<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Products;
use App\Models\Likes;

class CommentController extends Controller
{
    public function addComment(Request $req)
    {
        $data = $req->all();

        $comment = new Comment();
        $maxID = Comment::max('comment_id');
        $maxNum = substr($maxID, 2, 3) + 1;
        if($maxNum > 0 && $maxNum < 10){
            $comment->comment_id = "CM00".substr($maxID, 2, 3) + 1;
        }
        else if($maxNum >= 10 && $maxNum < 100){
            $comment->comment_id = "CM0".substr($maxID, 2, 3) + 1;
        }
        else{
            $comment->comment_id = "CM".substr($maxID, 2, 3) + 1;
        }
        $comment->message = $data["message"];
        $comment->username = $data["username"];
        $comment->product_id = $data["product_id"];
        $comment->save();

        $updateComment = Comment::all()
                            ->where('product_id',$data['product_id']);
        $updateComment = $this->getUserLikedComment($data["username"],$updateComment);
        $view = view('commentContent',['comments'=>$updateComment]);
        return $view;
    }
    public function getUserLikedComment($user,$comments){
        foreach ($comments as $i => $comment) {
            $isLiked =  Likes::where('comment_id', $comment["comment_id"])->where('username',$user)->get();
            if(count($isLiked)==0){
                $comments[$i]["img_like"] = "assets/detail/like.png";
            }else{
                $comments[$i]["img_like"] = "assets/detail/liked.png";
            }
            $totalLiked = Likes::where('comment_id',$comment["comment_id"])->get()->count();
            $comments[$i]["likes"] = $totalLiked;
        }

        return $comments;
    }
}
