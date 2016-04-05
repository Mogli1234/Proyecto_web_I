<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Mail as email;
use Mockery\Exception;
use App\User as user;
use App\Mail_User as mail_user;
use Auth;
class Mail extends Model
{
    protected $fillable=['to','subject','message'];
    protected $hidden= ['id','state'];

    #region Method to add email content to the DB
    public function createEmail($data){
        $user_id = new user();
            $mail = DB::table('mails')
                ->insert([
                    'to'=> $data['to_user'],
                    'subject'=>$data['subject'],
                    'message'=>$data['message']
                ]);
        $mails_users = new mail_user();
            $mail_id = $this->getThelastIdMail($data);
            $user_id = $user_id->obtainIdUser($data['to_user']);
        $mail_data = ['mail_id'=>$mail_id,'log_id'=>intval($data['log_user_id']),'to_user_id'=>$user_id];
        $mails_users->addMAils_toUser($mail_data);
        return $mail;
    }
    #endregion

    #region Method to send the email
    public function sendEmail($data){

        try{
            $to_view = array('bodyMessage' => $data->message);
            $sending = email::send('emails.basicMessage',$to_view,function($message)use($data){
                $message->from($data->email,'Bladimir Arroyo');
                $message->to($data->to)
                        ->subject($data->subject);
            });

        }catch (Exception $e){
            $sending = $e->getMessage();
        }
        return $sending;
    }
    #endregion

    #region Method to send the email
    public function sendVerificationEmail($data,$confirmation_code){

        try{
            $to_view = array('confirmation_code' => $confirmation_code);
            $sending = email::send('emails.confirm',$to_view,function($message)use($data){
                $message->from($data['email'],'Web Mail Directive')->to($data['email'])
                    ->subject('Your Reminder');
            });

        }catch (Exception $e){
            $sending = $e->getMessage();
        }
        return $sending;
    }
    #endregion

    #region Method to delete Mails
    public function deleteMAil($id){
        $record_detele = new mail_user();
        $record_detele->deleteRecord($id);
        $mails = DB::table('mails')
                    ->where('id',$id)
                    ->delete();
        return $mails;
    }
    #endregion

    #region Method to show information from specific mails
    public function showMailInformation($id){
        $mails = DB::table('mails')->where('id',$id)->get();
        return $mails;
    }
    #endregion

    #region Method to update a specific email
    public function editSpecificMail($data,$id){
        $update_mail = DB::table('mails')
                        ->where('id',$id)
                        ->update([
                            'to' => $data['to_user'],
                            'subject'=>$data['subject'],
                            'message'=>$data['message']
                        ]);
        return $update_mail;
    }
    #endregion

    #region Method to change state of specific Mail
    public function changeState($id){
        $mail_state = DB::table('mails')->select('state')->where('id',$id)->get();
        if($mail_state[0]->state == 'draft'){
            $mail_state[0]->state = 'send';
            $changed_mail= DB::table('mails')->where('id',$id)->update(['state'=>$mail_state[0]->state]);
        }elseif($mail_state[0]->state == 'send'){
            $mail_state[0]->state = 'sent';
            $changed_mail= DB::table('mails')->where('id',$id)->update(['state'=>$mail_state[0]->state]);
        }
        return $changed_mail;
    }
    #endregion

    #region Method to show all drafted mails
    public function chargeDraftedMails($log_id){
        try{
            $mails= DB::table('mails')
                ->join('mails_users','mails.id','=','mails_users.mail_id')
                ->join('users','mails_users.log_user_id','=','users.id')
                ->where(['state'=>'draft','mails_users.log_user_id'=>$log_id])
                ->select('mails.id','mails.to','mails.subject','mails.message')
                ->get();
        }catch (Exception $e){
            $mails = $e->getMessage();
        }
        return $mails;
    }
    #endregion

    #region Method to show all sends Mails
    public function showSendMails(){
        $sendMails=DB::table('mails')
                    ->join('mails_users','mails.id','=','mails_users.mail_id')
                    ->join('users','mails_users.log_user_id','=','users.id')
                    ->where(['state'=>'send','mails_users.log_user_id'=>Auth::user()->id])
                    ->select('mails.id','mails.to','mails.subject','mails.message','users.email')
                    ->get();
        return $sendMails;
    }
    #endregion

    #region Method to show all sents Mails
    public function showSentMails(){
        $sentMails=DB::table('mails')
            ->join('mails_users','mails.id','=','mails_users.mail_id')
            ->join('users','mails_users.log_user_id','=','users.id')
            ->where(['state'=>'sent','mails_users.log_user_id'=>Auth::user()->id])
            ->select('mails.id','mails.to','mails.subject','mails.message','users.email')
            ->get();
        return $sentMails;
    }
    #endregion

    #region Method to obtain the last id
    public function getThelastIdMail($data){
        $id_mail = DB::table('mails')
                    ->where([
                        'to'=>$data['to_user'],
                        'subject'=>$data['subject'],
                        'message'=>$data['message']
                    ])
                    ->value('id');
        return $id_mail;
    }
    #endregion

    #region Method to show all mails to be send
    public function showSendMailsToSend(){
        $sendMails=DB::table('mails')
            ->join('mails_users','mails.id','=','mails_users.mail_id')
            ->join('users','mails_users.log_user_id','=','users.id')
            ->where(['state'=>'send'])
            ->select('mails.id','mails.to','mails.subject','mails.message','users.email')
            ->get();
        return $sendMails;
    }
    #endregion

    #region Method to validate the user verification
    public function validateEmail($confirmationCode){
        $user = DB::table('users')->where('confirmed_code',$confirmationCode)->get();
        if($user != null){
            $user = DB::table('users')->where('confirmed_code',$confirmationCode)->update([
                'confirm'=>true,
                'confirmed_code'=>null
            ]);
            return $user;
        }
    }
    #endregion
}
