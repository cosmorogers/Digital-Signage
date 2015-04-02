<?php



/**
 * Skeleton subclass for representing a row from the 'user' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.
 */
class User extends BaseUser
{
	public function setPassword($v) {
		if ('' === $v) {
			$v = NULL;
		}
		return parent::setPassword($v);
	}
	
	public function preSave(PropelPDO $con = null) {
		if (in_array(UserPeer::PASSWORD, $this->modifiedColumns)) {
			if (!is_null($this->getPassword())) {
				
				$hash = $this->getBcrypt()->hash($this->getPassword());
				
				parent::setPassword($hash);
			}
		}
		return true;
	}
	
	public function verify($password) {
		if (!is_null($this->getPassword())) {
			return $this->getBcrypt()->verify($password, $this->getPassword());
		} else {
			//Use ldap
			return $this->checkLdap($this->getUsername(), $password);
		}
	}
	
	protected function getBcrypt() {
		$CI =& get_instance();
		$CI->load->library('bcrypt');
		return new Bcrypt(15);
	}
	
	protected function checkLdap($username, $password) {
		$server = '192.168.1.3';
		$ext = '@abbey.local';

		if ($ds = ldap_connect($server)) {
			ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3); 
			ldap_set_option($ds, LDAP_OPT_REFERRALS, 0);
			return (@ldap_bind($ds, $username . $ext, $password));
		} else {
			throw new LdapException("Couldn't connect");
		}
	}
}

class LdapException extends Exception {}
