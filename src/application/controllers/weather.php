<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Weather extends MY_Controller {
	
	protected $restricted = false;
  protected $api_key = '76351c23-bda0-4a01-9047-b07854c15e03';
  protected $location_id = '322018';//battle
  protected $cache_file = './application/cache/weather.cache';

	public function index()
	{
    if (file_exists($this->cache_file)) {
      $weather = unserialize(file_get_contents($this->cache_file));
      $now = time();
      if ($now - $weather['time'] > 3600) {
        $weather = $this->updateWeather();
      }
    } else {
      $weather = $this->updateWeather();
    }

    echo $weather['json'];
	}

  private function updateWeather() {
    

    $weather_json = file_get_contents('http://datapoint.metoffice.gov.uk/public/data/val/wxfcs/all/json/' . $this->location_id . '?res=daily&key=' . $this->api_key);

    $weather['json'] = $weather_json;
    $weather['time'] = time();

    file_put_contents($this->cache_file, serialize($weather));

    return $weather;
  }
}
