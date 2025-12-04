<?php

namespace App\Filament\Admin\Resources\Surveys\Schemas;

use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class SurveyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('overall')
                    ->required()
                    ->options([
                        5 => '5 - Excellent',
                        4 => '4 - Very Good',
                        3 => '3 - Good',
                        2 => '2 - Bad',
                        1 => '1 - Very Bad',
                    ]),
                Select::make('reason')
                    ->required()
                    ->options([
                        'To update my personal or professional information' => 'To update my personal or professional information',
                        'To complete the alumni tracer survey' => 'To complete the alumni tracer survey',
                        'To search for fellow alumni in the directory' => 'To search for fellow alumni in the directory',
                        'To verify alumni information (for employment or academic purposes)' => 'To verify alumni information (for employment or academic purposes)',
                        'To donate or explore ways to support the institution' => 'To donate or explore ways to support the institution',
                    ]),
                Textarea::make('comment')
                    ->rows(4)
                    ->maxLength(100)
                    ->reactive(),
                Hidden::make('date_surveyed')
                    ->default(date('Y-m-d'))
                    ->required()
                    ->dehydrated(fn($state, $context) => $context === 'create')
            ]);
    }
}
