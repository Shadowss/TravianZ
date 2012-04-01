<?php
#################################################################################
##                                                                             ##
##              -= YOU MUST NOT REMOVE OR CHANGE THIS NOTICE =-                ##
##                                                                             ##
## --------------------------------------------------------------------------- ##
##                                                                             ##
##  Project:       ZravianX                                                    ##
##  Version:       2011.11.13                                                  ##
##  Filename:      Templates/Admin/homenews.tpl                                ##
##  Developed by:  Mauroalt                                                    ##
##  Reworked by:   ZZJHONS                                                     ##
##  License:       Creative Commons BY-NC-SA 3.0                               ##
##  Copyright:     ZravianX (c) 2011 - All rights reserved                     ##
##  URLs:          http://zravianx.zzjhons.com                                 ##
##  Source code:   http://www.github.com/ZZJHONS/ZravianX                      ##
##                                                                             ##
#################################################################################
?>
<form action="" method="POST">
    <input name="action" type="hidden" value="addBan">
    <table width="504" cellpadding="1" cellspacing="1" id="member">
		<thead>
            <tr>
                <th height="21" colspan="2" valign="top">Home News Editor</th>
            </tr>
		</thead>
        <tbody>
            <tr>
                <td width="222" height="24"><strong>Home News:</strong></td>
                <td width="271" valign="top">
                    <center>
                        <font size=4>Home 1<input type="radio" name="n" value="1" checked="checked"/> Home 2<input type="radio" name="n" value="2"/> Home 3<input type="radio" name="n" value="3"/></font>
                    </center>
                </td>
            </tr>
            <tr>
                <td height="165"><strong>Text(HTML):</strong></td>
                <td valign="top">
                    <center>
                        <textarea name="txt" cols="60" rows="20"></textarea>
                    </center>
                </td>
            </tr>
            <tr>
                <td height="26" valign="top" class="on">
                    <center>
                        <input name="submit" type="reset" value="Reset" />
                    </center>
                </td>
                <td valign="top">
                    <center>
                        <input type="submit" value="Submit">
                    </center>
                </td>
            </tr>
        </tbody>
	</table>
    <br />
    <br />
</form>
<center><h1>Press submit to clear only<br />Otherwise enter the text</h1></center>
<?php
	$ti=$_POST['n'];
	$text=$_POST['txt'];
	$delete=$_POST['delete'];

	if ($ti or $text or $delete){

        if (!$text){
            unlink ('Templates/News/home/home'.$ti.'.tpl');
            $f=fopen('Templates/News/home/home'.$ti.'.tpl','w+');
            fwrite($f,$st,$text);
            exit;
        }
        
        unlink ('Templates/News/home/home'.$ti.'.tpl');
        $f=fopen('Templates/News/home/home'.$ti.'.tpl','w+');
        fwrite($f,'<div class="news">'.$text.'</div>');
        echo '<center><font size=5>Newsbox edited correctly</font>';
        include ("Templates/News/home/home".$ti.".tpl");
        echo '</center>';
	}
?>
