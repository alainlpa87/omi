<?php namespace App\Http\Controllers;

use App\Helpers\ToolsFunctions;
use App\Models\Assignment;
use App\Models\ClientSNotes;
use App\Models\Consultant;
use App\Models\Inbox;
use App\Models\Lead;
use App\Models\Project;
use App\Models\AttClientServices;
use App\Models\ProjectClientServices;
use App\Models\ProjectProduction;
use App\Models\Request;
use App\Models\Submission;
use App\Models\Transaction;
use App\Models\UploadedFiles;
use DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class AttorneyClientServicesController extends Controller {

    /*
     * Current Consultant logged
     */
    public $consultant;
    /*
     * To Allow use the controller methods the current user logged has to be Consultant
     */
    public function __construct()
    {
        $this->middleware('vendors');
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
        //miss the state 1 wich is when is finished that's cause dnt appears here
        $total_inbox = Inbox::where(['consultant_id'=>$this->consultant->id,'status'=>0])->count();
        $newCRAndTM = AttClientServices::where(['consultant_id'=>$this->consultant->id,'completed'=>0,'beforeDue'=>"NEW"])->whereIn('type', ['TM','CR'])->get();
        if(count($newCRAndTM)>0){
            $projectsNew = "";
            $projectsReturned = "";
            $projectsLate = "";
            $projectsAppAprvd = "";
            $projectsCRAndTM = "";
        }else{
            $newCRAndTM = "";
            $projectsNew = AttClientServices::where(['consultant_id'=>$this->consultant->id,'completed'=>0])->where('type', '!=','TM')->where('type', '!=','CR')->get();
            $projectsReturned = AttClientServices::where(['consultant_id'=>$this->consultant->id,'completed'=>2])->where('type', '!=','TM')->where('type', '!=','CR')->get();
            $projectsLate = AttClientServices::where(['consultant_id'=>$this->consultant->id,'completed'=>3])->where('type', '!=','TM')->where('type', '!=','CR')->get();
            $projectsAppAprvd = AttClientServices::where(['consultant_id'=>$this->consultant->id,'completed'=>4])->where('type', '!=','TM')->where('type', '!=','CR')->get();
            $projectsCRAndTM = AttClientServices::where(['consultant_id'=>$this->consultant->id,'completed'=>0])->whereIn('type', ['TM','CR'])->get();
        }
        return view('intranet.attorneyClientServices.index',array('consultant'=>$this->consultant,'total_inbox'=>$total_inbox,'projectsReturned'=>$projectsReturned,'projectsLate'=>$projectsLate,'projectsNew'=>$projectsNew,'projectAppAprvd'=>$projectsAppAprvd,'tmAndCr'=> $projectsCRAndTM,'newCRAndTM'=>$newCRAndTM));
    }

    /*approve Or Reject TM and CR*/
    public function approveOrRejectTMandCR(){
        $attRow = AttClientServices::find(Input::get('ID'));
        if(Input::get('PARAMS') == 'APPROVE'){
            $attRow->beforeDue = '';
            $attRow->save();
            $csNote = new ClientSNotes();
            $csNote->projectclientservices_id = $attRow->projectclientservices_id;
            $csNote->notes = "Attorney Approve the ".$attRow->type." coversheet.";
            $csNote->save();
        }else{
            $clientS = Consultant::where('usr','clientservices')->first();
            $msgInbox = "Attorney rejected ".$attRow->type. "<br>" ."Fileno: ".$attRow->projectclientservices->fileno. "<br>" ."Reason: ".Input::get('REASON');
            Inbox::createInbox($attRow->lead_id,$clientS->id,$msgInbox,"CLIENT SERVICES","CLIENT");
            $attRow->delete();
        }
    }

    /*
     * Search projects By Params
     */
    public function findProjectAttCS(){
        $leads = Lead::findLead(Input::get('PARAMS'));
        $projectsACS=array();
        if($leads!="-1")
            foreach($leads as $lead_id)
            {
                $lead_aux = Lead::find($lead_id);
                $projects =  $lead_aux->projects;
                foreach($projects as $p){
                    $pcs = $p->clientServicesProject();
                    if($pcs != null){
                        $attCS = AttClientServices::where('projectclientservices_id',$pcs->id)->get();
                        foreach($attCS as $attcs)
                            $projectsACS[]=$attcs;
                    }
                }
            }
        $projectsToLoad=array();
        foreach($projectsACS as $project){
            $pid = $project->projectclientservices->project_id;
            $projectsToLoad[]=$this->paintProject($pid,$project->id);
        }
        echo json_encode($projectsToLoad);
    }

    /*
     * Create a portlet from a Project
     */
    public function paintProject($projectId,$atcsId){
        $view = ToolsFunctions::curl(url("paintProjectAttCS?PROJECT=$projectId&ATTCSID=$atcsId&USER=".$this->consultant->id));
        return $view;
    }

    /*
     *print business profile for a project in vendor view
     */
    public function printBusinessAttCS()
    {
        $id = Input::get('ID');
        $project = Project::find($id);
        if($project!=null)
        {
            return view('intranet.attorneyClientServices.printBusiness',array('project'=>$project,'user'=>$this->consultant->usr));
        }
    }

    /*
     * the attorney finsih, client services get a msg in inbox
     * */
    public function finishAttCS(){
        $attCS_id = Input::get('ID');
        $attCS = AttClientServices::find($attCS_id);
        $command = Input::get('COMMAND');
        $files = Input::get('FILES');


        if($attCS != null){
            $pCS = $attCS->projectclientservices;
            $proj_id = $pCS->project_id;
            $proj =Project::find($proj_id);

            if($command == "NORMAL" || $command == "APP"){
                $notePCS = new ClientSNotes();
                $notePCS->projectclientservices_id = $pCS->id;
                if($attCS->completed == 2)
                    $notePCS->notes = "Revision uploaded by attorney";
                else
                    $notePCS->notes = "New application uploaded by attorney";
                $notePCS->save();

                $pCS->completed = 1;
                $pCS->returnedReason="";
                $pCS->save();

                $attCS->completed=1;
                $attCS->stateChangedDate = date('Y-m-d 00:00:00');
                $attCS->returnedReason="";
                $attCS->save();
            }

            if($command == "CR" || $command == "TM"){
                $notePCS = new ClientSNotes();
                $notePCS->projectclientservices_id = $pCS->id;
                $notePCS->notes = $command." uploaded by attorney";
                $notePCS->save();

                $attCS->completed=1;
                $attCS->stateChangedDate = date('Y-m-d 00:00:00');
                $attCS->returnedReason="";
                $attCS->save();
            }

            $clientS = Consultant::where('usr','clientservices')->first();
            if($command == 'NORMAL'){
                $msgInbox = "NEW APLICATION UPLOADED BY ATTORNEY <br>".date("m-d-Y H:i:s")."<br>Client: ".$proj->lead->fname." ".$proj->lead->lname."<br>"
                    ."File #: ".$proj->lead->fileno."<br>Pin: ".$proj_id;
                $auxAction ='PATENT_APP_FINISH';
            }elseif($command == 'APP'){
                $msgInbox = "NEW FILING RECEIPT UPLOADED BY ATTORNEY <br>".date("m-d-Y H:i:s")."<br>Client: ".$proj->lead->fname." ".$proj->lead->lname."<br>"
                    ."File #: ".$proj->lead->fileno."<br>Pin: ".$proj_id;
                $auxAction ='FILING_RECEIPT_UPLOADED';
            }elseif($command == 'SEARCH' || $command == 'OTHER'){
                $msgInbox = "NEW FILES UPLOADED BY ATTORNEY <br>".date("m-d-Y H:i:s")."<br>Client: ".$proj->lead->fname." ".$proj->lead->lname."<br>"
                    ."File #: ".$proj->lead->fileno."<br>Pin: ".$proj_id;
                $auxAction ='FILES_UPLOADED';
            }elseif($command == "CR" || $command == "TM"){
                $msgInbox = "NEW ".$command." UPLOADED BY ATTORNEY <br>".date("m-d-Y H:i:s")."<br>Client: ".$proj->lead->fname." ".$proj->lead->lname."<br>"
                    ."File #: ".$proj->lead->fileno."<br>Pin: ".$proj_id;
                $auxAction =$command.'_UPLOADED';
            }

            foreach($files as $file){
                $msgInbox.="<br>File Name: ".$file;
            }

            Inbox::createInbox($attCS->lead_id,$clientS->id,$msgInbox,"CLIENT SERVICES","ATTORNEY");

            Transaction::createTransaction($pCS->attorney_id,'','',$auxAction.'_BY_ATT','',$proj->id,'','','','','');
            if($command == "NORMAL" || $command == "APP" || $command == "CR" || $command == "TM")
                return json_encode($attCS_id);
            return 0;
        }
        return "-1";
    }

    public function reportAttVendors(){
        $att_id = Input::get('ATT');
        $first_day_of_month = date('Y-m-01 00:00:00');
        $last_day_of_month = date('Y-m-t 23:59:00');
        $attCS = AttClientServices::where('consultant_id',$att_id)->where('created_at','>=',$first_day_of_month)->where('created_at','<=',$last_day_of_month)->get();
        $att = Consultant::find($att_id);
        $att_name = $att->fname." ".$att->lname;
        $total_inbox = Inbox::where(['consultant_id'=>$this->consultant->id,'status'=>0])->count();
        $rcvdDates = array(); //
        foreach($attCS as $attcs) {
            if($attcs->type = "DESIGN")
                if($attcs->projectclientservices->appSentD_created_at !== '0000-00-00 00:00:00')
                    $rcvdDates[$attcs->id] = date('m-d-Y', strtotime($attcs->projectclientservices->appSentD_created_at));
                else
                    $rcvdDates[$attcs->id] = "";
            else
                if($attcs->projectclientservices->appSent_created_at !== '')
                    $rcvdDates[$attcs->id] = $attcs->projectclientservices->appSent_created_at;
                else
                    $rcvdDates[$attcs->id] = "";
        }

        $data = array();
        $pos = 0;
        //trademark
        $projectCSs = ProjectClientServices::where('trademarkAtt',$att_id)->where('trademark_sent_to_attorney','>=',$first_day_of_month)->where('trademark_sent_to_attorney','<=',$last_day_of_month)->get();
        foreach($projectCSs as $projectCS){
            $data[$pos]['FILENO']=$projectCS->fileno;
            $data[$pos]['TYPE']='TM';
            $data[$pos]['SENDDATE']= date("m-d-Y",strtotime($projectCS->trademark_sent_to_attorney));
            $data[$pos]['RECEIVEDDATE']= $projectCS->trademarkFil_created_at;
            $pos++;
        }
        //copyright
        $projectCSs = ProjectClientServices::where('copyrightAtt',$att_id)->where('copyright_sent_to_attorney','>=',$first_day_of_month)->where('copyright_sent_to_attorney','<=',$last_day_of_month)->get();
        foreach($projectCSs as $projectCS){
            $data[$pos]['FILENO']=$projectCS->fileno;
            $data[$pos]['TYPE']='CR';
            $data[$pos]['SENDDATE']= date("m-d-Y",strtotime($projectCS->copyright_sent_to_attorney));
            $data[$pos]['RECEIVEDDATE']= $projectCS->copyrightFiled_created_at;
            $pos++;
        }

        return view("intranet.attorneyClientServices.tools.attorneyDetails",array('data'=>$data,'attDetails'=>$attCS,'consultant'=>$this->consultant,'total_inbox'=>$total_inbox,'att_name'=>$att_name,'rcvdDates'=>$rcvdDates,'att_id'=>$att_id));
    }

    public function reportAttSelectMonthVendors(){
        $att_id = Input::get('ATT');
        $month = Input::get('MONTH');
        $thisMonth = date("Y")."-$month-01 00:00:00";
        if($thisMonth>date("Y-m-d H:i:s"))
            $thisMonth = date("Y-m-d H:i:s", strtotime("-1 year", strtotime($thisMonth)));
        $to=date("Y-m-d H:i:s", strtotime("+1 month", strtotime($thisMonth)));
        $attCS = AttClientServices::where('consultant_id',$att_id)->where('created_at','>=',$thisMonth)->where('created_at','<',$to)->get();
        $data = array();
        foreach($attCS as $att){
            if($att->type == "DESIGN"){
                if($att->projectclientservices->appSentD_created_at!='0000-00-00 00:00:00')
                    $aux = date('m-d-Y', strtotime($att->projectclientservices->appSentD_created_at));
                else
                    $aux ="N/A";
            }
            else {
                if($att->projectclientservices->appSent_created_at!='')
                    $aux =$att->projectclientservices->appSent_created_at;
                else
                    $aux ="N/A";
            }

            $info = array($att->lead->fileno, $att->type,date("m-d-Y",strtotime($att->created_at)),$aux);
            $data[]=$info;
        }

        //trademark
        $projectCSs = ProjectClientServices::where('trademarkAtt',$att_id)->where('trademark_sent_to_attorney','>=',$thisMonth)->where('trademark_sent_to_attorney','<=',$to)->get();
        foreach($projectCSs as $projectCS){
            $info = array($projectCS->fileno, 'TM',date("m-d-Y",strtotime($projectCS->trademark_sent_to_attorney)),($projectCS->trademarkFil_created_at != ""?$projectCS->trademarkFil_created_at:"N/A"));
            $data[]=$info;
        }
        //copyright
        $projectCSs = ProjectClientServices::where('copyrightAtt',$att_id)->where('copyright_sent_to_attorney','>=',$thisMonth)->where('copyright_sent_to_attorney','<=',$to)->get();
        foreach($projectCSs as $projectCS){
            $info = array($projectCS->fileno, 'CR',date("m-d-Y",strtotime($projectCS->copyright_sent_to_attorney)),($projectCS->copyrightFiled_created_at != ""?$projectCS->copyrightFiled_created_at:"N/A"));
            $data[]=$info;
        }

        return json_encode($data);
    }

}
