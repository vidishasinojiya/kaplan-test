<?php

namespace App\Models;

use Illuminate\Support\Facades\Http;
use Illuminate\Database\Eloquent\Model;

class WeeklyStudySchedule extends Model
{

    var $dataObj;

    public function __construct(?Data $dataObj = null) {
        if (null == $dataObj) {
            $this->dataObj = new Data();
        } else {
            $this->dataObj = $dataObj;
        }
    }

    public function calculateSchedule()
    {

        $response = $this->dataObj->fetchExternalData();

        $data = json_decode($response, true);

        $newDataArray = [];
        $timeCombination = [];
        $Week = 1;
        $calculateTime = 0;

        foreach ($data["activities"] as $activityData) {
            if ($calculateTime < 240) {
                $newDataArray[$Week][] = $activityData;
            } else {
                $Week = $Week + 1;
                $calculateTime = 0;
                $newDataArray[$Week][] = $activityData;
            }

            $calculateTime = $calculateTime + $activityData["durationMinutes"];
            $timeCombination[$Week . "time"][] = $calculateTime;
        }

        $timearray = $this->calculateTime($timeCombination);
        return compact("newDataArray", "timearray");
    }

    private function calculateTime($timeCombination)
    {
        $timearray = [];
        foreach ($timeCombination as $time) {
            $minutes = end($time);

            $hours = floor($minutes / 60);
            $min = $minutes - $hours * 60;

            $timearray[] = $hours . "h " . $min . "m";
        }
        return $timearray;
    }
}
