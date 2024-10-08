<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ShiftSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create morning shift
        \App\Models\Shift::create([
            'company_id' => 1,
            'created_by' => 1,
            'name' => 'Morning Shift',
            'clock_in_time' => '08:00:00',
            'clock_out_time' => '16:00:00',
        ]);

        // create afternoon shift
        \App\Models\Shift::create([
            'company_id' => 1,
            'created_by' => 1,
            'name' => 'Afternoon Shift',
            'clock_in_time' => '16:00:00',
            'clock_out_time' => '00:00:00',
        ]);
    }
}
