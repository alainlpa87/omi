<?php namespace App\Http\Controllers;

use App\Helpers\PlivoHelper;
use App\Helpers\ToolsFunctions;
use App\Models\Assignment;
use App\Models\Consultant;
use App\Models\Lead;
use App\Models\LeadCampain;
use App\Models\Project;
use App\Models\Request;
use App\Models\Submission;
use Illuminate\Support\Facades\Input;
use DB;

class OmiProjectController extends Controller {


    public function __construct(){}
    /*
     * Load the create sub page
     *
     * @return Response
     */
    public function index(){
        return view('omi.project.index');
    }

    public function continue1(){
        $email = Input::get("EMAIL");
        $phone = str_pad(preg_replace('/\D+/', '', Input::get("PHONE")), 11, '1', STR_PAD_LEFT);
        $phone2 = (Input::has("PHONE2") && Input::get("PHONE2")!= '')?str_pad(preg_replace('/\D+/', '', Input::get("PHONE2")), 11, '1', STR_PAD_LEFT):"";
        $fname = Input::get("FNAME");
        $lname = Input::get("LNAME");
        $bestToCall = (Input::has("BESTCALL"))?Input::get("BESTCALL"):"";
        $password = Input::get("PASSWORD");

        $lead = Lead::where('email', 'like',$email)->orWhere('phone', 'like',$phone)->orWhere('phone2', 'like',$phone)->first();
        if ($lead != null) {
            $lead->best = $bestToCall;
            $lead->password = $password;
            $lead->save();
            Lead::updateLead($lead->id,'','',$fname,$lname,$phone,$phone2,$email,'','','','','','','','','','');

            //it mean we have a lead with that phone or email and we go directly to the subs questions.
            return "$lead->id";
        }else{
            //it mean that we going to obtain more info to create the lead before the sub.
            return "-1";
        }
    }

    public function continue2(){
        $email = Input::get("EMAIL");
        $phone = str_pad(preg_replace('/\D+/', '', Input::get("PHONE")), 11, '1', STR_PAD_LEFT);
        $fname = Input::get("FNAME");
        $lname = Input::get("LNAME");
        $address = Input::get("ADDRESS");
        $city = Input::get("CITY");
        $state = Input::get("STATE");
        $zip = Input::get("ZIP");
        $password = Input::get("PASSWORD");

        $params = "first_name=".urlencode($fname)."&last_name=".urlencode($lname)."&phone=".urlencode($phone)."&phone2=&email=".urlencode($email)."&address1=".urlencode($address)."&address2=&city=".urlencode($city)."&state=".urlencode($state)."&postal_code=".urlencode($zip)."&note=&patent=";

        $campaign = LeadCampain::where('email',$email)->count();
        if($campaign >0){
            $usr = ToolsFunctions::selectCampaignUser();
            $params.='&campaign='.$usr;
            $params.='&vendor_id=EDATA';
            LeadCampain::where('email',$email)->update(['delete'=>1]);
        }else{
            $params.='&vendor_id=OMI';
        }
        $leadId = ToolsFunctions::curl(url("incomingLeads?$params"));
        if($leadId != ''){
            $lead = Lead::find($leadId);
            if ($lead != null) {
                $lead->password = $password;
                $lead->save();
            }
        }
        return "$leadId";
    }

    public function continue3(){
        $leadId = Input::get("LEAD");
        $lead = Lead::find($leadId);
        $consultantId = $lead->consultant_id;
        $ideaName = Input::get("IDEANAME");
        $ideaConcept = Input::get("IDEACONCEPT");
        $hisIdea = Input::get("HISIDEA");
        $similarProduct = Input::get("SIMILARPRODUCT");
        $probIdea = Input::get("PROBIDEA");
        $isApp = Input::get('APP');
        $language = Input::get('LANGUAGE');

        //if lead is assigned to robot, find the last owner and reassign it back
        if($consultantId == 1){
            $assignments = Assignment::where('lead_id','=',$lead->id)->where('consultant_id','!=',$consultantId)->orderBy('created_at','DESC')->get();
            foreach($assignments as $assignment){
                $consultantAux = Consultant::find($assignment->consultant_id);
                if($consultantAux != null && $consultantAux->active == 1) {
                    $lead->consultant_id = $assignment->consultant_id;
                    $lead->status = 'UNLOADED';
                    $lead->save();
                    $consultantId = $assignment->consultant_id;
                    break;
                }
            }
        }

        $projectId = Project::createProject($consultantId, $leadId, $ideaName, $ideaConcept, $hisIdea, $similarProduct, $probIdea, 'INCOMPLETE');
        if($isApp == 1){
            $project =Project::find($projectId);
            $project->isApp = $isApp;
            $project->language = $language;
            $project->save();
        }
        return "$projectId";
    }

    public function submit(){
        $projectId = Input::get("PROJECT");
        $occupation = Input::get("OCCUPATION");
        $tpacontact = Input::get("TPACONTACT");
        $patsearch = Input::get("PATSEARCH");
        $patented = Input::get("PATENTED");
        $pinventors = Input::get("PINVENTORS");

        //update occupation in the lead
        $project = Project::find($projectId);
        if($project != null) {
            $lead = Lead::find($project->lead_id);
            if($lead != null) {
                $lead->occupation = $occupation;
                $lead->save();
            }
        }
        //update and finish project.
        if($project->status == 'LOADED'){
            $projectId = Project::updateProject($projectId, $tpacontact, $patsearch, $patented, $pinventors, 'LOADED');
        }else{
            $projectId = Project::updateProject($projectId, $tpacontact, $patsearch, $patented, $pinventors, 'UNLOADED');
        }
        //create the row in submission to keep record.
        $submissionAux = Submission::where(['project_id'=>$projectId,'consultant_id'=>$project->consultant_id,'status'=>'NEW'])->first();
        if($submissionAux != null){
            $aux = 'is created';
        }else{
            Submission::createSubmission($projectId,$project->consultant_id,'NEW',$lead->leadSource,'');
        }

        //create request to admin for approval
        $requestAdmin = new Request();
        $request_find = Request::where(['project_id'=>$projectId,'consultantStage'=>'APPROVE','adminStage'=>''])->first();
        if($request_find!=null)
            $requestAdmin = $request_find;
        $requestAdmin->project_id = $projectId;
        $requestAdmin->request = "ADMIN";
        $requestAdmin->consultantStage = "APPROVE";
        $requestAdmin->save();
        //send Text to client to let him know we have the submission
        PlivoHelper::sendSMS($lead->phone, 'We have received your submission. We will contact you soon.');

        return "$projectId";
    }
}
