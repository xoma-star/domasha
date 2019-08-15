<div class="calendar_new">
<?php
function draw_calendar($month, $year, $week, $action = 'none') {
	$running_day = date('w',mktime(0,0,0,$month,1,$year));
	$running_day = $running_day - 1;
	if ($running_day == -1) {
		$running_day = 6;
	}
	
	$days_in_month = date('t',mktime(0,0,0,$month,1,$year));
	$day_counter = 0;
	$days_in_this_week = 1;
	$dates_array = array();
	
	// первая строка календаря

	$w = date('W', strtotime('1.'.$month.'.'.$year));

	if (mb_strlen($w) == 2 && $w-10 < 0) {
		$w = mb_substr($w, 1, 1);
	}

	$calendar.= '<tr '.$this_week_c.' calendar_week="'.$w.'">';
	
	// вывод пустых ячеек
	for ($x = 0; $x < $running_day; $x++) {
		$calendar.= '<th class="calendar_d_n_exist"> </th>';
		$days_in_this_week++;
	}
	
	// дошли до чисел, будем их писать в первую строку
	for($list_day = 1; $list_day <= $days_in_month; $list_day++) {
		$calendar.= '<th scrollto="'.($running_day).'" class="';

		// выделяем выходные дни
		if ($running_day != 0) {
			if (($running_day % 6 == 0)) {
				$calendar .= ' calendar_weekend';
			}
		}
		if ($list_day.'.'.$month.'.'.$year == date('j.n.Y')) {
				$calendar .= ' calendar_this_day';
			}
		$calendar .= '">';

		// пишем номер в ячейку
		$calendar.= $list_day;
		$calendar.= '</th>';

		// дошли до последнего дня недели
		if ($running_day == 6) {
			// закрываем строку
			$calendar.= '</tr>';
			// если день не последний в месяце, начинаем следующую строку
			if (($day_counter + 1) != $days_in_month) {
				if ((date('W', strtotime($list_day.'.'.$month.'.'.$year))+1) == $week) {
					$this_week_c = 'class="this_week"';
				}
				else{
					$this_week_c = '';
				}
				$w = date('W', strtotime($list_day.'.'.$month.'.'.$year))+1;
				$calendar.= '<tr '.$this_week_c.' calendar_week="'.$w.'">';
			}
			// сбрасываем счетчики 
			$running_day = -1;
			$days_in_this_week = 0;
		}

		$days_in_this_week++; 
		$running_day++; 
		$day_counter++;
	}

	// выводим пустые ячейки в конце последней недели
	if ($days_in_this_week < 8) {
		for($x = 1; $x <= (8 - $days_in_this_week); $x++) {
			$calendar.= '<th class="calendar_d_n_exist"> </th>';
		}
	}
	$calendar.= '</tr>';

	return $calendar;
}

$months_arr = ['September,Сентябрь,9,', 'October,Октябрь,10', 'November,Ноябрь,11', 'December,Декабрь,12', 'January,Январь,1', 'Febrary,Февраль,2', 'March,Март,3', 'April,Апрель,4', 'May,Май,5'];

		for ($i=0; $i < 9; $i++) {
			//echo $i%3+1;
			if (($i%3+1) == 1) {
				?>
				<div class="calendar_month_row">
				<?php
			}
			$month_arr = explode(',', $months_arr[$i]);
			$month_p = $month_arr[2];

			if ($month_p <= 12 && $month_p >5) {
				$year_p = 2019;
			}

			else{
				$year_p = 2020;
			}
			?>
			<div class="calendar_month_block">
			<?php echo '<span class="calendar_title">'.$month_arr[1].'</span>'; ?>
			<table class="calendar_month">
				<tbody>
			<?php
			echo draw_calendar($month_p,$year_p,$week);
			$date = date('t', strtotime('1.'.$month_p.'.'.$year_p));
			$rows = (int)($date/7)+1;
			?>
				</tbody>
			</table>
			<?php

			if ($i%3+1 == 3) {
				?>
				</div>
				<?php
			}

			?>
		</div>
			<?php

		}

?>
</div>