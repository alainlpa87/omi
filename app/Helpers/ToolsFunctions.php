<?php
/**
 * Created by PhpStorm.
 * User: Alain
 * Date: 10/6/2015
 * Time: 1:25 PM
 */

namespace App\Helpers;

use App\Models\Assignment;
use App\Models\Consultant;
use App\Models\Inbox;
use App\Models\Lead;
use App\Models\PaymentTransaction;
use App\Models\Project;
use App\Models\Submission;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class ToolsFunctions {

    public static function encrypt($string) {
        $key = "Patent Service USA";
        $resultE = '';
        for($i=0; $i<strlen($string); $i++) {
            $char = substr($string, $i, 1);
            $keychar = substr($key, ($i % strlen($key))-1, 1);
            $char = chr(ord($char)+ord($keychar));
            $resultE.=$char;
        }
        return base64_encode($resultE);
    }

    public static function isLocal($zip) {
        $result = false;

        $localZip = ['33010','33012','33013','33014','33015','33016','33018','33030','33031','33032','33033','33034','33035','33039','33149','33150','33101','33142','33143','33144','33145','33146','33147','33155','33156','33157','33158','33122','33125','33126','33127','33128','33129','33130','33131','33132','33133','33134','33135','33136','33137','33138','33161','33162','33165','33166','33167','33168','33169','33170','33172','33173','33174','33175','33176','33177','33178','33179','33180','33181','33182',
            '33183','33184','33185','33186','33187','33189','33190','33193','33194','33196','33139','33140','33141','33109','33154','33160','33054','33055','33056','33004','33441','33442','33301','33304','33305','33306','33308','33309','33311','33312','33313','33314','33315','33316','33317','33319','33321','33322','33323','33324','33325','33326','33327','33328','33330','33331','33332','33334','33351','33009','33019','33020','33021','33023','33027','33028','33029','33024','33025','33026','33067','33068',
            '33069','33071','33073','33076','33060','33062','33063','33064','33065','33066','33037','32765','33157','33613','18661','34987','33183','32025','33304','33305','33308','33309','33311','33313','33315','33317','33319','33321','33324','53949','33334','33402','33401','33404','33403','33406','33405','33408','33407','33410','33409','33412','33411','33414','33413','33415','33418','33417','33422','33421','33425','33426','33428','33431','33430','33433','33432','33435','33434','33009','33437','33436',
            '33438','33441','33440','11427','33445','33444','33446','33458','33025','33460','33462','33461','33029','33464','33463','33468','33467','33470','22430','33469','33474','33471','33476','33478','33477','33898','33480','33483','33486','33484','33488','33487','33060','33496','33493','33062','33498','33064','33063','33499','33066','33065','33068','33473','33449','33073','33472','33076','34684','34741','33569','33971','33140'];

        if(in_array($zip,$localZip)){
            $result = true;
        }
        return $result;
    }

//obtain the leadsource of the new leads
    public static function leadSource($name){
        $n = strtoupper($name);
        if($name == null){
            return 'DEF';
        }
        switch ($n){
            case ('lvn'):
                $source = 'LIVE-N';
                break;
            case ('TVM'):
                $source = 'LIVE-N';
                break;
            case ('LIVEN'):
                $source = 'LIVE-N';
                break;
            case ('KING'):
                $source = 'IMI';
                break;
            case ('OMI'):
                $source = 'OMI';
                break;
            default:
                $source = 'DEF';
        }
        return $source;
    }

    public static function drawThickLine ($img, $startX, $startY, $endX, $endY, $colour, $thickness) {
        $angle = (atan2(($startY - $endY), ($endX - $startX)));
        $dist_x = $thickness * (sin($angle));
        $dist_y = $thickness * (cos($angle));
        $p1x = ceil(($startX + $dist_x));
        $p1y = ceil(($startY + $dist_y));
        $p2x = ceil(($endX + $dist_x));
        $p2y = ceil(($endY + $dist_y));
        $p3x = ceil(($endX - $dist_x));
        $p3y = ceil(($endY - $dist_y));
        $p4x = ceil(($startX - $dist_x));
        $p4y = ceil(($startY - $dist_y));
        $array = array(0=>$p1x, $p1y, $p2x, $p2y, $p3x, $p3y, $p4x, $p4y);
        imagefilledpolygon($img, $array, (count($array)/2), $colour);
    }

    public static function sigJsonToImage ($json, $options = array()) {
        $defaultOptions = array(
            'imageSize' => array(198, 55)
        ,'bgColour' => array(0xff, 0xff, 0xff)
        ,'penWidth' => 2
        ,'penColour' => array(0x14, 0x53, 0x94)
        ,'drawMultiplier'=> 12
        );
        $options = array_merge($defaultOptions, $options);
        $img = imagecreatetruecolor($options['imageSize'][0] * $options['drawMultiplier'], $options['imageSize'][1] * $options['drawMultiplier']);
        if ($options['bgColour'] == 'transparent') {
            imagesavealpha($img, true);
            $bg = imagecolorallocatealpha($img, 0, 0, 0, 127);
        } else {
            $bg = imagecolorallocate($img, $options['bgColour'][0], $options['bgColour'][1], $options['bgColour'][2]);
        }
        $pen = imagecolorallocate($img, $options['penColour'][0], $options['penColour'][1], $options['penColour'][2]);
        imagefill($img, 0, 0, $bg);
        if (is_string($json))
            $json = json_decode(stripslashes($json));
        foreach ($json as $v)
            ToolsFunctions::drawThickLine($img, $v->lx * $options['drawMultiplier'], $v->ly * $options['drawMultiplier'], $v->mx * $options['drawMultiplier'], $v->my * $options['drawMultiplier'], $pen, $options['penWidth'] * ($options['drawMultiplier'] / 2));
        $imgDest = imagecreatetruecolor($options['imageSize'][0], $options['imageSize'][1]);
        if ($options['bgColour'] == 'transparent') {
            imagealphablending($imgDest, false);
            imagesavealpha($imgDest, true);
        }
        imagecopyresampled($imgDest, $img, 0, 0, 0, 0, $options['imageSize'][0], $options['imageSize'][0], $options['imageSize'][0] * $options['drawMultiplier'], $options['imageSize'][0] * $options['drawMultiplier']);
        imagedestroy($img);
        return $imgDest;
    }

    //notify to George Of File Upload When that file pay but some paperwork is missing and is Pending For Vendor
    public static function notifyGeorgeOfFileUpload($project){
        $contract = $project->lastContractPaid();
        if($contract != "" && $contract['TYPE'] != 'IGUP' && $project->vendor != 1){
            $subj = 'New file uploaded to paid IIG/IMG pending sharing with vendor.';
            $msg = $subj."<br>";
            $msg .= date("m-d-Y H:i:s")."<br>";
            $msg .= "File #:".$project->lead->fileno."<br>";
            $msg .= "Pin: ".$project->id."<br>";
            SendEmailHelper::send([], '', 'george@ownmyinvention.com', 'info@ownmyinvention.com', '', 'info@ownmyinvention.com', $subj, $msg,$subj);
        }
    }

    public static function curl($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        $data = curl_exec($ch);
        curl_close($ch);

        return $data;
    }

    //obtain welcome package info for PDFController
    public static function obtainWPInfo($projectId){

        $data['Payment_Amount__c']=0;
        $data['Payment_Type__c']='';
        $data['Amount_Paid_to_Date__c']=0;
        $data['CC_Auth_Code_Comments__c']='';
        $project = Project::find($projectId);
        if($project!=null)
        {
            $lasContract = $project->lastContractPaid();
            if($lasContract!="")
            {
                $paymentTrans = PaymentTransaction::where('contract_id',$lasContract['ID'])->where('approved',1)->get();
                foreach($paymentTrans as $payment)
                {
                    $data['Payment_Amount__c'] +=$payment->amount;
                    $data['Payment_Type__c'] = $payment->source;
                    $data['Amount_Paid_to_Date__c'] += $payment->amount;
                    $data['CC_Auth_Code_Comments__c'] = $payment->source=="PAYPAL" ? $payment->subscriptionId : "Authorize.net - ".$payment->subscriptionId;
                }
                if($data['Payment_Amount__c']>0)
                    return $data;
            }
        }
        return 0;
    }

    public static function obtainPPAInfo($projectId){
        $project = Project::find($projectId);
        if($project!=null){
            $lasContract = $project->contractPPA();
            if($lasContract!=""){
                $data['PPA_Payment_Amount__c'] =$lasContract->paid;
                $data['PPA_Payment_Type__c'] = "";//$payment->source;
                $data['PPA_Contract_Amount__c'] = $lasContract->ppaTotalPrice();
                $data['PPA_Received_Date__c'] = $lasContract->paidDate;
                $data['PPA_Percentage_Paid__c']=100* $lasContract->paid / ($lasContract->ppaTotalPrice()>0?$lasContract->ppaTotalPrice():1);
                $data['PPA_Balance_Due__c']= $lasContract->ppaTotalPrice()-$lasContract->paid;
            }
        }
        return $data;
    }

    public static function changeOwnership($project){
        $auxId = [];
        $aux = array_fill(0,3,0);
        $consultants = Consultant::whereIn('usr',array('celeste','clint','james'))->get();
        $ids = "";
        foreach($consultants as $consultant){
            $ids .= strlen($ids) > 0 ? "," : "";
            $ids .= $consultant->id;

            if($consultant->usr == 'celeste')
                $auxId[0] = $consultant->id;
            if($consultant->usr == 'clint')
                $auxId[1] = $consultant->id;
            if($consultant->usr == 'james')
                $auxId[2] = $consultant->id;
        }

        $results = DB::select( DB::raw("SELECT consultant_id,COUNT(*) as cant FROM submission WHERE note = 'INCUBATOR' AND consultant_id IN ($ids) GROUP BY consultant_id") );

        foreach($results as $value){
            $aux[array_search($value->consultant_id, $auxId)] = $value->cant;
        }

        $top = 0;
        for($i=count($aux) - 1; $i >0; $i--){
            if($aux[$i] < $aux[$i-1]){
                $top = $i;
            }
        }
        $usr = $auxId[$top];

        //update project with new consultant
        $project->consultant_id = $usr;
        $project->status = 'UNLOADED';
        $project->save();

        //update lead with new consultant
        $lead = $project->lead;
        $lead->consultant_id = $usr;
        $lead->save();

        //create submission.
        Submission::createSubmission($project->id,$project->consultant_id,'REASSIGN',$lead->leadSource,'INCUBATOR');

        //Create Transaction
        Transaction::createTransaction($lead->consultant_id, $lead->id, '', 'REASSIGN-SUB-INCUBATOR', '', $project->id, $lead->email, '', '', $lead->phone, '');
    }

    public static function selectCampaignUser(){
        $auxId = [];
        $aux = array_fill(0,3,0);
        $consultants = Consultant::whereIn('usr',array('celeste','clint','james'))->get();
        $ids = "";
        foreach($consultants as $consultant){
            $ids .= strlen($ids) > 0 ? "," : "";
            $ids .= $consultant->id;

            if($consultant->usr == 'celeste')
                $auxId[0] = $consultant->id;
            if($consultant->usr == 'clint')
                $auxId[1] = $consultant->id;
            if($consultant->usr == 'james')
                $auxId[2] = $consultant->id;
        }

        $results = DB::select( DB::raw("SELECT consultant_id,COUNT(*) as cant FROM submission WHERE note = 'EMAIL CAMPAIGN' AND consultant_id IN ($ids) GROUP BY consultant_id") );

        foreach($results as $value){
            $aux[array_search($value->consultant_id, $auxId)] = $value->cant;
        }

        $top = 0;
        for($i=count($aux) - 1; $i >0; $i--){
            if($aux[$i] < $aux[$i-1]){
                $top = $i;
            }
        }
        return $auxId[$top];
    }

    public static function reassignLead($leadId,$consultantTo,$reason,$madeBy){

        $now =  date("Y-m-d h:i:s");
        $lead = Lead::find($leadId);
        $lead->consultant_id = $consultantTo;
        if($madeBy != 'assignOldLeadsAsNew21' || $madeBy != 'assignOldLeadsAsNew')
            $lead->last = $now;
        $lead->status = 'UNLOADED';
        $lead->save();
        //update message received about this lead to the new consultant
        Inbox::where('lead_id', $lead->id)->update(['consultant_id' => $consultantTo]);
        //create row in assignment
        Assignment::createAssignment($consultantTo,$lead->id,'REASSIGN','',$lead->leadSource,$reason);

        $projectId = '';
        $projects = Project::where('lead_id',$lead->id)->get();
        foreach($projects as $project){
            $project->consultant_id = $consultantTo;
            $project->status = 'UNLOADED';
            $project->save();
            //create the row in submission to keep record.
            Submission::createSubmission($project->id,$consultantTo,'REASSIGN',$lead->leadSource,'');
            $projectId = $project->id;
        }
        //Create Transaction
        Transaction::createTransaction($consultantTo, $lead->id, $madeBy, 'REASSIGN-LEAD-BY-ADMIN', $reason, $projectId, $lead->email, '', '', $lead->phone, '');
    }
}
