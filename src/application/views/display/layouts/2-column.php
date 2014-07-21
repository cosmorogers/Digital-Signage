<?php
/* $screen Screen */ 
$layoutDescription = array(
  'name' => "2 Column",
  'desc' => "A simple 2 column layout",
  'containers' => array (
      array (
        'name' => 'left',
        'desc' => 'Appears in the smaller left hand column'
      ),
      array (
        'name' => 'main',
        'desc' => 'Appears in the larger main column'
      )
    ),
  'has_title' => true,
);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>BAS::Digital Signage System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Le styles -->
    <link href="<?php echo base_url('assets/css/bootstrap.css'); ?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/css/admin.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/smoothness/jquery-ui-1.10.1.custom.min.css');?>" rel="stylesheet">
    

	<style type="text/css">
    body, html {
			overflow: hidden;
			width: <?= $screen->getWidth() ?>px;
			height: <?= $screen->getHeight() ?>px;
      padding-top: 0;
		}
	</style>

  </head>

  <body>
    <div class="navbar navbar-inverse">
	  	<div class="navbar-inner">
	  		<div class="container-fluid">
	  			<a class="brand" href="#"><img src="<?php echo base_url('assets/img/logo_w.png'); ?>" /></a>
          <h2 style="color:#FFF; text-align:center; padding-right:37px;">{{text-title, default screen name}}</h2>
        </div>
	  	</div>
	  </div>

    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span3">
          left col
          {{Column 1, sortable div}}
        </div>
	
        <div class="span9">
          main col
		      {{Column 2, sortable div}}
        </div>
      </div>
    </div>
    {{scripts}}
  </body>        
</html>


