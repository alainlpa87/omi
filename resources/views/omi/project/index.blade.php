@extends('omi.project.defaultProject')
@section('title','Patent Services USA')
@section('header_styles')
    <link href="{{ asset('/css/omiProject.css') }}" rel="stylesheet">
@endsection
@section('content')

    <div class="main padding-top-15" style="padding-bottom: 15px">
        <div class="container">
            <div class="col-md-10 col-md-offset-1" style="border: 3px solid #accae4;">
                <h1 class="bubble head1">
                    <p class="greet text-center">Start Here!</p>
                    <div class="alert alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <p align="justify"><span class="emp">You're almost there!</span>  We're currently offering  confidential consultation and project screening <span class="emp">AT NO COST</span>.</p>
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <p><span class="label more moretrol" data-form="1"><i  class="fa fa-question-circle"></i> Learn More</span></p>
                    </div>
                    <div class="col-md-6 col-xs-6" align="right">
                        <p> <a name="trustlink" href="http://secure.trust-guard.com/privacy/9782" rel="nofollow" target="_blank" onclick="var nonwin=navigator.appName!='Microsoft Internet Explorer'?'yes':'no'; window.open(this.href.replace(/https?/, 'https'),'welcome','location='+nonwin+',scrollbars=yes,width=517,height='+screen.availHeight+',menubar=no,toolbar=no'); return false;" oncontextmenu="var d = new Date(); alert('Copying Prohibited by Law - This image and all included logos are copyrighted by trust-guard \251 '+d.getFullYear()+'.'); return false;"><img id="trusty" name="trustseal" alt="Privacy Seals" style="border: 0; margin:-10px 0px 0px 0px; padding:5px;" src="//dw26xg4lubooo.cloudfront.net/seals/privacy/9782-header.gif"></a> </p>
                    </div>
                    <div class="col-md-12 col-xs-12">
                        <p class="moreblock more1" style="text-align:justify; display:none;" data-form="1" id=""><span class="hd4"><i class="fa fa-lock"></i> Confidential Review<br><br></span>A confidential project screening comes first.  Establish a Statement of Non-Disclosure, learn your rights as the inventor and see if you may be eligible to obtain a patent.  If your idea makes it, our screening provides you with a clear quote and free consultation for the life of your project.<br>
                    </div>
                    <p><strong>1. Statement of Non-Disclosure.</strong></p>
                    <p style="text-align: justify;">I fully understand that the submission of my idea, product or new invention to Patent Services IS NOT A RELEASE. I further understand that Patent Services will not, under any circumstance, use, disclose, assign, modify or solicit my idea, product or new invention to any other individual, organization, corporation or entity without my expressed written and verbal authorization. I also acknowledge that all employees, contractors, affiliates, strategic partners and representatives of Patent Services have voluntarily signed a confidentiality agreement for my privacy and protection.</p>
                    <input type="checkbox" class="agree" id="chk"><label for="chk" class="labelAgree">&nbsp;I Agree</label></p>
                    <p><strong>2. Confirm your details below.</strong></p>
                    <i class="fa fa-chevron-down" style="text-align:center; font-size:24px; width:100%;"></i><br>
                </h1>
                <h1 class="bubble head2" style="display: none;">
                    <p class="greet">A few more details to confirm...</p>
                    <div class="alert alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <p align="justify">Please verify the details below.  All information collected is protected by a <strong>Statement of Non-Disclosure</strong>.</p>
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <p><span class="label more moretrol" data-form="2"><i  class="fa fa-question-circle"></i> Learn More</span></p>
                    </div>
                    <div class="col-md-6 col-xs-6" align="right">
                        <p> <a name="trustlink" href="http://secure.trust-guard.com/privacy/9782" rel="nofollow" target="_blank" onclick="var nonwin=navigator.appName!='Microsoft Internet Explorer'?'yes':'no'; window.open(this.href.replace(/https?/, 'https'),'welcome','location='+nonwin+',scrollbars=yes,width=517,height='+screen.availHeight+',menubar=no,toolbar=no'); return false;" oncontextmenu="var d = new Date(); alert('Copying Prohibited by Law - This image and all included logos are copyrighted by trust-guard \251 '+d.getFullYear()+'.'); return false;"><img id="trusty" name="trustseal" alt="Privacy Seals" style="border: 0; margin:-10px 0px 0px 0px; padding:5px;" src="//dw26xg4lubooo.cloudfront.net/seals/privacy/9782-header.gif"></a> </p>
                    </div>
                    <div class="col-md-12 col-xs-12">
                        <p class="moreblock more2" style="text-align:justify; display:none;" data-form="2" id=""><span class="hd4"><i class="fa fa-lock"></i> Statement of Non-Disclosure<br><br></span>Before a patent is obtained, your idea may be a valuable <strong>trade secret</strong>.  A Statement of Non-Disclosure is a standard protection for contracting patent attorneys and other industry professionals in this early stage.  Our Statement of Non-Disclosure will pop up for your review before proceeding further through this form.
                            <i class="fa fa-chevron-up" data-form="1" style="text-align:center; cursor:pointer; width:100%;"></i><br></p>
                    </div>
                    <p><strong>2. Confirm your contact info below.</strong></p>
                    <i class="fa fa-chevron-down" style="text-align:center; font-size:24px; width:100%;"></i><br>
                </h1>
                <h1 class="bubble head3" style="display: none;">
                    <p class="greet">Great!
                    <div class="alert alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <p align="justify">Complete the description of your concept as clearly as possible.  Before the formal review, a consultant may contact you by phone for additional details or questions.</p>
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <p><span class="label more moretrol" data-form="4"><i class="fa fa-question-circle"></i> Learn More</span></p>
                    </div>
                    <div class="col-md-6 col-xs-6" align="right">
                        <p> <a name="trustlink" href="http://secure.trust-guard.com/privacy/9782" rel="nofollow" target="_blank" onclick="var nonwin=navigator.appName!='Microsoft Internet Explorer'?'yes':'no'; window.open(this.href.replace(/https?/, 'https'),'welcome','location='+nonwin+',scrollbars=yes,width=517,height='+screen.availHeight+',menubar=no,toolbar=no'); return false;" oncontextmenu="var d = new Date(); alert('Copying Prohibited by Law - This image and all included logos are copyrighted by trust-guard \251 '+d.getFullYear()+'.'); return false;"><img id="trusty" name="trustseal" alt="Privacy Seals" style="border: 0; margin:-10px 0px 0px 0px; padding:5px;" src="//dw26xg4lubooo.cloudfront.net/seals/privacy/9782-header.gif"></a> </p>
                    </div>
                    <div class="col-md-12 col-xs-12">
                        <p class="moreblock more4" style="text-align:justify; display:none;" data-form="4" id=""><span class="hd4"><i class="fa fa-lock"></i> Confidential Submission<br><br></span>We will use the details that you provide to understand your project.  Please be as detailed as possible so we can provide accurate assistance with your patent needs.  These details are protected under your Statement of Non-disclosure. <br><i class="fa fa-chevron-up" data-form="4" style="text-align:center; cursor:pointer; width:100%;"></i><br></p>
                    </div>
                    <p><strong>3. Complete invention details below.</strong></p>
                    <i class="fa fa-chevron-down" style="text-align:center; font-size:24px; width:100%;"></i><br>
                </h1>
                <h1 class="bubble head4" style="display: none;">
                    <p class="greet">Last step!
                    <div class="alert alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <p align="justify">The Statement of Non-Disclosure that you have just accepted is used to protect <strong>ALL details</strong> that you enter from here forward.</p>
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <p><span class="label more moretrol" data-form="3"><i  class="fa fa-question-circle"></i> Learn More</span></p>
                    </div>
                    <div class="col-md-6 col-xs-6" align="right">
                        <p> <a name="trustlink" href="http://secure.trust-guard.com/privacy/9782" rel="nofollow" target="_blank" onclick="var nonwin=navigator.appName!='Microsoft Internet Explorer'?'yes':'no'; window.open(this.href.replace(/https?/, 'https'),'welcome','location='+nonwin+',scrollbars=yes,width=517,height='+screen.availHeight+',menubar=no,toolbar=no'); return false;" oncontextmenu="var d = new Date(); alert('Copying Prohibited by Law - This image and all included logos are copyrighted by trust-guard \251 '+d.getFullYear()+'.'); return false;"><img id="trusty" name="trustseal" alt="Privacy Seals" style="border: 0; margin:-10px 0px 0px 0px; padding:5px;" src="//dw26xg4lubooo.cloudfront.net/seals/privacy/9782-header.gif"></a> </p>
                    </div>
                    <div class="col-md-12 col-xs-12">
                        <p class="moreblock more3" style="text-align:justify; display:none;" data-form="3" id=""><span class="hd4"><i class="fa fa-lock"></i> Confidential Submission<br><br></span>All consultation, screening and quotation starts with a Confidential Submission completed by the inventor or an authorized contact of the inventor.  You have just accepted the terms of the Statement of Non-Disclosure. Everything you enter on this form is protected through these terms. <br><i class="fa fa-chevron-up" data-form="3" style="text-align:center; cursor:pointer; width:100%;"></i><br></p>
                    </div>
                    <p><strong>4. Complete inventor details below.</strong></p>
                    <i class="fa fa-chevron-down" style="text-align:center; font-size:24px; width:100%;"></i><br>
                </h1>
                <!-- BEGIN INPUTS-->
                <div class="row">
                    <form role="form" id="form1">
                        <div class="progress"><a name="1"></a>
                            <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%">
                                25%
                            </div>
                        </div>

                        <div class="col-md-6" id="divfname">
                            <div class="form-group">
                                <label>First Name<sup class="req">*</sup></label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                    </span>
                                    <input type="text" id="fname" class="form-control" placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6" id="divlname">
                            <div class="form-group">
                                <label>Last Name<sup class="req">*</sup></label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                    </span>
                                    <input type="text" id="lname" class="form-control" placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6" id="divphone">
                            <div class="form-group">
                                <label>Phone Number<sup class="req">*</sup></label>
                                <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-phone"></i>
                                        </span>
                                    <input type="text" id="dphoneno" class="form-control phones" placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6" id="divphone2">
                            <div class="form-group">
                                <label>2nd Phone Number</label>
                                <div class="input-group">
                                     <span class="input-group-addon">
                                         <i class="fa fa-phone"></i>
                                     </span>
                                    <input type="text" id="ephoneno" class="form-control phones" placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-body">
                                <div class="form-group">
                                    <label>Email Address<sup class="req">*</sup></label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                           <i class="fa fa-envelope"></i>
                                        </span>
                                        <input type="email" id="email" class="form-control" placeholder="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6" id="divbest">
                            <div class="form-group">
                                <label>Best Time to Call</label>
                                <div class="input-group">
                                   <span class="input-group-btn">
                                        <button class="btn default" type="button"><i class="fa fa-clock-o"></i></button>
                                   </span>
                                    <input type="text" class="form-control timepicker timepicker-no-seconds" id= "dbtcall">
                                </div>
                            </div>
                        </div>
                        <div id="divPassword" class="col-md-6">
                            <div class="form-body">
                                <div class="form-group">
                                    <label>Create Password<sup class="req">*</sup><span id="cantCaract">(7 characters minimum)</span></label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                           <i class="fa fa-lock"></i>
                                        </span>
                                        <input type="password" id="password" class="form-control" placeholder="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-body">
                                <div class="form-group">
                                    <label id="labelConfirmPass">Confirm Password<sup class="req">*</sup></label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                           <i class="fa fa-lock"></i>
                                        </span>
                                        <input type="password" id="password2" class="form-control" placeholder="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-body">
                                <div class="form-group">
                                    <input type="checkbox" class="agree" id="chkPass">
                                    <label id="labelChkPass">I already have a password.</label>
                                    <a id="resetPass" href="/ResetPassword.php" style="display:none ;text-decoration: underline;float: right;padding-top: 30px;">I forgot my password.</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <p>Attention: The email address and password entered here can be used to access your project in our Launch Center.</p>
                            <p><sup class="req">*</sup>Required Fields</p>
                        </div>
                        <div class="col-md-4 col-md-offset-4">
                            <div class="form-group">
                                <span class="text-center">
                                    <button id="continue1" class="btn btn-info center-block" type="button">
                                        <strong>Continue</strong>
                                        <i class="fa fa-arrow-right fa-fw"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                    </form>
                    <form role="form" id="form2" style="display: none;">
                        <div class="progress"><a name="2"></a>
                            <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%">
                                50%
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Address</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-home"></i>
                                    </span>
                                    <input type="text" id="address" class="form-control " placeholder="" value="">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>City/Town</label>
                                <div class="input-group">
                                      <span class="input-group-addon">
                                         <i class="fa fa-home"></i>
                                      </span>
                                    <input type="text" id= "city" class="form-control" placeholder="" value="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>State</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-home"></i>
                                    </span>
                                    <select name="state" id="state" class="form-control">
                                        <option value="blank">&nbsp;</option>
                                        <option value="AL">&nbsp;Alabama</option>
                                        <option value="AK">&nbsp;Alaska</option>
                                        <option value="AS">&nbsp;American Samoa</option>
                                        <option value="AZ">&nbsp;Arizona</option>
                                        <option value="AR">&nbsp;Arkansas</option>
                                        <option value="CA">&nbsp;California</option>
                                        <option value="CO">&nbsp;Colorado</option>
                                        <option value="CT">&nbsp;Connecticut</option>
                                        <option value="DE">&nbsp;Delaware</option>
                                        <option value="DC">&nbsp;District Of Columbia</option>
                                        <option value="FL">&nbsp;Florida</option>
                                        <option value="GA">&nbsp;Georgia</option>
                                        <option value="HI">&nbsp;Hawaii</option>
                                        <option value="ID">&nbsp;Idaho</option>
                                        <option value="IL">&nbsp;Illinois</option>
                                        <option value="IN">&nbsp;Indiana</option>
                                        <option value="IA">&nbsp;Iowa</option>
                                        <option value="KS">&nbsp;Kansas</option>
                                        <option value="KY">&nbsp;Kentucky</option>
                                        <option value="LA">&nbsp;Louisiana</option>
                                        <option value="ME">&nbsp;Maine</option>
                                        <option value="MD">&nbsp;Maryland</option>
                                        <option value="MA">&nbsp;Massachusetts</option>
                                        <option value="MI">&nbsp;Michigan</option>
                                        <option value="MN">&nbsp;Minnesota</option>
                                        <option value="MS">&nbsp;Mississippi</option>
                                        <option value="MO">&nbsp;Missouri</option>
                                        <option value="MT">&nbsp;Montana</option>
                                        <option value="NE">&nbsp;Nebraska</option>
                                        <option value="NV">&nbsp;Nevada</option>
                                        <option value="NH">&nbsp;New Hampshire</option>
                                        <option value="NJ">&nbsp;New Jersey</option>
                                        <option value="NM">&nbsp;New Mexico</option>
                                        <option value="NY">&nbsp;New York</option>
                                        <option value="NC">&nbsp;North Carolina</option>
                                        <option value="ND">&nbsp;North Dakota</option>
                                        <option value="OH">&nbsp;Ohio</option>
                                        <option value="OK">&nbsp;Oklahoma</option>
                                        <option value="OR">&nbsp;Oregon</option>
                                        <option value="PA">&nbsp;Pennsylvania</option>
                                        <option value="PR">&nbsp;Puerto Rico</option>
                                        <option value="RI">&nbsp;Rhode Island</option>
                                        <option value="SC">&nbsp;South Carolina</option>
                                        <option value="SD">&nbsp;South Dakota</option>
                                        <option value="TN">&nbsp;Tennessee</option>
                                        <option value="TX">&nbsp;Texas</option>
                                        <option value="UT">&nbsp;Utah</option>
                                        <option value="VT">&nbsp;Vermont</option>
                                        <option value="VA">&nbsp;Virginia</option>
                                        <option value="VI">&nbsp;Virgin Islands</option>
                                        <option value="WA">&nbsp;Washington</option>
                                        <option value="WV">&nbsp;West Virginia</option>
                                        <option value="WI">&nbsp;Wisconsin</option>
                                        <option value="WY">&nbsp;Wyoming</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>ZIP<sup class="req">*</sup></label>
                                <div class="input-group">
                                       <span class="input-group-addon">
                                           <i class="fa fa-home"></i>
                                       </span>
                                    <input type="text" id="zip" class="form-control" placeholder="" value="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Country</label>
                                <div class="input-group">
                                     <span class="input-group-addon">
                                         <i class="fa fa-flag"></i>
                                     </span>
                                    <select name="country" id="country" class="form-control">
                                        <option value="blank">&nbsp;</option>
                                        <option value="af">&nbsp;Afghanistan</option>
                                        <option value="al">&nbsp;Albania</option>
                                        <option value="dz">&nbsp;Algeria</option>
                                        <option value="as">&nbsp;American Samoa</option>
                                        <option value="AD">&nbsp;Andorra</option>
                                        <option value="ao">&nbsp;Angola</option>
                                        <option value="ai">&nbsp;Anguilla</option>
                                        <option value="ar">&nbsp;Argentina</option>
                                        <option value="am">&nbsp;Armenia</option>
                                        <option value="aw">&nbsp;Aruba</option>
                                        <option value="au">&nbsp;Australia</option>
                                        <option value="at">&nbsp;Austria</option>
                                        <option value="az">&nbsp;Azerbaijan</option>
                                        <option value="BS">&nbsp;Bahamas</option>
                                        <option value="BH">&nbsp;Bahrain</option>
                                        <option value="BD">&nbsp;Bangladesh</option>
                                        <option value="BB">&nbsp;Barbados</option>
                                        <option value="BY">&nbsp;Belarus</option>
                                        <option value="BE">&nbsp;Belgium</option>
                                        <option value="BZ">&nbsp;Belize</option>
                                        <option value="BJ">&nbsp;Benin</option>
                                        <option value="BM">&nbsp;Bermuda</option>
                                        <option value="BT">&nbsp;Bhutan</option>
                                        <option value="BO">&nbsp;Bolivia</option>
                                        <option value="BA">&nbsp;Bosnia and Herzegowina</option>
                                        <option value="BW">&nbsp;Botswana</option>
                                        <option value="BV">&nbsp;Bouvet Island</option>
                                        <option value="BR">&nbsp;Brazil</option>
                                        <option value="IO">&nbsp;British Indian Ocean Territory</option>
                                        <option value="BN">&nbsp;Brunei Darussalam</option>
                                        <option value="BG">&nbsp;Bulgaria</option>
                                        <option value="BF">&nbsp;Burkina Faso</option>
                                        <option value="BI">&nbsp;Burundi</option>
                                        <option value="KH">&nbsp;Cambodia</option>
                                        <option value="CM">&nbsp;Cameroon</option>
                                        <option value="CA">&nbsp;Canada</option>
                                        <option value="CV">&nbsp;Cape Verde</option>
                                        <option value="KY">&nbsp;Cayman Islands</option>
                                        <option value="CF">&nbsp;Central African Republic</option>
                                        <option value="TD">&nbsp;Chad</option>
                                        <option value="CL">&nbsp;Chile</option>
                                        <option value="CN">&nbsp;China</option>
                                        <option value="CX">&nbsp;Christmas Island</option>
                                        <option value="CC">&nbsp;Cocos (Keeling) Islands</option>
                                        <option value="CO">&nbsp;Colombia</option>
                                        <option value="KM">&nbsp;Comoros</option>
                                        <option value="CG">&nbsp;Congo</option>
                                        <option value="CD">&nbsp;Congo, the Democratic Republic of the</option>
                                        <option value="CK">&nbsp;Cook Islands</option>
                                        <option value="CR">&nbsp;Costa Rica</option>
                                        <option value="CI">&nbsp;Cote d'Ivoire</option>
                                        <option value="HR">&nbsp;Croatia (Hrvatska)</option>
                                        <option value="CU">&nbsp;Cuba</option>
                                        <option value="CY">&nbsp;Cyprus</option>
                                        <option value="CZ">&nbsp;Czech Republic</option>
                                        <option value="DK">&nbsp;Denmark</option>
                                        <option value="DJ">&nbsp;Djibouti</option>
                                        <option value="DM">&nbsp;Dominica</option>
                                        <option value="DO">&nbsp;Dominican Republic</option>
                                        <option value="EC">&nbsp;Ecuador</option>
                                        <option value="EG">&nbsp;Egypt</option>
                                        <option value="SV">&nbsp;El Salvador</option>
                                        <option value="GQ">&nbsp;Equatorial Guinea</option>
                                        <option value="ER">&nbsp;Eritrea</option>
                                        <option value="EE">&nbsp;Estonia</option>
                                        <option value="ET">&nbsp;Ethiopia</option>
                                        <option value="FK">&nbsp;Falkland Islands (Malvinas)</option>
                                        <option value="FO">&nbsp;Faroe Islands</option>
                                        <option value="FJ">&nbsp;Fiji</option>
                                        <option value="FI">&nbsp;Finland</option>
                                        <option value="FR">&nbsp;France</option>
                                        <option value="GF">&nbsp;French Guiana</option>
                                        <option value="PF">&nbsp;French Polynesia</option>
                                        <option value="TF">&nbsp;French Southern Territories</option>
                                        <option value="GA">&nbsp;Gabon</option>
                                        <option value="GM">&nbsp;Gambia</option>
                                        <option value="GE">&nbsp;Georgia</option>
                                        <option value="DE">&nbsp;Germany</option>
                                        <option value="GH">&nbsp;Ghana</option>
                                        <option value="GI">&nbsp;Gibraltar</option>
                                        <option value="GR">&nbsp;Greece</option>
                                        <option value="GL">&nbsp;Greenland</option>
                                        <option value="GD">&nbsp;Grenada</option>
                                        <option value="GP">&nbsp;Guadeloupe</option>
                                        <option value="GU">&nbsp;Guam</option>
                                        <option value="GT">&nbsp;Guatemala</option>
                                        <option value="GN">&nbsp;Guinea</option>
                                        <option value="GW">&nbsp;Guinea-Bissau</option>
                                        <option value="GY">&nbsp;Guyana</option>
                                        <option value="HT">&nbsp;Haiti</option>
                                        <option value="HM">&nbsp;Heard and Mc Donald Islands</option>
                                        <option value="VA">&nbsp;Holy See (Vatican City State)</option>
                                        <option value="HN">&nbsp;Honduras</option>
                                        <option value="HK">&nbsp;Hong Kong</option>
                                        <option value="HU">&nbsp;Hungary</option>
                                        <option value="IS">&nbsp;Iceland</option>
                                        <option value="IN">&nbsp;India</option>
                                        <option value="ID">&nbsp;Indonesia</option>
                                        <option value="IR">&nbsp;Iran (Islamic Republic of)</option>
                                        <option value="IQ">&nbsp;Iraq</option>
                                        <option value="IE">&nbsp;Ireland</option>
                                        <option value="IL">&nbsp;Israel</option>
                                        <option value="IT">&nbsp;Italy</option>
                                        <option value="JM">&nbsp;Jamaica</option>
                                        <option value="JP">&nbsp;Japan</option>
                                        <option value="JO">&nbsp;Jordan</option>
                                        <option value="KZ">&nbsp;Kazakhstan</option>
                                        <option value="KE">&nbsp;Kenya</option>
                                        <option value="KI">&nbsp;Kiribati</option>
                                        <option value="KP">&nbsp;Korea, Democratic People's Republic of</option>
                                        <option value="KR">&nbsp;Korea, Republic of</option>
                                        <option value="KW">&nbsp;Kuwait</option>
                                        <option value="KG">&nbsp;Kyrgyzstan</option>
                                        <option value="LA">&nbsp;Lao People's Democratic Republic</option>
                                        <option value="LV">&nbsp;Latvia</option>
                                        <option value="LB">&nbsp;Lebanon</option>
                                        <option value="LS">&nbsp;Lesotho</option>
                                        <option value="LR">&nbsp;Liberia</option>
                                        <option value="LY">&nbsp;Libyan Arab Jamahiriya</option>
                                        <option value="LI">&nbsp;Liechtenstein</option>
                                        <option value="LT">&nbsp;Lithuania</option>
                                        <option value="LU">&nbsp;Luxembourg</option>
                                        <option value="MO">&nbsp;Macau</option>
                                        <option value="MK">&nbsp;Macedonia</option>
                                        <option value="MG">&nbsp;Madagascar</option>
                                        <option value="MW">&nbsp;Malawi</option>
                                        <option value="MY">&nbsp;Malaysia</option>
                                        <option value="MV">&nbsp;Maldives</option>
                                        <option value="ML">&nbsp;Mali</option>
                                        <option value="MT">&nbsp;Malta</option>
                                        <option value="MH">&nbsp;Marshall Islands</option>
                                        <option value="MQ">&nbsp;Martinique</option>
                                        <option value="MR">&nbsp;Mauritania</option>
                                        <option value="MU">&nbsp;Mauritius</option>
                                        <option value="YT">&nbsp;Mayotte</option>
                                        <option value="MX">&nbsp;Mexico</option>
                                        <option value="FM">&nbsp;Micronesia</option>
                                        <option value="MD">&nbsp;Moldova</option>
                                        <option value="MC">&nbsp;Monaco</option>
                                        <option value="MN">&nbsp;Mongolia</option>
                                        <option value="MS">&nbsp;Montserrat</option>
                                        <option value="MA">&nbsp;Morocco</option>
                                        <option value="MZ">&nbsp;Mozambique</option>
                                        <option value="MM">&nbsp;Myanmar</option>
                                        <option value="NA">&nbsp;Namibia</option>
                                        <option value="NR">&nbsp;Nauru</option>
                                        <option value="NP">&nbsp;Nepal</option>
                                        <option value="NL">&nbsp;Netherlands</option>
                                        <option value="AN">&nbsp;Netherlands Antilles</option>
                                        <option value="NC">&nbsp;New Caledonia</option>
                                        <option value="NZ">&nbsp;New Zealand</option>
                                        <option value="NI">&nbsp;Nicaragua</option>
                                        <option value="NE">&nbsp;Niger</option>
                                        <option value="NG">&nbsp;Nigeria</option>
                                        <option value="NU">&nbsp;Niue</option>
                                        <option value="NF">&nbsp;Norfolk Island</option>
                                        <option value="MP">&nbsp;Northern Mariana Islands</option>
                                        <option value="NO">&nbsp;Norway</option>
                                        <option value="OM">&nbsp;Oman</option>
                                        <option value="PK">&nbsp;Pakistan</option>
                                        <option value="PW">&nbsp;Palau</option>
                                        <option value="PA">&nbsp;Panama</option>
                                        <option value="PG">&nbsp;Papua New Guinea</option>
                                        <option value="PY">&nbsp;Paraguay</option>
                                        <option value="PE">&nbsp;Peru</option>
                                        <option value="PH">&nbsp;Philippines</option>
                                        <option value="PN">&nbsp;Pitcairn</option>
                                        <option value="PL">&nbsp;Poland</option>
                                        <option value="PT">&nbsp;Portugal</option>
                                        <option value="PR">&nbsp;Puerto Rico</option>
                                        <option value="QA">&nbsp;Qatar</option>
                                        <option value="RE">&nbsp;Reunion</option>
                                        <option value="RO">&nbsp;Romania</option>
                                        <option value="RU">&nbsp;Russian Federation</option>
                                        <option value="RW">&nbsp;Rwanda</option>
                                        <option value="KN">&nbsp;Saint Kitts and Nevis</option>
                                        <option value="LC">&nbsp;Saint LUCIA</option>
                                        <option value="VC">&nbsp;Saint Vincent and the Grenadines</option>
                                        <option value="WS">&nbsp;Samoa</option>
                                        <option value="SM">&nbsp;San Marino</option>
                                        <option value="ST">&nbsp;Sao Tome and Principe</option>
                                        <option value="SA">&nbsp;Saudi Arabia</option>
                                        <option value="SN">&nbsp;Senegal</option>
                                        <option value="SC">&nbsp;Seychelles</option>
                                        <option value="SL">&nbsp;Sierra Leone</option>
                                        <option value="SG">&nbsp;Singapore</option>
                                        <option value="SK">&nbsp;Slovakia (Slovak Republic)</option>
                                        <option value="SI">&nbsp;Slovenia</option>
                                        <option value="SB">&nbsp;Solomon Islands</option>
                                        <option value="SO">&nbsp;Somalia</option>
                                        <option value="ZA">&nbsp;South Africa</option>
                                        <option value="GS">&nbsp;South Georgia and the South Sandwich Islands</option>
                                        <option value="ES">&nbsp;Spain</option>
                                        <option value="LK">&nbsp;Sri Lanka</option>
                                        <option value="SH">&nbsp;St. Helena</option>
                                        <option value="PM">&nbsp;St. Pierre and Miquelon</option>
                                        <option value="SD">&nbsp;Sudan</option>
                                        <option value="SR">&nbsp;Suriname</option>
                                        <option value="SJ">&nbsp;Svalbard and Jan Mayen Islands</option>
                                        <option value="SZ">&nbsp;Swaziland</option>
                                        <option value="SE">&nbsp;Sweden</option>
                                        <option value="CH">&nbsp;Switzerland</option>
                                        <option value="SY">&nbsp;Syrian Arab Republic</option>
                                        <option value="TW">&nbsp;Taiwan, Province of China</option>
                                        <option value="TJ">&nbsp;Tajikistan</option>
                                        <option value="TZ">&nbsp;Tanzania, United Republic of</option>
                                        <option value="TH">&nbsp;Thailand</option>
                                        <option value="TG">&nbsp;Togo</option>
                                        <option value="TK">&nbsp;Tokelau</option>
                                        <option value="TO">&nbsp;Tonga</option>
                                        <option value="TT">&nbsp;Trinidad and Tobago</option>
                                        <option value="TN">&nbsp;Tunisia</option>
                                        <option value="TR">&nbsp;Turkey</option>
                                        <option value="TM">&nbsp;Turkmenistan</option>
                                        <option value="TC">&nbsp;Turks and Caicos Islands</option>
                                        <option value="TV">&nbsp;Tuvalu</option>
                                        <option value="UG">&nbsp;Uganda</option>
                                        <option value="UA">&nbsp;Ukraine</option>
                                        <option value="AE">&nbsp;United Arab Emirates</option>
                                        <option value="GB">&nbsp;United Kingdom</option>
                                        <option value="US" selected>&nbsp;United States</option>
                                        <option value="UM">&nbsp;United States Minor Outlying Islands</option>
                                        <option value="UY">&nbsp;Uruguay</option>
                                        <option value="UZ">&nbsp;Uzbekistan</option>
                                        <option value="VU">&nbsp;Vanuatu</option>
                                        <option value="VE">&nbsp;Venezuela</option>
                                        <option value="VN">&nbsp;Viet Nam</option>
                                        <option value="VG">&nbsp;Virgin Islands (British)</option>
                                        <option value="VI">&nbsp;Virgin Islands (U.S.)</option>
                                        <option value="WF">&nbsp;Wallis and Futuna Islands</option>
                                        <option value="EH">&nbsp;Western Sahara</option>
                                        <option value="YE">&nbsp;Yemen</option>
                                        <option value="ZM">&nbsp;Zambia</option>
                                        <option value="ZW">&nbsp;Zimbabwe</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group" style="text-align: center;">
                                <button class="btn default" id="back2" type="button" style="display: inline-block; text-align: center">
                                    <i class="fa fa-arrow-left fa-fw"></i> Back
                                </button>
                                <button class="btn btn-info" id="continue2" type="button">
                                    Continue <i class="fa fa-arrow-right fa-fw"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                    <form role="form" id="form3" style="display: none;">
                        <div class="progress"><a name="4"></a>
                            <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%">
                                75%
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Invention Name</label>
                                <div class="input-group">
                                  <span class="input-group-addon">
                                    <i class="fa fa-th-large"></i>
                                  </span>
                                    <input type="text" id="ideaname" class="form-control" placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="xs-shrink">Please describe your product or concept. What does it do? How does it work? What is it made from?<sup class="req">*</sup><br>(Provide as much detail as possible)</label>
                                <label class="xs-shrink" style="float:right;">Minimum 120 characters (<span id="labelCount">0</span>)</label>
                                <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-th-large"></i>
                                        </span>
                                    <textarea rows="8" id="ideaconcept" class="form-control auto_save" placeholder=""></textarea>
                                </div><br><span class="addwarn"></span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="xs-shrink">When and how did you think of this invention?<sup class="req">*</sup></label>
                                <label class="xs-shrink" id="labelCount1" style="float:right;">Minimum 12 characters (<span id="labelCount">0</span>)</label>
                                <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-th-large"></i>
                                        </span>
                                    <textarea rows="3"  id="hisidea" class="form-control auto_save" placeholder=""></textarea>
                                </div><br><span class="addwarn1"></span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="xs-shrink">Are you aware of any similar product on the market? If so, how is your product different, unique, or better?</label>
                                <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-th-large"></i>
                                        </span>
                                    <input type="text" id="similar_products" class="form-control auto_save" placeholder="">
                                </div><br>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="xs-shrink">What problem does your invention solve?<sup class="req">*</sup></label>
                                <label class="xs-shrink" id="labelCount2" style="float:right;">Minimum 12 characters (<span id="labelCount">0</span>)</label>
                                <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-th-large"></i>
                                        </span>
                                    <input type="text" id="probidea" class="form-control auto_save" placeholder="">
                                </div><br><span class="addwarn2"></span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group col-md-7">
                                <label class="xs-shrink">Is your idea software or an app?</label>
                                <div class="input-group">
                                    <select  id="selectIsApp" style="width: 170px;">
                                        <option value="0">NO</option>
                                        <option value="1">YES</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-5 hidden" id="select-language-container">
                                <label class="xs-shrink">Select Computer Programming Language</label>
                                <div class="input-group">
                                    <select  id="selectLanguage" style="width: 170px;">
                                        <option value="0">--Language--</option>
                                        <option value="java">Java</option>
                                        <option value="python">Python</option>
                                        <option value="c">C</option>
                                        <option value="c++">C++</option>
                                        <option value="c#">C#</option>
                                        <option value="ruby">Ruby/Rails</option>
                                        <option value="objective-C">Objective-C(iOS)</option>
                                        <option value="javaScript">JavaScript</option>
                                        <option value="php">PHP</option>
                                    </select>
                                </div><br><span class="addwarn3"></span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <p><sup class="req">*</sup>Required Fields</p>
                            <div class="form-group" style="text-align: center;">
                                <button class="btn default button-previous" id="back3" type="button" style="display: inline-block;">
                                    <i class="fa fa-arrow-left fa-fw"></i> Back
                                </button>
                                <button class="btn btn-info button-next" id="continue3" type="button">
                                    Continue <i class="fa fa-arrow-right fa-fw"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                    <form role="form" id="form4" style="display: none;">
                        <div class="progress"><a name="3"></a>
                            <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                100%
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>List all Inventors</label>
                                <div class="input-group">
                                       <span class="input-group-addon">
                                           <i class="fa fa-user"></i>
                                       </span>
                                    <input type="text" id="pinventors" class="form-control" placeholder="">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Primary Inventor Occupation</label>
                                <div class="input-group">
                                   <span class="input-group-addon">
                                       <i class="fa fa-wrench"></i>
                                   </span>
                                    <input type="text" id="occupation" class="form-control" placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>List all Third-Party Authorized Contacts</label>
                                <div class="input-group">
                                 <span class="input-group-addon">
                                     <i class="fa fa-user"></i>
                                 </span>
                                    <input type="text" id="tpacontact" class="form-control" placeholder="">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="shrink">Has a patent attorney been hired?</label>
                                <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-bank"></i>
                                </span>
                                    <select class="form-control" id="patsearch" >
                                        <option></option>
                                        <option selected>No</option>
                                        <option>Yes</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="shrink">Has a licensing agency been hired?</label>
                                <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-building"></i>
                                </span>
                                    <select class="form-control" id="patented">
                                        <option></option>
                                        <option selected>No</option>
                                        <option>Yes</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group" style="text-align: center;">
                                <button data-fileno="" class="btn btn-success button-next" id="submit" type="button">
                                    Submit <i class="fa fa-arrow-right fa-fw"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>



            <div class="clearfix"></div>
        </div>
    </div>

@endsection

@section('footer_scripts')
    <script type="text/javascript">
        setTimeout(function(){var a=document.createElement("script");
            var b=document.getElementsByTagName("script")[0];
            a.src=document.location.protocol+"//script.crazyegg.com/pages/scripts/0063/0306.js?"+Math.floor(new Date().getTime()/3600000);
            a.async=true;a.type="text/javascript";b.parentNode.insertBefore(a,b)}, 1);
    </script>

    <script type="text/javascript">

        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-965262-61']);
        _gaq.push(['_trackPageview']);

        (function() {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
        })();
    </script>
@endsection

