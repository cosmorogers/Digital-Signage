<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MY_Controller extends CI_Controller {

	/**
	 *
	 * @var CI_Loader
	 */
	public $load;

	/**
	 * 
	 * @var CI_Input
	 */
	public $input;
	
	/**
	 * 
	 * @var CI_Session
	 */
	public $session;
	
	protected $restricted = true;
	
	public function __construct() {
		parent::__construct();
		
		if ($this->restricted) {
			if (!$this->authentication->logged_in()) {
				$this->addErrorMessage('You are not logged in. Please login');
				redirect('auth/login');
			}
		}
	}
	
	protected function addSuccessMessage($msg) 
	{
		$this->session->set_flashdata('success', $msg);
	}
	
	protected function addErrorMessage($msg) {
		$this->session->set_flashdata('error', $msg);
	}
}
