<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create a role user
        \App\Models\RoleUser::create([
            'user_id' => 1,
            'role_id' => 1,
        ]);

        \App\Models\RoleUser::create([
            'user_id' => 1,
            'role_id' => 2,
        ]);

        \App\Models\RoleUser::create([
            'user_id' => 2,
            'role_id' => 2,
        ]);
    }
}
