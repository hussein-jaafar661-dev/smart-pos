<?php

namespace Modules\Identity\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Identity\Models\User;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::firstOrCreate(
            ['username' => 'admin'],
            [
                'company_id' => null,
                'branch_id' => null,
                'name' => 'Super Admin',
                'email' => 'admin@smartpos.local',
                'phone' => null,
                'password' => 'admin123',
                'is_active' => true,
                'last_login_at' => null,
            ]
        );

        $user->assignRole('Super Admin');
    }
}