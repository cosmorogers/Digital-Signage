<?php 
/* @var $this CI_Loader */
/* @var $slideshow Slideshow */

$header = array (
		'title' => ($slideshow->isNew() ? 'Add a Slideshow' : 'Edit Slideshow'),
		'active' => 'slideshows',
		'breadcrumbs' => array (
			'Slideshows' => site_url('slideshows')
		),
		'sidemenu' => 'slideshows'
);


$this->view('templates/header', $header);

$this->helper('form');
?>
<?php if (!$slideshow->isNew()): ?>
	<a href="<?= site_url('slideshows/deleteslideshow/' . $slideshow->getId())?>" class="btn btn-danger pull-right">Delete</a>
<?php endif;?>

<?= form_open('', array('class'=>'form-horizontal'))?>

	<div class="control-group <?= (isset($errors[SlideshowPeer::NAME]) ? 'error' : ''); ?>">
		<label class="control-label" for="inputName">Name</label>
		<div class="controls">
			<input type="text" name="slideshow[Name]" id="inputName" placeholder="Human friendly slideshow name" value="<?= $slideshow->getName(); ?>" >
			<span class="help-inline"><?= (isset($errors[SlideshowPeer::NAME]) ? $errors[SlideshowPeer::NAME] : ''); ?></span>
		</div>
	</div>
	
	<div class="control-group <?= (isset($errors[SlideshowPeer::WIDTH]) ? 'error' : ''); ?>">
		<label class="control-label" for="inputWidth">Width <small>(in px)</small></label>
		<div class="controls">
			<input type="text" name="slideshow[Width]" id="inputWidth" placeholder="1920" value="<?= $slideshow->getWidth();?>" >
			<span class="help-inline"><?= (isset($errors[SlideshowPeer::WIDTH]) ? $errors[SlideshowPeer::WIDTH] : ''); ?></span>
		</div>
	</div>
	
	<div class="control-group <?= (isset($errors[SlideshowPeer::HEIGHT]) ? 'error' : ''); ?>">
		<label class="control-label" for="inputHeight">Height <small>(in px)</small></label>
		<div class="controls">
			<input type="text" name="slideshow[Height]" id="inputHeight" placeholder="1000" value="<?= $slideshow->getHeight();?>" >
			<span class="help-inline"><?= (isset($errors[SlideshowPeer::HEIGHT]) ? $errors[SlideshowPeer::HEIGHT] : ''); ?></span>
		</div>
	</div>
	
	<div class="control-group <?= (isset($errors[SlideshowPeer::DELAY]) ? 'error' : ''); ?>">
		<label class="control-label" for="inputDelay">Delay <small>(in seconds)</small></label>
		<div class="controls">
			<input type="text" name="slideshow[Delay]" id="inputDelay" placeholder="4" value="<?= $slideshow->getDelay();?>" >
			<span class="help-inline"><?= (isset($errors[SlideshowPeer::DELAY]) ? $errors[SlideshowPeer::DELAY] : ''); ?></span>
		</div>
	</div>
	
	<div class="control-group <?= (isset($errors[SlideshowPeer::EFFECT]) ? 'error' : ''); ?>">
		<label class="control-label" for="inputEffect">Effect</label>
		<div class="controls">
			<select id="inputEffect" name="slideshow[Effect]">
				<?php foreach (SlideshowPeer::getValueSet(SlideshowPeer::EFFECT) as $effect) :?>
				<option value="<?= $effect ?>" <?= ($slideshow->getEffect() == $effect ? 'selected' : '') ?>><?= $effect?></option>
				<?php endforeach;?>
			</select>	
		
			<span class="help-inline"><?= (isset($errors[SlideshowPeer::EFFECT]) ? $errors[SlideshowPeer::EFFECT] : ''); ?></span>
		</div>
	</div>

	<div class="form-actions">
		<button type="submit" class="btn btn-primary">Save changes</button>
		<a href="<?= site_url('slideshows')?>" class="btn">Cancel</a>
	</div>
</form>
    
    <?php $this->view('templates/footer');?>