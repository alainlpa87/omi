<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'ticket';

    protected $filled = array('name','lead_id','project_id','phase','receiver');

    /**
     * Create a new Eloquent model instance.
     *
     * @param array $attributes
     * @return mixed
     */
    public function __construct(array $attributes = []){

        parent::__construct($attributes);
    }

    // return the lead
    public function lead(){
        if($this->lead_id!=0)
            return $this->belongsTo('App\Models\Lead');
        return null;
    }

    // return the project
    public function project(){
        if($this->project_id!=0)
            return $this->belongsTo('App\Models\Project');
        return null;
    }

    // return the conversation
    public function reply(){
        if($this->reply_id!=0)
            return $this->belongsTo('App\Models\Reply');
        return null;
    }

}