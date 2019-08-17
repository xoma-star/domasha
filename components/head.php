<?php include 'fc/check_cookie.php'; ?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<?php if($_GET['bad'] != 1){ ?>
	<noscript><meta http-equiv="refresh" content="0; URL=badbrowser.php?bad=1"></noscript>
	<script>if(!navigator.cookieEnabled) {window.location = 'badbrowser.php?bad=1'}</script>
	<?php } ?>
	<title>Домаша</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="Robots" content="index">
	<meta name="description" content="ну давай давай нападай">
	<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
	<link rel="manifest" href="/site.webmanifest">
	<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="theme-color" content="#ffffff">
	<link rel="stylesheet" type="text/css" href="css/loader.css">
	<link rel="stylesheet" type="text/css" href="css/main.css?<?php echo strtotime(date('d.m.Y')); ?>">
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	<script src="js/cookie.js"></script>
	<script src="js/night.js"></script>
	<script src="https://vk.com/js/api/openapi.js?162" type="text/javascript"></script>
	<script>
		function loader_show(){
			$('.loader').show();
		}
		function loader_hide(){
			$('.loader').hide();
		}
		loader_show();
	</script>
</head>
<body>
	<div class="loader">
		<div class="spinner spinner-1"></div>
	</div>
	<div class="overlay-image"></div>
	<div class="overlay">
		<div class="icon-close" id="close-overlay"></div>
		<div class="overlay-content"></div>
	</div>
	<div class="right-menu block">
		<div class="icon-close" id="hide-menu-right"></div>
		<ul>
			<a href="index.php"><li>Главная</li></a>
			<div class="clear-fix"></div>
			<a href="https://vk.com/domasha_bot"><li>Блог</li></a>
			<div class="clear-fix"></div>
		<!-- 	<a href="index.php"><li>Бот TG</li></a>
			<div class="clear-fix"></div> -->
			<a><li>Темная тема<label class="switch"><input type="checkbox" id="night-toggle"><span class="slider round"></span></label></li></a>
			<div class="clear-fix"></div>
			<a style="display: none;"><li>Вкл. ночью<label class="switch"><input type="checkbox" id="night-toggle-auto"><span class="slider round"></span></label></li></a>
			<div class="clear-fix"></div>
			<a><li>Уведомления<label class="switch"><input type="checkbox" id="pushes-toggle"><span class="slider round"></span></label></li></a>
			<div class="clear-fix"></div>
			<!-- <a><li>Синхронизация<label class="switch"><input type="checkbox" id="sync-toggle"><span class="slider round"></span></label></li></a>
			<div class="clear-fix"></div> -->
			<div class="user-bar">
				<?php
				if (file_exists('users/'.$_COOKIE['uid'].'.txt')) {
					$user_data = json_decode(file_get_contents('users/'.$_COOKIE['uid'].'.txt'));
					$photo = $user_data->ava;
					$name = $user_data->name;
					$sync = $user_data->sync;
					$night = $user_data->night;
					$night_auto = $user_data->{'night-auto'};
					$logined = 1;
				}
				else{
					$photo = 'img/icons/user.svg';
					$names = ['Войти'];
					$name = $names[mt_rand(0,count($names)-1)];
					$sync = 0;
					if (!empty($_COOKIE['night'])) {
						$night = $_COOKIE['night'];
					}
					else{
						$night = 0;
					}
					if (!empty($_COOKIE['night-auto'])) {
						$night_auto = $_COOKIE['night-auto'];
					}
					else{
						$night_auto = 0;
					}
					$logined = 0;
				}
				?>
				<div style="display: none;" id="user_sets"></div>
				<img src="<?php echo $photo; ?>" class="left">
				<div><?php echo $name; ?></div>
			</div>
		</ul>
		<div style="display: none;" id="sun-night" sunrise="0" sunset="0"></div>
	</div>
	<div class="click-to-close"></div>
	<div class="header">
		<ul>
			<!-- <a href="index.php"><li>Главная</li></a>
			<a href="https://vk.me/domasha_bot"><li>Бот ВК</li></a>
			<a href="index.php"><li>Бот TG</li></a> -->
			<li>Домаша</li>
			<div class="right switch-theme"></div>
		</ul>
	</div>