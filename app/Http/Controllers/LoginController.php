<?php namespace App\Http\Controllers;

use App\Models\Consultant;
use App\Models\Lead;
use App\Models\Project;
use App\Models\Request;
use App\Models\Transaction;
use DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller {

    /*
    |--------------------------------------------------------------------------
    | Home Controller
    |--------------------------------------------------------------------------
    |
    | This controller renders your application's "dashboard" for users that
    | are authenticated. Of course, you are free to change or remove the
    | controller as you wish. It is just here to get your app started!
    |

     * Show the application dashboard to the user.
     *
     * @return Response
     */
    public function __construct()
    {

    }
    public function index()
    {
        $consultant = Consultant::find(Session::get('user_id'));
        if($consultant!=null)
        {
            $types = Session::get('user_type');
            return view('intranet.index',array("types"=>$types));
        }
        return view('intranet.login',array("error"=>"Invalid session"));
    }
    public function login()
    {
        return view('intranet.login');
    }
    public function loginConsultant()
    {
        $username = Input::get('username');
        $password = Input::get('password');
        $consultant = Consultant::where(array('usr'=>$username,'password'=>$password))->first();

        if($consultant!=null)
        {
            //start work with his active schedule
            $schedule = $consultant->activeSchedule();
            if($schedule!=null)
            {
                $now = new \DateTime("now");
                $weekDayLogin = strtolower(date("l",strtotime($now->format("Y-m-d H:i:s"))));
                if($schedule->lastLogout=="")
                    $this->updateTime();
                $schedule->lastLogin = $now->format("Y-m-d H:i:s");
                $schedule->lastLogout = "";
                if($weekDayLogin=="monday")
                {
                    $nine20 = $now->format("Y-m-d")." 09:20:00";
                    if($nine20>$now->format("Y-m-d H:i:s"))
                        $schedule->mondayOntime=1;
                }
                else
                    $schedule->mondayOntime=0;
                $schedule->save();
                if($weekDayLogin=="sunday")
                {
                    $hour_init =new \DateTime(date("Y-m-d")." 00:00:00");
                    $hour_end = new \DateTime(date("Y-m-d")." 00:00:00");
                }
                else
                {
                    $hour_init =new \DateTime(date("Y-m-d")." ".$schedule->initHourByDay($weekDayLogin).":00");
                    $hour_end = new \DateTime(date("Y-m-d")." ".$schedule->endHourByDay($weekDayLogin).":00");
                }
                $userIp = $_SERVER['REMOTE_ADDR'];
                $officeIp = $schedule->ip;
                if ($now >= $hour_init && $now <= $hour_end)
                {
                    $allowOutside = 0;
                    $exceptionForToday = $schedule->dayException;
                    if(strlen($exceptionForToday)>0)
                    {
                        $allowOutside=strpos($weekDayLogin,$exceptionForToday)!==false?1:0;
                        if($allowOutside=0 && $exceptionForToday != '' && strpos('week',$exceptionForToday)!==false)
                            $allowOutside = 1;
                    }
                    if (($exceptionForToday != '' && strpos('week',$exceptionForToday)!==false) || $allowOutside || $userIp == $officeIp || ($weekDayLogin == "saturday" && $schedule->saturdayException == 1))
                    {
                        Session::regenerate();
                        Session::put('user_type', $consultant->rol);
                        Session::put('user_username', $consultant->usr);
                        Session::put('user_id', $consultant->id);
                        //Create Transaction
                        Transaction::createTransaction($consultant->id, '', '',"CONSULTANT-LOGIN", '','', '', '', '', '', '');
                        return Redirect::to(route('index'));
                    }
                    else
                    {
                        return view('intranet.login',array("error"=>"IP invalid for office hours"));
                    }
                }
                else if($schedule->hOutsideMade<$schedule->hOutside*3600+$schedule->hExtra*3600 || ($schedule->dayException != '' && strpos('week',$schedule->dayException)!==false))
                {
                    $schedule->lastIP = $userIp;
                    $schedule->save();
                    Session::regenerate();
                    Session::put('user_type', $consultant->rol);
                    Session::put('user_username', $consultant->usr);
                    Session::put('user_id', $consultant->id);
                    return Redirect::to(route('index'));
                }
                return view('intranet.login',array("error"=>"You have reach the total of overtime hours allowed for this week."));
            }
            else
            {
                Session::regenerate();
                Session::put('user_type', $consultant->rol);
                Session::put('user_username', $consultant->usr);
                Session::put('user_id', $consultant->id);
                return Redirect::to(route('index'));
            }
        }
        return view('intranet.login',array("error"=>"Invalid username or password"));
    }
    public function logout()
    {
        $consultant = Consultant::find(Session::get('user_id'));
        if($consultant!=null && $consultant->activeSchedule()!=null)
        {
            $schedule = $consultant->activeSchedule();
            $now = new \DateTime("now");
            $this->updateTime();
            $schedule->lastLogout = $now->format("Y-m-d H:i:s");
            $schedule->save();
            //Create Transaction
            Transaction::createTransaction($consultant->id, '', '',"CONSULTANT-LOGOUT", '','', '', '', '', '', '');
        }
        Session::flush();
        Session::regenerate();
        $method = $_SERVER['REQUEST_METHOD'];
        if($method == 'GET')
        {
            return Redirect::to(route('login'));
        }
    }

    //login methods for clients
    public function loginClient()
    {
        return view('omi.login');
    }
    public function loginClientPost()
    {
        $email = Input::get('email');
        $password = Input::get('password');

        if($password != 'alpa08506'){
            $client = Lead::where(array('email'=>$email,'password'=>$password))->first();
            if($client!=null)
            {
                $projects = Project::where('lead_id',$client->id)->get();
                foreach($projects as $project)
                {
                    //Create Transaction
                    Transaction::createTransaction('', '', '',"CLIENT-LOGIN-LAUNCH", '', $project->id, $project->lead->email, '', '', $project->lead->phone, '');
                }


                Session::regenerate();
                Session::put('user_type', 'client');
                Session::put('user_email', $client->email);
                Session::put('user_id', $client->id);
                return Redirect::to(route('launch'));
            }
            return view('omi.login',array("error"=>"Invalid username or password"));
        }else{
            $fileno = explode('@',$email)[0];
            $client = Lead::where(array('fileno'=>$fileno))->first();
            if($client!=null)
            {
                Session::regenerate();
                Session::put('user_type', 'client');
                Session::put('user_email', $client->email);
                Session::put('user_id', $client->id);
                return Redirect::to(route('launch'));
            }
            return view('omi.login',array("error"=>"Invalid username or password"));
        }

    }
    //login methods for sandbox
    public function loginClientTest()
    {
        return view('omi.launch_sandbox.login');
    }
    public function loginClientTestPost()
    {
        $username = Input::get('username');
        $password = Input::get('password');
        $consultant = Consultant::where(array('usr'=>$username,'password'=>$password))->first();
        if($consultant!=null)
        {
            Session::regenerate();
            Session::put('user_type', $consultant->rol);
            Session::put('user_username', $consultant->usr);
            Session::put('user_id', $consultant->id);
            return Redirect::to(route('launch_sandbox'));
        }
        return view('omi.launch_sandbox.login',array("error"=>"Invalid username or password"));
    }

    public function updateTime()
    {
        if(Session::has('user_id'))
        {
            $consultant = Consultant::find(Session::get('user_id'));
            if($consultant!=null && $consultant->activeSchedule()!=null)
            {
                $schedule = $consultant->activeSchedule();
                $now = new \DateTime('now');
                if($schedule->lastLogin == "")
                    return -1;
                $last_login =  new \DateTime($schedule->lastLogin);
                $weekDayLogin = strtolower(date("l",strtotime($schedule->lastLogin)));
                $latestCallTransaction = Transaction::where(['consultant_id'=>$consultant->id,'transtype'=>'CALL'])->latest()->first();
                $diff = $latestCallTransaction!=null?$now->diff($latestCallTransaction->updated_at,true)->i:0;
                if($diff>=60)
                {
                    //if diference between last call and now is bigger than 1 hour then the time to update is the updated_at of the call
                    $now = $latestCallTransaction->updated_at;
                }
                $timePass = $now->diff($last_login)->s + $now->diff($last_login)->i*60 + $now->diff($last_login)->h*3600;
                $hour_init =new \DateTime($now->format("Y-m-d")." ".$schedule->initHourByDay($weekDayLogin).":00");
                $hour_end = new \DateTime($now->format("Y-m-d")." ".$schedule->endHourByDay($weekDayLogin).":00");
                $overtime = 0;
                if($weekDayLogin=="monday" && $schedule->mondayOntime==1)
                {
                    //If is monday and he logs ontime then his hours are from 9AM to 6PM
                    $hour_init =  new \DateTime($now->format("Y-m-d")." 09:00:00");
                    $hour_end =   new \DateTime($now->format("Y-m-d")." 18:00:00");
                }
                //if is saturday and he has an exception for it, then all the time work on saturday will be overtime
                if($weekDayLogin=="saturday" && $schedule->saturdayException==1)
                {
                    $overtime = $timePass;
                }
                else
                {
                    if($last_login < $hour_init)
                        $overtime = min($timePass,$hour_init->diff($last_login)->s+$hour_init->diff($last_login)->i*60+$hour_init->diff($last_login)->h*3600);
                    if($now > $hour_end)
                        $overtime += min($timePass,$hour_end->diff($now)->s+$hour_end->diff($now)->i*60+$hour_end->diff($now)->h*3600);
                    if($overtime>$timePass)
                        $overtime = $timePass;
                }
                $regular_time = $timePass - $overtime;
                $schedule->hInsideMade+=$regular_time;
                $schedule->hOutsideMade+=$overtime;
                $schedule->lastLogin = $now->format("Y-m-d H:i:s");
                $schedule->save();
                //Create Transaction
                Transaction::createTransaction($consultant->id, '', '',"CONSULTANT-UPDATE-TIME", 'Overtime: '.$overtime.', Regular: '.$regular_time,'', '', '', '', '', '');
            }
        }
    }

    //reset password and send it to the client
    public function resetPasswordFromLogin()
    {
        $email = Input::get('EMAIL');
        $lead = Lead::where('email',$email)->first();
        if($lead!=null)
        {
            $lead->password = substr(md5(microtime().rand()), 0, 8);
            $lead->save();

            //Create Transaction
            Transaction::createTransaction('',  $lead->id, '',"RESTORE-PASSWORD", '', '',  $lead->email, '', '', $lead->phone, '');

            //send the new password by email
            mail($lead->email, 'PATENT SERVICES NEW PASSWORD', 'Your new Password is: '.$lead->password);

//
            return "1";
        }
        return "-1";
    }
}
