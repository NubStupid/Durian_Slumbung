<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dtrans extends Model
{
    use HasFactory;
    protected $connection = "connect_Durian";
    protected $table = "d_trans";
    protected $primaryKey = "d_trans_id";
    public $incrementing = false;
    public $timestamps = false;

    public function product(){
        return $this->hasOne(Products::class,'product_id','product_id');
    }

    public function wisata(){
        return $this->hasOne(Wisata::class,'wisata_id','product_id');
    }
}
