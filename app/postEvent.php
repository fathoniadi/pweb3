<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class postEvent extends Model
{
    protected $table = 'postEvent';
    protected $primaryKey = 'post_id';
    public $timestamps = false;
    protected $fillable = array('post_text', 'post_photo', 'post_owner', 'post_location', 'post_date', 'post_nameEvent');
}
