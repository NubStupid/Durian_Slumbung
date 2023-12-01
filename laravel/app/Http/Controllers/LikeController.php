<?php

namespace App\Http\Controllers;
use App\Models\Comment;
use App\Models\Products;
use App\Models\Likes;


use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function addLike(Request $req)
    {
        $data = $req->all();

        $likes = new Likes();
        $maxID = Likes::max('likes_id');
        $maxNum = substr($maxID, 2, 3) + 1;
        if($maxNum > 0 && $maxNum < 10){
            $likes->likes_id = "L000".substr($maxID, 2, 3) + 1;
        }
        else if($maxNum >= 10 && $maxNum < 100){
            $likes->likes_id = "L00".substr($maxID, 2, 3) + 1;
        }
        else if($maxNum >= 100 && $maxNum < 1000){
            $likes->likes_id = "L0".substr($maxID, 2, 3) + 1;
        }
        else{
            $likes->likes_id = "L".substr($maxID, 2, 3) + 1;
        }
        $likes->likes_id = $data["likes_id"];
        $likes->username = $data["username"];
        $likes->comment_id = $data["comment_id"];
        $likes->save();

        $updateLike = Likes::where('comment_id', $data['comment_id'])->get();
        $likeCount = $updateLike->count();

        $view = view('commentCard',['comments'=>$likeCount]);
        return $view;
    }
}
