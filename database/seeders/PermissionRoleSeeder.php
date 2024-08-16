<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create 6 permission roles where role_id is always 1, and permission_id from 1 to 5
        for ($i = 0; $i < 6; $i++) {
            \App\Models\PermissionRole::create([
                'role_id' => 1,
                'permission_id' => $i + 1
            ]);
        }
    }
}
