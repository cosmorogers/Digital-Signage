<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Templates extends MY_Controller {

	private $templateBase = 'application/views/display/layouts';

	public function index() 
	{
        $templates = TemplateQuery::CREATE()->find();
		$this->load->view('screens/templates/view', array('templates' => $templates));
	}

	public function create()
	{
        $template = new Template();
        $errors = array();
        if ($data = $this->input->post('template')) {
            $template->fromArray($data);

            if ($template->validate()) {
                $template->save();
                $this->addSuccessMessage('Template Created');
                redirect('templates/edit/' . $template->getId());
            } else {
                $errors = $template->getValidationFailures();
            }
        }

		$layouts = array();
		
		foreach(scandir($this->templateBase) as $file) {
			$layoutDescription = null;
			if (pathinfo($this->templateBase . DIRECTORY_SEPARATOR . $file, PATHINFO_EXTENSION) === 'php') {
				ob_start();
				$screen = new Screen();
				@include($this->templateBase . DIRECTORY_SEPARATOR . $file);
				ob_end_clean();

				if (!is_null($layoutDescription) && is_array($layoutDescription)) {
					$layouts[] = array(
						'name' => $layoutDescription['name'],
						'file' => $file
					);
				}
			}

		}
		$this->load->view('screens/templates/create', array(
            'layouts' => $layouts,
            'template' => $template,
            'errors' => $errors
        ));
	}

	public function edit($id)
	{
		//Load template
        $template = TemplateQuery::create()->findOneById($id);

        $widgets = WidgetQuery::create()->find();

		$file = $template->getLayout();
		$layoutDescription = null;
		
		ob_start();
		$screen = new Screen();
		include($this->templateBase . DIRECTORY_SEPARATOR . $file);
		ob_end_clean();

		if (!is_null($layoutDescription) && is_array($layoutDescription)) {
            $TemplateWidgets= TemplateWidgetQuery::create()
                ->findByTemplate($template);

			$this->load->view('screens/templates/edit',
                array(
                    'layout' => $layoutDescription,
                    'template_widgets' => $TemplateWidgets,
                    'widgets' => $widgets,
                    'template' => $template
                )
            );
		} else {
			echo "oh noes";
		}
	}

    public function saveWidget($templateId)
    {
        $template = TemplateQuery::create()->findOneById($templateId);
        if (!is_null($template) && $data = $this->input->post('widget')) {
            $widget = WidgetQuery::create()->findOneByName($data['name']);
            if (!is_null($widget)) {
                $templateWidget = new TemplateWidget();
                $templateWidget->setTemplate($template)
                    ->setWidget($widget)
                    ->setContainer($data['container'])
                    ->setData(serialize($data['settings']))
                    ->save();

                echo json_encode(array('success' => true));
            } else {
                echo 'widget not found';
            }
        } else {
            echo 'Template not found' . $templateId;
        }
    }

    public function updateWidget($widgetId)
    {
        $templateWidget = TemplateWidgetQuery::CREATE()->findOneById($widgetId);
        if (!is_null($templateWidget)) {
            $templateWidget->getWidget()->getClass()->update($this->input->get('settings'));
        }
    }


    public function removeWidget()
    {
        if ($widgetId = $this->input->post('id')) {
            $templateWidget = TemplateWidgetQuery::CREATE()->findOneById($widgetId);
            if (!is_null($templateWidget)) {
                $templateWidget->delete();
            }
        }
    }


}