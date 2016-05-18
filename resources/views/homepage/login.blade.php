@extends('homepage.layouts.layout')

@section('title')
	Login Aksi.in
@endsection
@section('content')
@if ($errors->has())
    <div class="alert-danger" style="color:red; text-align:left; font-weight:bold">
        @foreach ($errors->all() as $error)
        {{ $error }}<br>
        @endforeach
    </div>
@endif
<div> 
<form method="post" action="{{url('/')}}/doLogin">
	<input type="text" name="username" required="" placeholder="username">
	<br>
	<input type="password" name="password" required="" placeholder="password">
	<br>
	<input type="checkbox" name="rememberme"  placeholder="" value="1">
	<span>Remember me</span>
	<br>
	<input type="submit" value="Login">
	<input type="hidden" name="_token" value="{{csrf_token() }}">
</form>
</div>
@endsection