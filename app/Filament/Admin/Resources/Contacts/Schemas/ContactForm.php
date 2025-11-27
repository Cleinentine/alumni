<?php

namespace App\Filament\Admin\Resources\Contacts\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ContactForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('contact_email')
                    ->email()
                    ->required(),
                TextInput::make('contact_number')
                    ->tel()
                    ->rules(['phone:INTERNATIONAL,PH'])
                    ->required(),
                TextInput::make('alternate_contact_number')
                    ->tel()
                    ->rules(['phone:INTERNATIONAL,PH'])
                    ->required()
            ]);
    }
}
