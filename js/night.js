var themes = [
	{
		theme_class:'',
		meta_color:'#FFFFFF'
	},
	{
		theme_class:'night',
		meta_color:'#171717'
	},
	{
		theme_class:'ultra-violet',
		meta_color:'#45316e'
	},
	{
		theme_class:'state-blue',
		meta_color:'#0a1932'
	},
	{
		theme_class:'sea-foam',
		meta_color:'#002828'
	},
	{
		theme_class:'banana',
		meta_color:'#603b08'
	}
];
function set_theme(i,n){
	if (typeof($('html').attr('class')) != 'undefined') {
		var classes = $('html').attr('class').split(' ');
		for (var z = 0; z < themes.length; z++) {
			for (var v = 0; v < classes.length; v++) {
				if (themes[z].theme_class == classes[v] && themes[z].theme_class != themes[i].theme_class) {
				    $('html,body').removeClass(classes[v]);
			    }
			}
		}
	}
	$('meta[name="theme-color"]').attr('content', themes[i].meta_color);
	$('html,body').addClass(themes[i].theme_class);
}
function check_night(){
	var sunset = $('#sun-night').attr('sunset');
	var sunrise = $('#sun-night').attr('sunrise');
	var date = new Date();
	var hours = date.getHours();
	var now = + new Date()/1000+0*60*60;
	$('.theme-block-selected').remove();
	if (localStorage.getItem('theme') != null) {
		$('[theme-type="default"]').children('#theme-'+localStorage.getItem('theme')).append('<div class="theme-block-selected"></div>');
		if (localStorage.getItem('night_a') == 1) {
			$('[theme-type="night"]').children('#theme-'+localStorage.getItem('night_theme')).append('<div class="theme-block-selected"></div>');
			$('#night-toggle-auto').attr('checked', 'checked');
			if (sunset != 0 && sunrise != 0) {
				if (now >= sunrise && now <= sunset) {
					set_theme(localStorage.getItem('theme')-1);
				}
				else{
					if (localStorage.getItem('night_theme') == null) {localStorage.setItem('night_theme', 2)}
					set_theme(localStorage.getItem('night_theme')-1);
				}
			}
			else{
				if (hours < 9 || hours > 19) {
					set_theme(localStorage.getItem('theme')-1);
				}
				else{
					set_theme(localStorage.getItem('night_theme')-1);
				}
			}
		}
		else{
			set_theme(localStorage.getItem('theme')-1);
		}
	}
	else{
		$('[theme-type="default"]').children('#theme-1').append('<div class="theme-block-selected"></div>');
		set_theme(0);
	}
	// if (localStorage.getItem('theme') == 2) {
	// 	$('#night-toggle-auto').parent().parent().show('fast');
	// 	if (localStorage.getItem('night_a') == 1) {
	// 		if (sunset != 0 && sunrise != 0) {
	// 			if (now >= sunrise && now <= sunset) {
	// 				$('html,body').removeClass('night');
	// 				$('meta[name="theme-color"]').attr('content', '#FFFFFF');
	// 			}
	// 			else{
	// 				$('html,body').addClass('night');
	// 				$('meta[name="theme-color"]').attr('content', '#171717');
	// 			}
	// 		}
	// 		else{
	// 			if (hours < 9 || hours > 19) {
	// 				$('html,body').addClass('night');
	// 				$('meta[name="theme-color"]').attr('content', '#171717');
	// 			}
	// 			else{
	// 				$('html,body').removeClass('night');
	// 				$('meta[name="theme-color"]').attr('content', '#FFFFFF');
	// 			}
	// 		}
	// 		$('#night-toggle-auto').attr('checked', 'checked');
	// 		$('#night-toggle').attr('checked', 'checked');
	// 	}
	// 	else{
	// 		$('html,body').addClass('night');
	// 		$('meta[name="theme-color"]').attr('content', '#171717');
	// 		$('#night-toggle').attr('checked', 'checked');
	// 	}
	// 	$('.theme-block-selected').remove();
	// 	$('#theme-2').append('<div class="theme-block-selected"></div>');
	// }
	// else{
	// 	$('meta[name="theme-color"]').attr('content', '#FFFFFF');
	// 	$('html,body').removeClass('night');
	// 	$('#theme-1').append('<div class="theme-block-selected"></div>');
	// }
	// if (Cookies.get('night-auto') == 1 && (hours < 9 || hours > 19)) {
	// 	$('html,body').addClass('night');
	// 	$('#night-toggle-auto').parent().children('input').attr('checked', 'true');
	// }
}
//check_night();