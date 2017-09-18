<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LegalRecord extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'legalmaintenance';

    // the completed define the project estatus(0->no completed or new,1->completed, 2->returned, 3->overdue)
    protected $filled = array('projectclientservices_id' , 'record_type', 'legal_record',
        'activity', 'activity_due_date', 'description', 'recv_date');

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





}