<?php

namespace App\Filament\Admin\Resources\Feedback;

use App\Filament\Admin\Resources\Feedback\Pages\CreateFeedback;
use App\Filament\Admin\Resources\Feedback\Pages\EditFeedback;
use App\Filament\Admin\Resources\Feedback\Pages\ListFeedback;
use App\Filament\Admin\Resources\Feedback\Schemas\FeedbackForm;
use App\Filament\Admin\Resources\Feedback\Tables\FeedbackTable;
use App\Models\Feedback;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class FeedbackResource extends Resource
{
    protected static ?string $model = Feedback::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::ChatBubbleLeft;

    public static function form(Schema $schema): Schema
    {
        return FeedbackForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FeedbackTable::configure($table);
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
            'index' => ListFeedback::route('/'),
            'create' => CreateFeedback::route('/create'),
            'edit' => EditFeedback::route('/{record}/edit'),
        ];
    }

    public static function redirectAfterCreate($record): string
    {
        return route('filament.resources.feedbacks.edit', ['record' => $record->graduate_id]);
    }
}
