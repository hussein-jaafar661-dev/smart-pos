<?php

namespace App\Filament\Resources\UnitConversions\Pages;

use App\Filament\Resources\UnitConversions\UnitConversionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\ValidationException;
use Modules\Inventory\Exceptions\InvalidUnitConversionException;
use Modules\Inventory\Services\UnitConversionService;

class EditUnitConversion extends EditRecord
{
    protected static string $resource = UnitConversionResource::class;

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $unitConversionService = app(UnitConversionService::class);

        try {
            return $unitConversionService->update($record, $data);
        } catch (InvalidUnitConversionException $e) {
            throw ValidationException::withMessages([
                'data.from_unit_id' => $e->getMessage(),
            ]);
        }
    }

    protected function getHeaderActions(): array
    {
        return [
        
DeleteAction::make()
    ->action(function (Model $record) {
        app(UnitConversionService::class)->delete($record);
    }),

        ];
    }
}
