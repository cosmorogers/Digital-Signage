<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Templates extends MY_Controller {

	private $templateBase = 'application/views/display/layouts';

	public function index() 
	{
		$this->load->view('screens/templates/view');
	}

	public function create()
	{
		$layouts = array();
		
		foreach(scandir($this->templateBase) as $file) {
			$layoutDescription = null;
			if (pathinfo($this->templateBase . DIRECTORY_SEPARATOR . $file, PATHINFO_EXTENSION) === 'php') {
				ob_start();
				$screen = new Screen();
				@include($this->templateBase . DIRECTORY_SEPARATOR . $file);
				ob_end_clean();

				if (!is_null($layoutDescription) && is_array($layoutDescription)) {
					$layouts[] = array(
						'name' => $layoutDescription['name'],
						'file' => $file
					);
				}
			}

		}
		$this->load->view('screens/templates/create', array('layouts' => $layouts));
	}

	public function edit($id)
	{
		//Load template

		$file = "2-column";
		$layoutDescription = null;
		
		ob_start();
		$screen = new Screen();
		include($this->templateBase . DIRECTORY_SEPARATOR . $file . '.php');
		ob_end_clean();

		if (!is_null($layoutDescription) && is_array($layoutDescription)) {
			$this->load->view('screens/templates/edit', array('layout' => $layoutDescription));
		} else {
			echo "oh noes";
		}
	
	}

}