<?php namespace App\Http\Controllers;

use App\Models\Consultant;
use App\Models\Contract;
use App\Models\Lead;
use App\Models\LeadCampain;
use App\Models\PaymentTransaction;
use App\Models\Project;
use App\Models\ProjectClientServices;
use App\Models\ProjectProduction;
use App\Models\UploadedFiles;
use App\Models\ClientSNotes;
use DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;


class IntranetController extends Controller {

    public function __construct()
    {

    }

    public function testA(){


        /*$project = Project::find('8305');
        $aux_plans = array();
        for($i=0;$i<12;$i++){
            if($project->contractPPA()->ppaPlans!="" && in_array($i+1,explode(',',$project->contractPPA()->ppaPlans)))
                $aux_plans[$i] =true;
            else
                $aux_plans[$i] =false;
        }
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML(view('templates.client_services.docusign_ppa_U_D_template_pdf',array('contract'=>$project->contractPPA(),'project'=>$project,'plans'=>$aux_plans))->render());
        return $pdf->stream();*/



//        $notes= 'testing';
//        $files = array();
//        $files[] = 53160;
//        $files[] = 38163;
//        $serialized_ids= urlencode(serialize($files));
//
//        $result = file_get_contents(url("emailReturnedApp?ID=154&AT_ID=2&NOTES=".urlencode($notes)."&FILES=".$serialized_ids));
//        print_r($result);

        $project = Project::find('8305');
        $client = Consultant::find(9);


        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML(view('templates.client_services.docusign_ddr_template_pdf',array('client'=>$project->lead,'project'=>$project))->render());
        return $pdf->stream();


    }

    public function testGenerateDeclarationAndMicroEntity()
    {
        $project = Project::find(20801);
/*******************        Generate Declaration document for a client  ************************************/

        $client = $project->lead;
        $document= 'declarationU';
        $name = $document;
        $pCS=$project->clientServicesProject();
        $att = Consultant::find($pCS->attorney_id);
        if($project->coInventor== "")
            $coInvCount = 0;
        else
            $coInvCount =count(explode(',',$project->coInventor));
        $sheetsCount = 0;
        if($coInvCount>0) {
            $sheetsCount = round($coInvCount / 3);
            if ($coInvCount % 3 > 0)
                $sheetsCount++;
        }
        if($document == 'declarationD')
            $content = view('templates.client_services.mail_declaration_template_pdf',array('client'=>$client,'project'=>$project,'pcs'=>$pCS ,'fileno'=>$client->fileno,'attorney'=>$att,'sheetsCount'=>$sheetsCount,'design'=>1));
        else
            $content = view('templates.client_services.mail_declaration_template_pdf',array('client'=>$client,'project'=>$project,'pcs'=>$pCS ,'fileno'=>$client->fileno,'attorney'=>$att,'sheetsCount'=>$sheetsCount,'design'=>0));
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($content);
        $pdf->save("files/projects/".$client->fileno."/".$project->id."/".$name.".pdf");


        /*******************        Generate MicroEntity document for a client  ************************************/

        $client = $project->lead;
        $document= 'microEntityU';
        $coInvIndex = 0;//pk no tiene coinventor si tuviera se pone 1 o 2 segun el orden del coinventor que esta firmando
        $design =0;
        if($document == 'microEntityD'){
            $name = "certification_of_microEntityD";
            $design =1;
        }
        else if($document == 'microEntityU')
            $name = "certification_of_microEntityU";
        else if($document == 'microEntityP')
            $name = "certification_of_microEntityP";

        if($coInvIndex != null && $coInvIndex != 0)
            $name .="_coInv".$coInvIndex;

        $pCS=$project->clientServicesProject();
        $coInvs = explode(',',$project->coInventor);
        $content = view('templates.client_services.mail_microentity_template_pdf',
            array('client'=>$client,'project'=>$project, 'fileno'=>$client->fileno,'pcs'=>$pCS,'coInvIndex'=>$coInvIndex, 'coInvs'=>$coInvs,'design'=>$design));
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($content);
        $pdf->save("files/projects/".$client->fileno."/".$project->id."/".$name.".pdf");

        print 1;

    }


