<?php namespace App\Models;

use Illuminate\Support\Facades\Config;
use Illuminate\Database\Eloquent\Model;


class Manufacturer extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'manufacturer';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','industry_id','hasNda','ndaSign','manfNda','cSignManfNda','manfNoNda','email','phone','fname','lname'];

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

    //return the industry of this Manufacturer
    public function industry()
    {
        if($this->industry_id!=0)
            return $this->belongsTo('App\Models\Industry');
        return null;
    }

    //many to many with manufacturers
    public function ilcs()
    {
        return $this->belongsToMany('App\Models\Ilc', 'ilc_manufacturer')
            ->withTimestamps();
    }

    //create a $industryType from the scratch.
    public static function createManufacturer($name,$industry_id,$hasNda,$ndaSign,$manfNda,$manfNoNda,$cSignManfNda,$email,$phone,$fname,$lname){
        $manufacturer = Manufacturer::where(['name'=>$name,'industry_id'=>$industry_id,'hasNda'=>$hasNda,'email'=>$email,'fname'=>$fname,'lname'=>$lname])->first();
        if($manufacturer == null){
            $manufacturer = new Manufacturer();
            $manufacturer->name = $name;
            $manufacturer->industry_id = $industry_id;
            $manufacturer->hasNda = $hasNda;
            $manufacturer->ndaSign = $ndaSign;
            $manufacturer->manfNda = $manfNda;
            $manufacturer->cSignManfNda = $cSignManfNda;
            $manufacturer->manfNoNda = $manfNoNda;
            $manufacturer->email = $email;
            $manufacturer->phone = $phone;
            $manufacturer->fname = $fname;
            $manufacturer->lname = $lname;
            $manufacturer->save();
        }
        return $manufacturer->id;
    }

    //adding new ilc to this manufacturer
    public function addIlc($ilcs){
        foreach($ilcs as $ilc){
            if (!$this->ilcs->contains($ilc)){
                $this->ilcs()->attach($ilc);
            }
        }
        return 1;
    }

    //delete ilc from this manufacturer
    public function deleteIlc($ilcs){
        foreach($ilcs as $ilc){
            if ($this->ilcs->contains($ilc)){
                $this->ilcs()->detach($ilc);
            }
        }
        return 1;
    }

    public function getManufacturerFiles(){
        return UploadedFiles::where('manufacturer_id',$this->id)->get();
    }

    //return the notes
    public function getNotes()
    {
        return ManufacturerNotes::where('manufacturer_id',$this->id)->orderBy('created_at', 'desc')->get();
    }
}
