@extends('template.loginregisterTemplate')
@section('title')
    <title>Login</title>
    @php
        $title = "Login";
    @endphp
@endsection

@section('content')
<input type="button" class="btn btn-danger" onclick="location.href='{{ url('logout')}}';" value="Logout" />
@endsection