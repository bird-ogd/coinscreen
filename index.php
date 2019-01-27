<html>
<head>
	<meta charset="utf-8">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<link rel="shortcut icon" type="image/x-icon" href="media/icon.png" />
	<link rel="apple-touch-icon" href="media/icon.png" />
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>CoinScreen</title>
</head>
<body>
	
	<?php
	function feed($start, $end) {

		$json = file_get_contents("https://api.coinmarketcap.com/v1/ticker/?convert=GBP&limit=48");
		$array = json_decode($json, true);

		for ($i = $start; $i < $end; $i++) {
			$name = $array[$i]["name"];
			$price = number_format($array[$i]["price_gbp"], 2, '.', '');
			if ($price < 0.01) {
				$price = "< £0.01";
			} else {
				$price = "£" . $price;
			}
			$unit = $name . $price;	
			$unitlength = strlen($unit);
			$seperator = "";
			$seperator = str_repeat(".", 25 - $unitlength);
			$string = $name . $seperator . $price;
			echo "<p>" . $string . "</p>";
		}
	}
	?>

	<h3 class="header noselect"><a class="click" onclick="location.reload();">COINSCREEN</a><span class="left"><?php echo date('D d M y G:i') . " GMT";?></span></h3>
	<h1 class="neutral noselect">COINSCREEN</h1>

	<div class="row">
		<div class="column">
			<h3 class="click " onclick="location.reload();">Prices</h3>
			<?php feed(0, 11); ?>
		</div>
		<div class="column">
			<?php feed(11, 23); ?>
		</div>
		<div class="column">
			<?php feed(23, 35); ?>
		</div>
		<div class="column">
			<?php feed(36, 48); ?>
		</div>
	</div>

	<div class="footer">
		<p>Data from <span class="yellow"><a href="https://coinmarketcap.com/" target="_blank">CoinMarketCap</a></span> | <span class="click" onclick="location.reload();">Refresh Data</span></p>
	</div>
</div>
<meta name="viewport" content="width=device-width, initial-scale=1">
</body>
</html>