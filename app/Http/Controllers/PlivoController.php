<?php namespace App\Http\Controllers;

use App\Models\Inbox;
use App\Models\Message;
use App\Models\Consultant;
use App\Models\Lead;
use App\Models\PhoneByState;
use App\Models\ProjectClientServices;
use App\Models\RecordCalls;
use App\Models\Transaction;
use Plivo\RestAPI;
use Plivo\Response;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class PlivoController extends Controller
{

    //Remenber this two in Plivo Helper
    private $auth_id = "MAOGNKN2I4NTMYY2Q3YM";  //PSUSA
    private $auth_token = "NmNjN2ZmMzBmN2RhNDM1MWYxZWQzYWExZThhZWMz";  //PSUSA

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->consultant = Consultant::find(Session::get('user_id'));

            return $next($request);
        });
    }

//connect with phones.
    public function callHome()
    {
        $usr = $this->consultant->id;
        $phone = str_pad(Input::get("PHONE"), 11, '1', STR_PAD_LEFT);
        $p = new RestAPI($this->auth_id, $this->auth_token);
        $params = array(
            'to' => $phone,
            'from' => '17862940557',
            'answer_url' => route('idle', ['HOME' => '1', 'USR' => $usr]),
            'hangup_url' => route('bossEnd', ['USR' => $usr]),
            'caller_name' => 'DIALER',
            'answer_method' => 'GET',
            'hangup_method' => 'GET');
        $p->make_call($params);
    }

//End of all Calls.
    public function bossEnd()
    {
        $usr = Input::get("USR");
        $consultant = Consultant::find($usr);
        if ($consultant != null) {
                $uuid = $consultant->uuid;
                $p = new RestAPI($this->auth_id, $this->auth_token);
                $call = $p->get_live_call(array('call_uuid' => $uuid));

            if ($call['status'] == '404') {
                $consultant->status = 'OFFLINE';
                $consultant->uuid = '';
                $consultant->save();
            }
        }
    }

//REDIRECT from connect with phones.
    public function idle()
    {
        $uuid = Input::get("CallUUID");
        $status = Input::get("CallStatus");
        $response = new Response();
        $response->addWait(array('length' => 2));

        if ($status == 'failed' || Input::has("PASS")) {
            $response->addSpeak('Failed call... Baaad Phone Number', array('language' => 'en-US', 'voice' => 'WOMAN'));
        } elseif ($status == 'cancel' || Input::has("HANG") || Input::has("MSG") || Input::has("HOME")) {
            //nada
        } else {
            $response->addSpeak('They hung up the phone.', array('language' => 'en-US', 'voice' => 'WOMAN'));

            //stop record from recordingCallManager
            $aux = new RestAPI($this->auth_id, $this->auth_token);
            $record = RecordCalls::where('consultant_id','=',Input::get("USR"))->orderBy('created_at', 'desc')->first();
            if ($record != null) {
                $params = array(
                    'call_uuid'=>$record->uuid,
                    'URL' => $record->url,
                    'callback_url' => ''
                );
                $aux->stop_record($params);
            }
        }
        $response->addSpeak('Ready to dial.', array('language' => 'en-US', 'voice' => 'MAN'));
        $response->addWait(array('length' => 180000));
        print $response->toXML();
//update USR STATUS.
        $usr = Input::get("USR");
        $consultant = Consultant::find($usr);
        if ($consultant != null) {
            if ($uuid) {
                $consultant->uuid = $uuid;
                $consultant->status = 'IDLE';
            } else {
                $consultant->status = 'ACTIVE';
            }
            $consultant->save();
        }
//update transaction TRANSTYPE.
        if ($status == 'failed') {
            $transId = Input::has("TRANSACTION") ? Input::get("TRANSACTION") : -1;
            $trans = Transaction::find($transId);
            if ($trans != null) {
                $trans->transtype = 'FAILED';
                $trans->save();
            }
        } elseif ($status == 'cancel' && Input::has("HANG") && $uuid) {
            $trans = Transaction::where('uuid', 'like', $uuid)->orderBy('created_at', 'desc')->first();
            if ($trans != null) {
                $trans->transtype = 'HANGUP';
                $trans->save();
            }
        }
    }

