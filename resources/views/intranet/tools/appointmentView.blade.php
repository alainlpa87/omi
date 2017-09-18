@extends('intranet.layouts.default')
@section('title')
    APPOINTMENT
@endsection
@section('header_styles')
    <link href="{{ asset('/css/lead.css') }}" rel="stylesheet">
@endsection
@section('content')
    <textarea rows="8" disabled class="appointmentViewTextarea">{{$note}}</textarea>
@endsection
@section('footer_scripts')
@endsection
