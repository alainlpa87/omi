<?php namespace App\Http\Controllers;

use App\Helpers\CreateContractSignedHelper;
use App\Helpers\DocusignFunctions;
use App\Helpers\ToolsFunctions;
use App\Models\Consultant;
use App\Models\Contract;
use App\Models\Inbox;
use App\Models\Project;
use App\Models\ProjectProduction;
use App\Models\Transaction;
use Illuminate\Support\Facades\Input;
use DB;

class DocusignController extends Controller {

    public function __construct(){}

    public function signedContractDocusign()
    {
        $contract_id = Input::get('ID');
        $contract = Contract::find($contract_id);

        if (Input::get('event') == "signing_complete") {
            //get the document from docusign and saved into the dialer
            DocusignFunctions::docuSignGetContract(Input::get('envelopeId'), $contract);

            /***save the contract and proper action after the signature is done***/

            //update production if is an upgrade.
            if ($contract->type == "IGUP") {
                $projectP = ProjectProduction::where(array('project_id' => $contract->project->id, 'typeVendor' => 'production'))->first();
                if ($projectP != null) {
                    $projectP->contractType = 'IGUP';
                    $projectP->save();
                }
            }
            //update contract and reflect the signature
            $contract->signed = 'DOCUSIGN';
            $contract->signedDate = date("Y-m-d H:i:s");
            $contract->save();

            // generate sold report
            if($contract->type == 'IIG' or $contract->type == 'IMG')
                CreateContractSignedHelper::generateSoldReport($contract);

            //Create Transaction
            Transaction::createTransaction($contract->project->lead->consultant_id, $contract->project->lead->id, '', 'CONTRACT-SIGNED-CLIENT', $contract->type, '', $contract->project->lead->email, '', '', $contract->project->lead->phone, '');

            //Send Email to George and ALain
            $url = url("sendPaymentNotificationToAdminDocusign?ID=".$contract->id);
            ToolsFunctions::curl($url);
            //Send Email to client
            $url = url("sendPaymentNotificationToClient?ID=".$contract->id);
            ToolsFunctions::curl($url);

            $msgInbox = "INVENTOR PAID IN FULL CONTRACT SIGNED.\r\n";
            $msgInbox .= date("m-d-Y H:i:s") . "\r\n";
            $msgInbox .= "File #:" . $contract->project->lead->fileno . "\r\n";
            $msgInbox .= "Pin: " . $contract->project->id . "\r\n";
            $msgInbox .= "Client: " . $contract->project->lead->fname . " " . $contract->project->lead->lname . "\r\n";
            $msgInbox .= "Amount: " . $contract->paid . "\r\n";
            $msgInbox .= "Type: " . $contract->type . "\r\n";
            Inbox::createInbox($contract->project->lead->id, $contract->project->consultant_id, $msgInbox, 'PAYMENT', 'CLIENT');

            return view('omi.payment.success', array('project' => $contract->project, 'contract' => $contract, 'client' => $contract->project->lead, 'complete' => 1));
        }
        else {
            return redirect('launch');
        }
    }

    public function afterSignDocusign()
    {
        $contract_id = Input::get('ID');
        $contract = Contract::find($contract_id);

        if (Input::get('event') == "signing_complete") {
            //get the document from docusign and saved into the dialer
            DocusignFunctions::docuSignGetContract(Input::get('envelopeId'), $contract);

            //update contract and reflect the signature
            $contract->signed = 'DOCUSIGN';
            $contract->signedDate = date("Y-m-d H:i:s");
            $contract->save();

            //Create Transaction
            Transaction::createTransaction($contract->project->lead->consultant_id, $contract->project->lead->id, '', 'CONTRACT-SIGNED-CLIENT', $contract->type, '', $contract->project->lead->email, '', '', $contract->project->lead->phone, '');

            return view('omi.payment.index',array('project'=>$contract->project,'contract'=>$contract,'client'=>$contract->project->lead));
        }
        else {
            return redirect('launch');
        }
    }

    public function afterSignPpaDocusign()
    {
        $contract_id = Input::get('ID');
        $contract = Contract::find($contract_id);

        if (Input::get('event') == "signing_complete") {
            //get the document from docusign and saved into the dialer
            DocusignFunctions::docuSignGetContract(Input::get('envelopeId'), $contract);

            //update contract and reflect the signature
            $contract->signed = 'DOCUSIGN';
            $contract->signedDate = date("Y-m-d H:i:s");
            $contract->save();

            //create msg for consultant
            $msgInbox = "PPA CONTRACT SIGNED.\r\n";
            $msgInbox .= date("m-d-Y H:i:s")."\r\n";
            $msgInbox .= "File #:".$contract->project->lead->fileno."\r\n";
            $msgInbox .= "Pin: ".$contract->project->id."\r\n";
            $msgInbox .= "Client: ".$contract->project->lead->fname." ".$contract->project->lead->lname."\r\n";
            $msgInbox .= "Amount: ".$contract->paid."\r\n";
            $msgInbox .= "Type: ".$contract->type."\r\n";
            Inbox::createInbox($contract->project->lead->id, $contract->project->consultant_id, $msgInbox, 'PAYMENT', 'CLIENT');

            //Create Transaction
            Transaction::createTransaction($contract->project->lead->consultant_id, $contract->project->lead->id, '', 'CONTRACT-SIGNED-CLIENT', $contract->type, '', $contract->project->lead->email, '', '', $contract->project->lead->phone, '');

            return view('omi.payment.index',array('project'=>$contract->project,'contract'=>$contract,'client'=>$contract->project->lead));
        }
        else {
            return redirect('launch');
        }
    }

