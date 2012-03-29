<?php
//////////////////////////////////////////////////////////////////////////////////////////////////////
//                                             TRAVIANX                                             //
//            Only for advanced users, do not edit if you dont know what are you doing!             //
//                                Made by: Dzoki & Dixie (TravianX)                                 //
//                              - TravianX = Travian Clone Project -                                //
//                                 DO NOT REMOVE COPYRIGHT NOTICE!                                  //
//////////////////////////////////////////////////////////////////////////////////////////////////////
	rename("include/constant.php","../GameEngine/config.php");
?>



<form action="include/multihunter.php" method="post" id="dataform">
   
<p>
	<span class="f10 c">Create Multihunter account</span>
		<table>
			<tr><td>Name:</td><td><input type="text" name="mhpw" id="mhpw" value="Multihunter" disabled="disabled"></td></tr>
			<tr><td>Password:</td><td><input type="text" name="mhpw" id="mhpw" value=""></td></tr>
			<tr><td>Note: Rember this password! You need it for the ACP</td><td></td></tr>
		</table>
</p>

   	<center>
    <input type="submit" name="Submit" id="Submit" value="Submit"></center>
</form>
    
</div>