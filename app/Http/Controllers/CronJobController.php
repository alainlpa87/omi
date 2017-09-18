<?php namespace App\Http\Controllers;

use App\Helpers\PlivoHelper;
use App\Helpers\ToolsFunctions;
use App\Models\Consultant;
use App\Models\ConsultantBoard;
use App\Models\ConsultantHours;
use App\Models\ConsultantSchedule;
use App\Models\ConsultantScore;
use App\Models\Contract;
use App\Models\Ilc;
use App\Models\IlcNotes;
use App\Models\IlcVendors;
use App\Models\Lead;
use App\Models\Project;
use App\Models\ProjectClientServices;
use App\Models\ProjectProduction;
use App\Models\Request;
use App\Models\Submission;
use App\Models\Transaction;
use App\Models\AttClientServices;
use App\Models\Inbox;
use App\Models\ClientSDocs;
use App\Models\ClientSNotes;
use App\Helpers\SendEmailHelper;
use Illuminate\Support\Facades\App;
use DB;

class CronJobController extends Controller {



    public function __construct(){

    }

    /*
     * reset the consultant's ability to receive sms when they get new leads
    */
    public function resetLeadNoti(){
        Consultant::where('leadNotiOpt', '=', 1)->update(['leadNoti' => 1]);
    }

    /*
     * (Stale) finish projects that client leave INCOMPLETE 30 min ago.
    */
    public function finishProjects(){

        $project = Project::where('status','INCOMPLETE')->where('created_at','<',date('Y-m-d H:i:s', strtotime('-30 minutes')))->first();
        if($project != null) {
            //update and finish project.
            $project->status = 'UNLOADED';
            $project->save();
            //create the row in submission to keep record.
            Submission::createSubmission($project->id,$project->consultant_id,'NEW',$project->lead->leadSource,'CRONJOB');
            //create request to admin for approval
            $requestAdmin = new Request();
            $requestAdmin->project_id = $project->id;
            $requestAdmin->request = "ADMIN";
            $requestAdmin->consultantStage = "APPROVE";
            $requestAdmin->save();
        }
    }

    /*
     * leads without projects and 21 days without call go to robot. (without appointments -> next release)
    */
    public function makeLeadsRobot(){
        $leads = Lead::where('status','NOT LIKE','EXCLUDE')->where('last','<',date('Y-m-d H:i:s', strtotime('-21 days')))->where('last','NOT LIKE','0000-00-00 00:00:00')->where('consultant_id','NOT LIKE',1)->get();
        $ids = "";
        foreach($leads as $lead){
            if($lead->projects->count() == 0){
                $lead->auxConsultant = $lead->consultant_id;
                $lead->consultant_id = 1;
                $lead->save();
                $ids .= strlen($ids) > 0 ? "," : "";
                $ids .= $lead->id;
            }
        }
        //Create Transaction
        Transaction::createTransaction('', '', '', 'MAKE-LEADS-ROBOT', $ids, '', '', '', '', '', '');
    }

    /*
     * delete IMG with two days without payments.
    */
    public function deleteImgAfter2daysWithoutPaid(){
        $contracts = Contract::where('paid','=',0)->where('type','=','IMG')->where('created_at','<',date('Y-m-d H:i:s', strtotime('-2 days')))->get();
        $projectIds = "";
        foreach($contracts as $contract){
            $projectIds .= strlen($projectIds) > 0 ? "," : "";
            $projectIds .= $contract->project_id;
            $contract->delete();
        }
        //Create Transaction
        Transaction::createTransaction('', '', '', 'DELETE-IMG-AFTER-2DAYS', $projectIds, '', '', '', '', '', '');
    }

    /*
     * delete IIG Upgrades after two weeks without payments.
    */
    public function deleteIigUpgradesAfter2WeeksWithoutPaid(){
        $contracts = Contract::where('type','=','IIG')->where('iigUpgrade','=',1)->where('created_at','<',date('Y-m-d H:i:s', strtotime('-15 days')))->get();
        $contractIds = "";
        foreach($contracts as $contract){
            $contractIds .= strlen($contractIds) > 0 ? "," : "";
            $contractIds .= $contract->id;

            $contract->iigUpgrade = 0;
            $contract->price = $contract->paid;
            $contract->save();
        }
        //Create Transaction
        Transaction::createTransaction('', '', '', 'DELETE-IIG-UPGRADE-AFTER-2WEEKS', $contractIds, '', '', '', '', '', '');
    }

    /*
     * sent upgrade contract (IGUP) after 5 days of the IMG payment.
    */
    public function sendUpgradeAfter1Days(){
        $contracts = Contract::where('paidDate','<=',date('Y-m-d H:i:s', strtotime('-1 days')))->where('paidDate','>=',date('Y-m-d H:i:s', strtotime('-5 days')))->where('type','IMG')->where('signedDate','<=',date('Y-m-d H:i:s', strtotime('-1 days')))->whereRaw('price = paid')->get();
        $projectIds = "";
        foreach($contracts as $contract){
            $igup = Contract::where(['project_id'=>$contract->project_id,'type'=>'IGUP'])->first();
            if($igup == null){
                $projectIds .= strlen($projectIds) > 0 ? "," : "";
                $projectIds .= $contract->project_id;
                $iig = Contract::where(['project_id'=>$contract->project_id,'type'=>'IIG'])->first();
                $price = ($iig?$iig->price:879) - $contract->price;
                ToolsFunctions::curl(url("reviewPDF?ID=".$contract->project_id."&TYPE=IGUP&PRICE=".$price));
                ToolsFunctions::curl(url("saveContract?ID=".$contract->project_id."&TYPE=IGUP&REQUEST=EMAIL&SEND=1&PRICE=".$price));
            }
        }
        //Create Transaction
        Transaction::createTransaction('', '', '', 'SEND-IGUP-AFTER-1DAYS', $projectIds, '', '', '', '', '', '');
        print $projectIds;
    }

    /*
     * sent Welcome Package (WP) after 7 days of the IMG payment or 7 days after IIG payment or 1 day after IGUP payment(if the IMG payment was 7 days or more ago).
    */
    public function sendWelcomePackages(){
        $projectIds = "";

        //IGUP Cases
        $igup = Contract::where('paidDate','<=',date('Y-m-d H:i:s', strtotime('-1 days')))->where('paidDate','>=',date('Y-m-d H:i:s', strtotime('-9 days')))->where('signedDate','<=',date('Y-m-d H:i:s', strtotime('-1 days')))->where('type','IGUP')->whereRaw('price = paid')->get();
        foreach($igup as $contract){
            $countIMG = Contract::where(['project_id'=>$contract->project_id,'type'=>'IMG'])->where('paidDate','<=',date('Y-m-d H:i:s', strtotime('-7 days')))->where('signedDate','<=',date('Y-m-d H:i:s', strtotime('-7 days')))->whereRaw('price = paid')->count();
            if($countIMG > 0){
                $countWP = Contract::where(['project_id'=>$contract->project_id,'type'=>'WP'])->where('updated_at','>',date('Y-m-d H:i:s',strtotime($contract->paidDate)))->count();
                if($countWP == 0) {
                    $projectIds .= strlen($projectIds) > 0 ? "," : "";
                    $projectIds .= $contract->project_id;
                    ToolsFunctions::curl(url("reviewPDF?ID=" . $contract->project_id . "&TYPE=WP&PRICE=0"));
                    ToolsFunctions::curl(url("saveContract?ID=" . $contract->project_id . "&TYPE=WP&REQUEST=EMAIL&PRICE=0&SEND=1"));
                }
            }

        }
        //IMG Cases
        $img = Contract::where('paidDate','<=',date('Y-m-d H:i:s', strtotime('-7 days')))->where('paidDate','>=',date('Y-m-d H:i:s', strtotime('-9 days')))->where('signedDate','<=',date('Y-m-d H:i:s', strtotime('-7 days')))->where('type','IMG')->whereRaw('price = paid')->get();
        foreach($img as $contract){
            $countWP = Contract::where(['project_id'=>$contract->project_id,'type'=>'WP'])->count();
            if($countWP == 0) {
                $projectIds .= strlen($projectIds) > 0 ? "," : "";
                $projectIds .= $contract->project_id;
                ToolsFunctions::curl(url("reviewPDF?ID=" . $contract->project_id . "&TYPE=WP&PRICE=0"));
                ToolsFunctions::curl(url("saveContract?ID=" . $contract->project_id . "&TYPE=WP&REQUEST=EMAIL&PRICE=0&SEND=1"));
            }
        }

        //IIG Cases
        $iig = Contract::where('paidDate','<=',date('Y-m-d H:i:s', strtotime('-7 days')))->where('paidDate','>=',date('Y-m-d H:i:s', strtotime('-9 days')))->where('signedDate','<=',date('Y-m-d H:i:s', strtotime('-7 days')))->where('type','IIG')->whereRaw('price = paid')->get();
        foreach($iig as $contract){
            $countWP = Contract::where(['project_id'=>$contract->project_id,'type'=>'WP'])->count();
            if($countWP == 0) {
                $projectIds .= strlen($projectIds) > 0 ? "," : "";
                $projectIds .= $contract->project_id;
                ToolsFunctions::curl(url("reviewPDF?ID=" . $contract->project_id . "&TYPE=WP&PRICE=0"));
                ToolsFunctions::curl(url("saveContract?ID=" . $contract->project_id . "&TYPE=WP&REQUEST=EMAIL&PRICE=0&SEND=1"));
            }
        }
        //Create Transaction
        Transaction::createTransaction('', '', '', 'SEND-WELCOME-PACKAGE', $projectIds, '', '', '', '', '', '');
    }

