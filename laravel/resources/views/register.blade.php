@extends('template.loginregisterTemplate')
@section('title')
    <title>Register</title>
    @php
        $title = "Register";
    @endphp
@endsection

@section('content')
<h1>Register</h1>
<form method="POST">
    @csrf
    Username : <input type="text" name="username" id="username" value={{ old('username') }}><span style="color: red;">{{ $errors->first('username') }}</span><br>
    Password : <input type="text" name="password" id="password"><span style="color: red;">{{ $errors->first('password') }}</span><br>
    Confirm Password : <input type="text" name="confirm_password" id="confirm_password"><span style="color: red;">{{ $errors->first('confirm_password') }}</span><br>
    No Telp : <input type="text" name="notelp" id="notelp" value={{ old('notelp') }}><span style="color: red;">{{ $errors->first('notelp') }}</span><br>
    <input type="submit" value="Register">
</form>
@if(session()->has('pesan'))
    <strong style="color:red">{{session()->get('pesan')}}</strong>
@endif
sudah punya akun ? sini sm abang <input type="button" onclick="location.href='{{ url('login')}}';" value="Register"/><br>
@endsection