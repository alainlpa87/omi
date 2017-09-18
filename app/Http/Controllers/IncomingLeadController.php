<?php namespace App\Http\Controllers;

use App\Helpers\PlivoHelper;
use App\Models\Assignment;
use App\Models\Consultant;
use App\Models\Lead;
use App\Models\Project;
use App\Models\Transaction;
use Illuminate\Support\Facades\Input;
use DB;
use App\Helpers\ToolsFunctions;

class IncomingLeadController extends Controller {


    public function __construct(){
    }

    //receive leads from different LEADSOURCES and assign those to the consultants.
    public function index()
    {
        $fname = Input::get('first_name');
        $lname = Input::get('last_name');
        $phone = str_pad(preg_replace('/\D+/', '', Input::get("phone")), 11, '1', STR_PAD_LEFT);
        $phone2 = (Input::has("phone2") && Input::get("phone2") != "")?str_pad(preg_replace('/\D+/', '', Input::get("phone2")), 11, '1', STR_PAD_LEFT):"";
        $email = strtolower(urldecode(Input::get('email')));
        $street = Input::get('address1');
        $street2 = Input::get('address2');
        $city = Input::get('city');
        $state = Input::get('state');
        $zip = Input::get('postal_code');
        $notes = (Input::has("note"))?Input::get('note'):'';
        $patent = (Input::has("patent"))?Input::get('patent'):'';
        if(Input::get('vendor_id')=="lvn" || Input::get('vendor_id')=="TVM")
            $leadSource="LIVE-N";
        else
            $leadSource = ToolsFunctions::leadSource(Input::get('vendor_id'));

        //Transaction::createTransaction('', '', '', 'ENTRO: '.$fname, $lname, '', $email, '', '', $phone, '');

//Check Local.
        if(ToolsFunctions::isLocal($zip)){
            //crear el lead exclude, local 1, reason local y asignarlo a alain.
            $consultantId = 16;//alain
            $leadId = Lead::createLead('',$consultantId,$fname,$lname,$phone,$phone2,$email,$street,$street2,$city,$state,$zip,$notes,$leadSource,'1','LOCAL',$patent,'EXCLUDE');
            Assignment::createAssignment($consultantId,$leadId,'NEW',0,$leadSource,'LOCAL');
            return $leadId;
        }

//Check repeated.
        $leads = Lead::where('email', 'like',$email)
            ->orWhere('phone', 'like',$phone)
            ->orWhere('phone2', 'like',$phone)
            ->get(array('id', 'created_at'));
        if(count($leads) > 0) {
            $project = Project::where('lead_id', 'like', $leads[0]["id"])->count();
            if($project == 0){
                $creationDay = date("Y-m-d h:i:s",strtotime("30 days ago"));
                if($leads[0]["created_at"] < $creationDay){
                    //actualizar campos en el lead, poner otro fileno
                    $fileno = DB::table('lead')->max('fileno') + 1;
                    Lead::updateLead($leads[0]["id"],$fileno,'',$fname,$lname,$phone,$phone2,$email,$street,$street2,$city,$state,$zip,$notes,$leadSource,'','',$patent);
                    //create Transaction for Update Lead When Repeated.
                    Transaction::createTransaction('', $leads[0]["id"], '', 'LEAD-UPDATE-REPEATED', '', '', $email, '', '', $phone, '');
                    return $leads[0]["id"];
                }else{
                    return $leads[0]["id"];
                }
            }else{
                return $leads[0]["id"];
            }
        }

//Get $currentShift
        if(date('w',strtotime("now")) == 5 || date('w',strtotime("now")) == 6){
            $earlyEnd = strtotime("11pm");
            $lateStart = strtotime("2am");
            $lateEnd = strtotime("1am");
        }else{
            $earlyEnd = strtotime("2pm");
            $lateStart = strtotime("12pm");
            $lateEnd = strtotime("4am");
        }
        switch (strtotime("now")){
            case (strtotime("now") > $lateEnd && strtotime("now") < $lateStart):
                $currentShift = 'EARLY';
                break;

            case (strtotime("now") > $earlyEnd && strtotime("now") < strtotime('tomorrow')):
                $currentShift = 'LATE';
                break;

            case (strtotime("now") < $lateEnd):
                $currentShift = 'LATE';
                break;

            default:
                $currentShift = 'ALL';
        }

        //Select consultants
        if ((strpos(strtolower($fname),'test') !== false) || (strpos(strtolower($lname),'test') !== false)){
            //asignarlo a alain.
            $consultantId = 16;//alain
            $leadId = Lead::createLead('',$consultantId,$fname,$lname,$phone,$phone2,$email,$street,$street2,$city,$state,$zip,$notes,$leadSource,'','',$patent);
            return $leadId;
        }
        else{

//            invento pa que los incubator cojan 2 leads diarios una ves tengan 10 subs approved
//            $consultantId = '';
//            $consultants = Consultant::where('usr','like','%user_%')->get();
//            $lastAssignToIncubator = Transaction::where('transtype','LIKE','LEAD-INCUBATOR-ALL')->orderBy('created_at','DESC')->first();
//            if($lastAssignToIncubator != null){
//                foreach($consultants as $consultant){
//                    $cant = Request::whereBetween('updated_at', array($lastAssignToIncubator->created_at, Carbon::now()))->where('adminStage','LIKE','APPROVED')->count();
//                }
//            }

//            FIN de invento pa que los incubator cojan 2 leads diarios una ves tengan 10 subs approved


            //know if that was an extra lead or not [extra lead is because you exceed the amount for your group]
            $leadExtra = 0;
            //amount of leads per group [top(group 3) => 7, body(group 2) => 6, bottom(group 1) => 5]
            $cuantityGroup = [0,5,6,7];
            $availableCons = array();
            $amountOfLeads = array();

            $leadSourceC = $leadSource =="LIVE-N"?"live_n":$leadSource;
            if($currentShift == 'ALL'){
                $consultants = Consultant::where(['leads' => 1,$leadSourceC => 1,'active' => 1])->orderBy('score', 'desc')->get();
                foreach($consultants as $consultant){
                    $leadsToday = Assignment::where(['consultant_id' => $consultant->id,'status' => 'NEW'])->where('created_at','>',date("Y-m-d",strtotime("today"))." 00:00:00")->count();
                    if($leadsToday < $cuantityGroup[$consultant->group]){
                        $availableCons [] = $consultant->id;
                        $amountOfLeads [] = $leadsToday;
                    }
                }
            }else{
                //pull consultants from that shift and see if they can receive more leads.
                $consultants = Consultant::where(['leads' => 1,$leadSourceC => 1,'active' => 1,'shift' => $currentShift])->orderBy('score', 'desc')->get();
                foreach($consultants as $consultant){
                    $leadsToday = Assignment::where(['consultant_id' => $consultant->id,'status' => 'NEW'])->where('created_at','>',date("Y-m-d",strtotime("today"))." 00:00:00")->count();
                    if($leadsToday < $cuantityGroup[$consultant->group]){
                        $availableCons [] = $consultant->id;
                        $amountOfLeads [] = $leadsToday;
                    }
                }

                //if nobody from that shift can't receive more, pull consultants from the other shift and see if they can receive more leads.
                if (count($availableCons) == 0){
                    $alternativeShift = $currentShift == 'LATE'?'EARLY':'LATE';
                    $consultants = Consultant::where(['leads' => 1,$leadSourceC => 1,'active' => 1,'shift' => $alternativeShift])->orderBy('score', 'desc')->get();
                    foreach($consultants as $consultant){
                        $leadsToday = Assignment::where(['consultant_id' => $consultant->id,'status' => 'NEW'])->where('created_at','>',date("Y-m-d",strtotime("today"))." 00:00:00")->count();
                        if($leadsToday < $cuantityGroup[$consultant->group]){
                            $availableCons [] = $consultant->id;
                            $amountOfLeads [] = $leadsToday;
                        }
                    }
                }

                //if all the shift are full, pull all the consultants and assign fair.
                if (count($availableCons) == 0){
                    $leadExtra = 1;
                    $consultants = Consultant::where(['leads' => 1,$leadSourceC => 1,'active' => 1])->orderBy('score', 'desc')->get();
                    foreach($consultants as $consultant){
                        $leadsToday = Assignment::where(['consultant_id' => $consultant->id,'status' => 'NEW','leadExtra' => 1])->where('created_at','>',date("Y-m-d",strtotime("today"))." 00:00:00")->count();
                        $availableCons [] = $consultant->id;
                        $amountOfLeads [] = $leadsToday;
                    }
                }
            }


//variable para guardar el consultant q seria segunda opcion.
            $auxTop = 0;
//END OF variable para guardar el consultant q seria segunda opcion.

            $top = 0;
            for($i=count($amountOfLeads) - 1; $i >0; $i--){
                if($amountOfLeads[$i] < $amountOfLeads[$i-1]){
                    $auxTop = $top;
                    $top = $i;
                }
            }

//para que batson solo obtenga leads despues de las 6 pm
            /*if($availableCons[$top] == 22 && (date('H:i')<'18:00' || date('H:i')>'21:00')){
                $top = $auxTop;
            }*/
//END OF para que batson solo obtenga leads despues de las 6 pm

            $consultantId = $availableCons[$top];

            $notas = '';
            if(Input::has("campaign")){
                $notas = 'EMAIL CAMPAIGN';
                $consultantId = Input::get("campaign");
            }

            //crear el lead con el $consultantId
            $leadId = Lead::createLead('',$consultantId,$fname,$lname,$phone,$phone2,$email,$street,$street2,$city,$state,$zip,$notes,$leadSource,'','',$patent,'UNLOADED');

            //crear el assignment con el $leadExtra.
            Assignment::createAssignment($consultantId,$leadId,'NEW',$leadExtra,$leadSource,$notas);

            //send sms to consultant.
            PlivoHelper::consultantSmsOutPerLead($consultantId,$leadId);

            //crear Transaction.
            Transaction::createTransaction($consultantId, $leadId, '', 'LEAD-CREATED', '', '', $email, '', '', $phone, '');

            //send welcome email to the new lead. comentado el 4/13/2017 para ahorrar la cantidad de emails que se estan mandando
//            if(!Input::has("campaign")){
//                $consultant = Consultant::find($consultantId);
//                file_get_contents("https://www.ownmyinvention.com/3.0/app/Helpers/BME/sendBMEmail.php?TYPE=SUBKIT&EMAIL=".$email."&CONPHONE=".$consultant->did."&CONNAME=".urlencode($consultant->fname." ".$consultant->lname));
//            }

            print $leadId;
        }
    }

}

