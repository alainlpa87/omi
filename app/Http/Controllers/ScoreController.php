<?php namespace App\Http\Controllers;

use App\Models\Consultant;
use App\Models\ConsultantBoard;
use App\Models\ConsultantScore;
use App\Models\Contract;
use App\Models\Inbox;
use App\Models\Message;
use App\Models\Project;
use App\Models\ProjectProduction;
use App\Models\Request;
use App\Models\Submission;
use App\Models\Transaction;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class ScoreController extends Controller {


     /*
     * Current Consultant logged
     */
    public $consultant;
    /*
     * To Allow use the controller methods the current user logged has to be Consultant
     */
    public function __construct()
    {
        $this->middleware('consultant');
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
        $calls=0;
        $subs=0;
        $contracts=0;
        $ph1 = 0;
        $imgs = 0;
        $voiceMessages = Message::where(['type'=>'VM','consultant_id'=>$this->consultant->id])->get();
        $total_inbox = Inbox::where(['consultant_id'=>$this->consultant->id,'status'=>0])->count();
        $thisMonth = date("Y-m")."-01 00:00:00";
        $statsThisMonth = ConsultantBoard::where('created_at','>=',$thisMonth)->get();
        foreach($statsThisMonth as $stat)
        {
            $calls +=$stat->calls;
            $subs +=$stat->subs;
            $contracts +=$stat->cont;
            $ph1+=$stat->ph1;
            $imgs +=$stat->img;
        }
        //calls by type
        $thisMonthDate = date("Y-m")."-01 00:00:00";
        $transactions = Transaction::where(['consultant_id'=>$this->consultant->id,'transtype'=>'CALL'])->where('created_at','>=',$thisMonthDate)->get();$totals = array();
        $totals["CALL"]=count($transactions);
        $totals["Lead"]=0;
        $totals["New"]=0;
        $totals["Recycle"]=0;
        $totals["Sub"]=0;
        $totals["PaidPH1"]=0;
        $totals["Pipe"]=0;
        foreach($transactions as $transaction)
        {
            //to count type of calls
            if($transaction->contractType != ""){
                $totals[$transaction->contractType]+=1;
                if($transaction->contractType == "Lead" && $transaction->payPostedBy != ""){
                    $totals[$transaction->payPostedBy]+=1;
                }
            }
        }
        $projects = Project::where('consultant_id',$this->consultant->id)->where('lead_id','>',0)->where('status','not like','EXCLUDE')->where('created_at','>=',date('Y-m-d 00:00:00', strtotime('-7 days')))->get();
        foreach($projects as $project)
        {
            if($project->totalPhase1AmountIn() == "")
                $totals["Pipe"] += 1;
        }
        //END OF calls by type
        return view('intranet.stats.index',array('consultant'=>$this->consultant,'voiceMessages'=>$voiceMessages,
            'total_inbox'=>$total_inbox,'stats'=>$statsThisMonth,'calls'=>$calls,'subs'=>$subs,'contracts'=>$contracts,'ph1'=>$ph1,'imgs'=>$imgs,'totals'=>$totals));
    }
    public function consultantScores()
    {
        $data = array();
        $consultants = Consultant::where('rol','like','%consultant%')->get();
        $today = date("Y-m-d")." 00:00:00";
        $startCounting = date("Y-m-d H:i:s", strtotime("-13 days", strtotime($today)));
        $subsArray = array();
        $contsArray = array();
        $salesIIGArray = array();
        $salesIMGArray = array();
        foreach($consultants as $consultant)
        {
            $subsArray[$consultant->id]=0;
            $contsArray[$consultant->id]=0;
            $salesIIGArray[$consultant->id]=0;
            $salesIMGArray[$consultant->id]=0;
        }
        $requests = Request::where(['consultantStage'=>'APPROVE','adminStage'=>'APPROVED'])->where('updated_at','>=',$today)->get();
        foreach($requests as $request)
        {
            $firstRequest = Request::where(['consultantStage'=>'APPROVE','adminStage'=>'APPROVED','project_id'=>$request->project_id])->orderBy('created_at','ASC')->first();
            if($firstRequest==null||$firstRequest->id==$request->id)
                if($request->project)
                {
                    $assignment = Submission::where('project_id',$request->project_id)->where('status','NEW')->where('consultant_id',$request->project->consultant_id)->first();
                    if($assignment!=null)
                        $subsArray[$request->project->consultant_id]++;
                }
        }
        $contracts = Contract::where('created_at','>=',$today)->get();
        foreach($contracts as $contract)
        {
            $firstRequest = Request::where(['consultantStage'=>'APPROVE','adminStage'=>'APPROVED','project_id'=>$contract->project_id])->orderBy('created_at','ASC')->first();
            if($firstRequest!=null)
            {
                $dateRequest = new \DateTime($firstRequest->updated_at);
                $dateContract = new \DateTime($contract->created_at);
                $intervalD = $dateContract->diff($dateRequest)->d;
                $intervalM = $dateContract->diff($dateRequest)->m;
                if($intervalD<=14 && $intervalM==0 && $contract->project)
                {
                    if(!isset($contsArray[$contract->consultant_id]))
                        $contsArray[$contract->consultant_id]=0;
                    $contsArray[$contract->consultant_id]++;
                }
            }
        }
        $contracts = Contract::whereRaw('price = paid')->where('signedDate','>=',$today)->where('paidDate','>=',$today)->get();
        foreach($contracts as $contract)
        {
            if($contract->project)
            {
                if($contract->type=="IIG")
                    $salesIIGArray[$contract->consultant_id]++;
                else if($contract->type=="IMG"||$contract->type=="IGUP")
                    $salesIMGArray[$contract->consultant_id]++;
            }
        }

        //contra los IIG UPGRADES AS SOLD
        $contractsIIGUpgrades = Contract::whereRaw('price != paid')->where('signedDate','>=',$today)->where('paidDate','>=',$today)->where('iigUpgrade','=',1)->get();
        foreach($contractsIIGUpgrades as $contract){
            if($contract->project){
                if($contract->type=="IIG"){
                    $salesIIGArray[$contract->consultant_id]++;
                }
            }
        }
        //END OF count IIG UPGRADES AS SOLD

        foreach($consultants as $consultant)
        {
            $approvedToday= $subsArray[$consultant->id];
            $approved14= 0;
            $contractToday = $contsArray[$consultant->id];
            $contract14 = 0;
            $soldIIGToday =  $salesIIGArray[$consultant->id];
            $soldIMGToday =  $salesIMGArray[$consultant->id];
            $sold14 = 0;

            $consultanScores = ConsultantScore::where('consultant_id',$consultant->id)->where('created_at','>=',$startCounting)->get();
            foreach($consultanScores as $score)
            {
                $approved14+=$score->approvedPoint;
                $contract14+=$score->contractPoint;
                $sold14+=$score->salesPoint;
            }
            $data[$consultant->usr]['APPROVED_TODAY'] = $approvedToday;
            $data[$consultant->usr]['APPROVED_POINT_TODAY'] = $approvedToday*15;
            $data[$consultant->usr]['APPROVED_POINT_14'] =$approved14;

            $data[$consultant->usr]['CONTRACT_TODAY'] = $contractToday;
            $data[$consultant->usr]['CONTRACT_POINT_TODAY'] = $contractToday*15;
            $data[$consultant->usr]['CONTRACT_POINT_14'] =$contract14;

            $data[$consultant->usr]['SOLD_IIG_TODAY'] = $soldIIGToday;
            $data[$consultant->usr]['SOLD_IMG_TODAY'] = $soldIMGToday;
            $data[$consultant->usr]['SOLD_POINT_TODAY'] = ($soldIIGToday+$soldIMGToday)*75;
            $data[$consultant->usr]['SOLD_POINT_14'] =$sold14;

            $data[$consultant->usr]['TOTAL_TODAY'] = $approvedToday*15+$contractToday*15+($soldIIGToday+$soldIMGToday)*75;
            $data[$consultant->usr]['TOTAL_14'] =$approved14+$contract14+$sold14;
        }
        return json_encode($data);
    }
    public function consultantStats()
    {
        $calls=0;
        $subs=0;
        $contracts=0;
        $ph1 = 0;
        $img = 0;
        $month = Input::get('MONTH');
        $thisMonth = date("Y")."-$month-01 00:00:00";
        if($thisMonth>date("Y-m-d H:i:s"))
            $thisMonth = date("Y-m-d H:i:s", strtotime("-1 year", strtotime($thisMonth)));
        $to=date("Y-m-d H:i:s", strtotime("+1 month", strtotime($thisMonth)));
        $statsThisMonth = ConsultantBoard::where('created_at','>=',$thisMonth)->where('created_at','<',$to)->get();
        $data = array();
        foreach($statsThisMonth as $stat)
        {
            $data[ucwords($stat->consultant->usr)]['CALLS']=$stat->calls;
            $data[ucwords($stat->consultant->usr)]['SUBS']=$stat->subs;
            $data[ucwords($stat->consultant->usr)]['CONT']=$stat->cont;
            $data[ucwords($stat->consultant->usr)]['PH1']=$stat->ph1;
            $data[ucwords($stat->consultant->usr)]['IMG']=$stat->img;
            $calls +=$stat->calls;
            $subs +=$stat->subs;
            $contracts +=$stat->cont;
            $ph1+=$stat->ph1;
            $img +=$stat->img;
        }
        $data['TOTAL']['CALLS']=$calls;
        $data['TOTAL']['SUBS']=$subs;
        $data['TOTAL']['CONT']=$contracts;
        $data['TOTAL']['PH1']=$ph1;
        $data['TOTAL']['IMG']=$img;
        return json_encode($data);
    }
    public function consultantProduction(){
        $dateInit = date("Y-m")."-01";
        $dateBefore = date("Y-m-d",strtotime("-1 month",strtotime($dateInit)));
        $dateEnd = date("Y-m-d",strtotime("+3 month",strtotime($dateInit)));
        $data = array();
        $pos = 0;
        $projectsProductionLastMonthWithoutShipping = ProjectProduction::where('scheduleDate','>',$dateBefore)->where('scheduleDate','<',$dateInit)->where('shippingDate','like','0000-00-00 00:00:00')->get();
        foreach($projectsProductionLastMonthWithoutShipping as $projectP)
        {
            if($this->consultant->id == $projectP->project->consultant_id)
            {
                $data[$pos]['DATEPAYMENT']=date("m-d-Y",strtotime($projectP->paidDate));
                $data[$pos]['FILENO']=$projectP->fileno;
                $data[$pos]['INVENTOR']=ucwords($projectP->project->lead->fname." ".$projectP->project->lead->lname);
                $data[$pos]['DATEESTIMATE']=($projectP->scheduleDate != '0000-00-00 00:00:00'?date('m-d-Y',strtotime($projectP->scheduleDate)):'');
                $data[$pos]['DATESHIPING']=($projectP->shippingDate != '0000-00-00 00:00:00'?date('m-d-Y',strtotime($projectP->shippingDate)):'');
                $data[$pos]['CONSULTANT']=strtoupper($projectP->project->consultant->fname[0]."".$projectP->project->consultant->lname[0]);
                $data[$pos]['PPATYPE']= $projectP->project->utility;
                $pos++;
            }
        }

        $projectsProductionThisMonth = ProjectProduction::where('scheduleDate','>',$dateInit)->where('scheduleDate','<',$dateEnd)->get();
        foreach($projectsProductionThisMonth as $projectP)
        {
            if($this->consultant->id == $projectP->project->consultant_id)
            {
                $data[$pos]['DATEPAYMENT']=date("m-d-Y",strtotime($projectP->paidDate));
                $data[$pos]['FILENO']=$projectP->fileno;
                $data[$pos]['INVENTOR']=ucwords($projectP->project->lead->fname." ".$projectP->project->lead->lname);
                $data[$pos]['DATEESTIMATE']=($projectP->scheduleDate != '0000-00-00 00:00:00'?date('m-d-Y',strtotime($projectP->scheduleDate)):'');
                $data[$pos]['DATESHIPING']=($projectP->shippingDate != '0000-00-00 00:00:00'?date('m-d-Y',strtotime($projectP->shippingDate)):'');
                $data[$pos]['CONSULTANT']=strtoupper($projectP->project->consultant->fname[0]."".$projectP->project->consultant->lname[0]);
                $data[$pos]['PPATYPE']= $projectP->project->utility;
                $pos++;
            }
        }
        return json_encode($data);
    }

    public function productionProgressReport(){
        $dateInit = date("Y-m")."-01";
        $dateEnd = date("Y-m-d",strtotime("+3 month",strtotime($dateInit)));
        $data = array();
        $pos = 0;
        $projectsProductionThisMonth = ProjectProduction::where('scheduleDate','>',$dateInit)->where('typeVendor','production')->where('scheduleDate','<',$dateEnd)->get();
        foreach($projectsProductionThisMonth as $projectP){
            $consultantA = Consultant::find($projectP->attorney_id);
            $data[$pos]['DATEPAYMENT']=date("m-d-Y",strtotime($projectP->paidDate));
            $data[$pos]['FILENO']=$projectP->fileno;
            $data[$pos]['INVENTOR']=ucwords($projectP->project->lead->fname." ".$projectP->project->lead->lname);
            $data[$pos]['DATEESTIMATE']=date("m-d-Y",strtotime($projectP->scheduleDate));
            $data[$pos]['DATESHIPING']='';
            $data[$pos]['CONSULTANT']=$projectP->project->consultant->usr=='marcus'?'MF':strtoupper($projectP->project->consultant->fname[0]."".$projectP->project->consultant->lname[0]);
            $data[$pos]['PPATYPE']= $projectP->project->utility;
            $data[$pos]['ATTORNEY']=$consultantA!=null ?substr($consultantA->fname,0,2):"";
            $data[$pos]['SENDDATE']= ($projectP->sendDate == '0000-00-00 00:00:00'?'':date("m-d-Y",strtotime($projectP->sendDate)));
            $data[$pos]['IIGTYPE']= $projectP->project->IigType();
            $pos++;
        }
        return json_encode($data);
    }

    public function productionProgressReportCSV()
    {
        $dateInit = date("Y-m")."-01";
        $dateEnd = date("Y-m-d",strtotime("+3 month",strtotime($dateInit)));
        $pos = 1;
        $projectsProductionThisMonth = ProjectProduction::where('scheduleDate','>',$dateInit)->where('typeVendor','production')->where('scheduleDate','<',$dateEnd)->get();
        $filename = "files/reports/production_".date('m_Y').".csv";
        $rejfile = fopen($filename,"w");
        $row = array("Paid Date","FILE","INVENTOR","Est. Shipping","Shipping Date","REP","PPA Type","Attorney","Sent To Vendors", "IIG Type");
        fputcsv($rejfile,$row);
        foreach($projectsProductionThisMonth as $projectP){
            $consultantA = Consultant::find($projectP->attorney_id);
            $row = array(date("m-d-Y",strtotime($projectP->paidDate)),$projectP->fileno,
                ucwords($projectP->project->lead->fname." ".$projectP->project->lead->lname),date("m-d-Y",strtotime($projectP->scheduleDate)),
                ($projectP->shippingDate == '0000-00-00 00:00:00'?'':date("m-d-Y",strtotime($projectP->shippingDate))),$projectP->project->consultant->usr=='marcus'?'MF':strtoupper($projectP->project->consultant->fname[0]."".$projectP->project->consultant->lname[0]),
            $projectP->project->utility,($consultantA!=null ?substr($consultantA->fname,0,2):""),($projectP->sendDate == '0000-00-00 00:00:00'?'':date("m-d-Y",strtotime($projectP->sendDate))),$projectP->project->IigType());
            fputcsv($rejfile,$row);
            $pos++;
        }
        echo json_encode($filename);
    }
}
