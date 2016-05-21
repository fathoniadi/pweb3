<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class postComment extends Model
{
    protected $table = 'postComment';
    protected $primaryKey = 'comment_id';
    public $timestamps = false;
    protected $fillable = array('comment_post', 'comment_text', 'comment_user','comment_date');
}
