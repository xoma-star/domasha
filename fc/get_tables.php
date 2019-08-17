<?php
	function mb_ucfirst($str, $encoding='UTF-8')
	{
		$str = mb_ereg_replace('^[\ ]+', '', $str);
		$str = mb_strtoupper(mb_substr($str, 0, 1, $encoding), $encoding).
			   mb_substr($str, 1, mb_strlen($str), $encoding);
		return $str;
	}
	function get_first_day($year, $month, $week){
		for ($i=0; $i < $week; $i++) {
			$firstweekmonth = date("W", strtotime('1.'.$month.'.'.$year)) + $i - 1;
		}
		return $firstweekmonth * 7 * 86400 + strtotime('1/1/' . $year) - date('w', strtotime('1/1/' . $year)) * 86400 + 86400;
	}
	$config = [
		'study_start'=>'01.09.2019',
		'study_end'=>'01.06.2020',
		'max_week'=>date('W', strtotime('01.06.2020')) // заменить также в подвале get_tables() и timetable.php
	];
	$week = $_GET['w'];
	if (empty($week)) {
		$week = date('W');
	}
	if ($week > $config['max_week']) {
		$year = date('Y', strtotime($config['study_start']));
	}
	else{
		$year = date('Y', strtotime($config['study_end']));
	}
	$first_str = get_first_day($year, 1, $week);

	$day_names = ['Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота'];
	$month_names = ['янв', 'фев', 'мар', 'апр', 'мая', 'июн', 'июл', 'авг', 'сен', 'окт', 'ноя', 'дек'];
	$week_data = json_decode(file_get_contents('../hw/'.$week.'.txt'));
	$timetable = json_decode(file_get_contents('../timetable.txt'));

	$sun_data = json_decode(file_get_contents('get_sun_data.php'));

	//include 'log.php';
	//$_POST['user'] = $_GET['user'];
	//loger('get_tables', '');

	for ($i=0; $i < 6; $i++) {
		?>
		<div class="block table-wrap" day-id="<?php echo $i; ?>">
			<h1 class="day-name"><?php echo $day_names[$i].', '.date('j', $first_str + $i*24*60*60).' '.$month_names[date('m', $first_str + $i*24*60*60)-1]; ?><img style="visibility: hidden;"></h1>
			<div class="notes"><?php
					if (count($week_data->response->days[$i]->notes) > 0) {
						for ($v=0; $v < count($week_data->response->days[$i]->notes); $v++) { 
							echo '<div class="note">'.$week_data->response->days[$i]->notes[$v].'</div>';
						}
					}
				?></div>
			<?php if($week_data->response->days[$i]->weekend == 'false'){ ?>
			<?php if (count($week_data->response->days[$i]->subjects) > 0) { ?>
			<table>
				<tr class="table-header table-row">
					<th class="subject-name-td">Предмет</th>
					<th>Домашнее задание</th>
				</tr>
				<?php
				for ($z=0; $z < count($week_data->response->days[$i]->subjects); $z++) {
					if (empty($timetable->response[$i][$z]) || !empty($week_data->response->days[$i]->subjects[$z]->name) && ($timetable->response[$i][$z] != $week_data->response->days[$i]->subjects[$z]->name)) {
						//$name = '<span title="Замена">!</span>'.mb_ucfirst($week_data->response->days[$i]->subjects[$z]->name);
						$name = mb_ucfirst($week_data->response->days[$i]->subjects[$z]->name);
						if ($k == 0) {
							if ($week_data->response->days[$i]->subjects[$z]->name != $timetable->response[$i][$z]) {
								$k++;
								echo "<script id=\"script_remove\">$('[day-id=".$i."]').children('.notes').append('<div class=\"note\">Замены в расписании</div>');$('#script_remove').remove()</script>";
							}
							else{
								$name = $timetable->response[$i][$z];
							}
						}
					}
					else{
						$name = $timetable->response[$i][$z];
					}
					?>
					<tr lesson="<?php echo $z; ?>" class="table-row">
						<th><?php echo mb_ucfirst($name); ?></th>
						<th><?php echo $week_data->response->days[$i]->subjects[$z]->hw;
						if ((count($week_data->response->days[$i]->subjects[$z]->docs) + count($week_data->response->days[$i]->subjects[$z]->images)) > 0) {
							?>
							<img title="Есть вложения" src="data:image/svg+xml;charset=utf-8,%0D%0A%3Csvg%20version%3D%221.1%22%20id%3D%22Capa_1%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20xmlns%3Axlink%3D%22http%3A%2F%2Fwww.w3.org%2F1999%2Fxlink%22%20x%3D%220px%22%20y%3D%220px%22%0D%0A%09%20viewBox%3D%220%200%2058%2058%22%20style%3D%22enable-background%3Anew%200%200%2058%2058%3B%22%20xml%3Aspace%3D%22preserve%22%3E%0D%0A%3Cpolygon%20style%3D%22fill%3A%237383BF%3B%22%20points%3D%2220%2C3.5%2025%2C10.5%2058%2C10.5%2058%2C3.5%20%22%2F%3E%0D%0A%3Cpolygon%20style%3D%22fill%3A%23424A60%3B%22%20points%3D%2225%2C10.5%2020%2C3.5%200%2C3.5%200%2C10.5%200%2C54.5%2058%2C54.5%2058%2C17.5%2030%2C17.5%20%22%2F%3E%0D%0A%3Cpolygon%20style%3D%22fill%3A%2371C3A9%3B%22%20points%3D%2230%2C17.5%2058%2C17.5%2058%2C10.5%2025%2C10.5%20%22%2F%3E%0D%0A%3Cg%3E%0D%0A%09%3Cpath%20style%3D%22fill%3A%237383BF%3B%22%20d%3D%22M18%2C29.5h14c0.552%2C0%2C1-0.447%2C1-1s-0.448-1-1-1H18c-0.552%2C0-1%2C0.447-1%2C1S17.448%2C29.5%2C18%2C29.5z%22%2F%3E%0D%0A%09%3Cpath%20style%3D%22fill%3A%237383BF%3B%22%20d%3D%22M18%2C35.5h22c0.552%2C0%2C1-0.447%2C1-1s-0.448-1-1-1H18c-0.552%2C0-1%2C0.447-1%2C1S17.448%2C35.5%2C18%2C35.5z%22%2F%3E%0D%0A%09%3Cpath%20style%3D%22fill%3A%237383BF%3B%22%20d%3D%22M40%2C39.5H18c-0.552%2C0-1%2C0.447-1%2C1s0.448%2C1%2C1%2C1h22c0.552%2C0%2C1-0.447%2C1-1S40.552%2C39.5%2C40%2C39.5z%22%2F%3E%0D%0A%3C%2Fg%3E%0D%0A%3C%2Fsvg%3E%0D%0A" class="includes right">
							<?php
						}

						?><img title="Подробнее" src="data:image/svg+xml;charset=utf-8,%0D%0A%3Csvg%20version%3D%221.1%22%20id%3D%22Layer_1%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20xmlns%3Axlink%3D%22http%3A%2F%2Fwww.w3.org%2F1999%2Fxlink%22%20x%3D%220px%22%20y%3D%220px%22%0D%0A%09%20viewBox%3D%220%200%20512%20512%22%20style%3D%22enable-background%3Anew%200%200%20512%20512%3B%22%20xml%3Aspace%3D%22preserve%22%3E%0D%0A%3Cg%3E%0D%0A%09%3Cpath%20style%3D%22fill%3A%23FFFFFF%3B%22%20d%3D%22M131.879%2C248.242c-4.278%2C0-7.758%2C3.48-7.758%2C7.758c0%2C4.278%2C3.48%2C7.758%2C7.758%2C7.758%0D%0A%09%09c4.278%2C0%2C7.758-3.48%2C7.758-7.758C139.636%2C251.722%2C136.156%2C248.242%2C131.879%2C248.242z%22%2F%3E%0D%0A%09%3Cpath%20style%3D%22fill%3A%23FFFFFF%3B%22%20d%3D%22M131.879%2C217.212c-21.388%2C0-38.788%2C17.4-38.788%2C38.788s17.4%2C38.788%2C38.788%2C38.788%0D%0A%09%09s38.788-17.4%2C38.788-38.788S153.266%2C217.212%2C131.879%2C217.212z%20M131.879%2C271.515c-8.569%2C0-15.515-6.946-15.515-15.515%0D%0A%09%09c0-8.569%2C6.946-15.515%2C15.515-15.515c8.567%2C0%2C15.515%2C6.946%2C15.515%2C15.515C147.394%2C264.569%2C140.446%2C271.515%2C131.879%2C271.515z%22%2F%3E%0D%0A%09%3Cpath%20style%3D%22fill%3A%23FFFFFF%3B%22%20d%3D%22M131.879%2C240.485c-8.569%2C0-15.515%2C6.946-15.515%2C15.515c0%2C8.569%2C6.946%2C15.515%2C15.515%2C15.515%0D%0A%09%09c8.567%2C0%2C15.515-6.946%2C15.515-15.515C147.394%2C247.431%2C140.446%2C240.485%2C131.879%2C240.485z%20M131.879%2C263.758%0D%0A%09%09c-4.278%2C0-7.758-3.48-7.758-7.758c0-4.278%2C3.48-7.758%2C7.758-7.758c4.278%2C0%2C7.758%2C3.48%2C7.758%2C7.758%0D%0A%09%09C139.636%2C260.278%2C136.156%2C263.758%2C131.879%2C263.758z%22%2F%3E%0D%0A%09%3Cpath%20style%3D%22fill%3A%23FFFFFF%3B%22%20d%3D%22M256%2C248.242c-4.278%2C0-7.758%2C3.48-7.758%2C7.758c0%2C4.278%2C3.48%2C7.758%2C7.758%2C7.758%0D%0A%09%09c4.278%2C0%2C7.758-3.48%2C7.758-7.758C263.758%2C251.722%2C260.278%2C248.242%2C256%2C248.242z%22%2F%3E%0D%0A%09%3Cpath%20style%3D%22fill%3A%23FFFFFF%3B%22%20d%3D%22M256%2C217.212c-21.388%2C0-38.788%2C17.4-38.788%2C38.788s17.4%2C38.788%2C38.788%2C38.788%0D%0A%09%09s38.788-17.4%2C38.788-38.788S277.388%2C217.212%2C256%2C217.212z%20M256%2C271.515c-8.569%2C0-15.515-6.946-15.515-15.515%0D%0A%09%09c0-8.569%2C6.946-15.515%2C15.515-15.515c8.569%2C0%2C15.515%2C6.946%2C15.515%2C15.515C271.515%2C264.569%2C264.569%2C271.515%2C256%2C271.515z%22%2F%3E%0D%0A%09%3Cpath%20style%3D%22fill%3A%23FFFFFF%3B%22%20d%3D%22M256%2C240.485c-8.569%2C0-15.515%2C6.946-15.515%2C15.515c0%2C8.569%2C6.946%2C15.515%2C15.515%2C15.515%0D%0A%09%09c8.569%2C0%2C15.515-6.946%2C15.515-15.515C271.515%2C247.431%2C264.569%2C240.485%2C256%2C240.485z%20M256%2C263.758c-4.278%2C0-7.758-3.48-7.758-7.758%0D%0A%09%09c0-4.278%2C3.48-7.758%2C7.758-7.758c4.278%2C0%2C7.758%2C3.48%2C7.758%2C7.758C263.758%2C260.278%2C260.278%2C263.758%2C256%2C263.758z%22%2F%3E%0D%0A%09%3Cpath%20style%3D%22fill%3A%23FFFFFF%3B%22%20d%3D%22M372.364%2C256c0%2C4.278%2C3.48%2C7.758%2C7.758%2C7.758c4.278%2C0%2C7.758-3.48%2C7.758-7.758%0D%0A%09%09c0-4.278-3.48-7.758-7.758-7.758C375.844%2C248.242%2C372.364%2C251.722%2C372.364%2C256z%22%2F%3E%0D%0A%09%3Cpath%20style%3D%22fill%3A%23FFFFFF%3B%22%20d%3D%22M341.333%2C256c0%2C21.388%2C17.4%2C38.788%2C38.788%2C38.788c21.388%2C0%2C38.788-17.4%2C38.788-38.788%0D%0A%09%09s-17.4-38.788-38.788-38.788C358.734%2C217.212%2C341.333%2C234.612%2C341.333%2C256z%20M395.636%2C256c0%2C8.569-6.946%2C15.515-15.515%2C15.515%0D%0A%09%09c-8.569%2C0-15.515-6.946-15.515-15.515c0-8.569%2C6.946-15.515%2C15.515-15.515C388.69%2C240.485%2C395.636%2C247.431%2C395.636%2C256z%22%2F%3E%0D%0A%09%3Cpath%20style%3D%22fill%3A%23FFFFFF%3B%22%20d%3D%22M364.606%2C256c0%2C8.569%2C6.946%2C15.515%2C15.515%2C15.515c8.569%2C0%2C15.515-6.946%2C15.515-15.515%0D%0A%09%09c0-8.569-6.946-15.515-15.515-15.515C371.552%2C240.485%2C364.606%2C247.431%2C364.606%2C256z%20M387.879%2C256c0%2C4.278-3.48%2C7.758-7.758%2C7.758%0D%0A%09%09c-4.278%2C0-7.758-3.48-7.758-7.758c0-4.278%2C3.48-7.758%2C7.758-7.758C384.399%2C248.242%2C387.879%2C251.722%2C387.879%2C256z%22%2F%3E%0D%0A%3C%2Fg%3E%0D%0A%3Cpath%20style%3D%22fill%3A%23719DF7%3B%22%20d%3D%22M256%2C0v217.212c21.388%2C0%2C38.788%2C17.4%2C38.788%2C38.788s-17.4%2C38.788-38.788%2C38.788V512%0D%0A%09c141.158%2C0%2C256-114.842%2C256-256S397.158%2C0%2C256%2C0z%20M380.121%2C294.788c-21.388%2C0-38.788-17.4-38.788-38.788s17.4-38.788%2C38.788-38.788%0D%0A%09c21.388%2C0%2C38.788%2C17.4%2C38.788%2C38.788S401.509%2C294.788%2C380.121%2C294.788z%22%2F%3E%0D%0A%3Cpath%20style%3D%22fill%3A%233D6DEB%3B%22%20d%3D%22M217.212%2C256c0-21.388%2C17.4-38.788%2C38.788-38.788V0C114.842%2C0%2C0%2C114.842%2C0%2C256s114.842%2C256%2C256%2C256%0D%0A%09V294.788C234.612%2C294.788%2C217.212%2C277.388%2C217.212%2C256z%20M131.879%2C294.788c-21.388%2C0-38.788-17.4-38.788-38.788%0D%0A%09s17.4-38.788%2C38.788-38.788s38.788%2C17.4%2C38.788%2C38.788S153.266%2C294.788%2C131.879%2C294.788z%22%2F%3E%0D%0A%3C%2Fsvg%3E%0D%0A%0D%0A" class="row-more right"></th>
					</tr>
					<?php
				}
				?>
			</table>
			<?php }else{ ?>
			<div class="weekend">
				<h2>Нет расписания🙄</h2>
			</div>
			<?php } ?>
			<?php }else{ ?>
			<div class="weekend">
				<h2>Не учимся🥳</h2>
			</div>
			<?php } ?>
		</div>
		<?php
		$k=0;
	}
?>
<script>
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
	check_weather();
	$('#sun-night').attr('sunset', '<?php echo $sun_data->sunset; ?>').attr('sunrise', '<?php echo $sun_data->sunrise; ?>');
	check_night();
</script>