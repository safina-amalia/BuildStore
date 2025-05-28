<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Tambahkan ini!
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     */
<<<<<<< HEAD
   // App\Http\Middleware\CheckRole.php
    public function handle($request, Closure $next, $role)
    {
        if (auth()->check() && auth()->user()->role == $role) {
            return $next($request);
        }

        return redirect()->route('welcome');
    }

=======
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (Auth::check() && Auth::user()->role == $role) {
            return $next($request);
        }

        return redirect()->route('welcome');
    }
>>>>>>> 423fe2a09e74310352221c0c481cb2111a1b057f
}
