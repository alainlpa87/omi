<?php namespace App\Http\Controllers;

use App\Models\Consultant;
use App\Models\ConsultantSchedule;
use App\Models\Inbox;
use DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class SuperAdminController extends Controller {

    /*
     * Current Consultant logged
     */
    public $consultant;
    /*
     * To Allow use the controller methods the current user logged has to be Consultant
     */
    public function __construct()
    {
        $this->middleware('statistics');
        $this->middleware(function ($request, $next) {
            $this->consultant = Consultant::find(Session::get('user_id'));
            return $next($request);
        });
    }
    /*
     * Send to the index view the request from consultants to send contracts or approve projects
     *
     * @return Response
     */
    public function index(){
        $consultants = Consultant::where('rol','LIKE','%consultant%')->where('id','!=',16)->where('id','!=',3)->get();
        $total_inbox = Inbox::where(['consultant_id'=>$this->consultant->id,'status'=>0])->count();
        return view('intranet.superadmin.index',array('consultant'=>$this->consultant,'total_inbox'=>$total_inbox,'consultants'=>$consultants));
    }
    //searh a consultant in the DB an send it to the view
    public function loadDataConsultant()
    {
        $id = Input::get('ID');
        $consultant = Consultant::find($id);
        if($consultant!=null)
        {
            $data = array();
            $data['consultant'] = $consultant;
            $data['shedule'] = -1;
            $shedule = ConsultantSchedule::where('consultant_id','=',$id)->where('activeWeek',1)->first();
            if($shedule!=null){
                $data['shedule'] = $shedule;
            }
            return json_encode($data);
        }
        return "-1";
    }
    //update a consultant in the DB
    public function updateDataConsultant()
    {
        $id = Input::get('ID');
        $fname = Input::get('FNAME');
        $lname = Input::get('LNAME');
        $usr = Input::get('USR');
        $password = Input::get('PASSWORD');
        $did = Input::get('DID');
        $did2 = Input::get('DID2');
        $ext = Input::get('EXT');
        $email = Input::get('EMAIL');
        $shift = Input::get('SHIFT');
        $utype = Input::get('TYPE');
        $leads = Input::get('LEADS');
        $oldleadslikenew = Input::get('OLDLEADS');
        $oldleads21 = Input::get('OLDLEADS21');
        $imi = Input::get('IMI');
        $omi = Input::get('OMI');
        $cmp = Input::get('CMP');
        $cmf = Input::get('CMF');
        $cmr = Input::get('CMR');
        $live = Input::get('LIVE');
        $live_n = Input::get('LIVE_N');
        $n42 = Input::get('N42');
        $seo = Input::get('SEO');
        $def = Input::get('DEF');
        $pal = Input::get('PAL');
        $token = Input::get('TOKEN');
        $allowRecording = Input::get('ALLOWRECORDING');
        $allowToWorkFromHome = Input::get('WORKFROMHOMEOFFICEHOURS');
        $noAllowToWorkFromHomeAtAll = Input::get('NOTALLOWTOWORKFROMHOMEATALL');
        $result = Consultant::updateConsultant($id,$fname,$lname,$usr,$password,$did,$did2,$ext,$email,$shift,$utype,$leads,$oldleadslikenew,$oldleads21,$imi,$omi,$cmp,$cmf,$cmr,$live,$live_n,$n42,$seo,$def,$pal,$allowRecording,$token,$allowToWorkFromHome,$noAllowToWorkFromHomeAtAll);
        if($result==1)
            return "1";
        return "-1";
    }
}
