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
              <a class="nav-link text-dark" href="/cart">Cart</a>
            </li>
            <li class="nav-item mx-3">
              <a class="nav-link active" aria-current="page" href="#">History</a>
            </li>
          </ul>
    </div>
    {{-- <div class="d-flex justify-content-center mb-5" style="width: 100px; background-color:black; height:5px;"></div> --}}
    <?php $total = 0; $totalqty = 0; ?>
    @if(count($listhistory)!=0)
    <div class="container-fluid cart-content">
        @php
            setlocale(LC_ALL, 'id-ID', 'id_ID');
            $ctr = 1;
        @endphp
        <div class="row px-5">
            <div class="container-fluid">
                @foreach ($listhistory as $history)
                <div class="mx-5 row no-gutters my-3">
                    <div class="accordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                  {{-- {{$history->invoice_number}} --}}
                                @php
                                    $color = "";
                                    $status = "";
                                    if($history->status == "paid")
                                    {
                                        $color = "bg-success-subtle";
                                        $status = "Berhasil";
                                    }
                                    else if($history->status == "pending")
                                    {
                                        $color = "bg-warning-subtle";
                                        $status = "Menunggu Pembayaran";
                                    }
                                    else
                                    {
                                        $color = "bg-danger-subtle";
                                        $status = "Gagal";
                                    }
                                @endphp
                                <button class="accordion-button collapsed {{$color}}" type="button" data-bs-toggle="collapse" data-bs-target="#panel{{$ctr}}" aria-expanded="false" aria-controls="panel{{$ctr}}">
                                    <div class="w-100 me-4">
                                        <div class="d-flex justify-content-between">
                                            <h5>{{strftime("%d %B %Y", strtotime("$history->created_at"))}}</h5>
                                            <h6>{{$status}}</h6>
                                        </div>
                                        <h6>Total Pesanan: {{$history->total}}</h6>
                                        <h6>{{count($history->dtrans)}} Produk</h6>
                                        {{-- <h6>{{$history->dtrans}} Produk</h6> --}}
                                    </div>
                                    {{-- {{date("Y-m-d", strtotime("$history->created_at"))}} --}}
                                    {{-- {{strftime("%d %B %Y", date("Y-m-d", $history->created_at))}} --}}
                                </button>
                              </h2>
                              <div id="panel{{$ctr}}" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    @php
                                        $ada = null;
                                    @endphp
                                    @foreach ($history->dtrans as $dt)
                                        <div class="d-flex justify-content-between mx-2">
                                            <div>
                                                @if ($dt->product)
                                                    <p>{{$dt->product->name}}</p>
                                                    @php
                                                        $ada = true;
                                                        $ada = $dt->pengambilan
                                                    @endphp
                                                @else
                                                    {{-- @dump($dt->product) --}}
                                                    {{-- @dump($dt->wisata) --}}
                                                    Pengolahan {{$dt->wisata->Olahan->name}}<br>
                                                    {{$dt->pengambilan}}
                                                @endif

                                            </div>
                                            <p>x{{$dt->qty}}</p>
                                        </div>
                                        <div class="d-flex justify-content-end">
                                            <p>{{$dt->total}}</p>
                                        </div>
                                        <hr>
                                    @endforeach
                                    <div class="d-flex justify-content-between align-items-end">
                                        <div class="pe-2">
                                            Waktu Pemesanan<br>
                                            @if ($history->status == "paid")
                                                Waktu Pembayaran<br>
                                            @endif
                                            @if ($ada)
                                                Waktu Pengambilan<br>
                                            @endif
                                            @if ($history->status ==  "paid")
                                                Metode Pembayaran<br>
                                            @endif
                                        </div>
                                        <div class="me-auto">
                                            {{$history->created_at}}<br>
                                            @if ($history->status == "paid")
                                                {{$history->updated_at}}<br>
                                            @endif
                                            @if ($ada)
                                                {{$ada}}<br>
                                            @endif
                                            @if ($history->status == "paid")
                                                {{$history->payment_method}}<br>
                                            @endif
                                        </div>
                                        @if ($history->status == "paid")
                                            <a class="btn btn-success" href="/invoice/{{$history->invoice_number}}">Invoice</a>
                                        @elseif($history->status == "pending")
                                            <a class="btn btn-primary" href="{{$history->payment_url}}">Bayar</a>
                                        @endif
                                    </div>
                                  {{-- <strong>This is the first item's accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow. --}}
                                </div>
                              </div>
                            </div>
                          </div>
                        {{-- <div class="col-md-3">
                            <img src="{{$data->img_url}}" class="card-img" alt="">
                        </div> --}}
                        {{-- <div class="col-md-9">
                            <div class="row">
                                <div class="col-6 mt-3">
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
                                    <div class="p-5"></div>
                                    <div class="p-5"></div>
                                    <div class="p-4"></div>
                                    <div class="row mt-auto">
                                        <div class="col-3 my-auto">
                                            <button class="circle py-auto decreaseQty" id="dec_{{$cekdata->product_id}}"><b>-</b></button>
                                        </div>
                                        <div class="col-6">
                                            <input type="text" name="" class="form-control p-2 fs-5 qty_{{$cekdata->product_id}}" placeholder="0" value="{{$cekdata->qty}}" style="text-align:center;" onchange="cekbutton()">
                                        </div>
                                        <div class="col-3 my-auto">
                                            <button class="circle py-auto increaseQty" id="inc_{{$cekdata->product_id}}"><b>+</b></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="p-5"></div>
                                    <div class="p-5"></div>
                                    <div class="p-4"></div>
                                    <div class="mt-auto pe-5 d-flex">
                                        <button class="mx-3 deleteCartItem border border-0" data-cart-id="{{$cekdata->cart_id}}"><img src="{{asset('assets/cart/trashicon.png')}}" alt="Trash Icon" width="max-content" height="40px"></button>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                    @php
                        $ctr++;
                    @endphp
                @endforeach
                {{-- @foreach($listproduct as $data)
                    @foreach($listcart as $cekdata)
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
                                        <div class="col-6 mt-3">
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
                                            <div class="p-5"></div>
                                            <div class="p-5"></div>
                                            <div class="p-4"></div>
                                            <div class="row mt-auto">
                                                <div class="col-3 my-auto">
                                                    <button class="circle py-auto decreaseQty" id="dec_{{$cekdata->product_id}}"><b>-</b></button>
                                                </div>
                                                <div class="col-6">
                                                    <input type="text" name="" class="form-control p-2 fs-5 qty_{{$cekdata->product_id}}" placeholder="0" value="{{$cekdata->qty}}" style="text-align:center;" onchange="cekbutton()">
                                                </div>
                                                <div class="col-3 my-auto">
                                                    <button class="circle py-auto increaseQty" id="inc_{{$cekdata->product_id}}"><b>+</b></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="p-5"></div>
                                            <div class="p-5"></div>
                                            <div class="p-4"></div>
                                            <div class="mt-auto pe-5 d-flex">
                                                <button class="mx-3 deleteCartItem border border-0" data-cart-id="{{$cekdata->cart_id}}"><img src="{{asset('assets/cart/trashicon.png')}}" alt="Trash Icon" width="max-content" height="40px"></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @break
                        @endif
                    @endforeach
                @endforeach --}}
            </div>

            {{-- <div class="col-3">
                <div class="mt-5 me-4 border ps-3 pt-3 pe-3">
                    <h3>Ringkasan Belanja</h3>
                    <h5 class="mt-3">Total Harga ( <span id="totalQtyDisplay"></span> barang) </h5>
                    <hr>
                    <span class="fw-bold fs-3" id="totalHargaDisplay"></span>
                    <div class="mt-3 d-grid">
                        <a class="btn btn-success text-center fw-bold px-5 py-1 mb-3" href="/checkout">Beli (<span id="totalQtyButtonDisplay"></span>)</a>
                    </div>
                </div>
            </div> --}}
            <div class="py-5"></div>
        </div>
    </div>
    @else
    <div class="container-md d-flex justify-content-center my-5 empty-cart" id="emptycart">
        <div class="my-2 text-center">
            <img class="my-2" src="{{asset('assets/cart/cartkosong.png')}}" alt="" style="max-width:100px;height:max-content">
            <h3>
                Kamu belum pernah melakukan transaksi<br>
                Yuk beli produk kami sekarang!
            </h3>
            <a href="{{url("/product/")}}"><button class="btn btn-success my-3">Mulai Belanja!</button></a>
            <div class="py-5"></div>
            <div class="py-3"></div>
        </div>
    </div>
    @endif
@endsection
@push('script')
    <script>
        $(document).ready(function () {
            if({{count($listhistory)}}!=0){
                displayRingkasan();
            }

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
