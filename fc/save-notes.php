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
		$docs = mb_substr(strip_tags(htmlspecialchars(htmlentities($_POST['docs']))), 0, 250);
		$day = $_POST['d'];
		$lesson = $_POST['l'];
		$user = $_POST['user'];
		if (is_numeric($week) && is_numeric($day)) {
			if (file_exists('../hw/'.$week.'.txt')) {
				$week_data = json_decode(file_get_contents('../hw/'.$week.'.txt'));
				$docs = explode('☺', $docs);
				for ($i=0; $i < count($docs); $i++) { 
					if (empty($docs[$i])) {
						array_splice($docs, $i, 1);
						$i--;
					}
				}
				include 'log.php';
				loger('notes',$docs,$week_data->response->days[$day]->notes);
				$week_data->response->days[$day]->notes = $docs;
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