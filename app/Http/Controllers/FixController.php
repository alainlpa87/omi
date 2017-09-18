<?php namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Consultant;
use App\Models\Contract;
use App\Models\Inbox;
use App\Models\Lead;
use App\Models\Project;
use App\Models\Request;
use App\Models\Submission;
use App\Models\Transaction;
use App\Models\UploadedFiles;
use DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class FixController extends Controller {

    /*
     * Current Consultant logged
     */
    public $consultant;
    /*
     * To Allow use the controller methods the current user logged has to be Consultant
     */
    public function __construct()
    {
        $this->middleware('fix');
        $this->middleware(function ($request, $next) {
            $this->consultant = Consultant::find(Session::get('user_id'));

            return $next($request);
        });
    }
    /*
     * Send to the index view the request from consultants to send contracts or approve projects
     *
     * @return Response
     */
    public function index(){
        $consultants = Consultant::where('rol','LIKE','%consultant%')->get();
        $total_inbox = Inbox::where(['consultant_id'=>$this->consultant->id,'status'=>0])->count();
        return view('intranet.fix.index',array('consultant'=>$this->consultant,'total_inbox'=>$total_inbox,'consultants'=>$consultants));
    }

    //assign leads to an specific consultant by user
    public function assignLead()
    {
        $numLeads = Input::get('NUMBER');
        $consultantId = Input::get('ID');
        $now =  date("Y-m-d h:i:s");
        $robot = Consultant::where('usr','ROBOT')->first();
        $leads = Lead::where('consultant_id',$robot->id)->orderBy('created_at','DESC')->take($numLeads)->get();//->skip(300)
        foreach($leads as $lead)
        {
            $lead->consultant_id = $consultantId;
            $lead->last = $now;
            $lead->status = "UNLOADED";
            $lead->flag = "";
            $lead->save();
            Assignment::createAssignment($consultantId,$lead->id,'REASSIGN',0,$lead->leadSource,"TO_INCUBATOR");
        }
        //Create Transaction
        Transaction::createTransaction($consultantId, '', '', 'ASSIGN_LEAD_FUNCTION', $numLeads, '', '', '', '', '', '');
        return "1";
    }

    public function fixContract()
    {
        $contractType = Input::get('TYPE');
        $projectId = Input::get('ID');
        $price = ($contractType == 'IMG')?449:($contractType == 'IGUP'?430:879);

        $contract = Contract::where(['project_id'=>$projectId,'type'=>$contractType])->first();
        if($contract == null){
            $project = Project::find($projectId);
            $contract = new Contract();
            $contract->consultant_id = $project->consultant_id;
            $contract->type = $contractType;
            $contract->project_id = $project->id;
        }
        $contract->created_at = date("Y-m-d h:i:s");
        $contract->paidDate = "00-00-00 00:00:00";
        $contract->signedDate = "00-00-00 00:00:00";
        $contract->signed = "";
        $contract->price = $price;
        $contract->save();

        //Create Transaction
        Transaction::createTransaction('', '', '', 'CONTRACT_FIXED', 'contract_id: '.$contract->id, '', '', $contractType, '', '', $price);
        return "1";
    }

    public function fixDuplicateProject()
    {
        $projectId = Input::get('ID');
        $project = Project::where(['id'=>$projectId])->first();
        if($project == null)
            return "-1";
        $lead = $project->lead;
        $consultant = $project->consultant;
        //if any contract is paid we abort.
        $contracts = Contract::where(['project_id'=>$projectId])->get();
        foreach ($contracts as $contract){
            if($contract->paid >0)
                return "-1";
        }
        //if contract are not paid we proceed
        Request::where(['project_id'=>$projectId])->delete();
        Contract::where(['project_id'=>$projectId])->delete();
        Transaction::where(['project_id'=>$projectId])->delete();
        UploadedFiles::where(['project_id'=>$projectId])->delete();
        Submission::where(['project_id'=>$projectId])->delete();
        Project::where(['id'=>$projectId])->delete();
        //Create Transaction
        Transaction::createTransaction($consultant->id, $lead->id, '', 'DUPLICATE_PROJECT_FIXED', 'project_id: '.$projectId, $projectId, '', '', '', '', '');
        return "1";
    }
}
