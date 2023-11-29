@extends('template.basicStructTemplate')
@push('style')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
@endpush
@section('container')
{{-- NavBar --}}

    <nav class="navbar navbar-expand-lg bg-green-primary nav-underline">
        <div class="container-fluid">
        <img class="navbar-brand" src="{{asset('assets/navbar/LogoDurianSlumbung.png')}}" style="max-width:8vw; max-height:auto;">
        @php
            $activeHome = "";       $hrefHome ="/";
            $activeProduct = "";    $hrefProduct ="/product";
            $activeWisata ="";      $hrefWisata ="/wisata";
            $activeAbout = "";      $hrefAbout = "/about";
            $activeCart = "";       $hrefCart = "/cart";
            if($title == "Home"){
                $activeHome = "active";
                $hrefHome = "#";
            }else if($title == "Product"){
                $activeProduct = "active";
                $hrefProduct = "#";
            }else if($title == "Wisata"){
                $activeWisata = "active";
                $hrefWisata = "#";
            }else if($title == "About"){
                $activeAbout = "active";
                $hrefAbout = "#";
            }
        @endphp
        <div class="d-flex justify-content-center" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item mx-2">
                    <a class="nav-link text-white {{$activeHome}}" aria-current="page" href={{url($hrefHome)}}>Home</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link text-white {{$activeProduct}}" aria-current="page" href={{url($hrefProduct)}}>Products</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link text-white {{$activeWisata}}" aria-current="page" href={{url($hrefWisata)}}>Wisata</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link text-white {{$activeAbout}}" aria-current="page" href={{url($hrefAbout)}}>About</a>
                </li>
            </ul>
        </div>

        <div class="d-flex me-3 align-items-center">
            @if($user == null)

                <a href="{{url('/login')}}" class="btn bg-gray-light border border-2">Login</a>

            @else
                {{-- Shopping Cart --}}
                <a href="{{url($hrefCart)}}" class="me-4 pe-2">
                    <img src="{{asset('assets/navbar/shopping-cart.png')}}" alt="" style="max-width:1.5vw; max-height:auto;">
                </a>
                {{-- Logo --}}
                <a href="" class="bg-gray-light user-logo" style=" border-radius:50%">
                    <img src="{{asset('assets/navbar/shopping-cart.png')}}" alt="" style="max-width: 3vw; max-height:auto; border-radius:50%">
                </a>

            @endif

        </div>
        </div>
    </nav>

{{-- Content --}}
@yield('content')

{{-- Footer --}}

<div class="container-fluid py-3 bg-green-primary">
    <div class="row">


        {{-- Bagian Kiri Footer --}}


        <div class="col-4">
            <p class="ms-5 text-light fs-2 fw-bold">DURIAN SLUMBUNG</p>
            <p class="ms-5 text-light fs-4 fw-semibold">Follow Us On</p>
            <div class="d-flex flex-row ms-5 mb-3">
                <a href="https://www.instagram.com/durkedir" class=" pe-2">
                    <img src="{{asset('assets/footer/instagram.png')}}" alt="ig" srcset="" width="30px" height="30px">
                </a>
                <a href="https://www.tiktok.com/@duriankediri" class=" pe-2">
                    <img src="{{asset('assets/footer/tiktok.png')}}" alt="tt" srcset="" width="30px" height="30px">
                </a>
                <a href="https://www.facebook.com/duriankediribergaransi" class=" pe-2">
                    <img src="{{asset('assets/footer/facebook.png')}}" alt="fb" srcset="" width="30px" height="30px">
                </a>
                <a href="https://www.youtube.com/c/NDESOEXPLORE" class=" pe-2">
                    <img src="{{asset('assets/footer/youtube.png')}}" alt="yt" srcset="" width="30px" height="30px">
                </a>
            </div>
            <p class="ms-5 text-light fw-semibold" style="font-size: 10px;">Durian Slumbung 2023 | Icons by Icon8</p>
        </div>


        {{-- Bagian Tengah Footer --}}


        <div class="col-4 my-auto">
            <nav class="nav-underline">
                <div class="row">
                    <div class="col">
                        <div class="d-flex justify-content-center my-1">
                            <a class="nav-link text-light <?= $activeHome ?>" aria-current="page" href={{url($hrefHome)}}>Home</a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="d-flex justify-content-center my-1">
                            <a class="nav-link text-light <?= $activeProduct ?>" href={{url($hrefProduct)}}>Products</a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="d-flex justify-content-center my-1">
                            <a class="nav-link text-light <?= $activeWisata ?>" href={{url($hrefWisata)}}>Wisata</a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="d-flex justify-content-center my-1">
                            <a class="nav-link text-light <?= $activeAbout ?>" href={{url($hrefAbout)}}>About</a>
                        </div>
                    </div>
                </div>


            </nav>
        </div>


        {{-- Bagian Kanan Footer --}}


        <div class="col-4">
            <div class="row">
                <div class="col">
                    <div class="row align-items-bottom justify-content-center">
                        <div class="col-1 d-flex justify-content-end">
                            <img src="{{asset('assets/footer/location.png')}}" alt="loc" srcset="" width="30px" height="30px">
                        </div>
                        <div class="col-3">
                            <h3 class="text-light">LOCATION</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <p class="text-light info-footer text-center">Durkedir (Durian Kediri) 100% BERGARANSI, Meloyo, Mlancu, Kec. Kandangan, Kabupaten Kediri, Jawa Timur 64294</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="row align-items-bottom justify-content-center">
                        <div class="col-3 d-flex justify-content-end">
                            <img src="{{asset('assets/footer/contact.png')}}" alt="loc" srcset="" width="30px" height="30px">
                        </div>
                        <div class="col-6">
                            <h3 class="text-light">Contact Person</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <p class="text-light info-footer text-center">WA : 0812-5975-6928 (Mulyono)<br>WA : 0812-5441-1245 (Bang Jono)</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
@push('script')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
@endpush
