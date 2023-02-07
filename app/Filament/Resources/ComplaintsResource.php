<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ComplaintsResource\Pages;
use App\Filament\Resources\ComplaintsResource\Pages\EditComplaints;
use App\Filament\Resources\ComplaintsResource\Pages\ViewComplaints;
use App\Filament\Resources\ComplaintsResource\RelationManagers;
use App\Models\Complaints;
use App\Models\StatusComplaints;
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

class ComplaintsResource extends Resource
{
    protected static ?string $model = Complaints::class;

    protected static ?string $navigationGroup = 'Complaint';

    protected static ?string $navigationLabel = 'Complaints';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationIcon = 'heroicon-o-annotation';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Images')->schema([
                    FileUpload::make('images')
                    ->multiple()
                    ->enableDownload()
                    ->enableOpen(),
                ]),
                Section::make('Detail Complaints')->schema([
                    TextInput::make('title'),
                    RichEditor::make('description')->label('Description')
                        ->placeholder('')
                        ->toolbarButtons([
                            'attachFiles', 'blockquote', 'bold', 'bulletList', 'codeBlock',
                            'h2', 'h3', 'italic', 'link', 'orderedList', 'redo', 'strike', 'undo',
                        ])->required(),
                    Select::make('category_complaint_id')
                        ->relationship('categories', 'name')
                        // ->createOptionForm([
                        //     Forms\Components\TextInput::make('name')
                        //         ->required(),
                        // ]),
                ]),
                Section::make('Actions')->schema([
                    Select::make('status')
                    ->options([
                        'Waiting' => 'Waiting',
                        'Approved' => 'Approved',
                        'Decline' => 'Decline',
                        'Finish' => 'Finish'
                    ])->default('Waiting'),
                                RichEditor::make('notes')->label('Notes')
                                ->placeholder('')
                                ->toolbarButtons([
                                    'attachFiles', 'blockquote', 'bold', 'bulletList', 'codeBlock',
                                    'h2', 'h3', 'italic', 'link', 'orderedList', 'redo', 'strike', 'undo',
                                ])
                                ])
                        ->visible(fn ($livewire, $get) => $livewire instanceof EditComplaints),
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
                        Tables\Columns\ImageColumn::make('images')
                        ->getStateUsing(function (Model $record) {
                            if ($record->images) {
                                $thumb = $record->images;
                                return $thumb[0];
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
                            Stack::make([
                            TextColumn::make('created_at')->sortable()->date()->color('primary')->sortable()
                                ->extraAttributes([
                                    'class' => 'mt-2 text-primary-500 dark:text-primary-500 text-xs'
                                ]),
                            TextColumn::make('categories.name')
                                ->extraAttributes([
                                    'class' => 'mt-1 text-gray-300 font-bold dar1:text-gray-300 text-xs'
                                ]),
                            ]),
                            BadgeColumn::make('status')->alignRight()
                            ->colors([
                                'secondary' => 'Waiting',
                                'warning' => 'Approved',
                                'success' => 'Finish',
                                'danger' => 'Decline',
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
                SelectFilter::make('category_complaint_id')
                ->label('Category')
                ->relationship('categories', 'name'),
                SelectFilter::make('status')
                ->label('Status')
                    ->options([
                        'Waiting' => 'Waiting',
                        'Approved' => 'Approved',
                        'Decline' => 'Decline',
                        'Finish' => 'Finish'
                    ])
                    // ->default('Waiting'),

            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Action'),
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
                //         ->options(StatusComplaints::all()->pluck('name', 'id')),
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
            'index' => Pages\ListComplaints::route('/'),
            'create' => Pages\CreateComplaints::route('/create'),
            'edit' => Pages\EditComplaints::route('/{record}/edit'),
            'view' => Pages\ViewComplaints::route('/{record}')
        ];
    }
}
