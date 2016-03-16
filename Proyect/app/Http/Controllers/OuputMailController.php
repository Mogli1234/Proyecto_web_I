<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Mail as mail;
use App\User as User;
use Auth;
class OuputMailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sendMails = new mail();
        $sendMails = $sendMails->showSendMails(Auth::user()->id);
        return view('sendMails.index')->with('sendsMails',$sendMails);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        return view('sendMails.edit')->with(['edited_mail'=>$mails,'users'=>$users]);
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
                return redirect('/Output')->with(['status'=>'Congratulations your maill has been updated!','users'=>$users]);
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
        $sendMails = new mail();
        $sendMails = $sendMails->showSendMails(Auth::user()->id);
        try{
            if($mail->deleteMAil($id)){
                return redirect('/Output')->with('sendsMails',$sendMails);
            }
        }catch (Exception $e){
            return back()->with(['errors'=>$e->getMessage(),'sendsMails'=>$sendMails]);
        }
    }
}
