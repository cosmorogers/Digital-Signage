<?php 
/* @var $this CI_Loader */
/* @var $screens PropelCollection */

$header = array (
		'title' => 'Create A Template',
		'active' => 'screens',
		'breadcrumbs' => array (
			'Screens' => site_url('screens'),
			'Templates' => site_url('templates')		
		),
		'sidemenu' => 'screens'
);
$this->view('templates/header', $header); 
$this->helper('form');
?>

<?php echo form_open('', array('class'=>'form-horizontal'))?>

	<div class="control-group <?php echo (isset($errors[TemplatePeer::NAME]) ? 'error' : ''); ?>">
		<label class="control-label" for="inputName">Name</label>
		<div class="controls">
			<input type="text" name="template[Name]" id="inputName" placeholder="Human friendly template name" value="<?php echo $template->getName(); ?>" >
            <span class="help-inline"><?php echo (isset($errors[TemplatePeer::NAME]) ? $errors[TemplatePeer::NAME] : ''); ?></span>

        </div>
	</div>

	<div class="control-group <?php echo (isset($errors[TemplatePeer::LAYOUT]) ? 'error' : ''); ?>">
		<label class="control-label" for="inputLayout">Layout</label>
		<div class="controls">
			<select name="template[Layout]">
				<?php foreach($layouts as $layout): ?>
				<option value="<?php echo $layout['file']; ?>"><?php echo $layout['name']; ?></option>
				<?php endforeach; ?>
			</select>
            <span class="help-inline"><?php echo (isset($errors[TemplatePeer::LAYOUT]) ? $errors[TemplatePeer::LAYOUT] : ''); ?></span>
        </div>

	</div>

	<div class="form-actions">
		<button type="submit" class="btn btn-primary">Create</button>
		<a href="<?php echo site_url('templates')?>" class="btn">Cancel</a>
	</div>
</form>

<?php $this->view('templates/footer');?>
