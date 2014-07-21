<?php 
/* @var $this CI_Loader */
/* @var $message Message */

$header = array (
		'title' => 'Delete Message',
		'active' => 'messages',
		'breadcrumbs' => array (
			'Messages' => site_url('messages')
		),
		'sidemenu' => 'screens'
);


$this->view('templates/header', $header);

$this->helper('form');
?>

<div class="alert alert-error alert-block">
<?= form_open('', array('class'=>'form-horizontal'))?>
	<h5>Are you sure you want to delete this message?</h5>
	<blockquote class="well">
		<?= $message->getMessage()?>
		<small><?= $message->getAuthor() . ', ' . $message->getStart() . ' - ' . $message->getEnd(); ?></small>
	</blockquote>
	<p>This action is <strong>NOT</strong> reversible.</p>
	<input type="hidden" name="confirm" value="<?= $message->getId()?>">
	<button type="submit" class="btn btn-danger">Yes</button>
	<a href="<?= site_url('messages')?>" class="btn btn-success">No</a>
</form>
</div>
<?php $this->view('templates/footer');?>