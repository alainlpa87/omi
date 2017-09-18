<?php
/**
 * Created by PhpStorm.
 * User: Alain
 * Date: 10/6/2015
 * Time: 1:25 PM
 */

namespace App\Helpers;

use App\Models\Consultant;
use App\Models\Lead;
use App\Models\Project;
use Plivo\RestAPI;

class PlivoHelper {

    //Send SMS to consultant when they receive a lead.
    public static function consultantSmsOutPerLead($consultantId,$leadId)
    {
        $consultant = Consultant::find($consultantId);
        if ($consultant != null) {
            if($consultant->notino != ''){
                $lead = Lead::find($leadId);
                if ($lead != null) {
                    $p = new RestAPI('MAOGNKN2I4NTMYY2Q3YM', 'NmNjN2ZmMzBmN2RhNDM1MWYxZWQzYWExZThhZWMz');
                    $params = array(
                        'src' => '17863221087',
                        'dst' => str_pad(preg_replace('/\D+/', '', $consultant->notino), 11, '1', STR_PAD_LEFT),
                        'text' => "New lead!\r\n\r\nName:".$lead->fname." ".$lead->lname."\r\n\r\nState:".$lead->state."\r\n\r\nPhone:".$lead->phone."\r\n\r\nFILENO: $lead->fileno",
                        'type' => 'sms',
                    );
                    $p->send_message($params);
                    return "1";
                }
                return "0";
            }
        }
        return "0";
    }

    public static function sendSMS($phone,$msg)
    {
        $set = array(17864712293,17864538438,17864106994,17864106648,17864106007,17864756224,17864656547,17864656561,17864656571,17864656599,17864656603,17864656607,17864656794,17864710367,17864712038,17864752406);
        $from = $set[array_rand($set)];
        $p = new RestAPI('MAOGNKN2I4NTMYY2Q3YM', 'NmNjN2ZmMzBmN2RhNDM1MWYxZWQzYWExZThhZWMz');
        $params = array(
            'src' => $from,
            'dst' => str_pad(preg_replace('/\D+/', '', $phone), 11, '1', STR_PAD_LEFT),
            'text' => $msg,
            'type' => 'sms',
        );
        $p->send_message($params);
        return "1";
    }

//Send SMS to consultant when they receive a lead.
    public static function consultantSmsOutPerPayment($consultantId,$projectId,$amount)
    {
        $consultant = Consultant::find($consultantId);
        if ($consultant != null) {
            $project = Project::find($projectId);
            if ($project != null) {
                $p = new RestAPI('MAOGNKN2I4NTMYY2Q3YM', 'NmNjN2ZmMzBmN2RhNDM1MWYxZWQzYWExZThhZWMz');
                $today = date("Y-m-d H:i:s");
                $params = array(
                    'src' => '17863221087',
                    'dst' => str_pad(preg_replace('/\D+/', '', $consultant->notino), 11, '1', STR_PAD_LEFT),
                    'text' => $today."\r\n\r\nNew Payment!\r\n\r\nFile:".$project->lead->fileno."\r\n\r\nPin:".$project->id."\r\n\r\nAmount:".$amount,
                    'type' => 'sms',
                );
                $p->send_message($params);
                return "1";
            }
            return "0";
        }
        return "0";
    }
}
