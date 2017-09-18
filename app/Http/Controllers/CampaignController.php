<?php namespace App\Http\Controllers;

use App\Helpers\PlivoHelper;
use App\Helpers\ToolsFunctions;
use App\Models\Assignment;
use App\Models\Consultant;
use App\Models\Lead;
use App\Models\Project;
use App\Models\Request;
use App\Models\Submission;
use Illuminate\Support\Facades\Input;
use DB;

class CampaignController extends Controller {

    /*
     * To Allow use the controller methods the current user logged has to be Client
     */
    public function __construct(){}
    /*
     * Send to the index view the
     *
     * @return Response
     */
    public function index()
    {
        return view('omi.campaign.index',array());
    }

    public function submitCampaign(){
        //lead info
        $email = Input::get('EMAIL');
        $fname = Input::get('FNAME');
        $lname = Input::get('LNAME');
        $phone = str_pad(preg_replace('/\D+/', '', Input::get("PHONE")), 11, '1', STR_PAD_LEFT);
        $phone2 = (Input::has("PHONE2") && Input::get("PHONE2")!= '')?str_pad(preg_replace('/\D+/', '', Input::get("PHONE2")), 11, '1', STR_PAD_LEFT):"";
        $password = Input::get("PASSWORD");
        $street = Input::get('ADDRESS');
        $street2 =Input::get('SUITE');
        $city = Input::get('CITY');
        $state = Input::get('STATE');
        $zip = Input::get('ZIP');
        $country = Input::get('COUNTRY');
        $occupation = Input::get('OCUPATION');

        $lead = Lead::where('email', 'like',$email)->orWhere('phone', 'like',$phone)->orWhere('phone2', 'like',$phone)->first();
        if($lead == null) {
            $params = "first_name=".urlencode($fname)."&last_name=".urlencode($lname)."&phone=".urlencode($phone)."&phone2=&email=".urlencode($email)."&address1=".urlencode($street)."&address2=".urlencode($street2)."&city=".urlencode($city)."&state=".urlencode($state)."&postal_code=".urlencode($zip)."&note=&patent=&vendor_id=EMAILCAMPAIGN";
            $leadId = ToolsFunctions::curl(url("incomingLeads?$params"));
            $lead = Lead::find($leadId);
        }else{
            $lead->fname = $fname;
            $lead->lname = $lname;
            $lead->phone = $phone;
            $lead->phone2 = $phone2;
            $lead->email = $email;
            $lead->street = $street;
            $lead->street2 = $street2;
            $lead->city = $city;
            $lead->state = $state;
            $lead->zip = $zip;
        }
        $lead->password = $password;
        $lead->occupation = $occupation;
        $lead->country =$country;
        $lead->save();

        //sub info
        $ideaName = Input::get('PNAME');
        $ideaConcept = Input::get('PDESC');
        $hisIdea = Input::get('WHENHOW');
        $similarProduct = Input::get('SIMILAR');
        $probIdea =Input::get('PROBLEM');
        $isApp =Input::get('ISAPP');
        $language = Input::get('PLANGUAGE');

        $statement = Input::get('STATEMENT');
        $pinventors = Input::get('ALLINV');
        $tpacontact = Input::get('THIRDP');
        $patsearch = Input::get('ATTHIRED');
        $patented = Input::get('AGENCYHIRED');
        $disclosure = Input::get('DISCLOSURE');

        $consultantId = $lead->consultant_id;

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

        $projectId = Project::createFullProject($consultantId,$lead->id,$ideaName,$ideaConcept,$hisIdea,$similarProduct,$probIdea, $tpacontact, $patsearch, $patented, $pinventors, $isApp, $language,'UNLOADED');
        $project =Project::find($projectId);
        //create row in submission
        Submission::createSubmission($projectId,$project->consultant_id,'NEW',$lead->leadSource,'');

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
