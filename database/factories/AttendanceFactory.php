<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\attendance>
 */
class AttendanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'company_id' => 1,
            'user_id' => 1,
            'date' => $this->faker->date(),
            'is_holiday' => false,
            'is_leave' => false,
            'leave_id' => null,
            'holiday_id' => null,
            'clock_in_date_time' => $this->faker->dateTime(),
            'clock_out_date_time' => $this->faker->dateTime(),
            'total_duration' => $this->faker->numberBetween(1, 10),
            'is_late' => false,
            'is_half_day' => false,
            'is_paid' => true,
            'status' => 'present',
            'reason' => $this->faker->sentence(),
        ];
    }
}
