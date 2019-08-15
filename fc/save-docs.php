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
		$docs = strip_tags(htmlspecialchars(htmlentities($_POST['docs'])));
		$day = $_POST['d'];
		$lesson = $_POST['l'];
		if (is_numeric($week) && is_numeric($day) && is_numeric($lesson)) {
			if (file_exists('../hw/'.$week.'.txt')) {
				$week_data = json_decode(file_get_contents('../hw/'.$week.'.txt'));
				$dc = [];
				$docs = explode('☺', $docs);
				for ($i=0; $i < count($docs)-1; $i++) {
					$doc = explode('☻', $docs[$i]);
					if (empty($doc[0]) || empty($doc[1])) {
						array_splice($docs, $i, 1);
						$i--;
					}
					else{
						$dc[$i] = ['name'=>$doc[0],'path'=>$doc[1]];
					}
				}
				include 'log.php';
                loger('docs',$dc,$week_data->response->days[$day]->subjects[$lesson]->docs);
				$week_data->response->days[$day]->subjects[$lesson]->docs = $dc;
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