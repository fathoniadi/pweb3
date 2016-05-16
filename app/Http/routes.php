<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'homepage@index');
Route::get('/login', 'homepage@login');
Route::get('/register', 'homepage@register');
Route::post('/doRegister', 'homepage@doregister');
Route::get('/doRegister', 'homepage@register');
Route::get('/timeline', 'Dashboard@timeline');
Route::post('/doLogin', 'homepage@doLogin');