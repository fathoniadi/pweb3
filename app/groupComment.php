<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class groupComment extends Model
{
    protected $table = 'groupComment';
    protected $primaryKey = 'groupComment_id';
    public $timestamps = false;
    protected $fillable = array('groupComment_text', 'groupComment_groupId', 'groupComment_user', 'groupComment_Replyto', 'groupComment_date');
}

