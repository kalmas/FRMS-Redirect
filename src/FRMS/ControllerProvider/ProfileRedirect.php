<?php
namespace FRMS\ControllerProvider;

use Silex\Application;
use Silex\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\Request;

class ProfileRedirect implements ControllerProviderInterface {
	
	/* (non-PHPdoc)
	 * @see \Silex\ControllerProviderInterface::connect()
	 */
	public function connect(Application $app) {
		$controllers = $app['controllers_factory'];
		
		$controllers->get('/', function(Request $request) use($app) {
			return 'About to handle site ' . $request->get('id');
		});
		
		return $controllers;
	}

}