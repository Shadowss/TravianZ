<?php
//////////////////////////////////////////////////////////////////////////////////////////////////////
// TRAVIANX //
// Only for advanced users, do not edit if you dont know what are you doing! //
// Made by: Dzoki & Dixie (TravianX) //
// - TravianX = Travian Clone Project - //
// DO NOT REMOVE COPYRIGHT NOTICE! //
//////////////////////////////////////////////////////////////////////////////////////////////////////

if(isset($_GET['c']) && $_GET['c'] == 1) {
echo "<div class=\"headline\"><span class=\"f10 c5\">Error importing database. Check configuration.</span></div><br>";
}
?>
<form action="process.php" method="post" id="dataform">
<input type="hidden" name="substruc" value="1">

        <p>
        <span class="f10 c">Create SQL Structure</span>
<table>
<tr><td>Warning: This can take some time. Wait till the next page has been loaded! Click Create to proceed..</td></tr>
<tr><td><center><input type="submit" name="Submit" id="Submit" value="Create.." onClick="return proceed()"></center></td></tr>
</table>
        </p>
</form>
</div>
