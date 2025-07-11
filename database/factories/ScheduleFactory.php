<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Schedule>
 */
class ScheduleFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {


    return [
      'date' => $this->faker->date(),
      'start_time' => $this->faker->time(),
      'is_available' => true,
      'user_id' => null,
    ];
  }
}
