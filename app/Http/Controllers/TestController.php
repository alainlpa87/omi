<?php namespace App\Http\Controllers;


use App\Helpers\ToolsFunctions;
use App\Models\AttClientServices;
use App\Models\Consultant;
use App\Models\Contract;
use App\Models\Ilc;
use App\Models\Inbox;
use App\Models\Lead;
use App\Models\PhoneByState;
use App\Models\PpaPricesPlan;
use App\Models\Project;
use App\Models\ProjectClientServices;
use App\Models\Transaction;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use LynX39\LaraPdfMerger\PDFManage;
use Plivo\RestAPI;
use DB;
class TestController extends Controller {

    public function __construct(){}

    //create PDFs with DomPDF
    public function methodOne(){

        //using the facade PDF (not tested)
        /*
            $pdf = PDF::loadView('pdf.invoice', $data);
            return $pdf->download('invoice.pdf');
        */

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML(view('templates.ilc.empty_mail_ilc_invProfile_template_pdf',array())->render());
        return $pdf->stream();
    }

    //Merging PDFs
    public function methodTwo(){
        $pdf = new PDFManage();

        $pdf->addPDF('files/projects/signed_docusign_IGUP.pdf', 'all');
        $pdf->addPDF('files/projects/submission_REJECTED.pdf', 'all');
        $pdf->addPDF('files/projects/submission_APPROVED.pdf', 'all');

//You can optionally specify a different orientation for each PDF
        /*$pdf->addPDF('samplepdfs/one.pdf', '1, 3, 4', 'L');
        $pdf->addPDF('samplepdfs/two.pdf', '1-2', 'P');*/

        $pdf->merge('file', $_SERVER['DOCUMENT_ROOT'].'/3.0/public/files/projects/test.pdf', 'P');

        // REPLACE 'file' WITH 'browser', 'download', 'string', or 'file' for output options
        // Last parameter is for orientation (P for protrait, L for Landscape).
        // This will be used for every PDF that doesn't have an orientation specified
    }

    //plivo
    public function methodThree()
    {
        $auth_id = "MAOGNKN2I4NTMYY2Q3YM";  //PSUSA
        $auth_token = "NmNjN2ZmMzBmN2RhNDM1MWYxZWQzYWExZThhZWMz";  //PSUSA

        $p = new RestAPI($auth_id, $auth_token);
        $params = array(
            'to' => '17867037229',
            'from' => '17862940557',
            'answer_url' => route('idle', ['HOME' => '1', 'USR' => 16]),
            'hangup_url' => route('bossEnd', ['USR' => 16]),
            'caller_name' => 'DIALER',
            'answer_method' => 'GET',
            'hangup_method' => 'GET');
        $p->make_call($params);
    }


    public function methodFour(){
        $pCS = ProjectClientServices::find(154);
        $project = Project::find('8305');
        $client = Consultant::find(16);
        if($project->coInventor== "")
            $coInvCount = 0;
        else
            $coInvCount = count(explode(',',$project->coInventor));
        $sheetsCount = 0;
        if($coInvCount>0) {
            $sheetsCount = round($coInvCount / 3);
            if ($coInvCount % 3 > 0)
                $sheetsCount++;
        }
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML(view('templates.client_services.mail_poa_template_pdf',array('client'=>$project->lead,'fileno'=>'664930','project'=>$project,'attorney'=>$client, 'pcs'=>$pCS, 'invName'=>($project->lead->fname." ".$project->lead->lname),'coInvIndex'=>0, 'coInvs'=>$coInvCount,'coInvCount'=>count($coInvCount),'design'=>0))->render());
        return $pdf->stream();
        //test
    }
}
