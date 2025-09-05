<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        // Register view composers for navigation
        \Illuminate\Support\Facades\View::composer([
            'components.dashboard.sidebar',
            'components.dashboard.sidebar-mobile',
            'layouts.dashboard',
            'admin.dashboard.index',
            'admin.analytics.index',
            'admin.settings.index',
        ], \App\View\Composers\DashboardComposer::class);
    }
}
