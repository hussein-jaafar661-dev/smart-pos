<?php

namespace App\Filament\Resources\UnitConversions\Pages;

use App\Filament\Resources\UnitConversions\UnitConversionResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\ValidationException;
use Modules\Company\Models\Company;
use Modules\Inventory\Exceptions\InvalidUnitConversionException;
use Modules\Inventory\Services\UnitConversionService;

class CreateUnitConversion extends CreateRecord
{
    protected static string $resource = UnitConversionResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $user = auth()->user();

        $unitConversionService = app(UnitConversionService::class);

        try {
            if ($user->company_id === null) {
                $company = Company::findOrFail($data['company_id']);

                unset($data['company_id']);

                return $unitConversionService->create($company, $data);
            }

            $company = $user->company;

            return $unitConversionService->create($company, $data);

        }catch (InvalidUnitConversionException $e) {
    throw ValidationException::withMessages([
        'data.from_unit_id' => $e->getMessage(),
    ]);
}
    }
}
