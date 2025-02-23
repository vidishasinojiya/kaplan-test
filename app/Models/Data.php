<?php

namespace App\Models;

use Illuminate\Support\Facades\Http;
use Illuminate\Database\Eloquent\Model;

class Data
{

    public function fetchExternalData()
    {
        $response = Http::get(
            "https://kp-lms-static.s3.us-east-2.amazonaws.com/activities.json"
        );
        return $response;
    }

}
