<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Session;

use App\Models\Cart;
use App\Models\Users;
use App\Models\Transaction;
use App\Models\DetailTransaction;

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

        $produk = [];
        $totalProduk = [
            "qty" => 0,
            "harga" => 0
        ];
        $cart = Cart::where('username', Session::get('username'))->where('product_id','like','P%')->get();
        foreach($cart as $c)
        {
            $produk[] = [
                "product_id" => $c->product_id,
                "product_name" => $c->Product->name,
                "product_price" => $c->price,
                "qty" => $c->qty,
                "subtotal" => $c->price * $c->qty
            ];
            $totalProduk["harga"] += $c->price * $c->qty;
        }
        $totalProduk["qty"] = count($cart);

        $wisata = [];
        $totalWisata = [
            "qty" => 0,
            "harga" => 0
        ];
        $cart = Cart::where('username', Session::get('username'))->where('product_id','like','W%')->get();
        foreach($cart as $c)
        {
            $wisata[] = [
                "wisata_id" => $c->product_id,
                "wisata_name" => $c->Wisata->Olahan->name,
                "date" => $c->price,
                "wisata_price" => $c->price,
                "qty" => $c->qty,
                "subtotal" => $c->price * $c->qty
            ];
            $totalWisata["harga"] += $c->price * $c->qty;
        }
        $totalWisata["qty"] = count($cart);

        return view("checkout",[
            'user' => $user,
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
        $inv = "IN" . date("Ymd");
        $num = "";
        do
        {
            $num = rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9);
        }while(Transaction::where('invoice_number', $inv . $num)->exists());
        $inv .= $num;
        return $inv;
    }

    public function pay(Request $req)
    {
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

        if($req->produk)
        {
            foreach($req->produk as $p)
            {
                // var_dump($p);
                $det['d_trans_id'] = $this->generateDtrans();
                $det['qty'] = $p['qty'];
                $det['total'] = $p['subtotal'];
                $det['h_trans_id'] = $order->h_trans_id;
                $det['product_id'] = $p['id'];
                $det['pengambilan'] = $req->tgl;

                // var_dump($det);
                // echo '<br>';
                DetailTransaction::create($det);
                // $detail = DetailTransaction::create($det);
            }
        }
        if($req->wisata)
        {
            foreach($req->wisata as $w)
            {
                // var_dump($p);
                $det['d_trans_id'] = $this->generateDtrans();
                $det['qty'] = $w['qty'];
                $det['total'] = $w['subtotal'];
                $det['h_trans_id'] = $order->h_trans_id;
                $det['product_id'] = $w['id'];
                $det['pengambilan'] = date("Y-m-d",  strtotime($w['date']));

                // var_dump($det);
                // echo '<br>';
                DetailTransaction::create($det);
                // $detail = DetailTransaction::create($det);
            }
        }
        // dd($req->all());


        // dd($req->all());
        // $data['_token'] = $req->_token;
        // $data['total'] = $req->total;
        // // $data['_token'] = $req->_token;
        // $data['h_trans_id'] = $this->generateHtrans();
        // $data['invoice_number'] = $this->generateInv();
        // // $data['subtotal'] = $req->subtotal;
        // $data['username'] = Session::get('username');
        // $data['status'] = 'pending';
        // // dd($data);
        // $order = Transaction::create($data);

        $cart = Cart::where("username", Session::get('username'))->delete();

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
                'first_name' => Session::get('username'),
                'phone' => Users::find(Session::get('username'))->telp
            ),
            'callbacks' => array(
                'finish' => url('/history'),
                'unfinish' => url('/history'),
                'error' => url('/history')
            )
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        $paymentUrl = \Midtrans\Snap::createTransaction($params)->redirect_url;

        Transaction::find("{$order->h_trans_id}")->update(["payment_url" => $paymentUrl]);

        return redirect($paymentUrl);
    }

    public function callback(Request $req)
    {
        $serverKey = config('services.midtrans.serverKey');
        $hashed = hash("sha512", $req->order_id.$req->status_code.$req->gross_amount.$serverKey);
        if($hashed == $req->signature_key)
        {
            if($req->transaction_status == 'capture' || $req->transaction_status == 'settlement')
            {
                $order = Transaction::where('invoice_number', $req->order_id)->first();
                $order->update(['status' => 'paid', 'payment_method' => $req->payment_type]);
            }
            else if($req->transaction_status != 'pending')
            {
                $order = Transaction::where('invoice_number', $req->order_id)->first();
                $order->update(['status' => 'failed']);
            }
        }
    }

    public function invoice($id)
    {
        $order = Transaction::where('invoice_number', $id)->first();
        $detail = DetailTransaction::where('h_trans_id', $order->h_trans_id)->get();
        $no_tlp = Users::find(Session::get("username"))->telp;

        $view = View::make('invoice', compact('order', 'detail', 'no_tlp'));

        $dompdf = new Dompdf();
        $dompdf->loadHtml($view);
        $dompdf->setPaper('A4', 'potrait');
        $dompdf->render();

        return $dompdf->stream("invoice.pdf", [
                'Attachment' => 0
            ]);
    }
}
