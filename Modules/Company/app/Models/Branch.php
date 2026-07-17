<?php

namespace Modules\Company\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Company\Models\Company;
use Illuminate\Database\Eloquent\SoftDeletes;
// use Modules\Company\Database\Factories\BranchFactory;

class Branch extends Model
{
    use HasFactory,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
       'company_id',
        //'code',
        'phone',
        'email',
        'address',
        'city',
        'state',
        'country',
        'postal_code',
        'notes'
    ];
    protected $casts = [
        'is_active' => 'boolean',
        'is_main' => 'boolean',
    ];

    // protected static function newFactory(): BranchFactory
    // {
    //     // return BranchFactory::new();
    // }
    public function company(){ 
        return$this->belongsTo(Company::class);//Company::classتشير الىModules\Company\Models\Company
    }
}
