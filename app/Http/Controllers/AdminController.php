<?php namespace App\Http\Controllers;

use App\Helpers\ToolsFunctions;
use App\Models\Assignment;
use App\Models\Consultant;
use App\Models\Inbox;
use App\Models\Lead;
use App\Models\Project;
use App\Models\ProjectProduction;
use App\Models\Request;
use App\Models\Transaction;
use App\Models\UploadedFiles;
use DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;

class AdminController extends Controller {

    /*
     * Current Consultant logged
     */
    public $consultant;
    /*
     * To Allow use the controller methods the current user logged has to be Consultant
     */
    public function __construct()
    {
        $this->middleware('admin');
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
        $total_inbox = Inbox::where(['consultant_id'=>$this->consultant->id,'status'=>0])->count();
        $request = Request::where(['request'=>'ADMIN', 'adminStage'=>''])->get();
        $requestList = array();
        $contractList = array();
        $count = 0;
        foreach($request as $req){
            $aux = array();
            $aux['PROJECT'] = Project::find($req->project_id);
            $aux['REQUEST'] = $req;
            if(strpos($req->consultantStage,'SEND') !== false){
                $count++;
            }else{
                $requestList[] = $aux;
            }
        }
        Request::where('status', 0)->update(['status' => 1]);
        return view('intranet.admin.index',array('consultant'=>$this->consultant,'total_inbox'=>$total_inbox,'dataRequest'=>$requestList,'totalContracts' => $count));
    }

    /*
     * Update Admin notes on project and request
     */
    public function saveAdminNotes()
    {
        $notes = Input::get('NOTES');
        $requestId = Input::get('REQUEST');
        $request = Request::find($requestId);
        if($request!=null)
        {
            $request->adminNotes = $notes;
            $request->save();
            $project = Project::find($request->project_id);
            if($project!=null) {
                $project->adminNotes = $notes;
                $project->save();
            }
            return "1";
        }
        return "-1";
    }

    /*
     * approve, reject or NMI
     */
    public function changeRequestStage()
    {
        $value = Input::get('VALUE');
        $requestId = Input::get('REQUEST');
        $request = Request::find($requestId);
        if($request!=null){
            if($request->adminStage == ""){
                $project = Project::find($request->project_id);
                if($project!=null) {
                    if($value == 'APPROVED'){
                        $project->pendingNMI = 0;
                        $project->save();
                    }elseif($value == "APPROVED BUT NMI"){
                        $project->pendingNMI = 1;
                        $project->save();
                        $value = 'APPROVED';
                    }
                    $request->adminStage = $value;
                    $request->admin_id = $this->consultant->id;
                    $request->consultant_id = $project->consultant_id;
                    $request->save();

                    //create and save the sub in the upload files

                    $pdf = App::make('dompdf.wrapper');
                    $content = view('intranet.admin.printProject',array('project'=>$project));
                    if(!File::exists("files/projects/".$project->lead->fileno."/".$project->id)) {
                        File::makeDirectory("files/projects/".$project->lead->fileno."/".$project->id, 0755, true);
                    }
                    $fileName = "submission_".$value.".pdf";
                    $pdf->loadHTML($content);
                    $url = "files/projects/".$project->lead->fileno."/".$project->id."/".$fileName;
                    $pdf->save($url);

                    $file = UploadedFiles::where(['fileName'=>$fileName,'project_id'=>$project->id])->first();
                    if($file==null){
                        $file = new UploadedFiles();
                    }
                    $file->project_id = $project->id;
                    $file->internal = 1;
                    $file->fileName = $fileName;
                    $file->url = $url;
                    $file->save();

                    //ask if owner is an incubator to change the ownership
                    if ($value == 'APPROVED' && $project->stage != 'SUBMISSIONS' && $project->stage != 'CONCEPT' && strpos($project->consultant->rol, 'incubator') !== false){
                        ToolsFunctions::changeOwnership($project);
                    }
                    return $requestId;
                }
                return "-1";
            }
            return "-2";
        }
        return "-1";
    }

