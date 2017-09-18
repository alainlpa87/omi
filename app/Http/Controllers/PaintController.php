<?php namespace App\Http\Controllers;

use App\Models\Consultant;
use App\Models\Ilc;
use App\Models\IlcVendors;
use App\Models\Industry;
use App\Models\Lead;
use App\Models\Project;
use App\Models\ProjectClientServices;
use App\Models\ProjectProduction;
use App\Models\AttClientServices;
use App\Models\UploadedFiles;
use App\Models\Ticket;
use App\Models\Reply;
use App\Models\Request;
use DB;
use Illuminate\Support\Facades\Input;

class PaintController extends Controller {

    /*
    |--------------------------------------------------------------------------
    | Home Controller
    |--------------------------------------------------------------------------
    |
    | This controller renders your application's "dashboard" for users that
    | are authenticated. Of course, you are free to change or remove the
    | controller as you wish. It is just here to get your app started!
    |

     * Show the application dashboard to the user.
     *
     * @return Response
     */
    public function __construct()
    {

    }
    /**
     * Paint a new portlet from project Id
     *
     * @return Response
     */
    public function paintPortlet()
    {
        $id = Input::get('ID');
        $mobile = Input::get('MOBILE');

        $project =Project::find($id);
        if($project!=null)
        {
            if($mobile==1)
            {
                define('SHOW_DETAILS','SH-D');
                define('BASE','B');
                define('CLIENT','C');
                define('BUSINESS_PROFILE','B-P');
                define('PROJECT','PJ');
                define('PROFILE','PF');
            }
            else
            {
                define('SHOW_DETAILS','SHOW DETAILS');
                define('BASE','BASE');
                define('CLIENT','CLIENT');
                define('BUSINESS_PROFILE','BUSINESS PROFILE');
                define('PROJECT','PROJECT');
                define('PROFILE','PROFILE');
            }
            return view('intranet.project.portlet',array('project'=>$project,'new'=>1));
        }
        return "-1";
    }
    /**
     * Paint a new ticket
     *
     * @return Response
     */
    public function paintTicket(){
        $id =Input::get('ID');
        $ticket = Ticket::find($id);
        if($ticket != null){
            $replies = Reply::where('ticket_id',$ticket->id)->orderBy('created_at','ASC')->get();
            return view('intranet.ticket.ticketsDetails',array('ticket'=>$ticket,'replies'=>$replies));
        }else
            return "-1";
    }

    /**
     * Paint a new lead from lead Id
     *
     */
    public function paintLead()
    {
        $id = Input::get('ID');
        $mobile = Input::get('MOBILE');

        $lead =Lead::find($id);
        if($lead!=null)
        {
            $est = ['CT','DE','DC','FL','GA','IN','ME','MD','MA','MI','NH','NJ','NY','NC','OH','PA','RI','SC','VT','VA','WV'];
            $cst = ['AL','AR','IA','KS','KY','IL','LA','MN','MS','MO','NE','ND','OK','SD','TN','TX','WI','WY'];
            $mst = ['CO','ID','MT','NM','UT'];
            $pst = ['AZ','CA','OR','WA','NV'];
            if($mobile==1)
            {
                define('SHOW_DETAILS','SH-D');
                define('BASE','B');
                define('CLIENT','C');
                define('BUSINESS_PROFILE','B-P');
                define('PROJECT','PJ');
                define('PROFILE','PF');
            }
            else
            {
                define('SHOW_DETAILS','SHOW DETAILS');
                define('BASE','BASE');
                define('CLIENT','CLIENT');
                define('BUSINESS_PROFILE','BUSINESS PROFILE');
                define('PROJECT','PROJECT');
                define('PROFILE','PROFILE');
            }
            return view('intranet.lead.lead',array('lead'=>$lead,'new'=>1,'est'=>$est,'cst'=>$cst,'mst'=>$mst,'pst'=>$pst));
        }
        return "-1";
    }

    /**
     * Paint a new portlet from project and last request for Admin View
     *
     * @return Response
     */
    public function paintProjectAdmin(){
        $projectId = Input::get('PROJECT');
        $project =Project::find($projectId);
        if($project!=null){
            $requestId = Input::get('REQUEST');
            $request =Request::find($requestId);
            if($request!=null){
                return view('intranet.admin.portlet',array('project'=>$project,'currentRequest'=>$request));
            }
        }
        return "-1";
    }

