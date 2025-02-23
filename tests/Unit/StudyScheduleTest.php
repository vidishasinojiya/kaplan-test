<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\WeeklyStudySchedule;
use App\Models\Data;
use Illuminate\Support\Facades\Http;


class StudyScheduleTest extends TestCase
{
    /**
     * A basic unit test example.
     */
   public function testFetchExternalData()
    {

      $dataObj = $this->createMock(Data::class);

      $mockApiResponse = json_encode([
            'activities' => [
                ['activityId' => 6421, 'name'=> "Getting Started", 'isComplete'=> false ,'durationMinutes' => 60],
                ['activityId' => 6422, 'name'=> "Intro to Your Course", 'isComplete'=> false ,'durationMinutes' => 20],
                ['activityId' => 6423, 'name'=> "Module 1: Reading Assignment", 'isComplete'=> false ,'durationMinutes' => 40],
                ['activityId' => 6424, 'name'=> "Module 1: Interactive Exercise", 'isComplete'=> false ,'durationMinutes' => 60],
                ['activityId' => 6425, 'name'=> "Module 2: Interactive Exercise", 'isComplete'=> false ,'durationMinutes' => 70],
                ['activityId' => 6426, 'name'=> "Module 2: Quiz", 'isComplete'=> false ,'durationMinutes' => 20],
                ['activityId' => 6427, 'name'=> "Module 3: Exam", 'isComplete'=> false ,'durationMinutes' => 90],
                ['activityId' => 6428, 'name'=> "Module 4: Exam", 'isComplete'=> false ,'durationMinutes' => 30],

            ],
        ]);

      $dataObj->method('fetchExternalData')->willReturn($mockApiResponse);

      $myService = new WeeklyStudySchedule($dataObj);

      $result = $myService->calculateSchedule();
        // Define the expected results based on the mock data
        $expectedNewDataArray = [
            1 => [
                ['activityId' => 6421, 'name'=> "Getting Started", 'isComplete'=> false ,'durationMinutes' => 60],
                ['activityId' => 6422, 'name'=> "Intro to Your Course", 'isComplete'=> false ,'durationMinutes' => 20],
                ['activityId' => 6423, 'name'=> "Module 1: Reading Assignment", 'isComplete'=> false ,'durationMinutes' => 40],
                ['activityId' => 6424, 'name'=> "Module 1: Interactive Exercise", 'isComplete'=> false ,'durationMinutes' => 60],
                ['activityId' => 6425, 'name'=> "Module 2: Interactive Exercise", 'isComplete'=> false ,'durationMinutes' => 70],
            ],
            2 => [
                ['activityId' => 6426, 'name'=> "Module 2: Quiz", 'isComplete'=> false ,'durationMinutes' => 20],
                ['activityId' => 6427, 'name'=> "Module 3: Exam", 'isComplete'=> false ,'durationMinutes' => 90],
                ['activityId' => 6428, 'name'=> "Module 4: Exam", 'isComplete'=> false ,'durationMinutes' => 30],
            ]
        ];

        $expectedNewTimeArray =  ['4h 10m', '2h 20m'];

        // Perform assertions
        // Check Data
        $this->assertEquals($expectedNewDataArray, $result['newDataArray']);
        // Check Time
        $this->assertEquals($expectedNewTimeArray, $result['timearray']);
    }

    
}
