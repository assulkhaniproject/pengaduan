<?php

namespace App\Filament\Pages;

use DateTime;
use Filament\Pages\Page;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Illuminate\Support\Facades\Date;
use Filament\Forms\Components\DatePicker;
use Illuminate\Support\Facades\Hash;
use RyanChandler\FilamentProfile\Pages\Profile as BaseProfile;

class Profile extends BaseProfile
{
    protected static ?string $navigationIcon = 'heroicon-o-user';

    // protected static string $view = 'filament.pages.profile';

    public $name;
    public $email;
    public $nik;
    public $alamat;
    public $tgl_lahir;
    public $current_password;
    public $new_password;
    public $new_password_confirmation;

    public function mount()
    {
        $this->form->fill([
            'name' => auth()->user()->name,
            'email' => auth()->user()->email,
            'nik' => auth()->user()->nik,
            'alamat' => auth()->user()->alamat,
            'tgl_lahir' => auth()->user()->tgl_lahir,
            'avatar' => auth()->user()->avatar,

        ]);
    }

    public function submit()
    {
        $this->form->getState();

        //dd($this->form->getState());
        $state = array_filter([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->new_password ? Hash::make($this->new_password) : null,
            'avatar' => $this->form->getState()['avatar'],
            'nik' => $this->form->getState()['nik'],
            'alamat' => $this->form->getState()['alamat'],
            'tgl_lahir' => $this->form->getState()['tgl_lahir'],
        ]);

        //dd(auth()->user());
        auth()->user()->update($state);

        $this->reset(['current_password', 'new_password', 'new_password_confirmation']);
        $this->notify('success', 'Your profile has been updated.');

        return redirect()->route('filament.pages.dashboard');
    }

    public function getCancelButtonUrlProperty()
    {
        return static::getUrl();
    }

    protected function getBreadcrumbs(): array
    {
        return [
            url()->current() => 'Profile',
        ];
    }

    protected function getFormSchema(): array
    {
        return [
            Section::make('Photo')->schema([
                FileUpload::make('avatar')
                    ->label('Foto Profil')
                    ->disk('public')
                    ->directory('User/Avatar')
                    ->avatar()
            ]),

            Section::make('Profile')->schema([
                Grid::make()->schema([
                    TextInput::make('name')
                        ->required(),
                    TextInput::make('email')
                        ->label('Email Address')
                        ->required(),
                ])->columns(2)
            ]),

            Section::make('Detail')->schema([
                Grid::make()->schema([
                    TextInput::make('nik')->maxLength(16)->numeric()->required(),
                    Textarea::make('alamat'),
                    DatePicker::make('tgl_lahir'),

                ])->columns(1)
            ]),
            Section::make('Update Password')
                ->columns(2)
                ->schema([
                    Grid::make()
                        ->schema([
                            TextInput::make('current_password')
                                ->label('Current Password')
                                ->password()
                                ->rules(['required_with:new_password'])
                                ->currentPassword()
                                ->autocomplete('off')
                                ->columnSpan(1),
                            TextInput::make('new_password')
                                ->label('New Password')
                                ->password()
                                ->rules(['confirmed'])
                                ->autocomplete('new-password'),
                            TextInput::make('new_password_confirmation')
                                ->label('Confirm Password')
                                ->password()
                                ->rules([
                                    'required_with:new_password',
                                ])
                                ->autocomplete('new-password'),
                        ])->columns(3),
                ]),

        ];
    }
}
