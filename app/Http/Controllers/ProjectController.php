<?php namespace App\Http\Controllers;

use App\Helpers\PlivoHelper;
use App\Helpers\ToolsFunctions;
use App\Models\Article;
use App\Models\Consultant;
use App\Models\Contract;
use App\Models\Inbox;
use App\Models\Lead;
use App\Models\Message;
use App\Models\PpaPricesPlan;
use App\Models\Project;
use App\Models\Transaction;
use Illuminate\Support\Facades\Input;
use App\Models\Request;
use DB;
use Illuminate\Support\Facades\Session;

class ProjectController extends Controller {

    /*
     * Current Consultant logged
     */
    public $consultant;
    /*
     * To Allow use the controller methods the current user logged has to be Consultant
     */
    public function __construct()
    {
        $this->middleware('consultant');
        $this->middleware(function ($request, $next) {
            $this->consultant = Consultant::find(Session::get('user_id'));

            return $next($request);
        });
    }
    /*
     * Send to the index view the active projects,the consultant and his voice mails, and update all his projects to LOADED
     *
     * @return Response
     */
    public function index()
    {
        $today = date("Y-m-d H:i:s");
        $before45=  date("Y-m-d H:i:s", strtotime("-90 days", strtotime($today)));
        $projects = Project::where('consultant_id',$this->consultant->id)->where('lead_id','>',0)->where('status','not like','EXCLUDE')->where('updated_at','>=',$before45)->orderBy('created_at','DESC')->get();
        Project::where('status', 'UNLOADED')->where('consultant_id',$this->consultant->id)->update(['status' => 'LOADED']);
        $voiceMessages = Message::where(['type'=>'VM','consultant_id'=>$this->consultant->id])->get();
        $total_inbox = Inbox::where(['consultant_id'=>$this->consultant->id,'status'=>0])->count();
        $articles = Article::all();
        return view('intranet.project.index',array('consultant'=>$this->consultant,'projects'=>$projects,'voiceMessages'=>$voiceMessages,
            'total_inbox'=>$total_inbox,'articles'=>$articles,'new'=>0));
    }
    /*
     * Update consultant notes for a project
     */
    public function updateNotes()
    {
        $id = Input::get('ID');
        $project = Project::find($id);
        if($project!=null)
        {
            $notes = Input::get('NOTES');
            $project->notes = $notes;
            $project->save();
            //Create Transaction
            Transaction::createTransaction($this->consultant->id, '', '',"UPDATE-CONSULTANT-NOTES-PROJECT", $notes, $id, $project->lead->email, '', '', $project->lead->phone, '');
            return "1";
        }
        return "-1";
    }
    /*
     * Update notes for a project
     */
    public function updateApprovalNotesProject()
    {
        $id = Input::get('ID');
        $project = Project::find($id);
        if($project!=null)
        {
            $notes = Input::get('NOTES');
            $project->approvalNotes = $notes;
            $project->save();
            //Create Transaction
            Transaction::createTransaction($this->consultant->id, '', '',"UPDATE-APPROVAL-NOTES-PROJECT", $notes, $id, $project->lead->email, '', '', $project->lead->phone, '');
            return "1";
        }
        return "-1";
    }
    /*
     * Update internal notes for a project
     */
    public function updateInternalNotesProject()
    {
        $id = Input::get('ID');
        $project = Project::find($id);
        if($project!=null)
        {
            $notes = Input::get('NOTES');
            $project->internalNotes = $notes;
            $project->save();
            //Create Transaction
            Transaction::createTransaction($this->consultant->id, '', '',"UPDATE-INTERNAL-NOTES-PROJECT", $notes, $id, $project->lead->email, '', '', $project->lead->phone, '');
            return "1";
        }
        return "-1";
    }

