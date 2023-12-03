<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\DetailTransaction;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Session;

class TransactionController extends Controller
{
    public function __construct()
    {
        \Midtrans\Config::$serverKey    = config('services.midtrans.serverKey');
        \Midtrans\Config::$isProduction = config('services.midtrans.isProduction');
        \Midtrans\Config::$isSanitized  = config('services.midtrans.isSanitized');
        \Midtrans\Config::$is3ds        = config('services.midtrans.is3ds');
    }

    public function checkout()
    {
        $user = request()->attributes->get('user');

        // $checkout = [];
        // if(Session::has('checkout'))
        //     $checkout = Session::get('checkout');
        $tgl = "01-06-2023";
        $produk[] = [
            "product_id" => "P001",
            "product_name" => "Durian Kecil",
            "product_price" => 10000,
            "qty" => 2,
            "subtotal" => 20000
        ];
        $produk[] = [
            "product_id" => "P002",
            "product_name" => "Durian Sedang",
            "product_price" => 15000,
            "qty" => 1,
            "subtotal" => 15000
        ];
        $totalProduk = [
            "qty" => 2,
            "harga" => 35000
        ];

        $wisata[] = [
            "wisata_id" => "W001",
            "wisata_name" => "Pengolahan Es Krim Durian",
            "date" => "30-11-2023",
            "wisata_price" => 10000,
            "qty" => 2,
            "subtotal" => 20000
        ];
        $wisata[] = [
            "wisata_id" => "W002",
            "wisata_name" => "Pengolahan Pancake Durian",
            "date" => "12-12-2023",
            "wisata_price" => 10000,
            "qty" => 1,
            "subtotal" => 10000
        ];
        $totalWisata = [
            "qty" => 2,
            "harga" => 30000
        ];
        return view("checkout",[
            'user' => $user,
            'tgl' => strtotime($tgl),
            // 'tgl' => date_create($tgl),
            'produk' => $produk,
            'totalProduk' => $totalProduk,
            'wisata' => $wisata,
            'totalWisata' => $totalWisata
        ]);
    }

    public function generateHtrans()
    {
        $maks = substr(Transaction::max('h_trans_id'), 2, 3);
        $ht = "HT" . str_pad($maks + 1, 3, "0", STR_PAD_LEFT);
        return $ht;
    }

    public function generateDtrans()
    {
        $maks = substr(DetailTransaction::max('d_trans_id'), 2, 3);
        $dt = "DT" . str_pad($maks + 1, 3, "0", STR_PAD_LEFT);
        return $dt;
    }

