<?php namespace App\Http\Controllers;

use App\Models\AttClientServices;
use App\Models\Consultant;
use App\Models\Inbox;
use App\Models\Message;
use App\Models\ProjectClientServices;
use App\Models\ProjectProduction;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use DB;

class AttorneyReportsController extends Controller {


    /*
    * Current Consultant logged
    */
    public $consultant;
    /*
     * To Allow use the controller methods the current user logged has to be Consultant
     */
    public function __construct(){
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
        $consultants = Consultant::where('rol','LIKE','%attorney%')->where('usr','!=','jk_attorney')->get();
        $voiceMessages = Message::where(['type'=>'VM','consultant_id'=>$this->consultant->id])->get();
        $total_inbox = Inbox::where(['consultant_id'=>$this->consultant->id,'status'=>0])->count();
        return view('intranet.report.attReport',array('consultant'=>$this->consultant,'consultants'=>$consultants,'voiceMessages'=>$voiceMessages,
            'total_inbox'=>$total_inbox));
    }

    //Production report of Patent Search per Attorney between two dates.
    public function patentSearchProgressReport(){
        $att_id = Input::get('CONSULTANT');
        $dateStart = date("Y-m-d H:i:s",strtotime(Input::get('STARTDATE')));
        $dateEnd = date("Y-m-d",strtotime(Input::get('ENDDATE')))." 23:59:59";

        $data = array();
        $pos = 0;
        $projectsProductionAtt = ProjectProduction::where('created_at','>=',$dateStart)->where('consultant_id',$att_id)->where('created_at','<=',$dateEnd)->get();
        foreach($projectsProductionAtt as $projectP){
            $data[$pos]['FILENO']=$projectP->fileno;
            $data[$pos]['INVENTOR']=ucwords($projectP->project->lead->fname." ".$projectP->project->lead->lname);
            $data[$pos]['SENDDATE']= date("m-d-Y",strtotime($projectP->created_at));
            $data[$pos]['RECEIVEDDATE']= $projectP->completedDate != '0000-00-00 00:00:00'?date("m-d-Y",strtotime($projectP->completedDate)):'';
            $pos++;
        }
        return json_encode($data);
    }

    public function patentSearchProgressReportCSV() {
        $att_id = Input::get('CONSULTANT');
        $dateStart = date("Y-m-d H:i:s",strtotime(Input::get('STARTDATE')));
        $dateEnd = date("Y-m-d",strtotime(Input::get('ENDDATE')))." 23:59:59";
        $projectsProductionAtt = ProjectProduction::where('created_at','>=',$dateStart)->where('consultant_id',$att_id)->where('created_at','<=',$dateEnd)->get();
        $filename = "files/reports/patentSearchProgressReport_".date('m_Y').".csv";
        $rejfile = fopen($filename,"w");
        $row = array("FILENO","INVENTOR","SENDDATE","RECEIVEDDATE");
        fputcsv($rejfile,$row);
        foreach($projectsProductionAtt as $projectP){
            $row = array(
                $projectP->fileno,
                ucwords($projectP->project->lead->fname." ".$projectP->project->lead->lname),
                date("m-d-Y",strtotime($projectP->created_at)),
                $projectP->completedDate != '0000-00-00 00:00:00'?date("m-d-Y",strtotime($projectP->completedDate)):''
            );
            fputcsv($rejfile,$row);
        }
        echo json_encode($filename);
    }

