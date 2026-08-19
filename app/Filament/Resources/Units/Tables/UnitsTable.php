<?php

namespace App\Filament\Resources\Units\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
//use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Modules\Inventory\Services\UnitService;
use Illuminate\Database\Eloquent\Model;
use Filament\Actions\DeleteAction;
use Modules\Inventory\Models\Unit;

class UnitsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label(__('Name'))
                    ->sortable()
                    ->searchable(),
                TextColumn::make('symbol')
                    ->label(__('Symbol'))
                    ->sortable()
                    ->searchable(),
                TextColumn::make('unit_type')
                    ->label(__('Unit Type'))
                    ->sortable()
                    ->searchable(),
                TextColumn::make('company.name')
                    ->label(__('Company'))
                    ->state(
                            fn (Unit $record) =>
                                $record->company_id === null
                                    ? __('System')
                                    : $record->company?->name
                        )// إذا كانت الوحدة نظامية ولا تتبع أي شركة، نعرض "System".
                    // وإذا كانت تابعة لشركة، نعرض اسم الشركة.
                    ->sortable()
                    ->searchable(),
                    IconColumn::make('is_active')
    ->label(__('Active'))
    ->boolean(),
   TextColumn::make('deleted_at')
    ->label(__('Deleted At'))
    ->dateTime()
    ->placeholder('-'),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make()
                    ->action(function (UnitService $unitService, Model $record) {
                        $unitService->delete($record);
                    }),            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                 //   ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
