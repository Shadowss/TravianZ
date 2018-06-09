<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       message.tpl                                                 ##
##  Developed by:  Dzoki                                                       ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2011. All rights reserved.                ##
##                                                                             ##
#################################################################################
?>
<style>
	.del {width:12px; height:12px; background-image: url(img/admin/icon/del.gif);}
</style>
<link href="../<?php echo GP_LOCATE; ?>lang/en/compact.css?f4b7i" rel="stylesheet" type="text/css">
<table id="member" style="width:225px">
  <thead>
	<tr>
		<th colspan="2">IGM/Reports</th>
	</tr>
  </thead>
	<tr>
		<td>IGM ID</td>
		<td><form action="" method="get"><input type="hidden" name="p" value="message"><input type="text" class="fm" name="nid" value="<?php echo $_GET['nid'];?>"> <input type="image" value="submit" src="../img/admin/b/ok1.gif"></form></td>
	</tr>
	<tr>
		<td>Report ID</td>
		<td><form action="" method="get"><input type="hidden" name="p" value="message"><input type="text" class="fm" name="bid" value="<?php echo $_GET['bid'];?>"> <input type="image" value="submit" src="../img/admin/b/ok1.gif"></form></td>
	</tr>
</table>
<br>

<?php
if($_GET['nid'] && is_numeric($_GET['nid'])) include('msg.tpl');
elseif($_GET['bid'] && is_numeric($_GET['bid'])) include('report.tpl');
?>

