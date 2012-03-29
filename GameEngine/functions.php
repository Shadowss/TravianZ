<?php
############################################################
##                                                        ##
##     Test functions so far mini template parser         ##
##     Author : Advocaite                                 ##
##     Project : TravianX                                 ##
##                                                        ##
############################################################
function addSub($subName, $sub)
{
	$GLOBALS['subs']["{".$subName."}"] = $sub;
}

function template($filepath, $subs)
{
	global $s;
	if(file_exists($filepath))
	{
		$text = file_get_contents($filepath);
	} else {
		print "File '$filepath' not found";
		return false;
	}
	
	foreach($subs as $sub => $repl)
	{
		$text = str_replace($sub, $repl, $text);
	}
	
	ob_start();
		eval("?>".$text);
		$text = ob_get_contents();
	ob_end_clean();
	return $text;
}

?>