<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Mail as mail;
use App\User as User;
use Mockery\CountValidator\Exception;
use App\Http\Requests\MailRequest;
use Auth;
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
        $draftedMails = $draftedMails->chargeDraftedMails(Auth::user()->id);
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
        return view('E-mails.create')->with('users',$users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MailRequest $request)
    {
            $new_mail = new mail();
            $users = new User();
            $users = $users->showUsersName();
            if($new_mail->createEmail($request->all())){
                return redirect('E-mails/create')->with(['status'=>'Congratulations your mail has been stored!','users'=>$users]);
            }
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
    public function update(MailRequest $request, $id)
    {
            $new_mail = new mail();
            $users = new User();
            $users = $users->showUsersName();
            if($new_mail->editSpecificMail($request->all(),$id)){
                return redirect('/E-mails')->with(['status'=>'Congratulations your maill has been updated!','users'=>$users]);
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
        $draftedMails = $draftedMails->chargeDraftedMails(Auth::user()->id);
        try{
            if($mail->deleteMAil($id)){
                return redirect('E-mails')->with('drafted',$draftedMails);
            }
        }catch (Exception $e){
            return back()->with(['errors'=>$e->getMessage(),'drafted'=>$draftedMails]);
        }

    }

    //Own function
    #region Method to add draft Mail to send Mail
    public function addToSendMail($id){
        $mail = new mail();
        $draftedMails = new mail();
        $draftedMails = $draftedMails->chargeDraftedMails(Auth::user()->id);
        try{
            if($mail->changeState($id)){
                return back()->with('drafted',$draftedMails);
            }
        }catch (Exception $e){
            return back()->with(['errors'=>$e->getMessage(),'drafted'=>$draftedMails]);
        }
    }
    #endregion

    #region Method to redirecto to login for the verification mail
    public function redirecLoginVerification($confirmationCode){
        $mail = new mail();
        dd($mail->validateEmail($confirmationCode));
        die;
        if($mail->validateEmail($confirmationCode)){
            return redirect('/login');
        }
    }
    #endregion
}
