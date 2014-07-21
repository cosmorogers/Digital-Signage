<?php
/* $screen Screen */ 
?>
<?= $screen->getName(); ?>
<!DOCTYPE html>
<html lang="en" manifest="<?php echo site_url('cache/manifest/' . $screen->getId()); ?>">
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

  </head>

  <body>
<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a class="brand" href="#"><img src="<?php echo base_url('assets/img/logo_w.png'); ?>" /> Digital Signage System</a>			</div>
			</div><!--/.nav-collapse -->
		</div>
	</div>

    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span12">
		<div class="hero-unit">
			<h1>Screen Placeholder!</h1>
			<p>Normal service will resume shortly</p>
		</div>
	</div>
      </div>
    </div>
  </body>        
</html>