    public function updateInventionName()
    {
        $id = Input::get('ID');
        $project = Project::find($id);
        if($project!=null)
        {
            $ideaName = Input::get('INVENTION_NAME');
            $project->ideaName = $ideaName;
            $project->save();
            return "1";
        }
        return "-1";
    }
    /*
     * Update the stage for a project
     */
    public function updateStageProject()
    {
        $id = Input::get('ID');
        $project = Project::find($id);
        if($project!=null)
        {
            $stage = Input::get('STAGE');
            $project->stage = $stage;
            $project->save();
            //Create Transaction
            Transaction::createTransaction($this->consultant->id, '', '',"UPDATE-STAGE-PROJECT", $stage, $id, $project->lead->email, '', '', $project->lead->phone, '');

            //ask if owner is an incubator to change the ownership
            $request = $project->lastRequestToAdmin();
            $adminStage = '';
            if($request != null){
                $adminStage = $request->adminStage;
            }
            if ($adminStage == 'APPROVED' && $project->stage != 'SUBMISSIONS' && $project->stage != 'CONCEPT' && strpos($project->consultant->rol, 'incubator') !== false){
                ToolsFunctions::changeOwnership($project);
                return $id;
            }
            return "-2";
        }
        return "-1";
    }
    /*
     *Create a new request for a Project
     */
    public function requestProject()
    {
        $id = Input::get('ID');
        $project = Project::find($id);
        if($project!=null)
        {
            $request_send = Input::get('REQUEST');
            $type = Input::get('TYPE');
            $request  = new Request();
            $request_find = Request::where(['project_id'=>$id,'consultantStage'=>$request_send,'adminStage'=>''])->first();
            if($request_find!=null)
                $request = $request_find;
            $request->project_id = $id;
            $request->request = $type;
            $request->consultantStage = $request_send;
            $request->save();
            return "1";
        }
        return "-1";
    }
    /*
     *Move a project to specific action date
     */
    public function moveToDateProject()
    {
        $id = Input::get('ID');
        $project = Project::find($id);
        if($project!=null)
        {
            $date = date("Y-m-d H:i:s",strtotime(Input::get('DATE')));
            $project->actionDate = $date;
            $project->save();
            //Create Transaction
            Transaction::createTransaction($this->consultant->id, '', '',"MOVE-DATE-PROJECT", $date, $id, $project->lead->email, '', '', $project->lead->phone, '');
            return "1";
        }
        return "-1";
    }

    /*
     * Mark a project as EXCLUDE
     */
    public function deleteProject()
    {
        $id = Input::get('ID');
        $project = Project::find($id);
        if($project!=null)
        {
            $project->status = 'EXCLUDE';
            $project->save();
            //Create Transaction
            Transaction::createTransaction($this->consultant->id, '', '',"DELETE-PROJECT", '', $id, $project->lead->email, '', '', $project->lead->phone, '');
            return "1";
        }
        return "-1";
    }

    /*
     * Search projects By Params
     */
    public function findProject()
    {
        $leads = Lead::findLead(Input::get('PARAMS'));
        $isMobile = Input::get('MOBILE');
        $projects=array();
        if($leads!="-1")
            foreach($leads as $lead_id)
            {
                $listOfProjects = Project::where('lead_id',$lead_id)->get();
                foreach($listOfProjects as $projectFromLead){
                    if($projectFromLead->consultant_id == $this->consultant->id)
                        $projects[] = $projectFromLead;
                }
            }
        $projectsToLoad=array();
        foreach($projects as $project){
            $projectsToLoad[]=$this->paintProject($project->id,$isMobile);
        }
        echo json_encode($projectsToLoad);
    }

    /*
     * Search all the new projects that aren't loaded yet for the current consultant  and updated to loaded
     */
    public function loadProjects()
    {
        $newProjects = Project::where('consultant_id',$this->consultant->id)->where('status','LIKE','UNLOADED')->get();
        $projectsToLoad=array();
        $isMobile = Input::get('MOBILE');
        $pos = 0;
        foreach($newProjects as $project)
        {
            $projectsToLoad[$pos]['portlet']=$this->paintProject($project->id,$isMobile);
            $projectsToLoad[$pos]['stage']=$project->stage;
            $pos++;

        }
        echo json_encode($projectsToLoad);
        Project::where('status', 'UNLOADED')->where('consultant_id',$this->consultant->id)->update(['status' => 'LOADED']);
    }
    /*
     * Create a portlet from a Project, if the project isn't passed, create it from an ID
     */
    public function paintProject($id,$isMobile)
    {
        $view = ToolsFunctions::curl(url("paintPortlet?ID=$id&MOBILE=$isMobile"));
        return $view;
    }

    /*
     * Restore a project and save the row in assignment.
     */
    public function restoreProject()
    {
        $id = Input::get('ID');
        $project = Project::find($id);
        if($project!=null){
            $project->status = 'RESTORED';
            $project->actionDate = '0000-00-00 00:00:00';
            $project->save();
            //Create Transaction
            Transaction::createTransaction($this->consultant->id, '', '',"RESTORE-PROJECT", '', $id, $project->lead->email, '', '', $project->lead->phone, '');
            return "1";
        }
        return "-1";
    }

