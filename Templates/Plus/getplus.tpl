<?php

#################################################################################
##                -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-               ##
## --------------------------------------------------------------------------- ##
##  Filename       : getplus.tpl                                               ##
##  Type           : Plus - Purchase Prompt                                    ##
## --------------------------------------------------------------------------- ##
##  Developed by   : Shadow                                                    ##
## --------------------------------------------------------------------------- ##
##  Contact        : cata7007@gmail.com                                        ##
##  Project        : TravianZ                                                  ##
##  URLs:          : https://travianz.org                                      ##
##  GitHub         : https://github.com/Shadowss/TravianZ                      ##
## --------------------------------------------------------------------------- ##
##  License        : TravianZ Project                                          ##
##  Copyright      : TravianZ (c) 2010-2026. All rights reserved.              ##
## --------------------------------------------------------------------------- ##
#################################################################################

include("Templates/Plus/pmenu.tpl");

$uid = (int)$session->uid;
$plusTime = 604800; // 7 zile

echo '<br><div align="center"><h2>Get <font color="#71D000">P</font><font color="#FF6F0F">l</font><font color="#71D000">u</font><font color="#FF6F0F">s</font></h2>';
echo 'Exchange gold for Plus features. All actions are logged.</div><br>';

if(empty($_POST['plus'])) {
?>
<form method="POST">
<table width="300" align="center">
<tr><td><b><?= $session->username ?></b> – Gold: <?= $session->gold ?></td></tr>
<tr><td align="center"><b><?php echo TZ_SELECT_REWARD_2; ?></b>
    <select name="reward" required>
        <option value=""><?php echo TZ_SELECT_REWARD; ?></option>
        <option value="plus"><?php echo TZ_VIP_ACCOUNT_10_GOLD_7_DAYS; ?></option>
        <option value="b1"><?php echo TZ_LUMBER_25_5_GOLD; ?></option>
        <option value="b2"><?php echo TZ_CLAY_25_5_GOLD; ?></option>
        <option value="b3"><?php echo TZ_IRON_25_5_GOLD; ?></option>
        <option value="b4"><?php echo TZ_CROP_25_5_GOLD; ?></option>
    </select><br><br>
    <input type="submit" name="plus" value="Get Now">
</td></tr>
</table>
</form>
<?php
} else {

    /**
     * PERMISIUNI SITTER: aici se cumpara Plus si bonusurile de productie.
     *
     * Acest sablon nu avea NICIO verificare de sitter - spre deosebire de
     * 8/9/10/11/12/15.tpl, care aveau (chiar daca pe un flag nesigur). Un
     * sitter putea cheltui aurul proprietarului de aici, oricat.
     */
    if (isset($session) && method_exists($session, 'sitterCan')
        && !$session->sitterCan(SITTER_PERM_GOLD)) {

        die('<div align="center"><font color="red"><b>'
            . (defined('SITTER_P_DENIED') ? SITTER_P_DENIED
               : 'Your sitter permissions do not allow this action.')
            . '</b></font><br><button onclick="history.back()">' . BACK . '</button></div>');
    }

    $reward = $_POST['reward'] ?? '';
    
    // whitelist
    $map = [
        'plus' => ['field'=>'plus','cost'=>10],
        'b1'   => ['field'=>'b1','cost'=>5],
        'b2'   => ['field'=>'b2','cost'=>5],
        'b3'   => ['field'=>'b3','cost'=>5],
        'b4'   => ['field'=>'b4','cost'=>5],
    ];
    
    if(!isset($map[$reward])) {
        die('<b>ERROR:</b> Invalid reward. <button onclick="history.back()">'.BACK.'</button>');
    }
    
    $field = $map[$reward]['field'];
    $cost = $map[$reward]['cost'];
    $now = time();
    
    // 1. scade gold ATOMIC – doar dacă ai suficient
    $goldUpd = mysqli_query($database->dblink,
        "UPDATE ".TB_PREFIX."users SET gold = gold - $cost 
         WHERE id = $uid AND gold >= $cost"
    );
    
    if(mysqli_affected_rows($database->dblink) != 1) {
        die('<div align="center"><font color="red"><b>Not enough gold!</b></font><br><button onclick="history.back()">'.BACK.'</button></div>');
    }
    
    // 2. adaugă timpul la feature
    // dacă a expirat, setează de acum, altfel adaugă
    mysqli_query($database->dblink,
        "UPDATE ".TB_PREFIX."users 
         SET `$field` = IF(`$field` < $now, $now + $plusTime, `$field` + $plusTime)
         WHERE id = $uid"
    );
    
    // 3. update sesiune
    $session->gold -= $cost;
    $_SESSION['gold'] = $session->gold;
    $session->$field = max($session->$field, $now) + $plusTime;
    
    // 4. log
    mysqli_query($database->dblink,
        "INSERT INTO ".TB_PREFIX."gold_fin_log (wid, action, time) 
         VALUES (0, 'Bought $field for $cost gold', $now)"
    );
    
    echo '<meta http-equiv="refresh" content="2;url=plus.php?id=3">';
    echo '<br><div align="center"><font color="green" size="4"><b>Your status has been updated!</b></font></div>';
}
?>
</div>