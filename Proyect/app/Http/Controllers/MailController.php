<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Mail as mail;
use App\User as User;
use Mockery\CountValidator\Exception;

class MailController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $draftedMails = new mail();
        $draftedMails = $draftedMails->chargeDraftedMails();
        return view('E-mails.index')->with('drafted',$draftedMails);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = new User();
        $users = $users->showUsersName();
       // dd(Auth::user()->name);die;
        return view('E-mails.create')->with('users',$users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $new_mail = new mail();
            $users = new User();
            $users = $users->showUsersName();
            if($new_mail->createEmail($request->all())){

                return redirect('E-mails/create')->with(['status'=>'Congratulations your maill has been stored!','users'=>$users]);
            }
        }catch (Exception $e){
            return back()->with(['errors'=>$e->getMessage(),'users'=>$users]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mails = new mail();
        $mails = $mails->showMailInformation($id);
        $users = new User();
        $users = $users->showUsersName();
        return view('E-mails.edit')->with(['edited_mail'=>$mails,'users'=>$users]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $new_mail = new mail();
            $users = new User();
            $users = $users->showUsersName();
            if($new_mail->editSpecificMail($request->all(),$id)){

                return redirect('E-mails.edit')->with(['status'=>'Congratulations your maill has been updated!','users'=>$users]);
            }
        }catch (Exception $e){
            return back()->with(['errors'=>$e->getMessage(),'users'=>$users]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mail = new mail();
        $draftedMails = new mail();
        $draftedMails = $draftedMails->chargeDraftedMails();
        try{
            if($mail->deleteMAil($id)){
                return redirect('E-mails')->with('drafted',$draftedMails);
            }
            else{
            }
        }catch (Exception $e){
            return back()->with(['errors'=>$e->getMessage(),'drafted'=>$draftedMails]);
        }

    }
}
