<?php namespace App\Http\Controllers;


use App\Helpers\ToolsFunctions;
use App\Models\Lead;
use App\Models\Project;
use App\Models\Reply;
use App\Models\Ticket;
use App\Models\Inbox;
use App\Models\Transaction;
use App\Models\UploadedFiles;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use DB;
use Illuminate\Support\Facades\Session;

class TicketController extends Controller {


    /*
      * Current Client logged
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

    public function showCreateTicket(){
        $lead =$this->client;
        $projects = Project::where('lead_id',$lead->id)->get();
        $projectsAllowTickets=array();
        foreach($projects as $project){
            $lastContract = $project->lastContractNoWP();
            if($lastContract!=null)
            {
                if($project->lastContractPaid() != null)
                {
                    if(strlen($project->lastContractPaid()['SIGN']) >0)
                        $projectsAllowTickets[]=$project;

                }else if($project->lastContractWithPayment() != null && $project->lastContractWithPayment()->iigUpgrade == 1)
                    $projectsAllowTickets[]=$project;
            }
        }
        return view("omi.launch.ticket.createTicket",array('client'=>$lead,'projectsFromLead'=>$projectsAllowTickets));
    }

    public function showTickets(){
        // phase 2 is the closed one that's why those tickets dnt should appears
        $tickets = Ticket::where('lead_id',$this->client->id)->where('phase','<>',2)->get();
        $replies = array();
        foreach($tickets as $ticket){
            $repliesTicket = Reply::where('ticket_id',$ticket->id)->orderBy('created_at','ASC')->get();
            $replies [$ticket->id] = $repliesTicket;
        }
        return view("omi.launch.ticket.ticket",array('client'=>$this->client,'tickets'=>$tickets,'replies'=>$replies));
    }

    public function createTicket(){
        $name = Input::get('NAME');
        $pid = Input::get('PID');
        $message = Input::get('MESSAGE');
        $project =Project::find($pid);
        if($project!=null){
            $ticket = new Ticket();
            $ticket->name =$name;
            $ticket->project_id = $pid;
            $ticket->lead_id =$project->lead_id;
            $pcs = $project->clientServicesProject();
            if($pcs !=null && $pcs->ppaSent_created_at != ''){
                $ticket->receiver = 'cs';//the ticket go to client services
                $aux_id=25;
            }
            else{
                $ticket->receiver = 'production';
                $aux_id=30;
            }
            $ticket->save();
            $this->createReply($message,$ticket->id);

            $msgInbox = "A ticket was opened by the client.<br>".date("m-d-Y H:i:s")."<br>Client: " . $project->lead->fname . " " . $project->lead->lname .
                "<br>File #: " . $project->lead->fileno . "<br>Pin: " . $project->id."<br>Ticket Subject: ".$ticket->name.
                "<br><a href='".url('showTicketsToCS')."' target='_blank'>Manage Tickets</a>";
            Inbox::createInbox($project->lead->id,$aux_id, $msgInbox, "CLIENT TEXT", "CLIENT");
            //send email to george and clientservices or production
            $sent = ToolsFunctions::curl(url("emailTicket?TID=".$ticket->id."&TOCLIENT=0&RECEIVER=".$ticket->receiver));
            return $ticket->id;
        }else
            return -1;

    }

    public  function createReply($messageParam =null,$ticketId =-1){
        if($messageParam == null){
            $ticket_id = Input::get('TICKETID');
            $message = Input::get('MESSAGE');
        }else{
            $ticket_id = $ticketId;
            $message = $messageParam;
        }
        $ticket =Ticket::find($ticket_id);
        //create the replay
        $reply = new Reply();
        $reply->message =$message;
        $reply->ticket_id = $ticket_id;
        $reply->author = $ticket->lead->fname." ".$ticket->lead->lname;
        $reply->save();

        $project = $ticket->project;
        if($ticket->receiver == 'cs')
            $aux_id=25;
        else
            $aux_id=30;

        $replies = Reply::where('ticket_id',$ticket_id)->get();
        if(count($replies)>1){
            $msgInbox = "A ticket was updated by the client.<br>".date("m-d-Y H:i:s")."<br>Client: " . $project->lead->fname . " " . $project->lead->lname .
                "<br>File #: " . $project->lead->fileno . "<br>Pin: " . $project->id."<br>Ticket Subject: ".$ticket->name.
                "<br><a href='".url('showTicketsToCS')."' target='_blank'>Manage Tickets</a>";
            Inbox::createInbox($project->lead->id, $aux_id, $msgInbox, "CLIENT TEXT", "CLIENT");
            //send email to george and clientservices or production
            $sent = ToolsFunctions::curl(url("emailTicket?TID=".$ticket->id."&TOCLIENT=0&RECEIVER=".$ticket->receiver));
        }

        return json_encode(array($reply));
    }

    public function closeTicket(){
        $tid = Input::get('TID');
        $ticket = Ticket::find($tid);
        if($ticket!=null){
            $ticket->phase =2;
            $ticket->save();
            if($ticket->receiver == 'cs')
                $aux_id=25;
            else
                $aux_id=30;
            $project = $ticket->project;
            $msgInbox = "A ticket was closed by the client.<br>".date("m-d-Y H:i:s")."<br>Client: " . $project->lead->fname . " " . $project->lead->lname .
                "<br>File #: " . $project->lead->fileno . "<br>Pin: " . $project->id."<br>Ticket Subject: ".$ticket->name;
            Inbox::createInbox($project->lead->id, $aux_id, $msgInbox, "CLIENT TEXT", "CLIENT");
            ToolsFunctions::curl(url("emailClosedTicket?TID=".$tid."&FROM=2"));
            return $tid;
        }else
            return -1;
    }
}
