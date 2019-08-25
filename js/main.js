//функции
function load_lesson(w,d,l,p){
	//loader_show();
	if ($('#tables').attr('preloaded') == 'false') {
		check_sundata();
	}
	if (p) {
		history.pushState({'w': w, 'd':d, 'l':l}, null, '?w='+w+'&d='+d+'&l='+l);
	}
	$.ajax({
		type: 'GET',
		url: 'fc/hw-data.php',
		data: {'d':d,'w':w,'l':l},
		success: function(data){
			localStorage.setItem('last_page_type', 'lesson');
			localStorage.setItem('last_page_data', '{"week":'+w+',"day":'+d+',"lesson":'+l+'}');
			console.log('Получена информация об уроке (неделя '+w+', день '+d+', урок '+l+')');
			$('.overlay').animate({top:0},100);
			$('body').css('overflow', 'hidden');
			$('.overlay-content').html(data);
			loader_hide();
		}
    });
}
function load_day(w,d,p){
	//loader_show();
	if ($('#tables').attr('preloaded') == 'false') {
		check_sundata();
	}
	if (p) {
		history.pushState({'w': w, 'd':d}, null, '?w='+w+'&d='+d);
	}
	$.ajax({
		type: 'GET',
		url: 'fc/day-data.php',
		data: {'d':d,'w':w},
		success: function(data){
			localStorage.setItem('last_page_type', 'day');
			localStorage.setItem('last_page_data', '{"week":'+w+',"day":'+d+'}');
			console.log('Получена информация о дне (неделя '+w+', день '+d+')');
			$('.overlay').animate({top:0},100);
			$('body').css('overflow', 'hidden');
			$('.overlay-content').html(data);
			loader_hide();
		}
    });
}
function open_doc(src){
	var preload = '<div class="document_preload">'+
		'<div class="cssload-inner cssload-one"></div>'+
  		'<div class="cssload-inner cssload-two"></div>'+
  		'<div class="cssload-inner cssload-three"></div>'+
  	'</div>'+
  	'<iframe onload="$(\'.document_preload\').remove()" src="'+src+'"></iframe>';
	$('.overlay-image').show().html(preload);
	$('.overlay-image').children('iframe').height($(window).height()/1.2);
	$('.overlay').css('overflow', 'hidden');
	show_notification('Не загрузился документ? <u style="cursor: pointer;" onclick="window.open(\''+src+'\', \'_blank\')">Жми сюда</u>');
}
function show_notification(text){
	$('.notification').addClass('shown');
	$('.notification-text').html(text);
}
function check_weather(){
	$.ajax({
		type: 'GET',
		url: 'fc/check_weather.php',
		success: function(data){
			var weather_data = JSON.parse(data);
			if (weather_data.may_rain == true) {
				$('#weather-may-rain').show();
				$('#weather-may-rain').children('span').html('В ближайшие 3 часа '+weather_data.rain);
			}
			var weather_today = parseInt(weather_data.weather_today);
			var weather_tomorrow = parseInt(weather_data.weather_tomorrow);
			if (weather_today - weather_tomorrow > 5) {
				$('#weather-cold').show();
				$('#weather-cold').children('span').html('Завтра похолодание ('+(weather_tomorrow)+'°C)');
			}
		}
    });
}
function check_sundata(){
	$.ajax({
		type: 'GET',
		url: 'fc/get_sun_data.php',
		success: function(data){
			var jjj = JSON.parse(data);
			$('#sun-night').attr('sunset', jjj.sunset).attr('sunrise', jjj.sunrise);
			check_night();
		}
    });
}
function getRandomInt(min, max) {
	return Math.floor(Math.random() * (max - min)) + min;
}
function show_bad_browser(){
	var bad_browser = '<div class="widget-wrap">'+
		'<div style="display:block;" class="block block-notification" id="weather-may-rain">'+
			'<img src="data:image/svg+xml;charset=utf-8,%0D%0A%3Csvg%20version%3D%221.1%22%20id%3D%22Layer_1%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20xmlns%3Axlink%3D%22http%3A%2F%2Fwww.w3.org%2F1999%2Fxlink%22%20x%3D%220px%22%20y%3D%220px%22%0D%0A%09%20viewBox%3D%220%200%20473.931%20473.931%22%20style%3D%22enable-background%3Anew%200%200%20473.931%20473.931%3B%22%20xml%3Aspace%3D%22preserve%22%3E%0D%0A%3Ccircle%20style%3D%22fill%3A%23E84849%3B%22%20cx%3D%22236.966%22%20cy%3D%22236.966%22%20r%3D%22236.966%22%2F%3E%0D%0A%3Cpath%20style%3D%22fill%3A%23EDC92C%3B%22%20d%3D%22M409.266%2C333.9L246.676%2C71.853c-1.893-3.057-5.231-4.913-8.823-4.913%0D%0A%09c-3.596%2C0-6.933%2C1.86-8.827%2C4.913L65.997%2C334.618c-1.987%2C3.203-2.088%2C7.233-0.251%2C10.526c1.83%2C3.293%2C5.31%2C5.336%2C9.074%2C5.336h326.072%0D%0A%09h0.045c5.736%2C0%2C10.383-4.651%2C10.383-10.383C411.313%2C337.772%2C410.553%2C335.632%2C409.266%2C333.9z%22%2F%3E%0D%0A%3Cpath%20d%3D%22M225.819%2C242.111l-3.371-50.439c-0.632-9.83-0.943-16.887-0.943-21.167c0-5.826%2C1.527-10.372%2C4.576-13.635%0D%0A%09c3.053-3.274%2C7.079-4.902%2C12.06-4.902c6.039%2C0%2C10.08%2C2.088%2C12.112%2C6.264c2.032%2C4.18%2C3.053%2C10.204%2C3.053%2C18.058%0D%0A%09c0%2C4.636-0.247%2C9.347-0.733%2C14.11l-4.531%2C51.917c-0.49%2C6.181-1.542%2C10.918-3.162%2C14.222c-1.616%2C3.296-4.288%2C4.943-8.004%2C4.943%0D%0A%09c-3.794%2C0-6.425-1.59-7.895-4.789C227.503%2C253.504%2C226.448%2C248.64%2C225.819%2C242.111z%20M237.508%2C311.401%0D%0A%09c-4.284%2C0-8.026-1.381-11.214-4.153c-3.195-2.769-4.789-6.649-4.789-11.633c0-4.355%2C1.527-8.06%2C4.576-11.117%0D%0A%09c3.053-3.053%2C6.795-4.58%2C11.218-4.58c4.426%2C0%2C8.191%2C1.523%2C11.319%2C4.58c3.124%2C3.053%2C4.688%2C6.761%2C4.688%2C11.117%0D%0A%09c0%2C4.913-1.579%2C8.771-4.745%2C11.581C245.403%2C309.997%2C241.721%2C311.401%2C237.508%2C311.401z%22%2F%3E%0D%0A%3C%2Fsvg%3E%0D%0A">'+
			'<span>Браузер не поддерживается. Некоторые функции могут работать неправильно</span>'+
			'<div class="clear-fix"></div>'+
		'</div>'+
	'</div>';
	$('#tables').before(bad_browser);
}

