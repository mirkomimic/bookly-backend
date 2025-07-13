<?php

namespace App\Services\ScheduleTasks;

use App\Models\Schedule;
use Carbon\Carbon;

class ScheduleDatesTask
{
  public function __invoke()
  {
    $this->deleteOldDays();
    $this->addNewDay();
  }

  public function deleteOldDays()
  {
    $today = date('Y-m-d');

    Schedule::where('date', "<", $today)
      ->delete();
  }

  public function addNewDay()
  {
    $numberOfAppointments = 16;
    $appointmentTime = 30;
    $startTime = '07:30';

    $lastDate = Schedule::max('date');

    $newDay = $lastDate ? Carbon::parse($lastDate)->addDay() : Carbon::today();

    while ($newDay->isWeekend()) {
      $newDay->addDay();
    }

    $newDayFormatted = $newDay->toDateString();

    for ($j = 0; $j < $numberOfAppointments; $j++) {
      if ($j !== 0) {
        $startTime = date('H:i', strtotime($startTime) + ($appointmentTime * 60));
      }

      $schedule = new Schedule();
      $schedule->date = $newDayFormatted;
      $schedule->start_time = $startTime;
      $schedule->is_available = true;
      $schedule->user_id = null;
      $schedule->save();
    }
  }

  public static function disableOldAppointments()
  {
    $today = Carbon::today()->toDateString();
    $now = Carbon::now(env('TIME_ZONE'))->format('H:i:s');

    $schedule = Schedule::where('date', $today)
      ->where('start_time', '<', $now)
      ->get();

    foreach ($schedule as $item) {
      $item->is_available = false;
      $item->save();
    }
  }
}
