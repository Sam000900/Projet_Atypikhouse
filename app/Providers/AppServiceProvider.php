<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

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
        Inertia::share([
            'navTabs' => function () {
                $user = Auth::user();
                if (!$user) {
                    return [];
                }

                return collect(config('dashboardnavtabs'))
                    ->filter(fn ($tab) => in_array($user->role, $tab['forRole']))
                    ->values()
                    ->toArray();
            },
        ]);
    }
}
