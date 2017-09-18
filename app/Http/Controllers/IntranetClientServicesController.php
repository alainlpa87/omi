<?php namespace App\Http\Controllers;


use App\Helpers\PlivoHelper;
use App\Helpers\ToolsFunctions;
use App\Models\AttClientServices;
use App\Models\ClientSDocs;
use App\Models\ClientSNotes;
use App\Models\Consultant;
use App\Models\Contract;
use App\Models\Inbox;
use App\Models\Lead;
use App\Models\LegalRecord;
use App\Models\Project;
use App\Models\ProjectClientServices;
use App\Models\Transaction;
use App\Models\UploadedFiles;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use DB;
use Illuminate\Support\Facades\Session;
use LynX39\LaraPdfMerger\PDFManage;


class IntranetClientServicesController extends Controller {

    /*
     * Current Consultant logged
     */
    public $consultant;
    /*
     * To Allow use the controller methods the current user logged has to be Client
     */
    public function __construct()
    {
        $this->middleware('admin');
        $this->middleware(function ($request, $next) {
            $this->consultant = Consultant::find(Session::get('user_id'));

            return $next($request);
        });
    }


    public function index()
    {
        // get info about the attorneys to show in the details
        $first_day_of_month = date('Y-m-01 00:00:00');
        $last_day_of_month = date('Y-m-t 23:59:00');
        $attorneys = Consultant::where('rol','LIKE','%attorney%')->where('usr','!=','jk_attorney')->get();
        $attArray = [];
        foreach($attorneys as $att){
            $attCSProv     = AttClientServices::where('consultant_id',$att->id)->where('created_at','>=',$first_day_of_month)->where('created_at','<=',$last_day_of_month)->where('type','PROV')->get();
            $attCSUt       = AttClientServices::where('consultant_id',$att->id)->where('created_at','>=',$first_day_of_month)->where('created_at','<=',$last_day_of_month)->where('type','UT')->get();
            $attCSD        = AttClientServices::where('consultant_id',$att->id)->where('created_at','>=',$first_day_of_month)->where('created_at','<=',$last_day_of_month)->where('type','DESIGN')->get();
            $arrayAtt = array('aid'=>$att->id,'user'=>$att->usr,'attorneyName'=>$att->fname." ".$att->lname,'total'=>count($attCSProv)+count($attCSD)+count($attCSUt),'countProv'=>count($attCSProv),'countU'=>count($attCSUt),'countU_D'=>count($attCSD));
            $attArray[] = $arrayAtt;
        }

        //get all the files that are not closed nor hide
        $projectClientServices = ProjectClientServices::where('show','1')->where('completed','<>',4)->where('completed','<>',5)->get();//


        //////////////////////////
        ///pcs states:   //////////////////////////////////////////////////////
        //0->new,1->at proccess,2->returned,3->overdue,4->closed, 5->closed expirated//
        //////////////////////////////////////////////////////////////////////////////
        $attorneys = Consultant::where('rol','LIKE','%attorney%')->where('usr','<>','jk_attorney')->where('usr','<>','alain')->where('usr','<>','josue')->get();
        $total_inbox = Inbox::where(['consultant_id'=>$this->consultant->id,'status'=>0])->count();
        return view("intranet.clientServices.index2",array('consultant'=>$this->consultant,'attorneys'=>$attorneys,'total_inbox'=>$total_inbox,'arrayAtt'=>$attArray, 'allPCS'=>$projectClientServices));
    }



    /*Show in a new window, not only the pending pct/epo also the pending email follow ups,
    pending paten app follow up, trademark and copyright without sign, email update after one year,
    utility expiration, provisional upgrade, 9 months from patent pending follow up call,
    91 days without received the app from att
    */
    public function pendingPCTEPO(){
        $pendingEmailFollowUp = array();
        $pendingPtntAppFollowUp = array();
        $pendingPtntAppCR = array();
        $pendingPtntAppTM = array();
        $pendingLateApp = array();

        $now = date('Y-m-d');
        //////////
        $pcs =ProjectClientServices::where('completed','<>',4)->where('completed','<>',5)->get();
        foreach($pcs as $projcs){
            ////////Check if the welcome follow up call must be done
            if($projcs->emailSent_created_at !='' && $projcs->emailCall_created_at == ''){
                $then = \DateTime::createFromFormat("m-d-Y", str_replace('/','-',$projcs->emailSent_created_at));
                $dif = strtotime($now)-strtotime($then->format('Y-m-d'));
                $dif= $dif/86400;
                if($dif >= 7)
                    $pendingEmailFollowUp[]=$projcs;
            }
            ////////Check if the paten app follow up with inventor must be done
            if($projcs->appSent_created_at != '' && $projcs->appFollowUp_created_at =='' && $projcs->patentAppApproved_created_at == ''){
                $then = \DateTime::createFromFormat("m-d-Y",str_replace('/','-',$projcs->appSent_created_at));
                $dif = strtotime($now)-strtotime($then->format('Y-m-d'));
                $dif= $dif/86400;
                if($dif >= 7)
                    $pendingPtntAppFollowUp[]=$projcs;
            }
            ////////Checks if it has been two weeks since the patent app was sent it and the tm or cr still dont has been signed
            if($projcs->appSent_created_at != ''){
                $then = \DateTime::createFromFormat("m-d-Y",str_replace('/','-',$projcs->appSent_created_at));
                $dif = strtotime($now)-strtotime($then->format('Y-m-d'));
                $dif= $dif/86400;
                if($dif!= 0 && $dif%14 == 0){
                    if($projcs->trademarkSent_created_at != '' && $projcs->trademarkReceived_created_at == '')
                        $pendingPtntAppTM[] = $projcs;
                    if($projcs->copyrightSent_created_at != '' && $projcs->copyrightReceived_created_at == '')
                        $pendingPtntAppCR[] = $projcs;
                }
            }
        }


        //email update ut after one year
        $pendingUpdEmail = ProjectClientServices::where('updateDateAfterYear','<>','0000-00-00 00:00:00')->where('updateDateAfterYear','<',date('Y-m-d 23:59:59', strtotime('-3 months')))->where('completed','<>',4)->where('completed','<>',5)->get();
        //ut expirated
        $pendingUtilities = ProjectClientServices::where('contractTypes','not like','%PROV%')->where('completed','<>',4)->where('rcvdDate','<>','0000-00-00 00:00:00')->where('rcvdDate','<',date('Y-m-d 23:59:59', strtotime('-2 year +1 day')))->where('agreementExt_rcvd','0000-00-00 00:00:00')->orWhere(function($query){
            $query->where('contractTypes','like','%UPG_UT%')->where('completed','<>',4)->where('rcvdDate','<>','0000-00-00 00:00:00')->where('rcvdDate','<',date('Y-m-d 23:59:59', strtotime('-2 year +1 day')))->where('agreementExt_rcvd','0000-00-00 00:00:00');
        })->orWhere(function($query){
            $query->where('contractTypes','not like','%PROV%')->where('completed','<>',4)->where('rcvdDate','<>','0000-00-00 00:00:00')->where('rcvdDate','<',date('Y-m-d 23:59:59', strtotime('-3 year +1 day')))->where('agreementExt_rcvd','<>','0000-00-00 00:00:00');
        })->orWhere(function($query){
            $query->where('contractTypes','like','%UPG_UT%')->where('completed','<>',4)->where('rcvdDate','<>','0000-00-00 00:00:00')->where('rcvdDate','<',date('Y-m-d 23:59:59', strtotime('-3 year +1 day')))->where('agreementExt_rcvd','<>','0000-00-00 00:00:00');
        })->get();
        //upgrade pct/epo
        $pendingPCTEPO = ProjectClientServices::where('completed','<>',4)->where('completed','<>',5)->where('contractTypes','not like','%PCT%')->where('contractTypes','not like','%EPO%')
            ->where('contractTypes','not like','%PROV%')->where('pctEpoAlert',0)->where('patentAppFiled_created_at','<>','0000-00-00 00:00:00')->where('patentAppFiled_created_at','<',date('Y-m-d 23:59:59', strtotime('-6 months')))->where('patentType','not like','%PROV%')->orWhere(function($query){
                $query->where('completed','<>',4)->where('completed','<>',5)->where('contractTypes','not like','%PCT%')->where('contractTypes','not like','%EPO%')
                    ->where('contractTypes','like','%UPG_UT%')->where('pctEpoAlert',0)->where('patentAppFiled_created_at','<>','0000-00-00 00:00:00')->where('patentAppFiled_created_at','<',date('Y-m-d 23:59:59', strtotime('-6 months')));
            })->get();

        //provisional upgrade letter
        $pendingPROV = ProjectClientServices::where('completed','<>',4)->where('completed','<>',5)->where('contractTypes','not like','%PCT%')->where('contractTypes','not like','%EPO%')
            ->where('contractTypes','like','%PROV%')->where('contractTypes','not like','%UT%')->where('provAlert',0)->where('patentAppFiled_created_at','<>','0000-00-00 00:00:00')->where('patentAppFiled_created_at','<',date('Y-m-d 23:59:59', strtotime('-9 months')))->get();
        // 9 months from patent pending follow call
        $pcsUpd9M = ProjectClientServices::where('patentAppFiled_created_at','<>','0000-00-00 00:00:00')->where('patentAppFiled_created_at','<',date('Y-m-d 00:00:00', strtotime('-9 months +1 day')))->where('patentAppFiled_created_at','>',date('Y-m-d 00:00:00', strtotime('-9 months -1 day')))->where('completed','<>',4)->where('completed','<>',5)->get();
        // 91 days without received the app from att, notify delay to client
        $aux = AttClientServices::where('created_at','<',date('Y-m-d 23:59:59', strtotime('-90 day')))->where('completed',3)->get(); //->where('created_at','>',date('Y-m-d 00:00:00', strtotime('-92 day')))
        foreach($aux as $attCs){
            if($attCs->projectclientservices->notifyAppDelay == 0 && $attCs->projectclientservices->patentAppApproved_created_at !='' && $attCs->projectclientservices->patentAppApprovedD_created_at!='0000-00-00 00:00:00')
                $pendingLateApp[] = $attCs->projectclientservices;
        }

        return view("intranet.clientServices.tools.projectsWithoutSignPCTEPO",array('pendingPCTEPO'=>$pendingPCTEPO,'pendingPROV'=>$pendingPROV,'pendingEmailFollowUp'=>$pendingEmailFollowUp,'pendingPtntAppFollowUp'=>$pendingPtntAppFollowUp,'pendingPtntAppTM'=>$pendingPtntAppTM,'pendingPtntAppCR'=>$pendingPtntAppCR,'pendingUpdEmail'=>$pendingUpdEmail,'pendingUtilities'=>$pendingUtilities,'Months9FollowCall'=>$pcsUpd9M,'pendingLateApp'=>$pendingLateApp));

    }

    /*find a client services file*/
    public function findProjectClientServices(){
        $leads = Lead::findLead(Input::get('PARAMS'));
        $projects=array();
        if($leads!="-1")
            foreach($leads as $lead_id)
            {
                $listOfProjects = Project::where('lead_id',$lead_id)->get();
                foreach($listOfProjects as $projectFromLead){
                    $projects[] = $projectFromLead;
                }
            }
        $projectsToLoad=array();
        foreach($projects as $project){
            $projectCS = $project->clientServicesProject();
            $projectsToLoad[]=$this->paintProject($project->id,($projectCS!= null?$projectCS->id:'-1'));
        }
        echo json_encode($projectsToLoad);
    }

    /*
    * Create a portlet from a Project
    */
    public function paintProject($projectId,$projectClientS){
        $view = file_get_contents(url("paintProjectClientServices?PROJECT=$projectId&PROJECTCS=$projectClientS"));
        return $view;
    }

    /*
        * Change mailOnly to true o false
        * this indicates that the client received just paper mail
        */
    public function checkMailOnly(){
        $id=Input::get('ID');
        $check=Input::get('CHECK');
        $project=ProjectClientServices::where('project_id',$id)->first();
        if($project!=null){
            $project->mailOnly=$check;
            $project->save();
            return "1";
        }
        return "-1";
    }

    /*
     *Set type for a PPA contract
     * */
    public function checkTypeContract(){
        $id=Input::get('ID');
        $type=Input::get('TYPE');
        $check=Input::get('CHECK');
        $project=ProjectClientServices::where('project_id',$id)->first();
        $result ="1";
        if($project!=null){
            if($check==1){
                $msg="SET_PPA_CONTRACT_TYPE";
                $types=$project->contractTypes;
                if(strlen($types)>1)
                    $types.=",".$type;
                else
                    $types.=$type;

                //reminder to cs file the pct/epo if the paten app was already filed
                if( ($type == "PCT" || $type== "EPO") && $project->patentAppFiled_created_at!="0000-00-00 00:00:00")
                    $result =json_encode("reminder");

            }else{
                $msg="UNSET_PPA_CONTRACT_TYPE";
                $typesA=$project->contractTypes;
                $arrTypes =explode(",", $typesA);
                $types="";
                if(count($arrTypes)!=1){
                    foreach($arrTypes as $typeP){
                        if($typeP!=$type)
                            $types.=$typeP.",";
                    }
                    $types=substr($types,0,strlen($types)-1);
                }
            }
            $project->contractTypes=$types;
            $project->save();
        }else{
            $result = "-1";
        }
        //
        Transaction::createTransaction($this->consultant->id,'','',$msg,$type,$id,'','PPA','','','');
        return $result;
    }


    /*
*Set Filing Attorney
* */
    public function selectAtt(){
        $id=Input::get('ID');
        $attorney=Input::get('ATT');
        $col=Input::get('COL');
        $project=ProjectClientServices::where('project_id',$id)->first();
        if($project!=null){
            $project->$col=$attorney;
            $project->save();
            return "1";
        }
        return "-1";
    }

