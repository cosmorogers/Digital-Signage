<?php



/**
 * Skeleton subclass for representing a row from the 'widget' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.
 */
class Widget extends BaseWidget
{

    /**
     * @return AbstractWidget
     */
    public function getClass()
    {
        require_once 'application/widgets/AbstractWidget.php';
        $className = ucfirst($this->getName()) . 'Widget';
        require_once 'application/widgets/'.$className.'.php';
        return new $className();
    }
	
}
