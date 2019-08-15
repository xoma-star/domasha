<?php
	$week = $_POST['w'];
	$day = $_POST['d'];
	$lesson = $_POST['l'];
	//if ($_POST['api'] == false) {
		if (in_array($_FILES['file']['type'], ['application/msword', 'application/pdf', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document']) || $_POST['api'] == true) {
			if ($_FILES['file']['size'] < 10*1024*1024*8) {
				$week_data = json_decode(file_get_contents('../hw/'.$week.'.txt'));
				if (!empty($week_data->response)) {
					$folders = array_diff(scandir('../docs'), ['.', '..']);
					$k = true;
					for ($i=2; $i < count($folders)+2; $i++) {
						$doc = '../docs/'.$folders[$i].'/'.$_FILES['file']['name'];
						if (!file_exists($doc)) {
							$k = false;
							if (move_uploaded_file($_FILES['file']['tmp_name'], $doc)) {
								$path = 'https://domasha.tk/docs/'.$folders[$i].'/'.$_FILES['file']['name'];
								$fold_name = $folders[$i];
							}
						}
					}
					if ($k === true) {
						$alph = ['q','w','e','r','t','y','u','i','o','p','a','s','d','f','g','h','j','k','l','z','x','c','v','b','n','m',1,2,3,4,5,6,7,8,9,0];
						for ($i=0; $i < 5; $i++) { 
							$fold_name .= $alph[mt_rand(0, count($alph)-1)];
						}
						mkdir('../docs/'.$fold_name);
						if (move_uploaded_file($_FILES['file']['tmp_name'], '../docs/'.$fold_name.'/'.$_FILES['file']['name'])) {
							$path = 'https://domasha.tk/docs/'.$fold_name.'/'.$_FILES['file']['name'];	
						}
					}
					$lesson_data = $week_data->response->days[$day]->subjects[$lesson];
					if($_POST['api'] == true){
						//https://oauth.vk.com/authorize?client_id=7089164&display=page&redirect_uri=https://vk.com&scope=docs,offline&response_type=token&v=5.101
						$token = '94f6616a3b2f6015642bbc78dcddefe6cf6b52079be74e4c17f27f09040dfc437b21ea495f17c8d8f3e8d';
						$request_params = [
						    'access_token' => $token,
						    'v' => '5.101'
						];
						$url = 'https://api.vk.com/method/docs.getUploadServer?' . http_build_query($request_params);
						$result = json_decode(file_get_contents($url));
						$curl = curl_init();
						//$file = $path;
						$file = __DIR__.'/../docs/'.$fold_name.'/'.$_FILES['file']['name'];
						$file = curl_file_create($file, mime_content_type($file), pathinfo($file)['basename']);
						curl_setopt($curl, CURLOPT_URL, $result->response->upload_url);
						curl_setopt($curl, CURLOPT_POST, true);
						curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-type: multipart/form-data;charset=utf-8']);
						curl_setopt($curl, CURLOPT_POSTFIELDS, ['file' => $file]);
						curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
						curl_setopt($curl, CURLOPT_TIMEOUT, 10);
						curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
						$response = json_decode(curl_exec($curl));
						curl_close($curl);
						$request_params = [
						    'access_token' => $token,
						    'v' => '5.101',
						    'file' => $response->file,
						    'title' => $_FILES['file']['name'],
						    'tags' => 'domasha'
						];
						unlink($path);
						$url = 'https://api.vk.com/method/docs.save?' . http_build_query($request_params);
						$result = json_decode(file_get_contents($url));
						$path = explode('&dl=', $result->response->doc->url)[0];	
					}
	                $lesson_data->docs[count($lesson_data->docs)] = ['name'=>$_FILES['file']['name'], 'path'=>$path];
	                $week_data->response->days[$day]->subjects[$lesson] = $lesson_data;
	                if (!empty($path)) {
	                	file_put_contents('../hw/'.$week.'.txt', json_encode($week_data));
	                	include 'log.php';
	                	loger('uploaded_doc', $path);
	                	echo $_FILES['file']['name'].','.$path;
	                }
				}
				else{
					echo "err3";
				}
			}
			else{
				echo "err2";
			}
		}
		else{
			echo "err1";
		}
	//}
	// elseif($_POST['api'] == true){
	// 	//https://oauth.vk.com/authorize?client_id=7089164&display=page&redirect_uri=https://vk.com&scope=docs,offline&response_type=token&v=5.101
	// 	$token = '94f6616a3b2f6015642bbc78dcddefe6cf6b52079be74e4c17f27f09040dfc437b21ea495f17c8d8f3e8d';
	// 	$request_params = [
	// 	    'access_token' => $token,
	// 	    'v' => '5.101'
	// 	];
	// 	$url = 'https://api.vk.com/method/docs.getUploadServer?' . http_build_query($request_params);
	// 	$result = json_decode(file_get_contents($url));
	// 	$curl = curl_init();
	// 	$file = $_FILES['file']['tmp_name'];
	// 	$file = curl_file_create($file, mime_content_type($file), pathinfo($file)['basename']);
	// 	curl_setopt($curl, CURLOPT_URL, $result->response->upload_url);
	// 	curl_setopt($curl, CURLOPT_POST, true);
	// 	curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-type: multipart/form-data;charset=utf-8']);
	// 	curl_setopt($curl, CURLOPT_POSTFIELDS, ['file' => $file]);
	// 	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	// 	curl_setopt($curl, CURLOPT_TIMEOUT, 10);
	// 	curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
	// 	$response = json_decode(curl_exec($curl));
	// 	curl_close($curl);
	// 	$request_params = [
	// 	    'access_token' => $token,
	// 	    'v' => '5.101',
	// 	    'file' => $response->file,
	// 	    'title' => $_FILES['file']['name'],
	// 	    'tags' => 'domasha'
	// 	];
	// 	$url = 'https://api.vk.com/method/docs.save?' . http_build_query($request_params);
	// 	$result = json_decode(file_get_contents($url));
	// 	$path = explode('&dl=', $result->response->doc->url)[0];
	// 	$week_data = json_decode(file_get_contents('../hw/'.$week.'.txt'));
	// 	if (!empty($week_data->response)) {
	// 		$lesson_data = $week_data->response->days[$day]->subjects[$lesson];
 //            $lesson_data->docs[count($lesson_data->docs)] = $path;
 //            $week_data->response->days[$day]->subjects[$lesson] = $lesson_data;
 //            if (!empty($path)) {
 //            	file_put_contents('../hw/'.$week.'.txt', json_encode($week_data));
 //            	include 'log.php';
 //            	loger('uploaded_doc', $path);
 //            	echo $path;
 //            }
	// 	}
	// 	else{
	// 		echo "err3";
	// 	}
	// }
	// else{
	// 	echo 'err3';
	// }
?>