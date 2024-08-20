<?php

namespace Database\Seeders;

use App\Models\Leave;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LeaveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Leave::create([
            'user_id' => 1,
            'company_id' => 1,
            'leave_type_id' => 1,
            'start_date' => '2024-08-01',
            'end_date' => '2024-08-03',
            'is_half_day' => false,
            'total_days' => 3,
            'is_paid' => true,
            'reason' => 'sick',
            'status' => 'pending',
        ]);
    }
}
