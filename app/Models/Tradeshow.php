<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tradeshow extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tradeshows';

    // the completed define the project estatus(0->no completed or new,1->completed, 2->returned, 3->overdue)
    protected $filled = array('name', 'tradeshowEndDate','tradeshowStartDate','link','year','location');

    /**
     * Create a new Eloquent model instance.
     *
     * @param array $attributes
     * @return mixed
     */
    public function __construct(array $attributes = []){

        parent::__construct($attributes);
    }


//create a Trade Show
    public static function createTradeshow($name, $tradeshowEndDate,$tradeshowStartDate,$link,$location,$year){
        $tradeshow = Tradeshow::where(['name'=>$name,'tradeshowEndDate'=>$tradeshowEndDate])->first();
        if($tradeshow == null){
            $tradeshow = new Tradeshow();
            $tradeshow->name = $name;
            $tradeshow->tradeshowEndDate = $tradeshowEndDate;
            $tradeshow->tradeshowStartDate = $tradeshowStartDate;
            $tradeshow->link = $link;
            $tradeshow->location = $location;
            $tradeshow->year = $year;
            $tradeshow->save();
        }
        return $tradeshow->id;
    }
}




























