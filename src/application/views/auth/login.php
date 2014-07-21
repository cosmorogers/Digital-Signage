<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>BAS::Digital Signage System</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">

<!-- Le styles -->
<link href="<?php echo base_url('assets/css/bootstrap.css'); ?>" rel="stylesheet">

<!-- <link href="css/bootstrap-responsive.css" rel="stylesheet">-->
<link href="<?php echo base_url('assets/css/admin.css');?>" rel="stylesheet">
<link href="<?php echo base_url('assets/css/smoothness/jquery-ui-1.10.1.custom.min.css');?>" rel="stylesheet">
<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<style type="text/css">
body {
	padding-top: 40px;
	padding-bottom: 40px;
}

.login {
	max-width: 300px;
	margin: 0 auto 20px;
	background-color: #fff;
	border: 1px solid #e5e5e5;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-radius: 5px;
	-webkit-box-shadow: 0 1px 2px rgba(0, 0, 0, .05);
	-moz-box-shadow: 0 1px 2px rgba(0, 0, 0, .05);
	box-shadow: 0 1px 2px rgba(0, 0, 0, .05);
	padding: 19px 29px 0 29px;
}

.form-signin .form-signin-heading,.form-signin .checkbox {
	margin-bottom: 10px;
}

.form-signin input[type="text"],.form-signin input[type="password"] {
	font-size: 16px;
	height: 37px;
	margin-bottom: 15px;
	padding: 7px 9px;
	width: 272px
}

.form-actions {
	margin-bottom: 0;
	margin-left: -29px;
	margin-right: -29px;
}

.input-append .add-on,.input-prepend .add-on {
	height: 27px;
	line-height: 27px;
}

form {
	margin: 0;
}
</style>

</head>

<body>

	<div class="container">
		<div class="login">
			<?php $this->helper('form'); echo form_open('', array('class'=>'form-signin'))?>
			<div class="login-inner">
				<h2 class="form-signin-heading">Please log in</h2>
				<?php if ($this->session->flashdata('success') !== FALSE) :?>
				<div class="alert alert-success">
					<strong>Success!</strong>
					<?php echo $this->session->flashdata('success');?>
				</div>
				<?php endif;?>
				<?php if ($this->session->flashdata('error') !== FALSE) :?>
				<div class="alert alert-error">
					<?php echo $this->session->flashdata('error');?>
				</div>
				<?php endif;?>
				<?php if ('' != $error) :?>
				<div class="alert alert-error">
					<?php echo $error?>
				</div>
				<?php endif;?>
				<div class="input-prepend">
					<span class="add-on"><i class="icon-user"></i> </span> <input
						name="auth[username]" type="text" class="input-block-level"
						id="usernameInput" placeholder="Username">
				</div>
				<div class="input-prepend">
					<span class="add-on"><i class=" icon-lock"></i> </span> <input
						name="auth[password]" type="password" class="input-block-level"
						placeholder="Password">
				</div>
			</div>
			<div class="form-actions">
				<button class="btn btn-primary pull-right" type="submit">Log in</button>
			</div>
			</form>
		</div>

	</div>
	<!-- /container -->

	<!-- Le javascript
    ================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="<?php echo base_url('assets/js/jquery-1.9.1.js'); ?>"></script>
	<script src="<?php echo base_url('assets/js/jquery-ui-1.10.1.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/js/bootstrap-modal.js'); ?>"></script>
	<script src="<?php echo base_url('assets/js/bootstrap-dropdown.js'); ?>"></script>
	<script	src="<?php echo base_url('assets/js/bootstrap-scrollspy.js'); ?>"></script>
	<script src="<?php echo base_url('assets/js/bootstrap-tab.js'); ?>"></script>
	<script src="<?php echo base_url('assets/js/bootstrap-tooltip.js'); ?>"></script>
	<script src="<?php echo base_url('assets/js/bootstrap-popover.js'); ?>"></script>
	<script src="<?php echo base_url('assets/js/bootstrap-button.js'); ?>"></script>
	<script	src="<?php echo base_url('assets/js/bootstrap-collapse.js'); ?>"></script>
	<script	src="<?php echo base_url('assets/js/bootstrap-carousel.js'); ?>"></script>
	<script	src="<?php echo base_url('assets/js/bootstrap-typeahead.js'); ?>"></script>
  <script>
    $(function() {
      $('#usernameInput').focus();
    });
  </script>
</body>
</html>
