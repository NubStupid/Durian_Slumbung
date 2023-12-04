<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
    protected $connection = "connect_Durian";
    protected $table = "admin";
    protected $primaryKey = "username";
    public $incrementing = false;
    public $timestamps = false;
}