    /*
     * Mark a lead as EXCLUDE and save the reason
     */
    public function adminDeleteLead()
    {
        $fileno = Input::get('FILENO');
        $lead = Lead::where('fileno',$fileno)->first();
        if($lead!=null)
        {
            $lead->reason = 'ADMIN EXCLUDED BY CLIENT REQUEST';
            $lead->status = 'EXCLUDE';
            $lead->save();
            //Create Transaction
            Transaction::createTransaction($lead->consultant_id, $lead->id, $this->consultant->id, 'DELETE-LEAD-BY-ADMIN', 'ADMIN EXCLUDED BY CLIENT REQUEST', '', $lead->email, '', '', $lead->phone, '');
            return "1";
        }
        return "-1";
    }

    /*
     * Mark a lead as EXCLUDE and save the reason
     */
    public function adminCreateSub()
    {
        $fileno = Input::get('FILENO');
        $ideaName = Input::get('IDEANAME');
        $lead = Lead::where('fileno',$fileno)->first();
        if($lead!=null){
            $project = Project::where('lead_id',$lead->id)->first();
            if($project==null){
                $projectId = Project::createProject($lead->consultant_id,$lead->id,$ideaName,'REVIEW FILES','REVIEW FILES','REVIEW FILES','REVIEW FILES', 'UNLOADED');
                //Create Transaction
                Transaction::createTransaction($lead->consultant_id, $lead->id, $this->consultant->id, 'SUBMISSION-CREATED-BY-ADMIN', '', $projectId, $lead->email, '', '', $lead->phone, '');
                return "1";
            }
            return "-1";
        }
        return "-1";
    }

    /*
     * Get all consultant for a combo
     */
    public function allConsultants(){
        return json_encode(Consultant::where('rol','LIKE','%consultant%')->get());
    }

    /*
     * Reassign Lead
     */
    public function reassignLead(){
        $fileno = Input::get('FILENO');
        $consultantId = Input::get('CONSULTANT');
        $reason = Input::get('REASON');
        $lead = Lead::where('fileno',$fileno)->first();
        if($lead!=null){
            ToolsFunctions::reassignLead($lead->id,$consultantId,$reason,$this->consultant->id);
            return "1";
        }
        return "-1";
    }

    public function reassignAllLead(){
        $now =  date("Y-m-d h:i:s");
        $consultantIdFrom = Input::get('FROM');
        $consultantIdTo = Input::get('TO');
        $random = Input::get('RANDOM');
        $reason = Input::get('REASON');
        $amount = Input::get('AMOUNT');
        $all = Input::get('ALL');

        $leads = "";
        if($all == 'true'){
            $leads = Lead::where('consultant_id',$consultantIdFrom)->orderBy('created_at','DESC')->get();
        }else{
            $leads = Lead::where('consultant_id',$consultantIdFrom)->take($amount)->orderBy('created_at','DESC')->get();
        }

        $totalLeads = count($leads);
        $ids = "";
        $reassigned = 0;

        if($random == 'true'){
            $consultants = Consultant::where(['leads' => 1,'active' => 1])->orderBy('score', 'desc')->get();//,'utype'=>'CON_JR' for junior only
            for($i=0;$i<$totalLeads;$i++){
                $consultantsAux = $consultants[$i%count($consultants)];
                if($leads[$i]->projects->count() == 0){
                    $leads[$i]->consultant_id = $consultantsAux->id;
                    $leads[$i]->last = $now;
                    $leads[$i]->status = 'UNLOADED';
                    $leads[$i]->save();
                    //update message received about this lead to the new consultant
                    Inbox::where('lead_id', $leads[$i]->id)->update(['consultant_id' => $consultantsAux->id]);
                    //create row in assignment
                    Assignment::createAssignment($consultantsAux->id,$leads[$i]->id,'REASSIGN','',$leads[$i]->leadSource,'Unloaded_Leads');//_CON_JR  for junior only
                    $ids .= strlen($ids) > 0 ? "," : "";
                    $ids .= $leads[$i]->id;
                    $reassigned++;
                }
            }

        }else{
            $leadWithSubs = -1;
            foreach($leads as $lead){
                if($lead->projects->count() == 0){
                    $lead->consultant_id = $consultantIdTo;
                    $lead->status = 'UNLOADED';
                    $lead->last = $now;
                    $lead->save();
                    //update message received about this lead to the new consultant
                    Inbox::where('lead_id', $lead->id)->update(['consultant_id' => $consultantIdTo]);
                    //create row in assignment
                    Assignment::createAssignment($consultantIdTo,$lead->id,'REASSIGN','',$lead->leadSource);
                    $ids .= strlen($ids) > 0 ? "," : "";
                    $ids .= $lead->id;
                    $reassigned++;
                }else{
                    $leadWithSubs--;
                }
            }
        }
        //Create Transaction
        Transaction::createTransaction($consultantIdTo, '', $consultantIdFrom, 'REASSIGN-ALL-LEADS', $reason.": ".$ids, '', '', '', $this->consultant->id, '', '');

        if($all == 'true' || $random == 'true'){
            if($totalLeads == $reassigned){
                return "-1";
            }else{
                return $totalLeads - $reassigned;
            }
        }else if($leadWithSubs < -1){
            return $leadWithSubs;
        }else{
            return "-1";
        }

    }

