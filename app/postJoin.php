<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class postJoin extends Model
{
    protected $table = 'postJoin';
    protected $primaryKey = 'join_id';
    public $timestamps = false;
    protected $fillable = array('join_post', 'join_user', 'join_flag');
}
