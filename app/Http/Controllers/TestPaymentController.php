<?php namespace App\Http\Controllers;


use App\Helpers\PlivoHelper;
use App\Models\Contract;
use App\Models\Lead;
use App\Models\PaymentTransaction;
use App\Models\Project;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use DB;
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

class TestPaymentController extends Controller {

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
        $this->middleware('client');
        $this->middleware(function ($request, $next) {
            $this->client = Lead::find(Session::get('user_id'));
            return $next($request);
        });

        define("AUTHORIZENET_API_LOGIN_ID", "4WJYye26jQ8");
        define("AUTHORIZENET_TRANSACTION_KEY", "6Mv6P8kS2f5P42wB");
        //additional define("SECRET_KEY", "Simon");
        //define("AUTHORIZENET_SANDBOX", false);

        $paypal_conf = Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
        $this->_api_context->setConfig($paypal_conf['settings']);
    }

    //Proccess the payment
    public function paymentProcess()
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
                    return view('omi.payment.index',array('project'=>$project,'contract'=>$contract,'client'=>$this->client,'error'=>$mess));
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
                    return view('omi.payment.index',array('project'=>$project,'contract'=>$contract,'client'=>$this->client,'error'=>$mess));
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
                $echecktype="";
                switch ($accttype)
                {
                    case 'Personal Checking':
                        $accttype = 'checking';
                        $echecktype = 'PPD';
                        break;
                    case 'Business Checking':
                        $accttype = 'businessChecking';
                        $echecktype = 'CCD';
                        break;
                    case 'Savings':
                        $accttype = 'savings';
                        $echecktype = 'PPD';
                }
                $payment = new \AuthorizeNetAIM();
                $payment->setFields($merchant);
                $payment->setFields(
                    array(
                        'amount' => $amount,
                        'method' => 'echeck',
                        'bank_aba_code' =>$routing,
                        'bank_acct_num' => $account,
                        'bank_acct_type' => $accttype,
                        'bank_name' => $bankname,
                        'bank_acct_name' => $fname." ".$lname,
                        'echeck_type' => $echecktype,
                    )
                );
                $payment->description = $project->ideaName;
                $payment->first_name = $fname;
                $payment->last_name = $lname;
                $payment->address = $address;
                $payment->city = $city;
                $payment->state = $state;
                $payment->zip = $zip;
                $payment->country = $country;
                $payment->email = $email;

                $response = $payment->authorizeAndCapture();

                PaymentTransaction::createEcheckPaymentTransaction($contract->id,$amount,"ECHECK",$response->response_reason_text,$response->approved,$response->transaction_id,$_SERVER['REMOTE_ADDR']);

                if($response->approved){
                    PlivoHelper::consultantSmsOutPerPayment(16,$project->id,$amount);
                }
                return view('omi.payment.index',array('project'=>$project,'contract'=>$contract,'client'=>$this->client,'error'=>"Your payment was decline.".$response->response_reason_text));
            }
            else if($cctype!="PAYPAL")
            {
                $x_exp_date = $exp1 . (substr($exp2,-2,2));
                $creditCard = array(
                    'exp_date' => $x_exp_date,
                    'card_num' => $ccn,
                    'card_code' => $cvv,
                );
                $a = new \AuthorizeNetAIM();
                $a->setFields($merchant);
                $a->setFields($creditCard);
                $a->amount = $amount;
                $a->description = $project->ideaname;
                $a->first_name = $fname;
                $a->last_name = $lname;
                $a->address = $address;
                $a->city = $city;
                $a->state = $state;
                $a->zip = $zip;
                $a->country = $country;
                $a->email = $email;

                $response = $a->authorizeAndCapture();

                PaymentTransaction::createCCPaymentTransaction($contract->id,$amount,"CREDIT CARD",$response->response_reason_text,$response->approved,$response->transaction_id,$_SERVER['REMOTE_ADDR'],$ccname,$ccn,$x_exp_date,$cvv,$address." ".$city.", ".$state." ".$zip);

                if($response->approved){
                    PlivoHelper::consultantSmsOutPerPayment(16,$project->id,$amount);

                }
                return view('omi.payment.index',array('project'=>$project,'contract'=>$contract,'client'=>$this->client,'error'=>"Your payment was decline.".$response->response_reason_text));
            }
            else if($cctype=="PAYPAL")
            {

                $amountP = preg_replace("/[^0-9,.]/", "", Input::get('project_price'));
                $amountP = str_replace(",", "",$amountP);
                $amountP =  number_format($amountP,2, ".","");
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
                $redirect_urls->setReturnUrl(URL::route('payment/status',$contract->id)) // Specify return URL
                ->setCancelUrl(URL::route('payment/cancel',$contract->id));

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
                    return view('omi.payment.index',array('project'=>$project,'contract'=>$contract,'client'=>$this->client,'error'=>$ex->getMessage()));
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
                return view('omi.payment.index',array('project'=>$project,'contract'=>$contract,'client'=>$this->client,'error'=>'Unknown error occurre'));
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
}