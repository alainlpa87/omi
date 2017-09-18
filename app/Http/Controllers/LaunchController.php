<?php namespace App\Http\Controllers;

use App\Helpers\CreateContractSignedHelper;
use App\Helpers\DocusignFunctions;
use App\Helpers\ToolsFunctions;
use App\Models\Article;
use App\Models\Assignment;
use App\Models\AttClientServices;
use App\Models\ClientSNotes;
use App\Models\Consultant;
use App\Models\Contract;
use App\Models\IlcNotes;
use App\Models\Inbox;
use App\Models\Lead;
use App\Models\Ilc;
use App\Models\Message;
use App\Models\PaymentTransaction;
use App\Models\PpaPricesPlan;
use App\Models\Project;
use App\Models\ProjectProduction;
use App\Models\Reply;
use App\Models\Transaction;
use App\Models\UploadedFiles;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use DB;
use Illuminate\Support\Facades\Session;

class LaunchController extends Controller {

    /*
     * Current Consultant logged
     */
    public $client;
    /*
     * To Allow use the controller methods the current user logged has to be Client
     */
    public function __construct()
    {
        $this->middleware('client');
        $this->middleware(function ($request, $next) {
            $this->client = Lead::find(Session::get('user_id'));
            return $next($request);
        });
    }
    /*
     * Send to the index view the
     *
     * @return Response
     */
    public function index()
    {
        $inbox_profile =0;
        $inbox_project =0;
        //to know if allow manage tickets
        $allowTickets =0;
        $projects = Project::where('lead_id',$this->client->id)->get();
        foreach($projects as $project){
            $lastContract = $project->lastContractNoWP();
            if($lastContract!=null)
            {
                if($project->lastContractPaid() != null)
                {
                    if(strlen($project->lastContractPaid()['SIGN']) >0) {
                        $allowTickets=1;
                        break;
                    }
                }else if($project->lastContractWithPayment() != null && $project->lastContractWithPayment()->iigUpgrade == 1){
                    $allowTickets=1;
                    break;
                }

            }
        }

        return view('omi.launch.index',array('client'=>$this->client,'allowTickets'=>$allowTickets,'showProfile' => $inbox_profile,'showProject' => $inbox_project));
    }
    //load profile view
    public function profile()
    {
        return view('omi.launch.profile',array('client'=>$this->client));
    }
    //updated client profile information
    public function updateDataLead()
    {
        $fname = Input::get('FNAME');
        $lname = Input::get('LNAME');
        $phone = (Input::get("PHONE") != "")?str_pad(preg_replace('/\D+/', '', Input::get("PHONE")), 11, '1', STR_PAD_LEFT):"";
        $phone2 = (Input::get("PHONE2") != "")?str_pad(preg_replace('/\D+/', '', Input::get("PHONE2")), 11, '1', STR_PAD_LEFT):"";
        $email = strtolower(Input::get('EMAIL'));
        $street = trim(Input::get('STREET'));
        $city = trim(Input::get('CITY'));
        $state =trim( Input::get('STATE'));
        $zip = Input::get('ZIP');
        $complete = Input::get('COMPLETE');
        $country = trim(Input::get('COUNTRY'));
        $birth = Input::get('BIRTH');
        $spouse = trim(Input::get('SPOUSE'));
        $children = trim(Input::get('CHILDREN'));
        $college =trim( Input::get('COLLEGE'));
        $degree = trim(Input::get('DEGREE'));
        $profession = trim(Input::get('PROFESSION'));
        $hobby = trim(Input::get('HOBBY'));

        $this->client->fname = $fname;
        $this->client->lname = $lname;
        $this->client->phone = $phone;
        $this->client->phone2 = $phone2;
        $this->client->email = $email;
        if($complete)
        {
            $dateBirth = new \DateTime($birth);
            $dateBirth = new \DateTime($dateBirth->format("Y-m-d"));
            if ($street != '') {
                $this->client->street = $street;
            }
            if ($city != '') {
                $this->client->city = $city;
            }
            if ($state != '') {
                $this->client->state = $state;
            }
            if ($zip != '') {
                $this->client->zip = $zip;
            }
            if ($country != '') {
                $this->client->country = $country;
            }
            if ($dateBirth != '') {
                $this->client->birth = $dateBirth;
            }
            if ($spouse != '') {
                $this->client->spouse = $spouse;
            }
            if ($children != '') {
                $this->client->children = $children;
            }
            if ($college != '') {
                $this->client->college = $college;
            }
            if ($degree != '') {
                $this->client->degree = $degree;
            }
            if ($profession != '') {
                $this->client->profession = $profession;
            }
            if ($hobby != '') {
                $this->client->hobby = $hobby;
            }
        }
        $this->client->save();

        //Create Transaction
        Transaction::createTransaction($this->client->consultant_id, $this->client->id, '', 'UPDATE-PERSONAL-INFO-LAUNCH', '', '', $this->client->email, '', '', $this->client->phone, '');
        return "1";
    }

