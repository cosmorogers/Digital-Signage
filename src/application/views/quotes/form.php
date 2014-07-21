<?php 
/* @var $this CI_Loader */
/* @var $quote Quote */

$header = array (
		'title' => 'Add',
		'active' => 'quotes',
		'breadcrumbs' => array (
			'Quote of the day' => site_url('quotes')
		)
);
$this->view('templates/header', $header); 

$this->helper('form');
?>
<?php echo form_open('', array('class'=>'form-horizontal'))?>

	<div class="control-group <?php echo (isset($errors[QuotePeer::QUOTE]) ? 'error' : ''); ?>">
		<label class="control-label" for="inputMessage">Message</label>
		<div class="controls">
			<textarea name="quote[Quote]" id="inputMessage" class="span8" rows="5" placeholder=""><?php echo $quote->getQuote(); ?></textarea>
			<span class="help-inline"><?php echo (isset($errors[QuotePeer::QUOTE]) ? $errors[QuotePeer::QUOTE] : ''); ?></span>
		</div>
	</div>
	
		<div class="form-actions">
		<button type="submit" class="btn btn-primary">Save changes</button>
		<a href="<?php echo site_url('quotes')?>" class="btn">Cancel</a>
	</div>
</form>
    
    <?php $this->view('templates/footer');?>