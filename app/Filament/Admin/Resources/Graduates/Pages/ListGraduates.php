<?php

namespace App\Filament\Admin\Resources\Graduates\Pages;

use App\Filament\Admin\Resources\Graduates\GraduateResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListGraduates extends ListRecords
{
    protected static string $resource = GraduateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
