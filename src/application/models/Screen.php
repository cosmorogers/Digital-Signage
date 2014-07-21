<?php



/**
 * Skeleton subclass for representing a row from the 'screen' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.
 */
class Screen extends BaseScreen
{
	public function checkAlive()
	{
        	exec(sprintf('ping -c 1 -W 5 %s', escapeshellarg($this->getIp())), $res, $rval);
        	return $rval === 0;
	}

	public function magicBoot()
	{
		exec(sprintf('wakeonlan %s', escapeshellarg($this->getMac())), $res, $rval);
		return $rval === 0;
	}

	public function checkIn()
	{
		$this->setLastSeen(time())
		->save();
	}

  public function getMachineFriendlyName()
  {
    return strtolower(url_title($this->getName()));
  }

  public function getRemote()
  {
    exec('vncsnapshot -passwd /var/www/internal/display/.screens.pwd ' . $this->getIp() . ' /var/www/internal/display/assets/uploads/previews/' . $this->getMachineFriendlyName() . '.jpg',$res,$val);

    if (0 === $val) {
      return base_url('assets/uploads/previews/' . $this->getMachineFriendlyName() . '.jpg');
    } else {
      return NULL;
    }
  }
}
