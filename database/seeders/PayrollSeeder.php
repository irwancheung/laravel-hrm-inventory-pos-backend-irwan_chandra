<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PayrollSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create payrolls based on this file 2024_08_20_080850_create_payrolls_table.php
        $payrolls = [
            [
                'user_id' => 1,
                'company_id' => 1,
                'month' => 8,
                'year' => 2024,
                'basic_salary' => 6000000,
                'nett_salary' => 5000000,
                'total_days' => 31,
                'working_days' => 22,
                'present_days' => 20,
                'total_office_time' => 160,
                'total_worked_time' => 150,
                'half_days' => 1,
                'late_days' => 2,
                'paid_leaves' => 2,
                'unpaid_leaves' => 1,
                'holiday_count' => 8,
                'payment_date' => Carbon::now(),
                'status' => 'generated',
            ],
            [
                'user_id' => 1,
                'company_id' => 2,
                'month' => 8,
                'year' => 2024,
                'basic_salary' => 7000000,
                'nett_salary' => 60000000,
                'total_days' => 31,
                'working_days' => 22,
                'present_days' => 20,
                'total_office_time' => 170,
                'total_worked_time' => 160,
                'half_days' => 0,
                'late_days' => 0,
                'paid_leaves' => 2,
                'unpaid_leaves' => 1,
                'holiday_count' => 8,
                'payment_date' => Carbon::now(),
                'status' => 'generated',
            ],
        ];
    }
}
