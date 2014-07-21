<html>
<head lang="en" manifest="<?php echo site_url('cache/manifest/' . $screen->getId()); ?>">
<style>
body, html { 
	background: black; 
	width: <?=$screen->getWidth() ?>px;
	height: <?=$screen->getHeight() ?>px;
	overflow: hidden;
}
</style>
</head>
<body>
<div id="slideshow" data-cycle-speed="600">
<?php
$slideshow = SlideshowQuery::create()->findOneById(6);
foreach ($slideshow->getImages() as $img) : 
?>
<img src="<?php echo $img->getSizeUrl($slideshow->getWidth(),$slideshow->getHeight(), 'black'); ?>">
<?php endforeach; ?>
</div>



<script src="<?php echo base_url('assets/js/jquery-1.9.1.js');?>"></script>
<script src="<?php echo base_url('assets/js/jquery.cycle2.min.js');?>"></script>
<script src="<?php echo base_url('assets/js/refresh-screen.js');?>"></script>
<script type="text/javascript">
$('#slideshow').cycle();
</script>
</body>
</html>
