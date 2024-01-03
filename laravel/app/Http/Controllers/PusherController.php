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
        $otherMaster = Admin::where('role','=','M')->where('username',"!=",auth()->user())->first();
        return view('chatMaster',['toChat'=>$otherMaster]);
    }

    public function broadcast(Request $request)
    {
        broadcast(new PusherBroadcast($request->get('message')))->toOthers();

        return view('broadcast', ['message' => $request->get('message')]);
    }

    public function receive(Request $request)
    {
        return view('receive', ['message' => $request->get('message')]);
    }
}
