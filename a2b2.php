<?php
include_once("GameEngine/Generator.php");
$start_timer = $generator->pageLoadTimeStart();

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Project:        TravianZ                                                   ##
##  Version:        18.05.2026                                                 ##
##  Filename:       a2b2.php                                                   ##
##  Developed by:   Dzoki		                                               ##
##  Refactored by:  Shadow                                                     ##
##  License:        TravianZ Project                                           ##
##  Copyright:      TravianZ (c) 2010-2026. All rights reserved.               ##
##  URLs:           https://travianz.org                                       ##
##                  https://github.com/Shadowss/TravianZ                       ##
##                                                                             ##
#################################################################################

use App\Utils\AccessLogger;
include_once("GameEngine/Village.php");
AccessLogger::logRequest();

$uid = (int)$session->uid;
$amount = (int)($_SESSION['amount'] ?? 0);

$packages = [
    199  => 60,
    499  => 120,
    999  => 360,
    1999 => 1000,
    4999 => 2000
];

if (isset($_GET['newdid'])) {
    $_SESSION['wid'] = (int)$_GET['newdid'];
    header("Location: a2b2.php");
    exit;
}

$building->procBuild($_GET);

$transactionProcessed = false;
$oldBalance = 0;
$newBalance = 0;
$goldAdded = 0;

