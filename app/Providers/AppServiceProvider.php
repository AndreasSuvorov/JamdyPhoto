<?php

namespace App\Providers;

use App\View\Components\Header\Header;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;

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
        Blade::component('header', Header::class);
        view()->composer('*', function (View $view) {
            if (Auth::check()) {
                if (!request()->ajax() && !request()->wantsJson()) {
                    $user = request()->user();
                    $view->with(['user' => $user]);
                }
            }
        });
    }
}
