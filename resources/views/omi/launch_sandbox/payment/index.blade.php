@extends('omi.layout.headSandbox')
@section('title','Patent Services USA')
@section('header_styles')
    <link href="{{ asset('/css/common.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/launch.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/payment.css') }}" rel="stylesheet">
@endsection
@section('content')
    <h1 align="center"><strong>Patent Services Payment Terminal</strong></h1>
    <form id="formPayment" name="formPayment" method="post" action="{{url('process_sandbox')}}" onsubmit="return checkForm();" enctype="multipart/form-data">
        <div class="col-md-6 col-sm-12 col-xs-12 boxPaymentInfo">
            <!-- PROJECT BLOCK -->
            <h2 class="subTitles">Project Information</h2>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <label>Project Name: <strong>{{$project->ideaName}}</strong></label>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <label>Contract Type: <strong>{{$contract->type}}</strong></label>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <label class="col-md-3">Amount:</label>
                <div class="input-group col-md-9">
                    <span class="input-group-addon"><i class="fa fa-money"></i></span>
                    <input type="text" id="project_price" onkeyup="checkFieldBack(this);" name="project_price" {{$contract->funding==0 && $contract->type!="PPA"?"readonly='readonly'":""}} class="form-control" value="{{money_format("%i", $contract->type!="PPA"?$contract->price - $contract->paid:100)}}">
                </div>
            </div>
            <!-- PROJECT BLOCK -->
            <br><br>
            <!-- BILLING BLOCK -->
            <h2 class="subTitles">Billing Information</h2>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <input type="text" id="fname" name="fname" placeholder="First Name" class="form-control" value="{{ $project->lead->fname}}">
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <input type="text" id="lname" name="lname" placeholder="Last Name" class="form-control" value="{{ $project->lead->lname}}">
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-home"></i></span>
                    <input type="text" id="address" name="address" placeholder="Address" class="form-control" value="{{ $project->lead->street}}">
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-home"></i></span>
                    <input type="text" id="city" name="city" placeholder="City" class="form-control" value="{{ $project->lead->city}}">
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-home"></i></span>
                    @if($country = $project->lead->country)@endif
                    @include('omi.tools.country')
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-home"></i></span>
                    @if($state = $project->lead->state)@endif
                    @include('omi.tools.state')
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-home"></i></span>
                    <input type="text" id="zip" name="zip" placeholder="ZIP/Postal Code" class="form-control" value="{{ $project->lead->zip}}">
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
                    <input type="email" id="email" name="email" placeholder="E-mail" class="form-control" value="{{ $project->lead->email}}">
                </div>
            </div>
            <!-- BILLING BLOCK -->
        </div>

        <!-- CREDIT CARD BLOCK -->
        <div class="col-md-6 col-sm-12 col-xs-12 boxPaymentInfo">
            <h2 class="subTitles">Credit Card Information</h2>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <label>Credit Card Type:</label>
                <div class="input-group">
                    <input name="cctype" type="radio" value="V" class="lft-field" checked/> <img src="{{'img/payment/ico_visa.jpg'}}" align="absmiddle" class="cardhide V"/>
                    <input name="cctype" type="radio" value="M" class="lft-field"/> <img src="{{'img/payment/ico_mc.jpg'}}" align="absmiddle" class="cardhide M"/>
                    <input name="cctype" type="radio" value="A" class="lft-field"/> <img src="{{'img/payment/ico_amex.jpg'}}" align="absmiddle" class="cardhide A"/>
                    <input name="cctype" type="radio" value="D" class="lft-field"/> <img src="{{'img/payment/ico_disc.jpg'}}" align="absmiddle" class="cardhide D"/>
                    <input name="cctype" type="radio" value="E" class="lft-field isCheck"/> <img src="{{'img/payment/eCheck.png'}}" align="absmiddle" class="cardhide D"/>
                    <input name="cctype" type="radio" value="PP" class="lft-field isPayPal"/> <img src="{{'img/payment/ico_paypal.png'}}" align="absmiddle" class="lft-field paypal cardhide PP"/>
                </div>
            </div>
            <div class="ccinfo">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                        <input name="ccn" id="ccn" placeholder="Card Number" type="text" class="form-control"  onkeyup="checkNumHighlight(this.value);checkFieldBack(this);noAlpha(this);" value="" onkeypress="checkNumHighlight(this.value);noAlpha(this);" onblur="checkNumHighlight(this.value);" onchange="checkNumHighlight(this.value);" maxlength="16" />
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input name="ccname" id="ccname" placeholder="Name on Card" type="text" class="form-control"  onkeyup="checkFieldBack(this);"  />
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <select name="exp1" id="exp1" class="form-control" onchange="checkFieldBack(this);">
                            <option value="01">01</option>
                            <option value="02">02</option>
                            <option value="03">03</option>
                            <option value="04">04</option>
                            <option value="05">05</option>
                            <option value="06">06</option>
                            <option value="07">07</option>
                            <option value="08">08</option>
                            <option value="09">09</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-6">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <select name="exp2" id="exp2" class="form-control" onchange="checkFieldBack(this);">
                            <option value="2016">2016</option>
                            <option value="2017">2017</option>
                            <option value="2018">2018</option>
                            <option value="2019">2019</option>
                            <option value="2020">2020</option>
                            <option value="2021">2021</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                        <input name="cvv" id="cvv" placeholder="CVV" type="text" maxlength="5" class="form-control"  onkeyup="checkFieldBack(this);noAlpha(this);"/>
                    </div>
                </div>
            </div>
            <div class="checkinfo" style="display: none;">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-bank"></i></span>
                        <input name="rnumber" id="rnumber" placeholder="Routing Number" type="text" class="form-control"  onkeyup="checkNumHighlightCheck(this.value);checkFieldBack(this);noAlpha(this);" value="" onkeypress="checkNumHighlightCheck(this.value);noAlpha(this);" onblur="checkNumHighlightCheck(this.value);" onchange="checkNumHighlightCheck(this.value);" maxlength="9" />
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-bank"></i></span>
                        <input name="anumber" id="anumber" placeholder="Account Number" type="text" class="form-control"  onkeyup="checkNumHighlightCheck(this.value);checkFieldBack(this);noAlpha(this);" value="" onkeypress="checkNumHighlightCheck(this.value);noAlpha(this);" onblur="checkNumHighlightCheck(this.value);" onchange="checkNumHighlightCheck(this.value);" maxlength="20" />
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-bank"></i></span>
                        <input name="bkname" id="bkname" placeholder="Bank Name" type="text" class="form-control"  onkeyup="checkFieldBack(this);"  />
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-bank"></i></span>
                        <select name="accttype" id="accttype" class="form-control" onchange="checkFieldBack(this);">
                            <option value="">Please Select</option>
                            <option value="Personal Checking"  >Personal Checking</option>
                            <option value="Business Checking"  >Business Checking</option>
                            <option value="Savings" >Savings</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="submit-btn">
                <input type="hidden" name="contract_id" value="{{$contract->id}}">
                <input type="hidden" name="project_id" value="{{$project->id}}">
                <input src="{{asset('img/payment/btn_submit.jpg')}}" type="image" name="submit" />
            </div>
            @if(isset($error))
                <input type="hidden" id="errorText" value="{{$error}}">
            @endif
        </div>
        <!-- CREDIT CARD BLOCK -->
    </form>
@endsection

@section('footer_scripts')
    <script src="{{asset("js/autoNumeric.js")}}"></script>
    <script src="{{asset("/js/omi/payment.js")}}"></script>
@endsection