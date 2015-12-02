<?php
	require('../config.php');
	require('vendor/autoload.php');
	$twitter = new TwitterAPIExchange($config['twitter']);

	$url = 'https://api.twitter.com/1.1/statuses/home_timeline.json';
	$requestMethod = 'GET';
	$fields = array(
		'count' => '5'
	);

	$twitter = new TwitterAPIExchange($config['twitter']);
	$res = $twitter->buildOauth($url, $requestMethod)
		->performRequest();

	$res = json_decode($res);

	$resArray = array();

	for($i = 0; $i < 5; $i++) {
		array_push($resArray, $res[$i]);
	}

	return $resArray;
