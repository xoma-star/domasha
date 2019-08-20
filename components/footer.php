<div class="notification">
	<img class="bell left" src="img/icons/bell.svg">
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
		$.ajax({
			type: 'GET',
			url: 'fc/get_tables.php',
			data: {'w':w},
			success: function(data){
				var next_w = parseInt(w)+1;
				var prev_w = w-1;
				// if (w-1 <= 0) {
				// 	w = max_w;
				// 	next_w = 2;
				// 	prev_w = w;
				// }
				// if (w == max_w) {
				// 	w = 1;
				// 	prev_w = max_w;
				// 	next_w = 1;
				// }
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
				if (scroll != false) {
					var dest = $('[day-id="'+scroll+'"]').offset().top-100;
					$('html, body').animate({ scrollTop: dest }, 600);
				}
				loader_hide();
				return false;
			},
			error: function(){
				setTimeout(function(){get_tables(w,'none',false)}, 5000);
			}
        });
	}
	$(document).ready(function(){
		<?php
		if (empty($_GET['w'])) {
			$_GET['w'] = date('W');
		}
		?>
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
		if (typeof(params.l) != 'undefined') {
			load_lesson(params.w,params.d,params.l,true);
		}
		else if(typeof(params.d) != 'undefined'){
			load_day(params.w,params.d,true);
		}
		else{
			$('#tables').attr('preloaded', 'true');
			get_tables(<?php echo $_GET['w']; ?>,'?w=<?php echo $_GET['w']; ?>',false);
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
	user.OS = client.getOS();
	user.osVersion = client.getOSVersion();
	//user.screenPrint = client.getScreenPrint();
	// user.plugins = client.getPlugins();
	// user.fonts = client.getFonts();
	user.language = client.getLanguage();
	UpUp.start({
	  'content-url': 'offline.php',
	  'assets': ['css/main.css', 'js/main.js', 'img/icons/offline.svg']
	});
</script>
</html>