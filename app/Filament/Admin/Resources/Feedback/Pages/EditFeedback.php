<?php

namespace App\Filament\Admin\Resources\Feedback\Pages;

use App\Filament\Admin\Resources\Feedback\FeedbackResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditFeedback extends EditRecord
{
    protected static string $resource = FeedbackResource::class;
    protected static string $recordRouteKeyName = 'graduate_id';

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
