<?php

namespace Modules\Inventory\Services;

use Modules\Company\Models\Company;
use Modules\Inventory\Models\Unit;
use Modules\Inventory\Models\UnitConversion;
use Modules\Inventory\Exceptions\InvalidUnitForCompanyException;
use Modules\Inventory\Exceptions\InvalidUnitConversionException;

class UnitConversionService
{
    public function create(Company $company, array $data): UnitConversion
    {
        $data['company_id'] = $company->id;

      $fromUnit = Unit::query()
    ->findOrFail($data['from_unit_id']);

$this->validateUnitForCompany($fromUnit, $company);

$toUnit = Unit::query()
    ->findOrFail($data['to_unit_id']);

$this->validateUnitForCompany($toUnit, $company);



if ($fromUnit->id === $toUnit->id) {
    throw new InvalidUnitConversionException(
        'The from unit and to unit must be different.'
    );
}
if ($data['factor'] <= 0) {
    throw new InvalidUnitConversionException(
        'The conversion factor must be greater than zero.'
    );
}
$exists = UnitConversion::query()
    ->where('company_id', $company->id)
    ->where('from_unit_id', $fromUnit->id)
    ->where('to_unit_id', $toUnit->id)
    ->exists();

if ($exists) {
    throw new InvalidUnitConversionException(
        'This unit conversion already exists.'
    );
}
return UnitConversion::create($data);
    }
    public function update( UnitConversion $conversion, array $data): UnitConversion{
        $company = $conversion->company;
        $fromUnit = Unit::query()
    ->findOrFail($data['from_unit_id']);
    $this->validateUnitForCompany($fromUnit, $company);
$toUnit = Unit::query()
    ->findOrFail($data['to_unit_id']);
    $this->validateUnitForCompany($toUnit, $company);
    
if ($fromUnit->id === $toUnit->id) {
    throw new InvalidUnitConversionException(
        'The from unit and to unit must be different.'
    );
}
if ($data['factor'] <= 0) {
    throw new InvalidUnitConversionException(
        'The conversion factor must be greater than zero.'
    );
}
 $exists = UnitConversion::query()
        ->where('company_id', $company->id)
        ->where('from_unit_id', $fromUnit->id)
        ->where('to_unit_id', $toUnit->id)
        ->where('id', '!=', $conversion->id)
        ->exists();

    if ($exists) {
        throw new InvalidUnitConversionException(
            'This unit conversion already exists.'
        );
    }
$conversion->update([
    'from_unit_id' => $data['from_unit_id'],
    'to_unit_id' => $data['to_unit_id'],
    'factor' => $data['factor'],
]);
return $conversion->refresh();/*بعد update()، الـ Model موجود أصلًا في الذاكرة.

refresh() يعيد تحميله من قاعدة البيانات، فنضمن أن القيمة التي نرجعها هي آخر نسخة فعلية من السجل
   */     
    }

    public function delete(
   
    UnitConversion $conversion
): void
{
    
$conversion->delete();
}
    private function validateUnitForCompany(Unit $unit,Company $company): void
{
    if (
        $unit->company_id !== null &&
        $unit->company_id !== $company->id
    ) {
        throw new InvalidUnitForCompanyException(
            'The selected unit does not belong to this company.'
        );
    }

    if (! $unit->is_active) {
        throw new InvalidUnitForCompanyException(
            'The selected unit is inactive.'
        );
    }
}
}