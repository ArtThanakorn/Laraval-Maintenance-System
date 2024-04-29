<?php

namespace App\Http\Middleware;

use Closure;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     **/
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            if (auth()->user()->role === 1) {
                return $next($request);
            } else {
                Auth::logout();
                return redirect(route('login.page'))->with('error', "ไม่ใช้admin");
            }
        } else {
            return redirect(route('login.page'));
        }
    }
}
