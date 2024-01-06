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
            <td class="w-50">
                <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('assets/pdf/Logo.png'))) }}" style="width: 100%">
            </td>
            <td class="text-end"><h1>INVOICE</h1></td>
        </tr>
    </table>
    <table class="w-100">
        @php
            setlocale(LC_ALL, 'id-ID', 'id_ID');
        @endphp
        <tr>
            <td class="w-50 semi-bold">BILLED TO:</td>
            <td class="text-end">{{$order['invoice_number']}}</td>
        </tr>
        <tr>
            <td class="w-50">{{Session::get('username')}}</td>
            <td class="text-end">{{strftime("%d %b %Y", strtotime("{$order['created_at']}"))}}</td>
        </tr>
        <tr>
            <td class="w-50">{{$no_tlp}}</td>
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
                            echo $d->Wisata->Olahan->name;
                    @endphp
                </td>
                <td>{{$d['qty']}}</td>
                <td>
                    @php
                        if($d->product_id[0] == 'P')
                            echo $d->Product->price;
                        else
                            echo $d->Wisata->price;
                    @endphp
                </td>
                <td>Rp{{number_format($d['total'],0,",",".")}}</td>
            </tr>
        @endforeach
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
            <td class="text-end">{{$order['payment_method']}}</td>
        </tr>
    </table>
</body>
</html>
