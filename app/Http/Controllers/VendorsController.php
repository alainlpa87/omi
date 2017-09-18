<?php namespace App\Http\Controllers;

use App\Helpers\ToolsFunctions;
use App\Models\Consultant;
use App\Models\Inbox;
use App\Models\Lead;
use App\Models\Project;
use App\Models\ProjectProduction;
use DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class VendorsController extends Controller {

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
        $total_inbox = Inbox::where(['consultant_id'=>$this->consultant->id,'status'=>0])->count();
        $projectsNew = ProjectProduction::where(['consultant_id'=>$this->consultant->id,'completed'=>0,'noShow'=>0])->get();
        $projectsReturned = ProjectProduction::where(['consultant_id'=>$this->consultant->id,'completed'=>2,'noShow'=>0])->get();
        $projectsLate = ProjectProduction::where(['consultant_id'=>$this->consultant->id,'completed'=>3,'noShow'=>0])->get();
        return view('intranet.vendors.index',array('consultant'=>$this->consultant,'total_inbox'=>$total_inbox,'projectsReturned'=>$projectsReturned,'projectsLate'=>$projectsLate,'projectsNew'=>$projectsNew));
    }

    /*
     * Search projects By Params
     */
    public function findProjectVendor(){
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
        $view = ToolsFunctions::curl(url("paintProjectVendors?PROJECT=$projectId&USER=".$this->consultant->id));
        return $view;
    }

    /*
     *print business profile for a project in vendor view
     */
    public function printBusinessVendor()
    {
        $id = Input::get('ID');
        $project = Project::find($id);
        if($project!=null)
        {
            return view('intranet.vendors.printBusiness',array('project'=>$project,'user'=>$this->consultant->usr));
        }
    }

    public function completeProjectWriter()
    {
        $id = Input::get('ID');
        $project = ProjectProduction::find($id);
        if($project!=null)
        {
            $now = new \DateTime('now');
            $project->completed = 1;
            $project->completedDate =  $now->format("Y-m-d H:i:s");
            $project->save();
            return "1";
        }
        return "-1";
    }
}
