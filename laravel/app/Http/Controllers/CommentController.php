<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Products;

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
        $view = view('commentContent',['comments'=>$updateComment]);
        return $view;
    }
}