    //load project view
    public function loadProject($id)
    {
        $project = Project::find($id);
        //If project exists and belongs to the lead show it, else go to launch page
        if($project!=null && $project->lead_id == $this->client->id)
        {
            //a project needs to be sign if the price was reach it but the client hasn't sign yet
            //a project allows payment once that exists a contract for it, and the price hasn't reach it yet and
            //the stage of the project is one of the stages shows below and the action date for it is before or today
            $needSign=0;
            $paymentAvailable=0;
            $allowQuestions=0;
            $allowPpaPlans=0;

            $lastContract = $project->lastContractNoWP();
            if($lastContract!=null)
            {
                if($project->lastContractPaid() != null)
                {
                    if(strlen($project->lastContractPaid()['SIGN']) == 0)
                        $needSign=1;
                    else
                        $allowQuestions=1;
                }else if($project->lastContractWithPayment() != null && $project->lastContractWithPayment()->iigUpgrade == 1){
                    $allowQuestions=1;
                }
                if($lastContract->type=="PPA"){
                    if($lastContract->signed == "1"){
                        $needSign=1;
                    }
                    if($lastContract->ppaTotalPrice() > $lastContract->paid || $lastContract->paid == 0){
                        $paymentAvailable=1;
                    }
                }else{
                    if($lastContract->paid<$lastContract->price){
                        $paymentAvailable=1;
                    }
                }
                $aux_plans = explode(',',$lastContract->ppaPlans);
                if(count($aux_plans)>0 && $aux_plans[0] != '' && $lastContract->paid == $lastContract->price && $lastContract->type=="PPA" && $lastContract->ppapricesplan_id != 0 && $lastContract->ppapricesplan_id < 5 && ($project->utility == "U_D" || $project->utility == "Utility" || $project->utility == "IMG"))
                {
                    $allowPpaPlans=1;
                }
            }
            $clientRequests = $project->requests->where('request','CLIENT')->where('consultantStage','CLIENT REVIEW')->where('adminStage','')->count();
            //docs legals to sign like ddr psa copyright trademark poa declaration add_declaration microentity
            $docsToSign = -1;
            $upLetterSign = -1; // and the upgrade letter pct epo
            $upgLetterPCTSign =-1;
            $provInvoiceSign = -1; // and the provisional invoice
            $ilcNeedSign = -1; // and the ilc marketing agreement
            if($project->coInventor== "")
                $coInvCount = 0;
            else
                $coInvCount = count(explode(',',$project->coInventor));
            $pCS = $project->clientServicesProject();
            $ilcInfo = array();
            $ilcInfo['exist']=-1;
            if($pCS !=null) {
                foreach ($pCS->getDocsCS() as $doc) {
                    if ($doc->name == 'add_declaration' && $coInvCount == 0)
                        continue;
                    $docsToSign = 1;
                }
                if($pCS->agreementExt_sent!='0000-00-00 00:00:00' && $pCS->agreementExt_rcvd =='0000-00-00 00:00:00')
                    $docsToSign = 1;
                // if the upgrade letter was sent it but still dont signed
                $upgLettFile = UploadedFiles::where('project_id', $pCS->project_id)->where('fileName', 'upgradeLetter.pdf')->first();
                if ($pCS->pctEpoAlert == 1 && $upgLettFile == null)
                    $upLetterSign = 1;
                // if the upgrade letter (only pct) was sent it but still dont signed
                $upgLettPCTFile = UploadedFiles::where('project_id', $pCS->project_id)->where('fileName', 'upgradeLetterPCT.pdf')->first();
                if ($pCS->pctEpoAlert == 1 && $upgLettPCTFile == null)
                    $upgLetterPCTSign = 1;
                // if the provInvoice was sent but still dont signed
                $provInvFile = UploadedFiles::where('project_id', $pCS->project_id)->where('fileName', 'provInvoice.pdf')->first();
                if ($pCS->provAlert == 1 && $provInvFile == null)
                    $provInvoiceSign = 1;
                // if the ilc was sent it but still dnt signed
                if($pCS->marketingAgrSent_created_at!="" && $pCS->marketingAgrReceived_created_at == "" && $pCS->releaseFormReceived_created_at == "")
                    $ilcNeedSign=1;
                // if the ilc patented contract was sent it but still dnt signed
                $ilc = Ilc::where('projectclientservices_id',$pCS->id)->first();
                if($ilc!=null && $ilc->patentedContractSentDate!="0000-00-00 00:00:00" && $ilc->patentedContractRcvdDate == "0000-00-00 00:00:00")
                    $ilcNeedSign=1;

                //pct psa
                $pctPSAFile = UploadedFiles::where('project_id', $pCS->project_id)->where('fileName', 'PCT_PSA_signed.pdf')->first();
                if ($pCS->pctPsaSent_create_at != "0000-00-00 00:00:00" && $pctPSAFile == null) //&& $pCS->pctPsaRcvd_create_at == "0000-00-00 00:00:00"
                    $upgLetterPCTSign = 1;

                //Create Transaction
                Transaction::createTransaction('', '', '',"CLIENT-LOGIN-CS_UPDATE-VISITED", '', $project->id, $project->lead->email, '', '', $project->lead->phone, '');

                /////////////////////////////////ILC Tab
                ///////////////////////////////////////////////////////
                ///////to know if have ilc and get the info////////////
                $ilc = Ilc::where('projectclientservices_id',$pCS->id)->first();
                if($ilc != null){
                    $ilcInfo['exist']=1;
                    $ilcInfo['contractDate']= date('m-d-y',strtotime($ilc->agreementStartDate));
                    if($ilc->welcomePckgSentDate != '0000-00-00 00:00:00'){
                        $ilcInfo['welcomePkcg'] = date('m-d-y',strtotime($ilc->welcomePckgSentDate));
                        $file_aux = UploadedFiles::where('project_id',$pCS->project_id)->where('fileName','like',$ilc->fileno."_emailWelcomePckgILC%")->first();
                        if($file_aux != null)
                            $ilcInfo['welcomePackEmail'] =$file_aux->url;
                        else
                            $ilcInfo['welcomePackEmail'] =-1;
                    }
                    else
                        $ilcInfo['welcomePkcg'] = -1;
                    if(!(strpos($ilc->introCallDate, '00:00:00')!== false))
                        $ilcInfo['introCall'] = date('m-d-y',strtotime($ilc->introCallDate));
                    else
                        $ilcInfo['introCall'] = -1;
                    $aux_note = IlcNotes::where('ilc_id',$ilc->id)->where('notes','Intro Call Email sent.')->first();
                    if($aux_note !=null){
                        $ilcInfo['introCallEmail'] = date('m-d-y',strtotime($aux_note->created_at));
                        $file_aux = UploadedFiles::where('project_id',$pCS->project_id)->where('fileName','like',$ilc->fileno."_emailIntroCallILC%")->first();
                        if($file_aux != null)
                            $ilcInfo['introCallILCEmail'] =$file_aux->url;
                        else
                            $ilcInfo['introCallILCEmail'] =-1;
                    }
                    else
                        $ilcInfo['introCallEmail'] = -1;
                    $ilcInfo['courtesyUpdate'] = -1;
                    $aux_notes = IlcNotes::where('ilc_id',$ilc->id)->where('notes','like','Courtesy email sent to client%')->get();
                    if($aux_notes !=null) {
                        $courtesies = [];
                        foreach ($aux_notes as $aux_note) {
                            $auxArray = explode('file ',$aux_note->notes);
                            if(count($auxArray) > 1){
                                $fname = $auxArray[1];
                                $file_aux = UploadedFiles::where('project_id',$pCS->project_id)->where('fileName','like',"%".$fname."%")->first();
                                if($file_aux != null)
                                    $courtesies[]=array(date('m-d-y',strtotime($aux_note->created_at)),$file_aux->url);
                                else
                                    $courtesies[]=array(date('m-d-y',strtotime($aux_note->created_at)),-1);
                            }
                            else
                                $courtesies[]=array(date('m-d-y',strtotime($aux_note->created_at)),-1);

                        }
                        $ilcInfo['courtesyUpdate'] = $courtesies;
                    }
                    if($ilc->website_codes != '0000-00-00 00:00:00')
                        $ilcInfo['website'] = date('m-d-y',strtotime($ilc->website_codes));
                    else
                        $ilcInfo['website'] = -1;
                    $aux_notes = IlcNotes::where('ilc_id',$ilc->id)->where('notes','like','Submission emailed to client%')->get();
                    if($aux_notes !=null) {
                        $subs=[];
                        foreach ($aux_notes as $aux_note) {
                            $auxArray = explode('email saved in ',$aux_note->notes);
                            if(count($auxArray) > 1){
                                $fname = $auxArray[1];
                                $file_aux = UploadedFiles::where('project_id',$pCS->project_id)->where('fileName','like',"%".$fname."%")->first();
                                if($file_aux != null)
                                    $subs[]=array(date('m-d-y',strtotime($aux_note->created_at)),$file_aux->url);
                                else
                                    $subs[]=array(date('m-d-y',strtotime($aux_note->created_at)),-1);
                            }else
                                $subs[]=array(date('m-d-y',strtotime($aux_note->created_at)),-1);
                        }
                        $ilcInfo['subEmail'] = $subs;
                    }
                    else
                        $ilcInfo['subEmail'] = -1;
                    if($ilc->separationDate != '0000-00-00 00:00:00'){
                        $ilcInfo['separationDate'] = date('m-d-y',strtotime($ilc->separationDate));
                        $aux_note = IlcNotes::where('ilc_id',$ilc->id)->where('notes','like','Separation%')->first();
                        switch($aux_note->notes){
                            case "Separation letter utility abandoned sent.":
                                $ilcInfo['separationType'] = 'YOU RECEIVED A SEPARATION LETTER ON :';
                                break;
                            case "Separation letter client request sent.":
                                $ilcInfo['separationType'] = "YOU RECEIVED A SEPARATION LETTER ON :";
                                break;
                            case "Separation letter provisional sent.":
                                $ilcInfo['separationType'] = "YOU RECEIVED A SEPARATION LETTER ON :";
                                break;
                            case "Separation letter utility sent.":
                                $ilcInfo['separationType'] = "YOU RECEIVED A SEPARATION LETTER ON :";
                                break;
                            default:
                                break;
                        }
                        $file_aux = UploadedFiles::where('project_id',$pCS->project_id)->where('fileName','like',$ilc->fileno."_emailSeparationLetter%")->first();
                        if($file_aux != null)
                            $ilcInfo['separationFile'] =$file_aux->url;
                        else
                            $ilcInfo['separationFile'] =-1;
                    }
                    else
                        $ilcInfo['separationDate'] = -1;
                }
            }

            $updateEmails = Transaction::where('transtype','UPDATE_EMAIL_PATENT_APP_SENT_TO_CLIENT')->where('project_id',$id)->orderBy('created_at','ASC')->get();
            $updateAfterYearEmails = Transaction::where('transtype','UPDATE_EMAIL_PATENT_APP_AFTER_YEAR_SENT_TO_CLIENT')->where('project_id',$id)->orderBy('created_at','ASC')->get();
            $allowTickets =$allowQuestions;

            //letter of engagement available in production
            $letterOfEngagement = 0;
            $projectP = ProjectProduction::where('project_id','=',$project->id)->where('typeVendor','=','production')->where('attorney_id','!=','0')->where('letterofengagement','=','1')->first();
            if($projectP != null)
                $letterOfEngagement = 1;

            return view('omi.launch.project',array('letterOfEngagement'=>$letterOfEngagement,'client'=>$this->client,'allowTickets'=>$allowTickets,'project'=>$project,'needSign'=>$needSign,'allowPayment'=>$paymentAvailable,'allowPpaPlans'=>$allowPpaPlans,'allowQuestions'=>$allowQuestions,'notesApproval'=>$clientRequests,'contract'=>$lastContract,'docsToSign'=>$docsToSign,'upLetterSign'=>$upLetterSign,'ilcNeedSign'=>$ilcNeedSign,'provInvoiceSign'=>$provInvoiceSign,'upgLetterPCTSign'=>$upgLetterPCTSign,'updateEmails'=>$updateEmails,'updateAfterYearEmails'=>$updateAfterYearEmails,'ilcInfo'=>$ilcInfo));
        }
        else
            return redirect('launch');
    }

