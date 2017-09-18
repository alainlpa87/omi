@extends('intranet.layouts.default')
@endsection

@section('content')
    <div class="container-fluid">
        @if($first_time==1)
            <div class="row">
                <div class="col-md-12 divLogo">
                    <img src="{{asset('img/logo.png')}}">
                    <span class="spanIntranet">Unsubscribe</span>
                </div>
                <div class="col-md-4 col-md-offset-4">
                    <div class="panel panel-default">
                        <div class="panel-heading panel-login"></div>
                        <div class="panel-body panel-unsubscribe">
                            <form class="form-horizontal" role="form" method="POST" action="{{ url('unsubscribeNow') }}">
                                <div class="form-group">
                                    <label class="col-md-4 control-label">Email</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="email" value="{{ old('email') }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary">Unsubscribe</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="row">
                <div class="col-md-12 divLogo">
                    <img src="{{asset('img/logo.png')}}">
                    <span class="spanIntranet">{{$message}}</span>
                </div>
            </div>
        @endif
    </div>
@endsection

@section('footer_scripts')
@endsection

