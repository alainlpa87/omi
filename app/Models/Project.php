<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'project';

    /**
     * The attributes that are mass assignable.
     *approvalNotes: when we need approval from the client, we create a request 'CLIENT REWIEW' we will show the approvalNotes in the launch center and when they approve it we will concatenate it to the ideaconcept and clear the approvalNotes
     * utility: PPAType from the Attorney
     * @var array
     */
    protected $fillable = ['lead_id','patentSearch', 'ideaName','ideaConcept','pInventor','hisIdea','similarProduct','probIdea','descIdea','uniIdea',
        'payIdea','techField','costSpend','targetMarket','modifications','environment','device','addNotes','notes','stage','coInventor','coInventorRelation',
        'approvalNotes','status','vendor','vendorDate','utility', 'pendingNMI','consultant_id','actionDate','adminNotes','internalNotes','tpaContact','patented',
        'isApp', 'language','echeck','ip'];//showMoreInfo es para cuando alguien pague mostrar las preguntas adicionales

    /**
     * Create a new Eloquent model instance.
     *
     * @param array $attributes
     * @return mixed
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

    }
    //return the consultant owner of this project
    public function consultant()
    {
        if($this->consultant_id!=0)
            return $this->belongsTo('App\Models\Consultant');
        return null;
    }
    //return the lead owner of this project
    public function lead()
    {
        if($this->lead_id!=0)
            return $this->belongsTo('App\Models\Lead');
        return null;
    }
    //return all the requests made it for this project
    public function requests()
    {
        return $this->hasMany('App\Models\Request');
    }
    //return all the contracts made it for this project
    public function contracts()
    {
        return $this->hasMany('App\Models\Contract');
    }
    //return all the contracts made it for this project
    public function transactions()
    {
        return $this->hasMany('App\Models\Transaction');
    }
    //return all the files uploaded it for this project
    public function files()
    {
        return $this->hasMany('App\Models\UploadedFiles');
    }
    //return the last x transaction as text
    public function lastTransactions($total=20)
    {
        $transacions = Transaction::where('project_id',$this->id)->orWhere('lead_id',$this->lead->id)->orderBy('created_at','DESC')->take($total)->get();
        $textResult="";
        foreach($transacions as $transacion)
        {
            $textResult.=$transacion->created_at." - ".$transacion->transtype." - ".$transacion->params." - ConsultantID: ".($transacion->consultant_id != 0?$transacion->consultant_id:'N/A')."<br>";
        }
        return $textResult;
    }
    //return the last request made it for this project
    public function lastRequest()
    {
       return $this->requests()->latest()->first();
    }
    //return the last request made it to admin for this project
    public function lastRequestToAdmin()
    {
        return $this->requests()->latest()->where('request','ADMIN')->first();
    }
    //return the last contract sent it for this project
    public function lastContract()
    {
        return $this->contracts()->latest()->first();
    }
    //return the last contract sent it for this project
    public function lastContractNoWP()
    {
        return $this->contracts()->where('type','NOT LIKE','WP')->latest()->first();
    }
    //return the last contract with payments
    public function lastContractWithPayment()
    {
        return $this->contracts()->where('paid','>',0)->orderBy('paidDate','DESC')->first();
    }
    public function firstContract()
    {
        return Contract::where('project_id',$this->id)->orderBy('created_at','ASC')->first();
    }
    //return files by type
    public function filesByType($types = null)
    {
        if($types==null)
            $files = UploadedFiles::where(array('project_id'=>$this->id))->get();
        else
        {
            $files = array();
            foreach($types as $type)
            {
                $filesTemp = UploadedFiles::where(array('project_id'=>$this->id, "$type"=>1))->get();
                foreach($filesTemp as $file)
                {
                    if(!in_array($file,$files))
                        $files[]=$file;
                }
            }
        }
        return $files;
    }

    //return files by type
    public function getProjectProduction(){
        $projectProduction = ProjectProduction::where(array('project_id'=>$this->id,'typeVendor'=>'production'))->first();
        return $projectProduction;
    }

    //return last funding contract
    public function lastFundingContract()
    {
        return $this->contracts()->latest()->where('funding','1')->first();
    }

    //create a project from the scratch.
    public static function createProject($consultantId,$leadId,$ideaName,$ideaConcept,$hisIdea,$similarProduct,$probIdea, $status){
        $project = new Project();
        $project->consultant_id = $consultantId;
        $project->lead_id = $leadId;
        $project->ideaName = $ideaName;
        $project->ideaConcept = $ideaConcept;
        $project->hisIdea = $hisIdea;
        $project->similarProduct = $similarProduct;
        $project->probIdea = $probIdea;
        $project->status = $status;
        $project->save();
        $project->ip = $_SERVER['REMOTE_ADDR'];
        $project->save();
        return $project->id;
    }

    //update project.
    public static function updateProject($projectId, $tpacontact, $patsearch, $patented, $pinventors, $status){
        $project = Project::find($projectId);
        if($project != null) {
            $project->tpaContact = $tpacontact;
            $project->patentSearch = $patsearch;
            $project->patented = $patented;
            $project->coInventor = $pinventors;
            $project->status = $status;
            $project->save();
            return $project->id;
        }
        return 0;
    }

    public static function createFullProject($consultantId,$leadId,$ideaName,$ideaConcept,$hisIdea,$similarProduct,$probIdea, $tpacontact, $patsearch, $patented, $pinventors, $isApp, $language,$status){
        $project = new Project();
        $project->consultant_id = $consultantId;
        $project->lead_id = $leadId;
        $project->ideaName = $ideaName;
        $project->ideaConcept = $ideaConcept;
        $project->hisIdea = $hisIdea;
        $project->similarProduct = $similarProduct;
        $project->probIdea = $probIdea;
        $project->tpaContact = $tpacontact;
        $project->patentSearch = $patsearch;
        $project->patented = $patented;
        $project->coInventor = $pinventors;
        $project->isApp = $isApp;
        $project->language = $language;
        $project->status = $status;
        $project->save();
        return $project->id;
    }

    //return the date of the last contracts paid if not return empty
    public function lastContractPaidDate(){
        $contract = $this->contracts->where('type','PPA')->first();
        if($contract != null && ($contract->paid != 0)) {
            return $contract->paidDate;
        }
        $contract = $this->contracts->where('type','IIG')->first();
        if($contract != null && ($contract->paid == $contract->price)) {
            return $contract->paidDate;
        }
        $contract = $this->contracts->where('type','IGUP')->first();
        if($contract != null && ($contract->paid == $contract->price)) {
            return $contract->paidDate;
        }
        $contract = $this->contracts->where('type','IMG')->first();
        if($contract != null && ($contract->paid == $contract->price)) {
            return $contract->paidDate;
        }
        return "";
    }

    //return an array with info of the last contract paid
    public function lastContractPaid()
    {
        $contract = $this->contracts->where('type','IIG')->first();
        if($contract != null && ($contract->paid >= $contract->price)) {
            $result ['DATE'] = date('m-d-Y h:i:s',strtotime(str_replace('-','/',$contract->paidDate)));
            $result ['TYPE'] = $contract->type;
            $result ['IMG'] = '';
            $result ['SIGN'] = $contract->signed;
            $result ['ID'] = $contract->id;
            $result ['PAID'] = $contract->paid;
            $result ['CONSULTANT'] = $contract->consultant_id;
            return $result;
        }
        $contract = $this->contracts->where('type','IGUP')->first();
        if($contract != null && ($contract->paid >= $contract->price)) {
            $result ['DATE'] = date('m-d-Y h:i:s',strtotime(str_replace('-','/',$contract->paidDate)));
            $result ['TYPE'] = $contract->type;
            $result ['SIGN'] = $contract->signed;
            $result ['PAID'] = $contract->paid;
            $result ['ID'] = $contract->id;
            $result ['CONSULTANT'] = $contract->consultant_id;
            //obtain the date of the img
            $contract = $this->contracts->where('type','IMG')->first();
            if($contract != null && ($contract->paid >= $contract->price)) {
                $result ['IMG'] = date('m-d-Y h:i:s',strtotime(str_replace('-','/',$contract->paidDate)));
            }
            return $result;
        }
        $contract = $this->contracts->where('type','IMG')->first();
        if($contract != null && ($contract->paid >= $contract->price)) {
            $result ['DATE'] = date('m-d-Y h:i:s',strtotime(str_replace('-','/',$contract->paidDate)));
            $result ['TYPE'] = $contract->type;
            $result ['IMG'] = date('m-d-Y h:i:s',strtotime(str_replace('-','/',$contract->paidDate)));
            $result ['SIGN'] = $contract->signed;
            $result ['PAID'] = $contract->paid;
            $result ['ID'] = $contract->id;
            $result ['CONSULTANT'] = $contract->consultant_id;
            return $result;
        }
        return "";
    }
    //return true if the project has a contract paid and signed
    public function allowPPA()
    {
        $contract = $this->contracts->where('type','IIG')->first();
        if($contract!=null && $contract->paid == $contract->price && strlen($contract->signed)>0) return true;
        $contract = $this->contracts->where('type','IGUP')->first();
        if($contract!=null && $contract->paid == $contract->price && strlen($contract->signed)>0) return true;
        $contract = $this->contracts->where('type','IMG')->first();
        if($contract!=null && $contract->paid == $contract->price && strlen($contract->signed)>0) return true;
        return false;
    }
    //return the contract of PPA if the project has one
    public function contractPPA()
    {
        $contract = $this->contracts->where('type','PPA')->first();
        if($contract!=null) return $contract;
        return "";
    }
    public function contractIIG()
    {
        $contract = $this->contracts->where('type','IIG')->first();
        if($contract!=null) return $contract;
        return "";
    }
    public function contractIMG()
    {
        $contract = $this->contracts->where('type','IMG')->first();
        if($contract!=null) return $contract;
        return "";
    }
    public function contractIGUP()
    {
        $contract = $this->contracts->where('type','IGUP')->first();
        if($contract!=null) return $contract;
        return "";
    }

    //return the total amount of phase 1
    public function totalPhase1AmountIn(){
        if($this->contractIIG() != '' && $this->contractIIG()->paid > 0){
            return $this->contractIIG()->paid;
        }
        elseif($this->contractIMG() != '' && $this->contractIMG()->paid > 0){
            if($this->contractIGUP() != '' && $this->contractIGUP()->paid > 0){
                return ($this->contractIMG()->paid + $this->contractIGUP()->paid);
            }
            else{
                return $this->contractIMG()->paid;
            }
        }
        return '';
    }

    //return the client services project object
    public function clientServicesProject(){
       return ProjectClientServices::where('project_id',$this->id)->first();
    }

    //return the IIG PACKAGE if exist paid IIG
    public function IigType(){
        $contractPaid = $this->lastContractPaid();
        if($contractPaid != ""){
            if($contractPaid['TYPE'] == 'IIG'){
                switch($contractPaid['PAID']){
                    case 649:
                        return 'SILVER';
                    case 849:
                        return 'SILVER';
                    case 879:
                        return 'SILVER';
                    case 749:
                        return 'GOLD';
                    case 949:
                        return 'GOLD';
                    case 1079:
                        return 'GOLD';
                    case 979:
                        return 'PLATINUM';
                    case 999:
                        return 'PLATINUM';
                    case 1179:
                        return 'PLATINUM';
                    case 1379:
                        return 'PLATINUM';
                }

            }elseif($contractPaid['TYPE'] == 'IGUP'){
                switch($contractPaid['PAID']){
                    case 200:
                        return 'SILVER';
                    case 400:
                        return 'SILVER';
                    case 430:
                        return 'SILVER';
                    case 300:
                        return 'GOLD';
                    case 500:
                        return 'GOLD';
                    case 630:
                        return 'GOLD';
                    case 530:
                        return 'PLATINUM';
                    case 550:
                        return 'PLATINUM';
                    case 730:
                        return 'PLATINUM';
                    case 930:
                        return 'PLATINUM';
                }
            }
        }
        return '';
    }

    //return the consultants that have been involves on the contracts
    public function getConsultantsOnSales()
    {
        $usr = '';
        $contract = $this->contracts->where('type','PPA')->first();
        if($contract != null) {
            $usr = $contract->consultant->usr;
        }

        $contract = $this->contracts->where('type','IIG')->first();
        if($contract != null && ($contract->paid >= $contract->price)) {
            if(strpos($usr,$contract->consultant->usr) === false)
                $usr .=" ".$contract->consultant->usr;
        }
        $contract = $this->contracts->where('type','IGUP')->first();
        if($contract != null && ($contract->paid >= $contract->price)) {
            if(strpos($usr,$contract->consultant->usr) === false)
                $usr .=" ".$contract->consultant->usr;
        }
        $contract = $this->contracts->where('type','IMG')->first();
        if($contract != null && ($contract->paid >= $contract->price)) {
            if(strpos($usr,$contract->consultant->usr) === false)
                $usr .=" ".$contract->consultant->usr;
        }
        return $usr;
    }

    //return the Ppa Investment Protection amount.
    public function getPpaInvestmentProtection()
    {
        $contract = $this->contracts->where('type','IIG')->first();
        if($contract != null && ($contract->paid == $contract->price)) {
           return $contract->getInvestmentProtection();
        }
        else {
            $contract = $this->contracts->where('type', 'IGUP')->first();
            if ($contract != null && ($contract->paid== $contract->price)) {
                return $contract->getInvestmentProtection();
            }
        }
        return 0;
    }

}
