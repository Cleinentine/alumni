<?php

namespace App\Filament\Admin\Resources\Contacts\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ContactsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('contact_email')
                    ->label('Contact Email')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('contact_number')
                    ->label('Contact Number')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('alternate_contact_number')
                    ->label('Alternate Contact Number')
                    ->sortable()
                    ->searchable()
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make()
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
