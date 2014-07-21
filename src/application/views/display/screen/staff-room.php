<?php
/* $screen Screen */ 
?>

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

	<style type="text/css">
		body, html {
			overflow: hidden;
			width: <?= $screen->getWidth() ?>px;
			height: <?= $screen->getHeight() ?>px;
		}
		.hero-unit p { font-size: 30px; margin-top: 5px; }
	</style>

  </head>

  <body>
    <div class="navbar navbar-inverse navbar-fixed-top">
		  <div class="navbar-inner">
			  <div class="container-fluid">
				  <a class="brand" href="#"><img src="<?php echo base_url('assets/img/logo_w.png'); ?>" /></a>
        </div>
		  </div>
	  </div>

    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span12">
		<div class="hero-unit">
			<div id="messages" data-cycle-slides="> div" data-cycle-timeout="6000">
			<?php foreach (MessageQuery::create()->filterByScreen($screen)->filterCurrent()->find() as $message) : ?>
			<div class="message">
				<h1><?= $message->getTitle(); ?> <small><?= $message->getAuthor(); ?></small></h1>
				<p><?= $message->getMessage(); ?></p>
			</div>			
			<?php endforeach; ?>
			</div>
		</div>
	

		<div id="slideshow">
			<?php
			$slideshow = SlideshowQuery::create()->findOneById(2);
			foreach ($slideshow->getImages() as $img) : 
			?>
			<img src="<?php echo $img->getSizeUrl($slideshow->getWidth(),$slideshow->getHeight(), '#2b0014'); ?>">
			<?php endforeach; ?>

		</div>
	</div>
      </div>
    </div>

<script src="<?php echo base_url('assets/js/jquery-1.9.1.js');?>"></script>
<script src="<?php echo base_url('assets/js/jquery.cycle2.min.js');?>"></script>
<script src="<?php echo base_url('assets/js/refresh-screen.js');?>"></script>
<script type="text/javascript">
$('#messages').cycle();
$('#slideshow').cycle();
</script>
  </body>        
</html>


