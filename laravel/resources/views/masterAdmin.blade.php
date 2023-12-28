@extends('template.adminTemplate')
@section('title')
    <title>CRUD Admin</title>
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
<div class="text-3xl font-bold my-2  text-center">Admins</div>
<div class="grid grid-cols-3 p-10 ">
    <div class="flex justify-center p-5 mx-5 border-2 border-black grid grid-cols-1 rounded-lg" style="height:75vh;">
            <label class="form-control">
                <div class="label">
                  <span class="label-text">Filter Admins</span>
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
            @include('masterAdminCard',['admins'=>$admins])
        </div>
    </div>
    <div id="form" class="col-span-2 border-2 rounded-lg border-black p-5 me-5" style="width:100%">
        <div class="text-3xl font-bold mb-5">Create Admin</div>
        <div class="my-1">
            Username : <input type="text" placeholder="Type here" class="input input-bordered w-full max-w-xs" />
        </div>
        <div class="my-1">
            Password : <input type="text" placeholder="Type here" class="input input-bordered w-full max-w-xs" />
        </div>
        <button class="btn btn-success">Add Admin</button>
    </div>
    <div id="product" class="col-span-2 border-2 rounded-lg border-black p-5 me-5" style="width:100%">
        <div class="text-3xl font-bold">Update Admin</div>
        <div id="adminContentView">

        </div>
    </div>
</div>
@endsection
@push('script')
<script>
    function admin(admin_id){
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
        $('#adminContentView').load('/masterAdminView',
            {
                a_id:admin_id
            },function(response){
                $('#adminContentView').html(response);
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
        $('#productContent').load('/searchAdmin',
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

    function updateAdmin(p_id){
        console.log(p_id);
    }
    function deleteAdmin(p_id){
        console.log(p_id);
    }
    $(document).ready(function(){
        create();
    });
</script>
@endpush

