<?php
	function loger($type,$to,$from=''){
		global $_POST,$week,$lesson,$day;
		$log = [
			'time'=>time(),
			'type'=>$type,
			'week'=>$week,
			'day'=>$day,
			'lesson'=>$lesson,
			'from'=>$from,
			'to'=>$to,
			'ip'=>$_SERVER['REMOTE_ADDR'],
			'user_data'=>$_POST['user'],
			'uid'=>$_COOKIE['uid']
		];
		if (file_exists('logs/'.date('d.m.Y').'.txt')) {
			$data = json_decode(file_get_contents('logs/'.date('d.m.Y').'.txt'));
			$data->response[count($data->response)] = $log;
			file_put_contents('logs/'.date('d.m.Y').'.txt', json_encode($data));
		}
		else{
			$arr = ['response'=>[$log]];
			$f_hdl = fopen('logs/'.date('d.m.Y').'.txt', 'w');
			fwrite($f_hdl, json_encode($arr));
			fclose($f_hdl);
		}
	}
?>