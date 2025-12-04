<?php

namespace App\Filament\Admin\Resources\Feedback\Pages;

use App\Filament\Admin\Resources\Feedback\FeedbackResource;
use Filament\Resources\Pages\CreateRecord;

class CreateFeedback extends CreateRecord
{
    protected static string $resource = FeedbackResource::class;
    protected static string $recordRouteKeyName = 'graduate_id';
}
