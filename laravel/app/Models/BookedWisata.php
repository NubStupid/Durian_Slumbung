<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookedWisata extends Model
{
    use HasFactory;

    protected $connection = "connect_Durian";
    protected $table = "booked_wisata";
    protected $primaryKey = ["wisata_id", "tgl_dipesan"];
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'wisata_id','tgl_dipesan','qty'
    ];

    public function Wisata(){
        return $this->belongsTo(Wisata::Class,"wisata_id","wisata_id");
    }
}
