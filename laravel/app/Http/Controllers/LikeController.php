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

        if ($maxNum > 0 && $maxNum < 10) {
            $likes->likes_id = "L000" . $maxNum;
        } else if ($maxNum >= 10 && $maxNum < 100) {
            $likes->likes_id = "L00" . $maxNum;
        } else if ($maxNum >= 100 && $maxNum < 1000) {
            $likes->likes_id = "L0" . $maxNum;
        } else {
            $likes->likes_id = "L" . $maxNum;
        }

        $likes->username = $data["username"];
        $likes->comment_id = $data["comment_id"];
        $likes->save();

        $updateLike = Likes::where('comment_id', $data['comment_id'])->get();
        $likeCount = $updateLike->count();
        return $likeCount;
    }



    public function deleteLike(Request $req)
    {
        $data = $req->all();

        $ifExist = Likes::where('comment_id', $data['comment_id'])
                       ->where('username', $data['username'])
                       ->delete();

        $updateLike = Likes::where('comment_id', $data['comment_id'])->get();
        $likeCount = $updateLike->count();
        return $likeCount;
    }

}