    /*
*Set Sent Date
 * Save the date of PCT Invoice Sent && Design Invoice Sent after pick the date in the datepicker
* */
    public function setSentDate(){
        $id=Input::get('ID');
        $date=Input::get('DATE');
        $col=Input::get('COL');
        $project=ProjectClientServices::where('project_id',$id)->first();
        if($project!=null){
            if($col == 'patentAppFiled_created_at' || $col == 'DModel_sent' || $col == 'docUpgSent_created_at' || $col == 'designInvoiceSentDate' || $col == 'pctInvoiceRecvdDate' || $col == 'pctInvoicePaidDate' || $col == 'pctQuestSent' || $col=='pctQuestReceived' || $col=='pctPsaSent_create_at' || $col=='pctPsaRcvd_create_at' || $col=='patentAppApprovedD_created_at' || $col == 'poaDecSentD_created_at' || $col =='poaDecRcvdD_created_at' || $col=='appSentD_created_at'){
                $project->$col = date("Y-m-d",strtotime($date));
                if($col == 'patentAppFiled_created_at' && $project->hasType('PROV') && !$project->hasType('UPG_UT'))
                    $project->patentType = 'PROV';
                elseif($col == 'patentAppFiled_created_at' && $project->hasType('UPG_UT'))
                    $project->patentType = 'UT(UPG)';
                elseif($col == 'patentAppFiled_created_at' && $project->hasType('UT'))
                    $project->patentType = 'UT';
            }
            else
                $project->$col=$date;
            $project->save();
            return 1;
        }
        return -1;

    }

    /*
     * Set checks in the Patent App Process
     * */
    public function checkPatentAppProcess(){
        $id=Input::get('ID');
        $check=Input::get('CHECK');
        $date=Input::get('DATE');
        $col=Input::get('COL');
        $projectCs=ProjectClientServices::where('project_id',$id)->first();
        $result="1";
        if($projectCs!=null){
            if($check==1){ //if the checkbox was checked
                // save the date
                //if the date is created with / instead f - make the proper changes
                if($col == "patentAppFiled_created_at" || $col == "pctQuestReceived" || $col == "pctPsaSent_create_at" || $col == "pctPsaRcvd_create_at" || $col == "poaDecRcvdD_created_at" || $col=="patentAppApprovedD_created_at"){
                    $aux = explode('-',$date);
                    $value_aux = $aux[2]."-".$aux[0]."-".$aux[1];
                    $projectCs->$col=date("Y-m-d",strtotime($value_aux));
                }else
                    $projectCs->$col=$date;
                if($projectCs->completed == 0)
                    $projectCs->completed = 1;
                $projectCs->save();

                //in case docs must be sent
                if($col=="ppaSent_created_at"){
                    //check de doc dnt exist yet
                    if(($aux=$projectCs->getDocsByName('agreementPSA'))!=null)
                        $aux->delete();
                    $newrowDocs= new ClientSDocs();
                    $newrowDocs->projectclientservices_id=$projectCs->id;
                    $newrowDocs->document="agreementPSA";
                    $newrowDocs->name="PSA";

                    if(($aux=$projectCs->getDocsByName('ddr'))!=null)
                        $aux->delete();
                    $newrowDocs2=new ClientSDocs();
                    $newrowDocs2->projectclientservices_id=$projectCs->id;
                    $newrowDocs2->document="ddr";
                    $newrowDocs2->name="DDR";

                    $newrowDocs->save();
                    $newrowDocs2->save();//

                    //generate the pdfs
                    $this->generateCSWelcomeLetterWithPSAandDDR($id);
                    $this->generateEmptyDDR($id);
                    $this->generateEmptyAgreementPSA($id);

                    //uploaded to the db
                    $this->uploadDoc('agreementPSA',$id,$projectCs->project->lead->fileno);
                    $this->uploadDoc('ddr',$id,$projectCs->project->lead->fileno);

                    //sent an email to client notify new legal docs was sent to him
                    file_get_contents(url("emailClientServices?ID=$id&TYPE=SENTDOCS"));
                    $project = Project::find($id);
                    $msgInbox = "The document PSA and DDR was sent to client.<br>".date("m-d-Y H:i:s")."<br>Client: ".$project->lead->fname." ".$project->lead->lname.
                        "<br>File #: ".$project->lead->fileno."<br>Pin: ".$project->id;
                    Inbox::createInbox($project->lead->id,$project->consultant_id,$msgInbox,"CLIENT SERVICES","CLIENT SERVICES");
                    $result="psa_ddr";
                }
                elseif($col=="copyrightSent_created_at"){
                    if(($aux=$projectCs->getDocsByName('copyrightQuestionnaire'))!=null)
                        $aux->delete();
                    $newrowDocs= new ClientSDocs();
                    $newrowDocs->projectclientservices_id=$projectCs->id;
                    $newrowDocs->document="copyrightQuestionnaire";
                    $newrowDocs->name="COPYRIGHT";
                    $newrowDocs->save();

                    //generate the empty pdf
                    $this->generateEmptyCopyRQ($id);
                    //upload the doc to db
                    $this->uploadDoc('copyrightQuestionnaire',$id,$projectCs->project->lead->fileno);
                    //sent an email to client notify new legal docs was send
                    file_get_contents(url("emailClientServices?ID=$id&TYPE=COPYRIGHT"));
                }
                elseif($col=="trademarkSent_created_at"){
                    if(($aux=$projectCs->getDocsByName('trademark'))!=null)
                        $aux->delete();
                    $newrowDocs= new ClientSDocs();
                    $newrowDocs->projectclientservices_id=$projectCs->id;
                    $newrowDocs->document="trademark";
                    $newrowDocs->name="TRADEMARK";
                    $newrowDocs->save();

                    //generate the empty pdf
                    $this->generateEmptyTrademark($id);
                    //upload the doc to db
                    $this->uploadDoc('trademark',$id,$projectCs->project->lead->fileno);
                    //sent an email to client notify new legal docs was send
                    file_get_contents(url("emailClientServices?ID=$id&TYPE=TRADEMARK"));

                }
                elseif($col == "emailSent_created_at"){
                    file_get_contents(url("emailClientServices?ID=$id&TYPE=WELCOMELETTER"));
                }//the ilc agreement
                elseif($col == "marketingAgrSent_created_at"){
                    $fileId = Input::get('FILEID');
                    if($fileId != null && $fileId != 0)
                        $file = UploadedFiles::find($fileId);
                    if($file == null)
                        return -1;
                    $file->filingReceipt=1;
                    $file->save();
                    if(strpos($file->url, '/attClientServices/') !== false)
                        $fileN = 'attClientServices/'.$file->fileName;
                    elseif(strpos($file->url, '/uploaded/') !== false)
                        $fileN = 'uploaded/'.$file->fileName;
                    else
                        $fileN = $file->fileName;
                    $app_no = $projectCs->patentAppNo;
                    //generate the pdfs
                    $this->generateEmptyILC($id);
                    $this->generateReleaseILC($id);
                    //uploade to the db
                    $this->uploadDoc('ilc_agreement',$id,$projectCs->project->lead->fileno);
                    $this->uploadDoc('ilc_release',$id,$projectCs->project->lead->fileno);
                    //send email to client
                    file_get_contents(url("emailClientServices?ID=$id&TYPE=ILC&FILENAME=".urlencode($fileN)."&APPNUMBER=$app_no"));
                    $result = "ilc_sent";
                }//the ilc agreement after upgrade
                elseif($col == "marketingAgrSentAfterUpgrade_created_at"){
                    $fileId = Input::get('FILEID');
                    if($fileId != null && $fileId != 0)
                        $file = UploadedFiles::find($fileId);
                    if($file == null)
                        return -1;
                    if(strpos($file->url, '/attClientServices/') !== false)
                        $fileN = 'attClientServices/'.$file->fileName;
                    elseif(strpos($file->url, '/uploaded/') !== false)
                        $fileN = 'uploaded/'.$file->fileName;
                    else
                        $fileN = $file->fileName;
                    $app_no = $projectCs->patentAppNo;

                    //before generate new ILC save the old one
                    $project = Project::find($id);
                    $client = $project->lead;
                    if(File::exists("files/projects/".$client->fileno."/".$id."/"."ilc_agreement.pdf")) {
                        if (File::move("files/projects/".$client->fileno."/".$id."/"."ilc_agreement.pdf", "files/projects/".$client->fileno."/".$id."/"."ilc_agreement_Prov.pdf")){
                            $aux_file = UploadedFiles::where('project_id',$id)->where('fileName','ilc_agreement.pdf')->first();
                            if($aux_file!=null){
                                $aux_file->url = "files/projects/".$client->fileno."/".$id."/ilc_agreement_Prov.pdf";
                                $aux_file->fileName = "ilc_agreement_Prov.pdf";
                                $aux_file->save();
                            }
                        }
                    }
                    //generate the pdfs
                    $this->generateEmptyILC($id);
                    $this->generateReleaseILC($id);
                    //uploade to the db
                    $this->uploadDoc('ilc_agreement',$id,$projectCs->project->lead->fileno);
                    $this->uploadDoc('ilc_release',$id,$projectCs->project->lead->fileno);
                    //send email to client
                    file_get_contents(url("emailClientServices?ID=$id&TYPE=ILC&FILENAME=".urlencode($fileN)."&APPNUMBER=$app_no"));
                    $result = "ilcAfterUpgrade_sent";
                }
                elseif($col == "marketingAgrReceived_created_at"){
                    //the client services file change the state
                    if($projectCs->phase == 3){
                        $projectCs->phase = 4;
                        $projectCs->changePhaseDate=date('Y-m-d 00:00:00');
                        $projectCs->save();
                    }
                    file_get_contents(url("emailReceivedILC?ID=$id"));
                }
                elseif($col == "ddrReceived_created_at"){
                    $project = Project::find($id);
                    //if the doc dnt was sent online erase of table
                    $psa_aux = ClientSDocs::where('projectclientservices_id',$projectCs->id)->where('name','PSA')->first();
                    $ddr_aux = ClientSDocs::where('projectclientservices_id',$projectCs->id)->where('name','DDR')->first();
                    if($psa_aux !=null && $psa_aux->file_id == -1)
                        $psa_aux->delete();
                    if($ddr_aux !=null && $ddr_aux->file_id == -1)
                        $ddr_aux->delete();
                    ///////sent the welcome email
                    file_get_contents(url("emailClientServices?ID=$id&TYPE=WELCOMELETTER"));
                    $projectCs->emailSent_created_at = $date;
                    if($projectCs->phase == 0){
                        $projectCs->phase = 1;
                        $projectCs->changePhaseDate=date('Y-m-d 00:00:00');
                    }
                    $projectCs->save();
                    ///////
                    $msgInbox = "The document PSA and DDR was received.<br>".date("m-d-Y H:i:s")."<br>Client: ".$project->lead->fname." ".$project->lead->lname.
                        "<br>File #: ".$project->lead->fileno."<br>Pin: ".$project->id;
                    Inbox::createInbox($project->lead->id,$project->consultant_id,$msgInbox,"CLIENT SERVICES","CLIENT SERVICES");
                    $result="psa_ddr";
                }
                elseif($col == "copyrightReceived_created_at"){
                    //if the doc dnt was sent online erase of table
                    $copyR_aux = ClientSDocs::where('projectclientservices_id',$projectCs->id)->where('name','COPYRIGHT')->first();
                    if($copyR_aux != null && $copyR_aux->file_id == -1)
                        $copyR_aux->delete();
                    ////////////////////////
                    $result="copyright";
                }
                elseif($col == "trademarkReceived_created_at"){
                    //if the doc dnt was sent online erase of table
                    $trademark_aux = ClientSDocs::where('projectclientservices_id',$projectCs->id)->where('name','TRADEMARK')->first();
                    if($trademark_aux != null && $trademark_aux->file_id == -1)
                        $trademark_aux->delete();
                    ////////////////////////
                    $result="trademark";
                }
                elseif($col == "patentAppFiled_created_at"){
                    $project = Project::find($id);
                    $msgInbox = "Patent Application filed by attorney.<br>".date("m-d-Y H:i:s")."<br>Client: ".$project->lead->fname." ".$project->lead->lname.
                        "<br>File #: ".$project->lead->fileno."<br>Pin: ".$project->id;
                    Inbox::createInbox($project->lead->id,$project->consultant_id,$msgInbox,"CLIENT SERVICES","CLIENT SERVICES");
                    if($projectCs->hasType('PROV') && !$projectCs->hasType('UPG_UT')){
                        $projectCs->patentType = 'PROV';
                        $projectCs->save();
                    }elseif($projectCs->hasType('UPG_UT')){
                        $projectCs->patentType = 'UT(UPG)';
                        $projectCs->save();
                    }elseif($projectCs->hasType('UT')){
                        $projectCs->patentType = 'UT';
                        $projectCs->save();
                    }
                }
                elseif($col == "patentAppApproved_created_at" && $projectCs->completed == 3 && $projectCs->overDueReason = 'Client overdue(Patent Application overdue)'){
                    if($projectCs->returnedReason == ''){
                        $projectCs->completed = 1;
                    }else
                        $projectCs->completed = 2;
                    $projectCs->overDueReason ='';
                    $projectCs->save();
                }
                elseif($col == "pctPsaSent_create_at"){
                    //generate the pdf
                    $this->generateEmptyAgreementPSA($id,1);
                    //check de doc dnt exist yet
                    if(($aux=$projectCs->getDocsByName('agreementPCTPSA'))!=null)
                        $aux->delete();
                    //uploaded to the db
                    $this->uploadDoc('PCT_PSA',$id,$projectCs->project->lead->fileno);
                    //sent email
                    file_get_contents(url("emailClientServices?ID=$id&TYPE=PCTPSA"));
                }

            }
            else{ //if the checkbox was unchecked
                // remove the date
                $projectCs->$col="";
                $projectCs->save();

                //in case docs must be remove
                if($col=="ppaSent_created_at"){
                    $rowDocs= ClientSDocs::where('projectclientservices_id',$projectCs->id)->where('name','PSA')->first();
                    if($rowDocs!=null)
                        $rowDocs->delete();
                    $rowDocs2=ClientSDocs::where('projectclientservices_id',$projectCs->id)->where('name','DDR')->first();
                    if($rowDocs2!=null)
                        $rowDocs2->delete();
                }
                elseif($col=="copyrightSent_created_at"){
                    $rowDocs= ClientSDocs::where('projectclientservices_id',$projectCs->id)->where('name','COPYRIGHT')->first();
                    if($rowDocs!=null)
                        $rowDocs->delete();
                    $result="copyright";
                }
                elseif($col=="trademarkSent_created_at"){
                    $rowDocs= ClientSDocs::where('projectclientservices_id',$projectCs->id)->where('name','TRADEMARK')->first();
                    if($rowDocs!=null)
                        $rowDocs->delete();
                    $result="trademark";
                }
                elseif($col=="marketingAgrSent_created_at"){
                    $result="uncheck_ilc_sent";
                }
                elseif($col=="appSent_created_at"){
                    $projectCs->poaDec_created_at="";
                    $projectCs->poaDecReceived_created_at="";
                    $projectCs->patentAppApproved_created_at="";
                    $projectCs->save();
                    $result="uncheck_patent_app";
                }
                elseif($col=="appSentD_created_at"){
                    $projectCs->poaDecSentD_created_at="0000-00-00 00:00:00";
                    $projectCs->poaDecRcvdD_created_at="0000-00-00 00:00:00";
                    $projectCs->patentAppApprovedD_created_at="0000-00-00 00:00:00";
                    $projectCs->save();
                    $result="uncheck_patent_app_d";
                }
            }
        }else
            return "-1";

        return json_encode($result);
    }