    //Client Services report of patent App, CR and TM per Attorney between two dates.
    public function cSReport(){
        $att_id = Input::get('CONSULTANT');
        $dateStart = date("Y-m-d H:i:s",strtotime(Input::get('STARTDATE')));
        $dateEnd = date("Y-m-d",strtotime(Input::get('ENDDATE')))." 23:59:59";

        $data = array();
        $pos = 0;
        $attCSs = AttClientServices::where('consultant_id',$att_id)->where('type','!=',"CR")->where('type','!=',"TM")->where('created_at','>=',$dateStart)->where('created_at','<=',$dateEnd)->get();
        foreach($attCSs as $att){
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
            $data[$pos]['FILENO']=$att->lead->fileno;
            $data[$pos]['PIN']=$att->projectclientservices->project->id;
            $data[$pos]['INVENTOR']=ucwords($att->projectclientservices->project->lead->fname." ".$att->projectclientservices->project->lead->lname);
            $data[$pos]['TYPE']=$att->type;
            $data[$pos]['SENDDATE']= date("m-d-Y",strtotime($att->created_at));
            $data[$pos]['RECEIVEDDATE']= $aux;
            $pos++;
        }
        //trademark
        $projectCSs = ProjectClientServices::where('trademarkAtt',$att_id)->where('trademark_sent_to_attorney','>=',$dateStart)->where('trademark_sent_to_attorney','<=',$dateEnd)->get();
        foreach($projectCSs as $projectCS){
            $data[$pos]['FILENO']=$projectCS->fileno;
            $data[$pos]['PIN']=$projectCS->project->id;
            $data[$pos]['INVENTOR']=ucwords($projectCS->project->lead->fname." ".$projectCS->project->lead->lname);
            $data[$pos]['TYPE']='TM';
            $data[$pos]['SENDDATE']= date("m-d-Y",strtotime($projectCS->trademark_sent_to_attorney));
            $data[$pos]['RECEIVEDDATE']= $projectCS->trademarkFil_created_at!=''?$projectCS->trademarkFil_created_at:"N/A";
            $pos++;
        }
        //copyright
        $projectCSs = ProjectClientServices::where('copyrightAtt',$att_id)->where('copyright_sent_to_attorney','>=',$dateStart)->where('copyright_sent_to_attorney','<=',$dateEnd)->get();
        foreach($projectCSs as $projectCS){
            $data[$pos]['FILENO']=$projectCS->fileno;
            $data[$pos]['PIN']=$projectCS->project->id;
            $data[$pos]['INVENTOR']=ucwords($projectCS->project->lead->fname." ".$projectCS->project->lead->lname);
            $data[$pos]['TYPE']='CR';
            $data[$pos]['SENDDATE']= date("m-d-Y",strtotime($projectCS->copyright_sent_to_attorney));
            $data[$pos]['RECEIVEDDATE']= $projectCS->copyrightFiled_created_at!=''?$projectCS->copyrightFiled_created_at:"N/A";
            $pos++;
        }
        return json_encode($data);
    }

    public function cSReportCSV() {
        $att_id = Input::get('CONSULTANT');
        $dateStart = date("Y-m-d H:i:s",strtotime(Input::get('STARTDATE')));
        $dateEnd = date("Y-m-d",strtotime(Input::get('ENDDATE')))." 23:59:59";
        $attCSs = AttClientServices::where('consultant_id',$att_id)->where('type','!=',"CR")->where('type','!=',"TM")->where('created_at','>=',$dateStart)->where('created_at','<=',$dateEnd)->get();
        $filename = "files/reports/patentSearchProgressReport_".date('m_Y').".csv";
        $rejfile = fopen($filename,"w");
        $row = array("FILENO","INVENTOR","TYPE","SENDDATE","RECEIVEDDATE");
        fputcsv($rejfile,$row);
        foreach($attCSs as $att){
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
            $row = array(
                $att->lead->fileno,
                ucwords($att->projectclientservices->project->lead->fname." ".$att->projectclientservices->project->lead->lname),
                $att->type,
                date("m-d-Y",strtotime($att->created_at)),
                $aux
            );
            fputcsv($rejfile,$row);
        }
        $projectCSs = ProjectClientServices::where('trademarkAtt',$att_id)->where('trademark_sent_to_attorney','>=',$dateStart)->where('trademark_sent_to_attorney','<=',$dateEnd)->get();
        foreach($projectCSs as $projectCS){
            $row = array(
                $projectCS->fileno,
                ucwords($projectCS->project->lead->fname." ".$projectCS->project->lead->lname),
                'TM',
                date("m-d-Y",strtotime($projectCS->trademark_sent_to_attorney)),
                $projectCS->trademarkFil_created_at
            );
            fputcsv($rejfile,$row);
        }
        $projectCSs = ProjectClientServices::where('copyrightAtt',$att_id)->where('copyright_sent_to_attorney','>=',$dateStart)->where('copyright_sent_to_attorney','<=',$dateEnd)->get();
        foreach($projectCSs as $projectCS){
            $row = array(
                $projectCS->fileno,
                ucwords($projectCS->project->lead->fname." ".$projectCS->project->lead->lname),
                'CR',
                date("m-d-Y",strtotime($projectCS->copyright_sent_to_attorney)),
                $projectCS->copyrightFiled_created_at
            );
            fputcsv($rejfile,$row);
        }
        echo json_encode($filename);
    }

