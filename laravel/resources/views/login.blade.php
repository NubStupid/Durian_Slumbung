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
    .moveLeft{
        transform: translateX(150%);
    }
    .moveRight{
        transform: translateX(0%);
    }
    </style>
@endpush
@section('content')
@php
    $registerPanel = "";
    if(isset($register)){
        $registerPanel = "true";
    }

@endphp
<div class="d-flex align-items-center" style="height:100vh;">
    <div class="container-md">

        @if(session('success_message'))
        <div class="modal fade" id="RegisBerhasil" tabindex="-1" aria-labelledby="RegisBerhasil" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-body text-center">
                    <img src="{{asset('assets/misc/check-green.gif')}}" class="my-2" alt="" width="max-content" height="70px">
                  <h5 class="py-2">Registrasi Berhasil!</h5>
                  <button type="button" class="btn btn-secondary mx-5 w-0" data-bs-dismiss="modal" aria-label="Close" id="okayButton">Okay</button>
                </div>
              </div>
            </div>
        </div>
        @endif

        <div class="row" style="position:relative; width:100%;">
            <div class="overlay top-0 start-0 rounded-5 z-2" id="overlay">
                <div class="row d-flex align-items-center justify-content-center"style="height:90vh; width:100%;">
                    <div class="row fs-1 fw-semibold px-4 text-white text-center justify-content-center">
                        <div class="row fs-2"><a href="{{url('/')}}" class="text-decoration-none text-white"><span id="arrow">←</span> Back to Homepage</a></div>
                        <span class="align-items-center">
                            <span id="text">Login into</span>
                            <img class="navbar-brand" src="{{asset('assets/navbar/LogoDurianSlumbung.png')}}" style="max-width:10vw; max-height:auto;">
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-6 p-5 bg-green-secondary rounded-5 rounded-end" style="height:90vh;" id="leftscreen">
                <div class="row">
                    <div class="col-8">
                        <div class="text-center fw-bold text-white py-4" style="font-size: 4rem">LOGIN</div>
                        @if(session()->has('pesanLogin'))
                            <div class="alert alert-warning alert-dismissible fade show w-100" role="alert">
                                {{session()->get('pesanLogin')}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <form method="POST" action="{{ route('loginUser', ['type' => 'login']) }}">
                        @csrf
                            <div class="row ps-5">
                                <div class="col-3 text-end">
                                    <div class="row my-4 fw-semibold fs-4 text-white">Username :</div>
                                    <div class="row my-4 fw-semibold fs-4 text-white">Password :</div>
                                </div>
                                <div class="col-7">
                                    <div class="row my-4">
                                        <input type="text" name="username" id="username" class="loginButton form-control"><br>
                                    </div>
                                    <div class="row my-4">
                                        <input type="password" name="password" id="password" class="loginButton form-control"><br>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3 d-flex justify-content-center">
                                <div class="row d-flex justify-content-center">
                                    <input type="submit" value="Login" class="loginButton w-25 btn bg-green-body text-white fw-bold fs-5">
                                </div>
                            </div>
                            <hr>
                            <div class="row d-flex align-items-center my-3">
                                <div class="col-8 d-flex justify-content-end text-white fw-semibold" id="">
                                    Doesn't have an account? Make one!
                                </div>
                                <div class="col-2 ">
                                    <input type="button" onclick="regisClick()" value="Register" class="loginButton btn bg-green-body text-white fw-bold"/><br>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-4"></div>
                </div>
            </div>


            <div class="col-6 px-5 py-1 bg-green-secondary rounded-5 rounded-start d-flex justify-content-end" style="height:90vh;" id="rightscreen">
                <div class="row">
                    <div class="col-11 me-5">
                        <div class="text-center fw-bold text-white py-5" style="font-size: 4rem">Register</div>
                        @if(session()->has('pesanRegister'))
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                {{session()->get('pesanRegister')}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <form method="POST" action="{{route('loginUser',['type'=>'register'])}}">
                            @csrf
                            <div class="row pe-5 me-5">
                                <div class="col-5">
                                    <div class="row my-4 fw-semibold fs-5 text-white">Username :</div>
                                    <div class="row mt-4 mb-2 fw-semibold fs-5 text-white">Password :</div>
                                    <div class="row mt-4 mb-4 fw-semibold fs-5 text-white">Confirm Password :</div>
                                    <div class="row mb-4 mt-4 fw-semibold fs-5 text-white">No Telp :</div>
                                </div>
                                <div class="col-6">
                                    {{-- <div class="row position-absolute">
                                        @error('username')
                                            <span style="color: red;">
                                                {{$message}}
                                            </span>
                                        @enderror
                                    </div> --}}
                                    <div class="row my-3">
                                        <input type="text" name="username" id="username" class="form-control regisButton"><br>
                                    </div>
                                    {{-- <div class="row  position-absolute">
                                        @error('password')
                                            <span style="color: red;" >
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div> --}}
                                    <div class="row my-3">
                                        <input type="password" name="password" id="password" class="form-control regisButton"><br>
                                    </div>
                                    {{-- <div class="row position-absolute">
                                        @error('confirm_password')
                                            <span style="color: red;">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div> --}}
                                    <div class="row my-3">
                                        <input type="password" name="confirm_password" id="confirm_password" class="regisButton form-control">
                                    </div>
                                    {{-- <div class="row position-absolute">
                                        @error('notelp')
                                            <span style="color: red;">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div> --}}
                                    <div class="row my-2">
                                        <input type="text" name="notelp" id="notelp" value="{{ old('notelp') }}" class="regisButton form-control">
                                    </div>
                                    <div class="row my-4">
                                        <input type="submit" value="Register" class="regisButton btn bg-green-body text-white fs-5 fw-bold">
                                    </div>
                                    <div class="row d-flex align-items-end my-3">
                                        <div class="col-8 d-flex justify-content-end text-white fw-semibold">
                                            Already have an account?
                                        </div>
                                        <div class="col-2 ">
                                            <input type="button" onclick="loginClick()" value="Login" class="regisButton btn bg-green-body text-white fw-bold"/><br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>
@endsection
@push('script')
<script>
    $(document).ready(function () {
        let panel = {!! json_encode($registerPanel) !!};
        showSuccessModal();
        if(panel == ""){
            leftLoaded();
        }else{
            rightLoaded();
        }
    });
    function regisClick(){
        $("#text").html("Register into");
        $('#overlay').toggleClass('moveLeft');
        rightLoaded();
    }
    function showSuccessModal() {
            $('#RegisBerhasil').modal('show');
        }
    function loginClick(){
        $("#text").html("Login into");
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
