<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// 1. Tambahkan import Paginator di bawah ini
use Illuminate\Pagination\Paginator;

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
        // 2. Tambahkan baris ini agar pagination Laravel menggunakan style Bootstrap
        Paginator::useBootstrap();
    }
}