    public function reassignAllLeadWithSub(){
        $consultantIdFrom = Input::get('FROM');
        $leadsCount = Input::get('LEADS');
        $listTo = explode(',',Input::get('TO'));
        $cant=floor($leadsCount/count($listTo));
        foreach($listTo as $consultantId){
            $leads = Lead::where('consultant_id',$consultantIdFrom)->take($cant)->get();
            foreach($leads as $lead){
                ToolsFunctions::reassignLead($lead->id,$consultantId,'REASSIGN-ALL-LEADS-WITH-SUBS',$this->consultant->id);
            }
        }
        $leads = Lead::where('consultant_id',$consultantIdFrom)->get();
        $i = 0;
        foreach($leads as $lead){
            ToolsFunctions::reassignLead($lead->id,$listTo[$i],'REASSIGN-ALL-LEADS-WITH-SUBS',$this->consultant->id);
            $i++;
        }
        return "1";
    }

    /*
     * Create New Lead from the admin view
     */
    public function createNewLeadAdmin(){
        $fileno = Input::get('FILENO');
        $fname = Input::get('FNAME');
        $lname = Input::get('LNAME');
        $email = Input::get('EMAIL');
        $phone = str_pad(preg_replace('/\D+/', '', Input::get("PHONE")), 11, '1', STR_PAD_LEFT);
        $street = Input::get('STREET');
        $street2 = Input::get('STREET2');
        $city = Input::get('CITY');
        $state = Input::get('STATE');
        $zip = Input::get('ZIP');
        $consultantId = Input::get('CONSULTANT');

        $lead = Lead::where('fileno',$fileno)->first();
        if($lead == null){
            $lead = Lead::where('email',$email)->first();
            if($lead == null) {
                $lead = Lead::where('phone', $phone)->first();
                if ($lead == null) {

                    //crear el lead con el $consultantId
                    $leadId = Lead::createLead($fileno,$consultantId,$fname,$lname,$phone,'',$email,$street,$street2,$city,$state,$zip,'','DEF','','','','UNLOADED');

                    //crear el assignment.
                    Assignment::createAssignment($consultantId,$leadId,'REASSIGN','','DEF');

                    //crear Transaction.
                    Transaction::createTransaction($consultantId, $leadId, $this->consultant->id, 'CREATE-LEAD-BY-ADMIN', '', '', $email, '', '', $phone, '');

                    return "1";
                }
                return "-1";
            }
            return "-1";
        }
        return "-1";
    }

