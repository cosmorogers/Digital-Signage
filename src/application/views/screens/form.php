<?php 
/* @var $this CI_Loader */
/* @var $screen Screen */

$header = array (
		'title' => ($screen->isNew() ? 'Add a Screen' : 'Edit Screen'),
		'active' => 'screens',
		'breadcrumbs' => array (
			'Screens' => site_url('screens')
		),
		'sidemenu' => 'screens'
);


$this->view('templates/header', $header);

$this->helper('form');
?>

<?php echo form_open('', array('class'=>'form-horizontal'))?>

	<div class="control-group <?php echo (isset($errors[ScreenPeer::NAME]) ? 'error' : ''); ?>">
		<label class="control-label" for="inputName">Name</label>
		<div class="controls">
			<input type="text" name="screen[Name]" id="inputName" placeholder="Human friendly screen name" value="<?php echo $screen->getName(); ?>" >
			<span class="help-inline"><?php echo (isset($errors[ScreenPeer::NAME]) ? $errors[ScreenPeer::NAME] : ''); ?></span>
		</div>
	</div>
	
	<div class="control-group <?php echo (isset($errors[ScreenPeer::IP]) ? 'error' : ''); ?>">
		<label class="control-label" for="inputIp">IP Address</label>
		<div class="controls">
			<input type="text" name="screen[Ip]" id="inputIp" placeholder="IP Address" value="<?php echo $screen->getIp();?>" >
			<span class="help-inline"><?php echo (isset($errors[ScreenPeer::IP]) ? $errors[ScreenPeer::IP] : ''); ?></span>
		</div>
	</div>
	
		<div class="control-group <?php echo (isset($errors[ScreenPeer::MAC]) ? 'error' : ''); ?>">
		<label class="control-label" for="inputMac">Mac Address</label>
		<div class="controls">
			<input type="text" name="screen[Mac]" id="inputMac" placeholder="MAC Address" value="<?php echo $screen->getMac();?>" >
			<span class="help-inline"><?php echo (isset($errors[ScreenPeer::MAC]) ? $errors[ScreenPeer::MAC] : ''); ?></span>
		</div>
	</div>
	
	<div class="control-group <?php echo (isset($errors[ScreenPeer::WIDTH]) ? 'error' : ''); ?>">
		<label class="control-label" for="inputWidth">Width <small>(in px)</small></label>
		<div class="controls">
			<input type="text" name="screen[Width]" id="inputWidth" placeholder="1920" value="<?php echo $screen->getWidth();?>" >
			<span class="help-inline"><?php echo (isset($errors[ScreenPeer::WIDTH]) ? $errors[ScreenPeer::WIDTH] : ''); ?></span>
		</div>
	</div>
	
	<div class="control-group <?php echo (isset($errors[ScreenPeer::HEIGHT]) ? 'error' : ''); ?>">
		<label class="control-label" for="inputHeight">Height <small>(in px)</small></label>
		<div class="controls">
			<input type="text" name="screen[Height]" id="inputHeight" placeholder="1080" value="<?php echo $screen->getHeight();?>" >
			<span class="help-inline"><?php echo (isset($errors[ScreenPeer::HEIGHT]) ? $errors[ScreenPeer::HEIGHT] : ''); ?></span>
		</div>
	</div>
	


	<div class="form-actions">
		<button type="submit" class="btn btn-primary">Save changes</button>
		<a href="<?php echo site_url('screens')?>" class="btn">Cancel</a>
	</div>
</form>
    
    <?php $this->view('templates/footer');?>