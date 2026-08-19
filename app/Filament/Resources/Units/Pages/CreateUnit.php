<?php

namespace App\Filament\Resources\Units\Pages;

use App\Filament\Resources\Units\UnitResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Modules\Company\Models\Company;
use Modules\Inventory\Services\UnitService;

class CreateUnit extends CreateRecord
{
    protected static string $resource = UnitResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $user = auth()->user();

        $unitService = app(UnitService::class);

        if ($user->company_id === null) {

            if ($data['scope'] === 'system') {
                unset($data['scope']);

                return $unitService->createSystemUnit($data);
            }

            $company = Company::findOrFail($data['company_id']);

            unset($data['scope'], $data['company_id']);

            return $unitService->createCompanyUnit($company, $data);
        }

        $company = $user->company;

        unset($data['scope']);

        return $unitService->createCompanyUnit($company, $data);
    }
}
