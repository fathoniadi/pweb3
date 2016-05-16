<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Input;
use App\userAccount;
use Redirect;
use App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Html\FormFacade;
use Carbon\Carbon;
use DB;
use Session;
use Cookie;
use Illuminate\Http\Response;

class homepage extends Controller
{
    public function index()
    {
    	return view('welcome');
    }

    public function login()
    {
    	return view('homepage/login');
    }

    public function doLogin(Request $request)
    {
        $rulesLogin = array(
            'username' => 'required',
            'password' => 'required'
            );

        $validatorLogin = Validator::make(\Input::all(), $rulesLogin);

        if($validatorLogin->fails())
        {
            return Redirect::to('login')
                ->withErrors($validatorLogin);
        }
        else
        {
            echo "Sukses";
            $username = Input::get('username');
            $password = Input::get('password');
            $password = md5($password);
           
           $flagLogin = DB::select("SELECT username from userAccount where username = '".$username."' and password = '".$password."'");
           if($flagLogin)
           {
                foreach ($flagLogin as $row) {
                    $user = $row->username;
                }

                Session::put('user',$user);

                if(Input::get('rememberme'))
                {
                       $value = $request->cookie('test-cookie');

                        if ($value == 'test') {
                            echo "aaa";
                        }

                        $response = new Response();

                        $response->withCookie('test-cookie', 'test', 60);
                }

              
                
           }

        

        }

    }

    public function register()
    {
        return view('homepage/register');
    }

    public function doRegister()
    {
        $rulesRegister = array(
            'username' => 'required|unique:userAccount',
            'email'    => 'required|email',
            'password' => 'required',
            'confirmPassword' => 'required|same:password'
            );
        $validatorRegister = Validator::make(\Input::all(), $rulesRegister);

        if($validatorRegister->fails())
        {
            /*$messages = $validatorRegister->messages();*/
            return Redirect::to('register')
                ->withErrors($validatorRegister);
        }
        else
        {
            $rows = DB::Select("Select sysdate() as date");
            foreach ($rows as $row) {
                $dateNow = $row->date;
            }

            $useraccount = new userAccount;
            $useraccount->username = Input::get('username');
            $useraccount->email = Input::get('email');
            $password = md5(Input::get('password'));
            $useraccount->password = $password;
            $useraccount->dateJoin = $dateNow;

            if($useraccount->save())
            {
                echo "Data Masuk";
            }
            else
            {
                echo "Data gagal input database";
            }
        }
    }
}
