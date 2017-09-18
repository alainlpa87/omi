<html>
{{--This template is to generate a PDF with the emails that client send throw our launch center in their projects view--}}
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head><body>
<link href="{{ asset('/css/pdf.css') }}" rel="stylesheet">
{{--Page #1--}}
<p align="center">
    <img src="{{asset('/img/contracts/logo.png')}}" name="Logo" width="165" height="126" id="Object1" align="center">
    <br><i>Giving the edge to Inventors!</i>
</p>
<table align="center" width="100%">
    <tr>
        <td>Client Name: {{$lead->fname." ".$lead->lname}}</td>
    </tr>
    <tr>
        <td>Email: {{$lead->email}}</td>
    </tr>
    <tr>
        <td>FileNo: {{$lead->fileno}}</td>
    </tr>
</table>
<br>
<table align="center" width="100%">
    <tr>
        <td>Subject: {{$subject}}</td>
    </tr>
    <tr>
        <td><p>{{$text}}</p></td>
    </tr>
</table>
</body></html>
