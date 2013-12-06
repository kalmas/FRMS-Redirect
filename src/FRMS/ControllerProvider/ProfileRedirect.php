<?php
namespace FRMS\ControllerProvider;

use Silex\Application;
use Silex\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

class ProfileRedirect implements ControllerProviderInterface {
	
	/* (non-PHPdoc)
	 * @see \Silex\ControllerProviderInterface::connect()
	 */
	public function connect(Application $app) {
		$controllers = $app['controllers_factory'];
		
		$controllers->get('/', function(Request $request) use($app) {
			$errors = $app['validator']->validateValue($request->get('id'), new Assert\Regex(array(
					'pattern' => '/^\d+$/'
				)));
			
			if(count($errors) > 0) {
				return $app['redirector']->redirect();
			} else {
				$siteId = $request->get('id');
			}
			
			$translator = $app['site_id_translator'];
			$value = $translator->translate($siteId);
			
			return $app['redirector']->redirect($value);
		});
		
		return $controllers;
	}

}