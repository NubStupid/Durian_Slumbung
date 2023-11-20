@extends('template.customerTemplate')
@section('title')
    <title>Products</title>
    @php
        $title = "Product";
    @endphp
@endsection
@section('content')
    <div class="container-fluid my-3">
        <div class="row">
            <div class="col-9 fs-2 fw-semibold me-5">&ensp;&ensp;&ensp;&ensp;Products on sale</div>
            <div class="col-2 ms-5 d-flex justify-content-end"><input type="text" name="searchProduct" id="" class="form-control" placeholder="Search"></div>
        </div>
    </div>
    @isset($carouselItem)
        <div id="carouselExampleCaptions" class="carousel slide">
            <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                {{-- For loop data dari carousel --}}
                <div class="carousel-item active">
                    <img src="..." class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                    <h5>First slide label</h5>
                    <p>Some representative placeholder content for the first slide.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="..." class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                    <h5>Second slide label</h5>
                    <p>Some representative placeholder content for the second slide.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="..." class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                    <h5>Third slide label</h5>
                    <p>Some representative placeholder content for the third slide.</p>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
            </button>
        </div>
    @endisset
    <div class="container-md">
        @for ($i = 1; $i <= count($products); $i++)
            @if($i == 1)
                <div class="row row-cols-3 d-flex justify-content-center">
                    @include('productsCard')
            @elseif($i%3==0)
                    @include('productsCard')
                </div>
                <div class="row row-cols-3 d-flex justify-content-center">
            @else
                @include('productsCard')
            @endif
        @endfor
        </div>
    </div>
@endsection
