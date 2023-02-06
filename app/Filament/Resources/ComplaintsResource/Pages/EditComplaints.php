<?php

namespace App\Filament\Resources\ComplaintsResource\Pages;

use App\Filament\Resources\ComplaintsResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditComplaints extends EditRecord
{
    protected static string $resource = ComplaintsResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
