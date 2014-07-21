<?php 
/* @var $this CI_Loader */
/* @var $quote Quote */

$header = array (
		'title' => 'Delete Quote',
		'active' => 'quotes',
		'breadcrumbs' => array (
			'Quotes' => site_url('quotes')
		),
		'sidemenu' => 'screens'
);


$this->view('templates/header', $header);

$this->helper('form');
?>

<div class="alert alert-error alert-block">
<?= form_open('', array('class'=>'form-horizontal'))?>
	<h5>Are you sure you want to delete this quote?</h5>
	<blockquote class="well">
		<?= $quote->getQuote()?>
	</blockquote>
	<p>This action is <strong>NOT</strong> reversible.</p>
	<input type="hidden" name="confirm" value="<?= $quote->getId()?>">
	<button type="submit" class="btn btn-danger">Yes</button>
	<a href="<?= site_url('messages')?>" class="btn btn-success">No</a>
</form>
</div>
<?php $this->view('templates/footer');?>