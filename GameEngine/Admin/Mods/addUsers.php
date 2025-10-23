<?php

use App\Entity\User;

// go max 5 levels up - we don't have folders that go deeper than that
$autoprefix = '';
for ($i = 0; $i < 5; $i++) {
    $autoprefix = str_repeat('../', $i);
    if (file_exists($autoprefix.'autoloader.php')) break;
}

include_once($autoprefix."GameEngine/config.php");
include_once($autoprefix."GameEngine/Session.php");
include_once($autoprefix."GameEngine/Automation.php");
include_once($autoprefix."GameEngine/Database.php");

$wgarray = array(1=>1200,1700,2300,3100,4000,5000,6300,7800,9600,11800,14400,17600,21400,25900,31300,37900,45700,55100,66400,80000);

foreach ($_POST as $key => $value) {
    $_POST[$key] = $database->escape($value);
}

$id                  = (int) $_POST['id'];
$baseName            = $_POST['users_base_name'];
$amount              = isset($_POST['users_amount']) ? (int) $_POST['users_amount'] : 0;         // accounts (legacy)
$villagesRequested   = isset($_POST['villages_amount']) ? (int) $_POST['villages_amount'] : 0;   // for single account
$beginnersProtection = isset($_POST['users_protection']) ? $_POST['users_protection'] : 0;
$postTribe           = (int) $_POST['tribe'];
$mode                = isset($_POST['mode']) ? $_POST['mode'] : 'many_accounts';

// Basic validation
if (strlen($baseName) < 4) {
    header("Location: ../../../Admin/admin.php?p=addUsers&e=BN2S&bn=$baseName&am=$amount&vi=$villagesRequested&mo=$mode");
    exit;
}
if (strlen($baseName) > 20) {
    header("Location: ../../../Admin/admin.php?p=addUsers&e=BN2L&bn=$baseName&am=$amount&vi=$villagesRequested&mo=$mode");
    exit;
}

// convenience closure: pick tribe once (for a user)
$chooseTribe = function(int $postTribe) {
    if ($postTribe === 0) return rand(1,3);
    return max(1, min(3, $postTribe));
};

