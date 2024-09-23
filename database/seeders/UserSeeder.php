<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name'  => 'Super Admin',
            'username' => 'superadmin',
            'profile_image' => 'https://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50',
            'email' => 'superadmin@admin.com',
            'password' => Hash::make('12345678'),
            'shift_id'  => null,
            'department_id'  => null,
            'designation_id'  => null,
            'status' => 'enable',
            'role_id' => Role::where('name', 'admin')->first()->id,
            'phone' => '0812345678',
            'address' => 'Jakarta Barat, DKI Jakarta, Indonesia',
            'company_id' => 1,
            'is_superadmin' => true,
            'user_type' => 'employee',
            'login_enabled' => true,
        ]);

        User::factory()->create([
            'name'  => 'Irwan Chandra',
            'username' => 'irwancheung',
            'profile_image' => 'https://www.gravatar.com/avatar/215e460b479e2e5b48aec07710c08d50',
            'email' => 'irwancheung@gmail.com',
            'password' => Hash::make('12345678'),
            'shift_id'  => null,
            'department_id'  => null,
            'designation_id'  => null,
            'status' => 'enable',
            'role_id' => Role::where('name', 'admin')->first()->id,
            'phone' => '0812345678',
            'address' => 'Jakarta Barat, DKI Jakarta, Indonesia',
            'company_id' => 1,
            'is_superadmin' => true,
            'user_type' => 'employee',
            'login_enabled' => true,
        ]);
    }
}
