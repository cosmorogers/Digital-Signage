<?php
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 06/08/14
 * Time: 15:44
 */


class SlideshowWidget extends AbstractWidget {

    public function __construct()
    {
        parent::__construct('Slideshow','Display a chosen slideshow');
    }

    public function form($settings)
    {
        $slideshows = SlideshowQuery::create()->find();
        $form = '<form><fieldset><label>Slideshow to show</label><select name="slideshow">';
        foreach ($slideshows as $slideshow) {
            $form .= '<option value="' . $slideshow->getId() . '">' . $slideshow->getName() . '</option>';
        }
        $form .= '</select></fieldset></form>';

        return $form;
    }


    public function view($settings)
    {
        return 'Some slideshowage';
    }
}