@extends('homepage.layouts.layout')

@section('title')
	Register Aksi.in
@endsection
@section('content')
@if ($errors->has())
    <div class="alert-danger" style="color:red; text-align:left; font-weight:bold">
        @foreach ($errors->all() as $error)
        {{ $error }}<br>
        @endforeach
    </div>
@endif
@if(session('message'))
    <div class="alert-danger" style="color:green; text-align:left; font-weight:bold">
        {{session('message')}}
    </div>
@endif

<div>
	<form method="post" action="{{url('/')}}/doRegister">
		<input type="text" name="username" required="" placeholder="username">
		<br>
		<input type="email" name="email" required="" placeholder="email">
		<br>
		<input type="password" name="password" required="" placeholder="password">
		<br>
		<input type="password" name="confirmPassword" required="" placeholder="confirm password">
		<br>
		<input style="display:block; background-color:blue; color:white" type="submit" value="Register">
		<input type="hidden" name="_token" value="{{csrf_token() }}">
	</form>
</div>
@endsection 