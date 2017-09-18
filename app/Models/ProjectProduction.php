<?php namespace App\Models;
use Illuminate\Auth\Authenticatable;
use Illuminate\Support\Facades\Config;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class ProjectProduction extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'project_production';

    /**
     * The attributes that are mass assignable.
     *
     * letterofengagement: 0 no enviado,1 enviado, 2 recivido
     *
     * @var array
     */

    protected $fillable = ['consultant_id','project_id','fileno','typeVendor','completed','completedDate','attorney_id','writer_id','university_id','designer_id','designer2d_id','sendDate','contractType','returnedReason','sendDateIMG','scheduleDate','shippingDate','paidDate','letterofengagement','sent_letterofeng'];

    /**
     * Create a new Eloquent model instance.
     *
     * @param array $attributes
     * @return mixed
     */
    //completed = 1 -> Completed by  vendors, completed = 2 -> returned by production, completed = 3 -> project late, completed = 4 project finished
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

    }
    //return the consultant owner of this project in production
    public function consultant()
    {
        if($this->consultant_id!=0)
            return $this->belongsTo('App\Models\Consultant');
        return null;
    }
    //return the project in Production
    public function project()
    {
        if($this->project_id!=0)
            return $this->belongsTo('App\Models\Project');
        return null;
    }
    //return 1 if all the rows for this projects except the one for production are complete
    public function IsAllComplete()
    {
        $rows = ProjectProduction::where('project_id',$this->project_id)->where('typeVendor','<>','production')->get();
        foreach($rows as $row)
        {
            if($row->completed == 0)
                return 0;
        }
        if(count($rows)<=1)
            return 0;
        return 1;
    }


    public function returnedTo()
    {
        $rows = ProjectProduction::where('project_id',$this->project_id)->where('typeVendor','<>','production')->get();
        $returned="";
        foreach($rows as $row)
        {
            if($row->completed == 2)
                $returned.=strlen($returned)>0?", ".$row->typeVendor:$row->typeVendor;
        }
        return $returned;
    }
    public function returnedReasonTo()
    {
        $rows = ProjectProduction::where('project_id',$this->project_id)->where('typeVendor','<>','production')->get();
        $returned="";
        foreach($rows as $row)
        {
            if($row->completed == 2)
                $returned.=strlen($returned)>0?", ".$row->returnedReason:$row->returnedReason;
        }
        return $returned;
    }
    public function attorney()
    {
        if($this->attorney_id>0)
            return Consultant::find($this->attorney_id);
        return null;
    }
    public function writer()
    {
        if($this->writer_id>0)
            return Consultant::find($this->writer_id);
        return null;
    }
    public function designer()
    {
        if($this->designer_id>0)
            return Consultant::find($this->designer_id);
        return null;
    }
    public function designer2d()
    {
        if($this->designer2d_id>0)
            return Consultant::find($this->designer2d_id);
        return null;
    }
    public function university()
    {
        if($this->university_id>0)
            return Consultant::find($this->university_id);
        return null;
    }
    public function overdueBy()
    {
        $rows = ProjectProduction::where('project_id',$this->project_id)->where('typeVendor','<>','production')->get();
        $overdue="";
        foreach($rows as $row)
        {
            if($row->completed == 3)
                $overdue.=strlen($overdue)>0?", ".$row->typeVendor:$row->typeVendor;
        }
        return $overdue;
    }
}
