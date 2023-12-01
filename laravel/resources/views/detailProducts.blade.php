@extends('template.customerTemplate')
@section('title')
    <title>Details</title>
    @php
        $title = "Detail";
    @endphp
@endsection
@push('style')
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    ::-webkit-scrollbar {
        display: none;
    }
    .comment-section-outer {
        max-width: 300px; /* Adjust the maximum width as needed */
        border: 1px solid #ccc; /* Optional styling for the outer container */
        overflow: hidden;
    }

    .comment-section-inner {
        margin-bottom: -20px; /* Adjust margin to make space for the scrollbar */
        overflow-y: auto; /* Use "auto" to show vertical scrollbar only when needed */
        overflow-x: hidden;
        scrollbar-width: thin; /* "auto" or "thin" depending on your preference - Firefox */
        scrollbar-color: transparent transparent; /* Adjust colors as needed - Firefox */
    }

    .comment-section-inner::-webkit-scrollbar {
        width: 0.5em; /* Adjust width as needed - WebKit browsers */
    }

    .comment-section-inner::-webkit-scrollbar-thumb {
        background-color: transparent; /* Adjust color as needed - WebKit browsers */
    }

    .content {
        padding: 20px; /* Adjust padding as needed */
    }
</style>
<script>

     function like(comment){
        var currentSrc = $(comment).attr('src');
        // Define the new image source
        if(currentSrc!=undefined)
        var newSrc = (currentSrc === "{{asset('assets/detail/like.png')}}") ? "{{asset('assets/detail/liked.png')}}" : "{{asset('assets/detail/like.png')}}";
        // Change the image source
        $(comment).attr('src', newSrc);
    }
    function addComment(){
        let product_id = '{{$product["product_id"]}}';
        let username = '{{Session::get("username")}}';
        let message = $("#commentToAdd").val();
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        });
        $.post('/comments', {
            message: message,
            username: username,
            product_id: product_id
        }, function(response) {
            // Handle the successful response
            console.log(response);
            $("#comment").html(response);
            // console.log("Berhasil");
        })
        .fail(function(error) {
            // Handle errors
            console.error('Error:', error);
        });
    }

