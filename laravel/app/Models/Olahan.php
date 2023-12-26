<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Olahan extends Model
{
    use HasFactory;
    
    protected $connection = "connect_Durian";
    protected $table = "olahan";
    protected $primaryKey = "olahan_id";
    public $incrementing = false;
    public $timestamps = false;
}
