<?php
if (!isset($_REQUEST)) {
    return;
}

$confirmationToken = '7ac07239';
$token = 'f62dd59c7af42eda05f24526a6d3d2503a9ad3e0933f2ad5ff717f7375fe03617e408b034fcd25b50add2';
$secretKey = '34dpoiyopi45';

$data = json_decode(file_get_contents('php://input'));

if(strcmp($data->secret, $secretKey) !== 0 && strcmp($data->type, 'confirmation') !== 0)
    return;

switch ($data->type) {
    case 'confirmation':
        echo $confirmationToken;
        break;
    case 'message_new':
        $tokens = json_decode(file_get_contents('notified-users.txt'));
		for ($i=0; $i < count($tokens->response); $i++) { 
			$url = 'https://fcm.googleapis.com/fcm/send';
			$YOUR_API_KEY = 'AAAA8ZbMEsk:APA91bGKhQW-sLsi45Av9VlWvIEJVuF_1J9Ftrt0k5M638Rq1XaXGxSibIOSkzpl4awFZCRHzGpo_r0sGJDlWVkVim7bebnRhoUYqlcWfJoh99DXw3lTkT82ZE8tIbt2k2BO6N8hcl1v';
			$YOUR_TOKEN_ID = $tokens->response[$i];

			$message = explode('~', $data->object->text)[0];
			$link = explode('~', $data->object->text)[1];

			if (empty($link)) {
				$link = 'https://domasha.tk';
			}

			$request_body = [
			    'to' => $YOUR_TOKEN_ID,
			    'data' => [
			        'title' => 'Очень важное уведомление!!',
			        'body' => $message,
			        'icon' => 'https://domasha.tk/img/icons/notification.png',
			        'click_action' => $link,
			    ],
			    'time_to_live' => 60*60*24
			];
			$fields = json_encode($request_body);

			$request_headers = [
			    'Content-Type: application/json',
			    'Authorization: key=' . $YOUR_API_KEY,
			];

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
			curl_setopt($ch, CURLOPT_HTTPHEADER, $request_headers);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
			$response = curl_exec($ch);
			curl_close($ch);

			$response = json_decode($response);
			if ($response->failure == 1) {
				if ($response->results[0]->error == 'NotRegistered') {
					$tmp = json_decode(file_get_contents('notified-users.txt'));
					array_splice($tmp->response, array_search($YOUR_TOKEN_ID, $tmp), 1);
					file_put_contents('notified-users.txt', json_encode($tmp));
				}
			}
		}
		$request_params = array(
            'message' => 'Пользователи ('.$i.') получили уведомление',
            'user_id' => $data->object->from_id,
            'access_token' => $token,
            'v' => '5.101',
            'random_id' => mt_rand(0,255)
        );

        $get_params = http_build_query($request_params);

        file_get_contents('https://api.vk.com/method/messages.send?' . $get_params);
        echo('ok');
        break;
}
?>