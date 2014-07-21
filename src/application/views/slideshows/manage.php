<?php 
/* @var $this CI_Loader */
/* @var $slideshow Slideshow */
/* @var $images PropelModelPager */
/* @var $slideshowimages PropelObjectCollection */

$header = array (
		'title' => 'Manage Slideshow',
		'active' => 'slideshows',
		'breadcrumbs' => array (
			'Slideshows' => site_url('slideshows'),
		),
		'sidemenu' => 'slideshows'
);
$this->view('templates/header', $header); 
?>
<!-- <div class="container-fluid"> -->
	<div class="row-fluid">
		<div class="popover span4" style="display:block; position:relative;">
			<h4 class="popover-title">Slideshow images</h4>
			<div class="popover-content">
				<div id="slideshow-images">
					<?php if (0 == $slideshowimages->count()):?>
						<div class="alert">There are no images in this slideshow yet.</div>
					<?php endif;?>
					<ul class="thumbnails slideshow-thumbnails grid3" >
					<?php foreach ($slideshowimages as $slideshowImage) : /* @var $slideshowImage SlideshowImage */?>
						<li class="span4">
							<div class="thumbnail clearfix">
								<img src="<?= $slideshowImage->getImage()->getThumbnailUrl()?>" alt="">
								<div class="hover-overlay">
									<a href="<?= site_url('slideshows/removeimage/' . $slideshow->getId() . '/' . $slideshowImage->getImageId() . '/' . $slideshowImage->getOrder()); ?>" class="close">&times;</a>
								</div>							
							</div>
						</li>
					<?php endforeach;?>
					</ul>
				</div>
			</div>
		</div>
		<div class="popover span8" style="display:block; position:relative;">
			<h4 class="popover-title">All images <a href="<?= site_url('slideshows/upload/' . $slideshow->getId())?>" class="btn btn-small pull-right">Upload more images</a></h4>
			<div class="popover-content">
				<div class="slideshow-thumbnails">
					<?php if (0 == $images->count()):?>
						<div class="alert">There are no images yet. <a href="<?= site_url('slideshows/upload/' . $slideshow->getId());?>">Click here</a> to upload some</div>
					<?php endif;?>
					<ul class="thumbnails grid4" id="all-images">
					<?php foreach ($images as $image) : /* @var $image Image */?>
						<li class="span3">
							<div class="thumbnail">
								<img src="<?= $image->getMediumUrl()?>" alt="">
								<div class="hover-overlay">
									<a href="<?= site_url('slideshows/addimage/' . $slideshow->getId() . '/' . $image->getId()); ?>"><i class="icon-plus-sign icon-white"></i></a>
								</div>
							</div>
						</li>
					<?php endforeach;?>
					</ul>
				</div>
				<?php if (0 < $images->count()):?>
            	<div class="pagination pagination-centered">
					<ul>
						<li class="<?= ($images->getPreviousPage() == $images->getPage() ? ' active' : '')?>"><a href="?page=<?= $images->getPreviousPage()?>">&laquo;</a></li>
						
						<?php foreach ($images->getLinks(5) as $link) :?>
							<li class="<?= ($link == $images->getPage() ? ' active' : '')?>"><a href="?page=<?= $link ?>" ><?= $link ?></a></li>
						<?php endforeach;?>
					
						<li class="<?= ($images->getNextPage() == $images->getPage() ? ' active' : '')?>"><a href="?page=<?= $images->getNextPage()?>">&raquo;</a></li>
					</ul>
				</div>
				<?php endif; ?>
			</div>
		</div>
	<!-- </div> -->
</div>
<?php
$footer = array (
//	'js' => array('slideshow-manager.js')
); 
$this->view('templates/footer', $footer);?>