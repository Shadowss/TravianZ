<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       Form.php                                                    ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2026. All rights reserved.                ##
##  Refactored by: Shadow (cata7007@gmail.com)								   ##
##                                                                             ##
##  Refactor:      Incremental cleanup (compatibility preserved)               ##
##  Notes:         PHP 7+ / legacy safe                                        ##
##                                                                             ##
##  URLs:          http://travian.shadowss.ro                                  ##
##                 https://github.com/Shadowss/TravianZ                        ##
##                                                                             ##
#################################################################################

class Form {

	private $errorarray = array();
	public $valuearray = array();
	private $errorcount = 0;

	public function __construct() {

		if (isset($_SESSION['errorarray']) && isset($_SESSION['valuearray'])) {

			$this->errorarray = $_SESSION['errorarray'];
			$this->valuearray = $_SESSION['valuearray'];
			$this->errorcount = count($this->errorarray);

			unset($_SESSION['errorarray'], $_SESSION['valuearray']);
		} else {
			$this->errorcount = 0;
		}
	}

	public function addError($field, $error) {

		$this->errorarray[$field] = $error;
		$this->errorcount = count($this->errorarray);
	}

	public function getError($field) {

		if (array_key_exists($field, $this->errorarray)) {
			return $this->errorarray[$field];
		}

		return "";
	}

	public function getValue($field) {

		if (array_key_exists($field, $this->valuearray)) {
			return $this->valuearray[$field];
		}

		return "";
	}

	public function setValue($field, $value) {

		$this->valuearray[$field] = $value;
	}

	public function getDiff($field, $cookie) {

		if (array_key_exists($field, $this->valuearray) && $this->valuearray[$field] != $cookie) {
			return $this->valuearray[$field];
		}

		return $cookie;
	}

	public function getRadio($field, $value) {

		if (array_key_exists($field, $this->valuearray) && $this->valuearray[$field] == $value) {
			return "checked";
		}

		return "";
	}

	public function returnErrors() {

		return $this->errorcount;
	}

	public function getErrors() {

		return $this->errorarray;
	}
}
?>