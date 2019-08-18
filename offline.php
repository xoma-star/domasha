<html lang="ru"><head>
		<noscript><meta http-equiv="refresh" content="0; URL=badbrowser.php?bad=1"></noscript>
	<script mine="true" type="text/javascript">if(!navigator.cookieEnabled) {window.location = 'badbrowser.php?bad=1'}</script>
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
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<script mine="true" src="https://code.jquery.com/jquery-3.4.1.min.js" type="text/javascript"></script>
	<script mine="true" src="https://vk.com/js/api/openapi.js?162" type="text/javascript"></script>
	<script mine="true" src="js/cookie.js"></script>
	<script mine="true" src="js/night.js"></script>
	<script mine="true" type="text/javascript">
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
		<img src="img/icons/offline.svg" class="offline-icon">
		<span class="offline-text">Нет соединения с сервером.<br>Проверьте подключение к сети.</span>
		<script mine="true">
			setInterval(function(){
				$.ajax({
					type: 'GET',
					url: 'badbrowser.php',
					success: function(){
						window.location.reload();
					}
			    });
			}, 1000);
		</script>
	</div>
	<div class="overlay-image"></div>
	<div class="overlay">
		<img src="img/icons/cancel.svg" class="icon-close">
		<div class="overlay-content"></div>
	</div>
	<div class="header">
		<ul>
			<a href="index.php"><li>Главная</li></a>
			<a href="https://vk.me/domasha_bot"><li>Бот ВК</li></a>
			<a href="index.php"><li>Бот TG</li></a>
		</ul>
	</div>
	<div class="content">
	<div class="block" id="navigation">
		<div class="nav-row">
			<a class="left" id="prev-w" href="?w="><h4><span style="background-color: #afafaf; border-radius: 10px; color: #afafaf;">прндцщая вы</span></h4></a>
			<button class="btn btn-primary" id="calendar-switch">Календарь</button>
			<a class="right" id="next-w" href="?w="><h4><span style="background-color: #afafaf; border-radius: 10px; color: #afafaf;">прндцщая вы</span></h4></a>
			<div class="clear-fix"></div>
			<?php include 'components/calendar.php'; ?>
		</div>
	</div>
	<div id="tables" preloaded="false">
		<div class="block table-wrap">
			<h1 class="day-name"><span style="background-color: #686a73; border-radius: 20px; color: #686a73;">Пидарас, 42 asdsa</span></h1>
			<table>
				<tr class="table-header table-row">
					<th class="subject-name-td">Предмет</th>
					<th>Домашнее задание</th>
				</tr>
				<tr class="table-row">
					<th><span style="background-color: #afafaf; border-radius: 10px; color: #afafaf;">математика</span></th>
					<th><span style="background-color: #afafaf; border-radius: 10px; color: #afafaf;">еееdddеее бооооойй</span><img src="img/icons/more.svg" class="row-more right" width="20"></th>
				</tr>
				<tr class="table-row">
					<th><span style="background-color: #afafaf; border-radius: 10px; color: #afafaf;">математика</span></th>
					<th><img src="img/icons/more.svg" class="row-more right" width="20"></th>
				</tr>
				<tr class="table-row">
					<th><span style="background-color: #afafaf; border-radius: 10px; color: #afafaf;">математика</span></th>
					<th><img src="img/icons/more.svg" class="row-more right" width="20"></th>
				</tr>
				<tr class="table-row">
					<th><span style="background-color: #afafaf; border-radius: 10px; color: #afafaf;">математика</span></th>
					<th><span style="background-color: #afafaf; border-radius: 10px; color: #afafaf;">ееееее боооdasdasоойй</span><img src="img/icons/more.svg" class="row-more right" width="20"></th>
				</tr>
				<tr class="table-row">
					<th><span style="background-color: #afafaf; border-radius: 10px; color: #afafaf;">математика</span></th>
					<th><span style="background-color: #afafaf; border-radius: 10px; color: #afafaf;">ееееее бооооойй</span><img src="img/icons/more.svg" class="row-more right" width="20"></th>
				</tr>
				<tr class="table-row">
					<th><span style="background-color: #afafaf; border-radius: 10px; color: #afafaf;">математика</span></th>
					<th><span style="background-color: #afafaf; border-radius: 10px; color: #afafaf;">ееееее бооооойй</span><img src="img/icons/more.svg" class="row-more right" width="20"></th>
				</tr>
			</table>
		</div>
		<div class="block table-wrap">
			<h1 class="day-name"><span style="background-color: #686a73; border-radius: 20px; color: #686a73;">Пидарас, 42 asdsa</span></h1>
			<table>
				<tr class="table-header table-row">
					<th class="subject-name-td">Предмет</th>
					<th>Домашнее задание</th>
				</tr>
				<tr class="table-row">
					<th><span style="background-color: #afafaf; border-radius: 10px; color: #afafaf;">математика</span></th>
					<th><span style="background-color: #afafaf; border-radius: 10px; color: #afafaf;">еееdddеее бооооойй</span><img src="img/icons/more.svg" class="row-more right" width="20"></th>
				</tr>
				<tr class="table-row">
					<th><span style="background-color: #afafaf; border-radius: 10px; color: #afafaf;">математика</span></th>
					<th><img src="img/icons/more.svg" class="row-more right" width="20"></th>
				</tr>
				<tr class="table-row">
					<th><span style="background-color: #afafaf; border-radius: 10px; color: #afafaf;">математика</span></th>
					<th><img src="img/icons/more.svg" class="row-more right" width="20"></th>
				</tr>
				<tr class="table-row">
					<th><span style="background-color: #afafaf; border-radius: 10px; color: #afafaf;">математика</span></th>
					<th><span style="background-color: #afafaf; border-radius: 10px; color: #afafaf;">ееееее боооdasdasоойй</span><img src="img/icons/more.svg" class="row-more right" width="20"></th>
				</tr>
				<tr class="table-row">
					<th><span style="background-color: #afafaf; border-radius: 10px; color: #afafaf;">математика</span></th>
					<th><span style="background-color: #afafaf; border-radius: 10px; color: #afafaf;">ееееее бооооойй</span><img src="img/icons/more.svg" class="row-more right" width="20"></th>
				</tr>
				<tr class="table-row">
					<th><span style="background-color: #afafaf; border-radius: 10px; color: #afafaf;">математика</span></th>
					<th><span style="background-color: #afafaf; border-radius: 10px; color: #afafaf;">ееееее бооооойй</span><img src="img/icons/more.svg" class="row-more right" width="20"></th>
				</tr>
			</table>
		</div>
		<div class="block table-wrap">
			<h1 class="day-name"><span style="background-color: #686a73; border-radius: 20px; color: #686a73;">Пидарас, 42 asdsa</span></h1>
			<table>
				<tr class="table-header table-row">
					<th class="subject-name-td">Предмет</th>
					<th>Домашнее задание</th>
				</tr>
				<tr class="table-row">
					<th><span style="background-color: #afafaf; border-radius: 10px; color: #afafaf;">математика</span></th>
					<th><span style="background-color: #afafaf; border-radius: 10px; color: #afafaf;">еееdddеее бооооойй</span><img src="img/icons/more.svg" class="row-more right" width="20"></th>
				</tr>
				<tr class="table-row">
					<th><span style="background-color: #afafaf; border-radius: 10px; color: #afafaf;">математика</span></th>
					<th><img src="img/icons/more.svg" class="row-more right" width="20"></th>
				</tr>
				<tr class="table-row">
					<th><span style="background-color: #afafaf; border-radius: 10px; color: #afafaf;">математика</span></th>
					<th><img src="img/icons/more.svg" class="row-more right" width="20"></th>
				</tr>
				<tr class="table-row">
					<th><span style="background-color: #afafaf; border-radius: 10px; color: #afafaf;">математика</span></th>
					<th><span style="background-color: #afafaf; border-radius: 10px; color: #afafaf;">ееееее боооdasdasоойй</span><img src="img/icons/more.svg" class="row-more right" width="20"></th>
				</tr>
				<tr class="table-row">
					<th><span style="background-color: #afafaf; border-radius: 10px; color: #afafaf;">математика</span></th>
					<th><span style="background-color: #afafaf; border-radius: 10px; color: #afafaf;">ееееее бооооойй</span><img src="img/icons/more.svg" class="row-more right" width="20"></th>
				</tr>
				<tr class="table-row">
					<th><span style="background-color: #afafaf; border-radius: 10px; color: #afafaf;">математика</span></th>
					<th><span style="background-color: #afafaf; border-radius: 10px; color: #afafaf;">ееееее бооооойй</span><img src="img/icons/more.svg" class="row-more right" width="20"></th>
				</tr>
			</table>
		</div>
	</div>
</div>
<script mine="true" src="js/main.js" type="text/javascript"></script>
</body>
<script>loader_show()</script>
</html>