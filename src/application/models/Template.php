<?php



/**
 * Skeleton subclass for representing a row from the 'template' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.
 */
class Template extends BaseTemplate
{
    public function getWidgetsInContainer($container, $screen)
    {
        $return = '';
        foreach ($this->getTemplateWidgetsJoinWidget() as $widget) {
            if ($widget->getContainer() == $container) {
                $return .= $widget->getWidget()->getClass()->view($widget->getData(), $screen);
            }
        }

        return $return;
    }

    public function getScripts()
    {
        $scripts = array();
        $tq = TemplateWidgetQuery::create()->groupByWidgetName();
        foreach ($this->getTemplateWidgetsJoinWidget($tq) as $widget) {
            $scripts = array_merge($scripts, $widget->getWidget()->getClass()->scripts());
        }
        return array_unique($scripts);
    }
}