    /*
    * Get MSG Templates
    */
    public function getMsgTemplate()
    {
        $cName = $this->consultant->fname." ".$this->consultant->lname;
        $id = Input::get('PROJECT');
        $project = Project::find($id);
        $name = $project->lead->fname." ".$project->lead->lname;
        $messages = Message::where(['type'=>'TEMPLATE','consultant_id'=>0])->get();

        $listMsg = array();
        foreach($messages as $msg){
            $text = str_replace("[name]",$name,$msg->text);
            $text = str_replace("[DID]",$this->consultant->did,$text);
            $text = str_replace("[fileno]",$project->lead->fileno,$text);
            $text = str_replace("[consultant name]",$cName,$text);
            $aux['TEXT'] = $text;
            $aux['TITLE'] = $msg->title;
            $listMsg[] = $aux;
        }
        return json_encode($listMsg);
    }

    /*
     *print business profile for a project
     */
    public function printBusinessProfile()
    {
        $id = Input::get('ID');
        $project = Project::find($id);
        if($project!=null)
        {
            return view('intranet.project.printBusiness',array('project'=>$project));
        }
    }

    /*
     *print project
     */
    public function printProject()
    {
        $id = Input::get('ID');
        $project = Project::find($id);
        if($project!=null)
        {
            return view('intranet.project.printProject',array('project'=>$project));
        }
    }

    //allow funding
    public function allowFundingProject()
    {
        $id = Input::get('ID');
        $project = Project::find($id);
        if($project!=null)
        {
            $request = Input::get('REQUEST');
            $contract_find = $project->lastContractNoWP();
            if($contract_find==null)
                return "-1";
            if($contract_find->type=="IMG"||$contract_find->type=="IGUP")
            {
                if($request=="DISABLED")
                {
                    if($contract_find->paid>0)
                        return "-2";
                    $contract_find->funding = 0;
                    $contract_find->save();
                }
                else if($contract_find->funding == 0)
                {
                    $contract_find->funding = 1;
                    $contract_find->save();
                }
                return "1";
            }
            else if($contract_find->type=="IIG")
            {
                $lastIMG = $project->contracts->where('type','IMG')->first();
                $lastIGUP = $project->contracts->where('type','IGUP')->first();
                if($request=="DISABLED" && $lastIGUP)
                {
                    if($lastIGUP->paid>0)
                        return "-2";
                    $lastIGUP->funding = 0;
                    $lastIGUP->save();
                }
                if($request=="DISABLED" && $lastIMG)
                {
                    if($lastIMG->paid>0)
                        return "-2";
                    $lastIMG->funding = 0;
                    $lastIMG->save();
                }
                else if($lastIGUP)
                {
                    $price_IUGP = $lastIGUP->price;
                    if($lastIMG->paid == 0)
                    {
                        $lastIGUP->delete();
                        $lastIGUP = New Contract();
                    }
                    $lastIGUP->project_id = $id;
                    $lastIGUP->price = $price_IUGP;
                    $lastIGUP->funding = 1;
                    $lastIGUP->type = "IGUP";
                    $lastIGUP->consultant_id = $project->consultant_id;
                    $lastIMG->save();
                }
                else if($lastIMG)
                {
                    $price_IMG = $lastIMG->price;
                    if($lastIMG->paid == 0)
                    {
                        $lastIMG->delete();
                        $lastIMG = New Contract();
                    }
                    $lastIMG->project_id = $id;
                    $lastIMG->price = $price_IMG;
                    $lastIMG->funding = 1;
                    $lastIMG->type = "IMG";
                    $lastIMG->consultant_id = $project->consultant_id;
                    $lastIMG->save();
                }
                else
                {
                    $lastIMG = New Contract();
                    $lastIMG->project_id = $id;
                    $lastIMG->price = 449;
                    $lastIMG->funding = 1;
                    $lastIMG->type = "IMG";
                    $lastIMG->consultant_id = $project->consultant_id;
                    $lastIMG->save();
                }
                return "1";
            }

        }
        return "-3";
    }

