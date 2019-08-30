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
		$aud = mb_strtolower($_POST['a']);
		$day = $_POST['d'];
		$lesson = $_POST['l'];
		if (is_numeric($week) && is_numeric($day) && is_numeric($lesson)) {
			if (file_exists('../hw/'.$week.'.txt')) {
				$week_data = json_decode(file_get_contents('../hw/'.$week.'.txt'));
				include 'log.php';
				loger('changed_type', $aud, $week_data->response->days[$day]->subjects[$lesson]->type);
				$week_data->response->days[$day]->subjects[$lesson]->type = $aud;
					
				
				file_put_contents('../hw/'.$week.'.txt', json_encode($week_data));
				echo mb_ucfirst($aud);
			}
			else{
				echo "error3";
			}
		}
		else{
			echo "error2";
		}
	}
	else{
		echo "не авторизован";
	}
?>