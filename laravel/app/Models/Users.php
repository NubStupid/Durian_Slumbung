<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Users extends Model
{
    use HasFactory;
    protected $connection ="connect_Durian";
    protected $table = "user";
    protected $primaryKey = "username";
    public $incrementing = false;
    public $timestamps = false;

    // yang kiri itu fieldnya Comment kalo kanan itu fieldnya Users
    public function Comments(){
        return $this->hasMany(Comment::class,"username","username");
    }
}
