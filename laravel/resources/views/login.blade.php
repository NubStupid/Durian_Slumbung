@extends('template.loginregisterTemplate')
@section('title')
    <title>Login</title>
    @php
        $title = "Login";
    @endphp
@endsection
@push('style')
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <style>
    body{
        overflow: hidden;
    }
    #leftscreen.visible{
        opacity: 1;
        transition: width 0.4s linear;
    }
    #leftscreen.hidden{
        opacity: 0;
    }
    #rightscreen.visible{
        opacity: 1;
        transition: width 0.4s linear;
    }
    #rightscreen.hidden{
        opacity: 0;
    }
    .overlay {
        position:absolute;
        width: 40% !important;
        height: 90vh;
        background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent black overlay */
        transition: transform 0.4s ease;
    }
    .moveLeft{
        transform: translateX(150%);
    }
    .moveRight{
        transform: translateX(0%);
    }
    </style>
@endpush
@section('content')
<div class="d-flex align-items-center" style="height:100vh;">
    <div class="container-md">
        <div class="row" style="position:relative; width:100%;">
            <div class="overlay top-0 start-0 rounded-5 text-white text-center d-flex align-items-center justify-content-center" id="overlay">
                <div class="fs-1 fw-semibold">Login dek</div>
            </div>
            <div class="col-6 p-5 bg-blue-light rounded-5 rounded-end" style="height:90vh;" id="leftscreen">
                <h1>LOGIN</h1>
                <form method="POST">
                    @csrf
                    Username : <input type="text" name="username" id="username" class="loginButton"><br>
                    Password : <input type="text" name="password" id="password" class="loginButton"><br>
                    <input type="submit" value="Login" class="loginButton">
                </form>
                @if(session()->has('pesan'))
                    <strong style="color:red">{{session()->get('pesan')}}</strong>
                @endif
                belum punya akun ? sini sm abang <input type="button" onclick="regisClick()" value="Register" class="loginButton"/><br>
                <input type="button" onclick="location.href='{{ url('logout')}}';" value="Logout" class="loginButton"/>
            </div>


            <div class="col-6 p-5 bg-blue-dark rounded-5 rounded-start d-flex justify-content-end" style="height:90vh;" id="rightscreen">
                <h1>Register</h1>
                    <form method="POST">
                        @csrf
                        Username : <input type="text" name="username" id="username" value="{{ old('username') }}" class="regisButton"><span style="color: red;">{{ $errors->first('username') }}</span><br>
                        Password : <input type="text" name="password" id="password" class="regisButton"><span style="color: red;" >{{ $errors->first('password') }}</span><br>
                        Confirm Password : <input type="text" name="confirm_password" id="confirm_password" class="regisButton"><span style="color: red;">{{ $errors->first('confirm_password') }}</span><br>
                        No Telp : <input type="text" name="notelp" id="notelp" value="{{ old('notelp') }}" class="regisButton"><span style="color: red;">{{ $errors->first('notelp') }}</span><br>
                        <input type="submit" value="Register" class="regisButton">
                    </form>
                    @if(session()->has('pesan'))
                        <strong style="color:red">{{session()->get('pesan')}}</strong>
                    @endif
                    sudah punya akun ? sini sm abang <input type="button" onclick="loginClick()" value="Register" class="regisButton"/><br>
            </div>


        </div>
    </div>
</div>
@endsection
@push('script')
<script>
    $(document).ready(function () {
        leftLoaded();
    });
    function regisClick(){
        $('#overlay').toggleClass('moveLeft');
        rightLoaded();
    }
    function loginClick(){
        $('#overlay').toggleClass('moveRight');
        leftLoaded();
    }
    function leftLoaded(){
        $('#leftscreen').removeClass('hidden col-6 col-2 col-10');
        $('#rightscreen').removeClass('col-10 col-6');

        $('#leftscreen').addClass('visible col-10');
        $('#rightscreen').addClass('col-2');

        $('#rightscreen').removeClass('visible');
        $('#rightscreen').addClass('hidden');

        $('#overlay').toggleClass('moveLeft');

        $('#overlay').one('transitionend', function() {
            // $('#overlay').toggleClass('moveLeft');
            // rightLoaded();
            $(".regisButton").prop("disabled",true);
            $(".loginButton").prop("disabled",false);
        });
    }
    function rightLoaded() {
        $('#rightscreen').removeClass('hidden col-6 col-2 col-10');
        $('#leftscreen').removeClass('col-10 col-6');

        $('#rightscreen').addClass('visible col-10');
        $('#leftscreen').addClass('col-2');


        $('#leftscreen').removeClass('visible');
        $('#leftscreen').addClass('hidden');
        $('#overlay').toggleClass('moveRight');

        $('#overlay').one('transitionend', function() {
            // $('#overlay').toggleClass('moveRight');
            // leftLoaded();
            $(".loginButton").prop("disabled",true);
            $(".regisButton").prop("disabled",false);
        });
    }

</script>

@endpush
