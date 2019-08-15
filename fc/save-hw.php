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
		$hw = mb_substr(strip_tags(htmlspecialchars($_POST['hw'])), 0, 1000);
		$hw = str_replace("\n", '<br>', $hw);
		$day = $_POST['d'];
		$lesson = $_POST['l'];
		if (is_numeric($week) && is_numeric($day) && is_numeric($lesson)) {
			if (file_exists('../hw/'.$week.'.txt')) {
				$week_data = json_decode(file_get_contents('../hw/'.$week.'.txt'));
				include 'log.php';
                loger('homework',$hw,$week_data->response->days[$day]->subjects[$lesson]->hw);
				$week_data->response->days[$day]->subjects[$lesson]->hw = $hw;
				file_put_contents('../hw/'.$week.'.txt', json_encode($week_data));
			}
			else{
				echo "error";
			}
		}
		else{
			echo "error";
		}
	}
?>