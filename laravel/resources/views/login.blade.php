@extends('template.loginregisterTemplate')
@section('title')
    <title>Login</title>
    @php
        $title = "Login";
    @endphp
@endsection

@section('content')
<h1>LOGIN</h1>
<form method="POST">
    @csrf
    Username : <input type="text" name="username" id="username"><br>
    Password : <input type="text" name="password" id="password"><br>
    <input type="submit" value="Login">
</form>
@if(session()->has('pesan'))
    <strong style="color:red">{{session()->get('pesan')}}</strong>
@endif
belum punya akun ? sini sm abang <input type="button" onclick="location.href='{{ url('register')}}';" value="Register"/><br>
<input type="button" onclick="location.href='{{ url('logout')}}';" value="Logout" />
@endsection