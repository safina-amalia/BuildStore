<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;  // Penting: harus di-import

class UserMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Jika user belum login atau bukan role 3, logout dan redirect ke login
        if (!Auth::check() || Auth::user()->role !== 3) {
            Auth::logout();  // pastikan logout jika user bukan user role 3
            return redirect('/login')->with('error', 'Anda harus login sebagai user.');
        }

        return $next($request);
    }
}
