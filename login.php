<?php
	$uid = $_GET['uid'];
	$name = $_GET['first_name'];
	$hash_c = md5('7079888'.$uid.'jUhorzTpmcklflMOlli8');
	if ($hash_c == $_GET['hash']) {
		setcookie('uid', $uid, time()+7*24*60*60);
		setcookie('hash', $hash_c, time()+7*24*60*60);
		// setcookie('username', $name, time()+7*24*60*60);
		// setcookie('userphoto', $_GET['photo_rec'], time()+7*24*60*60);
		$path = 'users/'.$uid.'.txt';
		if (file_exists($path)) {
			$user_data = json_decode(file_get_contents($path));
			$user_data->name = $name;
			$user_data->ava = $_GET['photo_rec'];
			file_put_contents($path, json_encode($user_data));
		}
		else{
			$user_data = [
				'name'=>$name,
				'ava'=>$_GET['photo_rec'],
				'sync'=>0,
				'night'=>0,
				'night-auto'=>0,
				'notifications'=>0
			];
			$f_hdl = fopen($path, 'w');
			fwrite($f_hdl, json_encode($user_data));
			fclose($f_hdl);
		}
		if (mb_strlen($_GET['l']) > 0) {
			header('Location: https://domasha.tk?w='.$_GET['w'].'&d='.$_GET['d'].'&l='.$_GET['l']);
		}
		elseif (mb_strlen($_GET['d']) > 0) {
			header('Location: https://domasha.tk?w='.$_GET['w'].'&d='.$_GET['d']);
		}
		elseif (mb_strlen($_GET['w']) > 0) {
			header('Location: https://domasha.tk?w='.$_GET['w']);
		}
		else{
			header('Location: https://domasha.tk');
		}	
	}
?>