    //upload a doc to the db
    function uploadDoc($name,$pin,$fileno){
        $aux_file = UploadedFiles::where('project_id',$pin)->where('fileName',$name.'.pdf')->first();
        if($aux_file!=null)
            $aux_file->delete();
        $uploadFile = new UploadedFiles();
        $uploadFile->project_id = $pin;
        $uploadFile->url = "files/projects/".$fileno."/".$pin."/$name.pdf";
        $uploadFile->fileName = "$name.pdf";
        $uploadFile->save();
    }

    /*
    * Set numbers in the Patent App Process
    * */
    public function setNumberPatentApp(){
        $type = "";
        $id=Input::get('ID');
        $date=Input::get('DATE');
        $numberInvoice=Input::get('NUMBER');
        $col=Input::get('COL');
        $col2=Input::get('COL2');
        $hasDate=Input::get('HASDATE');
        $project=ProjectClientServices::where('project_id',$id)->first();
        if($project!=null){
            $project->$col=$numberInvoice;
            if($numberInvoice=="" && $hasDate==1){
                $project->$col2="";
            }
            else if($hasDate==1){
                if($col2 == 'designInvoiceSentDate')
                    $project->$col2=date('Y-m-d H:i:s',strtotime($date));
                else
                    $project->$col2=$date;
            }
            $project->save();

            if($col == "patentAppNo"){
                $contractT = explode(',',$project->contractTypes);
                foreach($contractT as $c){
                    if($c == 'PCT'){
                        $type.='PCT,';
                    }
                    if($c == 'EPO'){
                        $type.='EPO,';
                    }
                }
                if($type != "")
                    $type=substr($type,0,-1);
            }

            if($col == 'patentAppInvoiceNo' || $col=='designInvoiceNo'){
                //change the state of the client services file
                if($project->phase == 2){
                    $project->phase = 3;
                    $project->changePhaseDate=date('Y-m-d 00:00:00');
                    $project->save();
                }
                if($col == 'designInvoiceNo')
                    $attCs = AttClientServices::where('projectclientservices_id',$project->id)->where('type','DESIGN')->first();
                else
                    $attCs = AttClientServices::where('projectclientservices_id',$project->id)->first();
                if($attCs!=null){
                    $attCs->completed=4;
                    $attCs->stateChangedDate = date('Y-m-d 00:00:00');
                    $attCs->save();
                }
            }

            return json_encode($type);
        }
        return -1;

    }

    /*
     *Add a new row in ClientServices
     * */
    public function addProjectCS(){
        $id=Input::get('ID');
        $project=Project::find($id);
        $contract=Contract::where('project_id',$id)->where('type','LIKE','PPA')->first();
        $pcs = ProjectClientServices::where('project_id',$id)->first();
        if($contract!=null && $pcs == null) {
            $contract_id = $contract->id;
            $newRow = new ProjectClientServices();
            $newRow->project_id = $id;
            $newRow->contract_id = $contract_id;
            $newRow->fileno = $project->lead->fileno;
            $newRow->show = 1;
            $newRow->rcvdDate = $contract->paidDate;
            $newRow->ppaRcvdDate = $contract->paidDate;
            $newRow->save();
            $arr = array($this->paintProject($id, $newRow->id), $id);

            echo json_encode($arr);
        }else
            echo json_encode(array("false"));
    }

    /*
     * Change the state show of the project in Client Services
     * */
    public function changedShow(){
        $state=Input::get('STATE');
        $id=Input::get('ID');
        $project=ProjectClientServices::where('project_id',$id)->first();
        if($project!=null){
            if($state=="1"){
                $project->show=1;
                $project->save();
                //make a new transaction row
                Transaction::createTransaction($this->consultant->id,'','','SHOW_PROJECT_CLIENT_SERVICES','',$id,'','','','','');
            }else{
                $project->show=0;
                $project->save();
                //make a new transaction row
                Transaction::createTransaction($this->consultant->id,'','','HIDE_PROJECT_CLIENT_SERVICES','',$id,'','','','','');
            }
        }else
            return -1;
        echo json_encode(array($id,$state,$project->completed));
//        echo json_encode(array($id,$state,$project->phase+1)); //to when the the new UI with 8 phases is ready
    }

    /*
     * Show a review of the files merged
     * */
    public function reviewMergeFilesOld(){
        $fileIds = Input::get('F_IDS');
        $projectId= Input::get('P_ID');
        $docType= Input::get('DOC_TYPE');
        $project = Project::find($projectId);

        if($project==null)
            return "-1";
        $projectCs = $project->clientServicesProject();
        if($projectCs==null)
            return "-1";

        //geting the type of contract to create the first page of the coversheet
        $provisional= -1;
        if($projectCs->hasType("PROV"))
            $provisional = 1;
        $utility = -1;
        if($projectCs->hasType("UT"))
            $utility = 1;
        $design = -1;
        if($projectCs->hasType("D"))
            $design = 1;
        $epo = -1;
        if($projectCs->hasType("EPO"))
            $epo = 1;
        $pct = -1;
        if($projectCs->hasType("PCT"))
            $pct = 1;
        $trademark = -1;
        if($projectCs->hasType("TM"))
            $trademark = 1;
        $copyright = -1;
        if($projectCs->hasType("CR"))
            $copyright = 1;
        $upgrade = -1;
        if($projectCs->hasType("UPG_UT")){
            $upgrade = 1;
            $provisional = 0;
        }

        if($docType == "ATT_COVERSHEET"){
            $content =view('templates.client_services.mail_ph2AttorneyCoverSheet_template_pdf',
                array('client'=>$project->lead,'provisional'=>$provisional,'utility'=>$utility,'design'=>$design,
                    'epo'=>$epo,'pct'=>$pct,'upgrade'=>$upgrade,'trademark'=>$trademark,'copyright'=>$copyright,'project'=>$project));
            $pdf1 = App::make('dompdf.wrapper');
            $pdf1->loadHTML($content);
            $pdf1->save("files/projects/".$project->lead->fileno."/".$project->id."/"."ph2AttorneyCoverSheet_pag1.pdf");
        }
        elseif($docType == "ILC_COVERSHEET"){
            $contractIMG = Contract::where('project_id',$projectId)->where('type','IMG')->whereRaw('price = paid')->first();
            $contractIGUP = Contract::where('project_id',$projectId)->where('type','IGUP')->whereRaw('price = paid')->first();
            $img=-1;
            if($contractIMG!=null && $contractIGUP == null)
                $img=1;
            $content =view('templates.client_services.mail_ph1ILCCoversheet_template_pdf',
                array('project'=>$project, 'pcs'=>$projectCs,'client'=>$project->lead,'prov'=>$provisional,'ut'=>$utility,'design'=>$design,
                    'epo'=>$epo,'pct'=>$pct,'upg'=>$upgrade,'tm'=>$trademark,'cr'=>$copyright,'img'=>$img));
            $pdf1 = App::make('dompdf.wrapper');
            $pdf1->loadHTML($content);
            $pdf1->save("files/projects/".$project->lead->fileno."/".$project->id."/"."ph1ILCCoverSheet_pag1.pdf");
        }

        // check img to convert to pdf and get the new file_id
        foreach($fileIds as $file_id){
            $file=UploadedFiles::find($file_id);
            $file_url = $file->url;
            //check the extesion of the file
            $ext=substr($file_url,-3);
            if($ext != "pdf" && $ext != "PDF"){
                //make the pdf from img
                $new_url=substr($file_url,0,strlen($file_url)-3);
                $new_url.="pdf";
                $content = view('templates.client_services.coversheet_image_to_pdf_template_pdf',array('imgPath'=>$file_url));
                $pdf = App::make('dompdf.wrapper');
                $pdf->loadHTML($content);
                $pdf->save($new_url);
            }
            if($docType == "ILC_COVERSHEET"){
                $file->ilc =1;
                $file->save();
            }
        }


        // url to call the script to merge the files
        $finalurl="";

        //serialze the files ids
        $serialized_ids= urlencode(serialize($fileIds));
        //call the script
        if($docType == "ATT_COVERSHEET")
            $finalurl=urlencode("../../../public/files/projects/".$project->lead->fileno.'/'.$project->id."/attorneyCoverSheet.pdf");
        elseif($docType == "ILC_COVERSHEET")
            $finalurl=urlencode("../../../public/files/projects/".$project->lead->fileno.'/'.$project->id."/ilcCoverSheet.pdf");
        elseif($docType == "TM_COVERSHEET")
            $finalurl=urlencode("../../../public/files/projects/".$project->lead->fileno.'/'.$project->id."/trademarkCoverSheet.pdf");
        elseif($docType == "CR_COVERSHEET")
            $finalurl=urlencode("../../../public/files/projects/".$project->lead->fileno.'/'.$project->id."/copyRightCoverSheet.pdf");

        $resultMerg = ToolsFunctions::curl(url("../app/Helpers/PDFMerger/mergePdf.php?IDS=".$serialized_ids."&URL=".$finalurl."&PID=".$projectId."&FILENO=".$project->lead->fileno."&DOC=".$docType));//

        if($resultMerg == "1") { // if none error happened
            if($docType == "ATT_COVERSHEET"){
                $ifexists=UploadedFiles::where('project_id',$projectId)->where('fileName',"attorneyCoverSheet.pdf")->first();
                if($ifexists != null)
                    $ifexists->delete();
                $uploadMerge = new UploadedFiles();
                $uploadMerge->project_id = $projectId;
                $uploadMerge->url = "files/projects/".$project->lead->fileno.'/'.$project->id."/attorneyCoverSheet.pdf" ;
                $uploadMerge->fileName = "attorneyCoverSheet.pdf";
                $uploadMerge->attorney =1;
                $uploadMerge->save();
                $result = array($uploadMerge->id,url("files/projects/".$project->lead->fileno.'/'.$project->id."/attorneyCoverSheet.pdf"));
            }
            elseif($docType == "ILC_COVERSHEET"){
                $ifexists=UploadedFiles::where('project_id',$projectId)->where('fileName',"ilcCoverSheet.pdf")->first();
                if($ifexists != null)
                    $ifexists->delete();
                $uploadMerge = new UploadedFiles();
                $uploadMerge->project_id = $projectId;
                $uploadMerge->url = "files/projects/".$project->lead->fileno.'/'.$project->id."/ilcCoverSheet.pdf" ;
                $uploadMerge->fileName = "ilcCoverSheet.pdf";
                $uploadMerge->ilc =1;
                $uploadMerge->save();
                foreach($fileIds as $fid){
                    $upFile =UploadedFiles::find($fid);
                    $upFile->ilc =1;
                    $upFile->save();
                }
                $result = array($uploadMerge->id,url("files/projects/".$project->lead->fileno.'/'.$project->id."/ilcCoverSheet.pdf"));
            }
            elseif($docType == "CR_COVERSHEET"){
                $ifexists=UploadedFiles::where('project_id',$projectId)->where('fileName',"copyRightCoverSheet.pdf")->first();
                if($ifexists != null)
                    $ifexists->delete();
                $uploadMerge = new UploadedFiles();
                $uploadMerge->project_id = $projectId;
                $uploadMerge->url = "files/projects/".$project->lead->fileno.'/'.$project->id."/copyRightCoverSheet.pdf" ;
                $uploadMerge->fileName = "copyRightCoverSheet.pdf";
                $uploadMerge->attorney =1;
                $uploadMerge->save();
                $result = array($uploadMerge->id,url("files/projects/".$project->lead->fileno.'/'.$project->id."/copyRightCoverSheet.pdf"));
            }
            elseif($docType == "TM_COVERSHEET"){
                $ifexists=UploadedFiles::where('project_id',$projectId)->where('fileName',"trademarkCoverSheet.pdf")->first();
                if($ifexists != null)
                    $ifexists->delete();
                $uploadMerge = new UploadedFiles();
                $uploadMerge->project_id = $projectId;
                $uploadMerge->url = "files/projects/".$project->lead->fileno.'/'.$project->id."/trademarkCoverSheet.pdf" ;
                $uploadMerge->fileName = "trademarkCoverSheet.pdf";
                $uploadMerge->attorney =1;
                $uploadMerge->save();
                $result = array($uploadMerge->id,url("files/projects/".$project->lead->fileno.'/'.$project->id."/trademarkCoverSheet.pdf"));
            }


            return json_encode($result);
        }

        return array("-1");
    }

