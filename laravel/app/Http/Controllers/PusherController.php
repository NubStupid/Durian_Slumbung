<?php

namespace App\Http\Controllers;

use App\Events\PusherBroadcast;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use App\Models\Admin;
use Illuminate\Http\Request;

class PusherController extends Controller
{
    public function index()
    {
        $otherMaster = Admin::where('role','=','M')->where('username',"!=",session()->get('username'))->first();
        return view('chatMaster',['toChat'=>$otherMaster]);
    }

    public function broadcast(Request $request)
    {
        broadcast(new PusherBroadcast($request->get('message'),session()->get('username')))->toOthers();

        return view('broadcast', ['message' => $request->get('message'),'user'=>session()->get('username')]);
    }

    public function receive(Request $request)
    {
        return view('receive', ['message' => $request->get('message'),'user'=>$request->get('username')]);
    }
}
