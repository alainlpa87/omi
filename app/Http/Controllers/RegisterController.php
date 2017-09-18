<?php namespace App\Http\Controllers;



use App\Models\Lead;
use App\Models\Transaction;
use Illuminate\Support\Facades\Input;

class RegisterController extends Controller {


    public function __construct(){}

    //Send to Register view
    public function index(){
        $values = array();
        if(Input::has("FNAME"))
            $values['fname'] = Input::get("FNAME");
        if(Input::has("LNAME"))
            $values['lname'] = Input::get("LNAME");
        if(Input::has("EMAIL")){
            $values['email'] = Input::get("EMAIL");
            $email = Input::get("EMAIL");
        }

        if(Input::has("PHONE")){
            $values['phone'] = str_pad(preg_replace('/\D+/', '', Input::get("PHONE")), 11, '1', STR_PAD_LEFT);
            $phone=str_pad(preg_replace('/\D+/', '', Input::get("PHONE")), 11, '1', STR_PAD_LEFT);
        }

        if(Input::has("CATEGORY"))
            $values['category'] = Input::get("CATEGORY");
        if(Input::has("PATENT"))
            $values['patent'] = Input::get("PATENT");
        if(Input::has("ARELEAST18"))
            $values['areLeast18'] = Input::get("ARELEAST18");

        if(Input::has("PHONE") && Input::has("EMAIL")) {
            $lead = Lead::where('email', 'like', $email)->orWhere('phone', 'like', $phone)->orWhere('phone2', 'like', $phone)->first();
            if ($lead != null) {
                //create Transaction for Update Lead When Repeated.
                Transaction::createTransaction('', $lead->id, '', 'LEAD-UPDATE-REPEATED-REGISTER', '', '', $email, '', '', $phone, '');
                return view('omi.project.index');
            }else{
                return view('omi.register',$values);
            }
        }
        return view('omi.register',$values);

    }

    //save the password after create the lead
    public function savePassRegister(){
        $leadId = Input::get("LEAD");
        $pass = Input::get("PASSWORD");
        $category = Input::get("CATEGORY");
        $patent = Input::get("PATENT");
        $are18 = Input::get("ARE18");
        $lead = Lead::find($leadId);
        if($lead!=null){
            $lead->password = $pass;
            $lead->category = $category;
            $lead->patent = $patent;
            $lead->are18 = $are18;
            $lead->save();
        }

        //create Transactio.
        Transaction::createTransaction('', $lead->id, '', 'LEAD-SAVE-PASS-REGISTER', '', '', '', '', '', '', '');
        return "1";
    }
    public function registerSuccess()
    {
        return view('omi.success');
    }
}

