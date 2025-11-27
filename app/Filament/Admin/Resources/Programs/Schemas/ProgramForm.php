<?php

namespace App\Filament\Admin\Resources\Programs\Schemas;

use App\Models\Program;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ProgramForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->regex('/^[a-zA-Z0-9_ ]+$/')
                    ->unique(Program::class, 'name')
                    ->rule('exists:programs,name'),
                Select::make('college_id')
                    ->required()
                    ->label('College')
                    ->options(\App\Models\College::pluck('name', 'id'))
                    ->searchable(),
            ]);
    }
}
