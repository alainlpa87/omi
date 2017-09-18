<?php namespace App\Models;

use Illuminate\Support\Facades\Config;
use Illuminate\Database\Eloquent\Model;


class Inbox extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'inbox';

    /**
     * The attributes that are mass assignable.
     * subject [CLIENT TEXT, PAYMENT, FILE UPLOADED]
     * @var array
     */
    protected $fillable = ['lead_id','consultant_id', 'message','subject','status','finish','createdBy'];

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
    public function contact()
    {
        if($this->lead_id!=0)
            return $this->belongsTo('App\Models\Lead');
        return null;
    }
    public function consultant()
    {
        if($this->consultant_id!=0)
            return $this->belongsTo('App\Models\Consultant');
        return null;
    }

    public static function createInbox($lead, $consultant, $text, $subject, $createdBy){
        $msg = new Inbox();
        $msg->consultant_id = $consultant;
        $msg->lead_id = $lead;
        $msg->message = $text;
        $msg->subject = $subject;
        $msg->createdBy = $createdBy;
        $msg->save();
        return $msg->id;
    }
}
