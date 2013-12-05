<?php
namespace FRMS\ControllerProvider;

use Silex\Application;
use Silex\ControllerProviderInterface;

class VanityRedirect implements ControllerProviderInterface {
	
	/* (non-PHPdoc)
	 * @see \Silex\ControllerProviderInterface::connect()
	 */
	public function connect(Application $app) {
		$controllers = $app['controllers_factory'];
		
		$controllers->get('/{vanity}', function($vanity) use($app) {
			return 'About to handle vanity ' . $vanity;
		});
		
		return $controllers;
	}

}