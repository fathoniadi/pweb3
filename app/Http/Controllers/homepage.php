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
use DB;
use Session;
use Cookie;
use App\Http\Controllers\CheckingSession;

class homepage extends Controller
{
    private $checkingsession;

    public function __construct()
    {
        if(Cookie::get('user')) 
        {
            $user = Cookie::get('user');
        }
        else
        {
            $user = base64_decode(Session::get('user'));
        }

        $this->checkingsession = new CheckingSession();
        $flag = $this->checkingsession->Check($user);
        if($flag==1) 
        {
            //echo "Redirect ke Timeline";
            Redirect::to('timeline')->send();
        }
    }

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
            //echo "Sukses";
            $username = Input::get('username');
            $password = Input::get('password');
            $password = md5($password);
           
           $flagLogin = DB::select("SELECT username from userAccount where username = '".$username."' and password = '".$password."'");
           if($flagLogin)
           {
                foreach ($flagLogin as $row) {
                    //echo $row->username;
                    $user = base64_encode($row->username);
                    //echo $user;
                }

                Session::put('user',base64_encode($user));
                //echo "Gagal".base64_decode(base64_decode(Session::get('userLogin')));

                if(Input::get('rememberme'))
                {
                    Cookie::queue('user', $user, 24*60*30);
                }

                return Redirect::to('timeline');
                //echo "aaa";


                
           }
           else
           {
                return Redirect::to('login')
                ->withErrors("Username atau Password salah");
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
                return Redirect::to('register')->with("message","Berhasil Registrasi");
            }
            else
            {
                return Redirect::to('register')->withErrors("Gagal register");
            }
        }
    }
}
