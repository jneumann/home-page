<?php
  require('config.php');
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

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<link rel="stylesheet" href="css/main.css">
	</head>
	<body>
		<div class="container">
			<!-- Add your site or application content here -->
			<div class="title">
				<h1>Welcome Home</h1>
			</div>
			<div class="links row">
				<div class="col-lg-2 col-sm-2">
					<img src="https://www.atlassian.com/wac/sectionWrap/08/column/02/moreContent/0/imageBinary/logo_bitbucket-blue.svg" />
					<a href="http://bitbucket.com">Bitbucket</a>
				</div>
				<div class="col-lg-2 col-sm-2">
					<img src="images/github.svg" />
					<a href="http://github.com">Github</a>
				</div>
				<div class="col-lg-2 col-sm-2">
					<img src="images/facebook.svg" />
					<a href="http://facebook.com">Facebook</a>
				</div>
				<div class="col-lg-2 col-sm-2">
					<img src="images/php.svg" />
					<a href="http://sites.hdg/info.php">PhpInfo</a>
				</div>
				<div class="col-lg-2 col-sm-2">
					<img src="http://www.ycombinator.com/images/ycombinator-logo-fb889e2e.png" />
					<a href="http://news.ycombinator.com">Hacker News</a>
				</div>
				<div class="col-lg-2 col-sm-2">
					<img src="http://s.cafebazaar.ir/1/upload/icons/com.devhd.feedly.png" />
					<a href="http://feedly.com">Feedly</a>
				</div>
			</div>
			<hr />
			<div class="classdojo row">
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
			<hr />
			<div class="twitter row">
				<h1>Twitter</h1>
			</div>
			<hr />
			<div class="podio row">
				<h1>Podio</h1>
			</div>
			<hr />
			<div class="fitbit row">
				<h1>Fitbit</h1>
			</div>
		</div>
	</body>
</html>
