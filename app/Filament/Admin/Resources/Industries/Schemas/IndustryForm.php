<?php

namespace App\Filament\Admin\Resources\Industries\Schemas;

use App\Models\Industry;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class IndustryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->regex('/^[a-zA-Z0-9_ ]+$/')
                    ->unique(Industry::class, 'name')
                    ->rule('exists:colleges,name'),
            ]);
    }
}
