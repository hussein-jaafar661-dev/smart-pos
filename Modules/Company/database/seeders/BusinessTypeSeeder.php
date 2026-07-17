<?php

namespace Modules\Company\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Company\Models\BusinessType;

class BusinessTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
     public function run(): void
    {
        $businessTypes = [
            [
                'code' => 'RETAIL',
                'name' => 'Retail Store',
                'description' => 'General retail store',
                'is_active' => true,
            ],
            [
                'code' => 'SUPERMARKET',
                'name' => 'Supermarket',
                'description' => 'Supermarket and grocery',
                'is_active' => true,
            ],
            [
                'code' => 'PHARMACY',
                'name' => 'Pharmacy',
                'description' => 'Pharmacy and medical store',
                'is_active' => true,
            ],
            [
                'code' => 'RESTAURANT',
                'name' => 'Restaurant',
                'description' => 'Restaurant and food services',
                'is_active' => true,
            ],
            [
                'code' => 'CAFE',
                'name' => 'Cafe',
                'description' => 'Coffee shop and cafe',
                'is_active' => true,
            ],
            [
                'code' => 'BAKERY',
                'name' => 'Bakery',
                'description' => 'Bakery and pastry shop',
                'is_active' => true,
            ],
            [
                'code' => 'CLOTHING',
                'name' => 'Clothing Store',
                'description' => 'Fashion and clothing',
                'is_active' => true,
            ],
            [
                'code' => 'ELECTRONICS',
                'name' => 'Electronics Store',
                'description' => 'Electronics and devices',
                'is_active' => true,
            ],
        ];

        foreach ($businessTypes as $businessType) {
            BusinessType::firstOrCreate(
                ['code' => $businessType['code']],
                $businessType
            );
        }
    }
}
