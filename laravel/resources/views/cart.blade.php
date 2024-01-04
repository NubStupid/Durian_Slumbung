@extends('template.customerTemplate')
@section('title')
    <title>Cart</title>
    @php
        $title = "Cart";
    @endphp
@endsection

@push('style')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endpush
@section('content')
    <div class="text-center d-flex justify-content-center mt-5 mb-2">
        <ul class="nav nav-underline fs-4">
            <li class="nav-item mx-3">
              <a class="nav-link active" aria-current="page" href="#">Cart</a>
            </li>
            <li class="nav-item mx-3">
              <a class="nav-link text-dark" href="/history">History</a>
            </li>
          </ul>
    </div>
    {{-- <div class="d-flex justify-content-center mb-5" style="width: 100px; background-color:black; height:5px;"></div> --}}
    <?php $total = 0; $totalqty = 0; ?>
    @if(count($listcart)!=0)
    <div class="container-fluid cart-content">
        <div class="row px-5">
            <div class="col-9 container-fluid">
                @foreach($listcart as $cekdata)
                    @if(substr($cekdata->product_id, 0, 1) === "P")
                        @foreach($listproduct as $data)
                            @if($data->product_id == $cekdata->product_id)
                                <?php $qtyproduk = $cekdata->qty; ?>
                                <?php $maksqty = $data->max_quantity; ?>
                                <?php
                                    $totalqty += $cekdata->qty;
                                    $total += $cekdata->qty*ceil($cekdata->price);
                                ?>
                                <input type="hidden" class="maxQty_{{$cekdata->product_id}}" value="{{$maksqty}}">
                                <div class="mx-5 row no-gutters my-5" style="background-color:var(--bg-blue-dark);">
                                    <div class="col-md-3">
                                        <img src="{{$data->img_url}}" class="card-img" alt="">
                                    </div>
                                    <div class="col-md-9">
                                        <div class="row">
                                            <div class="col-8 mt-3">
                                                <h3>
                                                    {{$data->name}}
                                                </h3>
                                                <h4 class="mt-3">
                                                    Rp. {{number_format($data->price,0,",",".")}}
                                                </h4>
                                                <h5 class="mt-3">
                                                    {{$data->description}}
                                                </h5>
                                            </div>
                                            <div class="col-4">
                                                <div class="pb-5 pt-3 d-flex justify-content-end me-3">
                                                    <button class="ms-5 border border-0" data-bs-target="#updateQty" data-bs-toggle="modal" data-qty="{{ $cekdata->qty }}" data-maxqty="{{ $data->qty }}" data-id="{{ $cekdata->cart_id }}"><img src="{{asset('assets/cart/edit.png')}}" alt="Edit" width="max-content" height="40vh"></button>
                                                </div>
                                                <div class="p-5"></div>
                                                <div class="p-4"></div>
                                                <div class="mt-auto pe-2 d-flex">
                                                    <input type="text" name="" class="form-control p-2 fs-5 qty_{{$cekdata->product_id}} me-3" placeholder="0" value="{{$cekdata->qty}}" style="text-align:center;" onchange="cekbutton()" readonly >
                                                    <button class=" mx-3 deleteCartItem border border-0" data-cart-id="{{$cekdata->cart_id}}"><img src="{{asset('assets/cart/trashicon.png')}}" alt="Trash Icon" width="max-content" height="50vh"></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @break
                            @endif
                            <div class="modal fade" id="updateQty" tabindex="-1" role="dialog" aria-labelledby="updateQtyLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="updateModalLabel">Update Qty</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('update.qty') }}" method="POST">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="newQty">Qty</label>
                                                    <input type="number" class="form-control" id="tempQty" name="tempQty" min="0" max="{{ $data->qty }}">
                                                    <input type="hidden" name="cekid" id="cekid">
                                                </div>
                                                <button type="submit" class="btn btn-primary my-2">Update Qty</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @elseif(substr($cekdata->product_id, 0, 1) === "W")
                        @foreach($listwisata as $data)
                            @if($data->wisata_id == $cekdata->product_id)
                                @foreach($listolahan as $dataolahan)
                                    @if($data->olahan_id === $dataolahan->olahan_id)
                                        <?php $qtyproduk = $cekdata->qty; ?>
                                        <?php $maksqty = $data->quantity; ?>
                                        <?php
                                            $totalqty += $cekdata->qty;
                                            $total += $cekdata->qty*ceil($cekdata->price);
                                        ?>
                                        <input type="hidden" class="maxQty_{{$cekdata->product_id}}" value="{{$maksqty}}">
                                        <div class="mx-5 row no-gutters my-5" style="background-color:var(--bg-blue-dark);">
                                            <div class="col-md-3">
                                                <img src="{{asset('assets/wisata/olahan/'.$dataolahan->img)}}" class="card-img" alt="gabisa">
                                            </div>
                                            <div class="col-md-9">
                                                <div class="row">
                                                    <div class="col-8 mt-3">
                                                        <h3>
                                                            {{$dataolahan->name}}
                                                        </h3>
                                                        <h4 class="mt-3">
                                                            Rp. {{number_format($cekdata->price,0,",",".")}}
                                                        </h4>
                                                        <p class="mt-3">
                                                            {{$dataolahan->description}}
                                                        </p>
                                                    </div>
                                                    <div class="col-4 mb-3">
                                                        <div class="pb-5 pt-3 d-flex justify-content-end me-3">
                                                            <button class="ms-5 border border-0" data-bs-target="#updateQty" data-bs-toggle="modal" data-qty="{{ $cekdata->qty }}" data-maxqty="{{ $data->qty }}" data-id="{{ $cekdata->cart_id }}"><img src="{{asset('assets/cart/edit.png')}}" alt="Edit" width="max-content" height="40vh"></button>
                                                        </div>
                                                        <div class="p-5"></div>
                                                        <div class="p-4"></div>
                                                        <div class="mt-auto pe-2 d-flex">
                                                            <input type="text" name="" class="form-control p-2 fs-5 qty_{{$cekdata->product_id}} me-3" placeholder="0" value="{{$cekdata->qty}}" style="text-align:center;" onchange="cekbutton()" readonly >
                                                            <button class=" mx-3 deleteCartItem border border-0" data-cart-id="{{$cekdata->cart_id}}"><img src="{{asset('assets/cart/trashicon.png')}}" alt="Trash Icon" width="max-content" height="50vh"></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @break
                                    @endif
                                @endforeach
                                @break
                            @endif
                            <div class="modal fade" id="updateQty" tabindex="-1" role="dialog" aria-labelledby="updateQtyLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="updateModalLabel">Update Qty</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('update.qty') }}" method="POST">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="newQty">Qty</label>
                                                    <input type="number" class="form-control" id="tempQty" name="tempQty" min="0" max="{{ $data->qty }}">
                                                    <input type="hidden" name="cekid" id="cekid">
                                                </div>
                                                <button type="submit" class="btn btn-primary my-2">Update Qty</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                @endforeach
            </div>

            <div class="col-3">
                <div class="mt-5 me-4 border ps-3 pt-3 pe-3">
                    <h3>Ringkasan Belanja</h3>
                    <h5 class="mt-3">Total Harga ( <span id="totalQtyDisplay"></span> barang) </h5>
                    <hr>
                    <span class="fw-bold fs-3" id="totalHargaDisplay"></span>
                    <div class="mt-3 d-grid">
                        <a class="btn btn-success text-center fw-bold px-5 py-1 mb-3" href="/checkout">Beli (<span id="totalQtyButtonDisplay"></span>)</a>
                    </div>
                </div>
            </div>
            <div class="py-5"></div>
        </div>
    </div>
    @else
    <div class="container-md d-flex justify-content-center my-5 empty-cart" id="emptycart">
        <div class="my-2 text-center">
            <img class="my-2" src="{{asset('assets/cart/cartkosong.png')}}" alt="" style="max-width:100px;height:max-content">
            <h3>
                Wah, cartmu kosong <br>
                Yuk tambahkan produk produk kami ke cart!
            </h3>
            <a href="{{url("/product/")}}"><button class="btn btn-success my-3">Mulai Belanja!</button></a>
            <div class="py-5"></div>
            <div class="py-3"></div>
        </div>
    </div>
    @endif
    @if(session('successupdate'))
    <div class="modal fade" id="HasilUpdate" tabindex="-1" aria-labelledby="HasilAdd" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-body text-center">
                <img src="{{asset('assets/misc/berhasiladdtocart.gif')}}" class="my-2" alt="" width="max-content" height="110px">
              <h5 class="py-2">Berhasil Mengupdate Quantity!</h5>
              <button type="button" class="btn btn-secondary mx-5 w-0" data-bs-dismiss="modal" aria-label="Close" id="okayButton">Oke!</button>
            </div>
          </div>
        </div>
    </div>
    @endif
    @if(session('error'))
    <div class="modal fade" id="HasilUpdate" tabindex="-1" aria-labelledby="HasilUpdate" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-body text-center">
                <img src="{{asset('assets/misc/gagaladdtocart.gif')}}" class="my-2" alt="" width="150vw" height="max-content">
                <h5 class="py-2">{{ session('error') }}</h5>
                <button type="button" class="btn btn-secondary mx-5 w-0" data-bs-dismiss="modal" aria-label="Close" id="okayButton">Oke!</button>
            </div>
          </div>
        </div>
    </div>
    @endif
