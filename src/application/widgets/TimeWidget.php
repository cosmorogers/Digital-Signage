<?php
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 11/08/14
 * Time: 15:28
 */

class TimeWidget extends AbstractWidget {

    public function __construct()
    {
        parent::__construct('Time','Display the current time and date');
    }

    public function view($settings, Screen $screen)
    {
        return '<div class="hero-unit">
            <div class="clock">
              <h3 id="date" style="text-align:center"></h3>
              <p style="font-size: 30px; text-align: center;">
                <span id="hours"></span>:<span id="min"></span>:<span id="sec"></span>
              </p>
            </div>
          </div>';
    }

    public function scripts()
    {
        return array('clock.js');
    }

} 