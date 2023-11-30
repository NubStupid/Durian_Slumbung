<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Guest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(session()->has('username')){
            if (session()->get('role') == "user"){
                return redirect('/');
            }
            else if(session()->get('role') == "admin"){
                return redirect('adminhomepage');
            }
        }
        return $next($request);
    }
}
