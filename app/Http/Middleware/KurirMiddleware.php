<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth; // jangan lupa import ini

class KurirMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->role === 2) {
            return $next($request);
        }

        return redirect('/login')->with('error', 'Akses ditolak, Anda harus login sebagai kurir.');
    }
}
