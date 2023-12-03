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
                <p class ="fw-semibold"style="text-indent:1.5em;">Rp. {{number_format($product->price,0,",",".")}}</p><br>
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
                        <div class="col-9 p-2"><input type="text" name="comment" id="" class="form-control fs-5" placeholder="Comment"></div>
                        <div class="col-3 p-2"><a href="" class="btn bg-blue-dark p-2 fw-semibold text-white">Comment</a></div>
                    </div>
                    <div class="comment-section comment-section-outer rounded-2 mt-3 shadow">
                        <div class="comment-section-inner">
                            {{-- dolorem exercitationem! Odit, beatae! Nulla magnam magni ipsum modi voluptatum minima quis aspernatur, accusantium nobis dolores, nostrum, consequuntur earum officiis voluptate mollitia ratione animi quod beatae dicta dolorem facilis? Vitae voluptatem dolor modi facere omnis sint tenetur suscipit animi velit doloremque neque sit iste temporibus sed tempore, aliquam quae pariatur recusandae distinctio voluptatum? --}}
                            @foreach ($comments as $comment)
                                @include('commentCard',['comment'=>$comment])
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-8">
                <div class="row fs-2 fw-semibold my-2">
                    <div class="col-1">Rp.</div>
                    <div class="col-11"><span id="subtotal">0</span></div>
                </div>
                <hr>
                <div class="row my-2">
                    <h5 class="ps-5 mb-3">Quantity to buy :</h5>
                    <div class="col-1 my-auto ps-5">
                        <button class="circle py-auto decreaseQty" id="dec"><b>-</b></button>
                    </div>
                    <div class="col-1 d-flex justify-content-center ps-4 pe-0">
                        <input type="text" name="" class="form-control p-2 fs-5 qty" placeholder="0" value="1" style="text-align:center;" onchange="cekbutton()">
                    </div>
                    <div class="col-1 my-auto pe-5">
                        <button class="circle py-auto increaseQty" id="inc"><b>+</b></button>
                    </div>
                    <div class="col-6">

                    </div>
                    <div class="col-3 d-flex justify-content-center">
                        <form action="{{ route('add-cart', ['id' => $product->product_id])  }}" Method="POST"onsubmit="cekqty()">
                            @csrf
                            <input type="hidden" name="qty" id="getQty">
                            <input type="submit" class="btn bg-blue-dark p-2 text-white fs-5" style="width:5vw;" value="Buy">
                        </form>
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

    {{-- Popup add to cart --}}
    @if(session('success'))
    <div class="modal fade" id="HasilAdd" tabindex="-1" aria-labelledby="HasilAdd" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-body text-center">
                <img src="{{asset('assets/misc/berhasiladdtocart.gif')}}" class="my-2" alt="" width="max-content" height="110px">
              <h5 class="py-2">Berhasil Menambah ke keranjang!</h5>
              <button type="button" class="btn btn-secondary mx-5 w-0" data-bs-dismiss="modal" aria-label="Close" id="okayButton">Sip!</button>
            </div>
          </div>
        </div>
    </div>
    @endif
    @if(session('error'))
    <div class="modal fade" id="HasilAdd" tabindex="-1" aria-labelledby="HasilAdd" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-body text-center">
                <img src="{{asset('assets/misc/gagaladdtocart.gif')}}" class="my-2" alt="" width="max-content" height="110px">
              <h5 class="py-2">Jumlah barang di keranjang melebihi stok!</h5>
              <button type="button" class="btn btn-secondary mx-5 w-0" data-bs-dismiss="modal" aria-label="Close" id="okayButton">Oke</button>
            </div>
          </div>
        </div>
    </div>
    @endif
@endsection
@push('script')
<script>
    let ratingValue = 0;
    $(document).ready(function () {
        ratingValue = {{$rating}};
        updateStars();
        loadData();
        showModal();

        $('.decreaseQty').click(function(e) {
            e.preventDefault();
            var qty = $('.qty').val();
            var value = parseInt(qty);
            value = isNaN(value) ? 0 : value;
            if(value>1){
                value--;
                $('.qty').val(value);
                let harga = {{$product->price}};
                var subtotal = harga*value;
                if (!isNaN(subtotal))
                    document.getElementById("subtotal").innerHTML = new Intl.NumberFormat("id-ID").format(subtotal);
            }
            $( ".qty" ).trigger( "change" );
        });
        
        
        $('.increaseQty').click(function(e) {
            
            e.preventDefault();
            var qty = $('.qty').val();
            var value = parseInt(qty);
            value = isNaN(value) ? 0 : value;
            let maksqty = {{$product->qty}};
            if(value<maksqty){
                value++;
                let harga = {{$product->price}};
                var subtotal = harga*value;
                if (!isNaN(subtotal))
                    document.getElementById("subtotal").innerHTML = new Intl.NumberFormat("id-ID").format(subtotal);
                
                $('.qty').val(value);
            }
            $( ".qty" ).trigger( "change" );
        });
        $('.qty').on('input', function() {
            var value = $(this).val();

            if (!/^-?\d*\.?\d+$/.test(value)) {
                value = value.replace(/[^\d-]/g, '');
            } 
            let maksqty = {{$product->qty}};
            var countMinus = (value.match(/-/g) || []).length;
            if (countMinus > 1 || (countMinus === 1 && value.indexOf('-') !== 0)) {
                value = value.replace(/-/g, '');
            }
            if(value<1){
                value = 0;
            }
            else if(value>maksqty){
                value = maksqty;
            }
            else if(value.length === 2 && value.charAt(0) === '0' && value.charAt(1) !== '0') {
                value = value.substring(1);
            }
            loadData();
            $(this).val(value);
        });
        $('.qty').on('change', function (){
            cekbutton();
        });
        $('.qty').on('blur', function() {
            var value = $(this).val();
            if(value === '0') {
                $(this).val('1');
            }
            loadData();
        });
    });
    
    function cekqty() {
        var qtyValue = document.querySelector('.qty').value;
        document.getElementById('getQty').value = qtyValue;
    }
    function showModal() {
        $('#HasilAdd').modal('show');
    }
    function loadData(){
        var qty = $('.qty').val();
        var value = parseInt(qty);
        value = isNaN(value) ? 0 : value;
        let harga = {{$product->price}};
        let maksqty = {{$product->qty}};
        var subtotal = harga*value;
        if(subtotal>harga*maksqty){
            subtotal = harga * maksqty;
        }
        if (!isNaN(subtotal))
            document.getElementById("subtotal").innerHTML = new Intl.NumberFormat("id-ID").format(subtotal);

        if (value <=1) {
            $('.decreaseQty').prop('disabled', true);
        } else {
            $('.decreaseQty').prop('disabled', false);
        }
    }
    function cekbutton(){
        var qty = $('.qty').val();
        var value = parseInt(qty);
        value = isNaN(value) ? 0 : value;
        let maksqty = {{$product->qty}};
        if (value <= 1) {
            $('.decreaseQty').prop('disabled', true);
        } else {
            $('.decreaseQty').prop('disabled', false);
        }
        if (value === maksqty) {
            $('.increaseQty').prop('disabled', true);
        } else {
            $('.increaseQty').prop('disabled', false);
        }
    }
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
    function addqty(){

    }
</script>
@endpush