//Start Dialer.
    public function boss()
    {
        $to = str_pad(preg_replace('/\D+/', '', Input::get("TO")), 11, '1', STR_PAD_LEFT);
        $from = str_pad(preg_replace('/\D+/', '', Input::get("FROM")), 11, '1', STR_PAD_LEFT);
        $p = new RestAPI($this->auth_id, $this->auth_token);
        $status = $this->consultant->status;

        if ($status == 'OFFLINE') {
            $params = array(
                'to' => $from,
                'from' => '17862940557',
                'hangup_url' => route('bossEnd', ['USR' => $this->consultant->id]),
                'caller_name' => 'HOUSE x' . substr($from, -3),
                'machine_detection' => 'hangup',
                'machine_detection_time' => 3500,
                'ring_timeout' => 10,
                'answer_method' => 'GET',
                'hangup_method' => 'GET',
                'answer_url' => route('dial', ['USR' => $this->consultant->id, 'FWD' => $to])
            );
            $p->make_call($params);
        } elseif ($status == 'IDLE') {
                $p->transfer_call(array(
                    'call_uuid' => $this->consultant->uuid,
                    'legs' => 'aleg',
                    'aleg_url' => route('dial', ['USR' => $this->consultant->id, 'FWD' => $to]),
                    'aleg_method' => 'GET'
                ));
        }
    }

//Redirect From boss to Dial.
    public function dial()
    {
        $uuid = Input::get("CallUUID");
        $usr = Input::get("USR");
        $dst = Input::get("FWD");
        $lead = Lead::where('phone', 'like', $dst)->orWhere('phone2', 'like', $dst)->first();
        $consultPhone = '17862940557';

        $consultant = Consultant::find($usr);

//Find the caller id phone we going to use for that state
        if($lead != null){
            if ($consultant != null && $consultant->useExt == 1) {
                $consultPhone = str_pad(preg_replace('/\D+/', '', $consultant->did), 11, '1', STR_PAD_LEFT);
            }else{
                $phoneByState = PhoneByState::where('state', 'like',$lead->state)->pluck('phone');
                if (count($phoneByState)>0) {
                    $consultPhone = $phoneByState[0];
                }
            }
        }

        //update USR STATUS.
                if ($consultant != null) {
                    if ($uuid) {
                        $consultant->uuid = $uuid;
                        $consultant->status = 'ACTIVE';
                    } else {
                        $consultant->status = 'ACTIVE';
                    }
                    $consultant->save();
                }

        // created the TRANSACTION.
                if($lead != null) {
                    //save only if is the first call for that file today.
                    $today = "%".date('Y-m-d')."%";
                    $transToday = Transaction::where('transtype','like','CALL')->where('lead_id','=',$lead->id)->where('created_at','like',$today)->first();
                    if($transToday == null){
                        $new = "Recycle";
                        $callType = $lead->hasContractSold() > 0?"PaidPH1":(count($lead->projects()->get()) > 0?"Sub":"Lead");
                        if($callType == "Lead"){
                            $now = date('Y-m-d H:i:s', strtotime('-7 days'));
                            if($lead->created_at >= $now){
                                $new = "New";
                            }
                        }
                        $trans = Transaction::createTransaction($usr, $lead->id, $uuid, 'CALL', '', '', '', $callType, $new, $dst, '');
                    }
                    else{
                        $trans = -1;
                    }
                }else{
                    $trans = Transaction::createTransaction($usr, '', $uuid, 'CALL', '', '', '', '', 'OUTSIDE-CALL', $dst, '');
                }

//make the call
        $response = new Response();
        $dial_params = array();
        $dial_params['callerName'] = "PATENT SERVICES USA";
        $dial_params['callerId'] = $consultPhone;
        if($lead != null) {
            $dial_params['action'] = route('dialEnd', ['LEAD' => $lead->id]);
        }else{
            $dial_params['action'] = route('dialEnd', ['LEAD' => 'OUTSIDE']);
        }
        $dial_params['method'] = 'GET';
        $dial_params['callbackUrl'] = route('action', ['USR' => $usr]);
        $dial_params['callbackMethod'] = 'GET';
        $dial_params['redirect'] = 'false';
        $dial = $response->addDial($dial_params);
        (substr($dst, 0, 4) == "sip:") ? $dial->addUser($dst) : $dial->addNumber($dst);
        $response->addRedirect(route('idle', ['TRANSACTION' => $trans, 'USR' => $usr]), array('method' => 'GET'));
        print $response->toXML();
    }

//redirect from Dial to update LEAD last call.
    public function dialEnd()
    {
        $leadId = Input::get("LEAD");
        if($leadId != 'OUTSIDE'){
            $lead = Lead::find($leadId);
            if ($lead != null) {
                $lead->last = date("Y-m-d H:i:s");
                $lead->save();
                //update transaccion call
                $transaction = Transaction::where(['lead_id'=>$leadId,'transtype'=>'CALL'])->orderBy('created_at','DESC')->first();
                if($transaction != null){
                    $transaction->params = 'FINISHED';
                    $transaction->save();
                }
            }
        }
    }