// convenience closure: builds/units/resources for one village
$createVillage = function(int $uid, string $villageName, int $tribe, bool $isCapital) use ($database, $automation, $wgarray) : int {
    // Random quad
    $kid = rand(1,4);

    // Second arg (1) historically used as "capital" in your code; non-capital = 0
    $wid = $database->generateBase($kid, $isCapital ? 1 : 0);
    $database->setFieldTaken($wid);

    // random resources + storage sizing (same as your current logic)
    $rand_resource = rand(30000, 80000);
    $level_storage = rand(10, 20);
    $cap_storage   = $wgarray[$level_storage]*(STORAGE_BASE/800);
    if ($rand_resource > $cap_storage) $rand_resource = $cap_storage;

    $time = time();
    $capitalFlag = $isCapital ? 1 : 0;

    // vdata
    $q = "INSERT INTO ".TB_PREFIX."vdata (`wref`,`owner`,`name`,`capital`,`pop`,`cp`,`celebration`,`type`,`wood`,`clay`,`iron`,`maxstore`,`crop`,`maxcrop`,`lastupdate`,`loyalty`,`exp1`,`exp2`,`exp3`,`created`)
          VALUES (".(int)$wid.",".(int)$uid.",'".$database->escape($villageName)."',$capitalFlag,200,1,0,0,$rand_resource,$rand_resource,$rand_resource,$cap_storage,$rand_resource,$cap_storage,$time,100,0,0,0,$time)";
    mysqli_query($GLOBALS["link"], $q) or die(mysqli_error($database->dblink));

    // fdata (unchanged randomization from your current code)
    $q = "INSERT INTO ".TB_PREFIX."fdata (`vref`,`f1`,`f1t`,`f2`,`f2t`,`f3`,`f3t`,`f4`,`f4t`,`f5`,`f5t`,`f6`,`f6t`,`f7`,`f7t`,`f8`,`f8t`,`f9`,`f9t`,`f10`,`f10t`,`f11`,`f11t`,`f12`,`f12t`,`f13`,`f13t`,`f14`,`f14t`,`f15`,`f15t`,`f16`,`f16t`,`f17`,`f17t`,`f18`,`f18t`,`f19`,`f19t`,`f20`,`f20t`,`f21`,`f21t`,`f22`,`f22t`,`f23`,`f23t`,`f24`,`f24t`,`f25`,`f25t`,`f26`,`f26t`,`f27`,`f27t`,`f28`,`f28t`,`f29`,`f29t`,`f30`,`f30t`,`f31`,`f31t`,`f32`,`f32t`,`f33`,`f33t`,`f34`,`f34t`,`f35`,`f35t`,`f36`,`f36t`,`f37`,`f37t`,`f38`,`f38t`,`f39`,`f39t`,`f40`,`f40t`,`f99`,`f99t`,`wwname`)
          VALUES ($wid ,".rand(5,10).",1,".rand(5,10).",4,".rand(5,10).",1,".rand(5,10).",3,".rand(5,10).",2,".rand(5,10).",2,".rand(5,10).",3,".rand(5,10).",4,".rand(5,10).",4,".rand(5,10).",3,".rand(5,10).",3,".rand(5,10).",4,".rand(5,10).",4,".rand(5,10).",1,".rand(5,10).",4,".rand(5,10).",2,".rand(5,10).",1,".rand(5,10).",2,".rand(2,5).",8,".rand(5,20).",37,".rand(10,20).",26,".rand(10,20).",22,".rand(10,20).",19,".rand(2,5).",9,$level_storage,11,".rand(10,20).",15,".rand(10,20).",20,0,0,".rand(10,15).",17,$level_storage,10,".rand(5,10).",12,0,0,10,23,0,0,0,0,0,0,0,0,".rand(5,10).",18,".rand(5,10).",16,0,0,0,0,'World Wonder')";
    mysqli_query($GLOBALS["link"], $q) or die(mysqli_error($database->dblink));

    // pop/cp recount
    $automation->recountPop($wid);
    $automation->recountPop($wid);

    // units: random per tribe (same as your code)
    $q = "UPDATE " . TB_PREFIX . "units SET
            u".(($tribe-1)*10+1)." = ".rand(100, 2000).",
            u".(($tribe-1)*10+2)." = ".rand(100, 2400).",
            u".(($tribe-1)*10+3)." = ".rand(100, 1600).",
            u".(($tribe-1)*10+4)." = ".rand(100, 1500).",
            u".(($tribe-1)*10+5)." = ".rand(48, 1700).",
            u".(($tribe-1)*10+6)." = ".rand(60, 1800)."
          WHERE vref = '".$wid."'";
    mysqli_query($GLOBALS["link"], $q) or die(mysqli_error($database->dblink));

    return $wid;
};

// ===== Branch by mode =====
if ($mode === 'many_accounts') {
    if ($amount < 1) {
        header("Location: ../../../Admin/admin.php?p=addUsers&e=AMLO&bn=$baseName&am=$amount&mo=$mode");
        exit;
    }
    if ($amount > 200) {
        header("Location: ../../../Admin/admin.php?p=addUsers&e=AMHI&bn=$baseName&am=$amount&mo=$mode");
        exit;
    }

    $created = 0;
    $skipped = 0;
    $addUnitsWrefs = [];
    $addTechWrefs  = [];
    $addABTechWrefs= [];

    for ($i=1; $i <= $amount; $i++) {
        $userName = $baseName . $i;
        $password = $generator->generateRandStr(20);
        $email    = $userName . '@example.com';
        $tribe    = $chooseTribe($postTribe);
        $act      = "";

        if (User::exists($database, $userName)) {
            $skipped++;
            continue;
        }

        $uid = $database->register($userName, password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]), $email, $tribe, $act);
        if (!$uid) continue;

        // profile protection dove
        $q = "UPDATE " . TB_PREFIX . "users SET desc2 = '[#0]' WHERE id = ".(int)$uid;
        mysqli_query($GLOBALS["link"], $q) or die(mysqli_error($database->dblink));

        if (!$beginnersProtection) {
            $protection = time();
            mysqli_query($GLOBALS["link"], "UPDATE ".TB_PREFIX."users SET protect = '".$protection."' WHERE id = ".(int)$uid) or die(mysqli_error($database->dblink));
        }

        $database->updateUserField($uid,"act","",1);

        // One capital village (legacy)
        $villageName = $userName . "'s village";
        $wid = $createVillage($uid, $villageName, $tribe, true);

        $addUnitsWrefs[]  = $wid;
        $addTechWrefs[]   = $wid;
        $addABTechWrefs[] = $wid;

        $database->updateUserField($uid,"access",USER,1);

        $created++;
    }

    $database->addUnits($addUnitsWrefs);
    $database->addTech($addTechWrefs);
    $database->addABTech($addABTechWrefs);

    header("Location: ../../../Admin/admin.php?p=addUsers&g=OK&bn=$baseName&am=$created&sk=$skipped&bp=$beginnersProtection&tr=$postTribe&mo=$mode");
    exit;
}

