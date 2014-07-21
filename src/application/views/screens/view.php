<?php 
/* @var $this CI_Loader */
/* @var $screens PropelCollection */

$header = array (
		'title' => 'Manage Screens',
		'active' => 'screens',
		'breadcrumbs' => array (
			'Screens' => site_url('screens')		
		),
		'sidemenu' => 'screens'
);
$this->view('templates/header', $header); 
?>
<p class=""><a href="<?php echo site_url('screens/add')?>" class="btn btn-inverse"><i class="icon-white icon-plus-sign"></i> Add a Screen</a>
<table class="table table-striped table-hover table-bordered">
	<thead>
		<tr class="table-headings">
			<th>Name</th>
			<th>IP Address</th>
			<th>Last seen</th>
			<th>Status</th>
			<th class="actions">Actions</th>
		</tr>
	</thead>
	<tbody>
	<?php if (0 == $screens->count()) :?>
		<tr>
			<td colspan="5">There are no screens in the system yet.</td>
		</tr>
	<?php else:?>
		<?php foreach ($screens as $screen): /* @var $screen Screen */?>
		<tr>
			<td><?php echo $screen->getName();?></td>
			<td><?php echo $screen->getIp()?></td>
			<td><?php echo $screen->getLastSeen()?></td>
			<td></td>
			<td>
				<div class="btn-group">
					<a href="<?php echo site_url('screens/edit/' . $screen->getId());?>" class="btn"><i class="icon icon-pencil"></i></a>
          <button class="btn dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
          <ul class="dropdown-menu pull-right">
            <li>
              <a href="<?= site_url('display/view/' . $screen->getMac()); ?>">Template Preview</a>
            </li>
            <li>
              <a href="<?= site_url('screens/remote/' . $screen->getId()); ?>"><i class="icon-eye-open"></i> Remote</a>
            </li>
            <li>
              <a href="<?php echo site_url('screens/delete/' . $screen->getId());?>"><i class="icon-trash"></i> Delete</a>
            </li>
          </ul>
					
				</div>
			</td>
		</tr>
		<?php endforeach;?>
	<?php endif;?>
	</tbody>

</table>

<?php $this->view('templates/footer');?>
