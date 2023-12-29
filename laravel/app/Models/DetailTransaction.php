<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaction extends Model
{
    use HasFactory;

    protected $connection = "connect_Durian";
    protected $table = "d_trans";
    protected $primaryKey = "d_trans_id";
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'd_trans_id','qty','total', 'h_trans_id', 'product_id', 'pengambilan'
    ];

    public function Product(){
        return $this->belongsTo(Products::class, "product_id", "product_id");
    }

    public function Wisata(){
        return $this->belongsTo(Wisata::class, "product_id", "wisata_id");
    }
}
