<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    protected $connection = "connect_Durian";
    protected $table = "product";
    protected $primaryKey = "product_id";
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'product_id','name','price','category_id','qty','description','img_url','rate'
    ];
}
