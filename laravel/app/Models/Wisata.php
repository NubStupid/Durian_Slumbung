<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wisata extends Model
{
    use HasFactory;

    protected $connection = "connect_Durian";
    protected $table = "wisata";
    protected $primaryKey = "wisata_id";
    public $incrementing = false;
    public $timestamps = false;

    public function Olahan(){
        return $this->hasOne(Olahan::class,"olahan_id","olahan_id");
    }
}
