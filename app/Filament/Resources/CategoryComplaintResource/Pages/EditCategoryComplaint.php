<?php

namespace App\Filament\Resources\CategoryComplaintResource\Pages;

use App\Filament\Resources\CategoryComplaintResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCategoryComplaint extends EditRecord
{
    protected static string $resource = CategoryComplaintResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
