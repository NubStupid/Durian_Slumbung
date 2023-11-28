{{-- @extends('template.basicStructTemplate')
@push('style')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
@endpush
@section('container')

    <nav class="navbar navbar-expand-lg bg-green-primary">
        <div class="container-fluid">
            <img class="navbar-brand" src="{{asset('assets/navbar/LogoDurianSlumbung.png')}}" style="max-width:8vw; max-height:auto;">
            <span class="nav-item h3 text-white me-auto ms-4">Checkout</span>
        </div>
    </nav>



@endsection
@push('script')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
@endpush --}}


@extends('template.loginregisterTemplate')
@section('title')
    <title>Checkout</title>
    @php
        $title = "Checkout";
    @endphp
@endsection

@section('content')
    <nav class="navbar navbar-expand-lg bg-green-primary">
        <div class="container-fluid">
            <img class="navbar-brand" src="{{asset('assets/navbar/LogoDurianSlumbung.png')}}" style="max-width:8vw; max-height:auto;">
            <span class="nav-item h3 text-white me-auto ms-4">Checkout</span>
        </div>
    </nav>
    <form method="post">
        @csrf
        <div class="container my-4 p-4 rounded d-flex" style="background-color: #F0F0F0">
            <h4 class="me-2">Tanggal Pengambilan:</h4><h4>01 Juni 2023</h4>
        </div>
        <div class="container my-4 p-4 rounded" style="background-color: #F0F0F0">
            <table class="table">
                <thead>
                    <th style="background-color: #F0F0F0; width: 70%;"><h5>Produk Dipesan</h5></th>
                    <th class="text-center" style="background-color: #F0F0F0; width: 10%;">Harga Satuan</th>
                    <th class="text-center" style="background-color: #F0F0F0; width: 10%;">Jumlah</th>
                    <th class="text-center" style="background-color: #F0F0F0;">Subtotal</th>
                </thead>
                <tr class="table-group-divider" style="border-color: #CFCFCF;">
                    <td style="background-color: #F0F0F0">Durian Kecil</td>
                    <td class="text-center" style="background-color: #F0F0F0">10.000</td>
                    <td class="text-center" style="background-color: #F0F0F0">2</td>
                    <td class="text-end" style="background-color: #F0F0F0">Rp20.000</td>
                </tr>
                <tr class="table-group-divider" style="border-color: #CFCFCF;">
                    <td style="background-color: #F0F0F0">Durian Sedang</td>
                    <td class="text-center" style="background-color: #F0F0F0">15.000</td>
                    <td class="text-center" style="background-color: #F0F0F0">1</td>
                    <td class="text-end" style="background-color: #F0F0F0">Rp15.000</td>
                </tr>
                <tr class="table-group-divider" style="border-color: #CFCFCF;">
                    <td style="background-color: #F0F0F0">
                        <div class="d-flex align-items-center">
                            Pesan: <input type="text" name="" id="" class="w-100 ms-2 form-control bg-light" placeholder="(Opsional) Tinggalkan pesan ke penjual">
                        </div>
                    </td>
                    <td colspan="2" class="text-end align-middle" style="background-color: #F0F0F0">Total Pesanan (2 Produk)</td>
                    <td class="text-end align-middle" style="background-color: #F0F0F0">Rp35.000</td>
                </tr>
                <tr class="table-group-divider" style="border-color: #CFCFCF;"></tr>
            </table>
        </div>
        <div class="container my-4 p-4 rounded" style="background-color: #F0F0F0">
            <table class="table">
                <thead>
                    <th style="background-color: #F0F0F0; width: 60%;"><h5>Dapur Durian</h5></th>
                    <th class="text-center" style="background-color: #F0F0F0; width: 10%;">Tanggal</th>
                    <th class="text-center" style="background-color: #F0F0F0; width: 10%;">Harga Satuan</th>
                    <th class="text-center" style="background-color: #F0F0F0; width: 10%;">Jumlah</th>
                    <th class="text-center" style="background-color: #F0F0F0">Subtotal</th>
                </thead>
                <tr class="table-group-divider" style="border-color: #CFCFCF;">
                    <td style="background-color: #F0F0F0">Pengolahan Es Krim Durian</td>
                    <td class="text-center" style="background-color: #F0F0F0">30-11-2023</td>
                    <td class="text-center" style="background-color: #F0F0F0">10.000</td>
                    <td class="text-center" style="background-color: #F0F0F0">2</td>
                    <td class="text-end" style="background-color: #F0F0F0">Rp20.000</td>
                </tr>
                <tr class="table-group-divider" style="border-color: #CFCFCF;">
                    <td style="background-color: #F0F0F0">Pengolahan Pancake Durian</td>
                    <td class="text-center" style="background-color: #F0F0F0">12-12-2023</td>
                    <td class="text-center" style="background-color: #F0F0F0">10.000</td>
                    <td class="text-center" style="background-color: #F0F0F0">1</td>
                    <td class="text-end" style="background-color: #F0F0F0">Rp10.000</td>
                </tr>
                <tr class="table-group-divider" style="border-color: #CFCFCF;">
                    <td colspan="2" style="background-color: #F0F0F0">
                        <div class="d-flex align-items-center">
                            Pesan: <input type="text" name="" id="" class="w-100 ms-2 form-control bg-light" placeholder="(Opsional) Tinggalkan pesan ke penjual"></td>
                        </div>
                    <td colspan="2" class="text-end align-middle" style="background-color: #F0F0F0">Total Pesanan (2 Produk)</td>
                    <td class="text-end align-middle" style="background-color: #F0F0F0">Rp30.000</td>
                </tr>
                <tr class="table-group-divider" style="border-color: #CFCFCF;"></tr>
            </table>
        </div>
        <div class="container p-0 text-end d-flex justify-content-end">
            <div class="col col-4 mb-4 p-4 rounded" style="background-color: #F0F0F0">
                <div class="row mb-3">
                    <div class="col">
                        <h4>Total Pembayaran: </h4>
                        <h5 class="mt-3">Total Pesanan: </h5>
                    </div>
                    <div class="col col-4">
                        <h4>Rp65.000</h4>
                        <h5 class="mt-3">4 Produk</h5>
                    </div>
                </div>
                <hr>
                <button type="submit" class="btn bg-green-primary text-white">Buat Pesanan</button>
            </div>
        </div>
    </form>
@endsection
