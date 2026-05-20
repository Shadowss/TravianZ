<?php
// Gold Club activation – 100 gold, atomic
$uid = (int)$session->uid;
$wid = (int)$village->wid;
$now = time();
$cost = 100;

if($session->sit != 0) {
    header("Location: plus.php?id=3"); exit;
}

// un singur query
mysqli_query($database->dblink,
    "UPDATE ".TB_PREFIX."users 
     SET goldclub = 1, gold = gold - $cost 
     WHERE id = $uid AND gold >= $cost AND goldclub = 0"
);

if(mysqli_affected_rows($database->dblink) == 1) {
    // update sesiune
    $session->gold -= $cost;
    $session->goldclub = 1;
    $_SESSION['gold'] = $session->gold;
    $_SESSION['goldclub'] = 1;
    
    if(isset($database->cache)) {
        $database->cache->delete('user:'.$uid);
    }
    
    // LOG pentru a2b2.php
    mysqli_query($database->dblink,
        "INSERT INTO ".TB_PREFIX."gold_fin_log 
         (uid, wid, action, gold, time, details) 
         VALUES ($uid, $wid, 'Use 100 gold for Gold Club', -$cost, $now, 'Gold Club activated')"
    );
}

header("Location: plus.php?id=3");
exit;
?>