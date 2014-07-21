<?php
class CI_Propel {
	
	public function __construct()
	{
		require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'propel' . DIRECTORY_SEPARATOR . 'Propel.php';
		Propel::init(FCPATH . DIRECTORY_SEPARATOR . APPPATH . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'propel.php');
		set_include_path(FCPATH . DIRECTORY_SEPARATOR . APPPATH . 'models' . PATH_SEPARATOR . get_include_path());
	}
}