<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate; // 1. Tambahkan Facade Gate
use App\Models\User;                  // 2. Import Model User

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
        // Otorisasi khusus Admin
        Gate::define('admin-only', function (User $user) {
            return $user->role === 'admin';
        });

        // Otorisasi khusus PJ Gedung
        Gate::define('pj-only', function (User $user) {
            return $user->role === 'pj_gedung';
        });

        // Otorisasi gabungan (Admin atau PJ Gedung)
        Gate::define('pj-or-admin', function (User $user) {
            return in_array($user->role, ['admin', 'pj_gedung']);
        });
    }
}