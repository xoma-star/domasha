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

	$sun_data = json_decode(file_get_contents('https://domasha.tk/fc/get_sun_data'));

	include 'log.php';
	$_POST['user'] = $_GET['user'];
	loger('get_tables', '');

	for ($i=0; $i < 6; $i++) {
		?>
		<div class="block table-wrap" day-id="<?php echo $i; ?>">
			<h1 class="day-name"><?php echo $day_names[$i].', '.date('j', $first_str + $i*24*60*60).' '.$month_names[date('m', $first_str + $i*24*60*60)-1]; ?><img src="img/icons/settings.svg" style="visibility: hidden;"></h1>
			<div class="notes"><?php
					if (count($week_data->response->days[$i]->notes) > 0) {
						for ($v=0; $v < count($week_data->response->days[$i]->notes); $v++) { 
							echo '<div class="note">'.$week_data->response->days[$i]->notes[$v].'</div>';
						}
					}
				?></div>
			<?php if($week_data->response->days[$i]->weekend == 'false'){ ?>
			<table>
				<tr class="table-header table-row">
					<th class="subject-name-td">Предмет</th>
					<th>Домашнее задание</th>
				</tr>
				<?php
				for ($z=0; $z < count($week_data->response->days[$i]->subjects); $z++) {
					if (empty($timetable->response[$i][$z]) || !empty($week_data->response->days[$i]->subjects[$z]->name) && ($timetable->response[$i][$z] != $week_data->response->days[$i]->subjects[$z]->name)) {
						$name = '<span title="Замена">!</span>'.mb_ucfirst($week_data->response->days[$i]->subjects[$z]->name);
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
							<img title="Есть вложения" src="img/icons/folder.svg" class="includes right">
							<?php
						}

						?><img title="Подробнее" src="img/icons/more.svg" class="row-more right"></th>
					</tr>
					<?php
				}
				?>
			</table>
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
</script>