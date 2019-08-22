<?php
	// header("X-XSS-Protection: 1; mode=block");
	// header("Referrer-Policy: no-referrer");
	// header("Referrer-Policy: strict-origin-when-cross-origin");
	// //header("X-Frame-Options:sameorigin");
	// header("X-Permitted-Cross-Domain-Policies: none");
	// header('Strict-Transport-Security: max-age=31536000; includeSubDomains; preload');
	// header("X-Content-Type-Options: nosniff");
	// header_remove('x-powered-by');
	if (!empty($_COOKIE['uid'])) {
		$hash_c = md5('7079888'.$_COOKIE['uid'].'jUhorzTpmcklflMOlli8');
		if ($hash_c != $_COOKIE['hash']) {
			setcookie('uid', $uid, -1);
			setcookie('hash', $hash_c, -1);
			header('Location: https://domasha.tk');
		}
	}
?>