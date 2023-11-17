@extends('template.basicStructTemplate')
@push('style')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
@endpush
@section('container')
{{-- NavBar --}}

    <nav class="navbar navbar-expand-lg bg-green-primary nav-underline">
        <div class="container-fluid">
        <img class=" ms-3 navbar-brand" src="{{asset('assets/navbar/LogoDurianSlumbung.png')}}" style="max-width:8vw; max-height:auto;">

        <div class="d-flex justify-content-center" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item mx-2">
                <a class="nav-link text-white active" aria-current="page" href="#">Home</a>
            </li>
            <li class="nav-item mx-2">
                <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item dropdown mx-2">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Dropdown
                </a>
                <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
            </li>
            <li class="nav-item mx-2">
                <a class="nav-link disabled" aria-disabled="true">Disabled</a>
            </li>
            </ul>
        </div>

        <div class="d-flex me-3 align-items-center">
            {{-- <a href="{{}}" class="btn bg-gray-light border border-2">Login</a> --}}


            {{-- Shopping Cart --}}
            <a href="" class="mx-4">
                <img src="{{asset('assets/navbar/shopping-cart.png')}}" alt="" style="max-width:1.5vw; max-height:auto;">
            </a>
            {{-- Logo --}}
            <a href="" class="bg-gray-light " style=" border-radius:50%">
                <img src="{{asset('assets/navbar/shopping-cart.png')}}" alt="" style="max-width: 3vw; max-height:auto; border-radius:50%">
            </a>

        </div>
        </div>
    </nav>

{{-- Content --}}
@yield('content')

{{-- Footer --}}




@endsection
@push('script')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
@endpush
