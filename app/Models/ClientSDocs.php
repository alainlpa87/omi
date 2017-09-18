<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientSDocs extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'clientservicesdocs';

    protected $filled = array('projectclientservices_id','file_id','notes_resend','document','name','signdate','belong_PA');

    /**
     * Create a new Eloquent model instance.
     *
     * @param array $attributes
     * @return mixed
     */
    public function __construct(array $attributes = []){

        parent::__construct($attributes);
    }

    // return the client services
    public function projectclientservices(){
        if($this->projectclientservices_id!=0)
            return $this->belongsTo('App\Models\ProjectClientServices');
        return null;
    }

}