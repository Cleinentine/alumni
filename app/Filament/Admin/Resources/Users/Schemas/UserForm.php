<?php

namespace App\Filament\Admin\Resources\Users\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

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
                    ->required(),
                TextInput::make('role')
                    ->numeric()
                    ->rules('numeric', 'min:0', 'max:3')
                    ->extraAttributes([
                        'type' => 'number',
                        'min' => 0,
                        'max' => 3
                    ])
                    ->hidden(fn($get) => $get('id'))
            ]);
    }
}