    /*
     * Change the active week in the consultant schedule to the other and clean it to start the week
    */
    public function changeWeek()
    {
        ConsultantSchedule::where('activeWeek', 0)->update(['hInsideMade' => 0,'hOutsideMade' => 0,'lastLogin' => "",'lastLogout' => "",'mondayOntime' => 0]);
        ConsultantSchedule::where('activeWeek', 1)->update(['activeWeek' => 2]);
        ConsultantSchedule::where('activeWeek', 0)->update(['activeWeek' => 1]);
        ConsultantSchedule::where('activeWeek', 2)->update(['activeWeek' => 0]);
        $schedules = ConsultantSchedule::where('activeWeek',0)->get();
        foreach($schedules as $cSchedule)
        {
            $consultantHours = new ConsultantHours();
            $consultantHours->consultant_id = $cSchedule->consultant_id;
            $consultantHours->hInsideMade = $cSchedule->hInsideMade;
            $consultantHours->hOutsideMade = $cSchedule->hOutsideMade;
            $consultantHours->save();
        }
    }
    /*
     * Update stats every one hour with the calls, subs and solds for every consultant in this month
    */
    public function updateStats()
    {
        $thisMonthDate = date("Y-m")."-01 00:00:00";
        $thisMonthDateStart = date("Y-m-d H:i:s", strtotime("-8 hours", strtotime($thisMonthDate)));
        $to=date("Y-m-d H:i:s", strtotime("+1 month", strtotime($thisMonthDate)));
        $thisMonthDateEnd =date("Y-m-d H:i:s", strtotime("-8 hours", strtotime($to)));
        $consultants = Consultant::where('rol','like','%,score%')->get();
        $subsArray = array();
        $contsArray = array();
        $ph1sArray = array();
        $imgsArray = array();
        foreach($consultants as $consultant)
        {
            $subsArray[$consultant->id]=0;
            $contsArray[$consultant->id]=0;
            $ph1sArray[$consultant->id]=0;
            $imgsArray[$consultant->id]=0;
        }

        /*$requests = Request::where(['consultantStage'=>'APPROVE','adminStage'=>'APPROVED'])->where('updated_at','>=',$thisMonthDateStart)->where('updated_at','<=',$thisMonthDateEnd)->get();
        foreach($requests as $request)
        {
            $firstRequest = Request::where(['consultantStage'=>'APPROVE','adminStage'=>'APPROVED','project_id'=>$request->project_id])->orderBy('created_at','ASC')->first();
            if($firstRequest==null||$firstRequest->id==$request->id)
                if($request->project && array_key_exists($request->project->consultant_id,$subsArray))
                {
                    $assignment = Submission::where('project_id',$request->project_id)->where('status','NEW')->where('consultant_id',$request->project->consultant_id)->first();
                    if($assignment!=null)
                        $subsArray[$request->project->consultant_id]++;
                }
        }*/

        foreach($consultants as $consultant)
        {
            $requests = Request::where(['consultantStage'=>'APPROVE','adminStage'=>'APPROVED'])->where('updated_at','>=',$thisMonthDateStart)->where('updated_at','<=',$thisMonthDateEnd)->where('consultant_id','like',$consultant->id)->get();
            foreach($requests as $request)
            {
                $firstRequest = Request::where(['consultantStage'=>'APPROVE','adminStage'=>'APPROVED','project_id'=>$request->project_id])->orderBy('created_at','ASC')->first();
                if($firstRequest==null||$firstRequest->id==$request->id)
                    $subsArray[$consultant->id]++;
            }
        }

        $contracts = Contract::where('created_at','>=',$thisMonthDateStart)->where('created_at','<=',$thisMonthDateEnd)->get();
        foreach($contracts as $contract)
        {
            $firstRequest = Request::where(['consultantStage'=>'APPROVE','adminStage'=>'APPROVED','project_id'=>$contract->project_id])->orderBy('created_at','ASC')->first();
            if($firstRequest!=null)
            {
                $dateRequest = new \DateTime($firstRequest->updated_at);
                $dateContract = new \DateTime($contract->created_at);
                $intervalD = $dateContract->diff($dateRequest)->d;
                $intervalM = $dateContract->diff($dateRequest)->m;
                if($intervalD<=14 && $intervalM==0 && $contract->project && $contract->id == $contract->project->firstContract()->id && array_key_exists($contract->consultant_id,$contsArray))
                    $contsArray[$contract->consultant_id]++;
            }
        }
        $contracts = Contract::whereRaw('price = paid')->where('signedDate','>=',$thisMonthDateStart)->where('paidDate','>=',$thisMonthDateStart)->get();
        foreach($contracts as $contract)
        {
            if($contract->project)
            {
                if($contract->type=="IIG" && array_key_exists($contract->consultant_id,$ph1sArray))
                    $ph1sArray[$contract->consultant_id]++;
                else if(($contract->type=="IMG"||$contract->type=="IGUP") && array_key_exists($contract->consultant_id,$imgsArray))
                    $imgsArray[$contract->consultant_id]++;
            }
        }
        //contra los IIG UPGRADES AS SOLD
        $contractsIIGUpgrades = Contract::whereRaw('price != paid')->where('signedDate','>=',$thisMonthDateStart)->where('paidDate','>=',$thisMonthDateStart)->where('iigUpgrade','=',1)->get();
        foreach($contractsIIGUpgrades as $contract){
            if($contract->project){
                if($contract->type=="IIG" && array_key_exists($contract->consultant_id,$ph1sArray)){
                    $ph1sArray[$contract->consultant_id]++;
                }
            }
        }
        //END OF count IIG UPGRADES AS SOLD

        foreach($consultants as $consultant)
        {
            $consultantBoard = ConsultantBoard::where('consultant_id',$consultant->id)->orderBy('created_at','DESC')->first();
            if($consultantBoard == null)
                $consultantBoard = new ConsultantBoard();
            else
            {
                $date = new \DateTime($consultantBoard->created_at);
                if($date->format("Y-m")!=date("Y-m"))
                    $consultantBoard = new ConsultantBoard();
            }
            $consultantBoard->consultant_id = $consultant->id;
            $consultantBoard->calls = Transaction::where(['consultant_id'=>$consultant->id,'transtype'=>'CALL'])->where('created_at','>=',$thisMonthDate)->distinct('phone')->count();
            $consultantBoard->subs = $subsArray[$consultant->id];
            $consultantBoard->cont = $contsArray[$consultant->id];
            $consultantBoard->ph1 = $ph1sArray[$consultant->id];
            $consultantBoard->img = $imgsArray[$consultant->id];
            $consultantBoard->save();
        }
    }
    /*
     * Update score once a day for every consultant
    */
    public function updateScores()
    {
        $today = date("Y-m-d")." 00:00:00";
        $today = date("Y-m-d H:i:s", strtotime("-24 hours", strtotime($today)));
        $consultants = Consultant::where('rol','like','%,score%')->where('leads',1)->get();
        $subsArray = array();
        $contsArray = array();
        $salesArray = array();
        foreach($consultants as $consultant)
        {
            $subsArray[$consultant->id]=0;
            $contsArray[$consultant->id]=0;
            $salesArray[$consultant->id]=0;
        }

        $requests = Request::where(['consultantStage'=>'APPROVE','adminStage'=>'APPROVED'])->where('updated_at','>=',$today)->get();
        foreach($requests as $request)
        {
            $firstRequest = Request::where(['consultantStage'=>'APPROVE','adminStage'=>'APPROVED','project_id'=>$request->project_id])->orderBy('created_at','ASC')->first();
            if($firstRequest==null||$firstRequest->id==$request->id)
                if($request->project  && array_key_exists($request->project->consultant_id,$subsArray))
                {
                    $assignment = Submission::where('project_id',$request->project_id)->where('status','NEW')->where('consultant_id',$request->project->consultant_id)->first();
                    if($assignment!=null)
                        $subsArray[$request->project->consultant_id]++;
                }
        }

        $contracts = Contract::where('created_at','>=',$today)->get();
        foreach($contracts as $contract)
        {
            $firstRequest = Request::where(['consultantStage'=>'APPROVE','adminStage'=>'APPROVED','project_id'=>$contract->project_id])->orderBy('created_at','ASC')->first();
            if($firstRequest!=null)
            {
                $dateRequest = new \DateTime($firstRequest->updated_at);
                $dateContract = new \DateTime($contract->created_at);
                $intervalD = $dateContract->diff($dateRequest)->d;
                $intervalM = $dateContract->diff($dateRequest)->m;
                if($intervalD<=14 && $intervalM==0 &&  $contract->project && $contract->id == $contract->project->firstContract()->id && array_key_exists($contract->consultant_id,$contsArray))
                    $contsArray[$contract->consultant_id]++;
            }
        }
        $contracts = Contract::whereRaw('price = paid')->where('signedDate','>=',$today)->where('paidDate','>=',$today)->get();
        foreach($contracts as $contract)
        {
            if($contract->project  && array_key_exists($contract->consultant_id,$salesArray))
            {
                $salesArray[$contract->consultant_id]++;
            }
        }

        //contra los IIG UPGRADES AS SOLD
        $contractsIIGUpgrades = Contract::whereRaw('price != paid')->where('signedDate','>=',$today)->where('paidDate','>=',$today)->where('iigUpgrade','=',1)->get();
        foreach($contractsIIGUpgrades as $contract){
            if($contract->project  && array_key_exists($contract->consultant_id,$salesArray)){
                $salesArray[$contract->consultant_id]++;
            }
        }
        //END OF count IIG UPGRADES AS SOLD

        foreach($consultants as $consultant)
        {
            $consultantScore = new ConsultantScore();
            $consultantScore->consultant_id = $consultant->id;
            $consultantScore->approvedPoint = $subsArray[$consultant->id]*15;
            $consultantScore->contractPoint = $contsArray[$consultant->id]*15;
            $consultantScore->salesPoint = $salesArray[$consultant->id]*75;
            $consultantScore->total = $consultantScore->approvedPoint+$consultantScore->contractPoint+$consultantScore->salesPoint;
            $consultantScore->save();
        }
        $moreThan15days = date("Y-m-d H:i:s", strtotime("-15 days", strtotime($today)));
        DB::table('consultant_score')->where('created_at', '<', $moreThan15days)->delete();

        //update consultant score and group
        $startCounting = date("Y-m-d H:i:s", strtotime("-14 days", strtotime($today)));
        $max = 1;
        $scores = array();
        $maxs=array();
        $mins=array();
        foreach($consultants as $consultant)
        {
            $total=0;
            $consultanScores = ConsultantScore::where('consultant_id',$consultant->id)->where('created_at','>=',$startCounting)->get();
            foreach($consultanScores as $score)
                $total+=$score->total;
            $max = $total > $max ? $total : $max;
            if(count($maxs)<4)
                $maxs[]=$total;
            else
            {
                $minS = min($maxs);
                if($minS<$total)
                    $maxs[array_search($minS,$maxs)]=$total;
            }
            if(count($mins)<3)
                $mins[]=$total;
            else
            {
                $maxS = max($mins);
                if($maxS>$total)
                    $mins[array_search($maxS,$mins)]=$total;
            }
            $scores[$consultant->id] = $total;
        }
        foreach($consultants as $consultant)
        {
            $consultant->score = $scores[$consultant->id]*100/$max;
            if(array_search($scores[$consultant->id],$maxs)!== false)
            {
                $consultant->group = 3;
                unset($maxs[array_search($scores[$consultant->id],$maxs)]);
            }
            else if(array_search($scores[$consultant->id],$mins)!== false)
            {
                $consultant->group = 1;
                unset($mins[array_search($scores[$consultant->id],$mins)]);
            }
            else
                $consultant->group = 2;
            $consultant->save();
            print $consultant->id."<br>";
        }
    }

