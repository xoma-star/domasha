<?php
	$sunset = json_decode(file_get_contents('sunset.txt'));
	if ((time()-$sunset->updated) > 60*60) {
		$weather_data = json_decode(file_get_contents('http://api.openweathermap.org/data/2.5/weather?q=Ufa&APPID=ba00b8736b1a100a1fe1fed48857a5a6&units=metric'));
		$sunset->sunrise = $weather_data->sys->sunrise+3*60*60;
		$sunset->sunset = $weather_data->sys->sunset+3*60*60;
		$sunset->updated = time();
		file_put_contents('sunset.txt', json_encode($sunset));
	}
	echo json_encode($sunset);
?>