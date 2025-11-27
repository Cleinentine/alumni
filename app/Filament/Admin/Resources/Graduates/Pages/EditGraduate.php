<?php

namespace App\Filament\Admin\Resources\Graduates\Pages;

use App\Filament\Admin\Resources\Graduates\GraduateResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Filament\Forms\Components\TextInput;

class EditGraduate extends EditRecord
{
    protected static string $resource = GraduateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
