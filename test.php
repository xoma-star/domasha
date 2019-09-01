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
// <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 426.667 426.667" xml:space="preserve">
// <path style="fill:#6AC259;" d="M213.333,0C95.518,0,0,95.514,0,213.333s95.518,213.333,213.333,213.333  c117.828,0,213.333-95.514,213.333-213.333S331.157,0,213.333,0z M174.199,322.918l-93.935-93.931l31.309-31.309l62.626,62.622  l140.894-140.898l31.309,31.309L174.199,322.918z"></path>
// </svg>
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
// 		'социально-психологическая адаптация',
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
// 		'физическая культура и спорт',
// 		'---',
// 		'удалить'
// 	]
// ];
// echo json_encode($arr);
$q = file_get_contents('https://yandex.ru/pogoda/ufa/details');
$weather_today = str_replace('+', '', explode('</span>', explode('<span class="temp__value">', $q)[6])[0]);
$today_weather = (object)([
	'morning'=>(object)([
		'temp'=>str_replace('hellip;', '...', preg_replace("/[^0-9+-°]/iu", '', explode('</td>', explode('<div class="weather-table__daypart">', $q)[1])[0])),
		'feels_like'=>preg_replace("/[^0-9+-°]/iu", '', explode('</td>', explode('<td class="weather-table__body-cell weather-table__body-cell_type_feels-like">', $q)[1])[0]),
		'condition'=>explode('</td>', explode('<td class="weather-table__body-cell weather-table__body-cell_type_condition">', $q)[1])[0],
		'icon'=>explode('"/>', explode('src="', explode('</td>', explode('<td class="weather-table__body-cell weather-table__body-cell_type_icon">', $q)[1])[0])[1])[0],
	]),
	'day'=>(object)([
		'temp'=>str_replace('hellip;', '...', preg_replace("/[^0-9+-°]/iu", '', explode('</td>', explode('<div class="weather-table__daypart">', $q)[2])[0])),
		'feels_like'=>preg_replace("/[^0-9+-°]/iu", '', explode('</td>', explode('<td class="weather-table__body-cell weather-table__body-cell_type_feels-like">', $q)[2])[0]),
		'condition'=>explode('</td>', explode('<td class="weather-table__body-cell weather-table__body-cell_type_condition">', $q)[2])[0],
		'icon'=>explode('"/>', explode('src="', explode('</td>', explode('<td class="weather-table__body-cell weather-table__body-cell_type_icon">', $q)[2])[0])[1])[0],
	]),
	'evening'=>(object)([
		'temp'=>str_replace('hellip;', '...', preg_replace("/[^0-9+-°]/iu", '', explode('</td>', explode('<div class="weather-table__daypart">', $q)[3])[0])),
		'feels_like'=>preg_replace("/[^0-9+-°]/iu", '', explode('</td>', explode('<td class="weather-table__body-cell weather-table__body-cell_type_feels-like">', $q)[3])[0]),
		'condition'=>explode('</td>', explode('<td class="weather-table__body-cell weather-table__body-cell_type_condition">', $q)[3])[0],
		'icon'=>explode('"/>', explode('src="', explode('</td>', explode('<td class="weather-table__body-cell weather-table__body-cell_type_icon">', $q)[3])[0])[1])[0],
	]),
	'night'=>(object)([
		'temp'=>str_replace('hellip;', '...', preg_replace("/[^0-9+-°]/iu", '', explode('</td>', explode('<div class="weather-table__daypart">', $q)[4])[0])),
		'feels_like'=>preg_replace("/[^0-9+-°]/iu", '', explode('</td>', explode('<td class="weather-table__body-cell weather-table__body-cell_type_feels-like">', $q)[4])[0]),
		'condition'=>explode('</td>', explode('<td class="weather-table__body-cell weather-table__body-cell_type_condition">', $q)[4])[0],
		'icon'=>explode('"/>', explode('src="', explode('</td>', explode('<td class="weather-table__body-cell weather-table__body-cell_type_icon">', $q)[4])[0])[1])[0],
	])
]);
print_r($today_weather);
?>