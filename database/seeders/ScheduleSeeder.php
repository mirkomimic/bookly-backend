<?php

namespace Database\Seeders;

use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  // public function run(): void
  // {
  //   $numberOfDays = 3;
  //   $numberOfAppointments = 16;
  //   $appointmentTime = 30; // in minutes
  //   $baseDate = Carbon::today();


  //   for ($i = 0; $i < $numberOfDays; $i++) {
  //     $date = date('Y-m-d', strtotime("$baseDate +$i days"));
  //     $time = '07:30';

  //     for ($j = 0; $j < $numberOfAppointments; $j++) {
  //       if ($j !== 0) {
  //         $time = date('H:i', strtotime($time) + ($appointmentTime * 60));
  //       }

  //       Schedule::factory()->create([
  //         'date' => $date,
  //         'start_time' => $time,
  //         'is_available' => true,
  //         'user_id' => null,
  //       ]);
  //     }
  //   }
  // }

  public function run(): void
  {
    $numberOfDays = 3;
    $numberOfAppointments = 16;
    $appointmentTime = 30; // in minutes
    $baseDate = Carbon::today();

    $daysCreated = 0;

    while ($daysCreated < $numberOfDays) {
      if (!$baseDate->isWeekend()) {
        $time = Carbon::createFromTime(7, 30);

        for ($j = 0; $j < $numberOfAppointments; $j++) {
          Schedule::factory()->create([
            'date' => $baseDate->toDateString(),
            'start_time' => $time->format('H:i'),
            'is_available' => true,
            'user_id' => null,
          ]);

          $time->addMinutes($appointmentTime);
        }

        $daysCreated++;
      }

      $baseDate->addDay(); // Move to the next day
    }
  }
}