    //allow PPA
    public function allowPPAProject()
    {
        $id = Input::get('ID');
        $project = Project::find($id);
        if($project!=null)
        {
            $request = Input::get('REQUEST');
            $contract_find = $project->contractPPA();
            if($request=="DISABLED")
            {
                if($contract_find!="" && $contract_find->paid>0)
                    return "-1";
                $contract_find->delete();
            }
            else if($contract_find=="")
            {
                $contract_find = new Contract();
                $contract_find->project_id = $id;
                $contract_find->consultant_id = $this->consultant->id;
                $contract_find->type = "PPA";
                $contract_find->price = 100000;
                $contract_find->save();
            }
            return "1";
        }
        return "-2";
    }

    //Check the contract actions available for this project
    public function checkContractActionsProject()
    {
        $actions=['contract'=>0,'contract_img'=>0,'upgrade'=>0,'welcome_package'=>0,'upgrade_price'=>0,'extra'=>'','soldIIG'=>0];
        $id = Input::get('ID');
        $project = Project::find($id);
        if($project!=null)
        {
            $now = date('Y-m-d 00:00:00');
            //if Approve contracts available
            $approved_request = $project->requests()->latest()->where(['request'=>'ADMIN','consultantStage'=>'APPROVE','adminStage'=>'APPROVED'])->first();
            if($approved_request!=null)
                $actions['contract']=1;
            //Upgrade contract available & Welcome package available
            $contract_img = $project->contracts()->latest()->where(['type'=>'IMG'])->first();
            $contract_iig = $project->contracts()->latest()->where(['type'=>'IIG'])->first();
            $contract_uimg = $project->contracts()->latest()->where(['type'=>'IGUP'])->first();


            //IMG questions
            if($contract_img!=null && $contract_img->paid>0)
            {
                $actions['contract_img'] = 0;
                $actions['contract'] = 0;
                if($contract_img->paid == $contract_img->price && strlen($contract_img->signed)>0) {
                    $actions['upgrade'] = 1;
                    $actions['upgrade_price'] = $contract_iig != null ? $contract_iig->price - $contract_img->price : 879 - $contract_img->price;
//cambiar 649 por 849
                    $then = new \DateTime($contract_img->paidDate);
                    $then = $then->modify('+7 day')->format('Y-m-d 00:00:00');
                    if($then <= $now)
                        $actions['welcome_package'] = 1;
                }
            }
            elseif($approved_request!=null){
                $actions['contract_img']=1;
            }
            //IIG questions
            if($contract_iig!=null)
            {
                if($contract_iig->paid > 0){
                    $actions['upgrade']=0;
                    $actions['contract']=0;
                    $actions['contract_img'] = 0;
                }
                if($contract_iig->paid == $contract_iig->price && strlen($contract_iig->signed)>0)
                {
                    //allow iig upgrade only if they paid after may 2 (new contract were live)
                    $dateStart = new \DateTime('2016-05-02 00:00:00');
                    $datePaid = new \DateTime($contract_iig->paidDate);
                    if($contract_iig->paid < 1379 && $datePaid > $dateStart){
//cambiar 979 por 1179
                        $actions['soldIIG']=1;
                    }

                    $then = new \DateTime($contract_iig->paidDate);
                    $then = $then->modify('+7 day')->format('Y-m-d 00:00:00');
                    if($then <= $now)
                        $actions['welcome_package']=1;
                }elseif($contract_iig->paid >= 649 && $contract_iig->paid < $contract_iig->price && strlen($contract_iig->signed)>0 && $contract_iig->iigUpgrade>0){
                    $actions['soldIIG']=-1;
                }
            }
            //UIMG questions
            if($contract_uimg!=null)
            {
                if($contract_uimg->paid == $contract_uimg->price && strlen($contract_uimg->signed)>0){
                    $actions['welcome_package']=1;

                    //allow iig upgrade only if they paid after may 2 (new contract were live)
                    $dateStart = new \DateTime('2016-05-02 00:00:00');
                    $datePaid = new \DateTime($contract_uimg->paidDate);
                    if($contract_uimg->paid < 930 && $datePaid > $dateStart){
//cambiar 979 por 1179
                        $actions['soldIIG']=1;
                    }
                }
                if($contract_uimg->paid > 0){
                    $actions['upgrade']=0;
                    $actions['contract'] = 0;
                    $actions['contract_img'] = 0;
                }
            }

        }
        return json_encode($actions);
    }

