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
    <link href="<?php echo base_url('assets/css/meteocons/stylesheet.css');?>" rel="stylesheet">

	<style type="text/css">
    body, html {
			overflow: hidden;
			width: <?= $screen->getWidth() ?>px;
			height: <?= $screen->getHeight() ?>px;
      padding-top: 0;
		}
    .hero-unit {
      padding: 10px 30px 30px;
    }
    .hero-unit h1 {
      font-size: 40px; 
    }
    /* pager */
    .cycle-pager { 
        text-align: center; width: 100%; z-index: 500; position: absolute; bottom: -40px; overflow: hidden;
    }
    .cycle-pager span { 
        font-family: arial; font-size: 50px; width: 16px; height: 16px; 
        display: inline-block; color: #ddd; cursor: pointer; 
    }
    .cycle-pager span.cycle-pager-active { color: #8D1950;}
    .cycle-pager > * { cursor: pointer;}
    #progress { position: absolute; bottom: -30px; height: 1px; width: 0px; background: #8D1950; z-index: 500; }
	</style>

  </head>

  <body>
    <div class="navbar navbar-inverse">
	  	<div class="navbar-inner">
	  		<div class="container-fluid">
	  			<a class="brand" href="#"><img src="<?php echo base_url('assets/img/logo_w.png'); ?>" /></a>
          <h2 style="color:#FFF; text-align:center; padding-right:37px;">ICT Suite</h2>
        </div>
	  	</div>
	  </div>

    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span3">
		      <div class="hero-unit">
			      <div id="messages" data-cycle-slides="> div.message" data-cycle-timeout="6000" data-cycle-auto-height=container>
			        <?php foreach (MessageQuery::create()->filterByScreen($screen)->filterCurrent()->find() as $message) : ?>
			        <div class="message">
				        <h1><?= $message->getTitle(); ?> <small><?= $message->getAuthor(); ?></small></h1>
				        <p><?= $message->getMessage(); ?></p>
			        </div>			
			        <?php endforeach; ?>
              <div class="cycle-pager"></div>
              <div id="progress"></div>
			      </div>
		      </div>

          <div class="hero-unit" style="padding:10px; text-align:center !important;">
            <h3>5 Day Weather Forecast</h3>
            <table id="weatherTable" class="table" style="font-size: 0.6em; margin-bottom: 0;">
              <tr id="dateRow"></tr>
              <tr id="iconsRow"></tr>
              <tr id="weatherRow"></tr>
            </table>
          </div>
        </div>
	
        <div class="span9">
		      <div id="slideshow">
			      <?php
			      $slideshow = SlideshowQuery::create()->findOneById(1);
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
<script src="<?php echo base_url('assets/js/weather.js');?>"></script>
<script type="text/javascript">
$('#messages').cycle();
$('#slideshow').cycle();

var progress = $('#progress'),
    slideshow = $('#messages');

slideshow.on( 'cycle-initialized cycle-before', function( e, opts ) {
    progress.stop(true).css( 'width', 0 );
});

slideshow.on( 'cycle-initialized cycle-after', function( e, opts ) {
    if ( ! slideshow.is('.cycle-paused') )
        progress.animate({ width: '100%' }, opts.timeout, 'linear' );
});

slideshow.on( 'cycle-paused', function( e, opts ) {
   progress.stop(); 
});

slideshow.on( 'cycle-resumed', function( e, opts, timeoutRemaining ) {
    progress.animate({ width: '100%' }, timeoutRemaining, 'linear' );
});
</script>
  </body>        
</html>


