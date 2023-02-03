<?php

namespace App\Filament\Resources;

use App\Components\PasswordGenerator;
use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\Pages\CreateUser;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\Layout\Panel;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;
use Nuhel\FilamentCropper\Components\Cropper;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-s-user-group';

    protected static ?string $navigationGroup = 'Filament Shield';

    protected static ?int $navigationSort = 1;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Details')
                    ->schema([
                        Cropper::make('avatar')
                            ->avatar()
                            ->enableOpen()
                            ->enableDownload()
                            ->modalHeading("Crop Background Image")
                            ->enableImageRotation()
                            ->rotationalStep(5)
                            ->enableImageFlipping()
                            ->modalSize('xl')
                            ->disk('public')
                            ->directory('User/Avatar'),
                        Forms\Components\TextInput::make('nik')
                            ->required()
                            ->reactive(),
                        Grid::make()->schema([
                            Forms\Components\TextInput::make('name')
                                ->required()
                                ->reactive(),
                            Forms\Components\TextInput::make('email')
                                ->required()
                                ->email()
                                ->unique(User::class, 'email', fn ($record) => $record),
                            DatePicker::make('tgl_lahir')
                        ])->columns(3),
                        Textarea::make('alamat'),
                        Forms\Components\Toggle::make('reset_password')
                            ->columnSpan('full')
                            ->reactive()
                            ->dehydrated(false)
                            ->hiddenOn('create'),
                        PasswordGenerator::make('password')
                            ->columnSpan('full')
                            ->visible(fn ($livewire, $get) => $livewire instanceof CreateUser || $get('reset_password') == true)
                            ->rules(config('filament-breezy.password_rules', 'max:25'))
                            ->required()
                            // ->helperText('maximum 8 characters')
                            ->dehydrateStateUsing(function ($state) {
                                return Hash::make($state);
                            }),
                        Grid::make()->schema([
                            Forms\Components\BelongsToManyMultiSelect::make('role_id')
                                ->relationship('roles', 'name'),
                        ])->columns(1)
                    ])->columns(['md' => 1]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Split::make([
                    Tables\Columns\ImageColumn::make('avatar')
                        ->label('Avatar')->grow(false)->circular()->size(50),
                    Tables\Columns\TextColumn::make('name')->sortable()->searchable()->extraAttributes([
                        'class' => 'mt-2 text-grey-300 dark:text-grey-300 text-md'
                    ]),
                    TextColumn::make('nik')
                        ->searchable()
                        ->copyable()
                        ->copyMessage('Color code copied')
                        ->icon('heroicon-s-shield-exclamation')
                        ->searchable()
                        ->wrap(),
                    Tables\Columns\TextColumn::make('email')
                        ->icon('heroicon-s-mail')
                        ->searchable()
                        ->wrap(),
                    Stack::make([
                        Tables\Columns\TagsColumn::make('roles.name')->searchable()
                            ->extraAttributes([
                                'class' => 'mt-2 text-grey-300 dark:text-grey-300 text-xs text-justify'
                            ]),
                    ])->alignment('right'),
                ]),
                Panel::make([
                    Tables\Columns\TextColumn::make('created_at')->date()->sortable()
                        ->icon('heroicon-s-calendar')
                        ->extraAttributes([
                            'class' => 'text-grey-300 dark:text-grey-300 text-md text-justify italic'
                        ]),
                ])->collapsible(),
            ])->defaultSort('name')
            ->filters([
                //
            ])
            ->actions([
                EditAction::make()->iconButton(),
                DeleteAction::make()->iconButton()
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
