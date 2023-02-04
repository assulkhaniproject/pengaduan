<?php

namespace App\Filament\Resources\PengaduanResource\Pages;

use App\Filament\Resources\PengaduanResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPengaduans extends ListRecords
{
    protected static string $resource = PengaduanResource::class;

    protected static ?string $title = 'Pengaduan';

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
