<?php
//////////////////////////////////////////////////////////////////////////////////////////////////////
//                                             TRAVIANX                                             //
//            Only for advanced users, do not edit if you dont know what are you doing!             //
//                                Made by: Dzoki & Dixie (TravianX)                                 //
//                              - TravianX = Travian Clone Project -                                //
//                                 DO NOT REMOVE COPYRIGHT NOTICE!                                  //
//////////////////////////////////////////////////////////////////////////////////////////////////////
?>
<p>
Thanks for installing TravianZ.
<h4>Please remove/rename the installation folder.</h4>
All the files are placed. The database is created, so you can now start playing on your own Travian.
</p>

<?php include("../GameEngine/config.php"); 
$time = time();
rename("../install/","../installed_".$time);
?>
<p>
<center><font size="4"><a href="<?php echo HOMEPAGE; ?>">> My TravianZ homepage <</font></a></center>
</p>
</div>
