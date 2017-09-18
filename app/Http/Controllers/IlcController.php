<?php namespace App\Http\Controllers;


use App\Helpers\PlivoHelper;
use App\Helpers\ToolsFunctions;
use App\Models\Consultant;
use App\Models\Ilc;
use App\Models\IlcNotes;
use App\Models\IlcVendors;
use App\Models\Inbox;
use App\Models\Industry;
use App\Models\Lead;
use App\Models\Manufacturer;
use App\Models\ManufacturerNotes;
use App\Models\Project;
use App\Models\Tradeshow;
use App\Models\Transaction;
use App\Models\UploadedFiles;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use DB;
use Illuminate\Support\Facades\Session;


class IlcController extends Controller {

    /*
     * Current Consultant logged
     */
    public $consultant;
    /*
     * To Allow use the controller methods the current user logged has to be Client
     */
    public function __construct()
    {
        $this->middleware('ilc');
        $this->middleware(function ($request, $next) {
            $this->consultant = Consultant::find(Session::get('user_id'));

            return $next($request);
        });
    }
    //sign contract
    public function index()
    {
        $total_inbox = Inbox::where(['consultant_id'=>$this->consultant->id,'status'=>0])->count();

        $projectsILC = Ilc::all();
        $industries = Industry::all();
        Ilc::where('status', 'UNLOADED')->update(['status' => 'LOADED']); //->where('consultant_id',$this->consultant->id)

        $pending = count(Ilc::where('introCallDate','<>','0000-00-00 00:00:00')->where('introCallDate','<',date('Y-m-d 23:59:59'))->where('introCallDate','like','%00:00:00')->get()) > 0 ? 1:0;
        $pending2 =count(Ilc::where('agreementStartDate','<>','0000-00-00 00:00:00')->where('agreementStartDate','<',date('Y-m-d H:i:s', strtotime('-1 year +6 days')))->where('separationDate','0000-00-00 00:00:00')->get())>0 ?1:0;
        return view("intranet.ILC.index",array('consultant'=>$this->consultant,'projectsILC'=>$projectsILC, 'industries'=>$industries,'total_inbox'=>$total_inbox,'pending'=>($pending || $pending2)));
    }

    public function pendingIlc(){
        $pendingIntroCall = Ilc::where('introCallDate','<>','0000-00-00 00:00:00')->where('introCallDate','<',date('Y-m-d 23:59:59'))->where('introCallDate','like','%00:00:00')->get();
        $pendingExpiration = array();
        $ilcToCheck = Ilc::where('agreementStartDate','<>','0000-00-00 00:00:00')->where('agreementStartDate','<',date('Y-m-d H:i:s', strtotime('-1 year +6 days')))->where('separationDate','0000-00-00 00:00:00')->get();
        foreach($ilcToCheck as $ilc){
            if($ilc->projectclientservices->hasType("PROV") && !$ilc->projectclientservices->hasType('UPG_UT'))
                $pendingExpiration[] = $ilc;
            elseif($ilc->agreementStartDate < date('Y-m-d H:i:s', strtotime('-2 year +6 days')))
                $pendingExpiration[] = $ilc;
        }
        //chek for tradeshow date in the bussines day before
        $day = date('w');
        if(2 <= $day && $day <= 6)
            $checkDay = date('Y-m-d 00:00:00',strtotime('-1 day'));
        elseif($day == 1)
            $checkDay = date('Y-m-d 00:00:00',strtotime('-3 day'));
        else
            $checkDay = date('Y-m-d 00:00:00',strtotime('-2 day'));
        $tradeshowAlert = count(Tradeshow::where('tradeshowEndDate',$checkDay)->get())>0 ? 1:0;

        return view("intranet.ILC.tools.pendingIlc",array('pendingIntroCall'=>$pendingIntroCall,'pendingExpiration'=>$pendingExpiration,'tradeshowAlert'=>$tradeshowAlert));
    }

