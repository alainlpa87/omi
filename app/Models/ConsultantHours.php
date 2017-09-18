<?php namespace App\Models;
use Illuminate\Auth\Authenticatable;
use Illuminate\Support\Facades\Config;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class ConsultantHours extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'consultant_hours';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['consultant_id','hInsideMade','hOutsideMade'];

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
}
