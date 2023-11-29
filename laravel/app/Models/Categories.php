<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;
    protected $connection = "connect_Durian";
    protected $table = "categories";
    protected $primaryKey = "category_id";
    public $incrementing = true;
    public $timestamps = false;
}
