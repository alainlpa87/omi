<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IlcVendors extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'ilc_vendors';

    // state (0->new, 1->returned, 2->overdue, 3->complete )
    protected $filled = array('ilc_id','fileno', 'status','state','vendorId','2d','filesRcvdDate','text','textBack');

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
    public function ilc()
    {
        return $this->belongsTo('App\Models\Ilc');
    }




//create a ILC from the scratch.
    public static function createIlcVendor($ilc_id,$status=null, $vendorId, $dosD,  $text){
        $ilcV = IlcVendors::where('ilc_id',$ilc_id)->first();
        if($ilcV == null)
            $ilcV = new IlcVendors();

        $ilc =Ilc::find($ilc_id);
        if($ilc == null)
            return -1;
        $ilcV->fileno = $ilc->fileno;
        $ilcV->ilc_id = $ilc_id;
        if ($status != null) {
            $ilcV->status = $status;
        }
        $ilcV->state = 0;
        $ilcV->vendorId = $vendorId;
        $ilcV->dosD = $dosD;
        $ilcV->text = $text;
        $ilcV->filesRcvdDate =date('Y-m-d 00:00:00');
        $ilcV->save();

        return $ilcV->id;
    }

}




























