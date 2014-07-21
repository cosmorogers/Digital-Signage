<?php 
/* @var $this CI_Loader */
/* @var $screens PropelCollection */

$header = array (
		'title' => 'Manage Templates',
		'active' => 'screens',
		'breadcrumbs' => array (
			'Screens' => site_url('screens')		
		),
		'sidemenu' => 'screens'
);
$this->view('templates/header', $header); 
?>


<p class=""><a href="<?php echo site_url('screens/createtemplate')?>" class="btn btn-inverse"><i class="icon-white icon-plus-sign"></i> Create a Template</a>
<table class="table table-striped table-hover table-bordered">
	<thead>
		<tr class="table-headings">
			<th>Namesss</th>
			<th>Layout</th>
			<th>Screen</th>
			<th class="actions">Actions</th>
		</tr>
	</thead>
	<tbody>
	</tbody>
</table>




<?php $this->view('templates/footer');?>