<?php



/**
 * Skeleton subclass for representing a row from the 'image' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.
 */
class Image extends BaseImage
{
	public function preInsert(PropelPDO $con=null)
	{
		$this->setDate('@'.time());
		return true;
	}
	
	public function preDelete(PropelPDO $con=null)
	{
		$slideshowImages = $this->getSlideshowImages(null, $con);
		$slideshowImages->delete($con);
		
		return true;
	}
	
	public function getThumbnailUrl()
	{
		return base_url('assets/uploads/thumbnail/' . $this->getFilename());
	}
	
	public function getMediumUrl()
	{
		return base_url('assets/uploads/medium/' . $this->getFilename());
	}
	
	public function getSizeUrl($width, $height, $background = 'white')
	{
		$directory = 'assets/uploads/resized/' . $width . 'x' . $height; 
		$filename =  $directory . '/' . $this->getFilename();
		if (!file_exists($filename)) {
			/* Instanciate and read the image in */
			$im = new Imagick('assets/uploads/' . $this->getFilename());
			
			/* Fit the image into $width x $height box
			 The third parameter fits the image into a "bounding box" */
			$im->thumbnailImage( $width, $height, true );
			
			/* Create a canvas with the desired color */
			$canvas = new Imagick();
			$canvas->newImage( $width, $height, $background, 'png' );
			
			/* Get the image geometry */
			$geometry = $im->getImageGeometry();
			
			/* The overlay x and y coordinates */
			$x = ( $width - $geometry['width'] ) / 2;
			$y = ( $height - $geometry['height'] ) / 2;
			
			/* Composite on the canvas */
			$canvas->compositeImage( $im, imagick::COMPOSITE_OVER, $x, $y );
			
			/* Output the image*/
			if (!file_exists($directory)) {
				mkdir($directory, 0755, true);
			}
			$canvas->writeimage($filename);
		}
				
		return base_url($filename);
	}
}
