<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Request extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'request';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['project_id','request', 'consultantStage','adminStage','adminNotes','admin_id','consultant_id','readed'];

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
    public function project()
    {
        if($this->project_id!=0)
            return $this->belongsTo('App\Models\Project');
        return null;
    }
}
