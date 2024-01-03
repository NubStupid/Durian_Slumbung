<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;


class Users extends Authenticatable
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

    protected $fillable =[
        'username',
        'password'
    ];
    // Kalau ada ayng many to many
    // public function tesPivot(){
    //     return $this->belongsToMany(Comment::class,"pivot_ini_ga_ada_cuma_test","username","username")
    //             ->withPivot('field_ga_ada','field_ga_ada_2')
    //             ->as("nama hehe");
    // }
    // public function getImage(){
    //     if($this->img_url){
    //         return url('/storage'. $this->img_url);
    //     }
    //     return "https://t4.ftcdn.net/jpg/04/38/19/57/360_F_438195737_KifWlRKIKOYEwrbEXwUwLnVQoIeQM1iW.jpg";
    // }
}