    public function reviewMergeFiles(){
        $pdfMerger = new PDFManage();
        // url to call the script to merge the files
        $finalurl="";

        $fileIds = Input::get('F_IDS');
        $projectId= Input::get('P_ID');
        $docType= Input::get('DOC_TYPE');
        $project = Project::find($projectId);

        if($project==null)
            return "-1";
        $projectCs = $project->clientServicesProject();
        if($projectCs==null)
            return "-1";

        //geting the type of contract to create the first page of the coversheet
        $provisional= -1;
        if($projectCs->hasType("PROV"))
            $provisional = 1;
        $utility = -1;
        if($projectCs->hasType("UT"))
            $utility = 1;
        $design = -1;
        if($projectCs->hasType("D"))
            $design = 1;
        $epo = -1;
        if($projectCs->hasType("EPO"))
            $epo = 1;
        $pct = -1;
        if($projectCs->hasType("PCT"))
            $pct = 1;
        $trademark = -1;
        if($projectCs->hasType("TM"))
            $trademark = 1;
        $copyright = -1;
        if($projectCs->hasType("CR"))
            $copyright = 1;
        $upgrade = -1;
        if($projectCs->hasType("UPG_UT")){
            $upgrade = 1;
            $provisional = 0;
        }

        if($docType == "ATT_COVERSHEET"){
            //giving value to the url to save the file merged
            $finalurl= "attorneyCoverSheet.pdf";
            //generating first page of coversheet
            $content =view('templates.client_services.mail_ph2AttorneyCoverSheet_template_pdf',
                array('client'=>$project->lead,'provisional'=>$provisional,'utility'=>$utility,'design'=>$design,
                    'epo'=>$epo,'pct'=>$pct,'upgrade'=>$upgrade,'trademark'=>$trademark,'copyright'=>$copyright,'project'=>$project));
            $pdf1 = App::make('dompdf.wrapper');
            $pdf1->loadHTML($content);
            $pdf1->save("files/projects/".$project->lead->fileno."/".$project->id."/"."ph2AttorneyCoverSheet_pag1.pdf");
            $pdfMerger->addPDF("files/projects/".$project->lead->fileno."/".$project->id."/"."ph2AttorneyCoverSheet_pag1.pdf");
        }
        elseif($docType == "ILC_COVERSHEET"){
            //giving value to the url to save the file merged
            $finalurl= "ilcCoverSheet.pdf";
            //generating first page of coversheet
            $contractIMG = Contract::where('project_id',$projectId)->where('type','IMG')->whereRaw('price = paid')->first();
            $contractIGUP = Contract::where('project_id',$projectId)->where('type','IGUP')->whereRaw('price = paid')->first();
            $img=-1;
            if($contractIMG!=null && $contractIGUP == null)
                $img=1;
            $content =view('templates.client_services.mail_ph1ILCCoversheet_template_pdf',
                array('project'=>$project, 'pcs'=>$projectCs,'client'=>$project->lead,'prov'=>$provisional,'ut'=>$utility,'design'=>$design,
                    'epo'=>$epo,'pct'=>$pct,'upg'=>$upgrade,'tm'=>$trademark,'cr'=>$copyright,'img'=>$img));
            $pdf1 = App::make('dompdf.wrapper');
            $pdf1->loadHTML($content);
            $pdf1->save("files/projects/".$project->lead->fileno."/".$project->id."/"."ph1ILCCoverSheet_pag1.pdf");
            $pdfMerger->addPDF("files/projects/".$project->lead->fileno."/".$project->id."/"."ph1ILCCoverSheet_pag1.pdf");
        }
        elseif($docType == "TM_COVERSHEET")
            $finalurl="trademarkCoverSheet.pdf";
        elseif($docType == "CR_COVERSHEET")
            $finalurl="copyRightCoverSheet.pdf";

        // check img to convert to pdf and get the new file_id
        foreach($fileIds as $file_id){
            $file=UploadedFiles::find($file_id);
            $file_url = $file->url;
            if($docType == "ILC_COVERSHEET"){
                $file->ilc =1;
                $file->save();
            }
            //check the extension of the file
            $ext=substr($file_url,-3);
            if($ext != "pdf" && $ext != "PDF"){
                //make the pdf from img
                $new_url=substr($file_url,0,strlen($file_url)-3);
                $new_url.="pdf";
                $content = view('templates.client_services.coversheet_image_to_pdf_template_pdf',array('imgPath'=>$file_url));
                $pdf = App::make('dompdf.wrapper');
                $pdf->loadHTML($content);
                $pdf->save($new_url);
                //add new img converted to pdf to the pdfMerger
                $pdfMerger->addPDF($new_url);
            }else{
                //find out if file is in public or in UploadedFiles
                $arrAux = explode('../../',$file_url);
                if(count($arrAux)>1){
                    //add pdf to the pdfMerger
                    $pdfMerger->addPDF($_SERVER['DOCUMENT_ROOT']."/".$arrAux[1]);
                }else{
                    //add pdf to the pdfMerger
                    $pdfMerger->addPDF($file_url);
                }
            }

        }
        //save the merged file
        $resultMerg = $pdfMerger->merge('file', $_SERVER['DOCUMENT_ROOT']."/3.0/public/files/projects/".$project->lead->fileno."/".$project->id."/".$finalurl, 'P');

        // if none error happened save the new merged file;
        if($resultMerg == "1") {
            $ifexists=UploadedFiles::where('project_id',$projectId)->where('fileName',$finalurl)->first();
            if($ifexists != null)
                $ifexists->delete();
            $uploadMerge = new UploadedFiles();
            $uploadMerge->project_id = $projectId;
            $uploadMerge->url = "files/projects/".$project->lead->fileno.'/'.$project->id."/".$finalurl ;
            $uploadMerge->fileName = $finalurl;
            ($docType == "ILC_COVERSHEET")?$uploadMerge->ilc =1:$uploadMerge->attorney =1;
            $uploadMerge->save();
            $result = array($uploadMerge->id,url("files/projects/".$project->lead->fileno.'/'.$project->id."/".$finalurl));
            return json_encode($result);
        }

        return array("-1");
    }

    /*
     * Send the file already merge it to attorney
     * */
    public function mergeFiles($fileIdP = null, $attEm = null, $attId = null){
        if($fileIdP != null && $attEm != null && $attId != null){
            $fileId= $fileIdP;
            $att_email = $attEm;
            $att_id = $attId;
        }else{
            $fileId= Input::get('FILE_ID');
            $att_email = trim(Input::get('ATT_EMAIL'));
            $att_id = Input::get('ATT_ID');
        }

        if($att_email=="N/A")
            return "-1";
        $file = UploadedFiles::find($fileId);
        if($file==null)
            return "-1";
        $proj = Project::find($file->project_id);
        if($proj==null)
            return "-1";
        $CS = $proj->clientServicesProject();
        if($CS==null)
            return "-1";


        $CS->documentSent_created_at = date('m-d-Y');
        $CS->attorney_id = $att_id;
        $CS->save();

 // create a row in the AttClientServices model

        //know the type of app to put in the att view
        if($CS->hasType('UPG_UT'))
            $type ="UPG_UT";
        elseif($CS->hasType('PROV'))
            $type ="PROV";
        else
            $type = "UT";
        //DUE DATES FOR UPG_UT
        $dueDate = "0000-00-00 00:00:00";

        //check if exist to overwrite or if was prov change to upgrade and add dueDate
        $attCS = AttClientServices::where('projectclientservices_id',$CS->id)->where('type','not like','DESIGN')->first();
        if($attCS != null){
            if($type == "UPG_UT"){
                    if($CS->appSent_created_at != ''){
                        $attCS = AttClientServices::where('projectclientservices_id',$CS->id)->where('type','UPG_UT')->first();
                        if($attCS == null) {
                            $attCS = new AttClientServices();
                            //save when upgrade coversheet was sent
                            $CS->docUpgSent_created_at = date('Y-m-d 00:00:00');
                            $CS->save();
                        }
                        else
                            $dueDate = $attCS->dueDate;
                    }else{
                        $attCS = AttClientServices::where('projectclientservices_id',$CS->id)->where('type','UPG_UT')->first();
                        if($attCS == null){
                            //save when upgrade coversheet was sent
                            $CS->docUpgSent_created_at = date('Y-m-d 00:00:00');
                            $CS->save();

                            //find the provisional to replace it
                            $attCS = AttClientServices::where('projectclientservices_id',$CS->id)->where('type','PROV')->first();
                            if($attCS == null)
                                $attCS = new AttClientServices();
                            else
                                $dueDate = date("m-d-Y",strtotime($attCS->created_at." +30 days"));
                        }
                        else{
                            $dueDate = $attCS->dueDate;
                        }
                    }
            }
        }
        else{
            $attCS = new AttClientServices();
        }

        $attCS->projectclientservices_id = $CS->id;
        $attCS->completed = 0;
        $attCS->consultant_id = $att_id;
        $attCS->lead_id = $proj->lead_id;
        $attCS->type =$type;
        $attCS->reminderToAttAppDate =date('Y-m-d 00:00:00');
        $attCS->dueDate = $dueDate;
        $attCS->save();

        //if also have design already create a row for design too
        if($CS->hasType('D')){
            $attCSD = AttClientServices::where('projectclientservices_id',$CS->id)->where('type','DESIGN')->first();
            if($attCSD == null)
                $attCSD = new AttClientServices();
            $attCSD->projectclientservices_id = $CS->id;
            $attCSD->completed = 0;
            $attCSD->consultant_id = $att_id;
            $attCSD->lead_id = $proj->lead_id;
            $attCSD->type ="DESIGN";
            $attCSD->reminderToAttAppDate =date('Y-m-d 00:00:00');
            $attCSD->save();
        }

        //send email
        file_get_contents(url("emailDocToAtt?ID=".$file->project_id."&URL=".urlencode($file->url)."&AE=".$att_email."&TYPE=".$type."&ATTID=".$attCS->id));

        //make a new transaction row
        Transaction::createTransaction($this->consultant->id,'','','DOCUMENTS_SENT_TO_ATTORNEY','',$proj->id,'','','','','');

        return json_encode($CS->documentSent_created_at);
    }

    //send the design coversheet
    public function sendDesignCoversheet(){
        $pid = Input::get('ID');
        $project = Project::find($pid);
        if($project == null)
            return -1;
        $pcs = $project->clientServicesProject();
        if($pcs ==  null)
            return -1;

        $file = UploadedFiles::where('project_id',$pid)->where('fileName','attorneyCoverSheet.pdf')->first();
        if($file == null)
            return -2;

        $attCS = AttClientServices::where('projectclientservices_id',$pcs->id)->where('type','DESIGN')->first();
        if($attCS == null )
            $attCS = new AttClientServices();
        $attCS->projectclientservices_id = $pcs->id;
        $attCS->completed = 0;
        $attCS->type = "DESIGN";
        $attCS->consultant_id = $pcs->attorney_id;
        $attCS->lead_id = $project->lead_id;
        $attCS->reminderToAttAppDate =date('Y-m-d 00:00:00');
        $attCS->save();

        //send email
        file_get_contents(url("emailCoversheetToAtt?ID=".$pid."&UPG=0&URL=".urlencode($file->url)));

        return 1;
    }

    public function sendDesignCoversheetWithFile(){
        $pid = Input::get('ID');
        $fid =Input::get('FILES')[0];
        $project = Project::find($pid);
        if($project == null)
            return -1;
        $pcs = $project->clientServicesProject();
        if($pcs ==  null)
            return -1;

        $file = UploadedFiles::find($fid);
        if($file == null)
            return -1;

        $attCS = AttClientServices::where('projectclientservices_id',$pcs->id)->where('type','DESIGN')->first();
        if($attCS == null )
            $attCS = new AttClientServices();
        $attCS->projectclientservices_id = $pcs->id;
        $attCS->completed = 0;
        $attCS->type = "DESIGN";
        $attCS->consultant_id = $pcs->attorney_id;
        $attCS->lead_id = $project->lead_id;
        $attCS->reminderToAttAppDate =date('Y-m-d 00:00:00');
        $attCS->save();
        //send email

        file_get_contents(url("emailCoversheetToAtt?ID=".$pid."&UPG=0&FILE=".$fid."&URL=".urlencode($file->url)));
        // create a row in the AttClientServices model

        return 1;
    }

