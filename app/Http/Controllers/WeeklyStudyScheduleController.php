<?php

namespace App\Http\Controllers;
use App\Models\WeeklyStudySchedule;
use Illuminate\Support\Facades\Http;

use Illuminate\Http\Request;

class WeeklyStudyScheduleController extends Controller
{
    function getWeeklySchedule() {

        $obj = new WeeklyStudySchedule();
        $data = $obj->calculateSchedule();
        return view('weeklyStudySchedule', compact('data'));

    }
}
