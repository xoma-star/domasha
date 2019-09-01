<?php
	$weather_data = json_decode(file_get_contents('weather.txt'));
	if ((time()-$weather_data->updated) > 0.5*60*60) {
		$q = file_get_contents('https://yandex.ru/pogoda/ufa/details');
		$weather = ['response'=>[]];
		for ($i=0; $i < 7; $i++) { 
			$weather['response'][$i] = (object)([
				'morning'=>(object)([
					'temp'=>str_replace('°-', '°...-', str_replace('°+', '°...+', str_replace('-----', '', str_replace('-+', '+', preg_replace("/[^0-9+°-]/iu", '', explode('</td>', explode('<div class="weather-table__daypart">', $q)[1+$i*4])[0]))))),
					'feels_like'=>str_replace('°-', '°...-', str_replace('°+', '°...+', str_replace('-----', '', str_replace('-+', '+', preg_replace("/[^0-9+°-]/iu", '', explode('</td>', explode('<td class="weather-table__body-cell weather-table__body-cell_type_feels-like">', $q)[1+$i*4])[0]))))),
					'condition'=>explode('</td>', explode('<td class="weather-table__body-cell weather-table__body-cell_type_condition">', $q)[1+$i*4])[0],
					'icon'=>explode('"/>', explode('src="', explode('</td>', explode('<td class="weather-table__body-cell weather-table__body-cell_type_icon">', $q)[1+$i*4])[0])[1])[0],
				]),
				'day'=>(object)([
					'temp'=>str_replace('°-', '°...-', str_replace('°+', '°...+', str_replace('-----', '', str_replace('-+', '+', preg_replace("/[^0-9+°-]/iu", '', explode('</td>', explode('<div class="weather-table__daypart">', $q)[2+$i*4])[0]))))),
					'feels_like'=>str_replace('°-', '°...-', str_replace('°+', '°...+', str_replace('-----', '', str_replace('-+', '+', preg_replace("/[^0-9+°-]/iu", '', explode('</td>', explode('<td class="weather-table__body-cell weather-table__body-cell_type_feels-like">', $q)[2+$i*4])[0]))))),
					'condition'=>explode('</td>', explode('<td class="weather-table__body-cell weather-table__body-cell_type_condition">', $q)[2+$i*4])[0],
					'icon'=>explode('"/>', explode('src="', explode('</td>', explode('<td class="weather-table__body-cell weather-table__body-cell_type_icon">', $q)[2+$i*4])[0])[1])[0],
				]),
				'evening'=>(object)([
					'temp'=>str_replace('°-', '°...-', str_replace('°+', '°...+', str_replace('-----', '', str_replace('-+', '+', preg_replace("/[^0-9+°-]/iu", '', explode('</td>', explode('<div class="weather-table__daypart">', $q)[3+$i*4])[0]))))),
					'feels_like'=>str_replace('°-', '°...-', str_replace('°+', '°...+', str_replace('-----', '', str_replace('-+', '+', preg_replace("/[^0-9+°-]/iu", '', explode('</td>', explode('<td class="weather-table__body-cell weather-table__body-cell_type_feels-like">', $q)[3+$i*4])[0]))))),
					'condition'=>explode('</td>', explode('<td class="weather-table__body-cell weather-table__body-cell_type_condition">', $q)[3+$i*4])[0],
					'icon'=>explode('"/>', explode('src="', explode('</td>', explode('<td class="weather-table__body-cell weather-table__body-cell_type_icon">', $q)[3+$i*4])[0])[1])[0],
				]),
				'night'=>(object)([
					'temp'=>str_replace('°-', '°...-', str_replace('°+', '°...+', str_replace('-----', '', str_replace('-+', '+', preg_replace("/[^0-9+°-]/iu", '', explode('</td>', explode('<div class="weather-table__daypart">', $q)[4+$i*4])[0]))))),
					'feels_like'=>str_replace('°-', '°...-', str_replace('°+', '°...+', str_replace('-----', '', str_replace('-+', '+', preg_replace("/[^0-9+°-]/iu", '', explode('</td>', explode('<td class="weather-table__body-cell weather-table__body-cell_type_feels-like">', $q)[4+$i*4])[0]))))),
					'condition'=>explode('</td>', explode('<td class="weather-table__body-cell weather-table__body-cell_type_condition">', $q)[4+$i*4])[0],
					'icon'=>explode('"/>', explode('src="', explode('</td>', explode('<td class="weather-table__body-cell weather-table__body-cell_type_icon">', $q)[4+$i*4])[0])[1])[0],
				])
			]);
		}
		$weather_today = preg_replace("/[^0-9]/iu", '', $today_weather->day->feels_like);
		$weather_today = preg_replace("/[^0-9]/iu", '', $tomorrow_weather->day->feels_like);
		$bad_weather = ['debil', 'Небольшой дождь', 'Дождь', 'Сильный дождь', 'Гроза'];
		$may_rain = false;
		$r = ['morning', 'day', 'evening', 'night'];
		for ($i=0; $i < 4; $i++) { 
			if (in_array($weather['response'][0]->{$r[$i]}->condition, $bad_weather)) {
				$may_rain = true;
			}
		}
		$weather_data->updated = time();
		$weather_data->may_rain = $may_rain;
		$weather_data->weather = $weather;
		$weather_data->weather_today = $weather_today;
		$weather_data->weather_tomorrow = $weather_tomorrow;
		file_put_contents('weather.txt', json_encode($weather_data));
	}
	$arr = [
		'may_rain'=>$weather_data->may_rain,
		'weather'=>$weather_data->weather,
		'weather_today'=>$weather_data->weather_today,
		'weather_tomorrow'=>$weather_data->weather_tomorrow
	];
	echo json_encode($arr);
?>