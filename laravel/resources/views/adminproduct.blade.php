@extends('template.adminTemplate')
@section('title')
    <title>Admin Product</title>
@endsection
@push('style')
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<style>
    ::-webkit-scrollbar {
        display: none;
    }
    .products{
        margin-bottom: -20px; /* Adjust margin to make space for the scrollbar */
        overflow-y: auto; /* Use "auto" to show vertical scrollbar only when needed */
        overflow-x: hidden;
        scrollbar-width: thin; /* "auto" or "thin" depending on your preference - Firefox */
        scrollbar-color: transparent transparent; /* Adjust colors as needed - Firefox */
    }

    .products::-webkit-scrollbar {
        width: 0.5em; /* Adjust width as needed - WebKit browsers */
    }

    .products::-webkit-scrollbar-thumb {
        background-color: transparent; /* Adjust color as needed - WebKit browsers */
    }
    #product.hidden{
        opacity:0
    }
    #product.visible{
        opacity: 1;
    }
    #form.hidden{
        opacity: 0;
    }
    #form.visible{
        opacity: 1;
    }
</style>
@endpush
@section('content')
<div class="text-3xl font-bold my-2  text-center">Products</div>
<div class="grid grid-cols-3 p-10 ">
    <div class="flex justify-center p-5 mx-5 border-2 border-black grid grid-cols-1 rounded-lg" style="height:75vh;">
            <label class="form-control">
                <div class="label">
                  <span class="label-text">Filter Products</span>
                </div>
                <div class="grid grid-cols-2">
                    <input type="text" placeholder="Product's name" class="input input-bordered w-full max-w-xs mb-1" oninput="search(this.value)"/>
                    <button class="btn btn-outline btn-success mx-3" onclick="create()">
                        Add +
                    </button>
                </div>
            </label>
        <hr class="border-t-2 border-black">
        <div class="products" id="productContent">
            @include('adminproductCard',['products'=>$products])
        </div>
    </div>
    <div id="form" class="col-span-2 border-2 rounded-lg border-black p-5 me-5" style="width:100%">
        <div class="text-3xl font-bold mb-5">Create a Product</div>
    <form action="" method="post" enctype="multipart/form-data">
        @csrf
        <div class="my-1">
            Name : <input type="text" placeholder="Type here" class="input input-bordered w-full max-w-xs" name="name" id="name" required>
        </div>
        <div class="my-1">
            Price : <input type="number" placeholder="Type here" class="input input-bordered w-full max-w-xs" name="price" id="price" required>
        </div>
        <div class="my-1">
            Category : 
            <select class="select select-bordered w-full max-w-xs" name="category" id="category" required>
                <option disabled selected>Select A Category</option>
                @foreach ($category as $c)
                    <option value="{{$c['category_id']}}">{{$c['name']}}</option>
                @endforeach
            </select>
        </div>
        <div class="my-1">
            QTY : <input type="number" placeholder="Type here" class="input input-bordered w-full max-w-xs" name="qty" id="qty" required>
        </div>
        <div class="my-1">
            Image : <input type="file" class="file-input w-full max-w-xs" name="img[]" id="img" required>
        </div>
        <div class="my-1">
            Description : <br> <textarea class="textarea textarea-bordered textarea-md w-full max-w-xs" placeholder="Bio" name="desc" id="desc" required></textarea>
        </div>
        <button type="submit" class="btn btn-outline btn-success" name="btnAdd" data-bs-toggle="modal" data-bs-target="#popup">Add Product</button>
    </form>
    </div>
    <div id="product" class="col-span-2 border-2 rounded-lg border-black p-5 me-5" style="width:100%">
        <div class="text-3xl font-bold">Update a Product</div>
        <div id="productContentView">

        </div>
    </div>
</div>

@endsection
@push('script')
<script>
    function product(product_id){
        $('#product').addClass('visible');
        $('#product').removeClass('hidden');

        $('#form').addClass('hidden');
        $('#form').removeClass('visible');
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        });
        $('#productContentView').load('/adminproductView',
            {
                p_id:product_id
            },function(response){
                $('#productContentView').html(response);
            }
        );
    }
    function search(value){
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        });
        $('#productContent').load('/searchadminproduct',
            {
                name:value
            },function(response){
                $('#productContent').html(response);
            }
        );
    }
    function create(){
        $('#form').addClass('visible');
        $('#form').removeClass('hidden');

        $('#product').addClass('hidden');
        $('#product').removeClass('visible');
    }
    function updateProduct(p_id) {
        var name = $('#nameUpdate').val();
        var price = $('#priceUpdate').val();
        var category = $('#categoryUpdate').val();
        var qty = $('#qtyUpdate').val();
        var img = $('input[name="imgUpdate"]').val();
        var desc = $('#descUpdate').val();
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        var data = {
            name: name,
            price: price,
            category: category,
            qty: qty,
            img: img,
            desc: desc
        };

        console.log(data);
        console.log(csrfToken);
        $.ajax({
            url: `/updateproduct/${p_id}`,
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            data: data,
            success: function (data) {
                console.log('Product updated successfully');
                $('#productContent').html(data);
                $('#productContentView').html('Updated successfully');
            }
        });
    }
    function deleteProduct(p_id) {
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        
        $.ajax({
            url: `/deleteproduct/${p_id}`,
            type: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            success: function (data) {
                console.log('Product deleted successfully:', p_id);

                $('#productContent').html(data);
                $('#productContentView').html('Deleted successfully');
            }
        });
    }
    $(document).ready(function(){
        create();
    });
</script>
@endpush
