<?php namespace App\Http\Controllers;

use App\Helpers\ToolsFunctions;
use App\Models\Article;
use App\Models\AttClientServices;
use App\Models\ClientSNotes;
use App\Models\Contract;
use App\Models\Ilc;
use App\Models\IlcNotes;
use App\Models\Lead;
use App\Helpers\SendEmailHelper;
use App\Helpers\PlivoHelper;
use App\Models\LegalRecord;
use App\Models\Manufacturer;
use App\Models\PaymentTransaction;
use App\Models\Project;
use App\Models\ProjectClientServices;
use App\Models\Reply;
use App\Models\Ticket;
use App\Models\UploadedFiles;
use App\Models\ProjectProduction;
use App\Models\Transaction;
use App\Models\Inbox;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use App\Models\Consultant;
use DateTime;

class EmailController extends Controller {

    public function __construct()
    {

    }

    public function submissionKit()
    {
        $leadId = Input::get("LEAD");

        //search if there is no more email to this lead in the week
        if(!SendEmailHelper::only1EmailPerWeek($leadId))
            return "-1";

        $lead = Lead::find($leadId);
        if ($lead != null) {
            $usr = $lead->consultant;
            $uname = $usr->fname." ".$usr->lname;
            $sent = ToolsFunctions::curl(url("../app/Helpers/BME/sendBMEmail.php?TYPE=SUBKIT&EMAIL=".$lead->email."&CONNAME=".urlencode($uname)."&CONPHONE=".$usr->did));
            if ($sent == "1"){
// created the TRANSACTION.
                Transaction::createTransaction($lead->consultant_id, $leadId, '', 'EMAIL', 'SUBKIT', '', $lead->email, '', '', '', '');
                return "1";
            }else{
                //revisar este metodo
                Transaction::createTransaction($lead->consultant_id, $leadId, '', 'EMAIL', 'SUBKIT', '', $lead->email, '', 'Fail', '', '');
                return "1";
            }
        }
    }

    public function emailConsInfo()
    {
        $leadId = Input::get("LEAD");

        //search if there is no more email to this lead in the week
        if(!SendEmailHelper::only1EmailPerWeek($leadId))
            return "-1";

        $lead = Lead::find($leadId);
        if ($lead != null) {
            $usr = $lead->consultant;
            $uname = $usr->fname." ".$usr->lname;
            $sent = ToolsFunctions::curl(url("../app/Helpers/BME/sendBMEmail.php?TYPE=INFO&EMAIL=".$lead->email."&CONNAME=".urlencode($uname)."&CONPHONE=".$usr->did));
            if ($sent){
// created the TRANSACTION.
                Transaction::createTransaction($lead->consultant_id, $leadId, '', 'EMAIL', 'CONSINFO', '', $lead->email, '', '', '', '');
                return "1";
            }else{
                //revisar este metodo
                Transaction::createTransaction($lead->consultant_id, $leadId, '', 'EMAIL', 'SUBKIT', '', $lead->email, '', 'Fail', '', '');
                return "1";
            }
        }
    }

    public function tryingToReachYou()
    {
        $leadId = Input::get("LEAD");

        //search if there is no more email to this lead in the week
        if(!SendEmailHelper::only1EmailPerWeek($leadId))
            return "-1";

        $lead = Lead::find($leadId);
        if ($lead != null) {
            $sent = ToolsFunctions::curl(url("../app/Helpers/BME/sendBMEmail.php?TYPE=TTR&EMAIL=".$lead->email));
            if ($sent){
// created the TRANSACTION.
                Transaction::createTransaction($lead->consultant_id, $leadId, '', 'EMAIL', 'TTRY', '', $lead->email, '', '', '', '');
                return "1";
            }else{
                //revisar este metodo
                Transaction::createTransaction($lead->consultant_id, $leadId, '', 'EMAIL', 'SUBKIT', '', $lead->email, '', 'Fail', '', '');
                return "1";
            }
        }
    }

    public function getAttachedFilesArray($fileIds){
        foreach($fileIds as $id){
            $upFile = UploadedFiles::find($id);
            if(strpos($upFile->url, '/uploaded/') !== false)
                $files[] = 'uploaded/'.$upFile->fileName;
            elseif(strpos($upFile->url, '/attClientServices/') !== false)
                $files[] = 'attClientServices/'.$upFile->fileName;
            else
                $files[] = $upFile->fileName;
        }
        return $files;
    }

    public function nmi()
    {
        $leadId = Input::get("LEAD");
        $lead = Lead::find($leadId);
        if ($lead != null) {
            $sent = ToolsFunctions::curl(url("../app/Helpers/BME/sendBMEmail.php?TYPE=NMI&EMAIL=".$lead->email));
            if ($sent){
// created the TRANSACTION.
                Transaction::createTransaction($lead->consultant_id, $leadId, '', 'EMAIL', 'NMI', '', $lead->email, '', '', '', '');
                return "1";
            }else{
                return "-1";
            }
        }
    }

    public function sendLink()
    {
        $lead = '';
        if(Input::has("LEAD")){
            $leadId = Input::get("LEAD");

            //search if there is no more email to this lead in the week
            if(!SendEmailHelper::only1EmailPerWeek($leadId))
                return "-1";

            $lead = Lead::find($leadId);
        }else{
            $proyId = Input::get("PROJECT");
            $project = Project::find($proyId);
            $lead = $project->lead;
        }
        $artc = str_replace(" ", "-",Input::get("ARTICLE"));
        if ($lead != null) {
            $usr = $lead->consultant;
            $cname = $lead->fname." ".$lead->lname;
            $uname = $usr->fname." ".$usr->lname;

            $title="<italic><em>Link to our Learning Center</em>";
            $msg = '<p dir="ltr">Hello <strong style="font-style: italic;">'.ucwords($cname).'</strong></p>';
            $msg.="Please follow this link to our Learning Center:<br>";
            $msg.="<a href='".url("learn/$artc#Portfolio")."'>$artc</a><br>";
            $msg .= '<p>Sincerely,</p>';
            $msg .= '<p dir="ltr">'.ucwords($uname).'</p>';
            $msg .= '<p style="margin-left:20px;">Patent Services USA<br>';
            $msg .= '12000 Biscayne Blvd Suite 700<br>';
            $msg .= 'North Miami, FL 33181<br>';
            $msg .= 'Toll Free: 1-888-344-6836<br>';
            $msg .= 'Fax: 1-800-886-7951<br><br><br /><p dir="ltr"><a href="https://www.ownmyinvention.com/">www.ownmyinvention.com</a></p><br /><p>&nbsp;</p>';
            $subj = 'Link to our Learning Center';
            $sent = SendEmailHelper::send(array(), 'files/omi/', $lead->email, 'info@ownmyinvention.com', "Patent Services USA", 'info@ownmyinvention.com', $subj, $msg,$title);

            if ($sent){
// created the TRANSACTION.
                Transaction::createTransaction($lead->consultant_id, $lead->id, '', 'EMAIL', 'LINK', '', $lead->email, '', '', '', '');
                return "1";
            }else{
                return "-1";
            }
        }
    }

    public function sendContract()
    {
        $contractType = Input::get("CTYPE");
        $proyId = Input::get("PROJECT");
        $project = Project::find($proyId);
        $lead = $project->lead;
        if ($lead != null) {
            $usr = $lead->consultant;
            $cname = $lead->fname." ".$lead->lname;
            $uname = $usr->fname." ".$usr->lname;

            switch ($contractType) {
                case 'IMG':
                    $title="<italic><em>Inventor's Marketing Guide</em>";
                    $subj = "Inventor's Marketing Guide";
                    $fileName = "contract_img.pdf";
                    break;
                case 'IIG':
                    $title="<italic><em>Invention Initiative Guide</em>";
                    $subj = 'Invention Initiative Guide';
                    $fileName = "contract_iig.pdf";
                    break;
                case 'IGUP':
                    $title="<italic><em>Invention Guide Upgrade Proposal</em>";
                    $subj = 'Invention Guide Upgrade Proposal';
                    $fileName = "contract_upgrade.pdf";
                    break;
                case 'WP':
                    $title="<italic><em>Welcome Package and receipt</em>";
                    $subj = 'Patent Services USA Payment Received';
                    $fileName = "contract_wp.pdf";
                    break;
            }
            if($contractType == 'WP'){
                $msg= "Dear ".ucwords($cname).",<br><br>
                    Thank you for choosing Patent Services USA and becoming one of our valued clients.<br>
                    Patent Services is in the business of helping inventors succeed. We are happy that you've chosen our company in taking important steps towards making your Idea come alive.<br>
                    Attached you will find your Invention Initiative Guide Proposal Welcome Package and receipt.<br>
                    If you have any questions, feel free to contact your consultant ". ucfirst($uname).".<br>
                    Thank you,<br><br><br>
                    Patent Services Administration<br>
                    12000 Biscayne Blvd Suite 700<br>
                    North Miami, FL 33181<br>
                    Toll Free: 1-888-344-6836<br>
                    Fax: 1-800-886-7951<br>
                    www.ownmyinvention.com<br><br><br>
                    DISCLAIMER:<br>
                    This email message is for the sole use of the intended recipient(s) and may contain confidential and privileged information.
                    Any unauthorized review, use, disclosure or distribution is prohibited. If you are not the intended recipient, please contact
                    the sender by reply email and destroy all copies of the original message.";
            }else{
                $msg = '<h2>Dear '.ucwords($cname).',</h2>
                    <p> Attached you will find the '.$subj.' proposal that you requested.</p>
                    <p> As we discussed, this is an important step toward making your invention dream a reality.</p>
                    <p> After you have completed the document, please return it to one of the following:</p>
                    <ol>
                        <li>Fax it to my attention at 800-886-7951</li>
                        <li>Email to admin@ownmyinvention.com</li>
                        <li>Mail to : 12000 Biscayne Blvd <br>
                            <span style="padding-left:4em;">Suite 700</span><br>
                            <span style="padding-left:4em;">North Miami, FL 33181</span>
                        </li>
                    </ol>
                    <p> I look forward to working with you on your idea and will follow-up with you in the next few days.</p>
                    <p>Sincerely,</p>
                    <strong>'. ucfirst($uname).'</strong>';

//get the contract to save the price
                $contract = Contract::where(['project_id' => $proyId,'type' => $contractType])->first();
            }

//get the file
            $files = array();
            $files[] = $fileName;
//send the email
            $sent = SendEmailHelper::send($files, 'files/projects/'.$lead->fileno.'/'.$proyId.'/', $lead->email, 'info@ownmyinvention.com', "Patent Services USA", 'info@ownmyinvention.com', $subj, $msg,$title);

            if ($sent){
// created the TRANSACTION.
                if($contractType == 'WP'){
                    Transaction::createTransaction($lead->consultant_id, '', '', 'WP', '', $proyId, $lead->email, 'WP', '', '', '');
                }else{
                    Transaction::createTransaction($lead->consultant_id, '', '', 'CONTRACT', '', $proyId, $lead->email, $contractType, '', '', $contract->price);
                }
                return "1";
            }else{
                return "-1";
            }
        }
    }

    public function joinVentAgrmt()
    {
        $proyId = Input::get("PROJECT");
        $project = Project::find($proyId);
        $lead = $project->lead;
        if ($lead != null) {
            $files=array('Joint-Venture-Agreement.pdf');
            $path = 'files/omi/';
            $mailto = $lead->email;
            $from_mail = "info@ownmyinvention.com";
            $replyto = "info@ownmyinvention.com";
            $title = "Patent Services USA";
            $header = "Patent Services USA";
            $subj ='Patent Services USA';
            $msg = '<p>Dear Inventor</p><p style="text-align: justify;">It was a pleasure to speak with you. <a href="'.url("files/omi/Joint-Venture-Agreement.pdf").'">Click Here</a> to get a copy of the Document Joint Venture Agreements I mentioned to you.</p>
        <p  style="text-align: justify;">These documents are tools that can be used to work with potential investors.</p>
        <p  style="text-align: justify;">Please review the instructions and the attached documents. I look forward to speaking with you soon.</p>
        <p>Sincerely,</p><br />
                  <p>Patent Services USA<br>12000 Biscayne Blvd Suite 700<br>North Miami, FL 33181<br>Toll Free: 1-888-344-6836<br>Fax: 1-800-886-7951</p>
                  <p><a href="https://www.ownmyinvention.com">www.ownmyinvention.com</a></p>';
            $sent = SendEmailHelper::send($files, $path, $mailto, $from_mail, $header, $replyto,$subj , $msg, $title);
            if ($sent){
// created the TRANSACTION.
                Transaction::createTransaction($lead->consultant_id, '', '', 'EMAIL', 'JVA', $proyId, $lead->email, '', '', '', '');
                return "1";
            }else{
                return "-1";
            }
        }
    }

    public function sendPaymentNotificationToAdminDocusign()
    {
        $id = Input::get("ID");
        $contract = Contract::find($id);
        $project = Project::find($contract->project_id);
        $lead = Lead::find($project->lead_id);
        $usr = Consultant::find($project->consultant->id);
        $consultant = $usr->usr;
        if($project != null)
        {
            $subj = "Patent Services USA ".($contract->type)." contract ($consultant) - ".$lead->fileno;
            $msg = 'New payment from '.($lead->fileno).".";
            if($contract->type=="PPA")$msg.="\nTotal Amount: ".$contract->lastPaymentTransaction()->amount.".";
            $name="";
            $soldName="";
            switch($contract->type)
            {
                case "IMG":
                {
                    $name="signed_docusign_IMG.pdf";
                    $soldName = "sold_".$contract->type.".pdf";
                    break;
                }
                case "IIG":
                {
                    $name="signed_docusign_IIG.pdf";
                    if($contract->iigUpgrade == 1){
                        $name="signed_docusign_IIG_upgrade.pdf";
                    }
                    $soldName = "sold_".$contract->type.".pdf";
                    break;
                }
                case "IGUP":
                {
                    $name="signed_docusign_IGUP.pdf";
                    break;
                }
            }
            //get the file
            $files = array();
            if($name!="")
                $files[] = $name;
            strlen($soldName)>0?$files[] = $soldName:null;
            //send the email
            SendEmailHelper::send($files, 'files/projects/'.$lead->fileno.'/'.$project->id.'/', "george@ownmyinvention.com", 'info@ownmyinvention.com', "Patent Services USA", 'info@ownmyinvention.com', $subj, $msg,$subj);
            SendEmailHelper::send($files, 'files/projects/'.$lead->fileno.'/'.$project->id.'/', 'alain.lpa87@gmail.com', 'info@ownmyinvention.com', "Patent Services USA", 'info@ownmyinvention.com', $subj, $msg,$subj);
            if($contract->type!="PPA")
            {
                SendEmailHelper::send($files, 'files/projects/' . $lead->fileno . '/' . $project->id . '/', "rick@ownmyinvention.com", 'info@ownmyinvention.com', "Patent Services USA", 'info@ownmyinvention.com', $subj, $msg, $subj);
            }
        }
    }

    public function sendPaymentNotificationToClient()
    {
        $id = Input::get("ID");
        $contract = Contract::find($id);
        $project = Project::find($contract->project_id);
        $lead = Lead::find($project->lead_id);
        $paymentTransaction = PaymentTransaction::where('contract_id',$id)->where('approved',1)->orderBy('created_at','DESC')->first();
        if($project != null)
        {
            $cname = ucwords($lead->fname." ".$lead->lname);
            $amount = $paymentTransaction!=null?$paymentTransaction->amount:$contract->paid;
            $subj = "Payment Received!";
            $msg =  "Dear ".ucwords($lead->fname).",<br />";
            $msg .= "<br /> Thank you for your payment.";
            $msg .= "<br /><br />";
            $msg .= "<br />Payment was made for: \"" . $project->ideaName . "\"";
            $msg .= "<br />Payment amount: $" . number_format($amount, 2);
            $msg .= "<br /><br />Billing Information:<br />";
            $msg .= "Full Name: " . $cname. "<br />";
            $msg .= "Email: " . $lead->email . "<br />";
            $msg .= "Address: " . $lead->street . "<br />";
            $msg .= "City: " . $lead->city . "<br />";
            $msg .= "Country: " . $lead->country . "<br />";
            $msg .= "State/Province: " . $lead->state . "<br />";
            $msg .= "ZIP/Postal Code: " . $lead->zip . "<br />";
            $msg .= "<br /><br />Kind Regards,<br />" . $_SERVER['HTTP_HOST'];
            //get the file
            $files = array();
            //send the email
            SendEmailHelper::send($files, '', $lead->email, 'noreply@ownmyinvention.com', "Authorize.net Payment Terminal", 'noreply@ownmyinvention.com', $subj, $msg,$subj);
        }
    }

    //send an email to the vendor when a file was returned and why
    public function returnFileToVendor()
    {
        $file = Input::get('FILE');
        $reason = urldecode(Input::get('REASON'));
        $to = Input::get('ID');
        $subj = "File $file returned";
        $msg="This file $file needs to be check.<br>Reason:<br><br>";
        $msg.=$reason."<br>";
        $consultant = Consultant::find($to);
        if($consultant)
        {
            SendEmailHelper::send([], '', $consultant->email, 'production@ownmyinvention.com', $subj, 'production@ownmyinvention.com', $subj, $msg,$subj);
        }

    }

    //send an email to the vendor when a file is overdue
    public function overdueFilesVendor(){
        $file = Input::get('FILE');
        $vendorProject = ProjectProduction::find($file);
        if($vendorProject != null){
            $subj = "File $vendorProject->fileno overdue";
            $msg="<br><br>This file: $vendorProject->fileno is late.<br> Please take action with it.<br><br>";
            if($vendorProject->consultant != null){
                SendEmailHelper::send([], '', $vendorProject->consultant->email, 'production@ownmyinvention.com', $subj, 'production@ownmyinvention.com', $subj, $msg,$subj);
            }
        }
    }

    //send an email to the client when the legal documents was sent
    public function emailClientServices(){
        $files = array();
        $proj_id = Input::get('ID');
        $type = Input::get('TYPE');
        $project=Project::find($proj_id);
        $emailType ="";
        if($project!=null){
            $lead_id = $project->lead_id;
            $lead = Lead::find($lead_id);
            if($lead==null)
                return -1;
            $consultant = $lead->consultant;
            $path = 'files/projects/' . $lead->fileno . '/' . $project->id . '/';
            $mailto = $lead->email;
            $from_mail = "clientservices@ownmyinvention.com";
            $replyto = "clientservices@ownmyinvention.com";
            $title = "Patent Services USA Legal Documents";
            $header = "Patent Services USA";
            switch($type){  //
                case "SENTDOCS":
                    $subj = "PSA DDR";
                    $msg = "Dear ".ucwords($lead->fname)." ".ucwords($lead->lname).",<br />
                    Congratulations on moving forward with your patent work. For your convenience and in order to expedite the process of getting your patent work started, we have uploaded two documents to your project in the Launch Center that are necessary for you to complete in order to confirm your position on the patent attorney's docket. These documents are your Patent Services Agreement and your Due Diligence Review.
                     <br>
                    We invite you to review these documents here <a href='https://www.ownmyinvention.com/2.0/public/launch/login'>online</a> as soon as possible. You can execute the documents with your electronic signature there as well. Your documents can be found under My Projects(Select the name of your project) and proceed to Sign Legal Document. Once completed, we can confirm your position on the patent attorney's docket to prepare your patent application work.
                    <br>
                    If you have any questions regarding this information, please contact your consultant, ".$consultant->fname." ".$consultant->lname.", and they will be happy to assist you.
                     <br><br><br>
                    Sincerely,<br>
                    Client Services<br>
                    Patent Services, USA<br>
                    12000 Biscayne Blvd Suite 700<br>
                    North Miami, FL 33181<br>
                    Toll Free: 1-888-344-6836<br>
                    Fax: 1-800-886-7951<br>
                    www.ownmyinvention.com<br><br><br>
                    DISCLAIMER:<br>
                    This email message is for the sole use of the intended recipient(s) and may contain confidential and privileged information.
                    Any unauthorized review, use, disclosure or distribution is prohibited. If you are not the intended recipient, please contact
                    the sender by reply email and destroy all copies of the original message.";

                    $files[]="ddr.pdf";
                    $files[]="agreementPSA.pdf";
                    $files[] ="DDR_welcomeLetter.pdf";
                    $emailType ="PSA_DDR_EMAILED_TO_CLIENT";
                    break;
                case "PCTPSA":
                    $subj = "PCT PSA";
                    $msg = "Dear ".ucwords($lead->fname)." ".ucwords($lead->lname).",<br />
                    Congratulations! Your patent application has been filed to the United States Patent and Trademark Office by our Registered Patent Attorney and reached the patent pending status.
                     <br>
                     At this point we can begin the process of introducing you to our Patent Corporation Treaty (PCT) Patent Attorney / Agent that will handle the filling of your application. Enclosed you will find the official, agreement for Patent services. After you have reviewed and approved the agreement, please initial and sign where indicated and return the entire original agreement, to Patent Services USA, INC. Once this information is received, we will forward this to Independent Patent Attorney/Agent.
                     <br>
                    You can also review this document here <a href='https://www.ownmyinvention.com/2.0/public/launch/login'>online</a> as soon as possible. You can execute the documents with your electronic signature there as well. Your documents can be found under My Projects(Select the name of your project) and proceed to Sign Legal Document.
                    <br>
                    If you have any questions regarding this information, please contact your consultant, ".$consultant->fname." ".$consultant->lname.", and they will be happy to assist you.
                     <br><br><br>
                    Sincerely,<br>
                    Client Services<br>
                    Patent Services, USA<br>
                    12000 Biscayne Blvd Suite 700<br>
                    North Miami, FL 33181<br>
                    Toll Free: 1-888-344-6836<br>
                    Fax: 1-800-886-7951<br>
                    www.ownmyinvention.com<br><br><br>
                    DISCLAIMER:<br>
                    This email message is for the sole use of the intended recipient(s) and may contain confidential and privileged information.
                    Any unauthorized review, use, disclosure or distribution is prohibited. If you are not the intended recipient, please contact
                    the sender by reply email and destroy all copies of the original message.";

                    $files[]="PCT_PSA.pdf";
                    $emailType ="PCT_PSA_EMAILED_TO_CLIENT";
                    break;
                case "COPYRIGHT":
                    $subj = "Copyright Questionnaire";
                    $msg = "Hi ".ucwords($lead->fname)." ".ucwords($lead->lname).",<br /> Please go <a href='https://www.ownmyinvention.com/2.0/public/launch/login'>online</a> to fill the Copyright Questionnaire or review the documents in the attachment to fill. Please fill and return at your convenience.
                     <br><br><br>
                    Kindest regards,<br>
                    Client Services<br>
                    Patent Services, USA<br>
                    12000 Biscayne Blvd Suite 700<br>
                    North Miami, FL 33181<br>
                    Toll Free: 1-888-344-6836<br>
                    Fax: 1-800-886-7951<br>
                    www.ownmyinvention.com<br><br><br>
                    DISCLAIMER:<br>
                    This email message is for the sole use of the intended recipient(s) and may contain confidential and privileged information.
                    Any unauthorized review, use, disclosure or distribution is prohibited. If you are not the intended recipient, please contact
                    the sender by reply email and destroy all copies of the original message.";

                    $files[]="copyrightQuestionnaire.pdf";
                    $emailType ="COPYRIGHT_EMAILED_TO_CLIENT";
                    break;
                case "TRADEMARK":
                    $subj = "Trademark Questionnaire";
                    $msg = "Hi ".ucwords($lead->fname)." ".ucwords($lead->lname).",<br /> Please go <a href='https://www.ownmyinvention.com/2.0/public/launch/login'>online</a> to fill and return the Trademark Questionnaire or review the documents in the attachment to sign. Please sign and return at your convenience.
                     <br><br><br>
                    Kindest regards,<br>
                    Client Services<br>
                    Patent Services, USA<br>
                    12000 Biscayne Blvd Suite 700<br>
                    North Miami, FL 33181<br>
                    Toll Free: 1-888-344-6836<br>
                    Fax: 1-800-886-7951<br>
                    www.ownmyinvention.com<br><br><br>
                    DISCLAIMER:<br>
                    This email message is for the sole use of the intended recipient(s) and may contain confidential and privileged information.
                    Any unauthorized review, use, disclosure or distribution is prohibited. If you are not the intended recipient, please contact
                    the sender by reply email and destroy all copies of the original message.";

                    $files[]="trademark.pdf";
                    $emailType ="TRADEMARK_EMAILED_TO_CLIENT";
                    break;
                case "RETURNDOCS":// no se sta usando pero kisas en algun momento se use
                    $subj = "Legal documents returned";
                    $msg = "Dear ".ucwords($lead->fname)." ".ucwords($lead->lname).",<br /> Unfortunally some legal documents was sent it back to you in the ".$project->ideaName." project. You can see the reason in the Sign legal docs section.
                     <br><br><br>
                    Kindest regards,<br>
                    Client Services<br>
                    Patent Services, USA<br>
                    12000 Biscayne Blvd Suite 700<br>
                    North Miami, FL 33181<br>
                    Toll Free: 1-888-344-6836<br>
                    Fax: 1-800-886-7951<br>
                    www.ownmyinvention.com<br><br><br>
                    DISCLAIMER:<br>
                    This email message is for the sole use of the intended recipient(s) and may contain confidential and privileged information.
                    Any unauthorized review, use, disclosure or distribution is prohibited. If you are not the intended recipient, please contact
                    the sender by reply email and destroy all copies of the original message.";
                    $emailType ="LEGAL_DOCS_RETURNED_TO_CLIENT";
                    break;
                case "WELCOMELETTER":
                    $subj = "Welcome to Patent Services";
                    $msg = "Dear ".ucwords($lead->fname)." ".ucwords($lead->lname).",<br><br>
                    <p>Congratulations on taking this important step towards a Full Patent Protection for your invention!  This is a tremendous
                    accomplishment that few inventors ever begin.  Your determination and entrepreneurial spirit are characteristics that the
                    world's most successful inventors and business magnates possess. These traits will carry you forward, step by step, to realizing
                    your dream of becoming an accomplished inventor!</p>
                    <p>You've done your part…now we'll do ours.  We have received your signed Patent Services Agreement.  This now enables the
                    Independent Registered Patent Attorney to begin preparing the patent application for your invention.</p>
                    <p>During the next few weeks, I will be coordinating all activities with the attorney on your behalf.  I may contact you
                    periodically via email throughout this process to assist with certain patent application and information requests as required
                    by the attorney.  We will forward the completed patent application to you for review prior to the attorney's submission of your
                    application to the USPTO.</p>
                    <p>The Patent Pending process should take approximately 60 to 90 days.  We anticipate your new invention reaching a pending status
                    once your patent application is time stamped at the USPTO.  Your patent application number will be delivered to the attorney shortly
                    thereafter.</p>
                    <p>Please consider me your primary point of contact during the next several weeks while we assist you in protecting your idea.</p>
                    <p>If you have any questions or need further assistance, please do not hesitate to contact me.</p>
                    <br><br><br>
                    Kindest regards,<br>
                    Client Services<br>
                    Patent Services, USA<br>
                    12000 Biscayne Blvd Suite 700<br>
                    North Miami, FL 33181<br>
                    Toll Free: 1-888-344-6836<br>
                    Fax: 1-800-886-7951<br>
                    www.ownmyinvention.com<br><br><br>
                    DISCLAIMER:<br>
                    This email message is for the sole use of the intended recipient(s) and may contain confidential and privileged information.
                    Any unauthorized review, use, disclosure or distribution is prohibited. If you are not the intended recipient, please contact
                    the sender by reply email and destroy all copies of the original message.";
                    $emailType ="WELCOME_LETTER_EMAILED_TO_CLIENT";
                    PlivoHelper::sendSMS($lead->phone, 'Welcome to PSU client services. Welcome to PSU client services. We have attempted to contact you. Please check your email, log-in to your Project’s Launch Center or contact us at 1 888 344-6836.');
                    break;
                case "ILC":
                    $subj = "Your Patent Application has been Filed";
                    $app_number = Input::get('APPNUMBER');
                    $filename = urldecode(Input::get('FILENAME'));
                    $msg = "Dear ".ucwords($lead->fname)." ".ucwords($lead->lname).",<br /> Congratulations! Your patent application has been filed to
                     the United States Patent and Trademark Office by our Registered Patent Attorney and reached the patent pending
                     status. Enclosed you will find a copy of the electronic receipt, acknowledging the filing of the application,
                     with application number $app_number.
                     <br>
                     At this point we can begin the process of introducing you to our marketing affiliate International Licensing
                     Consultants that will handle the networking and licensing of your product. Enclosed you will find the official,
                     International Licensing Consultants Negotiations Agreement, also you can find it <a href='https://www.ownmyinvention.com/2.0/public/launch/login'>online</a> in your launch center. After you have reviewed and approved the agreement,
                     please initial and sign where indicated on page five (5 or 6) and return the entire original agreement, to Patent
                     Services USA, INC. Once this information is received, we will forward this to an authorized ILC representative for
                     further development.
                     <br>
                     If your decision is to not proceed with the assistance of ILC, please sign the release letter attached. Please note
                     that by signing this documentation, you have agreed to void any further support from International Licensing Consultants.
                     <br>
                     If you have any questions don't hesitate to contact me.
                     <br><br><br>
                    Kindest regards,<br>
                    Client Services<br>
                    Patent Services, USA<br>
                    12000 Biscayne Blvd Suite 700<br>
                    North Miami, FL 33181<br>
                    1-888-344-6836<br>
                    1-800-886-7951 Fax<br>
                    www.ownmyinvention.com<br><br><br>
                    DISCLAIMER:<br>
                    This email message is for the sole use of the intended recipient(s) and may contain confidential and privileged information.
                    Any unauthorized review, use, disclosure or distribution is prohibited. If you are not the intended recipient, please contact
                    the sender by reply email and destroy all copies of the original message.";

                    $files[]="ilc_agreement.pdf";
                    $files[]="ilc_release.pdf";
                    $files[]= $filename;
                    $emailType ="ILC_Marketing_Agreement_Sent_EMAILED_TO_CLIENT";
                    break;
            }
            //change the email
            $sent = SendEmailHelper::send($files, $path, $mailto, $from_mail, $header, $replyto,$subj , $msg, $title);
            if($sent && $project->clientServicesProject()!=null){
                $csNote = new ClientSNotes();
                $csNote->notes = $emailType;
                $csNote->projectclientservices_id = $project->clientServicesProject()->id;
                $csNote->save();
            }
            // transaction
            Transaction::createTransaction($project->consultant_id,$project->lead_id,'',$emailType,'',$proj_id,'','','','','');
            return "1";
        }else
            return "-1";
    }

