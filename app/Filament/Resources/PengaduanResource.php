<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PengaduanResource\Pages;
use App\Filament\Resources\PengaduanResource\Pages\EditPengaduan;
use App\Filament\Resources\PengaduanResource\Pages\ViewPengaduan;
use App\Filament\Resources\PengaduanResource\RelationManagers;
use App\Models\Pengaduan;
use App\Models\StatusPengaduan;
use Filament\Forms;
use Filament\Forms\Components\Actions\Modal\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Tables\Columns\Layout\Grid as LayoutGrid;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\Layout\Panel;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Livewire\Features\Placeholder;
use Symfony\Component\Console\Descriptor\Descriptor;

class PengaduanResource extends Resource
{
    protected static ?string $model = Pengaduan::class;

    protected static ?string $navigationGroup = 'Pages';

    protected static ?string $navigationLabel = 'Pengaduan';

    protected static ?string $navigationIcon = 'heroicon-o-annotation';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Photo')->schema([
                    FileUpload::make('photo')
                    ->multiple()
                    ->enableDownload()
                    ->enableOpen(),
                ]),
                Section::make('Detail Pengaduan')->schema([
                    TextInput::make('title'),
                    RichEditor::make('description')->label('Description')
                        ->placeholder('')
                        ->toolbarButtons([
                            'attachFiles', 'blockquote', 'bold', 'bulletList', 'codeBlock',
                            'h2', 'h3', 'italic', 'link', 'orderedList', 'redo', 'strike', 'undo',
                        ])->required(),
                    Select::make('category_id')
                        ->relationship('categories', 'name')
                        // ->createOptionForm([
                        //     Forms\Components\TextInput::make('name')
                        //         ->required(),
                        // ]),  
                ]),
                Section::make('Tindakan')->schema([
                    Select::make('status')
                    ->options([
                        'waiting' => 'Belum Direspon',
                        'progress' => 'Dalam Proses',
                        'done' => 'Selesai',
                        'rejected' => 'Ditolak'
                    ])->default('waiting'),
                                RichEditor::make('notes')->label('Notes')
                                ->placeholder('')
                                ->toolbarButtons([
                                    'attachFiles', 'blockquote', 'bold', 'bulletList', 'codeBlock',
                                    'h2', 'h3', 'italic', 'link', 'orderedList', 'redo', 'strike', 'undo',
                                ])
                                ])
                        ->visible(fn ($livewire, $get) => $livewire instanceof EditPengaduan),
                Hidden::make('user_id')->default(auth()->id()),
                
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
                        Tables\Columns\ImageColumn::make('photo')
                            ->getStateUsing(function (Model $record) {
                                if ($record->photo) {
                                    $thumb = $record->photo;
                                    return $thumb[0];
                                }
                                return asset('images/no_image.png');
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
                            TextColumn::make('created_at')->sortable()->date()->color('primary')->sortable()
                                ->extraAttributes([
                                    'class' => 'mt-2 text-primary-500 dark:text-primary-500 text-xs'
                                ]),
                            // TextColumn::make('categories.name')
                            //     ->extraAttributes([
                            //         'class' => 'mt-2 text-primary-500 dark:text-primary-500 text-xs'
                            //     ]),
                            BadgeColumn::make('status')->alignRight()
                            ->colors([
                                'secondary' => 'waiting',
                                'warning' => 'progress',
                                'success' => 'done',
                                'danger' => 'rejected',
                            ]) ->extraAttributes(['class' => 'mt-2 text-primary-50 text-xs text-right italic']),
                            // TextColumn::make('statuses.name')
                            //     ->extraAttributes(['class' => 'mt-2 text-primary-50 text-xs text-right italic'])
                            ]),
                        ]),
                    ]),
                        Panel::make([
                            Tables\Columns\TextColumn::make('notes')->sortable()
                                ->icon('heroicon-s-document')
                                ->label('Notes')
                                ->extraAttributes([
                                    'class' => 'text-grey-300 dark:text-grey-300 text-xs text-justify italic'
                                ])->html()->tooltip('Notes'),
                        ])->collapsible(),
            ])->defaultSort('created_at', 'desc')->contentGrid([
                'sm' => 1,
                'md' => 2,
                'xl' => 3,
                '2xl' => 3,
            ])
            ->filters([
                SelectFilter::make('category_id')->relationship('categories', 'name'),
                SelectFilter::make('status_id')->options([
                    '1' => 'Menunggu',
                    '2' => 'Proses',
                    '3' => 'Selesai',
                ])
                // ->default('1')
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Tindakan'),
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make()->iconButton(),
                    Tables\Actions\DeleteAction::make()->iconButton(),
                ]),
                // Tables\Actions\Action::make('proses')
                //     ->action(function (array $data, Model $record): void {
                //         // dd($data);
                //         $status = $record->statuses();
                        
                //         // $status = '';
                //         $record->status = $status;
                //         $record->update();
                //         $data['user_id'] = \auth()->user()->id;
                //         $record->notes()->create($data);
                //     })
                //     ->form([
                //         Select::make('status_id')
                //         ->options(StatusPengaduan::all()->pluck('name', 'id')),
                //         Forms\Components\Textarea::make('notes'),
                //     ])
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
            'index' => Pages\ListPengaduans::route('/'),
            'create' => Pages\CreatePengaduan::route('/create'),
            'edit' => Pages\EditPengaduan::route('/{record}/edit'),
            'view' => Pages\ViewPengaduan::route('/{record}')
        ];
    }
}
