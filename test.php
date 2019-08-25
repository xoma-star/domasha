<?php
// $arr = ['response'=>
// 	[
// 		'days'=>[
// 			0=>[1.2,3],
// 			3=>[]
// 		]
// 	]
// ];
// // $arr = [
// // 	'response'=>[['математика', 'русский', 'география', 'биология', 'физра', 'физра'],['математика', 'русский', 'география', 'биология', 'физра', 'физра'],['математика', 'русский', 'география', 'биология', 'физра', 'физра'],['математика', 'русский', 'география', 'биология', 'физра', 'физра'],['математика', 'русский', 'география', 'биология', 'физра', 'физра'],['математика', 'русский', 'география', 'биология', 'физра', 'физра']]
// // ];
// echo json_encode($arr);
// echo str_replace('+', '%20', urlencode('
// <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
// 	 viewBox="0 0 280.027 280.027" style="enable-background:new 0 0 280.027 280.027;" xml:space="preserve">
// <g>
// 	<path style="fill:#3CAED6;" d="M245.023,175.017c0-56.005-96.259-165.391-104.135-174.142l0,0l0,0l0,0
// 		c0,0-105.885,116.386-105.885,174.142s47.255,105.01,105.01,105.01c3.5,0,7.876,0,11.376-0.875c0.875,0,1.75,0,2.625-0.875
// 		c2.625,0,5.251-0.875,7.876-0.875c0.875,0,1.75-0.875,3.5-0.875c2.625-0.875,5.251-0.875,7.876-1.75
// 		c0.875,0,1.75-0.875,2.625-0.875c2.625-0.875,5.251-1.75,7.876-2.625c0.875,0,1.75-0.875,1.75-0.875
// 		c2.625-0.875,5.251-2.625,7.876-4.375c0.875,0,0.875-0.875,1.75-0.875c2.625-1.75,5.251-3.5,7.876-5.251c0,0,0.875,0,0.875-0.875
// 		c2.625-1.75,5.251-4.375,7.876-6.126l0,0C231.897,232.773,245.023,205.645,245.023,175.017z"/>
// 	<path style="fill:#63BFDE;" d="M183.768,140.014c-9.626,0-17.502,7.876-17.502,17.502c0,9.626,7.876,17.502,17.502,17.502
// 		c9.626,0,17.502-7.876,17.502-17.502C201.27,147.889,193.393,140.014,183.768,140.014z"/>
// 	<path style="fill:#369DC0;" d="M148.764,271.276c-57.756,0-105.01-47.255-105.01-105.01c0-48.13,71.757-136.513,97.134-165.391
// 		L140.014,0c0,0-105.01,117.261-105.01,175.017s47.255,105.01,105.01,105.01c31.503,0,59.506-14.001,78.758-35.003
// 		C199.518,260.775,175.891,271.276,148.764,271.276z"/>
// </g>
// '));
// $arr = [
// 	'subjects'=>[
// 		'математический анализ',
// 		'программирование',
// 		'алгебра и аналитическая геометрия',
// 		'история',
// 		'русский язык',
// 		'информатика',
// 		'библиотечные занятия',
// 		'физическая культура',
// 		'иностранный язык',
// 		'дискретная математика',
// 		'философия',
// 		'физические основы элементной базы компьютерной техники',
// 		'правоведение',
// 		'действительный и комплексный анализ',
// 		'физика',
// 		'математическая логика',
// 		'дополнительные главы алгебры и геометрии',
// 		'компьютерная графика',
// 		'---',
// 		'удалить'
// 	]
// ];
// echo json_encode($arr);
$weather_data = json_decode(file_get_contents('https://domasha.tk/fc/weather.txt'));
if ((time()-$weather_data->updated) > 60*60) {
	$weather_data = json_decode(file_get_contents('http://api.openweathermap.org/data/2.5/forecast?q=Ufa&APPID=ba00b8736b1a100a1fe1fed48857a5a6&units=metric&cnt=16'));
	$weather_data->updated = time();
	file_put_contents('weather.txt', json_encode($weather_data));
}
$thunders = [200,201,202,210,211,212,221,230,231,232];
$drizzles = [300,301,302,310,311,312,313,314,321,500];
$rains = [501,502,503,504,511,520,521,522,531];
$q = [$thunders, $drizzles, $rains];
$conds = ['возможна гроза', 'возможен небольшой дождь', 'возможен дождь'];
$may_rain = false;
for ($i=0; $i < 3; $i++) {
	if (in_array($weather_data->list[0]->weather[0]->id, $q[$i])) {
		$response = $conds[$i];
		$may_rain = true;
	}
}
$next_day_unix = strtotime(date('d.m.Y')) + 24*60*60;
for ($i=0; $i < count($weather_data->list); $i++) { 
	if ($weather_data->list[$i]->dt >= $next_day_unix) {
		//echo $i;
		break;
	}
}
$this_day_deg = $weather_data->list[0]->main->temp;
//$next_day_deg = $weather_data->list[7]->main->temp;
$next_day_deg = (int)(($weather_data->list[$i+3]->main->temp+$weather_data->list[$i+4]->main->temp+$weather_data->list[$i+5]->main->temp)/3);
//echo $weather_data->list[$i+2]->dt;
$arr = [
	'may_rain'=>$may_rain,
	'rain'=>$response,
	'weather_today'=>$this_day_deg,
	'weather_tomorrow'=>$next_day_deg
];
echo json_encode($arr);
?>