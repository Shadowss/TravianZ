<?php

#################################################################################

## -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =- ##

## --------------------------------------------------------------------------- ##

## Filename natarend.php ##

## Developed by: advocaite ##

## License: TravianX Project ##

## Copyright: TravianX (c) 2010-2011. All rights reserved. ##

## ##

#################################################################################



if($_SESSION['access'] < ADMIN) die("Access Denied: You are not Admin!");



?>

<?php $id = $_SESSION['id']; ?>

<form action="../GameEngine/Admin/Mods/natarend.php" method="POST">

<input type="hidden" name="id" id="id" value="<?php echo $id; ?>">

<br /><br /><br /><br /><br /><br /><br /><br /><br />

<center><b>Create World Wonder villages?</b></center>

<center><br /><input class="give_gold" name="vill_amount" id="vill_amount" value="20" maxlength="4">&nbsp;<font color="gray" size="1">insert number of Wonders and press 'enter'</center></form>

<?php

if(isset($_GET['g'])) {



          echo '<br /><br /><font color="Red"><b>World Wonders Added</font></b>';

          }

?>