<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Illuminate\Foundation\Vite;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
//
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Filament::registerStyles([
            asset('filament/assets/css/leaflet.css'),
            asset('filament/assets/css/geosearch.css'),
        ]);
        Filament::registerScripts([
            asset('filament/assets/js/leaflet.js'),
            asset('filament/assets/js/geosearch.umd.js'),
        ], true);
    }
}
