<?php
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 08/08/14
 * Time: 15:37
 */

class WeatherWidget extends AbstractWidget {

    public function __construct()
    {
        parent::__construct('Weather','Display the weather forecast. Will automatically adjust to the container size');
    }

    public function view($settings, Screen $screen)
    {
        return '<div class="hero-unit" style="padding:10px; text-align:center !important;">
            <h3>5 Day Weather Forecast</h3>
            <table id="weatherTable" class="table" style="font-size: 0.6em; margin-bottom: 0;" data-url="' . site_url('weather') . '">
              <tr id="dateRow"></tr>
              <tr id="iconsRow"></tr>
              <tr id="weatherRow"></tr>
            </table>
            <small class="muted" style="font-size: 10px;">Weather provided by The Met Office</small>
          </div>';
    }

    public function scripts()
    {
        return array('weather.js');
    }
} 