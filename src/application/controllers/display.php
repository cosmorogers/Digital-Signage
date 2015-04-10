<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Display extends MY_Controller {
	
	protected $restricted = false;

	public function view($mac=null)
	{
		$screen = null;		
		if (!is_null($mac)) {
			$screen = ScreenQuery::create()->findOneByMac($mac);
		} else {
      $ip = $_SERVER['REMOTE_ADDR'];
      if ($this->input->valid_ip($ip)) {
			  $screen = ScreenQuery::create()->findOneByIp($ip);
      }
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


  public function proxy() {
    $url = $_GET['url'];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
/*
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (compatible;)");
 curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt ($ch, CURLOPT_FAILONERROR, true);*/
    $output = curl_exec($ch);
    echo $output;
    curl_close($ch); 
  }
}
