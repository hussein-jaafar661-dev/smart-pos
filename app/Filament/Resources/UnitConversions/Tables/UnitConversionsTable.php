<?php

namespace App\Filament\Resources\UnitConversions\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class UnitConversionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('company.name')
                    ->label(__('Company'))
                    ->searchable()
                    ->sortable(),

                TextColumn::make('fromUnit.name')
                    ->label(__('From Unit'))
                    ->searchable()
                    ->sortable(),

                TextColumn::make('toUnit.name')
                    ->label(__('To Unit'))
                    ->searchable()
                    ->sortable(),

                TextColumn::make('factor')
                    ->label(__('Conversion Factor'))
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}