<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       Multisort.php                                               ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2011. All rights reserved.                ##
##                                                                             ##
#################################################################################

class multiSort {

	function sorte($array)
	{
		for($i = 1; $i < func_num_args(); $i += 3)
		{
			$key = func_get_arg($i);

			$order = true;
			if($i + 1 < func_num_args())
				$order = func_get_arg($i + 1);

			$type = 0;
			if($i + 2 < func_num_args())
				$type = func_get_arg($i + 2);

			$t = function($a, $b) use ($key, $type, $order)
			{			    
			    switch($type)
			    {
			        case 1: // Case insensitive natural.
			            $result = strcasenatcmp($a[$key], $b[$key]);
			            break;
			        case 2: // Numeric.
			            $result = $a[$key] - $b[$key];			 
			            break;
			        case 3: // Case sensitive string.
			            $result = strcmp($a[$key], $b[$key]);	
			            break;
			        case 4: // Case insensitive string.
			            $result = strcasecmp($a[$key], $b[$key]);	
			            break;
			        default: // Case sensitive natural.
			            $result = strnatcmp($a[$key], $b[ $key]);
			            break;                      
			    }
			    return $result*($order ? 1 : -1);
			};

			usort($array, $t);
		}
		return $array;
	}

};
$multisort = new multiSort;
?>
