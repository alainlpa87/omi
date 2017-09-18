<?php namespace App\Http\Controllers;

use App\Helpers\ToolsFunctions;
use App\Models\Article;
use App\Models\Assignment;
use App\Models\Consultant;
use App\Models\Inbox;
use App\Models\Lead;
use App\Models\Message;
use App\Models\Transaction;
use Illuminate\Support\Facades\Input;
use DB;
use Illuminate\Support\Facades\Session;

class LeadController extends Controller {

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
    /*
     * Send to the index view the active leads,the consultant and his voice mails, and update all his leads to LOADED
     *
     * @return Response
     */
    public function index()
    {
        $leads = Lead::where('consultant_id',$this->consultant->id)->where('status','not like','EXCLUDE')->orderBy('created_at','DESC')->get();
        Lead::where('status', 'UNLOADED')->where('consultant_id',$this->consultant->id)->update(['status' => 'LOADED']);
        $voiceMessages = Message::where(['type'=>'VM','consultant_id'=>$this->consultant->id])->get();
        $total_inbox = Inbox::where(['consultant_id'=>$this->consultant->id,'status'=>0])->count();
        $articles = Article::all();
        return view('intranet.lead.index',array('consultant'=>$this->consultant,'leads'=>$leads,'voiceMessages'=>$voiceMessages,
            'total_inbox'=>$total_inbox,'articles'=>$articles,'new'=>0));
    }
    /*
     * Update notes for a lead
     */
    public function updateNotes()
    {
        $id = Input::get('ID');
        $lead = Lead::find($id);
        if($lead!=null)
        {
            $notes = Input::get('NOTES');
            $lead->notes = $notes;
            $lead->save();
            //Create Transaction commented provicional to slow transaccion rows
            //Transaction::createTransaction($lead->consultant_id, $id, '', 'UPDATE-NOTES-LEAD', $notes, '', $lead->email, '', '', $lead->phone, '');
            return "1";
        }
        return "-1";
    }
    /*
    * Update flag for a lead
    */
    public function updateFlag()
    {
        $id = Input::get('ID');
        $lead = Lead::find($id);
        if($lead!=null)
        {
            $flag = Input::get('FLAG');
            $lead->flag = $flag;
            $lead->save();
            return "1";
        }
        return "-1";
    }
    /*
     * Update basic information for a lead
     */
    public function updateBasicDataLead()
    {
        $id = Input::get('ID');
        $lead = Lead::find($id);
        if($lead!=null)
        {
            $fname = Input::get('FNAME');
            $lname = Input::get('LNAME');
            $phone = (Input::get("PHONE") != "")?str_pad(preg_replace('/\D+/', '', Input::get("PHONE")), 11, '1', STR_PAD_LEFT):"";
            $phone2 = (Input::get("PHONE2") != "")?str_pad(preg_replace('/\D+/', '', Input::get("PHONE2")), 11, '1', STR_PAD_LEFT):"";
            $email = strtolower(Input::get('EMAIL'));
            $street = Input::get('STREET');
            $street2 = Input::get('STREET2');
            $city = Input::get('CITY');
            $state = Input::get('STATE');
            $zip = Input::get('ZIP');

            Lead::updateLead($lead->id,'','',$fname,$lname,$phone,$phone2,$email,$street,$street2,$city,$state,$zip,'','','','','');

            //Create Transaction
            Transaction::createTransaction($lead->consultant_id, $id, '', 'UPDATE-LEAD', '', '', $lead->email, '', '', $lead->phone, '');
            return "1";
        }
        return "-1";
    }
    /*
     * Mark a lead as EXCLUDE and save the reason
     */
    public function deleteLead()
    {
        $id = Input::get('ID');
        $lead = Lead::find($id);
        if($lead!=null)
        {
            $reason = Input::get('REASON');
            $lead->reason = $reason;
            $lead->status = 'EXCLUDE';
            $lead->save();
            //Create Transaction
            Transaction::createTransaction($lead->consultant_id, $id, '', 'DELETE-LEAD', $reason, '', $lead->email, '', '', $lead->phone, '');
            return "1";
        }
        return "-1";
    }
    /*
     * Search all the new leads that aren't loaded yet for the current consultant  and updated to loaded
     */
    public function loadLeads()
    {
        $newLeads = Lead::where('consultant_id',$this->consultant->id)->where('status','LIKE','UNLOADED')->get();
        $leadsToLoad=array();
        $isMobile = Input::get('MOBILE');
        foreach($newLeads as $lead)
        {
            $leadsToLoad[]=$this->paintLead($lead->id,$isMobile);
        }
        echo json_encode($leadsToLoad);
        Lead::where('status', 'UNLOADED')->where('consultant_id',$this->consultant->id)->update(['status' => 'LOADED']);
    }
    public function loadLead()
    {
        $id = Input::get('ID');
        $isMobile = Input::get('MOBILE');
        $leadsToLoad[]=$this->paintLead($id,$isMobile);
        echo json_encode($leadsToLoad);
    }
    /*
     * Create a portlet from a Lead, if the lead isn't passed, create it from an ID
     */
    public function paintLead($id,$isMobile)
    {
        $view = ToolsFunctions::curl(url("paintLead?ID=$id&MOBILE=$isMobile"));
        return $view;
    }
    /*
     * Create New Lead from the admin view
     */
    public function createNewLeadConsultant(){
        $fname = Input::get('FNAME');
        $lname = Input::get('LNAME');
        $email = Input::get('EMAIL');
        $phone = str_pad(preg_replace('/\D+/', '', Input::get("PHONE")), 11, '1', STR_PAD_LEFT);
        $street = Input::get('STREET');
        $street2 = Input::get('STREET2');
        $city = Input::get('CITY');
        $state = Input::get('STATE');
        $zip = Input::get('ZIP');
        $consultantId =$this->consultant->id;
        $lead = Lead::where('email',$email)->first();
        $found=[];
        if($lead == null)
        {
            $lead = Lead::where('phone', $phone)->first();
            if ($lead == null)
            {
                //crear el lead con el $consultantId
                $leadId = Lead::createLead('',$consultantId,$fname,$lname,$phone,'',$email,$street,$street2,$city,$state,$zip,'','DEF','','','','UNLOADED');

                //crear el assignment.
                Assignment::createAssignment($consultantId,$leadId,'REASSIGN','','DEF');

                //crear Transaction.
                Transaction::createTransaction($consultantId, $leadId, $this->consultant->id, 'CREATE-LEAD-BY-ADMIN', '', '', $email, '', '', $phone, '');

                $lead = Lead::where('email',$email)->first();
                $found["fileno"]=$lead->fileno;
                $found["success"]=1;
                return json_encode($found);
            }
        }
        $found["fileno"]=$lead->fileno;
        $found["success"]=0;
        return json_encode($found);
    }
    /*
     * Restore a lead and save the row in assignment.
     */
    public function restoreLead()
    {
        $id = Input::get('ID');
        $lead = Lead::find($id);
        if($lead!=null){
            $lead->status = 'RESTORED';
            $lead->save();
            //Create Transaction
            Transaction::createTransaction($lead->consultant_id, $id, '', 'RESTORE-LEAD', '', '', $lead->email, '', '', $lead->phone, '');
            return "1";
        }
        return "-1";
    }

