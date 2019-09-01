<?php require 'components/head.php'; ?>
<div class="content">
	<div class="block" id="navigation">
		<div class="nav-row"<?php if(empty($_COOKIE['uid'])){ ?> style="filter: blur(3px);"<?php } ?>>
			<a class="left" id="prev-w" href="?w="><h4><span style="background-color: #afafaf; border-radius: 10px; color: #afafaf;">прндцщая вы</span></h4></a>
			<button <?php if(empty($_COOKIE['uid'])){ ?> disabled <?php } ?> class="btn btn-primary" id="calendar-switch">Календарь</button>
			<a class="right" id="next-w" href="?w="><h4><span style="background-color: #afafaf; border-radius: 10px; color: #afafaf;">прндцщая вы</span></h4></a>
			<div class="clear-fix"></div>
			<?php include 'components/calendar.php'; ?>
		</div>
		<?php if(empty($_COOKIE['uid'])){ ?>
		<div id="vk_auth" style="margin: 0 auto; padding: 10px 0;"></div>
		<script type="text/javascript">
		  $(document).ready(function(){VK.Widgets.Auth("vk_auth", {"authUrl":"login"});});
		</script>
		<?php } ?>
	</div>
	<div class="widget-wrap">
		<div class="block block-notification weather rain" id="weather-may-rain" onclick="show_weather()">
			<img src="data:image/svg+xml;charset=utf-8,%0D%0A%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20enable-background%3D%22new%200%200%20512%20512%22%20height%3D%22512%22%20viewBox%3D%220%200%20512%20512%22%20width%3D%22512%22%3E%3Cpath%20d%3D%22m361.004%20422v30c0%2033.08-26.92%2060-60%2060-17.9%200-34-7.89-45-20.37-9.33-10.57-15-24.45-15-39.63v-452h30v452c0%2016.54%2013.46%2030%2030%2030s30-13.46%2030-30v-30z%22%20fill%3D%22%23575f64%22%2F%3E%3Cpath%20d%3D%22m361.004%20422v30c0%2033.08-26.92%2060-60%2060-17.9%200-34-7.89-45-20.37v-491.63h15v452c0%2016.54%2013.46%2030%2030%2030s30-13.46%2030-30v-30z%22%20fill%3D%22%23474f54%22%2F%3E%3Cpath%20d%3D%22m96.905%2097.901c-41.146%2041.146-64.393%2095.423-65.829%20153.381l-.072.082v35.636h30v-23.968c10.105-9.498%2023.5-14.854%2037.5-14.854%2014.003%200%2027.394%205.369%2037.5%2014.871v23.951h15l105-255c-60.1%200-116.602%2023.404-159.099%2065.901z%22%20fill%3D%22%23e63950%22%2F%3E%3Cpath%20d%3D%22m480.922%20251.282c-1.436-57.958-24.673-112.235-65.819-153.381-42.497-42.497-98.999-65.901-159.099-65.901l105%20255h15v-23.952c10.106-9.502%2023.497-14.872%2037.501-14.871%2014.001%200%2027.395%205.357%2037.5%2014.855l-.001%2023.968h29.99l.002-35.633z%22%20fill%3D%22%23cd0000%22%2F%3E%3Cpath%20d%3D%22m361.004%20242.03v44.97h-15v-23.95c-10.11-9.5-23.5-14.87-37.5-14.87-15.79%200-30.81%206.81-41.21%2018.7l-11.29%2012.9-11.29-12.9c-10.4-11.89-25.42-18.7-41.21-18.7-14%200-27.39%205.37-37.5%2014.87v23.95h-15v-44.97c6.45-118.4%2051.45-210.03%20105-210.03s98.55%2091.63%20105%20210.03z%22%20fill%3D%22%23ff637b%22%2F%3E%3Cpath%20d%3D%22m361.004%20242.03v44.97h-15v-23.95c-10.11-9.5-23.5-14.87-37.5-14.87-15.79%200-30.81%206.81-41.21%2018.7l-11.29%2012.9v-247.78c53.55%200%2098.55%2091.63%20105%20210.03z%22%20fill%3D%22%23e63950%22%2F%3E%3C%2Fsvg%3E%0D%0A">
			<span></span>
			<div class="clear-fix"></div>
		</div>
	</div>
	<div class="widget-wrap">
		<div class="block block-notification weather snow" id="weather-cold" onclick="show_weather()">
			<img src="data:image/svg+xml;charset=utf-8,%0D%0A%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20id%3D%22Layer_1%22%20enable-background%3D%22new%200%200%20496%20496%22%20height%3D%22512%22%20viewBox%3D%220%200%20496%20496%22%20width%3D%22512%22%3E%3Cpath%20d%3D%22m123.995%20351.99c-19.43%2014.6-32%2037.84-32%2064.01%200%2044.18%2035.82%2080%2080%2080s80-35.82%2080-80c0-26.17-12.57-49.41-32-64.01v-303.99c0-26.51-21.49-48-48-48s-48%2021.49-48%2048z%22%20fill%3D%22%23c2e3ff%22%2F%3E%3Cpath%20d%3D%22m187.995%20370.73v-322.73c0-8.84-7.16-16-16-16s-16%207.16-16%2016v322.73c-18.641%206.59-32%2024.369-32%2045.27%200%2026.51%2021.49%2048%2048%2048s48-21.49%2048-48c0-20.9-13.359-38.68-32-45.27z%22%20fill%3D%22%235989b3%22%2F%3E%3Cpath%20d%3D%22m187.995%20304v-256c0-8.84-7.16-16-16-16s-16%207.16-16%2016v256z%22%20fill%3D%22%2399d0ff%22%2F%3E%3Cpath%20d%3D%22m187.995%20176v-128c0-8.84-7.16-16-16-16s-16%207.16-16%2016v128z%22%20fill%3D%22%23d6ecff%22%2F%3E%3Cpath%20d%3D%22m383.309%20104h12.687c4.418%200%208-3.582%208-8s-3.582-8-8-8h-12.687l18.344-18.343c3.124-3.125%203.124-8.189%200-11.314-3.125-3.123-8.189-3.123-11.314%200l-29.658%2029.657h-20.685v-20.686l29.657-29.657c3.124-3.125%203.124-8.189%200-11.314-3.125-3.123-8.189-3.123-11.314%200l-18.343%2018.343v-12.686c0-4.418-3.582-8-8-8s-8%203.582-8%208v12.686l-18.343-18.343c-3.125-3.123-8.189-3.123-11.314%200-3.124%203.125-3.124%208.189%200%2011.314l29.657%2029.657v20.686h-20.686l-29.657-29.657c-3.125-3.123-8.189-3.123-11.314%200-3.124%203.125-3.124%208.189%200%2011.314l18.343%2018.343h-12.686c-4.418%200-8%203.582-8%208s3.582%208%208%208h12.686l-18.344%2018.343c-3.124%203.125-3.124%208.189%200%2011.314%203.126%203.124%208.189%203.123%2011.314%200l29.658-29.657h20.686v20.686l-29.657%2029.657c-3.124%203.125-3.124%208.189%200%2011.314%203.125%203.123%208.189%203.123%2011.314%200l18.343-18.343v12.686c0%204.418%203.582%208%208%208s8-3.582%208-8v-12.686l18.343%2018.343c3.126%203.124%208.189%203.123%2011.314%200%203.124-3.125%203.124-8.189%200-11.314l-29.657-29.657v-20.686h20.685l29.657%2029.657c1.563%201.562%203.609%202.343%205.657%202.343%207.064%200%2010.712-8.601%205.657-13.657z%22%20fill%3D%22%235989b3%22%2F%3E%3C%2Fsvg%3E%0D%0A">
			<span></span>
			<div class="clear-fix"></div>
		</div>
	</div>
	<div id="tables" preloaded="false">
		<div class="block table-wrap">
			<h1 class="day-name"><span style="background-color: #686a73; border-radius: 20px; color: #686a73;">----, -- ------</span></h1>
			<table>
				<tr class="table-header table-row">
					<th class="subject-name-td">Предмет</th>
					<th>Домашнее задание</th>
				</tr>
				<tr class="table-row">
					<th><span style="background-color: #afafaf; border-radius: 10px; color: #afafaf;">-----------------</span></th>
					<th><span style="background-color: #afafaf; border-radius: 10px; color: #afafaf;">-----------------</span><img class="row-more right" width="20"></th>
				</tr>
				<tr class="table-row">
					<th><span style="background-color: #afafaf; border-radius: 10px; color: #afafaf;">-------------------</span></th>
					<th><img class="row-more right" width="20"></th>
				</tr>
				<tr class="table-row">
					<th><span style="background-color: #afafaf; border-radius: 10px; color: #afafaf;">----------------</span></th>
					<th><img class="row-more right" width="20"></th>
				</tr>
				<tr class="table-row">
					<th><span style="background-color: #afafaf; border-radius: 10px; color: #afafaf;">---------------</span></th>
					<th><span style="background-color: #afafaf; border-radius: 10px; color: #afafaf;">--------------------</span><img class="row-more right" width="20"></th>
				</tr>
				<tr class="table-row">
					<th><span style="background-color: #afafaf; border-radius: 10px; color: #afafaf;">-------</span></th>
					<th><span style="background-color: #afafaf; border-radius: 10px; color: #afafaf;">--------------</span><img class="row-more right" width="20"></th>
				</tr>
				<tr class="table-row">
					<th><span style="background-color: #afafaf; border-radius: 10px; color: #afafaf;">-----------</span></th>
					<th><span style="background-color: #afafaf; border-radius: 10px; color: #afafaf;">------</span><img class="row-more right" width="20"></th>
				</tr>
			</table>
		</div>
		<div class="block table-wrap">
			<h1 class="day-name"><span style="background-color: #686a73; border-radius: 20px; color: #686a73;">----, -- ------</span></h1>
			<table>
				<tr class="table-header table-row">
					<th class="subject-name-td">Предмет</th>
					<th>Домашнее задание</th>
				</tr>
				<tr class="table-row">
					<th><span style="background-color: #afafaf; border-radius: 10px; color: #afafaf;">-----------------</span></th>
					<th><span style="background-color: #afafaf; border-radius: 10px; color: #afafaf;">-----------------</span><img class="row-more right" width="20"></th>
				</tr>
				<tr class="table-row">
					<th><span style="background-color: #afafaf; border-radius: 10px; color: #afafaf;">-------------------</span></th>
					<th><img class="row-more right" width="20"></th>
				</tr>
				<tr class="table-row">
					<th><span style="background-color: #afafaf; border-radius: 10px; color: #afafaf;">----------------</span></th>
					<th><img class="row-more right" width="20"></th>
				</tr>
				<tr class="table-row">
					<th><span style="background-color: #afafaf; border-radius: 10px; color: #afafaf;">---------------</span></th>
					<th><span style="background-color: #afafaf; border-radius: 10px; color: #afafaf;">--------------------</span><img class="row-more right" width="20"></th>
				</tr>
				<tr class="table-row">
					<th><span style="background-color: #afafaf; border-radius: 10px; color: #afafaf;">-------</span></th>
					<th><span style="background-color: #afafaf; border-radius: 10px; color: #afafaf;">--------------</span><img class="row-more right" width="20"></th>
				</tr>
				<tr class="table-row">
					<th><span style="background-color: #afafaf; border-radius: 10px; color: #afafaf;">-----------</span></th>
					<th><span style="background-color: #afafaf; border-radius: 10px; color: #afafaf;">------</span><img class="row-more right" width="20"></th>
				</tr>
			</table>
		</div>
		<div class="block table-wrap">
			<h1 class="day-name"><span style="background-color: #686a73; border-radius: 20px; color: #686a73;">----, -- ------</span></h1>
			<table>
				<tr class="table-header table-row">
					<th class="subject-name-td">Предмет</th>
					<th>Домашнее задание</th>
				</tr>
				<tr class="table-row">
					<th><span style="background-color: #afafaf; border-radius: 10px; color: #afafaf;">-----------------</span></th>
					<th><span style="background-color: #afafaf; border-radius: 10px; color: #afafaf;">-----------------</span><img class="row-more right" width="20"></th>
				</tr>
				<tr class="table-row">
					<th><span style="background-color: #afafaf; border-radius: 10px; color: #afafaf;">-------------------</span></th>
					<th><img class="row-more right" width="20"></th>
				</tr>
				<tr class="table-row">
					<th><span style="background-color: #afafaf; border-radius: 10px; color: #afafaf;">----------------</span></th>
					<th><img class="row-more right" width="20"></th>
				</tr>
				<tr class="table-row">
					<th><span style="background-color: #afafaf; border-radius: 10px; color: #afafaf;">---------------</span></th>
					<th><span style="background-color: #afafaf; border-radius: 10px; color: #afafaf;">--------------------</span><img class="row-more right" width="20"></th>
				</tr>
				<tr class="table-row">
					<th><span style="background-color: #afafaf; border-radius: 10px; color: #afafaf;">-------</span></th>
					<th><span style="background-color: #afafaf; border-radius: 10px; color: #afafaf;">--------------</span><img class="row-more right" width="20"></th>
				</tr>
				<tr class="table-row">
					<th><span style="background-color: #afafaf; border-radius: 10px; color: #afafaf;">-----------</span></th>
					<th><span style="background-color: #afafaf; border-radius: 10px; color: #afafaf;">------</span><img class="row-more right" width="20"></th>
				</tr>
			</table>
		</div>
		<div class="block table-wrap">
			<h1 class="day-name"><span style="background-color: #686a73; border-radius: 20px; color: #686a73;">----, -- ------</span></h1>
			<table>
				<tr class="table-header table-row">
					<th class="subject-name-td">Предмет</th>
					<th>Домашнее задание</th>
				</tr>
				<tr class="table-row">
					<th><span style="background-color: #afafaf; border-radius: 10px; color: #afafaf;">-----------------</span></th>
					<th><span style="background-color: #afafaf; border-radius: 10px; color: #afafaf;">-----------------</span><img class="row-more right" width="20"></th>
				</tr>
				<tr class="table-row">
					<th><span style="background-color: #afafaf; border-radius: 10px; color: #afafaf;">-------------------</span></th>
					<th><img class="row-more right" width="20"></th>
				</tr>
				<tr class="table-row">
					<th><span style="background-color: #afafaf; border-radius: 10px; color: #afafaf;">----------------</span></th>
					<th><img class="row-more right" width="20"></th>
				</tr>
				<tr class="table-row">
					<th><span style="background-color: #afafaf; border-radius: 10px; color: #afafaf;">---------------</span></th>
					<th><span style="background-color: #afafaf; border-radius: 10px; color: #afafaf;">--------------------</span><img class="row-more right" width="20"></th>
				</tr>
				<tr class="table-row">
					<th><span style="background-color: #afafaf; border-radius: 10px; color: #afafaf;">-------</span></th>
					<th><span style="background-color: #afafaf; border-radius: 10px; color: #afafaf;">--------------</span><img class="row-more right" width="20"></th>
				</tr>
				<tr class="table-row">
					<th><span style="background-color: #afafaf; border-radius: 10px; color: #afafaf;">-----------</span></th>
					<th><span style="background-color: #afafaf; border-radius: 10px; color: #afafaf;">------</span><img class="row-more right" width="20"></th>
				</tr>
			</table>
		</div>
		<div class="block table-wrap">
			<h1 class="day-name"><span style="background-color: #686a73; border-radius: 20px; color: #686a73;">----, -- ------</span></h1>
			<table>
				<tr class="table-header table-row">
					<th class="subject-name-td">Предмет</th>
					<th>Домашнее задание</th>
				</tr>
				<tr class="table-row">
					<th><span style="background-color: #afafaf; border-radius: 10px; color: #afafaf;">-----------------</span></th>
					<th><span style="background-color: #afafaf; border-radius: 10px; color: #afafaf;">-----------------</span><img class="row-more right" width="20"></th>
				</tr>
				<tr class="table-row">
					<th><span style="background-color: #afafaf; border-radius: 10px; color: #afafaf;">-------------------</span></th>
					<th><img class="row-more right" width="20"></th>
				</tr>
				<tr class="table-row">
					<th><span style="background-color: #afafaf; border-radius: 10px; color: #afafaf;">----------------</span></th>
					<th><img class="row-more right" width="20"></th>
				</tr>
				<tr class="table-row">
					<th><span style="background-color: #afafaf; border-radius: 10px; color: #afafaf;">---------------</span></th>
					<th><span style="background-color: #afafaf; border-radius: 10px; color: #afafaf;">--------------------</span><img class="row-more right" width="20"></th>
				</tr>
				<tr class="table-row">
					<th><span style="background-color: #afafaf; border-radius: 10px; color: #afafaf;">-------</span></th>
					<th><span style="background-color: #afafaf; border-radius: 10px; color: #afafaf;">--------------</span><img class="row-more right" width="20"></th>
				</tr>
				<tr class="table-row">
					<th><span style="background-color: #afafaf; border-radius: 10px; color: #afafaf;">-----------</span></th>
					<th><span style="background-color: #afafaf; border-radius: 10px; color: #afafaf;">------</span><img class="row-more right" width="20"></th>
				</tr>
			</table>
		</div>
		<div class="block table-wrap">
			<h1 class="day-name"><span style="background-color: #686a73; border-radius: 20px; color: #686a73;">----, -- ------</span></h1>
			<table>
				<tr class="table-header table-row">
					<th class="subject-name-td">Предмет</th>
					<th>Домашнее задание</th>
				</tr>
				<tr class="table-row">
					<th><span style="background-color: #afafaf; border-radius: 10px; color: #afafaf;">-----------------</span></th>
					<th><span style="background-color: #afafaf; border-radius: 10px; color: #afafaf;">-----------------</span><img class="row-more right" width="20"></th>
				</tr>
				<tr class="table-row">
					<th><span style="background-color: #afafaf; border-radius: 10px; color: #afafaf;">-------------------</span></th>
					<th><img class="row-more right" width="20"></th>
				</tr>
				<tr class="table-row">
					<th><span style="background-color: #afafaf; border-radius: 10px; color: #afafaf;">----------------</span></th>
					<th><img class="row-more right" width="20"></th>
				</tr>
				<tr class="table-row">
					<th><span style="background-color: #afafaf; border-radius: 10px; color: #afafaf;">---------------</span></th>
					<th><span style="background-color: #afafaf; border-radius: 10px; color: #afafaf;">--------------------</span><img class="row-more right" width="20"></th>
				</tr>
				<tr class="table-row">
					<th><span style="background-color: #afafaf; border-radius: 10px; color: #afafaf;">-------</span></th>
					<th><span style="background-color: #afafaf; border-radius: 10px; color: #afafaf;">--------------</span><img class="row-more right" width="20"></th>
				</tr>
				<tr class="table-row">
					<th><span style="background-color: #afafaf; border-radius: 10px; color: #afafaf;">-----------</span></th>
					<th><span style="background-color: #afafaf; border-radius: 10px; color: #afafaf;">------</span><img class="row-more right" width="20"></th>
				</tr>
			</table>
		</div>
	</div>
</div>
<?php require 'components/footer.php'; ?>