<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CorsMiddleware;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Example of binding a custom service to the container
        // $this->app->bind('SomeService', function ($app) {
        //     return new \App\Services\SomeService();
        // });

        // You can also register configuration values, events, etc.
        // For example, to bind a singleton service:
        // $this->app->singleton(SomeInterface::class, SomeService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {  // Apply CORS middleware globally for API routes
        Route::middleware([CorsMiddleware::class])->group(function () {
            Route::apiResource('users', UserController::class);
        }); // Closing the middleware group

        // Fixes for any migrations or database issues (e.g., length of string columns)
        Schema::defaultStringLength(191);

        // Forcing HTTPS on production to ensure secure URLs
        if (app()->environment('production')) {
            \URL::forceScheme('https');
        }

        // Example: You could also perform additional logic, like publishing config files, setting locales, etc.
        // Example: 
        // app('translator')->setLocale('en');
    }
}
