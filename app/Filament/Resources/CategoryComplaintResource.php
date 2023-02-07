<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryComplaintResource\Pages;
use App\Filament\Resources\CategoryComplaintResource\RelationManagers;
use App\Models\CategoryComplaint;
use App\Models\CategoryComplaints;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CategoryComplaintResource extends Resource
{
    protected static ?string $model = CategoryComplaints::class;

    protected static ?string $navigationGroup = 'Complaint';

    protected static ?string $navigationLabel = 'Category Complaints';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make()->schema([
                    TextInput::make('name')
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('created_at')->date(),

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
            'index' => Pages\ListCategoryComplaints::route('/'),
            'create' => Pages\CreateCategoryComplaint::route('/create'),
            'edit' => Pages\EditCategoryComplaint::route('/{record}/edit'),
        ];
    }
}
