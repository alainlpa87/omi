<?php
/**
 * Created by PhpStorm.
 * User: Alain
 * Date: 10/6/2015
 * Time: 1:25 PM
 */

namespace App\Helpers;

use App\Models\PpaPricesPlan;
use App\Models\Project;
use App\Models\ProjectProduction;
use App\Models\Transaction;
use Illuminate\Support\Facades\App;
use App\Models\Consultant;
use App\Models\Contract;
use App\Models\Lead;
use App\Models\UploadedFiles;
use Illuminate\Support\Facades\File;

class CreateContractSignedHelper {

    //generate the contract with name and data but without the signature to send it to docusign and allow to sign (Similar method: PDFController::reviewPDF) mailed version
    public static function prepareContractForDocusign($contract,$price)
    {
        //send the different price of the plans
        $prices = PpaPricesPlan::where('plan1', 'like',$price)->orWhere('plan2', 'like',$price)->orWhere('plan3', 'like',$price)->first();
        $name="";
        switch($contract->type)
        {
            case "IMG":
            {
                $content = view('templates.docusign_img_template_pdf',array('project'=>$contract->project,'price'=>$price,'prices'=>$prices))->render();
                $name="docusign_IMG";
                break;
            }
            case "IIG":
            {
                $content = view('templates.docusign_iig_template_pdf',array('contract'=>$contract,'project'=>$contract->project,'price'=>$price,'prices'=>$prices))->render();
                $name="docusign_IIG";
                if($contract->iigUpgrade == 1){
                    $name="docusign_IIG_upgrade";
                }
                break;
            }
            case "IGUP":
            {
                $content = view('templates.docusign_upgrade_template_pdf',array('project'=>$contract->project,'price'=>$price,'prices'=>$prices))->render();
                $name="docusign_IGUP";
                break;
            }
        }
        if(!File::exists("files/projects/".$contract->project->lead->fileno."/".$contract->project->id)) {
            File::makeDirectory("files/projects/".$contract->project->lead->fileno."/".$contract->project->id, 0755, true);
        }
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($content);
        $location = "files/projects/".$contract->project->lead->fileno."/".$contract->project->id."/$name.pdf";
        $pdf->save($location);
        return $location;
    }

    public static function prepareLetterOfEngForDocusign($project,$projectProd)
    {
        $att = $projectProd->attorney();
        if($att != null){
            if(!File::exists("files/projects/".$project->lead->fileno."/".$project->id)) {
                File::makeDirectory("files/projects/".$project->lead->fileno."/".$project->id, 0755, true);
            }
            $pdf = App::make('dompdf.wrapper');
            $pdf->loadHTML(view('templates.docusign_letterOfEng_template_pdf',array('client'=>$project->lead,'attorney'=>$att))->render());
            $location = "files/projects/".$project->lead->fileno."/".$project->id."/docusign_letterOfEngagement.pdf";
            $pdf->save($location);
            return $location;
        }
        return "";
    }

    //generate the PPA contract with name and data but without the signature to send it to docusign and allow to sign
    public static function preparePPAContractForDocusign($contract,$contractTypeBlade,$plans)
    {
        if(!File::exists("files/projects/".$contract->project->lead->fileno."/".$contract->project->id)) {
            File::makeDirectory("files/projects/".$contract->project->lead->fileno."/".$contract->project->id, 0755, true);
        }
        $pdf = App::make('dompdf.wrapper');
        if($contractTypeBlade == 'Provisional')
            $contractTypeBlade = 'IMG';
        $pdf->loadHTML(view('templates.client_services.docusign_ppa_'.$contractTypeBlade.'_template_pdf',array('contract'=>$contract,'project'=>$contract->project,'plans'=>$plans))->render());
        $location = "files/projects/".$contract->project->lead->fileno."/".$contract->project->id."/docusign_ppa.pdf";
        $pdf->save($location);
        return $location;
    }

