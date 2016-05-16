<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class userAccount extends Model
{
    protected $table = 'userAccount';
    protected $primaryKey = 'username';
    public $timestamps = false;

    protected $fillable = array('username', 'email', 'password', 'lastLogin', 'dateJoin');
}
