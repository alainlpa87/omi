<?php namespace App\Http\Controllers;

use App\Helpers\PlivoHelper;
use App\Models\Assignment;
use App\Models\Consultant;
use App\Models\Contract;
use App\Models\Inbox;
use App\Models\Lead;
use App\Models\Message;
use App\Models\PaymentTransaction;
use App\Models\Project;
use App\Models\Request;
use App\Models\Submission;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class StatsController extends Controller {


     /*
     * Current Consultant logged
     */
    public $consultant;
    /*
     * To Allow use the controller methods the current user logged has to be Consultant
     */
    public function __construct()
    {
        $this->middleware('statistics');
        $this->middleware(function ($request, $next) {
            $this->consultant = Consultant::find(Session::get('user_id'));
            return $next($request);
        });
    }
    /*
    * Send to the index view the active consultant,the consultant list
    *
    * @return Response
    */
    public function index()
    {
        $consultants = Consultant::where('rol','like','%score%')->get();
        $voiceMessages = Message::where(['type'=>'VM','consultant_id'=>$this->consultant->id])->get();
        $vendors = Assignment::where('status','NEW')->distinct()->select('leadSource')->groupBy('leadSource')->get();
        $total_inbox = Inbox::where(['consultant_id'=>$this->consultant->id,'status'=>0])->count();
        return view('intranet.report.index',array('consultant'=>$this->consultant,'consultants'=>$consultants,'voiceMessages'=>$voiceMessages,
            'total_inbox'=>$total_inbox,'vendors'=>$vendors));
    }
    /*
     * Return a list with the projects that has been sent by contrat in a period of time and
     * was approved in the last 14 days by consultant
     *
     **/
    public function consultantContractReport()
    {
        $dateStartInput = Input::get('STARTDATE');
        $dateStartInput = date("Y-m-d H:i:s", strtotime("-8 hours", strtotime($dateStartInput)));
        $dateEndInput = Input::get('STARTEND');
        $consultant_id = Input::get('CONSULTANT');

        $dateStart = new \DateTime($dateStartInput);
        $dateEnd = new \DateTime($dateEndInput);
        $dateEnd = new \DateTime($dateEnd->format("Y-m-d")." 16:00:00");

        $consultant = Consultant::find($consultant_id);
        if($consultant!=null)
        {
            $contractsOut = 0;
            $contracts = Contract::where('consultant_id',$consultant->id)->where('created_at','>=',$dateStart->format("Y-m-d H:i:s"))->where('created_at','<=',$dateEnd->format("Y-m-d H:i:s"))->get();
            $contractsA=array();
            foreach($contracts as $contract)
            {
                $datetimeProject = new \DateTime($contract->project->firstContract()->created_at);
                $request = $contract->project->requests->where('consultantStage','APPROVE')->where('adminStage','APPROVED')->sortByDesc('updated_at')->first();
                if($request!= null && $contract->id == $contract->project->firstContract()->id && $datetimeProject>=$dateStart && $datetimeProject <=$dateEnd)
                {
                    $dateRequestApproved = new \DateTime($request->updated_at);
                    $intervalD = $datetimeProject->diff($dateRequestApproved)->d;
                    $intervalM = $datetimeProject->diff($dateRequestApproved)->m;
                    if($intervalD<=14 && $intervalM==0)
                    {
                        $contractsA[$contractsOut]['FILENO']=$contract->project->lead->fileno;
                        $contractsA[$contractsOut]['DATE']=$datetimeProject->format("Y-m-d");
                        $contractsOut++;
                    }
                }
            }
            $contractsA['TOTAL']=$contractsOut;
            return json_encode($contractsA);
        }
        else
        {
            $contractsSend = Contract::where('created_at','>=',$dateStart->format("Y-m-d H:i:s"))->where('created_at','<=',$dateEnd->format("Y-m-d H:i:s"))->get();
            $contractsOut = 0;
            $contracts=array();
            foreach($contractsSend as $contract)
            {
                $project = $contract->project;
                if($project && $project->firstContract()!=null)
                {
                    $datetimeProject = new \DateTime($project->firstContract()->created_at);
                    $request = $project->requests->where('consultantStage','APPROVE')->where('adminStage','APPROVED')->sortByDesc('updated_at')->first();
                    if($request!= null && $contract->id == $project->firstContract()->id && $datetimeProject>=$dateStart && $datetimeProject <=$dateEnd)
                    {
                        $dateRequestApproved = new \DateTime($request->updated_at);
                        $intervalD = $datetimeProject->diff($dateRequestApproved)->d;
                        $intervalM = $datetimeProject->diff($dateRequestApproved)->m;
                        if($intervalD<=14 && $intervalM==0)
                        {
                            if(!isset( $contracts[$contract->consultant->usr]))
                            {
                                $contracts[$contract->consultant->usr]=['TOTAL'=>0,'FILENOS'=>''];
                            }
                            $contracts[$contract->consultant->usr]['TOTAL']+=1;
                            $contracts[$contract->consultant->usr]['FILENOS'].= $project->lead->fileno."  ";
                            $contractsOut++;
                        }
                    }
                }
            }
            $contracts['TOTAL']=$contractsOut;
            return json_encode($contracts);
        }
        return "-1";
    }
    /*
     * Return a list with the projects approved in a period of time by consultant
     *
     */
    public function consultantSubmissionReport()
    {
        $dateStartInput = Input::get('STARTDATE');
        $dateStartInput = date("Y-m-d H:i:s", strtotime("-8 hours", strtotime($dateStartInput)));
        $dateEndInput = Input::get('STARTEND');
        $consultant_id = Input::get('CONSULTANT');

        $dateStart = new \DateTime($dateStartInput);
        $dateEnd = new \DateTime($dateEndInput);
        $dateEnd = new \DateTime($dateEnd->format("Y-m-d")." 16:00:00");

        $consultant = Consultant::find($consultant_id);
        if($consultant!=null)
        {
            $approvedList=array();
            $rejectedList=array();
            $needsMoreInfoList = array();
            $approves = $rejectes = $needsMores = 0;
            $leadSources = array();

            $date1 = date("Y-m-d H:i:s", strtotime(Input::get('STARTDATE')));
            if($date1 < '2017-01-01 00:00:00'){
                $projects = $consultant->projects;
                foreach($projects as $project)
                {
                    $requestApproved = $project->requests->where('adminStage','APPROVED')->sortBy('updated_at')->first();
                    $requestRejected = $project->requests->where('adminStage','REJECTED')->sortBy('updated_at')->first();
                    $requestNeedsMoreInfo = $project->requests->where('adminStage','NEEDS MORE INFO')->sortByDesc('updated_at')->first();

                    if($requestApproved!= null)
                    {
                        $assignment = Submission::where('project_id',$requestApproved->project_id)->where('status','NEW')->where('consultant_id',$requestApproved->project->consultant_id)->first();
                        if($assignment!=null){
                            $datetimeRequest = new \DateTime($requestApproved->updated_at);
                            if($datetimeRequest>=$dateStart && $datetimeRequest<=$dateEnd)
                            {
                                $approvedList[$approves]['FILENO']=$project->lead->fileno;
                                $approvedList[$approves]['PIN']=$project->id;
                                $approvedList[$approves]['DATE']=$datetimeRequest->format("Y-m-d");
                                $approvedList[$approves]['LEADSOURCE']=$project->lead->leadSource;
                                if(!isset($leadSources[$project->lead->leadSource]))
                                    $leadSources[$project->lead->leadSource]=0;
                                $leadSources[$project->lead->leadSource]+=1;
                                $approves++;
                            }
                        }
                    }
                    if($requestRejected!= null)
                    {
                        $datetimeRequest = new \DateTime($requestRejected->updated_at);
                        if($datetimeRequest>=$dateStart && $datetimeRequest<=$dateEnd)
                        {
                            $rejectedList[$rejectes]['FILENO']=$project->lead->fileno;
                            $rejectedList[$rejectes]['PIN']=$project->id;
                            $rejectedList[$rejectes]['DATE']=$datetimeRequest->format("Y-m-d");
                            $rejectedList[$rejectes]['LEADSOURCE']=$project->lead->leadSource;
                            if(!isset($leadSources[$project->lead->leadSource]))
                                $leadSources[$project->lead->leadSource]=0;
                            $leadSources[$project->lead->leadSource]+=1;
                            $rejectes++;
                        }
                    }
                    if($requestNeedsMoreInfo!= null)
                    {
                        $datetimeRequest = new \DateTime($requestNeedsMoreInfo->updated_at);
                        if($datetimeRequest>=$dateStart && $datetimeRequest<=$dateEnd)
                        {
                            $needsMoreInfoList[$needsMores]['FILENO']=$project->lead->fileno;
                            $needsMoreInfoList[$needsMores]['PIN']=$project->id;
                            $needsMoreInfoList[$needsMores]['DATE']=$datetimeRequest->format("Y-m-d");
                            $needsMoreInfoList[$needsMores]['LEADSOURCE']=$project->lead->leadSource;
                            if(!isset($leadSources[$project->lead->leadSource]))
                                $leadSources[$project->lead->leadSource]=0;
                            $leadSources[$project->lead->leadSource]+=1;
                            $needsMores++;
                        }
                    }
                }
            }else{
                $dateStartInput = Input::get('STARTDATE');
                $dateStartInput = date("Y-m-d H:i:s", strtotime("-8 hours", strtotime($dateStartInput)));
                $dateEndInput = Input::get('STARTEND');
                $dateEndInput = date("Y-m-d H:i:s", strtotime("+16 hours", strtotime($dateEndInput)));

                $totalList = array();
                $request = Request::where('updated_at','>=',$dateStartInput)->where('updated_at','<=',$dateEndInput)->where('consultant_id','like',$consultant_id)->orderBy('updated_at','desc')->get();
                foreach($request as $req){
                    if(!in_array($req->project_id, $totalList) && $req->consultantStage == 'APPROVE'){

                        $datetimeRequest = new \DateTime($req->updated_at);
                        $project = $req->project;

                        if($req->adminStage == 'APPROVED'){
                            $approvedList[$approves]['FILENO']=$project->lead->fileno;
                            $approvedList[$approves]['PIN']=$project->id;
                            $approvedList[$approves]['DATE']=$datetimeRequest->format("Y-m-d");
                            $approvedList[$approves]['LEADSOURCE']=$project->lead->leadSource;
                            if(!isset($leadSources[$project->lead->leadSource]))
                                $leadSources[$project->lead->leadSource]=0;
                            $leadSources[$project->lead->leadSource]+=1;
                            $approves++;
                            $totalList []= $req->project_id;
                        }
                        if($req->adminStage == 'NEEDS MORE INFO'){
                            $needsMoreInfoList[$needsMores]['FILENO']=$project->lead->fileno;
                            $needsMoreInfoList[$needsMores]['PIN']=$project->id;
                            $needsMoreInfoList[$needsMores]['DATE']=$datetimeRequest->format("Y-m-d");
                            $needsMoreInfoList[$needsMores]['LEADSOURCE']=$project->lead->leadSource;
                            if(!isset($leadSources[$project->lead->leadSource]))
                                $leadSources[$project->lead->leadSource]=0;
                            $leadSources[$project->lead->leadSource]+=1;
                            $needsMores++;
                            $totalList []= $req->project_id;
                        }
                        if($req->adminStage == 'REJECTED'){
                            $rejectedList[$rejectes]['FILENO']=$project->lead->fileno;
                            $rejectedList[$rejectes]['PIN']=$project->id;
                            $rejectedList[$rejectes]['DATE']=$datetimeRequest->format("Y-m-d");
                            $rejectedList[$rejectes]['LEADSOURCE']=$project->lead->leadSource;
                            if(!isset($leadSources[$project->lead->leadSource]))
                                $leadSources[$project->lead->leadSource]=0;
                            $leadSources[$project->lead->leadSource]+=1;
                            $rejectes++;
                            $totalList []= $req->project_id;
                        }

                    }
                }
            }

            $requestResult = array();
            $requestResult['APPROVED'] = $approvedList;
            $requestResult['REJECTED'] = $rejectedList;
            $requestResult['NEEDSMOREINFO'] = $needsMoreInfoList;
            $requestResult['LEADSOURCE'] = $leadSources;
            return json_encode($requestResult);
        }
        else
        {
            $requests = Request::where('request','ADMIN')->where('updated_at','>=',$dateStart->format("Y-m-d H:i:s"))->where('updated_at','<=',$dateEnd->format("Y-m-d H:i:s"))->orderBy('created_at','ASC')->distinct('project_id')->groupBy('project_id')->get();
            $approvedList=array();
            $rejectedList=array();
            $needsMoreInfoList = array();
            $approves = $rejectes = $needsMores = 0;
            $leadSources = array();
            foreach($requests as $request)
            {
                $project = $request->project;
                if($project)
                {
                    $requestApproved = $project->requests->where('adminStage','APPROVED')->sortBy('updated_at')->first();
                    $requestRejected = $project->requests->where('adminStage','REJECTED')->sortBy('updated_at')->first();
                    $requestNeedsMoreInfo = $project->requests->where('adminStage','NEEDS MORE INFO')->sortByDesc('updated_at')->first();

                    if($requestApproved!= null)
                    {
                        $datetimeRequest = new \DateTime($requestApproved->updated_at);
                        if($datetimeRequest>=$dateStart && $datetimeRequest<=$dateEnd)
                        {
                            $assignment = Submission::where('project_id',$requestApproved->project_id)->where('status','NEW')->where('consultant_id',$requestApproved->project->consultant_id)->first();
                            if($assignment!=null) {
                                $approvedList[$approves]['FILENO'] = $project->lead->fileno;
                                $approvedList[$approves]['PIN'] = $project->id;
                                $approvedList[$approves]['DATE'] = $datetimeRequest->format("Y-m-d");
                                $approvedList[$approves]['LEADSOURCE'] = $project->lead->leadSource;
                                $approvedList[$approves]['CONSULTANT'] = $project->consultant->usr;
                                if (!isset($leadSources[$project->lead->leadSource]))
                                    $leadSources[$project->lead->leadSource] = 0;
                                $leadSources[$project->lead->leadSource] += 1;
                                $approves++;
                            }
                        }
                    }
                    if($requestRejected!= null)
                    {
                        $datetimeRequest = new \DateTime($requestRejected->updated_at);
                        if($datetimeRequest>=$dateStart && $datetimeRequest<=$dateEnd)
                        {
                            $rejectedList[$rejectes]['FILENO']=$project->lead->fileno;
                            $rejectedList[$rejectes]['PIN']=$project->id;
                            $rejectedList[$rejectes]['DATE']=$datetimeRequest->format("Y-m-d");
                            $rejectedList[$rejectes]['LEADSOURCE']=$project->lead->leadSource;
                            $rejectedList[$rejectes]['CONSULTANT']=$project->consultant->usr;
                            if(!isset($leadSources[$project->lead->leadSource]))
                                $leadSources[$project->lead->leadSource]=0;
                            $leadSources[$project->lead->leadSource]+=1;
                            $rejectes++;
                        }
                    }
                    if($requestNeedsMoreInfo!= null)
                    {
                        $datetimeRequest = new \DateTime($requestNeedsMoreInfo->updated_at);
                        if($datetimeRequest>=$dateStart && $datetimeRequest<=$dateEnd)
                        {
                            $needsMoreInfoList[$needsMores]['FILENO']=$project->lead->fileno;
                            $needsMoreInfoList[$needsMores]['PIN']=$project->id;
                            $needsMoreInfoList[$needsMores]['DATE']=$datetimeRequest->format("Y-m-d");
                            $needsMoreInfoList[$needsMores]['LEADSOURCE']=$project->lead->leadSource;
                            $needsMoreInfoList[$needsMores]['CONSULTANT']=$project->consultant->usr;
                            if(!isset($leadSources[$project->lead->leadSource]))
                                $leadSources[$project->lead->leadSource]=0;
                            $leadSources[$project->lead->leadSource]+=1;
                            $needsMores++;
                        }
                    }
                }
            }
            $requestResult = array();
            $requestResult['APPROVED'] = $approvedList;
            $requestResult['REJECTED'] = $rejectedList;
            $requestResult['NEEDSMOREINFO'] = $needsMoreInfoList;
            $requestResult['LEADSOURCE'] = $leadSources;
            return json_encode($requestResult);
        }
        return "-1";
    }
    /*
     * Return a list with the projects sold in a period of time by consultant
     *
     */
    public function consultantSoldReport()
    {
        $dateStartInput = Input::get('STARTDATE');
        $dateEndInput = Input::get('STARTEND');
        $consultant_id = Input::get('CONSULTANT');

        $dateStart = new \DateTime($dateStartInput);
        $dateEnd = new \DateTime($dateEndInput);
        $dateEnd = new \DateTime($dateEnd->format("Y-m-d")." 23:59:59");

        $consultant = Consultant::find($consultant_id);
        if($consultant!=null)
        {
            $contracts = Contract::where('consultant_id',$consultant->id)->whereRaw('price = paid')->
            where('signedDate','>=',$dateStart)->where('paidDate','>=',$dateStart)->
            where('signedDate','<=',$dateEnd)->where('paidDate','<=',$dateEnd)->get();
            $contractsSold = 0;
            $contractsSoldA =array();
            foreach($contracts as $contract)
            {
                $datetimeContract = New \DateTime($contract->paidDate);
                $contractsSoldA[$contractsSold][$consultant->usr]['FILENO']=$contract->project->lead->fileno;
                $contractsSoldA[$contractsSold][$consultant->usr]['DATE']=$datetimeContract->format("Y-m-d");
                $contractsSoldA[$contractsSold][$consultant->usr]['TYPE']=$contract->type;
                $contractsSoldA[$contractsSold][$consultant->usr]['PAID']=$contract->paid;
                $contractsSold++;
            }
            $contractsSoldA['TOTAL']=$contractsSold;
            return json_encode($contractsSoldA);
        }
        else
        {
            $contracts = Contract::whereRaw('price = paid')->where('signedDate','>=',$dateStart)->where('paidDate','>=',$dateStart)->
            where('signedDate','<=',$dateEnd)->where('paidDate','<=',$dateEnd)->get();
            $contractsSold = 0;
            $contractsSoldA =array();
            foreach($contracts as $contract)
            {
                $datetimeContract = New \DateTime($contract->paidDate);
                $contractsSoldA[$contractsSold][$contract->consultant?$contract->consultant->usr:$contract->project->consultant->usr]['FILENO']=$contract->project->lead->fileno;
                $contractsSoldA[$contractsSold][$contract->consultant?$contract->consultant->usr:$contract->project->consultant->usr]['DATE']=$datetimeContract->format("Y-m-d");
                $contractsSoldA[$contractsSold][$contract->consultant?$contract->consultant->usr:$contract->project->consultant->usr]['TYPE']=$contract->type;
                $contractsSoldA[$contractsSold][$contract->consultant?$contract->consultant->usr:$contract->project->consultant->usr]['PAID']=$contract->paid;
                $contractsSold++;
            }
            $contractsSoldA['TOTAL']=$contractsSold;
            return json_encode($contractsSoldA);
        }
        return "-1";
    }

    /*
     * Return a list with the projects sold in a period of time by consultant
     *
     */
    public function personalPH2ClosingRatio()
    {
        $consultant_id = Input::get('CONSULTANT');
        $consultant = Consultant::find($consultant_id);

        $dateStartInput = Input::get('STARTDATE');
        $dateStart = new \DateTime($dateStartInput);
        $dateStart = new \DateTime($dateStart->format("Y-m-d")." 00:00:00");

        $dateEndInput = Input::get('STARTEND');
        $dateEnd = new \DateTime($dateEndInput);
        $dateEnd = new \DateTime($dateEnd->format("Y-m-d")." 23:59:59");

        $contracts = Contract::where(['consultant_id'=>$consultant_id])->where('paid','>',0)->whereRaw('price <= paid')->where('paidDate','>=',$dateStart)->where('paidDate','<=',$dateEnd)->whereIn('type', array('IIG','IMG'))->get();


        $contractsSold = 0;
        $totalAmount = 0;
        $contractsSoldA =array();
        foreach($contracts as $contract)
        {
            $datetimeContract = New \DateTime($contract->paidDate);
            $contractsSoldA[$contractsSold][$consultant->usr]['FILENO']=$contract->project->lead->fileno;
            $contractsSoldA[$contractsSold][$consultant->usr]['DATE']=$datetimeContract->format("Y-m-d");
            $contractsSoldA[$contractsSold][$consultant->usr]['PAID']=$contract->paid;
            $contractsSoldA[$contractsSold][$consultant->usr]['CONSULTANT']=$contract->project->consultant->usr;
            $contractsSoldA[$contractsSold][$consultant->usr]['PPA']=($contract->project->contractPPA() != '' && $contract->project->contractPPA()->paid >0 ? $contract->project->contractPPA()->paid : 'NO PPA');
            ($contract->project->contractPPA() != '' && $contract->project->contractPPA()->paid >0 ? $totalAmount++: '');
            $contractsSold++;
        }
        $contractsSoldA['TOTAL']['TOTAL']=$contractsSold;
        $contractsSoldA['TOTAL']['SOLD']=$totalAmount;
        $contractsSoldA['TOTAL']['CLOSING RATIO']=$totalAmount/$contractsSold;
        return json_encode($contractsSoldA);
    }

    public function teamLeadPH2ClosingRatio()
    {
        $consultant_id = Input::get('CONSULTANT');
        $consultant = Consultant::find($consultant_id);

        $dateStartInput = Input::get('STARTDATE');
        $dateStart = new \DateTime($dateStartInput);
        $dateStart = new \DateTime($dateStart->format("Y-m-d")." 00:00:00");



        $dateEndInput = Input::get('STARTEND');
        $dateEnd = new \DateTime($dateEndInput);
        $dateEnd = new \DateTime($dateEnd->format("Y-m-d")." 23:59:59");



        $projects = DB::table('project')
            ->join('submission', function($join)use ($consultant_id,$dateStart,$dateEnd)
            {
                $join->on('submission.project_id', '=', 'project.id')
                    ->where('project.consultant_id', '=', $consultant_id)
                    ->where('submission.consultant_id', '=', $consultant_id)
                    ->where('submission.status', '=', 'REASSIGN')
                    ->where('submission.created_at', '>=', $dateStart)
                    ->where('submission.created_at', '<=', $dateEnd);
            })
            ->get();

        $contractsSold = 0;
        $totalAmount = 0;
        $contractsSoldA =array();
        foreach($projects as $project1)
        {
            $project = Project::find($project1->project_id);
            $consultantAux = '';
            $datetimeContract = '';
            $valid = 0;
            if($project->contractIIG() != "" && $project->contractIIG()->consultant_id != $consultant_id){
                $aux = Consultant::find($project->contractIIG()->consultant_id);
                if($aux != null)
                    $consultantAux = $aux->usr;
                $datetimeContract = date('m-d-Y',strtotime(str_replace('-','/',$project->contractIIG()->paidDate)));
                $valid = 1;
            }elseif($project->contractIMG() != "" && $project->contractIMG()->consultant_id != $consultant_id){
                $aux = Consultant::find($project->contractIMG()->consultant_id);
                if($aux != null)
                    $consultantAux = $aux->usr;
                $datetimeContract = date('m-d-Y',strtotime(str_replace('-','/',$project->contractIMG()->paidDate)));
                $valid = 1;

            }

            if($valid){
                $ppa = 'NO PPA';
                if($project->contractPPA() != '' && $project->contractPPA()->paid >0 && $project->contractPPA()->consultant_id == $consultant_id){
                    $ppa = $project->contractPPA()->paid.'<br>';
                    $totalAmount++;
                }

                $contractsSoldA[$contractsSold][$consultant->usr]['FILENO']=$project->lead->fileno;
                $contractsSoldA[$contractsSold][$consultant->usr]['DATE']= $datetimeContract;
                $contractsSoldA[$contractsSold][$consultant->usr]['PAID']=$project->totalPhase1AmountIn();
                $contractsSoldA[$contractsSold][$consultant->usr]['CONSULTANT']=$consultantAux;
                $contractsSoldA[$contractsSold][$consultant->usr]['PPA']= $ppa;
                $contractsSold++;
            }
        }
        $contractsSoldA['TOTAL']['TOTAL']=$contractsSold;
        $contractsSoldA['TOTAL']['SOLD']=$totalAmount;
        $contractsSoldA['TOTAL']['CLOSING RATIO']=$totalAmount/$contractsSold;
        return json_encode($contractsSoldA);
    }

    /*
     * Return a list with the total of new leads assign per consultant and by leadSource
     *
     */
    public function leadsPerConsultantReport()
    {
        $dateStartInput = Input::get('STARTDATE');
        $dateEndInput = Input::get('STARTEND');
        $consultant_id = Input::get('CONSULTANT');

        $dateStart = new \DateTime($dateStartInput);
        $dateEnd = new \DateTime($dateEndInput);

        if($consultant_id==-1)
            $assignments = Assignment::where('created_at','>=',$dateStart->format("Y-m-d")." 00:00:00")->where('created_at','<=',$dateEnd->format("Y-m-d")." 23:59:59")->where('status','NEW')->get();
        else
            $assignments = Assignment::where('created_at','>=',$dateStart->format("Y-m-d")." 00:00:00")->where('created_at','<=',$dateEnd->format("Y-m-d")." 23:59:59")->where(array('status'=>'NEW','consultant_id'=>$consultant_id))->get();

        $assignmentResult = array();
        $assignmentResult['TOTAL']=0;
        $assignmentResult['UNLOADED']=Lead::where('consultant_id',$consultant_id)->where('created_at','>=',$dateStart->format("Y-m-d")." 00:00:00")
        ->where('status','UNLOADED')->count();
        if($consultant_id==-1)
            foreach($assignments as $assignment)
            {
                if(isset($assignmentResult[$assignment->consultant->usr]))
                    $assignmentResult[$assignment->consultant->usr]+=1;
                else
                    $assignmentResult[$assignment->consultant->usr]=1;
                $assignmentResult['TOTAL'] += 1;
            }
        else
            foreach($assignments as $assignment)
            {
                if(isset($assignmentResult[$assignment->lead->leadSource]))
                    $assignmentResult[$assignment->lead->leadSource]+=1;
                else
                    $assignmentResult[$assignment->lead->leadSource]=1;
                $assignmentResult['TOTAL']+=1;
            }
        echo json_encode($assignmentResult);
    }
    /*
     * Return a list with the total of leads called in a 1-3 period per consultant
     *
     */
    public function leadsCalled3DayIntervalReport()
    {
        $dateEndInput = Input::get('STARTDATE');
        $dateEnd = new \DateTime($dateEndInput);

        $dateStart = $dateEnd->sub(new \DateInterval('P21D'));
        $dateEnd = new \DateTime($dateEndInput);
        $calls = Transaction::where('created_at','<=',$dateEnd->format("Y-m-d")." 23:59:59")->where('created_at','>=',$dateStart->format("Y-m-d")." 00:00:00")->where('transtype','CALL')->get();
        $callsInterval=array();

        foreach($calls as $call)
        {
            $dateLastCall =  new \DateTime($call->created_at);
            $dateLastCall = new \DateTime($dateLastCall->format("Y-m-d")." 00:00:00");
            $interval = $dateEnd->diff($dateLastCall)->d;
            $pos=intval(($interval+2)/3);
            if(!isset($callsInterval[$pos]['Total']))
                $callsInterval[$pos]['Total']=0;
            $callsInterval[$pos]['Total']+=1;
        }
        echo json_encode($callsInterval);
    }
    /*
     * Return a list with the total of leads called in a 1-3 period per consultant
     * (OK)
     */
    public function leadsCalled3DayIntervalPerConsultantReport()
    {
        $dateEndInput = Input::get('STARTDATE');
        $dateEnd = new \DateTime($dateEndInput);

        $dateStart = $dateEnd->sub(new \DateInterval('P21D'));
        $dateEnd = new \DateTime($dateEndInput);
        $calls = Transaction::where('created_at','<=',$dateEnd->format("Y-m-d")." 23:59:59")->where('created_at','>=',$dateStart->format("Y-m-d")." 00:00:00")->where('transtype','CALL')->get();
        $callsInterval=array();

        foreach($calls as $call)
        {
            $dateLastCall =  new \DateTime($call->created_at);
            $dateLastCall = new \DateTime($dateLastCall->format("Y-m-d")." 00:00:00");
            $interval = $dateEnd->diff($dateLastCall)->d;
            $pos=intval(($interval+2)/3);
            if(!isset($callsInterval[$call->consultant->usr]))
                $callsInterval[$call->consultant->usr]=array_fill(0, 8, 0);
            $callsInterval[$call->consultant->usr][$pos]+=1;
        }
        echo json_encode($callsInterval);
    }
    //Transactions between Start and End Date for an specific consultants (ok)
    public function transactionPerConsultantReport()
    {
        $dateStartInput = Input::get('STARTDATE');
        $dateEndInput = Input::get('STARTEND');
        $consultant_id = Input::get('CONSULTANT');

        $dateStart = new \DateTime($dateStartInput);
        $dateEnd = new \DateTime($dateEndInput);

        $transtypes=["CALL","SMS","VM","EMAIL","EMAILED-CONTRACT","REQUESTED-CONTRACT","PAYMENT-MADE-CLIENT"];
        $transactions = Transaction::where('created_at','<=',$dateEnd->format("Y-m-d")." 23:59:59")->whereIn('transtype', $transtypes)->where('created_at','>=',$dateStart->format("Y-m-d")." 00:00:00")->where('consultant_id',$consultant_id)->get();
        $transactionsResult=array();

        $interval = $dateEnd->diff($dateStart)->d;
        $interval = $interval>0?$interval+1:1;
        $labels = array();
        for($i=0;$i<$interval;$i++)
        {
            $day =  new \DateTime($dateStartInput);
            $day->add(new \DateInterval("P".$i."D"));
            $labels[]=$day->format("M-d");
        }
        $series = array();
        $totals = array();
        $totals["CALL"]=0;
        $totals["Lead"]=0;
        $totals["New"]=0;
        $totals["Recycle"]=0;
        $totals["PH-1 CALLS"]=0;
        $totals["PH-2 CALLS"]=0;
        $total = 0;
        foreach($transactions as $transaction)
        {
            $day =  new \DateTime(date("Y-m-d",strtotime($transaction->created_at))." 00:00:00");
            $interval1 = $day->diff($dateStart)->d;
            if(!isset($series[$transaction->transtype]))
            {
                $series[$transaction->transtype]= array_fill(0, $interval, 0);
            }
            if(!isset($totals[$transaction->transtype]))
                $totals[$transaction->transtype]=0;
            $total+=1;
            $series[$transaction->transtype][$interval1]+=1;
            $totals[$transaction->transtype]+=1;
            //to count type of calls
            if($transaction->transtype == "CALL" && $transaction->contractType != ""){
                if($transaction->contractType == "Lead")
                    $totals["Lead"]+=1;
                if($transaction->contractType == "Sub")
                    $totals["PH-1 CALLS"]+=1;
                if($transaction->contractType == "PaidPH1")
                    $totals["PH-2 CALLS"]+=1;
                if($transaction->contractType == "Lead" && $transaction->payPostedBy != ""){
                    $totals[$transaction->payPostedBy]+=1;
                }
            }
        }
        $transactionsResult['LABEL']=$labels;
        $transactionsResult['SERIES']=$series;
        $transactionsResult['TOTALS']=$totals;
        $transactionsResult['TOTAL']=$total;
        echo json_encode($transactionsResult);

    }
    //Transactions between Start and End Date for all consultants (ok)
    public function transactionReport()
    {
        $dateStartInput = Input::get('STARTDATE');
        $dateEndInput = Input::get('STARTEND');

        $dateStart = new \DateTime($dateStartInput);
        $dateEnd = new \DateTime($dateEndInput);

        $transtypes=["CALL","SMS","VM","EMAIL","EMAILED-CONTRACT","REQUESTED-CONTRACT","PAYMENT-MADE-CLIENT"];
        $transactions = Transaction::where('created_at','<=',$dateEnd->format("Y-m-d")." 23:59:59")->whereIn('transtype', $transtypes)->where('created_at','>=',$dateStart->format("Y-m-d")." 00:00:00")->get();
        $transactionsResult=array();

        $interval = $dateEnd->diff($dateStart)->d;
        $interval = $interval>0?$interval+1:1;
        $labels = array();
        for($i=0;$i<$interval;$i++)
        {
            $day =  new \DateTime($dateStartInput);
            $day->add(new \DateInterval("P".$i."D"));
            $labels[]=$day->format("M-d");
        }

        $series = array();
        $totals = array();
        $totals["CALL"]=0;
        $totals["Lead"]=0;
        $totals["New"]=0;
        $totals["Recycle"]=0;
        $totals["PH-1 CALLS"]=0;
        $totals["PH-2 CALLS"]=0;
        $total = 0;
        foreach($transactions as $transaction)
        {
            $day =  new \DateTime(date("Y-m-d",strtotime($transaction->created_at))." 00:00:00");
            $interval1 = $day->diff($dateStart)->d;
            if(!isset($series[$transaction->transtype]))
            {
                $series[$transaction->transtype]= array_fill(0, $interval, 0);
            }
            if(!isset($totals[$transaction->transtype]))
                $totals[$transaction->transtype]=0;
            $total+=1;
            $series[$transaction->transtype][$interval1]+=1;
            $totals[$transaction->transtype]+=1;
            //to count type of calls
            if($transaction->transtype == "CALL" && $transaction->contractType != ""){
                if($transaction->contractType == "Lead")
                    $totals["Lead"]+=1;
                if($transaction->contractType == "Sub")
                    $totals["PH-1 CALLS"]+=1;
                if($transaction->contractType == "PaidPH1")
                    $totals["PH-2 CALLS"]+=1;
                if($transaction->contractType == "Lead" && $transaction->payPostedBy != ""){
                    $totals[$transaction->payPostedBy]+=1;
                }
            }
        }
        $transactionsResult['LABEL']=$labels;
        $transactionsResult['SERIES']=$series;
        $transactionsResult['TOTALS']=$totals;
        $transactionsResult['TOTAL']=$total;
        echo json_encode($transactionsResult);
    }

    public function leadsBySourceReport()
    {
        $dateStartInput = Input::get('STARTDATE');
        $dateEndInput = Input::get('STARTEND');

        $dateStart = new \DateTime($dateStartInput);
        $dateEnd = new \DateTime($dateEndInput);


        $assignments = Assignment::where('created_at','>=',$dateStart->format("Y-m-d")." 00:00:00")->where('created_at','<=',$dateEnd->format("Y-m-d")." 23:59:59")->where('status','NEW')->get();
        $assignmentResult = array();

        $interval = $dateEnd->diff($dateStart)->d+1;
        $labels = array();
        for($i=0;$i<$interval;$i++)
        {
            $day =  new \DateTime($dateStartInput);
            $day->add(new \DateInterval("P".$i."D"));
            $labels[]=$day->format("M-d");
        }
        $series = array();
        $totals = array();
        $total = 0;

        foreach($assignments as $assignment)
        {
            $day =  new \DateTime(date("Y-m-d",strtotime($assignment->created_at))." 00:00:00");
            $interval1 = $dateEnd->diff($day)->d;
            if(!isset($series[$assignment->leadSource]))
            {
                $series[$assignment->leadSource]= array_fill(0, $interval, 0);
            }
            if(!isset($totals[$assignment->leadSource]))
                $totals[$assignment->leadSource]=0;
            $total+=1;
            $series[$assignment->leadSource][$interval1]+=1;
            $totals[$assignment->leadSource]+=1;
        }
        $assignmentResult['LABEL']=$labels;
        $assignmentResult['SERIES']=$series;
        $assignmentResult['TOTALS']=$totals;
        $assignmentResult['TOTAL']=$total;
        echo json_encode($assignmentResult);
    }

    public function projectBySourceReport()
    {
        $dateStartInput = Input::get('STARTDATE');
        $dateEndInput = Input::get('STARTEND');

        $dateStart = new \DateTime($dateStartInput);
        $dateEnd = new \DateTime($dateEndInput);

        $projects = Project::where('created_at','>=',$dateStart->format("Y-m-d")." 00:00:00")->where('created_at','<=',$dateEnd->format("Y-m-d")." 23:59:59")->orderBy('created_at','ASC')->get();

        $interval = $dateEnd->diff($dateStart)->d+1;
        $labels = array();
        for($i=0;$i<$interval;$i++)
        {
            $day =  new \DateTime($dateStartInput);
            $day->add(new \DateInterval("P".$i."D"));
            $labels[]=$day->format("M-d");
        }

        $projectResult = array();
        $series = array();
        $totals = array();
        $total = 0;
        foreach($projects as $project)
        {
            $day =  new \DateTime(date("Y-m-d",strtotime($project->created_at))." 00:00:00");
            $interval1 = $dateEnd->diff($day)->d;
            if($project->lead!=null)
            {
                if(!isset($series[$project->lead->leadSource]))
                {
                    $series[$project->lead->leadSource]= array_fill(0, $interval, 0);
                }
                if(!isset($totals[$project->lead->leadSource]))
                    $totals[$project->lead->leadSource]=0;
                $total+=1;
                $series[$project->lead->leadSource][$interval1]+=1;
                $totals[$project->lead->leadSource]+=1;
            }
        }
        $projectResult['LABEL']=$labels;
        $projectResult['SERIES']=$series;
        $projectResult['TOTALS']=$totals;
        $projectResult['TOTAL']=$total;
        echo json_encode($projectResult);
    }

    public function ph1PaidBySourceReport()
    {
        $dateStartInput = Input::get('STARTDATE');
        $dateEndInput = Input::get('STARTEND');

        $dateStart = new \DateTime($dateStartInput);
        $dateEnd = new \DateTime($dateEndInput);

        $contracts = Contract::whereRaw('price = paid')->whereIn('type', ['IMG','IIG'])->where('paidDate','>=',$dateStart->format("Y-m-d")." 00:00:00")->where('paidDate','<=',$dateEnd->format("Y-m-d")." 23:59:59")->groupBy('project_id')->get();
        $projects = array();
        foreach($contracts as $contract){
            if($contract->project->lead != null){
                $projects [] = array($contract->paidDate,$contract->project->lead->leadSource);
            }
        }

        $interval = $dateEnd->diff($dateStart)->d+1;
        $labels = array();
        for($i=0;$i<$interval;$i++)
        {
            $day =  new \DateTime($dateStartInput);
            $day->add(new \DateInterval("P".$i."D"));
            $labels[]=$day->format("M-d");
        }

        $projectResult = array();
        $series = array();
        $totals = array();
        $total = 0;
        foreach($projects as $project)
        {
            $day =  new \DateTime(date("Y-m-d",strtotime($project[0]))." 00:00:00");
            $interval1 = $dateEnd->diff($day)->d;
            if(!isset($series[$project[1]]))
            {
                $series[$project[1]]= array_fill(0, $interval, 0);
            }
            if(!isset($totals[$project[1]]))
                $totals[$project[1]]=0;
            $total+=1;
            $series[$project[1]][$interval1]+=1;
            $totals[$project[1]]+=1;
        }
        $projectResult['LABEL']=$labels;
        $projectResult['SERIES']=$series;
        $projectResult['TOTALS']=$totals;
        $projectResult['TOTAL']=$total;
        echo json_encode($projectResult);
    }

    public function leadWithProjectBySourceReport()
    {
        $dateStartInput = Input::get('STARTDATE');
        $dateEndInput = Input::get('STARTEND');

        $dateStart = new \DateTime($dateStartInput);
        $dateEnd = new \DateTime($dateEndInput);

        $projects = Project::where('created_at','>=',$dateStart->format("Y-m-d")." 00:00:00")->where('created_at','<=',$dateEnd->format("Y-m-d")." 23:59:59")->orderBy('created_at','ASC')->get();

        $interval = $dateEnd->diff($dateStart)->d+1;
        $labels = array();
        for($i=0;$i<$interval;$i++)
        {
            $day =  new \DateTime($dateStartInput);
            $day->add(new \DateInterval("P".$i."D"));
            $labels[]=$day->format("M-d");
        }

        $projectResult = array();
        $series = array();
        $totals = array();
        $leads = array();
        $total = 0;

        foreach($projects as $project)
        {
            $day =  new \DateTime(date("Y-m-d",strtotime($project->created_at))." 00:00:00");
            $interval1 = $dateEnd->diff($day)->d;
            $day = $day->format("M-d");
            if($project->lead!=null)
            {
                if(!isset($series[$project->lead->leadSource]))
                {
                    $series[$project->lead->leadSource]= array_fill(0, $interval, 0);
                }
                if(!isset($totals[$project->lead->leadSource]))
                    $totals[$project->lead->leadSource]=0;

                if(!isset($projectResult[$day][$project->lead->leadSource]))
                    $projectResult[$day][$project->lead->leadSource]=0;
                if(!isset($projectResult[$project->lead->leadSource]['TOTAL']))
                    $projectResult[$project->lead->leadSource]['TOTAL']=0;
                if(!isset($projectResult['TOTAL']))
                    $projectResult['TOTAL']=0;
                if(!in_array($project->lead_id,$leads))
                {
                    $total+=1;
                    $series[$project->lead->leadSource][$interval1]+=1;
                    $totals[$project->lead->leadSource]+=1;
                    $leads[]=$project->lead_id;
                }
            }
        }
        $projectResult['LABEL']=$labels;
        $projectResult['SERIES']=$series;
        $projectResult['TOTALS']=$totals;
        $projectResult['TOTAL']=$total;
        echo json_encode($projectResult);
    }

    public function grossLeadsBySourceReport()
    {
        $dateStartInput = Input::get('STARTDATE');
        $dateEndInput = Input::get('STARTEND');

        $dateStart = new \DateTime($dateStartInput);
        $dateEnd = new \DateTime($dateEndInput);
        $source = Input::get('SOURCE');

        $leads = Lead::where('created_at','>=',$dateStart->format("Y-m-d")." 00:00:00")->where('created_at','<=',$dateEnd->format("Y-m-d")." 23:59:59")->where('leadSource',$source)->get();
        $filename = "files/reports/".$source.date('m-d-Y-H-i-s_A').".csv";

        $rejfile = fopen($filename,"w");
        $n = 1;
        foreach($leads as $lead)
        {
            $row = array($n,$lead->fname,$lead->lname,$lead->email,$lead->created_at);
            fputcsv($rejfile,$row);
            $n++;
        }
        echo json_encode($filename);
    }

    public function setPaymentCompleteProject()
    {
        $id = Input::get('ID');
        $price = Input::get('PRICE');
        $type = Input::get('CTYPE');
        $signed = Input::get('SIGNED');
        $notes = Input::get('NOTES');
        $refund = Input::get('REFUND');
        $contract = Contract::where(['type'=>$type,'project_id'=>$id])->first();
        if($refund == 1){
            if($contract!=null){
                //create Payment transaction
                $payment_transaction = new PaymentTransaction();
                $payment_transaction->contract_id = $contract->id;
                $payment_transaction->amount = $price;
                $payment_transaction->source = $notes;
                $payment_transaction->details = 'Payment posted By Admin';
                $payment_transaction->numPayments = 1;
                $payment_transaction->approved =0;
                $payment_transaction->status ="refunded";
                $payment_transaction->subscriptionId ='';
                $payment_transaction->save();

                $newContractAmount = $contract->paid - $price;
                $contract->paid = $newContractAmount;
                if($type != 'PPA' && $newContractAmount == 0){
                    $contract->signedDate = '00-00-00 00:00:00';
                    $contract->signed = '';
                }
                $contract->save();

                return "1";
            }else{
                return "-1";
            }
        }else{
            if($contract!=null && $contract->paid<$contract->price )
            {
                if($type=="PPA")
                {
                    $contract->paid += $price;
                    $contract->price = 100000;
                }
                else
                {
                    $contract->paid = $price;
                    $contract->price = $price;
                }
                $contract->readed = 0;
                $contract->paidDate =  new \DateTime("now");
                $contract->consultant_id =$contract->project->consultant_id;
                if($signed)
                {
                    $contract->signedDate = new \DateTime("now");
                    $contract->signed = ucwords($contract->project->lead->fname." ".$contract->project->lead->lname);
                }
                $contract->save();

                //PPA Client Services
                if($type=="PPA"){
                    $clientS = Consultant::where('usr','clientservices')->first();
                    if($clientS!=null){
                        $msgInbox = "PPA Payment received.\r\n";
                        $msgInbox .= date("m-d-Y H:i:s")."\r\n";
                        $msgInbox .= "File #:".$contract->project->lead->fileno."\r\n";
                        $msgInbox .= "Client: ".$contract->project->lead->fname." ".$contract->project->lead->lname."\r\n";
                        if($signed){
                            $msgInbox .= "Contract Signed In.\r\n";
                        }
                        $msgInbox .= "Amount: ".$price."\r\n";
                        $msgInbox .= "PPA Paid To Date: ".$contract->paid."\r\n";
                        Inbox::createInbox($contract->project->lead->id,$clientS->id,$msgInbox,"PAYMENT","ADMIN");
                    }
                }
                //END

                if($type!="PPA")
                    $msgInbox = "Payment made By Admin.\r\n";
                else
                    $msgInbox = "PPA Payment made By Admin.\r\n";
                $msgInbox .= "File #:".$contract->project->lead->fileno."\r\n";
                $msgInbox .= "Pin: ".$contract->project->id."\r\n";
                $msgInbox .= "Client: ".$contract->project->lead->fname." ".$contract->project->lead->lname."\r\n";
                $msgInbox .= "Amount: ".$price."\r\n";
                Inbox::createInbox($contract->project->lead->id, $contract->project->consultant_id, $msgInbox, 'PAYMENT', 'ADMIN');

                //send sms to consultant.
                PlivoHelper::consultantSmsOutPerPayment($contract->project->consultant_id,$contract->project->id,$price);

                //create Payment transaction
                $payment_transaction = new PaymentTransaction();
                $payment_transaction->contract_id = $contract->id;
                $payment_transaction->amount = $price;
                $payment_transaction->source = $notes;
                $payment_transaction->details = 'Payment posted By Admin';
                $payment_transaction->numPayments = 1;
                $payment_transaction->approved =1;
                $payment_transaction->status ="approved";
                $payment_transaction->subscriptionId ='';
                $payment_transaction->save();

                //Create Transaction
                Transaction::createTransaction($this->consultant->id, $contract->project->lead->id, '', 'PAYMENT-MADE-BY-ADMIN', '',$contract->project->id, $contract->project->lead->email, '', 'ADMIN', $contract->project->lead->phone, $price);
                return "1";
            }
            else if($contract==null)
            {
                $contract = new Contract();
                $contract->project_id = $id;
                $contract->type = $type;
                if($type=="PPA")
                {
                    $contract->paid += $price;
                    $contract->price = 100000;
                }
                else
                {
                    $contract->paid = $price;
                    $contract->price = $price;
                }
                $contract->readed = 0;
                $contract->paidDate =  new \DateTime("now");
                $contract->consultant_id =$contract->project->consultant_id;
                if($signed && $type!="PPA")
                {
                    $contract->signedDate = new \DateTime("now");
                    $contract->signed = ucwords($contract->project->lead->fname." ".$contract->project->lead->lname);
                }
                $contract->save();

                //PPA Client Services
                if($type=="PPA"){
                    $clientS = Consultant::where('usr','clientservices')->first();
                    if($clientS!=null){
                        $msgInbox = "PPA Payment received.\r\n";
                        $msgInbox .= date("m-d-Y H:i:s")."\r\n";
                        $msgInbox .= "File #:".$contract->project->lead->fileno."\r\n";
                        $msgInbox .= "Client: ".$contract->project->lead->fname." ".$contract->project->lead->lname."\r\n";
                        $msgInbox .= "Amount: ".$price."\r\n";
                        $msgInbox .= "PPA Paid To Date: ".$contract->paid."\r\n";
                        Inbox::createInbox($contract->project->lead->id,$clientS->id,$msgInbox,"PAYMENT","ADMIN");
                    }
                }
                //END

                $msgInbox = "Payment made By Admin.\r\n";
                $msgInbox .= "File #:".$contract->project->lead->fileno."\r\n";
                $msgInbox .= "Pin: ".$contract->project->id."\r\n";
                $msgInbox .= "Client: ".$contract->project->lead->fname." ".$contract->project->lead->lname."\r\n";
                $msgInbox .= "Amount: ".$price."\r\n";
                Inbox::createInbox($contract->project->lead->id, $contract->project->consultant_id, $msgInbox, 'PAYMENT', 'ADMIN');

                //send sms to consultant.
                PlivoHelper::consultantSmsOutPerPayment($contract->project->consultant_id,$contract->project->id,$price);

                //create Payment transaction
                $payment_transaction = new PaymentTransaction();
                $payment_transaction->contract_id = $contract->id;
                $payment_transaction->amount = $price;
                $payment_transaction->source = $notes;
                $payment_transaction->details = 'Payment posted By Admin';
                $payment_transaction->numPayments = 1;
                $payment_transaction->approved =1;
                $payment_transaction->status ="approved";
                $payment_transaction->subscriptionId ='';
                $payment_transaction->save();

                //Create Transaction
                Transaction::createTransaction($this->consultant->id, $contract->project->lead->id, '', 'PAYMENT-MADE-BY-ADMIN', '',$contract->project->id, $contract->project->lead->email, '', 'ADMIN', $contract->project->lead->phone, $price);
                return "1";
            }
            else
                return "-2";
        }
    }
    //return a list with the projects that are in funding and already have made a payment
    public function projectsInFundingWithPayment()
    {
        $contracts = Contract::where('funding',1)->where('paid','>',0)->where('readed','>=',0)->get();
        $contractsA=array();
        $total=0;
        foreach($contracts as $contract)
        {
            $contractsA[$total]['FILENO'] = $contract->project->lead->fileno;
            $contractsA[$total]['PIN'] = $contract->project->id;
            $contractsA[$total]['TYPE'] = $contract->type;
            $contractsA[$total]['PRICE'] = $contract->price;
            $contractsA[$total]['PAID'] = $contract->paid;
            $contractsA[$total]['LAST_PAID'] = $contract->paidDate!="0000-00-00 00:00:00"?$contract->paidDate:"N/A";
            $contractsA[$total]['CONSULTANT'] = $contract->consultant->usr;
            $total++;
        }
        echo json_encode($contractsA);
    }
    //hide project in funding to dont show anymore in the funding report until a new payment is made
    public function deleteProjectsInFundingWithPayment()
    {
        $id = Input::get('ID');
        $project = Project::find($id);
        if($project!=null)
        {
            $contract = $project->contracts->where('funding',1)->where('readed',1)->first();
            if($contract==null)
                return "-1";
            $contract->readed = -1;
            $contract->save();
            return "1";
        }
        return "-1";
    }

    //return calls made by hours
    public function callsPerHourPerConsultant()
    {
        $dateStartInput = Input::get('STARTDATE');
        $consultant_id = Input::get('CONSULTANT');

        $dateStart = new \DateTime($dateStartInput);
        $consultant = Consultant::find($consultant_id);
        if($consultant!=null)
            $calls = Transaction::where('created_at','<=',$dateStart->format("Y-m-d")." 23:59:59")->where('created_at','>=',$dateStart->format("Y-m-d")." 08:00:00")->where(['transtype'=>'CALL','consultant_id'=>$consultant_id])->get();
         else
             $calls = Transaction::where('created_at','<=',$dateStart->format("Y-m-d")." 23:59:59")->where('created_at','>=',$dateStart->format("Y-m-d")." 08:00:00")->where('transtype','CALL')->get();
        $interval = 14;
        $labels = array();
        for($i=0;$i<$interval;$i++)
        {
            $labels[]=(($i+8)<10?'0'.($i+8):($i+8)).":00";
        }
        $series = array_fill(0, $interval, 0);
        $totals = array();
        $total = 0;
        foreach($calls as $call)
        {
            $hour =  new \DateTime(date("Y-m-d H:i:s",strtotime($call->created_at)));
            if(!isset($totals[$hour->format("H")]))
                $totals[$hour->format("H")]=0;
            $total+=1;
            $series[intval($hour->format("H"))-8]+=1;
            $totals[$hour->format("H")]+=1;
        }
        $transactionsResult['LABEL']=$labels;
        $transactionsResult['SERIES']=$series;
        $transactionsResult['TOTALS']=$totals;
        $transactionsResult['TOTAL']=$total;
        echo json_encode($transactionsResult);
    }


    //show the money report for the month
    public function monthlyMoneyReport() {
        //$paymentTrans = PaymentTransaction::where('status','!=','declined')->where('created_at','>=',date('Y-m-01 00:00:00'))->orderBy('created_at','ASC')->get();
        $paymentTrans = PaymentTransaction::where('status','!=','declined')->where('created_at','>=','2017-08-01 00:00:00')->orderBy('created_at','ASC')->get();
        $totalTransactions = 0;
        $data=array();
        foreach($paymentTrans as $transaction){
            $contract = $transaction->contract;
            $data[$totalTransactions]['CONSULTANT'] = ($contract->type == 'PPA')?$contract->project->getConsultantsOnSales():$contract->consultant->usr;
            $data[$totalTransactions]['FILENO'] = $contract->project->lead->fileno;
            $data[$totalTransactions]['PIN'] = $contract->project->id;
            $data[$totalTransactions]['PHASE'] = (($contract->funding == 1 || $contract->type == 'PPA') && $contract->paid < $contract->price)?(($transaction->status == 'approved')?'Funding ':'Refunded ').$contract->type:$contract->type;
            $data[$totalTransactions]['AMOUNT'] = ($transaction->status == 'approved')?"$".$transaction->amount:"-$".$transaction->amount;
            $data[$totalTransactions]['TRANSACTION'] = $transaction->id;
            $data[$totalTransactions]['NOTE'] = ($transaction->notes == '')?'Total Phase1: $'.$contract->project->totalPhase1AmountIn().($contract->type == 'PPA'?', Total Phase2: $'.$contract->paid:""):$transaction->notes;
            $data[$totalTransactions]['DATE'] = date('m/d/Y',strtotime($transaction->created_at));
            $totalTransactions++;
        }
        $data['TOTAL']=$totalTransactions;
        echo json_encode($data);
    }

    //sve note for an specific transaction on the money report
    public function monthlyReportSaveNotes() {

        $note = Input::get('VALUE');
        $transaction = PaymentTransaction::find(Input::get('ID'));
        if($transaction != null){
            $transaction->notes = $note;
            $transaction->save();
            return "1";
        }
        return "-1";
    }

    //save the money report for the month on csv
    public function monthlyMoneyReportCSV() {
        $paymentTrans = PaymentTransaction::where('status','!=','declined')->where('created_at','>=',date('Y-m-01 00:00:00'))->orderBy('created_at','ASC')->get();
        //$paymentTrans = PaymentTransaction::where('status','!=','declined')->where('created_at','>=','2017-07-01 00:00:00')->orderBy('created_at','ASC')->get();
        $filename = "files/reports/moneyReport_".date('m_Y').".csv";
        $rejfile = fopen($filename,"w");
        $row = array("CONSULTANT","FILENO","PIN","PHASE","AMOUNT","NOTE","DATE");
        fputcsv($rejfile,$row);
        foreach($paymentTrans as $transaction){
            $contract = $transaction->contract;
            $row = array(
                ($contract->type == 'PPA')?$contract->project->getConsultantsOnSales():$contract->consultant->usr,
                $contract->project->lead->fileno,$contract->project->id,
                (($contract->funding == 1 || $contract->type == 'PPA') && $contract->paid < $contract->price)?(($transaction->status == 'approved')?'Funding ':'Refunded ').$contract->type:$contract->type,
                ($transaction->status == 'approved')?"$".$transaction->amount:"-$".$transaction->amount,
                ($transaction->notes == '')?'Total Phase1: $'.$contract->project->totalPhase1AmountIn().($contract->type == 'PPA'?', Total Phase2: $'.$contract->paid:""):$transaction->notes,
                date('m/d/Y',strtotime($transaction->created_at))
            );
            fputcsv($rejfile,$row);
        }
        echo json_encode($filename);
    }

    public function paymentInAndNotSentToVendor() {
        $projects = DB::table('project')
            ->join('contract', function($join)
            {
                $join->on('contract.project_id', '=', 'project.id')
                    ->where('project.vendor', '=', 0)
                    ->where('contract.paid', '>',445)
                    ->where('contract.type', '!=','PPA')
                    ->where('contract.paidDate', '>','2017-01-01 00:00:00')
                    ->where('contract.signedDate', '>','2017-01-01 00:00:00');
            })
            ->groupBy('project.id')
            ->get();
        $totalTransactions = 0;
        $data=array();
        foreach($projects as $proy){
            $project = Project::find($proy->project_id);
            $contract = $project->lastContractPaid();
            $data[$totalTransactions]['FILENO'] = $project->lead->fileno;
            $data[$totalTransactions]['PIN'] = $project->id;
            $data[$totalTransactions]['CONTRACT TYPE'] = $contract['TYPE'];
            $data[$totalTransactions]['DATE'] = $contract['DATE'];
            $totalTransactions++;
        }
        $data['TOTAL']=$totalTransactions;
        echo json_encode($data);
    }


}
