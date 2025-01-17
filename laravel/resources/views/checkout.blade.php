@extends('template.loginregisterTemplate')
@section('title')
    <title>Checkout</title>
    @php
        $title = "Checkout";
    @endphp
@endsection

@push('style')
    <script type="text/javascript" src="https://app.stg.midtrans.com/snap/snap.js" data-client-key="{{config('services.midtrans.clientKey')}}"></script>
@endpush

@section('content')
    <nav class="navbar navbar-expand-lg bg-green-primary">
        <div class="container-fluid">
            <img class="navbar-brand" src="{{asset('assets/navbar/LogoDurianSlumbung.png')}}" style="max-width:8vw; max-height:auto;">
            <span class="nav-item h3 text-white me-auto ms-4">Checkout</span>
        </div>
    </nav>
    <form method="post">
        @csrf
        @if (count($produk) > 0)
            <div class="container my-4 p-4 rounded d-flex" style="background-color: #F0F0F0">
                @php
                    setlocale(LC_ALL, 'id-ID', 'id_ID');
                @endphp
                {{-- <h4 class="me-2">Tanggal Pengambilan: {{strftime("%d %B %Y", $tgl)}}  {{date("Y-m-d", strtotime("+8 days"))}}</h4> --}}
                <h4 class="me-2 d-flex align-items-center">Tanggal Pengambilan: <h5><input type="date" name="tgl" value="{{date("Y-m-d", strtotime("tomorrow"))}}" min="{{date("Y-m-d", strtotime("tomorrow"))}}" max="{{date("Y-m-d", strtotime("+8 days"))}}" class="p-2 ps-2 rounded-2 border border-2"></h5></h4>
                {{-- <input type="date" name="" id=""> --}}

            </div>
            <div class="container my-4 p-4 rounded" style="background-color: #F0F0F0">
                <table class="table">
                    <thead>
                        <th style="background-color: #F0F0F0; width: 70%;"><h5>Produk Dipesan</h5></th>
                        <th class="text-center" style="background-color: #F0F0F0; width: 10%;">Harga Satuan</th>
                        <th class="text-center" style="background-color: #F0F0F0; width: 10%;">Jumlah</th>
                        <th class="text-center" style="background-color: #F0F0F0;">Subtotal</th>
                    </thead>
                    @for ($i = 0; $i < count($produk); $i++)
                        @php
                            $p = $produk[$i];
                        @endphp
                        <tr class="table-group-divider" style="border-color: #CFCFCF;">
                            <td style="background-color: #F0F0F0">{{$p['product_name']}}</td>
                            <td class="text-center" style="background-color: #F0F0F0">{{number_format($p['product_price'],0,",",".")}}</td>
                            <td class="text-center" style="background-color: #F0F0F0">{{$p['qty']}}</td>
                            <td class="text-end" style="background-color: #F0F0F0">Rp{{number_format($p['subtotal'],0,",",".")}}</td>
                        </tr>
                        <input type="hidden" name="produk[{{$i}}][id]" value="{{$p['product_id']}}">
                        <input type="hidden" name="produk[{{$i}}][qty]" value="{{$p['qty']}}">
                        <input type="hidden" name="produk[{{$i}}][subtotal]" value="{{$p['subtotal']}}">
                    @endfor
                    <tr class="table-group-divider" style="border-color: #CFCFCF;">
                        <td style="background-color: #F0F0F0">
                            {{-- <div class="d-flex align-items-center">
                                Pesan: <input type="text" name="" id="" class="w-100 ms-2 form-control bg-light" placeholder="(Opsional) Tinggalkan pesan ke penjual">
                            </div> --}}
                        </td>
                        <td colspan="2" class="text-end align-middle" style="background-color: #F0F0F0">Total Pesanan ({{$totalProduk['qty']}} Produk)</td>
                        <td class="text-end align-middle" style="background-color: #F0F0F0">Rp{{number_format($totalProduk['harga'],0,",",".")}}</td>
                    </tr>
                    <tr class="table-group-divider" style="border-color: #CFCFCF;"></tr>
                </table>
            </div>
        @endif
        @if (count($wisata) > 0)
            <div class="container my-4 p-4 rounded" style="background-color: #F0F0F0">
                <table class="table">
                    <thead>
                        <th style="background-color: #F0F0F0; width: 60%;"><h5>Dapur Durian</h5></th>
                        <th class="text-center" style="background-color: #F0F0F0; width: 10%;">Tanggal</th>
                        <th class="text-center" style="background-color: #F0F0F0; width: 10%;">Harga Satuan</th>
                        <th class="text-center" style="background-color: #F0F0F0; width: 10%;">Jumlah</th>
                        <th class="text-center" style="background-color: #F0F0F0">Subtotal</th>
                    </thead>
                    @for ($i = 0; $i < count($wisata); $i++)
                        @php
                            $w = $wisata[$i];
                        @endphp
                        <tr class="table-group-divider" style="border-color: #CFCFCF;">
                            <td style="background-color: #F0F0F0">Pengolahan {{$w['wisata_name']}}</td>
                            <td class="text-center" style="background-color: #F0F0F0">{{date("Y-m-d", strtotime($w['date']))}}</td>
                            <td class="text-center" style="background-color: #F0F0F0">{{number_format($w['wisata_price'],0,",",".")}}</td>
                            <td class="text-center" style="background-color: #F0F0F0">{{$w['qty']}}</td>
                            <td class="text-end" style="background-color: #F0F0F0">Rp{{number_format($w['subtotal'],0,",",".")}}</td>
                        </tr>
                        <input type="hidden" name="wisata[{{$i}}][id]" value="{{$w['wisata_id']}}">
                        <input type="hidden" name="wisata[{{$i}}][qty]" value="{{$w['qty']}}">
                        <input type="hidden" name="wisata[{{$i}}][subtotal]" value="{{$w['subtotal']}}">
                        <input type="hidden" name="wisata[{{$i}}][date]" value="{{$w['date']}}">
                    @endfor
                    <tr class="table-group-divider" style="border-color: #CFCFCF;">
                        <td colspan="2" style="background-color: #F0F0F0">
                            {{-- <div class="d-flex align-items-center">
                                Pesan: <input type="text" name="" id="" class="w-100 ms-2 form-control bg-light" placeholder="(Opsional) Tinggalkan pesan ke penjual"></td>
                            </div> --}}
                        <td colspan="2" class="text-end align-middle" style="background-color: #F0F0F0">Total Pesanan ({{$totalWisata['qty']}} Produk)</td>
                        <td class="text-end align-middle" style="background-color: #F0F0F0">Rp{{number_format($totalWisata['harga'],0,",",".")}}</td>
                    </tr>
                    <tr class="table-group-divider" style="border-color: #CFCFCF;"></tr>
                </table>
            </div>
        @endif
        <div class="container p-0 text-end d-flex justify-content-end">
            <div class="col col-4 mb-4 p-4 rounded" style="background-color: #F0F0F0">
                <div class="row mb-3">
                    <div class="col">
                        <h4>Total Pembayaran: </h4>
                        <h5 class="mt-3">Total Pesanan: </h5>
                    </div>
                    <div class="col col-4">
                        <h4>Rp{{number_format($totalProduk['harga']+$totalWisata['harga'],0,",",".")}}</h4>
                        <h5 class="mt-3">{{$totalProduk['qty']+$totalWisata['qty']}} Produk</h5>
                    </div>
                </div>
                <hr>
                <input type="hidden" name="total" value="{{$totalProduk['harga']+$totalWisata['harga']}}">
                <button type="submit" class="btn bg-green-primary text-white">Buat Pesanan</button>
            </div>
        </div>
    </form>
@endsection
