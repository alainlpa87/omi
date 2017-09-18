@extends('intranet.layouts.default')
@section('header_styles')
    <link href="{{ asset('/css/project.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/clientServices.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/modal.css') }}" rel="stylesheet">
    <link href="{{ asset('/plugins/bootstrap/datepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('/plugins/bootstrap/buttons.dataTables.min.css')}}" rel="stylesheet"/>
@endsection
@include('intranet.layouts.mobile')
@section('content')

    {{--include Common Layout--}}
    @include('intranet.layouts.common')
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-3 col-xs-12 container-tools-left">
                <div class="container-dialer">
                    <h4 class="totalProjects">Projects with Open Tickets</h4>
                      @foreach($projectsWithTicket as $projTicket)
                        <div class="col-md-12 col-xs-6" style="margin-top: 5px;cursor: pointer;">
                            <a data-toggle="collapse">
                                <i>
                                    <h4 class="panel-title showTickets" data-pid="{{$projTicket->project_id}}"><span style="color: red">&bull;</span>{{"Fileno: ".$projTicket->lead->fileno." PIN: ".$projTicket->project_id}}:</h4>
                                </i>
                            </a>
                        </div><br>
                        @endforeach
                </div>
            </div>
            <div class="col-md-2 col-xs-12 container-tools-right">
                <button class="btn btn-primary" id="goHome" style="width: 100%;">HOME</button>
            </div>
            <div class="page-container">
                <div class="leadroll">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-3">
                            <div class="panel-group" id="accordionTickets">
                                <h3 class="col-md-12 hidden" id="csHeader">Client Services Tickets</h3>
                                <div class="col-md-12 col-xs-12" id="csTickets"></div>
                                <h3 class="col-md-12 hidden" id="prodHeader">Production Tickets</h3>
                                <div class="col-md-12 col-xs-12" id="prodTickets"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(setlocale(LC_MONETARY, 'en_US.UTF-8'))@endif
    @include('intranet.tools.loadingModal')

@endsection
@section('footer_scripts')
    <script src="{{asset("plugins/jquery/jquery.expandable.js")}}"></script>
    <script src="{{asset("js/common.js")}}"></script>
    <script src="{{asset("js/ticket.js")}}"></script>
    {{--upload file--}}
    <script src="{{asset("plugins/jquery/dropzone.js")}}"></script>

    <script src="{{asset("/plugins/bootstrap/moment.min.js")}}"></script>
    <script src="{{asset("/plugins/bootstrap/bootstrap-datepicker.js")}}"></script>
    <script src="{{asset("/plugins/bootstrap/bootstrap-datepaginator.min.js")}}"></script>
    <script src="{{asset("/plugins/bootstrap/jquery.dataTables.min.js")}}"></script>
    <script src="{{asset("/plugins/bootstrap/dataTables.bootstrap.min.js")}}"></script>
    <script src="{{asset("/plugins/bootstrap/dataTables.buttons.min.js")}}"></script>
    <script src="{{asset("/plugins/bootstrap/buttons.print.min.js")}}"></script>
@endsection