    //add PPA plan From launch center
    public function addPlan(){
        $contractId = Input::get('contractId');
        $plan = Input::get('selectPlan');

        $contract = Contract::find($contractId);
        if($contract != null){
            $project = $contract->project;
            if($project != null){
                $plans = explode(',',$contract->ppaPlans);
                $aux_plans = array();
                if(!in_array($plan,$plans)) {

                    $field = 'plan'.$plan;
                    $amount = PpaPricesPlan::find($contract->ppapricesplan_id)->$field;
                    $contract->price = $contract->price + $amount;

                    //split plans like 1,3,5
                    for ($i = 1; $i < 7; $i++) {
                        if (in_array($i, $plans)) {
                            $aux_plans[$i] = true;
                        }
                        elseif($i == $plan){
                            $aux_plans[$i] = true;
                        }
                        else {
                            $aux_plans[$i] = false;
                        }
                    }

                    $planList = '';
                    //add new plan like 1,3,'4',5
                    for ($i = 1; $i < 7; $i++) {
                        if ($aux_plans[$i] == true) {
                            $planList .= strlen($planList) > 0 ? "," : "";
                            $planList .= $i;
                        }
                    }

                    //update PPA plans
                    $contract->ppaPlans = $planList;
                    $contract->save();

                    //update PPA contract
                    /*se kito pk ya los contracts son firmados en docusign y no podemos generarlo automatico y se agrego este transaction para saber que se hizo esta accion*/
                    Transaction::createTransaction($project->consultant_id, $project->lead->id, '', 'CLIENT-ADD-PLAN-PPA', $field, '', $project->lead->email, '', '', $project->lead->phone, '');
                    //End update PPA contract

                    return view('omi.payment.index', array('project' => $project, 'contract' => $contract, 'client' => $this->client));
                }
            }
        }
        return view('omi.launch.index',array('client'=>$this->client,'showProfile' => 0,'showProject' => 0));
    }