    //Client Services report of PSA and DDR Sent and received between two dates.
    public function psaDdrReport(){
        $dateStart = Input::get('STARTDATE');
        $dateEnd = Input::get('ENDDATE');

        $data = array();
        $pos = 0;
        $projectCSs = DB::select("SELECT * FROM projectclientservices where str_to_date(ppaSent_created_at, '%m-%d-%Y') >= str_to_date(:dateStart, '%m/%d/%Y') AND str_to_date(ppaSent_created_at, '%m-%d-%Y') <= str_to_date(:dateEnd, '%m/%d/%Y')", ['dateStart' => $dateStart, 'dateEnd' => $dateEnd]);
        foreach($projectCSs as $projectCS){
            $clientS = ProjectClientServices::find($projectCS->id);
            $data[$pos]['FILENO']=$projectCS->fileno;
            $data[$pos]['INVENTOR']=ucwords($clientS->project->lead->fname." ".$clientS->project->lead->lname);
            $data[$pos]['SENDDATE']=$projectCS->ppaSent_created_at;
            if($projectCS->ddrReceived_created_at != ""){
                $data[$pos]['PSARECEIVEDDATE']= $projectCS->ddrReceived_created_at;
                $data[$pos]['DDRRECEIVEDDATE']= $projectCS->ddrReceived_created_at;
            }else{
                $data[$pos]['PSARECEIVEDDATE']= "";
                $data[$pos]['DDRRECEIVEDDATE']= "";
                if(($aux=$clientS->getDocsByName('agreementPSA'))!=null)
                    $data[$pos]['PSARECEIVEDDATE']= $aux->signdate;
                if(($aux=$clientS->getDocsByName('ddr'))!=null)
                    $data[$pos]['DDRRECEIVEDDATE']= $aux->signdate;
            }

            $pos++;
        }
        return json_encode($data);
    }

    public function psaDdrReportCSV() {
        $dateStart = Input::get('STARTDATE');
        $dateEnd = Input::get('ENDDATE');
        $projectCSs = DB::select("SELECT * FROM projectclientservices where str_to_date(ppaSent_created_at, '%m-%d-%Y') >= str_to_date(:dateStart, '%m/%d/%Y') AND str_to_date(ppaSent_created_at, '%m-%d-%Y') <= str_to_date(:dateEnd, '%m/%d/%Y')", ['dateStart' => $dateStart, 'dateEnd' => $dateEnd]);
        $filename = "files/reports/patentSearchProgressReport_".date('m_Y').".csv";
        $rejfile = fopen($filename,"w");
        $row = array("FILENO","INVENTOR","SENDDATE","PSARECEIVEDDATE","DDRRECEIVEDDATE");
        fputcsv($rejfile,$row);
        foreach($projectCSs as $projectCS){
            $clientS = ProjectClientServices::find($projectCS->id);
            $psa = "";
            $ddr = "";
            if($projectCS->ddrReceived_created_at != ""){
                $psa = $projectCS->ddrReceived_created_at;
                $ddr = $projectCS->ddrReceived_created_at;
            }else{
                if(($aux=$clientS->getDocsByName('agreementPSA'))!=null)
                    $psa = $aux->signdate;
                if(($aux=$clientS->getDocsByName('ddr'))!=null)
                    $ddr = $aux->signdate;
            }
            $row = array(
                $projectCS->fileno,
                ucwords($clientS->project->lead->fname." ".$clientS->project->lead->lname),
                $projectCS->ppaSent_created_at,
                $psa,
                $ddr
            );
            fputcsv($rejfile,$row);
        }
        echo json_encode($filename);
    }

