<?php
/* @var $this CI_Loader */
/* @var $slideshow Slideshow */

$header = array (
		'title' => 'Delete Slideshow',
		'active' => 'slideshows',
		'breadcrumbs' => array (
				'Slideshows' => site_url('slideshows')
		),
		'sidemenu' => 'slideshows'
);


$this->view('templates/header', $header);

$this->helper('form');
?>

<div class="alert alert-error alert-block">
<?= form_open('', array('class'=>'form-horizontal'))?>
	<h5>Are you sure you want to delete the slideshow '<?= $slideshow->getName() ?>'?</h5>
	<p>This action is <strong>NOT</strong> reversible.</p>
	<input type="hidden" name="confirm" value="<?= $slideshow->getId()?>">
	<button type="submit" class="btn btn-danger">Yes</button>
	<a href="<?= site_url('slideshows/edit/' . $slideshow->getId())?>" class="btn btn-success">No</a>
</form>
</div>
<?php $this->view('templates/footer');?>