</script>
@endpush
@section('content')
    <pre>
        @php
            // print_r(Session::get("username"));
            // print_r($product["product_id"]);
            // print_r($comments);
            // echo $rating;
        @endphp
    </pre>
    <div class="row my-4"></div>
    <div class="container-md">
        <h1 class="ps-3 mb-5">Detail Product</h1>



        <div class="row my-2">
            <div class="col-3 mx-3">
                <div class="row d-flex justify-content-center">
                    <img src="{{$product->img_url}}" class="card-img-top rounded-4" alt="..." style="max-width:20rem;max-height:auto;">
                </div>
            </div>
            <div class="col-8 mx-3 text-start bg-blue-light text-dark rounded-4">
                <h2 class="p-3 mb-2">{{$product->name}}</h2>
                <span class="fw-semibold fs-4 p-3 mb-5">Description</span>
                <p style="text-indent:3em;">{{$product->description}}</p><br>
                <span class="fw-semibold fs-4 p-3">Price</span>
                <p class ="fw-semibold"style="text-indent:1.5em;">Rp. {{intval($product->price)}},00</p><br>
                <span class="fw-semibold fs-4 ps-3">Qty</span>
                <p style="text-indent:1.5em;"><span class="fw-semibold" id="qty">{{intval($product->qty)}} Pcs</span></p><br>

            </div>
        </div>



        <div class="row my-2">
            <div class="col-3 mx-3">
                <div class="row my-2">
                    <p class="text-center fw-semibold">Leave a rating down below!</p>
                    <div class="d-flex justify-content-center">
                        <span class="fa fa-star mx-1 fs-4"  onclick="rate(1)"></span>
                        <span class="fa fa-star mx-1 fs-4"  onclick="rate(2)"></span>
                        <span class="fa fa-star mx-1 fs-4"  onclick="rate(3)"></span>
                        <span class="fa fa-star mx-1 fs-4"  onclick="rate(4)"></span>
                        <span class="fa fa-star mx-1 fs-4"  onclick="rate(5)"></span>
                    </div>
                </div>
                <div class="row my-2"></div>
                <div class="row my-2">
                    <div class="fs-5 fw-semibold text-start">Comments : </div>
                    <div class="row mt-2">
                        {{-- <form action="" method="post">
                            @csrf --}}
                            <div class="row mt-2">
                                <div class="col-9 p-2"><input type="text" name="comment" class="form-control fs-5" placeholder="Comment" id="commentToAdd"></div>
                                <div class="col-3 p-2"><button type="submit" class="btn bg-blue-dark p-2 fw-semibold text-white" onclick="addComment()">Comment</button></div>
                            </div>
                        {{-- </form> --}}
                    </div>
                    <div class="comment-section comment-section-outer rounded-2 mt-3 shadow">
                        <div class="comment-section-inner" id="comment">
                            {{-- dolorem exercitationem! Odit, beatae! Nulla magnam magni ipsum modi voluptatum minima quis aspernatur, accusantium nobis dolores, nostrum, consequuntur earum officiis voluptate mollitia ratione animi quod beatae dicta dolorem facilis? Vitae voluptatem dolor modi facere omnis sint tenetur suscipit animi velit doloremque neque sit iste temporibus sed tempore, aliquam quae pariatur recusandae distinctio voluptatum? --}}
                            @include('commentContent',['comments'=>$comments])
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-8">
                <div class="row fs-2 fw-semibold my-2">
                    <div class="col-1">Rp.</div>
                    <div class="col-11"><span id="subtotal text-start">-</span></div>
                </div>
                <hr>
                <div class="row my-2">
                    <h5 class="ps-5 mb-3">Quantity to buy :</h5>
                    <div class="col-9 d-flex justify-content-center ps-5">
                        <input type="text" name="" id="qty" class="form-control p-2 fs-5" placeholder="Input Quantity">
                    </div>
                    <div class="col-3 d-flex justify-content-center">
                        <a href="" class="btn bg-blue-dark p-2 text-white fs-5" style="width:5vw;">Buy</a>
                    </div>
                </div>
            </div>
        </div>


        <div class="row my-5 text-center">
            <span class="fs-1 fw-semibold mt-5">You Might Also Like</span>
            <div class="row d-flex justify-content-center">
                @for ($i = 1; $i <= 3; $i++)
                    @include('productsCard')
                @endfor
            </div>
        </div>
    </div>
    <div class="row my-5"></div>
    @endsection
    @push('script')
    <script>
        
        let ratingValue = 0;
        $(document).ready(function () {
        ratingValue = {{$rating}};
        updateStars();
    });
    function rate(value) {
        let product_id = '{{$product["product_id"]}}';
        let username = '{{Session::get("username")}}';
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        });
        if(ratingValue == value){
            // remove star sama record di db likes
            removeAllActiveStars();
            ratingValue =0;
            $.post('/product/delete', {
                username: username,
                product_id: product_id,
            }, function(response) {
                // Handle the successful response
                console.log(response);
                // console.log("Berhasil");
            })
            .fail(function(error) {
                // Handle errors
                console.error('Error:', error);
            });
        }else{
            ratingValue = value;
            //cek apakah ada di db kalau ga di insert kalau ada di update
            updateStars();
            $.post('/product/like', {
                username: username,
                product_id: product_id,
                rating: value
            }, function(response) {
                // Handle the successful response
                console.log(response);
                // console.log("Berhasil");
            })
            .fail(function(error) {
                // Handle errors
                console.error('Error:', error);
            });
        }
    }

    function updateStars() {
        const stars = document.querySelectorAll('.fa-star');
        stars.forEach((star, index) => {
            star.classList.toggle('active-star', index < ratingValue);
        });
    }
    function removeAllActiveStars() {
        const stars = document.querySelectorAll('.fa-star');
        stars.forEach((star) => {
            star.classList.remove('active-star');
    });

}
</script>
@endpush
