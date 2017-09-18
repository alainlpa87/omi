<?php namespace App\Models;

use Illuminate\Support\Facades\Config;
use Illuminate\Database\Eloquent\Model;


class UploadedFiles extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'uploadedfiles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['project_id', 'manufacturer_id','url', 'fileName', 'internal','public','vendor','clientVendor','attorney','admin_id','filingReceipt','university','designer','writer','2d','ilc','ilcVendors','ip'];

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
}
