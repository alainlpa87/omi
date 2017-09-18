<?php namespace App\Http\Controllers;

use App\Helpers\SendEmailHelper;
use App\Helpers\ToolsFunctions;
use App\Models\Consultant;
use App\Models\Contract;
use App\Models\Inbox;
use App\Models\Lead;
use App\Models\Project;
use App\Models\ProjectClientServices;
use App\Models\ProjectProduction;
use App\Models\Transaction;
use DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class ProductionController extends Controller {

    /*
     * Current Consultant logged
     */
    public $consultant;
    /*
     * To Allow use the controller methods the current user logged has to be Consultant
     */
    public function __construct()
    {
        $this->middleware('production');
        $this->middleware(function ($request, $next) {
            $this->consultant = Consultant::find(Session::get('user_id'));

            return $next($request);
        });
    }
    /*
     * Send to the index view the vendor's projects
     *
     * @return Response
     */
    public function index(){
        $this->InitValues();
        $total_inbox = Inbox::where(['consultant_id'=>$this->consultant->id,'status'=>0])->count();
        $writers = Consultant::where('rol','LIKE','%writer%')->get();
        $universities = Consultant::where('rol','LIKE','%university%')->get();
        $designers = Consultant::where('rol','LIKE','%designer%')->get();
        $projectsProductionNew = ProjectProduction::where(['completed'=>0,'consultant_id'=>$this->consultant->id])->where('sendDate','0000-00-00 00:00:00')->where('scheduleDate','<>','0000-00-00 00:00:00')->get();//->where('paidDate','<',date("Y-m-d",strtotime("5 days ago"))." 00:00:00")
        $projectsProductionSent = ProjectProduction::where(['completed'=>0,'consultant_id'=>$this->consultant->id])->where('sendDate','<>','0000-00-00 00:00:00')->get();
        $projectsProductionCompleted = ProjectProduction::where(['completed'=>1,'consultant_id'=>$this->consultant->id])->get();
        $projectsProductionReturned = ProjectProduction::where(['completed'=>2,'consultant_id'=>$this->consultant->id])->get();
        $projectsProductionOverdue = ProjectProduction::where(['completed'=>3,'consultant_id'=>$this->consultant->id])->get();

        $pendingPatentAppFiled = 0;
        $pcs = ProjectClientServices::where('patentAppFiled_created_at','<',date('Y-m-d H:i:s', strtotime('-3 months')))->where('patentAppFiled_created_at','<>','0000-00-00 00:00:00')->where('DModel_sent','0000-00-00 00:00:00')->get();
        if(count($pcs)>0)
            $pendingPatentAppFiled =1;

        //temporal
        $attorneyMike = Consultant::where('usr','mike_attorney')->first();
        $attorneyJh = Consultant::where('usr','jh_attorney')->first();

        $attorneyMike = ProjectProduction::where('attorney_id',$attorneyMike->id)->where('typeVendor','production')->where('sendDate','>=',date("Y-m")."-01 00:00:00")->count();
        $attorneyJh = ProjectProduction::where('attorney_id',$attorneyJh->id)->where('typeVendor','production')->where('sendDate','>=',date("Y-m")."-01 00:00:00")->count();
        $totalSend = ProjectProduction::where('typeVendor','production')->where('sendDate','>=',date("Y-m")."-01 00:00:00")->count();

        $attorneys = Consultant::where('rol','LIKE','%attorney%')->where('usr','!=','jk_attorney')->get();
        $attArray = [];
        foreach($attorneys as $att){
            $amount = ProjectProduction::where('attorney_id',$att->id)->where('typeVendor','production')->where('sendDate','>=',date("Y-m")."-01 00:00:00")->count();
            $attArray [] = $att->usr."-".$amount;
        }

        //fin de temporal

        return view('intranet.production.index',array('consultant'=>$this->consultant,'total_inbox'=>$total_inbox,
            'projectsProductionNew'=>$projectsProductionNew,'projectsProductionSent'=>$projectsProductionSent,'projectsProductionCompleted'=>$projectsProductionCompleted,
            'projectsProductionReturned'=>$projectsProductionReturned,'projectsProductionOverdue'=>$projectsProductionOverdue,
            'attorneys'=>$attorneys,'writers'=>$writers,'universities'=>$universities,'designers'=>$designers
        ,'attArray'=>$attArray,'attorney1Available'=>$attorneyMike,'attorney2Available'=>$attorneyJh,'totalSend'=>$totalSend,'pendingPatentAppF'=>$pendingPatentAppFiled));
    }

    /*
     * assign the vendors to every project(this method is called from the index method)
     */
    public function InitValues()
    {

        $writer = Consultant::where('rol','LIKE','%writer%')->first();
        $university = Consultant::where('rol','LIKE','%university%')->first();
        $designer = Consultant::where('rol','LIKE','%designer%')->first();
        $designer2d = Consultant::where('rol','LIKE','%2D%')->first();

        $attorneys = Consultant::where('rol','LIKE','%attorney%')->where('usr','!=','jk_attorney')->where('usr','!=','mike_attorney')->get();
        $attArray = [];
        $attArrayId = [];
        foreach($attorneys as $att){
            $amount = ProjectProduction::where('attorney_id',$att->id)->where('typeVendor','production')->where('sendDate','>=',date("Y-m")."-01 00:00:00")->count();
            $attArray [] = $amount;
            $attArrayId [] = $att->id;
        }

        $projectsProductionIIG = ProjectProduction::where(['contractType'=>'IIG','attorney_id'=>0,'university_id'=>0,'writer_id'=>0,'designer_id'=>0,'completed'=>0,'consultant_id'=>$this->consultant->id,'typeVendor'=>'production'])->where('sendDate','0000-00-00 00:00:00')->get();
        foreach($projectsProductionIIG as $project)
        {

            $contract = Contract::where(array('project_id'=>$project->project_id,'type'=>'IIG'))->first();
            if($contract!=null)
            {
                $dateSold = $contract->paidDate;
                $project->scheduleDate = date("Y-m-d H:i:s", strtotime("+8 Week", strtotime($dateSold)));
                $project->paidDate = $contract->paidDate;
            }
            $project->designer_id = $designer->id;
            $project->writer_id = $writer->id;
            $project->university_id = $university->id;
            if($contract != null && $contract->paid >= 1379){
//cambiar price from 979 to 1179
                $project->designer2d_id = $designer2d->id;
            }

            //para saber a cual de los att se le da el project
            $attPick = count($attArray) - 1;
            for($i=count($attArray) - 1; $i >=0; $i--){
                if($attArray[$attPick] > $attArray[$i]){
                    $attPick = $i;
                }
            }
            $project->attorney_id = $attArrayId[$attPick];
            $attArray[$attPick] = $attArray[$attPick] + 1;

            $project->save();
        }
        $projectsProductionIMG = ProjectProduction::where(['contractType'=>'IMG','university_id'=>0,'writer_id'=>0,'designer_id'=>0,'completed'=>0,'consultant_id'=>$this->consultant->id,'typeVendor'=>'production'])->where('sendDate','0000-00-00 00:00:00')->get();
        foreach($projectsProductionIMG as $project)
        {
            $contract = Contract::where(array('project_id'=>$project->project_id,'type'=>'IMG'))->first();
            if($contract!=null)
            {
                $dateSold = $contract->paidDate;
                $project->scheduleDate = date("Y-m-d H:i:s", strtotime("+6 Week", strtotime($dateSold)));
                $project->paidDate = $contract->paidDate;
            }
            $project->designer_id = $designer->id;
            $project->writer_id = $writer->id;
            $project->university_id = $university->id;
            $project->save();
        }
        $projectsProductionUPGRADE = ProjectProduction::where(['contractType'=>'IGUP','attorney_id'=>0,'completed'=>0,'consultant_id'=>$this->consultant->id,'typeVendor'=>'production'])->where('sendDateIMG','0000-00-00 00:00:00')->get();
        foreach($projectsProductionUPGRADE as $project)
        {

            $contract = Contract::where(array('project_id'=>$project->project_id,'type'=>'IMG'))->first();
            $contractU = Contract::where(array('project_id'=>$project->project_id,'type'=>'IGUP'))->first();
            if($contract!=null && $contractU != null)
            {
                $dateSoldIMG = $contract->paidDate;
                $dateSoldIGUP = $contractU->paidDate;
                $weeks = (strtotime($dateSoldIGUP) - strtotime($dateSoldIMG))/(60*60*24*7);
                if($weeks<=2)
                    $project->scheduleDate = date("Y-m-d H:i:s", strtotime("+8 Week", strtotime($dateSoldIMG)));
                else
                    $project->scheduleDate = date("Y-m-d H:i:s", strtotime("+".(6+round($weeks))." Week", strtotime($dateSoldIMG)));
                $project->paidDate = $contract->paidDate;
            }
            //for IGP that has been save as IGUP
            if($contractU != null && $contractU->price = 695 && $contractU->paid = 695)
            {
                $project->scheduleDate = date("Y-m-d H:i:s", strtotime("+4 Week", strtotime($contractU->paidDate)));
                $project->paidDate = $contractU->paidDate;
            }
            $project->sendDateIMG = $project->sendDate;
            $project->sendDate = "0000-00-00 00:00:00";
            $project->completed = 0;

            //para saber a cual de los att se le da el project
            $attPick = count($attArray) - 1;
            for($i=count($attArray) - 1; $i >=0; $i--){
                if($attArray[$attPick] > $attArray[$i]){
                    $attPick = $i;
                }
            }
            $project->attorney_id = $attArrayId[$attPick];
            $attArray[$attPick] = $attArray[$attPick] + 1;

            $project->designer_id = $project->designer_id>0?$project->designer_id:$designer->id;
            $project->writer_id = $project->writer_id>0 ?$project->writer_id: $writer->id;
            $project->university_id = $project->university_id>0? $project->university_id:$university->id;
            if($contractU != null && $contractU->paid >= 930){
//cambiar price from 530 to 730
                $project->designer2d_id = $project->designer2d_id>0? $project->designer2d_id:$designer2d->id;
            }
            $project->save();

        }
    }

    /*
     * Search projects By Params
     */
    public function findProjectProduction(){
        $leads = Lead::findLead(Input::get('PARAMS'));
        $projects=array();
        if($leads!="-1")
            foreach($leads as $lead_id)
            {
                $listOfProjects = Project::where(['lead_id'=>$lead_id,'vendor'=>1])->get();
                foreach($listOfProjects as $projectFromLead){
                        $projects[] = $projectFromLead;
                }
            }
        $projectsToLoad=array();
        foreach($projects as $project){
            $projectsToLoad[]=$this->paintProject($project->id);
        }
        echo json_encode($projectsToLoad);
    }

    /*
     * Create a portlet from a Project
     */
    public function paintProject($projectId){
        $view = ToolsFunctions::curl(url("paintProjectProduction?PROJECT=$projectId&USER=".$this->consultant->usr));
        return $view;
    }

    /*
     *print business profile for a project in vendor view
     */
    public function printBusinessProduction()
    {
        $id = Input::get('ID');
        $project = Project::find($id);
        if($project!=null)
        {
            return view('intranet.production.printBusiness',array('project'=>$project,'user'=>$this->consultant->usr));
        }
    }

    /*
     *when a file is refund notify al the vendor by email and delete project_production row
     */
    public function refundFilesProduction(){
        $id = Input::get('ID');

        $projects =  ProjectProduction::where(array('project_id'=>$id))->get();
        foreach($projects as $project){
            if($project->typeVendor == 'production'){
                $subj = "Stop Work";
                $msg="Good afternoon,<br>Please stop all work on #$project->fileno<br>Thanks,<br>Production Department<br><br>Please remove this file from the bill.";
                if($project->attorney() != null){
                    SendEmailHelper::send([], '', $project->attorney()->email, 'production@ownmyinvention.com', $subj, 'production@ownmyinvention.com', $subj, $msg,$subj);
                }
                if($project->writer() != null){
                    SendEmailHelper::send([], '', $project->writer()->email, 'production@ownmyinvention.com', $subj, 'production@ownmyinvention.com', $subj, $msg,$subj);
                }
                if($project->designer() != null){
                    SendEmailHelper::send([], '', $project->designer()->email, 'production@ownmyinvention.com', $subj, 'production@ownmyinvention.com', $subj, $msg,$subj);
                }
                if($project->university() != null){
                    SendEmailHelper::send([], '', $project->university()->email, 'production@ownmyinvention.com', $subj, 'production@ownmyinvention.com', $subj, $msg,$subj);
                }
            }
            $project->delete();
        }
        Transaction::createTransaction($this->consultant->id, '', '',"REFUND-PROJECT-PRODUCTION", 'Project Id: '.$id, $id, '', '', '', '', '');
        return "1";
    }

    /*
     *save shippind date and utility from production view
     */
    public function saveShippingDate()
    {
        $id = Input::get('ID');
        $shippingDate = Input::get('SHIPPINGDATE');
        $utility = Input::get('UTILITY');
        $projectP = ProjectProduction::where(array('project_id'=>$id,'typeVendor'=>'production'))->first();
        if($projectP!=null)
        {
            $projectP->shippingDate = $shippingDate;
            $projectP->save();
            $project = Project::find($id);
            $project->utility = $utility;
            $project->save();

            $msgInbox = "Production Update shipping date for Files #:".$projectP->fileno."\r\n";
            $msgInbox .= "Shipping date: ".$shippingDate."\r\n";
            $msgInbox .= "Contract Type: ".$utility;
            Inbox::createInbox($project->lead->id, $project->consultant_id, $msgInbox, 'PRODUCTION', 'PRODUCTION');

            //Create Transaction
            Transaction::createTransaction($this->consultant->id, '', '',"SET-SHIPPING-DATE-PROJECT-PRODUCTION", $shippingDate, $projectP->project_id, '', '', '', '', '');
            return "1";
        }
        return "-1";
    }

    /*
     *change the attorney from production view before send the project out to vendors
     */
    public function saveAttorney()
    {
        $id = Input::get('ID');
        $attorney = Input::get('ATTORNEY');
        $scheduleDate = Input::get('SCHEDULEDATE');
        $letter = Input::get('LETTER');
        $projectP = ProjectProduction::where(array('project_id'=>$id,'typeVendor'=>'production'))->first();
        if($projectP!=null)
        {
            $projectP->attorney_id = $attorney;
            $projectP->scheduleDate = $scheduleDate;
            if($letter != $projectP->letterofengagement){
                $projectP->letterofengagement = $letter;
                $projectP->sent_letterofeng = date("Y-m-d H:i:s");
            }
            $projectP->save();
            //Create Transaction
            Transaction::createTransaction($this->consultant->id, '', '',"CHANGE-ATTORNEY-PROJECT-PRODUCTION", $attorney, $projectP->project_id, '', '', '', '', '');
            return "1";
        }
        return "-1";
    }

    /*
     *return a project from production view to a vendors for a reason.
     */
    public function returnProject()
    {
        $id = Input::get('ID');
        $reason = Input::get('REASON');
        $type = Input::get('TYPE');
        $projectP =  ProjectProduction::where(array('project_id'=>$id,'typeVendor'=>'production'))->first();
        if($projectP!=null)
        {
            $projectT = ProjectProduction::where('project_id',$id)->where('typeVendor','LIKE',"$type%")->first();
            $projectP->completed = 2;
            $projectT->completed = 2;
            $projectT->returnedReason = $reason;
            $projectP->save();
            $projectT->save();
            //Create Transaction
            Transaction::createTransaction($this->consultant->id, '', '',"RETURN-PROJECT-PRODUCTION", $reason, $id, '', $type, '', '', '');
            //inbox
            $msgInbox = "FILE RETURNED\r\n";
            $msgInbox .= date("m-d-Y H:i:s")."\r\n";
            $msgInbox .= "Files #:".$projectP->fileno."\r\n";
            Inbox::createInbox($projectP->consultant_id, $projectT->consultant_id, $msgInbox, 'PRODUCTION', 'PRODUCTION');
            $url = url("returnFileToVendor?FILE=".$projectP->fileno."&ID=".$projectT->consultant_id."&REASON=".urlencode($reason));
            ToolsFunctions::curl($url);
            return "1";
        }
        return "-1";
    }

    /*
     *complete project from production view to moved to completed.
     */
    public function completeProjectProduction()
    {
        $id = Input::get('ID');
        $projects =  ProjectProduction::where(array('project_id'=>$id))->get();
        $now = new \DateTime('now');
        foreach($projects as $project)
        {
            $project->completed =1;
            $project->completedDate =  $now->format("Y-m-d H:i:s");
            $project->save();
        }
        return "1";
    }

    //save user and file for inbox and email
    function saveUserFileForInboxEmail($users,$files,$consultant,$fileno){
        $return = [];
        if (in_array($consultant, $users)) {
            $files [array_search($consultant, $users)] .= ', '.$fileno;
        }else{
            $users[] = $consultant;
            $files[array_search($consultant, $users)] = $fileno;
        }
        $return[0] = $users;
        $return[1] = $files;
        return $return;
    }

    /*
     *crate a row per vendor for every file that has to be send out and send and email with those file to the vendors.
     */

    public function sentToVendors()
    {
        $ids = explode(',',Input::get('IDS'));
        $users = [];
        $files = [];
        foreach($ids as $id)
        {
            $projectP = ProjectProduction::find($id);
            $now = date("Y-m-d H:i:s");
            if($projectP->sendDate == "0000-00-00 00:00:00")
            {

                // Project Production Attorney
                if($projectP->attorney_id>0)
                {
                    /*****CHECK LETTER OF ENGAGEMENT******/

                    //if letter of engagement is not signed move to the next project
                    if($projectP->letterofengagement != 2)
                        continue;
                    //obtain how many days has been signed
                    $date = date("Y-m-d",strtotime($projectP->sent_letterofeng));
                    $diff=date_diff(date_create(date("Y-m-d")),date_create($date))->format('%a');
                    //if has been signed for less than 7 days  move to the next project
                    if($diff < 7)
                        continue;

                    /*****END OF CHECK LETTER OF ENGAGEMENT******/

                    $consultantA = Consultant::find($projectP->attorney_id);
                    $rolA = explode(',',$consultantA->rol);

                    $projectPA = ProjectProduction::where(array('project_id'=>$projectP->project_id,'typeVendor'=>$rolA[2]))->first();
                    if($projectPA==null)
                    {
                        $projectPA = new ProjectProduction();
                        $projectPA->project_id = $projectP->project_id;
                        $projectPA->fileno = $projectP->fileno;
                        $projectPA->typeVendor = $rolA[2];
                        $projectPA->consultant_id = $projectP->attorney_id;
                        $projectPA->contractType = $projectP->contractType;
                        $projectPA->designer_id = $projectP->designer_id;
                        $projectPA->designer2d_id = $projectP->designer2d_id;
                        $projectPA->writer_id = $projectP->writer_id;
                        $projectPA->university_id = $projectP->university_id;
                        $projectPA->attorney_id = $projectP->attorney_id;
                        $projectPA->sendDate = $projectP->sendDate;
                        $projectPA->save();

                        //save user and file for inbox and email
                        $result = $this->saveUserFileForInboxEmail($users,$files,$projectP->attorney_id,$projectP->fileno);
                        $users = $result[0];
                        $files = $result[1];
                    }
                }

                // Project Production University
                $projectPU = ProjectProduction::where(array('project_id'=>$projectP->project_id,'typeVendor'=>'university'))->first();
                if($projectPU==null)
                {
                    $projectPU = new ProjectProduction();
                    $projectPU->project_id = $projectP->project_id;
                    $projectPU->fileno = $projectP->fileno;
                    $projectPU->typeVendor = 'university';
                    $projectPU->consultant_id = $projectP->university_id;
                    $projectPU->contractType = $projectP->contractType;
                    $projectPU->designer_id = $projectP->designer_id;
                    $projectPU->designer2d_id = $projectP->designer2d_id;
                    $projectPU->writer_id = $projectP->writer_id;
                    $projectPU->university_id = $projectP->university_id;
                    $projectPU->attorney_id = $projectP->attorney_id;
                    $projectPU->sendDate = $projectP->sendDate;
                    $projectPU->save();

                    //save user and file for inbox and email
                    $result = $this->saveUserFileForInboxEmail($users,$files,$projectP->university_id,$projectP->fileno);
                    $users = $result[0];
                    $files = $result[1];
                }

                // Project Production Designer
                $projectPD = ProjectProduction::where(array('project_id'=>$projectP->project_id,'typeVendor'=>'designer'))->first();
                if($projectPD==null)
                {
                    $projectPD = new ProjectProduction();
                    $projectPD->project_id = $projectP->project_id;
                    $projectPD->fileno = $projectP->fileno;
                    $projectPD->typeVendor = 'designer';
                    $projectPD->consultant_id = $projectP->designer_id;
                    $projectPD->contractType = $projectP->contractType;
                    $projectPD->designer_id = $projectP->designer_id;
                    $projectPD->designer2d_id = $projectP->designer2d_id;
                    $projectPD->writer_id = $projectP->writer_id;
                    $projectPD->university_id = $projectP->university_id;
                    $projectPD->attorney_id = $projectP->attorney_id;
                    $projectPD->sendDate = $projectP->sendDate;
                    $projectPD->save();

                    //save user and file for inbox and email
                    $result = $this->saveUserFileForInboxEmail($users,$files,$projectP->designer_id,$projectP->fileno);
                    $users = $result[0];
                    $files = $result[1];
                }

                // Project Production Designer2D
                if($projectP->designer2d_id>0){
                    $projectPD2 = ProjectProduction::where(array('project_id'=>$projectP->project_id,'typeVendor'=>'2D'))->first();
                    if($projectPD2==null)
                    {
                        $projectPD2 = new ProjectProduction();
                        $projectPD2->project_id = $projectP->project_id;
                        $projectPD2->fileno = $projectP->fileno;
                        $projectPD2->typeVendor = '2D';
                        $projectPD2->consultant_id = $projectP->designer2d_id;
                        $projectPD2->contractType = $projectP->contractType;
                        $projectPD2->designer_id = $projectP->designer_id;
                        $projectPD2->designer2d_id = $projectP->designer2d_id;
                        $projectPD2->writer_id = $projectP->writer_id;
                        $projectPD2->university_id = $projectP->university_id;
                        $projectPD2->attorney_id = $projectP->attorney_id;
                        $projectPD2->sendDate = $projectP->sendDate;
                        $projectPD2->save();

                        //save user and file for inbox and email
                        $result = $this->saveUserFileForInboxEmail($users,$files,$projectP->designer2d_id,$projectP->fileno);
                        $users = $result[0];
                        $files = $result[1];
                    }
                }

                // Project Production Writer
                $projectPW = ProjectProduction::where(array('project_id'=>$projectP->project_id,'typeVendor'=>'writer'))->first();
                if($projectPW==null)
                {
                    $projectPW = new ProjectProduction();
                    $projectPW->project_id = $projectP->project_id;
                    $projectPW->fileno = $projectP->fileno;
                    $projectPW->typeVendor = 'writer';
                    $projectPW->consultant_id = $projectP->writer_id;
                    $projectPW->contractType = $projectP->contractType;
                    $projectPW->designer_id = $projectP->designer_id;
                    $projectPW->designer2d_id = $projectP->designer2d_id;
                    $projectPW->writer_id = $projectP->writer_id;
                    $projectPW->university_id = $projectP->university_id;
                    $projectPW->attorney_id = $projectP->attorney_id;
                    $projectPW->sendDate = $projectP->sendDate;
                    // kitar cuando tengamos writer again
                    $projectPW->completed = 1;
                    $projectPW->save();
                    //-------------------------------

                    //save user and file for inbox and email
                    $result = $this->saveUserFileForInboxEmail($users,$files,$projectP->writer_id,$projectP->fileno);
                    $users = $result[0];
                    $files = $result[1];
                }
                elseif($projectP->contractType == 'IGUP'){
                    $contractU = Contract::where(array('project_id'=>$projectP->project_id,'type'=>'IGUP'))->first();
                    if($contractU != null && $contractU->paid >= 930){
//cambiar price 530 to 730
                        // cambiar por cero cuando tengamos writer again
                        $projectPW->completed = 1;
                        $projectPW->save();

                        //save user and file for inbox and email
                        $result = $this->saveUserFileForInboxEmail($users,$files,$projectP->writer_id,$projectP->fileno);
                        $users = $result[0];
                        $files = $result[1];
                    }
                }
                $projectP->sendDate = $now;
                $projectP->save();
            }
        }

        //inbox
        $msgInbox = "NEW FILES AVAILABLE.\r\n";
        $msgInbox .= date("m-d-Y H:i:s")."\r\n";

        //mail
        $subj = "New files ready";
        $msg="We have new files ready for you.<br>These are the files:<br><br>";
        for ($i = 0; $i <count($users); $i++) {
            $consultant = Consultant::find($users[$i]);
            $filesToSend = $files[$i];
            if($consultant != null){
                Inbox::createInbox($projectP->consultant_id, $consultant->id, $msgInbox."Files #:".$filesToSend."\r\n", 'PRODUCTION', 'PRODUCTION');
                SendEmailHelper::send([], '', $consultant->email, 'production@ownmyinvention.com', $subj, 'production@ownmyinvention.com', $subj, $msg.$filesToSend,$subj);
                if($consultant->usr=="jh_attorney"){
                    SendEmailHelper::send([], '', 'nmartinez@ip-pages.com', 'production@ownmyinvention.com', $subj, 'production@ownmyinvention.com', $subj, $msg.$filesToSend,$subj);
                }
            }
        }

        //Create Transaction
        Transaction::createTransaction($this->consultant->id, '', '',"SEND-PROJECT-PRODUCTION", '', '', '', '', '', '', '');
        return 1;
    }

    public function sendLetterOfEngagement()
    {
        //reminder of letter of engagement
        $projectProd = ProjectProduction::where('typeVendor','=','production')->where('attorney_id','!=','0')->where('sendDate','=','0000-00-00 00:00:00')->where('letterofengagement','=','1')->get();
        foreach($projectProd as $proj){
            $project = $proj->project;
            $date = date("Y-m-d",strtotime($proj->sent_letterofeng));
            $diff=date_diff(date_create(date("Y-m-d")),date_create($date))->format('%a');

            //rest days if today is monday or tuesday
            if(date('w',strtotime("now")) == 1 || (date('w',strtotime("now")) == 2 && $diff > 1) || (date('w',strtotime("now")) == 3 && $diff > 2))
                $diff = $diff-2;

            //create inbox for consultant
            $msgInbox = "Letter Of Engagement SENT on ".$date."\r\n";
            $msgInbox .= "and has not been received yet.\r\n";
            $msgInbox .= "File #:" . $project->lead->fileno . "\r\n";
            $msgInbox .= "Pin: " . $project->id . "\r\n";
            $msgInbox .= "Client: " . $project->lead->fname . " " . $project->lead->lname . "\r\n";
            $msgInbox .= date("m-d-Y H:i:s") . "\r\n";

            switch ($diff){
                case 1:
                    Inbox::createInbox($project->lead->id, $project->consultant_id, $msgInbox, "PRODUCTION", "PRODUCTION");
                    break;
                case 2:
                    Inbox::createInbox($project->lead->id, $project->consultant_id, $msgInbox, "PRODUCTION", "PRODUCTION");
                    break;
                case 3:
                    Inbox::createInbox($project->lead->id, $project->consultant_id, $msgInbox, "PRODUCTION", "PRODUCTION");
                    //email to george and asia
                    $subject = 'LETTER OF ENGAGEMENT NOT RECEIVED';
                    SendEmailHelper::send(array(), '', 'george@ownmyinvention.com', 'info@ownmyinvention.com', $subject, 'info@ownmyinvention.com', $subject, $msgInbox, $subject);
                    SendEmailHelper::send(array(), '', 'operations@ownmyinvention.com', 'info@ownmyinvention.com', $subject, 'info@ownmyinvention.com', $subject, $msgInbox, $subject);
                    break;
            }
        }

        //send the letter of engagement
        $projectP = ProjectProduction::where('typeVendor','=','production')->where('attorney_id','!=','0')->where('sendDate','=','0000-00-00 00:00:00')->where('letterofengagement','=','0')->get();
        foreach($projectP as $proy){
            $project = $proy->project;
            if($project != null){
                $date = strtotime("+7 day", strtotime($project->lastContractPaidDate()));
                if(date("Y-m-d") >= date("Y-m-d",$date) || $proy->contractType == 'IGUP') {
                    ToolsFunctions::curl(url("emailLetterOfEngagement?ID=".$project->id));
                    $proy->letterofengagement = 1;
                    $proy->sent_letterofeng = date("Y-m-d H:i:s");
                    $proy->save();
                }
            }
        }
        return 1;
    }
}