    public function generateInv()
    {
        // $inv = "INYYYYMMDDXXX001";
        $inv = "IN" . date("Ymd");
        $num = "";
        do
        {
            $num = rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9);
        }while(Transaction::where('invoice_number', $inv . $num)->exists());
        // dd(Transaction::where('invoice_number', $inv . $num)->exists());
        // dd(Transaction::where('invoice_number', 'IN2023120275300')->exists());
        // $maks = substr(Transaction::whereLike('invoice_number', $inv)->max('invoice_number'), 9, 3);
        $inv .= $num;
        // $maks = substr(Transaction::max('h_trans_id'), 2, 3);
        // $ht = "HT" . str_pad($maks + 1, 3, "0", STR_PAD_LEFT);
        // dd($ht);
        return $inv;
    }

    public function pay(Request $req)
    {
        foreach($req->produk as $p)
        {
            // var_dump($p);
            $det['d_trans_id'] = $this->generateDtrans();
            $det['qty'] = $p['qty'];
            $det['total'] = $p['subtotal'];
            $det['h_trans_id'] = $this->generateHtrans();
            $det['product_id'] = $p['id'];

            // var_dump($det);
            // echo '<br>';
            DetailTransaction::create($det);
            // $detail = DetailTransaction::create($det);
        }
        foreach($req->wisata as $w)
        {
            // var_dump($p);
            $det['d_trans_id'] = $this->generateDtrans();
            $det['qty'] = $w['qty'];
            $det['total'] = $w['subtotal'];
            $det['h_trans_id'] = $this->generateHtrans();
            $det['product_id'] = $w['id'];

            // var_dump($det);
            // echo '<br>';
            DetailTransaction::create($det);
            // $detail = DetailTransaction::create($det);
        }
        // dd($req->all());


        // dd($req->all());
        $data['_token'] = $req->_token;
        $data['total'] = $req->total;
        // $data['_token'] = $req->_token;
        $data['h_trans_id'] = $this->generateHtrans();
        $data['invoice_number'] = $this->generateInv();
        // $data['subtotal'] = $req->subtotal;
        $data['username'] = Session::get('username');
        $data['status'] = 'pending';
        // dd($data);
        $order = Transaction::create($data);

        // dd($order);
        // dd($order->id);
        // dd($order->subtotal);
        // dd($order->amount);

        // \Midtrans\Config::$serverKey = 'YOUR_SERVER_KEY';
        // // Set to `Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        // \Midtrans\Config::$isProduction = false;
        // // Set sanitization on (default)
        // \Midtrans\Config::$isSanitized = true;
        // // Set 3DS transaction for credit card to true
        // \Midtrans\Config::$is3ds = true;

        \Midtrans\Config::$serverKey    = config('services.midtrans.serverKey');
        \Midtrans\Config::$isProduction = config('services.midtrans.isProduction');
        \Midtrans\Config::$isSanitized  = config('services.midtrans.isSanitized');
        \Midtrans\Config::$is3ds        = config('services.midtrans.is3ds');

        $params = array(
            'transaction_details' => array(
                // 'order_id' => $order->h_trans_id,
                'order_id' => $order->invoice_number,
                'gross_amount' => $order->total,
            ),
            'customer_details' => array(
                'h_trans_id' => $order->h_trans_id,
                'invoice_number' => $order->invoice_number,
                'total' => $order->total,
                'username' => Session::get('username')
            ),
            'callbacks' => array(
                'finish' => url('/payment-success')
            )
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        $paymentUrl = \Midtrans\Snap::createTransaction($params)->redirect_url;
        return redirect($paymentUrl);
        // dd($snapToken);
        // return view('checkout', compact('snapToken', 'order'));
    }

    public function callback(Request $req)
    {
        $serverKey = config('services.midtrans.serverKey');
        $hashed = hash("sha512", $req->order_id.$req->status_code.$req->gross_amount.$serverKey);
        if($hashed == $req->signature_key)
        {
            if($req->transaction_status == 'capture' || $req->transaction_status == 'settlement')
            {
                // dd($req->order_id);
                // $order = Transaction::find($req->order_id);
                $order = Transaction::where('invoice_number', $req->order_id)->first();
                $order->update(['status' => 'paid']);
                // return redirect()->route('invoice', ['id' => $order->inv]);

                // dd($order);
                // $pdf = Pdf::loadView('invoice', compact('order'));

                // return view('invoice/' . $order->id);
            }
        }
    }

    // public function success($id)
    // {
    //     $order = Pay::find($id);

    //     // $pdf = Pdf::loadView('invoice', compact('order'));

    //     // return $pdf->stream($order->id. '.pdf');
    //     return view('payment-success', compact('order'));
    // }

    public function invoice($id)
    {
        // $order = Transaction::find($id);
        $order = Transaction::where('invoice_number', $id)->first();
        $detail = DetailTransaction::where('h_trans_id', $order->h_trans_id)->get();
        // foreach($detail as $d)
        // var_dump($d->d_trans_id);
        // dd($detail);
        // dd($order);
        // dd(Transaction::where('invoice_number', $id)->exists());

        // dd($order->invoice_number);

        // dd($order->id);
        // dd($order->invoice_number);
        // $order = [
        //     "id" => 1
        // ];

        $pdf = Pdf::loadView('invoice', compact('order', 'detail'));

        // $PDFOptions = ['enable_remote' => true, 'chroot' => public_path('storage/resource-booking')];

        // PDF::setOptions($PDFOptions)->loadView();

        // $pdf = Pdf::setOptions($PDFOptions)->loadView('invoice', compact('order'))->setWarnings(true);
        // $pdf = Pdf::loadView('invoice', compact('order'))->setWarnings(true);

        // $pdf->getDomPDF()->setHttpContext(
        //     stream_context_create([
        //         'ssl' => [
        //             'allow_self_signed'=> TRUE,
        //             'verify_peer' => FALSE,
        //             'verify_peer_name' => FALSE,
        //         ]
        //     ])
        // );

        return $pdf->stream($order['invoice_number']. '.pdf');
        // return $pdf->stream($order->id. '.pdf');

        // return view('invoice', compact('order'));
    }
}
