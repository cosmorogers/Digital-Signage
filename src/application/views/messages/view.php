<?php 
/* @var $this CI_Loader */
/* @var $messages PropelModelPager */
/* @var $users PropelCollection */

$header = array (
		'title' => 'Manage Messages',
		'active' => 'messages',
		'breadcrumbs' => array (
		)
);
$this->view('templates/header', $header);

?>
<form method="get" class="table-filter">
<div class="table-head">
	<a href="<?php echo site_url('messages/add')?>" class="btn btn-inverse"><i class="icon-white icon-plus-sign"></i> Add a Message</a>
	<span class="pull-right">Show 
		<select class="input-mini" name="filter[display]">
			<option <?php echo (isset($filters['display']) && $filters['display'] == '5' ? 'selected' : '');?>>5</option>
			<option <?php echo (isset($filters['display']) && $filters['display'] == '10' ? 'selected' : '');?>>10</option>
			<option <?php echo (isset($filters['display']) && $filters['display'] == '20' ? 'selected' : '');?>>20</option>
		</select>
	 per page</span>
</div>

<table class="table table-striped table-hover table-bordered">
	<thead>
		<tr class="table-headings">
			<th>Title</th>
			<th>Message</th>
			<th>Creator</th>
			<th>When</th>
			<th class="actions">Actions</th>
		</tr>
		
		<tr class="table-filters">
			<td><input name="filter[title]" type="text" value="<?php echo (isset($filters['title']) ? $filters['title'] : '' );?>" ></td>
			<td><input name="filter[message]" type="text"  value="<?php echo (isset($filters['message']) ? $filters['message'] : '' );?>" ></td>
			<td>
				<select name="filter[creator]">
					<option></option>
					<?php foreach ($users as $user) : /* @var $user User */?>
					<option value="<?php echo $user->getId()?>" <?php echo (isset($filters['creator']) && $filters['creator'] == $user->getId() ? 'selected' : '')?> ><?php echo $user->getName();?></option>
					<?php endforeach;?>
				</select>
			</td>
			<td>
				<select name="filter[when]">
					<option></option>
					<option <?php echo (isset($filters['when']) && $filters['when'] == 'Upcoming' ? 'selected' : '');?> >Upcoming</option>
					<option <?php echo (isset($filters['when']) && $filters['when'] == 'Current' ? 'selected' : '');?> >Current</option>
					<option <?php echo (isset($filters['when']) && $filters['when'] == 'Past' ? 'selected' : '');?> >Past</option>
				</select>
			</td>
			<td><button type="submit" class="btn">Search</button></td>
		</tr>
		
	</thead>

	<tbody>
	<?php if (0 == $messages->count()) :?>
		<tr>
			<td colspan="6">No messages match the current filter(s).</td>
		</tr>
	<?php else:?>
		<?php 
		$now = time();
		foreach ($messages as $message): /* @var $message Message */
		
		if ($message->getStart(null)->getTimestamp() < $now) {
			//Has started
			if ($message->getEnd(null)->getTimestamp() > $now) {
				$class= 'success';
			} else {
				$class= 'old-message error';
			}
		} else {
			//In the future
			$class = 'future-message info';
		}
		?>
		<tr class="<?php echo $class?>">
			<td><?php echo $message->getTitle(); ?></td>
			<td><?php echo $message->getMessage(); ?></td>
			<td><?php echo $message->getUser()->getName(); ?></td>
			<td><?php echo $message->getStart('j M \'y'); ?> to <?php echo $message->getEnd('j M \'y'); ?> </td>
			<td>
				<div class="btn-group">
					<a href="<?php echo site_url('messages/edit/' . $message->getId());?>" class="btn"><i class="icon icon-pencil"></i></a>
					<a href="<?php echo site_url('messages/delete/' . $message->getId());?>" class="btn btn-danger"><i class="icon icon-white icon-trash"></i></a>
				</div>
			</td>
		</tr>
		<?php endforeach;?>
	<?php endif;?>
	</tbody>
</table>
</form>
<div class="table-footer">
	<div class="pagination-total">
		Showing <?php echo $messages->getFirstIndex() ?> to <?php echo $messages->getLastIndex() ?>
  		 of <?php echo $messages->getNbResults() ?> total.
	</div>
	<?php if($messages->haveToPaginate()): ?>
	<?php 
	$append = array();
	foreach ($filters as $key => $value) {
		$append[] = 'filter[' . $key . ']=' . $value;
	}
	$append = '?' . implode('&', $append);
	?>
	<div class="pagination pagination-right">
		<ul>
			<li <?php echo ($messages->getPreviousPage() == $messages->getPage() ? 'class="disabled"' : '');?>><a href="<?php echo site_url('messages/view/' . $messages->getPreviousPage()) . $append?>">&laquo;</a></li>
			<?php 
			foreach ($messages->getLinks(5) as $link) {
				echo '<li' . ($link == $messages->getPage() ? ' class="active"' : '') . '>';
				echo '<a href="' . site_url('messages/view/' . $link)  . $append . '">';
				echo $link;
				echo '</a>';
				echo '</li>';
			}			
			?>
			<li <?php echo ($messages->getNextPage() == $messages->getPage() ? 'class="disabled"' : '');?>><a href="<?php echo site_url('messages/view/' . $messages->getNextPage()) . $append?>">&raquo;</a></li>
		</ul>
	</div>
	<?php endif; ?>
</div>
<?php $this->view('templates/footer');?>

