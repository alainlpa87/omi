<?php namespace App\Models;

use Illuminate\Support\Facades\Config;
use Illuminate\Database\Eloquent\Model;


class Industry extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'industry';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['type'];

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

    //return all the manufacturers for this industry
    public function manufacturers()
    {
        return $this->hasMany('App\Models\Manufacturer');
    }

    //return all the ILC for this industry
    public function ilc()
    {
        return $this->hasMany('App\Models\Ilc');
    }

    //create a $industryType from the scratch.
    public static function createIndustry($type){
        $industryType = IndustryTypes::where(['type'=>$type])->first();
        if($industryType == null){
            $industryType = new IndustryTypes();
            $industryType->type = $type;
            $industryType->save();
        }
        return $industryType->id;
    }
}