    //allow IigUpgrade
    public function allowIigUpgrade()
    {
        $checked = Input::get('CHECKED');
        $id = Input::get('ID');
        $project = Project::find($id);

        if($project!=null){
            $contract_iig = $project->contracts()->latest()->where(['type'=>'IIG'])->where('price','>',0)->first();
            if($contract_iig!=null){
                if($checked == 0){
                    $contract_iig->iigUpgrade = 0;
                    $contract_iig->price = $contract_iig->paid;
                }else{
                    $prices = PpaPricesPlan::where('plan1', 'like',$contract_iig->paid)->orWhere('plan2', 'like',$contract_iig->paid)->orWhere('plan3', 'like',$contract_iig->paid)->first();
                    $contract_iig->iigUpgrade = 1;
                    $contract_iig->price = ($contract_iig->paid == $prices->plan1?$prices->plan2:($contract_iig->paid == $prices->plan2)?$prices->plan3:$prices->plan2);
                }
                $contract_iig->save();
                return "1";
            }
            else{
                $contract_igup = $project->contracts()->latest()->where(['type'=>'IGUP'])->first();
                if($contract_igup!=null){
                    if($checked == 0){
                        $contract_igup->iigUpgrade = 0;
                        $contract_igup->price = $contract_igup->paid;
                    }else{
                        $prices = PpaPricesPlan::where('plan1', 'like',$contract_igup->paid)->orWhere('plan2', 'like',$contract_igup->paid)->orWhere('plan3', 'like',$contract_igup->paid)->first();
                        $contract_igup->iigUpgrade = 1;
                        $contract_igup->price = ($contract_igup->paid == $prices->plan1?$prices->plan2:($contract_igup->paid == $prices->plan2)?$prices->plan3:$prices->plan2);
                    }
                    $contract_igup->save();
                    return "1";
                }
            }
        }
        return "-1";
    }


    //Set payment, set all the options to make a payment available
    public function setPaymentProject()
    {
        $id = Input::get('ID');
        $price = Input::get('PRICE');
        $cType = Input::get('CTYPE');
        $project = Project::find($id);
        if($project!=null)
        {
            $contract = $project->contracts()->latest()->where(['type'=>$cType])->first();
            if($contract==null)
            {
                $contract = new Contract();
                $contract->project_id = $id;
                $contract->type = $cType;
            }
            $contract->price = $price;
            $contract->consultant_id = $this->consultant->id;
            $contract->save();
            $project->stage = 'WOM';
            $project->actionDate = '0000-00-00';
            //Create Transaction
            Transaction::createTransaction($this->consultant->id, '', '',"SET-PAYMENT-PROJECT", $price, $id, $project->lead->email, $cType, '', $project->lead->phone, '');
            $project->save();
            return "1";
        }
        return "-1";
    }

    //Set PPA values
    public function setPPAProject()
    {
        $id = Input::get('ID');
        $uType = Input::get('UTYPE');
        $ppaTime = Input::get('TIME');
        $status = Input::get('STATUS');
        $project = Project::find($id);
        if($project!=null){
            if($status == 'NEW'){
                $project->utility = $uType;
                $project->save();
                $pricesPlan = PpaPricesPlan::where(['type'=>$uType,'moment'=>$ppaTime])->first();
                if($pricesPlan!=null){
                    $ppaContract = $project->contractPPA();
                    if($ppaContract!=null){
                        $ppaContract->ppapricesplan_id = $pricesPlan->id;
                        $ppaContract->save();
                    }
                }
                //Create Transaction
                Transaction::createTransaction($this->consultant->id, '', '',"SET-PPA-NEW-PROJECT", 'UPDATE UTILITY AND TIME', $id, $project->lead->email, $uType."_".$ppaTime, '', $project->lead->phone, '');
                return "1";
            }else{
                $ppaContract = $project->contractPPA();
                $ppaContract->signed = 'OLD SIGNED';
                $ppaContract->save();
                return "1";
            }

        }
        return "-1";
    }

    //Allow Half PPA values
    public function allowHalfPricePPAProject()
    {
        $id = Input::get('ID');
        $project = Project::find($id);
        if($project!=null)
        {
            $request = Input::get('REQUEST');
            $contract_find = $project->contractPPA();
            if($contract_find!="")
            {
                if($request=="DISABLED")
                    $contract_find->halfPrice = 0;
                else
                    $contract_find->halfPrice = 1;
                $contract_find->save();
            }

            return "1";
        }
        return "-2";
    }