    /*
     * Search projects By Params
     */
    public function findProjectAdmin(){
        $leads = Lead::findLead(Input::get('PARAMS'));
        $projects=array();
        if($leads!="-1")
            foreach($leads as $lead_id)
            {
                $listOfProjects = Project::where('lead_id',$lead_id)->get();
                foreach($listOfProjects as $projectFromLead){
                        $projects[] = $projectFromLead;
                }
            }
        $projectsToLoad=array();
        foreach($projects as $project){
            if($project->lastRequestToAdmin() == null){
                $request  = new Request();
                $request->project_id = $project->id;
                $request->request = 'ADMIN';
                $request->consultantStage = 'FIND ADMIN';
                $request->adminStage = 'FIND ADMIN';
                $request->readed = 1;
                $request->admin_id = $this->consultant->id;
                $request->save();
             }else{
                $request = $project->lastRequestToAdmin();
            }
            $projectsToLoad[]=$this->paintProject($project->id,$request->id);
        }
        echo json_encode($projectsToLoad);
    }

    /*
     * Create a portlet from a Project
     */
    public function paintProject($projectId, $requestId){
        $view = ToolsFunctions::curl(url("paintProjectAdmin?PROJECT=$projectId&REQUEST=$requestId"));
        return $view;
    }

    /*
     * Search all the new projects that aren't loaded yet for the current consultant  and updated to loaded
     */
    public function loadNewRequest()
    {
        $newRequest = Request::where(['request'=>'ADMIN', 'adminStage'=>'', 'status' => 0])->get();
        $result=array();
        $projectsToLoad=array();
        $count = 0;
        foreach($newRequest as $request){
            if(strpos($request->consultantStage,'SEND') !== false){
                $count++;
            }else{
                $projectsToLoad[]=$this->paintProject($request->project_id,$request->id);
            }
        }
        Request::where('status', 0)->update(['status' => 1]);
        $result['contracts'] = $count;
        $result['request'] = $projectsToLoad;
        echo json_encode($result);
    }

    /*
     * Search all the new Contracts that aren't loaded yet for the current consultant  and updated to loaded
     */
    public function loadNewContract()
    {
        $newRequest =Request::where(['request'=>'ADMIN', 'adminStage'=>''])->get();
        $contracts=array();
        foreach($newRequest as $request){
            if(strpos($request->consultantStage,'SEND') !== false){
                $file = "";
                switch($request->consultantStage){
                    case "SEND WP":
                        $file = "contract_wp.pdf";
                        break;
                    case "SEND IGUP":
                        $file = "contract_upgrade.pdf";
                        break;
                    case "SEND IIG":
                        $file = "contract_iig.pdf";
                        break;
                    case "SEND IMG":
                        $file = "contract_img.pdf";
                        break;
                }
                $url = "files/projects/".$request->project->lead->fileno."/".$request->project->id."/".$file;
                $lead = $request->project->lead;
                $clientName = $lead->fname." ".$lead->lname;
                $clientAddress = $lead->street." ".$lead->street2.",".$lead->city.",".$lead->state." ".$lead->zip;
                $contracts[]=['id'=>$request->id,'clientName'=>$clientName,'clientAddress'=>$clientAddress,'url'=>$url,'fileName'=>explode(".",$file)[0]];
            }
        }
        echo json_encode($contracts);
    }

    /*
     * save the request admin stage to Contract sent.
     */
    public function saveSendContract()
    {
        $requestId = Input::get('REQUEST');
        $request = Request::find($requestId);
        if ($request != null) {
            $request->adminStage = "Contract sent";
            $request->admin_id = $this->consultant->id;
            $request->save();
            Transaction::createTransaction('', '', '', 'CONTRACT MAILED', 'BY ADMIN', $request->project_id, '', '', '', '', '');
            return "1";
        }
        return "-1";
    }

