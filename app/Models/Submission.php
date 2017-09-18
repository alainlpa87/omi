<?php namespace App\Models;

use Illuminate\Support\Facades\Config;
use Illuminate\Database\Eloquent\Model;


class Submission extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'submission';

    /**
     * The attributes that are mass assignable.
     * leadSource -> to make reports.
     * status -> [NEW, REASSIGN]
     * note -> [INCUBATOR, CRONJOB(completado por el cronjob),(otras notas)]
     * @var array
     */
    protected $fillable = ['project_id','consultant_id', 'status', 'leadSource', 'note'];

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
    public function project()
    {
        return $this->belongsTo('App\Models\Project');
    }

    //create a submission from the scratch.
    public static function createSubmission($projectId,$consultantId,$status,$leadSource,$note){
        $submission = new Submission();
        $submission->project_id = $projectId;
        $submission->consultant_id = $consultantId;
        $submission->status = $status;
        $submission->leadSource = $leadSource;
        $submission->note = $note;
        $submission->save();
        return $submission->id;
    }
}
