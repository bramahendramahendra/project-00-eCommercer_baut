<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use App\Models\InformationCompany;

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
        Schema::defaultStringLength(191);

        View::composer('components.application-logo', function ($view) {
            $logo = InformationCompany::where('id', 1)->value('image');
            if (!$logo) {
                $logo = asset('images/logo_default.png');
            }
            $view->with('logo', $logo);
        });

    }
}
