<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Charts\GoodProductChart;
use App\Models\Htrans;
use App\Models\Dtrans;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    //
    public function dashboard(GoodProductChart $chart){
        $last5Trans = Htrans::orderBy('h_trans_id','desc')->take(5)->get();
        $pinfo = [];
        foreach($last5Trans as $i => $trans){
            // dd($trans->dtrans->products);
            $dt = $trans->dtrans;
            foreach ($dt as $i => $d) {
                $toAdd['product'] = $d->product;
                $toAdd['qty'] = $d->qty;
                $pinfo[] = $toAdd;
            }
        }
        return view('adminhomepage',['chart'=>$chart->build(),'latestTrans'=>$pinfo]);
    }

    public function productReport(){
        $allTrans = Dtrans::select('product_id',DB::raw("SUM(qty) as total_qty"))->groupBy('product_id')->get();
        $products =[];
        foreach ($allTrans as $i => $dt) {
            $toAdd['product'] = $dt->product;
            $toAdd['qty'] = $dt->total_qty;
            $products[] = $toAdd;
        }   
        return view('productreport',['products'=>$products]);
    }
}
