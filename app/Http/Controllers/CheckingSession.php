<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;

class CheckingSession extends Controller
{
    public function Check($user)
    {
    	//echo $user;
    	$user = base64_decode($user);
    	//echo $user;
    	$flagSession = DB::select("Select username from userAccount where username = '".$user."'");
    	if($flagSession) return 1;
    	else return 0;
    }
}
