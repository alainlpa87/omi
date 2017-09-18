<?php namespace App\Models;

use Illuminate\Support\Facades\Config;
use Illuminate\Database\Eloquent\Model;


class Transaction extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'transaction';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['project_id', 'lead_id','consultant_id', 'transtype', 'email', 'phone','amount', 'contractType', 'payPostedBy', 'params','uuid'];

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
    public function consultant()
    {
        if($this->consultant_id!=0)
            return $this->belongsTo('App\Models\Consultant');
        return null;
    }
    public function lead()
    {
        if($this->lead_id!=0)
            return $this->belongsTo('App\Models\Lead');
        return null;
    }
    public function project()
    {
        if($this->project_id!=0)
            return $this->belongsTo('App\Models\Project');
        return null;
    }
    public static function createTransaction($consultant, $lead, $uuid, $transtype, $params, $project_id, $email, $contractType, $payPostedBy, $phone, $amount){
        $transaction = new Transaction();
        $consultant != ''?$transaction->consultant_id = $consultant:'';
        $lead != ''?$transaction->lead_id = $lead:'';
        $transaction->uuid = $uuid;
        $transaction->transtype = $transtype;
        $transaction->params = $params;
        $project_id != ''?$transaction->project_id = $project_id:'';
        $transaction->email = $email;
        $transaction->contractType = $contractType;
        $transaction->payPostedBy = $payPostedBy;
        $transaction->phone = $phone;
        $amount != ''?$transaction->amount = $amount:'';
        $transaction->save();
        return $transaction->id;
    }
}
