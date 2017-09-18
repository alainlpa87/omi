<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectClientServices extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'projectclientservices';

    protected $filled = array('show'
    ,'completed'                        //tiene 5 valores 0->new,1->at proccess,2->returned,3->overdue,4->closed, 5->closed expirated
    ,'phase'                            //representa la fase en la q esta el proyecto empezando dsd 0
    ,'returnedReason'                   //si el cliente retorno la aplicacion aki se almacena la razon
    ,'overDueReason'                    //si el proyecto se puso en overdue, aki se almacena la razon(attorney, client signature ...)
    ,'project_id'                       //id del proyecto
    ,'contract_id'                      //id del contract ppa
    ,'fileno'                           //file no
    ,'attorney_id'                      //id del attorney asignado
    ,'contractTypes'                    //ls tipos de contractos del file (ut, design, prov, epo, ...)
    ,'rcvdDate'                         //fecha en q se recibio el contrato
    ,'ppaRcvdDate'                      //fecha en q se pago el contracto
    ,'titleofinvention'                 //title of invention usada para mostrar en algunos docs
    ,'titleofinventionD'                //lo mismo pero para cuando sea design
    ,'ppaSent_created_at'               //fecha en q se envio el psa and ddr
    ,'ddrReceived_created_at'           //fecha en q se recibieron el psa y el ddr (ambos fueron firmados)
    ,'copyrightSent_created_at'         //fecha en q se envia el copyright questionnaire to client
    ,'trademarkSent_created_at'         //fecha en q se envia el trademark questionnaire to client
    ,'copyrightReceived_created_at'     //fecha en q se recibio el copyright questionnaire from the client
    ,'copyright_sent_to_attorney'       //fecha en q se mando el copyright al attorney
    ,'trademark_sent_to_attorney'       //fecha en q se mando el trademark al attorney
    ,'trademarkReceived_created_at'     //fecha en q se envia el trademark questionnaire from the client
    ,'agreementExt_sent'                //fecha en q se envio el agreement extension
    ,'agreementExt_rcvd'                //fecha en q se recibio el agreement extension
    ,'documentSent_created_at'          //fecha en q se enviaron los documentos al attorney (coversheet)
    ,'docUpgSent_created_at'            //fecha en q se enviaron los documentos del upgrade al attorney (coversheet)
    ,'emailSent_created_at'             //fecha en q se le manda el welcome email to client
    ,'emailCall_created_at'             //fecha en q se hizo la llamada de follow up al client
    ,'appSent_created_at'               //fecha en q se envio el patent app al client
    ,'poaDec_created_at'                //fecha en q se envio el poa and declaration al client (misma q la anterior)
    ,'appFollowUp_created_at'           //fecha en q se hizo el Patent App Followup with Inventor
    ,'poaDecReceived_created_at'        //fecha en q se recibio el poa and declaration al client
    ,'patentAppApproved_created_at'     //fecha en q se aprobo el patent app por el cliente
    ,'apppendingrevision'               //se usa pa saber si el patent app sta pendiente d revisiones
    ,'appSentD_created_at'              //fecha en q se envio el patent app design al client
    ,'poaDecSentD_created_at'           //fecha en q se envio el poa and declaration design al client (misma q la anterior)
    ,'poaDecRcvdD_created_at'           //fecha en q se recibio el poa and declaration design al client
    ,'patentAppApprovedD_created_at'    //fecha en q se aprobo el patent app design por el cliente
    ,'apppendingrevisionD'              //se usa pa saber si el patent app design sta pendiente d revisiones
    ,'marketingAgrSent_created_at'      //fecha en q se envio el ilc agreement
    ,'marketingAgrSentAfterUpgrade_created_at' //fecha en q se recibio el ilc agreement del upgrade firmado
    ,'marketingAgrReceived_created_at'   //fecha en q se recibio el ilc agreement
    ,'releaseFormReceived_created_at'    //fecha en q se recibio el release form del il agreement firmado x el cliente
    ,'patentAppInvoiceNo'                //invoice number
    ,'patentInvoiceSentDate'             //fecha en q se inserto el invoice number en l sistema
    ,'patentAppCheckNo'
    ,'patentAppFiled_created_at'
    ,'patentType'                       //tipo dl patent app filed (ut, prov, design)
    ,'patentAppNo'                      //numero del patent app
    ,'copyrightFiled_created_at'        //date en que se recive el CP from the att
    ,'copyrightAtt'
    ,'copyrightAppNumber'
    ,'trademarkFil_created_at'            //fecha en que se recive el TM del attorney
    ,'trademarkAtt'
    ,'trademarkAppNo'
    ,'epoToAttDate'
    ,'epoFil_created_at'
    ,'epoNumber'
    ,'pctPsaSent_create_at'
    ,'pctPsaRcvd_create_at'
    ,'pctQuestSent'
    ,'pctQuestReceived'
    ,'pctToAttDate'
    ,'pctCaseNumber'
    ,'pctFil_created_at'
    ,'pctNumber'
    ,'pctInvoiceRecvdDate'
    ,'pctInvoicePaidDate'
    ,'designInvoiceNo'
    ,'designCheckNo'
    ,'designFil_created_at'
    ,'designNumber'
    ,'designInvoiceSentDate'
    ,'grantedNumber'
    ,'grantedDate'
    ,'DModel_sent'          //fecha en q se envio el 3d model
    ,'DModel_rcvd'          //fecha en q se recibio el 3d model
    ,'pctEpoAlert'          //se usa pa saber si ya se envio el pct/epo upgrade y q no salga en la ventana extra d ls reminders
    ,'provAlert'            //lo mismo q arriba pero cn el provisional upgrade
    ,'notes'
    ,'updateDateAfterYear' // fecha en q se mando el ultimo update email si ya se mando el de un anho (incluyendo este caso)
    ,'changePhaseDate'    //fecha en q el file cambio de fase por ultima vz
    ,'mailOnly'           // indica si el client solo recibe correo regular (no usa email)
    ,'notifyAppDelay'
    ,'reminderToAttAppDate'
    ,'reminderToAttDesignAppDate');

    /**
     * Create a new Eloquent model instance.
     *
     * @param array $attributes
     * @return mixed
     */
    public function __construct(array $attributes = []){

        parent::__construct($attributes);
    }

    //return the project
    public function project()
    {
        return $this->belongsTo('App\Models\Project');
    }

    //return the contract
    public function contract()
    {
        if($this->contract_id!=0)
            return $this->belongsTo('App\Models\Contract');
        return null;
    }

    //return the notes
    public function csNotes()
    {
        return ClientSNotes::where('projectclientservices_id',$this->id)->orderBy('created_at', 'desc')->get();
    }

    //return the attorney asigned
    public function attorney(){
        if($this->attorney_id >0)
            return Consultant::find($this->attorney_id);
        else
            return -1;
    }

    // return true if the project have the  param type
    public function hasType($type){
        $types=$this->contractTypes;
        $arrTypes =explode(",", $types);
        foreach($arrTypes as $typeP){
            if($typeP==$type)
                return true;
        }
        return false;
    }

    //return los docs without sign
    public function getDocsCS(){
        return ClientSDocs::where('projectclientservices_id',$this->id)->where('file_id',-1)->get();
    }

    public function getDocsApp(){
        return ClientSDocs::where('projectclientservices_id',$this->id)->where('file_id',-1)->where('belong_PA',1)->get();
    }


    //return the doc with the name of the parameter
    public function getDocsByName($name){
        return ClientSDocs::where('projectclientservices_id',$this->id)->where('document',$name)->first();
    }

    //return true if exist some doc returned
    public function existReturned(){
        $docs=ClientSDocs::where('projectclientservices_id',$this->id)->where('file_id',-1) ->get();
        if($docs!=null){
            foreach($docs as $doc)
                if($doc->signdate != "")
                    return true;
        }
        return false;
    }

    //return true if exist some doc not returned
    public function existNoReturned(){
        $docs=ClientSDocs::where('projectclientservices_id',$this->id)->where('file_id',-1) ->get();
        if($docs!=null){
            foreach($docs as $doc)
                if($doc->notes_resend=="")
                    return true;
        }
        return false;
    }

    public function getUpgradeDue(){
        if($this->patentAppFiled_created_at=="0000-00-00 00:00:00")
            return "";

        $aux = explode(" ",$this->patentAppFiled_created_at);
        $arr_aux = explode("-",$aux[0]);
        $new_year = intval($arr_aux[0])+1;
        $new_date = $arr_aux[1]."-".$arr_aux[2]."-".$new_year;
        return $new_date;
    }

    public function legalRecords(){
        return LegalRecord::where('projectclientservices_id', $this->id)->get();
    }

    public function hasLegalRecord (){
        $legalR = LegalRecord::where('projectclientservices_id', $this->id)->get();
        return count($legalR)> 0;
    }

    public function getFilingR(){
        $file = UploadedFiles::where('project_id',$this->project_id)->where('filingReceipt',1)->first();
        if($file == null)
            return 0;
        return $file->id;
    }

}