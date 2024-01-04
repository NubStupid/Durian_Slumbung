<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $connection = "connect_Durian";
    protected $table = "cart";
    public $timestamps = false;

    protected $fillable = [
        'cart_id','product_id','price','qty', 'username'
    ];

    public function Product(){
        return $this->belongsTo(Products::Class,"product_id","product_id");
    }
}
