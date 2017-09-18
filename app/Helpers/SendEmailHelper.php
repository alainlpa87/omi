<?php
/**
 * Created by PhpStorm.
 * User: Alain
 * Date: 10/6/2015
 * Time: 1:25 PM
 */

namespace App\Helpers;

use App\Models\Transaction;

class SendEmailHelper {

    public static function send($files, $path, $mailto, $from_mail, $from_name, $replyto, $subject, $message,$title){

        $mail_bodyret = '<div style="width:650px; border:3px solid #0372A0; background-color:#F6F0E8 padding: 10px;">
        <div style="padding:5px 5px;background-color:#fff;text-align: left"><img src="'.asset("/img/social/logo2.png").'" width="299" height="56"/></div>
        <div style="font-family: Helvetica;padding:5px 5px;color:#fff; background-color:#292929;text-align: left">'.$title.'</div><div style="padding: 25px 10px 5px 10px;"><div style="font-family: arial;padding:10px 0 0 11px;">'.$message.'</div>
        </div><div style="background-color: #64AED9;color:#fff;text-align: center;"><span style="color:#fff;font-family: arial;font-size: 17px;padding-top: 10px;display: block">Want to stay updated about the world of inventions and patents?<br/></span>
        <span style="color:#fff;font-family: arial;font-size: 15px;padding-top: 10px;display: block">Simply follow us on<br/></span><span style="padding-top: 20px;display: block">
        <a target="_blank" href="http://www.facebook.com/PatentServicesUSA"><img style="vertical-align:middle;margin-left:10px;" src="'.asset("/img/social/fb.png").'"/></a>
        <a target="_blank" href="https://plus.google.com/+OwnMyInvention"><img style="vertical-align:middle;margin-left:10px;" src="'.asset("/img/social/g+.png").'"/></a>
        <a target="_blank" href="https://www.linkedin.com/company/patent-services-usa"><img style="vertical-align:middle;margin-left:10px;" src="'.asset("/img/social/linkedin.png").'"/></a>
        <a target="_blank" href="https://twitter.com/PatSvcUSA"><img style="vertical-align:middle;margin-left:10px;" src="'.asset("/img/social/twitter.png").'"/></a>
        <a target="_blank" href="http://www.pinterest.com/PatSvcUSA"><img style="vertical-align:middle;margin-left:10px;" src="'.asset("/img/social/pintreste.png").'"/></a>
        </span><span style="color:#fff;font-family: arial;font-size: 15px;padding-top: 1px;padding-bottom: 10px;display: block"><br/>and you will never miss an update!</span></div></div>';

        $semi_rand = md5(time());
        $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";
        $headers = "From: $from_name <$from_mail>\n";
        $headers .= "Reply-To: $replyto";
        if($from_mail == 'clientservices@ownmyinvention.com'){
            $headers .= "Cc:clientservices@ownmyinvention.com\n";
        }elseif ($from_mail == "production@ownmyinvention.com"){
            $headers .= "Cc:production@ownmyinvention.com\n";
        }
        $headers .= "MIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\"";

        // multipart boundary
        $message = "This is a multi-part message in MIME format.\n\n" . "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"iso-8859-1\"\n" . "Content-Transfer-Encoding: 7bit\n\n" . $mail_bodyret . "\n\n";
        $message .= "--{$mime_boundary}\n";

        // preparing attachments
        for($x=0;$x<count($files);$x++){
            $filePath = $path.$files[$x];
            $file = fopen($filePath,"r");
            $data = fread($file,filesize($filePath));
            fclose($file);
            $data = chunk_split(base64_encode($data));
            $message .= "Content-Type: {\"application/octet-stream\"};\n" . " name=\"".$files[$x]."\"\n" .
                "Content-Disposition: attachment;\n" . " filename=\"".$files[$x]."\"\n" .
                "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n";
            $message .= "--{$mime_boundary}\n";
        }
        return mail($mailto, $subject, $message, $headers);
    }

