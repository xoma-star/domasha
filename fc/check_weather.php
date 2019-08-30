<?php
	$weather_data = json_decode(file_get_contents('weather.txt'));
	if ((time()-$weather_data->updated) > 0.5*60*60) {
		$weather_data = json_decode(file_get_contents('http://api.openweathermap.org/data/2.5/forecast?q=Ufa&APPID=ba00b8736b1a100a1fe1fed48857a5a6&units=metric&cnt=16'));
		$weather_data->updated = time();
		file_put_contents('weather.txt', json_encode($weather_data));
	}
	$thunders = [200,201,202,210,211,212,221,230,231,232];
	$drizzles = [300,301,302,310,311,312,313,314,321,500];
	$rains = [501,502,503,504,511,520,521,522,531];
	$q = [$thunders, $drizzles, $rains];
	$conds = ['возможна гроза', 'возможен небольшой дождь', 'возможен дождь'];
	$may_rain = false;
	for ($i=0; $i < 3; $i++) {
		if (in_array($weather_data->list[0]->weather[0]->id, $q[$i])) {
			$response = $conds[$i];
			$may_rain = true;
		}
	}
	$next_day_unix = strtotime(date('d.m.Y')) + 24*60*60;
	for ($i=0; $i < count($weather_data->list); $i++) { 
		if ($weather_data->list[$i]->dt >= $next_day_unix) {
			break;
		}
	}
	$this_day_deg = $weather_data->list[0]->main->temp;
	$next_day_deg = $weather_data->list[8]->main->temp;
	//$next_day_deg = (int)(($weather_data->list[$i+3]->main->temp+$weather_data->list[$i+4]->main->temp+$weather_data->list[$i+5]->main->temp)/3);

	$arr = [
		'may_rain'=>$may_rain,
		'rain'=>$response,
		'weather_today'=>$this_day_deg,
		'weather_tomorrow'=>$next_day_deg
	];
	echo json_encode($arr);
?>