<?php namespace App\Http\Controllers;


use App\Helpers\ToolsFunctions;
use App\Models\Consultant;
use App\Models\Ilc;
use App\Models\IlcNotes;
use App\Models\IlcVendors;
use App\Models\Inbox;
use App\Models\Industry;
use App\Models\Lead;
use App\Models\Manufacturer;
use App\Models\Project;
use App\Models\Transaction;
use App\Models\UploadedFiles;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use DB;
use Illuminate\Support\Facades\Session;


class IlcVendorsController extends Controller {

    /*
     * Current Consultant logged
     */
    public $consultant;
    /*
     * To Allow use the controller methods the current user logged has to be Client
     */
    public function __construct()
    {
        $this->middleware('ilcVendor');
        $this->middleware(function ($request, $next) {
            $this->consultant = Consultant::find(Session::get('user_id'));

            return $next($request);
        });
    }

    //sign contract
    public function index()
    {
        //0--new, 1---returned, 2----overdue, 3---finished

        $total_inbox = Inbox::where(['consultant_id'=>$this->consultant->id,'status'=>0])->count();
        $projectsILCVNews = IlcVendors::where('state',0)->where('vendorId',$this->consultant->id)->get();
        $projectsIlcVReturned = IlcVendors::where('state',1)->where('vendorId',$this->consultant->id)->get();
        $projectsIlcVOverDue = IlcVendors::where('state',2)->where('vendorId',$this->consultant->id)->get();
        IlcVendors::where('status', 'UNLOADED')->where('vendorId',$this->consultant->id)->update(['status' => 'LOADED']); //->where('consultant_id',$this->consultant->id)

        return view("intranet.ilcVendors.index",array('consultant'=>$this->consultant,'projectsILCVendors'=>$projectsILCVNews, 'projectsILCVReturned'=>$projectsIlcVReturned, 'projectsILCVOverDue'=>$projectsIlcVOverDue,'total_inbox'=>$total_inbox));
    }



    public function findProjectILCVendors(){
        $leads = Lead::findLead(Input::get('PARAMS'));
//        $projects=array();
        $projectsToLoad=array();
        if($leads!="-1")
            foreach($leads as $lead_id)
            {
                $lead = Lead::find($lead_id);
                $listOfProjects = IlcVendors::where('fileno',$lead->fileno)->where('vendorId',$this->consultant->id)->get();
                foreach($listOfProjects as $projectFromLead){
                    $projectsToLoad[]=$this->paintProject($projectFromLead->id);
                }
            }
        echo json_encode($projectsToLoad);
    }

    /*
    * Create a portlet from a Project
    */
    public function paintProject($ilcvId){
        $view = ToolsFunctions::curl(url("paintProjectILCVendor?IID=$ilcvId"));
        return $view;
    }



    public function loadProjectPortletILCVendor(){
        $id = Input::get('ID');
        $projectToLoad = $this->paintProject($id);
        return json_encode($projectToLoad);
    }

    public function afterUploadFileILCVendor(){
        $iid = Input::get('IID');
        $projectId = Input::get('PID');
        $project = Project::find($projectId);
        if($project == null)
            return -1;
        //change the state of the ilc vendor to closed
        $ilcV = IlcVendors::find($iid);
        if($ilcV == null)
            return -1;
        $ilcV->state=3;
        $ilcV->save();
        //notify ilc of the change about state in the file
        $ilcConsultant =Consultant::where('usr','ilc')->first();
        $msg = "File closed by vendor.\r\n";
        $msg .= date("m-d-Y H:i:s")."\r\n";
        $msg .= "File #:".$ilcV->ilc->fileno."\r\n";
        $msg .= "Client: ".$ilcV->ilc->invFname." ".$ilcV->ilc->invLname."\r\n";
        $msg .= "Pin: ".$project->id."\r\n";
        Inbox::createInbox($project->lead->id,$ilcConsultant->id, $msg, 'FILE UPLOADED', 'ILC VENDOR');//
        //send email
        $sent =  ToolsFunctions::curl(url('notifyILCFileClosedByVendor?PID='.$projectId));
        if($sent == 1)
            return 1;
        return -1;
    }
}
