<?php namespace App\Http\Controllers;

use App\Helpers\ToolsFunctions;
use App\Models\ClientSDocs;
use App\Models\Consultant;
use App\Models\IlcVendors;
use App\Models\Inbox;
use App\Models\Manufacturer;
use App\Models\Project;
use App\Models\ProjectProduction;
use App\Models\Transaction;
use App\Models\UploadedFiles;
use App\Models\IlcNotes;
use App\Models\Ilc;
use DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class FileController extends Controller {


    /*
     * To Allow use the controller methods the current user logged has to be Consultant
     */
    public function __construct(){}

    /*
     * return all the accessible files for a Consultant
    */
    public function loadFilesProject()
    {
        $id = Input::get('ID');
        $project = Project::find($id);
        $files=[];
        if($project!=null)
        {
            $internalAndPublicFiles = $project->filesByType(array('internal','public'));
            foreach($internalAndPublicFiles as $file)
            {
                $files[]=['id'=>$file->id,'name'=>$file->fileName,'url'=>$file->url,'date'=>$file->created_at];
            }
        }
        return json_encode($files);
    }

    /*
     * return all the accessible files for a Client
    */
    public function loadFilesLaunch()
    {
        $id = Input::get('ID');
        $project = Project::find($id);
        $files=[];
        if($project!=null)
        {
            $internalAndPublicFiles = $project->filesByType(array('public','clientVendor'));
            foreach($internalAndPublicFiles as $file)
            {
                $files[]=['id'=>$file->id,'name'=>$file->fileName,'url'=>$file->url,'projectId'=>$id];
            }
        }
        return json_encode($files);
    }

    /*
     * return all the files for admin
    */
    public function loadFilesAdmin()
    {
        $id = Input::get('ID');
        $project = Project::find($id);
        $files=[];
        if($project!=null){
            $files = $project->files;
        }
        return json_encode($files);
    }

    /*
         * delete files for from admin
        */
    public function deleteFiles()
    {
        $fileId = Input::get('FILE');
        $file = UploadedFiles::find($fileId);
        $path = public_path().'/';
        if($file!=null){
            $path.=$file->url;
            File::delete($path);
            $file->delete();
            Transaction::createTransaction('','',$file->fileName,'DELETE_FILE','FILE ID: '.$fileId,$file->project_id,'','','','','');
            return json_encode($fileId);
        }
        return "-1";
    }

    /*
         * return all the accessible files for a Vendor
        */
    public function loadFilesVendor()
    {
        $id = Input::get('ID');
        $uid = Input::get('UID');
        $project = Project::find($id);
        $files=[];
        if($project!=null)
        {
            $rol = $this->getRol($uid);
            $internalFiles = $project->filesByType(array('vendor',$rol));
            foreach($internalFiles as $file)
            {
                $files[]=['id'=>$file->id,'name'=>$file->fileName,'url'=>$file->url];
            }
        }
        return json_encode($files);
    }

    /*
     * function to now the rol of a user
     * */
    public function getRol($uid){
        $usr = Consultant::find($uid);
        if($usr == null)
            return -1;
        $roles = explode(',',$usr->rol);
        foreach($roles as $rol){
            if($usr->usr == 'josue' || $usr->usr == 'alain')
                return 'attorney';

            if($rol == 'consultant' || $rol=='vendors' || $rol == 'admmin')
                continue;

            if($rol == 'attorneyjk' || $rol == 'attorneyjh' || $rol == 'attorneyMike' || $rol == 'attorneySandra'|| $rol == 'attorneyLev')
                return 'attorney';

            return $rol;
        }
    }

    /*
         * return all the accessible files for a attCS
        */
    public function loadFilesAttCS()
    {
        $id = Input::get('ID');
        $project = Project::find($id);
        $files=[];
        if($project!=null)
        {
            $internalFiles = $project->filesByType(array('attorney'));
            foreach($internalFiles as $file)
            {
                $created = date('m-d-Y',strtotime(str_replace('-','/',$file->created_at)));
                $files[]=['id'=>$file->id,'name'=>$file->fileName,'url'=>$file->url,'created'=>$created];
            }
        }
        return json_encode($files);
    }

    /*
         * return all the accessible files for a ILC
        */
    public function loadFilesILC()
    {
        $id = Input::get('ID');
        $iid =Input::get('IID');
        $project = Project::find($id);
        $files=[];
        if($project!=null)
        {
            $internalFiles = $project->filesByType(array('ilc','ilcVendors'));
            foreach($internalFiles as $file)
            {
                $created = date('m-d-Y',strtotime(str_replace('-','/',$file->created_at)));
                $files[]=['id'=>$file->id,'name'=>$file->fileName,'url'=>$file->url,'created'=>$created,'ilcVendors'=>$file->ilcVendors];
            }
        }
        $ilcV =IlcVendors::where('ilc_id',$iid)->first();
        if($ilcV == null)
            $existIlcV =0;
        else
            $existIlcV =1;
        return json_encode(array($files,$existIlcV));
    }

    /*
         * return all the accessible files for a Manufacturer
        */
    public function loadFilesManufacturer()
    {
        $mid = Input::get('MID');
        $manufacturer = Manufacturer::find($mid);
        $files=[];
        if($manufacturer!=null)
        {
            $filesLoaded = $manufacturer->getManufacturerFiles();
            foreach($filesLoaded as $file)
            {
                $created = date('m-d-Y',strtotime(str_replace('-','/',$file->created_at)));
                $files[]=['id'=>$file->id,'name'=>$file->fileName,'url'=>$file->url,'created'=>$created];
            }
        }
        return json_encode(array($files));
    }

    /*
         * return all the accessible files for a Vendor for production view
        */
    public function loadFilesProduction()
    {
        $id = Input::get('ID');
        $project = Project::find($id);
        $files=[];
        if($project!=null)
        {
            $internalFiles = $project->filesByType(array('vendor','university','designer','writer','attorney','2d'));
            foreach($internalFiles as $file)
            {
                $files[]=['id'=>$file->id,'name'=>$file->fileName,'url'=>$file->url,'date'=>$file->created_at];
            }
        }
        return json_encode($files);
    }

    /*
     * save the access to one file.
    */
    public function saveFileAccess()
    {
        $fileId = Input::get('FILE');
        $field = Input::get('COL');
        $value = Input::get('VALUE');
        $file = UploadedFiles::find($fileId);
        if($file!=null){
            $file->$field = $value=="true"?1:0;
            $file->save();

            if($field == 'internal'){
                $project = $file->project;
                //create the row in inbox to let consultant know
                $msg = "File uploaded By Admin.\r\n";
                $msg .= date("m-d-Y H:i:s")."\r\n";
                $msg .= "File #:".$project->lead->fileno."\r\n";
                $msg .= "Pin: ".$project->id."\r\n";
                $msg .= "Client: ".$project->lead->fname." ".$project->lead->lname."\r\n";
                $msg .= "FILE Name: ".$file->fileName."\r\n";
                Inbox::createInbox($project->lead->id, $project->consultant_id, $msg, 'FILE UPLOADED', 'ADMIN');
            }
            if($field == 'vendor'){
                $project = $file->project;

                //create the row in inbox to let consultant know
                $msg = "File uploaded By Patent Services USA.\r\n";
                $msg .= date("m-d-Y H:i:s")."\r\n";
                $msg .= "File #:".$project->lead->fileno."\r\n";
                $msg .= "Pin: ".$project->id."\r\n";
                $msg .= "Client: ".$project->lead->fname." ".$project->lead->lname."\r\n";
                $msg .= "FILE Name: ".$file->fileName."\r\n";

                $projectPD = ProjectProduction::where(array('project_id'=>$project->id,'typeVendor'=>'designer'))->where('completed','!=',1)->first();
                if($projectPD != null){
                    Inbox::createInbox($project->lead->id, $projectPD->consultant_id, $msg, 'FILE UPLOADED', 'ADMIN');
                }
                $projectPU = ProjectProduction::where(array('project_id'=>$project->id,'typeVendor'=>'university'))->where('completed','!=',1)->first();
                if($projectPU != null){
                    Inbox::createInbox($project->lead->id, $projectPU->consultant_id, $msg, 'FILE UPLOADED', 'ADMIN');
                }
                $projectPD2 = ProjectProduction::where(array('project_id'=>$project->id,'typeVendor'=>'2D'))->where('completed','!=',1)->first();
                if($projectPD2 != null){
                    Inbox::createInbox($project->lead->id, $projectPD2->consultant_id, $msg, 'FILE UPLOADED', 'ADMIN');
                }
                $projectPW = ProjectProduction::where(array('project_id'=>$project->id,'typeVendor'=>'writer'))->where('completed','!=',1)->first();
                if($projectPW != null){
                    Inbox::createInbox($project->lead->id, $projectPW->consultant_id, $msg, 'FILE UPLOADED', 'ADMIN');
                }
                $projectPAJH = ProjectProduction::where(array('project_id'=>$project->id,'typeVendor'=>'attorneyjh'))->where('completed','!=',1)->first();
                if($projectPAJH != null){
                    Inbox::createInbox($project->lead->id, $projectPAJH->consultant_id, $msg, 'FILE UPLOADED', 'ADMIN');
                }
                $projectPAJK = ProjectProduction::where(array('project_id'=>$project->id,'typeVendor'=>'attorneyjk'))->where('completed','!=',1)->first();
                if($projectPAJK != null){
                    Inbox::createInbox($project->lead->id, $projectPAJK->consultant_id, $msg, 'FILE UPLOADED', 'ADMIN');
                }
                $projectPAM = ProjectProduction::where(array('project_id'=>$project->id,'typeVendor'=>'attorneyMike'))->where('completed','!=',1)->first();
                if($projectPAM != null){
                    Inbox::createInbox($project->lead->id, $projectPAM->consultant_id, $msg, 'FILE UPLOADED', 'ADMIN');
                }
            }

            return "1";
        }
        return "-1";
    }

    /*
     * upload files for several project at the same time from vendors view
    */
    public function uploadFileVendors(){

        $file = Input::file('file');
        $vendorId = Input::get('CONSULTANT');
        $consultantVendor = Consultant::find($vendorId);
        $rol = $this->getRol($vendorId);
        $projectId = Input::get('PROJECT');
        $now = new \DateTime('now');
        if($projectId != 0){
            $project = Project::find($projectId);
            if($project!=null){
                if($file){
                    $fileName = $file->getClientOriginalName();
                    $file->move(public_path().'/files/projects/'.$project->lead->fileno.'/'.$project->id.'/vendors', $fileName);

                    //create the row in upload file
                    $uploadFile = UploadedFiles::where(['fileName'=>$fileName,'admin_id'=>$vendorId,'project_id'=>$projectId])->first();
                    if($uploadFile != null){
                        $uploadFile->delete();
                    }
                    $uploadFile = new UploadedFiles();
                    $uploadFile->project_id = $projectId;
                    $uploadFile->url = "files/projects/".$project->lead->fileno."/".$project->id."/vendors/$fileName";
                    $uploadFile->fileName = $fileName;
                    $uploadFile->$rol = 1;
                    $uploadFile->admin_id = $vendorId;
                    $uploadFile->ip = $_SERVER["REMOTE_ADDR"];
                    $uploadFile->save();

                    //complete the row for that project.
                    $projectVendor = ProjectProduction::where(['consultant_id'=>$vendorId,'project_id'=>$projectId])->where('completed','<>',1)->first();
                    if($projectVendor!=null){
                        $projectVendor->completed = 1;
                        $projectVendor->completedDate =  $now->format("Y-m-d H:i:s");
                        $projectVendor->save();
                    }

                    //create the row in inbox to let Production know
                    $msg  = "File #:".$project->lead->fileno."\r\n";
                    $msg .= "Pin: ".$project->id."\r\n";
                    $msg .= "Client: ".$project->lead->fname." ".$project->lead->lname."\r\n";
                    $msg .= "File Name: ".$fileName."\r\n";

                    $extArray = explode(".",$fileName);
                    $ext = $extArray[count($extArray)-1];

                    //let consultant and production know that the patent search was uploaded be the attorney
                    if($consultantVendor != null){
                        if(strpos($consultantVendor->rol, 'attorney')!== false){
                            $uploadFile->internal = 1;
                            $uploadFile->save();
                            if($ext == 'doc'|| $ext == 'docx'){
                                Inbox::createInbox($project->lead->id, $project->consultant_id, "Patent Search uploaded by the attorney.\r\n".$msg, 'PRODUCTION', 'PRODUCTION');
                                Inbox::createInbox($project->lead->id, 30, "Patent Search uploaded by the attorney.\r\n".$msg, 'FILE UPLOADED', 'PRODUCTION');
                                Transaction::createTransaction($vendorId,'','','UPLOAD_FILE_VENDOR','Patent Search: '.$fileName,$projectId,'','','','','');
                            }
                        }else{
                            //if is not an attorney let production know
                            Inbox::createInbox($project->lead->id, 30, "File uploaded By Vendor.\r\n".$msg, 'FILE UPLOADED', 'PRODUCTION');
                            Transaction::createTransaction($vendorId,'','','UPLOAD_FILE_VENDOR',$fileName,$projectId,'','','','','');
                        }
                    }
                }
            }
        }else{
            if($file){
                $fileName = $file->getClientOriginalName();
                $myProjects = ProjectProduction::where(['consultant_id'=>$vendorId])->where('completed','<>',1)->get();
                foreach($myProjects as $projectVendor){
                    $project = $projectVendor->project;
                    if(strpos(strval($fileName),strval($project->lead->fileno)) !== false){
                        $file->move(public_path().'/files/projects/'.$project->lead->fileno.'/'.$project->id.'/vendors', $fileName);
                        //create the row in upload file
                        $uploadFile = UploadedFiles::where(['fileName'=>$fileName,'admin_id'=>$vendorId,'project_id'=>$project->id])->first();
                        if($uploadFile != null){
                            $uploadFile->delete();
                        }
                        $uploadFile = new UploadedFiles();
                        $uploadFile->project_id = $project->id;
                        $uploadFile->url = "files/projects/".$project->lead->fileno."/".$project->id."/vendors/$fileName";
                        $uploadFile->fileName = $fileName;
                        $uploadFile->$rol = 1;
                        $uploadFile->admin_id = $vendorId;
                        $uploadFile->save();

                        $projectVendor->completed = 1;
                        $projectVendor->completedDate =  $now->format("Y-m-d H:i:s");
                        $projectVendor->save();

                        //create the row in inbox to let Production know
                        $msg  = "File #:".$project->lead->fileno."\r\n";
                        $msg .= "Pin: ".$project->id."\r\n";
                        $msg .= "Client: ".$project->lead->fname." ".$project->lead->lname."\r\n";
                        $msg .= "File Name: ".$fileName."\r\n";
                        Inbox::createInbox($project->lead->id, 30, "File uploaded By Vendor.\r\n".$msg, 'FILE UPLOADED', 'PRODUCTION');


                        $extArray = explode(".",$fileName);
                        $ext = $extArray[count($extArray - 1)];
                        //let consultant know that the patent search was uploaded be the attorney
                        if($consultantVendor != null && strpos($consultantVendor->rol, 'attorney')!== false && ($ext == 'doc'|| $ext == 'docx')){
                            Inbox::createInbox($project->lead->id, $project->consultant_id, "Patent Search uploaded for the attorney.\r\n".$msg, 'PRODUCTION', 'PRODUCTION');
                            $uploadFile->internal = 1;
                            $uploadFile->save();
                        }

                        Transaction::createTransaction($vendorId,'','','UPLOAD_FILE_VENDOR',$fileName,$project->id,'','','','','');
                    }
                }
            }
        }

    }

    /*
     * upload files from attorney client services view
     * */
    public function uploadFileAttCS(){
        $file = Input::file('file');
        $attId = Input::get('CONSULTANT');
        $projectId = Input::get('PROJECT');
        $command = Input::get('COMMAND');
        $project = Project::find($projectId);
        if($project!=null){
            if($file){
                $fileName = $file->getClientOriginalName();
                if(!File::exists("files/projects/".$project->lead->fileno."/".$project->id."/attClientServices")) {
                    File::makeDirectory("files/projects/".$project->lead->fileno."/".$project->id."/attClientServices", 0755, true);
                }
                $file->move(public_path().'/files/projects/'.$project->lead->fileno.'/'.$project->id.'/attClientServices', $fileName);

                //create the row in upload file
                $uploadFile = UploadedFiles::where(['fileName'=>$fileName,'project_id'=>$projectId])->first();
                if($uploadFile != null){
                    $uploadFile->delete();
                }
                $uploadFile = new UploadedFiles();
                $uploadFile->project_id = $projectId;
                $uploadFile->url = "files/projects/".$project->lead->fileno."/".$project->id."/attClientServices/$fileName";
                $uploadFile->fileName = $fileName;
                $uploadFile->attorney = 1;
                $uploadFile->admin_id = $attId;
                $uploadFile->ip = $_SERVER["REMOTE_ADDR"];
                if($command == 'APP') {
                    $otherFiles = UploadedFiles::where('project_id',$projectId)->where('filingReceipt',1)->get();
                    foreach($otherFiles as $otherF){
                        $otherF->filingReceipt=0;
                        $otherF->save();
                    }
                    $uploadFile->filingReceipt = 1;
                }
                $uploadFile->save();

                Transaction::createTransaction($attId,'','','UPLOAD_FILE_CS_ATT',$fileName,$projectId,'','','','','');
            }
        }
    }

    /*
     * upload files from ILC view
    */
    public function uploadFileILC(){
        $file = Input::file('file');
        $projectId = Input::get('PROJECT');
        $adminId = Input::get('CONSULTANT');
        $command = Input::get('COMMAND');
        $project = Project::find($projectId);
        $fileName = $file->getClientOriginalName();
        $strip_aux = explode('.',$fileName);
        $ext = $strip_aux[count($strip_aux)-1];
        if($project!=null){
            if($file){
                //create the row in upload file
                if($command == 'ndaFile'){
                    $action = Input::get('ACTION');
                    $manufacturer =Manufacturer::find(Input::get('MANUFACTURER'));
                    $iid = Input::get('ILC');
                    switch($action){
                        case "client_sign":
                            $fileName=$manufacturer->name." ".$project->lead->fname." ".$project->lead->lname.".".$ext;
                            $ilcNote = new IlcNotes();
                            $ilcNote->ilc_id = $iid;
                            $ilcNote->notes = "Client SIGNS the NDA file uploaded.";
                            $ilcNote->system=1;
                            $ilcNote->save();
                            break;
                        case "client_not_sign":
                            $fileName=$project->lead->fname." ".$project->lead->lname." Denies ".$manufacturer->name." NDA Proof.".$ext;
                            $ilcNote = new IlcNotes();
                            $ilcNote->ilc_id = $iid;
                            $ilcNote->notes = "Client DOES NOT SIGNS the NDA file uploaded.";
                            $ilcNote->system=1;
                            $ilcNote->save();
                            break;
                        case "client_agree":
                            $fileName=$project->lead->fname." ".$project->lead->lname." Approves Submission to ".$manufacturer->name." without NDA.".$ext;
                            $ilcNote = new IlcNotes();
                            $ilcNote->ilc_id = $iid;
                            $ilcNote->notes = "Client Agrees to submit product data without NDA.";
                            $ilcNote->system=1;
                            $ilcNote->save();
                            break;
                        case "client_not_agree":
                            $fileName=$project->lead->fname." ".$project->lead->lname." Refuses Submission to ".$manufacturer->name." without NDA.".$ext;
                            $ilcNote = new IlcNotes();
                            $ilcNote->ilc_id = $iid;
                            $ilcNote->notes = "Client Does Not want to submit product data without NDA.";
                            $ilcNote->system=1;
                            $ilcNote->save();
                            break;
                        default:
                            break;
                    }
                }elseif($command == 'patentStatus'){
                    $fileName = $file->getClientOriginalName();
                    $value = Input::get('VALUE');
                    $iid = Input::get('ILC');
                    $ilc =Ilc::find($iid);
                    if($ilc == null)
                        return -1;
                    if($value != '0')
                        $ilc->patent_status =$value;
                    else
                        $ilc->patent_status ='';
                    $ilc->save();
                    $ilcNote = new IlcNotes();
                    $ilcNote->ilc_id = $iid;
                    $ilcNote->notes = 'Patent Status changed to '.$value.' and the document "'.$fileName.'" was uploaded.';
                    $ilcNote->system=1;
                    $ilcNote->save();
                }else
                    $fileName = $file->getClientOriginalName();

                $file->move(public_path().'/files/projects/'.$project->lead->fileno.'/'.$project->id.'/uploaded', $fileName);

                $uploadFile = UploadedFiles::where('project_id',$projectId)->where('fileName',$fileName)->first();

                if($uploadFile != null)
                    $uploadFile->delete();
                $uploadFile = new UploadedFiles();
                $uploadFile->url = "files/projects/".$project->lead->fileno."/".$project->id."/uploaded/$fileName";
                $uploadFile->fileName = $fileName;
                $uploadFile->project_id = $projectId;
                $uploadFile->admin_id = $adminId;
                $uploadFile->ilc = 1;
                $uploadFile->ip = $_SERVER["REMOTE_ADDR"];
                $uploadFile->save();

                Transaction::createTransaction($adminId,'','','UPLOAD_FILE_FROM_ILC',$fileName,$projectId,'','','','','');
            }
        }
    }

    /*
     * upload files from Manufacturer view
    */
    public function uploadFileManufacturer(){
        $file = Input::file('file');
        $manufacturerId = Input::get('MANUFACTURER');
        $adminId = Input::get('CONSULTANT');
        $manufacturer = Project::find($manufacturerId);
        if($manufacturer!=null){
            if($file){
                $fileName = $file->getClientOriginalName();
                if(!File::exists("files/manufacturerFiles/".$manufacturerId."/")) {
                    File::makeDirectory("files/manufacturerFiles/".$manufacturerId."/", 0755, true);
                }
                $file->move(public_path().'/files/manufacturerFiles/'.$manufacturerId.'/', $fileName);
                //create the row in upload file
                $uploadFile = new UploadedFiles();
                $uploadFile->project_id = 0;
                $uploadFile->manufacturer_id = $manufacturerId;
                $uploadFile->url = "files/manufacturerFiles/".$manufacturerId."/$fileName";
                $uploadFile->fileName = $fileName;
                $uploadFile->admin_id = $adminId;
                $uploadFile->ip = $_SERVER["REMOTE_ADDR"];
                $uploadFile->save();
                Transaction::createTransaction($adminId,'','','UPLOAD_FILE_FROM_MANUFACTURER',$fileName,'','','','','','');
            }
        }
    }

    /*
     * upload files from production view
    */
    public function uploadFileProduction(){
        $file = Input::file('file');
        $projectId = Input::get('PROJECT');
        $adminId = Input::get('CONSULTANT');
        $project = Project::find($projectId);
        if($project!=null){
            if($file){
                $fileName = $file->getClientOriginalName();
                if(!File::exists("files/projects/".$project->lead->fileno."/".$project->id."/production")) {
                    File::makeDirectory("files/projects/".$project->lead->fileno."/".$project->id."/production/", 0755, true);
                }
                $file->move(public_path().'/files/projects/'.$project->lead->fileno.'/'.$project->id.'/production', $fileName);
                //create the row in upload file
                $uploadFile = UploadedFiles::where(['fileName'=>$fileName,'admin_id'=>$adminId,'project_id'=>$project->id])->first();
                if($uploadFile != null){
                    $uploadFile->delete();
                }

                $uploadFile = new UploadedFiles();
                $uploadFile->project_id = $projectId;
                $uploadFile->url = "files/projects/".$project->lead->fileno."/".$project->id."/production/$fileName";
                $uploadFile->fileName = $fileName;
                $uploadFile->internal = 1;
                $uploadFile->admin_id = $adminId;
                $uploadFile->ip = $_SERVER["REMOTE_ADDR"];
                $uploadFile->save();

                //create the row in inbox to let consultant know
                $msg = "File uploaded By Production.\r\n";
                $msg .= "File #:".$project->lead->fileno."\r\n";
                $msg .= "Pin: ".$project->id."\r\n";
                $msg .= "Client: ".$project->lead->fname." ".$project->lead->lname."\r\n";
                $msg .= "File Name: ".$fileName;
                Inbox::createInbox($project->lead->id, $project->consultant_id, $msg, 'PRODUCTION', 'PRODUCTION');

                //complete the row for that project.
                $projectProduction = ProjectProduction::where(['project_id'=>$projectId,'typeVendor'=>'production'])->first();
                if($projectProduction!=null){
                    $projectProduction->completed = 4;
                    $projectProduction->save();
                }
                //create the Transaction
                Transaction::createTransaction($adminId,'','','COMPLETE_UPLOAD_FILE_PRODUCTION',$fileName,$projectId,'','','','','');
            }
        }
    }

    /*
     * upload files from Launch Center view
    */
    public function uploadFileLaunch(){
        $file = Input::file('file');
        $projectId = Input::get('PROJECT');
        $command = Input::get('COMMAND');
        $project = Project::find($projectId);
        if($project!=null){
            if($file){
                $fileName = $file->getClientOriginalName();
                $file->move(public_path().'/files/projects/'.$project->lead->fileno.'/'.$project->id.'/uploaded', $fileName);
                //create the row in upload file
                $uploadFile = new UploadedFiles();
                $uploadFile->project_id = $projectId;
                $uploadFile->url = "files/projects/".$project->lead->fileno."/".$project->id."/uploaded/$fileName";
                $uploadFile->fileName = $fileName;
                $pcs = $project->clientServicesProject();
                if($pcs != null && $pcs->ppaSent_created_at == '')
                    $uploadFile->internal = 1;
                if($command == 'common'){
                    $uploadFile->public = 1;
                    $uploadFile->internal = 1;
                    //create the row in inbox to let consultant know
                    $msg = "File uploaded By Client.\r\n";
                    $msg .= date("m-d-Y H:i:s")."\r\n";
                    $msg .= "File #:".$project->lead->fileno."\r\n";
                    $msg .= "Client: ".$project->lead->fname." ".$project->lead->lname."\r\n";
                    $msg .= "Pin: ".$project->id."\r\n";
                    Inbox::createInbox($project->lead->id, $project->consultant_id, $msg, 'FILE UPLOADED', 'CLIENT');
                    if($pcs != null)
                        Inbox::createInbox($project->lead->id, 24, $msg, 'FILE UPLOADED', 'CLIENT');
                    ToolsFunctions::notifyGeorgeOfFileUpload($project);
                }
                $uploadFile->ip = $_SERVER["REMOTE_ADDR"];
                $uploadFile->save();
            }
        }
    }

    /*
     * upload files from admin view
    */
    public function uploadFileAdmin(){
        $file = Input::file('file');
        $projectId = Input::get('PROJECT');
        $adminId = Input::get('CONSULTANT');
        $project = Project::find($projectId);
        if($project!=null){
            if($file){
                $fileName = $file->getClientOriginalName();
                $file->move(public_path().'/files/projects/'.$project->lead->fileno.'/'.$project->id.'/uploaded', $fileName);
                //create the row in upload file
                $uploadFile = new UploadedFiles();
                $uploadFile->project_id = $projectId;
                $uploadFile->url = "files/projects/".$project->lead->fileno."/".$project->id."/uploaded/$fileName";
                $uploadFile->fileName = $fileName;
                $uploadFile->admin_id = $adminId;
                $uploadFile->ip = $_SERVER["REMOTE_ADDR"];
                $uploadFile->save();
                ToolsFunctions::notifyGeorgeOfFileUpload($project);
            }
        }
    }

    /*
    * upload files from ilc vendors view
   */
    public function uploadFileILCVendors(){
        $file = Input::file('file');
        $projectId = Input::get('PROJECT');
        $adminId = Input::get('CONSULTANT');
        $project = Project::find($projectId);
        if($project!=null){
            if($file){
                $fileName = $file->getClientOriginalName();
                $file->move(public_path().'/files/projects/'.$project->lead->fileno.'/'.$project->id.'/uploaded', $fileName);
                //create the row in upload file
                $uploadFile = UploadedFiles::where(['fileName'=>$fileName,'project_id'=>$project->id])->first();
                if($uploadFile != null){
                    $uploadFile->delete();
                }
                $uploadFile = new UploadedFiles();
                $uploadFile->project_id = $projectId;
                $uploadFile->url = "files/projects/".$project->lead->fileno."/".$project->id."/uploaded/$fileName";
                $uploadFile->fileName = $fileName;
                $uploadFile->admin_id = $adminId;
                $uploadFile->ilcVendors = 1;
                $uploadFile->ip = $_SERVER["REMOTE_ADDR"];
                $uploadFile->save();
                //put note in ilc
                $iid = Input::get('IID');
                $ilcV = IlcVendors::find($iid);
                $ilcNote = new IlcNotes();
                $ilcNote->ilc_id = $ilcV->ilc_id;
                $ilcNote->notes = "File closed by vendor and uploaded ".$fileName." document.";
                $ilcNote->system=1;
                $ilcNote->save();
            }
        }

    }

    /*
         * return all the accessible files for a ILC Vendors
        */
    public function loadFilesILCVendors()
    {
        $id = Input::get('ID');
        $project = Project::find($id);
        $files=[];
        if($project!=null)
        {
            $internalFiles = $project->filesByType(array('ilcVendors'));
            foreach($internalFiles as $file)
            {
                $created = date('m-d-Y',strtotime(str_replace('-','/',$file->created_at)));
                $files[]=['id'=>$file->id,'name'=>$file->fileName,'url'=>$file->url,'created'=>$created];
            }
        }
        return json_encode($files);
    }

    //to delete one of the files attached
    public function removeAttachment(){
        $fid = Input::get('FID');
        $file = UploadedFiles::find($fid);
        if($file == null)
            return -1;
        $file->delete();
        return $fid;
    }

    //return an array of files given the ids
    public function getFiles(){
        $fids = Input::get('FILES');
        $files = array();
        foreach($fids as $fid){
            $file = UploadedFiles::find($fid);
            if($file == null)
                return -1;
            $files[]=$file;
        }
        return json_encode($files);
    }

    //to show the attachments in the modal of the nda to client
    public function getAttachments(){
        $countF = Input::get('COUNT');
        if($countF == 0)
            return 0;
        $pid = Input::get('PROJECTID');
        $docsAttach = UploadedFiles::where('project_id',$pid)->orderBy('created_at','DESC')->limit($countF)->get();
        return json_encode($docsAttach);
    }

}
