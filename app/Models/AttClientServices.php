<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttClientServices extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'attorney_clientservices';

    // the completed define the project estatus(0->no completed or new,1->completed, 2->returned, 3->overdue, 4->pending Filing)
    //beforeDue guardar en que estado estaba antes para saber a la hora del overdue cuantos dias debe de estar
    //dueDate is for upgrade app because is different dah 56 days fron creation
    protected $filled = array('projectclientservices_id','completed','beforeDue','type','consultant_id','lead_id','returnedReason','overDueReason','stateChangedDate','reminderToAttAppDate','dueDate');

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

    public function lead()
    {
        return $this->belongsTo('App\Models\Lead');
    }

    public function consultant(){
        return $this->belongsTo('App\Models\Consultant');
    }

    /*
     * Create a AttCs from the scratch
     * */
    public static function createAttCS($projectclientservices_id, $consultant_id, $lead_id, $type){
        $attCS = AttClientServices::where('projectclientservices_id',$projectclientservices_id)->where('type',$type)->first();
        if($attCS == null){
            $attCS = new AttClientServices();
        }
        $attCS->projectclientservices_id = $projectclientservices_id;
        $attCS->completed = 0;
        $attCS->consultant_id = $consultant_id;
        $attCS->lead_id = $lead_id;
        $attCS->type = $type;
        $attCS->returnedReason='';
        $attCS->overDueReason='';
        $attCS->stateChangedDate =date('0000-00-00 00:00:00');
        $attCS->reminderToAttAppDate =date('Y-m-d 00:00:00');
        $attCS->save();

        return $attCS->id;
    }

    public function getDueDate(){
        if($this->completed == 0 || $this->completed == 3){
            if($this->type == 'UPG_UT'){
                $weeks = date('m/d/Y', strtotime($this->created_at.' + 2 weeks'));
                $pcs = $this->projectclientservices;
                $year =  date('m/d/Y', strtotime($pcs->patentAppFiled_created_at.' + 1 year'));
                $dueDate = strtotime($weeks) < strtotime($year)? $weeks:$year;
            }else{
                $dueDate = date('m/d/Y', strtotime($this->created_at.' + 10 weeks'));
            }
        }elseif($this->completed == 2 || $this->completed == 4){
            $dueDate = date('m/d/Y', strtotime($this->stateChangedDate.' + 2 weeks'));
        }

        return $dueDate;
    }

}