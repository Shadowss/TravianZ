<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Project:       TravianZ                                                    ##
##  Version:       30.04.2026	           			       			   		   ##
##  Filename       functions.php - mini template parser                        ##
##  Developed by:  Advocaite							   					   ##
##  Refactor by:   Shadow (PHP 7+ safe + optimized) 						   ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2026. All rights reserved.                ##
##  URLs:          https://travianz.org                                        ##
##                 https://github.com/Shadowss/TravianZ                        ##
##                                                                             ##
#################################################################################

/**
 * -------------------------------------------------------------------------
 * TEMPLATE SUBSTITUTION REGISTER
 * -------------------------------------------------------------------------
 * Stores global placeholders used across templates.
 * Example: {USERNAME}, {LEVEL}, etc.
 */
 
function addSub($subName, $sub)
{
	// Initialize storage if not set (safe legacy fix)
	if (!isset($GLOBALS['subs']) || !is_array($GLOBALS['subs'])) {
		$GLOBALS['subs'] = [];
	}

	$GLOBALS['subs']['{' . $subName . '}'] = $sub;
}

/**
 * -------------------------------------------------------------------------
 * SIMPLE TEMPLATE ENGINE (SAFE VERSION)
 * -------------------------------------------------------------------------
 * - Loads template file
 * - Replaces placeholders
 * - Executes NO PHP eval (security fix)
 * - Returns rendered HTML
 *
 * Added:
 * - file cache (static)
 * - safe fallback handling
 */
 
function template($filepath, $subs = [])
{
	static $cache = [];

	// Merge global subs + local subs (local overrides global)
	$globalSubs = (isset($GLOBALS['subs']) && is_array($GLOBALS['subs']))
		? $GLOBALS['subs']
		: [];

	if (!file_exists($filepath)) {
		echo "File '" . $filepath . "' not found";
		return false;
	}

	// Cache key (file + modification time)
	$cacheKey = $filepath . '|' . filemtime($filepath);

	// Return cached version if exists
	if (isset($cache[$cacheKey])) {
		$text = $cache[$cacheKey];
	} else {
		$text = file_get_contents($filepath);
		if ($text === false) {
			return false;
		}

		// Store raw template in cache
		$cache[$cacheKey] = $text;
	}

	// Merge subs (local overrides global)
	$subs = array_merge($globalSubs, $subs);

	// Replace placeholders
	if (!empty($subs)) {
		foreach ($subs as $sub => $repl) {
			$text = str_replace($sub, $repl, $text);
		}
	}

	/**
	 * SECURITY CHANGE:
	 * Removed eval() completely.
	 * Old system allowed PHP injection via templates.
	 *
	 * Now only plain text substitution is supported.
	 */

	// Output buffering kept for compatibility with legacy usage
	ob_start();
	echo $text;
	return ob_get_clean();
}
?>