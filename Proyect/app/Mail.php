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
            $mail_id = $this->getThelastIdMail($data);
        dd($mail_id);
        die;
        return $mail;
    }
    #endregion

    #region Method to to the email
    public function sendEmail($data){

        try{
            $to_view = array('bodyMessage' => $data['message']);
            $sending = email::send('emails.basicMessage',$to_view,function($message)use($data){
                $message->from($data['log_mail'],'Bladimir Arroyo');
                $message->to($data['to_user'])
                        ->subject($data['subject']);
            });
        }catch (Exception $e){
            $sending = $e->getMessage();
        }
        return $sending;
    }
    #endregion

    #region Method to charge all drafted mails
    public function chargeDraftedMails(){
        try{
            $mails = DB::table('mails')
                ->where('state','draft')
                ->get();
        }catch (Exception $e){
            $mails = $e->getMessage();
        }
        return $mails;
    }
    #endregion

    #region Method to delete Mails
    public function deleteMAil($id){
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
    public function change($id){
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

    #region Method to show all sends Mails
    public function showSendMails(){
        $sendMails= DB::table('mails')
                    ->where('state','send')
                    ->get();
        return $sendMails;
    }
    #endregion

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
}
