@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Sending Mails</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <table id="example" class="table table-striped responsive-utilities jambo_table">
                        <thead>
                        <tr class="headings">
                            <th>Send to</th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th class=" no-link last"><span class="nobr">Action</span>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($sentsMails as $key)
                            <tr>
                                <td>{{$key->to}}</td>
                                <td>{{$key->subject}}</td>
                                <td>{{$key->message}}</td>
                                <td><a href='/Envoys/{{$key->id}}'><span class="glyphicon glyphicon-book"></span></a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop