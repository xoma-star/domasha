<?php include 'check_cookie.php'; ?>
<?php
	function mb_ucfirst($str, $encoding='UTF-8')
	{
		$str = mb_ereg_replace('^[\ ]+', '', $str);
		$str = mb_strtoupper(mb_substr($str, 0, 1, $encoding), $encoding).
			   mb_substr($str, 1, mb_strlen($str), $encoding);
		return $str;
	}
	$week = $_GET['w'];
	$day = $_GET['d'];
	include 'log.php';
	$_POST['user'] = $_GET['user'];
	loger('get_day_data', '');
	if (is_numeric($week) && is_numeric($day)) {
		if (file_exists('../hw/'.$week.'.txt')) {
			$week_data = json_decode(file_get_contents('../hw/'.$week.'.txt'));
			$timetable = json_decode(file_get_contents('../timetable.txt'));
			$subjects = json_decode(file_get_contents('../subjects.txt'));
		}
		else{
			?><script id="script_remove">
				$('.icon-close').click();
				$('#script_remove').remove();
			</script><?php
		}
	}
	else{
		?><script id="script_remove">
			$('.icon-close').click();
			$('#script_remove').remove();
		</script><?php
	}
	$day_names = ['Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота'];
	$month_names = ['янв', 'фев', 'мар', 'апр', 'мая', 'июн', 'июл', 'авг', 'сен', 'окт', 'ноя', 'дек'];
?>
<div class="hw-data-header">
	<?php echo $day_names[$day].', '.date('d', strtotime($week_data->response->days[$day]->date)).' '.$month_names[date('m', strtotime($week_data->response->days[$day]->date))-1]; ?>
	(<label class="container-checkmark">выходной
		<input id="weekend-toggler" type="checkbox" <?php
			if ($week_data->response->days[$day]->weekend == 'true') {
				?>checked="checked"<?php
			}
		?>>
		<span class="checkmark"></span>
	</label>)
</div>
<?php
	if (empty($_COOKIE['uid'])) {
		?>
		<style>
			.dropdown-toggle::after{
				display: none !important;
			}
			#hw-text-save{
				display: none !important;
			}
			#hw-docs-save{
				display: none !important;
			}
			#hw-docs-add{
				display: none !important;
			}
			#subject-add{
				display: none !important;
			}
			.dropdown-menu{
				display: none !important;
			}
			#vk_auth{
				margin: 100px auto;
			}
		</style>
		<div id="vk_auth"></div>
		<script type="text/javascript">
		  VK.Widgets.Auth("vk_auth", {"authUrl":"login?w=<?php echo $week; ?>&d=<?php echo $day; ?>"});
		</script>
		<?php
	}
	else{
?>
<div class="hw-data-content">
	<?php
	if (count($week_data->response->days[$day]->subjects) > 0) {
		for ($i=0; $i < count($week_data->response->days[$day]->subjects); $i++) {
			$lesson_data = $week_data->response->days[$day]->subjects[$i];
			if (empty($lesson_data->name)) {
				$lesson_name = $timetable->response[$day][$i];
			}
			else{
				$lesson_name = $lesson_data->name;
			}
			?>
			<div class="btn-group">
				<button type="button" id="subject-cur-<?php echo $i; ?>" class="btn btn-primary" style="margin-right: 0;"><?php echo mb_ucfirst($lesson_name); ?></button>
				<div class="btn-group" role="group">
					<button id="dropdown-subject-<?php echo $i; ?>" type="button" class="btn btn-primary dropdown-toggle primary-reverse"></button>
					<div class="dropdown-menu" lesson="<?php echo $i; ?>" day="<?php echo $day; ?>" week="<?php echo $week; ?>">
						<?php
						for ($z=0; $z < count($subjects->subjects); $z++) { 
							?>
							<span class="dropdown-item change-subjects"><?php echo mb_ucfirst($subjects->subjects[$z]); ?></span>
							<?php
						}
						?>
					</div>
				</div>
			</div>
			<div class="clear-fix" style="margin: 10px 0;"></div>
			<?php
		}
	}
	else{
		?>
		<label>Нет расписания</label><div class="clear-fix"></div>
		<?php
	}
	?>
	<button id="subject-add" class="btn btn-primary">Добавить</button>
	<div class="form-group" id="hw-docs" docs="<?php echo count($week_data->response->days[$day]->notes); ?>">
		<label id="dssq">Объявления</label><div class="clear-fix"></div>
		<?php
		for ($i=0; $i < count($week_data->response->days[$day]->notes); $i++) { 
			?>
			<input autocomplete="off" type="text" id="hw-docs-<?php echo $i; ?>" class="form-control" placeholder="Объявление #<?php echo $i+1; ?>" hw-doc value="<?php echo $week_data->response->days[$day]->notes[$i]; ?>"></div>
			<?php
		}
		?>
		<button id="hw-docs-save" class="btn btn-primary" style="display: none;">Сохранить</button><button id="hw-docs-add" class="btn btn-primary">Добавить</button>
	</div>
</div>
<script>
	$('#hw-docs-save').click(function(){
		var docs_str = '';
		for (var i = 0; i < $('[hw-doc]').length; i++) {
			docs_str += $('#hw-docs-'+i).val()+'☺';
		}
		$.ajax({
			type: 'POST',
			url: 'fc/save-notes.php',
			data: {'d':<?php echo $day; ?>,'w':<?php echo $week; ?>,'docs':docs_str,'user':user},
			success: function(data){
				$('#hw-docs-save').html('Сохранено').attr('disabled', 'true');
				get_tables(<?php echo $week; ?>, 'none', false);
			}
	    });
	});
	var docs = $('#hw-docs').attr('docs');
	$('#hw-docs-add').click(function(){
		if ($('#hw-docs-'+(docs-1)).val() != '' || docs == 0) {
			$('#hw-docs-save').before('<input  autocomplete="off" type="text" id="hw-docs-'+docs+'" class="form-control" placeholder="Объявление #'+(parseInt(docs)+1)+'" hw-doc>');
			docs++;
		}
	});
	$('#subject-add').click(function(){
		var blocks = $('.dropdown-menu').length;
		var text = '<div class="btn-group"><button type="button" id="subject-cur-'+blocks+'" class="btn btn-primary" style="margin-right: 0;">Предмет</button><div class="btn-group" role="group"><button id="dropdown-subject-'+blocks+'" type="button" class="btn btn-primary dropdown-toggle primary-reverse"></button><div class="dropdown-menu" lesson="'+blocks+'" day="<?php echo $day; ?>" week="<?php echo $week; ?>"><?php for ($z=0; $z < count($subjects->subjects); $z++) { ?><span class="dropdown-item change-subjects"><?php echo mb_ucfirst($subjects->subjects[$z]); ?></span><?php } ?></div></div></div><div class="clear-fix" style="margin: 10px 0;"></div>';
		$('#subject-add').before(text);
	});
	<?php	
}
?>
</script>