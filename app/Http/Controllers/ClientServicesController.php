<?php namespace App\Http\Controllers;

use App\Helpers\DocusignFunctions;
use App\Helpers\ToolsFunctions;
use App\Models\Consultant;
use App\Models\Inbox;
use App\Models\Lead;
use App\Models\Project;
use App\Models\ProjectClientServices;
use App\Models\Ilc;
use App\Models\Transaction;
use App\Models\UploadedFiles;
use App\Models\ClientSNotes;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use DB;
use Illuminate\Support\Facades\Session;

class ClientServicesController extends Controller {

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
    //sign contract
    public function sign()
    {
        $document = Input::get('DOCUMENT');
        $id = Input::get('ID');
        $coInvIndex = Input::get('COINVINDEX');
        $project = Project::find($id);
        $pCS=$project->clientServicesProject();
        $att = null;
        // to know if the contract is provisional or utility, to know the period of time in the ilc
        $prov_ut ="";
        $effectiveDate = "";
        if($pCS!=null) {
            $att = Consultant::find($pCS->attorney_id);
            if($pCS->hasType('UT') || $pCS->hasType('UPG_UT'))
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

        if($document == "patentedContract"){
            $date = strtotime(date('Y-m-d H:i:s'));
            $effectiveDate = date('l jS F Y',$date);
        }


        return view('omi.launch.client_services.sign',array('client'=>$this->client,'document'=>$document,'project_id'=>$id,
            'project'=>$project,'pcs'=>$pCS,'attorney'=>$att,'coInvCount'=>$coInvCount,'coInvs'=>$coInvs,'coInvIndex'=>$coInvIndex,'prov_ut'=>$prov_ut,
            'effectiveDate'=>$effectiveDate,'dateBy'=>$dateBy,'contractBy'=>$contractBy,'amountBy'=>$amountBy,
            'percentageBy'=>$percentageBy,'balanceBy'=>$balanceBy));
    }

    function manageInternalDocusignEmbeddedView($project,$envelopeId,$docName,$coInvNeedToSign){
        //primera ves en este metodo viene de createDocusignCSDocs()
        $last = 1;
        if($coInvNeedToSign){
            if(strlen($project->coInventor)!=0){
                $last += count(explode(',',$project->coInventor));
            }
        }
        $recipientId = $project->id;
        $clientUserId = $project->lead->id;
        $recipientName = ucwords($project->lead->fname." ".$project->lead->lname);
        $recipientEmail = $project->lead->email;

        DocusignFunctions::getTheEmbeddedView($docName,$recipientEmail,$recipientName,$recipientId,$clientUserId,$envelopeId,$project->id,$last);
    }

    public function createDocusignCSDocs()
    {
        $document = Input::get('document');
        $project = Project::find(Input::get('project_id'));
        if ($project != null) {
            $fileUrl = "files/projects/".$this->client->fileno."/".$project->id."/";
            $signPos = [400,800,1,400,440];
            $coInvNeedToSign = 0;
            switch($document){
                case "psa":
                    $docName = "agreementPSA";
                    $signPos = [400,268,7,400,440];
                    $coInvNeedToSign = 1;
                    break;
                case "ddr":
                    $docName = $document;
                    $this->prepareTemplateDocusignCSDocs($document, $project);
                    break;
            }
            $envelopeId = DocusignFunctions::docuSignClientServicesWithDoc($fileUrl.$docName.".pdf",$project,$signPos);
            $this->manageInternalDocusignEmbeddedView($project,$envelopeId,$docName,$coInvNeedToSign);
        }
        return redirect('launch');
    }

    //after signed the document created the file and save it
    public function signed()
    {
        $document = Input::get('document');
        $img = Input::get('output');
        $proj_id = Input::get('project_id');
        $coInvIndex = Input::get('COINV');
        //separate the case of add_dec cause there is more than one sign
        if($document=="addDeclarationU" || $document=="addDeclarationD"){
            $project = Project::find($proj_id);
            $coInvs = explode(',',$project->coInventor);
            for($i=0;$i<count($coInvs);$i++){
                $aux_img = Input::get('output'.$i);
                if($aux_img) {
                    $image = ToolsFunctions::sigJsonToImage($aux_img);
                    if (!File::exists("files/projects/" . $this->client->fileno)) {
                        File::makeDirectory("files/projects/" . $this->client->fileno, 0755, true);
                    }
                    $result = imagejpeg($image, "files/projects/" . $this->client->fileno . "/signature_add_dec".$i.".jpg");
                }
            }
        }
        elseif($document == "ilc_agreement" || $document == "ilc_patented_contract"){
            $project = Project::find($proj_id);
            $coInvs = explode(',',$project->coInventor);
            for($i=0;$i<count($coInvs);$i++){
                $aux_img = Input::get('output'.($i+1));
                if($aux_img) {
                    $image = ToolsFunctions::sigJsonToImage($aux_img);
                    if (!File::exists("files/projects/" . $this->client->fileno)) {
                        File::makeDirectory("files/projects/" . $this->client->fileno, 0755, true);
                    }
                    $result = imagejpeg($image, "files/projects/" . $this->client->fileno . "/signature_ilc".($i+1).".jpg");
                }
            }
        }
        elseif($document == "upgradeLetter"){//also separate this case cause have 2 signs
            $img_1 = Input::get('output_1');
            $img_2 = Input::get('output_2');
            if($img_1){
                $image = ToolsFunctions::sigJsonToImage($img_1);
                if (!File::exists("files/projects/" . $this->client->fileno)) {
                    File::makeDirectory("files/projects/" . $this->client->fileno, 0755, true);
                }
                $result = imagejpeg($image, "files/projects/" . $this->client->fileno . "/signature_upgLetter_inv.jpg");
            }
            if($img_2){
                $image = ToolsFunctions::sigJsonToImage($img_2);
                if (!File::exists("files/projects/" . $this->client->fileno)) {
                    File::makeDirectory("files/projects/" . $this->client->fileno, 0755, true);
                }
                $result = imagejpeg($image, "files/projects/" . $this->client->fileno . "/signature_upgLetter_coInv.jpg");
            }
        }
        elseif($document == "provInvoice"){//also separate this case cause have 2 signs
            $img_1 = Input::get('output');
            $img_2 = Input::get('output2');
            if($img_1){
                $image = ToolsFunctions::sigJsonToImage($img_1);
                if (!File::exists("files/projects/" . $this->client->fileno)) {
                    File::makeDirectory("files/projects/" . $this->client->fileno, 0755, true);
                }
                $result = imagejpeg($image, "files/projects/" . $this->client->fileno . "/signature_provInv_inv.jpg");
            }
            if($img_2){
                $image = ToolsFunctions::sigJsonToImage($img_2);
                if (!File::exists("files/projects/" . $this->client->fileno)) {
                    File::makeDirectory("files/projects/" . $this->client->fileno, 0755, true);
                }
                $result = imagejpeg($image, "files/projects/" . $this->client->fileno . "/signature_proInv_coInv.jpg");
            }
        }
        elseif($document == "ilc_release"){//also separate this case cause could have several signs
            $project = Project::find($proj_id);
            $coInvs = explode(',',$project->coInventor);
            for($i=0;$i<count($coInvs);$i++){
                $aux_img = Input::get('output'.($i+1));
                if($aux_img) {
                    $image = ToolsFunctions::sigJsonToImage($aux_img);
                    if (!File::exists("files/projects/" . $this->client->fileno)) {
                        File::makeDirectory("files/projects/" . $this->client->fileno, 0755, true);
                    }
                    $result = imagejpeg($image, "files/projects/" . $this->client->fileno . "/signature_ilcR".($i+1).".jpg");
                }
            }

        }
        elseif($document == "agreementExt"){
            $project = Project::find($proj_id);
            if($project->coInventor != ''){
                $aux_img = Input::get('output1');
                if($aux_img) {
                    $image = ToolsFunctions::sigJsonToImage($aux_img);
                    if (!File::exists("files/projects/" . $this->client->fileno)) {
                        File::makeDirectory("files/projects/" . $this->client->fileno, 0755, true);
                    }
                    $result = imagejpeg($image, "files/projects/" . $this->client->fileno . "/signatureCoInv.jpg");
                }
            }
        }
        if($img){
            $image = ToolsFunctions::sigJsonToImage($img);
            if(!File::exists("files/projects/".$this->client->fileno)) {
                File::makeDirectory("files/projects/".$this->client->fileno, 0755, true);
            }
            switch($document){
                case ('declarationU') :
                case ('declarationD'):
                    $result = imagejpeg($image, "files/projects/".$this->client->fileno."/signature_dec.jpg");
                    break;
                case ('microEntityU') :
                case ('microEntityD') :
                case ('microEntityP') :
                    if($coInvIndex!=null && $coInvIndex == 0)
                        $result = imagejpeg($image, "files/projects/".$this->client->fileno."/signature_mE.jpg");
                    else
                        $result = imagejpeg($image, "files/projects/".$this->client->fileno."/signature_mE_coInv".$coInvIndex.".jpg");
                    break;
                case ("poaU") :
                case ("poaD") :
                    if($coInvIndex!=null && $coInvIndex == 0)
                        $result = imagejpeg($image, "files/projects/".$this->client->fileno."/signature_poa.jpg");
                    else
                        $result = imagejpeg($image, "files/projects/".$this->client->fileno."/signature_poa_coInv".$coInvIndex.".jpg");
                    break;
                default:
                    $result = imagejpeg($image, "files/projects/".$this->client->fileno."/signature.jpg");
                    break;
            }

        }
        $pdf = $this->createDocument($document);

        // mark the doc like signed and upload it to the db
        $cS = ProjectClientServices::where('project_id',$proj_id)->first();
        if($cS!=null){
            switch($document){
                case ("microEntityP"):
                case ("microEntityU"):
                case ("microEntityD"):
                    if( $coInvIndex==0){
                        $uploadFile=UploadedFiles::where('project_id',$proj_id)->where('fileName',"certification_of_".$document.".pdf")->first();
                        if($uploadFile == null){
                            $uploadFile = new UploadedFiles();
                            $uploadFile->project_id = $proj_id;
                            $uploadFile->url = "files/projects/".$this->client->fileno."/".$proj_id."/certification_of_".$document.".pdf";
                            $uploadFile->fileName = "certification_of_".$document.".pdf";
                        }
                    }else{
                        $uploadFile=UploadedFiles::where('project_id',$proj_id)->where('fileName',"certification_of_".$document."_coInv".$coInvIndex.".pdf")->first();
                        if($uploadFile == null){
                            $uploadFile = new UploadedFiles();
                            $uploadFile->project_id = $proj_id;
                            $uploadFile->url = "files/projects/".$this->client->fileno."/".$proj_id."/certification_of_".$document."_coInv".$coInvIndex.".pdf";
                            $uploadFile->fileName = "certification_of_".$document."_coInv".$coInvIndex.".pdf";
                        }
                    }
                    break;
                case ("poaU"):
                case ("poaD"):
                    if($document=="poaU")
                        $aux_doc="power_of_attorneyU";
                    else
                        $aux_doc="power_of_attorneyD";

                    if( $coInvIndex==0){
                        $uploadFile=UploadedFiles::where('project_id',$proj_id)->where('fileName',$aux_doc.".pdf")->first();
                        if($uploadFile == null){
                            $uploadFile = new UploadedFiles();
                            $uploadFile->project_id = $proj_id;
                            $uploadFile->url = "files/projects/".$this->client->fileno."/".$proj_id."/".$aux_doc.".pdf";
                            $uploadFile->fileName = $aux_doc.".pdf";
                        }
                    }else{
                        $uploadFile=UploadedFiles::where('project_id',$proj_id)->where('fileName',$aux_doc."_coInv".$coInvIndex.".pdf")->first();
                        if($uploadFile != null){
                            $uploadFile->delete();
                        }
                        $uploadFile = new UploadedFiles();
                        $uploadFile->project_id = $proj_id;
                        $uploadFile->url = "files/projects/".$this->client->fileno."/".$proj_id."/".$aux_doc."_coInv".$coInvIndex.".pdf";
                        $uploadFile->fileName = $aux_doc."_coInv".$coInvIndex.".pdf";
                    }
                    break;
                case ("addDeclarationU"):
                case ("addDeclarationD"):
                    if($document=="addDeclarationU")
                        $aux_doc="additional_inventorsU";
                    else
                        $aux_doc="additional_inventorsD";
                    $uploadFile=UploadedFiles::where('project_id',$proj_id)->where('fileName',$aux_doc.".pdf")->first();
                    if($uploadFile != null){
                        $uploadFile->delete();
                    }
                    $uploadFile = new UploadedFiles();
                    $uploadFile->project_id = $proj_id;
                    $uploadFile->url = "files/projects/".$this->client->fileno."/".$proj_id."/".$aux_doc.".pdf";
                    $uploadFile->fileName = $aux_doc.".pdf";
                    break;
                case ("agreementExt"):
                    $uploadFile=UploadedFiles::where('project_id',$proj_id)->where('fileName',"agreement_extension.pdf")->first();
                    if($uploadFile != null){
                        $uploadFile->delete();
                    }
                    $uploadFile = new UploadedFiles();
                    $uploadFile->project_id = $proj_id;
                    $uploadFile->url = "files/projects/".$this->client->fileno."/".$proj_id."/agreement_extension.pdf";
                    $uploadFile->fileName = "agreement_extension.pdf";
                    $cS->agreementExt_rcvd = date('Y-m-d H:i:s');
                    $cS->save();
                    if($cS->contract != null){
                        $contract =$cS->contract;
                        $contract->price = $cS->contract->ppaTotalPrice() +1495;
                        $contract->save();
                    }
                    $csNote = new ClientSNotes();
                    $csNote->notes = 'Agreement Extension received.';
                    $csNote->projectclientservices_id = $cS->id;
                    $csNote->save();
                    break;
                case ("ilc_agreement"):
                    $uploadFile=UploadedFiles::where('project_id',$proj_id)->where('fileName',"ilc_agreement_signed.pdf")->first();
                    if($uploadFile != null){
                        $uploadFile->delete();
                    }
                    $uploadFile = new UploadedFiles();
                    $uploadFile->project_id = $proj_id;
                    $uploadFile->url = "files/projects/".$this->client->fileno."/".$proj_id."/ilc_agreement_signed.pdf";
                    $uploadFile->fileName = "ilc_agreement_signed.pdf";
                    $uploadFile->ilc =1;
                    break;
                case ("PCT_PSA"):
                    $uploadFile=UploadedFiles::where('project_id',$proj_id)->where('fileName',"PCT_PSA_signed.pdf")->first();
                    if($uploadFile != null){
                        $uploadFile->delete();
                    }
                    $uploadFile = new UploadedFiles();
                    $uploadFile->project_id = $proj_id;
                    $uploadFile->url = "files/projects/".$this->client->fileno."/".$proj_id."/PCT_PSA_signed.pdf";
                    $uploadFile->fileName = "PCT_PSA_signed.pdf";
                    break;
                case "ilc_patented_contract":
                    $uploadFile=UploadedFiles::where('project_id',$proj_id)->where('fileName',"ilc_patented_contract_signed.pdf")->first();
                    if($uploadFile != null){
                        $uploadFile->delete();
                    }
                    $uploadFile = new UploadedFiles();
                    $uploadFile->project_id = $proj_id;
                    $uploadFile->url = "files/projects/".$this->client->fileno."/".$proj_id."/ilc_patented_contract_signed.pdf";
                    $uploadFile->fileName = "ilc_patented_contract_signed.pdf";
                    $uploadFile->ilc =1;
                    $ilc = Ilc::where('projectclientservices_id',$cS->id)->first();
                    if($ilc != null){
                        $ilc->patentedContractRcvdDate = date('Y-m-d H:i:s');
                        $ilc->save();
                    }
                    break;
                default:
                    $uploadFile=UploadedFiles::where('project_id',$proj_id)->where('fileName',$document.".pdf")->first();
                    if($uploadFile != null){
                        $uploadFile->delete();
                    }
                    $uploadFile = new UploadedFiles();
                    $uploadFile->project_id = $proj_id;
                    $uploadFile->url = "files/projects/".$this->client->fileno."/".$proj_id."/$document.pdf";
                    $uploadFile->fileName = $document.".pdf";
                    break;
            }


            if($document  == "trademark" || $document  == "copyrightQuestionnaire")
                $uploadFile->clientVendor =1;
            if($document == "declarationU" || $document == "declarationD" || $document == "addDeclarationU" || $document == "addDeclarationD" || $document == "microEntityD" || $document == "microEntityU" || $document == "microEntityP" || $document == "poaD" || $document == "poaU") {
                $uploadFile->clientVendor = 1;
                $uploadFile->attorney = 1;
            }
            $uploadFile->save();

                                    //ir disminuyendo los documentos adicionales que se crean para los coinventors
                                                $doc = $cS->getDocsByName($document);
                                                if($doc!=null){
                                                    if(($document=="poaD" || $document=="poaU" || $document=="microEntityD" || $document=="microEntityU" || $document=="microEntityP")&& $doc->count >1){
                                                        $doc->count = $doc->count-1;
                                                    }else{
                                                        $doc->count = $doc->count-1;
                                                        $doc->signdate = date('m-d-Y');
                                                        $doc->file_id=$uploadFile->id;
                                                        $doc->notes_resend="";
                                                    }

                                                    $doc->save();
                                                }

                                    //to know if dnt remains docs returned and change the status of the project client services
                                                $allDocs = $cS->getDocsCS();
                                                $existReturn = false;
                                                foreach($allDocs as $doc)
                                                    if($doc->notes_resend!=""){
                                                        $existReturn =true;
                                                        break;
                                                    }
                                                if(!$existReturn) {
                                                    $cS->returnedReason="";
                                                    $cS->completed = 1;
                                                    $cS->save();
                                                }
                                                $clientS = Consultant::where('usr','clientservices')->first();
                                                if($clientS!=null){
                                                    $aux_id=$clientS->id;
                                                    $msgInbox = "The document ".$document." was signed.<br>".date("m-d-Y H:i:s")." <br>Client: ".$this->client->fname." ".$this->client->lname.
                                                        "<br>File #: ".$this->client->fileno."<br>Pin: ".$proj_id;
                                                    Inbox::createInbox($this->client->id,$aux_id,$msgInbox,"CLIENT SERVICES","CLIENT");
                                                }


//check if the poa and dec was signed both already
            if($document=="poaD" || $document=="declarationD"){
                $auxPoa = $cS->getDocsByName("poaD");
                $auxDec = $cS->getDocsByName("declarationD");
                if($auxPoa!=null && $auxPoa->count<=0 && $auxDec!=null && $auxDec->count<=0) {
                    $date =date('Y-m-d');
                    $cS->poaDecRcvdD_created_at = $date;
                    $cS->save();
                }
            }
            elseif($document=="poaU" || $document=="declarationU"){
                $auxPoa = $cS->getDocsByName("poaU");
                $auxDec = $cS->getDocsByName("declarationU");
                if($auxPoa!=null && $auxPoa->count<=0 && $auxDec!=null && $auxDec->count<=0) {
                    $date =date('m-d-Y');
                    $cS->poaDecReceived_created_at = $date;
                    $cS->save();
                }
            }

            /*//            generate the consent of electronic signature from client
            if($document !="ddr" && $document!="agreementPSA" && $document!="PCT_PSA"){
                switch($document){
                    case ("microEntityP"):
                    case ("microEntityU"):
                    case ("microEntityD"):
                        $auxName = "certification_of_".$document;
                        break;
                    case ("poaU"):
                    case ("poaD"):
                        if($document=="poaU")
                            $auxName="power_of_attorneyU";
                        else
                            $auxName="power_of_attorneyD";
                        break;
                    case ("addDeclarationU"):
                    case ("addDeclarationD"):
                        if($document=="addDeclarationU")
                            $auxName="additional_inventorsU";
                        else
                            $auxName="additional_inventorsD";
                        break;
                    case ("agreementExt"):
                        $auxName="agreement_extension";
                        break;
                    default:
                        $auxName =$document;
                        break;
                }

                if($project->coInventor !='')
                    $coInventors = ' & '.$project->coInventor;
                else
                    $coInventors ='';
                $pdf = App::make('dompdf.wrapper');
                $pdf->loadHTML('<table align="center" width="100%">
                        <tr><td>Date: '.date('m-d-Y').'</td></tr>
                        <tr><td>Client Name: '.$lead->fname.' '.$lead->lname.$coInventors.'</td></tr>
                        <tr><td>Client Address: '.$lead->street.', '.$lead->city.', '.$lead->state.', '.$lead->zip.'</td></tr>
                        <tr><td>Ip Address: '.$_SERVER["REMOTE_ADDR"].'</td></tr>
                        <tr><td>Document Name: '.$auxName.'</td></tr></table><br>
                        <table align="center" width="100%">
                        <tr><td><p>The Inventor acknowledges their consent to this document via Electronic Signature.
                        This document and any counterparts to this document will be deemed an original. To expedite the
                        submittal of this Document, the Inventor acknowledges that Electronic Transmissions of the Document
                        will be equivalent to original documents. "Electronic Transmission" will mean copies that are
                        reproduced or transmitted as complete and accurate reproductions and transmissions of this original.
                        Signatories have the option to opt out and sign with a paper signature instead.</p></td></tr>
                        </table>');

                $docname = $lead->fileno."_electronicSignatureConsent_".$auxName.".pdf";
                $pdf->save("files/projects/".$lead->fileno."/".$project->id."/".$docname);

                $uploadFile=UploadedFiles::where('project_id',$proj_id)->where('fileName',$docname)->first();
                if($uploadFile != null){
                    $uploadFile->delete();
                }
                $uploadFile = new UploadedFiles();
                $uploadFile->project_id = $proj_id;
                $uploadFile->url = "files/projects/".$this->client->fileno."/".$proj_id."/".$docname;
                $uploadFile->fileName = $docname;
                $uploadFile->public = 1;
                if($auxName =='ilc_agreement' || $auxName =='ilc_patent_pending' || $auxName== 'ilc_patented_contract')
                    $uploadFile->ilc = 1;
                $uploadFile->save();
            }*/

            Transaction::createTransaction($cS->project->consultant_id,$cS->project->lead_id,'','SIGN_LEGAL_DOC',$document,$proj_id,'','','','','');

            if(count($cS->getDocsCS())<1)
                return redirect('launch/project/'.$proj_id);
        }
        return redirect('launch/client_services/docs/'.$proj_id);
    }

    //create  pdf file
    public function createDocument($document, $id=null)
    {
        $fname = $this->client->fname;
        $lname = $this->client->lname;
        $co_name = strlen($this->client->coInventor)>0?" & ".$this->client->coInventor:"";
        $fileno = $this->client->fileno;
        $content ="";
        $name ="";
        $project_id=Input::get('project_id');
        if($id==null)
            $project = Project::find($project_id);
        else
            $project = Project::find($id);

        if($document=='trademark_letter')
        {
            $mark = Input::get('mark');
            $name ="trademark_letter";
            $dateSign = new \DateTime(Input::get('trademark_letter_date'));
            $content = view('templates.client_services.mail_trademark_too_descriptive_template_pdf',
                array('fname'=>$fname." ".$lname,'mark'=>$mark,'fileno'=>$fileno,'day'=>$dateSign->format("d"),
                    'month'=>$dateSign->format("F"),'year'=>$dateSign->format("Y")));
        }
        elseif($document=='trademark'){
            $name="trademark";
            $ownerMark=Input::get('nameInput');
            $countryCitizenship=Input::get('nationalityInput');
            $address=Input::get('addressInput');
            $cityStateZip=Input::get('cityInput');
            $phone=Input::get('phoneInput');
            $email=Input::get('emailInput');
            $mark=Input::get('markInput');
            $markDate=Input::get('markDateInput');
            $descGoods=Input::get('descGoodsInput');
            $descMarkUse=Input::get('descMarkUseInput');
            $attachedS=Input::get('attached');
            $descSpecimen=Input::get('descSpecimenInput');

            $content = view('templates.client_services.mail_trademark_copyright_template_pdf',
                array('fname'=>$fname." ".$lname." ".$co_name,
                    'ownerMark'=>$ownerMark,
                    'countryCitizenship'=>$countryCitizenship,
                    'address'=>$address,
                    'cityStateZip'=>$cityStateZip,
                    'phone'=>$phone,
                    'email'=>$email,
                    'mark'=>$mark,
                    'markDate'=>$markDate,
                    'descGoods'=>$descGoods,
                    'descMarkUse'=>$descMarkUse,
                    'attachedS'=>$attachedS,
                    'descSpecimen'=>$descSpecimen,
                    'client'=>$this->client));
        }
        else if($document=='pct_questionnaire')
        {
            $name ="pct_questionnaire";
            $titleInput = Input::get('titleInput');
            $nameInput = Input::get('nameInput');
            $addressInput = Input::get('addressInput');
            $dateOfBirthInput = Input::get('dateOfBirthInput');
            $nationalityInput = Input::get('nationalityInput');
            $citizenInput = Input::get('citizenInput');
            $domiciledInput = Input::get('domiciledInput');
            $content = view('templates.client_services.mail_pct_questionnarie_template_pdf',
                array('fname'=>$nameInput,'address'=>$addressInput,'title'=>$titleInput,
                    'dateBirth'=>$dateOfBirthInput,'nationality'=>$nationalityInput,
                    'citizen'=>$citizenInput,'domiciled'=>$domiciledInput,'client'=>$this->client));
        }
        else if($document=='ilc_patent_pending')
        {
            $name ="ilc_patent_pending";
            $application_number = Input::has('application_number')?Input::get('application_number'):'Application number';
            $content = view('templates.client_services.mail_ilc_patent_pending_template_pdf',
                array('fname'=>$fname." ".$lname." ".$co_name,'application_number'=>$application_number));
        }
        else if($document=='applicationCoverPagePCT')
        {
            $name ="applicationCoverPagePCT";
            $approved = Input::get('approveRadio');
            $content = view('templates.client_services.mail_ApplicationCoverPage_PCT_template_pdf',
                array('fname'=>$fname." ".$lname." ".$co_name,'approved'=>$approved,'co_inventor'=>$co_name));
        }
        else if($document == 'applicationCoverPageProvisional')
        {
            $name ="applicationCoverPageProvisional";
            $approved = Input::get('approveRadio');
            $content = view('templates.client_services.mail_ApplicationCoverPage_Provisional_template_pdf',
                array('fname'=>$fname." ".$lname." ".$co_name,'approved'=>$approved,'co_inventor'=>$co_name));
        }
        else if($document == 'copyrightQuestionnaire')
        {
            $name ="copyrightQuestionnaire";
            $titleInput = Input::get('titleInput');
            $nameInput = Input::get('nameInput');
            $addressInput = Input::get('addressInput');
            $dateOfBirthInput = Input::get('dateOfBirthInput');
            $nationalityInput = Input::get('nationalityInput');
            $citizenInput = Input::get('citizenInput');
            $domiciledInput = Input::get('domiciledInput');
            $categoryInput = Input::get('categoryInput');
            $claimantRadio = Input::get('claimantRadio');
            $materialsInput = Input::get('materialsInput');
            $copyIncludeRadio = Input::get('copyIncludeRadio');

            $content = view('templates.client_services.mail_copyright_questionnarie_template_pdf',
                array('fname'=>$fname." ".$lname." ".$co_name,
                    'titleInput'=>$titleInput,
                    'nameInput'=>$nameInput,
                    'addressInput'=>$addressInput,
                    'dateOfBirthInput'=>date('m/d/Y',strtotime($dateOfBirthInput)),
                    'nationalityInput'=>$nationalityInput,
                    'citizenInput'=>$citizenInput,
                    'domiciledInput'=>$domiciledInput,
                    'categoryInput'=>$categoryInput,
                    'claimantRadio'=>$claimantRadio,
                    'materialsInput'=>$materialsInput,
                    'copyIncludeRadio'=>$copyIncludeRadio,
                    'client'=>$this->client));
        }
        else if($document == 'ph2AttorneyCoverSheet')
        {
            $name ="ph2AttorneyCoverSheet";
            $provisional = Input::get('provisional')=="on"?1:0;
            $utility = Input::get('utility')=="on"?1:0;
            $design = Input::get('design')=="on"?1:0;
            $epo = Input::get('epo')=="on"?1:0;
            $pct = Input::get('pct')=="on"?1:0;
            $upgrade = Input::get('upgrade')=="on"?1:0;
            $trademark = Input::get('trademark')=="on"?1:0;
            $copyright = Input::get('copyright')=="on"?1:0;
            $agreement = Input::get('agreement')=="on"?1:0;
            $graphic = Input::get('graphic')=="on"?1:0;
            $product = Input::get('product')=="on"?1:0;
            $business = Input::get('business')=="on"?1:0;
            $content = view('templates.client_services.mail_ph2AttorneyCoverSheet_template_pdf',
                array('fname'=>$fname." ".$lname." ".$co_name,
                    'client'=>$this->client,
                    'provisional'=>$provisional,
                    'utility'=>$utility,
                    'design'=>$design,
                    'epo'=>$epo,
                    'pct'=>$pct,
                    'upgrade'=>$upgrade,
                    'trademark'=>$trademark,
                    'copyright'=>$copyright,
                    'agreement'=>$agreement,
                    'graphic'=>$graphic,
                    'product'=>$product,
                    'business'=>$business));
        }
        else if($document == 'PCT_PSA')
        {
            $pCS=$project->clientServicesProject();
            $att = Consultant::find($pCS->attorney_id);
            $name ="PCT_PSA_signed";
            $dateSign = new \DateTime(Input::get('inventor_date'));
            $content = view('templates.client_services.mail_agreementPCTPSA_template_pdf',
                array('project'=>$project,'client'=>$this->client,'day'=>$dateSign->format("d"),
                    'month'=>$dateSign->format("m"),
                    'year'=>$dateSign->format("Y"), 'fileno'=>$fileno));
        }
        else if($document == 'declarationD' || $document == 'declarationU'){
            $name = $document;
            $pCS=$project->clientServicesProject();
            $att = Consultant::find($pCS->attorney_id);
            if($project->coInventor== "")
                $coInvCount = 0;
            else
                $coInvCount =count(explode(',',$project->coInventor));
            $sheetsCount = 0;
            if($coInvCount>0) {
                $sheetsCount = round($coInvCount / 3);
                if ($coInvCount % 3 > 0)
                    $sheetsCount++;
            }
            if($document == 'declarationD')
                $content = view('templates.client_services.mail_declaration_template_pdf',array('client'=>$this->client,'project'=>$project,'pcs'=>$pCS ,'fileno'=>$fileno,'attorney'=>$att,'sheetsCount'=>$sheetsCount,'design'=>1));
            else
                $content = view('templates.client_services.mail_declaration_template_pdf',array('client'=>$this->client,'project'=>$project,'pcs'=>$pCS ,'fileno'=>$fileno,'attorney'=>$att,'sheetsCount'=>$sheetsCount,'design'=>0));
        }
        else if($document == 'microEntityD' || $document == 'microEntityU' || $document == 'microEntityP'){
            $coInvIndex = Input::get('COINV');
            $design =0;
            if($document == 'microEntityD'){
                $name = "certification_of_microEntityD";
                $design =1;
            }
            else if($document == 'microEntityU')
                $name = "certification_of_microEntityU";
            else if($document == 'microEntityP')
                $name = "certification_of_microEntityP";

            if($coInvIndex != null && $coInvIndex != 0)
                $name .="_coInv".$coInvIndex;

            $pCS=$project->clientServicesProject();
            $coInvs = explode(',',$project->coInventor);
            $content = view('templates.client_services.mail_microentity_template_pdf',
                array('client'=>$this->client,'project'=>$project, 'fileno'=>$fileno,'pcs'=>$pCS,'coInvIndex'=>$coInvIndex, 'coInvs'=>$coInvs,'design'=>$design));
        }
        else if($document == 'poaD' || $document == 'poaU'){
            if($document == 'poaD'){
                $name = "power_of_attorneyD";
                $design =1;
            }
            elseif($document == 'poaU') {
                $name = "power_of_attorneyU";
                $design =0;
            }


            $coInvIndex = Input::get('COINV');
            if($coInvIndex != null && $coInvIndex != 0)
                $name .= "_coInv".$coInvIndex;

            $pCS=$project->clientServicesProject();
            $coInvs = explode(',',$project->coInventor);
            $att = Consultant::find($pCS->attorney_id);
            if($project->coInventor == '')
                $coInvCount = 0;
            else
                $coInvCount = count($coInvs);
            $content = view('templates.client_services.mail_poa_template_pdf',
                array('client'=>$this->client,'attorney'=>$att,'project'=>$project,'fileno'=>$fileno,'pcs'=>$pCS, 'coInvIndex'=>$coInvIndex, 'coInvs'=>$coInvs, 'coInvCount'=>$coInvCount,'design'=>$design));
        }
        else if($document == 'addDeclarationU' || $document == 'addDeclarationD'){
            if($document == 'addDeclarationU')
                $name = "additional_inventorsU";
            elseif($document == 'addDeclarationD')
                $name = "additional_inventorsD";
            $residence = array();
            $state = array();
            $country = array();
            $mAddress = array();
            $city = array();
            $state1 = array();
            $zip = array();
            $country1 = array();
            $coInvs = explode(',',$project->coInventor);
            if($project->coInventor== "")
                $coInvCount = 0;
            else
                $coInvCount = count($coInvs);
            for($i=0;$i<$coInvCount;$i++){
                $residence[]    =   Input::get('residence_'.$i);
                $state[]        =   Input::get('state_'.$i);
                $country[]      =   Input::get('country_'.$i);
                $mAddress[]     =   Input::get('mAddress_'.$i);
                $city[]         =   Input::get('city_'.$i);
                $state1[]       =   Input::get('state1_'.$i);
                $zip[]          =   Input::get('zip_'.$i);
                $country1[]     =   Input::get('country1_'.$i);
            }

            $coInvInfo=array('coInv'=>$coInvs,'client'=>$this->client ,'residence'=>$residence,'state'=>$state,'country'=>$country,'mAddress'=>$mAddress,'city'=>$city,'state1'=>$state1,'zip'=>$zip,'country1'=>$country1);
            $content = view('templates.client_services.mail_add_declaration_template_pdf',
                array('client'=>$this->client,'fileno'=>$fileno,'coInvCount'=>$coInvCount,'coInvInfo'=>$coInvInfo));
        }else if($document == "upgradeLetter"){
            $name = "upgradeLetter";
            $plan_4 = Input::get('plan_4');
            $plan_5 = Input::get('plan_5');
            $pcs = $project->clientServicesProject();
            $content = view('templates.client_services.mail_upgradePCTEPO_template_pdf',array('client'=>$this->client,'plan_4'=>$plan_4,'plan_5'=>$plan_5,'project'=>$project,'pcs'=>$pcs));
        }else if($document == "upgradeLetterPCT"){
            $name = "upgradeLetterPCT";
            $plan_5 = Input::get('plan_5');
            $pcs = $project->clientServicesProject();
            $content = view('templates.client_services.mail_upgradePCT_template_pdf',array('client'=>$this->client,'plan_5'=>$plan_5,'project'=>$project,'pcs'=>$pcs));
        }else if($document == "ilc_agreement"){
            $name = "ilc_agreement_signed";
            $pCS=$project->clientServicesProject();
            $time = str_replace('-','/',$pCS->marketingAgrSent_created_at);
            $time1 = strtotime($time);
            $effectiveDate = date('l jS F Y',$time1);
            $prov_ut="";
            if($pCS->hasType('UT') || $pCS->hasType('UPG_UT'))
                $prov_ut="U";
            elseif($pCS->hasType('PROV'))
                $prov_ut="P";
            $pCS->marketingAgrReceived_created_at = date('m-d-Y');
            if($pCS->phase == 3){
                $pCS->phase = 4;
                $pCS->changePhaseDate=date('Y-m-d 00:00:00');
            }
            $pCS->save();
            ToolsFunctions::curl(url("emailReceivedILC?ID=$project_id"));
            $coInvs = explode(',',$project->coInventor);
            if($project->coInventor== "")
                $coInvCount = 0;
            else
                $coInvCount = count($coInvs);
            $content = view('templates.client_services.mail_ILC_template_pdf',array('client'=>$this->client,'fileno'=>$fileno,'effectiveDate'=>$effectiveDate,'prov_ut'=>$prov_ut,'coInvCount'=>$coInvCount,'coInvs'=>$coInvs));
        }elseif($document == "ilc_patented_contract"){
            $name = "ilc_patented_contract_signed";
            $ilc = Ilc::where('fileno',$project->lead->fileno)->first();
            if($ilc == null)
                return -1;
            if($ilc->coInvs !='')
                $coinventors = explode(',',$ilc->coInvs);
            else
                $coinventors =0;

            $date = strtotime(date('Y-m-d H:i:s'));
            $effectiveDate = date('l jS F Y',$date);
            $content = view('templates.ilc.mail_patented_contract_ilc_template_pdf',array('ilc'=>$ilc, 'effectiveDate'=>$effectiveDate, 'coinventors'=>$coinventors));
        }else if($document == "provInvoice"){
            $name = "provInvoice";
            $wishNoProv =Input::get('wishNoProv');
            $understandLose =Input::get('understandLose');
            $data = ToolsFunctions::obtainPPAInfo($project->id);
            $dateBy= $data['PPA_Received_Date__c'];
            $contractBy = $data['PPA_Contract_Amount__c'];
            $amountBy = $data['PPA_Payment_Amount__c'];
            $percentageBy = round($data['PPA_Percentage_Paid__c'],2);
            $balanceBy = $contractBy - $amountBy;
            $content = view('templates.client_services.mail_prov_invoice_template_pdf',array('client'=>$project->lead,'amountBy'=>$amountBy,'dateBy'=>$dateBy,'balanceBy'=>$balanceBy,'percentageBy'=>$percentageBy,'contractBy'=>$contractBy,'wishNoProv'=>$wishNoProv,'understandLose'=>$understandLose));
        }else if($document == "ilc_release"){
            $name = "ilc_release";
            $pCS=$project->clientServicesProject();
            $pCS->releaseFormReceived_created_at = date('m-d-Y');
            if($pCS->phase == 3){
                $pCS->phase = 4;
                $pCS->changePhaseDate=date('Y-m-d 00:00:00');
            }
            $pCS->save();
            $coInvs = explode(',',$project->coInventor);
            if($project->coInventor== "")
                $coInvCount = 0;
            else
                $coInvCount = count($coInvs);
            $content =  view('templates.client_services.mail_ilc_release_template_pdf',array('client'=>$project->lead,'coInvCount'=>$coInvCount));
        }elseif($document == "agreementExt"){
            $name ="agreement_extension";
            $coInvs = explode(',',$project->coInventor);
            $pCS =$project->clientServicesProject();
            $client =$project->lead;
            $content = view('templates.client_services.mail_agreementExtension_template_pdf',
                array('client'=>$client,'pcs'=>$pCS,'coInvs'=>$coInvs));
        }

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($content);
        $pdf->save("files/projects/".$this->client->fileno."/".$project->id."/".$name.".pdf");
        return $pdf;
    }

    //create  pdf file
    public function prepareTemplateDocusignCSDocs($document, $project)
    {
        $content ="";
        $name ="";
        switch($document){
            case 'ddr':
                $name ="ddr";
                $staffInput = Input::get('staffInput');
                $helpfulInput = Input::get('helpfulInput');
                $questionsInput = Input::get('questionsInput');
                $risksInput = Input::get('risksInput');
                $guaranteesInput = Input::get('guaranteesInput');
                $knowledgeableInput = Input::get('knowledgeableInput');
                $explainInput = Input::get('explainInput');
                $promisesInput = Input::get('promisesInput');
                $iigInput = Input::get('iigInput');
                $clearInput = Input::get('clearInput');
                $readInput = Input::get('readInput');
                $webInput = Input::get('webInput');
                $companyInput = Input::get('companyInput');
                $satisfiedInput = Input::get('satisfiedInput');
                $opinionInput = Input::get('opinionInput');
                $commentsInput = Input::get('commentsInput');
                $testimonialInput = Input::get('testimonialInput');
                $staffRadio = Input::get('staffRadio');
                $satisfactionRadio = Input::get('satisfactionRadio');
                $helpfulRadio = Input::get('helpfulRadio');
                $questionsRadio = Input::get('questionsRadio');
                $risksRadio = Input::get('risksRadio');
                $guaranteesRadio = Input::get('guaranteesRadio');
                $knowledgeableRadio = Input::get('knowledgeableRadio');
                $explainRadio = Input::get('explainRadio');
                $promisesRadio = Input::get('promisesRadio');
                $costsRadio = Input::get('costsRadio');
                $iigRadio = Input::get('iigRadio');
                $clearRadio = Input::get('clearRadio');
                $readRadio = Input::get('readRadio');
                $webRadio = Input::get('webRadio');
                $mainCategory = Input::get('mainCategory');
                $subCategory = Input::get('subCategory');

                $content = view('templates.client_services.docusign_ddr_template_pdf',
                    array(
                        'fname'=>ucwords($this->client->fname." ".$this->client->lname),
                        'staffRadio'=>$staffRadio,
                        'satisfactionRadio'=>$satisfactionRadio,
                        'helpfulRadio'=>$helpfulRadio,
                        'questionsRadio'=>$questionsRadio,
                        'risksRadio'=>$risksRadio,
                        'guaranteesRadio'=>$guaranteesRadio,
                        'knowledgeableRadio'=>$knowledgeableRadio,
                        'explainRadio'=>$explainRadio,
                        'promisesRadio'=>$promisesRadio,
                        'costsRadio'=>$costsRadio,
                        'iigRadio'=>$iigRadio,
                        'clearRadio'=>$clearRadio,
                        'readRadio'=>$readRadio,
                        'webRadio'=>$webRadio,
                        'staffInput'=>$staffInput,
                        'helpfulInput'=>$helpfulInput,
                        'questionsInput'=>$questionsInput,
                        'risksInput'=>$risksInput,
                        'guaranteesInput'=>$guaranteesInput,
                        'knowledgeableInput'=>$knowledgeableInput,
                        'explainInput'=>$explainInput,
                        'promisesInput'=>$promisesInput,
                        'iigInput'=>$iigInput,
                        'clearInput'=>$clearInput,
                        'readInput'=>$readInput,
                        'webInput'=>$webInput,
                        'companyInput'=>$companyInput,
                        'satisfiedInput'=>$satisfiedInput,
                        'opinionInput'=>$opinionInput,
                        'commentsInput'=>$commentsInput,
                        'testimonialInput'=>$testimonialInput,
                        'client'=>$this->client,
                        'mainCategory'=>$mainCategory,
                        'subCategory'=>$subCategory,
                        'project'=>$project));
                break;
        }
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($content);
        $pdf->save("files/projects/".$this->client->fileno."/".$project->id."/".$name.".pdf");
        return $pdf;
    }
}