    public function emailILCOverdue(){
        $files = array();
        $proj_id = Input::get('ID');
        $project=Project::find($proj_id);
        $emailType ="ILC_OVERDUE_EMAIL_NOTIFY_CLIENT";
        if($project!=null){
            $lead_id = $project->lead_id;
            $lead = Lead::find($lead_id);
            if($lead==null)
                return -1;
            $path = 'files/projects/' . $lead->fileno . '/' . $project->id . '/';
            $mailto = $lead->email;
            $from_mail = "clientservices@ownmyinvention.com";
            $replyto = "clientservices@ownmyinvention.com";
            $title = "Patent Services USA Legal Documents";
            $header = "Patent Services USA";
            $subj = "ILC Overdue";
            $msg = "Dear ".ucwords($lead->fname)." ".ucwords($lead->lname).",<br/> Remember that your patent application has been filed to
                     the United States Patent and Trademark Office by our Registered Patent Attorney and reached the patent pending
                     status.
                     <br>
                     At this point we can begin the process of introducing you to our marketing affiliate International Licensing
                     Consultants that will handle the networking and licensing of your product. <a href='https://www.ownmyinvention.com/2.0/public/launch/login'>Online</a> you will find the official,
                     International Licensing Consultants Negotiations Agreement. After you have reviewed and approved the agreement,
                     please initial and sign where indicated on page five (5 or 6) and return the entire original agreement, to Patent
                     Services USA, INC. Once this information is received, we will forward this to an authorized ILC representative for
                     further development.
                     <br>
                     If your decision is to not proceed with the assistance of ILC, please sign the release letter <a href='https://www.ownmyinvention.com/2.0/public/launch/login'>online</a>. Please note
                     that by signing this documentation, you have agreed to void any further support from International Licensing Consultants.
                     <br>
                     If you have any questions don't hesitate to contact me.
                     <br><br><br>
                    Kindest regards,<br>
                    Client Services<br>
                    Patent Services, USA<br>
                    12000 Biscayne Blvd Suite 700<br>
                    North Miami, FL 33181<br>
                    1-888-344-6836<br>
                    1-800-886-7951 Fax<br>
                    www.ownmyinvention.com<br><br><br>
                    DISCLAIMER:<br>
                    This email message is for the sole use of the intended recipient(s) and may contain confidential and privileged information.
                    Any unauthorized review, use, disclosure or distribution is prohibited. If you are not the intended recipient, please contact
                    the sender by reply email and destroy all copies of the original message.";

            $sent = SendEmailHelper::send($files, $path, $mailto, $from_mail, $header, $replyto,$subj , $msg, $title);
            if($sent && $project->clientServicesProject()!=null){
                $csNote = new ClientSNotes();
                $csNote->notes = $emailType;
                $csNote->projectclientservices_id = $project->clientServicesProject()->id;
                $csNote->save();
            }
            Transaction::createTransaction($project->consultant_id,$project->lead_id,'',$emailType,'',$proj_id,'','','','','');
        }else
            return -1;
    }

    public function emailPatentApp(){
        $command = Input::get('COMMAND');
        $proj_id = Input::get('ID');
        $project=Project::find($proj_id);
        if($project != null){
            $coInvs = explode(',',$project->coInventor);
            $auxType ='';
            if($command == "PA"){
                $files = array('power_of_attorneyU.pdf', 'certification_of_microEntityU.pdf', 'declarationU.pdf');
                $docsAUx = '<li>Power of Attorney</li>
                        <li>Declaration</li>
                        <li>Micro Entity</li>';
                $auxType='Utility';
                if($project->coInventor != ''){
                    $files[]='additional_inventorsU.pdf';
                    for($i=1;$i<count($coInvs)+1;$i++){
                        $files [] = "power_of_attorneyU_coInv".$i.".pdf";
                        $files [] = "certification_of_microEntityU_coInv".$i.".pdf";
                    }
                }
                //add to the attachments all the file uploaded to the panten app
                $uploadedFiles = UploadedFiles::where('project_id',$proj_id)->where('fileName',"like",'PAU_%')->get();
                foreach($uploadedFiles as $upFile)
                    $files [] = "uploaded/".$upFile->fileName;
            }elseif($command == "PROV"){
                $auxType='Provisional';
                $files = array('certification_of_microEntityP.pdf');
                $docsAUx = '<li>Micro Entity</li>';
                if($project->coInventor != '')
                    for($i=1;$i <count($coInvs)+1;$i++)
                        $files [] = "certification_of_microEntityP_coInv".$i.".pdf";
                //add to the attachments all the file uploaded to the panten app
                $uploadedFiles = UploadedFiles::where('project_id',$proj_id)->where('fileName',"like",'PROV_%')->get();
                foreach($uploadedFiles as $upFile)
                    $files [] = "uploaded/".$upFile->fileName;
            }elseif($command == "DESIGN"){
                $auxType='Utility & Design';
                $files = array('power_of_attorneyD.pdf', 'certification_of_microEntityD.pdf', 'declarationD.pdf');
                $docsAUx = '<li>Power of Attorney</li>
                        <li>Declaration</li>
                        <li>Micro Entity</li>';
                $coInvs = explode(',',$project->coInventor);
                if($project->coInventor != ''){
                    $files[]='additional_inventorsD.pdf';
                    for($i=1;$i<count($coInvs)+1;$i++){
                        $files [] = "power_of_attorneyD_coInv".$i.".pdf";
                        $files [] = "certification_of_microEntityD_coInv".$i.".pdf";
                    }
                }
                //add to the attachments all the file uploaded to the panten app
                $uploadedFiles = UploadedFiles::where('project_id',$proj_id)->where('fileName',"like",'PAD_%')->get();
                foreach($uploadedFiles as $upFile){
                    $files [] = "uploaded/".$upFile->fileName;
                }
            }

            //pcs and att
            $projectCs = $project->clientServicesProject();
            $att = $projectCs->attorney();

            $path = 'files/projects/' . $project->lead->fileno . '/' . $project->id . '/';
            $mailto = $project->lead->email;
            $subj = "Patent Application Package";
            $header ="Patent Services USA";
            $from_mail = "clientservices@ownmyinvention.com";
            $replyto = "clientservices@ownmyinvention.com";
            $msg = "<p>Patent Services</p>
                    <p>12000 Biscayne Blvd Suite # 700</p>
                    <p>North Miami, FL 33181</p><br>
                    <p>Dear <u>".$project->lead->fname." ".$project->lead->lname."</u>.</p>
                    <p>Enclosed you will find the following paperwork prepared by your Patent Attorney <u>".$att->fname." ".$att->lname."</u> :</p>
                    <ul>
                        <li>".$auxType." application</li>
                        <li>Patent drawings</li>".$docsAUx."

                    </ul><br>
                    <p>Please note that this application is required to be approved and forms need to be signed before filing it with the USPTO.
                    Please be advised that the documents only require your signature. Your patent attorney <u>".$att->fname." ".$att->lname."</u> will complete everything else.</p>
                    <p>Any questions do not hesitate to contact us.</p>
                     <br><br><br>
                    Sincerely,<br>
                    Client Support Services<br>
                    PATENT SERVICES, USA Inc.<br>
                    12000 Biscayne Blvd Suite #700<br>
                    North Miami, FL 33181<br>
                    Toll Free: 1-888-344-6836<br>
                    Fax: 1-800-886-7951<br>
                    <a href='www.ownmyinvention.com'>www.ownmyinvention.com</a><br><br><br>
                    DISCLAIMER:<br>
                    Patent Services is not a law firm and does not provide legal advice or legal opinion.  Patent Services
                    shall engage an Independent Registered Patent Attorney and/or Patent Agent to assist in certain matters
                    relating to the services described herein";

            //change email
            $sent = SendEmailHelper::send($files, $path, $mailto, $from_mail, $header, $replyto, $subj, $msg, $subj);

            if($sent && $projectCs!=null){
                $csNote = new ClientSNotes();
                $csNote->notes = 'PATENT_APP_EMAILED_TO_CLIENT';
                $csNote->projectclientservices_id = $projectCs->id;
                $csNote->save();
            }

            $tm_file =UploadedFiles::where('project_id',$proj_id)->where('fileName','trademark.pdf')->first();
            $cr_file =UploadedFiles::where('project_id',$proj_id)->where('fileName','copyrightQuestionnaire.pdf')->first();
            //if the trademark o cr was sent it but still without signature send the email again
            if($projectCs->trademarkSent_created_at != '' && $projectCs->trademarkReceived_created_at == '' && $tm_file!=null)
                ToolsFunctions::curl(url("emailClientServices?ID=$proj_id&TYPE=TRADEMARK"));
            if($projectCs->copyrightSent_created_at != '' && $projectCs->copyrightReceived_created_at == '' && $cr_file!=null)
                ToolsFunctions::curl(url("emailClientServices?ID=$proj_id&TYPE=COPYRIGHT"));

            // transaction
            Transaction::createTransaction($project->consultant_id,$project->lead_id,'','PATENT_APP_EMAILED_TO_CLIENT','',$proj_id,'','','','','');
            return 1;
        }
        return -1;
    }

    //rsend patent app package to sign again
    public function reEmailPatentAppPack(){
        $command = Input::get('COMMAND');
        $proj_id = Input::get('ID');
        $project=Project::find($proj_id);
        if($project != null){
            $coInvs = explode(',',$project->coInventor);
            if($command == "PA"){
                $files = array('power_of_attorneyU.pdf', 'certification_of_microEntityU.pdf', 'declarationU.pdf');
                if($project->coInventor != ''){
                    $files[]='additional_inventorsU.pdf';
                    for($i=1;$i<count($coInvs)+1;$i++){
                        $files [] = "power_of_attorneyU_coInv".$i.".pdf";
                        $files [] = "certification_of_microEntityU_coInv".$i.".pdf";
                    }
                }
            }elseif($command == "PROV"){
                $files = array('certification_of_microEntityP.pdf');
                if($project->coInventor != '')
                    for($i=1;$i <count($coInvs)+1;$i++)
                        $files [] = "certification_of_microEntityP_coInv".$i.".pdf";
            }elseif($command == "DESIGN"){
                $files = array('power_of_attorneyD.pdf', 'certification_of_microEntityD.pdf', 'declarationD.pdf');
                $coInvs = explode(',',$project->coInventor);
                if($project->coInventor != ''){
                    $files[]='additional_inventorsD.pdf';
                    for($i=1;$i<count($coInvs)+1;$i++){
                        $files [] = "power_of_attorneyD_coInv".$i.".pdf";
                        $files [] = "certification_of_microEntityD_coInv".$i.".pdf";
                    }
                }
            }


            $path = 'files/projects/' . $project->lead->fileno . '/' . $project->id . '/';
            $mailto = $project->lead->email;
            $subj = "Patent Application Package";
            $header ="Patent Services USA";
            $from_mail = "clientservices@ownmyinvention.com";
            $replyto = "clientservices@ownmyinvention.com";
            $msg = "Dear ".ucwords($project->lead->fname)." ".ucwords($project->lead->lname).",<br />
             We are unable to process the electronic documents that you recently submitted. For legal purposes, the signature(s)
             must be legible and complete. Please resubmit your documents with legible signatures as soon as possible. Failure
             to do so may result in a rejection of your application by the United States Patent and Trademark Office.  If you have
             trouble signing these forms electronically, they can be printed and returned to our office via mail.<br>
             If you have any questions or need assistance, please contact us.
                     <br><br><br>
                    Kindest regards,<br>
                    Client Services<br>
                    Patent Services, USA<br>
                    12000 Biscayne Blvd Suite 700<br>
                    North Miami, FL 33181<br>
                    Toll Free: 1-888-344-6836<br>
                    Fax: 1-800-886-7951<br>
                    www.ownmyinvention.com<br><br><br>
                    DISCLAIMER:<br>
                    This email message is for the sole use of the intended recipient(s) and may contain confidential and privileged information.
                    Any unauthorized review, use, disclosure or distribution is prohibited. If you are not the intended recipient, please contact
                    the sender by reply email and destroy all copies of the original message.";

            //change email
            $sent = SendEmailHelper::send($files, $path, $mailto, $from_mail, $header, $replyto, $subj, $msg, $subj);
            $projectCs = $project->clientServicesProject();
            if($sent && $projectCs!=null){
                $csNote = new ClientSNotes();
                $csNote->notes = 'PATENT_APP_REEMAILED_TO_CLIENT';
                $csNote->projectclientservices_id = $projectCs->id;
                $csNote->save();
                // transaction
                Transaction::createTransaction($project->consultant_id,$project->lead_id,'','PATENT_APP_REEMAILED_TO_CLIENT','',$proj_id,'','','','','');
                return json_encode($csNote);
            }

        }
        return -1;
    }

    //email the coversheet to the attorney
    public function emailDocToAtt(){
        $projId = Input::get('ID');
        $url = urldecode(Input::get('URL'));
        $att_email = Input::get('AE');
        $type = Input::get('TYPE');
        $att_id = Input::get('ATTID');
        $proj = Project::find($projId);
        $CS = $proj->clientServicesProject();
        $fromDate = \DateTime::createFromFormat("m-d-Y",$CS->documentSent_created_at);
        $toDate = \DateTime::createFromFormat("m-d-Y",$CS->documentSent_created_at);
        $toDate = $toDate->modify("+56 days")->format('m-d-Y');
        $fromDate = $fromDate->format('m-d-Y');

        if($type == "UPG_UT"){
            $fromDate = $CS->docUpgSent_created_at;
            $attCS = AttClientServices::find($att_id);
            if($attCS != null)
                $toDate = date("m-d-Y",strtotime($attCS->dueDate));
            else
                $toDate = date("m-d-Y",strtotime($attCS->created_at." +56 days"));
        }

        $files = array("attorneyCoverSheet.pdf");
        $subj = "ATTORNEY COVERSHEET";
        $path =  str_replace("attorneyCoverSheet.pdf", "",$url);//
        $mailto= $att_email;
        $from_mail = "clientservices@ownmyinvention.com";
        $replyto = "clientservices@ownmyinvention.com";
        $header = "Patent Services USA";
        $aux=""; //dnt know what should be there if the project it's not marked like one of the three
        if($CS->hasType('UPG_UT'))
            $aux="Upgrade Utility (Disregard previous provisional sent a few days ago.)";
        elseif($CS->hasType('PROV'))
            $aux="Provisional";
        elseif($CS->hasType('D') && $CS->hasType('UT'))
            $aux="Utility & Design";
        elseif($CS->hasType('UT'))
            $aux="Utility";

        $msg = "Hi ,<br />
                    <p>Enclosed is a new ".$aux." app towards ".date('M').".</p>
                    <table style='border-collapse:collapse' border='0' cellpadding='0' cellspacing='0'>
                        <tr><td style='width:263.0pt;border:solid windowtext 1.0pt;padding:0in 5.4pt 0in 5.4pt;height:30.0pt' valign='top' width='351'><strong>".$aux." Applications</strong></td><td style='width:62.0pt;border:solid windowtext 1.0pt;border-left:none;padding:0in 5.4pt 0in 5.4pt;height:30.0pt' valign='top' width='83'><strong>File #</strong></td><td style='width:56.0pt;border:solid windowtext 1.0pt;border-left:none;padding:0in 5.4pt 0in 5.4pt;height:30.0pt' valign='top' width='75'><strong>Date Sent</strong></td><td style='width:65.0pt;border:solid windowtext 1.0pt;border-left:none;padding:0in 5.4pt 0in 5.4pt;height:30.0pt' valign='top' width='87'><strong>Due Date</strong></td></tr>
                        <tr><td style='width:263.0pt;border:solid windowtext 1.0pt;border-top:none;padding:0in 5.4pt 0in 5.4pt;height:15.0pt' nowrap='' valign='top' width='351'>".ucwords($proj->lead->fname)." ".ucwords($proj->lead->lname)."</td><td style='width:62.0pt;border-top:none;border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0in 5.4pt 0in 5.4pt;height:15.0pt' nowrap='' valign='top' width='83'>".$proj->lead->fileno."</td><td style='width:56.0pt;border-top:none;border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0in 5.4pt 0in 5.4pt;height:15.0pt' nowrap='' valign='top' width='75'>".$fromDate."</td><td style='width:65.0pt;border-top:none;border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0in 5.4pt 0in 5.4pt;height:15.0pt' nowrap='' valign='top' width='87'>".$toDate."</td></tr>
                    </table>
                     <br><br><br>
                    Kindest regards,<br>
                    Client Services<br>
                    Patent Services, USA<br>
                    12000 Biscayne Blvd Suite 700<br>
                    North Miami, FL 33181<br>
                    Toll Free: 1-888-344-6836<br>
                    Fax: 1-800-886-7951<br>
                    www.ownmyinvention.com<br><br><br>
                    DISCLAIMER:<br>
                    This email message is for the sole use of the intended recipient(s) and may contain confidential and privileged information.
                    Any unauthorized review, use, disclosure or distribution is prohibited. If you are not the intended recipient, please contact
                    the sender by reply email and destroy all copies of the original message.";

        //
        if($projId == 8305)
            $sent = SendEmailHelper::send($files, $path, "alain.lpa87@gmail.com", $from_mail, $header, $replyto, $subj, $msg, $subj);
        else {
            $sent = SendEmailHelper::send($files, $path, $mailto, $from_mail, $header, $replyto, $subj, $msg, $subj);
            $att = Consultant::find($CS->attorney_id);
            if($att != null)
                PlivoHelper::sendSMS($att->did, 'You have received an application from PSU. File #:'.$proj->lead->fileno);
            if($mailto == 'jdh@ip-pages.com')
                SendEmailHelper::send($files, $path, 'dwhitman@ip-pages.com ', $from_mail, $header, $replyto, $subj, $msg, $subj);
        }
        if($sent && $proj->clientServicesProject()!=null){
            $csNote = new ClientSNotes();
            $csNote->notes = 'DOCUMENTS_EMAILED_TO_ATTORNEY';
            $csNote->projectclientservices_id = $proj->clientServicesProject()->id;
            $csNote->save();
        }
        //transaction
        Transaction::createTransaction($proj->consultant_id,$proj->lead_id,'','DOCUMENTS_EMAILED_TO_ATTORNEY','',$projId,'','','','','');
    }

    //email the coversheet to the attorney
    public function emailCoversheetToAtt(){
        $projId = Input::get('ID');
        $url = urldecode(Input::get('URL'));
        $upg = Input::get('UPG');
        $proj = Project::find($projId);
        if($proj == null)
            return -1;

        $begininText ='';
        $CS = $proj->clientServicesProject();
        if($CS == null)
            return -1;

        if($upg == 1){
            $aux = Input::get('TYPE');
            if($aux == '')
                $aux  = "Upgrade";
            $aux2 = "UPGRADE";
            $subj = "UPGRADE COVERSHEET";
            $attCS = AttClientServices::where('projectclientservices_id',$CS->id)->where('type','UPG_UT')->first();
            $date = date("m-d-Y",strtotime(str_replace('-','/',Input::get('RDATE'))));
            $date1 = date("m-d-Y",strtotime(str_replace('-','/',Input::get('DDATE'))));
            if($CS->appSent_created_at == '')
                $begininText="<p>Enclosed is a new ".$aux." App which was a provisional and was upgraded by client before the patent application was sent.</p>";
            else
                $begininText="<p>Enclosed is a new ".$aux." App.</p>";

        }
        else {
            $aux  = "Design";
            $aux2 = "DESIGN";
            $subj = "DESIGN COVERSHEET";
            $attCS = AttClientServices::where('projectclientservices_id',$CS->id)->where('type','DESIGN')->first();
            $date = date("m-d-Y",strtotime($attCS->created_at));
            $date1 = date("m-d-Y",strtotime($attCS->created_at." +56 days"));
            $begininText="<p>Enclosed is a new Design App.</p>";
        }
        if($attCS == null)
            return -1;
        $att = Consultant::find($CS->attorney_id);


        $fid = Input::get('FILE');
        if($fid != ''){
            $file = UploadedFiles::find($fid);
            $files = array($file->fileName);
            $path =  str_replace($file->fileName, "",$file->url);//
        }else {
            $files = array("attorneyCoverSheet.pdf");
            $path =  str_replace("attorneyCoverSheet.pdf", "",$url);//
        }
        $mailto= $att->email;
        $from_mail = "clientservices@ownmyinvention.com";
        $replyto = "clientservices@ownmyinvention.com";
        $header = "Patent Services USA";

        $msg = "Hi ,<br />
                    ".$begininText."
                    <table style='border-collapse:collapse' border='0' cellpadding='0' cellspacing='0'>
                        <tr><td style='width:263.0pt;border:solid windowtext 1.0pt;padding:0in 5.4pt 0in 5.4pt;height:30.0pt' valign='top' width='351'><strong>".$aux." Applications</strong></td><td style='width:62.0pt;border:solid windowtext 1.0pt;border-left:none;padding:0in 5.4pt 0in 5.4pt;height:30.0pt' valign='top' width='83'><strong>File #</strong></td><td style='width:56.0pt;border:solid windowtext 1.0pt;border-left:none;padding:0in 5.4pt 0in 5.4pt;height:30.0pt' valign='top' width='75'><strong>Date Sent</strong></td><td style='width:65.0pt;border:solid windowtext 1.0pt;border-left:none;padding:0in 5.4pt 0in 5.4pt;height:30.0pt' valign='top' width='87'><strong>Due Date</strong></td></tr>
                        <tr><td style='width:263.0pt;border:solid windowtext 1.0pt;border-top:none;padding:0in 5.4pt 0in 5.4pt;height:15.0pt' nowrap='' valign='top' width='351'>".ucwords($proj->lead->fname)." ".ucwords($proj->lead->lname)."</td><td style='width:62.0pt;border-top:none;border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0in 5.4pt 0in 5.4pt;height:15.0pt' nowrap='' valign='top' width='83'>".$proj->lead->fileno."</td><td style='width:56.0pt;border-top:none;border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0in 5.4pt 0in 5.4pt;height:15.0pt' nowrap='' valign='top' width='75'>".$date."</td><td style='width:65.0pt;border-top:none;border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0in 5.4pt 0in 5.4pt;height:15.0pt' nowrap='' valign='top' width='87'>".$date1."</td></tr>
                    </table>
                     <br><br><br>
                    Kindest regards,<br>
                    Client Services<br>
                    Patent Services, USA<br>
                    12000 Biscayne Blvd Suite 700<br>
                    North Miami, FL 33181<br>
                    Toll Free: 1-888-344-6836<br>
                    Fax: 1-800-886-7951<br>
                    www.ownmyinvention.com<br><br><br>
                    DISCLAIMER:<br>
                    This email message is for the sole use of the intended recipient(s) and may contain confidential and privileged information.
                    Any unauthorized review, use, disclosure or distribution is prohibited. If you are not the intended recipient, please contact
                    the sender by reply email and destroy all copies of the original message.";

        //
        if($projId == 8305)
            $sent = SendEmailHelper::send($files, $path, "alain.lpa87@gmail.com", $from_mail, $header, $replyto, $subj, $msg, $subj);
        else {
            $sent = SendEmailHelper::send($files, $path, $mailto, $from_mail, $header, $replyto, $subj, $msg, $subj);
            PlivoHelper::sendSMS($att->did, 'You have received an application from PSU. File #:'.$proj->lead->fileno);
            if($mailto == 'jdh@ip-pages.com')
                SendEmailHelper::send($files, $path, 'dwhitman@ip-pages.com ', $from_mail, $header, $replyto, $subj, $msg, $subj);
        }
        if($sent && $proj->clientServicesProject()!=null){
            $csNote = new ClientSNotes();
            $csNote->notes = 'DOCUMENTS '.$aux2.' EMAILED TO ATTORNEY';
            $csNote->projectclientservices_id = $proj->clientServicesProject()->id;
            $csNote->save();
        }
        //transaction
        Transaction::createTransaction($proj->consultant_id,$proj->lead_id,'','DOCUMENTS_'.$aux2.'_EMAILED_TO_ATTORNEY','',$projId,'','','','','');
    }

    public function emailUpgLetter(){
        $pid = Input::get('ID');
        $type = Input::get('TYPE');
        $project = Project::find($pid);
        $pcs = ProjectClientServices::where('project_id',$pid)->first();
        if($project!=null && $pcs != null){
            $path = "files/projects/".$project->lead->fileno."/".$project->id."/";
            $subj = "UPGRADE LETTER PCT OR EPO";
            if($type == 'PCTEPO')
                $files = array("upgradeLetterPCTEPO.pdf");
            else
                $files = array("upgradeLetterPCT.pdf");
            $to_mail = $project->lead->email;
            $from_mail = "clientservices@ownmyinvention.com";
            $replyto = "clientservices@ownmyinvention.com";
            $header = "Patent Services USA";
            $msg = "Dear ".ucwords($project->lead->fname)." ".ucwords($project->lead->lname)."<br />
            We are pleased to inform you of another “milestone” achievement. You've been committed to the pursuing of your invention for almost a year now. Most inventors fail to make it through even their 1st month for many different reasons. Through Patent Services, you've been successful at leveraging the necessary expertise required for progress. For this reason, we feel the need to say CONGRATULATIONS on a magnificent accomplishment!
            <br>
            With this in mind, we are communicating to remind you that your Utility Patent Application number ".$pcs->patentAppNo." for the ".$project->ideaName." invention is due for an upgrade on ".$pcs->getUpgradeDue().". We invite you to review these documents here <a href='https://www.ownmyinvention.com/2.0/public/launch/login'>online</a> in the Launch Center as soon as possible to execute the documents with your electronic signature there as well.
            <br>
            Your assigned Independent Registered Patent Attorney can draft and file for a EUROPEAN UNION DESIGN PATENT and / or a PATENT COOPERATION TREATY APPLICATION. We ask that you give us no less than six (10) weeks notice prior to the stated expiration date above. Your consent to continue, or your decision to decline, may be indicated by signing and returning this letter to us immediately with the upgrade fee if applicable. If you have any questions, call our client services department at 1-877-652-4908, ext. 211 for assistance. We hope to continue our mutual efforts with you.
                     <br><br><br>
                    Kindest regards,<br>
                    Client Services<br>
                    Patent Services, USA<br>
                    12000 Biscayne Blvd Suite 700<br>
                    North Miami, FL 33181<br>
                    Toll Free: 1-888-344-6836<br>
                    Fax: 1-800-886-7951<br>
                    www.ownmyinvention.com<br><br><br>
                    DISCLAIMER:<br>
                    This email message is for the sole use of the intended recipient(s) and may contain confidential and privileged information.
                    Any unauthorized review, use, disclosure or distribution is prohibited. If you are not the intended recipient, please contact
                    the sender by reply email and destroy all copies of the original message.";

            $sent = SendEmailHelper::send($files, $path, $to_mail, $from_mail, $header, $replyto, $subj, $msg, $subj);
            if($sent && $project->clientServicesProject()!=null){
                $csNote = new ClientSNotes();
                $csNote->notes = 'UPGRADE_PCT_EPO_EMAILED_TO_CLIENT';
                $csNote->projectclientservices_id = $project->clientServicesProject()->id;
                $csNote->save();
            }
            //transaction
            Transaction::createTransaction($project->consultant_id,$project->lead_id,'','UPGRADE_PCT_EPO_EMAILED_TO_CLIENT','',$pid,'','','','','');
        }
    }

