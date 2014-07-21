<?php 
/* @var $this CI_Loader */
/* @var $screen Screen */

$header = array (
		'title' => '404 Page not found',
		'breadcrumbs' => array()
);

$this->view('templates/header', $header);


?>


<h5>The requested page could not be found</h5>
<p>The requested URL <a href="<?= current_url();?>"><?= current_url(); ?></a> could not be found. Sorry</p>

<?php $this->view('templates/footer');?>