
<?php $__env->startSection('title'); ?>
    Patent Services USA
<?php $__env->stopSection(); ?>

<?php $__env->startSection('header_styles'); ?>
    <link href="<?php echo e(asset('/css/newRegister.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid registerContainer">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="panel borderDivRegister panel-primary" >
                    <div class="panel-heading panel-register {">
                        COMPLETE YOUR PROFILE
                    </div>
                    <div class="panel-body">
                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                            <label>First Name</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input type="text" class="form-control cleanBorder" id="fname" name="fname" value="<?php echo e(isset($fname)?$fname:""); ?>" />
                            </div>
                        </div>
                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                            <label>Last Name</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input type="text" class="form-control" id="lname" name="lname" value="<?php echo e(isset($lname)?$lname:""); ?>" />
                            </div>
                        </div>
                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                            <label>Phone Number</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                <input type="text" class="form-control cleanBorder" id="phone" name="phone" value="<?php echo e(isset($phone)?$phone:""); ?>" />
                            </div>
                        </div>
                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                            <label>Email Address</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                <input type="text" class="form-control cleanBorder" id="email" name="email" value="<?php echo e(isset($email)?$email:""); ?>" />
                            </div>
                        </div>
                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                            <label>Password</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input type="password" class="form-control cleanBorder" id="password" name="password" value="" />
                            </div>
                        </div>
                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                            <label>Confirm Password</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input type="password" class="form-control cleanBorder" id="confirmPassword" name="confirmPassword" value="" />
                            </div>
                        </div>
                        <hr>
                        <div class="groupAddress">
                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                <label>Address</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-home"></i></span>
                                    <input type="text" class="form-control" id="address" name="address" value="" />
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                <label>City/Town</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-home"></i></span>
                                    <input type="text" class="form-control" id="city" name="city" value="" />
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                <label>State</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-home"></i></span>
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
                            <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                <label>ZIP Code</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-home"></i></span>
                                    <input type="text" class="form-control" id="zip" name="zip" value="" />
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                <label>Country</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-home"></i></span>
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
                        <input type="hidden" id="category" value="<?php echo e(isset($category)?$category:""); ?>">
                        <input type="hidden" id="patent" value="<?php echo e(isset($patent)?$patent:""); ?>">
                        <input type="hidden" id="areLeast18" value="<?php echo e(isset($areLeast18)?$areLeast18:""); ?>">
                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                            <button id="btnSaveProfile" class="btn btn-success center-block btnSave" type="button">
                                <i class="fa fa-floppy-o"></i>
                                <strong>Save</strong>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
    <script src="<?php echo e(asset('/js/omi/register.js')); ?>" type="text/javascript"></script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('omi.layout.land', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>