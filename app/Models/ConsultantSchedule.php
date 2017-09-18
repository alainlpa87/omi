<?php namespace App\Models;
use Illuminate\Auth\Authenticatable;
use Illuminate\Support\Facades\Config;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class ConsultantSchedule extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'consultant_schedule';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['consultant_id','ip','lastIP','lastLogin','lastLogout','monday','tuesday', 'wednesday','thursday',
        'friday','saturday','mondayOntime','saturdayException','hInside','hOutside','hExtra','hInsideMade','hOutsideMade','activeWeek','dayException'];

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
    //return the consultant owner of this schedule
    public function consultant()
    {
        if($this->consultant_id!=0)
            return $this->belongsTo('App\Models\Consultant');
        return null;
    }
    public function initHourByDay($day)
    {
        $hours = explode('-',$this->$day);
        return $hours[0];
    }
    public function endHourByDay($day)
    {
        $hours = explode('-',$this->$day);
        return $hours[1];
    }
}
