<?php namespace App\Http\Controllers;

use App\Helpers\CreateContractSignedHelper;
use App\Helpers\ToolsFunctions;
use App\Models\Article;
use App\Models\Assignment;
use App\Models\Consultant;
use App\Models\Contract;
use App\Models\Inbox;
use App\Models\Lead;
use App\Models\Message;
use App\Models\PaymentTransaction;
use App\Models\PpaPricesPlan;
use App\Models\Project;
use App\Models\Transaction;
use App\Models\UploadedFiles;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use PayPal\Api\Amount;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;

class LaunchTestController extends Controller {

    /*
     * Current Consultant logged
     */
    public $client;
    private $_api_context;
    /*
     * To Allow use the controller methods the current user logged has to be Client
     */
    public function __construct()
    {
        $this->middleware('consultant');
        $this->client = Lead::where('email','alain@ownmyinvention.com')->first();
        define("AUTHORIZENET_API_LOGIN_ID", "85bSKeeEh2K");
        define("AUTHORIZENET_TRANSACTION_KEY", "6Agsm4T4W2MC655z");
        define("AUTHORIZENET_SANDBOX", false);

        $paypal_conf = Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
        $this->_api_context->setConfig($paypal_conf['settings']);
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
        return view('omi.launch_sandbox.index',array('client'=>$this->client,'showProfile' => $inbox_profile,'showProject' => $inbox_project));
    }
    //load profile view
    public function profile()
    {
        return view('omi.launch_sandbox.profile',array('client'=>$this->client));
    }
    //updated client profile information
    public function updateDataLead()
    {
        $fname = Input::get('FNAME');
        $lname = Input::get('LNAME');
        $phone = str_pad(preg_replace('/\D+/', '', Input::get("PHONE")), 11, '1', STR_PAD_LEFT);
        $phone2 = str_pad(preg_replace('/\D+/', '', Input::get("PHONE2")), 11, '1', STR_PAD_LEFT);
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
            $stages = array("WOM", 'WALKTHRU',"DROP", "DROP/IMG", "ARCHIVE","PHASE2","CONTRACT");

            $lastContract = $project->lastContractNoWP();
            if($lastContract!=null)
            {
                $actionDate = new \DateTime($project->actionDate);
                $today = new \DateTime();
                if($project->lastContractPaid() != null)
                {
                    if(strlen($project->lastContractPaid()['SIGN']) == 0)
                        $needSign=1;
                    else
                        $allowQuestions=1;
                }

                if($lastContract->paid<$lastContract->price && in_array($project->stage,$stages) && ($actionDate <=$today||$lastContract->type=="IGUP"||$lastContract->type=="PPA"||$project->stage=="WALKTHRU"))
                {
                    $paymentAvailable=1;
                }
            }

            $clientRequests = $project->requests->where('request','CLIENT')->where('consultantStage','CLIENT REVIEW')->where('adminStage','')->count();
            //docs legals to sign like ddr psa copyright trademark poa declaration add_declaration microentity
            $docsToSign = -1;
            $upLetterSign = -1; // and the upgrade letter pct epo
            $provInvoiceSign = -1; // and the provisional invoice
            $ilcNeedSign = -1; // and the ilc marketing agreement
            if($project->coInventor== "")
                $coInvCount = 0;
            else
                $coInvCount = count(explode(',',$project->coInventor));
            $pCS = $project->clientServicesProject();
            if($pCS !=null) {
                foreach ($pCS->getDocsCS() as $doc) {
                    if ($doc->name == 'add_declaration' && $coInvCount == 0)
                        continue;
                    $docsToSign = 1;
                }
                // if the upgrade letter was sent it but still dont signed
                $upgLettFile = UploadedFiles::where('project_id', $pCS->project_id)->where('fileName', 'upgradeLetter.pdf')->first();
                if ($pCS->pctEpoAlert == 1 && $upgLettFile == null)
                    $upLetterSign = 1;
                // if the provInvoice was sent but still dont signed
                $provInvFile = UploadedFiles::where('project_id', $pCS->project_id)->where('fileName', 'provInvoice.pdf')->first();
                if ($pCS->provAlert == 1 && $provInvFile == null)
                    $provInvoiceSign = 1;
                // if the ilc was sent it but still dnt signed
                if($pCS->marketingAgrSent_created_at!="" && $pCS->marketingAgrReceived_created_at == "" && $pCS->releaseFormReceived_created_at == "")
                    $ilcNeedSign=1;
            }
            $updateEmails = Transaction::where('transtype','UPDATE_EMAIL_PATENT_APP_SENT_TO_CLIENT')->where('project_id',$id)->orderBy('created_at','ASC')->get();
            $updateAfterYearEmails = Transaction::where('transtype','UPDATE_EMAIL_PATENT_APP_AFTER_YEAR_SENT_TO_CLIENT')->where('project_id',$id)->orderBy('created_at','ASC')->get();
            return view('omi.launch_sandbox.project',array('client'=>$this->client,'project'=>$project,'needSign'=>$needSign,'allowPayment'=>$paymentAvailable,'allowQuestions'=>$allowQuestions,'notesApproval'=>$clientRequests,'contract'=>$lastContract,'docsToSign'=>$docsToSign,'upLetterSign'=>$upLetterSign,'ilcNeedSign'=>$ilcNeedSign,'provInvoiceSign'=>$provInvoiceSign,'updateEmails'=>$updateEmails,'updateAfterYearEmails'=>$updateAfterYearEmails));
        }
        else
            return redirect('launch_sandbox');
    }

    //show docs to sign in client services
    public function showDocsCS($id)
    {
        $project = Project::find($id);
        //If project exists and belongs to the lead show it, else go to launch page
        if($project!=null && $project->lead_id == $this->client->id){
            $allDocsSigned =1; //to know if the docs of the paten app package was signed or not
            $docs_signed = array('dec'=>1,'poa'=>1,'add_dec'=>1,'microEntity'=>1); //array to know which doc was signed and which dnt
            $pCS = $project->clientServicesProject();

            //to know how many coInv have the project
            if($project->coInventor== "")
                $coInvCount = 0;
            else
                $coInvCount =count(explode(',',$project->coInventor));

            //to get the url of the patent app
            $upFils = UploadedFiles::where('project_id',$id)->get();
            $urlPA = "";
            foreach($upFils as $uf){
                $aux = substr($uf->fileName,0,3);
                if($aux == "PA_")
                    $urlPA = url($uf->url);
            }
            if($pCS!=null){
                foreach($pCS->getDocsCS() as $doc){//getDocsCS return the files with file_id -1 what it means is not signed
                    if($doc->name=="add_declaration" && $coInvCount == 0)
                        continue;
                    if($doc->belong_PA == 1){
                        $allDocsSigned = -1;
                        switch($doc->name){
                            case "declaration":
                                $docs_signed['dec']=-1;
                                break;
                            case "add_declaration":
                                $docs_signed['add_dec']=-1;
                                break;
                            case "poa":
                                $docs_signed['poa']=-1;
                                break;
                            case "microEntity":
                                $docs_signed['microEntity']=-1;
                                break;
                        }
                    }
                }
                $upLetterSign = -1; //the upgrade letter pct epo
                $ilcNeedSign = -1; // the ilc marketing agreement
                $provInvoiceSign = -1; // and the provisional invoice
                //if upgrade letter was sent it but still dont signed
                $upgLettFile = UploadedFiles::where('project_id', $pCS->project_id)->where('fileName', 'upgradeLetter.pdf')->first();
                if ($pCS->pctEpoAlert == 1 && $upgLettFile == null)
                    $upLetterSign = 1;
                //if ilc was sent it but still dnt signed
                if($pCS->marketingAgrSent_created_at!="" && $pCS->marketingAgrReceived_created_at == "" && $pCS->releaseFormReceived_created_at == "")
                    $ilcNeedSign = 1;
                // provisional invoice
                $provInvFile = UploadedFiles::where('project_id', $pCS->project_id)->where('fileName', 'provInvoice.pdf')->first();
                if ($pCS->provAlert == 1 && $provInvFile == null)
                    $provInvoiceSign = 1;
                return view('omi.launch_sandbox.client_services.docs',array('project_CS'=>$pCS,'client'=>$this->client,'urlPA'=>$urlPA,'allDocsSigned'=>$allDocsSigned,'docs_signed'=>$docs_signed,'coInvCount'=>$coInvCount,'upLetterSign'=>$upLetterSign,'ilcNeedSign'=>$ilcNeedSign,'provInvoiceSign'=>$provInvoiceSign));
            }
        }
        return redirect('launch');
    }

    //esto es de client services controller pero lo puse aki mismo para el sandbox

    //sign contract
    public function sign()
    {
        $document = Input::get('DOCUMENT');
        $id = Input::get('ID');
        $project = Project::find($id);
        $pCS=$project->clientServicesProject();
        $att = null;
        // to know if the contract is provisional or utility, to know the period of time in the ilc
        $prov_ut ="";
        $effectiveDate = "";
        if($pCS!=null) {
            $att = Consultant::find($pCS->attorney_id);
            if($pCS->hasType('UT'))
                $prov_ut="U";
            elseif($pCS->hasType('PROV'))
                $prov_ut="P";
            $time = str_replace('-','/',$pCS->marketingAgrSent_created_at);
            $time1 = strtotime($time);
            $effectiveDate = date('l jS F Y',$time1);
        }

        $coInvs = array();
        if ($project->coInventor == "")
            $coInvCount = 0;
        else {
            $coInvs = explode(',', $project->coInventor);
            $coInvCount = count($coInvs);
        }

        // data if the doc is the provInvoice
        $dateBy= null;
        $contractBy = null;
        $amountBy = null;
        $percentageBy = null;
        $balanceBy = null;
        if($document == "provInvoice"){
            $data = ToolsFunctions::obtainPPAInfo($id);
            $dateBy= $data['PPA_Received_Date__c'];
            $contractBy = $data['PPA_Contract_Amount__c'];
            $amountBy = $data['PPA_Payment_Amount__c'];
            $percentageBy = round($data['PPA_Percentage_Paid__c'],2);
            $balanceBy = $contractBy - $amountBy;
        }


        return view('omi.launch_sandbox.client_services.sign',array('client'=>$project->lead,'document'=>$document,'project_id'=>$id,
            'project'=>$project,'pcs'=>$pCS,'attorney'=>$att,'coInvCount'=>$coInvCount,'coInvs'=>$coInvs,'prov_ut'=>$prov_ut,
            'effectiveDate'=>$effectiveDate,'dateBy'=>$dateBy,'contractBy'=>$contractBy,'amountBy'=>$amountBy,
            'percentageBy'=>$percentageBy,'balanceBy'=>$balanceBy));
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
                return "1";
            }
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
            $clientRequest = $project->requests->where('request','CLIENT')->where('consultantStage','CLIENT REVIEW')->where('adminStage','')->first();
            $clientRequest->adminStage="APPROVED";
            $clientRequest->save();
            return "1";
        }
        return "-1";
    }

    //sign contract
    public function signContract($id)
    {
        $project = Project::find($id);
        //If project exists and belongs to the lead show it, else go to launch page
        if($project!=null && $project->lead_id == $this->client->id)
        {
            $contract = Contract::where(array('project_id'=>$project->id,'signed'=>''))->where('type','NOT LIKE','WP')->whereRaw('price = paid')->first();
            if($contract!=null)
            {
                $prices = PpaPricesPlan::find(9);
                return view('omi.launch_sandbox.sign',array('prices'=>$prices,'client'=>$this->client,'project'=>$project,'contract'=>$contract,'from'=>'sign'));
            }else{
                $contract = Contract::where(array('project_id'=>$project->id,'signed'=>'1','type'=>'PPA'))->first();
                if($contract!=null){
                    return view('omi.launch_sandbox.sign',array('client'=>$this->client,'project'=>$project,'contract'=>$contract,'from' => 'signPPA', 'ContractType' => ($project->utility != ''?$project->utility:'IMG')));
                }
            }
        }
        return redirect('launch_sandbox');
    }
    public function signedContract()
    {
        $contract_id = Input::get('ID');
        $contract = Contract::find($contract_id);
        if($contract !=null && $contract->project->lead_id == $this->client->id)
        {
            return view('omi.payment_sandbox.success',array('project'=>$contract->project,'contract'=>$contract,'client'=>$this->client,'complete'=>1));
        }
        return redirect('launch_sandbox');
    }

    public function signedPPAContract()
    {
        $contract_id = Input::get('ID');
        $contract = Contract::find($contract_id);
        if($contract !=null && $contract->project->lead_id == $this->client->id)
        {
            return view('omi.payment_sandbox.success',array('project'=>$contract->project,'contract'=>$contract,'client'=>$this->client,'complete'=>1));
        }
        return redirect('launch_sandbox');
    }

    //change password
    public function changePassword()
    {
        $consultant_id = Input::get('LEAD');
        $old = Input::get('OLD');
        $new = Input::get('NEW');

        $lead = Lead::find($consultant_id);
        if($lead!=null && $lead->password == $old){
            return "1";
        }
        return "-1";
    }
    //sign contract before Paid
    public function signBeforePaid($id)
    {
        $project = Project::find($id);
        //If project exists and belongs to the lead show it, else go to launch page
        if($project!=null && $project->lead_id == $this->client->id)
        {
            $contract = $project->lastContractNoWP();
            if($contract!=null)
            {
                $prices = PpaPricesPlan::find(9);
                return view('omi.launch_sandbox.sign',array('prices'=>$prices,'client'=>$this->client,'project'=>$project,'contract'=>$contract,'from'=>'signBeforePaid','ContractType'=>($project->utility != ''?$project->utility:'IMG')));
            }
        }
        return redirect('launch_sandbox');
    }

    public function success()
    {
        $contract_id = Input::get('ID');
        $contract = Contract::find($contract_id);
        if($contract !=null && $contract->project->lead_id == $this->client->id)
        {
            return view('omi.payment_sandbox.success', array('project' => $contract->project, 'contract' => $contract, 'client' => $this->client,'complete'=>1));
        }
        return redirect('launch_sandbox');
    }

    public function payment_sandbox()
    {
        $project_id = Input::get('project_id');
        $contract_id = Input::get('contract_id');
        $project = Project::find($project_id);
        if($project!=null && $project->lead_id == $this->client->id)
        {
            $contract = $project->lastContractNoWP();
            if($contract->id == $contract_id)
            {
                if (Input::has('inventor_name_hidden'))
                {
                    $contract->signed = Input::get('inventor_name_hidden');
                    if(strlen(Input::get('cinventor_name_hidden'))>0)
                        $contract->signed .= ";".Input::get('cinventor_name_hidden');
                    $dateSign = new \DateTime(Input::get('inventor_date_hidden'));
                    $contract->signedDate = $dateSign;
                    $contract->save();
                }
                if($contract->paid >=$contract->price)
                {
                    if(strlen($contract->signed)==0)
                    {
                        return redirect(route('launch_sandbox/signBeforePaid',$project->id));
                    }
                    else
                        return redirect(url('launch_sandbox/project/'.$project->id));
                }
                return view('omi.launch_sandbox.payment.index',array('project'=>$project,'contract'=>$contract,'client'=>$this->client));
            }
        }
        return redirect(url('launch_sandbox'));
    }
    //Proccess the payment
    public function payment_process()
    {
        $project_id = Input::get('project_id');
        $contract_id = Input::get('contract_id');
        $project = Project::find($project_id);
        $contract = Contract::find($contract_id);
        if($project!=null && $contract!=null && $project->id == $contract->project_id )
        {
            $amount = preg_replace("/[^0-9,.]/", "", Input::get('project_price'));
            $amount = str_replace(",", "",$amount);
            $amount =  number_format($amount,2, ".","");
            $cctype = Input::get('cctype');

            $ccname =Input::get('ccname');
            $ccn = Input::get('ccn');
            $exp1 = Input::get('exp1');
            $exp2 = Input::get('exp2');
            $cvv = Input::get('cvv');
            $accttype = Input::get('accttype');
            $bankname = Input::get('bkname');
            $routing  =Input::get('rnumber');
            $account  =Input::get('anumber');

            $fname =  Input::get('fname');
            $lname =  Input::get('lname');
            $address =  Input::get('address');
            $city =  Input::get('city');
            $state =  Input::get('state');
            $country =  Input::get('country');
            $zip =  Input::get('zip');
            $email =  Input::get('email');
            $continue = true;

            if($cctype=="E")
            {
                if(empty($accttype) || empty($bankname) || empty($routing) || empty($account))
                {
                    $continue = false;
                    $mess = 'Not all required fields were filled out.';
                }
                if(!is_numeric($routing))
                {
                    $continue = false;
                    $mess = 'Routing number can contain numbers only.';
                }
                if(!is_numeric($account))
                {
                    $continue = false;
                    $mess = 'Account number can contain numbers only.';
                }
                if(!$continue)
                {
                    return view('omi.launch_sandbox.payment.index',array('project'=>$project,'contract'=>$contract,'client'=>$this->client,'error'=>$mess));
                }
            }
            else if($cctype!="PP")
            {
                //CREDIT CARD PHP VALIDATION
                if(empty($ccn) || empty($cctype) || empty($exp1) || empty($exp2) || empty($ccname) || empty($cvv) || empty($address) || empty($state) || empty($city))
                {
                    $continue = false;
                    $mess = 'Not all required fields were filled out.';
                }
                if(!is_numeric($cvv))
                {
                    $continue = false;
                    $mess = 'CVV number can contain numbers only.';
                }
                if(!is_numeric($ccn))
                {
                    $continue = false;
                    $mess = 'Credit Card number can contain numbers only.';
                }
                if(date("Y-m-d", strtotime($exp2."-".$exp1."-01")) < date("Y-m-d"))
                {
                    $continue = false;
                    $mess = 'Your credit card is expired.';
                }
                if($continue)
                {
                    if(!$this->validateCC($ccn,$cctype))
                    {
                        $continue = false;
                        $mess = 'The number you\'ve entered does not match the card type selected.';
                    }
                }
                if($continue)
                {
                    if(!$this->luhn_check($ccn))
                    {
                        $continue = false;
                        $mess = 'Invalid credit card number.';
                    }
                }
                if(!$continue)
                {
                    return view('omi.launch_sandbox.payment.index',array('project'=>$project,'contract'=>$contract,'client'=>$this->client,'error'=>$mess));
                }
            }
            switch($cctype)
            {
                case "V":
                    $cctype = "VISA";
                    break;
                case "M":
                    $cctype = "MASTERCARD";
                    break;
                case "DI":
                    $cctype = "DINERS CLUB";
                    break;
                case "D":
                    $cctype = "DISCOVER";
                    break;
                case "A":
                    $cctype = "AMEX";
                    break;
                case "PP":
                    $cctype = "PAYPAL";
                    break;
                case "E":
                    $cctype = "ECHECK";
                    break;
            }
            $merchant = array(
                'login' => AUTHORIZENET_API_LOGIN_ID,
                'tran_key' => AUTHORIZENET_TRANSACTION_KEY,
                'allow_partial_auth' => "false",
            );
            if($cctype=="ECHECK")
            {
                if($contract->type=="PPA")
                {
                    return view('omi.launch_sandbox.payment.success',array('project'=>$project,'contract'=>$contract,'client'=>$this->client,'complete'=>0));
                }

                if($contract->price<=$contract->paid && strlen($contract->signed)>0)
                {
                    return view('omi.launch_sandbox.payment.success',array('project'=>$project,'contract'=>$contract,'client'=>$this->client,'complete'=>1));
                }
                else if($contract->price<=$contract->paid)
                    return view('omi.launch_sandbox.sign',array('client'=>$this->client,'project'=>$project,'contract'=>$contract,'from'=>'sign'));
                else
                    return view('omi.launch_sandbox.payment.success',array('project'=>$project,'contract'=>$contract,'client'=>$this->client,'complete'=>0));
            }
            else if($cctype!="PAYPAL")
            {
                if($contract->type=="PPA")
                {
                    return view('omi.launch_sandbox.payment.success',array('project'=>$project,'contract'=>$contract,'client'=>$this->client,'complete'=>0));
                }

                if($contract->price<=$contract->paid && strlen($contract->signed)>0)
                {
                    return view('omi.launch_sandbox.payment.success',array('project'=>$project,'contract'=>$contract,'client'=>$this->client,'complete'=>1));
                }
                else if($contract->price<=$contract->paid)
                    return view('omi.launch_sandbox.sign',array('client'=>$this->client,'project'=>$project,'contract'=>$contract,'from'=>'sign'));
                else
                    return view('omi.launch_sandbox.payment.success',array('project'=>$project,'contract'=>$contract,'client'=>$this->client,'complete'=>0));
            }
            else if($cctype=="PAYPAL")
            {

                $amountP = preg_replace("/[^0-9,.]/", "", Input::get('project_price'));
                $payer = new Payer();
                $payer->setPaymentMethod('paypal');

                $item_1 = new Item();
                $item_1->setName($project->ideaName)
                    ->setCurrency('USD')
                    ->setQuantity(1)
                    ->setPrice($amountP);

                $item_list = new ItemList();
                $item_list->setItems(array($item_1));
                $amount = new Amount();
                $amount->setCurrency('USD')
                    ->setTotal($amountP);

                $redirect_urls = new RedirectUrls();
                $redirect_urls->setReturnUrl(URL::route('payment_sandbox/status',$contract->id)) // Specify return URL
                ->setCancelUrl(URL::route('payment_sandbox/cancel',$contract->id));

                $transaction = new \PayPal\Api\Transaction();
                $transaction->setAmount($amount)
                    ->setItemList($item_list)
                    ->setDescription('PayPal One Time Payment');
                $payment = new Payment();
                $payment->setIntent('Sale')
                    ->setPayer($payer)
                    ->setRedirectUrls($redirect_urls)
                    ->setTransactions(array($transaction));
                try
                {
                    $payment->create($this->_api_context);
                }
                catch (\PayPal\Exception\PayPalConnectionException $ex)
                {
                    return view('omi.launch_sandbox.payment.index',array('project'=>$project,'contract'=>$contract,'client'=>$this->client,'error'=>$ex->getMessage()));
                }
                foreach($payment->getLinks() as $link)
                {
                    if($link->getRel() == 'approval_url')
                    {
                        $redirect_url = $link->getHref();
                        break;
                    }
                }
                Session::put('paypal_payment_id', $payment->getId());
                Session::put('contract_id', $contract->id);
                if(isset($redirect_url))
                {
                    // redirect to paypal
                    return Redirect::away($redirect_url);
                }
                return view('omi.launch_sandbox.payment.index',array('project'=>$project,'contract'=>$contract,'client'=>$this->client,'error'=>'Unknown error occurre'));
            }
        }
    }
    function validateCC($cc_num, $type)
    {
        $verified = false;
        if($type == "A") //American Express
        {
            if (preg_match("/^([34|37]{2})([0-9]{13})$/",$cc_num))
                $verified = true;
        }
        elseif($type == "DI") //Diner's Club
        {
            if (preg_match("/^([30|36|38]{2})([0-9]{12})$/",$cc_num))
                $verified = true;
        }
        elseif($type == "D") //Discover Card
        {
            if (preg_match("/^([6011]{4})([0-9]{12})$/",$cc_num))
                $verified = true;
        }
        elseif($type == "M") //Mastercard
        {
            if (preg_match("/^([51|52|53|54|55]{2})([0-9]{14})$/",$cc_num))
                $verified = true;
        }
        elseif($type == "V")
        {
            if (preg_match("/^([4]{1})([0-9]{12,15})$/",$cc_num))
                $verified = true;
        }
        return $verified;
    }
    function luhn_check($number)
    {
        // Strip any non-digits (useful for credit card numbers with spaces and hyphens)
        $number=preg_replace('/\D/', '', $number);
        // Set the string length and parity
        $number_length=strlen($number);
        $parity=$number_length % 2;

        // Loop through each digit and do the maths
        $total=0;
        for ($i=0; $i<$number_length; $i++)
        {
            $digit=$number[$i];
            // Multiply alternate digits by two
            if ($i % 2 == $parity)
            {
                $digit*=2;
                // If the sum is two digits, add them together (in effect)
                if ($digit > 9)
                    $digit-=9;
            }
            // Total up the digits
            $total+=$digit;
        }
        // If the total mod 10 equals 0, the number is valid
        return ($total % 10 == 0) ? true : false;
    }
    //cancel paypal Payment
    public function cancelPayment($contract_id)
    {
        $contract = Contract::find($contract_id);
        $project = Project::find($contract->project_id);
        $client = Lead::find($project->lead_id);
        return view('omi.launch_sandbox.payment.cancel',array('project'=>$project,'contract'=>$contract,'client'=>$client));
    }
    //proccess payment via Paypal
    public function getPaymentStatus($contract_id)
    {
        $contract = Contract::find($contract_id);
        $project = Project::find($contract->project_id);
        $client = Lead::find($project->lead_id);
        // Get the payment ID before session clear
        $payment_id = Session::get('paypal_payment_id');

        // clear the session payment ID
        Session::forget('paypal_payment_id');

        if (!Input::get('PayerID') ||! Input::get('token'))
        {
            return view('omi.launch_sandbox.payment.index',array('project'=>$project,'contract'=>$contract,'client'=>$client,'error'=>'Payment failed'));
        }
        if($contract->type=="PPA")
        {
            return view('omi.launch_sandbox.payment.success',array('project'=>$project,'contract'=>$contract,'client'=>$client,'complete'=>0));
        }
        if($contract->price<=$contract->paid && strlen($contract->signed)>0)
        {
            return view('omi.launch_sandbox.payment.success',array('project'=>$project,'contract'=>$contract,'client'=>$client,'complete'=>1));
        }
        else if($contract->price<=$contract->paid)
            return view('omi.launch_sandbox.sign',array('client'=>$client,'project'=>$project,'contract'=>$contract,'from'=>'sign'));
        else
            return view('omi.launch_sandbox.payment.success',array('project'=>$project,'contract'=>$contract,'client'=>$client,'complete'=>0));

    }
}
