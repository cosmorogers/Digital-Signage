<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Display extends MY_Controller {
	
	protected $restricted = false;

	public function view($mac=null)
	{
		$screen = null;		
		if (!is_null($mac)) {
			$screen = ScreenQuery::create()->findOneByMac($mac);
		} else {
			$screen = ScreenQuery::create()->findOneByIp($this->input->ip_address());
		}

		if (is_null($screen)) {
			show_404();
		} else {

			$screen->checkIn();

			/*$this->load->helper('url');
			$design = $screen->getMachineFriendlyName();
			//Yay

			if (@file_exists(APPPATH. "views/display/screen/" . $design . ".php")) {
				$this->load->view('display/screen/' . $design, array('screen' => $screen));
			} else {
				$this->load->view('display/view', array('screen' => $screen));
			}*/

            $layout = $screen->getTemplate()->getLayout();
            if (@file_exists(APPPATH . "views/display/layouts/" . $layout )) {
                $this->load->view("display/layouts/" . $layout , array('screen' => $screen));
            } else {
                //Layout not there!
            }

		}
	}
}
