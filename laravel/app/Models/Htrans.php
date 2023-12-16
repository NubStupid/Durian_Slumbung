<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Htrans extends Model
{
    use HasFactory;
    protected $connection = "connect_Durian";
    protected $table = "h_trans";
    protected $primaryKey = "h_trans_id";
    public $incrementing = false;
    public $timestamps = false;


    public function dtrans(){
        return $this->hasMany(Dtrans::class,'h_trans_id','h_trans_id');
    }
}