    public function sendUpgCoversheet(){
        $pid = Input::get('ID');
        $auxType = Input::get('TYPE');
        $rcvdDate = Input::get('RDATE');
        $dueDate = Input::get('DDATE');
        $project = Project::find($pid);
        if($project == null)
            return -1;
        $pcs = $project->clientServicesProject();
        if($pcs ==  null)
            return -1;

        $file = UploadedFiles::where('project_id',$pid)->where('fileName','attorneyCoverSheet.pdf')->first();
        if($file == null){
            $files = Input::get('FILES');
            if($files == null)
                return -2;
            else
                $file = UploadedFiles::find($files[0]);
        }

        // create a row in the AttClientServices model
        $attCS = AttClientServices::where('projectclientservices_id',$pcs->id)->where('type','UPG_UT')->first();
        if($attCS == null)
            $attCS = new AttClientServices();
        $attCS->projectclientservices_id = $pcs->id;
        $attCS->completed = 0;
        $attCS->type = "UPG_UT";
        $attCS->consultant_id = $pcs->attorney_id;
        $attCS->lead_id = $project->lead_id;
        $attCS->reminderToAttAppDate =date('Y-m-d 00:00:00');
        $attCS->dueDate = date("Y-m-d 00:00:00",strtotime(str_replace('-','/',$dueDate)));
        $attCS->save();

        $pcs->docUpgSent_created_at = date('Y-m-d 00:00:00');
        $pcs->save();

        //send email
        if($file->fileName == 'attorneyCoverSheet.pdf')
            ToolsFunctions::curl(url("emailCoversheetToAtt?ID=$pid&UPG=1&TYPE=$auxType&RDATE=$rcvdDate&DDATE=$dueDate&URL=".urlencode($file->url)));
        else{
            $fileId = $file->id;
            file_get_contents(url("emailCoversheetToAtt?ID=$pid&FILE=$fileId&UPG=1&TYPE=$auxType&RDATE=$rcvdDate&DDATE=$dueDate&URL=".urlencode($file->url)));
        }

        return 1;
    }

    //return the patent app by the client
    public function returnPatentAppByClientServices(){
        $pid = Input::get('PID');
        $notes = Input::get('NOTES');
        $appType = Input::get('TYPE');//DESIGN or UT
        $files = Input::get('FILES');


        $project = Project::find($pid);
        if($project!=null) {
            $pCS = $project->clientServicesProject();
            $attCS = AttClientServices::where('projectclientservices_id',$pCS->id)->where('type',$appType)->first();
            if($attCS == null)
                return -1;
            $pCS->completed = 2;
            $pCS->returnedReason = $notes;
            $pCS->save();

            $attCS->completed=2;
            $attCS->stateChangedDate = date('Y-m-d 00:00:00');
            $attCS->returnedReason = $notes;
            $attCS->save();

            //serialze the files ids
            $serialized_ids= urlencode(serialize($files));

            file_get_contents(url("emailReturnedApp?ID=$pCS->id&AT_ID=$pCS->attorney_id&NOTES=".urlencode($notes)."&FILES=".$serialized_ids));

            //Note
            $csNote = new ClientSNotes();
            $csNote->notes = "Client Services sent revisions to the Att";
            $csNote->projectclientservices_id = $pCS->id;
            $csNote->save();
            //transaction
            Transaction::createTransaction('',$project->lead->id,'','PATENT_APP_RETURNED_BY_CLIENT_SERVICES',$notes,$pid,'','','','','');

            return "1";
        }else
            return "-1";
    }

    /*
     *Send back some doc to the client to sign
     * */
    public function resendFile(){
        $file_id = Input::get('FILE_ID');
        $notes = Input::get('NOTE');
        $proj_id = Input::get('PIN');
        $csDoc =ClientSDocs::where('file_id',$file_id)->first();
        $project = Project::find($proj_id);
        $consultant_id = -1;
//        $lead_id = -1;
        if($project!=null){
            $consultant_id=$project->consultant_id;
//            $lead_id = $project->lead_id;
        }

        $lead = $project->lead;//Lead::find($lead_id);


        if($csDoc!=null) {
            $csDoc->notes_resend = $notes;
            $csDoc->file_id=-1;// given the fact that the doc must be sign again then the file physically dnt should exist so dnt have a file_id
            $csDoc->save();
            $result = "return".$csDoc->name."_";

            if($consultant_id!=-1){
                $aux_id=$consultant_id;
                $msgInbox = "The document ".$csDoc->name." was send it back.<br>".date("m-d-Y H:i:s")."<br>Client: ".$lead->fname." ".$lead->lname.
                    "<br>File #: ".$lead->fileno."<br>Pin: ".$proj_id."<br>Reason: ".$notes;
                Inbox::createInbox($lead->id,$aux_id,$msgInbox,"CLIENT SERVICES","CLIENT");
            }
            $pcs=$project->clientServicesProject();
            if($pcs == null)
                return json_encode(-1);
            $pcs->completed = 2;
            $pcs->returnedReason = $notes;
            $pcs->save();
            //make a new transaction row
            Transaction::createTransaction($this->consultant->id,'','','DOCUMENTS_SENT_BACK_TO_CLIENT',$csDoc->name,$proj_id,'','','','','');
            return json_encode($result);
        }
        return json_encode(-1);
    }

    //create WelcomeLetter
    public function generateCSWelcomeLetterWithPSAandDDR($project_id)
    {
        $project = Project::find($project_id);
        $lead_id = $project->lead_id;
        $lead = Lead::find($lead_id);
        $data = ToolsFunctions::obtainPPAInfo($project_id);
        $dateBy= $data['PPA_Received_Date__c'];
        $contractBy = $data['PPA_Contract_Amount__c'];
        $viaBy = $data['PPA_Payment_Type__c'];
        $amountBy = $data['PPA_Payment_Amount__c'];
        $percentageBy = round($data['PPA_Percentage_Paid__c'],2);
        $balanceBy = $contractBy - $amountBy;

        $content = view('templates.client_services.mail_welcome_letter_template_pdf',
            array('amountBy'=>$amountBy,'dateBy'=>$dateBy,'viaBy'=>$viaBy,'balanceBy'=>$balanceBy,'percentageBy'=>$percentageBy,'contractBy'=>$contractBy));

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($content);
        if(!File::exists("files/projects/".$project->lead->fileno."/".$project->id)) {
            File::makeDirectory("files/projects/".$project->lead->fileno."/".$project->id, 0755, true);
        }

        $aux_file = UploadedFiles::where('project_id',$project->id)->where('fileName','DDR_welcomeLetter.pdf')->first();
        if($aux_file!=null)
            $aux_file->delete();
        //upload file to db
        $file = new UploadedFiles();
        $file->project_id = $project_id;
        $file->url = "files/projects/".$lead->fileno."/".$project_id."/DDR_welcomeLetter.pdf";
        $file->fileName = "DDR_welcomeLetter.pdf";
        $file->public =1;
        $file->clientVendor =1;
        $file->save();

        $pdf->save("files/projects/".$lead->fileno."/".$project->id."/"."DDR_welcomeLetter.pdf");
        return $pdf->stream();
    }

    //create empty DDR
    public function generateEmptyDDR($project_id){
        $project = Project::find($project_id);
        $lead = $project->lead;
        $pdf = App::make('dompdf.wrapper');//AndDesign
        $content =  view('templates.client_services.docusign_ddr_template_pdf',array('client'=>$lead,'project'=>$project));
        $pdf->loadHTML($content);
        if(!File::exists("files/projects/".$project->lead->fileno."/".$project->id)) {
            File::makeDirectory("files/projects/".$project->lead->fileno."/".$project->id, 0755, true);
        }
        $pdf->save("files/projects/".$lead->fileno."/".$project->id."/"."ddr.pdf");
        return $pdf->stream();
    }
    //create empty AgreementPSA
    public function generateEmptyAgreementPSA($project_id, $pct = 0){
        $project = Project::find($project_id);
        $lead = $project->lead;
        $pcs = ProjectClientServices::where('project_id',$project_id)->first();
        $att = Consultant::find($pcs->attorney_id);
        $pdf = App::make('dompdf.wrapper');//AndDesign
        if($pct == 0)
            $content =  view('templates.client_services.docusign_psa_template_pdf',array('client'=>$lead,'project'=>$project,'attorney'=>$att));
        else
            $content =  view('templates.client_services.empty_mail_agreementPCTPSA_template_pdf',array('client'=>$lead,'project'=>$project,'attorney'=>$att));
        $pdf->loadHTML($content);
        if(!File::exists("files/projects/".$project->lead->fileno."/".$project->id)) {
            File::makeDirectory("files/projects/".$project->lead->fileno."/".$project->id, 0755, true);
        }
        if($pct == 0)
            $pdf->save("files/projects/".$lead->fileno."/".$project->id."/"."agreementPSA.pdf");
        elseif($pct == 1)
            $pdf->save("files/projects/".$lead->fileno."/".$project->id."/"."PCT_PSA.pdf");
        return $pdf->stream();
    }

    //create empty CopyRight Questionnaire
    public function generateEmptyCopyRQ($project_id){
        $project = Project::find($project_id);
        $lead = $project->lead;
        $pdf = App::make('dompdf.wrapper');//AndDesign
        $content =  view('templates.client_services.empty_mail_copyright_questionnaire_template_pdf',array('client'=>$lead));
        $pdf->loadHTML($content);
        if(!File::exists("files/projects/".$project->lead->fileno."/".$project->id)) {
            File::makeDirectory("files/projects/".$project->lead->fileno."/".$project->id, 0755, true);
        }
        $pdf->save("files/projects/".$lead->fileno."/".$project->id."/"."copyrightQuestionnaire.pdf");
        return $pdf->stream();
    }

    //create empty Trademark Questionnaire
    public function generateEmptyTrademark($project_id){
        $project = Project::find($project_id);
        $lead = $project->lead;
        $pdf = App::make('dompdf.wrapper');//AndDesign
        $content =  view('templates.client_services.empty_mail_trademark_copyright_template_pdf',array('client'=>$lead));
        $pdf->loadHTML($content);
        if(!File::exists("files/projects/".$project->lead->fileno."/".$project->id)) {
            File::makeDirectory("files/projects/".$project->lead->fileno."/".$project->id, 0755, true);
        }
        $pdf->save("files/projects/".$lead->fileno."/".$project->id."/"."trademark.pdf");
        return $pdf->stream();
    }

    //change the attorney selected
    public function changeAtt(){
        $pid = Input::get('PID');
        $att_id = Input::get('ID');
        $att = Consultant::find($att_id);
        $pCS =ProjectClientServices::where('project_id',$pid)->first();
        $pCS->attorney_id = $att_id;
        $pCS->save();
        return json_encode($att->email);
    }

    /*
     * upload files from client services view
    */
    public function uploadFileClientS(){
        $file = Input::file('file');
        $projectId = Input::get('PROJECT');
        $clientServicesId = Input::get('CONSULTANT');
        $command = Input::get('COMMAND');
        $email_att = Input::get('EMAILATT');
        $att_id = Input::get('ATTID');
        $project = Project::find($projectId);
        if($project!=null){
            $projectCs=$project->clientServicesProject();
            //in case that for any reason the att id or the att email don't goes through
            if(trim($email_att) == ''){
                $att_id = $projectCs->attorney_id;
                $att = Consultant::find($att_id);
                $email_att = $att->email;
            }
            if($file){
                $fileName = '';
                if($command == 'HOME' || $command == 'ATT'){
                    $fileName = $file->getClientOriginalName();
                }elseif($command == 'PA'){
                    $fileName = 'PAU_'.$file->getClientOriginalName();
                    ////set the date in the db for this field
                    $nowDate = date('m-d-Y');
                    $projectCs->appSent_created_at = $nowDate;
                    $projectCs->poaDec_created_at = $nowDate;
                    $projectCs->completed=1;
                    if($projectCs->phase == 1){
                        $projectCs->phase = 2;
                        $projectCs->changePhaseDate=date('Y-m-d 00:00:00');
                    }
                    $projectCs->save();

                }elseif($command == 'PROV'){
                    $fileName = 'PROV_'.$file->getClientOriginalName();
                    ////set the date in the db for this field
                    $nowDate = date('m-d-Y');
                    $projectCs->appSent_created_at = $nowDate;
                    $projectCs->poaDec_created_at = $nowDate;
                    $projectCs->completed=1;
                    if($projectCs->phase == 1){
                        $projectCs->phase = 2;
                        $projectCs->changePhaseDate=date('Y-m-d 00:00:00');
                    }
                    $projectCs->save();
                }elseif($command == 'DESIGN'){
                    $fileName = 'PAD_'.$file->getClientOriginalName();
                    ////set the date in the db for this field
                    $nowDate = date('Y-m-d');
                    $projectCs->appSentD_created_at = $nowDate;
                    $projectCs->poaDecSentD_created_at = $nowDate;
                    $projectCs->completed=1;
                    if($projectCs->phase == 1){
                        $projectCs->phase = 2;
                        $projectCs->changePhaseDate=date('Y-m-d 00:00:00');
                    }
                    $projectCs->save();
                }elseif($command == 'DtoA')
                    $fileName = "attorneyCoverSheet.pdf";



                $file->move(public_path().'/files/projects/'.$project->lead->fileno.'/'.$project->id.'/uploaded', $fileName);
                //create the row in upload file
                $upFile = UploadedFiles::where('project_id',$projectId)->where('fileName',$fileName)->first();
                if( $upFile != null)
                    $upFile->delete();

                $uploadFile = new UploadedFiles();
                $uploadFile->project_id = $projectId;
                $uploadFile->url = "files/projects/".$project->lead->fileno."/".$project->id."/uploaded/$fileName";
                $uploadFile->fileName = $fileName;
                $uploadFile->admin_id = $clientServicesId;
                if($command == 'ATT' || $command == 'DtoA')
                    $uploadFile->attorney = 1;
                $uploadFile->ip = $_SERVER["REMOTE_ADDR"];
                $uploadFile->save();

                /////////// if is Dtoa is send the doc to the attorney
                if($command == 'DtoA')
                    return $this->mergeFiles($uploadFile->id, $email_att,$att_id);

                $filenameAux = urlencode($fileName);
                $emailAux = urlencode($email_att);
                //////////if the file is uploaded to the attorney
                if($command == 'ATT')
                    file_get_contents(url("emailUpDocToAtt?ID=$projectId&FILENAME=".urlencode($filenameAux)."&AE=".urlencode($emailAux)));

                //create the Transaction
                if($command == 'HOME')
                    Transaction::createTransaction($clientServicesId,$project->lead_id,'','UPLOAD_FILE_CS',$fileName,$projectId,'','','','','');
            }
        }
    }