    public static function generateSoldReport ($contract){

        $paidDate = date('m-d-Y',strtotime(str_replace('-','/',$contract->signedDate)));
        $personal_info = strlen($contract->project->lead->birth) > 0 ?"Date of Birth: ".$contract->project->lead->birth:"";
        $personal_info .= strlen($personal_info) >0 && strlen($contract->project->lead->spouse) > 0 ?"; ".("Spouse Name: ".$contract->project->lead->spouse):
            (strlen($contract->project->lead->spouse) > 0?("Spouse Name: ".$contract->project->lead->spouse):"");
        $personal_info .= strlen($personal_info) >0 && strlen($contract->project->lead->children) > 0 ?"; ".("Children's names: ".$contract->project->lead->children):
            (strlen($contract->project->lead->children) > 0?("Children's names: ".$contract->project->lead->children):"");
        $personal_info .= strlen($personal_info) >0 && strlen($contract->project->lead->degree) > 0 ?"; ".("Degree/Diploma: ".$contract->project->lead->degree):
            (strlen($contract->project->lead->degree) > 0?("Degree/Diploma: ".$contract->project->lead->degree):"");
        $personal_info .= strlen($personal_info) >0 && strlen($contract->project->lead->college) > 0 ?"; ".("Education: ".$contract->project->lead->college):
            (strlen($contract->project->lead->college) > 0?("Education: ".$contract->project->lead->college):"");
        $personal_info .= strlen($personal_info) >0 && strlen($contract->project->lead->profession) > 0 ?"; ".("Profession: ".$contract->project->lead->profession):
            (strlen($contract->project->lead->profession) > 0?("Profession: ".$contract->project->lead->profession):"");
        $personal_info .= strlen($personal_info) >0 && strlen($contract->project->lead->hobby) > 0 ?"; ".("Hobbies: ".$contract->project->lead->hobby):
            (strlen($contract->project->lead->hobby) > 0?("Hobbies: ".$contract->project->lead->hobby):"");
        $adminNotes = "";
        $pdf = App::make('dompdf.wrapper');
        $content = view('templates.sold_report_template_pdf',array('contract'=>$contract,'personal_info'=>$personal_info,'admin_notes'=>$adminNotes,'paidDate'=>$paidDate))->render();
        $pdf->loadHTML($content);
        $pdf->save("files/projects/".$contract->project->lead->fileno."/".$contract->project->id."/sold_".$contract->type.".pdf");
        Transaction::createTransaction($contract->project->lead->consultant_id, $contract->project->lead->id, '', 'SOLD-REPORT-CREATED', '', '', $contract->project->lead->email, '', '', $contract->project->lead->phone, '');
        $uploadFile = UploadedFiles::where(array('project_id'=>$contract->project->id,'fileName'=>"sold_".$contract->type.".pdf"))->first();
        if($uploadFile == null)
        {
            $uploadFile = new UploadedFiles();
            $uploadFile->project_id = $contract->project->id;
            $uploadFile->url = "files/projects/".$contract->project->lead->fileno."/".$contract->project->id."/sold_".$contract->type.".pdf";
            $uploadFile->fileName = "sold_".$contract->type.".pdf";
            $uploadFile->internal = 1;
        }
        $uploadFile->save();
    }

    public static function generatePatentApplicationConsent ($project,$patentType){

        $lead = $project->lead;
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML('<p align="center" class="padd_cover">
                    <img src="'.asset("img/logo.png").'" alt="" name="Object1" width="150" height="116" id="Object1" align="center">
                    <br><i style="font-size: 14px;color: darkblue;">Giving the edge to Inventors!</i>
                    </p>
                    <br><br><br>
                    <table align="center" width="100%">
                    <tr><td>Patent Services</td></tr>
                    <tr><td>12000 Biscayne Blvd Suite # 700</td></tr>
                    <tr><td>North Miami, FL 33181</td></tr>
                    <tr><td>&nbsp;</td></tr>
                    <tr><td>Client FILENO: '.$lead->fileno.'</td></tr>
                    <tr><td>Client Name: '.$lead->fname.' '.$lead->lname.'</td></tr>
                    <tr><td>Client Address: '.$lead->street.', '.$lead->city.', '.$lead->state.', '.$lead->zip.'</td></tr>
                    <tr><td>IP Address: '.$_SERVER['REMOTE_ADDR'].'</td></tr></table><br>
                    <table align="center" width="100%">
                    <tr>
                    <td>
                    <p>Please note that this '.$patentType.' Patent Application is required to be approved before filing it with the USPTO.</p>
                    </td>
                    </tr>
                    <tr>
                    <td>
                    <p>[X] I, '.$lead->fname.' '.$lead->lname.' approve the drafted '.$patentType.' patent application to be submitted to the United States Patent and Trademark Office.</p>
                    </td>
                    </tr>
                    <tr>
                    <td>
                    <p>[ ] I, '.$lead->fname.' '.$lead->lname.' do not approve the drafted '.$patentType.' patent application.</p>
                    </td>
                    </tr>
                    <tr>
                    <td>
                    <p>&nbsp;</p>
                    </td>
                    </tr>
                    <tr>
                    <td>
                    <p>The Inventor acknowledges their consent to this document via Electronic Signature.
                    This document and any counterparts to this document will be deemed an original. To expedite the
                    submittal of this Document, the Inventor acknowledges that Electronic Transmissions of the Document
                    will be equivalent to original documents. "Electronic Transmission" will mean copies that are
                    reproduced or transmitted as complete and accurate reproductions and transmissions of this original.
                    Signatories have the option to opt out and sign with a paper signature instead.</p>
                    </td>
                    </tr>
                    </table>
                    <br><br><br>
                    <table align="center" width="98%" style="">
                    <tr style="">
                        <td colspan="2"><img style="position: absolute;top: -4px !important;margin-left: 50px" src="'.asset("files/projects/".$lead->fileno."/signature_mE.jpg").'">
                        <br>
                        <p style="margin-top: 0px !important;z-index: 100;">Signature: ___________________</p></td>
                        <p style="margin-top: 0px !important;z-index: 100;">Client Name: '.$lead->fname.' '.$lead->lname.'</p></td>
                        <td>Date: '.date('m-d-Y').'</td>
                    </tr>
                    </table>');
        $docname = $lead->fileno."_".$patentType."_"."Patent_Application_Consent.pdf";
        $pdf->save("files/projects/".$lead->fileno."/".$project->id."/".$docname);

        $uploadFile = UploadedFiles::where(array('project_id'=>$project->id,'fileName'=>$docname))->first();
        if($uploadFile == null)
        {
            $uploadFile = new UploadedFiles();
            $uploadFile->project_id = $project->id;
            $uploadFile->url = "files/projects/".$lead->fileno."/".$project->id."/$docname";
            $uploadFile->fileName = $docname;
            $uploadFile->public = 1;
            $uploadFile->save();
        }
    }
}