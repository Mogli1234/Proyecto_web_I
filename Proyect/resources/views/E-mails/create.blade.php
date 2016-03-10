@extends('layouts.app')
    @section('content')
        <form  class="form-horizontal" role="form" method="POST" action="/E-mails">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <h1>Mail Form</h1>
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
                <input type="text" class="form-control required" name="subject">
            </div>
            <div>
                <label>Message:</label>
                <textarea name="message" placeholder="Put your message" class="form-control required"></textarea>
            </div>
            <div>
                <button type="submit" class="btn btn-default">Save Mail</button>
                <a href="/E-mails"><input type="button" class="btn btn-default" value="Cancel"></a>
            </div>
            <div class="clearfix"></div>
        </form>
    @stop