// ===== Single account with X villages =====
if ($mode === 'single_with_villages') {
    if ($villagesRequested < 1) {
        header("Location: ../../../Admin/admin.php?p=addUsers&e=VILO&bn=$baseName&vi=$villagesRequested&mo=$mode");
        exit;
    }
    if ($villagesRequested > 200) {
        header("Location: ../../../Admin/admin.php?p=addUsers&e=VIHI&bn=$baseName&vi=$villagesRequested&mo=$mode");
        exit;
    }

    $userName = $baseName; // exact name, no numeric suffix
    $password = $generator->generateRandStr(20);
    $email    = $userName . '@example.com';
    $tribe    = $chooseTribe($postTribe);
    $act      = "";

    if (User::exists($database, $userName)) {
        // Don’t silently add villages to an existing (maybe real) user via this tool.
        header("Location: ../../../Admin/admin.php?p=addUsers&e=AMLO&bn=$baseName&vi=$villagesRequested&mo=$mode");
        exit;
    }

    $uid = $database->register($userName, password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]), $email, $tribe, $act);
    if (!$uid) {
        header("Location: ../../../Admin/admin.php?p=addUsers&e=Unknown&bn=$baseName&vi=$villagesRequested&mo=$mode");
        exit;
    }

    // protection dove
    $q = "UPDATE " . TB_PREFIX . "users SET desc2 = '[#0]' WHERE id = ".(int)$uid;
    mysqli_query($GLOBALS["link"], $q) or die(mysqli_error($database->dblink));

    if (!$beginnersProtection) {
        $protection = time();
        mysqli_query($GLOBALS["link"], "UPDATE ".TB_PREFIX."users SET protect = '".$protection."' WHERE id = ".(int)$uid) or die(mysqli_error($database->dblink));
    }

    $database->updateUserField($uid,"act","",1);

    $addUnitsWrefs = [];
    $addTechWrefs  = [];
    $addABTechWrefs= [];

    for ($v=1; $v <= $villagesRequested; $v++) {
        $isCapital   = ($v === 1);
        $villageName = $userName . ($isCapital ? " (Capital)" : " #" . $v);
        $wid = $createVillage($uid, $villageName, $tribe, $isCapital);

        $addUnitsWrefs[]  = $wid;
        $addTechWrefs[]   = $wid;
        $addABTechWrefs[] = $wid;

        // Set the first village as active/capital in the usual tables if your code expects it:
        if ($isCapital) {
            // ensure vdata.capital already 1; if you have any “default village” linkage, set that here.
        }
    }

    // Tech & ABTech for all villages
    $database->addUnits($addUnitsWrefs);
    $database->addTech($addTechWrefs);
    $database->addABTech($addABTechWrefs);

    // Enable user after villages created
    $database->updateUserField($uid,"access",USER,1);

    header("Location: ../../../Admin/admin.php?p=addUsers&g=OK&bn=$baseName&vi=$villagesRequested&sk=0&bp=$beginnersProtection&tr=$postTribe&mo=$mode");
    exit;
}

// Fallback (shouldn’t happen)
header("Location: ../../../Admin/admin.php?p=addUsers&e=Unknown&bn=$baseName&mo=$mode");
?>