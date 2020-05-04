<?php

require 'class/item.class.php';
require 'class/weather.class.php';

if (isset($_POST["submit"])) {
	$city = $_POST["city"];
	$jsondata = file_get_contents("http://api.openweathermap.org/data/2.5/forecast?appid=1462b2063b2bf2916d8ba369e56a5241&q=$city&units=metric");
	$json = json_decode($jsondata, true);
}

?>

<!DOCTYPE html>
<html>

<head>
	<title>json</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" href="lib/node_modules/bootstrap/dist/css/bootstrap.css">
	<link rel="stylesheet" href="lib/node_modules/@fortawesome/fontawesome-free/css/all.min.css">
	<script src="lib/node_modules/jquery/dist/jquery.js"></script>
	<script src="lib/node_modules/bootstrap/dist/js/bootstrap.js"></script>
	<script src="lib/node_modules/popper.js/dist/umd/popper.js"></script>
</head>

<body class="container">
	<div class="row">
		<form method="post">
			<div class="row">
				<div class="col-6">
					<label class="form-check-label" for="city">City:</label>
					<input type="text" name="city" class="form-control mt-2">
				</div>
				<div class="col-12">
					<button name="submit" type="submit" class="btn btn-primary mt-2 mb-2">Submit</button>
				</div>
			</div>
		</form>
	</div>
	<?php
	if (isset($_POST["submit"])) :
	?>
		<div class="row">
			<h1><?= $json["city"]["name"] ?></h1>
		</div>
	<?php
	endif;
	?>
	<div class="row">
		<?php
		if (isset($_POST["submit"])) :
			foreach ($json['list'] as $d) :
				$weather = new Weather($d['weather'][0]['main'], $d['weather'][0]['description'], $d['weather'][0]['icon']);
				$item = new WeatherItem($d['dt_txt'], $d['wind']['speed'], $weather, $d['main']['temp']);
		?>
				<div class="card mb-2 mr-2" style="width: 16rem;">
					<img src="http://openweathermap.org/img/w/<?= $weather->icon ?>.png" class="card-img-top" alt="weater icon">
					<div class="card-body">
						<h5 class="card-title"><?= date('l d - h\hi a', strtotime($item->date)) ?></h5>
						<p><i class="fas fa-thermometer-half"></i> : <b><?= $item->temp."°C / ".($item->temp * 9 / 5 + 32)."°F" ?></b></p>
						<p><i class="fas fa-wind"></i> : <b><?= $item->wind ?>km/h</b></p>
					</div>
				</div>
		<?php
			endforeach;
		endif;
		?>
	</div>
</body>

</html>