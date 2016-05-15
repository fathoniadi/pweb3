<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

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

    public function doLogin(Request $requests)
    {
    	echo $requests->input('username');
    	echo $requests->input('password');
    }
}
