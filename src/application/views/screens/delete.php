<?php 
/* @var $this CI_Loader */
/* @var $screen Screen */

$header = array (
		'title' => 'Delete Screen',
		'active' => 'screens',
		'breadcrumbs' => array (
			'Screens' => site_url('screens')
		),
		'sidemenu' => 'screens'
);


$this->view('templates/header', $header);

$this->helper('form');
?>

<div class="alert alert-error alert-block">
<?php echo form_open('', array('class'=>'form-horizontal'))?>
	<h5>Are you sure you want to delete the screen "<?php echo $screen->getName(); ?>" ?</h5>
	<p>This action is <strong>NOT</strong> reversible.</p>
	<input type="hidden" name="confirm" value="<?php echo $screen->getId()?>">
	<button type="submit" class="btn btn-danger">Yes</button>
	<a href="<?php echo site_url('screens')?>" class="btn btn-success">No</a>
</form>
</div>
<?php $this->view('templates/footer');?>