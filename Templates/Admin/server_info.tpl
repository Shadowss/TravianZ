<?php 
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       server_info.tpl                                             ##
##  Developed by:  Dzoki                                                       ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2011. All rights reserved.                ##
##                                                                             ##
#################################################################################
?>
<?php
$tribe1 = mysql_query("SELECT SQL_CACHE * FROM ".TB_PREFIX."users WHERE tribe = 1");
$tribe2 = mysql_query("SELECT SQL_CACHE * FROM ".TB_PREFIX."users WHERE tribe = 2");
$tribe3 = mysql_query("SELECT SQL_CACHE * FROM ".TB_PREFIX."users WHERE tribe = 3");
$tribes = Array(mysql_num_rows($tribe1),mysql_num_rows($tribe2),mysql_num_rows($tribe3));
$users = mysql_num_rows(mysql_query("SELECT SQL_CACHE * FROM ".TB_PREFIX."users")) - 1;
?>

<br /><br />
    <table id="profile">
        <thead>
         <tr><th colspan="2">Player Information</th></tr>
         </thead>
         <tbody>
         
		 <tr>
		 <td>Registered players</td>
         <td><?php
				echo $users;
				?>
				</td>
         </tr>
		 
		 
         <tr>
          <td>Active players</td>
          <td><?php


    $result = mysql_query("SELECT SQL_CACHE * FROM ".TB_PREFIX."active");
    $num_rows = mysql_num_rows($result);

    echo $num_rows;

    ?>
	
    </td>
         </tr>
         <tr>
          <td>Players online</td>
          <td><?php
          $t =time();
          $result = mysql_query(
          "SELECT SQL_CACHE * FROM ".TB_PREFIX."users WHERE ".$t." - timestamp < 300") or die(mysql_error());;
          $num_rows = mysql_num_rows($result);
          
          echo $num_rows;
          
          ?>
          </td>
         </tr>
		 
		 <tr>
          <td>Players Banned</td>
          <td><?php


    $result = mysql_query("SELECT SQL_CACHE * FROM ".TB_PREFIX."users WHERE access = 0");
    $num_rows = mysql_num_rows($result);

    echo $num_rows;

    ?>
          </td>
         </tr>
		  <tr>
          <td>Villages settled</td>
          <td><?php


    $result = mysql_query("SELECT SQL_CACHE * FROM ".TB_PREFIX."vdata");
    $num_rows = mysql_num_rows($result);

    echo $num_rows;

    ?>
          </td>
         </tr>
        </tbody>
       </table>
<br />
      <table id="profile">
        <thead>
         <tr><th colspan="3">Player Information</th></tr>
		 <td class="b">Tribe</td>
		 <td class="b">Registered</td>
		 <td class="b">Percent</td>
         </thead>
         <tbody>
         <tr>
          <td>Romans</td>
          <td><?php


    echo $tribes[0];

    ?>
    </td>
          <td><?php


$percents = 100*($tribes[0] / $users);
echo $percents = intval ($percents);
echo "%";
      ?></td>
         </tr>
         <tr>
          <td>Teutons</td>
          <td><?php


    echo $tribes[1];

    ?>
    </td>
          <td><?php



$percents = 100*($tribes[1] / $users);
echo $percents = intval ($percents);
echo "%";
      ?>
          </td>
         </tr>
         <tr>
          <td>Gauls</td>
          <td><?php


    echo $tribes[2];


    ?></td>
          <td><?php


$percents = 100*($tribes[2] / $users);
echo $percents = intval ($percents);
echo "%";
      ?></td>
         </tr>
        </tbody>
       </table>
	   
	<div>