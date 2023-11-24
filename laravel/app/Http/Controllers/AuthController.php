<?php

namespace App\Http\Controllers;

use App\Rules\cekusername;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function cekLogin(Request $req){
        $username = $req->username;
        $password = $req->password;
        $remember = $req->remember;
        if($username=="admin"&&$password=="admin"){
            session()->put('username', $username);
            session()->put('role', "admin");
            return redirect('adminhomepage');
        }
        else{
            $user = DB::connection("connect_Durian")->table('user')
                ->where('username', $username)
                ->where('password', $password)
                ->first();
            
            if($user){
                session()->put('username', $username);
                session()->put('role', "user");
                return redirect('homepage');
            }
            else{
                return redirect('login')->with("pesan","Gagal Login!");
            }
        }
    }
    public function cekRegister(Request $req){
        $rules = [
            'username' => ["required", new cekusername()],
            'password' => 'required',
            'confirm_password' => 'required|same:password',
            'notelp' => ["required", "regex:/^0[0-9]{8,11}$/"]
        ];
        $messages = [
            "required" => ":attribute kosong",
            'confirm_password.same' => 'Password tidak sama',
            'notelp.regex' => 'Nomor telepon hanya boleh berisi angka.'
        ];
        $req->validate($rules, $messages);

        $newuser = DB::connection("connect_Durian")->table("user");
        $newuser = $newuser->insert(
            [
                "username" => $req->username,
                "password" => $req->password,
                "telp" => $req->notelp
            ]
        );
        return redirect('login');
    }
}
