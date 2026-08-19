<?php

namespace Modules\Inventory\Services;
use Modules\Inventory\Models\Unit;
use Modules\Company\Models\Company;

class UnitService
{
   public function createCompanyUnit(Company $company, array $data): Unit
{
    $unit = new Unit($data);

    $unit->company_id = $company->id;
    $unit->is_system = false;

    $unit->save();

    return $unit;
}
public function createSystemUnit(array $data): Unit
{
    $unit = new Unit($data);

    $unit->company_id = null;
    $unit->is_system = true;

    $unit->save();

    return $unit;
}
    public function update(Unit $unit, array $data): Unit
    {
        $unit->update($data);
        return $unit;
    }
    public function delete(Unit $unit): void
    {
        $unit->delete();
    }
    public function restore(Unit $unit): Unit
{
    $unit->restore();

    return $unit;
}
}
