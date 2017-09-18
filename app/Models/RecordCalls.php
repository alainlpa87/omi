<?php namespace App\Models;

use Illuminate\Support\Facades\Config;
use Illuminate\Database\Eloquent\Model;


class RecordCalls extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'recordcalls';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['consultant_id', 'lead_id', 'uuid','recordId','url','library','description'];

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
        return $this->belongsTo('App\Models\Consultant');
    }

    public function lead()
    {
        return $this->belongsTo('App\Models\Lead');
    }
}
