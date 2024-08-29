<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create IT department
        \App\Models\Department::create([
            'company_id' => 1,
            'created_by' => 1,
            'name' => 'IT',
            'description' => 'IT Department',
        ]);

        // create HR department
        \App\Models\Department::create([
            'company_id' => 1,
            'created_by' => 1,
            'name' => 'HR',
            'description' => 'HR Department',
        ]);
    }
}
