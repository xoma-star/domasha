<tr class="table-header table-row">
	<th>Тип</th>
	<th>Когда</th>
	<th>Неделя</th>
	<th>День</th>
	<th>Урок</th>
	<th>Изменено с</th>
	<th>на</th>
	<th>IP</th>
	<th>userdata</th>
	<th>uid</th>
</tr>
<?php
	$file_data = json_decode(file_get_contents('logs/'.$_GET['name']));
	for ($i=0; $i < count($file_data->response); $i++) { 
		?>
		<tr class="table-row" type="<?php echo $file_data->response[$i]->type; ?>">
			<th><?php
			switch ($file_data->response[$i]->type) {
				case 'subject':
					echo "изменен предмет";
					break;
				case 'get_day_data':
					echo "получена информация о дне";
					break;
				case 'get_hw_data':
					echo "получена информация об уроке";
					break;
				case 'get_tables':
					echo "получены таблицы с заданиями";
					break;
				case 'image_remove':
					echo "удалена картинка";
					break;
				case 'uploaded_doc':
					echo "загружен документ";
					break;
				case 'docs':
					echo "изменены документы";
					break;
				case 'homework':
					echo "изменено задание";
					break;
				case 'notes':
					echo "изменены объявления";
					break;
				case 'add_photo':
					echo "загружена картинка";
					break;
				case 'weekend':
					echo "изменен выходной";
					break;
				default:
					echo "none";
					break;
			}
			?></th>
			<th><?php echo date('H:i:s', $file_data->response[$i]->time+5*60*60); ?></th>
			<th><?php echo $file_data->response[$i]->week; ?></th>
			<th><?php echo $file_data->response[$i]->day; ?></th>
			<th><?php echo $file_data->response[$i]->lesson; ?></th>
			<th><?php
			if (is_array($file_data->response[$i]->from)) {
					print_r($file_data->response[$i]->from);
			}
			else{
				echo $file_data->response[$i]->from;
			}
			?></th>
			<th><?php
			if (is_array($file_data->response[$i]->to)) {
					print_r($file_data->response[$i]->to);
			}
			else{
				echo $file_data->response[$i]->to;
			}
			?></th>
			<th><?php echo $file_data->response[$i]->ip; ?></th>
			<th><?php
			$file_data->response[$i]->user_data = array_values((array)$file_data->response[$i]->user_data);
			for ($z=0; $z < count($file_data->response[$i]->user_data); $z++) {
				echo $file_data->response[$i]->user_data[$z]."<br>";
			}
			?></th>
			<th><?php echo $file_data->response[$i]->uid; ?></th>
		</tr>
		<?php
	}
?>
