<?php 
/* @var $this CI_Loader */
/* @var $message Message */

$header = array (
		'title' => ($message->isNew() ? 'Add a Message' : 'Edit Message'),
		'active' => 'messages',
		'breadcrumbs' => array (
			'Messages' => site_url('messages')
		)
);

$this->view('templates/header', $header);

$this->helper('form');
?>

<?php echo form_open('', array('class'=>'form-horizontal'))?>

	<div class="control-group <?php echo (isset($errors[MessagePeer::TITLE]) ? 'error' : ''); ?>">
		<label class="control-label" for="inputTitle">Title</label>
		<div class="controls">
			<input type="text" name="message[Title]" class="span8" id="inputTitle" placeholder="Message title" value="<?php echo $message->getTitle(); ?>" >
			<span class="help-inline"><?php echo (isset($errors[MessagePeer::TITLE]) ? $errors[MessagePeer::TITLE] : ''); ?></span>
		</div>
	</div>
	
	<div class="control-group <?php echo (isset($errors[MessagePeer::AUTHOR]) ? 'error' : ''); ?>">
		<label class="control-label" for="inputAuthor">Author</label>
		<div class="controls">
			<input type="text" name="message[Author]" class="span8" id="inputAuthor" placeholder="Message Author" value="<?php echo $message->getAuthor(); ?>" >
			<span class="help-inline"><?php echo (isset($errors[MessagePeer::AUTHOR]) ? $errors[MessagePeer::AUTHOR] : ''); ?></span>
		</div>
	</div>
	
	<div class="control-group <?php echo (isset($errors[MessagePeer::MESSAGE]) ? 'error' : ''); ?>">
		<label class="control-label" for="inputMessage">Message</label>
		<div class="controls">
			<textarea name="message[Message]" id="inputMessage" class="span8" rows="5" placeholder="Message content"><?php echo $message->getMessage(); ?></textarea>
			<span class="help-inline"><?php echo (isset($errors[MessagePeer::MESSAGE]) ? $errors[MessagePeer::MESSAGE] : ''); ?></span>
		</div>
	</div>
	
	<div class="control-group <?php echo (isset($errors[MessagePeer::START]) ? 'error' : ''); ?>">
		<label class="control-label" for="inputStart">Start date</label>
		<div class="controls">
			<div class="input-append">
				<input type="text" name="message[Start]" class="datepicker" id="inputStart" placeholder="yyyy-mm-dd" value="<?php echo $message->getStart('Y-m-d'); ?>" >
				<span class="add-on">YYYY-MM-DD</span>
			</div>
			<span class="help-inline"><?php echo (isset($errors[MessagePeer::START]) ? $errors[MessagePeer::START] : ''); ?></span>
		</div>
	</div>
	
	<div class="control-group <?php echo (isset($errors[MessagePeer::END]) ? 'error' : ''); ?>">
		<label class="control-label" for="inputEnd">End date</label>
		<div class="controls">
			<div class="input-append">
				<input type="text" name="message[End]" class="datepicker" id="inputEnd" placeholder="yyyy-mm-dd" value="<?php echo $message->getEnd('Y-m-d'); ?>" >
				<span class="add-on">YYYY-MM-DD</span>
			</div>
			<span class="help-inline"><?php echo (isset($errors[MessagePeer::END]) ? $errors[MessagePeer::END] : ''); ?></span>
		</div>
	</div>
	
	<div class="control-group <?php echo (isset($errors['screens']) ? 'error' : ''); ?>">
		<label class="control-label" for="inputEnd">Screens</label>
		<div class="controls">
			<table class="table table-condensed table-hover">
			<?php if (0 == $screens->count()) :?>
				<tr>
					<td colspan="2">There are no screens yet. Please add some</td>
				</tr>
			<?php else :?>
				<?php foreach ($screens as $screen) : /* @var $screen Screen */?>
				<?php 
					if ($message->isNew() || $message->getScreens()->contains($screen) )  {
						$checked = 'checked="checked"';
					} else {
						$checked = '';
					}
				?>
				<tr>
					<td class="checkbox-col"><input type="checkbox" id="screensInput<?php echo $screen->getId();?>" name="screens[<?php echo $screen->getId();?>]" <?php echo $checked;?> ></td>
					<td><label class="checkbox-label" for="screensInput<?php echo $screen->getId();?>"><?php echo $screen->getName(); ?></label></td>
				</tr>
				<?php endforeach;?>
			<?php endif;?>
			</table>
			
			
			<span class="help-inline"><?php echo (isset($errors['screens']) ? $errors['screens'] : ''); ?></span>
		</div>
	</div>
	
	<div class="form-actions">
		<button type="submit" class="btn btn-primary">Save changes</button>
		<a href="<?php echo site_url('messages')?>" class="btn">Cancel</a>
	</div>
</form>
    
    <?php $this->view('templates/footer');?>