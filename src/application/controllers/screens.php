<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Screens extends MY_Controller {
	
	public function index() 
	{
		$this->view();
	}
	
	public function view()
	{
		//$this->load->helper('url');
	
		$query = ScreenQuery::create()->find();
	
	
		$data = array (
				'screens' => $query
		);
		$this->load->view('screens/view', $data);
		//$this->load->view('templates/footer');
	
	}
	
	public function add() 
	{
		$this->_create(new Screen());
	}
	
	public function edit($id) 
	{
		$screen = ScreenQuery::create()->findOneById($id);
		if (!is_null($screen)) {
			$this->_create($screen);
		} else {
			show_404();
		}
	}
	
	protected function _create(Screen $screen) 
	{
		$errors = array();
		if ($data = $this->input->post('screen')) {
			
			$screen->fromArray($data);
			
			if ($screen->validate()) {
				$screen->save();
				$this->addSuccessMessage('Screen saved');
				redirect('screens');
			} else {
				$errors = $screen->getValidationFailures();
			}
			
		}
		
		$this->load->view('screens/form', array('screen' => $screen, 'errors' => $errors));
	}
	
	public function delete($id) 
	{
		$screen = ScreenQuery::create()->findOneById($id);
		if (!is_null($screen)) {
			if ($this->input->post('confirm') !== FALSE && $this->input->post('confirm') == $id) {
				$screen->delete();
				$this->addSuccessMessage('Screen deleted');
				redirect('screens');
			} else {
				$this->load->view('screens/delete', array('screen'=>$screen));
			}
		} else {
			show_404();
		}
	}

	public function checkAlive($id) 
	{
		$screen = ScreenQuery::create()->findOneById($id);
		if (!is_null($screen)) {
			echo json_encode(array('alive' => $screen->checkAlive()));
		} else {
			show_404();
		}
	}

	public function boot($id) 
	{
		$screen = ScreenQuery::create()->findOneById($id);
		if (!is_null($screen)) {
			echo json_encode(array('boot' => $screen->magicBoot()));
		} else {
			show_404();
		}
	}

	public function remote($id)
	{
		$screen = ScreenQuery::create()->findOneById($id);
		if (!is_null($screen)) {
			$this->load->view('screens/remote', array('screen'=>$screen));
		} else {
			show_404();
		}
	}
}
