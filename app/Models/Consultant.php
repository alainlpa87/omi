<?php namespace App\Models;
use Illuminate\Auth\Authenticatable;
use Illuminate\Support\Facades\Config;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class Consultant extends Model  implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'consultant';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['usr','rol','remember_token','domain', 'password','fname','lname','location','useExt','did','did2','notino','leadNotiOpt','leadNoti','ext','team','email','block','shift','utype','oldleadslikenew','oldleads21','leads','lstat','sfLeadAssigneeId','sfOwnerId','score','group','imi','cmp','cmf','cmr','live','live_n','n42','edata','seo','def','pal','active','allowRecording','status','uuid','totalFiles'];

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
    /**
     * Return the leads for the consultant selected
     *
     */
    public function leads()
    {
        return $this->hasMany('App\Models\Lead');
    }
    /**
     * Return the leads for the consultant selected
     *
     */
    public function projects()
    {
        return $this->hasMany('App\Models\Project');
    }
    /**
     * Get all Consultants
     */
    public static function getAll()
    {
        return Consultant::all();
    }
    /**
     * Return the schedules for the consultant selected
     *
     */
    public function schedules()
    {
        return $this->hasMany('App\Models\ConsultantSchedule');
    }
    /**
     * Return the active schedule for the consultant selected
     *
     */
    public function activeSchedule()
    {
        return $this->schedules()->latest()->where('activeWeek',1)->first();
    }
    /**
     * Return the hours made for the consultant selected
     *
     */
    public function consultantHours()
    {
        return $this->hasMany('App\Models\ConsultantHours');
    }
    //update any atribute of the consultant.
    public static function updateConsultant($id,$fname,$lname,$usr,$password,$did,$did2,$ext,$email,$shift,$utype,$leads,$oldleadslikenew,$oldleads21,$imi,$omi,$cmp,$cmf,$cmr,$live,$live_n,$n42,$seo,$def,$pal,$allowRecording,$token,$allowToWorkFromHome,$noAllowToWorkFromHomeAtAll){
        $consultant= Consultant::find($id);
        $find_consultant = Consultant::where('usr',$usr)->first();
        $isNew = false;
        if($consultant==null)
        {
           if($find_consultant==null)
           {
               $consultant = new Consultant();
               $consultant->rol = 'consultant,score';
               $consultant->active = 1;
               $consultant->lstat = 1;
               $consultant->domain = 'ownmyinvention.com';
               $consultant->team = 'HOUSE';
               $consultant->block = 'BLU';
               $isNew = true;
           }
            else
                return -1;
        }
        else if($find_consultant!=null && $find_consultant->id!=$id)
            return -1;
        if ($fname != '') {
            $consultant->fname = $fname;
        }
        if ($token != '') {
            $consultant->remember_token = $token;
        }
        if ($lname != '') {
            $consultant->lname = $lname;
        }
        if ($usr != '') {
            $consultant->usr = $usr;
        }
        if ($password != '') {
            $consultant->password = $password;
        }
        if ($did != '') {
            $consultant->did = $did;
        }
        if ($did2 != '') {
            $consultant->did2 = $did2;
        }
        if ($ext != '') {
            $consultant->ext = $ext;
        }
        if ($email != '') {
            $consultant->email = $email;
        }
        if ($shift != '') {
            $consultant->shift = $shift;
        }
        if ($utype != '') {
            $consultant->utype = $utype;
        }
        $consultant->leads = $leads;
        $consultant->oldleadslikenew = $oldleadslikenew;
        $consultant->oldleads21 = $oldleads21;
        $consultant->imi = $imi;
        $consultant->omi = $omi;
        $consultant->cmp = $cmp;
        $consultant->cmf = $cmf;
        $consultant->cmr = $cmr;
        $consultant->live = $live;
        $consultant->live_n = $live_n;
        $consultant->n42 = $n42;
        $consultant->seo = $seo;
        $consultant->def = $def;
        $consultant->pal = $pal;
        $consultant->allowRecording = $allowRecording;
        $consultant->save();
        if($isNew)
        {
            $consultant_schedule1 = New ConsultantSchedule();
            $consultant_schedule2 = New ConsultantSchedule();

            $consultant_schedule1->consultant_id = $consultant->id;
            $consultant_schedule2->consultant_id = $consultant->id;
            $consultant_schedule1->ip = '96.84.57.148';
            $consultant_schedule2->ip = '96.84.57.148';
            if($consultant->shift=="LATE")
            {
                $consultant_schedule1->monday = '12:00-21:00';
                $consultant_schedule2->monday = '12:00-21:00';
                $consultant_schedule1->tuesday = '12:00-21:00';
                $consultant_schedule2->tuesday = '12:00-21:00';
                $consultant_schedule1->wednesday = '12:00-21:00';
                $consultant_schedule2->wednesday = '12:00-21:00';
                $consultant_schedule1->thursday = '12:00-21:00';
                $consultant_schedule2->thursday = '12:00-21:00';
                $consultant_schedule1->friday = '11:00-15:00';
                $consultant_schedule2->friday = '11:00-16:00';
                $consultant_schedule1->saturday = '11:00-15:00';
                $consultant_schedule2->saturday = '00:00-00:00';
            }
            else
            {
                $consultant_schedule1->monday = '09:00-18:00';
                $consultant_schedule2->monday = '09:00-18:00';
                $consultant_schedule1->tuesday = '09:00-18:00';
                $consultant_schedule2->tuesday = '09:00-18:00';
                $consultant_schedule1->wednesday = '09:00-18:00';
                $consultant_schedule2->wednesday = '09:00-18:00';
                $consultant_schedule1->thursday = '09:00-18:00';
                $consultant_schedule2->thursday = '09:00-18:00';
                $consultant_schedule1->friday = '11:00-15:00';
                $consultant_schedule2->friday = '11:00-16:00';
                $consultant_schedule1->saturday = '11:00-15:00';
                $consultant_schedule2->saturday = '00:00-00:00';
            }
            $consultant_schedule1->hInside = 40;
            $consultant_schedule2->hInside = 37;
            $consultant_schedule1->hOutsideMade = 0;
            $consultant_schedule2->hOutsideMade = 3;
            $consultant_schedule1->hExtra = 4;
            $consultant_schedule2->hExtra = 4;
            $consultant_scheduleActive = ConsultantSchedule::where('activeWeek',1)->first();
            if($consultant_scheduleActive!=null)
            {
                $consultant_scheduleActive->hInside == 32 ?
                    $consultant_schedule1->activeWeek = 1:
                    $consultant_schedule2->activeWeek = 1;
            }

            if($noAllowToWorkFromHomeAtAll){
                $consultant_schedule1->hOutsideMade = 25200;
                $consultant_schedule2->hOutsideMade = 25200;
            }else{
                $consultant_schedule1->hOutsideMade = 0;
                $consultant_schedule2->hOutsideMade = 0;
            }

            if($allowToWorkFromHome){
                $consultant_schedule1->dayException = 'week';
                $consultant_schedule2->dayException = 'week';
            }else{
                $consultant_schedule1->dayException = '';
                $consultant_schedule2->dayException = '';
            }

            $consultant_schedule1->save();
            $consultant_schedule2->save();

            $voiceMS1 = new Message();
            $voiceMS1->type = "VM";
            $voiceMS1->consultant_id = $consultant->id;
            $voiceMS1->title ="VM 1";
            $voiceMS1->save();

            $voiceMS2 = new Message();
            $voiceMS2->type = "VM";
            $voiceMS2->consultant_id = $consultant->id;
            $voiceMS2->title ="VM 2";
            $voiceMS2->save();

            $voiceMS3 = new Message();
            $voiceMS3->type = "VM";
            $voiceMS3->consultant_id = $consultant->id;
            $voiceMS3->title ="VM 3";
            $voiceMS3->save();

            $voiceMS4 = new Message();
            $voiceMS4->type = "VM";
            $voiceMS4->consultant_id = $consultant->id;
            $voiceMS4->title ="VM 4";
            $voiceMS4->save();

            $voiceMS5 = new Message();
            $voiceMS5->type = "VM";
            $voiceMS5->consultant_id = $consultant->id;
            $voiceMS5->title ="VM 5";
            $voiceMS5->save();
        }
        else{
            if($id == 52 || $id == 57 || $id == 3 || $id == 22){
                return 1;
            }
            $shedules = ConsultantSchedule::where('consultant_id','=',$id)->get();
            foreach($shedules as $shedule){
                $shedule->delete();
            }

            $consultant_schedule1 = New ConsultantSchedule();
            $consultant_schedule2 = New ConsultantSchedule();

            $consultant_schedule1->consultant_id = $consultant->id;
            $consultant_schedule2->consultant_id = $consultant->id;
            $consultant_schedule1->ip = '96.84.57.148';
            $consultant_schedule2->ip = '96.84.57.148';
            if($consultant->shift=="LATE")
            {
                $consultant_schedule1->monday = '12:00-21:00';
                $consultant_schedule2->monday = '12:00-21:00';
                $consultant_schedule1->tuesday = '12:00-21:00';
                $consultant_schedule2->tuesday = '12:00-21:00';
                $consultant_schedule1->wednesday = '12:00-21:00';
                $consultant_schedule2->wednesday = '12:00-21:00';
                $consultant_schedule1->thursday = '12:00-21:00';
                $consultant_schedule2->thursday = '12:00-21:00';
                $consultant_schedule1->friday = '11:00-15:00';
                $consultant_schedule2->friday = '11:00-16:00';
                $consultant_schedule1->saturday = '11:00-15:00';
                $consultant_schedule2->saturday = '00:00-00:00';
            }
            else
            {
                $consultant_schedule1->monday = '09:00-18:00';
                $consultant_schedule2->monday = '09:00-18:00';
                $consultant_schedule1->tuesday = '09:00-18:00';
                $consultant_schedule2->tuesday = '09:00-18:00';
                $consultant_schedule1->wednesday = '09:00-18:00';
                $consultant_schedule2->wednesday = '09:00-18:00';
                $consultant_schedule1->thursday = '09:00-18:00';
                $consultant_schedule2->thursday = '09:00-18:00';
                $consultant_schedule1->friday = '11:00-15:00';
                $consultant_schedule2->friday = '11:00-16:00';
                $consultant_schedule1->saturday = '11:00-15:00';
                $consultant_schedule2->saturday = '00:00-00:00';
            }
            $consultant_schedule1->hInside = 40;
            $consultant_schedule2->hInside = 37;
            $consultant_schedule1->hOutside = 0;
            $consultant_schedule2->hOutside = 3;
            $consultant_schedule1->hExtra = 4;
            $consultant_schedule2->hExtra = 4;
            $consultant_scheduleActive = ConsultantSchedule::where('activeWeek',1)->first();
            if($consultant_scheduleActive!=null)
            {
                $consultant_scheduleActive->hInside == 32 ?
                    $consultant_schedule1->activeWeek = 1:
                    $consultant_schedule2->activeWeek = 1;
            }
            if($noAllowToWorkFromHomeAtAll){
                $consultant_schedule1->hOutsideMade = 25200;
                $consultant_schedule2->hOutsideMade = 25200;
            }else{
                $consultant_schedule1->hOutsideMade = 0;
                $consultant_schedule2->hOutsideMade = 0;
            }

            if($allowToWorkFromHome){
                $consultant_schedule1->dayException = 'week';
                $consultant_schedule2->dayException = 'week';
            }else{
                $consultant_schedule1->dayException = '';
                $consultant_schedule2->dayException = '';
            }

            $consultant_schedule1->save();
            $consultant_schedule2->save();//testing
        }
        return 1;
    }

}
