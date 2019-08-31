<?php
	$weather_data = json_decode(file_get_contents('weather.txt'));
	if ((time()-$weather_data->updated) > 0.5*60*60) {
		$q = file_get_contents('https://yandex.ru/pogoda/ufa/details');
		$weather_today = str_replace('+', '', explode('</span>', explode('<span class="temp__value">', $q)[6])[0]);
		$weather_tomorrow = str_replace('+', '', explode('</span>', explode('<span class="temp__value">', $q)[18])[0]);
		$condition_morning = explode('</td>', explode('<td class="weather-table__body-cell weather-table__body-cell_type_condition">', $q)[1])[0];
		$condition_day = explode('</td>', explode('<td class="weather-table__body-cell weather-table__body-cell_type_condition">', $q)[2])[0];
		$condition_evening = explode('</td>', explode('<td class="weather-table__body-cell weather-table__body-cell_type_condition">', $q)[3])[0];
		$hours_now = date('G', time()+2*60*60);
		$bad_weather = ['debil', 'Небольшой дождь', 'Дождь', 'Сильный дождь', 'Гроза'];
		$may_rain = false;
		if ($hours_now > 20) {
			$may_rain = false;
		}
		elseif ($hours_now > 12) {
			$w = [$condition_evening];
			for ($i=0; $i < count($w); $i++) { 
				if (in_array($w[$i], $bad_weather)) {
					$may_rain = true;
					$code[$i] = array_search($w[$i], $bad_weather);
				}
				else{
					$code[$i] = 0;
				}
			}
		}
		elseif ($hours_now > 11) {
			$w = [$condition_day,$condition_evening];
			for ($i=0; $i < count($w); $i++) { 
				if (in_array($w[$i], $bad_weather)) {
					$may_rain = true;
					$code[$i] = array_search($w[$i], $bad_weather);
				}
				else{
					$code[$i] = 0;
				}
			}
		}
		else{
			$w = [$condition_morning,$condition_day,$condition_evening];
			for ($i=0; $i < count($w); $i++) { 
				if (in_array($w[$i], $bad_weather)) {
					$may_rain = true;
					$code[$i] = array_search($w[$i], $bad_weather);
				}
				else{
					$code[$i] = 0;
				}
			}
		}
		if ($may_rain) {
			$bw = ['возможен небольшой дождь', 'возможен дождь', 'возможен сильный дождь', 'возможна гроза'];
			if (count($code) == 2) {
				$e = ['днем','вечером'];
				$rain = 'Сегодня ';
				for ($i=0; $i < count($code); $i++) { 
					if ($code[$i] != 0) {
						$rain .= $e[$i].' '.$bw[$code[$i]-1].' и ';
					}
				}
				$rain = mb_substr($rain, 0, -3);
			}
			elseif (count($code) == 3) {
				$e = ['утром','днем','вечером'];
				$rain = 'Сегодня ';
				for ($i=0; $i < count($code); $i++) { 
					if ($code[$i] != 0) {
						$rain .= $e[$i].' '.$bw[$code[$i]-1].' и ';
					}
				}
				$rain = mb_substr($rain, 0, -3);
			}
			else{
				$rain = 'Сегодня вечером '.$bw[$code[0]-1];
			}
		}
		$weather_data->updated = time();
		$weather_data->may_rain = $may_rain;
		$weather_data->rain = $rain;
		$weather_data->weather_today = $weather_today;
		$weather_data->weather_tomorrow = $weather_tomorrow;
		file_put_contents('weather.txt', json_encode($weather_data));
	}
	$arr = [
		'may_rain'=>$weather_data->may_rain,
		'rain'=>$weather_data->rain,
		'weather_today'=>$weather_data->weather_today,
		'weather_tomorrow'=>$weather_data->weather_tomorrow
	];
	echo json_encode($arr);
?>