    //provisional upgrade letter
    public function emailProvInvoice(){
        $pid = Input::get('ID');
        $project = Project::find($pid);
        $pcs = ProjectClientServices::where('project_id',$pid)->first();
        if($project!=null && $pcs!=null){
            $path = "files/projects/".$project->lead->fileno."/".$project->id."/";
            $subj = "Provisional Patent Application Renewal";
            $header = "Patent Services USA";
            $title = "Provisional Patent Application Renewal";
            $files = array("provisional_Invoice.pdf");
            $to_mail = $project->lead->email;
            $from_mail = "clientservices@ownmyinvention.com";
            $replyto = "clientservices@ownmyinvention.com";
            $filingDate =date('m/d/y',strtotime($pcs->patentAppFiled_created_at));
            $expiringDate = date('m/d/y',strtotime($pcs->patentAppFiled_created_at." + 1 year"));
            $msg = "Dear ".ucwords($project->lead->fname)." ".ucwords($project->lead->lname).",<br />
                    We are pleased to inform you of another “milestone” achievement.  You've been committed to the pursuing of
                    your invention for almost a year now. Most inventors fail to make it through even their 1st month for many
                    different reasons. Through Patent Services, you've been successful at leveraging the necessary expertise
                    required for progress. For this reason, we feel the need to say CONGRATULATIONS on a magnificent accomplishment!
                    <br>
                    With this in mind, we are communicating to remind you that your Provisional Patent Application number ".$pcs->patentAppNo."
                    for the ".$project->ideaName." will be expiring on ".$expiringDate.".  A non-provisional application for the
                    invention must be filed on or before this date in order to claim the benefit of the provisional application's
                    original filing date of ".$filingDate.".  If a non-provisional application is not filed before the expiration date,
                    you will lose the opportunity and rights established under the original provisional application.  This, in turn,
                    may prevent you from applying for a patent on your invention in the future.
                    <br><br>
                    Notwithstanding any other provision of this agreement, the INVENTOR expressly agrees that the independent registered
                    patent attorney engaged by PATENT SERVICES shall work on matters in connection with the utility patent application and
                    related non final office actions with the United States Patent And Trademark Office (hereinafter “USPTO”) as stated
                    herein. In the event that there is a final rejection of such utility patent application then the independent registered
                    patent attorney shall provide his or her recommendation to the client's file to either proceed with 1) the request for
                    continued examination (“RCE”) which shall not include continuation application, divisional application and/or continuation-in-part
                    application ( 2) a design patent application for any subject matter within the utility application capable of protection
                    under a design patent. 3) an appeal of the final rejection based upon the current status of the pending claims.  INVENTOR
                    shall pay any applicable fee if independent registered patent attorney recommends proceeding with RCE and PATENT SERVICES
                    shall pay the filing fee if the independent registered patent attorney recommends proceeding with the design patent
                    application. PATENT SERVICES shall not pay the applicable fee if independent registered patent attorney recommends
                    proceeding with an appeal. PATENT SERVICES will not be liable for maintenance fees required by the USPTO nor will it be
                    responsible to pay issuance fees or publication fees.  PATENT SERVICES will only follow independent registered patent
                    attorney recommendation to the client's file.
                    <br><br>
                    Your assigned Independent Registered Patent Attorney can draft and file for non-provisional patent protection, which will
                    require a more comprehensive application.  We ask that you give us no less than six (6) weeks' notice prior to the stated
                    expiration date above.  Your consent to continue, or your decision to decline, may be indicated by signing and returning
                    this letter to us immediately with the upgrade fee if applicable.  Please review the attached fee agreement.
                     <br><br><br>
                    Kindest regards,<br>
                    Client Services<br>
                    Patent Services, USA<br>
                    12000 Biscayne Blvd Suite 700<br>
                    North Miami, FL 33181<br>
                    Toll Free: 1-888-344-6836<br>
                    Fax: 1-800-886-7951<br>
                    www.ownmyinvention.com<br><br><br>
                    DISCLAIMER:<br>
                    This email message is for the sole use of the intended recipient(s) and may contain confidential and privileged information.
                    Any unauthorized review, use, disclosure or distribution is prohibited. If you are not the intended recipient, please contact
                    the sender by reply email and destroy all copies of the original message.";
            //
            $sent = SendEmailHelper::send($files, $path, $to_mail, $from_mail, $header, $replyto, $subj, $msg, $title);
            //inbox to consultant
            $msgInbox = "The Provisional Patent Application Renewal was sent to client.<br>".date("m-d-Y H:i:s")."<br>Client: ".$project->lead->fname." ".$project->lead->lname.
                "<br>File #: ".$project->lead->fileno."<br>Pin: ".$project->id;
            Inbox::createInbox($project->lead->id,$project->consultant_id,$msgInbox,"CLIENT SERVICES","SYSTEM");
            if($sent && $project->clientServicesProject()!=null){
                $csNote = new ClientSNotes();
                $csNote->notes = 'PROVISIONAL_UPGRADE_EMAILED_TO_CLIENT';
                $csNote->projectclientservices_id = $project->clientServicesProject()->id;
                $csNote->save();
            }
            //transaction
            Transaction::createTransaction($project->consultant_id,$project->lead_id,'','PROVISIONAL_UPGRADE_EMAILED_TO_CLIENT','',$pid,'','','','','');
        }
        //Please go <a href='https://www.ownmyinvention.com/2.0/public/launch/login'>online</a> to see and approve the PROVISIONAL INVOICE or see attachment.
    }

    //send update email of patent app to the client in the 3rd, the 6th, and the 12th month
    public function UpdateEmail(){
        $pid = Input::get('ID');
        $time = Input::get('TIME');
        $dateApp = Input::get('DATE');
        $numberApp = Input::get('NUMBER');
        $project = Project::find($pid);
//        echo $time;echo "<br>";
        if($project!=null){
            $csNote = new ClientSNotes();
            $csNoteSms = new ClientSNotes();
            $pcs =ProjectClientServices::where('project_id',$pid)->first();
            $csNote->projectclientservices_id = $pcs->id;
            $csNoteSms->projectclientservices_id = $pcs->id;
            $subj = "Update Email";
            $header = "Patent Services USA";
            $title = "$time months Update Email";
            $to_mail = $project->lead->email;
            $from_mail = "clientservices@ownmyinvention.com";
            $replyto = "clientservices@ownmyinvention.com";
            $path = "files/projects/".$project->lead->fileno."/".$project->id."/";
            $files = array();
            if($time == '3'){
                $msg = "Dear ".ucwords($project->lead->fname)." ".ucwords($project->lead->lname).":<br />
                Congratulations on taking important steps towards the development of your invention, this is a
                tremendous accomplishment! Your courage and entrepreneurial spirit will carry you, to realizing your dream.
                Currently, we are continuing to monitor your patent application with the Independent Registered Patent
                attorney, every effort is being made to assist the attorney.
                <br><br>
                Your patent application is published with the United States Patent and Trademark Office
                approximately 18 months after the filing date of the application, and then the status of
                the application can be viewed on USPTO's PAIR service (http://portal.uspto.gov/external/portal/pair).
                Until the application is published, the application information is not veiwable.
                <br><br>
                Please note it usually takes 18-24 months for the USPTO to start the examination process. Sometimes
                ofice action will occur before the application is published, and we will send you a copy of  such office
                actions when we receive them. Any questions do not hesitate to contact me.
                <br><br><br>
                Sincerely,<br><br>
                Client Support Services<br>
                PATENT SERVICES<br>
                12000 Biscayne Blvd Suite #700<br>
                North Miami, FL 33181<br>
                1-888-344-6836 ext. 211<br>
                1-800-886-7951 Fax<br>";
                $csNote->notes = "Update 3 months Patent App sent to client.";
                $csNoteSms->notes = "SMS Out with Update 3 months Patent App sent to client.";

            }elseif($time == '6'){
                $msg = "Dear ".ucwords($project->lead->fname)." ".ucwords($project->lead->lname).":<br />
                Currently, we are continuing to monitor your patent application with the Independent Registered Patent
                attorney, every effort is being made to assist the attorney. The patent application is published with the United States Patent and Trademark Office
                approximately 18 months after the filing date of the application, and then the status of
                the application can be viewed on USPTO's PAIR service (http://portal.uspto.gov/external/portal/pair).
                Until the application is published, the application information is not viewable.
                <br><br>
                Please note it usually takes 18-24 months for the USPTO to start the examination process. Sometimes
                office action will occur before the application is published, and we will send you a copy of  such office
                actions when we receive them. Any questions do not hesitate to contact me.
                <br><br>
                Sincerely,<br><br>
                Client Support Services<br>
                PATENT SERVICES<br>
                12000 Biscayne Blvd Suite #700<br>
                North Miami, FL 33181<br>
                1-888-344-6836 ext. 211<br>
                1-800-886-7951 Fax<br>";
                $csNote->notes = "Update 6 months Patent App sent to client.";
                $csNoteSms->notes = "SMS Out with Update 6 months Patent App sent to client.";
            }else{
                $msg = "Dear ".ucwords($project->lead->fname)." ".ucwords($project->lead->lname).":<br />
                Currently, we are continuing to monitor your patent application with the Independent Registered Patent
                attorney, every effort is being made to assist the attorney.
                <br>
                Your patent application is published with the United States Patent and Trademark Office
                approximately 18 months after the filing date of the application, and then the status of
                the application can be viewed on USPTO's PAIR service (http://portal.uspto.gov/external/portal/pair).
                Until the application is published, the application information is not veiwable.
                <br><br>
                Your patent was filed on ".$dateApp."-Application number is ".$numberApp."
                <br>
                Please note it usually takes 18-24 months for the USPTO to start the examination process. Sometimes
                ofice action will occur before the application is published, and we will send you a copy of  such office
                actions when we receive them. Any questions do not hesitate to contact me.
                <br><br>
                Sincerely,<br><br>
                Client Support Services<br>
                PATENT SERVICES<br>
                12000 Biscayne Blvd Suite #700<br>
                North Miami, FL 33181<br>
                1-888-344-6836 ext. 211<br>
                1-800-886-7951 Fax<br>";
                $csNote->notes = "Update 1 year Patent App sent to client.";
                $csNoteSms->notes = "SMS Out with Update 1 year Patent App sent to client.";
            }
            SendEmailHelper::send($files, $path, $to_mail, $from_mail, $header, $replyto, $subj, $msg, $title);
            PlivoHelper::sendSMS($project->lead->phone, 'You have received communication from PSU please check your email or inventor\'s platform for updates.');
            $csNote->save();
            $csNoteSms->save();
            //transaction
            $param = $time." months";
            Transaction::createTransaction($project->consultant_id,$project->lead_id,'','UPDATE_EMAIL_PATENT_APP_SENT_TO_CLIENT',$param,$pid,'','','','','');
        }
    }

    //email a doc uploaded to the attorney
    public function emailUpDocToAtt(){
        $projId = Input::get('ID');
        $att_email =urldecode(Input::get('AE'));
        $filename = urlencode(Input::get('FILENAME'));

        $proj = Project::find($projId);
        $files = array();
        $subj = "Document Uploaded";
        $mailto= $att_email;
        $from_mail = "clientservices@ownmyinvention.com";
        $replyto = "clientservices@ownmyinvention.com";
        $header = "Patent Services USA";

        $msg = "<br />
                    <p>The document ".$filename." was uploaded by Client Services.
                        <br>Fileno: ".$proj->lead->fileno."
                        <br>Client: ".ucwords($proj->lead->fname)." ".ucwords($proj->lead->lname)."
                        <br>The document is availabe in the <a href='https://www.ownmyinvention.com/2.0/public/attClientServices'>attorney view.</a>
                        </p>
                     <br><br>
                    Kindest regards,<br>
                    Client Services<br>
                    Patent Services, USA<br>
                    12000 Biscayne Blvd Suite 700<br>
                    North Miami, FL 33181<br>
                    Toll Free: 1-888-344-6836<br>
                    Fax: 1-800-886-7951<br>
                    www.ownmyinvention.com<br><br><br>
                    DISCLAIMER:<br>
                    This email message is for the sole use of the intended recipient(s) and may contain confidential and privileged information.
                    Any unauthorized review, use, disclosure or distribution is prohibited. If you are not the intended recipient, please contact
                    the sender by reply email and destroy all copies of the original message.";


        $sent = SendEmailHelper::send($files, '', $mailto, $from_mail, $header, $replyto, $subj, $msg, $subj);
        if($mailto == 'jdh@ip-pages.com')
            SendEmailHelper::send($files, '', 'dwhitman@ip-pages.com ', $from_mail, $header, $replyto, $subj, $msg, $subj);
        if($sent && $proj->clientServicesProject()!=null){
            $csNote = new ClientSNotes();
            $csNote->notes = 'DOCUMENT_UPLOADED_TO_ATTORNEY_BY_CS';
            $csNote->projectclientservices_id = $proj->clientServicesProject()->id;
            $csNote->save();
        }
        //transaction
        Transaction::createTransaction($proj->consultant_id,$proj->lead_id,'','DOCUMENT_UPLOADED_TO_ATTORNEY_BY_CS','',$projId,'','','','','');
    }

    public function emailDntReach(){
        $pin = Input::get('ID');
        $project = Project::find($pin);
        $client = $project->lead;//fname lname email all 3 from here dnt need more
        $files = array();
        $subj = "We have been unable to reach you.";
        $mailto= $client->email;
        $from_mail = "clientservices@ownmyinvention.com";
        $replyto = "clientservices@ownmyinvention.com";
        $header = "Patent Services USA";

        $msg = "Dear ".ucwords($client->fname)." ".ucwords($client->lname).":<br />
                Recently we made several attempts to contact you by telephone, regarding the information you submitted to us.<br><br>
                Please call us at 1-888-344-6836 ext. (237), or email us. Please be sure to keep an updated telephone number on file with us, so we may contact you in the future.<br><br>
                We look forward to speaking with you soon.

                <br><br>
                Sincerely,<br><br>
                Client Support Services<br>
                PATENT SERVICES<br>
                12000 Biscayne Blvd Suite #700<br>
                North Miami, FL 33181<br>
                Toll Free: 1-888-344-6836
                Fax: 1-800-886-7951<br>
                www.ownmyinvention.com";

        $sent = SendEmailHelper::send($files, '', $mailto, $from_mail, $header, $replyto, $subj, $msg, $subj);

        //transaction
        if($sent){
            Transaction::createTransaction('','','','EMAIL_DONT_REACH_CLIENT','',$pin,'','','','','');
            if($project->clientServicesProject()!=null){
                $csNote = new ClientSNotes();
                $csNote->notes = "Trying To Reach You Email Sent";
                $csNote->projectclientservices_id = $project->clientServicesProject()->id;
                $csNote->save();
            }
            return 1;
        }

        return -1;
    }

    public function emailPatentAppDraftingStatus(){
        $pin = Input::get('ID');
        $date =Input::get('DATE');
        $project = Project::find($pin);
        $client = $project->lead;//fname lname email all 3 from here dnt need more
        $files = array();
        $subj = "Patent Application Drafting Status.";
        $mailto= $client->email;
        $from_mail = "clientservices@ownmyinvention.com";
        $replyto = "clientservices@ownmyinvention.com";
        $header = "Patent Services USA";

        $msg = "Dear ".ucwords($client->fname)." ".ucwords($client->lname).":<br />
               It's my pleasure to inform you that I have received notification from the Independent Registered Patent Attorney's office that your invention, the $project->ideaName is in its final stages of preparation to reach Patent Pending status. The Patent Attorney's office has informed us that the estimated delivery for your  patent application will be the week of $date.
               <br>As soon as I receive your completed patent application, I will initiate a review to confirm that all information is correct prior to forwarding it to you.  Upon receipt of your patent application, you will be asked to review the application for final approval prior to filing the application with the USPTO.
               <br>We appreciate your patience as the patent attorney has worked diligently to prepare and complete your application.  We recognize that your enthusiasm for moving your invention forward is often difficult to contain. We share your excitement as we move toward accomplishing a major milestone for your invention together.
               <br>Please feel free to contact me if you have any further questions regarding this information.

                <br><br>
                Client Support Services<br>
                PATENT SERVICES USA, INC.<br>
                12000 Biscayne Blvd Suite #700<br>
                North Miami, FL 33181<br>
                1-888-344-6836
                1-800-886-7951 Fax<br>
                clientservices@ownmyinvention.com";


        $sent = SendEmailHelper::send($files, '', $mailto, $from_mail, $header, $replyto, $subj, $msg, $subj);
        if($sent && $project->clientServicesProject()!=null){
            $csNote = new ClientSNotes();
            $csNote->notes = 'EMAIL_PATENTAPP_DRAFTING_STATUS';
            $csNote->projectclientservices_id = $project->clientServicesProject()->id;
            $csNote->save();
        }
        //transaction
        Transaction::createTransaction('','','','EMAIL_PATENTAPP_DRAFTING_STATUS','',$pin,'','','','','');

    }

    public function emailReceivedILC(){
        $files = array();
        $proj_id = Input::get('ID');
        $project=Project::find($proj_id);
        $lead = $project->lead;
        $subj = "Patent Services ILC";
        if($lead==null)
            return -1;
        $path = 'files/projects/' . $lead->fileno . '/' . $project->id . '/';
        $mailto = $lead->email;
        $from_mail = "clientservices@ownmyinvention.com";
        $replyto = "clientservices@ownmyinvention.com";
        $title = "Patent Services USA Legal Documents";
        $header = "Patent Services USA";
        $msg = "Dear ".ucwords($lead->fname)." ".ucwords($lead->lname).",<br />
              Patent Services USA, Inc. has received your signed International Licensing Consultants (ILC)
              contract and with this established we can proceed with transferring the necessary documentation
              for our affiliate, ILC, to begin the marketing of your now patent-pending innovation.<br>
              ILC will require 7-10 business days before sending an official Welcome Package via parcel
              mail to your attention, in addition, the Marketing Director will contact you directly to
              perform an introductory call.<br>
              To maximize the conversation, please review the coming Welcome Package, in detail, for this
              will allow the Director to address any pending questions or concerns you may have about ILC
              and the services they render as a licensing consultant company.<br>
              Moving forward, with respect to PSU and our obligations to your pending application, please note
              that future updates will be in response to either requests made by the lawyer assigned to your
              account or from feedback we may receive from the USPTO.<br>
              Hence, the need for weekly or monthly updates from PSU are not presently required and there may a
              distinction of time - such as a 6-8 week period or longer - before a concrete development can be shared.<br>
              We are, however, diligently assuring your application is on course for fair and thorough evaluation by the
              USPTO and will inform you immediately of any actions pending.<br>
              In the interim, PSU congratulates you on your commitment and for reaching this step in the process to
              proprietary ownership of your invention. We thank you for partnering with our company and we wish you
              the best as you explore potential opportunities in the industry with ILC.
                     <br><br><br>
                    Kindest regards,<br>
                    Client Services<br>
                    Patent Services, USA<br>
                    12000 Biscayne Blvd Suite 700<br>
                    North Miami, FL 33181<br>
                    1-888-344-6836<br>
                    1-800-886-7951 Fax<br>
                    www.ownmyinvention.com<br><br><br>
                    DISCLAIMER:<br>
                    This email message is for the sole use of the intended recipient(s) and may contain confidential and privileged information.
                    Any unauthorized review, use, disclosure or distribution is prohibited. If you are not the intended recipient, please contact
                    the sender by reply email and destroy all copies of the original message.";

        $emailType ="ILC_Marketing_Agreement_Rcvd_EMAILED_TO_CLIENT";
        $sent = SendEmailHelper::send($files, $path, $mailto, $from_mail, $header, $replyto,$subj , $msg, $title);//
        if($sent && $project->clientServicesProject()!=null){
            $pcs =$project->clientServicesProject();
            $csNote = new ClientSNotes();
            $csNote->notes = $emailType;
            $csNote->projectclientservices_id = $pcs->id;
            $csNote->save();

            $clientS = Consultant::where('usr','clientservices')->first();
            if($pcs->mailOnly == 1){
                $msgInbox = "A marketing agreement was emailed to the project with the following fileno and it's check to regular mail.<br>File #: ".$pcs->fileno;
                Inbox::createInbox('',$clientS->id,$msgInbox,"CLIENT SERVICES","CLIENT");
            }
        }
        // transaction
        Transaction::createTransaction($project->consultant_id,$project->lead_id,'',$emailType,'',$proj_id,'','','','','');
    }

    public function emailPatentAppOverdue(){
        $files = array();
        $proj_id = Input::get('ID');
        $project=Project::find($proj_id);
        $lead = $project->lead;
        $subj = "Reminder Patent App";
        if($lead==null)
            return -1;
        $path = 'files/projects/' . $lead->fileno . '/' . $project->id . '/';
        $mailto = $lead->email;
        $from_mail = "clientservices@ownmyinvention.com";
        $replyto = "clientservices@ownmyinvention.com";
        $title = "Patent Services USA Patent App Approve";
        $header = "Patent Services USA";
        $msg = "Dear ".ucwords($lead->fname)." ".ucwords($lead->lname).",<br />
             We have been unable to reach you. Your Patent Application has been completed by your patent attorney.
             Please log on to review and approve your pending application and signing documents. If you have any
             revisions they must be submitted in writing. Your Patent Application will not be submitted to the United
             States Patent Office without your approval first.<br>
             If you have any questions or need assistance please contact us.
             <br><br><br>
              Kindest regards,<br>
              Client Services<br>
              Patent Services, USA<br>
              12000 Biscayne Blvd Suite 700<br>
              North Miami, FL 33181<br>
              1-888-344-6836<br>
              1-800-886-7951 Fax<br>
              www.ownmyinvention.com<br><br><br>
              DISCLAIMER:<br>
              This email message is for the sole use of the intended recipient(s) and may contain confidential and privileged information.
              Any unauthorized review, use, disclosure or distribution is prohibited. If you are not the intended recipient, please contact
              the sender by reply email and destroy all copies of the original message.";

        $emailType ="REMINDER_PATENT_APP_EMAILED_TO_CLIENT";
        $sent = SendEmailHelper::send($files, $path, $mailto, $from_mail, $header, $replyto,$subj , $msg, $title);
        if($sent && $project->clientServicesProject()!=null){
            $csNote = new ClientSNotes();
            $csNote->notes = $emailType;
            $csNote->projectclientservices_id = $project->clientServicesProject()->id;
            $csNote->save();
        }
        // transaction
        Transaction::createTransaction($project->consultant_id,$project->lead_id,'',$emailType,'',$proj_id,'','','','','');
    }

    public function emailTrademarkLetter(){
        $files = array('trademark_letter.pdf');
        $proj_id = Input::get('ID');
        $project=Project::find($proj_id);
        $lead = $project->lead;
        $subj = "Trademark Letter";
        if($lead==null)
            return -1;
        $path = 'files/projects/' . $lead->fileno . '/' . $project->id . '/';
        $mailto = $lead->email;
        $from_mail = "clientservices@ownmyinvention.com";
        $replyto = "clientservices@ownmyinvention.com";
        $title = "Patent Services USA";
        $header = "Patent Services USA";
        $msg = 'Dear '.ucwords($lead->fname).' '.ucwords($lead->lname).',<br />
             Please be advised, the United States Patent and Trademark Office has found your Trademark too closely descriptive
             of your actual invention. Therefore, registration for your trademark will be refused.<br>
             If the Trademark merely describes the goods or services, then it is too closely descriptive and will be rejected.
             For example, trying to trademark "snow shovel" for a snow shovel, or "car jack" for a car jack, will not work.
             The trademark should NOT give any indication of the goods being offered for sale.  Examples of excellent trademarks
             would be the following: “Apple" for computers or "Nissan" for cars, or "BIC" for ink pens, or "Sharpie" for a yellow
             highlighter.<br>
             The Independent Registered Patent Attorney has prepared and submitted preliminary Trademark information and requires
             this additional supporting document.  In order to complete the final phase of your application to the United States
             Patent and Trademark Office, the Registered Patent Attorney is requesting this “time-sensitive” information from you,
             in order to avoid any future filing inconsistencies and to expedite your filing promptly.  The attorney requires this
             completed information returned to us as soon as possible.<br>
             We invite you to review these documents here <a href="https://www.ownmyinvention.com/2.0/public/launch/login">online</a> as soon as possible. You can execute the documents with your electronic signature there as well. Your documents can be found under My Projects(Select the name of your project) and proceed to Sign Legal Document.
             If you have any questions or need assistance please contact us.
             <br><br><br>
              Kindest regards,<br>
              Client Services<br>
              Patent Services, USA<br>
              12000 Biscayne Blvd Suite 700<br>
              North Miami, FL 33181<br>
              1-888-344-6836<br>
              1-800-886-7951 Fax<br>
              www.ownmyinvention.com<br><br><br>
              DISCLAIMER:<br>
              This email message is for the sole use of the intended recipient(s) and may contain confidential and privileged information.
              Any unauthorized review, use, disclosure or distribution is prohibited. If you are not the intended recipient, please contact
              the sender by reply email and destroy all copies of the original message.';

        $emailType ="TRADEMARK_LETTER_EMAILED_TO_CLIENT";
        $sent = SendEmailHelper::send($files, $path, $mailto, $from_mail, $header, $replyto,$subj , $msg, $title);
        if($sent && ($pcs= $project->clientServicesProject())!=null){
            $csNote = new ClientSNotes();
            $csNote->notes = $emailType;
            $csNote->projectclientservices_id = $project->clientServicesProject()->id;
            $csNote->save();
            $clientS = Consultant::where('usr','clientservices')->first();
            if($pcs->mailOnly == 1){
                $msgInbox = "A Trademark Letter was emailed to the project with the following fileno ant it's check to regular mail.<br>File #: ".$pcs->fileno;
                Inbox::createInbox('',$clientS->id,$msgInbox,"CLIENT SERVICES","CLIENT");
            }
        }
        // transaction
        Transaction::createTransaction($project->consultant_id,$project->lead_id,'',$emailType,'',$proj_id,'','','','','');
    }

    public function emailExpiredNotice(){
        $files = array();
        $proj_id = Input::get('ID');
        $project=Project::find($proj_id);
        $lead = $project->lead;
        $pcs = $project->clientServicesProject();
        if($pcs==null)return -1;
        $att = Consultant::find($pcs->attorney_id);
        $subj = "Project Expired Notice";
        if($lead==null || $att==null)
            return -1;
        $path = 'files/projects/' . $lead->fileno . '/' . $project->id . '/';
        $mailto = $lead->email;
        $from_mail = "clientservices@ownmyinvention.com";
        $replyto = "clientservices@ownmyinvention.com";
        $title = "Patent Services USA Patent App Approve";
        $header = "Patent Services USA";
        $legalActivities = LegalRecord::where('projectclientservices_id',$pcs->id)->where('activity_due_date','>=',date('Y-m-d 00:00:00'))->get();
        $msg = "Via Certified & Regular Mail  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".date('M d, Y')."
              ".ucwords($lead->fname)." ".ucwords($lead->lname)."<br>
              ".$lead->street."<br>
              ".$lead->city.",".$lead->state." ".$lead->zip."<br>
              <br>
              File No. ".$lead->fileno."<br>
              Dear ".ucwords($lead->fname)." ".ucwords($lead->lname).",<br />
              It is with great pleasure that we have served your needs for over two years. It is with this desire to
              provide you with excellent service that we would like to thank you for allowing us to be the support for
              your invention.<br>
              Our records indicate your contract with us has expired. We would like to provide you with the
              attorney contact information related to your file. Any further inquiry shall be addressed to the attorney
              below. This Independent Registered Patent Attorney will continue to service your case.<br>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              ".$att->fname." ".$att->lname."<br>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              ".$att->email."<br>
              It was our goal to help you through this period, to engage the Independent Registered Patent
              Attorney and to serve all your needs. We truly thank you for your business and best of luck in your future
              endeavors.
              <br><br><br>";
        if(count($legalActivities)>0)
            $msg.="<b>Our records indicate you received an office action on ".date('m/d/y',strtotime($legalActivities[0]->recv_date))." from the United States Patent and Trademark Office. Patent Services will continue to monitor your project for the next 90 days.</b>
                     <br><br><br>";

        $msg.="Kindest regards,<br>
                    Client Services<br>
                    Patent Services, USA<br>
                    12000 Biscayne Blvd Suite 700<br>
                    North Miami, FL 33181<br>
                    1-888-344-6836<br>
                    1-800-886-7951 Fax<br>
                    www.ownmyinvention.com<br><br><br>
                    DISCLAIMER:<br>
                    This email message is for the sole use of the intended recipient(s) and may contain confidential and privileged information.
                    Any unauthorized review, use, disclosure or distribution is prohibited. If you are not the intended recipient, please contact
                    the sender by reply email and destroy all copies of the original message.";

        $emailType ="PROJECT_EXPIRED_NOTICE_TO_CLIENT"; //old trasntype ->PROJECT EXPIRED
        $sent = SendEmailHelper::send($files, $path, $mailto, $from_mail, $header, $replyto,$subj , $msg, $title);
        if($sent && $pcs!=null){
            $csNote = new ClientSNotes();
            $csNote->notes = $emailType;
            $csNote->projectclientservices_id = $pcs->id;
            $csNote->save();
            $clientS = Consultant::where('usr','clientservices')->first();
            if($pcs->mailOnly == 1){
                $msgInbox = "A Project Expired Notice was emailed to the project with the following fileno and it's check to regular mail.<br>File #: ".$pcs->fileno;
                Inbox::createInbox('',$clientS->id,$msgInbox,"CLIENT SERVICES","CLIENT");
            }
        }
        // transaction
        Transaction::createTransaction($project->consultant_id,$project->lead_id,'',$emailType,'',$proj_id,'','','','','');
    }

    //email to the attorney when a project prov is expired
    public function emailExpiredToAttorney(){
        $projId = Input::get('ID');
        $proj = Project::find($projId);
        $pcs = $proj->clientServicesProject();
        if($pcs==null)return -1;
        $att = Consultant::find($pcs->attorney_id);
        $files = array();
        $subj = "Project Expired Notice";
        $mailto= $att->email;
        $from_mail = "clientservices@ownmyinvention.com";
        $replyto = "clientservices@ownmyinvention.com";
        $header = "Patent Services USA";

        $msg = "Hi ,<br />
                    <p>Enclosed is a project that has expired.</p>
                    <table style='border-collapse:collapse' border='0' cellpadding='0' cellspacing='0'>
                        <tr><td style='width:263.0pt;border:solid windowtext 1.0pt;padding:0in 5.4pt 0in 5.4pt;height:30.0pt' valign='top' width='351'><strong>Inventor</strong></td><td style='width:62.0pt;border:solid windowtext 1.0pt;border-left:none;padding:0in 5.4pt 0in 5.4pt;height:30.0pt' valign='top' width='83'><strong>File #</strong></td></tr>
                        <tr><td style='width:263.0pt;border:solid windowtext 1.0pt;border-top:none;padding:0in 5.4pt 0in 5.4pt;height:15.0pt' nowrap='' valign='top' width='351'>".ucwords($proj->lead->fname)." ".ucwords($proj->lead->lname)."</td><td style='width:62.0pt;border-top:none;border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0in 5.4pt 0in 5.4pt;height:15.0pt' nowrap='' valign='top' width='83'>".$proj->lead->fileno."</td></tr>
                    </table>
                     <br><br><br>
                    Kindest regards,<br>
                    Client Services<br>
                    Patent Services, USA<br>
                    12000 Biscayne Blvd Suite 700<br>
                    North Miami, FL 33181<br>
                    Toll Free: 1-888-344-6836<br>
                    Fax: 1-800-886-7951<br>
                    www.ownmyinvention.com<br><br><br>
                    DISCLAIMER:<br>
                    This email message is for the sole use of the intended recipient(s) and may contain confidential and privileged information.
                    Any unauthorized review, use, disclosure or distribution is prohibited. If you are not the intended recipient, please contact
                    the sender by reply email and destroy all copies of the original message.";


        $sent = SendEmailHelper::send($files, '', $mailto, $from_mail, $header, $replyto, $subj, $msg, $subj);//
        if($mailto == 'jdh@ip-pages.com')
            SendEmailHelper::send($files, '', 'dwhitman@ip-pages.com ', $from_mail, $header, $replyto, $subj, $msg, $subj);
        if($sent && $pcs!=null){
            $csNote = new ClientSNotes();
            $csNote->notes = 'PROJECT_EXPIRED_NOTICE_TO_ATTORNEY';
            $csNote->projectclientservices_id = $pcs->id;
            $csNote->save();
        }
        //transaction
        Transaction::createTransaction($proj->consultant_id,$proj->lead_id,'','PROJECT_EXPIRED_NOTICE_TO_ATTORNEY','',$projId,'','','','','');
    }

    //send update email of patent app to the client in the 3rd, the 6th, and the 12th month
    public function updateEmailAfterYear(){
        $pid = Input::get('ID');
        $fileIds = Input::get('FILES');
        $project = Project::find($pid);
        if($project!=null){
            $csNote = new ClientSNotes();
            $pcs =ProjectClientServices::where('project_id',$pid)->first();
            $dateApp = date('m/d/Y',strtotime($pcs->patentAppFiled_created_at));
            $numberApp = $pcs->patentAppNo;
            $csNote->projectclientservices_id = $pcs->id;
            $subj = "Update Email";
            $header = "Patent Services USA";
            $title = "Update Email";
            $to_mail = $project->lead->email;
            $from_mail = "clientservices@ownmyinvention.com";
            $replyto = "clientservices@ownmyinvention.com";
            $path = "files/projects/".$project->lead->fileno."/".$project->id."/";
            $files = array();
            if($fileIds != null)
                $files = $this->getAttachedFilesArray($fileIds);

            $msg = "Dear ".ucwords($project->lead->fname)." ".ucwords($project->lead->lname).":<br />
                Currently, we are continuing to monitor your patent application with the Independent Registered Patent
                attorney, every effort is being made to assist the attorney.
                <br>
                Your patent application is published with the United States Patent and Trademark Office
                approximately 18 months after the filing date of the application, and then the status of
                the application can be viewed on USPTO's PAIR service (http://portal.uspto.gov/external/portal/pair).
                Until the application is published, the application information is not veiwable.
                <br><br>
                Your patent was filed on ".$dateApp."-Application number is ".$numberApp."
                <br>
                Please note it usually takes 18-24 months for the USPTO to start the examination process. Sometimes
                ofice action will occur before the application is published, and we will send you a copy of  such office
                actions when we receive them. Any questions do not hesitate to contact me.
                <br><br>
                Sincerely,<br><br>
                Client Support Services<br>
                PATENT SERVICES<br>
                12000 Biscayne Blvd Suite #700<br>
                North Miami, FL 33181<br>
                1-888-344-6836 ext. 211<br>
                1-800-886-7951 Fax<br>";
            $csNote->notes = "Update After 1 year Patent App sent to client.";
            $pcs->updateDateAfterYear =date('Y-m-d 00:00:00');
            SendEmailHelper::send($files, $path, $to_mail, $from_mail, $header, $replyto, $subj, $msg, $title);
            PlivoHelper::sendSMS($project->lead->phone, 'We have attempted to contact you. Please check your email and inventor’s platform or contact us at 1 888 344-6836.');
            $pcs->save();
            $csNote->save();
            ////////
            if($pcs->mailOnly == 1){
                $clientS = Consultant::where('usr','clientservices')->first();
                $msgInbox = "An Update Email was sent to the project with the following fileno and it's check to regular mail.<br>File #: ".$pcs->fileno;
                Inbox::createInbox('',$clientS->id,$msgInbox,"CLIENT SERVICES","CLIENT");
            }
            //transaction
            Transaction::createTransaction($project->consultant_id,$project->lead_id,'','UPDATE_EMAIL_PATENT_APP_AFTER_YEAR_SENT_TO_CLIENT','',$pid,'','','','','');
            return $pid;
        }
        return -1;
    }

    public function reminderAppToClient(){
        $files = array();
        $proj_id = Input::get('ID');
        $project=Project::find($proj_id);
        $lead = $project->lead;
        $pcs = $project->clientServicesProject();
        $date1 = $pcs->documentSent_created_at;
        $split_aux = explode('-',$date1);
        $aux=$split_aux[2]."-".$split_aux[0]."-".$split_aux[1];
        $date2 = Date("m-d-Y", strtotime("$aux +12 week"));
        $subj = "Client Services Update";
        if($lead==null)
            return -1;
        $path = 'files/projects/' . $lead->fileno . '/' . $project->id . '/';
        $mailto = $lead->email;
        $from_mail = "clientservices@ownmyinvention.com";
        $replyto = "clientservices@ownmyinvention.com";
        $title = "Patent Services USA";
        $header = "Patent Services USA";
        $msg = "Dear ".ucwords($lead->fname)." ".ucwords($lead->lname).",<br />
                    Please be advised that every effort is being made to assist the Independent Registered Patent Attorney in
                    drafting your patent application. It takes approximately 60 to 90 days for the attorney to complete the draft.<br>
                    Your package was sent to your patent attorney on $date1. We expect to receive your drafted application within 60 to 90 days. In the event your attorney needs more information from you, the drafted application completion
                    date may vary.<br>
                    As soon as we receive your patent application, it will be made available for your review and approval through
                    your inventor’s platform at ownmyinvention.com.<br>
                    If you have any questions, please contact client services by phone at 888-344-6836.
                     <br><br><br>
                    Kindest regards,<br>
                    Client Services<br>
                    Patent Services, USA<br>
                    12000 Biscayne Blvd Suite 700<br>
                    North Miami, FL 33181<br>
                    1-888-344-6836<br>
                    1-800-886-7951 Fax<br>
                    www.ownmyinvention.com<br><br><br>
                    DISCLAIMER:<br>
                    This email message is for the sole use of the intended recipient(s) and may contain confidential and privileged information.
                    Any unauthorized review, use, disclosure or distribution is prohibited. If you are not the intended recipient, please contact
                    the sender by reply email and destroy all copies of the original message.";

        $sent = SendEmailHelper::send($files, $path, $mailto, $from_mail, $header, $replyto,$subj , $msg, $title);
        if($sent && $pcs!=null){
            $csNote = new ClientSNotes();
            $csNote->notes = 'REMINDER_PATENT_APP_SENT_TO_ATTORNEY_EMAILED_TO_CLIENT';
            $csNote->projectclientservices_id = $pcs->id;
            $csNote->save();
        }
        PlivoHelper::sendSMS($lead->phone, 'We have attempted to contact you about an update on your application.Please check your email or contact us at 1 888 344-6836');
        // transaction
        Transaction::createTransaction($project->consultant_id,$project->lead_id,'','REMINDER_PATENT_APP_SENT_TO_ATTORNEY_EMAILED_TO_CLIENT','',$proj_id,'','','','','');
    }

    public function sendCoversheet(){
        $projId = Input::get('ID');
        $type = Input::get('TYPE');
        /////////////////////////
        $proj = Project::find($projId);
        if($proj==null)return -1;
        $pcs = $proj->clientServicesProject();
        if($pcs==null)return -1;
        /////////////////////////////////
        $subj = "";
        $msg = "";
        $att = Consultant::find($pcs->attorney_id);

        ////////////////////////////////////
        if($type == "ILC_COVERSHEET"){
            $files = array("ilcCoverSheet.pdf");
            $subj = "New Marketing Project";
            $mailto= "asia@successwithilc.com";
            $aux_header ="New Marketing Project.";
            //create row in ilc table
            $newIlc = Ilc::createIlc($pcs->fileno,$pcs->id,0);
            $msgInbox = "New Marketing Project.<br>File #: ".$pcs->fileno;
            $ilcUser =Consultant::where('usr','ilc')->first();
            Inbox::createInbox('',$ilcUser->id,$msgInbox,"CLIENT SERVICES","CLIENTS");

        }elseif($type == "TM_COVERSHEET" || $type == "RESEND_TM_COVERSHEET"){
            if($att == null)
                return -1;
            $mailto= $att->email;
            $aux_header ="New Trademark File.";
            $files = array("trademarkCoverSheet.pdf");
            if($type == "TM_COVERSHEET"){
                $pcs->trademark_sent_to_attorney = date('Y-m-d 00:00:00');
                $pcs->trademarkAtt = $att->id;
            }
        }elseif($type == "CR_COVERSHEET" || $type == "RESEND_CR_COVERSHEET"){
            if($att == null)
                return -1;
            $mailto= $att->email;
            $aux_header ="New Copyright File.";
            $files = array("copyRightCoverSheet.pdf");
            if($type == "CR_COVERSHEET"){
                $pcs->copyright_sent_to_attorney = date('Y-m-d 00:00:00');
                $pcs->copyrightAtt = $att->id;
            }
        }

        $path = 'files/projects/' . $proj->lead->fileno . '/' . $projId . '/';
        $from_mail = "clientservices@ownmyinvention.com";
        $replyto = "clientservices@ownmyinvention.com";
        $header = "Patent Services USA";
        $msg = "<p>$aux_header</p>
                    <table style='border-collapse:collapse' border='0' cellpadding='0' cellspacing='0'>
                        <tr><td style='width:263.0pt;border:solid windowtext 1.0pt;padding:0in 5.4pt 0in 5.4pt;height:30.0pt' valign='top' width='351'><strong>Inventor Name</strong></td><td style='width:62.0pt;border:solid windowtext 1.0pt;border-left:none;padding:0in 5.4pt 0in 5.4pt;height:30.0pt' valign='top' width='83'><strong>File #</strong></td></tr>
                        <tr><td style='width:263.0pt;border:solid windowtext 1.0pt;border-top:none;padding:0in 5.4pt 0in 5.4pt;height:15.0pt' nowrap='' valign='top' width='351'>".ucwords($proj->lead->fname)." ".ucwords($proj->lead->lname)."</td><td style='width:62.0pt;border-top:none;border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0in 5.4pt 0in 5.4pt;height:15.0pt' nowrap='' valign='top' width='83'>".$proj->lead->fileno."</td></tr>
                    </table>";
        ///////////////////////////////////////
        if($projId == 8305)
            $sent = SendEmailHelper::send($files, $path, 'alain.lpa87@gmail.com', $from_mail, $header, $replyto, $subj, $msg, $subj);//
        else{
            $sent = SendEmailHelper::send($files, $path, $mailto, $from_mail, $header, $replyto, $subj, $msg, $subj);//
            if($mailto == 'jdh@ip-pages.com')
                SendEmailHelper::send($files, $path, 'dwhitman@ip-pages.com', $from_mail, $header, $replyto, $subj, $msg, $subj);
        }
        if($sent && $pcs!=null){
            $csNote = new ClientSNotes();
            $csNote->notes = $aux_header.' Sent.';
            $csNote->projectclientservices_id = $pcs->id;
            $csNote->save();
            //save the date that was set on the if above.
            if($type == "CR_COVERSHEET" || $type == "TM_COVERSHEET"){
                //save the date that was sent
                $pcs->save();
                //create row in att view
                $typeAtt = ($type == "CR_COVERSHEET")?"CR":"TM";
                $attCSD = AttClientServices::where('projectclientservices_id',$pcs->id)->where('type',$typeAtt)->first();
                if($attCSD == null)
                    $attCSD = new AttClientServices();
                $attCSD->projectclientservices_id = $pcs->id;
                $attCSD->completed = 0;
                $attCSD->consultant_id = $pcs->attorney_id;
                $attCSD->lead_id = $proj->lead_id;
                $attCSD->type = $typeAtt;
                $attCSD->reminderToAttAppDate =date('Y-m-d 00:00:00');
                $attCSD->save();
            }
        }
        //transaction
        Transaction::createTransaction($proj->consultant_id,$proj->lead_id,$pcs->attorney_id,'COVERSHEET_SENT',$aux_header,$projId,'','','','','');
        return 1;
    }

    public function emailPCTQuest(){
        $pid = Input::get('ID');
        $fileIds = Input::get('FILES');
        $project = Project::find($pid);
        if($project!=null){
            $csNote = new ClientSNotes();
            $pcs =ProjectClientServices::where('project_id',$pid)->first();
            $csNote->projectclientservices_id = $pcs->id;
            $subj = "PCT Agreement";
            $header = "Patent Services USA";
            $title = "Patent Services USA";
            $to_mail = $project->lead->email;
            $from_mail = "clientservices@ownmyinvention.com";
            $replyto = "clientservices@ownmyinvention.com";
            $path = "files/projects/".$project->lead->fileno."/".$project->id."/";
            $files = array();
            if($fileIds != null)
                $files = $this->getAttachedFilesArray($fileIds);

            $msg = "Dear ".ucwords($project->lead->fname)." ".ucwords($project->lead->lname).":<br />
                Enclosed you will find the following paperwork:
                <ul>
                    <li>PCT Application</li>
                    <li>PCT Patent drawings</li>
                    <li>PCT Request (sign in Box No. X and return)</li>
                    <li>Micro Entity (sign above your name and return)</li>
                    <li>PCT Questionnaires (complete and return)</li>
                </ul>
                Please note that this application is required to be approved before filing it with the PCT Office.
                <br>
                <img src='https://www.ownmyinvention.com/2.0/public/img/unchk_square.png' alt=''> I, ".ucwords($project->lead->fname)." ".ucwords($project->lead->lname).", approve the drafted PCT application to be submitted to the United States Patent and Trademark Office.
                <br>
                <img src='https://www.ownmyinvention.com/2.0/public/img/unchk_square.png' alt=''> I, ".ucwords($project->lead->fname)." ".ucwords($project->lead->lname).", do not approve the drafted PCT application.
                <br>
                Any questions do not hesitate to contact us.
                <br><br>
                Kindest regards,<br>
                Client Support Services<br>
                PATENT SERVICES<br>
                12000 Biscayne Blvd Suite #700<br>
                North Miami, FL 33181<br>
                1-888-344-6836 ext. 211<br>
                1-800-886-7951 Fax<br>";
            $csNote->notes = "PCT Agreement sent to client.";
            SendEmailHelper::send($files, $path, $to_mail, $from_mail, $header, $replyto, $subj, $msg, $title);
            $pcs->pctQuestSent =  date('Y-m-d 00:00:00');
            $pcs->save();
            $csNote->save();
            ////////
            if($pcs->mailOnly == 1){
                $clientS = Consultant::where('usr','clientservices')->first();
                $msgInbox = "A PCT Agreement was emailed to the project with the following fileno and it's check to regular mail.<br>File #: ".$pcs->fileno;
                Inbox::createInbox('',$clientS->id,$msgInbox,"CLIENT SERVICES","CLIENT");
            }
            //transaction
            Transaction::createTransaction($project->consultant_id,$project->lead_id,'','PCT_AGREEMENT_SENT_TO_CLIENT','',$pid,'','','','','');
            return json_encode($csNote);
        }
        return -1;
    }

    public function emailReturnedApp(){
        $pcs = ProjectClientServices::find(Input::get('ID'));
        $att = Consultant::find(Input::get('AT_ID'));
        $notes = urldecode(Input::get('NOTES'));

        $subj = "Returned Patent App";
        $header = "Patent Services USA";
        $title = "Patent Services USA";
        $to_mail = $att->email;
        $from_mail = "clientservices@ownmyinvention.com";
        $replyto = "clientservices@ownmyinvention.com";
        $path = "files/projects/".$pcs->fileno."/".$pcs->project_id."/";

        $files = array();
        if(Input::has('FILES')){
            $fileLists = unserialize(urldecode(Input::get('FILES')));
            $files = $this->getAttachedFilesArray($fileLists);
        }

        $msg = "The Patent Application was returned by the client for the following reasons:<br>".date("m-d-Y H:i:s")."<br>".$notes."
            <br>File #: " . $pcs->fileno . "<br>Pin: ". $pcs->project_id."
                <br><br>
                Kindest regards,<br>
                Client Support Services<br>
                PATENT SERVICES<br>
                12000 Biscayne Blvd Suite #700<br>
                North Miami, FL 33181<br>
                1-888-344-6836 ext. 211<br>
                1-800-886-7951 Fax<br>";

        SendEmailHelper::send($files, $path, $to_mail, $from_mail, $header, $replyto, $subj, $msg, $title);

        //send text to att to make sure he is notify
        PlivoHelper::sendSMS($att->did,"You just received an email with new revision from File #: ". $pcs->fileno ."; Pin: ". $pcs->project_id);

        $project = $pcs->project;
        Transaction::createTransaction($project->consultant_id,$project->lead_id,'','APP_RETURNED_BY_CLIENT','',$project->id,'','','','','');
    }


    public function responseFromPsuToClients(){
        $project = Project::find(Input::get('PID'));
        $notes = Input::get('NOTES');
        //$sender = urldecode(Input::get('SENDER'));
        $sender = 'Client Services';

        $subj = "Patent Services USA";
        $header = "Patent Services USA";
        $title = "Patent Services USA";

        if($sender == 'Client Services'){
            $from_mail = "clientservices@ownmyinvention.com";
            $replyto = "clientservices@ownmyinvention.com";
        }else{
            $from_mail = "production@ownmyinvention.com";
            $replyto = "production@ownmyinvention.com";
        }



        //save email body into the dialer
        $lead= $project->lead;
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML('<p align="center"><img src="'.asset("/img/contracts/logo.png").'" name="Logo" width="165" height="126" id="Object1" align="center">
                        <br><i>Giving the edge to Inventors!</i></p><table align="center" width="100%"><tr>
                        <td>Client Name: '.$lead->fname.' '.$lead->lname.'</td></tr><tr><td>Email: '.$lead->email.'</td>
                        </tr><tr><td>FileNo: '.$lead->fileno.'</td></tr></table><br><table align="center" width="100%">
                        <tr><td>Subject: From PSU to Client</td></tr><tr><td><p>'.nl2br($notes).'</p></td></tr></table>');

        if(!File::exists("files/projects/".$lead->fileno."/".$project->id)) {
            File::makeDirectory("files/projects/".$lead->fileno."/".$project->id, 0755, true);
        }
        $docname = $lead->fileno."_emailCorrespondenceToClient_".date('m_d_Y H:i:s').".pdf";
        $pdf->save("files/projects/".$lead->fileno."/".$project->id."/".$docname);

        $aux_file = UploadedFiles::where('project_id',$project->id)->where('fileName',$docname)->first();
        if($aux_file!=null)
            $aux_file->delete();
        $uploadFile = new UploadedFiles();
        $uploadFile->project_id = $project->id;
        $uploadFile->url = "files/projects/".$lead->fileno."/".$project->id."/".$docname;
        $uploadFile->fileName = $docname;
        $uploadFile->clientVendor = 1;
        $uploadFile->save();


        $path = "files/projects/".$project->lead->fileno."/".$project->id."/";
        $files = array();
        if(Input::has('FILES')){
            $files = $this->getAttachedFilesArray(Input::get('FILES'));
        }

        $msg = nl2br($notes)."
                <br><br>
                Kindest regards,<br>
                PATENT SERVICES<br>
                12000 Biscayne Blvd Suite #700<br>
                North Miami, FL 33181<br>
                1-888-344-6836 ext. 211<br>
                1-800-886-7951 Fax<br>";

        SendEmailHelper::send($files, $path, $project->lead->email, $from_mail, $header, $replyto, $subj, $msg, $title);
        //send text to Client to make sure he is notify
        PlivoHelper::sendSMS($project->lead->phone,"You just received an email From Patent Services USA. Please check your ".$project->lead->email." account");
        //note in cs
        $pcs = $project->clientServicesProject();
        $csNote = new ClientSNotes();
        $csNote->notes = 'Email sent to client through the portal.';
        $csNote->projectclientservices_id = $pcs->id;
        $csNote->save();
        //transaction
        Transaction::createTransaction($project->consultant_id,$project->lead_id,'','EMAIL_FROM_PSU_TO_CLIENT','BY: '.$sender,$project->id,'','','','','');
        return 1;
    }

    public function sendEmailToVendor(){
        $project = Project::find(Input::get('PID'));
        $lead= $project->lead;
        $to_email = Input::get('EMAIL');
        $notes = Input::get('NOTES');
        $subj = Input::get('SUBJ');
        $header = "Patent Services USA";
        $title = "Patent Services USA";
        $from =Input::get('FROM');
        $pcs = $project->clientServicesProject();
        $files = array();
        $fileNumber = '<table align="center" width="100%"><tr><td>FileNo: '.$lead->fileno.'</td></tr></table><br><br>';
        $msg = $fileNumber.nl2br($notes);

        if($from =='cs'){
            $from_mail = "clientservices@ownmyinvention.com";
            $replyto = "clientservices@ownmyinvention.com";
            $path = "files/projects/".$project->lead->fileno."/".$project->id."/";
            if(Input::has('FILES')){
                $files = $this->getAttachedFilesArray(Input::get('FILES'));
            }

            $add = "
                <br><br>
                Kindest regards,<br>
                PATENT SERVICES<br>
                12000 Biscayne Blvd Suite #700<br>
                North Miami, FL 33181<br>
                1-888-344-6836 ext. 211<br>
                1-800-886-7951 Fax<br>";

            $csNote = new ClientSNotes();
            $csNote->notes = $subj.'. Email sent to vendor.';
            $csNote->projectclientservices_id = $pcs->id;
            $csNote->save();
        }
        elseif($from =='ilc'){
            $from_mail = "asia@successwithilc.com";
            $replyto = "asia@successwithilc.com";
            $path = "files/projects/".$project->lead->fileno."/".$project->id."/";
            if(Input::has('FILES')){
                $files = $this->getAttachedFilesArray(Input::get('FILES'));
            }

            $add = "
                <br><br>
                Sincerely,<br>
                Asia Wynder<br>
                Marketing Director<br>
                International Licensing Consultants<br>
                7777 Glades Road – Suite 100<br>
                Boca Raton, FL 33434<br>
                (800) 713 – 1899 – Toll-Free Phone<br>
                (800) 343 – 1052  – Fax<br>
                 Asia@successwithilc.com<br>";
        }
        elseif($from =='pct_epo'){
            if($to_email == 'gschutte@cruickshank.ie'){
                $action = 'EPO';
                $pcs->epoToAttDate = date('Y-m-d 00:00:00');
                $msg = $notes;
            }else{
                $action = 'PCT';
                $pcs->pctToAttDate = date('Y-m-d 00:00:00');
                $msg = $notes." ".$pcs->pctCaseNumber;
            }
            $pcs->save();

            $from_mail = "clientservices@ownmyinvention.com";
            $replyto = "clientservices@ownmyinvention.com";
            $path = "files/projects/".$project->lead->fileno."/".$project->id."/";
            if(Input::has('FILES')){
                $files = $this->getAttachedFilesArray(Input::get('FILES'));
            }

            $add = "
                <br><br>
                Kindest regards,<br>
                CLIENT SERVICES DEPARTMENT<br>
                PATENT SERVICES<br>
                12000 Biscayne Blvd Suite #700<br>
                North Miami, FL 33181<br>
                1-888-344-6836 ext. 211<br>
                1-800-886-7951 Fax<br>";

            $csNote = new ClientSNotes();
            $csNote->notes = $action.' EMAILED TO ATT';
            $csNote->projectclientservices_id = $pcs->id;
            $csNote->save();
        }
        else{
            $from_mail = "production@ownmyinvention.com";
            $replyto = "production@ownmyinvention.com";
            $path = 'files/projects/'.$project->lead->fileno.'/'.$project->id.'/production/';
            $countF = Input::get('COUNT');
            if($countF > 0){
                $docsAttach = UploadedFiles::where('project_id',$project->id)->orderBy('created_at','DESC')->limit($countF)->get();
                foreach($docsAttach as $doc)
                    $files[]=$doc->fileName;
            }

            $add = "
                <br><br>
                Sincerely,<br>
                Victoria A.<br>
                Production Department<br>
                12000 Biscayne Blvd Suite #700<br>
                North Miami, FL 33181<br>
                1-888-344-6836 ext. #208<br>
                1-800-886-7951 Fax<br>";
            //transaction
            Transaction::createTransaction('',$project->lead_id,'','EMAIL_FROM_PROD_TO_VENDOR','',$project->id,'','','','','');
        }

        //Sending the email
        $msg .= $add;
        SendEmailHelper::send($files, $path, $to_email, $from_mail, $header, $replyto, $subj, $msg, $title);

        //save email body into the dialer
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML('<p align="center"><img src="'.asset("/img/contracts/logo.png").'" name="Logo" width="165" height="126" id="Object1" align="center">
                        <br><i>Giving the edge to Inventors!</i></p><table align="center" width="100%"><tr><td>Email: '.$to_email.'</td>
                        </tr><tr><td>FileNo: '.$lead->fileno.'</td></tr></table><br><table align="center" width="100%">
                        <tr><td>Subject: '.$subj.'</td></tr><tr><td><p>'.nl2br($notes).'</p></td></tr></table>');

        if(!File::exists("files/projects/".$lead->fileno."/".$project->id)) {
            File::makeDirectory("files/projects/".$lead->fileno."/".$project->id, 0755, true);
        }
        $docname = $lead->fileno."_emailCorrespondenceToVendor_".date('m_d_Y H:i:s').".pdf";
        $pdf->save("files/projects/".$lead->fileno."/".$project->id."/".$docname);

        $aux_file = UploadedFiles::where('project_id',$project->id)->where('fileName',$docname)->first();
        if($aux_file!=null)
            $aux_file->delete();
        $uploadFile = new UploadedFiles();
        $uploadFile->project_id = $project->id;
        $uploadFile->url = "files/projects/".$lead->fileno."/".$project->id."/".$docname;
        $uploadFile->fileName = $docname;
        $uploadFile->clientVendor = 1;
        $uploadFile->save();

        return 1;
    }

    public function sendEmailFromAttToCS(){
        $project = Project::find(Input::get('PID'));
        $to = Input::get('TO');
        if($to == 'cs')
            $to_email = "clientservices@ownmyinvention.com";
        else
            $to_email = "production@ownmyinvention.com";

        $notes = Input::get('NOTES');
        $subj = Input::get('SUBJ');
        $header = "Patent Services USA";
        $title = "Patent Services USA";
        $from_mail = Input::get('EMAIL');
        $replyto = "";


        //save email body into the dialer
        $lead= $project->lead;
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML('<p align="center"><img src="'.asset("/img/contracts/logo.png").'" name="Logo" width="165" height="126" id="Object1" align="center">
                        <br><i>Giving the edge to Inventors!</i></p><table align="center" width="100%">
                        <tr><td>Email: '.$from_mail.'</td>
                        </tr><tr><td>FileNo: '.$lead->fileno.'</td></tr></table><br><table align="center" width="100%">
                        <tr><td>Subject: '.$subj.'</td></tr><tr><td><p>'.nl2br($notes).'</p></td></tr></table>');

        if(!File::exists("files/projects/".$lead->fileno."/".$project->id)) {
            File::makeDirectory("files/projects/".$lead->fileno."/".$project->id, 0755, true);
        }
        $docname = $lead->fileno."_emailCorrespondenceFromVendor_".date('m_d_Y H:i:s').".pdf";
        $pdf->save("files/projects/".$lead->fileno."/".$project->id."/".$docname);

        $aux_file = UploadedFiles::where('project_id',$project->id)->where('fileName',$docname)->first();
        if($aux_file!=null)
            $aux_file->delete();
        $uploadFile = new UploadedFiles();
        $uploadFile->project_id = $project->id;
        $uploadFile->url = "files/projects/".$lead->fileno."/".$project->id."/".$docname;
        $uploadFile->fileName = $docname;
        $uploadFile->clientVendor = 1;
        $uploadFile->save();


        $path = "files/projects/".$project->lead->fileno."/".$project->id."/";
        $files = array();
        if(Input::has('FILES')){
            $files = $this->getAttachedFilesArray(Input::get('FILES'));
        }

        $msg = nl2br($notes)."
                <br><br>
                Kindest regards,<br>
                PATENT SERVICES<br>
                12000 Biscayne Blvd Suite #700<br>
                North Miami, FL 33181<br>
                1-888-344-6836 ext. 211<br>
                1-800-886-7951 Fax<br>";

        //
        SendEmailHelper::send($files, $path, $to_email, $from_mail, $header, $replyto, $subj, $msg, $title);
        $pcs = $project->clientServicesProject();
        if($to == 'cs'){
            $csNote = new ClientSNotes();
            $csNote->notes = 'Email from the vendor.';
            $csNote->projectclientservices_id = $pcs->id;
            $csNote->save();
        }
        //transaction
        Transaction::createTransaction($project->consultant_id,$project->lead_id,'','EMAIL_FROM_VENDOR_TO_CS','',$project->id,'','','','','');
        return 1;
    }

    public function trademarkActionEmail(){
        $pid = Input::get('ID');
        $fileIds = Input::get('FILES');


        $project = Project::find($pid);
        if($project!=null){
            $subj = "Trademark email";
            $header = "Patent Services USA";
            $title = "Patent Services USA";
            $to_mail = $project->lead->email;
            $from_mail = "clientservices@ownmyinvention.com";
            $replyto = "clientservices@ownmyinvention.com";
            $path = "files/projects/".$project->lead->fileno."/".$project->id."/";
            $files = array();
            if($fileIds != null)
                $files = $this->getAttachedFilesArray($fileIds);

        }else
            return -1;
        $msg = "<b>Application Status: Non-Final Rejection</b><br>
                <b>File No: ".$project->lead->fileno."</b><br>
                <b>Per Independent Registered Attorney</b><br><br>
                Dear ".ucwords($project->lead->fname)." ".ucwords($project->lead->lname).":<br />
                We are continuing to monitor your patent application work with the Independent Registered Patent attorney. 
                Every effort is being made to assist the attorney to complete the patent work. Enclosed is a copy of the 
                Non-Final Office Action received via the independent registered patent attorney from the United States
                Patent and Trademark Office for your patent application.  At this point, the patent attorney will file a
                response to your application in order to continue the work.<br>
                With our goal and responsibility to providing excellent service to you, we can help better inform and guide
                you.  Our organization will facilitate the work and engage your independent registered patent attorney to
                continue working to represent you before the USPTO examiner.  We will continue to keep you apprised of any
                further actions or events.
                <br><br>
                Sincerely,<br>
                Client Support Services<br>
                PATENT SERVICES<br>
                12000 Biscayne Blvd Suite #700<br>
                North Miami, FL 33181<br>
                1-888-344-6836 ext. 211<br>
                1-800-886-7951 Fax<br>";

        $sent = SendEmailHelper::send($files, $path, $to_mail, $from_mail, $header, $replyto, $subj, $msg, $title);
        if($sent == 1){
            Transaction::createTransaction($project->consultant_id,$project->lead_id,'','TRADEMARK_ACTION_EMAILED','',$project->id,'','','','','');
            $pcs = $project->clientServicesProject();
            $csNote = new ClientSNotes();
            $csNote->notes = 'Trademark Action email sent';
            $csNote->projectclientservices_id = $pcs->id;
            $csNote->save();
            //////////////////////
            if($pcs->mailOnly == 1){
                $clientS = Consultant::where('usr','clientservices')->first();
                $msgInbox = "A Trademark Action Email was sent to the project with the following fileno and it's check to regular mail.<br>File #: ".$pcs->fileno;
                Inbox::createInbox('',$clientS->id,$msgInbox,"CLIENT SERVICES","CLIENT");
            }
            return 1;
        }
        else
            return -1;
    }

    public function noFinalActionEmail(){
        $pid = Input::get('ID');
        $fileIds = Input::get('FILES');

        $project = Project::find($pid);
        if($project!=null){
            $subj = "Non Final Office Action Utility";
            $header = "Patent Services USA";
            $title = "Patent Services USA";
            $to_mail = $project->lead->email;
            $from_mail = "clientservices@ownmyinvention.com";
            $replyto = "clientservices@ownmyinvention.com";
            $path = "files/projects/".$project->lead->fileno."/".$project->id."/";
            $files = array();
            if($fileIds != null)
                $files = $this->getAttachedFilesArray($fileIds);

        }else
            return -1;
        $msg = "<b>Application Status: Non-Final Rejection</b><br>
                <b>File No: ".$project->lead->fileno."</b><br>
                <b>Per Independent Registered Attorney</b><br><br>
                Dear ".ucwords($project->lead->fname)." ".ucwords($project->lead->lname).":<br />
                We are continuing to monitor your patent application work with the Independent Registered Patent attorney. 
                Every effort is being made to assist the attorney to complete the patent work. Enclosed is a copy of the 
                Non-Final Office Action received via the independent registered patent attorney from the United States
                Patent and Trademark Office for your patent application. As stated above your application status is a
                non-final rejection and certain claims have been denied.  At this point, the patent attorney will file a
                response to your application in order to continue the work.<br>
                Such rejections are made as a matter of course during the examination Process, and often reflect a lack
                of understanding of the invention by the Examiner and/or that the invention was claimed too broadly. It
                is rare when a patent application is allowed without an initial rejection as to either the form or scope
                of the claims.<br>
                The Rules of Practice provide procedures for amending the claims of the application to Overcome the rejection,
                and for the submission of legal and technical argument to point out to the Patent Examiner that the application
                is properly allowable. These procedures are used for most patent applications. A response must be filed prior to
                the date listed above to avoid abandonment or government extension fees.<br>
                With our goal and responsibility to providing excellent service to you, we can help better inform and guide
                you.  Our organization will facilitate the work and engage your independent registered patent attorney to
                continue working to represent you before the USPTO examiner.  We will continue to keep you apprised of any
                further actions or events.
                <br><br>
                Sincerely,<br>
                Client Support Services<br>
                PATENT SERVICES<br>
                12000 Biscayne Blvd Suite #700<br>
                North Miami, FL 33181<br>
                1-888-344-6836 ext. 211<br>
                1-800-886-7951 Fax<br>";

        $sent = SendEmailHelper::send($files, $path, $to_mail, $from_mail, $header, $replyto, $subj, $msg, $title);
        if($sent == 1){
            Transaction::createTransaction($project->consultant_id,$project->lead_id,'','NON_FINAL_OFFICE_ACTION_UT_EMAILED','',$project->id,'','','','','');
            $pcs = $project->clientServicesProject();
            $csNote = new ClientSNotes();
            $csNote->notes = 'Non Final Office Action Utility email sent';
            $csNote->projectclientservices_id = $pcs->id;
            $csNote->save();
            /////////change of phase
            if($pcs->phase == 5){
                $pcs->phase = 6;
                $pcs->changePhaseDate=date('Y-m-d 00:00:00');
                $pcs->save();
            }
            /////////////////
            if($pcs->mailOnly == 1){
                $clientS = Consultant::where('usr','clientservices')->first();
                $msgInbox = "Non Final Office Action Utility email sent to the project with the following fileno and it's check to regular mail.<br>File #: ".$pcs->fileno;
                Inbox::createInbox('',$clientS->id,$msgInbox,"CLIENT SERVICES","CLIENT");
            }
            return 1;
        }
        else
            return -1;
    }

    public function finalActionEmail(){
        $pid = Input::get('ID');
        $fileIds = Input::get('FILES');
        $rcvdDate = date('M j, Y', strtotime(Input::get('RDATE')));
        $dueDate = date('M j, Y', strtotime(Input::get('DDATE')));

        $project = Project::find($pid);
        if($project!=null){
            $subj = "Final Office Action";
            $header = "Patent Services USA";
            $title = "Patent Services USA";
            $to_mail = $project->lead->email;
            $from_mail = "clientservices@ownmyinvention.com";
            $replyto = "clientservices@ownmyinvention.com";
            $path = "files/projects/".$project->lead->fileno."/".$project->id."/";
            $files = array();
            if($fileIds != null)
                $files = $this->getAttachedFilesArray($fileIds);

        }else
            return -1;
        $msg = "<b>Application Status: Final Rejection</b><br>
                <b>File No: ".$project->lead->fileno."</b><br>
                <b>Per Independent Registered Attorney</b><br><br>
                Dear ".ucwords($project->lead->fname)." ".ucwords($project->lead->lname).":<br />
                We are continuing to monitor your patent application work with the Independent Registered Patent Attorney.
                Every effort is being made to assist the attorney to complete the patent work.<br>
                Enclosed is a copy of the Final Office Action, dated ".$rcvdDate." received via the Independent Registered Patent
                Attorney from the United States Patent and Trademark Office for your patent application.  As stated above
                your application status is a final rejection and claims have been denied.  At this point, the Independent
                Registered Patent Attorney would file a response to your application, due no later than ".$dueDate." in order to
                continue the work.  At this time, we must advise you that in accordance to your Patent Protection Agreement,
                Section 9 (9.4), that your application is entitled to one (1) more office action in an attempt to resolve
                the patent examiner’s rejection.  After the 2 nd Office Action, you will be required to pay the USPTO filing
                fees for each additional action.  Some options available to you from the Independent Registered Patent
                Attorney would be:<br><br>
                <img src='https://www.ownmyinvention.com/2.0/public/img/unchk_square.png' alt=''> Continue to pursue the utility patent and allow
                additional responses – possibly incurring fee for each response over two (2), as per your Patent Protection
                Agreement Section 9 (9.4).<br>
                <img src='https://www.ownmyinvention.com/2.0/public/img/unchk_square.png' alt=''> Abandon the application after 2 responses (not
                recommended) – our objective is to help you get the patent allowed and issued.<br>
                <img src='https://www.ownmyinvention.com/2.0/public/img/unchk_square.png' alt=''> Make changes to your invention design and allow
                attorney to re-write the application – additional Attorney, USPTO fees may apply.<br>
                <img src='https://www.ownmyinvention.com/2.0/public/img/unchk_square.png' alt=''> Allow the registered patent attorney to execute
                alternative filing strategies such as re-filing a design patent application.<br><br>
                Please note that there are no guarantees that any response to a Final Office Action will be persuasive
                or even considered. However you decide to continue, our organization will facilitate the work and engaging
                your independent registered patent attorney to continue working to represent you before the USPTO examiner.
                Contact our office at your earliest convenience so that we discuss your situation further. We will continue
                to keep you apprised of any further actions or events.
                <br><br>
                Sincerely,<br>
                Client Support Services<br>
                PATENT SERVICES<br>
                12000 Biscayne Blvd Suite #700<br>
                North Miami, FL 33181<br>
                1-888-344-6836 ext. 211<br>
                1-800-886-7951 Fax<br>";

        $sent = SendEmailHelper::send($files, $path, $to_mail, $from_mail, $header, $replyto, $subj, $msg, $title);
        if($sent == 1){
            Transaction::createTransaction($project->consultant_id,$project->lead_id,'','FINAL_OFFICE_ACTION_EMAILED','',$project->id,'','','','','');
            $pcs = $project->clientServicesProject();
            $csNote = new ClientSNotes();
            $csNote->notes = 'Final Office Action email sent';
            $csNote->projectclientservices_id = $pcs->id;
            $csNote->save();
            ///////change of phase
            if($pcs->phase == 6){
                $pcs->phase = 7;
                $pcs->changePhaseDate=date('Y-m-d 00:00:00');
                $pcs->save();
            }
            /////////////////////
            if($pcs->mailOnly == 1){
                $clientS = Consultant::where('usr','clientservices')->first();
                $msgInbox = "Final Office Action email sent to the project with the following fileno and it's check to regular mail.<br>File #: ".$pcs->fileno;
                Inbox::createInbox('',$clientS->id,$msgInbox,"CLIENT SERVICES","CLIENT");
            }
            return 1;
        }
        else
            return -1;
    }

    public function noticeAllowanceEmail(){
        $pid = Input::get('ID');
        $fileIds = Input::get('FILES');
        $feeAmount =money_format('%=#10.2n',Input::get('FEE'));
        $dueDate = date('M j, Y', strtotime(Input::get('DDATE')));
        $attId = Input::get('ATT');
        ////////////////////////////////////////////////
        ///here put code to choose the address by the att
        //////////////////////////////////////////////


        $project = Project::find($pid);
        if($project!=null){
            $subj = "Notice of Allowance";
            $header = "Patent Services USA";
            $title = "Patent Services USA";
            $to_mail = $project->lead->email;
            $from_mail = "clientservices@ownmyinvention.com";
            $replyto = "clientservices@ownmyinvention.com";
            $path = "files/projects/".$project->lead->fileno."/".$project->id."/";
            $files = array();
            if($fileIds != null)
                $fileIds = $this->getAttachedFilesArray($fileIds);

        }else
            return -1;

        $att = Consultant::find($attId);
        if($att== null)
            return -1;

        //align="center" try with this for center the text in the msg
        $msg = "Dear ".ucwords($project->lead->fname)." ".ucwords($project->lead->lname).":<br />
                Congratulations!  The United States Patent and Trademark Office has issued your innovation a Notice of
                Allowance. This form states that your patent will issue in approximately three months and all review of
                your idea has ended.  Attached, please find a copy of your Notice of Allowance.<br>
                As indicated thereon, the governmental issue fee for processing and printing of the formal Certificate of
                Letters Patent is $".$feeAmount." and the Issue Fee is due by ".$dueDate.". The fees should be forwarded to
                the patent attorney’s office at this time.<br><p align='center'>".$att->uuid."</p><br>
                Please note that this is a non-extendable deadline, and if the issue fee is not paid by the due date
                indicated above, the Patent Office will abandon the application. We do not expect to receive the patent
                for approximately three to four months after the fee is paid.<br>
                We are greatly pleased with your accomplishment as our goal has been to provide excellent service to enable
                this final step. Contact our office at your earliest convenience if needed.  Rest assured, we will continue
                to keep you apprised.
                <br><br>
                Sincerely,<br>
                Client Support Services<br>
                PATENT SERVICES<br>
                12000 Biscayne Blvd Suite #700<br>
                North Miami, FL 33181<br>
                1-888-344-6836 ext. 211<br>
                1-800-886-7951 Fax<br>";

        $sent = SendEmailHelper::send($files, $path, $to_mail, $from_mail, $header, $replyto, $subj, $msg, $title);
        if($sent == 1){
            Transaction::createTransaction($project->consultant_id,$project->lead_id,'','NOTICE_ALLOWANCE_EMAILED','',$project->id,'','','','','');
            $pcs = $project->clientServicesProject();
            $csNote = new ClientSNotes();
            $csNote->notes = 'Notice of Allowance email sent';
            $csNote->projectclientservices_id = $pcs->id;
            $csNote->save();
            ///////////////change the phase
            if($pcs->phase == 5){
                $pcs->phase = 6;
                $pcs->changePhaseDate=date('Y-m-d 00:00:00');
                $pcs->save();
            }
            ////////////////////
            if($pcs->mailOnly == 1){
                $clientS = Consultant::where('usr','clientservices')->first();
                $msgInbox = "Notice of Allowance email sent to the project with the following fileno and it's check to regular mail.<br>File #: ".$pcs->fileno;
                Inbox::createInbox('',$clientS->id,$msgInbox,"CLIENT SERVICES","CLIENT");
            }
            return 1;
        }
        else
            return -1;
    }

    public function trademarkAllowanceEmail(){
        $pid = Input::get('ID');
        $fileIds = Input::get('FILES');
        $date = date('M j, Y', strtotime(Input::get('DATE')));

        $project = Project::find($pid);
        if($project!=null){
            $subj = "Trademark Notice Of Allowance";
            $header = "Patent Services USA";
            $title = "Patent Services USA";
            $to_mail = $project->lead->email;
            $from_mail = "clientservices@ownmyinvention.com";
            $replyto = "clientservices@ownmyinvention.com";
            $path = "files/projects/".$project->lead->fileno."/".$project->id."/";
            $files = array();
            if($fileIds != null)
                $files = $this->getAttachedFilesArray($fileIds);

        }else
            return -1;

        $msg = "<b>Mark Name: $project->ideaName</b><br>
                <b>File No: ".$project->lead->fileno."</b><br>
                <b>Per Independent Registered Patent Attorney</b><br><br>
                Dear ".ucwords($project->lead->fname)." ".ucwords($project->lead->lname).":<br />
                I am pleased to inform you that the Trademark Office has issued a Notice of Allowance with respect to the
                mark as referenced above. As this application was filed based upon a bona fide intent to use the mark in
                commerce, it is now necessary to submit a Statement of Use prior to ".$date.".<br>
                The Statement of Use will verify to the Trademark Office the following information in order that ".ucwords($project->lead->fname)." ".ucwords($project->lead->lname)."
                may receive a Certificate of Registration:<br><br>
                <ol type='a'>
                    <li>
                        Ownership of the mark in the name of ".ucwords($project->lead->fname)." ".ucwords($project->lead->lname).";
                    </li>
                    <li>
                        The date of first use of the mark anywhere for the specific goods or services as set forth in the
                        Notice of Allowance;
                    </li>
                    <li>
                        The date of first use in interstate, foreign, or U.S. territorial commerce;
                    </li>
                    <li>
                    The mode or manner in which the mark has been used, e.g. brochures, specification sheets, flyers,
                    other advertising, etc.
                    </li>
                    <li>
                    The specimens which evidence current use of the mark in commerce for the one (1) designated class.</li>
                </ol>
                <br>
                The Statement of Use must be submitted to Patent Services before the deadline, failure to provide a statement
                of use will result in abandonment of the application. The inventor will be responsible for any fees to extend
                or revive the application.<br>
                With our goal and responsibility to providing excellent service to you, we can help better inform and guide you.  
                Our organization will facilitate the work and engage your independent registered patent attorney to continue working
                to represent you before the USPTO examiner.  We will continue to keep you apprised of any further actions or events.
                <br><br>
                Sincerely,<br>
                Client Support Services<br>
                PATENT SERVICES<br>
                12000 Biscayne Blvd Suite #700<br>
                North Miami, FL 33181<br>
                1-888-344-6836 ext. 211<br>
                1-800-886-7951 Fax<br>";

        $sent = SendEmailHelper::send($files, $path, $to_mail, $from_mail, $header, $replyto, $subj, $msg, $title);

        if($sent == 1){
            Transaction::createTransaction($project->consultant_id,$project->lead_id,'','TRADEMARK_NOTICE_ALLOWANCE_EMAILED','',$project->id,'','','','','');
            $pcs = $project->clientServicesProject();
            $csNote = new ClientSNotes();
            $csNote->notes = 'Trademark Notice Of Allowance email sent';
            $csNote->projectclientservices_id = $pcs->id;
            $csNote->save();
            /////////////////////
            if($pcs->mailOnly == 1){
                $clientS = Consultant::where('usr','clientservices')->first();
                $msgInbox = "Trademark Notice Of Allowance email sent to the project with the following fileno and it's check to regular mail.<br>File #: ".$pcs->fileno;
                Inbox::createInbox('',$clientS->id,$msgInbox,"CLIENT SERVICES","CLIENT");
            }
            return 1;
        }
        else
            return -1;
    }

    public function emailPCTAgreement(){
        $pid = Input::get('ID');
        $fileIds = Input::get('FILES');

        $project = Project::find($pid);
        if($project!=null){
            $subj = "PCT Filing Receipt";
            $header = "Patent Services USA";
            $title = "Patent Services USA";
            $to_mail = $project->lead->email;
            $from_mail = "clientservices@ownmyinvention.com";
            $replyto = "clientservices@ownmyinvention.com";
            $path = "files/projects/".$project->lead->fileno."/".$project->id."/";
            $files = array();
            if($fileIds != null)
                $files = $this->getAttachedFilesArray($fileIds);

        }else
            return -1;


        //align="center" try with this for center the text in the msg
        $msg = "Dear ".ucwords($project->lead->fname)." ".ucwords($project->lead->lname).":<br />
                Congratulations! Your patent application has been filed to the United States Patent and Trademark Office by our Registered Patent Attorney and reached the patent pending status.
                <br>
                At this point we can begin the process of introducing you to our Patent Corporation Treaty (PCT) Patent Attorney / Agent that will handle the filling of your application. Enclosed you will find the official, agreement for Patent services. After you have reviewed and approved the agreement, please initial and sign where indicated and return the entire original agreement, to Patent Services USA, INC. Once this information is received, we will forward this to Independent Patent Attorney/Agent.
                <br>
                If  you have any questions don't hesitate to contact us.
                <br><br>
                Sincerely,<br>
                Client Support Services<br>
                PATENT SERVICES<br>
                12000 Biscayne Blvd Suite #700<br>
                North Miami, FL 33181<br>
                1-888-344-6836 ext. 211<br>
                1-800-886-7951 Fax<br>";

        $sent = SendEmailHelper::send($files, $path, $to_mail, $from_mail, $header, $replyto, $subj, $msg, $title);
        if($sent == 1){
            Transaction::createTransaction($project->consultant_id,$project->lead_id,'','PCT_FILING_RECEIPT_EMAILED','',$project->id,'','','','','');
            //////////////
            $pcs =$project->clientServicesProject();
            if($pcs->mailOnly == 1){
                $clientS = Consultant::where('usr','clientservices')->first();
                $msgInbox = "PCT Filing Receipt emailed to the project with the following fileno and it's check to regular mail.<br>File #: ".$pcs->fileno;
                Inbox::createInbox('',$clientS->id,$msgInbox,"CLIENT SERVICES","CLIENT");
            }
            return 1;
        }
        else
            return -1;
    }

    public function emailPCTApplication(){
        $pid = Input::get('ID');
        $fileIds = Input::get('FILES');

        $project = Project::find($pid);
        if($project!=null){
            $subj = "Your PCT application has been filed";
            $header = "Patent Services USA";
            $title = "Patent Services USA";
            $to_mail = $project->lead->email;
            $from_mail = "clientservices@ownmyinvention.com";
            $replyto = "clientservices@ownmyinvention.com";
            $path = "files/projects/".$project->lead->fileno."/".$project->id."/";
            $files = array();
            if($fileIds != null)
                $files = $this->getAttachedFilesArray($fileIds);

        }else
            return -1;

        $pcs = $project->clientServicesProject();
        if($pcs == null)
            return -1;

        //align="center" try with this for center the text in the msg
        $msg = "Dear ".ucwords($project->lead->fname)." ".ucwords($project->lead->lname).":<br />
                Congratulations! Your PCT application has been filed to the United States Patent and Trademark Office by our Registered Patent Attorney and reached the patent pending status.  Enclosed you will find a copy of the electronic receipt, acknowledging the filing of the application, with application number ".$pcs->pctNumber.".
                <br>
                If  you have any questions don't hesitate to contact me.
                <br><br>
                Sincerely,<br>
                Client Support Services<br>
                PATENT SERVICES<br>
                12000 Biscayne Blvd Suite #700<br>
                North Miami, FL 33181<br>
                1-888-344-6836 ext. 211<br>
                1-800-886-7951 Fax<br>";

        $sent = SendEmailHelper::send($files, $path, $to_mail, $from_mail, $header, $replyto, $subj, $msg, $title);
        if($sent == 1){
            Transaction::createTransaction($project->consultant_id,$project->lead_id,'','PCT_APP_FILED_EMAILED','',$project->id,'','','','','');

            $csNote = new ClientSNotes();
            $csNote->notes = 'PCT application filed email sent';
            $csNote->projectclientservices_id = $pcs->id;
            $csNote->save();

            ////////////
            if($pcs->mailOnly == 1){
                $clientS = Consultant::where('usr','clientservices')->first();
                $msgInbox = "PCT application filed emailed to the project with the following fileno and it's check to regular mail.<br>File #: ".$pcs->fileno;
                Inbox::createInbox('',$clientS->id,$msgInbox,"CLIENT SERVICES","CLIENT");
            }
            return 1;
        }
        else
            return -1;
    }

    public function reminderAttBeforeProvExp(){
        $pid = Input::get('ID');

        $attcs = AttClientServices::find($pid);
        if($attcs!=null){
            $subj = "Upgrade overdue because provisional is close to expire";
            $header = "Patent Services USA";
            $title = "Patent Services USA";
            $to_mail = $attcs->consultant->email;
            $from_mail = "priority@ownmyinvention.com";
            $replyto = "clientservices@ownmyinvention.com";
            $path = "";
            $files = array();
        }else
            return -1;


        $msg = "File ".$attcs->projectclientservices->fileno." provisional will expired in 2 weeks
                <br><br>
                Sincerely,<br>
                Client Support Services<br>
                PATENT SERVICES<br>
                12000 Biscayne Blvd Suite #700<br>
                North Miami, FL 33181<br>
                1-888-344-6836 ext. 211<br>
                1-800-886-7951 Fax<br>";

        $sent = SendEmailHelper::send($files, $path, $to_mail, $from_mail, $header, $replyto, $subj, $msg, $title);
        if($sent == 1){
            Transaction::createTransaction('',$attcs->lead_id,'','REMINDER_TO_ATT_TWO_WEEK_BEFORE_PROV_EXP','',$attcs->projectclientservices->project->id,'','','','','');
            $pcs = $attcs->projectclientservices;
            $csNote = new ClientSNotes();
            $csNote->notes = 'REMINDER_TO_ATT_TWO_WEEK_BEFORE_PROV_EXP';
            $csNote->projectclientservices_id = $pcs->id;
            $csNote->save();

            $attcs->completed=3;
            $attcs->beforeDue = "provisional exp";
            $attcs->overDueReason = "Provisional will expire in ".date('m-d-Y', strtotime('+2 weeks'));
            $attcs->stateChangedDate = date('Y-m-d 00:00:00');
            $attcs->save();
            return 1;
        }
        else
            return -1;
    }

    public function ilcIntroPackgEmail(){
        $iid = Input::get('ID');
        $ilc=Ilc::find($iid);
        $emailType ="ILC_INTRO_PACKAGE_EMAILED_TO_CLIENT";
        if($ilc!=null){
            $path = 'files/projects/'.$ilc->fileno.'/'.$ilc->projectclientservices->project->id.'/';
            $files = array('SIC&NAICS_CODES.pdf',
                'productSpecSheet.pdf','inventorProfile.pdf',
                '../../../SAME - ILC Trade Show Procedures - 4.docx','../../../SAME - Inventors Resource Guide - 5.doc','../../../SAME - SIC and NAICS Info.doc');
            if(File::exists("files/projects/".$ilc->fileno."/".$ilc->projectclientservices->project->id.'/ilc_agreement_signed.pdf'))
                $files[]='ilc_agreement_signed.pdf';
            $mailto = $ilc->email;
            $from_mail = "asia@successwithilc.com";
            $replyto = "asia@successwithilc.com";
            $title = "International Licensing Consultants";
            $header = "International Licensing Consultants";
            $subj = "ILC Intro/Welcome Package";
            $msg = '<p class="pSmall">
    Dear '.ucwords($ilc->invFname)." ".ucwords($ilc->invLname).',
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    '.date('F j, Y').'
</p>
<p class="pSmall" style="text-align: justify;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    We would like to take this moment to congratulate you on your patent (or patent pending) status and formally
    welcome you to <span style="color:#008000">International Licensing Consultants</span>. We are an independent licensing agency, which often acquires
    portfolios like yours from patent assistance companies. ILC specializes in submitting products to industry, licensing
    negotiation services support, and education and assistance in the marketing of patented or patent pending inventions to
    industry. ILC will only accept clients who have a verifiable U.S. or International patent (pending) status, and have received a
    favorable product evaluation from a reputable independent third party. ILC performs licensing services on a contingency
    basis to select clientele acquired from our affiliated companies, meaning there are no upfront fees to these inventors for the
    services offered in our licensing agreement.
</p>
<p class="pSmall">
    Enclosed please find the following documents for your review:
</p>
<ul>
    <li>
       <b class="pSmall">ILC AFFILIATE LICENSING NEGOTIATIONS AGREEMENT</b> <span class="myiItalic">(Signed copy for your records)</span>
        <ul><li><span class="pSmall">The official agreement between ILC and yourself.</span></li></ul>
    </li>
    <li>
        <b class="pSmall">Product Spec Sheet</b>
        <ul><li><span class="pSmall">Specifications that will assist us in the marketing of your product/idea.</span></li></ul>
    </li>
    <li>
        <b class="pSmall">ILC Trade Show Procedures</b>
        <ul><li><span class="pSmall">Describes our trade-show processes and procedures.</span></li></ul>
    </li>
    <li>
        <b class="pSmall">ILC Inventors Profile</b>
        <ul><li><span class="pSmall">Profile to be uploaded along with your product information to our website.</span></li></ul>
    </li>
    <li>
        <b class="pSmall">ILC Inventors Networking Resource Guide</b>
        <ul><li><span class="pSmall">Reference guide through the licensing process.</span></li></ul>
    </li>
    <li>
        <b class="pSmall">SIC &amp; NAICS Classification Codes</b>
        <ul><li><span class="pSmall">US Classification Codes pertinent to your product</span></li></ul>
    </li>
</ul>
<p class="pSmall" style="text-align: justify;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    After completing the Inventor’s Profile and the Product Spec Sheet, please fax them to: <span style="color:#008000">800-343- 1052</span>, before
    mailing it to ensure a copy being secured in our branch office. If you are including a picture, it is not necessary to attempt to
    fax the picture (you may email it or simply include it in the copy you mail in). In the coming weeks, we will begin preparing
    your product artwork, establish a presence for your product on our website, and initiate mailings to potentially interested
    manufacturers. If you have any questions, please email us at: <u style="color:#008000">info@successwithilc.com</u> or call <span style="color:#008000">800-713- 1899</span>. Also, as
    we may contact you from time to time via email, please add this email address to your address book so messages from us
    do not get blocked by any filters. Once again, welcome aboard! We look forward to helping you with your licensing needs.
</p>
<p class="pSmall">Sincerely,</p>
<p class="mySmall" style="color: #008000">&nbsp;&nbsp;ASIA WYNDER</p>
<p class="mySmall">&nbsp;&nbsp;MARKETING DIRECTOR</p>
<p class="mySmall">&nbsp;&nbsp;INTERNATIONAL LICENSING CONSULTANTS</p>
<br>
<div class="myFooter">
    <p class="mySmall" align="center">7777 Glades Road Suite 100 &nbsp;<span style="color: orange">&bull;</span>&nbsp; Boca Raton, FL 33434</p>
    <p class="mySmall" align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;T: 1-800-713-1899 &nbsp;<span style="color: orange">&bull;</span>&nbsp; F: 1-800-343-1052</p>
    <p class="mySmall" align="center" style="color: orange">www.successwithilc.com</p>
</div>';

            $sent = SendEmailHelper::senIlc($files, $path, $mailto, $from_mail, $header, $replyto,$subj , $msg, $title,'');
            SendEmailHelper::senIlc($files, $path, 'asia@successwithilc.com', $from_mail, $header, $replyto,$subj , $msg, $title,'');
            Transaction::createTransaction($ilc->projectclientservices->project->consultant_id,$ilc->projectclientservices->project->lead_id,'',$emailType,'',$ilc->projectclientservices->project->id,'','','','','');
            $this->createPdfFromEmail($ilc,$ilc->projectclientservices->project_id,$subj,$msg,"WelcomePckgILC");

            return 1;
        }else
            return -1;
    }

    public function textCourtesyEmail(){
        $files = array();
        $manufacturers = explode(',',Input::get('MANUFACTURERS'));
        $emails = Input::get('EMAILS');
        $indName = urldecode(Input::get('INDUSTRY'));
        $path = '';
        $msg='';
        $mailto = 'info@ownmyinvention.com';
        $from_mail = "asia@successwithilc.com";
        $replyto = "asia@successwithilc.com";
        $title = "International Licensing Consultants";
        $header = "International Licensing Consultants";
        $subj = $indName." - Courtesy Update";
        $text = "Greetings ,<br><br>
                     We would like to alert you of our contacts, made this month, with manufacturers in the primary industry
                     and/or SIC &amp; NAICS coding network of your innovation. Our goal is to foster conversation and interest as
                     a means to obtain a licensing deal on your behalf. Second to this we vet manf. to confirm their history in
                     the industry, their years in business, openness to licensing outside ideas as well as their protocol and
                     noted criteria for intellectual property.
                     <br><br>
                     Please, read below to review a few of the manufacturers that ILC has contacted:
                     <br><br>";
        foreach($manufacturers as $manufacturer){
            $text.=$manufacturer."<br>";
        }
        $text .="Please note that as soon as ILC receives feedback from the above manufacturers and/or any other
                     contacts we made previously, ILC will contact you immediately to share whether we were able to share
                     your sell sheet, secure an NDA and/or complete a submission of your innovation for review. However, if
                     you have any questions or concerns in the interim, please do not hesitate to contact your Primary
                     Coordinator, at your earliest convenience.";
        $msg .=  "<br>.$text.
                     <br><br>
                     <p class='pSmall'>Sincerely,</p>
                     <p class='mySmall' style='color: #008000'>&nbsp;&nbsp;ASIA WYNDER</p>
                     <p class='mySmall'>&nbsp;&nbsp;MARKETING DIRECTOR</p>
                     <p class='mySmall'>&nbsp;&nbsp;INTERNATIONAL LICENSING CONSULTANTS</p>
                     <br>
                     <div class='myFooter'>
                         <p class='mySmall' align='center'>7777 Glades Road Suite 100 &nbsp;<span style='color: orange'>&bull;</span>&nbsp; Boca Raton, FL 33434</p>
                         <p class='mySmall' align='center'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;T: 1-800-713-1899 &nbsp;<span style='color: orange'>&bull;</span>&nbsp; F: 1-800-343-1052</p>
                         <p class='mySmall' align='center' style='color: orange'>www.successwithilc.com</p>
                     </div>";

        $sent = SendEmailHelper::senIlc($files, $path, $mailto, $from_mail, $header, $replyto,$subj , $msg, $title,$emails);
        SendEmailHelper::senIlc($files, $path, 'asia@successwithilc.com', $from_mail, $header, $replyto,$subj , $msg, $title,'');
        foreach(explode(',',$emails)  as $email){
            $ilc = Ilc::where('email',$email)->first();
            $fileName = $this->createPdfFromEmail($ilc,$ilc->projectclientservices->project_id,$subj,$text,"CourtesyUpdate");
            $ilcNote = new IlcNotes();
            $ilcNote->ilc_id = $ilc->id;
            $ilcNote->notes = $indName." - Courtesy email sent to client, email saved in file ".$fileName;
            $ilcNote->system =1;
            $ilcNote->save();
            $file = UploadedFiles::where('fileName',$fileName)->where('project_id',$ilc->projectclientservices->project_id)->first();
            if($file != null){
                $file->ilc =1;
                $file->save();
            }
        }
        return 1;
    }

    public function ilcNDATextEmail(){
        $files = array("ILC NDA Sample.docx");
        $mailto = Input::get('EMAIL');
        $msg = Input::get('TEXT');
        if($mailto!=null){
            $path = 'files/';
            $from_mail = "asia@successwithilc.com";
            $replyto = "asia@successwithilc.com";
            $title = "International Licensing Consultants";
            $header = "International Licensing Consultants";
            $subj = "ILC NDA Email";
            $msg.="<br><p class='pSmall'>Sincerely,</p>
                     <p class='mySmall' style='color: #008000'>&nbsp;&nbsp;ASIA WYNDER</p>
                     <p class='mySmall'>&nbsp;&nbsp;MARKETING DIRECTOR</p>
                     <p class='mySmall'>&nbsp;&nbsp;INTERNATIONAL LICENSING CONSULTANTS</p>
                     <br>
                     <div class='myFooter'>
                         <p class='mySmall' align='center'>7777 Glades Road Suite 100 &nbsp;<span style='color: orange'>&bull;</span>&nbsp; Boca Raton, FL 33434</p>
                         <p class='mySmall' align='center'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;T: 1-800-713-1899 &nbsp;<span style='color: orange'>&bull;</span>&nbsp; F: 1-800-343-1052</p>
                         <p class='mySmall' align='center' style='color: orange'>www.successwithilc.com</p>
                     </div>";
            $sent = SendEmailHelper::senIlc($files, $path, $mailto, $from_mail, $header, $replyto,$subj , $msg, $title,'');
            SendEmailHelper::senIlc($files, $path, 'asia@successwithilc.com', $from_mail, $header, $replyto,$subj , $msg, $title,'');
            if($sent == 1){
                Transaction::createTransaction('','','','NDA_EMAIL_TO_MANUFACTURER_SENT','Sent to: '.$mailto,'','','','','','');
                return 1;
            }else
                return -1;
        }else
            return -1;
    }

    public function ilcNDAToClient(){
        $files = array();
        $mailto = Input::get('EMAIL');
        $msg = Input::get('TEXT');
        $iid = Input::get('IID');
        $mid = Input::get('MID');
        $fids = Input::get('FILES');
        $ilc = Ilc::find($iid);
        if($ilc != null){
            $path = 'files/manufacturerFiles/'.$mid.'/';
            $from_mail = "asia@successwithilc.com";
            $replyto = "asia@successwithilc.com";
            $title = "International Licensing Consultants";
            $header = "International Licensing Consultants";
            $subj = "ILC NDA Email";
            if($fids != null)
                foreach($fids as $fid){
                    $file = UploadedFiles::find($fid);
                    if($file == null)
                        return -1;
                    $files[]=$file->fileName;
                }

            $msg.="<br><p class='pSmall'>Sincerely,</p>
                     <p class='mySmall' style='color: #008000'>&nbsp;&nbsp;ASIA WYNDER</p>
                     <p class='mySmall'>&nbsp;&nbsp;MARKETING DIRECTOR</p>
                     <p class='mySmall'>&nbsp;&nbsp;INTERNATIONAL LICENSING CONSULTANTS</p>
                     <br>
                     <div class='myFooter'>
                         <p class='mySmall' align='center'>7777 Glades Road Suite 100 &nbsp;<span style='color: orange'>&bull;</span>&nbsp; Boca Raton, FL 33434</p>
                         <p class='mySmall' align='center'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;T: 1-800-713-1899 &nbsp;<span style='color: orange'>&bull;</span>&nbsp; F: 1-800-343-1052</p>
                         <p class='mySmall' align='center' style='color: orange'>www.successwithilc.com</p>
                     </div>";
            $sent = SendEmailHelper::senIlc($files, $path, $mailto, $from_mail, $header, $replyto,$subj , $msg, $title,'');
            SendEmailHelper::senIlc($files, $path, 'asia@successwithilc.com', $from_mail, $header, $replyto,$subj , $msg, $title,'');
            if($sent == 1){
                $ilcNote = new IlcNotes();
                $ilcNote->ilc_id = $iid;
                $ilcNote->notes = "NON-DISCLOSURE AGREEMENT emailed to client.";
                $ilcNote->system =1;
                $ilcNote->save();
                PlivoHelper::sendSMS($ilc->projectclientservices->project->lead->phone, 'You have received communication from PSU please check your email for updates.');
                Transaction::createTransaction('',$ilc->projectclientservices->project->lead,'','NDA_EMAIL_TO_CLIENT','ILC ID:'.$iid,'','','','','','');
                return 1;
            }else
                return -1;
        }else
            return -1;
    }

    /**/
    public function introCallEmail(){
        $files = array();
        $lead =Lead::find(Input::get('LID'));
        if($lead != null){
            $path = '';
            $subj = "Intro Call";
            $header = "Patent Services USA";
            $title = "Patent Services USA";
            $to_mail = $lead->email;
            $from_mail = "clientservices@ownmyinvention.com";
            $replyto = "clientservices@ownmyinvention.com";

            $msg = "Dear ".ucwords($lead->fname)." ".ucwords($lead->lname).":<br />
                The client services department at Patent Services has contacted you to introduce the department as they
                will be servicing your patent moving forward. A client services representative is available to speak with
                you at your convenience during normal business hours, Monday – Friday, 8am-5pm est. If you need assistance
                or have questions about the patent process, please contact the client services department at 1-888-344-6836.
                This information is also available to you through your inventor’s platform at ownmyinvention.com.
                <br>
                If you have any questions don’t hesitate to contact us.
                <br><br>
                Sincerely,<br>
                Client Support Services<br>
                PATENT SERVICES<br>
                12000 Biscayne Blvd Suite #700<br>
                North Miami, FL 33181<br>
                1-888-344-6836 ext. 211<br>
                1-800-886-7951 Fax<br>";

            $sent = SendEmailHelper::send($files, $path, $to_mail, $from_mail, $header, $replyto,$subj , $msg, $title);

            return 1;
        }else
            return -1;
    }

    /*
     *
     * */
    public function reportIntroCall(){
        $msg_aux = '';
        $firstDay = date('Y-m-d 00:00:00', strtotime('- 7 days'));
        $lastDay = date('Y-m-d 23:59:59', strtotime('- 1 days'));
        $transactions = Transaction::where('transtype','AUTOMATIC_INTRO_CALL')->where('created_at','>',$firstDay)->where('created_at','<',$lastDay)->get();
        foreach($transactions as $trans){
            $lead_aux = $trans->lead;
            $msg_aux.='FileNo: '.$lead_aux->fileno.' ---------- Pin: '.$trans->project_id.' ---------- Client Name: '.ucwords($lead_aux->fname." ".$lead_aux->lname).' ---------- Date: '.date('m-d-Y',strtotime($trans->created_at)).'<br>';
        }
        $files = array();
        $path = '';
        $subj = "Intro Call Report";
        $header = "Patent Services USA";
        $title = "Patent Services USA";
        $to_mail = 'george@ownmyinvention.com';
        $from_mail = "info@ownmyinvention.com";
        $replyto = "info@ownmyinvention.com";

        $msg = "Clients who received automatic intro call last week:<br><br>".$msg_aux;
        if($msg_aux != ''){
            $sent = SendEmailHelper::send($files, $path, $to_mail, $from_mail, $header, $replyto,$subj , $msg, $title);
            $sent = SendEmailHelper::send($files, $path,'operations@ownmyinvention.com', $from_mail, $header, $replyto,$subj , $msg, $title);
        }

    }

    public function sendIlcSubEmail(){
        $mailto = Input::get('EMAIL');
        $fids = Input::get('FILES');
        $text = Input::get('TEXT');
        $bcc =  str_replace(';',',',Input::get('BCC'));
        $pid = Input::get('PID');
        $iid = Input::get('IID');
        if($mailto != null && $mailto!=''){
            $from_mail = "asia@successwithilc.com";
            $replyto = "asia@successwithilc.com";
            $title = "International Licensing Consultants";
            $header = "International Licensing Consultants";
            $subj = "Submission";
            $path = "";
            $files=array();
            if($fids != null)
                foreach($fids as $fid){
                    $file = UploadedFiles::find($fid);
                    if($file == null)
                        return -1;
                    $files[]=$file->url;
                }
            $msg=$text."<br><p class='pSmall'>Sincerely,</p>
                     <p class='mySmall' style='color: #008000'>&nbsp;&nbsp;ASIA WYNDER</p>
                     <p class='mySmall'>&nbsp;&nbsp;MARKETING DIRECTOR</p>
                     <p class='mySmall'>&nbsp;&nbsp;INTERNATIONAL LICENSING CONSULTANTS</p>
                     <br>
                     <div class='myFooter'>
                         <p class='mySmall' align='center'>7777 Glades Road Suite 100 &nbsp;<span style='color: orange'>&bull;</span>&nbsp; Boca Raton, FL 33434</p>
                         <p class='mySmall' align='center'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;T: 1-800-713-1899 &nbsp;<span style='color: orange'>&bull;</span>&nbsp; F: 1-800-343-1052</p>
                         <p class='mySmall' align='center' style='color: orange'>www.successwithilc.com</p>
                     </div>";
            $sent = SendEmailHelper::senIlc($files, $path, $mailto, $from_mail, $header, $replyto,$subj , $msg, $title,$bcc);
            SendEmailHelper::senIlc($files, $path, 'asia@successwithilc.com', $from_mail, $header, $replyto,$subj , $msg, $title,'');
            if($sent == 1){
                ///create pdf
                $ilc = Ilc::find($iid);
                $fileName = $this->createPdfFromEmail($ilc,$ilc->projectclientservices->project_id,$subj,nl2br($text),"SubToManf");

                $manfName =Input::get('MANF');
                $ilcNote = new IlcNotes();
                $ilcNote->ilc_id = $iid;
                $ilcNote->notes = "Submission emailed to client and to manufacturer ".$manfName.", email saved in ".$fileName;
                $ilcNote->system =1;
                $ilcNote->save();
                $userIlc = Consultant::where('usr','ilc')->first();
                Transaction::createTransaction($userIlc->id,'','','SUBMISSION_EMAILED_TO_CLIENT','',$pid,'','','','','');
//                PlivoHelper::sendSMS($ilc->projectclientservices->project->lead->phone, 'You have received communication from PSU please check your email for updates.');
                return 1;
            }else
                return -1;

        }
        return -1;
    }

    /*
     * send an email from client to PSUSA
     * */
    public function sendEmailFromClient(){
        $files = array();
        $subjFromClient = urldecode(Input::get('SUBJ'));
        $text = urldecode(Input::get('TEXT'));
        $pid = Input::get('PID');
        $countF = Input::get('COUNT');
        $forCS = Input::get('CLIENTSERVICES');
        $project = Project::find($pid);
        if($project != null){
            $msg ='<table align="center" width="100%"><tr><td>Client Name:'.$project->lead->fname.' '.$project->lead->lname.'</td></tr><tr><td>Email: '.$project->lead->email.'</td></tr><tr><td>FileNo: '.$project->lead->fileno.'</td></tr></table><br>';
            $msg.='<table align="center" width="100%"><tr><td>Subject:'.$subjFromClient.'</td></tr><tr><td>'.nl2br($text).'</td></tr></table>';
            $subj = 'Email From Client';
            $path = 'files/projects/'.$project->lead->fileno.'/'.$pid.'/uploaded/';
            $from_mail = 'info@ownmyinvention.com';
            $replyto = 'info@ownmyinvention.com';
            $title = "Patent Services USA";
            $header = "Patent Services USA";
            if($countF > 0){
                $docsAttach = UploadedFiles::where('project_id',$pid)->orderBy('created_at','DESC')->limit($countF)->get();
                foreach($docsAttach as $doc)
                    $files[]=$doc->fileName;
            }
            if($forCS == 1) {
                SendEmailHelper::send($files, $path, 'clientservices@ownmyinvention.com', $from_mail, $header, $replyto,$subj , $msg, $title);

                $csNote = new ClientSNotes();
                $pcs =ProjectClientServices::where('project_id',$pid)->first();
                $csNote->projectclientservices_id = $pcs->id;
                $csNote->notes = "Email received through the portal from client";
                $csNote->save();
                Transaction::createTransaction('',$project->lead->id,'','EMAIL_FROM_CLIENT','',$pid,'','','','','');
                return 1;
            }else{
                SendEmailHelper::send($files, $path, 'production@ownmyinvention.com', $from_mail, $header, $replyto,$subj , $msg, $title);
                return 1;
            }
            return -1;
        }else
            return -1;
    }

    public function emailTicket(){
        $tid = Input::get('TID');
        $ticket = Ticket::find($tid);
        $toClient = Input::get('TOCLIENT');
        $receiver = Input::get('RECEIVER');
        if($ticket!=null){
            $replies = Reply::where('ticket_id',$ticket->id)->orderBy('created_at','DESC')->get();
            $from_mail = "info@ownmyinvention.com";
            $replyto = "info@ownmyinvention.com";
            $title = "Patent Services USA";
            $header = "Patent Services USA";
            $subj = "Ticket Updated";
            $path = "";
            $files = array();
            $msg ="Client Name: ".$ticket->lead->fname." ".$ticket->lead->lname."<br>FILENO: ".$ticket->lead->fileno."<br>PIN: ".$ticket->project_id."<br><br>TICKET SUBJECT: ".$ticket->name."<br><br>";
            foreach($replies as $reply){
                if($reply->author == 'Client Services' || $reply->author == 'Production')
                    $msg.= "<span style='color: red;'>".$reply->author."&nbsp;&nbsp; (".date('m/d/Y H:i:s',strtotime($reply->created_at))."):</span><br><span style='margin-left: 30px !important;'>".$reply->message."</span><br><br>";
                else
                    $msg.= "<span style='color: green;'>".$reply->author."&nbsp;&nbsp; (".date('m/d/Y H:i:s',strtotime($reply->created_at))."):</span><br><span style='margin-left: 30px !important;'>".$reply->message."</span><br><br>";
            }
            SendEmailHelper::send($files, $path, 'rick@ownmyinvention.com', $from_mail, $header, $replyto,$subj , $msg, $title);
            SendEmailHelper::send($files, $path, 'operations@ownmyinvention.com', $from_mail, $header, $replyto,$subj , $msg, $title);
            if($toClient == 0 && $receiver == 'cs'){
                SendEmailHelper::send($files, $path, 'clientservices@ownmyinvention.com', $from_mail, $header, $replyto,"email to clientS@own".$subj , $msg, $title);
            }elseif($toClient == 0 && $receiver == 'production'){
                SendEmailHelper::send($files, $path, 'production@ownmyinvention.com', $from_mail, $header, $replyto,"email to production@own".$subj , $msg, $title);
            }elseif($toClient == 1){
                $project = Project::find($ticket->project_id);
                if($project != null && $project->clientServicesProject()!=null){
                    $csNote = new ClientSNotes();
                    $csNote->notes = "Ticket response sent to client.";
                    $csNote->projectclientservices_id = $project->clientServicesProject()->id;
                    $csNote->save();
                }
                ToolsFunctions::curl(url("emailTicketClient?LEADID=".$ticket->lead_id."&TID=".$tid));
            }
        }
    }

    public function emailTicketClient(){
        $lid = Input::get('LEADID');
        $tid = Input::get('TID');
        $lead = Lead::find($lid);
        if($lead != null){
            $from_mail = "info@ownmyinvention.com";
            $replyto = "info@ownmyinvention.com";
            $title = "Patent Services USA";
            $header = "Patent Services USA";
            $subj = "Ticket Updated";
            $path = "";
            $files = array();
            $ticket=Ticket::find($tid);
            $msg ="Dear ".ucwords($lead->fname)." ".ucwords($lead->lname).":<br />";
            $msg .='The ticket with subject: "'.$ticket->name.'" was updated by Patent Services USA, you can see it here <a href="https://www.ownmyinvention.com/2.0/public/launch/showTickets">online</a>';
            SendEmailHelper::send($files, $path, $lead->email, $from_mail, $header, $replyto,$subj , $msg, $title);
            PlivoHelper::sendSMS($ticket->lead->phone, 'You have received communication from PSU please check your email or inventor\'s platform for updates.');
        }
    }

    //send a email to client if psu closed the ticket or to psu if the client closed the ticket
    public function emailClosedTicket(){
        $tid =Input::get('TID');
        $fromCS = Input::get('FROM');//1 for Patent Services USA and 2 client name
        $ticket = Ticket::find($tid);
        if($ticket != null){
            $from_mail = "info@ownmyinvention.com";
            $replyto = "info@ownmyinvention.com";
            $title = "Patent Services USA";
            $header = "Patent Services USA";
            $subj = "Ticket Closed";
            $path = "";
            $files = array();
            $lead = $ticket->lead;
            if($fromCS == 1){
                $closedFrom = "Patent Services USA";
                $msg ="Dear ".ucwords($lead->fname)." ".ucwords($lead->lname).":<br />";
            }
            else{
                $closedFrom = ucwords($lead->fname)." ".ucwords($lead->lname);
                $msg ="";
            }

            $msg .='The ticket: "'.$ticket->name.'" with FileNo :'.$lead->fileno.' was closed by '.$closedFrom.'.';
            SendEmailHelper::send($files, $path, 'rick@ownmyinvention.com', $from_mail, $header, $replyto,$subj , $msg, $title);
            SendEmailHelper::send($files, $path, 'operations@ownmyinvention.com', $from_mail, $header, $replyto,$subj , $msg, $title);
            if($fromCS == 1)
                SendEmailHelper::send($files, $path, $lead->email, $from_mail, $header, $replyto,$subj , $msg, $title);
            elseif($ticket->receiver == 'cs') {
                SendEmailHelper::send($files, $path, 'clientservices@ownmyinvention.com', $from_mail, $header, $replyto, $subj, $msg, $title);
            }else{
                SendEmailHelper::send($files, $path,'production@ownmyinvention.com', $from_mail, $header, $replyto,$subj , $msg, $title);
            }
        }
    }


    public function sendDeclineEmailToManf(){
        $pid = Input::get('PID');
        $iid = Input::get('IID');
        $mid =Input::get('MID');
        $mailto = Input::get('EMAIL');
        $message = Input::get('TEXT');

        $message.="<br><p class='pSmall'>Sincerely,</p>
                     <p class='mySmall' style='color: #008000'>&nbsp;&nbsp;ASIA WYNDER</p>
                     <p class='mySmall'>&nbsp;&nbsp;MARKETING DIRECTOR</p>
                     <p class='mySmall'>&nbsp;&nbsp;INTERNATIONAL LICENSING CONSULTANTS</p>
                     <br>
                     <div class='myFooter'>
                         <p class='mySmall' align='center'>7777 Glades Road Suite 100 &nbsp;<span style='color: orange'>&bull;</span>&nbsp; Boca Raton, FL 33434</p>
                         <p class='mySmall' align='center'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;T: 1-800-713-1899 &nbsp;<span style='color: orange'>&bull;</span>&nbsp; F: 1-800-343-1052</p>
                         <p class='mySmall' align='center' style='color: orange'>www.successwithilc.com</p>
                     </div>";
        $manufacturer = Manufacturer::find($mid);
        if($manufacturer ==null)
            return -1;
        $from_mail = "asia@successwithilc.com";
        $replyto = "asia@successwithilc.com";
        $title = "International Licensing Consultants";
        $header = "International Licensing Consultants";
        $subj = "Decline Email";
        $path = "";
        $files = array();

        //send email
        $sent = SendEmailHelper::senIlc($files, $path, $mailto, $from_mail, $header, $replyto,$subj , $message, $title,'');
        SendEmailHelper::senIlc($files, $path, 'asia@successwithilc.com', $from_mail, $header, $replyto,$subj , $message, $title,'');
        if($sent == 1){
            //create ilc note
            $ilcNote = new IlcNotes();
            $ilcNote->ilc_id = $iid;
            $ilcNote->notes = "Decline Email sent to manufacturer: ".$manufacturer->name.".";
            $ilcNote->system =1;
            $ilcNote->save();
            //create Transaction
            $userIlc = Consultant::where('usr','ilc')->first();
            Transaction::createTransaction($userIlc->id,'','','DECLINE_EMAIL_SENT','',$pid,'','','','','');
            return json_encode($ilcNote);
        }else
            return -1;
    }

    public function sendExtensionEmail(){
        $pid = Input::get('PID');
        $project = Project::find($pid);
        if($project != null){
            $subj = "AMENDMENT TO PATENT PROTECTION AGREEMENT";
            $header = "Patent Services USA";
            $title = "Patent Services USA";
            $to_mail = $project->lead->email;
            $from_mail = "clientservices@ownmyinvention.com";
            $replyto = "clientservices@ownmyinvention.com";
            $path = "files/projects/".$project->lead->fileno."/".$project->id."/";
            $files = array('agreement_extension.pdf');
            $pcs = $project->clientServicesProject();

            $msg = "Dear ".ucwords($project->lead->fname)." ".ucwords($project->lead->lname).":<br />
                <p>It is with great pleasure that we have served your needs for over two years. It is with this desire
                to provide you with excellence that we would like to extend our services for one more year.</p>
                <p>Our records indicate your contract with us expires on ".date('m/d/Y',strtotime($pcs->rcvdDate.' +2 years -1 day')).". Because of this, we are offering
                you this one year extension. Enclosed is the extension agreement for your review. If you are interested
                in allowing us to serve you for one more year, please submit the signed extension agreement along with
                the payment to the address below as soon as possible. If not, your file will continue to be serviced by
                the Independent Registered Patent Attorney already assigned to your invention and our services will
                terminate according to the contract expiration date mentioned above. If within thirty (30) days, we have
                not received the agreement along with the payment, we will assume you have no desire to extend our services
                one more year.</p>
                <p>It was our goal to help you through this period, to engage the Independent Registered Patent Attorney and to serve all your needs. Please do not hesitate to contact us if you would need any further assistance.</p>
                <br><br>
                Sincerely,<br>
                Client Support Services<br>
                PATENT SERVICES<br>
                12000 Biscayne Blvd Suite #700<br>
                North Miami, FL 33181<br>
                1-888-344-6836 ext. 211<br>
                1-800-886-7951 Fax<br>";

            $sent = SendEmailHelper::send($files, $path, $to_mail, $from_mail, $header, $replyto, $subj, $msg, $title);
            if($sent == 1){
                Transaction::createTransaction($project->consultant_id,$project->lead_id,'','AGREEMENT_EXTENSION','',$project->id,'','','','','');
                $pcs = $project->clientServicesProject();
                $csNote = new ClientSNotes();
                $csNote->notes = 'Agreement Extension sent.';
                $csNote->projectclientservices_id = $pcs->id;
                $csNote->save();
                $pcs->agreementExt_sent = date('Y-m-d H:i:s');
                $pcs->save();
                return 1;
            }else
                return -1;
        }
        return -1;
    }


    public function responseFromILCToClients(){
        $project = Project::find(Input::get('PID'));
        $iid = Input::get('IID');
        $notes = Input::get('TEXT');
        $countF = Input::get('COUNT');
        $ilc = Ilc::find($iid);
        if($project!=null){
            $lead= $project->lead;
            $subj = "ILC EMAIL";
            $header = "International Licensing Consultants";
            $title = "International Licensing Consultants";
            $to_mail =$ilc->email;
            $from_mail = "asia@successwithilc.com";
            $replyto = "asia@successwithilc.com";
            $path = 'files/projects/'.$lead->fileno.'/'.$project->id.'/uploaded/';
            if($countF > 0){
                $docsAttach = UploadedFiles::where('project_id',$project->id)->orderBy('created_at','DESC')->limit($countF)->get();
                foreach($docsAttach as $doc)
                    $files[]=$doc->fileName;
            }


            //save email body into the dialer
            $pdf = App::make('dompdf.wrapper');
            $pdf->loadHTML('<table align="center" width="100%"><tr>
                        <td>Client Name: '.$ilc->invFname.' '.$ilc->invLname.'</td></tr><tr><td>Email: '.$ilc->email.'</td>
                        </tr><tr><td>FileNo: '.$lead->fileno.'</td></tr></table><br><table align="center" width="100%">
                        <tr><td>Subject: From ILC to Client</td></tr><tr><td><p>'.nl2br($notes).'</p></td></tr></table>');

            if(!File::exists("files/projects/".$lead->fileno."/".$project->id)) {
                File::makeDirectory("files/projects/".$lead->fileno."/".$project->id, 0755, true);
            }
            $docname = $lead->fileno."_emailCorrespondenceILCToClient_".date('m_d_Y H:i:s').".pdf";
            $pdf->save("files/projects/".$lead->fileno."/".$project->id."/".$docname);

            $aux_file = UploadedFiles::where('project_id',$project->id)->where('fileName',$docname)->first();
            if($aux_file!=null)
                $aux_file->delete();
            $uploadFile = new UploadedFiles();
            $uploadFile->project_id = $project->id;
            $uploadFile->url = "files/projects/".$lead->fileno."/".$project->id."/".$docname;
            $uploadFile->fileName = $docname;
            $uploadFile->ilc = 1;
            $uploadFile->save();


            $msg = nl2br($notes)."<br><p class='pSmall'>Sincerely,</p>
                     <p class='mySmall' style='color: #008000'>&nbsp;&nbsp;ASIA WYNDER</p>
                     <p class='mySmall'>&nbsp;&nbsp;MARKETING DIRECTOR</p>
                     <p class='mySmall'>&nbsp;&nbsp;INTERNATIONAL LICENSING CONSULTANTS</p>
                     <br>
                     <div class='myFooter'>
                         <p class='mySmall' align='center'>7777 Glades Road Suite 100 &nbsp;<span style='color: orange'>&bull;</span>&nbsp; Boca Raton, FL 33434</p>
                         <p class='mySmall' align='center'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;T: 1-800-713-1899 &nbsp;<span style='color: orange'>&bull;</span>&nbsp; F: 1-800-343-1052</p>
                         <p class='mySmall' align='center' style='color: orange'>www.successwithilc.com</p>
                     </div>";

            SendEmailHelper::senIlc($files, $path, $to_mail, $from_mail, $header, $replyto, $subj, $msg, $title,'');
            SendEmailHelper::senIlc($files, $path, 'asia@successwithilc.com', $from_mail, $header, $replyto, $subj, $msg, $title,'');
            //send text to Client to make sure he is notify
            PlivoHelper::sendSMS($project->lead->phone,"You just received an email from International Licensing Consultants. Please check your ".$project->lead->email." account");
            //note in ilc
            $ilcNote = new IlcNotes();
            $ilcNote->notes = 'Email sent to client through the portal.';
            $ilcNote->ilc_id = $iid;
            $ilcNote->system =1;
            $ilcNote->save();
            //transaction
            Transaction::createTransaction('',$project->lead_id,'','EMAIL_ILC_PSU_TO_CLIENT','','','','','','','');
            return 1;
        }
        return -1;
    }

    public function sendIntroCallILC(){
        $pid = Input::get('PID');
        $iid = Input::get('IID');
        $text =Input::get('TEXT');
        $project=Project::find($pid);
        $ilc = Ilc::find($iid);
        if($project!=null) {
            $message = "$text"."<p>In the interim, all the best,</p>
                     <p style='color: #008000'>&nbsp;&nbsp;ASIA WYNDER</p>
                     <p>&nbsp;&nbsp;MARKETING DIRECTOR</p>
                     <p>&nbsp;&nbsp;INTERNATIONAL LICENSING CONSULTANTS</p>
                     <br>
                     <div class='myFooter'>
                         <p class='mySmall' align='center'>7777 Glades Road Suite 100 &nbsp;<span style='color: orange'>&bull;</span>&nbsp; Boca Raton, FL 33434</p>
                         <p class='mySmall' align='center'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;T: 1-800-713-1899 &nbsp;<span style='color: orange'>&bull;</span>&nbsp; F: 1-800-343-1052</p>
                         <p class='mySmall' align='center' style='color: orange'>www.successwithilc.com</p>
                     </div>
                     <p>DISCLAIMER:</p>
                    <p>This email message is for the sole use of the intended recipient(s) and may contain confidential and privileged information.
                    Any unauthorized review, use, disclosure or distribution is prohibited. If you are not the intended recipient, please contact
                    the sender by reply email and destroy all copies of the original message.</p>";

            $mailto =  $ilc->email;
            $from_mail = "asia@successwithilc.com";
            $replyto = "asia@successwithilc.com";
            $title = "International Licensing Consultants";
            $header = "International Licensing Consultants";
            $subj = "Intro Call Email";
            $path = "";
            $files = array();

            //send email
            $sent = SendEmailHelper::senIlc($files, $path, $mailto, $from_mail, $header, $replyto, $subj, $message, $title, '');
            SendEmailHelper::senIlc($files, $path, 'asia@successwithilc.com', $from_mail, $header, $replyto, $subj, $message, $title, '');
            SendEmailHelper::senIlc($files, $path, 'jesus@ownmyinvention.com', $from_mail, $header, $replyto, $subj, $message, $title, '');
            if ($sent == 1) {
                //create pdf
                $this->createPdfFromEmail($ilc,$project->id,$subj,nl2br($text),"IntroCallILC");
                //create ilc note
                $ilcNote = new IlcNotes();
                $ilcNote->ilc_id = $iid;
                $ilcNote->notes = "Intro Call Email sent.";
                $ilcNote->system =1;
                $ilcNote->save();
                //create Transaction
                $userIlc = Consultant::where('usr', 'ilc')->first();
                Transaction::createTransaction($userIlc->id, '', '', 'INTRO_CALL_ILC', '', $pid, '', '', '', '', '');
                return 1;
            } else
                return -1;
        }
        return -1;
    }

    public function sendUpdateRegardingILCWeb(){
        $date = date('m-d-Y', strtotime(Input::get('DATE')));
        $pid = Input::get('PID');
        $iid = Input::get('IID');
        $project=Project::find($pid);
        $ilc = Ilc::find($iid);
        if($project!=null) {
            $mailto = $ilc->email;
            $from_mail = "asia@successwithilc.com";
            $replyto = "asia@successwithilc.com";
            $title = "International Licensing Consultants";
            $header = "International Licensing Consultants";
            $subj = "Update Regarding your ILC Webpage";
            $path = "";
            $files = array();
            $message ='<p>Greetings.</p>
                       <p style="text-align: justify;">ILC is happy to share that we are preparing the final stages of your personal webpage on our
                       website, <a href="www.successwithilc.com">www.successwithilc.com</a> We do appreciate your patience
                       for it is crucial that we ensure the security, search consistency, and overall confidentiality of
                       the webpages we construct for marketing before sharing the access codes.
                       </p>
                       <p style="text-align: justify;">Please keep in mind, that the webpage is just one aspect of the
                       services in which we render to gain interest in your innovation. We have attended tradeshows – you
                       can always monitor our agenda at <a href="http://successwithilc.com/TradeShow.aspx">http://successwithilc.com/TradeShow.aspx</a> - and we are proactively
                       contacting our leads within our database. Although we do not have a interested manf. to report at
                       this time, please note that we will continue our efforts and alert you immediately of any and all
                       developments.</p>
                       <p style="text-align: justify;">
                       With that shared, <span style="text-decoration: underline;font-style: italic;font-weight:bold;">we are looking to provide you with a username and password for your webpage by
                       '.$date.'</span> Furthermore, your direct webpage serves as a marketing medium and will be utilized in addition
                       to the other strategic services, noted earlier. Below, for your records, is a formal breakdown of
                       how the website functions:</p>
                       <p style="text-align: justify;color:blue;">
                       Manf. are permitted to search our database after they have registered on our site, electronically
                       signed our NDA and have been vetted and approved by ILC. When we vet a company we look for years in
                       the industry, revenue, primary product development and openness to new products from outside sources.
                       Once this is confirmed the manf. has a self-defined username and password which permits them access to
                       search our clientele by SIC/NAICS codes, related industry and/or concept. We also submit materials to manf.
                       often immediately after they register and/or if they have selected a favorite product which internally sends
                       ILC a notification of their interest.</p>
                       <p style="text-align: justify;color:blue;">
                       Please note that we do not have an internal counter on our website so we will not be able to share
                       how many manf. looked at your page in particular, however, we will always keep you updated as
                       developments occur.</p>
                       <p style="text-align: justify;color:blue;">
                       Lastly, you may have noticed featured products on our site, this public element, are for clients
                       that have already confirmed receipt of a granted patent by the USPTO. Since it is protected by the
                       patent and is already in public domain  ILC can advertise it directly, all other pending clients
                       are secured within our log-in only database.</p>
                       <p>
                       Again, we thank you greatly for your patience thus far.
                       </p>
                       <p>Best regards,</p>
                     <p style="color: #008000">&nbsp;&nbsp;ASIA WYNDER</p>
                     <p>&nbsp;&nbsp;MARKETING DIRECTOR</p>
                     <p>&nbsp;&nbsp;INTERNATIONAL LICENSING CONSULTANTS</p>
                     <br>
                     <div class="myFooter">
                         <p class="mySmall" align="center">7777 Glades Road Suite 100 &nbsp;<span style="color: orange">&bull;</span>&nbsp; Boca Raton, FL 33434</p>
                         <p class="mySmall" align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;T: 1-800-713-1899 &nbsp;<span style="color: orange">&bull;</span>&nbsp; F: 1-800-343-1052</p>
                         <p class="mySmall" align="center" style="color: orange">www.successwithilc.com</p>
                     </div>
                     <p>DISCLAIMER:</p>
                    <p>This email message is for the sole use of the intended recipient(s) and may contain confidential and privileged information.
            Any unauthorized review, use, disclosure or distribution is prohibited. If you are not the intended recipient, please contact
                    the sender by reply email and destroy all copies of the original message.</p>';

            //send email
            $sent = SendEmailHelper::senIlc($files, $path, $mailto, $from_mail, $header, $replyto, $subj, $message, $title, '');
            SendEmailHelper::senIlc($files, $path, 'asia@successwithilc.com', $from_mail, $header, $replyto, $subj, $message, $title, '');
            if ($sent == 1) {
                //create ilc note
                $ilcNote = new IlcNotes();
                $ilcNote->ilc_id = $iid;
                $ilcNote->notes = "Update Regarding ILC Webpage sent.";
                $ilcNote->system =1;
                $ilcNote->save();
                //create Transaction
                $userIlc = Consultant::where('usr', 'ilc')->first();
                Transaction::createTransaction($userIlc->id, '', '', 'UPDATE_REGARDING_ILC_WEBPAGE', '', $pid, '', '', '', '', '');
                return 1;
            } else
                return -1;
        }
        return -1;
    }

    public function sendSeparationAbandoned(){
        $pid = Input::get('PID');
        $iid = Input::get('IID');
        $project=Project::find($pid);
        $ilc = Ilc::find($iid);
        if($ilc!=null) {
            $path = "files/projects/".$project->lead->fileno."/".$project->id."/";
            //generate the separation doc
            $pcs = $project->clientServicesProject();
            $date =date('m-d-Y');
            $content = view('templates.ilc.mail_separation_utility_abandoned_template_pdf',
                array('ilc'=>$ilc,'appNo'=>$pcs->patentAppNo,'project'=>$project,'date'=>$date));
            $pdf = App::make('dompdf.wrapper');
            $pdf->loadHTML($content);
            $pdf->save($path."separation_utility_abandoned.pdf");

            $mailto = $ilc->email;
            $from_mail = "asia@successwithilc.com";
            $replyto = "asia@successwithilc.com";
            $title = "International Licensing Consultants";
            $header = "International Licensing Consultants";
            $subj = "Separation Letter";
            $files = array("separation_utility_abandoned.pdf");
            $message ='<p> Dear '.$ilc->invFname.' '.$ilc->invLname.',</p>
                        <p  style="text-align: justify;line-height: 150%;">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;We regret to inform you that our research indicates your pending
                            utility patent for  '.$ilc->inventionName.' has been abandoned by the USPTO and was officially recorded as abandoned.
                        </p>
                        <p  style="text-align: justify;line-height: 150%;">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;You can verify this development by visiting: <a href="http://www.uspto.gov/patents/process/status/index.jsp">http://www.uspto.gov/patents/process/status/index.jsp</a>
                            Upon arriving to the page, please select <b>Public Pair</b> (which can be found under the Check Status tab on the left
                            side of the page). At this point, you would have to enter the security captcha as noted on the screen. After
                            successfully passing this security feature, you will be directed to Search for Application. Our records note your
                            utility application number as: '.$pcs->patentAppNo.'. Please enter this number and press search, the next page will show your recorded status with the USPTO.</p>
                        <p  style="text-align: justify;line-height: 150%;">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Although, it has truly been a privilege working with you on your product, <span style="text-decoration: underline;">we regret to inform you that
                            since your invention is no longer under the protection of a patent-pending status, ILC cannot further advocate or
                            market your invention to manufacturers within the industry</span>. Therefore, we are separating from your initial
                            contract and ceasing all networking on the behalf of your product.
                        </p>
                        <p  style="text-align: justify;line-height: 150%;">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The marketing of new inventions is often a risky and uncertain challenge and even though this particular
                            invention was not rewarded a definitive patent, we must commend you for assessing that risk and meeting that
                            challenge with consistent excitement. We would again like to thank you very much for being our client and
                            should you have any need for our marketing services on a new product idea down the line, please do not hesitate
                            to contact us.
                        </p>
                       <p>Best regards,</p>
                     <p style="color: #008000">&nbsp;&nbsp;ASIA WYNDER</p>
                     <p>&nbsp;&nbsp;MARKETING DIRECTOR</p>
                     <p>&nbsp;&nbsp;INTERNATIONAL LICENSING CONSULTANTS</p>
                     <br>
                     <div class="myFooter">
                         <p class="mySmall" align="center">7777 Glades Road Suite 100 &nbsp;<span style="color: orange">&bull;</span>&nbsp; Boca Raton, FL 33434</p>
                         <p class="mySmall" align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;T: 1-800-713-1899 &nbsp;<span style="color: orange">&bull;</span>&nbsp; F: 1-800-343-1052</p>
                         <p class="mySmall" align="center" style="color: orange">www.successwithilc.com</p>
                     </div>
                     <p>DISCLAIMER:</p>
                    <p>This email message is for the sole use of the intended recipient(s) and may contain confidential and privileged information.
            Any unauthorized review, use, disclosure or distribution is prohibited. If you are not the intended recipient, please contact
                    the sender by reply email and destroy all copies of the original message.</p>';

            //send email
            $sent = SendEmailHelper::senIlc($files, $path, $mailto, $from_mail, $header, $replyto, $subj, $message, $title, '');
            SendEmailHelper::senIlc($files, $path, 'asia@successwithilc.com', $from_mail, $header, $replyto, $subj, $message, $title, '');
//            SendEmailHelper::senIlc($files, $path, 'jesus@ownmyinvention.com', $from_mail, $header, $replyto, $subj, $message, $title, '');
            if ($sent == 1) {
                //create pdf
                $this->createPdfFromEmail($ilc,$project->id,$subj,$message,"SeparationLetter");
                //create ilc note
                $ilcNote = new IlcNotes();
                $ilcNote->ilc_id = $iid;
                $ilcNote->notes = "Separation letter utility abandoned sent.";
                $ilcNote->system =1;
                $ilcNote->save();
                //upload the doc
                $uploadFile = new UploadedFiles();
                $uploadFile->project_id = $project->id;
                $uploadFile->url = "files/projects/".$project->lead->fileno."/".$project->id."/separation_utility_abandoned.pdf";
                $uploadFile->fileName = "separation_utility_abandoned.pdf";
                $uploadFile->ilc = 1;
                $uploadFile->save();
                //save the separation date
                $ilc->separationDate = date('Y-m-d H:i:s');
                $ilc->save();
                //create Transaction
                $userIlc = Consultant::where('usr', 'ilc')->first();
                Transaction::createTransaction($userIlc->id, '', '', 'SEPARATION_UTILITY_ABANDONED_SENT', '', $pid, '', '', '', '', '');
                return 1;
            } else
                return -1;
        }
    }

    public function sendSeparationClientRequest(){
        $pid = Input::get('PID');
        $iid = Input::get('IID');
        $project=Project::find($pid);
        $ilc = Ilc::find($iid);
        if($ilc!=null) {
            $path = "files/projects/".$project->lead->fileno."/".$project->id."/";
            //generate the separation doc
            $date =date('m-d-Y');
            $content = view('templates.ilc.mail_separation_client_request_template_pdf',
                array('ilc'=>$ilc,'project'=>$project,'date'=>$date));
            $pdf = App::make('dompdf.wrapper');
            $pdf->loadHTML($content);
            $pdf->save($path."separation_client_request.pdf");

            $mailto = $ilc->email;
            $from_mail = "asia@successwithilc.com";
            $replyto = "asia@successwithilc.com";
            $title = "International Licensing Consultants";
            $header = "International Licensing Consultants";
            $subj = "Separation Letter";
            $files = array("separation_client_request.pdf");
            $message ='<p> Dear '.$ilc->invFname.' '.$ilc->invLname.',</p>
                       <p  style="text-align: justify;line-height: 150%;">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;As per your written request, your contract with International Licensing Consultants has been
                            cancelled, effective '.$date.'. Though the process of marketing new inventions is often a risky and
                            uncertain challenge, ILC is and has always been committed to providing the best networking and
                            licensing service possible to each of our clients.
                        </p>
                        <p  style="text-align: justify;line-height: 150%;">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Therefore, we will offer the courtesy of reaching out to you should we receive feedback from a
                            manufacturer that was recently contacted on your behalf, in order to see if you would like to reconsider
                            your decision before we decline the interested manufacturer`s submission request.</p>
                        <p  style="text-align: justify;line-height: 150%;">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;It has truly been a privilege working with you and although we regret your decision for a
                            premature departure from our services, we genuinely wish you much success, if you choose to market '.$ilc->inventionName.'
                            , independently.
                        </p>
                       <p>Best regards,</p>
                     <p style="color: #008000">&nbsp;&nbsp;ASIA WYNDER</p>
                     <p>&nbsp;&nbsp;MARKETING DIRECTOR</p>
                     <p>&nbsp;&nbsp;INTERNATIONAL LICENSING CONSULTANTS</p>
                     <br>
                     <div class="myFooter">
                         <p class="mySmall" align="center">7777 Glades Road Suite 100 &nbsp;<span style="color: orange">&bull;</span>&nbsp; Boca Raton, FL 33434</p>
                         <p class="mySmall" align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;T: 1-800-713-1899 &nbsp;<span style="color: orange">&bull;</span>&nbsp; F: 1-800-343-1052</p>
                         <p class="mySmall" align="center" style="color: orange">www.successwithilc.com</p>
                     </div>
                     <p>DISCLAIMER:</p>
                    <p>This email message is for the sole use of the intended recipient(s) and may contain confidential and privileged information.
            Any unauthorized review, use, disclosure or distribution is prohibited. If you are not the intended recipient, please contact
                    the sender by reply email and destroy all copies of the original message.</p>';

            //send email
            $sent = SendEmailHelper::senIlc($files, $path, $mailto, $from_mail, $header, $replyto, $subj, $message, $title, '');
            SendEmailHelper::senIlc($files, $path, 'asia@successwithilc.com', $from_mail, $header, $replyto, $subj, $message, $title, '');
//            SendEmailHelper::senIlc($files, $path, 'jesus@ownmyinvention.com', $from_mail, $header, $replyto, $subj, $message, $title, '');
            if ($sent == 1) {
                //create pdf
                $this->createPdfFromEmail($ilc,$project->id,$subj,$message,"SeparationLetter");
                //create ilc note
                $ilcNote = new IlcNotes();
                $ilcNote->ilc_id = $iid;
                $ilcNote->notes = "Separation letter client request sent.";
                $ilcNote->system =1;
                $ilcNote->save();
                //upload the doc
                $uploadFile = new UploadedFiles();
                $uploadFile->project_id = $project->id;
                $uploadFile->url = "files/projects/".$project->lead->fileno."/".$project->id."/separation_client_request.pdf";
                $uploadFile->fileName = "separation_client_request.pdf";
                $uploadFile->ilc = 1;
                $uploadFile->save();
                //save the separation date
                $ilc->separationDate = date('Y-m-d H:i:s');
                $ilc->save();
                //create Transaction
                $userIlc = Consultant::where('usr', 'ilc')->first();
                Transaction::createTransaction($userIlc->id, '', '', 'SEPARATION_CLIENT_REQUEST_SENT', '', $pid, '', '', '', '', '');
                return 1;
            } else
                return -1;
        }
    }

    public function sendSeparationProv(){
        $pid = Input::get('PID');
        $iid = Input::get('IID');
        $project=Project::find($pid);
        $ilc = Ilc::find($iid);
        if($ilc!=null) {
            $path = "files/projects/".$project->lead->fileno."/".$project->id."/";
            //generate the separation doc
            $date =date('m-d-Y');
            $content = view('templates.ilc.mail_separation_provisional_template_pdf',
                array('ilc'=>$ilc,'project'=>$project,'date'=>$date));
            $pdf = App::make('dompdf.wrapper');
            $pdf->loadHTML($content);
            $pdf->save($path."separation_provisional.pdf");

            $mailto = $ilc->email;
            $from_mail = "asia@successwithilc.com";
            $replyto = "asia@successwithilc.com";
            $title = "International Licensing Consultants";
            $header = "International Licensing Consultants";
            $subj = "Separation Letter";
            $files = array("separation_provisional.pdf");
            $message ='<p> Dear '.$project->lead->fname.' '.$project->lead->lname.',</p>
                       <p  style="text-align: justify;line-height: 150%;">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;We regret to inform you that our records indicate your contract with International Licensing
                            Consultants has expired as of '.$date.'. It has truly been a privilege working with you on your product,
                            '.$ilc->inventionName.', and we hope you do not choose to merely abandon the idea.
                        </p>
                        <p  style="text-align: justify;line-height: 150%;">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Should you desire to secure patent protection, beyond the provisional time restraint, please
                            share proper documentation with us so that we may consider extending your contract and ideally
                            continue marketing on your behalf with minimal delay. If you choose not, please know that the
                            marketing of new inventions is often a risky and uncertain challenge and we commend you for
                            assessing that risk and meeting that challenge with consistent excitement from the beginning.</p>
                        <p  style="text-align: justify;line-height: 150%;">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;We would again like to thank you very much for being our client, and we wish you much
                            success in the future. Also, if you have any need for our marketing services on a new product idea
                            down the line, please do not hesitate to contact us.
                        </p>
                       <p>Best regards,</p>
                     <p style="color: #008000">&nbsp;&nbsp;ASIA WYNDER</p>
                     <p>&nbsp;&nbsp;MARKETING DIRECTOR</p>
                     <p>&nbsp;&nbsp;INTERNATIONAL LICENSING CONSULTANTS</p>
                     <br>
                     <div class="myFooter">
                         <p class="mySmall" align="center">7777 Glades Road Suite 100 &nbsp;<span style="color: orange">&bull;</span>&nbsp; Boca Raton, FL 33434</p>
                         <p class="mySmall" align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;T: 1-800-713-1899 &nbsp;<span style="color: orange">&bull;</span>&nbsp; F: 1-800-343-1052</p>
                         <p class="mySmall" align="center" style="color: orange">www.successwithilc.com</p>
                     </div>
                     <p>DISCLAIMER:</p>
                    <p>This email message is for the sole use of the intended recipient(s) and may contain confidential and privileged information.
            Any unauthorized review, use, disclosure or distribution is prohibited. If you are not the intended recipient, please contact
                    the sender by reply email and destroy all copies of the original message.</p>';

            //send email
            $sent = SendEmailHelper::senIlc($files, $path, $mailto, $from_mail, $header, $replyto, $subj, $message, $title, '');
            SendEmailHelper::senIlc($files, $path, 'asia@successwithilc.com', $from_mail, $header, $replyto, $subj, $message, $title, '');
//            SendEmailHelper::senIlc($files, $path, 'jesus@ownmyinvention.com', $from_mail, $header, $replyto, $subj, $message, $title, '');
            if ($sent == 1) {
                //create pdf
                $this->createPdfFromEmail($ilc,$project->id,$subj,$message,"SeparationLetter");
                //create ilc note
                $ilcNote = new IlcNotes();
                $ilcNote->ilc_id = $iid;
                $ilcNote->notes = "Separation letter provisional sent.";
                $ilcNote->system =1;
                $ilcNote->save();
                //upload the doc
                $uploadFile = new UploadedFiles();
                $uploadFile->project_id = $project->id;
                $uploadFile->url = "files/projects/".$project->lead->fileno."/".$project->id."/separation_provisional.pdf";
                $uploadFile->fileName = "separation_provisional.pdf";
                $uploadFile->ilc = 1;
                $uploadFile->save();
                //save the separation date
                $ilc->separationDate = date('Y-m-d H:i:s');
                $ilc->save();
                //create Transaction
                $userIlc = Consultant::where('usr', 'ilc')->first();
                Transaction::createTransaction($userIlc->id, '', '', 'SEPARATION_PROVISIONAL_SENT', '', $pid, '', '', '', '', '');
                return 1;
            } else
                return -1;
        }
    }

    public function sendSeparationUtility(){
        $pid = Input::get('PID');
        $iid = Input::get('IID');
        $project=Project::find($pid);
        $ilc = Ilc::find($iid);
        if($ilc!=null) {
            $path = "files/projects/".$project->lead->fileno."/".$project->id."/";
            //generate the separation doc
            $date =date('m-d-Y');
            $content = view('templates.ilc.mail_separation_utility_template_pdf',
                array('ilc'=>$ilc,'project'=>$project,'date'=>$date));
            $pdf = App::make('dompdf.wrapper');
            $pdf->loadHTML($content);
            $pdf->save($path."separation_utility.pdf");

            $mailto = $ilc->email;
            $from_mail = "asia@successwithilc.com";
            $replyto = "asia@successwithilc.com";
            $title = "International Licensing Consultants";
            $header = "International Licensing Consultants";
            $subj = "Separation Letter";
            $files = array("separation_utility.pdf");
            $message ='<p> Dear '.$ilc->invFname.' '.$ilc->invLname.',</p>
                    <p  style="text-align: justify;line-height: 150%;">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;We regret to inform you that our records indicate your contract with International Licensing
                        Consultants has expired as of '.$date.'. It has truly been a privilege working with you on your product,
                        '.$ilc->inventionName.', and we hope you do not choose to merely abandon the idea. The marketing of
                        new inventions is often a risky and uncertain challenge, and we must commend you for assessing that
                        risk and meeting that challenge with consistent excitement.
                    </p>
                    <p  style="text-align: justify;line-height: 150%;">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;As a courtesy to you, we will maintain your marketing webpage, just in-case we receive
                        feedback from a manufacturer that was recently contacted on your behalf. Should a manufacturer
                        desire a submission, we will proceed as formerly explained and agreed upon under the original
                        contractual terms. <span style="text-decoration: underline;">Please note that this extension is only for six (6) months and is based solely on
                        documented interest in your idea, by a manufacturer.</span></p>
                    <p  style="text-align: justify;line-height: 150%;">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;We would again like to thank you very much for being our client, and we wish you much
                        success in the future. Should you have any need for our marketing services on a new product idea
                        down the line, please do not hesitate to contact us.
                    </p>
                       <p>Best regards,</p>
                     <p style="color: #008000">&nbsp;&nbsp;ASIA WYNDER</p>
                     <p>&nbsp;&nbsp;MARKETING DIRECTOR</p>
                     <p>&nbsp;&nbsp;INTERNATIONAL LICENSING CONSULTANTS</p>
                     <br>
                     <div class="myFooter">
                         <p class="mySmall" align="center">7777 Glades Road Suite 100 &nbsp;<span style="color: orange">&bull;</span>&nbsp; Boca Raton, FL 33434</p>
                         <p class="mySmall" align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;T: 1-800-713-1899 &nbsp;<span style="color: orange">&bull;</span>&nbsp; F: 1-800-343-1052</p>
                         <p class="mySmall" align="center" style="color: orange">www.successwithilc.com</p>
                     </div>
                     <p>DISCLAIMER:</p>
                    <p>This email message is for the sole use of the intended recipient(s) and may contain confidential and privileged information.
            Any unauthorized review, use, disclosure or distribution is prohibited. If you are not the intended recipient, please contact
                    the sender by reply email and destroy all copies of the original message.</p>';

            //send email
            $sent = SendEmailHelper::senIlc($files, $path, $mailto, $from_mail, $header, $replyto, $subj, $message, $title, '');
            SendEmailHelper::senIlc($files, $path, 'asia@successwithilc.com', $from_mail, $header, $replyto, $subj, $message, $title, '');
//            SendEmailHelper::senIlc($files, $path, 'jesus@ownmyinvention.com', $from_mail, $header, $replyto, $subj, $message, $title, '');
            if ($sent == 1) {
                //create pdf
                $this->createPdfFromEmail($ilc,$project->id,$subj,$message,"SeparationLetter");
                //create ilc note
                $ilcNote = new IlcNotes();
                $ilcNote->ilc_id = $iid;
                $ilcNote->notes = "Separation letter utility sent.";
                $ilcNote->system =1;
                $ilcNote->save();
                //upload the doc
                $uploadFile = new UploadedFiles();
                $uploadFile->project_id = $project->id;
                $uploadFile->url = "files/projects/".$project->lead->fileno."/".$project->id."/separation_utility.pdf";
                $uploadFile->fileName = "separation_utility.pdf";
                $uploadFile->ilc = 1;
                $uploadFile->save();
                //save the separation date
                $ilc->separationDate = date('Y-m-d H:i:s');
                $ilc->save();
                //create Transaction
                $userIlc = Consultant::where('usr', 'ilc')->first();
                Transaction::createTransaction($userIlc->id, '', '', 'SEPARATION_UTILITY_SENT', '', $pid, '', '', '', '', '');
                return 1;
            } else
                return -1;
        }
    }


    public function sendWebsiteCodes(){
        $iid = Input::get('IID');
        $ilc = Ilc::find($iid);
        if($ilc!=null) {

            $mailto = $ilc->email;
            $from_mail = "asia@successwithilc.com";
            $replyto = "asia@successwithilc.com";
            $title = "International Licensing Consultants";
            $header = "International Licensing Consultants";
            $subj = "Website Access Codes";
            $files = array();
            $message ='<p>Hi '.ucwords($ilc->invFname." ".$ilc->invLname).',</p>
            <p>ILC  thanks you for your patience as we completed your personal webpage.<br>
            It is important for us to ensure the security, search consistency, and overall confidentiality of the webpages we construct for marketing before sharing the access codes.<br>
            With that said, we are happy to inform you that your page, including the computerized graphic, is fully updated on ILC\'s website: www.successwithilc.com.<br>
            Once on the site, please scroll down until you see on the <b>right hand side</b> a field that states: <b>LOGIN</b><br>
            Below is your user name and password.  <u>Keep in mind, the password is case sensitive, so enter it exactly as it is written below (you may want to just cut & paste it).</u></p>

            <p><b>User Name:</b> '.$ilc->website_codes_user.'</p>

            <p><b>Password:</b> '.$ilc->website_codes_pswd.'</p>

            <p>After you log-in, you will be taken to the first introduction page where you will see "<b>My Inventions</b>", underneath will be a profile photo of your product and a purpose statement. (this is not the full webpage)</p>

            <p>Now, left click the photo.</p>

            <p>This action will take you to the main page, where you can witness the <b>Product Overview,  Graphic Image and/or Video, Inventor Profile and Photo.</b><br>
            I have also attached the image from your patent application which was used to create your computerized graphic.</p>

            <p><u><b>**Note:</b></u> All photos in the <b>Product Overview</b> section can be clicked on in order to enlarge for viewing.  Video section requires you click the play icon. Utility Clients will then see the 3D graphic video. Provisional Clients will see a still image of their computerized graphic.</p>

            <p>After review, should you like to communicate changes and/or modifications, please do not hesitate in letting us know. <u><b>You are allotted a 30 day grace period in which all edits to text and/or graphic images will be conducted without charge.  Thereafter, ILC will require for you to complete an invoice and provide payment for any modifications requested.</u></b></p>

            <p>Again, we thank you for your patience and we look forward to your feedback regarding the site.</p>
            <p>Best regards,</p>
             <p style="color: #008000">&nbsp;&nbsp;ASIA WYNDER</p>
             <p>&nbsp;&nbsp;MARKETING DIRECTOR</p>
             <p>&nbsp;&nbsp;INTERNATIONAL LICENSING CONSULTANTS</p>
             <br>
             <div class="myFooter">
                 <p class="mySmall" align="center">7777 Glades Road Suite 100 &nbsp;<span style="color: orange">&bull;</span>&nbsp; Boca Raton, FL 33434</p>
                 <p class="mySmall" align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;T: 1-800-713-1899 &nbsp;<span style="color: orange">&bull;</span>&nbsp; F: 1-800-343-1052</p>
                 <p class="mySmall" align="center" style="color: orange">www.successwithilc.com</p>
             </div>
             <p>DISCLAIMER:</p>
            <p>This email message is for the sole use of the intended recipient(s) and may contain confidential and privileged information.
            Any unauthorized review, use, disclosure or distribution is prohibited. If you are not the intended recipient, please contact
            the sender by reply email and destroy all copies of the original message.</p>';

            //send email
            $sent = SendEmailHelper::senIlc($files, '', $mailto, $from_mail, $header, $replyto, $subj, $message, $title, '');
            SendEmailHelper::senIlc($files, '', 'asia@successwithilc.com', $from_mail, $header, $replyto, $subj, $message, $title, '');
            if ($sent == 1) {
                //create ilc note
                $ilcNote = new IlcNotes();
                $ilcNote->ilc_id = $iid;
                $ilcNote->notes = "Website Access Codes Email sent.";
                $ilcNote->system =1;
                $ilcNote->save();
                return 1;
            } else
                return -1;
        }
    }

    public function sendIlcPatentedContract(){
        $pid = Input::get('PID');
        $iid = Input::get('IID');
        $project=Project::find($pid);
        $ilc = Ilc::find($iid);
        if($project!=null){
            $path = "files/projects/".$project->lead->fileno."/".$project->id."/";
            $mailto = $ilc->email;
            $from_mail = "asia@successwithilc.com";
            $replyto = "asia@successwithilc.com";
            $title = "International Licensing Consultants";
            $header = "International Licensing Consultants";
            $subj = "ILC contract";
            $files = array("ilc_patented_contract.pdf");
            $text = urldecode(Input::get('TEXT'));

            $message = $text."<p>Best regards,</p>
                     <p style='color: #008000'>&nbsp;&nbsp;ASIA WYNDER</p>
                     <p>&nbsp;&nbsp;MARKETING DIRECTOR</p>
                     <p>&nbsp;&nbsp;INTERNATIONAL LICENSING CONSULTANTS</p>
                     <br>
                     <div class='myFooter'>
                         <p class='mySmall' align='center'>7777 Glades Road Suite 100 &nbsp;<span style='color: orange'>&bull;</span>&nbsp; Boca Raton, FL 33434</p>
                         <p class='mySmall' align='center'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;T: 1-800-713-1899 &nbsp;<span style='color: orange'>&bull;</span>&nbsp; F: 1-800-343-1052</p>
                         <p class='mySmall' align='center' style='color: orange'>www.successwithilc.com</p>
                     </div>
                     <p>DISCLAIMER:</p>
                    <p>This email message is for the sole use of the intended recipient(s) and may contain confidential and privileged information.
                    Any unauthorized review, use, disclosure or distribution is prohibited. If you are not the intended recipient, please contact
                    the sender by reply email and destroy all copies of the original message.</p>";
            //send email
            $sent = SendEmailHelper::senIlc($files, $path, $mailto, $from_mail, $header, $replyto, $subj, $message, $title, '');
            SendEmailHelper::senIlc($files, $path, 'asia@successwithilc.com', $from_mail, $header, $replyto, $subj, $message, $title, '');
//            SendEmailHelper::senIlc($files, $path, 'jesus@ownmyinvention.com', $from_mail, $header, $replyto, $subj, $message, $title, '');
            if ($sent == 1) {
                //create ilc note
                $ilcNote = new IlcNotes();
                $ilcNote->ilc_id = $iid;
                $ilcNote->notes = "Ilc Patented Contract sent.";
                $ilcNote->system =1;
                $ilcNote->save();
                //upload the doc
                $uploadFile=UploadedFiles::where('project_id',$project->id)->where('fileName',"ilc_patented_contract.pdf")->first();
                if($uploadFile != null){
                    $uploadFile->delete();
                }
                $uploadFile = new UploadedFiles();
                $uploadFile->project_id = $project->id;
                $uploadFile->url = "files/projects/".$project->lead->fileno."/".$project->id."/ilc_patented_contract.pdf";
                $uploadFile->fileName = "ilc_patented_contract.pdf";
                $uploadFile->ilc = 1;
                $uploadFile->save();
                //save date
                $ilc->patentedContractSentDate = date('Y-m-d H:i:s');
                $ilc->save();
                //create Transaction
                $userIlc = Consultant::where('usr', 'ilc')->first();
                Transaction::createTransaction($userIlc->id, '', '', 'ILC_PATENTED_CONTRACT_SENT', '', $pid, '', '', '', '', '');

                return 1;
            }
        }
    }

    public function notifyVendorNewFile(){
        $project = Project::find(Input::get('PID'));
        $to_mail =Input::get('EMAIL');
        $dueDate = Input::get('DDATE');
        if($project!=null){
            $subj = "NEW FILE RECEIVED";
            $header = "International Licensing Consultants";
            $title = "International Licensing Consultants";
            $from_mail = "asia@successwithilc.com";
            $replyto = "asia@successwithilc.com";
            $path = '';
            $files=array();

            $msg = "New File was received from ILC.<br><br>File #: ".$project->lead->fileno."<br>Pin: ".$project->id."<br>Due Date: ".$dueDate.
                "<p class='pSmall'>Sincerely,</p>
                     <p class='mySmall' style='color: #008000'>&nbsp;&nbsp;ASIA WYNDER</p>
                     <p class='mySmall'>&nbsp;&nbsp;MARKETING DIRECTOR</p>
                     <p class='mySmall'>&nbsp;&nbsp;INTERNATIONAL LICENSING CONSULTANTS</p>
                     <br>
                     <div class='myFooter'>
                         <p class='mySmall' align='center'>7777 Glades Road Suite 100 &nbsp;<span style='color: orange'>&bull;</span>&nbsp; Boca Raton, FL 33434</p>
                         <p class='mySmall' align='center'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;T: 1-800-713-1899 &nbsp;<span style='color: orange'>&bull;</span>&nbsp; F: 1-800-343-1052</p>
                         <p class='mySmall' align='center' style='color: orange'>www.successwithilc.com</p>
                     </div>";

            SendEmailHelper::senIlc($files, $path, $to_mail, $from_mail, $header, $replyto, $subj, $msg, $title,'');
            SendEmailHelper::senIlc($files, $path, 'asia@successwithilc.com', $from_mail, $header, $replyto, $subj, $msg, $title, '');

            //transaction
            Transaction::createTransaction('',$project->lead_id,'','FILES_SENT_TO_VENDOR','',$project->id,'','','','','');
            return 1;
        }
        return -1;
    }

    public function notifyFileBack(){
        $project = Project::find(Input::get('PID'));
        $to_mail =Input::get('EMAIL');
        $dueDate = Input::get('DDATE');
        if($project!=null){
            $subj = "FILE BACK RECEIVED";
            $header = "International Licensing Consultants";
            $title = "International Licensing Consultants";
            $from_mail = "asia@successwithilc.com";
            $replyto = "asia@successwithilc.com";
            $path = '';
            $files=array();

            $msg = "A File was received back from ILC.<br><br>File #: ".$project->lead->fileno."<br>Pin: ".$project->id."<br>Due Date: ".$dueDate.
                "<p class='pSmall'>Sincerely,</p>
                     <p class='mySmall' style='color: #008000'>&nbsp;&nbsp;ASIA WYNDER</p>
                     <p class='mySmall'>&nbsp;&nbsp;MARKETING DIRECTOR</p>
                     <p class='mySmall'>&nbsp;&nbsp;INTERNATIONAL LICENSING CONSULTANTS</p>
                     <br>
                     <div class='myFooter'>
                         <p class='mySmall' align='center'>7777 Glades Road Suite 100 &nbsp;<span style='color: orange'>&bull;</span>&nbsp; Boca Raton, FL 33434</p>
                         <p class='mySmall' align='center'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;T: 1-800-713-1899 &nbsp;<span style='color: orange'>&bull;</span>&nbsp; F: 1-800-343-1052</p>
                         <p class='mySmall' align='center' style='color: orange'>www.successwithilc.com</p>
                     </div>";

            SendEmailHelper::senIlc($files, $path, $to_mail, $from_mail, $header, $replyto, $subj, $msg, $title,'');
            SendEmailHelper::senIlc($files, $path, 'asia@successwithilc.com', $from_mail, $header, $replyto, $subj, $msg, $title, '');

            //transaction
            Transaction::createTransaction('',$project->lead_id,'','FILES_SENT_BACK_TO_VENDOR','',$project->id,'','','','','');
            return 1;
        }
        return -1;
    }

    public function notifyVendorFileOverdue(){
        $project = Project::find(Input::get('PID'));
        $to_mail =Input::get('EMAIL');
        if($project!=null){
            $subj = "FILE OVERDUE";
            $header = "International Licensing Consultants";
            $title = "International Licensing Consultants";
            $from_mail = "asia@successwithilc.com";
            $replyto = "asia@successwithilc.com";
            $path = '';
            $files=array();

            $msg = "File in overdue after 14 days.<br><br>File #: ".$project->lead->fileno."<br>Pin: ".$project->id.
                "<p class='pSmall'>Sincerely,</p>
                     <p class='mySmall' style='color: #008000'>&nbsp;&nbsp;ASIA WYNDER</p>
                     <p class='mySmall'>&nbsp;&nbsp;MARKETING DIRECTOR</p>
                     <p class='mySmall'>&nbsp;&nbsp;INTERNATIONAL LICENSING CONSULTANTS</p>
                     <br>
                     <div class='myFooter'>
                         <p class='mySmall' align='center'>7777 Glades Road Suite 100 &nbsp;<span style='color: orange'>&bull;</span>&nbsp; Boca Raton, FL 33434</p>
                         <p class='mySmall' align='center'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;T: 1-800-713-1899 &nbsp;<span style='color: orange'>&bull;</span>&nbsp; F: 1-800-343-1052</p>
                         <p class='mySmall' align='center' style='color: orange'>www.successwithilc.com</p>
                     </div>";

            SendEmailHelper::senIlc($files, $path, $to_mail, $from_mail, $header, $replyto, $subj, $msg, $title,'');
            SendEmailHelper::senIlc($files, $path, 'asia@successwithilc.com', $from_mail, $header, $replyto, $subj, $msg, $title, '');

            //transaction
            Transaction::createTransaction('',$project->lead_id,'','FILE_OVERDUE_BY_VENDOR','',$project->id,'','','','','');
            return 1;
        }
        return -1;
    }

    public function notifyILCFileClosedByVendor(){
        $project = Project::find(Input::get('PID'));
        if($project!=null){
            $subj = "FILE CLOSED";
            $header = "International Licensing Consultants";
            $title = "International Licensing Consultants";
            $from_mail = "info@ownmyinvention.com";
            $replyto = "info@ownmyinvention.com";
            $path = '';
            $files=array();

            $msg = "File closed by vendor.<br><br>File #: ".$project->lead->fileno."<br>Pin: ".$project->id;

            SendEmailHelper::senIlc($files, $path, 'asia@successwithilc.com', $from_mail, $header, $replyto, $subj, $msg, $title, '');
            Transaction::createTransaction('',$project->lead_id,'','FILE_CLOSED_BY_VENDOR','',$project->id,'','','','','');
            return 1;
        }
        return -1;
    }

    function createPdfFromEmail($ilcClient, $pid, $subj, $msg,$emailType){

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML('<p align="center"><img src="'.asset("/img/ilc_logo.jpg").'" name="Logo" width="165" height="126" id="Object1" align="center"></p>
                        <table align="center" width="100%">
                        <tr><td>Client Name: '.$ilcClient->invFname.' '.$ilcClient->invLname.'</td></tr>
                        <tr><td>Email: '.$ilcClient->email.'</td></tr>
                        <tr><td>FileNo: '.$ilcClient->fileno.'</td></tr>
                        </table><br>
                        <table align="center" width="100%">
                        <tr><td>Subject: '.$subj.'</td></tr>
                        <tr><td><p>'.$msg.'</p></td></tr>
                        </table>');


        if(!File::exists("files/projects/".$ilcClient->fileno."/".$pid)) {
            File::makeDirectory("files/projects/".$ilcClient->fileno."/".$pid, 0755, true);
        }

        $docname = $ilcClient->fileno."_email".$emailType."_".date('m_d_Y H:i:s').".pdf";
        $pdf->save("files/projects/".$ilcClient->fileno."/".$pid."/".$docname);

        $aux_file = UploadedFiles::where('project_id',$pid)->where('fileName',$docname)->first();
        if($aux_file!=null)
            $aux_file->delete();
        $uploadFile = new UploadedFiles();
        $uploadFile->project_id = $pid;
        $uploadFile->url = "files/projects/".$ilcClient->fileno."/".$pid."/".$docname;
        $uploadFile->fileName = $docname;
        $uploadFile->clientVendor = 1;
        $uploadFile->save();
        return $uploadFile->fileName;
    }

    public function notifyAppDelayToClient(){
        $pcs_id =Input::get('PID');
        $pcs =ProjectClientServices::find($pcs_id);
        if($pcs != null){
            $subj = "NOTIFY APP DELAY EMAIL";
            $header = "Patent Services USA";
            $title = "Patent Services USA";
            $to_mail = $pcs->project->lead->email;
            $from_mail = "clientservices@ownmyinvention.com";
            $replyto = "clientservices@ownmyinvention.com";
            $path = '';
            $files =array();

            $msg = "<p>Your Independent Registered Patent Attorney, has requested additional time to complete your drafted application.Your package was initially sent to your patent attorney on (date). Please be advised that every effort is being made to assist the patent attorney in drafting your patent application.</p>
                <p>Your application is in it's final stage of completion. As soon as we receive your patent application, it will be made available for you to review and approve through your inventor's platform at <a href='www.ownmyinvention.com'>www.ownmyinvention.com</a>.</p>
                <p>If you have any questions, please contact our client services department at Patent Services USA, at 888-344-6836</p>
                    Kindest regards,<br>
                    Client Services<br>
                    Patent Services, USA<br>
                    12000 Biscayne Blvd Suite 700<br>
                    North Miami, FL 33181<br>
                    1-888-344-6836<br>
                    1-800-886-7951 Fax<br>
                    www.ownmyinvention.com<br><br><br>
                    DISCLAIMER:<br>
                    This email message is for the sole use of the intended recipient(s) and may contain confidential and privileged information.
                    Any unauthorized review, use, disclosure or distribution is prohibited. If you are not the intended recipient, please contact
                    the sender by reply email and destroy all copies of the original message.";

            $sent = SendEmailHelper::send($files, $path, $to_mail, $from_mail, $header, $replyto, $subj, $msg, $title);

            if($sent == true){
                //note in pcs
                $csNote = new ClientSNotes();
                $csNote->notes = 'Email sent to client about patent delay.';
                $csNote->projectclientservices_id = $pcs_id;
                $csNote->save();
                $pcs->notifyAppDelay =1;
                $pcs->save();
                return $pcs->project_id;
            }
            return -1;
        }
        return -1;
    }

    public function emailLetterOfEngagement(){
        $project=Project::find(Input::get('ID'));
        $lead = $project->lead;
        if($lead!=null){
            $path = 'files/projects/' . $lead->fileno . '/' . $project->id . '/';
            $msg = "Dear ".ucwords($lead->fname)." ".ucwords($lead->lname).",<br />
                    <p>We are excited to inform you of the patent attorney within our network assigned to your account.
                    This attorney will conduct a patent search on your behalf and provide a legal patentability opinion regarding your innovation.</p>
                    <p>To move forward, however, <b>we need for you to sign a formal Letter of Engagement.</b>
                    The Letter of Engagement, is time-sensitive and clearly communicates to you all pertinent information regarding the attorney and gives us permission to share your idea with them in order to begin the search.</p>
                    <p>As policy, we need the <b>Letter of Engagement to be signed by you within 3 days of this email.</b>
                    You can access the Letter of Engagement by:</p>
                    <ul>
                        <li>Signing into your PSU Client Portal.</li>
                        <li>Select the Project/Guide you paid for.</li>
                        <li>Read and then Sign the <b>Letter of Engagement</b></li>
                    </ul>
                    <p><b>If we do not receive the Letter of Engagement</b>, we will be unable to submit your idea to the patent attorney.
                    Should you have any questions regarding the Letter of Engagement feel free to contact your Consultant.</p>
                    <br><br><br>
                    Kindest regards,<br>
                    Patent Services, USA<br>
                    12000 Biscayne Blvd Suite 700<br>
                    North Miami, FL 33181<br>
                    1-888-344-6836<br>
                    1-800-886-7951 Fax<br>
                    www.ownmyinvention.com<br><br><br>
                    DISCLAIMER:<br>
                    This email message is for the sole use of the intended recipient(s) and may contain confidential and privileged information.
                    Any unauthorized review, use, disclosure or distribution is prohibited. If you are not the intended recipient, please contact
                    the sender by reply email and destroy all copies of the original message.";

            $sent = SendEmailHelper::send(array(), $path, $lead->email, 'production@ownmyinvention.com', "Patent Services USA", 'production@ownmyinvention.com',"Letter of Engagement" , $msg, "Patent Services USA");

            $msgInbox = "File # " . $project->lead->fileno . " has just received their Letter of Engagement,\r\n";
            $msgInbox .= "Please call CT to address any questions and ensure they sign it within 3 days.\r\n";
            $msgInbox .= "This is important and directly affects the close of your deal.\r\n";
            $projectP = $project->getProjectProduction();
            if($projectP != null){
                $att = $projectP->attorney();
                if($att != null){
                    $msgInbox .= "The Attorney assigned to your client is ".ucwords($att->fname." ".$att->lname);
                }
            }
            //cretae inbox for consultant
            Inbox::createInbox($project->lead->id,$project->consultant_id,$msgInbox,"PRODUCTION","PRODUCTION");

            // transaction
            Transaction::createTransaction($project->consultant_id,$project->lead_id,'','LetterOfEngagement_Sent','',$project->id,$lead->email,'','','','');
            return 1;
        }
        return -1;
    }

    public function contactUs(){
        $name = Input::get('NAME');
        $from_mail = 'info@ownmyinvention.com';
        $replyto = Input::get('EMAIL');
        $header = "Patent Services USA";
        $title = "Patent Services USA";
        $to_mail = 'admin@ownmyinveiontion.com';
        $subj =Input::get('SUBJECT');
        $text = Input::get('MESSAGE');
        $files=array();
        $path ='';
        $msg = "Email received from ".$name." with email ".$replyto." :<br>".$text;
        $sent = SendEmailHelper::send($files, $path, $to_mail, $from_mail, $header, $replyto, $subj, $msg, $title);
        if($sent)
            return 1;
        return -1;
    }

    public function emailToAttForCloseFile(){
        $pCs = ProjectClientServices::find(Input::get('PCSID'));
        $attCs = AttClientServices::find(Input::get('ATTCSID'));
        $att = Consultant::find($attCs->consultant_id);

        $msg = "Hi ".ucwords($att->fname)." ".ucwords($att->lname).",<br />
                <p>".$pCs->fileno." is no longer working with Patent Services USA. Please do not conduct any work for him, we will close the file at your end.
                We will also remove the client’s file from your monthly report.
                Thank you</p>
                <br><br><br>
                Kindest regards,<br>
                Client Services Department<br>
                Patent Services, USA<br>
                12000 Biscayne Blvd Suite 700<br>
                North Miami, FL 33181<br>
                1-888-344-6836<br>
                1-800-886-7951 Fax<br>
                www.ownmyinvention.com<br><br><br>
                DISCLAIMER:<br>
                This email message is for the sole use of the intended recipient(s) and may contain confidential and privileged information.
                Any unauthorized review, use, disclosure or distribution is prohibited. If you are not the intended recipient, please contact
                the sender by reply email and destroy all copies of the original message.";

        $sent = SendEmailHelper::send(array(), "", $att->email, 'clientservices@ownmyinvention.com', "Patent Services USA", 'clientservices@ownmyinvention.com',$pCs->fileno." - Closed File" , $msg, "Patent Services USA");
        return 1;
    }
}
