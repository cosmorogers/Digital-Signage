<?php
class MacValidator implements BasicValidator {
	
	public function isValid(ValidatorMap $map, $str) {
		return (preg_match('/^([0-9A-F]{2}[:]){5}([0-9A-F]{2})$/i', $str) == 1);
	}
}