<?php namespace App\Models;

use Illuminate\Support\Facades\Config;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Lead extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'lead';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['fileno','fname', 'lname','phone','phone2','best','email','street','street2','city','state','zip','country',
        'local','hobby','profession','degree','college','children','spouse','married','birth','leadSource','last','notes','assignDate',
        'status','consultant_id','patent','flag','password','occupation','reason','category','are18'];

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
    public function consultant()
    {
        if($this->consultant_id!=0)
        {
            return $this->belongsTo('App\Models\Consultant');
        }
        return null;
    }
    //return the age for this lead.
    public function age()
    {
        if($this->birth!="0000-00-00 00:00:00")
        {
            return date_diff(date_create('today'),date_create($this->birth))->y;
        }
        return "";
    }

    //find leads that match with the param.
    public static function findLead($param){
        $param = trim($param);
        $spaces = substr_count($param, ' ');
        $result = "-1";
        if($spaces == 1){
            $parts = explode(" ",$param);
            $leads = Lead::where('fname', 'like','%'.$parts[0].'%')->orWhere('lname', 'like','%'.$parts[0].'%')->pluck('id');
            if($leads!=null) {
                $result = $leads;
            }
        }elseif($spaces == 0){
            $leads = Lead::where('fname', 'like','%'.$param.'%')
                ->orWhere('lname', 'like','%'.$param.'%')
                ->orWhere('email', 'like','%'.$param.'%')
                ->orWhere('phone', 'like','%'.$param.'%')
                ->orWhere('phone2', 'like','%'.$param.'%')
                ->orWhere('fileno', 'like','%'.$param.'%')
                ->pluck('id');
            if($leads!=null) {
                $result = $leads;
            }
        }
        return $result;
    }

    //create a lead from the scratch.
    public static function createLead($fileno,$consultantId,$fname,$lname,$phone,$phone2,$email,$street,$street2,$city,$state,$zip,$notes,$leadSource,$local,$reason,$patent,$status=null){
        $fileno = ($fileno == '')?DB::table('lead')->max('fileno') + 1:$fileno;
        $lead = new Lead();
        $lead->fileno = $fileno;
        $lead->fname = $fname;
        $lead->lname = $lname;
        $lead->phone = $phone;
        $lead->phone2 = $phone2;
        $lead->email = $email;
        $lead->street = $street;
        $lead->street2 = $street2;
        $lead->city = $city;
        $lead->state = $state;
        $lead->zip = $zip;
        $lead->notes = $notes;
        $lead->leadSource = $leadSource;
        $lead->local = $local;
        $lead->reason = $reason;
        $lead->patent = $patent;
        if($status != null){
            $lead->status = $status;
        }
        if($consultantId != ''){
            $lead->consultant_id = $consultantId;
        }
        $lead->ip = $_SERVER['REMOTE_ADDR'];
        $lead->save();
        return $lead->id;
    }

    //update any atribute of the lead.
    public static function updateLead($id,$fileno,$consultantId,$fname,$lname,$phone,$phone2,$email,$street,$street2,$city,$state,$zip,$notes,$leadSource,$local,$reason,$patent,$status=null){
        $lead = Lead::find($id);
        if($lead != null) {
            if ($fname != '') {
                $lead->fname = $fname;
            }
            if ($lname != '') {
                $lead->lname = $lname;
            }
            if ($phone != '') {
                $lead->phone = $phone;
            }
            if ($phone2 != '') {
                $lead->phone2 = $phone2;
            }
            if ($email != '') {
                $lead->email = $email;
            }
            if ($street != '') {
                $lead->street = $street;
            }
            $lead->street2 = $street2;
            if ($city != '') {
                $lead->city = $city;
            }
            if ($state != '') {
                $lead->state = $state;
            }
            if ($zip != '') {
                $lead->zip = $zip;
            }
            if ($leadSource != '') {
                $lead->leadSource = $leadSource;
            }
            if ($local != '') {
                $lead->local = $local;
            }
            if ($reason != '') {
                $lead->reason = $reason;
            }
            if ($patent != '') {
                $lead->patent = $patent;
            }
            if ($status != null) {
                $lead->status = $status;
            }
            if($consultantId != ''){
                $lead->consultant_id = $consultantId;
            }
            if($fileno != ''){
                $lead->fileno = $fileno;
            }
            if($notes != ''){
                $lead->notes = $notes;
            }
            $lead->save();
        }
    }

    //return the last x transaction as text.
    public function lastTransactions($total=60)
    {
        $transacions = Transaction::where('lead_id',$this->id)->orderBy('created_at','DESC')->take($total)->get();
        $textResult="";
        foreach($transacions as $transacion)
        {
            $textResult.=$transacion->created_at." - ".$transacion->transtype." - ".$transacion->params." - ConsultantID: ".($transacion->consultant_id != 0?$transacion->consultant_id:'N/A')."<br>";
        }
        return $textResult;
    }

    //return all the projects made it for this lead
    public function projects()
    {
        return $this->hasMany('App\Models\Project');
    }

    //return 1 if the lead has a paid contract, 0 otherwise
    public function hasContractSold()
    {
        foreach($this->projects()->get() as $project)
        {
            if($project->lastContractPaidDate()!="")
                return 1;
        }
        return 0;
    }
    //return 1 if the lead has a contract ready to pay, 0 otherwise
    public function makePaymentAvailable()
    {
        foreach($this->projects()->get() as $project)
        {
            if($project->status!="EXCLUDE" && $project->lastContractNoWP() !=null &&
                $project->lastContractNoWP()->paid < $project->lastContractNoWP()->price &&
                in_array($project->stage,array("WOM", 'WALKTHRU',"DROP", "DROP/IMG", "ARCHIVE","PHASE2","CONTRACT"))
                && ($project->stage=="WALKTHRU"||$project->lastContractNoWP()->type=="IGUP"||$project->lastContractNoWP()->type=="PPA" || new \DateTime($project->actionDate) <= new \DateTime()))
            return 1;
        }
        return 0;
    }
}
