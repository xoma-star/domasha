<?php
function get_first_day($year, $month, $week){
	for ($i=0; $i < $week; $i++) {
		$firstweekmonth = date("W", strtotime('1.'.$month.'.'.$year)) + $i - 1;
	}
	return $firstweekmonth * 7 * 86400 + strtotime('1/1/' . $year) - date('w', strtotime('1/1/' . $year)) * 86400 + 86400;
}
//['name'=>'','hw'=>'','docs'=>[],'images'=>[]],
$timetable = json_decode(file_get_contents('timetable.txt'));
for ($v=1; $v < 55; $v++) { 



		$week_data = json_decode(file_get_contents('hw/'.$v.'.txt'),true);
		$config = [
			'study_start'=>'01.09.2019',
			'study_end'=>'01.06.2020',
			'max_week'=>date('W', strtotime('01.06.2020'))
		];
		$week = $v;
		if ($week > $config['max_week']) {
			$year = date('Y', strtotime($config['study_start']));
		}
		else{
			$year = date('Y', strtotime($config['study_end']));
		}
		$first_str = get_first_day($year, 1, $week);
		for ($z=0; $z < 6; $z++) {
			if ($first_str < strtotime($config['study_start'])) {
				$weekend = 'true';
			}
			else{
				$weekend = 'false';
			}
			$arr['response']['days'][$z] = [
				'subjects'=>[],
				'notes'=>[],
				'date'=>date('d.m.Y', $first_str + $z*24*60*60),
				'weekend'=>$weekend
			];
			// for ($i=0; $i < count($timetable->response[$z]); $i++) { 
			// 	$arr['response']['days'][$z]['subjects'][$i] = ['name'=>'','hw'=>'','docs'=>[],'images'=>[]];
			// }
		}
		$week_data = $arr;
		file_put_contents('hw/'.$v.'.txt', json_encode($week_data));




		// $f_hdl = fopen('hw/'.$v.'.txt', 'w');
		// fwrite($f_hdl, '');
		// fclose($f_hdl);


}
?>