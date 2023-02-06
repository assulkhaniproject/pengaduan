<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryNewsResource\Pages;
use App\Filament\Resources\CategoryNewsResource\RelationManagers;
use App\Models\CategoryNews;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CategoryNewsResource extends Resource
{
    protected static ?string $model = CategoryNews::class;

    protected static ?string $navigationLabel = 'Category News';

    protected static ?string $navigationGroup = 'News';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('created_at'),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()->iconButton(),
                Tables\Actions\DeleteAction::make()->iconButton(),

            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCategoryNews::route('/'),
            'create' => Pages\CreateCategoryNews::route('/create'),
            'edit' => Pages\EditCategoryNews::route('/{record}/edit'),
        ];
    }
}
