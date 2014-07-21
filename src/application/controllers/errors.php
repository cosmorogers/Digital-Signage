<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Errors extends MY_Controller {

	public function error_404() {
		if ($this->authentication->logged_in()) {
			$this->load->view('errors/404');
		} else {
			$this->addErrorMessage('You are not logged in. Please login');
			redirect('auth/login');
		}
	}	
}