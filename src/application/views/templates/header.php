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

  </head>

  <body class="<?php echo url_title($title, '-', TRUE); ?>" >

	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a class="brand" href="#"><img src="<?php echo base_url('assets/img/logo_w.png'); ?>" /> Digital Signage System</a>
				<div class="btn-group  pull-right">
<?php /*
					<a class="btn btn-inverse btn-small dropdown-toggle" data-toggle="dropdown" href="#">
						<i class="icon icon-user icon-white"></i> Rogersc03
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<li>Ver: 0.1</li>
						<li><a href="<?php echo site_url('auth/logout');?>">Logout</a></li>
					</ul>
*/?>
					<a href="#" class="btn btn-small btn-inverse"><i class="icon icon-user icon-white"></i> <?php echo $this->authentication->get_user()->getUsername()?></a>
					<a href="<?php echo site_url('auth/logout')?>" class="btn btn-small btn-inverse">Logout <i class="icon  icon-off icon-white"></i> </a>
				</div>
			</div><!--/.nav-collapse -->
		</div>
	</div>
<?php if (!isset($active)) { $active = ''; }?>
	<div id="sidebar">
		<ul>
			<li class="<?php echo ($active == 'dashboard' ? 'active' : '');?>"><a href="<?php echo site_url('');?>"><i class="icon icon-white icon-th"></i> <span>Dashboard</span></a></li>
            <li class="<?php echo ($active == 'messages' ? 'active' : '');?>"><a href="<?php echo site_url('messages');?>"><i class="icon icon-white icon-comment"></i> <span>Messages</span></a></li>
            <li class="submenu <?php echo ($active == 'slideshows' ? 'active' : '');?> <?php echo (isset($sidemenu) && $sidemenu == 'slideshows' ? 'open' : '');?>">
            	<a href="#"><i class="icon icon-white icon-picture"></i> <span>Slideshows</span></a>
            	<ul>
            		<li><a href="<?php echo site_url('slideshows/upload');?>"><span>Upload</span></a>
            		<li><a href="<?php echo site_url('slideshows/images');?>"><span>Manage Images</span></a>
            		<li><a href="<?php echo site_url('slideshows');?>"><span>Manage Slideshows</span></a>
            		
            	</ul>
            </li>
            
            <li class="submenu <?php echo ($active == 'screens' ? 'active' : '');?> <?php echo (isset($sidemenu) && $sidemenu == 'screens' ? 'open' : '');?>">
				<a href="#"><i class="icon icon-white icon-list-alt"></i> <span>Screens</span></a>
				<ul>
					<li><a href="<?php echo site_url('screens');?>"><span>Manage</span></a></li>
					<li><a href="<?php echo site_url('templates');?>"><span>Templates</span></a></li>
				</ul>
			</li>
            <li class="<?php echo ($active == 'quote' ? 'active' : '');?>"><a href="<?php echo site_url('quotes');?>"><i class="icon icon-white icon-globe"></i> <span>Quote of the Day</span></a></li>
            <li class="<?php echo ($active == 'users' ? 'active' : '');?>"><a href="<?php echo site_url('users');?>"><i class="icon icon-white icon-user"></i> <span>Users</span></a></li>
            <li class="<?php echo ($active == 'settings' ? 'active' : '');?>"><a href="<?php echo site_url('settings');?>"><i class="icon icon-white icon-wrench"></i> <span>Settings</span></a></li>
		</ul>
	</div>
	
	<div id="content">
	<div class="content-head">
		<a href="#" class="btn btn-small btn-inverse pull-right">Help</a>
		<h1><?php echo $title; ?></h1>		
	</div>

	<div class="content-breadcrumbs">

		<div class="breadcumbs">
			<a href="<?php echo site_url(''); ?>"><i class="icon icon-home"></i>Home</a>
			<?php foreach ($breadcrumbs as $name => $url):?>
				<i class="icon icon-chevron-right"></i>
				<a href="<?php echo $url; ?>"><?php echo $name; ?></a>
			<?php endforeach;?>
			<i class="icon icon-chevron-right"></i>
			<a href="<?php echo current_url(); ?>"><?php echo $title; ?></a>
		</div>
		
	</div>
	
	
    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span12">
        <?php if ($this->session->flashdata('success') !== FALSE) :?>
        	<div class="alert alert-success">
        		<strong>Success!</strong>
        		<?php echo $this->session->flashdata('success');?>
        	</div>
        <?php endif;?>
        
