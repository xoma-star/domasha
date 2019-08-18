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
		$name = mb_strtolower($_POST['n']);
		$day = $_POST['d'];
		$lesson = $_POST['l'];
		$subjects = json_decode(file_get_contents('../subjects.txt'));
		if (in_array($name, $subjects->subjects)) {
			if (is_numeric($week) && is_numeric($day) && is_numeric($lesson)) {
				if (file_exists('../hw/'.$week.'.txt')) {
					$week_data = json_decode(file_get_contents('../hw/'.$week.'.txt'));
					include 'log.php';
					if ($name == 'удалить') {
						loger('subject-removed','',$week_data->response->days[$day]->subjects[$lesson]);
						array_splice($week_data->response->days[$day]->subjects, $lesson, 1);
					}
					else{
						loger('subject',$name,$week_data->response->days[$day]->subjects[$lesson]->name);
						if ($lesson >= count($week_data->response->days[$day]->subjects)) {
							$week_data->response->days[$day]->subjects[$lesson] = (object)['name'=>$name,'hw'=>'','docs'=>[],'images'=>[]];
						}
						else{
							$week_data->response->days[$day]->subjects[$lesson]->name = $name;
						}
					}
					file_put_contents('../hw/'.$week.'.txt', json_encode($week_data));
					echo mb_ucfirst($name);
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
			echo "error1";
		}
	}
	else{
		echo "не авторизован";
	}
?>