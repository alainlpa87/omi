@extends('omi.layout.head')
@section('title','Patent Services USA')
@section('header_styles')
    <link href="{{ asset('/css/launch.css') }}" rel="stylesheet">
    <link href="{{ asset('/plugins/bootstrap/bootstrap-datetimepicker.css')}}" rel="stylesheet"/>
@endsection
@if(setlocale(LC_MONETARY, 'en_US.UTF-8'))@endif
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        COMPLETE YOUR PROFILE
                    </div>
                    <div class="panel-body">
                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                            <label>First Name</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input type="text" class="form-control cleanBorder" id="fname" name="fname" value="{{$client->fname}}" />
                            </div>
                        </div>
                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                            <label>Last Name</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input type="text" class="form-control" id="lname" name="lname" value="{{$client->lname}}" />
                            </div>
                        </div>
                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                            <label>Phone Number</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                <input type="text" class="form-control cleanBorder" id="phone" name="phone" value="{{$client->phone}}" />
                            </div>
                        </div>
                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                            <label>2nd Phone Number</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                <input type="text" class="form-control cleanBorder" id="phone2" name="phone2" value="{{$client->phone2}}" />
                            </div>
                        </div>
                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                            <label>Email Address</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                <input type="text" class="form-control cleanBorder" id="email" name="email" value="{{$client->email}}" />
                            </div>
                        </div>
                        <div class="form-group col-md-6 col-sm-6 col-xs-12">
                            <label>FILENO</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span>
                                <input type="text" class="form-control" readonly id="fileno" name="fileno" value="{{$client->fileno}}" />
                            </div>
                        </div>
                        <hr>
                        @if($client->hasContractSold())
                            <div class="groupAddress">
                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <label>Address</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-home"></i></span>
                                        <input type="text" class="form-control" id="address" name="address" value="{{$client->street}}" />
                                    </div>
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <label>City/Town</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-home"></i></span>
                                        <input type="text" class="form-control" id="city" name="city" value="{{$client->city}}" />
                                    </div>
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <label>State</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-home"></i></span>
                                        <input type="text" class="form-control" id="state" name="state" value="{{$client->state}}" />
                                    </div>
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <label>ZIP Code</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-home"></i></span>
                                        <input type="text" class="form-control" id="zip" name="zip" value="{{$client->zip}}" />
                                    </div>
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <label>Country</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-home"></i></span>
                                        @if($country = $client->country)@endif
                                        @include('omi.tools.country')
                                    </div>
                                </div>
                            </div>
                            <div class="groupPersonal">
                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <label>Date of Birth</label>
                                    <div class='input-group date' id='datetimepickerStart' data-default="{{$client->birth}}">
                                        <input type='text' class="form-control" />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <label>Spouse's Name</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input type="text" class="form-control" id="spouse" name="spouse" value="{{$client->spouse}}" />
                                    </div>
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <label>Children's Names</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-child"></i></span>
                                        <input type="text" class="form-control" id="children" name="children" value="{{$client->children}}" />
                                    </div>
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <label>Education</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-graduation-cap"></i></span>
                                        <input type="text" class="form-control" id="college" name="college" value="{{$client->college}}" />
                                    </div>
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <label>Degree/Diploma</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-university"></i></span>
                                        <input type="text" class="form-control" id="degree" name="degree" value="{{$client->degree}}" />
                                    </div>
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <label>Profession</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-wrench"></i></span>
                                        <input type="text" class="form-control" id="profession" name="profession" value="{{$client->profession}}" />
                                    </div>
                                </div>
                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <label>Hobbies</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-futbol-o"></i></span>
                                        <input type="text" class="form-control" id="hobby" name="hobby" value="{{$client->hobby}}" />
                                    </div>
                                </div>
                            </div>
                        @endif
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
@endsection

@section('footer_scripts')

@endsection