    public function takeOldLeadsToUseAsNew(){

        $onOldLeads = Consultant::where(['oldleadslikenew' => 1,'active' => 1])->get();
        $total = count($onOldLeads);
        if($total != 0){
            $storeUser = Consultant::where('usr','oldleadslikenew')->first();
            $cant = 0;
            $leads = Lead::where('status','NOT LIKE','EXCLUDE')->where('last','<',date('Y-m-d H:i:s', strtotime('-10 days')))->where('last','NOT LIKE','0000-00-00 00:00:00')->where('consultant_id','NOT LIKE',1)->orderBy('created_at','DESC')->get();
            foreach($leads as $lead){
                if($cant == $total*10)
                    break;
                if($lead->projects->count() == 0){
                    $lead->auxConsultant = $lead->consultant_id;
                    $lead->consultant_id = $storeUser->id;
                    $lead->status = "UNLOADED";
                    $lead->flag = "clear";
                    $lead->reason = "";
                    $lead->notes = "";
                    $lead->last = "0000-00-00 00:00:00";
                    $lead->save();
                    Transaction::where('lead_id',$lead->id)->delete();
                    $cant++;
                }
            }
        }
    }

    public function assignOldLeadsAsNew(){
        if (date("H") > 9 && date("H") < 15){
            $onOldLeads = Consultant::where(['oldleadslikenew' => 1,'active' => 1])->get();
            if(count($onOldLeads) != 0){
                $storeUser = Consultant::where('usr','oldleadslikenew')->first();
                foreach($onOldLeads as $takeFrom){
                    $leads = Lead::where(['consultant_id'=>$storeUser->id])->where('auxConsultant','NOT LIKE',$takeFrom->id)->take(2)->get();
                    if(count($leads)>0){
                        ToolsFunctions::reassignLead($leads[0]->id,$takeFrom->id,'CRON OLD LIKE NEW','assignOldLeadsAsNew');
                        //send sms to consultant.
                        PlivoHelper::consultantSmsOutPerLead($takeFrom->id,$leads[0]->id);

                        ToolsFunctions::reassignLead($leads[1]->id,$takeFrom->id,'CRON OLD LIKE NEW','assignOldLeadsAsNew');
                        //send sms to consultant.
                        PlivoHelper::consultantSmsOutPerLead($takeFrom->id,$leads[1]->id);
                    }
                }
            }

            //more than 21 days leads
            $onOldLeads21 = Consultant::where(['oldleads21' => 1,'active' => 1])->get();
            if(count($onOldLeads21) != 0){
                foreach($onOldLeads21 as $takeFrom21){
                    $robot = Consultant::where('usr','ROBOT')->first();
                    $leads = Lead::where('consultant_id',$robot->id)->where('auxConsultant','NOT LIKE',$takeFrom21->id)->orderBy('created_at','DESC')->take(2)->get();
                    foreach($leads as $lead){
                        $lead->status = "UNLOADED";
                        $lead->flag = "clear";
                        $lead->reason = "";
                        $lead->notes = "";
                        $lead->last = "0000-00-00 00:00:00";
                        $lead->save();
                        Transaction::where('lead_id',$lead->id)->delete();
                        ToolsFunctions::reassignLead($lead->id,$takeFrom21->id,'CRON OLD LIKE NEW 21','assignOldLeadsAsNew21');
                        //send sms to consultant.
                        PlivoHelper::consultantSmsOutPerLead($takeFrom21->id,$lead->id);
                    }
                }
            }

        }
    }

    /****************************VENDORS CRON JOBS*************************************/


