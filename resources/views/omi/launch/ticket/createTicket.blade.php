@extends('omi.layout.head')
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
                <div class="col-md-3">
                    <b>Select a Project</b>
                </div>
                <div class="col-md-3">
                    <select class="form-control" name="selectProjectTicket" id="selectProjectTicket">
                        <option value="-1">Select Project</option>
                        @foreach($projectsFromLead as $proj)
                            <option value="{{$proj->id}}">{{ucwords($proj->ideaName)}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 10px;">
                <div class="col-md-3">
                    <b>Ticket Subject</b>
                </div>
                <div class="col-md-4">
                    <input type="text" name="ticketName" id="ticketName"  class="form-control">
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 10px;">
                <div class="col-md-3">
                    <b>Describe the problem</b>
                </div>
                <div class="col-md-6">
                    <textarea rows="15" cols="30" name="ticketText" id="ticketText"  class="form-control"></textarea>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 10px;">
                <div class="col-md-offset-7 col-md-2">
                    <button id="createTicket" class="btn btn-primary" style="width: 100%;">OPEN</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer_scripts')

@endsection

