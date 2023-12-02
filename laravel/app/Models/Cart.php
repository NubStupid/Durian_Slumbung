<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $connection = "connect_Durian";
    protected $table = "cart";
    protected $primaryKey = "cart_id";
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'product_id','price','qty', 'username'
    ];
}