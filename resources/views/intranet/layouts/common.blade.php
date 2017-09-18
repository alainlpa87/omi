<div class="col-md-12 col-xs-12 col-lg-12 topBar">
    <span id="spanSettings">
        <i class="fa fa-cog"></i>
    </span>
    <span id="spanUser" data-id="{{$consultant->id}}">
        {{$consultant->usr}}<i class="fa fa-sign-out"></i>
    </span>
    <span id="spanPhone" data-phone="{{$consultant->did}}" data-phone2="{{$consultant->did2}}">
        <i class="fa fa-phone"></i><span id="userDID" data-fname="{{$consultant->fname}}" data-lname="{{$consultant->lname}}">{{$consultant->did}}</span>
    </span>
    <span id="spanInbox">
        <i class="fa fa-envelope-o"></i>
        <span id="userInbox">{{$total_inbox}}</span>
    </span>
</div>

