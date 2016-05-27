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
Route::pattern('id_post', '[0-9]+');
Route::get('/', 'homepage@index');
Route::get('/login', 'homepage@login');
Route::get('/register', 'homepage@register');
Route::post('/doRegister', 'homepage@doregister');
Route::get('/doRegister', 'homepage@register');
Route::get('/timeline', 'Dashboard@timeline');
Route::get('/post/{id_post}', 'Dashboard@post');
Route::post('/doLogin', 'homepage@doLogin');
Route::get('/logout','Dashboard@logout');
Route::post('/doPostEvent','Dashboard@doPostEvent');
Route::post('/doLike','Dashboard@doLike');
Route::post('/doJoin','Dashboard@doJoin');
Route::post('/doLike','Dashboard@doLike');
Route::post('/doUnLike','Dashboard@doUnLike');
Route::post('/doUnJoin','Dashboard@doUnJoin');
Route::post('/deletePost','Dashboard@deletePost');
Route::post('/addComment','Dashboard@addComment');
Route::post('/doupdatepost','Dashboard@doupdatepost');
Route::post('/timelineajaxmore','Dashboard@timelineajaxmore');
Route::post('/timelineorder','Dashboard@timelineorder');
Route::post('/deletephotoevent','Dashboard@deletephotoevent');
Route::post('/commentajax','Dashboard@commentajax');
Route::post('/deletecomment','Dashboard@deletecomment');
Route::get('/editpost/{id_post}','Dashboard@editpost');
Route::get('/doPostEvent',function()
{
	return view('errors/404');
});
Route::get('/post',function()
{
	return view('errors/404');
});

Route::get('/editpost',function()
{
	return view('errors/404');
});
Route::get('/timelineajax',function()
{
	return view('errors/404');
});
Route::get('/doLike',function()
{
	return view('errors/404');
});
Route::get('/doUnLike',function()
{
	return view('errors/404');
});
Route::get('/doJoin',function()
{
	return view('errors/404');
});
Route::get('/doUnJoin',function()
{
	return view('errors/404');
});


Route::get('/group/{idgroup}','groupcon@group');
Route::post('/deletegComment','groupcon@deletegcomment');
Route::post('/doPostgComment' , 'groupcon@doPostgComment');
Route::post('/moregcomment','groupcon@moregcomment');