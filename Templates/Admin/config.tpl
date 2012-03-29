<?php 
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       config.tpl                                                  ##
##  Developed by:  Dzoki                                                       ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2011. All rights reserved.                ##
##                                                                             ##
#################################################################################
?>
<?php
mysql_connect(SQL_SERVER, SQL_USER, SQL_PASS);

mysql_select_db(SQL_DB);

if ($_SESSON['access'] == MULTIHUNTER) die("<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><b><font color='Red'><center>Access Denied: You are not admin</b></font></center>");

?>
<style>
.del {width:12px; height:12px; background-image: url(img/admin/icon/del.gif);} 
</style>  
<h2><center>Made by Dzoki</center></h2>
<table id="member">
  <thead>
    <tr>
        <th>~ Server Settings ~</th>
    </tr>
  </thead> 

</table>
<table id="profile">    
    <tr>
        <td class="b">Variable</td>
        <td class="b">Value</td> 
    </tr> 
    <tr>
        <td>Server Name</td>
        <td><?php echo SERVER_NAME;?></td>    
    </tr> 
 <tr>

        <td>Server Started</td>

        <td><?php echo date("d.m.y H:i",COMMENCE);?></td>   

    </tr>  
    <tr>
        <td>Language</td>
        <td><?php if(LANG == en){
				echo "English";
				} ?></td>  
    </tr>  
    <tr>  
        <td>Server Speed</td>
        <td><?php echo ''.SPEED.'x';?></td>    
    </tr>  
    <tr>
        <td>Map Size</td>
        <td><?php echo WORLD_MAX;?>x<?php echo WORLD_MAX;?></td>    
    </tr>  
	<tr>
        <td>Troop Speed</td>
        <td><?php echo INCREASE_SPEED;?>x</td>    
    </tr> 
		<tr>

        <td>Village Expanding Speed</td>

        <td><?php if(CP == 0){
				echo "Fast";
				}
				else if(CP == 1){
				echo "Slow";
				} ?></td> 

    </tr>   
    <tr>

        <td>Beginners Protection</td>

        <td><?php echo (PROTECTION/3600);?> hour/s</td> 

    </tr>    	
	<tr>

        <td>Activation Mail</td>

        <td><?php if(AUTH_EMAIL == true) {
				echo "<b><font color='Green'>Enabled</font></b>";
				}
				else if(AUTH_EMAIL == false){
				echo "<b><font color='Red'>Disabled</font></b>"; 
				}
				?></td> 
				

    </tr> 
	<tr>

        <td>Quest</td>

        <td><?php 
                if(QUEST == true) {
                echo "<b><font color='Green'>Enabled</font></b>";
                }
                else if(QUEST == false) {
                echo "<b><font color='Red'>Disabled</font></b>";
                } ?></td> 

    </tr>    
	
	<tr>

        <td>Demolish - Level required</td>

        <td><?php echo DEMOLISH_LEVEL_REQ; ?></td> 

    </tr>  
	
	<tr>

        <td>World Wonder - Statistics</td>

        <td><?php 
                if(WW == true) {
                echo "<b><font color='Green'>Enabled</font></b>";
                }
                else if(WW == false) {
                echo "<b><font color='Red'>Disabled</font></b>";
                } ?></td> 

    </tr>  
	<tr>

        <td><b><font color='#71D000'>P</font><font color='#FF6F0F'>l</font><font color='#71D000'>u</font><font color='#FF6F0F'>s</font></b> account duration</td>

        <td><?php if(PLUS_TIME >= 86400){
			echo ''.(PLUS_TIME/86400).' Days';
			} else if(PLUS_TIME < 86400){
			echo ''.(PLUS_TIME/3600).' Hours';
			} ?></td> 

    </tr>  
	
	<tr>

        <td>+25% production duration</td>

        <td><?php if(PLUS_PRODUCTION >= 86400){
			echo ''.(PLUS_PRODUCTION/86400).' Days';
			} else if(PLUS_PRODUCTION < 86400){
			echo ''.(PLUS_PRODUCTION/3600).' Hours';
			} ?></td> 

    </tr>  
	</table>
	
<table id="member">
  <thead>
    <tr>
        <th>~ Log Settings ~</th>
    </tr>
  </thead>
