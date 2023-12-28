@extends('template.customerTemplate')
@section('title')
    <title>Products</title>
    @php
        $title = "Product";
    @endphp
@endsection
@push('style')
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
@endpush
@section('content')
    <div class="container-fluid my-3">
        <div class="row">
            <div class="col-9 fs-2 fw-semibold me-5">&ensp;&ensp;&ensp;&ensp;Products on sale</div>
            <div class="col-2 me-5 d-flex justify-content-end dropdown">
                <button class="btn bg-blue-dark text-dark fw-semibold dropdown-toggle fs-4 z-2" type="button" data-bs-toggle="dropdown" aria-expanded="false" onclick="">
                  Filter Products
                </button>
                <ul class="dropdown-menu p-4 bg-white-smoke dropdown-anim z-1" style="min-width:100%;">
                    <li>
                        <span class="text-start fw-semibold">Filter by Name :</span>
                        <div class="col-10"><input type="text" name="searchProduct" id="searchBar" class="form-control" placeholder="Search" oninput="search()"></div>
                    </li>
                     <li>
                        <span class="text-start fw-semibold">Filter by Maximum Price : </span><br>
                        Rp. <span class="text-start" id="maxPrice">{{intval($maxPrice)}}</span>
                        <div class="col-10"><input type="range" class="form-range" min="0" max="{{$maxPrice}}" step="{{$step}}" id="rangePriceMax" oninput="search()" value={{$maxPrice}}></div>
                    </li>
                    <li>
                        <span class="text-start fw-semibold">Filter by Minimum Price : </span><br>
                        Rp. <span class="text-start" id="minPrice">0</span>
                        <div class="col-10"><input type="range" class="form-range" min="0" max="{{$maxPrice}}" step="{{$step}}" id="rangePriceMin" oninput="search()" value="0"></div>
                    </li>
                    <li>
                        <span class="text-start fw-semibold">Filter by Maximum Rating : </span><br>
                        <span class="text-start" id="rated">5</span>⭐
                        <div class="col-10"><input type="range" class="form-range" min="1" max="5" step="0.5" id="rangeRating" oninput="search()" value="5"></div>
                    </li>
                    <li>
                        From <span class="text-start fw-semibold" id="category">All Category</span><br>
                        <select class="form-select" aria-label="Default select example" onchange="search()" id="categoryPicked">
                            <option value="" selected>All Category</option>
                            @foreach ($categories as $category)
                                <option value="{{$category->category_id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </li>
                </ul>
            </div>
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
    <div class="container-md" id="content" style="min-height:75vh;">
        @include('productsContent',["products"=>$products])
    </div>
    <div class="row my-5"></div>
@endsection
@push('script')
<script>
    function search(){
        let toSearch = $("#searchBar").val();
        let maxPrice = $("#rangePriceMax").val();
        let minPrice = $("#rangePriceMin").val();
        let rated = $("#rangeRating").val();
        let category = $("#categoryPicked").val();


        $("#maxPrice").html(maxPrice);
        $("#minPrice").html(minPrice);
        $("#rated").html(rated);


        let categoryText = $("#categoryPicked :selected").text();
        $("#category").html(categoryText);

        var like = toSearch;
        let mode = true;


        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        });
        if(like !== "" || maxPrice < {{intval($maxPrice)}} || minPrice > 0|| rated <5 || category !== ""){
            mode = false;
        }
        $("#content").load('/product',{
            like:like,
            maxPrice:maxPrice,
            minPrice:minPrice,
            rated:rated,
            category:category,
            mode:mode
        },function (response) {
            $('#content').html(response);
            // console.log(response);
        })
    }
</script>
@endpush