    public function afterSignLetterOfEng()
    {
        $project = Project::find(Input::get('ID'));

        if (Input::get('event') == "signing_complete") {
            //get the document from docusign and saved into the dialer
            DocusignFunctions::docuSignGetDocument(Input::get('envelopeId'), $project, 'LetterOfEng');

            //creta inbox for consultant and production
            $msgInbox = "Letter Of Engagement SIGNED.\r\n";
            $msgInbox .= date("m-d-Y H:i:s") . "\r\n";
            $msgInbox .= "File #:" . $project->lead->fileno . "\r\n";
            $msgInbox .= "Pin: " . $project->id . "\r\n";
            $msgInbox .= "Client: " . $project->lead->fname . " " . $project->lead->lname . "\r\n";
            //creta inbox for production
            Inbox::createInbox($project->lead->id, 30, $msgInbox, "PRODUCTION", "LAUNCH");

            $projectP = $project->getProjectProduction();
            if($projectP != null){
                $projectP->letterofengagement = 2;
                $projectP->sent_letterofeng = date("Y-m-d H:i:s");
                $projectP->scheduleDate = date('Y-m-d H:i:s', strtotime('+6 weeks'));
                $projectP->save();

                $att = $projectP->attorney();
                if($att != null){
                    $msgInbox .= "The Attorney assigned to your client is ".ucwords($att->fname." ".$att->lname);
                }
            }

            //creta inbox for consultant
            Inbox::createInbox($project->lead->id, $project->consultant_id, $msgInbox, "PRODUCTION", "LAUNCH");

            //Create Transaction
            Transaction::createTransaction($project->lead->consultant_id, $project->lead->id, '', 'LETTER-OF-ENG-SIGNED-CLIENT', '', '', $project->lead->email, '', '', $project->lead->phone, '');
        }
        return redirect(url('launch/project/'.$project->id));
    }

    public function afterSignLegalDocs(){
        $projectId = Input::get('PROYID');
        $envelopeId = Input::get('ENVID');
        $document = Input::get('DOCNAME');
        $last = Input::get('LAST');

        $project = Project::find($projectId);
        if(Input::get('event') == "signing_complete"){
            //si entra aki viene de docusign despues de que una firma fue realizada
            $last = $last - 1;
            if($last == 0){
                //si entra aki es que ya no hay mas firmas en el documento y se puede guardar
                $namePrefix = '';



                //get the document from docusign and saved into the dialer
                $file_id = DocusignFunctions::docuSignGetLegalDocument($envelopeId, $project, $document,$namePrefix);

                //mark client services doc table as signed
                $cs = $project->clientServicesProject();
                $doc = $cs->getDocsByName($document);
                if($doc!=null){
                    if(($document=="poaD" || $document=="poaU" || $document=="microEntityD" || $document=="microEntityU" || $document=="microEntityP")&& $doc->count >1){
                        $doc->count = $doc->count-1;
                    }else{
                        $doc->count = $doc->count-1;
                        $doc->signdate = date('m-d-Y');
                        $doc->file_id=$file_id;
                        $doc->notes_resend="";
                    }

                    $doc->save();
                }
                //saber si keda algun doc in estado retornado para poder modificar el cs y sacarlo del estado retornado
                $allDocs = $cs->getDocsCS();
                $existReturn = false;
                foreach($allDocs as $doc)
                    if($doc->notes_resend!=""){
                        $existReturn =true;
                        break;
                    }
                if(!$existReturn) {
                    $cs->returnedReason="";
                    $cs->completed = 1;
                    $cs->save();
                }
                //Let clientServices know that client sign the document
                $clientS = Consultant::where('usr','clientservices')->first();
                $aux_id=$clientS->id;
                $msgInbox = "The document ".$document." was signed.<br>".date("m-d-Y H:i:s")." <br>Client: ".$project->lead->fname." ".$project->lead->lname.
                    "<br>File #: ".$project->lead->fileno."<br>Pin: ".$projectId;
                Inbox::createInbox($project->lead->id,$aux_id,$msgInbox,"CLIENT SERVICES","CLIENT");
                if($document  == "agreementPSA" || $document  == "ddr"){
                    Inbox::createInbox($project->lead->id,$project->consultant_id,$msgInbox,"CLIENT SERVICES","CLIENT");
                }

                //return to Launch center
                if(count($cs->getDocsCS())<1)
                    return redirect('launch/project/'.$projectId);
                return redirect('launch/client_services/docs/'.$projectId);
            }else{
                $pos = $last - 1;
                //si entra aki es que aun quedan coinventors por firmar
                $coinventors = explode(',',$project->coInventor);
                $recipientId = $project->id + $pos + 1;
                $clientUserId = $project->lead->id + $pos + 1;
                $recipientName = ucwords($coinventors[$pos]);
                $recipientEmail = "coinventor_".$pos."_".$project->lead->email;
                DocusignFunctions::getTheEmbeddedView($document,$recipientEmail,$recipientName,$recipientId,$clientUserId,$envelopeId,$project->id,$last);
            }
        }else{
            return redirect('launch/client_services/docs/'.$projectId);
        }
    }
}