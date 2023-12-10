<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Charts\GoodProductChart;

class AdminController extends Controller
{
    //
    public function dashboard(GoodProductChart $chart){
        return view('adminhomepage',['chart'=>$chart->build()]);
    }
}
