@extends('omi.layout.headSandbox')
@section('title','Patent Services USA')
@section('header_styles')
    <link href="{{ asset('/css/common.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/launch.css') }}" rel="stylesheet">
    <link href="{{ asset('/plugins/bootstrap/bootstrap-datetimepicker.css')}}" rel="stylesheet"/>
@endsection
@if(setlocale(LC_MONETARY, 'en_US.UTF-8'))@endif
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                @if($needSign)
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <a class="dashboard-stat dashboard-stat-light blue-soft" href="{{route('launch/sign',$project->id)}}">
                            <div class="visual">
                                <i class="fa fa-pencil"></i>
                            </div>
                            <div class="details">
                                <div class="number">
                                    <p style="font-size: 80%;">SIGN CONTRACT</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endif
                @if(($cS=$project->clientServicesProject())!=null && ($docsToSign>0 || ($cS->appSent_created_at!="" && $cS->patentAppApproved_created_at == "") || $upLetterSign == 1 || $ilcNeedSign == 1))
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        @if(count($cS->getDocsCS())==1 && $cS->getDocsCS()[0]->notes_resend==""  && ($cS->appSent_created_at=="" || $cS->patentAppApproved_created_at == "") && $upLetterSign == -1 )
                            {{--<a class="dashboard-stat dashboard-stat-light blue-soft" href="{{route('launch_sandbox/clientServices/sign',"DOCUMENT=".$cS->getDocsCS()[0]->document."&ID=".$project->id)}}">--}}
                            <div id="showOnlyDoc" class="dashboard-stat dashboard-stat-light blue-soft" style="cursor:pointer;" data-doc="{{$cS->getDocsCS()[0]->document}}" data-pid="{{$project->id}}" >
                                <div class="visual">
                                    <i class="fa fa-pencil"></i>
                                </div>
                                <div class="details" style="right: 0 !important;">
                                    <div class="number">
                                        <p style="font-size: 80%;">SIGN {{$cS->getDocsCS()[0]->name}}</p>
                                    </div>
                                </div>
                            </div>
                            {{--</a>--}}
                        @else
                            {{--<a class="dashboard-stat dashboard-stat-light blue-soft" href="{{route('launch_sandbox/client_services/docs',$project->id)}}">--}}
                            <div id="showDocsDiv" class="dashboard-stat dashboard-stat-light blue-soft" style="cursor:pointer;" data-pid="{{$project->id}}" >
                                <div class="visual">
                                    <i class="fa fa-pencil"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <p style="font-size: 80%;">SIGN LEGAL DOCS</p>
                                    </div>
                                </div>
                            </div>
                            {{--</a>--}}
                        @endif
                    </div>
                @endif
                @if($allowPayment)
                    @if($contract->funding==1||($contract->type=="PPA" && strlen($contract->signed)>0))
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <form method="POST" action="{{url("payment_sandbox")}}" id="paymentForm">
                                <input type="hidden" name="project_id" value="{{$project->id}}">
                                <input type="hidden" name="contract_id" value="{{$contract->id}}">
                                    <span style="cursor: pointer;" class="dashboard-stat dashboard-stat-light green-soft" onclick="$('#paymentForm').submit();">
                                        <div class="visual"><i class="fa fa-money"></i></div>
                                        <div class="details">
                                            <div class="number">
                                                Make a Payment
                                            </div>
                                        </div>
                                    </span>
                            </form>
                        </div>
                    @else
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <a class="dashboard-stat dashboard-stat-light green-soft" href="{{route('launch_sandbox/signBeforePaid',$project->id)}}">
                                <div class="visual"><i class="fa fa-money"></i></div>
                                <div class="details">
                                    <div class="number">
                                        Make a Payment
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endif
                @endif
                @if($allowQuestions)
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <a class="dashboard-stat dashboard-stat-light yellow-casablanca showEmail">
                            <div class="visual">
                                <i class="fa fa-envelope"></i>
                            </div>
                            <div class="details" style="right: 0 !important;">
                                <div class="number">
                                    <p style="font-size: 80%;">Contact Us.</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endif
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 linkUploadFileProject" data-id="{{$project->id}}">
                    <a class="dashboard-stat dashboard-stat-light red-soft" href="#">
                        <div class="visual"><i class="fa fa-upload"></i></div>
                        <div class="details">
                            <div class="number">
                                UPLOAD FILES
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-9 col-sm-12 col-xs-12">
                <ul class="nav nav-tabs" role="tablist">
                    <div class="caption">
                        <span class="projectStatus">PROJECT STATUS: APPROVED</span>
                    </div>
                    <li @if(($pcs = $project->clientServicesProject())== null)class="active"@endif>
                        <a href="#portlet_tab_1" data-toggle="tab" role="tab"> PROJECT DETAILS </a>
                    </li>
                    <li>
                        <a href="#portlet_tab_2" data-toggle="tab" role="tab"> INVENTORS </a>
                    </li>
                    @if($pcs!=null)
                        <li class="active">
                            <a href="#portlet_tab_3" data-toggle="tab" role="tab"> LEGAL STATUS </a>
                        </li>
                    @endif
                </ul>
                <div class="portlet-body">
                    <div class="tab-content col-md-12">
                        <div class="tab-pane @if($pcs == null) active @endif" id="portlet_tab_1" role="tabpanel">
                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                <label>Invention Name:</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input type="text" class="form-control cleanBorder" id="ideaName" name="ideaName" value="{{$project->ideaName}}" data-id="{{$project->id}}"/>
                                </div>
                            </div>
                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                <label>Invention Product Description</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <label type="text" id="ideaConcept" class="form-control" readonly style="height: 100px;overflow-y:scroll;">{!!$project->ideaConcept!!}</label>
                                </div>
                            </div>
                            @if(!$allowQuestions)
                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <label>Add some comments to your idea</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-th-large"></i></span>
                                        <textarea rows="6" type="text" class="form-control" id="description" name="description"></textarea>
                                    </div>
                                </div>
                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <button id="btnSaveProject" data-id="{{$project->id}}" data-next="1" data-tab="0" class="btn btn-success center-block btnSaveProject" type="button">
                                        <i class="fa fa-floppy-o"></i>
                                        <strong>Save</strong>
                                    </button>
                                </div>
                            @endif
                            <div class="clear"></div>
                            @if($notesApproval>0)
                                <div class="boxApproval">
                                    <div class="form-group col-md-10 col-sm-12 col-xs-12">
                                        <label>For Inventor Approval:</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-th-large"></i></span>
                                            <textarea rows="6" type="text" class="form-control" id="notesApproval" name="notesApproval">{{$project->approvalNotes}}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-2 col-sm-12 col-xs-12 boxBtnApproval">
                                        <button id="btnSaveApproval" data-id="{{$project->id}}" class="btn btn-success center-block btnSaveApproval" type="button">
                                            <i class="fa fa-thumbs-up"></i>
                                            <strong>Approve</strong>
                                        </button>
                                    </div>
                                </div>
                            @endif

                            @if($allowQuestions)
                                <div class="groupQuestions">
                                    <div class="panel-group" id="accordion">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse1" class="actionQuestions" data-id="{{$project->id}}">
                                                    <h4 class="panel-title">
                                                        Questions Group 1
                                                    </h4>
                                                </a>
                                            </div>
                                            <div id="collapse1" class="panel-collapse collapse in">
                                                <div class="panel-body">
                                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                        <label>Tell us when and how you thought of your invention.</label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-th-large"></i></span>
                                                            <textarea rows="8" type="text" class="form-control" id="hisIdea" name="hisIdea"> {{$project->hisIdea}}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                        <label>How does your new invention WORK, OPERATE or FUNCTION.</label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-th-large"></i></span>
                                                            <textarea rows="8" type="text" class="form-control" id="descIdea" name="descIdea"> {{$project->descIdea}}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                        <label>What similar product is on the market now? (Similar, but not the same).</label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-th-large"></i></span>
                                                            <textarea rows="8" type="text" class="form-control" id="similarProduct" name="similarProduct"> {{$project->similarProduct}}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                        <button id="btnSaveProject1" data-id="{{$project->id}}" data-next="2" data-tab="1" class="btn btn-success center-block btnSave btnSaveProject" type="button">
                                                            <i class="fa fa-floppy-o"></i>
                                                            <strong>Save And Continue</strong>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse2" class="actionQuestions" data-id="{{$project->id}}">
                                                    <h4 class="panel-title">
                                                        Questions Group 2
                                                    </h4>
                                                </a>
                                            </div>
                                            <div id="collapse2" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                        <label>How is your new invention DIFFERENT from other similar ideas? (Uniqueness)</label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-th-large"></i></span>
                                                            <textarea rows="8" type="text" class="form-control" id="uniIdea" name="uniIdea"> {{$project->uniIdea}}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                        <label>What PROBLEM does your idea solve? What are the advantages and benefits of your idea's solution?</label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-th-large"></i></span>
                                                            <textarea rows="8" type="text" class="form-control" id="probIdea" name="probIdea"> {{$project->probIdea}}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                        <label>How much will it cost to produce your idea?</label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-th-large"></i></span>
                                                            <textarea rows="8" type="text" class="form-control" id="costSpend" name="costSpend"> {{$project->costSpend}}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-6 col-sm-6 col-xs-4">
                                                        <button id="btnBackProject2" data-id="{{$project->id}}" data-back="1" data-tab="2" class="btn btn-info center-block btnSave btnBack" type="button">
                                                            <i class="fa fa-arrow-left"></i>
                                                            <strong>Back</strong>
                                                        </button>
                                                    </div>
                                                    <div class="form-group col-md-6 col-sm-6 col-xs-8">
                                                        <button id="btnSaveProject2" data-id="{{$project->id}}" data-next="3" data-tab="2" class="btn btn-success center-block btnSave btnSaveProject" type="button">
                                                            <i class="fa fa-floppy-o"></i>
                                                            <strong>Save And Continue</strong>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse3" class="actionQuestions" data-id="{{$project->id}}">
                                                    <h4 class="panel-title">
                                                        Questions Group 3
                                                    </h4>
                                                </a>
                                            </div>
                                            <div id="collapse3" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                        <label>How much will you sell it for?</label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-th-large"></i></span>
                                                            <textarea rows="8" type="text" class="form-control" id="payIdea" name="payIdea"> {{$project->payIdea}}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                        <label>What technical field(s) does your project fall into:? (Hold the Ctrl or ⌘ button to make multiple selections)</label>
                                                        <select multiple="" id="techField" name="techField" class="form-control" >
                                                            <option value="agriculture" {{strpos($project->techField, 'agriculture')!==false ?" selected":""}}>agriculture</option>
                                                            <option value="apparel/accessories" {{strpos($project->techField, 'apparel/accessories')!==false ?" selected":""}}>apparel/accessories</option>
                                                            <option value="arts/crafts/graphics" {{strpos($project->techField, 'arts/crafts/graphics')!==false ?" selected":""}}>arts/crafts/graphics</option>
                                                            <option value="automotive/vehicle" {{strpos($project->techField, 'automotive/vehicle')!==false ?" selected":""}}>automotive/vehicle</option>
                                                            <option value="drug/beauty educational" {{strpos($project->techField, 'drug/beauty educational')!==false ?" selected":""}}>drug/beauty educational</option>
                                                            <option value="electronics fuel/energy" {{strpos($project->techField, 'electronics fuel/energy')!==false ?" selected":""}}>electronics fuel/energy</option>
                                                            <option value="food/beverage/tobacco" {{strpos($project->techField, 'food/beverage/tobacco')!==false ?" selected":""}}>food/beverage/tobacco</option>
                                                            <option value="hardware – building product" {{strpos($project->techField, 'hardware – building product')!==false ?" selected":""}}>hardware – building product</option>
                                                            <option value="hardware – tools" {{strpos($project->techField, 'hardware – tools')!==false ?" selected":""}}>hardware – tools</option>
                                                            <option value="household – decorative" {{strpos($project->techField, 'household – decorative')!==false ?" selected":""}}>household – decorative</option>
                                                            <option value="household – cleaning" {{strpos($project->techField, 'household – cleaning')!==false ?" selected":""}}>household – cleaning</option>
                                                            <option value="household – tools/gadget" {{strpos($project->techField, 'household – tools/gadget')!==false ?" selected":""}}>household – tools/gadget</option>
                                                            <option value="household – other" {{strpos($project->techField, 'household – other')!==false ?" selected":""}}>household – other</option>
                                                            <option value="lawn/garden" {{strpos($project->techField, 'lawn/garden')!==false ?" selected":""}}>lawn/garden</option>
                                                            <option value="medical/therapeutic" {{strpos($project->techField, 'medical/therapeutic')!==false ?" selected":""}}>medical/therapeutic</option>
                                                            <option value="miscellaneous/other" {{strpos($project->techField, 'miscellaneous/other')!==false ?" selected":""}}>miscellaneous/other</option>
                                                            <option value="music" {{strpos($project->techField, 'music')!==false ?" selected":""}}>music</option>
                                                            <option value="novelty" {{strpos($project->techField, 'novelty')!==false ?" selected":""}}>novelty</option>
                                                            <option value="pets" {{strpos($project->techField, 'pets')!==false ?" selected":""}}>pets</option>
                                                            <option value="restaurant/hospitality" {{strpos($project->techField, 'restaurant/hospitality')!==false ?" selected":""}}>restaurant/hospitality</option>
                                                            <option value="safety" {{strpos($project->techField, 'safety')!==false ?" selected":""}}>safety</option>
                                                            <option value="seasonal" {{strpos($project->techField, 'seasonal')!==false ?" selected":""}}>seasonal</option>
                                                            <option value="sports/fitness/recreation" {{strpos($project->techField, 'sports/fitness/recreation')!==false ?" selected":""}}>sports/fitness/recreation</option>
                                                            <option value="stationery/office" {{strpos($project->techField, 'stationery/office')!==false ?" selected":""}}>stationery/office</option>
                                                            <option value="technology" {{strpos($project->techField, 'technology')!==false ?" selected":""}}>technology</option>
                                                            <option value="toys/hobbies" {{strpos($project->techField, 'toys/hobbies')!==false ?" selected":""}}>toys/hobbies</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                        <label>What companies, groups of people, products, processes or services could use your idea?</label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-th-large"></i></span>
                                                            <textarea rows="8" type="text" class="form-control" id="targetMarket" name="targetMarket"> {{$project->targetMarket}}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-6 col-sm-6 col-xs-4">
                                                        <button id="btnBackProject2" data-id="{{$project->id}}" data-back="2" data-tab="3" class="btn btn-info center-block btnSave btnBack" type="button">
                                                            <i class="fa fa-arrow-left"></i>
                                                            <strong>Back</strong>
                                                        </button>
                                                    </div>
                                                    <div class="form-group col-md-6 col-sm-6 col-xs-8">
                                                        <button id="btnSaveProject3" data-id="{{$project->id}}" data-next="4" data-tab="3" class="btn btn-success center-block btnSave btnSaveProject" type="button">
                                                            <i class="fa fa-floppy-o"></i>
                                                            <strong>Save And Continue</strong>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse4" class="actionQuestions" data-id="{{$project->id}}">
                                                    <h4 class="panel-title">
                                                        Questions Group 4
                                                    </h4>
                                                </a>
                                            </div>
                                            <div id="collapse4" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                        <label>What upgrades or modifications can you suggest to improve functionality, packaging, appeal, versatility, mechanics or affordability to a manufacturer or end user?</label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-th-large"></i></span>
                                                            <textarea rows="8" type="text" class="form-control" id="modifications" name="modifications"> {{$project->modifications}}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                        <label>Describe the environment (wet, dry, temperature, pressure, light, dark, etc.) in which your idea will function?</label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-th-large"></i></span>
                                                            <textarea rows="8" type="text" class="form-control" id="environment" name="environment"> {{$project->environment}}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                        <label>If your idea is a "device", what does it consume or produce? And what powers it? (Manual, electricity, gasoline, sunlight, water power, batteries, etc.)</label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-th-large"></i></span>
                                                            <textarea rows="8" type="text" class="form-control" id="device" name="device"> {{$project->device}}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                        <label>Any additional comments or information you wish to volunteer about yourself (inventor), any co-inventors or the invention</label>
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-th-large"></i></span>
                                                            <textarea rows="8" type="text" class="form-control" id="addNotes" name="addNotes"> {{$project->addNotes}}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                                        <button id="btnBackProject2" data-id="{{$project->id}}" data-back="3" data-tab="4" class="btn btn-info center-block btnSave btnBack" type="button">
                                                            <i class="fa fa-arrow-left"></i>
                                                            <strong>Back</strong>
                                                        </button>
                                                    </div>
                                                    <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                                        <button id="btnSaveProject2" data-id="{{$project->id}}" data-next="1" data-tab="4" class="btn btn-success center-block btnSave btnSaveProject" type="button">
                                                            <i class="fa fa-floppy-o"></i>
                                                            <strong>Save</strong>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="tab-pane" id="portlet_tab_2"  role="tabpanel">
                            <div class="form-group col-md-6 col-sm-12 col-xs-12">
                                <label>List all Inventors</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input type="text" id="coInventor" class="form-control" value="{{ $project->coInventor}}">
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-sm-12 col-xs-12">
                                <label>Coinventor Relation</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input type="text" id="coInventorRelation" class="form-control" value="{{ $project->coInventorRelation}}">
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-sm-12 col-xs-12">
                                <label>Primary Inventor Occupation</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-wrench"></i></span>
                                    <input type="text" id="occupation" class="form-control" value="{{ $project->lead->occupation}}">
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-sm-12 col-xs-12">
                                <label>List all Third-Party Authorized Contacts</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input type="text" id="tpaContact" class="form-control" value="{{ $project->tpaContact}}">
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-sm-12 col-xs-12">
                                <label>Has a patent attorney been hired?</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-bank"></i></span>
                                    <select class="form-control" id="patentSearch">
                                        <option {{$project->patentSearch==0?"selected":""}} value="0">No</option>
                                        <option {{$project->patentSearch==1?"selected":""}} value="1">Yes</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-sm-12 col-xs-12">
                                <label>Has a licensing agency been hired?</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-building"></i></span>
                                    <select class="form-control" id="patented">
                                        <option {{$project->patented==0?"selected":""}} value="0">No</option>
                                        <option {{$project->patented==1?"selected":""}} value="1">Yes</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                <button id="btnSaveInventors" data-id="{{$project->id}}" class="btn btn-success center-block btnSave btnSaveInventors" type="button">
                                    <i class="fa fa-floppy-o"></i>
                                    <strong>Save</strong>
                                </button>
                            </div>
                        </div>
                        @if($pcs != null)
                            <div class="tab-pane active" id="portlet_tab_3"  role="tabpanel">
                                @if($pcs->rcvdDate!='0000-00-00 00:00:00')
                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <label class="col-md-9">PATENT PROTECTION AGREEMENT PAYMENT DATE: </label>
                                        <div class="col-md-3">
                                            <p>{{date('m-d-Y', strtotime($pcs->rcvdDate))}}</p>
                                        </div>
                                    </div>
                                @endif
                                @if($pcs->ppaSent_created_at!='')
                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <label class="col-md-9">AGREEMENT FOR PATENT SERVICES & DUE DILIGENCE REVIEW SENT DATE: </label>
                                        <div class="col-md-3">
                                            <p>{{date('m-d-Y', strtotime(str_replace('-','/',$pcs->ppaSent_created_at)))}}</p>
                                        </div>
                                    </div>
                                @endif
                                @if($pcs->ddrReceived_created_at!='')
                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <label class="col-md-9">AGREEMENT FOR PATENT SERVICES & DUE DILIGENCE REVIEW RECEIVED DATE: </label>
                                        <div class="col-md-3">
                                            <p>{{date('m-d-Y', strtotime(str_replace('-','/',$pcs->ddrReceived_created_at)))}}</p>
                                        </div>
                                    </div>
                                @endif
                                @if($pcs->emailSent_created_at!='')
                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <div  class="col-md-9">
                                            <label><a href="{{asset('files/omi/Welcome to Patent Services USA.pdf')}}" target="_blank" class="welcomeEmLCLabel">WELCOME EMAIL SENT DATE:</a></label>
                                            <i class="fa fa-question-circle" style="color: #008000;cursor: help;margin-left: 10px;" title="Welcome to Patent Services, client services department. During the next few weeks we will be coordinating all activities with the attorney on your behalf. Please consider client services as your primary point of contact moving forward. The client services department is available to speak with you at your convenience Monday – Friday, 8am-5pm est. Our contact number is 1-888-344-6836. We are excited to be a part of your team."></i>
                                        </div>
                                        <div class="col-md-3">
                                            <p>{{date('m-d-Y', strtotime(str_replace('-','/',$pcs->emailSent_created_at)))}}</p>
                                        </div>
                                    </div>
                                @endif
                                @if($pcs->emailCall_created_at!='')
                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <div  class="col-md-9">
                                            <label>INTRO CALL DATE: </label>
                                            <i class="fa fa-question-circle" style="color: #008000;cursor: help;margin-left: 10px;" title="The client services department at Patent Services has contacted you to introduce the department as they will be servicing your patent moving forward. A client services representative is available to speak with you at your convenience during normal business hours, Monday – Friday, 8am-5pm est. If you need assistance or have questions about the patent process, please contact the client services department at 1-888-344-6836."></i>
                                        </div>
                                        <div class="col-md-3">
                                            <p>{{date('m-d-Y', strtotime(str_replace('-','/',$pcs->emailCall_created_at)))}}</p>
                                        </div>
                                    </div>
                                @endif
                                @if($pcs->appSent_created_at!='')
                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <label class="col-md-9">PATENT APPLICATION SENT DATE: </label>
                                        <div class="col-md-3">
                                            <p>{{date('m-d-Y', strtotime(str_replace('-','/',$pcs->appSent_created_at)))}}</p>
                                        </div>
                                    </div>
                                @endif
                                @if($pcs->patentAppApproved_created_at!='')
                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <label class="col-md-9">PATENT APPLICATION APPROVED DATE: </label>
                                        <div class="col-md-3">
                                            <p>{{date('m-d-Y', strtotime(str_replace('-','/',$pcs->patentAppApproved_created_at)))}}</p>
                                        </div>
                                    </div>
                                @endif
                                @if($pcs->marketingAgrSent_created_at!='')
                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <label class="col-md-9">ILC MARKETING AGREEMENT AND RECEIPT USPTO SENT DATE: </label>
                                        <div class="col-md-3">
                                            <p>{{date('m-d-Y', strtotime(str_replace('-','/',$pcs->marketingAgrSent_created_at)))}}</p>
                                        </div>
                                    </div>
                                @endif
                                @if($pcs->marketingAgrReceived_created_at!='')
                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <label class="col-md-9">ILC MARKETING AGREEMENT RECEIVED DATE: </label>
                                        <div class="col-md-3">
                                            <p>{{date('m-d-Y', strtotime(str_replace('-','/',$pcs->marketingAgrReceived_created_at)))}}</p>
                                        </div>
                                    </div>
                                @endif
                                @foreach($updateEmails as $email)
                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <div class="col-md-9">
                                            <label>
                                                UPDATE EMAIL FROM CLIENT SERVICES({{$email->params}})
                                            </label>
                                            @if($email->params == '3 months')
                                                <i class="fa fa-question-circle" style="color: #008000;cursor: help;margin-left: 10px;"
                                                   title="Congratulations on taking important steps towards the development of your invention, this is a tremendous accomplishment! Your courage and entrepreneurial spirit will carry you, to realizing your dream. Currently, we are continuing to monitor your patent application with the Independent Registered Patent attorney, every effort is being made to assist the attorney."></i>
                                            @elseif($email->params == '6 months')
                                                <i class="fa fa-question-circle" style="color: #008000;cursor: help;margin-left: 10px;"
                                                   title="Currently, we are continuing to monitor your patent application with the Independent Registered Patent attorney, every effort is being made to assist the attorney. The patent application is published with the United States Patent and Trademark Office approximately 18 months after the filing date of the application, and then the status of the application can be viewed on USPTO's PAIR service (http://portal.uspto.gov/external/portal/pair). Until the application is published, the application information is not viewable. Please note it usually takes 18-24 months for the USPTO to start the examination process. Sometimes office action will occur before the application is published, and we will send you a copy of  such office actions when we receive them. Any questions do not hesitate to contact me."></i>
                                            @elseif($email->params == '12 months')
                                                <i class="fa fa-question-circle" style="color: #008000;cursor: help;margin-left: 10px;"
                                                   title="Currently, we are continuing to monitor your patent application with the Independent Registered Patent attorney, every effort is being made to assist the attorney.
 Your patent was filed on {{date('m/d/Y',strtotime($pcs->patentAppFiled_created_at))}} -Application number is {{$pcs->patentAppNo}}"></i>
                                            @endif:
                                        </div>
                                        <div class="col-md-3">
                                            <p>{{date('m-d-Y', strtotime(str_replace('-','/',$email->created_at)))}}</p>
                                        </div>
                                    </div>
                                @endforeach
                                @foreach($updateAfterYearEmails as $email)
                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <label class="col-md-9">UPDATE EMAIL FROM CLIENT SERVICES AFTER 1 YEAR: </label>
                                        <div class="col-md-3">
                                            <p>{{date('m-d-Y', strtotime(str_replace('-','/',$email->created_at)))}}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-12 col-xs-12 " id="fileList_{{$project->id}}">
                <span class="fileListSpan">LIST OF FILES:</span></br></br>
                @foreach($project->filesByType(array('public')) as $file)
                    <div class="col-md-12 col-sm-12 col-xs-12" id="divFile_{{$file->id}}"><span title="{{$file->fileName}}&nbsp;&nbsp;&nbsp;{{$file->created_at}}"><a href="{{asset("/".$file->url)}}" target="_blank">{{strlen($file->fileName)>25?substr($file->fileName,0,23).'...':$file->fileName}}</a></span><span title="Delete File" data-id="{{$file->id}}" class="launchDeleteFile"><i class="fa fa-times "></i></span></div>
                @endforeach
            </div>
        </div>
    </div>
    @include('omi.launch.client_services.signModal')
@endsection

@section('footer_scripts')

@endsection

