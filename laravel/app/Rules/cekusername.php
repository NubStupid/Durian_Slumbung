<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class cekusername implements Rule
{
    public function passes($attribute,$value)
    {
        $user = DB::connection("connect_Durian")->table('user')
                ->where('username', $value)
                ->first();
        return !$user;
    }
    public function message()
    {
        return 'Username Sudah Ada!';
    }
}
