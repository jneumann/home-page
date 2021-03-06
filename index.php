<?php
  require('config.php');
  require('vendor/autoload.php');

  date_default_timezone_set("US/Central");
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<title></title>
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

		<script src="home.js"></script>

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<link rel="stylesheet" href="css/main.css">
	</head>
	<body>
		<div class="container">
			<!-- Add your site or application content here -->
			<div class="title">
				<h1>Welcome Home</h1>
			</div>
			<div class="links row hidden-xs">
				<div class="col-lg-2 col-md-2 col-sm-4">
					<a href="http://bitbucket.com">
						<img src="images/Bitbucket.svg" />
						Bitbucket
					</a>
				</div>
				<div class="col-lg-2 col-md-2 col-sm-4">
					<a href="http://github.com">
						<img src="images/github.svg" />
						Github
					</a>
				</div>
				<div class="col-lg-2 col-md-2 col-sm-4">
					<a href="http://podio.com">
						<img src="images/Podio.svg" />
						Podio
					</a>
				</div>
				<div class="col-lg-2 col-md-2 col-sm-4">
					<a href="http://sites.hdg/info.php">
						<img src="images/php.svg" />
						PhpInfo
					</a>
				</div>
				<div class="col-lg-2 col-md-2 col-sm-4">
					<a href="http://news.ycombinator.com">
						<img src="images/y-combinator.svg" />
						Hacker News
					</a>
				</div>
				<div class="col-lg-2 col-md-2 col-sm-4">
					<a href="http://feedly.com">
						<img src="http://s.cafebazaar.ir/1/upload/icons/com.devhd.feedly.png" />
						Feedly
					</a>
				</div>
			</div>
			<hr class="hidden-xs" />
			<div class="row">
				<div class="weather col-md-4 col-lg-3 clearfix">
					<?php
						$cu = curl_init();
						curl_setopt($cu, CURLOPT_URL, 'https://api.forecast.io/forecast/0b99f4b010921b26f03d8c216358378d/41.3510,-88.8391');
						curl_setopt($cu, CURLOPT_HTTPHEADER, $config['classdojo']);
						curl_setopt($cu, CURLOPT_RETURNTRANSFER, 1);
						$weather = curl_exec($cu);
						curl_close($cu);

						$weather = json_decode($weather);
					?>
					<h1>Weather</h1>
					<div class="col-sm-6">
					<h3>Today</h3>
					<i class="wi wi-forecast-io-<?php echo $weather->daily->data[0]->icon; ?>"></i>
					<p>
						<?php
							echo $weather->daily->data[0]->summary . '<br />';
							echo round($weather->currently->apparentTemperature, 0) . '&#176;<br />';
						?>
					</p>
					</div>
					<div class="col-sm-6">
					<h3>Tomorrow</h3>
					<i class="wi wi-forecast-io-<?php echo $weather->daily->data[1]->icon; ?>"></i>
					<p>
						<?php
							echo $weather->daily->data[1]->summary . '<br />';
							echo round($weather->daily->data[1]->apparentTemperatureMin, 0) . '&#176; -' . round($weather->daily->data[1]->apparentTemperatureMax, 0) . '&#176;<br />';
						?>
					</p>
					</div>
				</div>
				<div class="twitter col-md-8 col-lg-9">
					<h1>Twitter</h1>
					<div class="">
					<?php
						$tweets = require('functions/twitter.php');

						foreach($tweets as $k => $v) {
							echo "<div class='row'>";
							echo "<div class='col-sm-12'>";
							echo "<a href='http://twitter.com/" . $v->user->screen_name . "' target='_blank'>";
							echo "<img src='" . $v->user->profile_image_url . "' />";
							echo "</a>";
							echo '<h3>';
							echo "<a href='http://twitter.com/" . $v->user->screen_name . "' target='_blank' style='color:#000'>";
							echo $v->user->name;
							echo "</a>";
							echo '</h3>';
							if(isset($v->entities->urls['0']->url)) {
								echo "<a href='" . $v->entities->urls['0']->url . "' target='_blank'>";
							}
							echo $v->text;
							if(isset($v->entities->urls['0']->url)) {
								echo "</a>";
							}
							echo "</div>";
							echo "</div>";
						}
					?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<h1>Podio</h1>
					<?php
						Podio::setup($config['podio']['client-id'], $config['podio']['client-secret']);
						Podio::authenticate_with_app($config['podio']['ww-app-id'], $config['podio']['ww-app-secret']);
						$ww = PodioItem::filter($config['podio']['ww-app-id']);

						foreach($ww as $week) {
							if ($week->title == 'Jake Neumann') {
								$week_start = $week->fields['1']->values['start'];

								if((time()-(60*60*24*7)) < strtotime($week_start->format('Y-m-d H:i:s'))) {
									// var_dump( $week->fields );
									foreach( (array) $week->fields as $week) {
										foreach( (array) $week as $day) {
											if (is_object($day) && $day->type == 'app') {
												echo '<h4>' . $day->label . '</h4>';
												foreach($day->values as $proj) {
													echo '<a href="' . $proj->link . '" target="_blank">';
													echo $proj->title;
													echo '</a>';
													echo '<br />';
												}
											}
										}
									}
								}
							}
						}
					?>
				</div>
				<div class="classdojo col-md-6">
					<div class="col-sm-12">
						<h1>Class Dojo</h1>
					</div>
						<?php
							$cu = curl_init();
							curl_setopt($cu, CURLOPT_URL, 'https://home.classdojo.com/api/parent/5603218c458be92d1d471717/student');
							curl_setopt($cu, CURLOPT_HTTPHEADER, $config['classdojo']);
							curl_setopt($cu, CURLOPT_RETURNTRANSFER, 1);
							$res = curl_exec($cu);
							curl_close($cu);

							$cu = curl_init();
							curl_setopt($cu, CURLOPT_URL, 'https://home.classdojo.com/api/storyPost');
							curl_setopt($cu, CURLOPT_HTTPHEADER, $config['classdojo']);
							curl_setopt($cu, CURLOPT_RETURNTRANSFER, 1);
							$mes = curl_exec($cu);
							curl_close($cu);
							$res = json_decode($res);
							$res = $res->_items[0];
							$mes = json_decode($mes);
							$mes = $mes->_items[0];
						?>
					<div class="col-sm-6">
						<?php
							echo '<h3>Teacher</h3> ' . $res->teacher->title . ' ' . $res->teacher->lastName . '<br />';
						?>
					</div>
					<div class="col-sm-6">
						<?php
							echo '<h3>Points</h3> ' .  $res->currentPoints . '<br />';
						?>
					</div>
					<div class="col-sm-12">
						<?php
							echo '<h3>Latest Message (' . date('m/d/Y', strtotime($mes->createdAt)) . ')</h3>';
							if (isset($mes->attachments[0]->path)) {
								echo '<img src="' . $mes->attachments[0]->path . '" />';
							}
							echo '<p>' . $mes->body . '</p>';
						?>
					</div>
				</div>
			</div>
			<hr class="hidden-xs" />
			<div class="fitbit row">
				<h1>Fitbit</h1>
			</div>
		</div>
	</body>
</html>
