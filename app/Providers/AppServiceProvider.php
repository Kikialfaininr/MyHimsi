<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Carbon\Carbon;

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
        Carbon::setLocale('id');

        if (config('app.env') === 'local' && (env('APP_FORCE_HTTPS', false) || strpos(request()->getHost(), 'ngrok-free.app') !== false)) {
            URL::forceScheme('https');
        }             
    }
}
