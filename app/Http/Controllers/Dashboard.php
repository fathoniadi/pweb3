<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Session;
use DB;
use App\Http\Controllers\CheckingSession;
use Cookie;
use Redirect;
class Dashboard extends Controller
{
	private $checkingsession;
	public function __construct()
	{
		if(Cookie::get('user')) 
        {
            $user = Cookie::get('user');
        }
        elseif(Session::get('user'))
        {
            $user = base64_decode(Session::get('user'));
        }
        else Redirect::to('login')->send();
        $this->checkingsession = new CheckingSession();
        $flag = $this->checkingsession->Check($user);
        if($flag==0) 
        {
            Redirect::to('login')->send();
        }
	}

    public function timeline()
    {
    	return view('dashboard/timeline');
    }

    public function logout(Request $request)
    {
    	$request->session()->flush();
    	return redirect('/')->withCookie(Cookie::forget('user'));
    }


}
