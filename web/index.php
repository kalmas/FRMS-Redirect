<?php
require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();

//Debug messages
$app['debug'] = FALSE;

$app->get('/', function() use($app) {
	return $app->redirect('http://forrent.com/es/',301);
});

$app->get('/browse.php', function() use($app) {
	return $app->redirect('http://www.forrent.com/es/search.php',301);
});

$app->get('/listyourprop.php', function() use($app) {
	return $app->redirect('https://secure.forrent.com/es/privatePartySignup.php?step=0',301);
});
	
$app->get('/admin.php', function() use($app) {
	return $app->redirect('http://www.forrent.com/es/admin.php',301);
});

$app->get('/aboutus.php', function() use($app) {
	return $app->redirect('http://www.forrent.com/es/aboutus.php',301);
});

$app->get('/contactus.php', function() use($app) {
	return $app->redirect('http://www.forrent.com/es/contactus.php',301);
});

$app->run();
?>