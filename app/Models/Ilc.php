<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ilc extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'ilc';

    // the completed define the project estatus(0->no completed or new,1->completed, 2->returned, 3->overdue)
    protected $filled = array('fileno', 'projectclientservices_id','status','invFname','invLname','coInvs','phone','phone2','street','city','state','zip','email','inventionName','additionalEmails','coordinator','patent_status','industry_id','website_codes_user','website_codes_pswd','callTradeshow','welcomePckgSentDate','introCallDate','website_codes','agreementStartDate','separationDate','patentedContractSentDate','patentedContractRcvdDate');

    /**
     * Create a new Eloquent model instance.
     *
     * @param array $attributes
     * @return mixed
     */
    public function __construct(array $attributes = []){

        parent::__construct($attributes);
    }

   // return the project client services
    public function projectclientservices()
    {
        return $this->belongsTo('App\Models\ProjectClientServices');
    }


    //return the industry of this ILC
    public function industry()
    {
        if($this->industry_id!=0)
            return $this->belongsTo('App\Models\Industry');
        return null;
    }

    //many to many with manufacturers
    public function manufacturers()
    {
        return $this->belongsToMany('App\Models\Manufacturer', 'ilc_manufacturer')
            ->withTimestamps();
    }

//create a ILC from the scratch.
    public static function createIlc($fileno, $projectclientservices_id,$industry_id,$status=null){
        $ilc = Ilc::where(['fileno'=>$fileno,'projectclientservices_id'=>$projectclientservices_id])->first();
        if($ilc == null){
            $pcs = ProjectClientServices::find($projectclientservices_id);
            $lead = Lead::where('fileno',$fileno)->first();
            $ilc = new Ilc();
            $ilc->fileno = $fileno;
            $ilc->industry_id = $industry_id;
            $ilc->projectclientservices_id = $projectclientservices_id;
            if ($status != null) {
                $ilc->status = $status;
            }
            $ilc->patent_status = 'PENDING';
            $ilc->agreementStartDate =date('Y-m-d H:i:s', strtotime(str_replace('-','/',$pcs->marketingAgrReceived_created_at)));;
            //lead info
            $ilc ->invFname = $lead->fname;
            $ilc ->invLname = $lead->lname;
            $ilc ->coInvs = $pcs->project->coInventor;
            $ilc->phone = $lead->phone;
            $ilc->phone2 = $lead->phone2;
            $ilc->street = $lead->street;
            $ilc->city = $lead->city;
            $ilc->state = $lead->state;
            $ilc->zip = $lead->zip;
            $ilc->email = $lead->email;
            $ilc->inventionName = $pcs->project->ideaName;
            $ilc->save();
        }
        return $ilc->id;
    }

    //adding new manufacturer to this ilc project
    public function addManufacturer($manufacturers){
        foreach($manufacturers as $manufacturer){
            if (!$this->manufacturers->contains($manufacturer)){
                $this->manufacturers()->attach($manufacturer);
            }
        }
        return 1;
    }

    //delete manufacturer from this ilc project
    public function deleteManufacturer($manufacturers){
        foreach($manufacturers as $manufacturer){
            if ($this->manufacturers->contains($manufacturer)){
                $this->manufacturers()->detach($manufacturer);
            }
        }
        return 1;
    }

    //return the notes
    public function ilcNotes()
    {
        return IlcNotes::where('ilc_id',$this->id)->orderBy('created_at', 'desc')->get();
    }
}




























