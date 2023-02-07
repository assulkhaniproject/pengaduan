<?php

namespace App\Filament\Widgets;

use App\Models\Complaints;
use App\Models\News;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class StatsOverview extends BaseWidget
{

    protected static ?string $pollingInterval = '10s';
    protected function getCards(): array
    {
        return [
            Card::make('Total Complaints', Complaints::count())
            ->color('success'),
            Card::make('Total News', News::count())
            ->color('success'),
            Card::make('Total Users', User::count())
            ->color('success'),
        ];
    }
}