    //Allow ECHECK payments
    public function allowEcheckPayments()
    {
        $id = Input::get('ID');
        $project = Project::find($id);
        if($project!=null)
        {
            $request = Input::get('REQUEST');
            if($request=="DISABLED")
                $project->echeck = 0;
            else
                $project->echeck = 1;
            $project->save();
            return "1";
        }
        return "-2";
    }

    //reset password and send it to the client
    public function resetPassword()
    {
        $lead = Input::get('LEAD');
        $lead = Lead::find($lead);
        if($lead!=null)
        {
            $lead->password = substr(md5(microtime().rand()), 0, 8);
            $lead->save();

            //Create Transaction
            Transaction::createTransaction($this->consultant->id,  $lead->id, '',"RESTORE-PASSWORD", '', '',  $lead->email, '', '', $lead->phone, '');

            //send the new password by email
            if(Input::get('BYEMAIL') == 'true'){
                mail($lead->email, 'PATENT SERVICES NEW PASSWORD', 'Your new Password is: '.$lead->password);
            }
            //send the new password by text msg
            if(Input::get('BYPHONE') == 'true'){
                PlivoHelper::sendSMS($lead->phone, 'PATENT SERVICES NEW PASSWORD: '.$lead->password);
            }
            return "1";
        }
        return "-1";
    }
    //send an email to george when a consultant got all the information from the client
    public function requestNeedsMoreInfoReview()
    {
        $id = Input::get('ID');
        $request = Request::find($id);
        if($request !=null)
        {
            $project = Project::find($request->project_id);
            if($project!=null)
            {
                $msg = "FILENO = '".$project->lead->fileno."'\nPIN = '".$project->id."'\nThis Project is ready for vendors";
                //mail("george@ownmyinvention.com","Check for vendors",$msg);
                Transaction::createTransaction($this->consultant->id, '', '',"CHECK-FOR-VENDORS", '', $project->id, $project->lead->email, '', '', $project->lead->phone, '');
                return "1";
            }
        }
        return "-1";
    }
    public function requestAnswers()
    {
        $projects = Project::where('consultant_id',$this->consultant->id)->where('lead_id','>',0)->where('status','not like','EXCLUDE')->get();
        $requestStatus=array();
        foreach($projects as $project)
        {
            $request = $project->lastRequestToAdmin();
            if($request!=null && strlen($request->adminStage)>0 && $request->readed == 0)
            {
                $request->readed = 1;
                $request->save();
                $requestStatus[]=array('ID' => $request->id,'PROJECTID'=>$project->id, 'ADMINSTAGE'=>$request->adminStage,"NEEDSMOREINFO"=>$project->pendingNMI,"FILENO"=>$project->lead->fileno);
            }
        }
        echo json_encode($requestStatus);
    }

    public function lastPaidSys(){
        $projects = Project::where('consultant_id',$this->consultant->id)->where('lead_id','>',0)->where('status','not like','EXCLUDE')->get();
        $requestStatus=array();
        foreach($projects as $project){
            if($project->lastContractWithPayment()){
                $contract = $project->lastContractWithPayment();
                if($contract->readed == 0){
                    $contract->readed = 1;
                    $contract->save();
                    $requestStatus[]=array('PROJECTID'=>$project->id, 'CTYPE'=>$contract->type,"PRICE"=>money_format("%i",$contract->paid));
                }
            }
        }
        echo json_encode($requestStatus);
    }

    public function updateLogsProject(){
        $id = Input::get('ID');
        $project = Project::find($id);
        if($project!=null){
             echo json_encode($project->lastTransactions());
        }
    }

    public function getProductionDates(){
        $id = Input::get('ID');
        $project = Project::find($id);
        if($project!=null){
            $projectProduction = $project->getProjectProduction();
            if($projectProduction!=null) {
                $text = "Schedule Date: ".($projectProduction->scheduleDate != '0000-00-00 00:00:00'?date('m-d-Y',strtotime($projectProduction->scheduleDate)):'00-00-0000')."\nShipping Date: ".($projectProduction->shippingDate != '0000-00-00 00:00:00'?date('m-d-Y',strtotime($projectProduction->shippingDate)):'00-00-0000')."\n";
                $text .= "<br><a target='_blank' href='files/projects/".$project->lead->fileno."/".$project->id."/production/Coversheet.pdf'>Production Coversheet</a>";
                return json_encode($text);
            }
        }
        $text = "We can not find the info you are looking for.";
        return json_encode($text);
    }



}
