<?php
// Gold Club activation – 100 gold, atomic
$uid = (int)$session->uid;

if($session->sit != 0) {
    header("Location: plus.php?id=3"); exit;
}

// un singur query care face tot
mysqli_query($database->dblink,
    "UPDATE ".TB_PREFIX."users 
     SET goldclub = 1, gold = gold - 100 
     WHERE id = $uid AND gold >= 100 AND goldclub = 0"
);

if(mysqli_affected_rows($database->dblink) == 1) {
    // succes – update sesiunea
    $session->gold -= 100;
    $session->goldclub = 1;
    $_SESSION['gold'] = $session->gold;
    $_SESSION['goldclub'] = 1;
    
    if(isset($database->cache)) {
        $database->cache->delete('user:'.$uid);
    }
    
    // log
    mysqli_query($database->dblink,
        "INSERT INTO ".TB_PREFIX."gold_fin_log (wid, action, time) 
         VALUES (0, 'Gold Club activated', ".time().")"
    );
}

header("Location: plus.php?id=3");
exit;
?>