    //updated client profile information
    public function updateDataProject()
    {
        $ideaName = Input::get('IDEANAME');
        $descriptionExtra = Input::get('DESCRIPTION');
        $id = Input::get('ID');
        $type = Input::get('TYPE');
        $hisIdea = trim(Input::get('HISIDEA'));
        $similar = trim(Input::get('SIMILARPRODUCT'));
        $probIdea =trim( Input::get('PROBIDEA'));
        $descIdea = trim(Input::get('DESCIDEA'));
        $uniIdea = trim(Input::get('UNIIDEA'));
        $payIdea = trim(Input::get('PAYIDEA'));
        $techField = trim(Input::get('TECHFIELD'));
        $costSpend =trim( Input::get('COSTSPEND'));
        $targetMarket = trim(Input::get('TARGETMARKET'));
        $modifications = trim(Input::get('MODIFICATIONS'));
        $environment =trim( Input::get('ENVIRONMENT'));
        $device =trim( Input::get('DEVICE'));
        $addNotes = trim(Input::get('ADDNOTES'));
        $complete = Input::get('COMPLETE');

        $project = Project::find($id);
        if($project!=null)
        {
            $project->ideaName = $ideaName!="" ? $ideaName : $project->ideaName;
            if(strlen($project->ideaConcept)>0)
                $project->ideaConcept .=(strlen($descriptionExtra)>0?"<br><br>$descriptionExtra":"");
            else
                $project->ideaConcept =$descriptionExtra;
            if($complete)
            {
                $project->hisIdea = $type==2?(strlen($hisIdea)>0?$hisIdea:$project->hisIdea):$hisIdea;
                $project->similarProduct = $type==2?(strlen($similar)>0?$similar:$project->similarProduct): $similar;
                $project->probIdea = $type==2?(strlen($probIdea)>0?$probIdea:$project->probIdea): $probIdea;
                $project->descIdea= $type==2?(strlen($descIdea)>0?$descIdea:$project->descIdea):$descIdea;
                $project->uniIdea = $type==2?(strlen($uniIdea)>0?$uniIdea:$project->uniIdea):$uniIdea;
                $project->payIdea = $type==2?(strlen($payIdea)>0?$payIdea:$project->payIdea):$payIdea;
                $project->techField = $type==2?(strlen($techField)>0?$techField:$project->techField):$techField;
                $project->costSpend= $type==2?(strlen($costSpend)>0?$costSpend:$project->costSpend):$costSpend;
                $project->targetMarket = $type==2?(strlen($targetMarket)>0?$targetMarket:$project->targetMarket):$targetMarket;
                $project->modifications = $type==2?(strlen($modifications)>0?$modifications:$project->modifications):$modifications;
                $project->environment = $type==2?(strlen($environment)>0?$environment:$project->environment):$environment;
                $project->device = $type==2?(strlen($device)>0?$device:$project->device):$device;
                $project->addNotes = $type==2?(strlen($addNotes)>0?$addNotes:$project->addNotes):$addNotes;
            }
            $project->save();
            if($type==1)
            {
                //Create Transaction
                Transaction::createTransaction($this->client->consultant_id, '', '', 'UPDATE-PROJECT-INFO-LAUNCH', '', $id, $this->client->email, '', '', $this->client->phone, '');
                return "1";
            }
            //Create Transaction
            Transaction::createTransaction($this->client->consultant_id, '', '', 'UPDATE-PROJECT-INFO-LAUNCH-AUTOMATIC', '', $id, $this->client->email, '', '', $this->client->phone, '');
            return "2";
        }
        return "-1";
    }

    //updated client project inventor profile information
    public function updateDataInventor(){
        $id = Input::get('ID');
        $coinventor = trim(Input::get('COINVENTOR'));
        $coinventorRelation = trim(Input::get('COINVENTORRELATION'));
        $occupation = trim(Input::get('OCCUPATION'));
        $tpaContact = Input::get('TPACONTACT');
        $patentSearch = Input::get('PATENTSEARCH');
        $patented = Input::get('PATENTED');
        $project = Project::find($id);

        if($project!=null)
        {
            $project->coinventor = $coinventor;
            $project->coinventorRelation = $coinventorRelation;
            $project->tpaContact = $tpaContact;
            $project->patentSearch = $patentSearch;
            $project->patented = $patented;
            $project->save();

            $lead = $project->lead;
            $lead->occupation = $occupation;
            $lead->save();

            //Create Transaction
            Transaction::createTransaction($this->client->consultant_id, '', '', 'UPDATE-PROJECT-INFO-INVENTORS-LAUNCH', '', $id, $this->client->email, '', '', $this->client->phone, '');
            return "1";
        }
        return "-1";
    }
    //updated consultant request for approval
    public function updateApprovalNotes()
    {
        $id = Input::get('ID');
        $notes = trim(Input::get('NOTES'));
        $project = Project::find($id);
        if($project!=null)
        {
            if(strlen($project->ideaConcept)>0)
                $project->ideaConcept .=(strlen($notes)>0?"<br><br>$notes":"");
            else
                $project->ideaConcept =$notes;
            $project->approvalNotes="";
            $project->save();

            //create mesg to consultant to let him know
            $msgInbox = "Inventor approves the information.\r\n";
            $msgInbox .= date("m-d-Y H:i:s")."\r\n";
            $msgInbox .= "File #:".$project->lead->fileno."\r\n";
            $msgInbox .= "Pin: ".$project->id."\r\n";
            $msgInbox .= "Client: ".$project->lead->fname." ".$project->lead->lname."\r\n";
            Inbox::createInbox($project->lead->id, $project->consultant_id, $msgInbox, 'CLIENT TEXT', 'CLIENT');

            $clientRequest = $project->requests->where('request','CLIENT')->where('consultantStage','CLIENT REVIEW')->where('adminStage','')->first();
            $clientRequest->adminStage="APPROVED";
            $clientRequest->save();
            Transaction::createTransaction($this->client->consultant_id, '', '', 'CLIENT-APPROVAL-NOTES-APPROVED-LAUNCH', '', $id, $this->client->email, '', '', $this->client->phone, '');
            return "1";
        }
        return "-1";
    }


/***********************sign contracts and make payments*********************************/

