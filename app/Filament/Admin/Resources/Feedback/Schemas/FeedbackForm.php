<?php

namespace App\Filament\Admin\Resources\Feedback\Schemas;

use App\Models\Graduate;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class FeedbackForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('graduate_id')
                    ->label('Alumni')
                    ->required()
                    ->options(function () {
                        return Graduate::all()->mapWithKeys(function ($user) {
                            // Concatenate first_name and last_name to display the full name
                            $fullName = $user->first_name . ' ' . $user->last_name;

                            return [$user->id => $fullName];  // Use user ID as the key
                        });
                    })
                    ->searchable(),
                Select::make('relevance')
                    ->label('Curriculum Relevance')
                    ->required()
                    ->options([
                        5 => '5 - Excellent',
                        4 => '4 - Very Good',
                        3 => '3 - Good',
                        2 => '2 - Bad',
                        1 => '1 - Very Bad',
                    ]),
                Select::make('skills')
                    ->label('Skills Acquired')
                    ->required()
                    ->options([
                        5 => '5 - Excellent',
                        4 => '4 - Very Good',
                        3 => '3 - Good',
                        2 => '2 - Bad',
                        1 => '1 - Very Bad',
                    ]),
                Select::make('competency')
                    ->required()
                    ->options([
                        5 => '5 - Excellent',
                        4 => '4 - Very Good',
                        3 => '3 - Good',
                        2 => '2 - Bad',
                        1 => '1 - Very Bad',
                    ]),
                Select::make('post_graduate')
                    ->label('Pursued Further Education')
                    ->required()
                    ->options([
                        'Yes' => 'Yes',
                        'No' => 'No'
                    ]),
                Select::make('engagement')
                    ->label('Engagement with University')
                    ->required()
                    ->options([
                        'Yes' => 'Yes',
                        'No' => 'No'
                    ]),
                Select::make('entrepreneurship')
                    ->required()
                    ->options([
                        'Yes' => 'Yes',
                        'No' => 'No'
                    ]),
                Textarea::make('suggestions')
                    ->nullable()
                    ->maxLength(100),
                Hidden::make('date_submitted')
                    ->default(date('y-m-d')),
            ]);
    }
}
