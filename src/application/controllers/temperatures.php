<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Temperatures extends MY_Controller {

    protected $restricted = false;

    public function log($location)
    {
        if ($this->input->is_cli_request()) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'http://192.168.7.70/cgi-bin/temp.cgi');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            $result = curl_exec($ch);

            if ($result !== FALSE) {
                $res = explode(' ', $result);
                if (sizeof($res) == 5) {
                    $temperature = str_replace('C', '', $res[4]);
                    $t = new Temperature();
                    $t->setLocation($location)
                        ->setReading($temperature)
                        ->save();
                    echo "SAVED";
                }
            }
        } else {
            echo "no";
        }

    }
} 