    /*
     * change project vendor to late (completed = 3).
    */
    public function vendorsProjectsLate(){
        $university = ProjectProduction::where(['completed'=>0,'typeVendor'=>'university'])->where('sendDate','<',date('Y-m-d H:i:s', strtotime('-5 days')))->get();
        $designer = ProjectProduction::where(['completed'=>0,'typeVendor'=>'designer'])->where('sendDate','<',date('Y-m-d H:i:s', strtotime('-20 days')))->get();
        $writer = ProjectProduction::where(['completed'=>0,'typeVendor'=>'writer'])->where('sendDate','<',date('Y-m-d H:i:s', strtotime('-7 days')))->get();
        $attorneyjh = ProjectProduction::where(['completed'=>0,'typeVendor'=>'attorneyjh'])->where('sendDate','<',date('Y-m-d H:i:s', strtotime('-10 days')))->get();
        $attorneyjk = ProjectProduction::where(['completed'=>0,'typeVendor'=>'attorneyjk'])->where('sendDate','<',date('Y-m-d H:i:s', strtotime('-14 days')))->get();
        $designer2d = ProjectProduction::where(['completed'=>0,'typeVendor'=>'2d'])->where('sendDate','<',date('Y-m-d H:i:s', strtotime('-21 days')))->get();

        $projectsLate = '';
        $lates = array_merge($university,$designer,$writer,$attorneyjh,$attorneyjk,$designer2d);

        foreach($lates as $vendorProject){
            $vendorProject->completed = 3;
            $vendorProject->save();
            $production = ProjectProduction::where(['project_id'=>$vendorProject->project_id,'typeVendor'=>'production'])->first();
            $production->completed = 3;
            $production->save();
            //save id of lates
            $projectsLate .= strlen($projectsLate) > 0 ? "," : "";
            $projectsLate .= $vendorProject->id;

            //email the vendor
            file_get_contents(url("overdueFilesVendor?FILE=".$vendorProject->id));
        }
        //Create Transaction
        Transaction::createTransaction('', '', '', 'PROJECTS-VENDORS-LATE', $projectsLate, '', '', '', '', '', '');
    }


    /****************************CLIENT SERVICES CRON JOBS*************************************/
    /*
     * check the conditions to project overdue
     */
    public function checkForOverDue(){
        /***********Patent App Overdue***********/
        $clientS = Consultant::where('usr','clientservices')->first();
        //check if it's been 56 days since it was sent to attorney
        $pinsOverdue="";// array pa almacenar los pins y ponerlos en el transaction como params

        //for 'DESIGN','PROV','UT'
        $attCS=AttClientServices::where('completed',0)->whereIn('type', ['DESIGN','PROV','UT'])->where('created_at','<',date('Y-m-d H:i:s', strtotime('-56 days')))->get();
        foreach($attCS as $attcs){
            //si el patent app no se ha enviado al client (no se ha recibido del attorney)
            if($attcs->projectclientservices != null){
                if(($attcs->type == 'DESIGN' && $attcs->projectclientservices->appSentD_created_at == '0000-00-00 00:00:00')||(($attcs->type == 'UT' || $attcs->type == 'PROV') && $attcs->projectclientservices->appSent_created_at == '')){
                    $overDueFiles[] = $attcs;
                }
            }
        }

        //for 'UPG_UT'
        $attCS=AttClientServices::where('completed',0)->where('type', 'UPG_UT')->where('dueDate','<',date('Y-m-d H:i:s'))->get();
        foreach($attCS as $attcs){
            //si el patent app no se ha enviado al client (no se ha recibido del attorney)
            if($attcs->projectclientservices != null){
                $overDueFiles[] = $attcs;
            }
        }

        foreach ($overDueFiles as $attDue){
            $attDue->completed = 3; //cambia el estado a overdue
            $attDue->overDueReason = "Attorney overdue"; //razon del overdue
            $attDue->beforeDue = "normal";  // to know the state anterior al overdue
            $attDue->stateChangedDate = date('Y-m-d 00:00:00');
            $attDue->save();
            $pcs = ProjectClientServices::find($attDue->projectclientservices_id);
            //si no sta cerrado el project client services cambiarle el estado a overdue
            if ($pcs != null && $pcs->completed != 4 && $pcs->completed != 5) {
                $pcs->completed = 3;
                $pcs->overDueReason = "Attorney overdue";
                $pcs->save();
                $pinsOverdue = ",".$pcs->project_id;

                $lead = Lead::find($attDue->lead_id);
                $msgInbox = "Project Overdue by attorney.<br>" . date("m-d-Y H:i:s") . "<br>" . "File #: " . $lead->fileno . "PIN: " . $pcs->project_id;
                Inbox::createInbox($attDue->lead_id, $clientS->id, $msgInbox, "CLIENT SERVICES", "CLIENT");
                Inbox::createInbox($attDue->lead_id, $attDue->consultant_id, $msgInbox, "CLIENT SERVICES", "CLIENT");
                $csNote = new ClientSNotes();
                $csNote->notes = "File overdue by attorney.";
                $csNote->projectclientservices_id = $pcs->id;
                $csNote->save();
            }
        }

        /***************Revisions And Filing Overdue******************/
        $attCS=AttClientServices::where('completed',2)->where('stateChangedDate','<',date('Y-m-d 00:00:00', strtotime('-2 weeks')))->orWhere(function($query){
            $query->where('completed',4)->where('stateChangedDate','<',date('Y-m-d 00:00:00', strtotime('-2 weeks')));
        })->get();;
        foreach($attCS as $attcs){
            $pcs = ProjectClientServices::find($attcs->projectclientservices_id);
            if ($pcs != null && $pcs->completed != 4 && $pcs->completed != 5) {
                if($attcs->completed == 2){
                    $pcs->overDueReason = "Attorney Revisions Overdue";
                    $attcs->overDueReason = "Attorney Revisions Overdue";
                    $attcs->beforeDue = "revisions";
                }
                else{
                    $pcs->overDueReason = "Patent Filing Overdue";
                    $attcs->overDueReason = "Patent Filing Overdue";
                    $attcs->beforeDue = "filing";
                }
                $pcs->completed = 3;
                $pcs->save();
                $attcs->completed = 3;
                $attcs->stateChangedDate = date('Y-m-d 00:00:00');
                $attcs->save();
                $pinsOverdue = ",".$pcs->project_id;

                $lead = Lead::find($attcs->lead_id);
                $msgInbox = "Project Overdue by attorney.<br>" . date("m-d-Y H:i:s") . "<br>" . "File #: " . $lead->fileno . "PIN: " . $pcs->project_id;
                Inbox::createInbox($attcs->lead_id, $clientS->id, $msgInbox, "CLIENT SERVICES", "CLIENT");
                Inbox::createInbox($attcs->lead_id, $attcs->consultant_id, $msgInbox, "CLIENT SERVICES", "CLIENT");
                $csNote = new ClientSNotes();
                $csNote->notes = "File overdue by attorney.";
                $csNote->projectclientservices_id = $pcs->id;
                $csNote->save();
            }
        }
        if($pinsOverdue != "")
            Transaction::createTransaction('','','','PROJECT_OVERDUE_BY_ATT',$pinsOverdue,'','','','','','');
        /***********END of Patent App Overdue***********/


        /****************Documents sent to client and not signed yet*********PSA & DDR********/
        $msgCS = "DOCUMENTS WITH MORE THAN 5 DAYS WITHOUT SIGNATURE:<br>".date("m-d-Y H:i:s");
        $docs_without_sign = ClientSDocs::where('file_id',-1)->where('belong_PA',0)->get();
        foreach($docs_without_sign as $doc){
            $pcs = $doc->projectclientservices;
            if($pcs !=null && $pcs->ddrReceived_created_at == '' && $pcs->completed != 4 && $pcs->completed != 5){
                $now = date('Y-m-d');
                $then = $doc->created_at;
                $dif = strtotime($now)-strtotime($then);
                $dif= $dif/86400;
                if($dif != floor($dif))
                    $dif = floor($dif)+1;
                //para notificar cada 5 dias
                if($dif>0 && $dif%5==0){
                    $filename = $doc->name;
                    if($filename == "PSA" || $filename == "DDR"){
                        $lead = $pcs->project->lead;
                        $consultant_id = $lead->consultant_id;
                        $fileno = $pcs->fileno;
                        $pin = $pcs->project_id;
                        $msgInbox = "DOCUMENT WITH MORE THAN 5 DAYS WITHOUT SIGNATURE:<br>".date("m-d-Y H:i:s");
                        $msgInbox.="<br>Fileno: ".$fileno." ----PIN : ".$pin." ----File : ".$filename;
                        Inbox::createInbox($lead->id,$consultant_id ,$msgInbox,"CLIENT SERVICES","CLIENT");
                        $msgCS.="<br>Fileno: ".$fileno." ----PIN : ".$pin." ----File : ".$filename;
                    }
                }
            }
        }
        Inbox::createInbox(0,$clientS->id ,$msgCS,"CLIENT SERVICES","CLIENT");
        /*END OF***************PSA & DDR*****************/

        /****************Documents sent to client and not signed yet*********APP PROV and UTILITY********/
        $pCS = ProjectClientServices::where('completed',1)->where('appSent_created_at','<>','')->where('patentAppApproved_created_at','')->where('apppendingrevision','<>',1)->get();
        $pinsOverdue="";
        $fileNoToMail=array();
        foreach($pCS as $pcs){
            $lead = Lead::where('fileno',$pcs->fileno)->first();
            $now = date('Y-m-d 00:00:00');
            //or 10 days since the patten app
            //date for the patent application
            $then2 = \DateTime::createFromFormat("m-d-Y",$pcs->appSent_created_at);
            $dif2 = strtotime($now)-strtotime($then2->format('Y-m-d 00:00:00'));
            $dif2 = $dif2/86400;
            if($dif2 != floor($dif2))
                $dif2 = floor($dif2)+1;
            //para notificar cada 10 dias
            if($dif2>0 && $dif2%10==0){
                $pcs->completed = 3;
                $pcs->overDueReason = "Client overdue(Patent Application overdue)";
                $pcs->save();
                $pinsOverdue = ",".$pcs->project_id;
                //sent a inbox to client services and to consultant
                if($clientS!=null){
                    $msgInbox = "The Patent Application was sent over 10 days and it has not been signed yet.<br>".date("m-d-Y H:i:s")." <br>Client: ".$lead->fname." ".$lead->lname.
                        "<br>File #: ".$pcs->fileno."<br>Pin: ".$pcs->project_id;
                    Inbox::createInbox($lead->id,$clientS->id,$msgInbox,"CLIENT SERVICES","CLIENT");
                }
                //sent email to client notice him the overdue
                file_get_contents(url("emailPatentAppOverdue?ID=$pcs->project_id"));
                if($pcs->mailOnly == 1){
                    $fileNoToMail[]=$pcs->fileno;
                }
            }
        }

        $pins = "";
        if($pinsOverdue != "")
            Transaction::createTransaction('','','','PROJECT_OVERDUE_BY_CLIENT_PATENTAPP',$pinsOverdue,'','','','','','');
        /*END OF***************Documents sent to client and not signed yet*********APP PROV and UTILITY********/

        /****************Documents sent to client and not signed yet*********APP DESIGN********/
        $pCS = ProjectClientServices::where('completed',1)->where('appSentD_created_at','<>','0000-00-00 00:00:00')->where('appSentD_created_at','<',date('Y-m-d 00:00:00', strtotime('-10 days')))->where('patentAppApprovedD_created_at','0000-00-00 00:00:00')->where('apppendingrevisionD','<>',1)->get();
        $pinsOverdue="";
        foreach($pCS as $pcs){
            $lead = Lead::where('fileno',$pcs->fileno)->first();
            $pcs->completed = 3;
            $pcs->overDueReason = "Client overdue(Patent Application -Design-  overdue)";
            $pcs->save();
            $pinsOverdue = ",".$pcs->project_id;
            //sent a inbox to client services and to consultant
            if($clientS!=null){
                $msgInbox = "The Patent Application (Design) was sent over 10 days and it has not been signed yet.<br>".date("m-d-Y H:i:s")." <br>Client: ".$lead->fname." ".$lead->lname.
                    "<br>File #: ".$pcs->fileno."<br>Pin: ".$pcs->project_id;
                Inbox::createInbox($lead->id,$clientS->id,$msgInbox,"CLIENT SERVICES","CLIENT");
            }
            //sent email to client notice him the overdue
            file_get_contents(url("emailPatentAppOverdue?ID=$pcs->project_id"));
            if($pcs->mailOnly == 1)
                $fileNoToMail[]=$pcs->fileno;

        }
        $msgInbox = "A Reminder Patent App email was sent to the projects with the following fileno and they are check to regular mail.<br>";
        foreach($fileNoToMail as $fileno){
            $msgInbox.="<br>File #: ".$fileno;
        }
        if(count($fileNoToMail)>0)
            Inbox::createInbox('',$clientS->id,$msgInbox,"CLIENT SERVICES","CLIENT");

        if($pinsOverdue != "")
            Transaction::createTransaction('','','','PROJECT_OVERDUE_BY_CLIENT_PATENTAPPD',$pinsOverdue,'','','','','','');
        /*END OF***************Documents sent to client and not signed yet*********APP DESIGN********/

        /****************Documents ILC AGREEMENT sent to client and not signed yet*********ILC********/
        $pCS = ProjectClientServices::where('completed',1)->where('marketingAgrSent_created_at','<>','')->where('completed','<>',4)->where('completed','<>',5)->where('marketingAgrReceived_created_at','')->where('releaseFormReceived_created_at','')->get();
        $fileNoToMail=array();
        foreach($pCS as $pcs){
            $lead = Lead::where('fileno',$pcs->fileno)->first();
            $now = date('Y-m-d 00:00:00');
            $then = \DateTime::createFromFormat("m-d-Y",$pcs->marketingAgrSent_created_at)->format('Y-m-d 00:00:00');
            $dif = strtotime($now)-strtotime($then);
            $dif= $dif/86400;
            if($dif != floor($dif))
                $dif = floor($dif)+1;
            //para notificar cada 7 dias
            if($dif>0 && $dif%7==0){
                $msgInbox = "The ILC agreement was sent over 7 days and it has not been signed yet.<br>".date("m-d-Y H:i:s")." <br>Client: ".$lead->fname." ".$lead->lname.
                    "<br>File #: ".$pcs->fileno."<br>Pin: ".$pcs->project_id;
                Inbox::createInbox($lead->id,$clientS->id,$msgInbox,"CLIENT SERVICES","CLIENT SERVICES");//change 16 x $clientS->id
                file_get_contents(url("emailILCOverdue?ID=$pcs->project_id"));
                if($pcs->mailOnly == 1)
                    $fileNoToMail[]=$pcs->fileno;
            }
        }
        $msgInbox = "A Reminder ILC Agreement was emailed to the projects with the following fileno and they are check to regular mail.<br>";
        foreach($fileNoToMail as $fileno){
            $msgInbox.="<br>File #: ".$fileno;
        }
        if(count($fileNoToMail)>0)
            Inbox::createInbox('',$clientS->id,$msgInbox,"CLIENT SERVICES","CLIENT");

    }

