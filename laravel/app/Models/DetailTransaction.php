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
        'd_trans_id','qty','total', 'h_trans_id', 'product_id'
    ];
}
