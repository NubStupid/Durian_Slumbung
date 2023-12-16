<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $connection = "connect_Durian";
    protected $table = "comment";
    protected $primaryKey = "comment_id";
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'comment_id','message','username', 'product_id'
    ];
    // yang kiri itu fieldnya Users dan kanan fieldnya Comment
    public function User(){
        return $this->hasOne(Users::Class,"username","username");
    }
    // yang kiri itu fieldnya Comment dan kanan fieldnya Users
    // public function User(){
        // return $this->belongsTo(Users::class,"username","username");
    // }

}
