<?php
	if (!empty($_COOKIE['uid'])) {
		function mb_ucfirst($str, $encoding='UTF-8')
		{
			$str = mb_ereg_replace('^[\ ]+', '', $str);
			$str = mb_strtoupper(mb_substr($str, 0, 1, $encoding), $encoding).
				   mb_substr($str, 1, mb_strlen($str), $encoding);
			return $str;
		}
		$week = $_POST['w'];
		$day = $_POST['d'];
			if (file_exists('../hw/'.$week.'.txt')) {
				$week_data = json_decode(file_get_contents('../hw/'.$week.'.txt'));
				$prev_week = $week-1;
				if ($prev_week == 0) {
					 function get_weeks_in_year($year) 
						{ 	$year--; 
							$date = date('w', mktime(0, 0, 0, 12, 31, $year)); 
							$day = ($date < 4 ? 31 - $date : 31); 
							return date('W', mktime(0, 0, 0, 12, $day, $year)); 
						}
						$prev_week = get_weeks_in_year(2019);
				}
				$week_data_past = json_decode(file_get_contents('../hw/'.$prev_week.'.txt'));
				for ($i=0; $i < count($week_data_past->response->days[$day]->subjects); $i++) { 
					$week_data->response->days[$day]->subjects[$i]->aud = $week_data_past->response->days[$day]->subjects[$i]->aud;
					$week_data->response->days[$day]->subjects[$i]->name = $week_data_past->response->days[$day]->subjects[$i]->name;
					$week_data->response->days[$day]->subjects[$i]->type = $week_data_past->response->days[$day]->subjects[$i]->type;
					$week_data->response->days[$day]->subjects[$i]->hw = '';
					$week_data->response->days[$day]->subjects[$i]->docs = [];
					$week_data->response->days[$day]->subjects[$i]->images = [];
				}
				include 'log.php';
				loger('copied_day','');
				file_put_contents('../hw/'.$week.'.txt', json_encode($week_data));
				echo mb_ucfirst('скопировано');
			}
			else{
				echo "error3";
			}
	}
	else{
		echo "не авторизован";
	}
?>