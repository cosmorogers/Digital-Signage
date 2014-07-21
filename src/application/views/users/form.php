<?php 
/* @var $this CI_Loader */
/* @var $user User */

$header = array (
		'title' => ($user->isNew() ? 'Add a User' : 'Edit User'),
		'active' => 'users',
		'breadcrumbs' => array (
			'Users' => site_url('users')
		)
);

$this->view('templates/header', $header);

$this->helper('form');
?>

<?php echo form_open('', array('class'=>'form-horizontal'))?>
	
	<div class="control-group <?php echo (isset($errors[UserPeer::USERNAME]) ? 'error' : ''); ?>">
		<label class="control-label" for="inputUsername">Username</label>
		<div class="controls">
			<input type="text" name="user[Username]" class="span8" id="inputUsername" placeholder="Username" value="<?php echo $user->getUsername(); ?>" >
			<span class="help-inline"><?php echo (isset($errors[UserPeer::USERNAME]) ? $errors[UserPeer::USERNAME] : ''); ?></span>
		</div>
	</div>
	
	<div class="control-group <?php echo (isset($errors[UserPeer::NAME]) ? 'error' : ''); ?>">
		<label class="control-label" for="inputName">Name</label>
		<div class="controls">
			<input type="text" name="user[Name]" class="span8" id="inputName" placeholder="Display name" value="<?php echo $user->getName(); ?>" >
			<span class="help-inline"><?php echo (isset($errors[UserPeer::NAME]) ? $errors[UserPeer::NAME] : ''); ?></span>
		</div>
	</div>
	
	<div class="control-group">
		<label class="control-label" for="inputAuth">Authentication</label>
		<div class="controls">
			<label>
				<input type="checkbox" name="user[UseAd]" id="inputLdap" <?php echo ($user->getUseAd() ? 'checked' : '' )?>>
				Use Active Directory
			</label>
		</div>
	</div>
	
	
	<div class="control-group <?php echo (isset($errors[UserPeer::PASSWORD]) ? 'error' : ''); ?> password-control-group <?php echo ($user->getUseAd() ? 'hide' : '' )?>">
		<label class="control-label" for="inputPassword">Password</label>
		<div class="controls">
			<input type="text" name="user[Password]" class="span8" id="inputPassword" placeholder="Leave blank to leave password unchanged" value="" >
			<span class="help-inline"><?php echo (isset($errors[UserPeer::PASSWORD]) ? $errors[UserPeer::PASSWORD] : ''); ?></span>
		</div>
	</div>
	
	<div class="control-group password-control-group <?php echo ($user->getUseAd() ? 'hide' : '' )?>">
		<label class="control-label" for="inputConfirmPassword">Repeat Password</label>
		<div class="controls">
			<input type="text" name="user[ConfirmPassword]" class="span8" id="inputConfirmPassword" placeholder="" value="" >
			<span class="help-inline"></span>
		</div>
	</div>
	
	<div class="form-actions">
		<button type="submit" class="btn btn-primary">Save changes</button>
		<a href="<?php echo site_url('users')?>" class="btn">Cancel</a>
	</div>
</form>

<?php
$footer = array (
		'js' => array('users.js')
); 
$this->view('templates/footer', $footer);?>