    public function pctAndEpo(){
        $dateStart = date("Y-m-d H:i:s",strtotime(Input::get('STARTDATE')));
        $dateEnd = date("Y-m-d",strtotime(Input::get('ENDDATE')))." 23:59:59";

        $data = array();
        $pos = 0;
        //pct
        $projectCSs = ProjectClientServices::where('pctToAttDate','>=',$dateStart)->where('pctToAttDate','<=',$dateEnd)->get();
        foreach($projectCSs as $projectCS){
            $data[$pos]['FILENO']=$projectCS->fileno;
            $data[$pos]['INVENTOR']=ucwords($projectCS->project->lead->fname." ".$projectCS->project->lead->lname);
            $data[$pos]['TYPE']='PCT';
            $data[$pos]['SENDDATE']= date("m-d-Y",strtotime($projectCS->pctToAttDate));
            $data[$pos]['RECEIVEDDATE']= $projectCS->pctFil_created_at;
            $pos++;
        }
        //epo
        $projectCSs = ProjectClientServices::where('epoToAttDate','>=',$dateStart)->where('epoToAttDate','<=',$dateEnd)->get();
        foreach($projectCSs as $projectCS){
            $data[$pos]['FILENO']=$projectCS->fileno;
            $data[$pos]['INVENTOR']=ucwords($projectCS->project->lead->fname." ".$projectCS->project->lead->lname);
            $data[$pos]['TYPE']='EPO';
            $data[$pos]['SENDDATE']= date("m-d-Y",strtotime($projectCS->epoToAttDate));
            $data[$pos]['RECEIVEDDATE']= $projectCS->epoFil_created_at;
            $pos++;
        }
        return json_encode($data);
    }

    public function pctAndEpoCSV() {
        $dateStart = date("Y-m-d H:i:s",strtotime(Input::get('STARTDATE')));
        $dateEnd = date("Y-m-d",strtotime(Input::get('ENDDATE')))." 23:59:59";
        $projectCSs = ProjectClientServices::where('pctToAttDate','>=',$dateStart)->where('pctToAttDate','<=',$dateEnd)->get();
        $filename = "files/reports/patentSearchProgressReport_".date('m_Y').".csv";
        $rejfile = fopen($filename,"w");
        $row = array("FILENO","INVENTOR","SENDDATE","PSARECEIVEDDATE","DDRRECEIVEDDATE");
        fputcsv($rejfile,$row);
        foreach($projectCSs as $projectCS){
            $row = array(
                $projectCS->fileno,
                ucwords($projectCS->project->lead->fname." ".$projectCS->project->lead->lname),
                'PCT',
                date("m-d-Y",strtotime($projectCS->pctToAttDate)),
                $projectCS->pctFil_created_at
            );
            fputcsv($rejfile,$row);
        }
        $projectCSs = ProjectClientServices::where('epoToAttDate','>=',$dateStart)->where('epoToAttDate','<=',$dateEnd)->get();
        foreach($projectCSs as $projectCS){
            $row = array(
                $projectCS->fileno,
                ucwords($projectCS->project->lead->fname." ".$projectCS->project->lead->lname),
                'EPO',
                date("m-d-Y",strtotime($projectCS->epoToAttDate)),
                $projectCS->epoFil_created_at
            );
            fputcsv($rejfile,$row);
        }
        echo json_encode($filename);
    }

}
