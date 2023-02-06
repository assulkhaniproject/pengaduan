<?php

namespace App\Filament\Resources\CategoryNewsResource\Pages;

use App\Filament\Resources\CategoryNewsResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCategoryNews extends EditRecord
{
    protected static string $resource = CategoryNewsResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
