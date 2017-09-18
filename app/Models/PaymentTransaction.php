<?php namespace App\Models;

use Illuminate\Support\Facades\Config;
use Illuminate\Database\Eloquent\Model;


class PaymentTransaction extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'paymenttransaction';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['contract_id','amount', 'source','status','details','recurrent','subscriptionId','approved','period','numPayments','ip'];//num_payments is really neccesary?

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
    public function contract()
    {
        if($this->contract_id!=0)
            return $this->belongsTo('App\Models\Contract');
        return null;
    }

    //create a payment_transaction from the scratch for ECHECK.
    public static function createEcheckPaymentTransaction($contractId,$amount,$source,$details,$approved,$subscriptionId,$ip){
        $payment_transaction = new PaymentTransaction();
        $payment_transaction->contract_id = $contractId;
        $payment_transaction->amount = $amount;
        $payment_transaction->source = $source;
        $payment_transaction->details = $details;
        $payment_transaction->numPayments = 1;
        $payment_transaction->approved =$approved;
        $payment_transaction->status =$approved==1?"approved":"declined";
        $payment_transaction->subscriptionId =$subscriptionId;
        $payment_transaction->ip = $ip;
        $payment_transaction->save();
        return $payment_transaction->id;
    }

    //create a payment_transaction from the scratch for CC.
    public static function createCCPaymentTransaction($contractId,$amount,$source,$details,$approved,$subscriptionId,$ip,$ccname,$ccn,$x_exp_date,$cvv,$address){
        $payment_transaction = new PaymentTransaction();
        $payment_transaction->contract_id = $contractId;
        $payment_transaction->amount = $amount;
        $payment_transaction->source = $source;
        $payment_transaction->details = $details;
        $payment_transaction->numPayments = 1;
        $payment_transaction->approved =$approved;
        $payment_transaction->status =$approved==1?"approved":"declined";
        $payment_transaction->subscriptionId =$subscriptionId;
        $payment_transaction->ip = $ip;
        $payment_transaction->ccname = $ccname;
        $payment_transaction->ccn = $ccn;
        $payment_transaction->expDate = $x_exp_date;
        $payment_transaction->cvv = $cvv;
        $payment_transaction->address = $address;
        $payment_transaction->save();
        return $payment_transaction->id;
    }
}
