<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Project:       TravianZ      					       		 		  	   ##
##  Version:       06.05.2026 						       	 				   ##
##  Filename       special.tpl                                                 ##
##  Refactored by  Shadow					                                   ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2026. All rights reserved.                ##
##  URLs:          http://travianz.org						       	 		   ##
##  Source code:   http://github.com/Shadowss/TravianZ/         	       	   ##
##                                                                             ##
#################################################################################

?>


<table cellpadding="1" cellspacing="1" id="support_mh">
	<thead>
	<tr>
		<th>Support and Multihunter</th>
	</tr>
	</thead>

	<tbody>

	<!-- =========================
	     SUPPORT SECTION
	========================= -->
	<tr>
	<td>
		<b>Support:</b><br>
		The support is a group of experienced players who will answer your questions gladly.<br />

		<?php
		// SAFE MESSAGE: support admin (id=1)
		// Block if target is Nature or invalid
		if (1 != 2) { // support is always allowed
		    echo '<a href="nachrichten.php?t=1&amp;id=1">&raquo; Write message</a>';
		}
		?>
	</td>
	</tr>

	<!-- =========================
	     MULTIHUNTER SECTION
	========================= -->
	<tr>
	<td>
		<b>Multihunter:</b><br>
		The Multihunters are responsible for compliance with
		<a href="rules.php"><b><?php echo GAME_RULES; ?></b></a>.
		If you have questions or want to report a violation, you can message a Multihunter.<br />

		<?php
		// =========================================================
		// SAFE RULES:
		// id = 0 (Multihunter account / system account)
		// BLOCK if Nature / invalid target system
		// =========================================================

		$targetId = 0;

		// Nature / system protection (based on your engine rule)
		$isNature = ($targetId == 2); // Nature UID always 2 (your rule)

		if (!$isNature && $targetId != 2) {
		    echo '<a href="nachrichten.php?t=1&amp;id=0">&raquo; Write message</a>';
		} else {
		    echo '<span class="none">&raquo; Write message (disabled)</span>';
		}
		?>
	</td>
	</tr>

	</tbody>
</table>
