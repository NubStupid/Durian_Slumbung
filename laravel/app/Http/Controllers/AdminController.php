<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Charts\GoodProductChart;
use App\Models\Htrans;
use App\Models\Dtrans;
use App\Models\Wisata;
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

    public function wisataReport(){
        $allWisata = Wisata::orderBy('tgl_dipesan','desc')->get();
        return view('wisatareport',['wisata'=>$allWisata]);
    }
    public function filterWisata(Request $req){
        $data = $req->all();
        $filter = $data["time"];
        if($filter == "today"){
            $data = Wisata::whereDate('tgl_dipesan',today())->orderBy('tgl_dipesan','desc')->get();
        }else if($filter == "this week"){
            $data = Wisata::whereBetween('tgl_dipesan',[now()->subWeek(),now()])->orderBy('tgl_dipesan','desc')->get();
        }else if($filter == "this month"){
            $data = Wisata::whereMonth('tgl_dipesan',now()->month)->whereYear('tgl_dipesan',now()->year)->orderBy('tgl_dipesan','desc')->get();
        }else{
            $data = Wisata::orderBy('tgl_dipesan','desc')->orderBy('tgl_dipesan','desc')->get();
        }
        $view = view('wisatareportCard',['wisata'=>$data]);
        return $view;
    }
}
