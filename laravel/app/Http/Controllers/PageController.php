<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    //
    public function loadProductsView(){
        $products = DB::connection('connect_Customer')->table('products');
        $products = $products->select(["*"]);
        $products = $products->orderby('products.rating','desc');
        $products= $products->take(12);
        $products = $products->get();
        // dd($products);
        return view('products',['products'=>$products]);
    }
}
