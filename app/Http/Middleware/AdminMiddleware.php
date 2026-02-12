<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 1) {
            return $next($request);
        }

        return redirect('/login')->with('error', 'Anda harus login sebagai admin.');
    }
}
