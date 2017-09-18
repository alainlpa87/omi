<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IlcNotes extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'ilcnotes';

    protected $filled = array('ilc_id','notes','system');

    /**
     * Create a new Eloquent model instance.
     *
     * @param array $attributes
     * @return mixed
     */
    public function __construct(array $attributes = []){
        parent::__construct($attributes);
    }

    // return the ilc
    public function ilc(){
        if($this->ilc_id!=0)
            return $this->belongsTo('App\Models\Ilc');
        return null;
    }

    public static function createNote($ilc_id, $note){
        $ilcN = new IlcNotes();
        $ilcN->ilc_id = $ilc_id;
        $ilcN->notes = $note;
        $ilcN->save();
        return $ilcN;
    }

}