    // send a email to att remember the expected date for the patent app
    public function reminderPatentAppToAtt(){
        $attCSAux = AttClientServices::where('completed','<>',1)->where('reminderToAttAppDate','<>','0000-00-00 00:00:00')->where('reminderToAttAppDate','<',date('Y-m-d 23:59:59', strtotime('-1 months')))->get();
        $attCS =array();
        foreach($attCSAux as $att){
            $pcs = $att->projectclientservices;
            if($pcs != null && $pcs->appSent_created_at ==''){
                //save the date of the last remainder
                $att->reminderToAttAppDate = date('Y-m-d 00:00:00');
                $att->save();

                //get dates and type of app sent to att
                $date1=$pcs->documentSent_created_at;
                $split_aux = explode('-',$date1);
                $aux_date=$split_aux[2]."-".$split_aux[0]."-".$split_aux[1];
                $date2 = Date("m-d-Y", strtotime("$aux_date +56 days"));
                if($pcs->hasType('UPG_UT')){
                    $aux="Upgrade Utility";
                    $date1 = $pcs->docUpgSent_created_at;
                    $date2 = date("m-d-Y",strtotime($att->dueDate));
                }elseif($pcs->hasType('PROV'))
                    $aux="Provisional";
                elseif($pcs->hasType('D') && $pcs->hasType('UT'))
                    $aux="Utility & Design";
                elseif($pcs->hasType('UT'))
                    $aux="Utility";

                $texto = "<tr><td style='width:103.0pt;border:solid windowtext 1.0pt;border-top:none;padding:0in 5.4pt 0in 5.4pt;height:15.0pt' nowrap='' valign='top' width='81'>".ucwords($pcs->project->lead->fname." ".$pcs->project->lead->lname)."</td><td style='width:103.0pt;border-top:none;border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;padding:0in 5.4pt 0in 5.4pt;height:15.0pt' nowrap='' valign='top' width='81'>".$pcs->fileno."</td>
                                    <td style='width:103.0pt;border:solid windowtext 1.0pt;border-top:none;padding:0in 5.4pt 0in 5.4pt;height:15.0pt' nowrap='' valign='top' width='81'>".$aux."</td><td style='width:103.0pt;border:solid windowtext 1.0pt;border-top:none;padding:0in 5.4pt 0in 5.4pt;height:15.0pt' nowrap='' valign='top' width='81'>".$date1."</td><td style='width:103.0pt;border:solid windowtext 1.0pt;border-top:none;padding:0in 5.4pt 0in 5.4pt;height:15.0pt' nowrap='' valign='top' width='81'>".$date2."</td></tr>";
                if(array_key_exists($att->consultant_id,$attCS)){
                    $attCS[$att->consultant_id] .= $texto;
                }else{
                    $attCS[$att->consultant_id] = $texto;
                }
            }
        }
        foreach($attCS as $key=>$value) {
            $files = array();
            $subj = "ETA";
            $from_mail = "priority@ownmyinvention.com";
            $replyto = "clientservices@ownmyinvention.com";
            $header = "Patent Services USA";
            $att =Consultant::find($key);
            $msg = "Hi,<br>
                As a reminder we are pending to receive the following workload.<br><br>
                <table style='border-collapse:collapse' border='0' cellpadding='0' cellspacing='0'>
                        <tr><td style='width:103.0pt;border:solid windowtext 1.0pt;padding:0in 5.4pt 0in 5.4pt;height:30.0pt' valign='top' width='81'><strong>Client Name</strong></td><td style='width:103.0pt;border:solid windowtext 1.0pt;padding:0in 5.4pt 0in 5.4pt;height:30.0pt' valign='top' width='81'><strong>File #</strong></td>
                            <td style='width:103.0pt;border:solid windowtext 1.0pt;padding:0in 5.4pt 0in 5.4pt;height:30.0pt' valign='top' width='81'>App Type</td><td style='width:103.0pt;border:solid windowtext 1.0pt;padding:0in 5.4pt 0in 5.4pt;height:30.0pt' valign='top' width='81'>Date sent</td><td style='width:103.0pt;border:solid windowtext 1.0pt;padding:0in 5.4pt 0in 5.4pt;height:30.0pt' valign='top' width='81'>ETA</td>
                        </tr>
                        ".$value."
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

            SendEmailHelper::send($files, '', $att->email, $from_mail, $header, $replyto, $subj, $msg, $subj);
            SendEmailHelper::send($files, '', 'clientservices@ownmyinvention.com', $from_mail, $header, $replyto, $subj, $msg, $subj);
            if($att->usr=="jh_attorney"){
                SendEmailHelper::send($files, '', 'dwhitman@ip-pages.com ', $from_mail, $header, $replyto, $subj, $msg, $subj);
            }
        }
    }

