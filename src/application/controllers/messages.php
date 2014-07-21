<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Messages extends MY_Controller {
	
	public function index() {
		$this->view();
	}
	
	public function view($page = 1) {
		$this->authentication->logged_in();
		$this->authentication->get_user();
		$messageQuery = MessageQuery::create();
		$filters = $this->input->get('filter');
		
		if (!is_array($filters)) {
			$filters = array(
					'when' => 'Current',
					'display' => '10'
			);
		}
		
					
		if (isset($filters['title']) && '' != $filters['title']) {
			$messageQuery->filterByTitle('%' . $filters['title'] . '%');
		}
		
		if (isset($filters['message']) && '' != $filters['message']) {
			$messageQuery->filterByTitle('%' . $filters['message'] . '%');
		}
		
		if (isset($filters['creator']) && '' != $filters['creator']) {
			$user = UserQuery::create()->findOneById($filters['creator']);
			if (!is_null($user)) {
				$messageQuery->filterByUser($user);
			}
		}
		
		if (isset($filters['when'])) {
			if ('upcoming' == strtolower($filters['when'])) {
				$messageQuery->filterFuture();
			} else if ('current' == strtolower($filters['when'])) {
				$messageQuery->filterCurrent();
			} else if ('past' == strtolower($filters['when'])) {
				$messageQuery->filterPast();
			}
		}
		
		if (isset($filters['display']) && ctype_digit($filters['display'])) {
			$perPage = $filters['display'];
		} else {
			$perPage = 10;
		}
		
		$messageQuery->orderByStart(Criteria::DESC)->orderByEnd(Criteria::DESC);
		
		
		$messages = $messageQuery->paginate($page,$perPage);
		$this->load->view('messages/view', array(
				'messages' => $messages,
				'users'    => UserQuery::create()->orderByName()->find(),
				'filters'  => $filters
			)
		);
	}	
	
	public function add() {
		$message = new Message();
		$message->setCreatedAt('@'.time());
		$message->setAuthor($this->authentication->get_user()->getName());
		$message->setUser($this->authentication->get_user());
		$this->_create($message);
	}
	
	public function edit($id) {
		$message = MessageQuery::create()->findOneById($id);
		if (!is_null($message)) {
			$this->_create($message);
		} else {
			show_404();
		}
	}
	
	protected function _create(Message $message) {
		$errors = array();
		
		if ($data = $this->input->post('message')) {
			
			if (isset($data['Start'])) {
				$start = DateTime::createFromFormat('Y-m-d', $data['Start']);
				if (FALSE !== $start) {
					$message->setStart($start);
				} else {
					$errors[MessagePeer::START] = new ValidationFailed(MessagePeer::START, '');
				}
				unset($data['Start']);
			}
			
			if (isset($data['End'])) {
				$end = DateTime::createFromFormat('Y-m-d', $data['End']);
				if (FALSE !== $start) {
					$message->setEnd($end);
				} else {
					$errors[MessagePeer::END] = new ValidationFailed(MessagePeer::END, '');
				}
				unset($data['End']);
			}
			
			$message->fromArray($data);
			
			/* @var $currentScreens PropelCollection */
			Propel::log('Gettinc current screens');
			$currentScreens = $message->getScreens();
			$screensToRemove = array();
			$screens = $this->input->post('screens');
			if ($screens !== FALSE && is_array($screens)) {
				
				foreach ($message->getScreens() as $s) {
				
					if ($s instanceof Screen) {
						if (!array_key_exists($s->getId(), $screens)) {
							$screensToRemove[] = $s;						
						} else {
							unset($screens[$s->getId()]);
						}
					} else {
						Propel::log('SCREEN NOT A SCREEN!!!' . print_r($s, true));
						var_dump($s);
					}
				}
				
				foreach ($screens as $id => $value) {
					$screen = ScreenQuery::create()->findOneById($id);
					if (!is_null($screen)) {
						if (!$currentScreens->contains($screen)) {
							$message->addScreen($screen);
						}
					}
				}
			} else {
				//Remove all
				ScreenMessageQuery::create()->filterByMessage($message)->delete();
			}
			
			foreach ($screensToRemove as $s) {
				$message->removeScreen($s);
			}
			
			if ($message->validate()) {
				$message->save();
				$this->addSuccessMessage('Message saved');
				redirect('messages');
			} else {
				$errors = $message->getValidationFailures();
			}
			
		}
		
		$this->load->view('messages/form', array(
				'message' => $message, 
				'errors'  => $errors,
				'screens' => ScreenQuery::create()->orderByName()->find()
			)
		);
	}
	
	public function delete($id) {
		$message = MessageQuery::create()->findOneById($id);
		if (!is_null($message)) {
			if ($this->input->post('confirm') !== FALSE && $this->input->post('confirm') == $id) {
				$message->delete();
				$this->addSuccessMessage('Message deleted');
				redirect('messages');
			} else {
				$this->load->view('messages/delete', array('message'=>$message));
			}
		} else {
			show_404();
		}
	}
	
}