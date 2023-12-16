<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$order['invoice_number']}}</title>
    <style>
        @font-face {
            font-family: 'Poppins';
            font-style: normal;
            font-weight: normal;
            src: url({{ storage_path("fonts/Poppins-Regular.ttf") }}) format('truetype');
        }
        @font-face {
            font-family: 'Poppins-SemiBold';
            font-style: normal;
            font-weight: normal;
            src: url({{ storage_path("fonts/Poppins-SemiBold.ttf") }}) format('truetype');
        }
        @font-face {
            font-family: 'Amaranth';
            font-style: normal;
            font-weight: normal;
            src: url({{ storage_path("fonts/Amaranth-Bold.ttf") }}) format('truetype');
        }
        *{
            font-family: 'Poppins';
        }
        .logo{
            font-family: 'Amaranth';
            font-size: 40px;
            color: #5FA37A;
        }
        .semi-bold{
            font-family: 'Poppins-SemiBold';
        }
        .w-50 {
            width: 50%;
        }
        .w-100 {
            width: 100%;
        }
        .text-start{
            text-align: left;
        }
        .text-end{
            text-align: right;
        }
        .text-center{
            text-align: center;
        }
        .mt{
            margin-top: 15px;
        }
        .ps{
            padding-left: 10px;
        }
        .border-y{
            border-style: solid none solid none;
        }
        .align-center{
            vertical-align: center;
        }
        table {
            border-collapse: collapse;
        }
        .bg-gray{
            background-color: #D9D9D9;
        }
    </style>
