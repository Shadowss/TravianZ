<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       resetServer.tpl                                             ##
##  Developed by:  Ronix                                                       ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2012-2014. All rights reserved.                ##
##                                                                             ##
#################################################################################
?>
<form action="" method="post">
<table id="member">
    <thead>
        <tr>
            <th colspan="2">Server Resetting</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td colspan="2" id="txtreset">
                <br>
                This server will be reset to create new game server.<br>Click button Reset to proceed..<br>&nbsp;
            </td>
        </tr>
    </tbody>
    <thead>
        <tr id="hideobj">
            <td style="border-right:none; text-align:left"><input name="back" type="button" src="img/x.gif" value="<< back" alt="back" onclick="go_url('../Admin/admin.php')" /></td>
            <td style="border-left:none; text-align:right"><input name="reset" type="button" src="img/x.gif" value="Reset" alt="Reset" onclick="go_proceed()" /></td>
        </tr>
    </thead>    
</table>
</form>
<script type="text/javascript">
    function go_proceed() {
        document.getElementById("txtreset").innerHTML = '<br><center>Please wait..while the server was reset</center><br>&nbsp;';
        document.getElementById("hideobj").innerHTML = '';
        location="Templates/resetServer.php";
    }
</script>