    //sign contract after is paid from project view
    public function signContract($id)
    {
        $project = Project::find($id);
        //If project exists and belongs to the lead show it, else go to launch page
        if($project!=null && $project->lead_id == $this->client->id)
        {
            $contract = Contract::where(array('project_id'=>$project->id,'signed'=>''))->where('type','NOT LIKE','WP')->whereRaw('price = paid')->first();
            if($contract!=null)
            {
                //Create Transaction
                Transaction::createTransaction($this->client->consultant_id, $this->client->id, '', 'CONTRACT-VISITED', '', $project->id, $this->client->email, '', '', $this->client->phone, '');

                //send the different price of the plans
                $prices = PpaPricesPlan::where('plan1', 'like',$contract->price)->orWhere('plan2', 'like',$contract->price)->orWhere('plan3', 'like',$contract->price)->first();
                return view('omi.launch.sign',array('prices'=>$prices,'client'=>$this->client,'project'=>$project,'contract'=>$contract,'from'=>'sign'));
            }else{
                $contract = Contract::where(array('project_id'=>$project->id,'signed'=>'1','type'=>'PPA'))->first();
                if($contract!=null){
                    //Create Transaction
                    Transaction::createTransaction($this->client->consultant_id, $this->client->id, '', 'CONTRACT-PPA-VISITED', '', $project->id, $this->client->email, '', '', $this->client->phone, '');
                    return view('omi.launch.sign', array('client' => $this->client, 'project' => $project, 'contract' => $contract, 'from' => 'signPPA', 'ContractType' => ($project->utility != ''?$project->utility:'IMG')));
                }
            }
        }
        return redirect('launch');
    }

    //sign contract from sign view
    public function prepareDocusignContract()
    {
        $contract_id = Input::get('ID');
        $contract = Contract::find($contract_id);
        $signPos = [100,155,3,350,205];
        if ($contract != null && $contract->project->lead_id == $this->client->id) {

            //prepare contract to docusign
            if(Input::has("newPrice_hidden1")){
                /*this is before payment*/
                $newPrice = Input::get('newPrice_hidden1');
                $fileUrl = CreateContractSignedHelper::prepareContractForDocusign($contract,$newPrice);
                $redirectUrl = "launch/afterSign";

                //update contract with new price
                $contract->iigUpgradePrice = $newPrice - $contract->paid;
                $contract->price = $newPrice;
                $contract->save();
            }elseif(Input::has("contract_type_hidden")){

                /*this is for PPA contract*/
                $contractTypeBlade = Input::get('contract_type_hidden');

                $plans = [];
                $plansToSave = '';

                for ($i = 1; $i < 13; $i++) {
                    $plan = Input::get('hidden_plan'.$i);
                    $plans[] = $plan;
                    if($plan == 'true'){
                        $plansToSave .= strlen($plansToSave) > 0 ? "," : "";
                        $plansToSave .= $i;
                    }
                }

                $contract->ppaPlans= $plansToSave;
                $contract->save();

                $fileUrl = CreateContractSignedHelper::preparePPAContractForDocusign($contract,$contractTypeBlade,$plans);
                $redirectUrl = "launch/afterSignPpa";

                switch($contractTypeBlade){
                    case 'U_D':
                        $signPos = [100,350,10,370,400];
                        break;
                    case 'Utility':
                        $signPos = [100,350,8,370,400];
                        break;
                    case 'IMG':
                        $signPos = [100,250,8,370,302];
                        break;
                }
            }else{
                /*this is after payment was made*/
                $fileUrl = CreateContractSignedHelper::prepareContractForDocusign($contract,$contract->paid);
                $redirectUrl = "launch/successDocusign";
            }


            //redirect to docusign to be signed
            $recipientName = ucwords($contract->project->lead->fname." ".$contract->project->lead->lname);
            $recipientEmail = $contract->project->lead->email;
            DocusignFunctions::docuSignWithDoc($recipientName,$recipientEmail,$fileUrl,$contract->id,$redirectUrl,$signPos);
        }
        return redirect('launch');
    }

    //sign contract before Paid from project view
    public function signBeforePaid($id)
    {
        $project = Project::find($id);
        //If project exists and belongs to the lead show it, else go to launch page
        if($project!=null && $project->lead_id == $this->client->id)
        {
            $contract = $project->lastContractNoWP();
            if($contract!=null)
            {
                //Create Transaction
                Transaction::createTransaction($this->client->consultant_id, $this->client->id, '', 'CONTRACT-VISITED', '', $project->id, $this->client->email, '', '', $this->client->phone, '');
                //send the different price of the plans
                $prices = PpaPricesPlan::where('plan1', 'like',$contract->price)->orWhere('plan2', 'like',$contract->price)->orWhere('plan3', 'like',$contract->price)->first();
                return view('omi.launch.sign',array('prices'=>$prices,'client'=>$this->client,'project'=>$project,'contract'=>$contract,'from'=>'signBeforePaid','ContractType'=>($project->utility != ''?$project->utility:'IMG')));
            }
        }
        return redirect('launch');
    }

