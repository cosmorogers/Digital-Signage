<?php



/**
 * Skeleton subclass for representing a row from the 'slideshow' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.
 */
class Slideshow extends BaseSlideshow
{
	/**
	 * 
	 * @return Image
	 */
	public function getImage()
	{
		$image = SlideshowImageQuery::create()
					->filterBySlideshow($this)
					->joinWith('SlideshowImage.Image')
					->orderByOrder()
					->findOne();

		if (is_null($image)) {
			return NULL;
		} else {
			return $image->getImage();
		}
	}
}
