<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WeeklyStudyScheduleController;

/*Route::get('/', function () {
    return view('welcome');
}); */

Route::get('/', [WeeklyStudyScheduleController::class, 'getWeeklySchedule']);