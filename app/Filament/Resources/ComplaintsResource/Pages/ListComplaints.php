<?php

namespace App\Filament\Resources\ComplaintsResource\Pages;

use App\Filament\Resources\ComplaintsResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListComplaints extends ListRecords
{
    protected static string $resource = ComplaintsResource::class;

    protected static ?string $title = 'Complaints';

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