    //no se donde se usa
    public function success()
    {
        $contract_id = Input::get('ID');
        $contract = Contract::find($contract_id);
        if($contract !=null && $contract->project->lead_id == $this->client->id)
        {
            return view('omi.payment.success', array('project' => $contract->project, 'contract' => $contract, 'client' => $this->client,'complete'=>1));
        }
        return redirect('launch');
    }

/***********************sign contracts and make payments*********************************/


    public function signLetterOfEngagement($id){
        $project = Project::find($id);
        $projectProd = $project->getProjectProduction();
        if($projectProd != null){
            $fileUrl = CreateContractSignedHelper::prepareLetterOfEngForDocusign($project,$projectProd);
            $redirectUrl = "launch/afterSignLetterOfEng";
            if($fileUrl != ""){
                $recipientName = ucwords($project->lead->fname." ".$project->lead->lname);
                $recipientEmail = $project->lead->email;
                DocusignFunctions::docuSignWithDoc($recipientName,$recipientEmail,$fileUrl,$id,$redirectUrl,[100,260,2,350,310]);
            }
        }
        return redirect(url('launch/project/'.$project->id));
    }


    //change password
    public function changePassword()
    {
        $consultant_id = Input::get('LEAD');
        $old = Input::get('OLD');
        $new = Input::get('NEW');

        $lead = Lead::find($consultant_id);
        if($lead!=null && $lead->password == $old){
            $lead->password = $new;
            $lead->save();
            return "1";
        }
        return "-1";
    }

    //show docs to sign in client services
    public function showDocsCS($id)
    {
        $project = Project::find($id);
        //If project exists and belongs to the lead show it, else go to launch page
        if($project!=null && $project->lead_id == $this->client->id){
            $allDocsSigned =1; //to know if the docs of the paten app package was signed or not
            $docs_signed = array('type'=>'NA' ,'dec'=>1,'poa'=>1,'add_dec'=>1,'microEntity'=>1); //array to know which doc was signed and which dnt
            $urlsPA = array();
            $upFils = array();
            $pCS = $project->clientServicesProject();

            //to know how many coInv have the project
            $coInvs = explode(',',$project->coInventor);
            if($project->coInventor== "")
                $coInvCount = 0;
            else
                $coInvCount =count($coInvs);

            if($pCS!=null) {
                $showApp = 'na';
                $docsAppNotSign = $pCS->getDocsApp();
                if (count($docsAppNotSign) > 0 && substr($docsAppNotSign[0]['name'], -1) == "D")
                    $showApp = 'DESIGN';
                elseif (count($docsAppNotSign) > 0 && substr($docsAppNotSign[0]['name'], -1) == "U")
                    $showApp = 'UT';
                elseif (count($docsAppNotSign) > 0 && substr($docsAppNotSign[0]['name'], -1) == "P")
                    $showApp = 'PROV';
                //case patent app design
                if ($showApp == 'DESIGN' || ($pCS->appSentD_created_at != '0000-00-00 00:00:00' && $pCS->patentAppApprovedD_created_at == '0000-00-00 00:00:00')) {
                    //to get the url of the patent app
                    $upFils = UploadedFiles::where('project_id', $id)->where('fileName', "like", 'PAD_%')->get();
                    $docs_signed['type'] = 'PAD';
                    foreach ($docsAppNotSign as $doc) {//getDocsCS return the files with file_id -1 what it means is not signed
                        if ($doc->name == "addDeclarationD" && $coInvCount == 0)
                            continue;
                        switch ($doc->name) {
                            case "declarationD":
                                $allDocsSigned = -1;
                                $docs_signed['dec'] = -1;
                                break;
                            case "addDeclarationD":
                                $allDocsSigned = -1;
                                $docs_signed['add_dec'] = -1;
                                break;
                            case "poaD":
                                $allDocsSigned = -1;
                                $docs_signed['poa'] = -1;
                                break;
                            case "microEntityD":
                                $allDocsSigned = -1;
                                $docs_signed['microEntity'] = -1;
                                break;
                            default:
                                break;
                        }
                    }
                }
                elseif ($pCS->hasType('PROV') && !$pCS->hasType('UPG_UT') && $showApp == 'PROV') {//case patent app is prov
                    $upFils = UploadedFiles::where('project_id', $id)->where('fileName', "like", 'PROV_%')->get();
                    $docs_signed['type'] = 'PROV';
                    foreach ($pCS->getDocsCS() as $doc) {//getDocsCS return the files with file_id -1 what it means is not signed
                        if ($doc->belong_PA == 1) {
                            switch ($doc->name) {
                                case "microEntityP":
                                    $allDocsSigned = -1;
                                    $docs_signed['microEntity'] = -1;
                                    break;
                            }
                        }
                    }
                }
                elseif ($showApp == 'UT' || ($pCS->appSent_created_at != '' && $pCS->patentAppApproved_created_at == '')) {// case patent app is utility
                    $upFils = UploadedFiles::where('project_id', $id)->where('fileName', "like", 'PAU_%')->get();
                    $docs_signed['type'] = 'PAU';
                    foreach ($docsAppNotSign as $doc) {//getDocsCS return the files with file_id -1 what it means is not signed
                        if ($doc->name == "addDeclarationU" && $coInvCount == 0)
                            continue;
                        switch ($doc->name) {
                            case "declarationU":
                                $allDocsSigned = -1;
                                $docs_signed['dec'] = -1;
                                break;
                            case "addDeclarationU":
                                $allDocsSigned = -1;
                                $docs_signed['add_dec'] = -1;
                                break;
                            case "poaU":
                                $allDocsSigned = -1;
                                $docs_signed['poa'] = -1;
                                break;
                            case "microEntityU":
                                $allDocsSigned = -1;
                                $docs_signed['microEntity'] = -1;
                                break;
                        }
                    }
                }

                //patent app files
                foreach ($upFils as $uf)
                    $urlsPA [] = url($uf->url);


                $upLetterSign = -1; //the upgrade letter pct epo
                $upgLetterPCTSign = -1;//the upgrade letter only pct
                $ilcNeedSign = -1; // the ilc marketing agreement
                $ilcPatentedC = -1;
                $provInvoiceSign = -1; // and the provisional invoice
                $pctPSASign = -1; //and the pct psa

                //para dif cuando un upg fue pct/epo or only pct
                $existPCTEPO = -1;
                $existPCT = -1;
                if (File::exists("files/projects/" . $project->lead->fileno . "/" . $project->id . "/upgradeLetterPCTEPO.pdf"))
                    $existPCTEPO = 1;
                if (File::exists("files/projects/" . $project->lead->fileno . "/" . $project->id . "/upgradeLetterPCT.pdf"))
                    $existPCT = 1;

                //if upgrade letter was sent it but still dont signed
                $upgLettFile = UploadedFiles::where('project_id', $pCS->project_id)->where('fileName', 'upgradeLetter.pdf')->first();
                if ($pCS->pctEpoAlert == 1 && $upgLettFile == null && $pCS->epoFil_created_at == '' && $pCS->pctFil_created_at == '' && $existPCTEPO == 1)
                    $upLetterSign = 1;
                // if the upgrade letter (only pct) was sent it but still dont signed
                $upgLettPCTFile = UploadedFiles::where('project_id', $pCS->project_id)->where('fileName', 'upgradeLetterPCT.pdf')->first();
                if ($pCS->pctEpoAlert == 1 && $upgLettPCTFile == null && $pCS->pctFil_created_at == '' && $existPCT == 1)
                    $upgLetterPCTSign = 1;
                //if ilc was sent it but still dnt signed
                if ($pCS->marketingAgrSent_created_at != "" && $pCS->marketingAgrReceived_created_at == "" && $pCS->releaseFormReceived_created_at == "")
                    $ilcNeedSign = 1;
                //if ilc patented contract was sent it but still dnt signed
                $ilc = Ilc::where('projectclientservices_id',$pCS->id)->first();
                if($ilc!=null && $ilc->patentedContractSentDate!="0000-00-00 00:00:00" && $ilc->patentedContractRcvdDate == "0000-00-00 00:00:00")
                    $ilcPatentedC=1;

                // provisional invoice
                $provInvFile = UploadedFiles::where('project_id', $pCS->project_id)->where('fileName', 'provInvoice.pdf')->first();
                if ($pCS->provAlert == 1 && $provInvFile == null)
                    $provInvoiceSign = 1;
                //pct psa
                $pctPSAFile = UploadedFiles::where('project_id', $pCS->project_id)->where('fileName', 'PCT_PSA_signed.pdf')->first();
                if ($pCS->pctPsaSent_create_at != "0000-00-00 00:00:00" && $pCS->pctPsaRcvd_create_at == "0000-00-00 00:00:00")//&& $pctPSAFile == null
                    if($pctPSAFile == null)
                        $pctPSASign = 1;
                return view('omi.launch.client_services.docs',array('project_CS'=>$pCS,'project'=>$project ,'client'=>$this->client,'urlsPA'=>$urlsPA,'allDocsSigned'=>$allDocsSigned,'docs_signed'=>$docs_signed,'coInvCount'=>$coInvCount, 'coInvs'=>$coInvs,'upLetterSign'=>$upLetterSign,'ilcNeedSign'=>$ilcNeedSign,'provInvoiceSign'=>$provInvoiceSign,'upgLetterPCTSign'=>$upgLetterPCTSign,'pctPSASign'=>$pctPSASign,'ilcPatentedC'=>$ilcPatentedC));
            }
        }
        return redirect('launch');
    }

