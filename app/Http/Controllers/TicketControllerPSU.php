<?php namespace App\Http\Controllers;


use App\Helpers\ToolsFunctions;
use App\Models\Consultant;
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

class TicketControllerPSU extends Controller {


    /*
      * Current Client logged
      */
    public $consultant;
    /*
     * To Allow use the controller methods the current user logged has to be Client
     */
    public function __construct()
    {
        $this->middleware('consultant');
        $this->middleware(function ($request, $next) {
            $this->consultant = Consultant::find(Session::get('user_id'));
            return $next($request);
        });
    }


    public function showTicketsToCS(){

        $tickets = Ticket::where('phase','<>',2)->groupBy('project_id')->get();//where('receiver','cs')->

        $total_inbox = Inbox::where(['consultant_id'=>$this->consultant->id,'status'=>0])->count();
        return view("intranet.ticket.ticketsView",array('consultant'=>$this->consultant, 'total_inbox'=>$total_inbox,'projectsWithTicket'=>$tickets));
    }

    public function showTicketsFromProject(){
        $pin = Input::get('PID');
        $tickets = Ticket::where('phase','<>',2)->where('project_id',$pin)->get();//where('receiver','cs')->


        if($tickets == null)
            return -1;
        $ticketsToLoaded = array();
        foreach($tickets as $ticket){
            //change the phase of the ticket to "at process"
            $ticket->phase =1;
            $ticket->save();
            if($ticket->receiver == 'cs')
                $ticketsToLoaded[]=array('cs',$this->paintTicketPSU($ticket->id));
            elseif($ticket->receiver == 'production')
                $ticketsToLoaded[]=array('production',$this->paintTicketPSU($ticket->id));
        }
        echo json_encode($ticketsToLoaded);
    }

    public  function createReplyPSU(){
        $ticket_id = Input::get('TICKETID');
        $message = Input::get('MESSAGE');
        if($this->consultant->usr == 'clientservices')
            $author = 'Client Services';
        elseif($this->consultant->usr == 'production')
            $author = 'Production';
        else
            $author = 'Unknow';

        //create the replay
        $reply = new Reply();
        $reply->message =$message;
        $reply->ticket_id = $ticket_id;
        $reply->author = $author;
        $reply->save();

        $sent = ToolsFunctions::curl(url("emailTicket?TID=".$ticket_id."&TOCLIENT=1&RECEIVER="));
        return json_encode(array($reply));
    }

    public function paintTicketPSU($id)
    {
        $view = ToolsFunctions::curl(url("paintTicket?ID=$id"));
        return $view;
    }

    public function closeTicketPSU(){
        $tid = Input::get('TID');
        $ticket = Ticket::find($tid);
        if($ticket!=null){
            $ticket->phase =2;
            $ticket->save();
            ToolsFunctions::curl(url("emailClosedTicket?TID=".$tid."&FROM=1"));
            return $tid;
        }else
            return -1;
    }
}
