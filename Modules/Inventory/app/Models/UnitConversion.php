<?php

namespace Modules\Inventory\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Company\Models\Company;


// use Modules\Inventory\Database\Factories\UnitConversionFactory;

class UnitConversion extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'company_id',
        'from_unit_id',
        'to_unit_id',
        'factor',
    ];

    // protected static function newFactory(): UnitConversionFactory
    // {
    //     // return UnitConversionFactory::new();
    // }

    public function company(): BelongsTo
{
    return $this->belongsTo(Company::class);
}
public function fromUnit(): BelongsTo
{
    return $this->belongsTo(Unit::class, 'from_unit_id');
    
}
public function toUnit(): BelongsTo
{
    return $this->belongsTo(Unit::class, 'to_unit_id');
}
}