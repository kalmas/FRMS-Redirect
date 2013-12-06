<?php
use Silex\Application;
require_once __DIR__ . '/../bootstrap.php';

$app = new Silex\Application();
$app->register(new Igorw\Silex\ConfigServiceProvider(__DIR__ . '/../config.json'));
$app->register(new Silex\Provider\ValidatorServiceProvider());


$app['db'] = function(Application $app) {
	return new \FRMS\Db\Mssql(
			$app['config']['db']['host'],
			$app['config']['db']['database'],
			$app['config']['db']['user'],
			$app['config']['db']['pass']
	);
};
$app['site_id_translator'] = function(Application $app) {
	return new \FRMS\ValueTranslator\PrcToFrc\SiteIdTranslator($app['db']);
};
$app['redirector'] = function() {
	return new \FRMS\RedirectHelper();
};



// Debug messages
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

$app->mount('/detail', new FRMS\ControllerProvider\ProfileRedirect());
$app->mount('/browse', new FRMS\ControllerProvider\BrowseRedirect());

$app->run();
?>