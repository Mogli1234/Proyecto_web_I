<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/



/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/
Route::get('/', function () {
    return view('auth.login');
});

Route::group(['middleware' => 'web'], function () {
    Route::auth();
    Route::get('/','HomeController@index');
    Route::get('/home', 'HomeController@index');
    Route::resource('E-mails','MailController');
    Route::get('/E-mails/{id}/send', 'MailController@addToSendMail');
    Route::resource('/Output','OuputMailController');
    Route::get('/Envoys','EnvoyController@index');
    Route::get('/Envoys/{id}','EnvoyController@show');
});
Route::get('register/confirm/{confirmation_code}',function($confirmation_code,App\Mail $mails){
    if($mails->validateEmail($confirmation_code)){
        return redirect('/login');
    }else{
        return redirect('/errors');
    }
});

Route::get('/errors',function(){
    return view('errors.404');
});
