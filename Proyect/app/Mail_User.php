<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Mail as mails;
use App\User as users;
use DB;
class Mail_User extends Model
{
    protected $fillable=['mail_id','log_user_id',''];
    protected $hidden= ['id'];

    public function addMAils_toUser($data){
        $add_mail_user = DB::table('mails_users')
                        ->insert([
                         'mail_id' => $data['mail_id'],
                          'log_user_id'=> $data['log_id'],
                            'to_user_id'=>$data['to_user_id']
                        ]);
        return $add_mail_user;
    }

    public function deleteRecord($id){
        $record_to_delete= DB::table('mails_users')
                            ->where('mail_id',$id)
                            ->delete();
        return $record_to_delete;
    }
}
