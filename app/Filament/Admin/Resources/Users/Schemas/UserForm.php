<?php

namespace App\Filament\Admin\Resources\Users\Schemas;

use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('email')
                    ->email()
                    ->required(),
                TextInput::make('phone')
                    ->tel()
                    ->rules(['phone:INTERNATIONAL,PH']),
                TextInput::make('password')
                    ->password()
                    ->revealable()
                    ->nullable()

                    // Only required on Create
                    ->required(fn (string $context) => $context === 'create')

                    // Only update if not empty (Edit only)
                    ->dehydrated(
                        fn ($state, string $context) => $context === 'edit' && filled($state)
                    )

                    // Hash only when updating/saving
                    ->dehydrateStateUsing(
                        fn ($state) => filled($state) ? Hash::make($state) : null
                    ),
                Hidden::make('role')
                    ->default(2) // for example
                    ->dehydrated(),
            ]);
    }
}
