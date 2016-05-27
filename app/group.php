<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class group extends Model
{
    //
    protected $table = 'group';
    protected $primaryKey = 'group_id';
    public $timestamps = false;
    protected $fillable = array('group_name', 'owner', 'Event_id');
}
