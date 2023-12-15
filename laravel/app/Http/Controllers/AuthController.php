<?php

namespace App\Http\Controllers;

use App\Rules\cekusername;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;

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
            // session()->put('username', $username);
            // session()->put('role', "admin");
            // return redirect('adminhomepage');
        $credentials = [
            'username' => $username,
            'password' => $password //Defaultnya minta password
        ];

        // Kalau Password di encrypt
        // if(Auth::guard('admin')->attempt($credentials)){
            // session()->put('username', Auth::guard('admin')->user()->username);
            // session()->put('role', Auth::guard('admin')->user()->role);
            // if(Auth::guard('admin')->user()->role == "M"){
            //     return redirect('masterhomepage');
            // }
            // return redirect('adminhomepage');
        // }else if(Auth::guard('user')->attempt($credentials)){
        //     session()->put('username', Auth::guard('user')->user()->username);
        //     session()->put('role', "user");
        //     return redirect()->back();
        // }else{
        //     return redirect(route('login'))->with("pesanLogin", "Gagal Login!")->withInput();
        // }

        // Kalau tidak di encrypt
        $user = Auth::guard('admin')->getProvider()->retrieveByCredentials($credentials);
        if($user && $user->getAuthPassword() == $credentials['password']){
            session()->put('username', $user->username);
            session()->put('role', $user->role);
            if($user->role == "M"){
                return redirect('masterhomepage');
            }
            return redirect('adminhomepage');
        }
        $user = Auth::guard('web')->getProvider()->retrieveByCredentials($credentials);
        if($user && $user->getAuthPassword() == $credentials['password']){
            session()->put('username', $user->username);
            session()->put('role', "user");
            return redirect()->back();
        }else{
            return redirect(route('login'))->with("pesanLogin", "Gagal Login!")->withInput();
        }

        // tanpa auth
        // $user = DB::connection("connect_Durian")->table('user')
        //     ->where('username', $username)
        //     ->where('password', $password)
        //     ->first();

        // if($user){
        //     session()->put('username', $username);
        //     session()->put('role', "user");
        //     return redirect()->back();
        // }
        // else{
        //     $admin = Admin::where('username',$username)->where('password',$password)->first();
        //     if($admin){
        //         session()->put('username', $username);
        //         session()->put('role',$admin["role"]);
        //         if($admin["role"] == "M"){
        //             return redirect('masterhomepage');
        //         }
        //         return redirect('adminhomepage');
        //     }
        //     return redirect(route('login'))->with("pesanLogin", "Gagal Login!")->withInput();
        // }
    }
    // public function cekLogin(Request $req){
    //     $username = $req->username;
    //     $password = $req->password;
    //     $remember = $req->remember;
    //     if($username=="admin"&&$password=="admin"){
    //         session()->put('username', $username);
    //         session()->put('role', "admin");
    //         return redirect('adminhomepage');
    //     }
    //     else{
    //         $user = DB::connection("connect_Durian")->table('user')
    //             ->where('username', $username)
    //             ->where('password', $password)
    //             ->first();

    //         if($user){
    //             session()->put('username', $username);
    //             session()->put('role', "user");
    //             // return redirect()->intended('/');
    //             return redirect()->back();
    //         }
    //         else{
    //             return redirect(route('login'))->with("pesanLogin", "Gagal Login!")->withInput();
    //         }
    //     }
    // }
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
            return redirect('login')->with('success_message', 'Registration successful. Please login.');
        } else {
            return redirect(route('register'))->with("pesanRegister", "Gagal mendaftar")->withErrors($errors);
        }
    }
}