//redirect from Dial to update LEAD last call.
    public function action()
    {
        $action = Input::get("DialAction");
        if($action == 'answer'){
            $usr = Input::get("USR");
            $consultant = Consultant::find($usr);
            if ($consultant != null) {
                $consultant->status = 'ACTIVE';
                $consultant->save();
            }
        }
    }

//when Consultant click Hang Up.
    public function hanger()
    {
        $consultant = $this->consultant;
        $uuid = $consultant->uuid;
        if($consultant->status == 'ACTIVE'){
            $fwd = array(
                'call_uuid' => $uuid,
                'legs' => 'both',
                'bleg_url' => route('hangerEnd'),
                'bleg_method' => 'GET',
                'aleg_method' => 'GET');
            $fwd['aleg_url'] = route('idle', ['HANG' => '1', 'USR' => $consultant->id]);
            $p = new RestAPI($this->auth_id, $this->auth_token);
            $p->transfer_call($fwd);
            $p->speak(array(
                'call_uuid' => $uuid,
                'text' => 'OK... We hung up',
                'language' => 'en-US'));

            $consultant->status = 'IDLE';
            $consultant->save();
        }
    }

//redirect from hanger.
    public function hangerEnd()
    {
        $response = new Response();
        $response->addHangup(array());
        print $response->toXML();
    }

//function to send SMS. (non tested)
    private function sendSms($to, $sms, $usr, $lead, $smsTitle){
        if($usr != 1000000){
            $set = array(17864712293,17864538438,17864106994,17864106648,17864106007,17864756224,17864656547,17864656561,17864656571,17864656599,17864656603,17864656607,17864656794,17864710367,17864712038,17864752406);
            $from = $set[array_rand($set)];
            $from = '17864712293';
            $p = new RestAPI($this->auth_id, $this->auth_token);$params = array(
                'src' => $from,
                'dst' => $to,
                'text' => $sms,
                'type' => 'sms',
            );
            $p->send_message($params);
// created the TRANSACTION.
            Transaction::createTransaction($usr, $lead, '', 'SMS', $smsTitle, '', '', '', '', $to, '');
// update Last in the lead
            $lead = Lead::find($lead);
            if ($lead != null) {
                $lead->last = date("Y-m-d H:i:s");
                $lead->save();
            }
        }else{
            $from = '17862352778';
            $p = new RestAPI($this->auth_id, $this->auth_token);$params = array(
                'src' => $from,
                'dst' => $to,
                'text' => $sms,
                'type' => 'sms',
            );
            $p->send_message($params);
        }
    }

//Send SMS from the Lead views. (non tested)
    public function smsOut()
    {
        $fromConsultant = Input::get("FROM");
        $to = str_pad(preg_replace('/\D+/', '', Input::get("TO")), 11, '1', STR_PAD_LEFT);
        $cName = $this->consultant->fname." ".$this->consultant->lname;
        $lead = Lead::where('phone', 'like',  $to)->orWhere('phone2', 'like', $to)->first();

        $smsName = "";
        $sms = "";
        switch (Input::get("COMMAND")) {
            case 'smsLead':
                $msg = Input::get("MSG");
                $message = Message::find($msg);
                if($msg == '217'){
                    $sms = $message->text;
                    $smsName = $message->title;
                }elseif($message != null) {
                    $sms = str_replace("[PHONE]",$fromConsultant,$message->text);
                    $smsName = $message->title;
                    $sms = str_replace("[CONSULTANT]",$cName,$sms);
                    $sms = str_replace('\r\n',"\r\n",$sms);
                }
            break;
            case 'link':
                $title = str_replace(" ", "-",Input::get("TITLE"));
                $smsName="LINK";
                $sms="PATENT SERVICES, USA\r\n";
                $sms.="Please follow this link to our Learning Center:\r\n";
                $sms.="http://ownmyinvention.net/Learn/$title\r\n";
                $sms.="$cName\r\n$fromConsultant";
            break;
            case 'smsSub':
                $sms =  str_replace("<br>", "\n", Input::get("SMS"));
                $smsName="SMS BY SUB";

                $msg = "Message sent by you On: ".date("m-d-Y H:i:s")."\r\n";
                $msg .= "Original Message:\r\n\r\n";
                $msg .=	$sms."\r\n\r\n";
//save the msg in the inbox table as sent it by consultant
                $inbox = new Inbox();
                $inbox->consultant_id = $lead->consultant_id;
                $inbox->lead_id = $lead->id;
                $inbox->message = $msg;
                $inbox->subject = 'CLIENT TEXT';
                $inbox->createdBy = 'CONSULTANT';
                $inbox->status = 1;
                $inbox->save();
            break;
            case 'mms':
                $smsName="MMS";
                $sms="PATENT SERVICES USA\r\n Please use photo@ownmyinvention. com to transmit images and attachments securely.";
                $sms.="\r\n$cName\r\n$fromConsultant";
                break;
        }
        $this->sendSms($to, $sms, $this->consultant->id, $lead->id, $smsName);
        return "1";
    }

