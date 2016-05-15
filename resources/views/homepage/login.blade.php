@extends('homepage.layouts.layout')

@section('title')
	Login Aksi.in
@endsection
@section('content') 
<form method="post" action="{{url('/')}}/doLogin">
	<input type="text" name="username" placeholder="username">
	<br>
	<input type="password" name="password" placeholder="password">
	<br>
	<input style="display:block; background-color:blue; color:white" type="submit" value="Login">
	<input type="hidden" name="_token" value="{{csrf_token() }}">
</form>
@endsection 