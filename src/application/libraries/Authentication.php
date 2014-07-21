<?php
class Authentication {
	
	protected $CI;
	protected $user = NULL;
	
	public function __construct() {
		$this->CI =& get_instance();
	}	
	
	public function login (User $user) {
		$user = $user->toArray();
		$user['logged_in'] = TRUE;
		unset($user['Password']);
		$this->CI->session->set_userdata($user);
	}
	
	public function logout (User $user) {
		$this->CI->session->sess_destroy();
	}
	
	public function logged_in() {
		if($this->CI->session->userdata('logged_in') === TRUE) {
			if (!is_null($this->get_user())) {
				return TRUE;
			} else {
				return FALSE;
			}
		} else {
			return FALSE;
		}
	}
	
	public function get_user() {
		if (is_null($this->user)) {
			$id = $this->CI->session->userdata('Id');
			if ($id !== FALSE) {
				$this->user = UserQuery::create()->findOneById($id);
			}
		}
		
		return $this->user;
	}
	
}