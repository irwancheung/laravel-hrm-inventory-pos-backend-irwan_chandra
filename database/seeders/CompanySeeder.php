<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Company::create([
            'name' => 'iC Company',
            'email' => 'irwancheung@gmail.com',
            'phone' => '08123456789',
            'website' => 'irwancheung.com',
            'logo' => 'https://lh3.googleusercontent.com/a/ACg8ocL7pN6wGWIwENLyEsLIH0ghi4E8L5pYuRh5En2LQfU40Jwenmr0=s317-c-no',
            'address' => 'Jl. Gn. Rinjani No.52',
            'status' => 'active',
            'total_users' => 10,
            'clock_in_time' => '09:00:00',
            'clock_out_time' => '18:00:00',
            'early_clock_in_time' => 15,
            'allow_clock_out_until' => 15,
            'self_clocking' => 1
        ]);
    }
}