@endsection
@push('script')
    <script>
        $(document).ready(function () {
            if({{count($listcart)}}!=0){
                displayRingkasan();
            }
            $('#HasilUpdate').modal('show');

            $('#updateQty').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var qty = button.data('qty');
                var maxQty = button.data('maxqty');
                var id = button.data('id');
                var modal = $(this);
                modal.find('#tempQty').val(qty).attr('max', maxQty);
                modal.find('#cekid').val(id);
            });

            // Button Decrease qty
            $('.decreaseQty').click(function(e) {
                e.preventDefault();
                var $input = $(this).closest('.row').find('.qty');
                var qty = $input.val();
                var value = parseInt(qty);
                value = isNaN(value) ? 0 : value;
                if(value > 1){
                    value--;
                    $input.val(value);
                }
            });

            $('.increaseQty').click(function(e) {
                e.preventDefault();
                var $input = $(this).closest('.row').find('.qty');
                var qty = $input.val();
                var value = parseInt(qty);
                value = isNaN(value) ? 0 : value;

                var product_id = $(this).data('product-id');
                var maksqty = $('.maxQty_' + product_id).val();

                if(value < maksqty){
                    value++;
                    $input.val(value);
                }
            });

            $('.qty').on('input', function() {
                var $input = $(this);
                var value = $input.val();

                if (!/^-?\d*\.?\d+$/.test(value)) {
                    value = value.replace(/[^\d-]/g, '');
                }

                var countMinus = (value.match(/-/g) || []).length;
                if (countMinus > 1 || (countMinus === 1 && value.indexOf('-') !== 0)) {
                    value = value.replace(/-/g, '');
                }
                if(value < 1){
                    value = 0;
                } else if(value > maksqty){
                    value = maksqty;
                } else if(value.length === 2 && value.charAt(0) === '0' && value.charAt(1) !== '0') {
                    value = value.substring(1);
                }
                $input.val(value);
            });
        });

        // Button hapus item cart
        $('.deleteCartItem').on('click', function(e) {
            e.preventDefault();
            var cartId = $(this).data('cart-id');
            var $rowToDelete = $(this).closest('.row');
            $.ajax({
                url: '/delete-cart-item/' + cartId,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Add CSRF token
                },
                success: function(response) {
                    console.log('Item deleted');
                    $rowToDelete.remove();
                    location.reload();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
        function displayRingkasan(){
            // Nampilin total harga
            var totalValue = <?php echo $total; ?>;
            $('#totalHargaDisplay').text('Rp. ' + totalValue.toLocaleString('id-ID'));

            // Nampilin total Qty
            var totalQty = <?php echo $totalqty; ?>;
            $('#totalQtyDisplay').text(totalQty);
            $('#totalQtyButtonDisplay').text(totalQty);
        }
    </script>
@endpush