//Set voice message (First).
    public function vmBoss()
    {
        $from = '18776524908';
        $to = str_pad(preg_replace('/\D+/', '', Input::get("TO")), 11, '1', STR_PAD_LEFT);
        $vmId = Input::get("VM");
        $vm = Message::find($vmId);

        $p = new RestAPI($this->auth_id, $this->auth_token);
        $params = array(
            'to' => $to,
            'from' => $from,
            'answer_url' => route('setvm', ['URL' => $vm->text, 'VM' => $vmId]),
            'hangup_url' => '',
            'caller_name' => 'HOUSE',
            'ring_method' => 'GET',
            'machine_detection' => 'hangup',
            'machine_detection_time' => 2000,
            'answer_method' => 'GET',
            'hangup_method' => 'GET');
        $p->make_call($params);

    }

//Redirect from Set voice message (Second).
    public function setvm()
    {
        $vmId = Input::get("VM");
        $record_url = Input::has("RecordUrl")?Input::get("RecordUrl"):Input::get("URL");
        $response = new Response();
        $getdigits = $response->addGetDigits(array('action' => route('surevm', ['URL' => $record_url, 'VM' => $vmId]), 'method' => 'GET'));

        if (!$record_url || $record_url == ''){
            $getdigits->addSpeak('The Slot is empty.',array('language' => 'en-US', 'voice' => 'MAN'));
        }else{
            $getdigits->addSpeak('Press 1 to play your ree cording message',array('language' => 'en-US', 'voice' => 'MAN'));
        }
        $getdigits->addSpeak('Press 2 to ree cord an new message',array('language' => 'en-US', 'voice' => 'MAN'));
        $getdigits->addSpeak('Press 3 to save your message and exit.',array('language' => 'en-US', 'voice' => 'MAN'));
        print $response->toXML();
    }

//Redirect from Set voice message (Third).
    public function surevm()
    {
        $vmId = Input::get("VM");
        $record_url = Input::get("URL");
        $input_digits = Input::get("Digits");
        $response = new Response();

        if ($input_digits == '1')
        {
            $response->addPlay(urldecode($record_url));
            $response->addRedirect(route('setvm', ['URL' => $record_url, 'VM' => $vmId]), array('method' =>'GET'));
        }
        else if ($input_digits == '2')
        {
            $response->addRedirect(route('getvm', ['VM' => $vmId]), array('method' =>'GET'));
        }
        else if ($input_digits == '3') {
            $response->addSpeak('Your message is ready to go.',array('language' => 'en-US', 'voice' => 'MAN'));
//save the new msg
            $vm = Message::find($vmId);
            if ($vm != null) {
                $vm->text = $record_url;
                $vm->save();
            }
        } else {
            $response->addSpeak('Invalid input',array('language' => 'en-US', 'voice' => 'MAN'));
            $response->addRedirect(route('setvm', ['URL' => $record_url, 'VM' => $vmId]), array('method' =>'GET'));
        }

        print $response->toXML();
    }

//Redirect from Set voice message (Fourth).
    public function getvm()
    {
        $vmId = Input::get("VM");
        $response = new Response();
        $response->addSpeak('... Ree-cord your auto-message at the tone, after youre done, press pound',array('language' => 'en-US', 'voice' => 'MAN'));
        $response->addRecord(array('action' => route('setvm', ['VM' => $vmId]),
            'method' => 'GET',
            'maxLength' => '60',
            'timeout' => '60',
            'finishOnKey' => '#',
            'fileFormat' => 'wav',
            'playBeep' => 'true'));
        $response->addSpeak('Recording not received',array('language' => 'en-US', 'voice' => 'MAN'));
        $response->addRedirect(route('getvm', ['VM' => $vmId]), array('method' =>'GET'));
        print $response->toXML();
    }