    //close provisional app when expires and create an inbox for CS
    public function closedExpiredPCS(){
        $clientS = Consultant::where('usr','clientservices')->first();
        //provisionals
        $provisionals = ProjectClientServices::where('contractTypes','like','%PROV%')->where('contractTypes','not like','%UPG_UT%')->where('completed','<>',4)->where('patentAppFiled_created_at','<>','0000-00-00 00:00:00')->where('patentAppFiled_created_at','<',date('Y-m-d 23:59:59', strtotime('-1 year')))->get();
        foreach($provisionals as $prov){
            $prov->completed = 4;
            $prov->save();
            $lead = Lead::where('fileno',$prov->fileno)->first();
            $msgInbox = "The File ".$prov->fileno." was closed because expired.<br>".date("m-d-Y H:i:s")." <br>Client: ".$lead->fname." ".$lead->lname;
            Inbox::createInbox($lead->id,$clientS->id,$msgInbox,"CLIENT SERVICES","SYSTEM");
            Transaction::createTransaction('','','','CLOSED_FILE_EXPIRED','FILENO_'.$prov->fileno,$prov->project_id,'','','','','');
        }

        //utilities it's comment cause is manual now
//        $utilities = ProjectClientServices::where('contractTypes','not like','%PROV%')->where('completed','<>',4)->where('rcvdDate','<>','0000-00-00 00:00:00')->where('rcvdDate','<',date('Y-m-d 23:59:59', strtotime('-2 year')))->get();
//        foreach($utilities as $ut){
//            $ut->completed = 4; // put it in closed
//            $ut->save();
//            $lead = Lead::where('fileno',$ut->fileno)->first();
//            $msgInbox = "The File ".$ut->fileno." was closed because expired.<br>".date("m-d-Y H:i:s")." <br>Client: ".$lead->fname." ".$lead->lname;
//            file_get_contents(url("emailExpiredNotice?ID=$ut->project_id"));
//            file_get_contents(url("emailExpiredToAttorney?ID=$ut->project_id"));
//            Inbox::createInbox($lead->id,$clientS->id,$msgInbox,"CLIENT SERVICES","CLIENT SERVICES");
//            Transaction::createTransaction('','','','CLOSED_FILE_EXPIRED','FILENO_'.$ut->fileno,$ut->project_id,'','','','','');
//        }
    }

    //create inbox for CS for app sent to client and are not been sign yet. (run on mondays only)
    public function reminderAppOverdue(){
        $clientS = Consultant::where('usr','clientservices')->first();
        $pCS = ProjectClientServices::where('completed',3)->where('appSent_created_at','<>','')->where('patentAppApproved_created_at','')->where('apppendingrevision','<>',1)->get();
        foreach($pCS as $pcs){
            $lead = Lead::where('fileno',$pcs->fileno)->first();
            if($clientS!=null){
                $msgInbox = "The Patent Application has not been signed yet.<br>".date("m-d-Y H:i:s")." <br>Client: ".$lead->fname." ".$lead->lname.
                    "<br>File #: ".$pcs->fileno."<br>Pin: ".$pcs->project_id;
                Inbox::createInbox($lead->id,$clientS->id,$msgInbox,"CLIENT SERVICES","CLIENT");
            }
        }

        $pCS = ProjectClientServices::where('completed',3)->where('appSentD_created_at','<>','0000-00-00 00:00:00')->where('patentAppApprovedD_created_at','0000-00-00 00:00:00')->where('apppendingrevisionD','<>',1)->get();
        foreach($pCS as $pcs){
            $lead = Lead::where('fileno',$pcs->fileno)->first();
            if($clientS!=null){
                $msgInbox = "The Patent Application (Design) has not been signed yet.<br>".date("m-d-Y H:i:s")." <br>Client: ".$lead->fname." ".$lead->lname.
                    "<br>File #: ".$pcs->fileno."<br>Pin: ".$pcs->project_id;
                Inbox::createInbox($lead->id,$clientS->id,$msgInbox,"CLIENT SERVICES","CLIENT");
            }
        }
    }

    //remainder to att and CS that a patent was returned more than a week ago and has not be finish for the att  (stateChangedDate is updated every time to show the notification only ones a week)
    public function reminderPatentAppReturned(){
        $clientS = Consultant::where('usr','clientservices')->first();
        $attCS = AttClientServices::where('completed',2)->where('stateChangedDate','<>','0000-00-00 00:00:00')->where('stateChangedDate','<',date('Y-m-d 23:59:59', strtotime('-1 week')))->get();
        foreach($attCS as $attcs){
            $lead = Lead::find($attcs->lead_id);
            $msgInbox = "The submission was returned by the client more than a week ago.<br>".date("m-d-Y H:i:s")." <br>Client: ".$lead->fname." ".$lead->lname."<br>Fileno: ".$lead->fileno;
            Inbox::createInbox($lead->id,$clientS->id,$msgInbox,"CLIENT SERVICES","SYSTEM");
            Inbox::createInbox($lead->id,$attcs->consultant_id,$msgInbox,"CLIENT SERVICES","SYSTEM");
            $pcs = ProjectClientServices::find($attcs->projectclientservices_id);
            $csNote = new ClientSNotes();
            $csNote->notes = "SUBMISSION RETURNED REMINDER";
            $csNote->projectclientservices_id = $pcs->id;
            $csNote->save();
            $attcs->stateChangedDate = date('Y-m-d 00:00:00');
            $attcs->save();
        }
    }

    //create inbox por CS for CR and TM that have not been filed yet (run the 1 and 15 of every month)
    public function reminderTMOrCRFiling(){
        $clientS = Consultant::where('usr','clientservices')->first();
        $pCS = ProjectClientServices::where('patentAppFiled_created_at','<>','0000-00-00 00:00:00')->where('trademarkReceived_created_at','<>','')->where('trademarkFil_created_at','')->get();

        foreach($pCS as $pcs){
            $lead = Lead::where('fileno',$pcs->fileno)->first();
            $msgInbx = "Trademark filing pending:<br>".date("m-d-Y H:i:s");
            $msgInbx.="<br>Fileno: ".$pcs->fileno."<br>PIN: ".$pcs->project_id."<br>Client: ".$lead->fname." ".$lead->lname;
            Inbox::createInbox('',$clientS->id,$msgInbx,"CLIENT SERVICES","CLIENT SERVICES");//$clientS->id
        }

        $pCS = ProjectClientServices::where('patentAppFiled_created_at','<>','0000-00-00 00:00:00')->where('copyrightReceived_created_at','<>','')->where('copyrightFiled_created_at','')->get();
        foreach($pCS as $pcs){
            $lead = Lead::where('fileno',$pcs->fileno)->first();
            $msgInbx2 = "Copyright filing pending:<br>".date("m-d-Y H:i:s");
            $msgInbx2.="<br>Fileno: ".$pcs->fileno."<br>PIN: ".$pcs->project_id."<br>Client: ".$lead->fname." ".$lead->lname;
            Inbox::createInbox('',$clientS->id,$msgInbx2,"CLIENT SERVICES","CLIENT SERVICES");//$clientS->id
        }
    }

