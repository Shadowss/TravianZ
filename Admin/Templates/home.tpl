<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       home.tpl                                                    ##
##  Developed by:  Dzoki                                                       ##
##  Reworked:      aggenekech												   ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2011. All rights reserved.                ##
##                                                                             ##
#################################################################################
?>
<font size="3">
	<b>
		<center>
			WELCOME TO
				<?php
				if($_SESSION['access'] == MULTIHUNTER)
				{
					echo 'MULTIHUNTER';
				}
				else if($_SESSION['access'] == ADMIN)
				{
					echo 'ADMINISTRATOR';
				} ?>
			CONTROL PANEL
		</center>
	</b>
</font>


<br /><br /><br /><br />

	Hello <b><?php echo $_SESSION['username']; ?></b>, You are logged in as: <b><font color="Red">Administrator</font></b></center>
	<br /><br /><br />

	<br /><br /><br /><br /><br />


	<font color="#c5c5c5" size="1">
		Credits: Akakori & Elmar<br />
		Fixed, remade and new features added by <b>Dzoki</b><br />
		Reworked by <b>aggenkeech</b>
		Remaked by <b>Shadow</b>
	</font>