    //return the patent app by the client
    public function returnPatentAppByClient(){
        $pid = Input::get('PID');
        $notes = Input::get('NOTES');
        $type = Input::get('TYPE');
        if($type=='PAD')
            $type= 'DESIGN';
        elseif ($type=='PAU')
            $type= 'UT';
        $project = Project::find($pid);
        if($project!=null) {
            $client = $project->lead;
            $pCS = $project->clientServicesProject();
            $attCS = AttClientServices::where('projectclientservices_id',$pCS->id)->where('type',$type)->first();
            if($attCS == null)
                return -1;
            $pCS->completed = 2;
            $pCS->returnedReason = $notes;
//            $pCS->appSent_created_at="";
//            $pCS->poaDec_created_at="";
            $attCS->completed=2;
            $attCS->stateChangedDate = date('Y-m-d 00:00:00');
            $attCS->returnedReason = $notes;

            $pCS->save();
            $attCS->save();
            $clientS = Consultant::where('usr', 'clientservices')->first();
            $msgInbox = "The Patent Application was returned by the client for the following reasons:<br>".date("m-d-Y H:i:s")."<br>".$notes."<br>Client: " . $client->fname . " " . $client->lname .
                "<br>File #: " . $client->fileno . "<br>Pin: " . $project->id;

            if ($clientS != null) {
                $aux_id=$clientS->id;
                Inbox::createInbox($client->id, $aux_id, $msgInbox, "CLIENT SERVICES", "CLIENT");
            }

//            Inbox::createInbox($client->id, $pCS->attorney_id, $msgInbox, "CLIENT SERVICES", "CLIENT");
            ToolsFunctions::curl(url("emailReturnedApp?ID=$pCS->id&AT_ID=$pCS->attorney_id&NOTES=".urlencode($notes)));
            //cs note
            $csNote = new ClientSNotes();
            $csNote->notes = 'Patent App reviewed by client and sent to attorney by the following reasons:<br>'.$notes;
            $csNote->projectclientservices_id = $pCS->id;
            $csNote->save();
            //transaction
            Transaction::createTransaction('',$client->id,'','PATENT_APP_RETURNED_BY_CLIENT',$notes,$pid,'','','','','');

            return "1";
        }else
            return "-1";
    }

