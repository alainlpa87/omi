<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ManufacturerNotes extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'manufacturersnotes';

    protected $filled = array('manufacturer_id','notes');

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
    public function manufacturer(){
        if($this->manufacturer_id!=0)
            return $this->belongsTo('App\Models\Manufacturer');
        return null;
    }

    public static function createNote($manufacturer_id, $note){
        $ManuNotes = new ManufacturerNotes();
        $ManuNotes->manufacturer_id = $manufacturer_id;
        $ManuNotes->notes = $note;
        $ManuNotes->save();
        return $ManuNotes;
    }

}