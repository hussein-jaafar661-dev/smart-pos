<?php

namespace Modules\Company\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Company\Models\Company;

// use Modules\Company\Database\Factories\BusinessTypeFactory;

class BusinessType extends Model
{
    
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'code',
        'name',
        'description',
        'is_active'
    ];

    // protected static function newFactory(): BusinessTypeFactory
    // {
    //     // return BusinessTypeFactory::new();
    // }
    public function companies()
{
    return $this->hasMany(Company::class);
}
}