    // to generate the patent package and erase previous docs
    public function beforeSendPatent(){
        $project  = Project::find(Input::get('PID'));
        $type = Input::get('TYPE');
        $call = Input::get('CALL');


        if($project!=null){
            $projectCs = $project->clientServicesProject();
            //change the state from returned to at proccess
            if($projectCs->completed == 2){
                $projectCs->completed=1;
                $projectCs->save();
            }
            //check if there another sent patent app package
            if($type=="DESIGN" && $projectCs->appSent_created_at != '' && $projectCs->patentAppApproved_created_at=='')
                return json_encode('DESIGN_STARTED');
            if(($type=="PA" || $type=="PROV") && $projectCs->appSentD_created_at != '0000-00-00 00:00:00' && $projectCs->patentAppApprovedD_created_at=='0000-00-00 00:00:00')
                return json_encode('PATENT_STARTED');

            //erase the rows of the clientSDocs because dnt should exist docs without sign if another patent app will be send
            $docsAppPack = $projectCs->getDocsApp();
            foreach($docsAppPack as $doc)
                $doc->delete();

            //if exits the imgs of the signs delete them
            if(File::exists("files/projects/".$project->lead->fileno."/signature_poa.jpg"))
                unlink("files/projects/".$project->lead->fileno."/signature_poa.jpg");
            if(File::exists("files/projects/".$project->lead->fileno."/signature_mE.jpg"))
                unlink("files/projects/".$project->lead->fileno."/signature_mE.jpg");
            if($project->coInventor =='')
                $coInvCount=0;
            else
                $coInvCount = count(explode(',',$project->coInventor))+1;
            for($i=1;$i<$coInvCount;$i++){
                if(File::exists("files/projects/".$project->lead->fileno."/signature_poa_coInv".$i.".jpg"))
                    unlink("files/projects/".$project->lead->fileno."/signature_poa_coInv".$i.".jpg");
                if(File::exists("files/projects/".$project->lead->fileno."/signature_mE_coInv".$i.".jpg"))
                    unlink("files/projects/".$project->lead->fileno."/signature_mE_coInv".$i.".jpg");
            }

            if($type=="DESIGN"){
                //delete the patent apps previously sent
                if($call == "SEND") {
                    $aux_files = UploadedFiles::where('project_id', $project->id)->where('fileName', 'like', 'PAD_%')->get();
                    foreach ($aux_files as $aux_file)
                        $aux_file->delete();
                }

                $this->uploadCSDoc($projectCs->id,'declarationD',0);
                $this->uploadCSDoc($projectCs->id,'poaD',$coInvCount);
                $this->uploadCSDoc($projectCs->id,'microEntityD',$coInvCount);

                $this->generateEmptyDec($project->id,'declarationD');
                $this->generateEmptyPoa($project->id,'power_of_attorneyD');
                $this->generateEmptyMicroEntity($project->id,'certification_of_microEntityD');
                //upload this files to db
                $this->uploadDoc('declarationD',$project->id,$project->lead->fileno);
                $this->uploadDoc('power_of_attorneyD',$project->id,$project->lead->fileno);
                $this->uploadDoc('certification_of_microEntityD',$project->id,$project->lead->fileno);
                if($project->coInventor != '') {
                    for ($i = 1; $i < $coInvCount; $i++) {
                        $this->uploadDoc("power_of_attorneyD_coInv$i", $project->id, $project->lead->fileno);
                        $this->uploadDoc("certification_of_microEntityD_coInv$i", $project->id, $project->lead->fileno);
                    }
                    $this->uploadCSDoc($projectCs->id,'addDeclarationD',0);
                    $this->generateEmptyAddDec($project->id,'additional_inventorsD');
                    $this->uploadDoc('additional_inventorsD',$project->id,$project->lead->fileno);
                }

            }elseif($type=="PROV"){
                //delete the patent apps previously sent
                if($call == "SEND") {
                    $aux_files = UploadedFiles::where('project_id',$project->id)->where('fileName','like','PROV_%')->get();
                    foreach($aux_files as $aux_file)
                        $aux_file->delete();
                }
                //if it's prov only sent the microEntity
                $this->uploadCSDoc($projectCs->id,'microEntityP',$coInvCount);
                $this->generateEmptyMicroEntity($project->id,'certification_of_microEntityP');
                $this->uploadDoc('certification_of_microEntityP',$project->id,$project->lead->fileno);
                if($project->coInventor != '')
                    for($i=1;$i < $coInvCount;$i++)
                        $this->uploadDoc("certification_of_microEntityP_coInv$i",$project->id,$project->lead->fileno);

            }else{
                //delete the patent apps previously sent
                if($call == "SEND") {
                    $aux_files = UploadedFiles::where('project_id',$project->id)->where('fileName','like','PAU_%')->get();
                    foreach($aux_files as $aux_file)
                        $aux_file->delete();
                }
                $this->uploadCSDoc($projectCs->id,'declarationU',0);
                $this->uploadCSDoc($projectCs->id,'poaU',$coInvCount);
                $this->uploadCSDoc($projectCs->id,'microEntityU',$coInvCount);
                ////////////////
                $this->generateEmptyDec($project->id,'declarationU');
                $this->generateEmptyPoa($project->id,'power_of_attorneyU');
                $this->generateEmptyMicroEntity($project->id,'certification_of_microEntityU');
                //upload this files to db
                $this->uploadDoc('declarationU',$project->id,$project->lead->fileno);
                $this->uploadDoc('power_of_attorneyU',$project->id,$project->lead->fileno);
                $this->uploadDoc('certification_of_microEntityU',$project->id,$project->lead->fileno);
                if($project->coInventor != ''){
                    ////////////////////
                    for($i=1;$i < $coInvCount;$i++) {
                        $this->uploadDoc("power_of_attorneyU_coInv$i", $project->id, $project->lead->fileno);
                        $this->uploadDoc("certification_of_microEntityU_coInv$i",$project->id,$project->lead->fileno);
                    }
                    $this->uploadCSDoc($projectCs->id,'addDeclarationU',0);
                    $this->generateEmptyAddDec($project->id,'additional_inventorsU');
                    $this->uploadDoc('additional_inventorsU',$project->id,$project->lead->fileno);

                }
            }
            if($call == 'SEND')
                return 1;
            return json_encode($type);
        }
        return -1;

    }


    /*
     * send files to Att from client services view
    */
    public function sendFileClientSToAtt(){
        $fileId = Input::get('FILE');
        $projectId = Input::get('PROJECT');
        $email_att = Input::get('EMAILATT');

        $file = UploadedFiles::find($fileId);
        if($file != null){
            $file->attorney = 1;
            $file->save();
            file_get_contents(url("emailUpDocToAtt?ID=$projectId&FILENAME=".urlencode($file->fileName)."&AE=".urlencode($email_att)));
            return "1";
        }
        return "-1";
    }

    //create a row in the clientservicesdocs
    public function uploadCSDoc($id,$name,$coInvCount =0){
        $doc_aux = ClientSDocs::where('projectclientservices_id',$id)->where('name',$name)->first();
        if($doc_aux != null)
            $doc_aux->delete();
        $doc = new ClientSDocs();
        $doc->projectclientservices_id = $id;
        $doc->document = $name;
        $doc->name=$name;
        $doc->belong_PA = 1;
        $doc->file_id=-1;
        if($coInvCount>0)
            $doc->count = $coInvCount;
        $doc->save();
    }

    //generate a empty power attorney by applicant to send to client
    public function generateEmptyPoa($project_id,$name){
        $project = Project::find($project_id);
        $client = $project->lead;
        $pCS=$project->clientServicesProject();
        $att = Consultant::find($pCS->attorney_id);
        $coInvs =explode(',',$project->coInventor);
        if($project->coInventor == '')
            $coInvCount = 0;
        else
            $coInvCount = count($coInvs);
        if($name == "power_of_attorneyD")
            $design =1;
        else
            $design =0;
        $pdf = App::make('dompdf.wrapper');
        $content =  view('templates.client_services.empty_mail_POA_template_pdf',array('client'=>$client,'project'=>$project,'attorney'=>$att, 'pcs'=>$pCS, 'invName'=>($client->fname." ".$client->lname),'coInvCount'=>$coInvCount,'design'=>$design));
        $pdf->loadHTML($content);
        if(!File::exists("files/projects/".$project->lead->fileno."/".$project->id)) {
            File::makeDirectory("files/projects/".$project->lead->fileno."/".$project->id, 0755, true);
        }
        $pdf->save("files/projects/".$client->fileno."/".$project->id."/".$name.".pdf");//power_of_attorney.pdf

        $i=0;
        if($project->coInventor != '')
            foreach($coInvs as $coInv){
                $i++;
                $pdf = App::make('dompdf.wrapper');
                $content =  view('templates.client_services.empty_mail_POA_template_pdf',array('client'=>$client,'project'=>$project,'attorney'=>$att, 'pcs'=>$pCS, 'invName'=>$coInv,'coInvCount'=>$coInvCount,'design'=>$design));
                $pdf->loadHTML($content);
                if(!File::exists("files/projects/".$project->lead->fileno."/".$project->id)) {
                    File::makeDirectory("files/projects/".$project->lead->fileno."/".$project->id, 0755, true);
                }
                $pdf->save("files/projects/".$client->fileno."/".$project->id."/".$name."_coInv".$i.".pdf");
            }
    }

    //generate a empty microEntity to send to client
    public function generateEmptyMicroEntity($project_id,$name){
        $project = Project::find($project_id);
        $pcs = $project->clientServicesProject();
        $client = $project->lead;
        $coInvs =explode(',',$project->coInventor);
        if($name == "certification_of_microEntityD")
            $design =1;
        else
            $design =0;
        $pdf = App::make('dompdf.wrapper');
        $content =  view('templates.client_services.empty_mail_microentity_template_pdf',array('client'=>$client,'project'=>$project, 'fileno'=>$client->fileno,'pcs'=>$pcs,'invName'=>($client->fname." ".$client->lname),'design'=>$design));
        $pdf->loadHTML($content);
        if(!File::exists("files/projects/".$project->lead->fileno."/".$project->id)) {
            File::makeDirectory("files/projects/".$project->lead->fileno."/".$project->id, 0755, true);
        }
        $pdf->save("files/projects/".$client->fileno."/".$project->id."/".$name.".pdf");//
        if($project->coInventor != '')
            for($i=0;$i<count($coInvs);$i++){
                $pdf = App::make('dompdf.wrapper');
                $content =  view('templates.client_services.empty_mail_microentity_template_pdf',array('client'=>$client,'project'=>$project,'fileno'=>$client->fileno,'pcs'=>$pcs, 'invName'=>$coInvs[$i],'design'=>$design));
                $pdf->loadHTML($content);
                if(!File::exists("files/projects/".$project->lead->fileno."/".$project->id)) {
                    File::makeDirectory("files/projects/".$project->lead->fileno."/".$project->id, 0755, true);
                }
                $pdf->save("files/projects/".$client->fileno."/".$project->id."/".$name."_coInv".($i+1).".pdf");
            }
    }

    //generate a empty declaration to send to client
    public function generateEmptyDec($project_id, $name){//the name var is to know if it's a prov a design or a regular patent app
        $project = Project::find($project_id);
        $client = $project->lead;
        $pCS=$project->clientServicesProject();
        $att = Consultant::find($pCS->attorney_id);


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
        if($name == 'declarationD')
            $content =  view('templates.client_services.empty_mail_declaration_template_pdf',array('client'=>$client,'project'=>$project,'pcs'=>$pCS , 'fileno'=>$client->fileno,'attorney'=>$att,'sheetsCount'=>$sheetsCount,'design'=>1));
        else
            $content =  view('templates.client_services.empty_mail_declaration_template_pdf',array('client'=>$client,'project'=>$project,'pcs'=>$pCS , 'fileno'=>$client->fileno,'attorney'=>$att,'sheetsCount'=>$sheetsCount,'design'=>0));
        $pdf->loadHTML($content);
        if(!File::exists("files/projects/".$project->lead->fileno."/".$project->id)) {
            File::makeDirectory("files/projects/".$project->lead->fileno."/".$project->id, 0755, true);
        }
        $pdf->save("files/projects/".$client->fileno."/".$project->id."/".$name.".pdf");//declaration
        return $pdf->stream();
    }

    //generate a empty additional declaration to send to client
    public function generateEmptyAddDec($project_id,$name){
        $project = Project::find($project_id);
        $client = $project->lead;
        $coInvs = explode(',',$project->coInventor);
//        if($project->coInventor== "")
//            $coInvCount = 0;
//        else
//            $coInvCount = count(explode(',',$project->coInventor));
        $pdf = App::make('dompdf.wrapper');
        $content =  view('templates.client_services.empty_mail_add_declaration_template_pdf',array('coInvs'=>$coInvs));
        $pdf->loadHTML($content);
        if(!File::exists("files/projects/".$project->lead->fileno."/".$project->id)) {
            File::makeDirectory("files/projects/".$project->lead->fileno."/".$project->id, 0755, true);
        }
        $pdf->save("files/projects/".$client->fileno."/".$project->id."/".$name.".pdf");
        return $pdf->stream();
    }