</table>  
  
  <table id="profile">  
  <tr>
        <td class="b">Variable</td>
        <td class="b">Value</td> 
    </tr> 
    <tr>
        <td>Log Build</td>
        <td><?php if(LOG_BUILD == true) {
				echo "<b><font color='Green'>Enabled</font></b>";
				}
				else if(LOG_BUILD == false){
				echo "<b><font color='Red'>Disabled</font></b>"; 
				}
				?></td> 
    </tr>    
    <tr>
        <td>Log Technology</td>
        <td><?php if(LOG_TECH == true) {
				echo "<b><font color='Green'>Enabled</font></b>";
				}
				else if(LOG_TECH == false){
				echo "<b><font color='Red'>Disabled</font></b>"; 
				}
				?></td> 
    </tr>    
    <tr>
        <td>Log Login</td>
        <td><?php if(LOG_LOGIN == true) {
				echo "<b><font color='Green'>Enabled</font></b>";
				}
				else if(LOG_LOGIN == false){
				echo "<b><font color='Red'>Disabled</font></b>"; 
				}
				?></td> 
    </tr>    
    <tr>
        <td>Log Gold</td>
        <td><?php if(LOG_GOLD_FIN == true) {
				echo "<b><font color='Green'>Enabled</font></b>";
				}
				else if(ALOG_GOLD_FIN == false){
				echo "<b><font color='Red'>Disabled</font></b>"; 
				}
				?></td> 
    </tr>    
    <tr>
        <td>Log Admin</td>
        <td><?php if(LOG_ADMIN == true) {
				echo "<b><font color='Green'>Enabled</font></b>";
				}
				else if(LOG_ADMIN == false){
				echo "<b><font color='Red'>Disabled</font></b>"; 
				}
				?></td> 
    </tr>     
    <tr>
        <td>Log War</td>
        <td><?php if(LOG_WAR == true) {
				echo "<b><font color='Green'>Enabled</font></b>";
				}
				else if(LOG_WAR == false){
				echo "<b><font color='Red'>Disabled</font></b>"; 
				}
				?></td> 
    </tr>     
    <tr>
        <td>Log Market</td>
        <td><?php if(LOG_MARKET == true) {
				echo "<b><font color='Green'>Enabled</font></b>";
				}
				else if(LOG_MARKET == false){
				echo "<b><font color='Red'>Disabled</font></b>"; 
				}
				?></td> 
    </tr>     
    <tr>
        <td>Log Illegal</td>
        <td><?php if(LOG_ILLEGAL == true) {
				echo "<b><font color='Green'>Enabled</font></b>";
				}
				else if(LOG_ILLEGAL == false){
				echo "<b><font color='Red'>Disabled</font></b>"; 
				}
				?></td> 
    </tr>     
       	</table>
	
<table id="member">
  <thead>
    <tr>
        <th>~ Newsbox Settings ~</th>
    </tr>
  </thead>
</table>  
  
  <table id="profile">  
  <tr>
        <td class="b">Variable</td>
        <td class="b">Value</td> 
    </tr> 
	
	<tr>
		
		<td>Newsbox 1</td>
		
		<td><?php if(NEWSBOX1 == true){
				echo "<b><font color='Green'>Enabled</font></b>";
				}
				else if(NEWSBOX1 == false){
				echo "<b><font color='Red'>Disabled</font></b>";
				} ?> </td>
				
	</tr>
	<tr>
		
		<td>Newsbox 2</td>
		
		<td><?php if(NEWSBOX2 == true){
				echo "<b><font color='Green'>Enabled</font></b>";
				}
				else if(NEWSBOX2 == false){
				echo "<b><font color='Red'>Disabled</font></b>";
				} ?> </td>
				
	</tr>
	<tr>
		
		<td>Newsbox 3</td>
		
		<td><?php if(NEWSBOX3 == true){
				echo "<b><font color='Green'>Enabled</font></b>";
				}
				else if(NEWSBOX3 == false){
				echo "<b><font color='Red'>Disabled</font></b>";
				} ?> </td>
				
	</tr>
	
	<td>Home 1</td>
		
		<td><?php if(HOME1 == true){
				echo "<b><font color='Green'>Enabled</font></b>";
				}
				else if(HOME1 == false){
				echo "<b><font color='Red'>Disabled</font></b>";
				} ?> </td>
				
	</tr>
	
	<td>Home 2</td>
		
		<td><?php if(HOME2 == true){
				echo "<b><font color='Green'>Enabled</font></b>";
				}
				else if(HOME2 == false){
				echo "<b><font color='Red'>Disabled</font></b>";
				} ?> </td>
				
	</tr>
	
	<td>Home 3</td>
		
		<td><?php if(HOME3 == true){
				echo "<b><font color='Green'>Enabled</font></b>";
				}
				else if(HOME3 == false){
				echo "<b><font color='Red'>Disabled</font></b>";
				} ?> </td>
				
	</tr>
  </table>
	