    /**
     * Paint a new portlet from project for attorney client services View
     *
     * @return Response
     */
    public function paintProjectAttCS(){
        $projectId = Input::get('PROJECT');
        $consultantId = Input::get('USER');
        $project =Project::find($projectId);
        $projectCS = $project->clientServicesProject();
        $projectA = AttClientServices::find(Input::get('ATTCSID'));
        if($project!=null){
            return view('intranet.attorneyClientServices.portlet',array('project'=>$project,'projectN'=>$projectA,'search'=>1));
        }
        return "-1";
    }

    /**
     * Paint a new portlet from project for Vendor's View
     *
     * @return Response
     */
    public function paintProjectVendors(){
        $projectId = Input::get('PROJECT');
        $consultantId = Input::get('USER');
        $project =Project::find($projectId);
        $projectp = ProjectProduction::where('project_id',$projectId)->where('consultant_id',$consultantId)->first();
        if($project!=null){
            return view('intranet.vendors.portlet',array('project'=>$project,'projectp'=>$projectp,'user'=>$consultantId));
        }
        return "-1";
    }

    /**
     * Paint a new portlet from project for Production's View
     *
     * @return Response
     */
    public function paintProjectProduction(){
        $projectId = Input::get('PROJECT');
        $usr = Input::get('USER');
        $project =Project::find($projectId);
        $projectP =ProjectProduction::where(array('project_id'=>$projectId,'typeVendor'=>'Production'))->first();
        if($project!=null){
            return view('intranet.production.portlet',array('project'=>$project,'user'=>$usr,'projectp'=>$projectP));
        }
        return "-1";
    }


    /**
 * Paint a new portlet from project for ClientServices View
 *
 * @return Response
 */
    public function paintProjectClientServices(){
        $projectId = Input::get('PROJECT');
        $projectCsId = Input::get('PROJECTCS');
        $project =Project::find($projectId);
        $projectCS =ProjectClientServices::find($projectCsId);
        $attorneys = Consultant::where('rol','LIKE','%attorney%')->get();
        //check if have a file with filing receipt
        $projectClientServices = ProjectClientServices::where('show','1')->get();
        $withFilingReceipt = array();
        foreach($projectClientServices as $projcs) {
            $upFiles = UploadedFiles::where('project_id', $projcs->project_id)->where('filingReceipt', 1)->first();
            if ($upFiles != null)
                $withFilingReceipt[] = $projcs->project_id;
        }
        if($project!=null){
            $processStarted = 0;
            return view('intranet.clientServices.portlet',array('project'=>$project,'projectClientS'=>$projectCS,'attorneys'=>$attorneys,'processStarted'=>$processStarted,'withFilingReceipt'=>$withFilingReceipt));//
        }
        return "-1";
    }

    /**
     * Paint a new portlet from project for ILC View
     *
     * @return Response
     */
    public function paintProjectILC(){
        $id = Input::get('PROJECT');
        $ilc =ILC::find($id);
        $industries = Industry::all();
        if($ilc!=null){
            if($ilc->projectclientservices->hasType("PROV") && !$ilc->projectclientservices->hasType('UPG_UT'))
               $expirationDate = date('m-d-Y h:i:s', strtotime($ilc->agreementStartDate." +1 years"));
            else
               $expirationDate = date('m-d-Y h:i:s', strtotime($ilc->agreementStartDate." +2 years"));
            return view('intranet.ILC.portlet',array('project'=>$ilc->projectclientservices->project,'projectilc'=>$ilc,'industries'=>$industries,'expirationDate'=>$expirationDate));
        }
        return "-1";
    }

    /**
     * Paint a new portlet from project for ILCVendor View
     *
     * @return Response
     */
    public function paintProjectILCVendor(){
        $iid = Input::get('IID');
        $ilcV =IlcVendors::find($iid);
        if($ilcV!=null){
            $project = $ilcV->ilc->projectclientservices->project;
            return view('intranet.ilcVendors.portlet',array('project'=>$project,'projectV'=>$ilcV));
        }
        return "-1";
    }

}
