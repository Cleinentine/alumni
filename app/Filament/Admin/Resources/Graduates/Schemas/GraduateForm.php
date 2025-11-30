<?php

namespace App\Filament\Admin\Resources\Graduates\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class GraduateForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('first_name')
                    ->required()
                    ->regex('/^[a-zA-Z0-9_ ]+$/'),
                TextInput::make('middle_name')
                    ->nullable()
                    ->regex('/^[a-zA-Z0-9_ ]+$/'),
                TextInput::make('last_name')
                    ->required()
                    ->regex('/^[a-zA-Z0-9_ ]+$/'),
                DatePicker::make('birth_date')
                    ->required(),
                Select::make('gender')
                    ->required()
                    ->options([
                        'Male' => 'Male',
                        'Female' => 'Female',
                    ]),
                TextInput::make('year_graduated')
                    ->required()
                    ->numeric()
                    ->minValue(1960)
                    ->maxValue(date('Y')),
                Select::make('program_id')
                    ->required()
                    ->label('Program')
                    ->options(\App\Models\Program::pluck('name', 'id'))
                    ->searchable(),
                Select::make('country_id')
                    ->label('Country')
                    ->options(function () {
                        return DB::table('countries')->pluck('name', 'id');
                    })
                    ->searchable()
                    ->reactive() // important for dependent selects
                    ->required()
                    ->afterStateUpdated(fn ($state, callable $set) => $set('state_id', null)), // reset dependent

                Select::make('state_id')
                    ->label('State')
                    ->options(function (callable $get) {
                        $countryId = $get('country_id');
                        if (! $countryId) {
                            return [];
                        }

                        return DB::table('states')->where('country_id', $countryId)->pluck('name', 'id');
                    })
                    ->searchable()
                    ->reactive()
                    ->afterStateUpdated(fn ($state, callable $set) => $set('city_id', null)),

                Select::make('city_id')
                    ->label('City')
                    ->options(function (callable $get) {
                        $stateId = $get('state_id');
                        if (! $stateId) {
                            return [];
                        }

                        return DB::table('cities')->where('state_id', $stateId)->pluck('name', 'id');
                    })
                    ->reactive()
                    ->searchable(),

                Section::make('Account')
                    ->relationship('user') // ties it to the related user table
                    ->schema([
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
                            ->default(3) // for example
                            ->dehydrated(),
                    ]),

                Section::make('Employment')
                    ->relationship('employment') // ties it to the related user table
                    ->schema([
                        TextInput::make('title')
                            ->nullable()
                            ->reactive(),
                        TextInput::make('company')
                            ->nullable()
                            ->reactive(),
                        Select::make('industry_id')
                            ->label('Industry')
                            ->options(\App\Models\Industry::pluck('name', 'id'))
                            ->reactive()
                            ->searchable(),
                        Select::make('status')
                            ->required()
                            ->reactive()
                            ->options([
                                'Full-time' => 'Full-time',
                                'Part-time' => 'Part-time',
                                'Temporary/Seasonal' => 'Temporary/Seasonal',
                                'Self-Employed' => 'Self-Employed',
                                'Unemployed' => 'Unemployed',
                            ])
                            ->afterStateUpdated(function ($state, $set) {
                                if ($state === 'Unemployed') {
                                    // Clear other fields
                                    $set('title', null);
                                    $set('company', null);
                                    $set('industry_id', null);
                                    $set('search_methods', null);
                                    $set('country_id', null);
                                    $set('state_id', null);
                                    $set('city_id', null);
                                } else {
                                    $set('unemployment', null);
                                }
                            }),
                        Select::make('search_methods')
                            ->label('Search Methods')
                            ->reactive()
                            ->options([
                                'JobStreet' => 'JobStreet',
                                'LinkedIn' => 'LinkedIn',
                                'Indeed' => 'Indeed',
                                'Kalibrr' => 'Kalibrr',
                                'PhilJobNet' => 'PhilJobNet',
                                'Others' => 'Others',
                            ]),
                        Select::make('country_id')
                            ->label('Country')
                            ->options(function () {
                                return DB::table('countries')->pluck('name', 'id');
                            })
                            ->searchable()
                            ->reactive() // important for dependent selects
                            ->afterStateUpdated(fn ($state, callable $set) => $set('state_id', null)), // reset dependent

                        Select::make('state_id')
                            ->label('State')
                            ->options(function (callable $get) {
                                $countryId = $get('country_id');
                                if (! $countryId) {
                                    return [];
                                }

                                return DB::table('states')->where('country_id', $countryId)->pluck('name', 'id');
                            })
                            ->searchable()
                            ->reactive()
                            ->afterStateUpdated(fn ($state, callable $set) => $set('city_id', null)),

                        Select::make('city_id')
                            ->label('City')
                            ->options(function (callable $get) {
                                $stateId = $get('state_id');
                                if (! $stateId) {
                                    return [];
                                }

                                return DB::table('cities')->where('state_id', $stateId)->pluck('name', 'id');
                            })
                            ->reactive()
                            ->searchable(),
                        Textarea::make('unemployment')
                            ->rows(4)
                            ->maxLength(100)
                            ->reactive(),
                    ]),
            ]);
    }
}
