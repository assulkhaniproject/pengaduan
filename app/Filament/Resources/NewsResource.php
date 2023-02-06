<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NewsResource\Pages;
use App\Filament\Resources\NewsResource\RelationManagers;
use App\Models\News;
use Closure;
use Filament\Forms;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Nuhel\FilamentCropper\Components\Cropper;
use Filament\Tables\Columns\Layout\Grid as LayoutGrid;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class NewsResource extends Resource
{
    protected static ?string $model = News::class;

    protected static ?string $navigationLabel = 'News';

    protected static ?string $navigationGroup = 'News';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Section::make('General')
                            ->description('an news form that contains an information')
                            ->schema([
                                TextInput::make('title')
                                    ->label('Title News')
                                    ->placeholder('Enter the title of your news')
                                    ->afterStateUpdated(function (Closure $set, $state) {
                                        $set('slug', Str::slug($state));
                                    }),
                                RichEditor::make('description')->label('Body News')
                                    ->placeholder('Write the content of your news')
                                    ->toolbarButtons([
                                        'attachFiles', 'blockquote', 'bold', 'bulletList', 'codeBlock',
                                        'h2', 'h3', 'italic', 'link', 'orderedList', 'redo', 'strike', 'undo',
                                    ])->required(),
                            ])->collapsible(),
                        Section::make('Image')
                            ->schema([
                                Cropper::make('image')
                                    ->disk('public')
                                    ->directory('News/')
                                    ->enableDownload()
                                    ->enableOpen()
                                    ->imageResizeTargetWidth('1024')
                                    ->imageResizeTargetHeight('600')
                                    ->modalSize('6xl')
                                    ->modalHeading("Crop Background Image")
                            ])->collapsible(),
                        Section::make('Selected')->schema([
                            Select::make('category_news_id')
                                ->relationship('categories_news', 'name')
                                ->createOptionForm([
                                    Forms\Components\TextInput::make('name')
                                        ->required(),
                                ]),
                                Toggle::make('is_active')->label('Status')->inline()
                        ])->collapsible(),
                    ])->columnSpan(['lg' => fn (?News $record) => $record === null ? 3 : 2]),

                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\Placeholder::make('created_at')
                            ->label('Created at')
                            ->content(fn (News $record): ?string => $record->created_at?->diffForHumans()),

                        Forms\Components\Placeholder::make('updated_at')
                            ->label('Last modified at')
                            ->content(fn (News $record): ?string => $record->updated_at?->diffForHumans()),
                    ])
                    ->columnSpan(['lg' => 1])
                    ->hidden(fn (?News $record) => $record === null),
            ])
            ->columns([
                'sm' => 3,
                'lg' => null,
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->contentGrid([
                'md' => 2,
                'xl' => 3,
            ])
            ->columns([
                Stack::make([
                    LayoutGrid::make()->schema([
                        Tables\Columns\ImageColumn::make('image')
                            ->getStateUsing(function (Model $record) {
                                if ($record->image) {
                                    $thumb = $record->image;
                                    return $thumb;
                                }
                                return asset('images/no_image.jpeg');
                            })
                            ->height('200px')
                            ->extraImgAttributes([
                                'class' => 'object-cover h-cover rounded-t-xl w-full',
                            ]),
                    ])->columns(1),

                    Stack::make([
                        TextColumn::make('title')->searchable()->sortable()
                            ->extraAttributes([
                                'class' => 'mt-2 text-gray-500 dark:text-gray-300 text-md font-bold'
                            ]),
                        TextColumn::make('description')->limit(300)->searchable()
                            ->extraAttributes([
                                'class' => 'mt-2 text-gray-500 dark:text-gray-300 text-xs text-justify'
                            ]),

                        Split::make([
                            TextColumn::make('created_at')->date()->color('primary')->sortable()
                                ->extraAttributes([
                                    'class' => 'mt-2 text-primary-500 dark:text-primary-500 text-xs'
                                ]),
                            ]),
                            IconColumn::make('is_active')
                            ->alignRight()
                            ->boolean()
                                ->trueIcon('heroicon-o-badge-check')
                                ->falseIcon('heroicon-o-x-circle')
                                ->extraAttributes([
                                    'class' => 'mt-2 text-xs'
                                ]),
                    ]),
                ])
            ])->defaultSort('created_at','desc')
            ->filters([
                SelectFilter::make('category_news_id')->relationship('categories_news','name')
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()

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
            'index' => Pages\ListNews::route('/'),
            'create' => Pages\CreateNews::route('/create'),
            'edit' => Pages\EditNews::route('/{record}/edit'),
        ];
    }
}
