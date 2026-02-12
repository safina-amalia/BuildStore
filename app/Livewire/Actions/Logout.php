<?php

namespace App\Livewire\Actions;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Logout
{
    /**
     * Log the current user out of the application.
     */
    public function __invoke()
    {
        if (Auth::check()) {
            Auth::logout();

            Session::invalidate();
            Session::regenerateToken();
            Session::forget('url.intended');
        }

        return redirect()->route('welcome');  // wajib redirect setelah logout
    }
}