    public function generateIlcAgreement($fileno){
        $name = "ilc_agreement_signed";
        $pCS = ProjectClientServices::where('fileno',$fileno)->first();
        $project = $pCS->project;
        $time = str_replace('-','/',$pCS->marketingAgrSent_created_at);
        $time1 = strtotime($time);
        $effectiveDate = date('l jS F Y',$time1);
        $time21 = str_replace('-','/',$pCS->marketingAgrReceived_created_at);
        $time2 = strtotime($time21);
        $signedDate = date('m-d-Y',$time2);
        $prov_ut="";
        if($pCS->hasType('UT') || $pCS->hasType('UPG_UT'))
            $prov_ut="U";
        elseif($pCS->hasType('PROV'))
            $prov_ut="P";

//        file_get_contents(url("emailReceivedILC?ID=".$project->id));
        $coInvs = explode(',',$project->coInventor);
        if($project->coInventor== "")
            $coInvCount = 0;
        else
            $coInvCount = count($coInvs);
        $content = view('templates.client_services.mail_ILC_template_pdf',array('client'=>$project->lead,'fileno'=>$fileno,'effectiveDate'=>$effectiveDate,'prov_ut'=>$prov_ut,'coInvCount'=>$coInvCount,'coInvs'=>$coInvs,'signedDate'=>$signedDate));
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($content);
        $pdf->save("files/projects/".$fileno."/".$project->id."/".$name.".pdf");
        $uploadFile=UploadedFiles::where('project_id',$project->id)->where('fileName',"ilc_agreement_signed.pdf")->first();
        if($uploadFile != null){
            $uploadFile->delete();
        }
        $uploadFile = new UploadedFiles();
        $uploadFile->project_id = $project->id;
        $uploadFile->url = "files/projects/".$fileno."/".$project->id."/ilc_agreement_signed.pdf";
        $uploadFile->fileName = "ilc_agreement_signed.pdf";
        $uploadFile->save();
    }

    public function readFromCSV(){
        $emails = "";
        if (($gestor = fopen("files/imi.csv", "r")) !== FALSE)
        {
            while (($datos = fgetcsv($gestor, 1000, ",")) !== FALSE)
            {
                $email=$datos[1];
                $emails .= strlen($emails) > 0 ? "," : "";
                $emails .= $email;
            }
            fclose($gestor);
        }
        print_r($emails);
    }

//for leads with more than one project
    public function createWP()
    {
        $id = Input::get('ID');
        if($id != ""){
            $pdf = App::make('dompdf.wrapper');
            $project = Contract::find($id)->project;
            $data = [];
            $paymentTrans = PaymentTransaction::where('contract_id',$id)->where('approved',1)->get();
            foreach($paymentTrans as $payment)
            {
                $data['Payment_Amount__c'] =$payment->amount;
                $data['Payment_Type__c'] = $payment->source;
                $data['Amount_Paid_to_Date__c'] = $payment->amount;
                $data['CC_Auth_Code_Comments__c'] = $payment->source=="PAYPAL" ? $payment->subscriptionId : "Authorize.net - ".$payment->subscriptionId;
            }
            $showMore = 0;
            $contractIIG = $project->contracts()->where('type',"IIG")->first();
            $contractIGUP = $project->contracts()->where('type',"IGUP")->first();
            if($contractIIG!=null && $contractIIG->paid == $contractIIG->price)
                $showMore = 1;
            if($contractIGUP!=null && $contractIGUP->paid == $contractIGUP->price)
                $showMore = 1;
            $content = view('templates.wp_template_pdf',array('project'=>$project,'showMore'=>$showMore,'dataSF'=>$data));
            $name="contract_wp";

            if(!File::exists("files/projects/".$project->lead->fileno."/".$project->id)) {
                File::makeDirectory("files/projects/".$project->lead->fileno."/".$project->id, 0755, true);
            }
            $pdf->loadHTML($content);
            $pdf->save("files/projects/".$project->lead->fileno."/".$project->id."/$name.pdf");

            $uploadFile = UploadedFiles::where(array('project_id'=>$project->id,'fileName'=>$name."pdf"))->first();
            if($uploadFile == null)
            {
                $uploadFile = new UploadedFiles();
                $uploadFile->project_id = $project->id;
                $uploadFile->public = 1;
                $uploadFile->internal = 1;
            }
            $uploadFile->url = "files/projects/".$project->lead->fileno."/".$project->id."/$name.pdf";
            $uploadFile->fileName = $name.".pdf";
            $uploadFile->save();
            return $pdf->stream();
        }else{
            echo 'vacio';
        }

    }

