<?php

namespace App\Filament\Admin\Resources\Colleges;

use App\Filament\Admin\Resources\Colleges\Pages\CreateCollege;
use App\Filament\Admin\Resources\Colleges\Pages\EditCollege;
use App\Filament\Admin\Resources\Colleges\Pages\ListColleges;
use App\Filament\Admin\Resources\Colleges\Schemas\CollegeForm;
use App\Filament\Admin\Resources\Colleges\Tables\CollegesTable;
use App\Models\College;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CollegeResource extends Resource
{
    protected static ?string $model = College::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::BuildingLibrary;

    public static function form(Schema $schema): Schema
    {
        return CollegeForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CollegesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListColleges::route('/'),
            'create' => CreateCollege::route('/create'),
            'edit' => EditCollege::route('/{record}/edit'),
        ];
    }
}