    //generate a empty ILC Marketing Agreement
    public function generateEmptyILC($project_id){
        $project = Project::find($project_id);
        $client = $project->lead;
        if($project->coInventor !='')
            $coinventors = explode(',',$project->coInventor);
        else
            $coinventors =0;
        $pCS=$project->clientServicesProject();
        $prov_ut ="";
        if($pCS->hasType('UT') || $pCS->hasType('UPG_UT'))
            $prov_ut="U";
        elseif($pCS->hasType('PROV'))
            $prov_ut="P";
        $date1 = str_replace('-','/',$pCS->marketingAgrSent_created_at);
        $date2 = strtotime($date1);
        $effectiveDate = date('l jS F Y',$date2);
        $content = view('templates.client_services.empty_mail_ILC_template_pdf',array('client'=>$client, 'prov_ut'=>$prov_ut, 'effectiveDate'=>$effectiveDate, 'coinventors'=>$coinventors));
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($content);
        if(!File::exists("files/projects/".$project->lead->fileno."/".$project->id)) {
            File::makeDirectory("files/projects/".$project->lead->fileno."/".$project->id, 0755, true);
        }
        $pdf->save("files/projects/".$client->fileno."/".$project->id."/"."ilc_agreement.pdf");
        return $pdf->stream();
    }

    //generate a empty ILC Release Form
    public function generateReleaseILC($project_id){
        $project = Project::find($project_id);
        $client = $project->lead;
        $coinventors = explode(',',$project->coInventor);
        $pdf = App::make('dompdf.wrapper');
        $content =  view('templates.client_services.empty_mail_ilc_release_template_pdf',array('client'=>$project->lead,'coinventors'=>$coinventors));
        $pdf->loadHTML($content);
        if(!File::exists("files/projects/".$project->lead->fileno."/".$project->id)) {
            File::makeDirectory("files/projects/".$project->lead->fileno."/".$project->id, 0755, true);
        }
        $pdf->save("files/projects/".$client->fileno."/".$project->id."/"."ilc_release.pdf");
        return $pdf->stream();
    }

    //send upgrade pct or epo
    public function sendUpgrade(){
        $pid = Input::get('PIN');
        $project = Project::find($pid);
        $pcs = $project->clientServicesProject();
        if($pcs!=null){
            $client = $project->lead;
            //create and save the letter pdf
            $content = view('templates.client_services.empty_mail_upgradePCTEPO_template_pdf',array('client'=>$client,'project'=>$project,'pcs'=>$pcs));
            $pdf = App::make('dompdf.wrapper');
            $pdf->loadHTML($content);
            if(!File::exists("files/projects/".$project->lead->fileno."/".$project->id)) {
                File::makeDirectory("files/projects/".$project->lead->fileno."/".$project->id, 0755, true);
            }
            $pdf->save("files/projects/".$client->fileno."/".$project->id."/upgradeLetterPCTEPO.pdf");

            //set the var to know if the letter was sent
            $pcs->pctEpoAlert=1;
            $pcs->save();

            //sent an email to client notify upgrade letter was sent to him
            file_get_contents(url("emailUpgLetter?ID=$pid&TYPE=PCTEPO"));

            $csNote = new ClientSNotes();
            $csNote->notes = "Upgrade PCT/EPO Letter sent.";
            $csNote->projectclientservices_id = $pcs->id;
            $csNote->save();

            return $pid;
        }
        return "-1";
    }

    //send upgrade only to pct
    public function sendUpgradeOnlyPCT(){
        $pid = Input::get('PIN');
        $project = Project::find($pid);
        $pcs = ProjectClientServices::where('project_id',$pid)->first();
        if($project != null && $pcs!=null){
            $client = $project->lead;
            //create and save the letter pdf
            $content = view('templates.client_services.empty_mail_upgradePCT_template_pdf',array('client'=>$client,'project'=>$project,'pcs'=>$pcs));
            $pdf = App::make('dompdf.wrapper');
            $pdf->loadHTML($content);
            if(!File::exists("files/projects/".$project->lead->fileno."/".$project->id)) {
                File::makeDirectory("files/projects/".$project->lead->fileno."/".$project->id, 0755, true);
            }
            $pdf->save("files/projects/".$client->fileno."/".$project->id."/upgradeLetterPCT.pdf");

            //set the var to know if the letter was sent
            $pcs->pctEpoAlert=1;
            $pcs->save();

            //sent an email to client notify upgrade letter was sent to him
            file_get_contents(url("emailUpgLetter?ID=$pid&TYPE=PCT"));

            $csNote = new ClientSNotes();
            $csNote->notes = "Upgrade PCT Letter sent.";
            $csNote->projectclientservices_id = $pcs->id;
            $csNote->save();
            return $pid;
        }
        return "-1";
    }

    //send prov invoice
    public function sendProvInvoice(){
        $pid = Input::get('PIN');
        $project = Project::find($pid);
        $pcs = $project->clientServicesProject();
        if($pcs!=null){
            $client = $project->lead;
            $data = ToolsFunctions::obtainPPAInfo($pid);
            $dateBy= $data['PPA_Received_Date__c'];
            $contractBy = $data['PPA_Contract_Amount__c'];
            $amountBy = $data['PPA_Payment_Amount__c'];
            $percentageBy = round($data['PPA_Percentage_Paid__c'],2);
            $balanceBy = $contractBy - $amountBy;
            //create and save the letter pdf
            $content = view('templates.client_services.empty_mail_prov_invoice_template_pdf',array('client'=>$client,'amountBy'=>$amountBy,'dateBy'=>$dateBy,'balanceBy'=>$balanceBy,'percentageBy'=>$percentageBy,'contractBy'=>$contractBy));
            $pdf = App::make('dompdf.wrapper');
            $pdf->loadHTML($content);
            if(!File::exists("files/projects/".$project->lead->fileno."/".$project->id)) {
                File::makeDirectory("files/projects/".$project->lead->fileno."/".$project->id, 0755, true);
            }
            $pdf->save("files/projects/".$client->fileno."/".$project->id."/provisional_Invoice.pdf");

            //set the var to know if the letter was sent
            $pcs->provAlert=1;
            $pcs->save();

            //sent an email to client notify upgrade letter was sent to him
            file_get_contents(url("emailProvInvoice?ID=$pid"));
            $csNote = new ClientSNotes();
            $csNote->notes = "Provisional Patent Application Renewal sent.";
            $csNote->projectclientservices_id = $pcs->id;
            $csNote->save();
            return $pid;
        }
        return "-1";
    }

    public function finishMsgCs(){
        $inboxId = Input::get('ID');
        $status = Input::get('STATUS');
        $inbox = Inbox::find($inboxId);
        if($inbox != null){
            $inbox->finish = $status;
            $inbox->save();
            return "1";
        }
        return "-1";
    }

    // set the PPA details
    public function setPPADetails(){
        $col = Input::get('FIELD');
        $id = Input::get('ID');
        $value = Input::get('VALUE');
        $project = Project::find($id);
        $projCS = $project->clientServicesProject();
        $contract = $project->contractPPA();
        $lead = $project->lead;
        if($contract != ""){
            if($col == "totalPrice") {
                $contract->price = $value;
                $contract->save();
            }
            elseif($col == "amntPaid") {
                $contract->paid = $value;
                $contract->save();
            }
            elseif($col == "rcvdDate"){
                if($projCS == null)
                    return -1;
                $value = date("Y-m-d",strtotime($value));
                $projCS->rcvdDate = $value;
                $projCS->save();
                if($projCS->hasType('PROV') && !$projCS->hasType('UPG_UT'))
                    $result[0] =date('m-d-Y', strtotime('+1 year', strtotime($value)));
                else
                    $result[0] =date('m-d-Y', strtotime('+2 year', strtotime($value)));
                return json_encode($result);
            }elseif($col == "ppaRcvdDate"){
                if($projCS == null)
                    return -1;
                $value = date("Y-m-d",strtotime($value));
                $projCS->ppaRcvdDate = $value;
                $projCS->save();
            }
        }else
            return -1;

        return 1;
    }

    //delete notes of the pcs
    public function csDeleteNotes(){
        $id = Input::get('ID');
        $csNote = ClientSNotes::find($id);
        if($csNote!=null){
            $csNote->delete();
            return 1;
        }
        return -1;
    }

    //save the notes of the pcs
    public function csSaveNotes(){
        $notes = Input::get('VALUE');
        $pId = Input::get('PID');
        $id = Input::get('ID');
        if($id == "0"){
            $project = Project::find($pId);
            if($project!=null){
                $pcs = $project->clientServicesProject();
                if($pcs!=null){
                    $csNote = new ClientSNotes();
                    $csNote->notes = $notes;
                    $csNote->projectclientservices_id = $pcs->id;
                    $csNote->save();
                    return json_encode($csNote);
                }
            }
        }else{
            $csNote = ClientSNotes::find($id);
            $csNote->notes = $notes;
            $csNote->save();
            return json_encode($csNote);
        }
        return 0;
    }


    ////////
    public function pendingPatentAppF(){
        $pendingPatentAppF=array();
        $pcs = ProjectClientServices::where('patentAppFiled_created_at','<',date('Y-m-d H:i:s', strtotime('-3 months')))->where('patentAppFiled_created_at','<>','0000-00-00 00:00:00')->where('DModel_sent','0000-00-00 00:00:00')->get();
        return view("intranet.production.tools.production3DModel",array('pendingPatentAppF'=>$pcs));
    }

    // check like sent the 3d design to ilc
    public function send3D(){
        $pin = Input::get('PIN');
        $pcs = ProjectClientServices::where('project_id',$pin)->first();
        if($pcs != null) {
            $pcs->DModel_sent = date("Y-m-d");
            $pcs->save();
            $csNote = new ClientSNotes();
            $csNote->notes = "3D Design Sent to ILC by Production.";
            $csNote->projectclientservices_id = $pcs->id;
            $csNote->save();
            return 1;
        }

        return -1;
    }

    // check like sent the 3d design to ilc
    public function received3D(){
        $pin = Input::get('PID');
        $pcs = ProjectClientServices::find($pin);
        if($pcs != null) {
            $pcs->DModel_rcvd = date("Y-m-d");
            if($pcs->phase == 4){
                $pcs->phase = 5;
                $pcs->changePhaseDate=date('Y-m-d 00:00:00');
            }
            $pcs->save();
            $csNote = new ClientSNotes();
            $csNote->notes = "3D(2D) Design Check  by ILC like received.";
            $csNote->projectclientservices_id = $pcs->id;
            $csNote->save();
            return 1;
        }

        return -1;
    }

    public function changeState(){
        $pin = Input::get('ID');
        $state = Input::get('STATE');
        $pcs = ProjectClientServices::where('project_id',$pin)->first();
        if($pcs != null){
            $pcs->show = 0;
            if($state == 1)
                $pcs->show = 1;
            elseif($state == 4 || $state == 5){
                $attCs = AttClientServices::where('projectclientservices_id',$pcs->id)->first();
                if($attCs != null){
                    file_get_contents(url("emailToAttForCloseFile?PCSID=$pin&ATTCSID=".$attCs->id));
                    $attCs->delete();
                    $csNote = new ClientSNotes();
                    $csNote->notes = "Project Closed and email sent to attorney to stop working";
                    $csNote->projectclientservices_id = $pcs->id;
                    $csNote->save();
                }
            }
            $pcs->completed = $state;
            $pcs->save();

            Transaction::createTransaction($this->consultant->id,'','','CHANGE_STATUS_PROJECT','state: '.$state,$pin,'','','','','');
            return $state;
        }
        return -1;
    }

    public function reportAtt(){
        $att_id = Input::get('ATT');
        $first_day_of_month = date('Y-m-01 00:00:00');
        $last_day_of_month = date('Y-m-t 23:59:00');
        $attCS = AttClientServices::where('consultant_id',$att_id)->where('created_at','>=',$first_day_of_month)->where('created_at','<=',$last_day_of_month)->get();
        $att = Consultant::find($att_id);
        $att_name = $att->fname." ".$att->lname;
        $total_inbox = Inbox::where(['consultant_id'=>$this->consultant->id,'status'=>0])->count();
        $rcvdDates = array(); //
        foreach($attCS as $attcs) {
            if($attcs->type == "DESIGN")
                if($attcs->projectclientservices->appSentD_created_at !== '0000-00-00 00:00:00')
                    $rcvdDates[$attcs->id] = date('m-d-Y', strtotime($attcs->projectclientservices->appSentD_created_at));
                else
                    $rcvdDates[$attcs->id] = "";
            else
                if($attcs->projectclientservices->appSent_created_a !== '')
                    $rcvdDates[$attcs->id] = $attcs->projectclientservices->appSent_created_at;
                else
                    $rcvdDates[$attcs->id] = "";
        }

        return view("intranet.clientServices.tools.attorneyDetails",array('attDetails'=>$attCS,'consultant'=>$this->consultant,'total_inbox'=>$total_inbox,'att_name'=>$att_name,'rcvdDates'=>$rcvdDates,'att_id'=>$att_id));
    }

    public function reportAttSelectMonth(){
        $att_id = Input::get('ATT');
        $month = Input::get('MONTH');
        $thisMonth = date("Y")."-$month-01 00:00:00";
        if($thisMonth>date("Y-m-d H:i:s"))
            $thisMonth = date("Y-m-d H:i:s", strtotime("-1 year", strtotime($thisMonth)));
        $to=date("Y-m-d H:i:s", strtotime("+1 month", strtotime($thisMonth)));
        $attCS = AttClientServices::where('consultant_id',$att_id)->where('created_at','>=',$thisMonth)->where('created_at','<',$to)->get();
        $data = array();
        foreach($attCS as $att){
            if($att->type == "DESIGN"){
                if($att->projectclientservices->appSentD_created_at!='0000-00-00 00:00:00')
                    $aux = date('m-d-Y', strtotime($att->projectclientservices->appSentD_created_at));
                else
                    $aux ="N/A";
            }
            else {
                if($att->projectclientservices->appSent_created_at!='')
                    $aux =$att->projectclientservices->appSent_created_at;
                else
                    $aux ="N/A";
            }
            $info = array($att->lead->fileno, $att->type,date("m-d-Y",strtotime($att->created_at)),$aux);
            $data[]=$info;
        }

        return json_encode($data);
    }

