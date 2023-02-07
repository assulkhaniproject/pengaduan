<?php

namespace App\Providers;

use App\Filament\Widgets\StatsOverviewWidget;
use Filament\Facades\Filament;
use Filament\FilamentServiceProvider as FilamentFilamentServiceProvider;
use Filament\Forms\Components\TextInput;
use Filament\PluginServiceProvider;
use Illuminate\Support\ServiceProvider;
use RalphJSmit\Filament\Onboard\Widgets\OnboardTrackWidget;

class FilamentServiceProvider extends AppServiceProvider
{
    public static string $name = 'some-string-that-is-never-used';

    // protected array $widgets = [
    //     OnboardTrackWidget::class,
    //     // StatsOverviewWidget::class, // This is my second widget.
    // ];

    public function boot(): void
    {
        parent::boot();

        /** Application-specific stuff, not relevant for .*/
        Filament::serving(function () {
            // Using Vite
            Filament::registerViteTheme('resources/css/filament.css');
        });
    }
}
