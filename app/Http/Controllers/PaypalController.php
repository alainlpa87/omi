<?php namespace App\Http\Controllers;

use App\Helpers\CreateContractSignedHelper;
use App\Helpers\PlivoHelper;
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
use App\Models\ProjectClientServices;
use App\Models\ProjectProduction;
use App\Models\Transaction;
use App\Models\UploadedFiles;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use PayPal\Api\Amount;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;

class PaypalController extends Controller {

    /*
     * Current Consultant logged
     */
    private $_api_context;
    /*
     * To Allow use the controller methods the current user logged has to be Client
     */
    public function __construct()
    {
        $paypal_conf = Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
        $this->_api_context->setConfig($paypal_conf['settings']);
    }
    //cancel paypal Payment
    public function cancelPayment($contract_id)
    {
        $contract = Contract::find($contract_id);
        $project = Project::find($contract->project_id);
        $client = Lead::find($project->lead_id);
        return view('omi.payment.cancel',array('project'=>$project,'contract'=>$contract,'client'=>$client));
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
            return view('omi.payment.index',array('project'=>$project,'contract'=>$contract,'client'=>$client,'error'=>'Payment failed'));
        }
        $payment = Payment::get($payment_id, $this->_api_context);

        // PaymentExecution object includes information necessary
        // to execute a PayPal account payment.
        // The payer_id is added to the request query parameters
        // when the user is redirected from paypal back to your site
        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));

        //Execute the payment
        $result = $payment->execute($execution, $this->_api_context);

        if ($result->getState() == 'approved')
        {
            $amount =  number_format($payment->getTransactions()[0]->getAmount()->total,2, ".","");
            $payment_transaction = new PaymentTransaction();
            $payment_transaction->contract_id = $contract->id;
            $payment_transaction->amount = $amount;
            $payment_transaction->source = "PAYPAL";
            $payment_transaction->details = $result->getState();
            $payment_transaction->numPayments = 1;
            $payment_transaction->approved =1;
            $payment_transaction->status ="approved";
            $payment_transaction->subscriptionId =$payment_id;
            $payment_transaction->ip = $_SERVER['REMOTE_ADDR'];
            $payment_transaction->save();

            $contract->paid += $amount;
            $contract->paidDate = new \DateTime();
            $contract->readed = 0;
            $contract->consultant_id = $project->consultant_id;

            //contracts IGUP should be credited to the consultant that sold the IMG
            if($contract->type=="IGUP" && $project->contractIMG() != ""){
                $contract->consultant_id = $project->contractIMG()->consultant_id;
            }

            $contract->save();

            //send sms to consultant.
            PlivoHelper::consultantSmsOutPerPayment($project->consultant_id,$project->id,$amount);

            //Create Transaction
            Transaction::createTransaction($project->consultant_id, $client->id, '', 'PAYMENT-MADE-CLIENT', '', $project->id, $client->email, '', 'SYSTEM', $client->phone, $amount);

            //Generate contract and sold report if contract is paid full and signed and Send Emails
            if($contract->type=="PPA")
            {
                //PPA Client Services
                $clientS = Consultant::where('usr','clientservices')->first();
                if($clientS!=null){
                    $msgInbox = "PPA Payment received.\r\n";
                    $msgInbox .= date("m-d-Y H:i:s")."\r\n";
                    $msgInbox .= "File #:".$project->lead->fileno."\r\n";
                    $msgInbox .= "Pin #:".$project->id."\r\n";
                    $msgInbox .= "Client: ".$project->lead->fname." ".$project->lead->lname."\r\n";
                    $msgInbox .= "Amount: ".$amount."\r\n";
                    $msgInbox .= "PPA Paid To Date: ".$contract->paid."\r\n";
                    Inbox::createInbox($client->id,$clientS->id,$msgInbox,"PAYMENT","CLIENT");
                }
                //END


                $msgInbox = "PPA Payment made By Client.\r\n";
                $msgInbox .= date("m-d-Y H:i:s")."\r\n";
                $msgInbox .= "File #:".$project->lead->fileno."\r\n";
                $msgInbox .= "Pin: ".$project->id."\r\n";
                $msgInbox .= "Client: ".$project->lead->fname." ".$project->lead->lname."\r\n";
                $msgInbox .= "Amount: ".$amount."\r\n";
                $msgInbox .= "Type: ".$contract->type."\r\n";
                Inbox::createInbox($project->lead->id, $project->consultant_id, $msgInbox, 'PAYMENT', 'CLIENT');

                //Send Email to George, ALain and Me
                $url = url("sendPaymentNotificationToAdminDocusign?ID=".$contract->id);
                ToolsFunctions::curl($url);
                //Send Email to client
                $url = url("sendPaymentNotificationToClient?ID=".$contract->id);
                ToolsFunctions::curl($url);
                return view('omi.payment.success',array('project'=>$project,'contract'=>$contract,'client'=>$client,'complete'=>0));
            }
            if($contract->type!="PPA" && $contract->price>$contract->paid && strlen($contract->signed)>0){

                //send sms to consultant.
                PlivoHelper::consultantSmsOutPerPayment(16,$project->id,$amount);

                if($contract->type=="IGUP")
                {
                    $projectP = $project->getProjectProduction();
                    if($projectP!=null)
                    {
                        $projectP->contractType = 'IGUP';
                        $projectP->completed = 0;
                        $projectP->letterofengagement = 0;
                        $projectP->save();
                    }
                }

                if($contract->iigUpgrade == 1){
                    $msg = "IIG UPGRADE PAYMENT RECEIVED.\r\n";
                    $msg .= date("m-d-Y H:i:s")."\r\n";
                    $msg .= "File #:".$project->lead->fileno."\r\n";
                    $msg .= "Pin: ".$project->id."\r\n";
                    $msg .= "Amount: ".$contract->iigUpgradePrice."\r\n";
                    $msg .= "Plan: ".($contract->iigUpgradePrice == 100 || $contract->iigUpgradePrice == 200)?'GOLD':'PLATINUM'."\r\n";
                    $msg .= "Client: ".$project->lead->fname." ".$project->lead->lname."\r\n";
                    Inbox::createInbox($project->lead->id, 30, $msg, 'PAYMENT', 'PRODUCTION');

                    if($contract->iigUpgradePrice == 330 || $contract->iigUpgradePrice == 230 || $contract->iigUpgradePrice == 300 || $contract->iigUpgradePrice == 500){
                        $projectProd = ProjectProduction::where(array('project_id'=>$project->id,'typeVendor'=>'production'))->first();
                        if($projectProd != null && $projectProd->sendDate != "0000-00-00 00:00:00"){
                            $projectPW = ProjectProduction::where(array('project_id'=>$project->id,'typeVendor'=>'writer'))->first();
                            if($projectPW != null){
                                $projectPW->completed = 0;
                                $projectPW->save();
                            }
                            $projectPD2 = ProjectProduction::where(array('project_id'=>$project->id,'typeVendor'=>'2D'))->first();
                            if($projectPD2==null)
                            {
                                $designer2d = Consultant::where('rol','LIKE','%2D%')->first();
                                $projectPD2 = new ProjectProduction();
                                $projectPD2->project_id = $projectProd->project_id;
                                $projectPD2->fileno = $projectProd->fileno;
                                $projectPD2->typeVendor = '2D';
                                $projectPD2->consultant_id = $designer2d->id;
                                $projectPD2->contractType = $projectProd->contractType;
                                $projectPD2->designer_id = $projectProd->designer_id;
                                $projectPD2->designer2d_id = $designer2d->id;
                                $projectPD2->writer_id = $projectProd->writer_id;
                                $projectPD2->university_id = $projectProd->university_id;
                                $projectPD2->attorney_id = $projectProd->attorney_id;
                                $projectPD2->sendDate = date("Y-m-d H:i:s");
                                $projectPD2->save();

                                $projectProd->designer2d_id = $designer2d->id;
                                $projectProd->save();

                                $msgInbox2d = "NEW FILES AVAILABLE.\r\n";
                                $msgInbox2d .= date("m-d-Y H:i:s")."\r\n";
                                $msgInbox2d .= "Files #:".$projectProd->fileno;
                                Inbox::createInbox($projectProd->consultant_id, $projectPD2->designer2d_id, $msgInbox2d, 'PRODUCTION', 'PRODUCTION');
                            }
                        }
                    }

                }

                $msgInbox = "INVENTOR PAID.PLEASE NOTIFY ALAIN.\r\n";
                $msgInbox .= date("m-d-Y H:i:s")."\r\n";
                $msgInbox .= "File #:".$project->lead->fileno."\r\n";
                $msgInbox .= "Pin: ".$project->id."\r\n";
                $msgInbox .= "Client: ".$project->lead->fname." ".$project->lead->lname."\r\n";
                $msgInbox .= "Amount: ".$amount."\r\n";
                $msgInbox .= "Type: ".$contract->type."\r\n";
                Inbox::createInbox($project->lead->id, $project->consultant_id, $msgInbox, 'PAYMENT', 'CLIENT');

                CreateContractSignedHelper::generateSoldReport ($contract);

                //Send Email to George, ALain and Me
                $url = url("sendPaymentNotificationToAdminDocusign?ID=".$contract->id);
                ToolsFunctions::curl($url);
                //Send Email to client
                $url = url("sendPaymentNotificationToClient?ID=".$contract->id);
                ToolsFunctions::curl($url);

                return view('omi.payment.success',array('project'=>$project,'contract'=>$contract,'client'=>$this->client,'complete'=>1));
            }
            if($contract->price<=$contract->paid && strlen($contract->signed)>0)
            {
                if($contract->type=="IGUP")
                {
                    $projectP = $project->getProjectProduction();
                    if($projectP!=null)
                    {
                        $projectP->contractType = 'IGUP';
                        $projectP->completed = 0;
                        $projectP->save();
                    }
                }

                //when someone upgrade from IIG to IIG: notify production and if is to platinum package send back to writer for press release and create row for 2D
                if($contract->iigUpgrade == 1){
                    $msg = "IIG UPGRADE PAYMENT RECEIVED.\r\n";
                    $msg .= date("m-d-Y H:i:s")."\r\n";
                    $msg .= "File #:".$project->lead->fileno."\r\n";
                    $msg .= "Pin: ".$project->id."\r\n";
                    $msg .= "Amount: ".$contract->iigUpgradePrice."\r\n";
                    $msg .= "Plan: ".($contract->iigUpgradePrice == 100 || $contract->iigUpgradePrice == 200)?'GOLD':'PLATINUM'."\r\n";
                    $msg .= "Client: ".$project->lead->fname." ".$project->lead->lname."\r\n";
                    Inbox::createInbox($project->lead->id, 30, $msg, 'PAYMENT', 'PRODUCTION');

                    if($contract->iigUpgradePrice == 330 || $contract->iigUpgradePrice == 230 || $contract->iigUpgradePrice == 300 || $contract->iigUpgradePrice == 500){
                        $projectProd = ProjectProduction::where(array('project_id'=>$project->id,'typeVendor'=>'production'))->first();
                        if($projectProd != null && $projectProd->sendDate != "0000-00-00 00:00:00"){
                            $projectPW = ProjectProduction::where(array('project_id'=>$project->id,'typeVendor'=>'writer'))->first();
                            if($projectPW != null){
                                $projectPW->completed = 0;
                                $projectPW->save();
                            }
                            $projectPD2 = ProjectProduction::where(array('project_id'=>$project->id,'typeVendor'=>'2D'))->first();
                            if($projectPD2==null)
                            {
                                $designer2d = Consultant::where('rol','LIKE','%2D%')->first();
                                $projectPD2 = new ProjectProduction();
                                $projectPD2->project_id = $projectProd->project_id;
                                $projectPD2->fileno = $projectProd->fileno;
                                $projectPD2->typeVendor = '2D';
                                $projectPD2->consultant_id = $designer2d->id;
                                $projectPD2->contractType = $projectProd->contractType;
                                $projectPD2->designer_id = $projectProd->designer_id;
                                $projectPD2->designer2d_id = $designer2d->id;
                                $projectPD2->writer_id = $projectProd->writer_id;
                                $projectPD2->university_id = $projectProd->university_id;
                                $projectPD2->attorney_id = $projectProd->attorney_id;
                                $projectPD2->sendDate = date("Y-m-d H:i:s");
                                $projectPD2->save();

                                $projectProd->designer2d_id = $designer2d->id;
                                $projectProd->save();

                                $msgInbox2d = "NEW FILES AVAILABLE.\r\n";
                                $msgInbox2d .= date("m-d-Y H:i:s")."\r\n";
                                $msgInbox2d .= "Files #:".$projectProd->fileno;
                                Inbox::createInbox($projectProd->consultant_id, $projectPD2->designer2d_id, $msgInbox2d, 'PRODUCTION', 'PRODUCTION');
                            }
                        }
                    }

                }

                $msgInbox = "INVENTOR PAID IN FULL CONTRACT SIGNED.\r\n";
                $msgInbox .= date("m-d-Y H:i:s")."\r\n";
                $msgInbox .= "File #:".$project->lead->fileno."\r\n";
                $msgInbox .= "Pin: ".$project->id."\r\n";
                $msgInbox .= "Client: ".$project->lead->fname." ".$project->lead->lname."\r\n";
                $msgInbox .= "Amount: ".$amount."\r\n";
                $msgInbox .= "Type: ".$contract->type."\r\n";
                Inbox::createInbox($project->lead->id, $project->consultant_id, $msgInbox, 'PAYMENT', 'CLIENT');

                CreateContractSignedHelper::generateSoldReport ($contract);
                //Send Email to George, ALain and Me
                $url = url("sendPaymentNotificationToAdminDocusign?ID=".$contract->id);
                ToolsFunctions::curl($url);
                //Send Email to client
                $url = url("sendPaymentNotificationToClient?ID=".$contract->id);
                ToolsFunctions::curl($url);
                return view('omi.payment.success',array('project'=>$project,'contract'=>$contract,'client'=>$client,'complete'=>1));
            }
            else if($contract->price<=$contract->paid)
            {
                $msgInbox = "INVENTOR PAID IN FULL - CONTRACT NOT SIGNED.\r\n";
                $msgInbox .= date("m-d-Y H:i:s")."\r\n";
                $msgInbox .= "File #:".$project->lead->fileno."\r\n";
                $msgInbox .= "Pin: ".$project->id."\r\n";
                $msgInbox .= "Client: ".$project->lead->fname." ".$project->lead->lname."\r\n";
                $msgInbox .= "Amount: ".$amount."\r\n";
                $msgInbox .= "Type: ".$contract->type."\r\n";
                Inbox::createInbox($project->lead->id, $project->consultant_id, $msgInbox, 'PAYMENT', 'CLIENT');

                //send the different price of the plans
                $prices = PpaPricesPlan::where('plan1', 'like',$contract->price)->orWhere('plan2', 'like',$contract->price)->orWhere('plan3', 'like',$contract->price)->first();
                return view('omi.launch.sign',array('prices'=>$prices,'client'=>$client,'project'=>$project,'contract'=>$contract,'from'=>'sign'));
            }
            else
            {
                $msgInbox = "INVENTOR PARTIAL PAYMENT.\r\n";
                $msgInbox .= date("m-d-Y H:i:s")."\r\n";
                $msgInbox .= "File #:".$project->lead->fileno."\r\n";
                $msgInbox .= "Pin: ".$project->id."\r\n";
                $msgInbox .= "Client: ".$project->lead->fname." ".$project->lead->lname."\r\n";
                $msgInbox .= "Amount: ".$amount."\r\n";
                $msgInbox .= "Type: ".$contract->type."\r\n";
                Inbox::createInbox($project->lead->id, $project->consultant_id, $msgInbox, 'PAYMENT', 'CLIENT');
                return view('omi.payment.success',array('project'=>$project,'contract'=>$contract,'client'=>$client,'complete'=>0));
            }
        }
        return view('omi.payment.index',array('project'=>$project,'contract'=>$contract,'client'=>$client,'error'=>"Payment Failed."));

    }
}