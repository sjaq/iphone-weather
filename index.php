<?php

	function error($msg) {
		return '<span style="font-size:10px;font-weight:normal;">' . $msg . '</span>';
	}

	$city = isset($_GET['loc'])? $_GET['loc'] : '';
	$deg  = isset($_GET['deg'])? $_GET['deg'] : 'c';
	
	if(empty($city) || stristr($deg, 'DEGREE') || stristr($city, 'location')) {
		$out = error('read the readme!');
	} else {
		require './get_weather.php';
		$api = new GetWeather($city, $deg);
		$res = $api->get_degree();
		
		if(empty($res)) {
			$out = error('ur doin somthn wrng');
		} else {
			file_put_contents($api->cache, $res);
			$out = $res . '&deg;';
		}
	}
	
	// Extra Options:
	$refresh = (isset($_GET['refresh']) && $_GET['refresh'] >= (60*30))? $_GET['refresh'] : 60*30;
	$ext_stylesheet = isset($_GET['style'])? $_GET['style'] : '';
	$font = isset($_GET['font'])? $_GET['font'] : 'Helvetica Neue';
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">

	<head>

		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<title>iPhone Weather</title>
		<meta http-equiv="refresh" content="<?php echo $refresh ?>" />
		<style type="text/css" media="screen">
			* {
				margin: 0;
				padding: 0;
			}
			body {
				width: 320px;
				background: transparent;
				color: #fff;
				font: 20px <?php echo $font ?>;
			}
			
			#weather {
				font-weight: bold;
				position: absolute;
				right: 10px;
			}
		</style>
		<link rel="stylesheet" href="<?php echo $ext_stylesheet ?>" type="text/css" media="screen" title="custom style" charset="utf-8" />

	</head>
	
	<body>

		<div id="weather">
			<p><?php echo $out ?></p>
		</div>

	</body>

</html>