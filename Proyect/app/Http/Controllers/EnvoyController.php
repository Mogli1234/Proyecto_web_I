<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Mail as mail;
use App\User as Users;
class EnvoyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sentsMails = new mail();
        $sentsMails = $sentsMails->showSentMails();
        return view('sentMails.index')->with('sentsMails',$sentsMails);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $mails = new mail();
        $mails = $mails->showMailInformation($id);
        return view('sentMails.show')->with(['mail_show'=>$mails]);
    }

}
