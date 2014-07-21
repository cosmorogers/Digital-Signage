<?php



/**
 * Skeleton subclass for representing a row from the 'slideshow_image' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.
 */
class SlideshowImage extends BaseSlideshowImage
{
	public function preInsert(PropelPDO $con=null)
	{
		if (is_null($this->getOrder()) || '' == $this->getOrder()) {
			$this->setOrder($this->findMaxOrder($con));
		}
		return true;
	}
	
	protected function findMaxOrder(PropelPDO $con=null)
	{
		$order = 0;
		$image = SlideshowImageQuery::create()->filterBySlideshowId($this->getSlideshowId())->orderByOrder(Criteria::DESC)->findOne($con);
		if (!is_null($image)) {
			$order = $image->getOrder() + 1;
		}
		
		return $order;
	}
}