//SEND voice message.
    public function sendvm()
    {
        $vmId = Input::get("VM");
        $lead = Lead::where('phone', 'like', str_pad(preg_replace('/\D+/', '', Input::get("TO")), 11, '1', STR_PAD_LEFT))->orWhere('phone2', 'like', str_pad(preg_replace('/\D+/', '', Input::get("TO")), 11, '1', STR_PAD_LEFT))->first();

        $vm = Message::find($vmId);
        if ($vm != null) {
            $consultant = Consultant::find($vm->consultant_id);
            if ($consultant != null) {
                if($consultant->status == 'ACTIVE'){
                    $fwd = array(
                        'call_uuid' => $consultant->uuid,
                        'legs' => 'both',
                        'bleg_url' => route('endSendvm', ['VM' => urldecode($vm->text)]),
                        'bleg_method' => 'GET',
                        'aleg_method' => 'GET',
                        'aleg_url' => route('idle', ['USR' => $vm->consultant_id, 'MSG' => '1'])
                        );
                    $p = new RestAPI($this->auth_id, $this->auth_token);
                    $p->transfer_call($fwd);
                    $p->speak(array(
                        'call_uuid' => $consultant->uuid,
                        'text' => 'OK... I\'ll leave your message.',
                        'language' => 'en-US'));
// update CONSULTANT.
                    $consultant->status = 'IDLE';
                    $consultant->save();
// created the TRANSACTION.
                    Transaction::createTransaction($vm->consultant_id, $lead->id, $consultant->uuid, 'VM', $vm->title, '', '', '', '', '', '');
// update Last in the lead
                    $lead->last = date("Y-m-d H:i:s");
                    $lead->save();
                }
            }
        }
    }

//End of send voice message.
    public function endSendvm()
    {
        $vm = urldecode(Input::get("VM"));
        $response = new Response();
        $response->addWait(array(
            'length' => 35,
            'silence' => 'true'));
        $response->addPlay($vm,array());
        $response->addHangup(array());
        print $response->toXML();
    }

//record Calls.
    public function recordCall()
    {
        $lead = Lead::where('phone', 'like',  str_pad(preg_replace('/\D+/', '', Input::get("TO")), 11, '1', STR_PAD_LEFT))->orWhere('phone2', 'like', str_pad(preg_replace('/\D+/', '', Input::get("TO")), 11, '1', STR_PAD_LEFT))->first();
        $p = new RestAPI($this->auth_id, $this->auth_token);
        $params = array(
            'call_uuid' => $this->consultant->uuid,
            'time_limit' => 3600,
            'file_format' => 'wav'
        );
        $response = $p->record($params);
        $url = $response['response']["url"];
        $recordId = $response['response']["recording_id"];
// save the call.
        $record = new RecordCalls();
        $record->consultant_id = $this->consultant->id;
        $record->uuid = $this->consultant->uuid;
        $record->recordId = $recordId;
        $record->lead_id = $lead->id;
        $record->url = $url;
        $record->save();
        return $record->id;
    }

    //record Calls Manager.
    public function recordCallManager()
    {
        $consultant = Consultant::find(Input::get("ID"));
        if($consultant != null && $consultant->status == 'ACTIVE'){
            $p = new RestAPI($this->auth_id, $this->auth_token);
            $params = array(
                'call_uuid' => $consultant->uuid,
                'time_limit' => 3600,
                'file_format' => 'wav'
            );
            $response = $p->record($params);
            $url = $response['response']["url"];
            $recordId = $response['response']["recording_id"];
// save the call.
            $record = new RecordCalls();
            $record->consultant_id = $consultant->id;
            $record->uuid = $consultant->uuid;
            $record->recordId = $recordId;
            $record->lead_id = -1;
            $record->url = $url;
            $record->save();
            return "1";
        }
       return "-1";
    }

//Stop record Calls.
    public function stopRecordCall()
    {
        $id = Input::get("RECORD");
        $p = new RestAPI($this->auth_id, $this->auth_token);
        $record = RecordCalls::find($id);
        if ($record != null) {
            $params = array(
                'call_uuid'=>$record->uuid,
                'URL' => $record->url,
                'callback_url' => ''
            );
            $p->stop_record($params);
        }
        return "'STOP'";
    }

//activate and deactivate sms to consultant when they receive a lead
    public function smsFromConsultant()
    {
        $from = preg_replace('/^1|\D/', '', Input::get("FROM"));
        $text = Input::get("TEXT");
        $usr = Consultant::where('notino', 'like', $from)->first();
        if ($usr != null) {
            if (strpos(strtolower($text),'off') !== false){
                $usr->leadNoti = 0;
            }elseif(strpos(strtolower($text),'on') !== false){
                $usr->leadNoti = 1;
            }
            $usr->save();
        }
    }

//to redirect calls to BATSON or INVENTPALOOZA.
    public function redirectCalls()
    {
        $fwd = Input::get("FWD");
        $consultant = Consultant::find($fwd);
        if ($consultant != null) {
            $dst = "1".$consultant->did2;
        }
        $response = new Response();
        $dial = $response->addDial();
        $dial->addNumber($dst);
        print $response->toXML();
    }

