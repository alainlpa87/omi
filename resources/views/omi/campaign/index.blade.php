<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Protect Your Product & Invention Idea with a Patent - Patent Services USA</title>
    <!-- CSS  ================================================== -->
    <link href="{{ asset('/plugins/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.min.css"/>
    <link href="{{ asset('/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('https://fonts.googleapis.com/css?family=Knewave') }}" rel='stylesheet' type='text/css'>
    <link href="{{ asset('/css/omiCommon.css') }}" rel="stylesheet">
    <link href="{{ asset('/plugins/launchTemplate/css/basic.css') }}" rel="stylesheet" />
    <link href="{{ asset('/plugins/launchTemplate/css/custom.css') }}" rel="stylesheet" />
    <link href="{{ asset('/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ asset('/plugins/component/components.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ asset('/css/hover-min.css')}}" rel="stylesheet" media="all">
    <link href="{{ asset('/css/launch.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/omiProject.css') }}" rel="stylesheet">
</head>
<body>
<div class="container-fluid">
    <div class="well page-header" align="center">
        <img class="img-responsive img-rounded"  src="{{ asset('/img/logo.png') }}">
    </div>
    <div class="row">
        <div class="col-md-5">

            <div class="img-thumbnail" style="box-shadow: 0 0 15px gray;">
                <div>
                    <img class="img-responsive" src="{{asset('/img/form-header.png')}}">
                </div>
                <div class="center_form" style="background-color: #dcf5f9;">
                    <div id="campaign_form" >
                        <div style="padding:20px;">
                            <div class="display-none step" id="step-1" style="display: block;">
                                <h5>Your contact information:</h5>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="input-group has-success">
                                            <span class="input-group-addon" id="name">
                                                <i class="glyphicon glyphicon-user"></i>
                                            </span>
                                            <input class="form-control has-success" name="first_name" id="first_name" placeholder="First name *" aria-describedby="name" type="text" maxlength="100" required="" autocomplete="smartystreets">
                                            <input class="form-control has-success" name="last_name" id="last_name" placeholder="Last name *" aria-describedby="name" type="text" maxlength="100" required="" autocomplete="smartystreets">
                                        </div>
                                        <br>
                                        <div class="input-group has-success">
                                            <span class="input-group-addon" id="email">
                                                <i class="fa fa-at"></i>
                                            </span>
                                            <input class="form-control has-success" id="email_address" name="email" placeholder="Email address *" aria-describedby="email" type="email" maxlength="100" validation="email" required="" autocomplete="smartystreets">
                                        </div>
                                        <br>
                                        <div class="input-group has-success">
                                            <span class="input-group-addon" id="phone">
                                                <i class="glyphicon glyphicon-phone"></i>
                                            </span>
                                            <input class="form-control has-success" id="phone_number" name="phone" placeholder="Phone *" aria-describedby="phone" maxlength="100" type="text" validation="phone" required="" autocomplete="smartystreets">
                                        </div>
                                        <br>
                                        <div class="input-group has-success">
                                            <span class="input-group-addon" id="evening-phone">
                                                <i class="glyphicon glyphicon-phone-alt"></i>
                                            </span>
                                            <input class="form-control" id="2nd_phone" name="2nd_phone" placeholder="2nd phone" aria-describedby="2nd-phone" maxlength="100" type="text" validation="phone" autocomplete="smartystreets">
                                        </div>
                                        <br>
                                        <div class="input-group has-success">
                                            <span class="input-group-addon" id="password">
                                                <i class="glyphicon glyphicon-lock"></i>
                                            </span>
                                            <input class="form-control" id="passw" name="password"  type="password" placeholder="Password" >
                                        </div>
                                        <div class="input-group has-success">
                                            <span class="input-group-addon" id="password-confirm">
                                                <i class="glyphicon glyphicon-lock"></i>
                                            </span>
                                            <input class="form-control" id="passwordConfirm" name="passwordConfirm"  type="password" placeholder="Confirm Password">
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="display-none step" id="step-2" style="display: none;">
                                <h5>Your address:</h5>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="input-group has-success">
                                            <span class="input-group-addon">
                                                <i class="fa fa-map-signs"></i>
                                            </span>
                                            <input class="form-control has-success" id="street" name="address" placeholder="Address *" aria-describedby="address" maxlength="100" type="text" required="" autocomplete="off">
                                            <input class="form-control" id="suite" name="suite" placeholder="Suite/Apt" aria-describedby="suite" maxlength="100" type="text" autocomplete="smartystreets">
                                        </div>
                                        <br>
                                        <div class="input-group has-success">
                                            <span class="input-group-addon">
                                                <i class="glyphicon glyphicon-map-marker"></i>
                                            </span>
                                            <input class="form-control has-success" id="city" name="city" placeholder="City *" aria-describedby="city" maxlength="100" style="max-width:30%" type="text" required="" autocomplete="smartystreets">
                                            <select id="state" name="state" class="form-control has-success" style="width:20%;" required="">
                                                <option value="">State</option>
                                                <option value="AL">AL</option>
                                                <option value="AK">AK</option>
                                                <option value="AZ">AZ</option>
                                                <option value="AR">AR</option>
                                                <option value="CA">CA</option>
                                                <option value="CO">CO</option>
                                                <option value="CT">CT</option>
                                                <option value="DE">DE</option>
                                                <option value="DC">DC</option>
                                                <option value="FL">FL</option>
                                                <option value="GA">GA</option>
                                                <option value="HI">HI</option>
                                                <option value="ID">ID</option>
                                                <option value="IL">IL</option>
                                                <option value="IN">IN</option>
                                                <option value="IA">IA</option>
                                                <option value="KS">KS</option>
                                                <option value="KY">KY</option>
                                                <option value="LA">LA</option>
                                                <option value="ME">ME</option>
                                                <option value="MD">MD</option>
                                                <option value="MA">MA</option>
                                                <option value="MI">MI</option>
                                                <option value="MN">MN</option>
                                                <option value="MS">MS</option>
                                                <option value="MO">MO</option>
                                                <option value="MT">MT</option>
                                                <option value="NE">NE</option>
                                                <option value="NV">NV</option>
                                                <option value="NH">NH</option>
                                                <option value="NJ">NJ</option>
                                                <option value="NM">NM</option>
                                                <option value="NY">NY</option>
                                                <option value="NC">NC</option>
                                                <option value="ND">ND</option>
                                                <option value="OH">OH</option>
                                                <option value="OK">OK</option>
                                                <option value="OR">OR</option>
                                                <option value="PA">PA</option>
                                                <option value="RI">RI</option>
                                                <option value="SC">SC</option>
                                                <option value="SD">SD</option>
                                                <option value="TN">TN</option>
                                                <option value="TX">TX</option>
                                                <option value="UT">UT</option>
                                                <option value="VT">VT</option>
                                                <option value="VA">VA</option>
                                                <option value="WA">WA</option>
                                                <option value="WV">WV</option>
                                                <option value="WI">WI</option>
                                                <option value="WY">WY</option>
                                            </select>
                                            <input class="form-control has-success" id="zip" name="zip" placeholder="Zip code *" aria-describedby="zip" maxlength="5" style="max-width:25%" type="text" required="" autocomplete="smartystreets">
                                            <select name="country"  placeholder="Country *" id="country" required="" style="width:25%;" autocomplete="smartystreets" class="form-control has-success">
                                                <option value="">Country</option>
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
                                                <option value="US" selected>&nbsp;USA</option>
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

                            </div>

                            <div class="display-none step" id="step-3" style="display: none;">
                                <h5>Invention Name *</h5>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <input class="form-control" id="product_name" name="product_name" type="text" required="" autocomplete="smartystreets">
                                    </div>
                                </div>

                                <h5>Please describe your product or concept. What does it do? How does it work? What is it made from?*</h5>
                                <label class="xs-shrink" style="float:right;">Minimum 120 characters (<span id="labelCount">0</span>)</label>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="input-group">
                                            <textarea name="idea" id="product_desc" name="product_desc" class="form-control" cols="50" rows="7" required=""></textarea>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <h5>When and how did you think of this invention?*</h5>
                                <label class="xs-shrink" style="float:right;">Minimum 12 characters (<span id="labelCount1">0</span>)</label>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="input-group">
                                            <textarea name="when_how" id="when_how" class="form-control" cols="50" rows="3" required=""></textarea>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <h5>Are you aware of any similar product on the market? If so, how is your product different, unique, or better?</h5>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="input-group">
                                            <textarea name="similar_product" id="similar_product" class="form-control" cols="50" rows="1"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <h5>What problem does your invention solve?*</h5>
                                <label class="xs-shrink" style="float:right;">Minimum 10 characters (<span id="labelCount2">0</span>)</label>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="input-group">
                                            <textarea name="problem_solve" id="problem_solve" class="form-control" cols="50" rows="1"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <h5>Is your idea software or an app?(Select Computer Programming Language)</h5>
                                <div class="input-group has-success row" style="padding-right: 15px !important;padding-left: 15px !important;">
                                            <span class="input-group-addon">
                                                <i class="glyphicon glyphicon-map-marker"></i>
                                            </span>
                                    <select id="isApp" name="isApp" class="form-control has-success" style="width:20%;" required="">
                                        <option value="0">NO</option>
                                        <option value="1">YES</option>
                                    </select>
                                    <select  id="selectLanguage" name="language" class="form-control has-success hidden"  style="margin-left: 20px !important;width: 50%;">
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
                                </div>
                                <br>
                                <div class="row">
                                    {{--<div class="col-xs-2">--}}
                                        <input type="checkbox" id="statement" class="pull-left" name="statement" value="" maxlength="2" required="">
                                    {{--</div>--}}
                                    <div class="col-xs-10 label-statement">
                                        <small>Check here if you've read and understand the agreement below.</small>
                                    </div>
                                </div>

                                <br>
                                <small>
                                    I fully understand that the submission of my idea, product or new invention to Patent Services IS NOT A RELEASE. I further understand that Patent Services will not, under any circumstance, use, disclose, assign, modify or solicit my idea, product or new invention to any other individual, organization, corporation or entity without my expressed written and verbal authorization. I also acknowledge that all employees, contractors, affiliates, strategic partners and representatives of Patent Services have voluntarily signed a confidentiality agreement for my privacy and protection.
                                </small>
                            </div>

                            <div class="display-none step" id="step-4" style="display: none;">
                                <h5>List all Inventors </h5>
                                <div class="row">
                                    <div class="input-group has-success">
                                            <span class="input-group-addon" id="name">
                                                <i class="glyphicon glyphicon-user"></i>
                                            </span>
                                        <input class="form-control has-success" name="list_inventors" id="list_inventors"  aria-describedby="name" type="text" maxlength="100">
                                    </div>
                                </div>
                                <br>
                                <h5>Primary Inventor Occupation </h5>
                                <div class="row">
                                    <div class="input-group has-success">
                                            <span class="input-group-addon" id="name">
                                                <i class="glyphicon glyphicon-wrench"></i>
                                            </span>
                                        <input class="form-control has-success" name="inv_ocupation" id="inv_ocupation"  aria-describedby="name" type="text" maxlength="100">
                                    </div>
                                </div>
                                <br>
                                <h5>List all Third-Party Authorized Contacts</h5>
                                <div class="row">
                                    <div class="input-group has-success">
                                            <span class="input-group-addon" id="name">
                                                <i class="glyphicon glyphicon-user"></i>
                                            </span>
                                        <input class="form-control has-success" name="third_party" id="third_party"  aria-describedby="name" type="text" maxlength="100">
                                    </div>
                                </div>
                                <br>
                                <h5>Has a patent attorney been hired?&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                   Has a licensing agency been hired?</h5>
                                <div class="has-success row">
                                    <div class="input-group has-success">
                                    <span class="input-group-addon" id="name">
                                                <i class="glyphicon glyphicon-arrow-down"></i>
                                            </span>
                                    <select id="att_hired" name="att_hired" class="form-control has-success" style="width:40%;">
                                        <option value="0">NO</option>
                                        <option value="1">YES</option>
                                    </select>
                                    <span class="input-group-addon" id="name" style="margin-left: 130px !important;">
                                                <i class="glyphicon glyphicon-arrow-down"></i>
                                            </span>
                                    <select  id="licensing_hired" name="licensing_hired" class="form-control has-success"  style="width: 40%;">
                                        <option value="0">NO</option>
                                        <option value="1">YES</option>
                                    </select>
                                        </div>
                                </div>
                                <br>
                            </div>

                            <div class="display-none step" id="step-5">
                                <h3>Thank you for you inquiry!</h3>
                                One of our invention specialists will be getting back to you shortly.
                            </div>
                            <br>
                            <div class="row navigation">
                                <div class="col-xs-5 col-xs-push-1">
                                    <a class="btn btn-default btn-sm hidden" id="back" data-step="1"><i class="fa fa-arrow-circle-o-left"></i> Back</a>
                                </div>
                                <div class="col-xs-5 col-xs-push-1 text-right">
                                    <a class="btn btn-primary btn-sm" id="next" data-step="1">Next <i class="fa fa-arrow-circle-o-right"></i></a>
                                </div>
                            </div>

                            <br>
                            <div id="progress" class="progress">
                                <div class="progress-bar progress-bar-striped" role="progressbar" id="progress_bar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 15%">
                                    <span>Step 1 of 5</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-md-7">
            <div class="embed-responsive embed-responsive-16by9">
                <iframe src="https://www.youtube.com/embed/pKC6fqN_W2E?rel=0" frameborder="0" allowfullscreen=""></iframe>
            </div>
            <h4>Our Products have sold in over 1,000 stores including:</h4>
            <img class="img-responsive img-thumbnail" src="{{asset('/img/campainImages.jpg')}}" style="width: 100%;">

        </div>
    </div>

