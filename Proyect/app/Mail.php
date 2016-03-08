<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Mail as email;
use Mockery\Exception;

class Mail extends Model
{
    protected $fillable=['to','subject','message'];
    protected $hidden= ['id','state'];

    #region Method to add email content to the DB
    public function createEmail($data){

            $mail = DB::table('mails')
                ->insert([
                    'to'=> $data['to_user'],
                    'subject'=>$data['subject'],
                    'message'=>$data['message']
                ]);

            $this->sendEmail($data);
        return $mail;
    }
    #endregion

    #region Method to to the email
    public function sendEmail($data){

        try{
            $to_view = array('bodyMessage' => $data['message']);
            $sending = email::send('emails.basicMessage',$to_view,function($message)use($data){
                $message->from($data['log_mail'],'Bladimir Arroyo');
                $message->to($data['to_user'])->subject($data['subject']);
            });
        }catch (Exception $e){
            $sending = $e->getMessage();
        }
        return $sending;
    }
    #endregion

}