    //show the information of the lead with that condition.
    public function findLead(){
        $leads_id = Lead::findLead(Input::get('PARAMS'));
        $found=[];
        if($leads_id!="-1")
            foreach($leads_id as $lead_id)
            {
                $currentLead = Lead::find($lead_id);
                if($currentLead!=null)
                {
                    $owned = $this->consultant->id == $currentLead->consultant->id?1:0;
                    $found[]=['id'=>$currentLead->id,'fname'=>$currentLead->fname,'lname'=>$currentLead->lname,
                        'email'=>$currentLead->email,'user'=>$currentLead->consultant->usr,'fileno'=>$currentLead->fileno,
                    'status'=>$currentLead->status,'owned'=>$owned];
                }
            }
        return json_encode($found);
    }

    //Request new leads
    public function needMoreLeads()
    {
        $now_early = date("Y-m-d")." 00:00:00";
        $now =  date("Y-m-d h:i:s");
//        if(Assignment::where('reassignReason','NEED_MORE_LEADS')->where('created_at','>',$now_early)->where('consultant_id',$this->consultant->id)->count()<30)
//        {
            $robot = Consultant::where('usr','ROBOT')->first();
            $leads = Lead::where('consultant_id',$robot->id)->orderBy('created_at','DESC')->take(15)->get();
            foreach($leads as $lead)
            {
                $lead->consultant_id = $this->consultant->id;
                $lead->last = $now;
                $lead->status = "UNLOADED";
                $lead->save();
                Assignment::createAssignment($this->consultant->id,$lead->id,'REASSIGN',0,$lead->leadSource,"NEED_MORE_LEADS");
            }
            //Create Transaction
            Transaction::createTransaction($this->consultant->id, '', '', 'NEED-LEAD', '', '', '', '', '', '', '');
            return "1";
//        }
//        return "0";
    }

    public function updateLogsLead(){
        $id = Input::get('ID');
        $lead = Lead::find($id);
        if($lead!=null){
            echo json_encode($lead->lastTransactions());
        }
    }

    /*
    * Get MSG Templates
    */
    public function getLeadMsgTemplate()
    {
        $cName = $this->consultant->fname." ".$this->consultant->lname;
        $id = Input::get('ID');
        $lead = Lead::find($id);
        $name = $lead->fname." ".$lead->lname;
        $messages = Message::where(['type'=>'TEMPLATE','consultant_id'=>0])->get();

        $listMsg = array();
        foreach($messages as $msg){
            $text = str_replace("[name]",$name,$msg->text);
            $text = str_replace("[DID]",$this->consultant->did,$text);
            $text = str_replace("[fileno]",$lead->fileno,$text);
            $text = str_replace("[consultant name]",$cName,$text);
            $aux['TEXT'] = $text;
            $aux['TITLE'] = $msg->title;
            $listMsg[] = $aux;
        }
        return json_encode($listMsg);
    }
}
