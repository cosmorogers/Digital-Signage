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
class MessageWidget extends Widget {

    /**
     * Constructs a new MessageWidget class, setting the class_key column to WidgetPeer::CLASSKEY_2.
     */
    public function __construct()
    {
        parent::__construct();
        $this->setClassKey(WidgetPeer::CLASSKEY_2);
    }

    public function getWidgetName()
    {
    	return "Messages";
    }

    public function getWidgetDescription()
	{
		return "Automatically display the messages for the the screen that this template is used on.";
    }

    public function getWidgetForm()
    {
    	return array (
    		'time' => array (
    			'name' => 'Display Time',
    			'help' => 'How long to display each message',
    			'default' => 4,
    			'type' => 'number'
			)
		);
    }

} // MessageWidget
