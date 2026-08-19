<?php

namespace Modules\Inventory\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Inventory\Enums\UnitType;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Company\Models\Company;
// use Modules\Inventory\Database\Factories\UnitFactory;

class Unit extends Model
{
    use HasFactory,softDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'symbol',
        'unit_type'
    ];

    // protected static function newFactory(): UnitFactory
    // {
    //     // return UnitFactory::new();
    // }
    protected $casts = [
        'unit_type' => UnitType::class,
    ];
    public function company(): BelongsTo
{
    return $this->belongsTo(Company::class);
}
}
