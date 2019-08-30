function check_night(){
	var sunset = $('#sun-night').attr('sunset');
	var sunrise = $('#sun-night').attr('sunrise');
	var date = new Date();
	var hours = date.getHours();
	var now = + new Date()/1000+0*60*60;
	if (localStorage.getItem('theme') == 2) {
		$('#night-toggle-auto').parent().parent().show('fast');
		if (localStorage.getItem('night_a') == 1) {
			if (sunset != 0 && sunrise != 0) {
				if (now >= sunrise && now <= sunset) {
					$('html,body').removeClass('night');
					$('meta[name="theme-color"]').attr('content', '#FFFFFF');
				}
				else{
					$('html,body').addClass('night');
					$('meta[name="theme-color"]').attr('content', '#171717');
				}
			}
			else{
				if (hours < 9 || hours > 19) {
					$('html,body').addClass('night');
					$('meta[name="theme-color"]').attr('content', '#171717');
				}
				else{
					$('html,body').removeClass('night');
					$('meta[name="theme-color"]').attr('content', '#FFFFFF');
				}
			}
			$('#night-toggle-auto').attr('checked', 'checked');
			$('#night-toggle').attr('checked', 'checked');
		}
		else{
			$('html,body').addClass('night');
			$('meta[name="theme-color"]').attr('content', '#171717');
			$('#night-toggle').attr('checked', 'checked');
		}
		$('#theme-2').append('<div class="theme-block-selected"></div>');
	}
	else{
		$('meta[name="theme-color"]').attr('content', '#FFFFFF');
		$('html,body').removeClass('night');
		$('#theme-1').append('<div class="theme-block-selected"></div>');
	}
	// if (Cookies.get('night-auto') == 1 && (hours < 9 || hours > 19)) {
	// 	$('html,body').addClass('night');
	// 	$('#night-toggle-auto').parent().children('input').attr('checked', 'true');
	// }
}
//check_night();