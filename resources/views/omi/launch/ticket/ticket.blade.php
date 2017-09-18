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
            <div class="col-md-12 panel-group" id="accordionTickets">
                @foreach($tickets as $ticket)
                    <div class="col-md-12 col-sm-12 col-xs-12" id="ticketContainer_{{$ticket->id}}">
                        <div class="panel-heading">
                            <a data-toggle="collapse" data-parent="#accordionTickest" href="#collapseTicket_{{$ticket->id}}">
                                <i>
                                    <h4 class="panel-title col-md-6" style="border: solid #000000 1px;"><span style="color: red">&bull;</span>{{$ticket->name."  ------ ".date('m/d/Y',strtotime($ticket->created_at))}}:</h4>
                                </i>
                            </a>
                        </div>
                        <div id="collapseTicket_{{$ticket->id}}" class="collapse col-md-12">
                            <div id="containerReplies_{{$ticket->id}}">
                            @foreach($replies[$ticket->id] as $reply)
                                <div class="col-md-8 col-sm-12 col-xs-12">
                                    <b class="col-md-4">{{ucwords($reply->author)}} : </b>
                                    <p class="pSmall col-md-8">{{$reply->message}}</p>
                                </div>
                            @endforeach
                            </div>
                            <div div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="col-md-1"><i class="fa fa-reply writeReply" data-tid="{{$ticket->id}}" style="color: lightskyblue;cursor: pointer !important;"></i></div>
                                <div class="col-md-3 col-md-offset-5"><button class="btn btn-danger closeTicket" id="closeTicket" data-tid="{{$ticket->id}}">Close Ticket</button></div>
                                <div class="col-md-8 hidden" id="writeRticket_{{$ticket->id}}" style="margin-top: 10px !important;">
                                    <textarea rows="7" cols="30" name="replyText" id="replyText_{{$ticket->id}}"  class="form-control"></textarea>
                                </div>
                            </div>
                            <div div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 10px !important;">
                                <div class="col-md-offset-4 col-md-4 col-sm-12 col-xs-12">
                                    <button class="btn btn-danger cancelReplyTicket hidden" id="cancelReplyTicket_{{$ticket->id}}" data-tid="{{$ticket->id}}">Cancel</button>
                                    <button class="btn btn-success addReplyTicket pull-right hidden" id="addReplyTicket_{{$ticket->id}}" data-tid="{{$ticket->id}}">Reply</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-md-12 panel-group" style="margin-top: 30px !important;">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <button class="btn btn-primary" id="openTicket">OPEN TICKET</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer_scripts')

@endsection

