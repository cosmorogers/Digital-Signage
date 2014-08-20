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
<h3 id="templateName"><span><?php echo $template->getName(); ?></span> <button type="button" id="changeNameBtn"><i class="icon-pencil"></i></button></h3>
<div id="changeTemplateName" class="hide">
    <div class="input-append">
        <input id="templateNameInput" type="text" name="templateName" value="<?php echo $template->getName(); ?>"/>
        <button class="btn" type="button" id="changeNameSaveBtn">Save</button>
    </div>
</div>
<div class="row-fluid">
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
								<?php echo $widget->getWidget()->getClass()->getName(); ?>
								<i class="icon-chevron-up pull-right panel-collapse"></i>
							</h4>
							<div class="popover-content" data-widget="<?php echo $widget->getWidget()->getName()?>" data-id="<?php echo $widget->getId(); ?>">
                                <form autocomplete="off" data-id="<?php echo $widget->getId()?>">
                                    <fieldset>
                                        <?php echo $widget->getWidget()->getClass()->form($widget->getData()); ?>
                                        <div>
                                            <button class="btn btn-primary" type="submit">Save</button>
                                            <button class="btn btn-danger pull-right remove-widget" type="submit"><i class="icon-trash icon-white"></i></button>
                                        </div>
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
</div>
<script>
    var forms = <?php echo json_encode($forms);?>;
    var widgetUrl = '<?php echo site_url('templates'); ?>';
    var templateId = <?php echo $template->getId(); ?>;
    var token = {
        'name' : '<?php echo $this->security->get_csrf_token_name(); ?>',
        'value' : '<?php echo $this->security->get_csrf_hash(); ?>'
    };
</script>
<?php
$js = array('jquery.serialize-object.min.js', 'edit-template.js');
$this->view('templates/footer', array ('js' => $js));
?>