//SMS IN.
    public function smsIn()
    {
        $from = Input::get("From");
        $text = Input::get("Text");
        $lead = Lead::where('phone', 'like', $from)->orWhere('phone2', 'like', $from)->first();

        if ($lead != null) {
            $name = $lead->fname." ".$lead->lname;
            $fileno = $lead->fileno;
            $usr = $lead->consultant->usr;

            if ((strpos(strtolower($text),'stop') !== false) || (strpos(strtolower($text),'do not contact') !== false) || (strpos(strtolower($text),'block list') !== false) || (strpos(strtolower($text),'This is not a working number') !== false) || (strpos(strtolower($text),'do not text') !== false)|| (strpos(strtolower($text),'don%27t contact') !== false) || (strpos(strtolower($text),'don%27t text') !== false) || (strpos(strtolower($text),'unsubscribe') !== false) || (strpos(strtolower($text),'remove') !== false) || (strpos(strtolower($text),'delete') !== false) || (strpos(strtolower($text),'quit') !== false))
            {
                $msg = "A new STOP request was made via text.  We are now blocking texts to this number.\r\n\r\n";
                $msg .= "Original Message:\r\n\r\n";
                $msg .=	$text."\r\n\r\n";
                $msg .= "Info:\r\n";
                $msg .= "Consultant: ".$usr."\r\n";
                $msg .= "Client: ".$name."\r\n";
                $msg .= "File #: ".$fileno."\r\n";
                $msg .= $from;
                mail('intranet@ownmyinvention.com','STOP',$msg,"From: ".$from."\r\n");
            }else{
                $msg = "A new text message has arrived On: ".date("m-d-Y H:i:s")."\r\n";
                $msg .= "Original Message:\r\n\r\n";
                $msg .=	$text."\r\n\r\n";
                $msg .= "Info:\r\n";
                $msg .= "Consultant: ".$usr."\r\n";
                $msg .= "Client: ".$name."\r\n";
                $msg .= "File #: ".$fileno."\r\n";
                $msg .= "Phone #: ".$from."\r\n";
                mail('intranet@ownmyinvention.com','INBOUND TEXT',$msg,"From: ".$from."\r\n");
//save the msg in the inbox table
                Inbox::createInbox($lead->id, $lead->consultant_id, $msg, 'CLIENT TEXT', 'CLIENT');
            }
        }
    }

//Company toll free number
    public function mainInOld()
    {
        $dst = Input::get("FWD");
        $from = Input::get("From");
        $response = new Response();
        $dial = $response->addDial();
        $did = "";
        $lead = Lead::where('phone', 'like', $from)->orWhere('phone2', 'like', $from)->first();
        if ($lead != null) {
            //check for legal in the dialer to redirect the call to clientServices
            $project = ProjectClientServices::where('fileno',$lead->fileno)->where('ddrReceived_created_at','!=','')->first();
            if($project!=null)
                $received = 1;

            if($received == 1){
                $did = '7867037237';
            }else if($received==0){
                if($lead->consultant->usr == 'batson'){
                    $did = $lead->consultant->did2;
                }else{
                    $did = $lead->consultant->did;
                }
            }
        }
        if($did !=""){
            $did = "1".$did;
            $dial->addNumber($did);
        }else{
            $dial->addNumber($dst);
        }
        print $response->toXML();
    }

