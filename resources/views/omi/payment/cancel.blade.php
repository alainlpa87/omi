@extends('omi.layout.head')
@section('title','Patent Services USA')
@section('header_styles')
    <link href="{{ asset('/css/common.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/launch.css') }}" rel="stylesheet">
@endsection
@section('content')
    <h1 align="center"><strong>Patent Services Payment Terminal</strong></h1>
    <h2 class="subTitles"> Payment Cancelled!!</h2>
    <a class="btn btn-primary" href="{{url('launch')}}">Go back to the Launch Center</a>
@endsection