    public function createLegalActivity(){
        $pid = Input::get('PID');
        $project = Project::find($pid);
        $pcs = $project->clientServicesProject();
        $legalRecord = Input::get('LEGAL_R');
        $actType = Input::get('ACT_TYPE');
        $activity = Input::get('ACTIVITY');
        $dueDate = Input::get('DUE_DATE');
        $rcvdDate = Input::get('RCVD_DATE');
        $description = Input::get('DESCRIPTION');
        $newActivity = new LegalRecord();
        $newActivity->projectclientservices_id = $pcs->id;
        $newActivity->record_type = $actType;
        $newActivity->legal_record = $legalRecord;
        $newActivity->activity = $activity;
        $newActivity->activity_due_date = date("Y-m-d",strtotime($dueDate));
        $newActivity->recv_date = date("Y-m-d",strtotime($rcvdDate));
        $newActivity->description = $description;
        $newActivity->save();

        return json_encode($newActivity);
    }

    public function getLegalAct(){
        $legal_id = Input::get('LID');
        $legaAct = LegalRecord::find($legal_id);
        if($legaAct != null)
            return json_encode($legaAct);

        return -1;
    }

    public function editLegalAct(){
        $legal_id = Input::get('LID');
        $legalRecord = Input::get('LEGAL_R');
        $actType = Input::get('ACT_TYPE');
        $activity = Input::get('ACTIVITY');
        $dueDate = Input::get('DUE_DATE');
        $rcvdDate = Input::get('RCVD_DATE');
        $description = Input::get('DESCRIPTION');

        $legalAct = LegalRecord::find($legal_id);
        if($legalAct != null){
            $legalAct->record_type = $actType;
            $legalAct->legal_record = $legalRecord;
            $legalAct->activity = $activity;
            $date_aux = str_replace("-","/",$dueDate);
            $legalAct->activity_due_date =date("Y-m-d",strtotime($date_aux));
            $date_aux =str_replace("-","/",$rcvdDate);
            $legalAct->recv_date = date("Y-m-d",strtotime($date_aux));
            $legalAct->description = $description;
            $legalAct->save();
            return json_encode($legalAct);
        }
        return -1;
    }

    public function deleteLegalAct(){
        $legal_id = Input::get('LID');
        $legalAct = LegalRecord::find($legal_id);
        if($legalAct!=null){
            $legalAct->delete();
            return json_encode($legal_id);
        }
        return -1;
    }

    public function updateClientDetailsCs(){
        $projectId = Input::get('ID');
        $field = Input::get('FIELD');
        $value = Input::get('INFO');
        $project = Project::find($projectId);
        if($project != null){
            if($field == 'coInventor'){
                $project->coInventor = $value;
                $project->save();
                return "1";
            }else{
                $lead = $project->lead;
                if($lead != null){
                    if($value != '' && ($field == 'phone' || $field == 'phone2')){
                        $value = str_pad(preg_replace('/\D+/', '', $value), 11, '1', STR_PAD_LEFT);
                    }
                    $lead->$field = $value;
                    $lead->save();

                    //create and save the sub in the upload files, this code was to send the coversheet with the info
                    // updated of the client, is no longer necesary cause ilc is working directly with the dealer

//                    $pdf = App::make('dompdf.wrapper');
//                    $content = view('intranet.admin.printProject',array('project'=>$project));
//                    if(!File::exists("files/projects/".$project->lead->fileno."/".$project->id)) {
//                        File::makeDirectory("files/projects/".$project->lead->fileno."/".$project->id, 0755, true);
//                    }
//                    $fileName = "submission_APPROVED.pdf";
//                    $pdf->loadHTML($content);
//                    $url = "files/projects/".$project->lead->fileno."/".$project->id."/".$fileName;
//                    $pdf->save($url);
//
//                    $file = UploadedFiles::where(['fileName'=>$fileName,'project_id'=>$project->id])->first();
//                    if($file==null){
//                        $file = new UploadedFiles();
//                    }
//                    $file->project_id = $project->id;
//                    $file->internal = 1;
//                    $file->fileName = $fileName;
//                    $file->url = $url;
//                    $file->save();

                    return "1";
                }
                return "-1";
            }
        }
        return "-1";
    }

    public function sendReminderTMCR(){
        $pin = Input::get('PIN');
        $type = Input::get('TYPE');
        $sent = file_get_contents(url("emailClientServices?ID=$pin&TYPE=$type"));
        $projectcs = ProjectClientServices::where('project_id',$pin)->first();
        if($sent && $projectcs!= null){
            $csNote = new ClientSNotes();
            $csNote->notes = "Reminder $type sent.";
            $csNote->projectclientservices_id = $projectcs->id;
            $csNote->save();
        }
        if($sent==1)
            return $pin;
        return -1;
    }

    public function saveAppPendingRevision(){
        $col =Input::get('COL');
        $projectcs = ProjectClientServices::where('project_id',Input::get('ID'))->first();
        if($projectcs!= null){
            $projectcs->$col = Input::get('CHECK');
            $projectcs->save();
            return "1";
        }
        return "-1";
    }

    public function unCheckIlcAfterUpgrade(){
        $projectcs = ProjectClientServices::where('project_id',Input::get('ID'))->first();
        if($projectcs!= null){
            $projectcs->marketingAgrSentAfterUpgrade_created_at = "";
            $projectcs->save();
            return "1";
        }
        return "-1";
    }

    public function saveTitleOfInvention(){
        $projectcs = ProjectClientServices::where('project_id',Input::get('ID'))->first();
        $col = Input::get('COL');
        if($projectcs!= null){
            $projectcs->$col = Input::get('INVENTION');
            $projectcs->save();
            return "1";
        }
        return "-1";
    }

    public function saveIndustry(){
        $projectcs = ProjectClientServices::where('project_id',Input::get('ID'))->first();
        if($projectcs!= null){
            $projectcs->industry = Input::get('INDUSTRY');
            $projectcs->save();
            return "1";
        }
        return "-1";
    }

    //reset password and send it to the client
    public function sendNewPasswordCs()
    {
        $project = Input::get('ID');
        $project = Project::find($project);
        if($project!=null){
            $lead = $project->lead;
            if($lead!=null){
                $lead->password = substr(md5(microtime().rand()), 0, 8);
                $lead->save();
                $cname = $lead->fname." ".$lead->lname;
                $text = "Hi ".ucwords($cname).",\n Your temporary password is ".$lead->password.". Once you log in please go to your settings to reset your password for your account. Your documents can be found under My Projects(Select the name of your project) and proceed to Sign Legal Document to access your documents. If you have any more questions please contact us.";
                $text.= "<br><br>
                Client Support Services<br>
                PATENT SERVICES USA, INC.<br>
                12000 Biscayne Blvd Suite #700<br>
                North Miami, FL 33181<br>
                1-888-344-6836
                1-800-886-7951 Fax<br>
                clientservices@ownmyinvention.com";
                mail($lead->email, 'PATENT SERVICES NEW PASSWORD', $text);

                //create note
                $projectcs = ProjectClientServices::where('project_id',$project->id)->first();
                if($projectcs!= null){
                    $csNote = new ClientSNotes();
                    $csNote->notes = "New Password sent.";
                    $csNote->projectclientservices_id = $projectcs->id;
                    $csNote->save();
                }
                //Create Transaction
                Transaction::createTransaction($this->consultant->id,  $lead->id, '',"RESTORE-PASSWORD-CS", '', '',  $lead->email, '', '', $lead->phone, '');
                return "1";
            }
        }
        return "-1";
    }

    public function sendTrademarkLetter(){
        $pid = Input::get('ID');
        $project = Project::find($pid);
        if($project!=null) {
            $this->generateTrademarkLetter($pid);
            $projectCs = ProjectClientServices::where('project_id', $pid)->first();
            if(($aux=$projectCs->getDocsByName('trademark_letter'))!=null)
                $aux->delete();
            $newrowDocs = new ClientSDocs();
            $newrowDocs->projectclientservices_id = $projectCs->id;
            $newrowDocs->document = "trademark_letter";
            $newrowDocs->name = "TM_Letter";
            $newrowDocs->save();
            //send email
            file_get_contents(url("emailTrademarkLetter?ID=$pid"));
            return "1";
        }
        return "-1";
    }

    public function generateTrademarkLetter($pid){
        $project = Project::find($pid);
        if($project!=null){
            $content = view('templates.client_services.empty_mail_trademark_letter_template_pdf',
                array('client'=>$project->lead));
            $pdf = App::make('dompdf.wrapper');
            $pdf->loadHTML($content);
            $pdf->save("files/projects/".$project->lead->fileno."/".$pid."/trademark_letter.pdf");
            return $pdf->stream();
        }
        return -1;
    }

    public function closeUtilityExp(){
        $clientS = Consultant::where('usr','clientservices')->first();
        $pid = Input::get('PIN');
        $ut = ProjectClientServices::find($pid);
        if($ut!=null){
            $ut->completed = 4; // put it in closed
            $ut->save();
            $lead = Lead::where('fileno',$ut->fileno)->first();
            $msgInbox = "The File ".$ut->fileno." was closed because expired.<br>".date("m-d-Y H:i:s")." <br>Client: ".$lead->fname." ".$lead->lname;
            file_get_contents(url("emailExpiredNotice?ID=$ut->project_id"));
            file_get_contents(url("emailExpiredToAttorney?ID=$ut->project_id"));
            Inbox::createInbox($lead->id,$clientS->id,$msgInbox,"CLIENT SERVICES","SYSTEM");
            Transaction::createTransaction('','','','CLOSED_FILE_EXPIRED','FILENO_'.$ut->fileno,$ut->project_id,'','','','','');
            return $pid;
        }
        return -1;
    }

    public function findFilingR(){
        $pcs = ProjectClientServices::where('project_id',Input::get('ID'))->first();
        if($pcs != null)
            return $pcs->getFilingR();
        return -1;
    }

    /*
     * get the rcvd date of the docs to att and the due date of the app
     * */
    public function getDatesUpgC(){
        $pcs = ProjectClientServices::where('project_id',Input::get('ID'))->first();
        if($pcs!= null){
            if($pcs->patentAppFiled_created_at == '0000-00-00 00:00:00')
                return -2;
            $array=array(date('m-d-Y'), date('m-d-Y', strtotime($pcs->patentAppFiled_created_at." +1 year")));
            return json_encode($array);
        }
        return -1;
    }

    /*
*Set Filing Attorney
* */
    public function selectPatentType(){
        $id=Input::get('ID');
        $type = Input::get('TYPE');
        $project=ProjectClientServices::where('project_id',$id)->first();
        if($project!=null){
            $project->patentType= $type;
            $project->save();
            return "1";
        }
        return "-1";
    }

    public function removeAlert(){
        $pid = Input::get('ID');
        $action = Input::get('ACTION');
        $pcs = ProjectClientServices::where('project_id',$pid)->first();
        if($pcs == null)
            return -1;

        switch($action){
            case 'PCTEPO':
                $pcs->pctEpoAlert = 1;
                $pcs->save();
                break;
            case 'PROV':
                $pcs->provAlert = 1;
                $pcs->save();
                break;
            case 'UPDATE':
                $pcs->updateDateAfterYear =date('Y-m-d 00:00:00');
                $pcs->save();
                $csNote = new ClientSNotes();
                $csNote->projectclientservices_id = $pcs->id;
                $csNote->notes = "Update Email skipped by Client Services.";
                $csNote->save();
                break;
            default:
                return -1;
                break;
        }

        Transaction::createTransaction('','','','ALERT_REMOVED',$action,$pcs->project_id,'','','','','');
        return $pid;
    }

    public function sendTextIntroCall(){
        $pid= Input::get('PID');
        $pcs =ProjectClientServices::where('project_id',$pid)->first();
        if($pcs!=null){
            PlivoHelper::sendSMS($pcs->project->lead->phone, 'You have received communication from PSU please check your voicemail or inventor’s platform for updates.');
            $sent = file_get_contents(url("introCallEmail?LID=".$pcs->project->lead->id));
            $pcs->emailCall_created_at = date('m-d-Y');
            $pcs->save();
            $csNote = new ClientSNotes();
            $csNote->notes = "Manual Intro Call Text";
            $csNote->projectclientservices_id = $pcs->id;
            $csNote->save();
            Transaction::createTransaction('',$pcs->project->lead_id,'','MANUAL_INTRO_CALL','',$pcs->project_id,'','','','','');
            return $pid;
        }
        return -1;
    }

    public function ignoreNotifyAppDelay(){
        $pcs_id = Input::get('PIN');
        $pcs = ProjectClientServices::find($pcs_id);
        if($pcs != null){
            $pcs->notifyAppDelay =1;
            $pcs->save();
            $attCs = AttClientServices::where('projectclientservices_id',$pcs->id)->first();
            if($attCs == null)
                return -1;
            $attCs->completed =1;
            $attCs->stateChangedDate = date('Y-m-d 00:00:00');
            $attCs->save();
            $csNote = new ClientSNotes();
            $csNote->notes = "Notify App Delay Skipped, file in attorney view changed to finished.";
            $csNote->projectclientservices_id = $pcs->id;
            $csNote->save();
            Transaction::createTransaction('',$pcs->project->lead_id,'','PATENT_APP_STATE_SET_FINISHED_BY_CS','',$pcs->project_id,'','','','','');
            return $pcs->project_id;
        }
        return -1;
    }
}

