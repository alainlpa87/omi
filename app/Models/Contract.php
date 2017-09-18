<?php namespace App\Models;

use Illuminate\Support\Facades\Config;
use Illuminate\Database\Eloquent\Model;


class Contract extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'contract';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['project_id','type', 'price','paid','paidDate','signed','signedDate','sendBy','funding','readed','consultant_id','ppaPlans', 'ppapricesplan_id','halfPrice','iigUpgrade','iigUpgradePrice','Add849'];

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
    public function project()
    {
        if($this->project_id!=0)
            return $this->belongsTo('App\Models\Project');
        return null;
    }
    //return all payment transactions for this contract
    public function paymentTransactions()
    {
        return $this->hasMany('App\Models\PaymentTransaction');
    }
    // return last payment transaction Approved for this project that was approved
    public function lastPaymentTransactionApproved()
    {
        return $this->paymentTransactions()->latest()->where('approved',1)->get();
    }
    // return last payment transaction made for this project that was approved
    public function lastPaymentTransaction()
    {
        return $this->paymentTransactions()->latest()->where('approved',1)->first();
    }
    //return the consultant who sold the contract
    public function consultant()
    {
        if($this->consultant_id!=0)
            return $this->belongsTo('App\Models\Consultant');
        return null;
    }

    //return different prices for that current PPA contract
    public function ppaPrices()
    {
        if($this->ppapricesplan_id!=0)
            return PpaPricesPlan::find($this->ppapricesplan_id);
        return null;
    }

    public function getInvestmentProtection(){
        $prices = PpaPricesPlan::where('plan1', 'like',$this->paid)->orWhere('plan2', 'like',$this->paid)->orWhere('plan3', 'like',$this->paid)->first();
        if($prices != null){
            return $prices->getInvestmentProtection($this->paid);
        }
        return 0;
    }

    //return different prices for that current PPA contract
    public function ppaTotalPrice()
    {
        $value = 0;
        if($this->price != 100000)
            return $this->price;

        if(strlen($this->ppaPlans) == 0)
            return 0;
        if($this->ppapricesplan_id !=0){
            $plans = PpaPricesPlan::find($this->ppapricesplan_id);
            if($plans!=null){
                if(strlen($this->ppaPlans) == 1){
                    $planToReturn = 'plan'.$this->ppaPlans;
                    return $plans->$planToReturn;
                }else{
                    $planes = explode(',',$this->ppaPlans);
                    foreach($planes as $p){
                        $planToReturn = 'plan'.$p;
                        $value += $plans->$planToReturn;
                    }
                    return $value;
                }
            }
            return 0;
        }else{
            return 0;
        }
        return 0;
    }
}
