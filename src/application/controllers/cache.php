<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cache extends MY_Controller {
	
	protected $restricted = false;

	public function manifest($id)
	{
		$screen = ScreenQuery::create()->findOneById($id);
		if (!is_null($screen)) {
			
			header('Content-Type: text/cache-manifest');
			echo "CACHE MANIFEST\n";
			echo "#v2\n";
			echo "#cache manifest for screen {$screen->getName()}\n";
			if ($screen->getId() != 5) {
				$files = array (
					base_url('assets/css/bootstrap.css'),
					base_url('assets/css/admin.css'),
					base_url('assets/css/smoothness/jquery-ui-1.10.1.custom.min.css'),
					base_url('assets/img/logo_w.png'),
				);
			} else {
				$files = array (
					base_url('assets/js/jquery-1.9.1.js'),
					base_url('assets/js/jquery.cycle2.min.js')
				);
				$slideshow = SlideshowQuery::create()->findOneById(6);
				foreach ($slideshow->getImages() as $img) {
					$files[] = $img->getSizeUrl($slideshow->getWidth(),$slideshow->getHeight(), 'black');
				}
			}			

			foreach ($files as $file) {
				echo "$file \n";
			}

			echo "\nNETWORK: \n*\n";
		}
	}
}
