<?php 
/* @var $this CI_Loader */
/* @var $slideshows PropelCollection */

$header = array (
		'title' => 'Manage Slideshows',
		'active' => 'slideshows',
		'breadcrumbs' => array (
			'Slideshows' => site_url('slideshows')		
		),
		'sidemenu' => 'slideshows'
);
$this->view('templates/header', $header); 
?>
<p class=""><a href="<?php echo site_url('slideshows/add')?>" class="btn btn-inverse"><i class="icon-white icon-plus-sign"></i> Add a Slideshow</a></p>

<?php 
$i = 0;
foreach ($slideshows as $slideshow) : /* @var $slideshow Slideshow */ 
	if (0 == $i) : ?>
<ul class="thumbnails">
	<?php endif; ?>
	<li class="span3">
		<div class="thumbnail">
		<?php
		$image = $slideshow->getImage();
		if (!is_null($image)) {
			$url = $image->getSizeUrl(300, 240);
		} else {
			$url = base_url('assets/img/placeholder.png');			
		}
		?>
			<img src="<?= $url?>" alt="">
			<h4>
				<?php echo $slideshow->getName();?>
				<small><?php echo $slideshow->getWidth()?>x<?php echo $slideshow->getHeight()?></small>
				<a href="<?php echo site_url('slideshows/edit/' . $slideshow->getId())?>" class="btn btn-inverse btn-mini pull-right"><i class="icon-pencil icon-white"></i></a>
			</h4>
			<a href="<?php echo site_url('slideshows/upload/' . $slideshow->getId())?>" class="btn btn-primary btn-block"><i class="icon-upload icon-white"></i> Upload</a>
			<a href="<?php echo site_url('slideshows/manage/' . $slideshow->getId())?>" class="btn btn-block"><i class="icon-wrench"></i> Manage</a>
		</div>
	</li>
	<?php 
	$i++;
	if (4 == $i) :
		$i = 0;
	?>
	</ul>
	<?php endif?>
<?php endforeach;?>

<?php $this->view('templates/footer');?>