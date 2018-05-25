<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       Form.php                                                    ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2011. All rights reserved.                ##
##                                                                             ##
#################################################################################

class Form {

	private $errorarray = array();
	public $valuearray = array();
	private $errorcount;

	public function __construct() {
		if(isset($_SESSION['errorarray']) && isset($_SESSION['valuearray'])) {
			$this->errorarray = $_SESSION['errorarray'];
			$this->valuearray = $_SESSION['valuearray'];
			$this->errorcount = count($this->errorarray);

			unset($_SESSION['errorarray']);
			unset($_SESSION['valuearray']);
		}
		else $this->errorcount = 0;
	}

	public function addError($field,$error) {
		$this->errorarray[$field] = $error;
		$this->errorcount = count($this->errorarray);
	}

	public function getError($field) {
		if(array_key_exists($field,$this->errorarray)) {
			return $this->errorarray[$field];
		}
		else return "";
	}

	public function getValue($field) {
		if(array_key_exists($field,$this->valuearray)) {
			return $this->valuearray[$field];
		}
		else return "";
	}
	
	public function setValue($field, $value) {
        $this->valuearray[$field] = $value;
	}

	public function getDiff($field,$cookie) {
		if(array_key_exists($field,$this->valuearray) && $this->valuearray[$field] != $cookie) {
			return $this->valuearray[$field];
		}
		else return $cookie;
	}

	public function getRadio($field,$value) {
		if(array_key_exists($field,$this->valuearray) && $this->valuearray[$field] == $value) {
			return "checked";
		}
		else return "";
	}

	public function returnErrors() {
		return $this->errorcount;
	}

	public function getErrors() {
		return $this->errorarray;
	}
};
?>