<?php
	$notes = json_decode(file_get_contents('notified-users.txt'));
	if ($_POST['type'] == 'add') {
		$notes->response[count($notes->response)] = $_POST['token'];
	}
	elseif ($_POST['type'] == 'check') {
		if (in_array($_POST['token'], $notes->response)) {
			echo true;
		}
		else{
			echo false;
		}
	}
	elseif ($_POST['type'] == 'delete'){
		array_splice($notes->response, array_search($_POST['token'], $notes->response), 1);
	}
	file_put_contents('notified-users.txt', json_encode($notes));
?>