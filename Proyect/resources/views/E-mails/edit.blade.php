@extends('layouts.app')
    @section('content')
        <form class="form-horizontal form-label-left" method="POST" novalidate action="/E-mails/{{$edited_mail[0]->id}}">
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="count_id" value="{{$edited_mail[0]->id}}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            @if(session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger">
                    {{$errors->first()}}
                </div>
            @endif
            <span class="section">Mail Editor</span>
            <div>
                <label>To:</label>
                <select name="to_user" class="form-control" id="sel1">
                    @foreach ($users as $data)
                        <option value="{{$data->email}}">{{$data->name}}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label>From:</label>
                <input type="text" class="form-control required" name="log_mail" value="{{Auth::user()->email}}">
            </div>
            <div>
                <label>Subject:</label>
                <input type="text" class="form-control required" name="subject" value="{{$edited_mail[0]->subject}}">
            </div>
            <div>
                <label>Message:</label>
                <textarea name="message" placeholder="Put your message" class="form-control required">{{$edited_mail[0]->message}}</textarea>
            </div>
            <div>
                <button type="submit" class="btn btn-default">Save Mail</button>
                <a href="/user"><input type="button" class="btn btn-default" value="Cancel"></a>
            </div>
            <div class="clearfix"></div>
        </form>
    @stop