    /*
     * saveAvailableForVendors.
     */
    public function saveAvailableForVendors()
    {
        $projectId = Input::get('PROJECT');
        $value = Input::get('VALUE');
        $project = Project::find($projectId);
        if ($project != null) {
            if($value == "true")
            {
                $lastContract = $project->lastContractWithPayment();
                $now = new \DateTime('now');
                $project->vendor = 1;
                $project->vendorDate = $now->format("Y-m-d H:i:s");

                $projectP = ProjectProduction::where(array('project_id'=>$project->id,'typeVendor'=>'production'))->first();
                if($projectP==null)
                    $projectP = new ProjectProduction();
                $consultantP = Consultant::where('usr','production')->first();
                $projectP->project_id = $project->id;
                $projectP->fileno = $project->lead->fileno;
                $projectP->typeVendor = 'production';
                $projectP->consultant_id = $consultantP->id;
                $projectP->contractType = $lastContract?$lastContract->type:"";
                $projectP->save();

                //IPG that only has to be sent to the attorney (create the rows empty for the other vendor so sent to vendor will not send the file to them)
                if($lastContract && $lastContract->type == "IGUP" && $lastContract->price == 695 && $lastContract->paid == 695){
                    //university
                    $projectPU = new ProjectProduction();
                    $projectPU->project_id = $projectP->project_id;
                    $projectPU->fileno = $projectP->fileno;
                    $projectPU->typeVendor = 'university';
                    $projectPU->consultant_id = 0;
                    $projectPU->contractType = 'IPG';
                    $projectPU->completed = 1;
                    $projectPU->save();

                    //designer
                    $projectPD = new ProjectProduction();
                    $projectPD->project_id = $projectP->project_id;
                    $projectPD->fileno = $projectP->fileno;
                    $projectPD->typeVendor = 'designer';
                    $projectPD->consultant_id = 0;
                    $projectPD->contractType = 'IPG';
                    $projectPD->completed = 1;
                    $projectPD->save();

                    //writer
                    $projectPW = new ProjectProduction();
                    $projectPW->project_id = $projectP->project_id;
                    $projectPW->fileno = $projectP->fileno;
                    $projectPW->typeVendor = 'writer';
                    $projectPW->consultant_id = 0;
                    $projectPW->contractType = 'IPG';
                    $projectPW->completed = 1;
                    $projectPW->save();
                }
            }
            else
            {
                $project->vendor = 0;
                $count = ProjectProduction::where('project_id',$project->id)->count();
                if($count>1)
                    return "-2";
                DB::table('project_production')->where('project_id', $project->id)->delete();
            }
            $project->save();
            return "1";
        }
        return "-1";
    }

    /*
     *print business profile for a project in admin view
     */
    public function printBusinessProfileAdmin()
    {
        $id = Input::get('ID');
        $project = Project::find($id);
        if($project!=null)
        {
            return view('intranet.admin.printBusiness',array('project'=>$project));
        }
    }

    /*
     *print project
     */
    public function printProjectAdmin()
    {
        $id = Input::get('ID');
        $project = Project::find($id);
        if($project!=null)
        {
            return view('intranet.admin.printProject',array('project'=>$project));
        }
    }

    //show the information of the lead with that condition.
    public function findLeadAdmin(){
        $leads_id = Lead::findLead(Input::get('PARAMS'));
        $found=[];
        if($leads_id!="-1")
            foreach($leads_id as $lead_id)
            {
                $currentLead = Lead::find($lead_id);
                if($currentLead!=null)
                {
                    $owned = $this->consultant->id == $currentLead->consultant->id?1:0;
                    $found[]=['id'=>$currentLead->id,'fname'=>$currentLead->fname,'lname'=>$currentLead->lname,
                        'email'=>$currentLead->email,'phone' => $currentLead->phone,'user'=>$currentLead->consultant->usr,'fileno'=>$currentLead->fileno,
                        'status'=>$currentLead->status,'owned'=>$owned];
                }
            }
        return json_encode($found);
    }

}
