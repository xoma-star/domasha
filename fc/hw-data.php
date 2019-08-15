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
	$lesson = $_GET['l'];
	include 'log.php';
	$_POST['user'] = $_GET['user'];
	loger('get_hw_data', '');
	if (is_numeric($week) && is_numeric($day) && is_numeric($lesson)) {
		if (file_exists('../hw/'.$week.'.txt')) {
			$week_data = json_decode(file_get_contents('../hw/'.$week.'.txt'));
			$lesson_data = $week_data->response->days[$day]->subjects[$lesson];
			$timetable = json_decode(file_get_contents('../timetable.txt'));
			$subjects = json_decode(file_get_contents('../subjects.txt'));
			if (empty($lesson_data->name)) {
				$lesson_name = $timetable->response[$day][$lesson];
			}
			else{
				$lesson_name = $lesson_data->name;
			}
		}
		else{
			?><script mine="true" id="script_remove">
				$('.icon-close').click();
				$('#script_remove').remove();
			</script><?php
		}
	}
	else{
		?><script mine="true" id="script_remove">
			$('.icon-close').click();
			$('#script_remove').remove();
		</script><?php
	}
	$day_names = ['понедельник', 'вторник', 'среду', 'четверг', 'пятницу', 'субботу'];
	$month_names = ['янв', 'фев', 'мар', 'апр', 'мая', 'июн', 'июл', 'авг', 'сен', 'окт', 'ноя', 'дек'];
?>
<div class="hw-data-header">
	Задание на <?php echo $day_names[$day].', '.date('d', strtotime($week_data->response->days[$day]->date)).' '.$month_names[date('m', strtotime($week_data->response->days[$day]->date))-1].' ('.$lesson_name.')'; ?>
