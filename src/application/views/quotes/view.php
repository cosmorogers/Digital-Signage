<?php 
/* @var $this CI_Loader */
/* @var $quotes PropelCollection */

$header = array (
		'title' => 'Quote of the day',
		'active' => 'quotes',
		'breadcrumbs' => array (
		)
);
$this->view('templates/header', $header); 
?>
<form method="get" class="table-filter" action="<?= site_url('quotes/view') ?>">

<div class="table-head">
	<a href="<?= site_url('quotes/add')?>" class="btn btn-inverse"><i class="icon-white icon-plus-sign"></i> Add a Quote</a>
	<span class="pull-right">Show 
		<select class="input-mini" name="filter[display]">
			<option <?= (isset($filters['display']) && $filters['display'] == '5' ? 'selected' : '');?>>5</option>
			<option <?= (isset($filters['display']) && $filters['display'] == '10' ? 'selected' : '');?>>10</option>
			<option <?= (isset($filters['display']) && $filters['display'] == '20' ? 'selected' : '');?>>20</option>
		</select>
	 per page</span>
</div>

<table class="table table-striped table-hover table-bordered">
	<thead>
		<tr class="table-headings">
			<th>Quote</th>
			<th class="actions">Actions</th>
		</tr>
		<tr class="table-filters">
			<td><input name="filter[quote]" type="text" value="<?= (isset($filters['quote']) ? $filters['quote'] : '' );?>" ></td>
			<td><button type="submit" class="btn">Search</button></td>
		</tr>
	</thead>
	<tbody>
	<?php if (0 == $quotes->count()) :?>
		<tr>
			<td colspan="2">There are no quotes yet.</td>
		</tr>
	<?php else:?>
		<?php foreach ($quotes as $quote): /* @var $quote Quote */ ?>
		<tr>
			<td><?= $quote->getQuote(); ?></td>
			<td>
				<div class="btn-group">
					<a href="<?= site_url('quotes/edit/' . $quote->getId());?>" class="btn"><i class="icon icon-pencil"></i></a>
					<a href="<?= site_url('quotes/delete/' . $quote->getId());?>" class="btn btn-danger"><i class="icon icon-white icon-trash"></i></a>
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
		Showing <?= $quotes->getFirstIndex() ?> to <?= $quotes->getLastIndex() ?>
  		 of <?= $quotes->getNbResults() ?> total.
	</div>
	<?php if($quotes->haveToPaginate()): ?>
	<?php 
	$append = array();
	foreach ($filters as $key => $value) {
		$append[] = 'filter[' . $key . ']=' . $value;
	}
	$append = '?' . implode('&', $append);
	?>
	<div class="pagination pagination-right">
		<ul>
			<li <?= ($quotes->getPreviousPage() == $quotes->getPage() ? 'class="disabled"' : '');?>><a href="<?= site_url('quotes/view/' . $quotes->getPreviousPage()) . $append?>">&laquo;</a></li>
			<?php 
			foreach ($quotes->getLinks(5) as $link) {
				echo '<li' . ($link == $quotes->getPage() ? ' class="active"' : '') . '>';
				echo '<a href="' . site_url('quotes/view/' . $link)  . $append . '">';
				echo $link;
				echo '</a>';
				echo '</li>';
			}			
			?>
			<li <?= ($quotes->getNextPage() == $quotes->getPage() ? 'class="disabled"' : '');?>><a href="<?= site_url('quotes/view/' . $quotes->getNextPage()) . $append?>">&raquo;</a></li>
		</ul>
	</div>
	<?php endif; ?>
</div>

<?php $this->view('templates/footer');?>