<?php
	$j_data = json_decode(file_get_contents('junks.txt'));
	if ((time()-$j_data->updated) > 10*60) {
		$str = file_get_contents('https://www.yandex.ru');
		$q = explode('<div class="traffic__rate-text">', $str)[1];
		$d = explode('</div>', $q)[0];
		$j_data->rate = $d;
		$j_data->updated = time();
		file_put_contents('junks.txt', json_encode($j_data));
	}
?>