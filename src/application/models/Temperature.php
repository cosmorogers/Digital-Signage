<?php



/**
 * Skeleton subclass for representing a row from the 'temperature' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.
 */
class Temperature extends BaseTemperature
{
    public function preSave(PropelPDO $con = null)
    {
        $this->setTime(time());
        return parent::preSave($con);
    }
}