</div>
<?php
	if (empty($_COOKIE['uid'])) {
		?>
		<style>
			#dropdown-subject::after{
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
			#hw-img-label{
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
		<script mine="true" type="text/javascript">
		  VK.Widgets.Auth("vk_auth", {"authUrl":"login?w=<?php echo $week; ?>&d=<?php echo $day; ?>&l=<?php echo $lesson; ?>"});
		</script>
		<?php
	}
	else{
?>
<div class="hw-data-content">
	<div class="btn-group">
		<button type="button" id="subject-cur" class="btn btn-primary" style="margin-right: 0;"><?php echo mb_ucfirst($lesson_name); ?></button>
		<div class="btn-group" role="group">
			<button id="dropdown-subject" type="button" class="btn btn-primary dropdown-toggle primary-reverse"></button>
			<div class="dropdown-menu" lesson="<?php echo $lesson; ?>" day="<?php echo $day; ?>" week="<?php echo $week; ?>">
				<?php
				for ($i=0; $i < count($subjects->subjects); $i++) { 
					?>
					<span class="dropdown-item change-subject"><?php echo mb_ucfirst($subjects->subjects[$i]); ?></span>
					<?php
				}
				?>
			</div>
		</div>
	</div>
	<div class="form-group">
		<label>Задание</label>
		<textarea class="form-control" id="hw-text"><?php echo str_replace('<br>', "\n", $lesson_data->hw); ?></textarea>
		<button id="hw-text-save" class="btn btn-primary" style="display: none;">Сохранить</button>
	</div>
	<div class="form-group" id="hw-docs" docs="<?php echo count($lesson_data->docs); ?>">
		<label id="dssq">Документы</label>
		<div class="clear-fix"></div>
		<label style="font-size: 0.8em; opacity: .5;">чтобы удалить, оставьте пустым</label>
		<div class="clear-fix"></div>
		<?php
		for ($i=0; $i < count($lesson_data->docs); $i++) {
			// if (stripos($lesson_data->docs[$i], '.doc') !== false || stripos($lesson_data->docs[$i], '.xml') !== false) {
			// 	$url_to_open = 'https://view.officeapps.live.com/op/view.aspx?src='.urlencode($lesson_data->docs[$i]);
			// }
			// else{
			// 	$url_to_open = $lesson_data->docs[$i];
			// }
			?>
			<input  autocomplete="off" style="width: 70%; display: inline-block;" type="text" id="hw-docs-<?php echo $i; ?>" class="form-control" placeholder="Документ #<?php echo $i+1; ?>" hw-doc value="<?php echo $lesson_data->docs[$i]->name; ?>" src="<?php echo $lesson_data->docs[$i]->path; ?>"><img src="img/icons/open.svg" class="open-icon" onclick="open_doc('<?php echo $lesson_data->docs[$i]->path; ?>')"><div class="clear-fix"></div>
			<?php
		}
		?>
		<button id="hw-docs-save" class="btn btn-primary" style="display: none;">Сохранить</button>
		<button id="hw-docs-add" class="btn btn-primary">Добавить ссылку</button>
		<label for="hw-doc-upload" id="hw-doc-upload-label" class="btn btn-primary">Выбрать</label>
		<button style="display: none;" id="hw-doc-upload-confirm" class="btn btn-primary">Загрузить</button>
		<label style="display: none;" class="container">Через ВК api
		  <input id="load-via-api" type="checkbox" checked="checked">
		  <span class="checkmark"></span>
		</label>
		<input type="file" id="hw-doc-upload" style="display: none;">
	</div>
	<div class="form-group">
		<label>Картинки</label><div class="clear-fix"></div>
		<label for="hw-img" id="hw-img-label" class="btn btn-primary">Выбрать</label><button id="hw-img-upload" class="btn btn-primary" style="display: none;">Загрузить</button>
		<div class="clear-fix"></div>
		<?php
		for ($i=0; $i < count($lesson_data->images); $i++) { 
			?>
			<img src="<?php echo $lesson_data->images[$i]; ?>" class="hw-img-thumbnail">
			<?php
		}
		?>
		<input type="file" id="hw-img" style="display: none;" accept="image/jpeg,image/png" multiple>
	</div>
</div>
<script>
	$(document).on('focusin', '[hw-doc]', function(){
		var temp_name = $(this).val();
		$(this).attr('name', temp_name).val($(this).attr('src'));
	}).on('focusout', '[hw-doc]', function(){
		if ($(this).val() != '' && $(this).attr('created') != 'true' && $(this).val() == $(this).attr('src')) {
			$(this).val($(this).attr('name'));
		}
	});
	$('#hw-text-save').click(function(){
		$.ajax({
			type: 'POST',
			url: 'fc/save-hw.php',
			data: {'d':<?php echo $day; ?>,'w':<?php echo $week; ?>,'l':<?php echo $lesson; ?>,'hw':$('#hw-text').val(),'user':user},
			success: function(data){
				$('#hw-text-save').html('Сохранено').attr('disabled', 'true');
				get_tables(<?php echo $week; ?>, 'none', false);
			}
	    });
	});
	$('#hw-docs-save').click(function(){
		var docs_str = '';
		$('#hw-docs').children('img,div').remove();
		for (var i = 0; i < $('[hw-doc]').length; i++) {
			var src = $('#hw-docs-'+i).attr('src');
			if (typeof(src) == 'undefined' || src == '') {
				docs_str += $('#hw-docs-'+i).val()+'☻'+$('#hw-docs-'+i).val()+'☺';
				var f = $('#hw-docs-'+i).val();
			}
			else{
				if (typeof($('#hw-docs-'+i).attr('name')) == 'undefined' || $('#hw-docs-'+i).attr('name') == '') {
					if ($('#hw-docs-'+i).val().indexOf('://') > 0) {
						docs_str += $('#hw-docs-'+i).val()+'☻'+$('#hw-docs-'+i).val()+'☺';
						var f = $('#hw-docs-'+i).val();
					}
					else{
						docs_str += $('#hw-docs-'+i).val()+'☻'+$('#hw-docs-'+i).attr('src')+'☺';
						var f = $('#hw-docs-'+i).attr('src');
					}
				}
				else{
					docs_str += $('#hw-docs-'+i).attr('name')+'☻'+$('#hw-docs-'+i).val()+'☺';
						var f = $('#hw-docs-'+i).attr('src');
				}
			}
			//if ($('#hw-docs-'+i).attr('created') == 'true') {
				$('#hw-docs-'+i).attr('src', $('#hw-docs-'+i).val()).css({width:'70%',display:'inline-block'}).after('<img src="img/icons/open.svg" class="open-icon" onclick="open_doc(\''+f+'\')"><div class="clear-fix"></div>');
			//}
		}
		$.ajax({
			type: 'POST',
			url: 'fc/save-docs.php',
			data: {'d':<?php echo $day; ?>,'w':<?php echo $week; ?>,'l':<?php echo $lesson; ?>,'docs':docs_str,'user':user},
			success: function(data){
				$('#hw-docs-save').html('Сохранено').attr('disabled', 'true');
				get_tables(<?php echo $week; ?>, 'none', false);
			}
	    });
	});
	$('#hw-docs-add').click(function(){
		var docs = $('#hw-docs').attr('docs');
		if ($('#hw-docs-'+(docs-1)).val() != '' || docs == 0) {
			$('#hw-docs-save').before('<input autocomplete="off" created="true" type="text" id="hw-docs-'+docs+'" class="form-control" placeholder="Документ #'+(parseInt(docs)+1)+'" hw-doc>');
			$('#hw-docs').attr('docs', (parseInt(docs)+1));
		}
	});
	$('#hw-doc-upload').change(function(){
		$('#hw-doc-upload-label').hide();
		$('#hw-doc-upload-confirm').show();
	});
	$('#hw-doc-upload-confirm').on('click', function(){
		$(this).hide();
		$('#hw-doc-upload-label').show().html('Выбрать еще');
		for (var i = $('#hw-doc-upload').prop('files').length-1; i >= 0; i--) {
	    	var file_data = $('#hw-doc-upload').prop('files')[i];
	    	var form_data = new FormData();
	    	form_data.append('l', <?php echo $lesson; ?>);
	    	form_data.append('d', <?php echo $day; ?>);
	    	form_data.append('w', <?php echo $week; ?>);
	    	form_data.append('i', i);
	    	if ($('#load-via-api').attr('checked') == 'checked') {
	    		var a = true;
	    	}
	    	else{
	    		var a = false;
	    	}
	    	form_data.append('api', a);
	    	form_data.append('file', file_data);
	    	//form_data.append('user', user.canvas);
	    	loader_show();
	    	$.ajax({
	                url: 'fc/save-doc.php',
	                dataType: 'text',
	                cache: false,
	                contentType: false,
	                processData: false,
	                data: form_data,
	                type: 'post',
	                success: function(data){
	                	$('#hw-doc-upload-label').html('Загрузить еще');
	                	//accept="application/msword,application/pdf,application/vnd.openxmlformats-officedocument.wordprocessingml.document"
	                	if (data == 'err1') {
	                		alert('неверный формат');
	                	}
	                	else if (data == 'err2') {
	                		alert('слишком большой файл');
	                	}
	                	else if (data == 'err3'){
	                		alert('неверный параметры');
	                	}
	                	else{
	                		var docs = $('#hw-docs').attr('docs');
	                		data = data.split(',');
	                		$('#hw-docs-save').before('<input autocomplete="off" type="text" id="hw-docs-'+docs+'" class="form-control" placeholder="Документ #'+(parseInt(docs)+1)+'" hw-doc value="'+data[0]+'" src="'+data[1]+'">');
	                		$('#hw-docs-'+docs).css({width:'70%',display:'inline-block'}).after('<img src="img/icons/open.svg" class="open-icon" onclick="open_doc(\''+$('#hw-docs-'+docs).attr('src')+'\')"><div class="clear-fix"></div>');
							$('#hw-docs').attr('docs', (parseInt(docs)+1));

	                	}
	                	loader_hide();
	                }
	     	});	
	    }
	});
	$('#hw-img').on('change', function(){
		$('#hw-img-upload').css('display', 'inline-block');
	});
	$('#hw-img-upload').on('click', function() {
	    for (var i = $('#hw-img').prop('files').length-1; i >= 0; i--) {
	    	var file_data = $('#hw-img').prop('files')[i];
	    	var form_data = new FormData();
	    	form_data.append('l', <?php echo $lesson; ?>);
	    	form_data.append('d', <?php echo $day; ?>);
	    	form_data.append('w', <?php echo $week; ?>);
	    	form_data.append('file', file_data);
	    	//form_data.append('user', user.canvas);
	    	loader_show();
	    	$.ajax({
	                url: 'fc/save-photo.php',
	                dataType: 'text',
	                cache: false,
	                contentType: false,
	                processData: false,
	                data: form_data,
	                type: 'post',
	                success: function(data){
	                	$('#hw-img').before('<img src="'+data+'" class="hw-img-thumbnail">')
	                	$('#hw-img-upload').hide();
	                	loader_hide();
	                }
	     	});	
	    }
	});
	$(document).on('click', '.hw-img-thumbnail', function(){
		$('.overlay-image').show().html('<img src="'+$(this).attr('src')+'" photo-overlay><img src="img/icons/garbage.svg" class="hw-img-remove" style="width: 32px;height: 32px;cursor: pointer;position: absolute;top: 16px;right: 16px;" day="<?php echo $day; ?>" week="<?php echo $week; ?>" lesson="<?php echo $lesson; ?>">');
		show_notification('Нифига не видно? <u style="cursor: pointer;" onclick="window.open(\''+$(this).attr('src')+'\', \'_blank\')">Открыть в новой вкладке</u>');
	});
	<?php } ?>
</script>