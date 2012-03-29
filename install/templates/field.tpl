<?php
//////////////////////////////////////////////////////////////////////////////////////////////////////
//                                             TRAVIANX                                             //
//            Only for advanced users, do not edit if you dont know what are you doing!             //
//                                Made by: Dzoki & Dixie (TravianX)                                 //
//                              - TravianX = Travian Clone Project -                                //
//                                 DO NOT REMOVE COPYRIGHT NOTICE!                                  //
//////////////////////////////////////////////////////////////////////////////////////////////////////

if(isset($_GET['c']) && $_GET['c'] == 1) {
echo "<div class=\"headline\"><span class=\"f10 c5\">Error creating wdata. Check configuration or file.</span></div><br>";
}
?>
<form action="process.php" method="post" id="dataform">
<input type="hidden" name="subwdata" value="1">

	<p>
	<span class="f10 c">Create World Data</span>
		<table>
			<tr><td><b>Warning</b>: This can take some time. Do not click, just wait till the next page has been loaded!</td></tr>
			<tr><td><center><input type="submit" name="Submit" id="Submit" value="Create.."></center></td></tr>
		</table>
	</p>
</form>
</div>