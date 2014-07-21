<?php 
/* @var $this CI_Loader */
/* @var $users PropelCollection */

$header = array (
		'title' => 'Manage Users',
		'active' => 'users',
		'breadcrumbs' => array (
		)
);
$this->view('templates/header', $header); 
?>

<p><a href="<?php echo site_url('users/add')?>" class="btn btn-inverse"><i class="icon-white icon-plus-sign"></i> Add a User</a>


<table class="table table-striped table-hover table-bordered">
	<thead>
		<tr class="table-headings">
			<th>Username</th>
			<th>Name</th>
			<th class="actions">Actions</th>
		</tr>
	</thead>
	<tbody>
	<?php if (0 == $users->count()) :?>
		<tr>
			<td colspan="3">There are no users yet.</td>
		</tr>
	<?php else:?>
		<?php foreach ($users as $user): /* @var $user User */ ?>
		<tr>
			<td><?php echo $user->getUsername(); ?></td>
			<td><?php echo $user->getName(); ?></td>
			<td>
				<div class="btn-group">
					<a href="<?php echo site_url('users/edit/' . $user->getId());?>" class="btn"><i class="icon icon-pencil"></i></a>
					<a href="<?php echo site_url('users/delete/' . $user->getId());?>" class="btn btn-danger"><i class="icon icon-white icon-trash"></i></a>
				</div>
			</td>
		</tr>
		<?php endforeach;?>
	<?php endif;?>
	</tbody>

</table>



<?php $this->view('templates/footer');?>