//при загрузке документа
//хуевый браузер
$(document).ready(function(){
	if (user.browser == 'Chrome') {
		if (user.browserMajor < 45) {
			show_bad_browser();
		}
	}
	else if(user.browser == 'Firefox'){
		if (user.browserMajor < 44) {
			show_bad_browser();
		}
	}
	else if(user.browser == 'Yandex'){
		if (user.browserMajor < 45) {
			show_bad_browser();
		}
	}
	else if(user.browser == 'Opera'){
		if (user.browserMajor < 32) {
			show_bad_browser();
		}
	}
	else if(user.browser == 'Safari'){
		if (user.browserMajor < 11) {
			show_bad_browser();
		}
	}
	else{
		show_bad_browser();
	}
});
//уведомления
$(document).ready(function(){
	var chance = getRandomInt(0,1);
	//if (chance > 0) {
		if (typeof(Cookies.get('uid')) == 'undefined') {
			setTimeout(function(){
				show_notification('Войди в аккаунт, чтобы получить больше возможностей (<u style="cursor: pointer;" onclick="$(\'.switch-theme\').click();$(\'.user-bar\').click();$(\'.notification-close\').click();">Войти</u>)');
			},5000);
		}
		else if (!($('#pushes-toggle').is(':checked')) && getRandomInt(0,1) > 0) {
			setTimeout(function(){
				show_notification('Уведомления помогут не пропустить ничего важного (<u style="cursor: pointer;" onclick="$(\'.switch-theme\').click();$(\'#pushes-toggle\').click();$(\'.notification-close\').click();">Включить</u>)');
			},5000);
		}
		else if (getRandomInt(0,2) > 1){
			setTimeout(function(){
				show_notification('Каждый месяц необходимо 120 Р. на хостинг для сайта. (<a href="https://yasobe.ru/na/domasha" target="_blank"><u style="cursor: pointer;" onclick="$(\'.notification-close\').click();">Поддержать</u></a>)');
			},5000);
		}
	//}
});
//удаление банера хостинга
$(document).ready(function(){
	$('[style="text-align: right;position: fixed;z-index:9999999;bottom: 0;width: auto;right: 1%;cursor: pointer;line-height: 0;display:block !important;"]').remove();
});
//скрытие скриптов хостинга
$(document).ready(function(){
	//$('script[mine!="true"]').remove();
});
//подгрузка навигации
$(document).ready(function(){
	if (window.innerWidth < 1000) {
		$('#next-w').children().text('след. >>');
		$('#prev-w').children().text('<< пред.');
	}
	else{
		$('#next-w').children().text('Следующая неделя');
		$('#prev-w').children().text('Предыдущая неделя');
	}
});
//чекаем ночь, чтобы включить тему
$(document).ready(function(){
	setInterval(function(){check_night()}, 5000)
});
//показ панели из-за transition
$(document).ready(function(){
	$('.right-menu').show();
});


