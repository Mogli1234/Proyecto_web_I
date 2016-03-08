<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Mockery\Exception;

class Mail extends Model
{
    protected $fillable=['to','subject','message'];
    protected $hidden= ['id','state'];

    public function createEmail($data){
            $mail = DB::table('mails')
                ->insert([
                    'to'=> $data['to_user'],
                    'subject'=>$data['subject_user'],
                    'message'=>$data['message']
                ]);
        return $mail;
    }


}