</div>
</body>

<div id="footer-sec" class="pre-footer">
    <div class="container">

        <div class="row">

            <div class="col-md-6 col-sm-6 pre-footer-col">
                <h2>Inventors Welcome</h2>
                <p>Patents aren't just for big biz.  We offer free consultation and support for independent inventors.  Strength comes in numbers.</p><a class="btn-call" href='sub'><i class="fa fa-rocket margin-right-10"></i>Get Started FREE</a>
            </div>
            <div class="col-md-3 col-xs-12">
                <h2>Contact Us</h2>
                <address>
                    <strong> Patent Services USA </strong><br>
                    12000 Biscayne Blvd., Suite 700<br>
                    North Miami, FL 33181<br>
                </address>
            </div>
            <div class="col-md-3 col-xs-12">
                <h2>&nbsp;</h2>
                <address>
                    Phone: 1-888-34-INVENT(46836)<br>
                    Phone UK: +44 7441 907200<br>
                    Fax: 1-800-886-7951<br>
                    Email: <a href="mailto:admin@ownmyinvention.com">admin@ownmyinvention.com</a><br>
                </address>
            </div>
            <!-- END BOTTOM CONTACTS -->
            <div class="col-md-12">
                <p class="col-md-6">©2012-2014 PATENT SERVICES. All Rights Reserved.<img class="medalions" src="{{ asset('img/logos/wht_seal.png')}}" alt="Platinum Medalion" width="15%"><a href="http://www.inventpalooza.com/" target="_blank"><img class="medalions" src="{{ asset('img/logos/palooza_200.png')}}" alt="InventPalooza" width="20%"></a></p>
                <ul class="col-md-3 ulFooter">
                    <li><a href="../../../terms-and-conditions.php">Terms and Conditions</a></li>
                    <li><a href="../../../legal.php">Legal</a></li>
                    <li><a href="../../../privacy.php">Privacy</a></li>
                </ul>
                <div class="col-md-3">
                <span>
                    <a target="_blank" href="//www.facebook.com/PatentServicesUSA"><img style="vertical-align:middle;margin-left:10px;" src="{{asset('/img/social/fb.png')}}"></a>
                   <a target="_blank" href="//plus.google.com/+OwnMyInvention"><img style="vertical-align:middle;margin-left:10px;" src="{{asset('/img/social/g+.png')}}"></a>
                   <a target="_blank" href="//www.linkedin.com/company/patent-services-usa"><img style="vertical-align:middle;margin-left:10px;" src="{{asset('/img/social/linkedin.png')}}"></a>
                   <a target="_blank" href="//twitter.com/patsvcusa"><img style="vertical-align:middle;margin-left:10px;" src="{{asset('/img/social/twitter.png')}}"></a>
                    <a target="_blank" href="//www.pinterest.com/PatSvcUSA/"><img style="vertical-align:middle;margin-left:10px;" src="{{asset('/img/social/pintreste.png')}}"></a>
                </span>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('/plugins/jquery/jquery-1.11.3.js') }}" type="text/javascript"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.min.js"></script>
<script src="{{asset("/plugins/bootstrap/bootstrap.min.js")}}"></script>
<script src="{{asset("js/autoNumeric.js")}}" type="text/javascript"></script>
<script src="{{asset("/js/tools.js")}}" type="text/javascript"></script>
<script src="{{asset("/js/omi/campaign.js")}}" type="text/javascript"></script>
<script src="{{asset("/plugins/sweetalert/sweetalert.min.js")}}"></script>
<script src="{{asset("/plugins/bootstrap/moment.js")}}"></script>


