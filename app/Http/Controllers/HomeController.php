<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
  /**
   * Display the home page.
   */
  public function index(Request $request)
  {
    $days = Schedule::pluck('date')->unique()->sort()->values();

    $schedules = Schedule::where('date', $request->date)->get();

    return response()->json([
      'schedules' => $schedules,
      'days' => $days,
    ]);
  }
}
