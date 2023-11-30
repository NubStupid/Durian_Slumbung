<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rating;
use App\Models\Products;
class RatingController extends Controller
{
    //
    public function insertUpdateRating(Request $req){
        $data = $req->all();
        $ifExist = Rating::where('product_id',$data['product_id'])
                   ->where('username',$data['username'])
                   ->first();
        $tes = 0;
        // return json_encode($ifExist);
        if($ifExist == null){
            $rating = new Rating;
            $rating->product_id = $data["product_id"];
            $rating->username = $data["username"];
            $rating->rate = $data["rating"];
            $rating->save();
            $tes = $rating->rate;
        }else{
            $ifExist->rate = $data["rating"];
            $ifExist->save();
            $tes = $ifExist->rate;
        }
        $tes = $this->updateRating($data["product_id"]);
        return $tes;

    }
    public function deleteRating(Request $req){
        $data = $req->all();
        $ifExist = Rating::where('product_id',$data['product_id'])
                   ->where('username',$data['username'])
                   ->first();
        if($ifExist != null){
            $ifExist->rate = 0;
            $ifExist->save();
            $this->updateRating($data["product_id"]);
            return "Success";
        }else{
            return "Failed";
        }
    }
    public function updateRating($product_id){
        $sum = Rating::where('rate','>=',1)->where('product_id',$product_id)->sum('rate');
        $count = Rating::where('rate','>=',1)->where('product_id',$product_id)->count();
        $avgRate = ($count > 0) ? $sum / $count : $sum/1;
        $productUpdated = Products::where('product_id',$product_id)->first();
        if (($productUpdated && $productUpdated->rating != $avgRate)||$productUpdated->rating ==null) {
            $productUpdated->rate = $avgRate;
            $productUpdated->save();
        }
        return $avgRate;
    }
}
