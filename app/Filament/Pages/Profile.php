<?php

namespace App\Filament\Pages;

use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use RyanChandler\FilamentProfile\Pages\Profile as BaseProfile;

class Profile extends BaseProfile
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected function getTitle(): string {
        return __('Login credentials');
    }

    protected function getBreadcrumbs(): array
    {
        return [
            url()->current() => __('Login credentials'),
        ];
    }

    protected static function getNavigationGroup(): ?string
    {
        return __('Account');
    }

    protected static function getNavigationLabel(): string
	{
		return __('Login credentials');
	}

    protected function getFormSchema(): array
    {
        return [
            Section::make(__('General'))
                ->columns(2)
                ->schema([
                    TextInput::make('name')
                        ->label(__('Name'))
                        ->required(),
                    TextInput::make('email')
                        ->label(__('Email address'))
                        ->required(),
                ]),
            Section::make(__('Update Password'))
                ->columns(2)
                ->schema([
                    TextInput::make('current_password')
                        ->label(__('Current Password'))
                        ->password()
                        ->rules(['required_with:new_password'])
                        ->currentPassword()
                        ->autocomplete('off')
                        ->columnSpan(1),
                    Grid::make()
                        ->schema([
                            TextInput::make('new_password')
                                ->label(__('New Password'))
                                ->password()
                                ->rules(['confirmed'])
                                ->autocomplete('new-password'),
                            TextInput::make('new_password_confirmation')
                                ->label(__('Confirm Password'))
                                ->password()
                                ->rules([
                                    'required_with:new_password',
                                ])
                                ->autocomplete('new-password'),
                        ]),
                ]),
        ];
    }

}
