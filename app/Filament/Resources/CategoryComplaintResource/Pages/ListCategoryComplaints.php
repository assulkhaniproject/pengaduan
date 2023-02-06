<?php

namespace App\Filament\Resources\CategoryComplaintResource\Pages;

use App\Filament\Resources\CategoryComplaintResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCategoryComplaints extends ListRecords
{
    protected static string $resource = CategoryComplaintResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
