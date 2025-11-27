<?php

namespace App\Filament\Admin\Resources\Colleges\Schemas;

use App\Models\College;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CollegeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->regex('/^[a-zA-Z0-9_ ]+$/')
                    ->unique(College::class, 'name')
                    ->rule('exists:colleges,name'),
            ]);
    }
}
