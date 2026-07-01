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

		// iterate key/order/type triplets
		for ($i = 1; $i < count($args); $i += 3)
		{
			$key   = isset($args[$i]) ? $args[$i] : null;
			$order = isset($args[$i + 1]) ? $args[$i + 1] : true; // true = ASC
			$type  = isset($args[$i + 2]) ? $args[$i + 2] : 0;

			if ($key === null) {
				continue;
			}

			// comparator
			$cmp = function ($a, $b) use ($key, $type, $order)
			{
				$va = isset($a[$key]) ? $a[$key] : null;
				$vb = isset($b[$key]) ? $b[$key] : null;

				switch ($type)
				{
					case 1: // Case insensitive natural
						$result = strnatcasecmp($va, $vb);
						break;

					case 2: // Numeric
						$result = ($va == $vb) ? 0 : (($va < $vb) ? -1 : 1);
						break;

					case 3: // Case sensitive string
						$result = strcmp((string)$va, (string)$vb);
						break;

					case 4: // Case insensitive string
						$result = strcasecmp((string)$va, (string)$vb);
						break;

					default: // Case sensitive natural
						$result = strnatcmp((string)$va, (string)$vb);
						break;
				}

				return $order ? $result : -$result;
			};

			usort($array, $cmp);
		}

		return $array;
	}
}

$multisort = new multiSort();

?>