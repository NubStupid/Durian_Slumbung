<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $connection = "connect_Durian";
    protected $table = "comment";
    protected $primaryKey = "comment_id";
    public $incrementing = false;
    public $timestamps = false;
}
