<?php namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\ClientSNotes;
use App\Models\Consultant;
use App\Models\Ilc;
use App\Models\IlcNotes;
use App\Models\Inbox;
use App\Models\Lead;
use App\Models\Message;
use App\Models\Project;
use App\Models\Tradeshow;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class CommonController extends Controller {


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
    /**
     * Look into the DB the total of new mails for the current consultant
     *
     * @return Response
     */
    public function mailsys()
    {
        $total_inbox = Inbox::where(['consultant_id'=>$this->consultant->id,'status'=>0])->count();
        return $total_inbox;
    }

    /**
     * Load the emails for the current consultant
     *
     * @return Response
     */
    public function loadInbox()
    {
        $msgPaymentNew = Inbox::where(array('consultant_id'=>$this->consultant->id,'subject'=>'PAYMENT','status'=>0))->orderBy('created_at','DESC')->get();
        $msgFileNew = Inbox::where(array('consultant_id'=>$this->consultant->id,'subject'=>'FILE UPLOADED','status'=>0))->orderBy('created_at','DESC')->get();
        $msgFileOld = Inbox::where(array('consultant_id'=>$this->consultant->id,'subject'=>'FILE UPLOADED','status'=>1))->orderBy('created_at','DESC')->take(15)->get();
        $msgClientNew = Inbox::where(array('consultant_id'=>$this->consultant->id,'subject'=>'CLIENT TEXT','createdBy'=>'CLIENT','status'=>0))->orderBy('created_at','DESC')->get();
        $msgClientOld = Inbox::where(array('consultant_id'=>$this->consultant->id,'subject'=>'CLIENT TEXT','createdBy'=>'CLIENT','status'=>1))->orderBy('created_at','DESC')->take(15)->get();
        $msgProductionOld = Inbox::where(array('consultant_id'=>$this->consultant->id,'subject'=>'PRODUCTION','status'=>1))->orderBy('created_at','DESC')->take(15)->get();
        $msgProductionNew = Inbox::where(array('consultant_id'=>$this->consultant->id,'subject'=>'PRODUCTION','status'=>0))->orderBy('created_at','DESC')->get();
        $msgClientServicesNew = Inbox::where(array('consultant_id'=>$this->consultant->id,'subject'=>'CLIENT SERVICES','status'=>0))->orderBy('created_at','DESC')->get();
        if($this->consultant->id == 25){
            $msgPaymentOld = Inbox::where(array('consultant_id'=>$this->consultant->id,'subject'=>'PAYMENT','status'=>1,'finish'=>0))->orderBy('created_at','DESC')->get();
            $msgClientServicesOld = Inbox::where(array('consultant_id'=>$this->consultant->id,'subject'=>'CLIENT SERVICES','status'=>1,'finish'=>0))->orderBy('created_at','DESC')->take(15)->get();
        }else{
            $msgPaymentOld = Inbox::where(array('consultant_id'=>$this->consultant->id,'subject'=>'PAYMENT','status'=>1))->orderBy('created_at','DESC')->take(15)->get();
            $msgClientServicesOld = Inbox::where(array('consultant_id'=>$this->consultant->id,'subject'=>'CLIENT SERVICES','status'=>1))->orderBy('created_at','DESC')->take(15)->get();
        }
        $msgILCNew = Inbox::where(array('consultant_id'=>$this->consultant->id,'subject'=>'ILC','status'=>0))->orderBy('created_at','DESC')->get();
        $msgILCOld = Inbox::where(array('consultant_id'=>$this->consultant->id,'subject'=>'ILC','status'=>1))->orderBy('created_at','DESC')->take(15)->get();

        $msg=array();
        $msg['NEWPAYMENT'] = $msgPaymentNew;
        $msg['OLDPAYMENT'] = $msgPaymentOld;
        $msg['NEWCLIENT'] = $msgClientNew;
        $msg['OLDCLIENT'] = $msgClientOld;
        $msg['NEWFILE'] = $msgFileNew;
        $msg['OLDFILE'] = $msgFileOld;
        $msg['NEWPRODUCTION'] = $msgProductionNew;
        $msg['OLDPRODUCTION'] = $msgProductionOld;
        $msg['NEWCLIENTSERVICES'] = $msgClientServicesNew;
        $msg['OLDCLIENTSERVICES'] = $msgClientServicesOld;
        $msg['NEWILC'] = $msgILCNew;
        $msg['OLDILC'] = $msgILCOld;
        DB::table('inbox')
            ->where('consultant_id',$this->consultant->id)
            ->update(array('status' => 1));
        echo json_encode($msg);
    }

    /**
     * Load the emails for the current consultant and 1 project
     *
     * @return Response
     */
    public function loadInboxFromProject()
    {
        $idLead = Input::get("LEAD");
        $msgPaymentNew = Inbox::where(array('consultant_id'=>$this->consultant->id, 'lead_id' => $idLead,'subject'=>'PAYMENT','status'=>0))->orderBy('created_at','DESC')->get();
        $msgPaymentOld = Inbox::where(array('consultant_id'=>$this->consultant->id, 'lead_id' => $idLead,'subject'=>'PAYMENT','status'=>1))->orderBy('created_at','DESC')->take(15)->get();
        $msgClientNew = Inbox::where(array('consultant_id'=>$this->consultant->id, 'lead_id' => $idLead,'subject'=>'CLIENT TEXT','status'=>0))->orderBy('created_at','DESC')->get();
        $msgClientOld = Inbox::where(array('consultant_id'=>$this->consultant->id, 'lead_id' => $idLead,'subject'=>'CLIENT TEXT','status'=>1))->orderBy('created_at','DESC')->take(15)->get();
        $msgFileNew = Inbox::where(array('consultant_id'=>$this->consultant->id, 'lead_id' => $idLead,'subject'=>'FILE UPLOADED','status'=>0))->orderBy('created_at','DESC')->get();
        $msgFileOld = Inbox::where(array('consultant_id'=>$this->consultant->id, 'lead_id' => $idLead,'subject'=>'FILE UPLOADED','status'=>1))->orderBy('created_at','DESC')->take(15)->get();
        $msgProductionNew = Inbox::where(array('consultant_id'=>$this->consultant->id,'lead_id' => $idLead,'subject'=>'PRODUCTION','status'=>0))->orderBy('created_at','DESC')->get();
        $msgProductionOld = Inbox::where(array('consultant_id'=>$this->consultant->id,'lead_id' => $idLead,'subject'=>'PRODUCTION','status'=>1))->orderBy('created_at','DESC')->take(15)->get();
        $msgClientServicesNew = Inbox::where(array('consultant_id'=>$this->consultant->id,'lead_id' => $idLead,'subject'=>'CLIENT SERVICES','status'=>0))->orderBy('created_at','DESC')->get();
        $msgClientServicesOld = Inbox::where(array('consultant_id'=>$this->consultant->id,'lead_id' => $idLead,'subject'=>'CLIENT SERVICES','status'=>1))->orderBy('created_at','DESC')->take(15)->get();
        $msgILCNew = Inbox::where(array('consultant_id'=>$this->consultant->id,'subject'=>'ILC','status'=>0))->orderBy('created_at','DESC')->get();
        $msgILCOld = Inbox::where(array('consultant_id'=>$this->consultant->id,'subject'=>'ILC','status'=>1))->orderBy('created_at','DESC')->take(15)->get();
        $msg=array();
        $msg['NEWPAYMENT'] = $msgPaymentNew;
        $msg['OLDPAYMENT'] = $msgPaymentOld;
        $msg['NEWCLIENT'] = $msgClientNew;
        $msg['OLDCLIENT'] = $msgClientOld;
        $msg['NEWFILE'] = $msgFileNew;
        $msg['OLDFILE'] = $msgFileOld;
        $msg['NEWPRODUCTION'] = $msgProductionNew;
        $msg['OLDPRODUCTION'] = $msgProductionOld;
        $msg['NEWCLIENTSERVICES'] = $msgClientServicesNew;
        $msg['OLDCLIENTSERVICES'] = $msgClientServicesOld;
        $msg['NEWILC'] = $msgILCNew;
        $msg['OLDILC'] = $msgILCOld;
        DB::table('inbox')
            ->where(array('consultant_id'=>$this->consultant->id, 'lead_id' => $idLead))
            ->update(array('status' => 1));
        echo json_encode($msg);
    }


    //create Appointment From all views
    public function createAppointment()
    {
        $appointment = new Appointment();
        $appointment->consultant_id = $this->consultant->id;
        $appointment->date = Input::get("DATE");
        $appointment->note = Input::get("NOTE");
        $appointment->save();
        return "1";
    }

    //load Appointment on time.
    public function loadAppointment()
    {
        $appointment = Appointment::where(['consultant_id' => $this->consultant->id,'status' => 'UNLOADED'])
            ->where('date', '<', date("Y-m-d H:i:s"))
            ->first();
        if($appointment!=null){
            $appointment->status = 'LOADED';
            $appointment->save();
            return  json_encode($appointment->id);
        }else{
            return "-1";
        }
    }

    //load All Appointment.
    public function loadAllAppointment()
    {
        $consultant = $this->consultant->id;
        $appointments = Appointment::where(['consultant_id' => $consultant])->get();
        return view("intranet.tools.allAppointments",array('appointments'=>$appointments));
    }

    //load Appointment on time.
    public function showAppointment()
    {
        $appointment = Appointment::find(Input::get('ID'));
        return view('intranet.tools.appointmentView',array('note'=>$appointment->note));
    }

    //show the total calls per consultan 1
    public function leaders()
    {
        $today = date('Y-m-d').' 00:00:00';
        if(date('H:i')<'13:30' || date('H:i')>'14:00'){
            $leaders = DB::table('transaction')
                ->select('transaction.consultant_id','consultant.usr', DB::raw('count(*) as cant'))
                ->where('transtype','like','CALL')
                ->where('transaction.consultant_id','!=','57')
                ->where('transaction.created_at','>',$today)
                ->groupBy('transaction.consultant_id')
                ->orderBy('cant', 'DESC')
                ->orderBy('consultant.usr')
                ->join('consultant', 'transaction.consultant_id', '=', 'consultant.id')
                ->get();
        }else{
            $leaders = '';
        }
        return json_encode($leaders);
    }

    //save voice message name
    public function setNameVM()
    {
        $vmId = Input::get('VM');
        $vm = Message::find($vmId);
        if($vm!=null)
        {
            $title = Input::get('TITLE');
            $vm->title = $title;
            $vm->save();
            return "1";
        }
        return "-1";
    }

    //save consultant info like DID2, notifo, leadNotiOpt
    public function updateConsultantInfo()
    {
        $value = Input::get('VALUE');
        $column = Input::get('COLUMN');
        if($column && $value)
        {
            $this->consultant->$column = $value;
            $this->consultant->save();
            return "1";
        }
        return "-1";
    }

    //allow use extention number as outgoing DID
    public function useExt()
    {
        $value = Input::get('REQUEST');
        $this->consultant->useExt = ($value == 'ENABLED'?1:0);
        $this->consultant->save();
        return "1";
    }

    //check if a user was active in the last five minutes
    public function checkActivityUser()
    {
        /*$now = new \DateTime("now");
        $now->sub(new \DateInterval("PT4M"));
        $transaction  = Transaction::where(['consultant_id'=>$this->consultant->id,'transtype'=>'CALL'])->where('updated_at','>=',$now->format("Y-m-d H:is"))->first();
        if($transaction==null && $this->consultant->status!="ACTIVE" && strpos(Session::get('user_type'), 'admin')=== false)
            return "-1";*/
        return "1";
    }

    //share a note to another department
    public function shareNote(){
        $pid =Input::get('PID');
        $note = Input::get('NOTE');
        $receivers = Input::get('TO');
        $sender = Input::get('FROM');
        $project =Project::find($pid);
        $receivers_string='';
        if($project != null){
            $departmentR=array();
            foreach($receivers as $receiver){
                $receivers_string.= $receiver.', ';
                if($receiver == 'consultant'){
                    $departmentR[] = Consultant::find($project->consultant_id);
                }else
                    $departmentR[] = Consultant::where('usr',$receiver)->first();
            }
            $receivers_string = substr($receivers_string,0,count($receivers_string)-2);
            $departmentS = Consultant::where('usr',$sender)->first();
            $project =Project::find($pid);


            //put inbox in the receivers
            $msgInbox = "Note shared from: ".ucwords($departmentS->usr)."<br>Fileno: ".$project->lead->fileno."<br>Client: ".$project->lead->fname." ".
                $project->lead->lname."<br>PIN: ".$pid."<br>".$note;
            foreach($departmentR as $receiver)
                Inbox::createInbox($project->lead->id,$receiver->id,$msgInbox,"CLIENT SERVICES","CLIENT");

            $pcs = $project->clientServicesProject();
            //put note in the receivers
            foreach($receivers as $receiver){
                if($receiver == 'clientservices'){
                    if($pcs!=null){
                        $csNote = new ClientSNotes();
                        $csNote->notes = str_replace("<br>","\n",$msgInbox);
                        $csNote->projectclientservices_id = $pcs->id;
                        $csNote->save();
                    }
                }elseif($receiver == 'ilc'){
                    $ilcs = Ilc::where('projectclientservices_id',$pcs->id)->get();
                    foreach($ilcs as $ilc){
                        $ilcNote = new IlcNotes();
                        $ilcNote->ilc_id = $ilc->id;
                        $ilcNote->notes = str_replace("<br>","\n",$msgInbox);
                        $ilcNote->system =1;
                        $ilcNote->save();
                    }
                }elseif($receiver == 'consultant'){
                    $project->notes = $project->notes."\n".str_replace("<br>","\n",$msgInbox);
                    $project->save();
                }
            }

            //put note in the sender
            $msgInbox = "Note shared to: ".$receivers_string."<br>Fileno: ".$project->lead->fileno."<br>Client: ".$project->lead->fname." ".
                $project->lead->lname."<br>PIN: ".$pid."<br>".$note;
            switch($sender){
                case 'clientservices':
                    if($pcs!=null){
                        $csNote = new ClientSNotes();
                        $csNote->notes = str_replace("<br>","\n",$msgInbox);
                        $csNote->projectclientservices_id = $pcs->id;
                        $csNote->save();
                    }
                    break;
                case 'ilc':
                    $ilcs = Ilc::where('projectclientservices_id',$pcs->id)->get();
                    foreach($ilcs as $ilc){
                        $ilcNote = new IlcNotes();
                        $ilcNote->ilc_id = $ilc->id;
                        $ilcNote->notes = str_replace("<br>","\n",$msgInbox);
                        $ilcNote->system =1;
                        $ilcNote->save();
                    }
                    break;
                case 'consultant':
                    $project->notes = $project->notes."\n".str_replace("<br>","\n",$msgInbox);
                    $project->save();
                    break;
                default:
                    break;
            }

            Transaction::createTransaction($departmentS->id, $project->lead->id, '',"NOTE SHARED", $note, $project->id, '', '', '', '', '');
            return 1;
        }
        return -1;
    }
}
