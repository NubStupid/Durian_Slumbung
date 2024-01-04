<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\Users;
use Illuminate\Support\Facades\Session;
class ProviderController extends Controller
{
    //
    public function redirect($provider){
        return Socialite::driver($provider)->redirect();
    }
    public function callback($provider){
        $user = Socialite::driver($provider)->user();
        $ifExist = Users::where('username', $user->email)->first();
        if(!$ifExist){
            $newUser = new Users([
                'username'=>$user->email,
                'password'=>$user->id,
            ]);
            $newUser->save();
            $ifExist = $newUser;
        }
        auth()->login($ifExist);
        if(!auth()->check()){
            return redirect('login')->with('pesanLogin','Terjadi kesalahan dalam login Google!');
        }else{
            Session::put('username',$ifExist->username);
            Session::put('role',"user");
            return redirect('/');
        }
    }
}
