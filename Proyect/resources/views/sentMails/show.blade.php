@extends('layouts.app')
@section('content')
    <form class="form-horizontal form-label-left" method="GET" novalidate action="/Output/{{$mail_show[0]->id}}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <span class="section">Mail Show</span>
        <div>
            <label>To:</label>
            <select name="to_user" class="form-control" id="sel1" disabled>
                    <option value="">{{$mail_show[0]->to}}</option>
            </select>
        </div>
        <div>
            <label>From:</label>
            <input type="text" class="form-control required" name="log_mail" value="{{Auth::user()->email}}" disabled>
        </div>
        <div>
            <label>Subject:</label>
            <input type="text" class="form-control required" name="subject" value="{{$mail_show[0]->subject}}" disabled>
        </div>
        <div>
            <label>Message:</label>
            <textarea name="message" placeholder="Put your message" class="form-control required" disabled>{{$mail_show[0]->message}}</textarea>
        </div>
        <div>
            <a href="/Envoys"><input type="button" class="btn btn-default" value="Cancel"></a>
        </div>
        <div class="clearfix"></div>
    </form>
@stop