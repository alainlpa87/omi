<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'reply';

    protected $filled = array('message', 'author','ticket_id');

    /**
     * Create a new Eloquent model instance.
     *
     * @param array $attributes
     * @return mixed
     */
    public function __construct(array $attributes = []){

        parent::__construct($attributes);
    }


    // return the previous mssg
    public function ticket(){
        if($this->ticket_id!=0)
            return $this->belongsTo('App\Models\Ticket');
        return null;
    }

}