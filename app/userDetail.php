<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class userDetail extends Model
{
   protected $table = 'userDetail';
   protected $primaryKey = 'username';
   public $timestamps = false;

   protected $fillable = array('user_fullname', 'user_location', 'user_photo', 'username', 'lengkap');


    public function user_post()
    {
    	return $this->hasMany('App\postEvent', 'user_owner', 'username');
    }
}
