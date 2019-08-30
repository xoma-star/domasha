<div class="notification">
	<img class="bell left" src="img/icons/bell.svg" alt="Колокольчик">
	<div class="notification-text"></div>
	<div class="right notification-close"></div>
</div>
<div class="to-top"></div>
<script type="text/javascript">
  if (typeof(VK) == 'undefined') {
	<?php if($_GET['bad'] != 1){ ?>
	window.location = '/badbrowser.php?bad=1';
	<?php } ?>
  }
  VK.init({
    apiId: 7079888
  });
</script>
</body>
<script>
		function get_tables(w,url,scroll){
		if (w > 0) {}
		else{
			w = <?php echo date('W'); ?>;
		}
		var max_w = <?php function get_weeks_in_year($year) 
		{ 	$year--; 
			$date = date('w', mktime(0, 0, 0, 12, 31, $year)); 
			$day = ($date < 4 ? 31 - $date : 31); 
			return date('W', mktime(0, 0, 0, 12, $day, $year)); 
		}
		echo get_weeks_in_year(2019); ?>;
		var min_w = <?php echo date('W', strtotime('01.09.2019')); ?>;
		if (w >= max_w) {
			w = max_w;
		}
		//loader_show();
		$('#tables').attr('loaded', 'false');
		setTimeout(function(){
			if ($('#tables').attr('loaded') == 'false') {
				loader_show();
			}
		},1000);
		$.ajax({
			type: 'GET',
			url: 'fc/get_tables.php',
			data: {'w':w},
			timeout: 5000,
			success: function(data){
				$('#tables').attr('loaded', 'true');
				var next_w = parseInt(w)+1;
				var prev_w = w-1;
				if (w == 1) {
					prev_w = max_w;
				}
				if (w >= max_w) {
					next_w = 1;
				}
				if (url != 'none') {
					history.pushState({'w': w}, null, url);
				}
				$('#tables').html(data).attr('preloaded', 'true');
				$('#prev-w').attr('week', prev_w).attr('href', '?w='+prev_w);
				$('#next-w').attr('week', next_w).attr('href', '?w='+next_w);
				if (typeof(Cookies.get('uid')) != 'undefined') {
				}
				else{
					$('#prev-w').css('cursor','not-allowed').attr('week',w);
					$('#next-w').css('cursor','not-allowed').attr('week',w);
				}
				if (scroll != false) {
					var dest = $('[day-id="'+scroll+'"]').offset().top-100;
					$('html, body').animate({ scrollTop: dest }, 600);
				}
				loader_hide();
				localStorage.setItem('last_page_type', 'week');
				localStorage.setItem('last_page_data', '{"week":"'+w+'"}');
				return false;
			},
			error: function(){
				setTimeout(function(){get_tables(w,'none',false)}, 5000);
				var err_response = '<div class="widget-wrap">'+
										'<div class="block block-notification">'+
											'<img src="data:image/svg+xml;charset=utf-8,%0D%0A%3Csvg%20version%3D%221.1%22%20id%3D%22Layer_1%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20xmlns%3Axlink%3D%22http%3A%2F%2Fwww.w3.org%2F1999%2Fxlink%22%20x%3D%220px%22%20y%3D%220px%22%0D%0A%09%20viewBox%3D%220%200%20473.931%20473.931%22%20style%3D%22enable-background%3Anew%200%200%20473.931%20473.931%3B%22%20xml%3Aspace%3D%22preserve%22%3E%0D%0A%3Ccircle%20style%3D%22fill%3A%23E84849%3B%22%20cx%3D%22236.966%22%20cy%3D%22236.966%22%20r%3D%22236.966%22%2F%3E%0D%0A%3Cpath%20style%3D%22fill%3A%23EDC92C%3B%22%20d%3D%22M409.266%2C333.9L246.676%2C71.853c-1.893-3.057-5.231-4.913-8.823-4.913%0D%0A%09c-3.596%2C0-6.933%2C1.86-8.827%2C4.913L65.997%2C334.618c-1.987%2C3.203-2.088%2C7.233-0.251%2C10.526c1.83%2C3.293%2C5.31%2C5.336%2C9.074%2C5.336h326.072%0D%0A%09h0.045c5.736%2C0%2C10.383-4.651%2C10.383-10.383C411.313%2C337.772%2C410.553%2C335.632%2C409.266%2C333.9z%22%2F%3E%0D%0A%3Cpath%20d%3D%22M225.819%2C242.111l-3.371-50.439c-0.632-9.83-0.943-16.887-0.943-21.167c0-5.826%2C1.527-10.372%2C4.576-13.635%0D%0A%09c3.053-3.274%2C7.079-4.902%2C12.06-4.902c6.039%2C0%2C10.08%2C2.088%2C12.112%2C6.264c2.032%2C4.18%2C3.053%2C10.204%2C3.053%2C18.058%0D%0A%09c0%2C4.636-0.247%2C9.347-0.733%2C14.11l-4.531%2C51.917c-0.49%2C6.181-1.542%2C10.918-3.162%2C14.222c-1.616%2C3.296-4.288%2C4.943-8.004%2C4.943%0D%0A%09c-3.794%2C0-6.425-1.59-7.895-4.789C227.503%2C253.504%2C226.448%2C248.64%2C225.819%2C242.111z%20M237.508%2C311.401%0D%0A%09c-4.284%2C0-8.026-1.381-11.214-4.153c-3.195-2.769-4.789-6.649-4.789-11.633c0-4.355%2C1.527-8.06%2C4.576-11.117%0D%0A%09c3.053-3.053%2C6.795-4.58%2C11.218-4.58c4.426%2C0%2C8.191%2C1.523%2C11.319%2C4.58c3.124%2C3.053%2C4.688%2C6.761%2C4.688%2C11.117%0D%0A%09c0%2C4.913-1.579%2C8.771-4.745%2C11.581C245.403%2C309.997%2C241.721%2C311.401%2C237.508%2C311.401z%22%2F%3E%0D%0A%3C%2Fsvg%3E%0D%0A">'+
											'<span>Не удалось загрузить таблицы. Скоро попробуем снова.</span>'+
											'<div class="clear-fix"></div>'+
										'</div>'+
									'</div>';
				$('#tables').html(err_response);
			}
        });
	}
	$(document).ready(function(){
		var this_week = <?php echo date('W'); ?>;
			var params = window
			.location
			.search
			.replace('?','')
			.split('&')
			.reduce(
			function(p,e){
			    var a = e.split('=');
			    p[ decodeURIComponent(a[0])] = decodeURIComponent(a[1]);
			    return p;
			},
			{}
		);
		if (typeof(params.l) != 'undefined' && typeof(params.d) != 'undefined' && typeof(params.w) != 'undefined') {
			load_lesson(params.w,params.d,params.l,true);
		}
		else if(typeof(params.d) != 'undefined' && typeof(params.w) != 'undefined'){
			load_day(params.w,params.d,true);
		}
		else{
			if (typeof(localStorage.getItem('last_page_type')) != 'undefined' && localStorage.getItem('last_page_type') != null) {
				var last_page_data = JSON.parse(localStorage.getItem('last_page_data'));
				if (typeof(last_page_data.lesson) != 'undefined') {
					load_lesson(last_page_data.week,last_page_data.day,last_page_data.lesson,true);
				}
				else if (typeof(last_page_data.day) != 'undefined') {
					load_day(last_page_data.week,last_page_data.day,true);
				}
				else if (typeof(last_page_data.week) != 'undefined') {
					get_tables(last_page_data.week,'?w='+last_page_data.week,false);
				}
			}
			else{
				if (typeof(params.w) == 'undefined') {
					params.w = this_week;
				}
				$('#tables').attr('preloaded', 'true');
				get_tables(params.w,'?w='+params.w,false);
			}
		}
		setInterval(function(){
			var params = window
				.location
				.search
				.replace('?','')
				.split('&')
				.reduce(
				function(p,e){
				    var a = e.split('=');
				    p[ decodeURIComponent(a[0])] = decodeURIComponent(a[1]);
				    return p;
				},
				{}
			);
			get_tables(params.w,'none',false)
		}, 600000);
	});
</script>
<script src="js/main.js?<?php echo strtotime(date('d.m.Y')); ?>"></script>
<script src="js/client.js"></script>
<script src="js/firebase.js"></script>
<script src="js/push.js"></script>
<script src="upup.js"></script>
<script>
	var client = new ClientJS();
	var user = new Object();
	//user.canvas = client.getCanvasPrint();
	user.browser = client.getBrowser();
	user.browserVersion = client.getBrowserVersion();
	user.browserMajor = client.getBrowserMajorVersion();
	user.OS = client.getOS();
	user.osVersion = client.getOSVersion();
	//user.screenPrint = client.getScreenPrint();
	// user.plugins = client.getPlugins();
	// user.fonts = client.getFonts();
	user.language = client.getLanguage();
	UpUp.start({
	  'content-url': 'offline.php',
	  'assets': [
	  		'css/main.css',
	  		'css/util.css',
	  		'css/loader.css',
  			'js/main.js',
  			'js/jquery.js',
  			'img/icons/offline.svg',
  			'img/icons/warning.svg',
  			'js/night.js',
		]
	});
</script>
</html>