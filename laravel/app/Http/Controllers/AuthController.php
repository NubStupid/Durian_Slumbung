<?php

namespace App\Http\Controllers;

use App\Rules\cekusername;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function checkCredentials(Request $req,$type){
        if($type=="register"){
            return $this->cekRegister($req);
        }else if($type=="login"){
            return $this->cekLogin($req);
        }
    }

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
                return redirect()->intended('/');
            }
            else{
                return redirect(route('login'))->with("pesanLogin", "Gagal Login!")->withInput();
            }
        }
    }
    public function cekRegister(Request $req){
        $rules = [
            'username' => ["required", new cekusername()],
            'password' => 'required',
            'confirm_password' => 'required|same:password',
            'notelp' => ["required", "max:11",'regex:/^[0-9]+$/']
        ];
        $messages = [
            "required" => ":attribute kosong",
            'confirm_password.same' => 'Password tidak sama',
            'notelp.regex' => 'Nomor telepon hanya boleh berisi angka.'
        ];

        $validator = Validator::make($req->all(), $rules, $messages);
        $validationPassed = $validator->passes();
        $errors = $validator->errors();
        if ($validationPassed) {
            $newuser = DB::connection("connect_Durian")->table("user")->insert(
                [
                    "username" => $req->username,
                    "password" => $req->password,
                    "telp" => $req->notelp
                ]
            );
            return redirect('login');
        } else {
            return redirect(route('register'))->with("pesanRegister", "Gagal mendaftar")->withErrors($errors);
        }
    }
}
