<?php namespace App\Http\Controllers;

use App\Helpers\ToolsFunctions;
use App\Models\Contract;
use App\Models\Project;
use App\Models\Request;
use App\Models\Transaction;
use App\Models\UploadedFiles;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;

class PDFController extends Controller {


    /*
     * To Allow use the controller methods the current user logged has to be Consultant
     */
    public function __construct()
    {

    }
    /**
     * Show IMG,IGG, UPGRADE or WP PDF to review
     * (Similar method: CreateContractSignedHelper::prepareContractForDocusign) for signature online
     * @return Response
     */
    public function reviewPDF()
    {
        $id = Input::get('ID');
        $price = Input::get('PRICE');
        $type = Input::get('TYPE');
        $project = Project::find($id);
        if($project!=null)
        {
            $pdf = App::make('dompdf.wrapper');
            switch($type)
            {
                case "IMG":
                {
                    $content = view('templates.mail_img_template_pdf',array('project'=>$project,'price'=>$price));
                    $name="contract_img";
                    break;
                }
                case "IIG":
                {
                    $content = view('templates.mail_iig_template_pdf',array('project'=>$project,'price'=>$price));
                    $name="contract_iig";
                    break;
                }
                case "IGUP":
                {
                    $content = view('templates.mail_upgrade_template_pdf',array('project'=>$project,'price'=>$price));
                    $name="contract_upgrade";
                    break;
                }
                case "WP":
                {
                    $data = ToolsFunctions::obtainWPInfo($project->id);
                    $showMore = 0;
                    $contractIIG = $project->contracts()->where('type',"IIG")->first();
                    $contractIGUP = $project->contracts()->where('type',"IGUP")->first();
                    if($contractIIG!=null && $contractIIG->paid == $contractIIG->price)
                        $showMore = 1;
                    if($contractIGUP!=null && $contractIGUP->paid == $contractIGUP->price)
                        $showMore = 1;
                    $content = view('templates.wp_template_pdf',array('project'=>$project,'showMore'=>$showMore,'dataSF'=>$data));
                    $name="contract_wp";
                    $price="-1";
                    break;
                }
            }
            if(!File::exists("files/projects/".$project->lead->fileno."/".$project->id)) {
                File::makeDirectory("files/projects/".$project->lead->fileno."/".$project->id, 0755, true);
            }
            $pdf->loadHTML($content);
            $pdf->save("files/projects/".$project->lead->fileno."/".$project->id."/$name.pdf");
            //Create Transaction
            Transaction::createTransaction($project->consultant_id,  $project->lead->id, '',"GENERATED-CONTRACT", $price, $id, $project->lead->email, $type, '', $project->lead->phone, '');
            return $pdf->stream();
        }
        return "-1";
    }
    /**
     * Save MG,IGG, UPGRADE or WP PDF into project's folder
     *
     * @return Response
     */
    public function saveContract()
    {
        $id = Input::get('ID');
        $price = Input::get('PRICE');
        $type = Input::get('TYPE');
        $request = Input::get('REQUEST');
        $send = Input::get('SEND');
        $project = Project::find($id);
        if($project!=null)
        {
            $contract = $project->contracts()->where('type',$type)->first();
            if($contract==null)
            {
                $contract = new Contract();
                $contract->project_id = $id;
                $contract->type = $type;
            }
            $contract->sendBy = $request;
            $contract->price = $price;
            $contract->consultant_id = $project->consultant_id;
            $contract->created_at = date("Y-m-d H:i:s");
            $contract->save();

            //Save files in uploadFiles folder
            $nameFile = "";
            switch($type)
            {
                case "IMG":
                {
                    $nameFile="contract_img.pdf";
                    break;
                }
                case "IIG":
                {
                    $nameFile="contract_iig.pdf";
                    break;
                }
                case "IGUP":
                {
                    $nameFile="contract_upgrade.pdf";
                    break;
                }
                case "WP":
                {
                    $nameFile="contract_wp.pdf";
                    break;
                }
            }
            $uploadFile = UploadedFiles::where(array('project_id'=>$id,'fileName'=>$nameFile))->first();
            if($uploadFile == null)
            {
                $uploadFile = new UploadedFiles();
                $uploadFile->project_id = $id;
                $uploadFile->public = 1;
                $uploadFile->internal = 1;
            }
            $uploadFile->url = "files/projects/".$project->lead->fileno."/".$project->id."/$nameFile";
            $uploadFile->fileName = $nameFile;
            $uploadFile->save();

            if($request=="EMAIL")
            {
                if($send == 1)
                {
                    //Create Transaction
                    Transaction::createTransaction($project->consultant_id, $project->lead->id, '',"EMAILED-CONTRACT", $price, $id, $project->lead->email, $type, '', $project->lead->phone, '');
                    $url = url("sendContract?CTYPE=$type&PROJECT=$id");
                    ToolsFunctions::curl($url);
                }
                else
                {
                    //Create Transaction
                    Transaction::createTransaction($project->consultant_id, $project->lead->id, '',"WEB-CONTRACT", $price, $id, $project->lead->email, $type, '', $project->lead->phone, '');
                }
            }
            else
            {
                $requestAdmin = $project->requests()->where(array('consultantStage'=>"SEND $type",'adminStage'=>''))->first();
                if($requestAdmin==null)
                {
                    $requestAdmin = new Request();
                    $requestAdmin->project_id = $id;
                    $requestAdmin->request = "ADMIN";
                    $requestAdmin->consultantStage = "SEND $type";
                }
                $requestAdmin->save();
                //Create Transaction
                Transaction::createTransaction($project->consultant_id, $project->lead->id, '',"REQUESTED-CONTRACT", $price, $id, $project->lead->email, $type, '', $project->lead->phone, '');
            }
            return "1";
        }
        return "-1";
    }
}