    //create inbox for client services
    public function reminderPCTQuest(){
        $clientS = Consultant::where('usr','clientservices')->first();
        $pCS = ProjectClientServices::where('pctQuestSent','<>','0000-00-00 00:00:00')->where('pctQuestReceived','0000-00-00 00:00:00')->where('pctQuestSent','<',date('Y-m-d 00:00:00', strtotime('-14 day')))->where('pctQuestSent','>',date('Y-m-d 00:00:00', strtotime('-16 day')))->get();
        foreach($pCS as $pcs){
            $lead = Lead::where('fileno',$pcs->fileno)->first();
            $msgInbox = "The PCT Questionnaire was sent over 15 days and it has not been received yet.<br>".date("m-d-Y H:i:s")." <br>Client: ".$lead->fname." ".$lead->lname.
                "<br>File #: ".$pcs->fileno."<br>Pin: ".$pcs->project_id;
            Inbox::createInbox($lead->id,$clientS->id,$msgInbox,"CLIENT SERVICES","CLIENT SERVICES");
        }
    }

    //add 849 to ppa contract after 30 days off provisional payment if the full amount of the utility is not reached yet.
    public function raisePPA(){
        $contracts = Contract::where('type','PPA')->where('paid','<',11949)->where('paidDate','<',date('Y-m-d H:i:s', strtotime('-30 days')))->where('Add849',0)->get();
        foreach($contracts as $contract){
            $proj = $contract->project;
            if($proj != null){
                $pcs = $proj->clientServicesProject();
                if($pcs != null && $pcs->ppaSent_created_at!= '' && $contract->ppaTotalPrice() != 0 && $contract->price != $contract->paid && $proj->utility != "IMG"){
                    $contract->price = $contract->ppaTotalPrice() + 849;
                    $contract->Add849 = 1;
                    $contract->save();
                    Transaction::createTransaction('','','','RAISE_PRICE_CONTRACT_$849','CONTRACT_ID_'.$contract->id,$contract->project_id,'','PPA','','','');
                }
            }
        }
    }

    //send the patent app update email to the clients in the 3rd, 6th and 12th month
    public function updateEmailPatentAppCronJob(){
        $pcsUpd3M = ProjectClientServices::where('patentAppFiled_created_at','<>','0000-00-00 00:00:00')->where('patentAppFiled_created_at','<',date('Y-m-d 00:00:00', strtotime('-3 months + 1 day')))->where('patentAppFiled_created_at','>',date('Y-m-d 00:00:00', strtotime('-3 months -1 day')))->where('completed','<>',4)->where('completed','<>',5)->get();
        $pcsUpd6M = ProjectClientServices::where('patentAppFiled_created_at','<>','0000-00-00 00:00:00')->where('patentAppFiled_created_at','<',date('Y-m-d 00:00:00', strtotime('-180 day')))->where('patentAppFiled_created_at','>',date('Y-m-d 00:00:00', strtotime('-182 day')))->where('completed','<>',4)->where('completed','<>',5)->get();
        $pcsUpd1Y = ProjectClientServices::where('patentAppFiled_created_at','<>','0000-00-00 00:00:00')->where('patentAppFiled_created_at','<',date('Y-m-d 00:00:00', strtotime('-1 year +1 day')))->where('patentAppFiled_created_at','>',date('Y-m-d 00:00:00', strtotime('-1 year -1 day')))->where('completed','<>',4)->where('completed','<>',5)->get();
        $fileNoToMail = array();
        $clientS = Consultant::where('usr','clientservices')->first();

        foreach($pcsUpd3M as $pcs){
            file_get_contents(url("updateEmail?ID=$pcs->project_id&TIME=3&DATE=&NUMBER="));
            if($pcs->mailOnly == 1)
                $fileNoToMail[]=$pcs->fileno;

        }
        foreach($pcsUpd6M as $pcs){
            file_get_contents(url("updateEmail?ID=$pcs->project_id&TIME=6&DATE=&NUMBER="));
            if($pcs->mailOnly == 1)
                $fileNoToMail[]=$pcs->fileno;

        }
        foreach($pcsUpd1Y as $pcs) {
            $date = date('m/d/Y',strtotime($pcs->patentAppFiled_created_at));
            if(!$pcs->hasType('PROV')){
                $pcs->updateDateAfterYear =date('Y-m-d 00:00:00');
                $pcs->save();
                file_get_contents(url("updateEmail?ID=$pcs->project_id&TIME=12&DATE=$date->&NUMBER=$pcs->patentAppNo"));
                if($pcs->mailOnly == 1)
                    $fileNoToMail[]=$pcs->fileno;
            }
        }
        $msgInbox = "An update email was sent to the projects with the following fileno and they are check to regular mail.<br>";
        foreach($fileNoToMail as $fileno){
            $msgInbox.="<br>File #: ".$fileno;
        }

        if(count($fileNoToMail)>0)
            Inbox::createInbox('',$clientS->id,$msgInbox,"CLIENT SERVICES","CLIENT");
    }

    /*
     * send a email to attorney reminding him the file is up to expire two week before the expiration date
     * */
    public function reminderBeforeExpProv(){
        $clientS = Consultant::where('usr','clientservices')->first();
        $msgInbox = "The Following fileno has an App Provisional Filed that will expire in ".date('m-d-Y', strtotime('+2 weeks')).": <br>";
        $files = "";
        $pCS = ProjectClientServices::where('patentAppFiled_created_at','<>','0000-00-00 00:00:00')
                ->where('patentAppFiled_created_at','<',date('Y-m-d 23:59:59', strtotime('-1 year +14 days')))
                ->where('patentAppFiled_created_at','>',date('Y-m-d 23:59:59', strtotime('-1 year +13 days')))
                ->where('patentType','like','PROV')
                ->where('contractTypes','like','%UPG_UT%')
                ->get();
        foreach($pCS as $pcs){
            $attcsUPG = AttClientServices::where('projectclientservices_id',$pcs->id)->where('type','UPG_UT')->where('completed','<>',1)->first();
            if($attcsUPG!=null){
                $files.="<br>File #: ".$pcs->fileno;
                ToolsFunctions::curl(url("reminderAttBeforeProvExp?ID=$attcsUPG->id"));//change to priority
            }
        }
        if($files != "")
            Inbox::createInbox('',$clientS->id,$msgInbox.$files,"CLIENT SERVICES","CLIENT");
    }

    //send email to client after 42 days we send the app to the att
    public function emailDraftingStatus(){
        $projectCSs = DB::select("SELECT * FROM projectclientservices where str_to_date(documentSent_created_at, '%m-%d-%Y') > str_to_date(:dateStart, '%m/%d/%Y') AND str_to_date(documentSent_created_at, '%m-%d-%Y') < str_to_date(:dateEnd, '%m/%d/%Y') AND completed < 4", ['dateStart' => date('m/d/Y', strtotime('-43 days')), 'dateEnd' => date('m/d/Y', strtotime('-41 days'))]);
        $fileNoToMail = array();
        $clientS = Consultant::where('usr','clientservices')->first();
        foreach($projectCSs as $projectCS){
            $pcs = ProjectClientServices::find($projectCS->id);
            $aux = explode('-',$pcs->documentSent_created_at);
            $d = $aux[1]."-".$aux[0]."-".$aux[2];
            $date = date_create($d);
            date_add($date, date_interval_create_from_date_string('70 days'));
            $DATE = date_format($date,'m-d-Y');
            ToolsFunctions::curl(url("emailPatentAppDraftingStatus?ID=$pcs->project_id&DATE=$DATE"));
            if($pcs->mailOnly == 1)
                $fileNoToMail[]=$pcs->fileno;
        }

        $msgInbox = "A Patent Application Drafting Status email was sent to the projects with the following fileno and they are check to regular mail.<br>";
        foreach($fileNoToMail as $fileno){
            $msgInbox.="<br>File #: ".$fileno;
        }

        if(count($fileNoToMail)>0)
            Inbox::createInbox('',$clientS->id,$msgInbox,"CLIENT SERVICES","CLIENT");
    }

