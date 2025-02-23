<!DOCTYPE html>
<html lang="en">
<head>
<title>Weekly Study Schedule</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/study.css'); }} ">
</head>
<body>

<!-- Header -->
<header class="w3-display-container w3-content w3-center" style="max-width:1500px">
  <img class="w3-image" src="{{ asset('/edu-image-final.jpg') }}" alt="Me" width="1420" height="400">
</header>
<div class="main-div">
<h1><center>Study Schedule</center></h1>
<div class="w3-content w3-padding-large w3-margin-top list" id="navigation">

@if(!empty($data['newDataArray']) )
  	@foreach($data['newDataArray'] as $key=>$valueData)
		<ul class="mainUL">
	  		<li><h3>Week {{$key}} (Study Time: {{$data['timearray'][$key-1]}})</h3>

				@foreach($valueData as $activityData)

				    <ul class="innerUL">
				      <li>{{$activityData['name']}}  {{$activityData['durationMinutes']}}</li>
				    </ul>

				@endforeach
			</li>
		</ul>
	@endforeach
@else
      <h4> No Data Found</h4>     
@endif


</div>
</div>
</body>
</html>
