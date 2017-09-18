<?php namespace App\Models;

use Illuminate\Support\Facades\Config;
use Illuminate\Database\Eloquent\Model;


class Assignment extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'assignment';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     *
     * status = [NEW, REASSIGN]
     * leadSource = [IMI,PAL,SEO,LIVE-N,...] to make reports
     * reassignReason = [NEED_MORE_LEADS, TO_INCUBATOR, CROM, NEWCONSULTANT ]
     * leadExtra = [0,1] when the leads if extra of the amount of leads you receive by your group
     */
    protected $fillable = ['lead_id','consultant_id', 'status','leadExtra', 'leadSource', 'reassignReason'];

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
        return $this->belongsTo('App\Models\Consultant');
    }
    public function lead()
    {
        return $this->belongsTo('App\Models\Lead');
    }

    public static function createAssignment($consultantId,$leadId,$status,$leadExtra,$leadSource,$reassignReason=null){
        $assignment = new Assignment();
        $assignment->lead_id = $leadId;
        $assignment->consultant_id = $consultantId;;
        $assignment->status = $status;
        $assignment->leadSource = $leadSource;
        if($reassignReason != null){
            $assignment->reassignReason = $reassignReason;
        }
        if($leadExtra != ''){
            $assignment->leadExtra = $leadExtra;
        }
        $assignment->save();
        return $assignment->id;
    }
}