    //approve the patent app sent it to client
    public function approvePatentApp(){
        $pid = Input::get('PID');
        $type = Input::get('TYPE');
        $project = Project::find($pid);
        $patentType = '';
        if($project!=null) {
            $client = $project->lead;
            $clientS = Consultant::where('usr', 'clientservices')->first();
            $pCS =$project->clientServicesProject();
            if($type == "PAD"){
                $pCS->patentAppApprovedD_created_at = date("Y-m-d");
                $filePA = UploadedFiles::where('project_id',$pid)->where('fileName','like','PAD_%')->get();
                $patentType = 'Design';
            }else{
                $pCS->patentAppApproved_created_at = date("m-d-Y");
                if($type == "PROV") {
                    $filePA = UploadedFiles::where('project_id', $pid)->where('fileName', 'like', 'PROV_%')->get();
                    $patentType = 'Provisional';
                }else {
                    $filePA = UploadedFiles::where('project_id', $pid)->where('fileName', 'like', 'PAU_%')->get();
                    $patentType = 'Utility';
                }
            }
            foreach($filePA as $file){
                $file->clientVendor=1;
                $file->attorney = 1;
                $file->save();
            }

            $pCS->save();
            if ($clientS != null){
                $aux_id=$clientS->id;
                $msgInbox = "The Patent Application was approved by the client.<br>".date("m-d-Y H:i:s")."<br>Client: " . $client->fname . " " . $client->lname .
                    "<br>File #: " . $client->fileno . "<br>Pin: " . $project->id;
                Inbox::createInbox($client->id, $aux_id, $msgInbox, "CLIENT SERVICES", "CLIENT");

                $csNote = new ClientSNotes();
                $csNote->notes = "Patent Application $patentType Approve by client.";
                $csNote->projectclientservices_id = $clientS->id;
                $csNote->save();
            }

            CreateContractSignedHelper::generatePatentApplicationConsent($project,$patentType);

            //set in 0 the field filingReceipt of all the files of this project
            $otherFiles = UploadedFiles::where('project_id',$pid)->where('filingReceipt',1)->get();
            foreach($otherFiles as $otherF){
                $otherF->filingReceipt=0;
                $otherF->save();
            }

            //transaction
            Transaction::createTransaction('',$client->id,'','PATENT_APP_APPROVED_BY_CLIENT','',$pid,'','','','','');
            return "1";
        }else
            return "-1";
    }


    //to show the attachments in the modal of the nda to client
    public function getAttachmentsLaunch(){
        $countF = Input::get('COUNT');
        if($countF == 0)
            return 0;
        $pid = Input::get('PROJECTID');
        $docsAttach = UploadedFiles::where('project_id',$pid)->orderBy('created_at','DESC')->limit($countF)->get();
        return json_encode($docsAttach);
    }

    //to delete one of the files attached
    public function removeAttachmentLaunch(){
        $fid = Input::get('FID');
        $file = UploadedFiles::find($fid);
        if($file == null)
            return -1;
        $file->delete();
        return $fid;
    }

    //send the email from client and create a doc
    public function sendEmailClient(){
        $pid = Input::get('PID');
        $countF = Input::get('COUNT');
        $subject = Input::get('SUBJECT');
        $text = Input::get('TEXT');

        $project = Project::find($pid);
        if($project!=null){
            $lead= $project->lead;
            $pdf = App::make('dompdf.wrapper');//AndDesign
            $pdf->loadHTML('<p align="center"><img src="'.asset("/img/contracts/logo.png").'" name="Logo" width="165" height="126" id="Object1" align="center">
                        <br><i>Giving the edge to Inventors!</i></p><table align="center" width="100%"><tr>
                        <td>Client Name: '.$lead->fname.' '.$lead->lname.'</td></tr><tr><td>Email: '.$lead->email.'</td>
                        </tr><tr><td>FileNo: '.$lead->fileno.'</td></tr></table><br><table align="center" width="100%">
                        <tr><td>Subject: '.$subject.'</td></tr><tr><td><p>'.nl2br($text).'</p></td></tr></table>');
            if(!File::exists("files/projects/".$lead->fileno."/".$project->id)) {
                File::makeDirectory("files/projects/".$lead->fileno."/".$project->id, 0755, true);
            }
            $docname = $lead->fileno."_emailCorrespondenceFromClient_".date('m_d_Y H:i:s').".pdf";
            $pdf->save("files/projects/".$lead->fileno."/".$project->id."/".$docname);

            //send the email
            $pcs = $project->clientServicesProject();
            if($pcs !=null && $pcs->ppaSent_created_at != '')
                $forCS = 1;
            else
                $forCS = 0;
            $sent = ToolsFunctions::curl(url("sendEmailFromClient?PID=$pid&SUBJ=".urlencode($subject)."&TEXT=".urlencode($text)."&COUNT=$countF&CLIENTSERVICES=$forCS"));
            if($sent == 1){
                $url = "files/projects/".$lead->fileno."/".$project->id."/".$docname;

                $msgInbox = "Email received from client.<br>".date("m-d-Y H:i:s")."<br>Client: ".$project->lead->fname." ".$project->lead->lname.
                    "<br>File #: ".$project->lead->fileno."<br>Pin: ".$project->id."<br> Document: <a href='".url($url)."' target='_blank'>".$docname."</a><br>Attachments:<br>";
                $docsAttach = UploadedFiles::where('project_id',$project->id)->orderBy('created_at','DESC')->limit($countF)->get();
                foreach($docsAttach as $doc)
                    $msgInbox.=$doc->fileName."<br>";
                if($forCS == 1){
                    $clientServices = Consultant::where('usr','clientservices')->first();
                    Inbox::createInbox($project->lead->id,$clientServices->id,$msgInbox,"CLIENT TEXT","CLIENT");
                }else{
                    $production = Consultant::where('usr','production')->first();
                    Inbox::createInbox($project->lead->id,$project->consultant_id,$msgInbox,"CLIENT TEXT","CLIENT");
                    Inbox::createInbox($project->lead->id,$production->id,$msgInbox,"CLIENT TEXT","CLIENT");
                }
                //upload the doc
                $aux_file = UploadedFiles::where('project_id',$project->id)->where('fileName',$docname)->first();
                if($aux_file!=null)
                    $aux_file->delete();
                $uploadFile = new UploadedFiles();
                $uploadFile->project_id = $project->id;
                $uploadFile->url = "files/projects/".$lead->fileno."/".$project->id."/".$docname;
                $uploadFile->fileName = $docname;
                if($forCS == 0)
                    $uploadFile->internal = 1;
                $uploadFile->save();
                return 1;
            }
            return -1;
        }else
            return -1;
    }

    public function generateSignatureAgreement(){
        $pid =Input::get('PID');
        $project=Project::find($pid);
        if($project!=null){

            return $pid;
        }
        return -1;
    }
}
