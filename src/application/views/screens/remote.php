<?php 
/* @var $this CI_Loader */
/* @var $screen Screen */

$header = array (
		'title' => 'Remote Screen',
		'active' => 'screens',
		'breadcrumbs' => array (
			'Screens' => site_url('screens')
		),
		'sidemenu' => 'screens'
);


$this->view('templates/header', $header);

?>
<h3><?= $screen->getName() ?></h3>
<?php if (!is_null($remote = $screen->getRemote())) : ?>
  <img src="<?php echo $remote; ?>">
<?php else: ?>
<p class="alert alert-error">There was a problem generating the remote preview. Is the screen running?</p>
<?php endif; ?>
<?php $this->view('templates/footer');?>
