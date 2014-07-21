<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends MY_Controller {
	
	protected $restricted = false;
	
	
	
	public function login() {
		$error = '';
		if ($data = $this->input->post('auth')) {
			/* @var $user User */
			$user = UserQuery::create()->findOneByUsername($data['username']);
			
			if (!is_null($user)) {
				if ($user->verify($data['password'])) {
					$this->authentication->login($user);
					redirect('dashboard');
				} else {
					$error = 'Incorrect password';
				}
			} else {
				//Unknown user
				$error = 'Unknown user';
			}
			
		}
		
		$this->load->view('auth/login', array('error' => $error));
	}
	
	public function logout() {
		$this->authentication->logout();
		$this->addSuccessMessage('You have been logged out');
		redirect('auth/login');
	}
}