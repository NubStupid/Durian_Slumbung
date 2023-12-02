<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $connection = "connect_Durian";
    protected $table = "h_trans";
    protected $primaryKey = "h_trans_id";
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
        'h_trans_id','invoice_number','total', 'username', 'status'
    ];
}
