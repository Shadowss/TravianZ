<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
    <head>

  <link REL="shortcut icon" HREF="favicon.ico"/>

    <title><?php

    if($_SESSION['access'] == ADMIN) {
        echo 'Admin Control Panel - TravianX';
    } else
        if($_SESSION['access'] == MULTIHUNTER) {
            echo 'Multihunter Control Panel - TravianX';
        }

?></title>    

    <link rel=stylesheet type="text/css" href="../img/admin/admin.css">

    <link rel=stylesheet type="text/css" href="../img/admin/acp.css">

    <link rel=stylesheet type="text/css" href="../img/../img.css">

        <script src="mt-full.js?423cb"  type="text/javascript"></script>

    <script src="ajax.js" type="text/javascript"></script>



    <meta http-equiv="content-type" content="text/html; charset=UTF-8">

    <meta http-equiv="imagetoolbar" content="no">

</head>
<?php

    #################################################################################
    ##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
    ## --------------------------------------------------------------------------- ##
    ##  Filename       login_log.tpl                                               ##
    ##  Developed by:  Dzoki                                                       ##
    ##  License:       TravianX Project                                            ##
    ##  Copyright:     TravianX (c) 2010-2011. All rights reserved.                ##
    ##                                                                             ##
    #################################################################################

    if($_SESSION['access'] < ADMIN) die("Access Denied: You are not Admin!");

?>
<br>

<table cellpadding="1" cellspacing="1" id="member">
    <thead>
                <tr>
                    <th colspan="4">User login log</th>
                </tr>
                
        <tr><td>ID</td><td>Username</td><td>IP</td><td>Time</td></tr>
        </thead><tbody>
        
<?php

    $no = count($database->getLoginLog());
    $log = $database->getLoginLog();
    for ($i = 0; $i < $no; $i++) {
        $userid = $log[$i]['uid'];
        $username = $database->getUserField($userid, "username", 0);
        echo "<tr>";
        echo "<td>".$log[$i]['id']."</td>";
        echo "<td><a href=\"admin.php?p=player&uid=".$userid."\">".$username."</a>";
        echo "<td>".$log[$i]['ip']."</td>";
        echo "<td>".date("d.m.Y H:i", $log[$i]['time'])."</td>";
        echo "</tr>";
    }
    echo "</tbody></table>\n";

?>
