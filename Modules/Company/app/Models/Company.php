<?php

namespace Modules\Company\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Company\Models\Branch;
use Modules\Company\Models\BusinessType;
use Modules\Company\Models\CompanySetting;
use Illuminate\Database\Eloquent\SoftDeletes;
// use Modules\Company\Database\Factories\CompanyFactory;

class Company extends Model
{
    use HasFactory,SoftDeletes;
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'code',
        'name',
        'legal_name',
        'commercial_register',
        'business_type_id',
        'tax_number',
        'email',
        'phone',
        'website',
        'logo',
        'address',
        'city',
        'state',
        'country',
        'postal_code'
    ];
    protected $casts = [
        'is_active' => 'boolean',
    ];

    // protected static function newFactory(): CompanyFactory
    // {
    //     // return CompanyFactory::new();
    // }
    public function branches(){
        return $this->hasMany(Branch::class);
    
        }
        public function settings()
{
    return $this->hasOne(CompanySetting::class);
}
public function businessType()
{
    return $this->belongsTo(BusinessType::class);
}
}
