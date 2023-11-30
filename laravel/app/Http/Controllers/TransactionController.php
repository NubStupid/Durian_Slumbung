<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class TransactionController extends Controller
{
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

    public function invoice($id)
    {
        // $order = Pay::find($id);
        $order = [
            "id" => 1
        ];

        $pdf = Pdf::loadView('invoice', compact('order'));

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

        return $pdf->stream($order['id']. '.pdf');
        // return $pdf->stream($order->id. '.pdf');

        // return view('invoice', compact('order'));
    }
}
