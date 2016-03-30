<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;
use Auth;
class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','confirmed_code'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    #region Method to charge all users
    public function showUsersName(){
        $users = DB::table('users')
                    ->select('name','email')
                    ->get();
        return $users;
    }
    #endregion

    #region Method to charge the id from $usermail
    public function obtainIdUser($userMail){
        $user = DB::table('users')->where('email',$userMail)->value('id');
        return $user;
    }
    #endregion

    #region Method to getid from loguser
    public function getLogId(){

    }
    #endregion
}
