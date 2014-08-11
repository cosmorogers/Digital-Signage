<?php
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 11/08/14
 * Time: 14:46
 */

class TemperatureWidget extends AbstractWidget {

    public function __construct()
    {
        parent::__construct('Temperature','Display the current room temperature and graph');
    }

    public function view($settings, Screen $screen)
    {
        $temperature = TemperatureQuery::create()->orderByTime(Criteria::DESC)->findOne();

        $temperatures = TemperatureQuery::create()
            ->filterByLocation('it')
            ->filterByTime(strtotime("-1 day"), Criteria::GREATER_THAN)
            ->find();
        $tArray = array();
        $high = new Temperature();
        $low = new Temperature();
        $low->setReading(1000);//Just so first low works :)
        foreach ($temperatures as $t) {
            if ($t->getReading() > $high->getReading()) {
                $high = $t;
            }
            if ($t->getReading() < $low->getReading()) {
                $low = $t;
            }
            $tArray[] = array('time' => $t->getTime(), 'temperature' => $t->getReading());
        }

        return '<div class="hero-unit" style="padding:10px; text-align:center !important;">
                    <h3>Room Temperature <small>last 24hrs</small></h3>
                    <table class="table text-center">
                        <tr>
                            <th>High</th>
                            <th>Current</th>
                            <th>Low</th>
                        </tr>
                        <tr>
                            <td style="background-color:#f2dede;"><h4>' . $high->getReading() . '&deg;C<br><small>' . $high->getTime('H:i') . '</small></h4></td>
                            <td style="background-color:#dff0d8;"><h3 style="line-height: 23px;">' . $temperature->getReading() . '&deg;C<br><small class="muted">' . $temperature->getTime('H:i') . '</small></h3></td>
                            <td style="background-color:#d9edf7;"><h4>' . $low->getReading() . '&deg;C<br><small>' . $low->getTime('H:i') . '</small></h4></td>
                        </tr>
                    </table>
                    <div id="temperatureGraph" style="width: 100%; height: 200px"></div>
                    <script>var temperatures = ' . json_encode($tArray) . ';</script>
                </div>';
    }

    public function scripts()
    {
        return array('raphael-2.0.2.min.js', 'morris.min.js', 'temperature.js');
    }
} 