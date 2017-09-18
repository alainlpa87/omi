<?php namespace App\Http\Controllers;


use App\Models\Consultant;
use App\Models\Inbox;
use App\Models\RecordCalls;
use Illuminate\Support\Facades\Input;
use DB;
use Illuminate\Support\Facades\Session;


class CallController extends Controller {

    /*
     * Current Consultant logged
     */
    public $consultant;
    /*
     * To Allow use the controller methods the current user logged has to be Client
     */
    public function __construct()
    {
        $this->middleware('consultant');
        $this->middleware(function ($request, $next) {
            $this->consultant = Consultant::find(Session::get('user_id'));

            return $next($request);
        });
    }

    //sign contract
    public function index()
    {
        $rolLibrary =0;
        if(strpos(Session::get('user_type'), 'library')!== false){
            $calls = RecordCalls::all();
            $rolLibrary =1;
        }
        else
            $calls = RecordCalls::where('library',1)->get();

        $total_inbox = Inbox::where(['consultant_id'=>$this->consultant->id,'status'=>0])->count();
//        $training = scandir(url('training'));
        return view("intranet.recordCalls",array('consultant'=>$this->consultant,'total_inbox'=>$total_inbox,'records'=>$calls,'rolLibrary'=>$rolLibrary));//, 'trainingDocs'=>$training
    }

    public function changeLibrary(){
        $value =Input::get('VALUE');
        $lid =Input::get('LIBRARY');
        $recordCall = RecordCalls::find($lid);
        if($recordCall == null)
            return -1;
        $recordCall->library = $value;
        $recordCall->save();
        return 1;
    }

    public function changeDescription(){
        $value =Input::get('VALUE');
        $lid =Input::get('LIBRARY');
        $recordCall = RecordCalls::find($lid);
        if($recordCall == null)
            return -1;
        $recordCall->description = $value;
        $recordCall->save();
        return 1;
    }

}