<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class postLike extends Model
{
    protected $table = 'postLike';
    protected $primaryKey = 'like_id';
    public $timestamps = false;
    protected $fillable = array('like_post', 'like_user');
}