//invento mio
    public function smsInAlain()
    {
        $from = Input::get("From");
        $text = Input::get("Text");

        $from1 = '17862352778';
        $p = new RestAPI($this->auth_id, $this->auth_token);$params = array(
        'src' => $from1,
        'dst' => '17868047298',
        'text' => $from."\r\n".date("m-d-Y H:i:s")."\r\n".$text,
        'type' => 'sms',
    );
        $p->send_message($params);
    }
    public function smsOutAlain(){

        $sms =  str_replace("<br>", "\n", Input::get("SMS"));
        $to = str_pad(preg_replace('/\D+/', '', Input::get("TO")), 11, '1', STR_PAD_LEFT);

        if($sms != ''&& $to !=''){
            $from1 = '17862352778';
            $p = new RestAPI($this->auth_id, $this->auth_token);$params = array(
                'src' => $from1,
                'dst' => $to,
                'text' => $sms,
                'type' => 'sms',
            );
            $test = $p->send_message($params);
            //print 'msg sent.';
            print_r($test);
        }else{
            print 'invalid msg';
        }
    }

    //fin invento mio


    //Company toll free number
    public function mainIn(){
        $first = url("sound/firstNew.mp3");
        $second =url("sound/second.mp3");
        $getdigitattributes = array (
            'action'=> url("ivrAction"),
            'method' => 'GET'
        ); // This is the url where 'Digits' parameter would be sent after user's digit press event

        $r = new Response();
        $g = $r->addGetDigits($getdigitattributes);
        $g->addPlay($first);
        $g->addPlay($second);
        $r->addSpeak('Input not received.',array('language' => 'en-US', 'voice' => 'MAN'));
        $r->addRedirect(url("mainIn"), array('method' => 'GET'));
        print $r->toXML();
    }

    public function ivrAction()
    {
        $digits = Input::get('Digits');
        $from = Input::get('From');
        $first3letter =url("sound/first3letter.mp3");;
        $consultantExts = Consultant::where(['active' => 1])->pluck('ext');
        $response = new Response();

        if ($digits == '0') {//leave msg for support
            $response->addSpeak('Ok, I\'m going to transsfer your call to a representative...',array('language' => 'en-US', 'voice' => 'MAN'));
            $params = array(
                'callerId' => $from # Caller ID
            );
            $d = $response->addDial($params);
            $number = "17862940557";
            $d->addNumber($number);
        }elseif($digits == '1') {
            $getdigitattributes = array (
                'action'=> url("ivrAction"),
                'method' => 'GET'
            ); // This is the url where 'Digits' parameter would be sent after user's digit press event

            $g = $response->addGetDigits($getdigitattributes);
            $g->addSpeak('Esta llamada puede ser grabada o monitoriada para propositos de entrenamiento... Marque la extencion que desea o marque dos para escuchar nuestro directorio...',array('language' => 'es-US', 'voice' => 'MAN'));
            //$r->addSpeak("The number is $from");
            //$r->addRedirect('http://insidesalesmiami.com/redirect', array('method' => 'GET'));
            $response->addSpeak('Input not received.',array('language' => 'en-US', 'voice' => 'MAN'));
            $response->addRedirect(url("ivrAction?Digits=1"), array('method' => 'GET'));
        }elseif($digits == '2') {
            $getdigitattributes = array (
                'action'=> url("ivr3firstLetter"),
                'method' => 'GET'
            ); // This is the url where 'Digits' parameter would be sent after user's digit press event

            $g = $response->addGetDigits($getdigitattributes);
            $g->addPlay($first3letter);
            $response->addSpeak('Input not received.',array('language' => 'en-US', 'voice' => 'MAN'));
            $response->addRedirect(url("ivrAction?Digits=2"), array('method' => 'GET'));

        }elseif($digits == '3') {
            $text = 'Reception. dial zero... Human Resources. dial 221... client services. dial 237... administration. dial 211... production. dial 208... Development. dial 229... public relation. dial 214.';
            $getdigitattributes = array (
                'action'=> url("ivrAction"),
                'method' => 'GET'
            ); // This is the url where 'Digits' parameter would be sent after user's digit press event

            $g = $response->addGetDigits($getdigitattributes);
            $g->addSpeak($text,array('language' => 'en-US', 'voice' => 'MAN'));
            $response->addSpeak('Input not received.',array('language' => 'en-US', 'voice' => 'MAN'));
            $response->addRedirect(url("ivrAction?Digits=3"), array('method' => 'GET'));

        }elseif(in_array($digits,$consultantExts) || in_array($digits,[221,237,211,208,229,214])) {
            $response->addSpeak('Ok, I\'m going to transsfer your call...',array('language' => 'en-US', 'voice' => 'MAN'));
            $params = array(
                'callerId' => $from # Caller ID
            );
            $d = $response->addDial($params);


            if($digits == 999){
                $number = "17864757050";
            }elseif($digits == 998){
                $number = "13056099476";
            }else{
                $number = "17867037".$digits;
            }

            $d->addNumber($number);
        }elseif($digits > 100000) {
            $lead = Lead::where('fileno',$digits)->first();
            if($lead !=null){
                $project=ProjectClientServices::where('fileno',$digits)->first();
                if($project!=null){
                    $getdigitattributes = array (
                        'action'=> url("ivrAction?ExtCons=".$lead->consultant->ext),
                        'method' => 'GET'
                    ); // This is the url where 'Digits' parameter would be sent after user's digit press even

                    $g = $response->addGetDigits($getdigitattributes);
                    $g->addSpeak('Dial four. if you want to speak with your consultant. or five. if you want to speak with client services',array('language' => 'en-US', 'voice' => 'MAN'));
                    $response->addSpeak('Input not received.',array('language' => 'en-US', 'voice' => 'MAN'));
                    $response->addRedirect(url("ivrAction?Digits=".$digits), array('method' => 'GET'));
                }else{
                    $response->addSpeak('Ok, I\'m going to transsfer your call...',array('language' => 'en-US', 'voice' => 'MAN'));
                    $params = array(
                        'callerId' => $from # Caller ID
                    );
                    $d = $response->addDial($params);
                    $number = "17867037".$lead->consultant->ext;
                    $d->addNumber($number);
                }
            }else{
                $response->addSpeak('This Is an Invalid input',array('language' => 'en-US', 'voice' => 'MAN'));
                $response->addRedirect(url("mainIn"), array('method' => 'GET'));
            }
        }elseif ($digits == '4' && Input::has('ExtCons')) {//leave msg for support
            $extCons = Input::get('ExtCons');
            $response->addSpeak('Ok, I\'m going to transsfer your call...',array('language' => 'en-US', 'voice' => 'MAN'));
            $params = array(
                'callerId' => $from # Caller ID
            );
            $d = $response->addDial($params);


            if($extCons == 999){
                $number = "17864757050";
            }elseif($extCons == 998){
                $number = "13056099476";
            }else{
                $number = "17867037".$extCons;
            }


            $d->addNumber($number);
        }elseif ($digits == '5'  && Input::has('ExtCons')) {//leave msg for support
            $response->addSpeak('Ok, I\'m going to transsfer your call...',array('language' => 'en-US', 'voice' => 'MAN'));
            $params = array(
                'callerId' => $from # Caller ID
            );
            $d = $response->addDial($params);
            $number = "17867037237";
            $d->addNumber($number);
        }
        else {
            $response->addSpeak('This Is an Invalid input',array('language' => 'en-US', 'voice' => 'MAN'));
            $response->addRedirect(url("mainIn"), array('method' => 'GET'));
        }

        print $response->toXML();

    }

    public function ivr3firstLetter(){
        $digits = Input::get('Digits');
        $consultantExts = Consultant::where(['active' => 1,'remember_token'=> $digits])->get(['fname','lname','ext','did']);
        $response = new Response();

        if(count($consultantExts) == 1){
            $response->addRedirect(url("ivrAction?Digits=".$consultantExts[0]['ext']), array('method' => 'GET'));
        }elseif(count($consultantExts) > 1){
            $text = 'Listen our directory and dial the extension you are trying to reach ...';
            foreach($consultantExts as $ext){
                $text .= strlen($text) > 0 ? "," : "";
                $text .= $ext['fname'].'.  '.$ext['lname'].'..  extention. '.$ext['ext'].'....';
            }
            $getdigitattributes = array (
                'action'=> url("ivrAction"),
                'method' => 'GET'
            ); // This is the url where 'Digits' parameter would be sent after user's digit press event

            $g = $response->addGetDigits($getdigitattributes);
            $g->addSpeak($text,array('language' => 'en-US', 'voice' => 'MAN'));
            $response->addSpeak('Input not received.',array('language' => 'en-US', 'voice' => 'MAN'));
            $response->addRedirect(url("ivrAction?Digits=2"), array('method' => 'GET'));
        }else{
            $response->addSpeak('This Is an Invalid input.. Try again.',array('language' => 'en-US', 'voice' => 'MAN'));
            $response->addRedirect(url("ivrAction?Digits=2"), array('method' => 'GET'));
        }
        print $response->toXML();
    }


    //--------------------- Record Calls Manager Code -------------------------

    //index
    public function recordCallsManager(){
        $consultants = Consultant::where('active','LIKE','1')->get();
        $total_inbox = Inbox::where(['consultant_id'=>$this->consultant->id,'status'=>0])->count();
        $calls = RecordCalls::where('lead_id','LIKE','-1')->get();
        return view('intranet.recordcalls.index',array('consultant'=>$this->consultant,'total_inbox'=>$total_inbox,'consultants'=>$consultants,'calls'=>$calls));
    }

    public function deleteCall(){
        $id = Input::get("ID");
        $call = RecordCalls::find($id);
        if($call != null){
            $call->delete();
        }
        return json_encode($id);
    }

    //--------------------- library -------------------------

    public function callLibrary()
    {
        $usr = $this->consultant->id;
        $phone = str_pad(Input::get("PHONE"), 11, '1', STR_PAD_LEFT);
        $library = Input::get("LIBRARY");
        $p = new RestAPI($this->auth_id, $this->auth_token);
        $params = array(
            'to' => $phone,
            'from' => '17862940557',
            'answer_url' => route('playLibrary', ['LIBRARY' => $library]),
            'hangup_url' => route('bossEnd', ['USR' => $usr]),
            'caller_name' => 'DIALER',
            'answer_method' => 'GET',
            'hangup_method' => 'GET');
        $p->make_call($params);
    }

    public function playLibrary()
    {
        $library = Input::get("LIBRARY");
        $record = RecordCalls::find($library);
        $response = new Response();
        $response->addWait(array('length' => 2));
        $response->addPlay(urldecode($record->url));
        print $response->toXML();
    }
}