    public static function only1EmailPerWeek($leadId){
        $count = Transaction::where(['transtype'=>'EMAIL','lead_id'=>$leadId])->whereIn('params', array('SUBKIT', 'CONSINFO', 'TTRY','LINK'))->where('created_at','>=',date('Y-m-d H:i:s', strtotime('-7 days')))->count();
        if($count > 0)
            return false;
        return true;
    }

    public static function senIlc($files, $path, $mailto, $from_mail, $from_name, $replyto, $subject, $message,$title,$copias){

        $mail_bodyret = '<div style="width:650px; border:3px solid #0372A0; background-color:#F6F0E8 padding: 10px;">
        <div style="padding:5px 5px;background-color:#fff;text-align: center"><img src="'.asset("img/ilc_logo.jpg").'" width="259" height="86"/></div>
        <div style="font-family: Helvetica;padding:5px 5px;color:#fff; background-color:#292929;text-align: left">'.$title.'</div><div style="padding: 25px 10px 5px 10px;"><div style="font-family: arial;padding:10px 0 0 11px;">'.$message.'</div>
        </div></div>';

//        <div style="background-color: #64AED9;color:#fff;text-align: center;"><span style="color:#fff;font-family: arial;font-size: 17px;padding-top: 10px;display: block">Want to stay updated about the world of inventions and patents?<br/></span>
//        <span style="color:#fff;font-family: arial;font-size: 15px;padding-top: 10px;display: block">Simply follow us on<br/></span><span style="padding-top: 20px;display: block">
//        <a target="_blank" href="http://www.facebook.com/PatentServicesUSA"><img style="vertical-align:middle;margin-left:10px;" src="'.asset("/img/social/fb.png").'"/></a>
//        <a target="_blank" href="https://plus.google.com/+OwnMyInvention"><img style="vertical-align:middle;margin-left:10px;" src="'.asset("/img/social/g+.png").'"/></a>
//        <a target="_blank" href="https://www.linkedin.com/company/patent-services-usa"><img style="vertical-align:middle;margin-left:10px;" src="'.asset("/img/social/linkedin.png").'"/></a>
//        <a target="_blank" href="https://twitter.com/PatSvcUSA"><img style="vertical-align:middle;margin-left:10px;" src="'.asset("/img/social/twitter.png").'"/></a>
//        <a target="_blank" href="http://www.pinterest.com/PatSvcUSA"><img style="vertical-align:middle;margin-left:10px;" src="'.asset("/img/social/pintreste.png").'"/></a>
//        </span><span style="color:#fff;font-family: arial;font-size: 15px;padding-top: 1px;padding-bottom: 10px;display: block"><br/>and you will never miss an update!</span></div>

        $semi_rand = md5(time());
        $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";
        $headers = "From: $from_name <$from_mail>\n";
        $headers .= "Reply-To: $replyto"."\n";
        if($copias!='')
            $headers .= "Bcc:".$copias."\n";
        $headers .= "MIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\"";

        // multipart boundary
        $message = "This is a multi-part message in MIME format.\n\n" . "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"iso-8859-1\"\n" . "Content-Transfer-Encoding: 7bit\n\n" . $mail_bodyret . "\n\n";
        $message .= "--{$mime_boundary}\n";

        // preparing attachments
        for($x=0;$x<count($files);$x++){
            $filePath = $path.$files[$x];
            $file = fopen($filePath,"r");
            $data = fread($file,filesize($filePath));
            fclose($file);
            $data = chunk_split(base64_encode($data));
            $message .= "Content-Type: {\"application/octet-stream\"};\n" . " name=\"".$files[$x]."\"\n" .
                "Content-Disposition: attachment;\n" . " filename=\"".$files[$x]."\"\n" .
                "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n";
            $message .= "--{$mime_boundary}\n";
        }
        return mail($mailto, $subject, $message, $headers);
    }
}