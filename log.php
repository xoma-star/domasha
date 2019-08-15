<!DOCTYPE html>
<html>
<head>
	<title>domasha-logger</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/loader.css">
	<link rel="stylesheet" type="text/css" href="css/main.css?<?php echo time(); ?>">
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<script mine="true" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	<script mine="true" src="js/cookie.js"></script>
	<script mine="true">
		function loader_show(){
			$('.loader').show();
		}
		function loader_hide(){
			$('.loader').hide();
		}
		loader_show();
	</script>
	<style>
		table{
			width: 90%;
			overflow-x: auto;
			margin: 20px auto;
			background-color: #fff;
			border-collapse: collapse;
		}
		tr{
			border: 1px solid black;
		}
	</style>
</head>
<body>
	<select id="select_file">
		<option>файл</option>
		<?php 
			$logs = array_diff(scandir('fc/logs'), ['.', '..']);
			for ($i=2; $i < count($logs)+2; $i++) { 
				?>
				<option><?php echo $logs[$i]; ?></option>
				<?php
			}
		?>
	</select>
	<select id="select_type">
		<option>тип</option>
		<option>subject</option>
		<option>get_day_data</option>
		<option>get_hw_data</option>
		<option>get_tables</option>
		<option>image_remove</option>
		<option>uploaded_doc</option>
		<option>docs</option>
		<option>homework</option>
		<option>notes</option>
		<option>add_photo</option>
		<option>weekend</option>
	</select>
	<table>
		
	</table>
	<script>
		$('#select_file').change(function(){
			$.ajax({
				type: 'GET',
				url: 'fc/get_logs.php',
				data: {'name':$(this).val()},
				success: function(data){
					$('table').html(data);
				}
		    });
		});
		$('#select_type').change(function(){
			if ($(this).val() == 'тип') {
				$('tr').show();
			}
			else{
				$('tr[type!="'+$(this).val()+'"]').hide();
			}
		});
	</script>
</body>
</html>