</head>
<body>
    <table class="w-100">
        <tr>
            {{-- <td class="w-50"></td> --}}

            {{-- <td class="w-50 logo">Durian Slumbung</td> --}}
            <td class="w-50">
                {{-- {{dump(file_get_contents(public_path('LogoDurianSlumbung.png')))}} --}}
                <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('assets/pdf/Logo.png'))) }}" style="width: 100%">
            </td>
            {{-- <td class="w-50 logo">Durian Slumbung</td> --}}
            {{-- <td class="w-50"><img src="public" width="200" /></td> --}}


            {{-- <td class="w-50"><img src="data:image/svg+xml;base64,{{base64_encode(file_get_contents(storage_path('LogoDurianSlumbung.png')))}}" width="200" /></td> --}}
            {{-- <td class="w-50"><img src="data:image/svg+xml;base64,{{base64_encode(file_get_contents('public/assets/navbar/LogoDurianSlumbung.png'))}}" width="200" /></td> --}}
            {{-- <td class="w-50"><img src="{{'data:image/png;base64,'.base64_encode(file_get_contents(public_path('assets/navbar/LogoDurianSlumbung.png')))}}" width="200" /></td> --}}
            {{-- <td class="w-50"><img src="{{ public_path('/assets/navbar/LogoDurianSlumbung.png') }}" width="200" /></td> --}}
            {{-- <td class="w-50"><img src="{{url('public')}}" width="200" /></td> --}}
            {{-- <td class="w-50"><img src="data:image/svg+xml;charset=utf8,%3C?xml version='1.0'?%3E%3Csvg width='64' height='64' xmlns='http://www.w3.org/2000/svg'%3E%3Cg%3E%3Crect stroke='%23666666' id='svg_1' height='60.499994' width='60.166667' y='1.666669' x='1.999998' stroke-width='1.5' fill='none'/%3E%3Cline stroke-linecap='null' stroke-linejoin='null' id='svg_3' y2='59.333253' x2='59.749916' y1='4.333415' x1='4.250079' stroke-width='1.5' stroke='%23999999' fill='none'/%3E%3Cline stroke-linecap='null' stroke-linejoin='null' id='svg_4' y2='59.999665' x2='4.062838' y1='3.750342' x1='60.062164' stroke-width='1.5' stroke='%23999999' fill='none'/%3E%3C/g%3E%3C/svg%3E" width="200" /></td> --}}
            {{-- <td class="w-50"><img src="{{asset('assets/navbar/LogoDurianSlumbung.png')}}" width="200" /></td> --}}
            {{-- <td class="w-50"><img src="{{url('public/assets/navbar/LogoDurianSlumbung.png')}}" width="200" /></td> --}}
            {{-- <td class="w-50"><img src="public\assets\navbar\LogoDurianSlumbung.png" width="200" /></td> --}}
            {{-- <td class="w-50"><img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('assets/navbar/LogoDurianSlumbung.png'))) }}" width="200" /></td> --}}
            {{-- <td class="w-50"><img src="{{ public_path('assets\navbar\LogoDurianSlumbung.png') }}" width="200" /></td> --}}
            {{-- <td class="w-50"><img src="http://127.0.0.1:8000/assets/navbar/LogoDurianSlumbung.png" alt="laravel daily" width="200" /></td> --}}
            {{-- <td class="w-50"><img src="{{asset('assets/navbar/LogoDurianSlumbung.png')}}" alt=""></td> --}}
            <td class="text-end"><h1>INVOICE</h1></td>
        </tr>
    </table>
    <table class="w-100">
        <tr>
            <td class="w-50 semi-bold">BILLED TO:</td>
            <td class="text-end">{{$order['invoice_number']}}</td>
            {{-- <td class="text-end">INYYYYMMDDXXX001</td> --}}
        </tr>
        <tr>
            {{-- <td class="w-50">User Yang Login</td> --}}
            <td class="w-50">Blobo Blubu</td>
            <td class="text-end">24 Nov 2023</td>
            {{-- <td class="text-end">DD MM YYYY</td> --}}
        </tr>
        <tr>
            {{-- <td class="w-50">No Tlp User</td> --}}
            <td class="w-50">0812487123</td>
        </tr>
    </table>
    <table class="w-100 mt">
        <tr class="border-y text-center">
            <td class="semi-bold" style="width: 40%; padding-bottom: 5px; padding-top: 5px">Item</td>
            <td class="semi-bold">Quantity</td>
            <td class="semi-bold">Unit Price</td>
            <td class="semi-bold">Subtotal</td>
        </tr>
        @foreach ($detail as $d)
            <tr class="text-center">
                <td class="text-start ps">
                    @php
                        if($d->product_id[0] == 'P')
                            echo $d->Product->name;
                        else
                            echo $d->Wisata->tgl_dipesan;
                    @endphp
                </td>
                <td>{{$d['qty']}}</td>
                <td>
                    @php
                        if($d->product_id[0] == 'P')
                            echo $d->Product->price;
                        else
                            echo $d->Wisata->tgl_dipesan;
                    @endphp
                </td>
                <td>Rp{{number_format($d['total'],0,",",".")}}</td>
            </tr>
        @endforeach
        {{-- <tr class="text-center">
            <td class="text-start ps">Produk 1</td>
            <td>1</td>
            <td>50.000</td>
            <td>50.000</td>
        </tr>
        <tr class="text-center bg-gray">
            <td class="text-start ps">Produk 1</td>
            <td>2</td>
            <td>50.000</td>
            <td>100.000</td>
        </tr>
        <tr class="semi-bold text-center">
            <td class="text-start ps">Produk 1</td>
            <td>1</td>
            <td>50.000</td>
            <td>50.000</td>
        </tr> --}}
    </table>
    <table class="w-100 mt">
        <tr style="font-size: 18px;">
            <td class="w-50"></td>
            <td class="semi-bold">Total</td>
            <td class="text-end semi-bold">Rp{{number_format($order['total'],0,",",".")}}</td>
        </tr>
        <tr>
            <td class="w-50"></td>
            <td>Total Items</td>
            <td class="text-end">{{count($detail)}}</td>
        </tr>
        <tr>
            <td class="w-50"></td>
            <td>Metode Pembayaran</td>
            <td class="text-end">VA BCA</td>
        </tr>
    </table>
</body>
</html>
