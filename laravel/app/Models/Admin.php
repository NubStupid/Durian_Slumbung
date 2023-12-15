<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;
    protected $connection = "connect_Durian";
    protected $table = "admin";
    protected $primaryKey = "username";
    public $incrementing = false;
    public $timestamps = false;

    // public function getAuthPassword(){
    //     return $this->password; diisi field yangmau overwrite di cred password di auth
    // }
}
