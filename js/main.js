//функции
function load_lesson(w,d,l,p){
	loader_show();
	if (p) {
		history.pushState({'w': w, 'd':d, 'l':l}, null, '?w='+w+'&d='+d+'&l='+l);
	}
	$.ajax({
		type: 'GET',
		url: 'fc/hw-data.php',
		data: {'d':d,'w':w,'l':l},
		success: function(data){
			console.log('Получена информация об уроке (неделя '+w+', день '+d+', урок '+l+')');
			$('.overlay').animate({top:0},100);
			$('body').css('overflow', 'hidden');
			$('.overlay-content').html(data);
			loader_hide();
		}
    });
}
function load_day(w,d,p){
	loader_show();
	if (p) {
		history.pushState({'w': w, 'd':d}, null, '?w='+w+'&d='+d);
	}
	$.ajax({
		type: 'GET',
		url: 'fc/day-data.php',
		data: {'d':d,'w':w},
		success: function(data){
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
			if (data != '') {
				$('#weather-may-rain').show();
				$('#weather-may-rain').children('span').html('В ближайшие 3 часа '+data);
			}
		}
    });
}
function getRandomInt(min, max) {
	return Math.floor(Math.random() * (max - min)) + min;
}

//при загрузке документа
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
		else if (getRandomInt(0,2) > 0){
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
	if ($('#tables').attr('preloaded') == 'false') {
		$('#tables').attr('preloaded', 'true');
		get_tables(params.w, '?w='+params.w, false);
	}
	else{
		history.pushState({'w': params.w}, null, '?w='+params.w);
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
	if (Cookies.get('night') == 0 || typeof(Cookies.get('night')) == 'undefined') {
		Cookies.set('night', 1, { expires: 365 });
		$('#night-toggle-auto').parent().parent().parent().show('fast');
		$('meta[name="theme-color"]').attr('content', '#171717');
		console.log('Установили темную тему');
	}
	else{
		$('meta[name="theme-color"]').attr('content', '#FFFFFF');
		Cookies.set('night', 0, { expires: 365 });
		//Cookies.set('night-auto', 0, { expires: 365 });
		$('#night-toggle-auto').parent().parent().parent().hide('fast');
		//$('#night-toggle-auto').removeAttr('checked');
		console.log('Установили светлую тему');
	}
	check_night();
});
//свичер темной темы авто
$('#night-toggle-auto').change(function(){
	if (Cookies.get('night') == 1) {
		if (Cookies.get('night-auto') == 0 || typeof(Cookies.get('night-auto')) == 'undefined') {
			Cookies.set('night-auto', 1, { expires: 365 });
			console.log('Установили темную тему (авт.)');
			check_night();
		}
		else{
			Cookies.set('night-auto', 0, { expires: 365 });
			console.log('Удалили темную тему(авт.)');
			check_night();
		}
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
		  'VK.Widgets.Auth("vk_auth", {"authUrl":"login.php?w='+params.w+'"});'+
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