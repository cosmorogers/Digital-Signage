<?php 
/* @var $this CI_Loader */
/* @var $screens PropelCollection */

$header = array (
		'title' => 'Dashboard',
		'active' => 'dashboard',
		'breadcrumbs' => array (
		),
);
$this->view('templates/header', $header); 
?>
<div id="dashboardMessages"></div>
<ul class="thumbnails">

<?php foreach ($screens as $screen) : /* @var $screen Screen */?>
	<li class="span3">
		<div class="thumbnail dashboard-screen" data-url="<?= site_url('screens/checkalive/' . $screen->getId());?>">
      <img src="<?= base_url('assets/img/unknown.jpg');?>" data-base="<?= base_url('assets/img/');?>"/>
			<div class="caption">
				<h4><?= $screen->getName(); ?></h4>
			    <table class="table">
			    	<tr>
			    		<th>Status:</th>
			    		<td class="muted screen-status" >Loading</td>
		    		</tr>
		    		<tr>
		    			<th>Last seen:</th>
		    			<td><?= $screen->getLastSeen(); ?></td>
	    			</tr>
			    </table>
          <div class="clearfix">
			      <div class="btn-group pull-right">
			      	<button type="button" class="btn btn-danger tooltip-me boot-btn" title="Attempt remote boot" data-url="<?= site_url('screens/boot/' . $screen->getId())?>"><i class="icon icon-white icon-off"></i></button>
              <a href="<?= site_url('screens/edit/' . $screen->getId()); ?>" class="btn tooltip-me" title="Manage"><span class="icon icon-wrench"></span></a>
              <a href="<?= site_url('screens/remote/' . $screen->getId()); ?>" class="btn tooltip-me" title="Remote desktop"><span class="icon icon-eye-open"></span></a>
		      	</div>
          </div>
			</div>
		</div>
	</li>
<?php endforeach;?>
</ul>
<div class="row-fluid" style="margin-bottom:20px">
	<div class="popover span6" style="display:block; position:relative;">
		<h4 class="popover-title">Latest Messages <a href="<?= site_url('messages/add')?>" class="pull-right btn btn-mini btn-inverse"><i class="icon icon-white icon-plus-sign"></i> Add a Message</a></h4>
		<div class="popover-content">
			<?php foreach ($messages as $message) : /* @var $message Message */ ?>
			<a href="<?= site_url('messages/edit/' . $message->getId())?>" class="btn btn-mini pull-right"><i class="icon icon-pencil"></i></a>
			<h4><?= $message->getTitle();?></h4>
			<p><?= $message->getMessage();?></p>
			<hr />
			<?php endforeach;?>
		</div>
	</div>
	<div class="popover span6" style="display:block; position:relative;">
		<h4 class="popover-title">Latest Development News</h4>
		<div class="popover-content">
		  <p>If you click the button with the <span class="icon icon-eye-open"></span> button you can review a remote desktop snapshot of the screen!</p>
		</div>
	</div>
</div>

<?php 
$footer = array (
	'js' => array ('dashboard.js')
);
$this->view('templates/footer', $footer);?>
