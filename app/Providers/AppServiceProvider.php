<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Vendor;

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
        View::composer('layouts.admin', function ($view) {
            $pendingVendorsCount = Vendor::where('status', 'pending')
                ->where('is_notified', false)
                ->count();
            
            $latestPendingVendors = Vendor::where('status', 'pending')
                ->where('is_notified', false)
                ->with('user')
                ->latest()
                ->take(5)
                ->get();

            $view->with([
                'pendingVendorsCount' => $pendingVendorsCount,
                'latestPendingVendors' => $latestPendingVendors
            ]);
        });
    }
}
