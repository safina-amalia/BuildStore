<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Konfigurasi Midtrans
        Config::$serverKey = env('MIDTRANS_SERVER_KEY', 'SB-Mid-server-QRKR4DNSHoisPCnqjTOO72SB'); // Gunakan env
        Config::$isProduction = false; // Ubah ke true di production
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // Cegah redirect jika user login ke halaman /
        Route::matched(function () {
            if (request()->is('/') && Auth::check()) {
                // Tidak melakukan redirect — biarkan user tetap di halaman welcome
            }
        });
    }
}
