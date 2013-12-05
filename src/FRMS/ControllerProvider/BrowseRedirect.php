<?php
namespace FRMS\ControllerProvider;

use Silex\Application;
use Silex\ControllerProviderInterface;

class BrowseRedirect implements ControllerProviderInterface {
	
	/* (non-PHPdoc)
	 * @see \Silex\ControllerProviderInterface::connect()
	 */
	public function connect(Application $app) {
		$controllers = $app['controllers_factory'];
		
		$controllers->get('/{state}', function($state) use($app) {
			return 'About to handle state ' . $state;
		});
		
		$controllers->get('/{state}/{metro}', function($state, $metro) use($app) {
			return 'About to handle metro ' . $metro;
		});
		
		$controllers->get('/{state}/{metro}/{city}', function($state, $metro, $city) use($app) {
			return 'About to handle city ' . $city;
		});
		
		
		return $controllers;
	}

}