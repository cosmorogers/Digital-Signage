<?php
/**
 * User: chris
 * Date: 04/02/2015
 * Time: 13:00
 */


class RemoteurlWidget extends AbstractWidget {

    public function __construct()
    {
        parent::__construct('RemoteUrl','Display url in an iframe');
    }

    public function form($settings)
    {
        $form = '<label>Url to load</label>
        <input type="text" name="url" value="'. (isset($settings['url']) ? $settings['url'] : '') .'">';
        return $form;
    }


    public function view($settings, Screen $screen)
    {
        $url = (isset($settings['url']) ? $settings['url'] : 'http://www.battleabbeyschool.com');
        $view = '<iframe src="' . $url . '" width="100%" height="100%" scrolling="no" frameborder="0" seamless>';

        return $view;
    }

    public function scripts()
    {
        return array('jquery.cycle2.min.js', 'slideshow.js');
    }

}
