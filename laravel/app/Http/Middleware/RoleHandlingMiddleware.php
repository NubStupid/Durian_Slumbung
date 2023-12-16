<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleHandlingMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,$role): Response
    {
        $user = null;
        if(session('role') == 'A' && $role!= session('role')) {
            return redirect('adminhomepage');
        }else if(session('role') == 'M' && $role!= session('role')){
            return redirect('masterhomepage');
        }
        if(session()->has('username')) {
            $user = [
                'username' => session('username'),
            ];
        }
        $request->attributes->add(['user'=>$user]);
        return $next($request);
    }
}
