<?php

namespace Modules\Company\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Company\Models\Company;

// use Modules\Company\Database\Factories\CompanySettingFactory;

class CompanySetting extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'company_id',
        'language',
        'timezone',
        'currency_code',
        'currency_symbol',
        'decimal_places',
        'date_format',
        'time_format',
        
        'favicon',
       
        'invoice_footer'
    ];

    // protected static function newFactory(): CompanySettingFactory
    // {
    //     // return CompanySettingFactory::new();
    // }
    public function company()
{
    return $this->belongsTo(Company::class);
}
}
