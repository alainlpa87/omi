<?php namespace App\Models;

use Illuminate\Support\Facades\Config;
use Illuminate\Database\Eloquent\Model;


class Board extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'board';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['consultant','calls', 'subs', 'cont', 'ph1', 'img','lastUpdate','month','year'];

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
}
