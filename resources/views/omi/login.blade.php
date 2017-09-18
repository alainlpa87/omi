@extends('omi.layout.headLogin')
@section('title','Patent Services USA')


@section('header_styles')
    <link href="{{ asset('/css/omiLogin.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container-fluid container-launch divLogoLogin">
        <div class="row">
            <div class="col-md-12 divLogo">
                <img src="{{asset('img/logo.png')}}">
            </div>
            <div class="col-md-4 col-md-offset-4 boxLogin">
                <h3 class="form-title">Secure Login</h3>
                <div class="panel-body panel-login">
                    @if (isset($error))
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                <li>{{ $error }}</li>
                            </ul>
                        </div>
                    @endif

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('launch/login') }}">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label class="col-md-4 control-label">Email</label>
                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Password</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-xs-6">
                                <button type="submit" class="btn btn-success uppercase">Login</button>
                            </div>
                            {{--<div class="col-md-6 col-xs-6">--}}
                                {{--<a class="btn btn-link" href="{{ url('/password/email') }}">Forgot Your Password?</a>--}}
                            {{--</div>--}}
                        </div>
                    </form>
                    <div class="form-group"><p id="recoverPswd" class="btn" data-toggle="modal">Did you forget your password?</p></div>
                </div>
            </div>
        </div>
    </div>
    @include('omi.tools.recoverPsswdModal')
@endsection

@section('footer_scripts')
    <script src="{{asset("js/omi/resetPswd.js")}}"></script>
@endsection