<table id="member">
  <thead>
    <tr>
        <th>~ SQL Settings ~</th>
    </tr>
  </thead>
<table id="profile">  
  <tr>
        <td class="b">Variable</td>
        <td class="b">Value</td> 
    </tr> 
    <tr>
        <td>Hostname</td>
        <td><?php echo SQL_SERVER;?></td> 
    </tr>    
	<tr>
        <td>DB Username</td>
        <td><?php echo SQL_USER;?></td> 
    </tr>  
	<tr>
        <td>DB Password</td>
        <td>*********</td> 
    </tr>  
	<tr>
        <td>DB Name</td>
        <td><?php echo SQL_DB;?></td> 
    </tr>  
	<tr>
        <td>Table Prefix</td>
        <td><?php echo TB_PREFIX;?></td> 
    </tr> 
	<tr>
        <td>DB Type</td>
        <td><?php 
                if(DB_TYPE == 0) {
                echo "MYSQL";
                }
                else if(DB_TYPE == 1) {
                echo "MYSQLi";
                } ?></td> 
    </tr> 
	</table>
	
<table id="member">

  <thead>

    <tr>

        <th>~ Extra Settings ~</th>

    </tr>

  </thead>

<table id="profile">  

  <tr>

        <td class="b">Variable</td>

        <td class="b">Value</td> 

    </tr> 

    <tr>

        <td>Limit Mailbox</td>

        <td><?php if(LIMIT_MAILBOX == true){
				echo "<b><font color='Green'>Enabled</font></b>";
				}
				else if(LIMIT_MAILBOX == false){
				echo "<b><font color='Red'>Disabled</font></b>";
				} ?></td> 

    </tr>    
	<tr>

        <td>Max number of mails</td>

        <td><?php if(LIMIT_MAILBOX == true){
				echo MAX_MAIL;
				}
				else if(LIMIT_MAILBOX == false){
				echo "<font color='Gray'>Limit mailbox disabled</font>";
				} ?></td> 

    </tr>    
	<tr>

        <td>Include Admin in rank</td>

        <td><?php if(INCLUDE_ADMIN == true){
				echo "<b><font color='Green'>Enabled</font></b>";
				}
				else if(INCLUDE_ADMIN == false){
				echo "<b><font color='Red'>Disabled</font></b>";
				} ?></td> 

    </tr>    
	</table>
	
	<table id="member">

  <thead>

    <tr>

        <th>~ Admin Information ~</th>

    </tr>

  </thead>

<table id="profile">  

  <tr>

        <td class="b">Variable</td>

        <td class="b">Value</td> 

    </tr> 

    <tr>

        <td>Admin Email</td>

        <td><?php if(ADMIN_EMAIL == ''){
				echo "<b><font color='Red'>No admin email defined!</b></font>";
				}
				else if(ADMIN_EMAIL != ''){
				echo ADMIN_EMAIL;
				} ?></td> 

    </tr>  
	 <tr>

        <td>Admin Name</td>

        <td><?php if(ADMIN_NAME == ''){
				echo "<b><font color='Red'>No admin name defined!</b></font>";
				}
				else if(ADMIN_NAME != ''){
				echo ADMIN_NAME;
				} ?></td> 

    </tr>  
</table>	
	
<?php

function define_array( $array, $keys = NULL )
{
    foreach( $array as $key => $value )
    {
        $keyname = ($keys ? $keys . "_" : "") . $key;
        if( is_array( $array[$key] ) )
            define_array( $array[$key], $keyname );
        else
            define( $keyname, $value );
    }
}

//define_array($array);

?>
