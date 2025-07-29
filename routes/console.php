<?php

use App\Services\ScheduleTasks\ScheduleDatesTask;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

// Artisan::command('inspire', function () {
//   $this->comment(Inspiring::quote());
// })->purpose('Display an inspiring quote');

Schedule::call(new ScheduleDatesTask)->dailyAt('00:00')->name('schedule.addNewDayAndDeleteOldDays');

Schedule::call(function () {
  ScheduleDatesTask::disableOldAppointments();
})->everyThirtyMinutes()->name('schedule.disableOldAppointments');
