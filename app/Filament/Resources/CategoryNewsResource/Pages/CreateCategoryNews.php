<?php

namespace App\Filament\Resources\CategoryNewsResource\Pages;

use App\Filament\Resources\CategoryNewsResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCategoryNews extends CreateRecord
{
    protected static string $resource = CategoryNewsResource::class;
}
