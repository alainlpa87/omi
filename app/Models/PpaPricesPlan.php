<?php namespace App\Models;

use Illuminate\Support\Facades\Config;
use Illuminate\Database\Eloquent\Model;


class PpaPricesPlan extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'ppapricesplan';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['type','moment', 'plan1','plan2','plan3','plan4','plan5','plan6','plan7','plan8'];

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

    //return the investment protection of the contract
    public function getInvestmentProtection($price)
    {
        switch($price){
            case $this->plan1:
                return $this->plan4;
            case $this->plan2:
                return $this->plan5;
            case $this->plan3:
                return $this->plan6;
        }
    }
}
