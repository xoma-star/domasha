<?php
	$week = $_POST['w'];
	$day = $_POST['d'];
	$user = $_POST['user'];
	if (!empty($_COOKIE['uid'])) {
		if (file_exists('../hw/'.$week.'.txt')) {
			$week_data = json_decode(file_get_contents('../hw/'.$week.'.txt'));
			include 'log.php';
			loger('weekend', $_POST['c'], $week_data->response->days[$day]->weekend);
			$week_data->response->days[$day]->weekend = $_POST['c'];
			file_put_contents('../hw/'.$week.'.txt', json_encode($week_data));
		}
	}
?>