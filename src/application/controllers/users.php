<?php
class Users extends MY_Controller {
	
	public function index() {
		$users = UserQuery::create()->find();
		$this->load->view('users/view', array('users' => $users));
	}
	
	public function add() {
		$user = new User();
		$this->_create($user);
	}
	
	public function edit($id) {
		$user = UserQuery::create()->findOneById($id);
		if (!is_null($user)) {
			$this->_create($user);
		} else {
			show_404();
		}
	}
	
	protected function _create(User $user) {
		$errors = array();
		if ($data = $this->input->post('user')) {
			$errors = array();
			//Use active directory
			if (isset($data['UseAd'])) {
				$data['UseAd'] = true;
			} else {
				$data['UseAd'] = false;
			}
			
			if ($data['UseAd']) {
				$data['Password'] = NULL; //Remove password
			} else {
				//Use password
				if ('' == $data['Password']) {
					//Password left blank
					if (is_null($user->getPassword())) {
						//No password entered and no password set
						$errors[UserPeer::PASSWORD] = new ValidationFailed(UserPeer::PASSWORD, 'No password stored in database yet. Please enter one');
					} else {
						unset($data['Password']);							
					}
				} else {
					//Change password
					if ($data['Password'] === $data['ConfirmPassword']) {
						//OK
					} else {
						//No ok
						$errors[UserPeer::PASSWORD] = new ValidationFailed(UserPeer::PASSWORD, 'Password and confirm password did not match');
					}
				}
			}
			
			
			$user->fromArray($data);
			
			if ($user->validate() && empty($errors)) {
				$user->save();
				$this->addSuccessMessage('User saved');
				redirect('users');
			} else {
				$errors = array_merge($errors, $user->getValidationFailures());
			}
		}
		
		$this->load->view('users/form', array(
				'user' => $user,
				'errors' => $errors
			)
		);
	}
}
