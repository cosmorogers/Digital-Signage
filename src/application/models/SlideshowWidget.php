<?php



/**
 * Skeleton subclass for representing a row from one of the subclasses of the 'widget' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.
 */
class SlideshowWidget extends Widget {

    /**
     * Constructs a new SlideshowWidget class, setting the class_key column to WidgetPeer::CLASSKEY_3.
     */
    public function __construct()
    {
        parent::__construct();
        $this->setClassKey(WidgetPeer::CLASSKEY_3);
    }

} // SlideshowWidget
