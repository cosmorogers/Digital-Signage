<?php 
/* @var $this CI_Loader */
/* @var $images PropelCollection */

$header = array (
		'title' => 'Manage Images',
		'active' => 'slideshows',
		'breadcrumbs' => array (
			'Slideshows' => site_url('slideshows')		
		),
		'sidemenu' => 'slideshows'
);
$this->view('templates/header', $header); 
?>
<p class=""><a href="<?= site_url('slideshows/upload')?>" class="btn btn-inverse"><i class="icon-white icon-upload"></i> Upload</a></p>
<div class="image-thumbnails">
<?php foreach ($images as $image): /* @var $image Image */?>
	<div class="thumbnail">
		<img src="<?= $image->getThumbnailUrl()?>">
		<div class="hover-overlay"><a href="<?= site_url('slideshows/delete/' . $image->getId()); ?>" class="btn-remove-image"><i class="icon-trash icon-white"></i></a></div>
	</div>
<?php endforeach;?>
</div>
<?php $this->view('templates/footer');?>