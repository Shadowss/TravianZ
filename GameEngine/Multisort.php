<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : Multisort.php                    	                       ##
##  Type           : Multisort System Backend                                  ##
## --------------------------------------------------------------------------- ##
##  Developed by   : Dzoki           			                               ##
##  Refactored by  : Shadow & Ferywir									       ##
##  Thanks to      : ronix, InCube, Akakori, Elmar & Kirilloid                 ##
## --------------------------------------------------------------------------- ##
##  Contact        : cata7007@gmail.com                                        ##
##  Project        : TravianZ                                                  ##
##  URLs:          : https://travianz.org                                      ##
##  GitHub         : https://github.com/Shadowss/TravianZ                      ##
## --------------------------------------------------------------------------- ##
##  License        : TravianZ Project                                          ##
##  Copyright      : TravianZ (c) 2010-2026. All rights reserved.              ##
## --------------------------------------------------------------------------- ##
#################################################################################

class multiSort
{
	/**
	 * Multi-key array sorter
	 * Usage: sorte($array, 'key1', true, 3, 'key2', false, 2, ...)
	 */
	public function sorte($array)
	{
		$args = func_get_args();
		$array = $args[0];
		$criteria = array();

		// Collect key/order/type triplets in their declared priority order.
		for ($i = 1; $i < count($args); $i += 3)
		{
			$key   = isset($args[$i]) ? $args[$i] : null;
			$order = isset($args[$i + 1]) ? $args[$i + 1] : true; // true = ASC
			$type  = isset($args[$i + 2]) ? $args[$i + 2] : 0;

			if ($key !== null) {
				$criteria[] = array($key, $order, $type);
			}
		}

		if (!count($criteria)) {
			return $array;
		}

		usort($array, function ($a, $b) use ($criteria) {
			foreach ($criteria as $criterion) {
				list($key, $order, $type) = $criterion;
				$va = isset($a[$key]) ? $a[$key] : null;
				$vb = isset($b[$key]) ? $b[$key] : null;
				$result = $this->compareValues($va, $vb, $type);

				if ($result !== 0) {
					return $order ? $result : -$result;
				}
			}

			return 0;
		});

		return $array;
	}

	/**
	 * Compare two values using the sort type expected by sorte().
	 */
	private function compareValues($a, $b, $type)
	{
		switch ($type)
		{
			case 1: // Case insensitive natural
				return strnatcasecmp((string)$a, (string)$b);

			case 2: // Numeric
				return ($a == $b) ? 0 : (($a < $b) ? -1 : 1);

			case 3: // Case sensitive string
				return strcmp((string)$a, (string)$b);

			case 4: // Case insensitive string
				return strcasecmp((string)$a, (string)$b);

			default: // Case sensitive natural
				return strnatcmp((string)$a, (string)$b);
		}
	}
}

$multisort = new multiSort();

?>
