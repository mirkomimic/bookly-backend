<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ScheduleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
  return $request->user();
});

Route::get('/', [HomeController::class, 'index'])
  ->name('home.index');

Route::resource('schedules', ScheduleController::class)
  ->only(['store', 'update', 'destroy'])
  ->names('schedules');