    /*
     * send a text message and an email to client given follow up to the welcome email from 8 days ago
     * */
    public function reminderIntroCall(){
        $msgInbox = "An Intro Call email was sent to the projects with the following fileno and they are check to regular mail.<br>";
        $fileNoToMail = 0;
        ///////if it's monday send email to george with the report of the last week
        if(date('D') == 'Mon')
            ToolsFunctions::curl(url("reportIntroCall"));
        $pCS = ProjectClientServices::where('emailCall_created_at','')->where('emailSent_created_at','<>','')->get();
        $clientS = Consultant::where('usr','clientservices')->first();
        foreach($pCS as $pcs){
            $now = date('Y-m-d 00:00:00');
            $then = \DateTime::createFromFormat("m-d-Y",$pcs->emailSent_created_at)->modify('+7 day')->format('Y-m-d 00:00:00');
            if($then < $now){
                PlivoHelper::sendSMS($pcs->project->lead->phone, 'You have received communication from PSU please check your voicemail or client’s Launch Center for updates.');
                ToolsFunctions::curl(url("introCallEmail?LID=".$pcs->project->lead->id));
                $pcs->emailCall_created_at = date('m-d-Y');
                $pcs->save();
                $csNote = new ClientSNotes();
                $csNote->notes = "Automatic Intro Call";
                $csNote->projectclientservices_id = $pcs->id;
                $csNote->save();
                Transaction::createTransaction('',$pcs->project->lead_id,'','AUTOMATIC_INTRO_CALL','',$pcs->project_id,'','','','','');
                if($pcs->mailOnly == 1){
                    $fileNoToMail++;
                    $msgInbox.="<br>File #: ".$pcs->fileno;
                }
            }
        }
        if($fileNoToMail>0)
            Inbox::createInbox('',$clientS->id,$msgInbox,"CLIENT SERVICES","CLIENT");
    }

    public function sendAgreementExtension(){
        $msgInbox = "An Agreement Extension was sent to the projects with the following fileno and they are check to regular mail.<br>";
        $pendingUtilities = ProjectClientServices::where('contractTypes','not like','%PROV%')
            ->where('completed','<>',4)
            ->where('agreementExt_sent','0000-00-00 00:00:00')
            ->where('rcvdDate','<>','0000-00-00 00:00:00')
            ->where('rcvdDate','<',date('Y-m-d 23:59:59', strtotime('-2 year +31 day')))
            ->orWhere(function($query){
                $query->where('contractTypes','like','%UPG_UT%')
                    ->where('completed','<>',4)
                    ->where('agreementExt_sent','0000-00-00 00:00:00')
                    ->where('rcvdDate','<>','0000-00-00 00:00:00')
                    ->where('rcvdDate','<',date('Y-m-d 23:59:59', strtotime('-2 year +31 day')));
        })->get();
        $fileNoToMail = 0;
        $clientS = Consultant::where('usr','clientservices')->first();
        foreach($pendingUtilities as $pending){
            $project =$pending->project;
            $coInvs = explode(',',$project->coInventor);
            $content = view('templates.client_services.empty_mail_agreementExtension_template_pdf',
                array('client'=>$project->lead,'pcs'=>$pending,'coInvs'=>$coInvs));
            $pdf = App::make('dompdf.wrapper');
            $pdf->loadHTML($content);
            $pdf->save("files/projects/".$project->lead->fileno."/".$project->id."/agreement_extension.pdf");
            ToolsFunctions::curl(url("sendExtensionEmail?PID=".$project->id));
            if($pending->mailOnly == 1){
                $msgInbox.="<br>File #: ".$pending->fileno;
                $fileNoToMail++;
            }
        }
        if($fileNoToMail>0)
            Inbox::createInbox('',$clientS->id,$msgInbox,"CLIENT SERVICES","CLIENT");
    }

    //no se completo, la idea es que actualise la phase de los project segun los parametros necesarios para estar en cada una de las phases
    public function checkPCSPhaseTimeFrame(){
        $phase1PCS = ProjectClientServices::where('phase',0)->where('completed','<>',4)->where('completed','<>',5)->get();
        $phase2PCS = ProjectClientServices::where('phase',1)->where('completed','<>',4)->where('completed','<>',5)->get();
        $phase3PCS = ProjectClientServices::where('phase',2)->where('completed','<>',4)->where('completed','<>',5)->get();
        $phase4PCS = ProjectClientServices::where('phase',3)->where('completed','<>',4)->where('completed','<>',5)->get();
        $phase5PCS = ProjectClientServices::where('phase',4)->where('completed','<>',4)->where('completed','<>',5)->get();
        $phase6PCS = ProjectClientServices::where('phase',5)->where('completed','<>',4)->where('completed','<>',5)->get();
        $phase7PCS = ProjectClientServices::where('phase',6)->where('completed','<>',4)->where('completed','<>',5)->get();
    }

    /****************************ILC CRON JOBS*************************************/

    public function checkILCVendorOverDue(){
        $ilcVendors = IlcVendors::where('state','=',0)->where('filesRcvdDate','<',date('Y-m-d 00:00:01', strtotime('-14 days')))->get();
        $ilcVReturned =IlcVendors::where('state','=',1)->where('filesRcvdDate','<',date('Y-m-d 00:00:01', strtotime('-7 days')))->get();
        foreach($ilcVendors as $ilcV){
            $ilcV->state = 2;
            $ilcV->save();
            //put note in ilc
            $ilcNote = new IlcNotes();
            $ilcNote->ilc_id = $ilcV->ilc->id;
            $ilcNote->notes = "File in overdue by the vendor.";
            $ilcNote->system = 1;
            $ilcNote->save();

            $project = $ilcV->ilc->projectclientservices->project;
            //notify to vendor about the overdue
            $msg = "File in overdue after 14 days.\r\n";
            $msg .= date("m-d-Y H:i:s")."\r\n";
            $msg .= "File #:".$ilcV->ilc->fileno."\r\n";
            $msg .= "Client: ".$ilcV->ilc->invFname." ".$ilcV->ilc->invLname."\r\n";
            $msg .= "Pin: ".$project->id."\r\n";
            Inbox::createInbox($project->lead->id, $ilcV->vendorId, $msg, 'ILC', 'ILC VENDOR');//
            //notify ilc of the change about state in the file
            $ilcConsultant =Consultant::where('usr','ilc')->first();
            Inbox::createInbox($project->lead->id, $ilcConsultant->id, $msg, 'ILC', 'ILC VENDOR');//
            //send email
            $vendor = Consultant::find($ilcV->vendorId);
            ToolsFunctions::curl(url('notifyVendorFileOverdue?PID='.$project->id.'&EMAIL='.$vendor->email));
        }
        foreach($ilcVReturned as $ilcV){
            $ilcV->state = 2;
            $ilcV->save();
            //put note in ilc
            $ilcNote = new IlcNotes();
            $ilcNote->ilc_id = $ilcV->ilc->id;
            $ilcNote->notes = "File in overdue by the vendor.";
            $ilcNote->system = 1;
            $ilcNote->save();

            $project = $ilcV->ilc->projectclientservices->project;
            //notify to vendor about the overdue
            $msg = "File (returned) in overdue after 7 days.\r\n";
            $msg .= date("m-d-Y H:i:s")."\r\n";
            $msg .= "File #:".$ilcV->ilc->fileno."\r\n";
            $msg .= "Client: ".$ilcV->ilc->invFname." ".$ilcV->ilc->invLname."\r\n";
            $msg .= "Pin: ".$project->id."\r\n";
            Inbox::createInbox($project->lead->id, $ilcV->vendorId, $msg, 'ILC', 'ILC VENDOR');//
            //notify ilc of the change about state in the file
            $ilcConsultant =Consultant::where('usr','ilc')->first();
            Inbox::createInbox($project->lead->id, $ilcConsultant->id, $msg, 'ILC', 'ILC VENDOR');//
            //send email
            $vendor = Consultant::find($ilcV->vendorId);
            ToolsFunctions::curl(url('notifyVendorFileOverdue?PID='.$project->id.'&EMAIL='.$vendor->email));
        }
    }

    public function checkWebsiteCompleted(){
        $msgInbox = "The website must be completed in the next 10 days for the followings files:<br>";
        $ilcs = Ilc::where('welcomePckgSentDate','<',date('Y-m-d 00:00:00',strtotime("-89 days")))->where('welcomePckgSentDate','>',date('Y-m-d 00:00:00',strtotime("-91 days")))->where('website_codes_user','<>','')->where('website_codes_pswd','<>','')->get();
        foreach($ilcs as $ilc)
            $msgInbox.="File #: ".$ilc->fileno."---Client Name: ".$ilc->invFname." ".$ilc->invLname."<br>";

        if(count($ilcs)>0){
            $ilcConsultant =Consultant::where('usr','ilc')->first();
            Inbox::createInbox('',$ilcConsultant->id,$msgInbox,"ILC","ILC");
        }
    }

}
