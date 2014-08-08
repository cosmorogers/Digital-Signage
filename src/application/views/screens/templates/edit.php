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

$forms = array();
?>

	<div class=" span3">
		<h4 >Available Widgets</h4>
		<p>To activate a widget on this template drag it over to the content area you would like it to appear in.</p>

		<div class="widget-list" id="availableWidgets">
            <?php
            foreach ($widgets as $widget) :
                $widgetClass =$widget->getClass();
            ?>
			<div class="panel">
				<h4 class="popover-title"><?php echo $widgetClass->getName(); ?></h4>
				<div class="popover-content widget-desc" data-widget="<?php echo $widgetClass->getName();?>">
					<?php echo $widgetClass->getDescription(); ?>
				</div>
                <?php $forms[$widgetClass->getName()] = $widgetClass->form(null); ?>
			</div>
            <?php endforeach; ?>
		</div>
	</div>

	<div class="span9">
		<?php foreach ($layout['containers'] as $container) : ?>
			<div class="span4 panel">
				
				<div class="popover-content">
					<h4 ><?php echo ucfirst($container['name']); ?> Widget Container</h4>
					<p class="muted"><?php echo $container['desc'];?></p>
					<br />

					<div class="layout-container" style="min-height:40px;" data-template-id="<?php echo $template->getId(); ?>" data-template-container="<?php echo $container['name']; ?>">
                        <?php
                        foreach ($template_widgets as $widget) :
                            if ($widget->getContainer() == $container['name']) :
                        ?>
						<div class="panel">
							<h4 class="popover-title">
								<?php echo $widget->getClass()->getName(); ?>
								<i class="icon-chevron-up pull-right panel-collapse"></i>
							</h4>
							<div class="popover-content">
							    <form>
									<fieldset>
                                        <?php echo $widget->getClass()->getForm(); ?>
                                    </fieldset>
								</form>
							</div>
						</div>
                        <?php endif;?>
                        <?php endforeach; ?>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
	</div>

<script>
    var forms = <?php echo json_encode($forms);?>;
    var addWidget = <?php echo site_url('templates/addWidget'); ?>
</script>
<?php
$js = array('edit-template.js');
$this->view('templates/footer', array ('js' => array('edit-template.js')));
?>