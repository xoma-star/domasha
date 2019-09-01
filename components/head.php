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
	<link rel="stylesheet" type="text/css" href="css/fonts.css">
	<link async rel="stylesheet" type="text/css" href="css/weather.css">
	<script src="js/jquery.js"></script>
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
	<div class="left-menu block">
		<div class="icon-close" id="hide-menu-left"></div>
		<table class="weather-list">
			<tr class="weather-row-header">
				<td class="weather-temp">
					<span style="color: #f66049;"><?php
					$q = ['янв', 'фев', 'мар', 'апр', 'мая', 'июн', 'июл', 'авг', 'сен', 'окт', 'ноя', 'дек'];
					echo date('j').' '.$q[date('n')-1];
					?></span>
				</td>
				<td class="weather-feels-like">Ощущается как</td>
				<td class="weather-condition"></td>
			</tr>
			<tr class="weather-row" id="weather-morning">
				<td class="weather-temp">
					<div class="weather-temp-daytime">Утром</div>
					<div class="weather-temp-val"></div>
				</td>
				<td class="weather-feels-like"></td>
				<td class="weather-condition"><img src=""><span></span></td>
			</tr>
			<tr class="weather-row" id="weather-day">
				<td class="weather-temp">
					<div class="weather-temp-daytime">Днем</div>
					<div class="weather-temp-val"></div>
				</td>
				<td class="weather-feels-like"></td>
				<td class="weather-condition"><img src=""><span></span></td>
			</tr>
			<tr class="weather-row" id="weather-evening">
				<td class="weather-temp">
					<div class="weather-temp-daytime">Вечером</div>
					<div class="weather-temp-val"></div>
				</td>
				<td class="weather-feels-like"></td>
				<td class="weather-condition"><img src=""><span></span></td>
			</tr>
			<tr class="weather-row" id="weather-night">
				<td class="weather-temp">
					<div class="weather-temp-daytime">Ночью</div>
					<div class="weather-temp-val"></div>
				</td>
				<td class="weather-feels-like"></td>
				<td class="weather-condition"><img src=""><span></span></td>
			</tr>
		</table>
		<?php
			for ($i=1; $i < 7; $i++) { 
				?>
				<table class="weather-list">
					<tr class="weather-row-header">
						<td class="weather-temp">
							<span><?php
							echo date('j',strtotime(date('j.m.Y'))+$i*24*60*60).' '.$q[date('n',strtotime(date('j.m.Y'))+$i*24*60*60)-1];
							?></span>
						</td>
						<td class="weather-feels-like">Ощущается как</td>
						<td class="weather-condition"></td>
					</tr>
					<tr class="weather-row" id="weather-morning-<?php echo $i; ?>">
						<td class="weather-temp">
							<div class="weather-temp-daytime">Утром</div>
							<div class="weather-temp-val"></div>
						</td>
						<td class="weather-feels-like"></td>
						<td class="weather-condition"><img src=""><span></span></td>
					</tr>
					<tr class="weather-row" id="weather-day-<?php echo $i; ?>">
						<td class="weather-temp">
							<div class="weather-temp-daytime">Днем</div>
							<div class="weather-temp-val"></div>
						</td>
						<td class="weather-feels-like"></td>
						<td class="weather-condition"><img src=""><span></span></td>
					</tr>
					<tr class="weather-row" id="weather-evening-<?php echo $i; ?>">
						<td class="weather-temp">
							<div class="weather-temp-daytime">Вечером</div>
							<div class="weather-temp-val"></div>
						</td>
						<td class="weather-feels-like"></td>
						<td class="weather-condition"><img src=""><span></span></td>
					</tr>
					<tr class="weather-row" id="weather-night-<?php echo $i; ?>">
						<td class="weather-temp">
							<div class="weather-temp-daytime">Ночью</div>
							<div class="weather-temp-val"></div>
						</td>
						<td class="weather-feels-like"></td>
						<td class="weather-condition"><img src=""><span></span></td>
					</tr>
				</table>
				<?php
			}
		?>
	</div>
	<div class="right-menu block">
		<div class="icon-close" id="hide-menu-right"></div>
		<div class="menu-items">
			<a href="https://domasha.tk">Главная</a>
			<div class="clear-fix"></div>
			<a rel="noopener" target="_blank" href="https://vk.com/domasha_bot">Блог</a>
			<div class="clear-fix"></div>
			<a rel="noopener" target="_blank" href="https://yasobe.ru/na/domasha">Копилка</a>
			<div class="clear-fix"></div>
			<a id="open_settings">Настройки</a>
			<div class="clear-fix"></div>
			<a id="open_weather">Погода</a>
			<div class="clear-fix"></div>
		<!-- 	<a href="index.php"><li>Бот TG</li></a>
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
				<img alt="<?php echo $name; ?>" src="<?php echo $photo; ?>" class="left">
				<div><?php echo $name; ?></div>
			</div>
		</div>
		<div style="display: none;" id="sun-night" sunrise="0" sunset="0"></div>
	</div>
	<div class="click-to-close"></div>
	<div class="header-wrap">
		<div class="header">
			<!-- <a href="index.php"><li>Главная</li></a>
			<a href="https://vk.me/domasha_bot"><li>Бот ВК</li></a>
			<a href="index.php"><li>Бот TG</li></a> -->
			<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" width="512" height="512" viewBox="0 0 419.901 419.901" xml:space="preserve" class="domasha-logo">
				<g>
					<g>
						<path d="M143.786,121.308h46.688v107.17h-46.688V121.308z M357.655,81.482v256.953c0,12.094-9.84,21.934-21.939,21.934H84.183   c-12.103,0-21.949-9.84-21.949-21.934V81.482c0-12.096,9.84-21.936,21.949-21.936h251.533   C347.815,59.54,357.655,69.386,357.655,81.482z M232.663,121.417c0-8.36-4.323-15.698-12.945-22.003   c-8.634-6.311-18.523-9.465-29.679-9.465h-88.585v169.887h88.729c11.055,0,20.901-3.136,29.529-9.407   c8.628-6.278,12.945-13.621,12.945-22.062v-106.95H232.663z M416.312,39.437v341.025c0,21.781-17.659,39.439-39.434,39.439H43.023   c-21.775,0-39.434-17.658-39.434-39.439V39.437C3.589,17.658,21.248,0,43.023,0h333.856   C398.653,0.006,416.312,17.665,416.312,39.437z M373.207,81.482c0-20.664-16.818-37.488-37.491-37.488H84.183   c-20.67,0-37.494,16.818-37.494,37.488v256.953c0,20.661,16.818,37.485,37.494,37.485h251.533   c20.667,0,37.491-16.818,37.491-37.485V81.482z" class="hovered-path active-path" style="fill:#FFFFFF"></path>
					</g>
				</g>
			</svg>
			<div class="right switch-theme"></div>
		</div>
	</div>