    public function findProjectILC(){
        $leads = Lead::findLead(Input::get('PARAMS'));
        $projects=array();
        if($leads!="-1")
            foreach($leads as $lead_id)
            {
                $lead = Lead::find($lead_id);
                $listOfProjects = Ilc::where('fileno',$lead->fileno)->get();
                foreach($listOfProjects as $projectFromLead){
                    $projects[] = $projectFromLead->projectclientservices->project;
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
        $view = ToolsFunctions::curl(url("paintProjectILC?PROJECT=$projectId"));
        return $view;
    }

    /*
     * Search all the new projects that aren't loaded yet for the current consultant  and updated to loaded
     */
    public function loadProjectsILC()
    {
        $newProjects = Ilc::where('status','LIKE','UNLOADED')->get(); //where('consultant_id',$this->consultant->id)->

        $count = count(Ilc::where('status','LIKE','LOADED')->get());
        $data = array();
        $i =1;
        foreach($newProjects as $ilc){
            $ind='';
            foreach(Industry::all() as $indst)
                if($indst->id == $ilc->industry_id)
                    $ind=$indst->type;

            if($ilc->projectclientservices->hasType('D'))
                $type = 'Utilt & Design';
            elseif($ilc->projectclientservices->hasType('UT') || $ilc->projectclientservices->hasType('UPG_UT'))
                $type = 'Utility';
            elseif($ilc->projectclientservices->hasType("PROV"))
                $type = 'Provisional';

            $info = array($ilc->id, $ilc->projectclientservices->project->id,$count+$i,$ilc->projectclientservices->fileno,$ilc->invFname." ".$ilc->invLname,$ilc->coordinator,$ilc->patent_status,$ilc->inventionName,$type,$ind);
            $data[]=$info;
            $i++;
        }
        Ilc::where('status', 'UNLOADED')->update(['status' => 'LOADED']);//->where('consultant_id',$this->consultant->id)

        return json_encode($data);
    }

    public function loadProjectPortlet(){
        $id = Input::get('ID');
        $projectToLoad = $this->paintProject($id);
        return json_encode($projectToLoad);
    }


    public function sendIntroPackage(){
        $pid=Input::get('ID');
        $iid =Input::get('IID');
        $date=date('F j, Y');
        $project= Project::find($pid);
        if($project == null)
            return -1;
        $client =$project->lead;

        $title1=Input::get('TITLE1');
        $description1=Input::get('DESC1');
        $description11=Input::get('DESC11');
        $title2=Input::get('TITLE2');
        $description2=Input::get('DESC2');
        $description22=Input::get('DESC22');

        //genertate the ilc codes doc
        $pdf = App::make('dompdf.wrapper');
        $content =  view('templates.ilc.mail_ilc_codes_template_pdf',array('client'=>$client,'title1'=>$title1,'description1'=>$description1,'description11'=>$description11, 'title2'=>$title2,'description2'=>$description2,'description22'=>$description22));
        $pdf->loadHTML($content);
        $url = "files/projects/".$client->fileno."/".$project->id."/SIC&NAICS_CODES.pdf";
        $pdf->save($url);
        //saving the SIC&NAICS_CODES into the upload files database.
        $uploadFile = new UploadedFiles();
        $uploadFile->project_id = $project->id;
        $uploadFile->url = $url;
        $uploadFile->fileName = "SIC&NAICS_CODES.pdf";
        $uploadFile->ilc = 1;
        $uploadFile->save();


        //generate the product spec sheet
        $pdf2 = App::make('dompdf.wrapper');
        $content2 =  view('templates.ilc.empty_mail_ilc_productSpecSheet_template_pdf',array('client'=>$client));
        $pdf2->loadHTML($content2);
        $pdf2->save("files/projects/".$client->fileno."/".$project->id."/productSpecSheet.pdf");

        //generate the inv profile doc
        $pdf3 = App::make('dompdf.wrapper');
        $content3 =  view('templates.ilc.empty_mail_ilc_invProfile_template_pdf',array('client'=>$client));
        $pdf3->loadHTML($content3);
        $pdf3->save("files/projects/".$client->fileno."/".$project->id."/inventorProfile.pdf");

        //send the email
        ToolsFunctions::curl(url("ilcIntroPackgEmail?ID=$iid"));


        //create note
        $ilcNote = new IlcNotes();
        $ilcNote->ilc_id = $iid;
        $ilcNote->notes = "Intro Package sent to client.";
        $ilcNote->system =1;
        $ilcNote->save();
        //create transaction
        Transaction::createTransaction($this->consultant->id,$client->id,'','INTRO_PACKG_ILC_SENT_TO_CLIENT','',$pid,'','','','','');

        $ilc= Ilc::find($iid);
        $ilc->introCallDate = date('Y-m-d 00:00:00',strtotime("+5 days"));
        $ilc->welcomePckgSentDate = date('Y-m-d 00:00:00');
        $ilc->save();
        if(!File::exists("files/projects/".$client->fileno."/".$project->id.'/ilc_agreement_signed.pdf'))
            return 2;
        return 1;
    }

    //save the notes of the ilc
    public function ilcSaveNotes(){
        $notes = Input::get('VALUE');
        $id = Input::get('ID');
        if($id == "0"){
            $iid = Input::get('IID');
            $ilc = Ilc::find($iid);
            if($ilc!=null){
                $ilcNote = new IlcNotes();
                $ilcNote->ilc_id = $ilc->id;
                $ilcNote->notes = $notes;
                $ilcNote->save();
                return json_encode($ilcNote);
            }
        }else{
            $ilcNote = IlcNotes::find($id);
            $ilcNote->notes = $notes;
            $ilcNote->save();
            return json_encode( $ilcNote);
        }
        return 0;
    }

    //save the notes of the ilc
    public function createNoteManufacturer(){
        $notes = Input::get('NOTES');
        $id = Input::get('ID');
        ManufacturerNotes::createNote($id,$notes);
        return "1";
    }

    //save the notes of the ilc
    public function loadManufacturerNotes(){
        $id = Input::get('ID');
        $manufacturer = Manufacturer::find($id);
        return json_encode($manufacturer->getNotes());
    }

    //delete notes of the ilc
    public function ilcDeleteNotes(){
        $id = Input::get('ID');
        $ilcNote = IlcNotes::find($id);
        if($ilcNote!=null){
            $ilcNote->delete();
            return 1;
        }
        return -1;
    }

    //direct to view to create and edit manufacturers
    public function manufacturerCreateEdit(){
        $total_inbox = Inbox::where(['consultant_id'=>$this->consultant->id,'status'=>0])->count();
        $manuf = Manufacturer::all();
        $industries = Industry::all();
        return view("intranet.ILC.tools.manufacturer",array('consultant'=>$this->consultant,'manufacturers'=>$manuf,'industries'=>$industries,'total_inbox'=>$total_inbox));
    }

    //load the info of a manufacturer
    public function loadManufacturer(){
        $manufacturerId = Input::get('ID');
        $manufacturer =Manufacturer::find($manufacturerId);
        if($manufacturer != null)
            return json_encode($manufacturer);
        else
            return -1;
    }

    //save manufacturer info from manufacturer manager
    public function saveManufacturer(){
        $manufacturerId = Input::get('ID');
        $manufacturerName = Input::get('NAME');
        $email = Input::get('EMAIL');
        $phone = Input::get('PHONE');
        $fname = Input::get('FNAME');
        $lname = Input::get('LNAME');
        $industryId = Input::get('INDUSTRY');
        $hasNDA = Input::get('NDA');
        $ndaSign = Input::get('NDASIGN');
        $manfNda = Input::get('MANFNDA');
        $manfNoNda = Input::get('MANFNONDA');
        $cSignManfNda = Input::get('CSIGNMANF');
        if($manufacturerId == -1){
            $manufacturerId = Manufacturer::createManufacturer($manufacturerName,$industryId,$hasNDA,$ndaSign,$manfNda,$manfNoNda,$cSignManfNda,$email,$phone,$fname,$lname);
            $count = count(Manufacturer::all());
            Transaction::createTransaction($this->consultant->id,'','','MANUFACTURER_CREATED',$manufacturerId,'','','','','','');
            return json_encode(array('new',$manufacturerId,$count));
        }else{
            $manufacturer =Manufacturer::find($manufacturerId);
            if($manufacturer == null)
                return -1;
            $manufacturer->name =$manufacturerName;
            $manufacturer->email =$email;
            $manufacturer->phone =$phone;
            $manufacturer->fname =$fname;
            $manufacturer->lname =$lname;
            $manufacturer->industry_id =$industryId;
            $manufacturer->hasNda = $hasNDA;
            $manufacturer->ndaSign = $ndaSign;
            $manufacturer->manfNda = $manfNda;
            $manufacturer->cSignManfNda = $cSignManfNda;
            $manufacturer->manfNoNda = $manfNoNda;
            $manufacturer->save();
            Transaction::createTransaction($this->consultant->id,'','','MANUFACTURER_EDITED',$manufacturerId,'','','','','','');
            return json_encode(array('edit'));
        }
    }

    //save manufacturer info from manufacturer manager
    public function deleteManufacturer(){
        $manufacturerId = Input::get('ID');
        $manufacturer = Manufacturer::find($manufacturerId);
        if($manufacturer == null)
            return -1;
        $manufacturer->delete();
        Transaction::createTransaction($this->consultant->id,'','','MANUFACTURER_DELETED',$manufacturer->name,'','','','','','');
        return $manufacturerId;

    }

    //save the industry assign to the ilc
    public function saveIndustryILC(){
        $ind_id = Input::get('IND_ID');
        $ilc_id = Input::get('ILC_ID');

        $ilc = Ilc::find($ilc_id);
        if($ilc == null)
            return -1;
        $old_ind =$ilc->industry_id;
        $manufacturers =$ilc->manufacturers;
        $ilc->deleteManufacturer($manufacturers);
        $ilc->industry_id = $ind_id;
        $ilc->save();

        if($ind_id == 0)
            $indType = '';
        else
            $indType=$ilc->industry->type;
        $newManufacturers = Manufacturer::where('industry_id',$ind_id)->get();
        Transaction::createTransaction($this->consultant->id,'','','INDUSTRY_SAVED_TO_ILC','ILC ID: '.$ilc_id.', Industry ID: '.$ind_id,'','','','','','');
        return json_encode(array($ilc_id,$newManufacturers,$indType));
    }

    //add one manufacturer to the ilc
    public  function addManufacturer(){
        $man_id = Input::get('MID');
        $ilc_id = Input::get('IID');
        $ilc = Ilc::find($ilc_id);
        $manufacturer = Manufacturer::find($man_id);
        if($ilc ==null)
            return -1;
        if($manufacturer ==null)
            return -1;

        $ilc->addManufacturer(array($man_id));
        Transaction::createTransaction($this->consultant->id,'','','MANUFACTURER_ADDED_TO_ILC','ILC ID: '.$ilc_id.', Manufacturer ID: '.$man_id,'','','','','','');
        return  json_encode(array($ilc_id,$manufacturer));
    }

    //remove one manufacturer to the ilc
    public  function removeManufacturer(){
        $man_id = Input::get('MID');
        $ilc_id = Input::get('IID');
        $ilc = Ilc::find($ilc_id);
        $manufacturer = Manufacturer::find($man_id);
        if($ilc ==null)
            return -1;
        if($manufacturer ==null)
            return -1;
        $ilc->deleteManufacturer(array($man_id));
        Transaction::createTransaction($this->consultant->id,'','','MANUFACTURER_REMOVED_FROM_ILC','ILC ID: '.$ilc_id.', Manufacturer ID: '.$man_id,'','','','','','');
        return  json_encode(array($ilc_id,$man_id));
    }

    //get the manufacturers assigned to a industry
    public function getManufacturersIndustry(){
        $ind_id = Input::get('IND_ID');
        $industry =Industry::find($ind_id);
        if($industry == null)
            return -1;
        $manufacturers =$industry->manufacturers;
        return json_encode($manufacturers);
    }

    public function removePendingIntroCall(){
        $iid = Input::get('IID');
        $ilc = Ilc::find($iid);
        if($ilc == null)
            return -1;
        $ilc->introCallDate = date('Y-m-d H:i:s');
        $ilc->save();
        return json_encode($iid);
    }

    public function sendCourtesyEmail(){
        $ind_id = Input::get('INDUSTRY');
        $manfList = Input::get('MANUFACTURERS');

        //all the ilc rows with that industry
        $ilcWthInd = Ilc::where('industry_id',$ind_id)->get();
        $emailsInds = '';
        foreach($ilcWthInd as $ilc){
            $emailsInds.=$ilc->email.',';
        }
        //remove the last colon
        $emailsInds = substr($emailsInds, 0, -1);
        $industryName = Industry::find($ind_id)->type;
        $sent = ToolsFunctions::curl(url("textCourtesyEmail?EMAILS=".urlencode($emailsInds)."&MANUFACTURERS=".urlencode($manfList)."&INDUSTRY=".urlencode($industryName)));
        if($sent == 1) {
            $params =  "Lead ids: ";
            foreach ($ilcWthInd as $ilc) {
                PlivoHelper::sendSMS($ilc->projectclientservices->project->lead->phone, 'You have received communication from PSU please check your email for updates.');
                $params .=$ilc->projectclientservices->project->lead->id.",";
            }
            Transaction::createTransaction($this->consultant->id,'','','COURTESY_EMAIL_SENT',$params,'','','','','','');
            return 1;
        }else
            return -1;
    }


    //load some needed info for the submission
    public function loadSubInfo(){
        $pid =Input::get('PID');
        $project = Project::find($pid);
        if($project != null){
            $clientName = $project->lead->fname." ".$project->lead->lname;
            $iid =Input::get('IID');
            $ilc = Ilc::find($iid);
            if($ilc == null)
                return -1;
            $inventionName = $ilc->inventionName;
            $manufacturers = $ilc->manufacturers;
            $result=array($clientName, $inventionName,$manufacturers);
            return json_encode($result);
        }
        return -1;
    }

    //get the manufacturers assigned to a industry
    public function loadManufacturersFromClient(){
        $iid =Input::get('IID');
        $ilc = Ilc::find($iid);
        if($ilc == null)
            return -1;
        $manufacturers = $ilc->manufacturers;
        return json_encode($manufacturers);
    }

    public function updateClientDetailsILC(){
        $iid = Input::get('IID');
        $field = Input::get('FIELD');
        $value = Input::get('INFO');
        $ilc = Ilc::find($iid);
        if($ilc != null){
            if($value != '' && ($field == 'phone' || $field == 'phone2')){
                $value = str_pad(preg_replace('/\D+/', '', $value), 11, '1', STR_PAD_LEFT);
            }
            $ilc->$field = $value;
            $ilc->save();

            if($field == 'invFname' || $field == 'invLname'){
                $clientName = $ilc->invFname." ".$ilc->invLname;
                return json_encode(array($field,$clientName));
            }
            return json_encode(array($field,$value));
        }
        return "-1";
    }

    public function checkDates(){
        $iid = Input::get('IID');
        $field = Input::get('COL');
        $check = Input::get('CHECK');
        $ilc =Ilc::find($iid);
        if($ilc == null)
            return -1;
        if($check == 1)
            $ilc->$field = date('Y-m-d H:i:s');
        else
            $ilc->$field = date('0000-00-00 00:00:00');
        $ilc->save();
        if($field == 'website_codes')
            ToolsFunctions::curl(url('sendWebsiteCodes?IID='.$iid));
        return json_encode($field);
    }

    public function changeDates(){
        $iid=Input::get('IID');
        $date=Input::get('DATE');
        $col=Input::get('COL');
        $ilc =Ilc::find($iid);
        if($ilc == null)
            return -1;
        $ilc->$col = date("Y-m-d 12:00:00",strtotime($date));
        $ilc->save();
        return 1;
    }

    public function selectCoordinator(){
        $iid=Input::get('IID');
        $value = Input::get('VALUE');
        $ilc =Ilc::find($iid);
        if($ilc == null)
            return -1;
        if($value != '0')
            $ilc->coordinator =$value;
        else
            $ilc->coordinator='';

        $ilc->save();
        return 1;
    }

    public function selectPatentStatus(){
        $iid=Input::get('IID');
        $value = Input::get('VALUE');
        $ilc =Ilc::find($iid);
        if($ilc == null)
            return -1;
        if($value != '0')
            $ilc->patent_status =$value;
        else
            $ilc->patent_status ='';
        $ilc->save();
        return 1;
    }

    public function updateWebsiteInfo(){
        $iid =Input::get('IID');
        $field =Input::get('FIELD');
        $value = Input::get('INFO');
        $ilc =Ilc::find($iid);
        if($ilc == null)
            return -1;
        $ilc->$field = $value;
        $ilc->save();
        return 1;
    }

    public function generateIlcPatentedContract($iid, $pid){
//        $pid = Input::get('PID');
        $ilc = Ilc::find($iid);

        if($ilc->coInvs !='')
            $coinventors = explode(',',$ilc->coInvs);
        else
            $coinventors =0;

        $date = strtotime(date('Y-m-d H:i:s'));
        $effectiveDate = date('l jS F Y',$date);
        $content = view('templates.ilc.empty_mail_patented_contract_ilc_template_pdf',array('ilc'=>$ilc, 'effectiveDate'=>$effectiveDate, 'coinventors'=>$coinventors));
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($content);
        $pdf->save("files/projects/".$ilc->fileno."/".$pid."/"."ilc_patented_contract.pdf");
    }

    public function sendPatentedContract(){
        $pid = Input::get('PID');
        $iid = Input::get('IID');
        $text = Input::get('TEXT');

        $this->generateIlcPatentedContract($iid,$pid);

        $result = ToolsFunctions::curl(url('sendIlcPatentedContract?PID='.$pid.'&IID='.$iid.'&TEXT='.urlencode($text)));

        return $result;
    }

    public function setCallTradeshow(){
        $iid = Input::get('IID');
        $value = Input::get('VALUE');
        $ilc = Ilc::find($iid);
        if($ilc != null){
            $ilc->callTradeshow = $value;
            $ilc->save();
            return 1;
        }
        return -1;
    }

    public function sendIlcToVendor(){
        $iid = Input::get('IID');
        $vendorId = Input::get('VID');
        $designType = Input::get('DESIGNT');
        $text = Input::get('TEXT');
        $fileIds = Input::get('FILES');

        if($designType == '2d')
            $dosD =1;
        else
            $dosD =0;
        foreach($fileIds as $fid){
            $uploadedFile = UploadedFiles::find($fid);
            if($uploadedFile == null)
                return -1;
            $uploadedFile->ilcVendors = 1;
            $uploadedFile->save();
        }
        $ilcVId = IlcVendors::createIlcVendor($iid,null,$vendorId,$dosD,$text);
        if($ilcVId != -1){
            $pid = Input::get('PID');
            $project = Project::find($pid);
            $vendor = Consultant::find($vendorId);
            $dueDate = date('Y-m-d 00:00:00',strtotime('+14 days'));

            $msgInbox = "New File was received from ILC.".
                "<br>File #: ".$project->lead->fileno."<br>Pin: ".$project->id."<br>Due Date: ".$dueDate;
            Inbox::createInbox($project->lead->id,$vendorId,$msgInbox,"ILC","ILC");//$vendorId

            ToolsFunctions::curl(url('notifyVendorNewFile?PID='.$pid."&EMAIL=".$vendor->email."&DDATE=".$dueDate));
            $ilcNote = new IlcNotes();
            $ilcNote->ilc_id = $iid;
            $ilcNote->notes = "Documents ".$designType." sent to vendor ".$vendor->fname." ".$vendor->lname.".";
            $ilcNote->system =1;
            $ilcNote->save();
            return 1;
        }
        return -1;
    }

    public function sendIlcBackToVendor(){
        $iid = Input::get('IID');
        $text = Input::get('TEXT');
        $selectedFiles = Input::get('SFILES');
        $unselectedFiles = Input::get('USFILES');

        if($selectedFiles != null)
            foreach($selectedFiles as $fid){
                $uploadedFile = UploadedFiles::find($fid);
                if($uploadedFile == null)
                    return -1;
                $uploadedFile->ilcVendors = 1;
                $uploadedFile->save();
            }
        if($unselectedFiles != null)
            foreach($unselectedFiles as $fid){
                $uploadedFile = UploadedFiles::find($fid);
                if($uploadedFile == null)
                    return -1;
                $uploadedFile->ilcVendors = 0;
                $uploadedFile->save();
            }
        $ilcV = IlcVendors::where('ilc_id',$iid)->first();
        if($ilcV != null){
            $ilcV->state=1;
            $ilcV->textBack = $text;
            $ilcV->filesRcvdDate =date('Y-m-d 00:00:00');
            $ilcV->save();
            $pid = Input::get('PID');
            $project = Project::find($pid);
            $vendor = Consultant::find($ilcV->vendorId);
            $dueDate = date('Y-m-d 00:00:00',strtotime('+14 days'));

            $msgInbox = "A File was sent back from ILC.".
                "<br>File #: ".$project->lead->fileno."<br>Pin: ".$project->id."<br>Due Date: ".$dueDate;
            Inbox::createInbox($project->lead->id,$ilcV->vendorId,$msgInbox,"ILC","ILC");//

            ToolsFunctions::curl(url('notifyFileBack?PID='.$pid."&EMAIL=".$vendor->email."&DDATE=".$dueDate));
            $ilcNote = new IlcNotes();
            $ilcNote->ilc_id = $iid;
            $ilcNote->notes = "File sent back to vendor due the following: ".$text.".";
            $ilcNote->system =1;
            $ilcNote->save();
            return 1;
        }
        return -1;
    }

}
