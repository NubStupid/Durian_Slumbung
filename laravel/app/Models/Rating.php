<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $connection = "connect_Durian";
    protected $table = "rating";
    protected $primaryKey = "rating_id";
    public $incrementing = true;
    public $timestamps = false;

    protected $fillable = [
        'rate','username','product_id'
    ];
}