    /*Reassign a number of leads and subs from one consultant to other*/
    public function reassignLeadsAndSub()
    {
        $from = 20;
        $to = 6;
        $limit = 3;
        $results = DB::select( DB::raw("SELECT lead.id AS lead, project.id AS project, fileno, project.consultant_id, lead.consultant_id
                    FROM  `project`
                    INNER JOIN lead ON project.lead_id = lead.id
                    WHERE project.consultant_id ='$from'
                    AND project.status NOT LIKE  'exclude'
                    AND project.stage NOT LIKE  'archive' limit $limit") );
        foreach($results as $res){
            DB::select(DB::raw("update `project` set `consultant_id`='$to' WHERE id = '$res->project'"));
            DB::select(DB::raw("update `lead` set `consultant_id`='$to' WHERE id = '$res->lead'"));
            print '<pre>'.$res->fileno.'</pre>';
        }
    }
    /*End Reassign a number of leads and subs from one consultant to other */

    /*Save in canpaign lead from csv*/
    public function saveFromFile()
    {
        //$name = Input::get('FILENAME');
        $fila=0;
        $noEstan = '';
        if (($gestor = fopen("files/leadsliven.csv", "r")) !== FALSE)
        {
            while (($datos = fgetcsv($gestor, 1000, ",")) !== FALSE)
            {
                //$fila++;
                $email=$datos[3];

                if($email!=="email")
                {
                    $lead = Lead::where(['email'=>$email])->first();
                    if($lead == null) {
                        $phone=$datos[4];
                        $lead = Lead::where('phone','like',"%$phone%")->first();
                        if($lead != null) {
                            print $lead->email . " --> " . $lead->leadSource . " --> " . $lead->created_at.'<br>';
                        }else{
                            $noEstan .= $email.'<br>';
                        }
                    }
                }
            }
            echo "<br><br><br><br>".$noEstan;
            fclose($gestor);
        }
    }
    /*End Save in canpaign lead from csv*/

    /*Email campaign */
    public function showUnsubscribePage()
    {
        return view('intranet.extra.unsubscribe',array('first_time'=>1));
    }
    public function unsubscribeNow()
    {
        $email = Input::get('email');
        $leadC = LeadCampain::where('email',$email)->first();
        if($leadC!=null)
        {
            $leadC->delete = 1;
            $leadC->save();
        }
        return view('intranet.extra.unsubscribe',array('first_time'=>0,'message'=>$email.' was unsubscribe successfully.'));
    }
    /*End Email campaign */

    /*fill production table*/
    public function createFromFile()
    {
        $attorney30 = Consultant::where('usr','jk_attorney')->first();
        $attorney45 = Consultant::where('usr','jh_attorney')->first();
        $writer = Consultant::where('rol','LIKE','%writer%')->first();
        $university = Consultant::where('rol','LIKE','%university%')->first();
        $designer = Consultant::where('rol','LIKE','%designer%')->first();

        $files="1/22/2016,713056,K,3/11/2016;
2/9/2016,714588,Y/J,4/5/2016;
2/9/2016,669898,Y/J,4/5/2016;
2/9/2016,714795,Y/J,4/5/2016;
2/9/2016,710278,Y/J,4/5/2016;
2/10/2016,715383,Y/J,4/6/2016;
2/10/2016,711982,Y/J,4/6/2016;
2/11/2016,711153,Y/J,4/7/2016;
2/11/2016,710734,J,4/7/2016;
2/11/2016,708314,Y/J,4/7/2016;
2/11/2016,711734,K,4/7/2016;
2/12/2016,715330,K,4/8/2016;
2/12/2016,713470,K,4/8/2016;
2/12/2016,711949,J,4/8/2016;
2/29/2016,715843,,4/11/2016;
2/16/2016,700640,Y/J,4/12/2016;
2/17/2016,715266,Y/J,4/13/2016;
2/17/2016,693681,Y/J,4/13/2016;
2/18/2016,699639,J,4/14/2016;
2/19/2016,713992,,4/15/2016;
2/19/2016,716830,K,4/15/2016;
2/19/2016,709673,K,4/15/2016;
2/20/2016,715453,K,4/15/2016;
2/20/2016,716894,K,4/15/2016;
2/21/2016,697924,J,4/18/2016;
2/22/2016,705998,K,4/18/2016;
2/22/2016,716450,K,4/18/2016;
2/22/2016,716282,K,4/18/2016;
2/22/2016,716188,K,4/18/2016;
2/23/2016,715907,,4/19/2016;
2/23/2016,716306,K,4/19/2016;
2/23/2016,710994,K,4/19/2016;
2/23/2016,716915,J,4/19/2016;
2/24/2016,717236,K,4/20/2016;
2/25/2016,715152,J,4/21/2016;
2/25/2016,689596,J,4/21/2016;
2/25/2016,717448,K,4/21/2016;
3/11/2016,717764,,4/22/2016;
2/29/2016,703659,K,4/25/2016;
2/29/2016,717553,K,4/25/2016;
2/29/2016,717654,K,4/25/2016;
2/29/2016,715590,J,4/25/2016;
2/29/2016,617991,J,4/25/2016;
2/29/2016,717602,J,4/25/2016;
2/29/2016,717813,K,4/25/2016;
3/1/2016,717607,,4/26/2016;
3/1/2016,716993,J,4/26/2016;
3/1/2016,717237,J,4/26/2016;
3/1/2016,712210,J,4/26/2016;
3/1/2016,717616,J,4/26/2016;
3/1/2016,717976,J,4/26/2016;
3/16/2016,715126,,4/27/2016;
3/16/2016,711310,,4/27/2016;
3/2/2016,716960,,4/27/2016;
3/2/2016,716544,J,4/27/2016;
3/2/2016,714327,K,4/27/2016;
3/2/2016,716939,K,4/27/2016;
3/3/2016,718003,K,4/28/2016;
3/3/2016,710756,K,4/28/2016;
3/4/2016,718134,K,4/29/2016;
3/4/2016,711355,K,4/29/2016;
3/4/2016,698401,K,4/29/2016;
3/4/2016,653751,K,4/29/2016;
3/4/2016,717686,K,4/29/2016;
9/26/2015,660325,K,;
3/8/2016,718573,J,5/4/2016;
3/6/2016,714100,J,5/2/2016;
3/7/2016,650014,K,5/3/2016;
3/8/2016,715656,,5/4/2016;
3/23/2016,720046,,5/4/2016;
3/23/2016,710624,,5/4/2016;
3/9/2016,704728,J,5/5/2016;
3/9/2016,718624,J,5/5/2016;
3/9/2016,704728,K,5/5/2016;
3/25/2016,719028,,5/6/2016;
3/10/2016,718380,J,5/6/2016;
3/10/2016,719196,J,5/6/2016;
3/10/2016,717766,J,5/6/2016;
3/10/2016,719258,J,5/6/2016;
3/11/2016,718543,J,5/6/2016;
3/11/2016,719061,J,5/6/2016;
3/14/2016,672237,J,5/9/2016;
3/14/2016,718363,J,5/9/2016;
3/14/2016,718170,J,5/9/2016;
3/14/2016,716004,J,5/9/2016;
3/14/2016,719112,J,5/9/2016;
3/14/2016,718202,K,5/9/2016;
3/15/2016,717828,J,5/10/2016;
3/15/2016,718111,J,5/10/2016;
3/15/2016,715798,J,5/10/2016;
3/29/2016,719638,,5/10/2016;
3/16/2016,718023,K,5/11/2016;
3/17/2016,718418,K,5/12/2016;
3/17/2016,719598,K,5/12/2016;
3/17/2016,717292,K,5/12/2016;
3/18/2016,715731,K,5/13/2016;
3/18/2016,711660,K,5/13/2016;
3/21/2016,700121,K,5/16/2016;
3/21/2016,718125,K,5/16/2016;
3/21/2016,715095,,5/16/2016;
3/21/2016,676114,J,5/16/2016;
3/21/2016,716032,J,5/16/2016;
3/22/2016,718367,J,5/17/2016;
3/22/2016,719130,J,5/17/2016;
3/22/2016,719899,J,5/17/2016;
3/23/2016,719631,J,5/18/2016;
3/23/2016,704009,J,5/18/2016;
3/24/2016,715894,J,5/19/2016;
3/24/2016,720402,J,5/19/2016;
3/25/2016,720214,J,5/19/2016;
3/25/2016,720262,J,5/20/2016;
3/28/2016,717351,J,5/23/2016;
3/28/2016,692920,J,5/23/2016;
3/28/2016,715126,K,5/23/2016;
3/28/2016,645600,K,5/23/2016;
3/29/2016,715831,J,5/24/2016;
3/30/2016,720420,J,5/25/2016";
        $list_files = explode(';',$files);
        foreach($list_files as $file)
        {
            print_r($file);
            $file_explode= explode(',',$file);
            $fileno = $file_explode[1];
            $lead = Lead::where('fileno',$fileno)->first();
            if($lead!=null)
            {
                $projects = Project::where('lead_id',$lead->id)->get();
                foreach($projects as $projectS)
                {
                    $lastContract = $projectS->lastContractPaid();
                    if($lastContract!="")
                    {
                        $projectP = ProjectProduction::where(array('fileno'=>$fileno,'typeVendor'=>'production','project_id'=>$projectS->id))->first();
                        if($projectP==null)
                            $projectP = new ProjectProduction();
                        $projectP->project_id = $projectS->id;
                        $projectP->fileno = $fileno;
                        $projectP->typeVendor = 'production';
                        $projectP->consultant_id = 30;
                        $projectP->noShow = 1;
                        $projectP->contractType = $lastContract['TYPE'];
                        $projectP->created_at =  date("Y-m-d H:i:s",strtotime("7 days ago"));
                        $projectP->updated_at =  date("Y-m-d H:i:s",strtotime("7 days ago"));
                        $projectP->paidDate = date("Y-m-d H:i:s",strtotime($file_explode[0]));
                        $projectP->scheduleDate =strlen($file_explode[3])>0?date("Y-m-d H:i:s",strtotime($file_explode[3])):"0000-00-00 00:00:00";
                        $projectP->sendDate = date("Y-m-d H:i:s", strtotime("+7 Day", strtotime($file_explode[0])));

                        if($file_explode[2]=="J"||$file_explode[2]=="Y/J")
                            $projectP->attorney_id = $attorney30->id;
                        else if($file_explode[1]=="K"||$file_explode[2]=="Y/K")
                            $projectP->attorney_id = $attorney45->id;
                        else
                            $projectP->attorney_id = 0;
                        $projectP->designer_id = $designer->id;
                        $projectP->writer_id = $writer->id;
                        $projectP->university_id = $university->id;
                        $projectP->save();

                        // Project Production Attorney
                        if($projectP->attorney_id>0)
                        {
                            $consultantA = Consultant::find($projectP->attorney_id);
                            $rolA = explode(',',$consultantA->rol);

                            $projectPA = ProjectProduction::where(array('project_id'=>$projectP->project_id,'typeVendor'=>$rolA[2]))->first();
                            if($projectPA==null)
                            {
                                $projectPA = new ProjectProduction();
                                $projectPA->project_id = $projectP->project_id;
                                $projectPA->fileno = $projectP->fileno;
                                $projectPA->typeVendor = $rolA[2];
                                $projectPA->consultant_id = $projectP->attorney_id;
                                $projectPA->contractType = $projectP->contractType;
                                $projectPA->designer_id = $projectP->designer_id;
                                $projectPA->writer_id = $projectP->writer_id;
                                $projectPA->university_id = $projectP->university_id;
                                $projectPA->attorney_id = $projectP->attorney_id;
                                $projectPA->sendDate = $projectP->sendDate;
                                $projectPA->noShow = 1;
                                $projectPA->save();
                            }
                        }

                        // Project Production University
                        $projectPU = ProjectProduction::where(array('project_id'=>$projectP->project_id,'typeVendor'=>'university'))->first();
                        if($projectP->university_id>0 && $projectPU==null)
                        {
                            $projectPU = new ProjectProduction();
                            $projectPU->project_id = $projectP->project_id;
                            $projectPU->fileno = $projectP->fileno;
                            $projectPU->typeVendor = 'university';
                            $projectPU->consultant_id = $projectP->university_id;
                            $projectPU->contractType = $projectP->contractType;
                            $projectPU->designer_id = $projectP->designer_id;
                            $projectPU->writer_id = $projectP->writer_id;
                            $projectPU->university_id = $projectP->university_id;
                            $projectPU->attorney_id = $projectP->attorney_id;
                            $projectPU->sendDate = $projectP->sendDate;
                            $projectPU->noShow = 1;
                            $projectPU->save();
                        }

                        // Project Production Designer
                        $projectPD = ProjectProduction::where(array('project_id'=>$projectP->project_id,'typeVendor'=>'designer'))->first();
                        if($projectP->designer_id>0 && $projectPD==null)
                        {
                            $projectPD = new ProjectProduction();
                            $projectPD->project_id = $projectP->project_id;
                            $projectPD->fileno = $projectP->fileno;
                            $projectPD->typeVendor = 'designer';
                            $projectPD->consultant_id = $projectP->designer_id;
                            $projectPD->contractType = $projectP->contractType;
                            $projectPD->designer_id = $projectP->designer_id;
                            $projectPD->writer_id = $projectP->writer_id;
                            $projectPD->university_id = $projectP->university_id;
                            $projectPD->attorney_id = $projectP->attorney_id;
                            $projectPD->sendDate = $projectP->sendDate;
                            $projectPD->noShow = 1;
                            $projectPD->save();
                        }

                        // Project Production Writer
                        $projectPW = ProjectProduction::where(array('project_id'=>$projectP->project_id,'typeVendor'=>'writer'))->first();
                        if($projectP->writer_id>0 && $projectPW==null)
                        {
                            $projectPW = new ProjectProduction();
                            $projectPW->project_id = $projectP->project_id;
                            $projectPW->fileno = $projectP->fileno;
                            $projectPW->typeVendor = 'writer';
                            $projectPW->consultant_id = $projectP->writer_id;
                            $projectPW->contractType = $projectP->contractType;
                            $projectPW->designer_id = $projectP->designer_id;
                            $projectPW->writer_id = $projectP->writer_id;
                            $projectPW->university_id = $projectP->university_id;
                            $projectPW->attorney_id = $projectP->attorney_id;
                            $projectPW->sendDate = $projectP->sendDate;
                            $projectPW->noShow = 1;
                            $projectPW->save();
                        }

                    }
                }
            }

        }

        $files = "714100,J;650014,K;715656,IMG;704728,J;718624,J;704728,K;718380,J;719196,J;717766,J;719258,J;718543,J;719061,J;719130,J;719899,J;704009,J;715126,K;645600,K";
        $list_files = explode(';',$files);
//        foreach($list_files as $file)
//        {
//            $file_explode= explode(',',$file);
//            $fileno = $file_explode[0];
//            $lead = Lead::where('fileno',$fileno)->first();
//            if($lead!=null)
//            {
//                $projects = Project::where('lead_id',$lead->id)->get();
//                foreach($projects as $projectS)
//                {
//                    $lastContract = $projectS->lastContractPaid();
//                    if($lastContract!="")
//                    {
//                        $projectP = ProjectProduction::where(array('fileno'=>$fileno,'typeVendor'=>'production'))->first();
//                        if($projectP==null)
//                            $projectP = new ProjectProduction();
//                        $projectP->project_id = $projectS->id;
//                        $projectP->fileno = $fileno;
//                        $projectP->typeVendor = 'production';
//                        $projectP->consultant_id = 16;
//                        $projectP->contractType = $lastContract['TYPE'];
//                        $projectP->created_at =  date("Y-m-d H:i:s",strtotime("7 days ago"));
//                        $projectP->updated_at =  date("Y-m-d H:i:s",strtotime("7 days ago"));
//                        $projectP->paidDate = $lastContract['DATE'];
//                        if($lastContract['TYPE']=="IIG")
//                        {
//                            $projectP->scheduleDate = date("Y-m-d H:i:s", strtotime("+8 Week", strtotime($lastContract['DATE'])));
//                        }
//                        else if($lastContract['TYPE']=="IMG")
//                        {
//                            $projectP->scheduleDate = date("Y-m-d H:i:s", strtotime("+6 Week", strtotime($lastContract['DATE'])));
//                        }
//                        else if($lastContract['TYPE']=="IGUP")
//                        {
//                            $contract = Contract::where(array('project_id'=>$projectS->id,'type'=>'IMG'))->first();
//                            $contractU = Contract::where(array('project_id'=>$projectS->id,'type'=>'IGUP'))->first();
//                            $dateSoldIMG = $contract?$contract->paidDate:$lastContract['DATE'];
//                            $dateSoldIGUP = $contractU?$contractU->paidDate:$lastContract['DATE'];
//                            $weeks = ($dateSoldIGUP - $dateSoldIMG)/(60*60*24*7);
//                            if($weeks<=2)
//                                $projectP->scheduleDate = date("Y-m-d H:i:s", strtotime("+8 Week", strtotime($lastContract['DATE'])));
//                            else
//                                $projectP->scheduleDate = date("Y-m-d H:i:s", strtotime("+".(6+$weeks)." Week", strtotime($dateSoldIMG)));
//                            $projectP->scheduleDate = date("Y-m-d H:i:s", strtotime("+8 Week", strtotime($dateSoldIMG)));
//                        }
//                        if($file_explode[1]=="J")
//                            $projectP->attorney_id = $attorney30->id;
//                        else if($file_explode[1]=="K")
//                            $projectP->attorney_id = $attorney45->id;
//                        else
//                            $projectP->attorney_id = 0;
//                        $projectP->designer_id = $designer->id;
//                        $projectP->writer_id = 0;
//                        $projectP->university_id = $university->id;
//                        $now = date("Y-m-d H:i:s", strtotime("+7 Day", strtotime($lastContract['DATE'])));
//                        $projectP->sendDate = $now;
//                        $projectP->save();
//
//                        // Project Production Attorney
//                        if($projectP->attorney_id>0)
//                        {
//                            $consultantA = Consultant::find($projectP->attorney_id);
//                            $rolA = explode(',',$consultantA->rol);
//
//                            $projectPA = ProjectProduction::where(array('project_id'=>$projectP->project_id,'typeVendor'=>$rolA[2]))->first();
//                            if($projectPA==null)
//                            {
//                                $projectPA = new ProjectProduction();
//                                $projectPA->project_id = $projectP->project_id;
//                                $projectPA->fileno = $projectP->fileno;
//                                $projectPA->typeVendor = $rolA[2];
//                                $projectPA->consultant_id = $projectP->attorney_id;
//                                $projectPA->contractType = $projectP->contractType;
//                                $projectPA->designer_id = $projectP->designer_id;
//                                $projectPA->writer_id = $projectP->writer_id;
//                                $projectPA->university_id = $projectP->university_id;
//                                $projectPA->attorney_id = $projectP->attorney_id;
//                                $projectPA->sendDate = $projectP->sendDate;
//                                $projectPA->save();
//                            }
//                        }
//
//                        // Project Production University
//                        $projectPU = ProjectProduction::where(array('project_id'=>$projectP->project_id,'typeVendor'=>'university'))->first();
//                        if($projectPU==null)
//                        {
//                            $projectPU = new ProjectProduction();
//                            $projectPU->project_id = $projectP->project_id;
//                            $projectPU->fileno = $projectP->fileno;
//                            $projectPU->typeVendor = 'university';
//                            $projectPU->consultant_id = $projectP->university_id;
//                            $projectPU->contractType = $projectP->contractType;
//                            $projectPU->designer_id = $projectP->designer_id;
//                            $projectPU->writer_id = $projectP->writer_id;
//                            $projectPU->university_id = $projectP->university_id;
//                            $projectPU->attorney_id = $projectP->attorney_id;
//                            $projectPU->sendDate = $projectP->sendDate;
//                            $projectPU->save();
//                        }
//
//                        // Project Production Designer
//                        $projectPD = ProjectProduction::where(array('project_id'=>$projectP->project_id,'typeVendor'=>'designer'))->first();
//                        if($projectPD==null)
//                        {
//                            $projectPD = new ProjectProduction();
//                            $projectPD->project_id = $projectP->project_id;
//                            $projectPD->fileno = $projectP->fileno;
//                            $projectPD->typeVendor = 'designer';
//                            $projectPD->consultant_id = $projectP->designer_id;
//                            $projectPD->contractType = $projectP->contractType;
//                            $projectPD->designer_id = $projectP->designer_id;
//                            $projectPD->writer_id = $projectP->writer_id;
//                            $projectPD->university_id = $projectP->university_id;
//                            $projectPD->attorney_id = $projectP->attorney_id;
//                            $projectPD->sendDate = $projectP->sendDate;
//                            $projectPD->save();
//                        }
//
////                        // Project Production Writer
////                        $projectPW = ProjectProduction::where(array('project_id'=>$projectP->project_id,'typeVendor'=>'writer'))->first();
////                        if($projectPW==null)
////                        {
////                            $projectPW = new ProjectProduction();
////                            $projectPW->project_id = $projectP->project_id;
////                            $projectPW->fileno = $projectP->fileno;
////                            $projectPW->typeVendor = 'writer';
////                            $projectPW->consultant_id = $projectP->writer_id;
////                            $projectPW->contractType = $projectP->contractType;
////                            $projectPW->designer_id = $projectP->designer_id;
////                            $projectPW->writer_id = $projectP->writer_id;
////                            $projectPW->university_id = $projectP->university_id;
////                            $projectPW->attorney_id = $projectP->attorney_id;
////                            $projectPW->sendDate = $projectP->sendDate;
////                            $projectPW->save();
////                        }
//
//                    }
//                }
//            }
//
//        }
    }
    /*End Fill production table*/

    /*take project mark for vendor from one date to  present and put in project_production*/
    public function newFilesProduction()
    {
        $date='2016-03-25 00:00:00';
        $projects = Project::where('vendor',1)->where('vendorDate','>=',$date)->get();
        foreach($projects as $project)
        {
            $projectProduction  =  ProjectProduction::where('project_id',$project->id)->first();
            if($projectProduction==null)
            {
                $lastContract = $project->lastContractWithPayment();
                $projectProduction = new ProjectProduction();
                $projectProduction->project_id = $project->id;
                $projectProduction->fileno = $project->lead->fileno;
                $projectProduction->typeVendor = 'production';
                $projectProduction->consultant_id =30;
                $projectProduction->contractType = $lastContract?$lastContract->type:"";
                $projectProduction->created_at =  $project->vendorDate;
                $projectProduction->updated_at =  $project->vendorDate;
                $projectProduction->save();
            }
            else
                echo $project->lead->fileno.",";

        }

    }
    /*End take project mark for vendor from one date to  present and put in project_production*/
}
