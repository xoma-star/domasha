<?php
	$notes = json_decode(file_get_contents('notified-users.txt'));
	if ($_POST['type'] == 'add') {
		$notes->response[count($notes->response)] = $_POST['token'];
	}
	else{
		array_splice($notes->response, array_search($_POST['token'], $notes->response), 1);
	}
	file_put_contents('notified-users.txt', json_encode($notes));
?>