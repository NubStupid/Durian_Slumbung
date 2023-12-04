<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Auth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role1,$role2 = null): Response
    {
        $role2 = $role2 ?? 'kosong';
        if (!session()->has('username') || ($role1 != session()->get('role')&&($role2!= session()->get('role')||$role2 == 'kosong'))){
            return redirect('login');
        }

        return $next($request);
    }
}
