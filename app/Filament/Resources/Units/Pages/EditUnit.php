<?php

namespace App\Filament\Resources\Units\Pages;

use App\Filament\Resources\Units\UnitResource;
use Filament\Actions\DeleteAction;
//use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Modules\Inventory\Services\UnitService;

class EditUnit extends EditRecord
{
    protected static string $resource = UnitResource::class;
    protected function handleRecordUpdate(Model $record, array $data): Model
{
    $unitService = app(UnitService::class);

    return $unitService->update($record, $data);
}

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()
    ->action(function (UnitService $unitService, Model $record) {
        $unitService->delete($record);
    }),
          //  ForceDeleteAction::make(),
           RestoreAction::make()
    ->action(function (UnitService $unitService, Model $record) {
        $unitService->restore($record);
    }),
        ];
    }
}