if (isset($packages[$amount]) && $amount > 0) {
    $goldAdded = $packages[$amount];

    $result = mysqli_query($database->dblink, "SELECT gold FROM " . TB_PREFIX . "users WHERE id = $uid LIMIT 1");
    $user = mysqli_fetch_assoc($result);
    $oldBalance = (int)$user['gold'];

    mysqli_query($database->dblink, "UPDATE " . TB_PREFIX . "users SET gold = gold + $goldAdded WHERE id = $uid");

    $result = mysqli_query($database->dblink, "SELECT gold FROM " . TB_PREFIX . "users WHERE id = $uid LIMIT 1");
    $user = mysqli_fetch_assoc($result);
    $newBalance = (int)$user['gold'];

    $transactionProcessed = true;
    $_SESSION['amount'] = 0;
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <title><?php echo SERVER_NAME . ' - Account transactions'; ?></title>
    <link rel="shortcut icon" href="favicon.ico"/>
    <meta http-equiv="cache-control" content="max-age=0" />
    <meta http-equiv="pragma" content="no-cache" />
    <meta http-equiv="expires" content="0" />
    <meta http-equiv="imagetoolbar" content="no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <script src="mt-full.js?0faab" type="text/javascript"></script>
    <script src="unx.js?f4b7h" type="text/javascript"></script>
    <script src="new.js?0faab" type="text/javascript"></script>
    <link href="<?php echo GP_LOCATE; ?>lang/en/lang.css?f4b7d" rel="stylesheet" type="text/css" />
    <link href="<?php echo GP_LOCATE; ?>lang/en/compact.css?f4b7i" rel="stylesheet" type="text/css" />

    <?php
    if ($session->gpack == null || GP_ENABLE == false) {
        echo '<link href="' . GP_LOCATE . 'travian.css?e21d2" rel="stylesheet" type="text/css" />';
        echo '<link href="' . GP_LOCATE . 'lang/en/lang.css?e21d2" rel="stylesheet" type="text/css" />';
    } else {
        echo '<link href="' . $session->gpack . 'travian.css?e21d2" rel="stylesheet" type="text/css" />';
        echo '<link href="' . $session->gpack . 'lang/en/lang.css?e21d2" rel="stylesheet" type="text/css" />';
    }
    ?>
    <script type="text/javascript">window.addEvent('domready', start);</script>
</head>
<body class="v35">

<div class="wrapper">
    <img style="filter:chroma();" src="img/x.gif" id="msfilter" alt="" />
    <div id="dynamic_header"></div>

    <?php include("Templates/header.tpl"); ?>

    <div id="mid">
        <?php include("Templates/menu.tpl"); ?>
        <?php include("Templates/Plus/pmenu.tpl"); ?>

        <h1>Account transactions</h1>
        
        <div id="products">
            <?php if ($transactionProcessed) { ?>
                <!-- Partea de mulțumire după plată -->
                <p>Thank you for your purchase here at <?php echo SERVER_NAME; ?>.</p>
                <p>Below you see the entry record. Out of it, you can observe your old as well as your new account balance.</p>
                
                <table class="plusFunctions" cellpadding="1" cellspacing="1">
                <thead>
                <tr><th colspan="5" height="20">Record of <?php echo date('d.m.Y'); ?></th></tr>
                <tr>
                    <td align="center">Description</td>
                    <td align="center"><img src="img/x.gif" class="gold" alt="Gold" title="Gold" /></td>
                    <td align="center">Action</td>
                    <td align="center"><img src="img/x.gif" class="gold" alt="Gold" title="Gold" /></td>
                    <td align="center">Date</td>
                </tr>
                </thead>
                <tbody>
                <!-- tabelul cu old / package / new balance -->
                <tr>
                    <td class="desc"><b>&nbsp;&nbsp;Account Balance (old)</b></td>
                    <td class="desc"><div style="text-align:center"><?php echo $oldBalance; ?></div></td>
                    <td class="desc"><div style="text-align:center">&nbsp;</div></td>
                    <td class="desc"><div style="text-align:center">&nbsp;</div></td>
                    <td class="act"><div style="text-align:center">&nbsp;</div></td>
                </tr>
                <tr>
                    <td class="desc"><div style="text-align:center">&nbsp;</div></td>
                    <td class="desc"><div style="text-align:center">&nbsp;</div></td>
                    <td class="desc"><div style="text-align:center"><b><font color="#71D000">Package</font></b></div></td>
                    <td class="desc"><div style="text-align:center"><?php echo $goldAdded; ?> Gold</div></td>
                    <td class="act"><div style="text-align:center">&nbsp;</div></td>
                </tr>
                <tr>
                    <td class="desc"><b>&nbsp;&nbsp;Account Balance (new)</b></td>
                    <td class="desc"><div style="text-align:center">&nbsp;</div></td>
                    <td class="desc"><div style="text-align:center">&nbsp;</div></td>
                    <td class="desc"><div style="text-align:center"><?php echo $newBalance; ?></div></td>
                    <td class="act"><div style="text-align:center"><?php echo date('d.m.Y H:i:s'); ?></div></td>
                </tr>
                </tbody>
                </table>

                <p>Please verify the information.<br>It will let us know if the data is incorrect.</p>
                <p>Please mail your username, package, order time and email used to 
                <a href="mailto:<?php echo defined('PAYPAL_EMAIL') ? PAYPAL_EMAIL : 'novgorodschi@icloud.com'; ?>">our billing address</a>.</p>

            <?php } else { ?>
                <!-- Partea cu istoricul normal -->
                <?php
                $result = mysqli_query($database->dblink, "SELECT gold FROM ".TB_PREFIX."users WHERE id = $uid LIMIT 1");
                $golds = mysqli_fetch_assoc($result);

                $stats = mysqli_fetch_assoc(mysqli_query($database->dblink, "
                    SELECT 
                        SUM(CASE WHEN gold > 0 THEN gold ELSE 0 END) as received,
                        SUM(CASE WHEN gold < 0 THEN -gold ELSE 0 END) as spent 
                    FROM ".TB_PREFIX."gold_fin_log WHERE uid = $uid
                "));

                $received = (int)($stats['received'] ?? 0);
                $spent    = (int)($stats['spent'] ?? 0);
                ?>
                <p>Here you can see your current account statement.</p>
                <p>Current balance: <img src="img/x.gif" class="gold" alt="Gold" /> <b><?php echo (int)$golds['gold']; ?></b>
                &nbsp; | &nbsp; Total received: <b style="color:#71D000;">+<?php echo $received; ?></b>
                &nbsp; | &nbsp; Total spent: <b style="color:#FF6F0F;">-<?php echo $spent; ?></b></p>

                <!-- Tabelul cu istoricul (codul tău complet) -->
                <table class="plusFunctions" cellpadding="1" cellspacing="1">
				    <thead>
				<tr>
				<th colspan="6" height="20">Gold history</th>
				</tr>
				<tr>
				<td align="center">Date & Time</td>
				<td align="center">Village</td>
				<td align="center">Action</td>
				<td align="center">Details</td>
				<td align="center">
				<img src="img/x.gif" class="gold" alt="Gold" title="Gold" />
				</td>
				<td align="center">Balance</td>
				</tr>
				</thead>
				 <!-- AICI INCEPE PROBLEMA -->
				   <tbody>
    <?php
    $q = mysqli_query(
        $database->dblink,
        "SELECT l.*, v.name as vname
         FROM ".TB_PREFIX."gold_fin_log l
         LEFT JOIN ".TB_PREFIX."vdata v ON v.wref = l.wid
         WHERE l.uid = $uid
         ORDER BY l.time DESC
         LIMIT 200"
    );

    $balance = (int)$golds['gold'];

    if (mysqli_num_rows($q) > 0) {
        while ($r = mysqli_fetch_assoc($q)) {
            $date = date('d.m.Y H:i:s', $r['time']);
            $villageName = !empty($r['vname']) ? htmlspecialchars($r['vname'], ENT_QUOTES, 'UTF-8') : '-';
            $action = htmlspecialchars($r['action'], ENT_QUOTES, 'UTF-8');
            $details = htmlspecialchars(($r['details'] ?? ''), ENT_QUOTES, 'UTF-8');
            $gold = (int)$r['gold'];

            if (stripos($details, 'Mass gift') !== false) {
                $action = 'Admin Gift (All)';
                $details = str_replace('Mass gift by ', 'by ', $details);
            } elseif (stripos($details, 'gift by') !== false) {
                $action = 'Admin Gift';
            }

            $color = $gold < 0 ? '#FF6F0F' : '#71D000';
            $sign = $gold > 0 ? '+' : '';

            echo '<tr>';
            echo '<td class="desc"><div style="text-align:center">'.$date.'</div></td>';
            echo '<td class="desc"><div style="text-align:center">'.$villageName.'</div></td>';
            echo '<td class="desc"><div style="text-align:center"><b>'.$action.'</b></div></td>';
            echo '<td class="desc"><div style="text-align:center"><span style="color:#666;font-size:11px">'.$details.'</span></div></td>';
            echo '<td class="desc"><div style="text-align:center"><font color="'.$color.'"><b>'.$sign.$gold.'</b></font></div></td>';
            echo '<td class="act"><div style="text-align:center">'.$balance.'</div></td>';
            echo '</tr>';

            $balance -= $gold;
        }
    } else {
        echo '
        <tr>
            <td colspan="6" class="desc">
                <div style="text-align:center;padding:8px;">
                    No transactions yet.
                </div>
            </td>
        </tr>';
    }
    ?>
    </tbody>
                <!-- AICI SE TERMINA PROBLEMA -->
                </table>

                <p>Please verify the information.<br>It will let us know if the data is incorrect.</p>
                <p>Please mail your username, package, order time and email used to 
                <a href="mailto:<?php echo defined('PAYPAL_EMAIL') ? PAYPAL_EMAIL : 'cata7007@gmail.com'; ?>">our billing address</a>.</p>
            <?php } ?>
        </div> <!-- #products -->
    </div> <!-- #mid -->

    <br /><br /><br /><br />

    <div id="side_info">
        <?php
        include("Templates/multivillage.tpl");
        include("Templates/quest.tpl");
        include("Templates/news.tpl");
        if (!NEW_FUNCTIONS_DISPLAY_LINKS) {
            echo "<br><br><br><br>";
            include("Templates/links.tpl");
        }
        ?>
    </div>

    <div class="clear"></div>
</div> <!-- .wrapper -->

<div class="footer-stopper"></div>
<div class="clear"></div>

<?php
include("Templates/footer.tpl");
include("Templates/res.tpl");     // ← foarte important aici
?>

<div id="stime">
    <div id="ltime">
        <div id="ltimeWrap">
            <?php echo CALCULATED_IN; ?> <b><?php echo round(($generator->pageLoadTimeEnd() - $start_timer) * 1000); ?></b> ms
            <br /><?php echo SERVER_TIME; ?> <span id="tp1" class="b"><?php echo date('H:i:s'); ?></span>
        </div>
    </div>
</div>

<div id="ce"></div>
</body>
</html>