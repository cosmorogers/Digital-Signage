<?php 
/* @var $this CI_Loader */
/* @var $layout array */

$header = array (
		'title' => 'Edit Template',
		'active' => 'screens',
		'breadcrumbs' => array (
			'Screens' => site_url('screens'),
			'Manage Templates' => site_url('templates')		
		),
		'sidemenu' => 'screens'
);
$this->view('templates/header', $header); 
?>

	<div class=" span3">
		<h4 >Available Widgets</h4>
		<p>To activate a widget on this template drag it over to the content area you would like it to appear in.</p>

		<div class="widget-list" id="availableWidgets">
			<div class="panel">
				<?php $widget = new MessageWidget(); ?>
				<h4 class="popover-title"><?php echo $widget->getWidgetName(); ?></h4>
				<div class="popover-content widget-desc">
					<?php echo $widget->getWidgetDescription(); ?>
				</div>
			</div>
			<div class="panel">
				<h4 class="popover-title">Slideshow</h4>
				<div class="popover-content widget-desc">
					Display a choosen slideshow
				</div>
			</div>
			<div class="panel">
				<h4 class="popover-title">Weather</h4>
				<div class="popover-content widget-desc">
					Display a weather forecast. Will automatically adjust to the size available.
				</div>
			</div>
			<div class="panel">
				<h4 class="popover-title">Time</h4>
				<div class="popover-content widget-desc">
					Display a clock or textual time
				</div>
			</div>
			<div class="panel">
				<h4 class="popover-title">Daily Quote</h4>
				<div class="popover-content widget-desc">
					Display a random daily quote
				</div>
			</div>
		</div>
	</div>

	<div class="span9">
		<?php foreach ($layout['containers'] as $container) : ?>
			<div class="span4 panel">
				
				<div class="popover-content">
					<h4 ><?php echo ucfirst($container['name']); ?> Widget Area</h4>
					<p class="muted"><?php echo $container['desc'];?></p>
					<br />

					<div class="layout-container">

						<div class="panel">
							<h4 class="popover-title">
								Messages
								<i class="icon-chevron-up pull-right panel-collapse"></i>
							</h4>
							<div class="popover-content">
							    <form>
									<fieldset>
										<label>Display Time</label>
										<input type="number" value="4">
										<span class="help-block">How long to display each message</span>
										<button type="submit" class="btn btn-primary">Save</button>
										<button type="submit" class="btn btn-danger pull-right"><i class="icon-trash icon-white"></i></button>
									</fieldset>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
	</div>

<script type="text/javascript">
var widgets = <?php echo json_encode($widget->getWidgetForm()); ?>
</script>

<?php 
$js = array('edit-template.js');
$this->view('templates/footer', array ('js' => array('edit-template.js')));
?>