//взаимодействие с интерфейсом
//показать/скрыть календарь
$('#calendar-switch').click(function(){
	if ($('.calendar_new').css('display') == 'none') {
		$('.calendar_new').show();
		$('#calendar-switch').text('Закрыть').addClass('btn-deny').removeClass('btn-primary');
	}
	else{
		$('.calendar_new').hide();
		$('#calendar-switch').text('Календарь').addClass('btn-primary').removeClass('btn-deny');
	}
});
//показать/скрыть выпадающий список
$(document).on('click', '.dropdown-toggle', function(){
	if ($(this).parent().children('.dropdown-menu').css('display') == 'none') {
		$(this).parent().children('.dropdown-menu').show();
	}
	else{
		$(this).parent().children('.dropdown-menu').hide();
	}
});
//закрыть уведомление
$('.notification-close').click(function(){
	$('.notification').removeClass('shown').css('transform', 'translateY('+($('.notification').height()+20)+'px)');
});
//загрузка недели через навигацию
$('#prev-w,#next-w').click(function(){
	get_tables($(this).attr('week'),$(this).attr('href'),false);
	return false;
});
//загрузка недели через календарь
$('[calendar_week]').children('th').click(function(e){
	if ($(this).attr('scrollto') != 6) {
		get_tables($(this).parent().attr('calendar_week'),'?w='+$(this).parent().attr('calendar_week'),$(this).attr('scrollto'));
		
	}
	else{
		get_tables($(this).parent().attr('calendar_week'),'?w='+$(this).parent().attr('calendar_week'),false);				
	}
	$('.calendar_new').hide();
	$('#calendar-switch').text('Календарь').addClass('btn-primary').removeClass('btn-deny');
});
//показать/скрыть иконку в таблице через которуб переход в daydata
$(document).on('mousemove', 'tr', function(){
	if (window.innerWidth > 1000) {
		$(this).children('th').children('.row-more').show()
	}
}).on('mouseleave', 'tr', function(){
	if (window.innerWidth > 1000) {
		$(this).children('th').children('.row-more').hide()
	}
});
//закрыть оверлей(1)
$('#close-overlay').click(function(){
	$('.overlay').animate({top:'-100%'},100);
	$('body').css('overflow', 'auto');
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
	localStorage.setItem('last_page_type', 'week');
	localStorage.setItem('last_page_data', '{"week":'+params.w+'}');
	if ($('#tables').attr('preloaded') == 'false') {
		$('#tables').attr('preloaded', 'true');
		get_tables(params.w, '?w='+params.w, false);
	}
	else{
		history.pushState({'w': params.w}, null, '?w='+params.w);
	}
});
//смена аудитории
var aud_cur;
$(document).on('focusin', '[aud-change]', function(){
	aud_cur = $(this).val();
});
$(document).on('focusout', '[aud-change]', function(){
	if ($(this).val() != aud_cur) {
		var l = $(this).parent().attr('lesson');
		var w = $(this).parent().attr('week');
		var d = $(this).parent().attr('day');
		$.ajax({
			type: 'POST',
			url: 'fc/change-aud.php',
			data: {'d':d,'w':w,'l':l,'a':$(this).val(),'user':user},
			success: function(data){
				console.log('Изменена аудитория на '+data+' (неделя '+w+', день '+d+', урок '+l+')');
				get_tables(w, 'none', false);
			}
	    });
	}
});
//при наборе текста в поле задания
$(document).on('keyup', '#hw-text', function(){
	if ($(this).val() != '') {
		$('#hw-text-save').show().removeAttr('disabled').html('Сохранить');
	}
	else{
		$('#hw-text-save').hide();
	}
});
//при наборе текста в полях докуметов/объявлений
$(document).on('keyup', '[hw-doc]', function(){
	if ($(this).val() != '') {
		$('#hw-docs-save').show().removeAttr('disabled').html('Сохранить');
	}
	else{
		//$('#hw-docs-save').hide();
	}
});
//взаимодействие со стрелочками возле урла
window.addEventListener("popstate", function(e) {
	if (typeof(e.state.l) != 'undefined') {
		load_lesson(e.state.w,e.state.d,e.state.l,false);
	}
	else if(typeof(e.state.d) != 'undefined'){
		load_day(e.state.w,e.state.d,false);
	}
	else{
		$('.overlay').animate({top:'-100%'},100);
		$('body').css('overflow', 'auto');
		get_tables(e.state.w,'none',false);
	}
});
//нажал на иконку в таблице которая ведет в hw-data
$(document).on('click', '.row-more,.includes', function(){
	var l = $(this).parent().parent().attr('lesson');
	var d = $(this).parent().parent().parent().parent().parent().attr('day-id');
	var w = params.w;
	load_lesson(w,d,l,true);
});
//нажал на иконку в таблице которая ведет в day-data
$(document).on('click', '.day-name', function(){
	var d = $(this).parent().attr('day-id');
	var w = params.w;
	load_day(w,d,true);
});
//нажал на предмет из выпадающего списка (поменял предмет) day-data
$(document).on('click', '.change-subjects', function(){
	loader_show();
	var l = $(this).parent().attr('lesson');
	var w = $(this).parent().attr('week');
	var d = $(this).parent().attr('day');
	$.ajax({
		type: 'POST',
		url: 'fc/change-subject.php',
		data: {'d':d,'w':w,'l':l,'n':$(this).text(),'user':user},
		success: function(data){
			console.log('Изменен предмет на '+data+' (неделя '+w+', день '+d+', урок '+l+')');
			$('#subject-cur-'+l).html(data);
			$('#dropdown-subject-'+l).click();
			get_tables(w, 'none', false);
			if (data == 'Удалить') {
				load_day(w,d,false);
			}
		}
    });
});
//нажал на предмет из выпадающего списка (поменял предмет) hw-data
$(document).on('click', '.change-subject', function(){
	loader_show();
	var l = $(this).parent().attr('lesson');
	var w = $(this).parent().attr('week');
	var d = $(this).parent().attr('day');
	$.ajax({
		type: 'POST',
		url: 'fc/change-subject.php',
		data: {'d':d,'w':w,'l':l,'n':$(this).text(),'user':user},
		success: function(data){
			console.log('Изменен предмет на '+data+' (неделя '+w+', день '+d+', урок '+l+')');
			$('#subject-cur').html(data);
			get_tables(w, 'none', false);
			$('#dropdown-subject').click();
			if (data == 'Удалить') {
				$('#close-overlay').click();
			}
		}
    });
});
//закрыть оверлей(2) и если удалил то удалить
$('.overlay-image').click(function(e){
	$('.overlay').css('overflow', 'auto');
	if (e.target.className == 'hw-img-remove') {
		var d = $('.hw-img-remove').attr('day');
		var w = $('.hw-img-remove').attr('week');
		var l = $('.hw-img-remove').attr('lesson');
		$.ajax({
			type: 'POST',
			url: 'fc/photo-remove.php',
			data: {'d':d,'w':w,'l':l,'src':$('[photo-overlay]').attr('src'),'user':user},
			success: function(data){
				console.log('Удалено фото (неделя '+w+', день '+d+', урок '+l+')');
				$('[src="'+$('[photo-overlay]').attr('src')+'"]').remove();
				$('.overlay-image').click();
			}
	    });
	}
	else{
		$('.notification-close').click();
		$(this).hide();
	}
});
//показать/скрыть шестеренку возле day-name
$(document).on('mousemove', '.day-name', function(){
	$(this).children('img').show();
}).on('mouseleave', '.day-name', function(){
	$(this).children('img').hide();
});
//свичер темной темы
$('#night-toggle').change(function(){
	// if (Cookies.get('night') == 0 || typeof(Cookies.get('night')) == 'undefined') {
	// 	Cookies.set('night', 1, { expires: 365 });
	// 	$('#night-toggle-auto').parent().parent().parent().show('fast');
	// 	$('meta[name="theme-color"]').attr('content', '#171717');
	// 	console.log('Установили темную тему');
	// }
	// else{
	// 	$('meta[name="theme-color"]').attr('content', '#FFFFFF');
	// 	Cookies.set('night', 0, { expires: 365 });
	// 	//Cookies.set('night-auto', 0, { expires: 365 });
	// 	$('#night-toggle-auto').parent().parent().parent().hide('fast');
	// 	//$('#night-toggle-auto').removeAttr('checked');
	// 	console.log('Установили светлую тему');
	// }
	if ($(this).is(':checked')) {
		localStorage.setItem('night', 1);
		$('#night-toggle-auto').parent().parent().parent().show('fast');
		$('meta[name="theme-color"]').attr('content', '#171717');
		console.log('Установили темную тему');
	}
	else{
		$('meta[name="theme-color"]').attr('content', '#FFFFFF');
		localStorage.setItem('night', 0);
		$('#night-toggle-auto').parent().parent().parent().hide('fast');
		console.log('Установили светлую тему');
	}
	check_night();
});
//свичер темной темы авто
$('#night-toggle-auto').change(function(){
	if (localStorage.getItem('night') == 1) {
		// if (Cookies.get('night-auto') == 0 || typeof(Cookies.get('night-auto')) == 'undefined') {
		// 	Cookies.set('night-auto', 1, { expires: 365 });
		// 	console.log('Установили темную тему (авт.)');
		// 	check_night();
		// }
		// else{
		// 	Cookies.set('night-auto', 0, { expires: 365 });
		// 	console.log('Удалили темную тему(авт.)');
		// 	check_night();
		// }
		if ($(this).is(':checked')) {
			localStorage.setItem('night_a', 1);
			console.log('Установили темную тему auto');
		}
		else{
			localStorage.setItem('night_a', 0);
			console.log('Установили светлую тему auto');
		}
		check_night();
	}
});
//свичер синхронизации
$('#sync-toggle').change(function(){
	if (Cookies.get('sync') == 0 || typeof(Cookies.get('sync')) == 'undefined') {
		Cookies.set('sync', 1, { expires: 365 });
		console.log('Включили синхронизацию настроек');
	}
	else {
		Cookies.set('sync', 0, { expires: 365 });
		console.log('Отключили синхронизацию настроек');
	}
});
//показать/скрыть менюшку
$('.switch-theme,#hide-menu-right,.click-to-close').click(function(){
	$('.right-menu').toggleClass('shown');
	$('.content').toggleClass('blured');
	$('.click-to-close').toggleClass('jfj');
});
//взаимодействие с юзербаром внизу менюшки
$('.user-bar').click(function(){
	if (typeof(Cookies.get('uid')) == 'undefined') {
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
		$(this).html(
		'<div id="vk_auth"></div>'+
		'<script mine="true" type="text/javascript">'+
		  'VK.Widgets.Auth("vk_auth", {"authUrl":"login?w='+params.w+'"});'+
		'</script>');
	}
});
//иконка "наверх"
$(window).scroll(function(){
	if ($(window).scrollTop() > 300) {
		$('.to-top').show();
	}
	else{
		$('.to-top').hide();
	}
});
//переместить вверх
$('.to-top').click(function(){
	$('html,body').animate({scrollTop:0},100);
});
$(document).on('change', '#weekend-toggler', function(){
	loader_show();
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
	$.ajax({
		type: 'POST',
		url: 'fc/weekend.php',
		data: {'d':params.d,'w':params.w,'c':$(this).is(':checked'),'user':user},
		success: function(data){
			get_tables(params.w, 'none', false);
		}
    });

});