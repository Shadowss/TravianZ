<?php

declare(strict_types=1);

require_once __DIR__ . "/config.php";
require_once __DIR__ . "/Lang/" . LANG . ".php";

if (!isset($input)) {
    $input = '';
}

/* ===============================
   SECURITY HARD LIMIT (Anti-DoS)
   =============================== */
if (strlen($input) > 20000) {
    $input = substr($input, 0, 20000);
}

/* ===============================
   SAFE OUTPUT ESCAPER
   =============================== */
function bb_e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

/* ===============================
   BUILD PATTERNS ENTERPRISE STYLE
   =============================== */

$pattern = [];
$replace = [];

/* -------- BASIC TAGS (bounded, no catastrophic backtracking) -------- */
$pattern[] = "/\[b\]([^[]{0,5000})\[\/b\]/i";
$replace[] = "<b>$1</b>";

$pattern[] = "/\[i\]([^[]{0,5000})\[\/i\]/i";
$replace[] = "<i>$1</i>";

$pattern[] = "/\[u\]([^[]{0,5000})\[\/u\]/i";
$replace[] = "<u>$1</u>";

/* -------- UNIT TAGS (tid1–tid50) -------- */
for ($i = 1; $i <= 50; $i++) {
    $pattern[] = "/\[tid{$i}\]/i";
    $const = "U{$i}";
    $title = defined($const) ? bb_e(constant($const)) : '';
    $replace[] = "<img class='unit u{$i}' src='img/x.gif' title='{$title}' alt='{$title}'>";
}

/* -------- HERO -------- */
$pattern[] = "/\[hero\]/i";
$replace[] = "<img class='unit uhero' src='img/x.gif' title='".bb_e(U0)."' alt='".bb_e(U0)."'>";

/* -------- RESOURCES -------- */
$resources = [
    'lumber' => ['class' => 'r1', 'title' => LUMBER],
    'clay'   => ['class' => 'r2', 'title' => CLAY],
    'iron'   => ['class' => 'r3', 'title' => IRON],
    'crop'   => ['class' => 'r4', 'title' => CROP],
];

foreach ($resources as $tag => $data) {
    $title = bb_e($data['title']);
    $pattern[] = "/\[{$tag}\]/i";
    $replace[] = "<img src='img/x.gif' class='{$data['class']}' title='{$title}' alt='{$title}'>";
}

/* -------- SMILEYS -------- */
$smileys = [
    "*aha*" => "aha","*angry*" => "angry","*cool*" => "cool","*cry*" => "cry",
    "*cute*" => "cute","*depressed*" => "depressed","*eek*" => "eek",
    "*ehem*" => "ehem","*emotional*" => "emotional","*hit*" => "hit",
    "*hmm*" => "hmm","*hmpf*" => "hmpf","*hrhr*" => "hrhr","*huh*" => "huh",
    "*lazy*" => "lazy","*love*" => "love","*nocomment*" => "nocomment",
    "*noemotion*" => "noemotion","*notamused*" => "notamused","*pout*" => "pout",
    "*redface*" => "redface","*rolleyes*" => "rolleyes","*shy*" => "shy",
    "*smile*" => "smile","*tongue*" => "tongue",
    "*veryangry*" => "veryangry","*veryhappy*" => "veryhappy",
];

foreach ($smileys as $code => $class) {
    $pattern[] = "/" . preg_quote($code, '/') . "/";
    $replace[] = "<img class='smiley {$class}' src='img/x.gif' alt='{$code}' title='{$code}'>";
}

/* basic emoticons */
$basic = [":D"=>"grin",":)"=>"happy",":("=>"sad",";)"=>"wink"];
foreach ($basic as $code => $class) {
    $pattern[] = "/" . preg_quote($code, '/') . "/";
    $replace[] = "<img class='smiley {$class}' src='img/x.gif' alt='{$code}' title='{$code}'>";
}

/* ===============================
   SECURE PLACEHOLDER CALLBACKS
   =============================== */

/* -------- ALLIANCE -------- */
$input = preg_replace_callback(
    "/\[alliance(\d{1,20})\]([0-9]{1,20})\[\/alliance\d{1,20}\]/i",
    static function ($m) {
        global $database;
        $aid = (int)$m[2];
        $aname = $database->getAllianceName($aid);
        return $aname
            ? "<a href='allianz.php?aid={$aid}'>".bb_e($aname)."</a>"
            : "Alliance not found!";
    },
    $input
);

/* -------- PLAYER -------- */
$input = preg_replace_callback(
    "/\[player(\d{1,20})\]([0-9]{1,20})\[\/player\d{1,20}\]/i",
    static function ($m) {
        global $database;
        $uid = (int)$m[2];
        $uname = $database->getUserField($uid, "username", 0);
        return ($uname && $uname !== "[?]")
            ? "<a href='spieler.php?uid={$uid}'>".bb_e($uname)."</a>"
            : "Player not found!";
    },
    $input
);

/* -------- REPORT -------- */
$input = preg_replace_callback(
    "/\[report(\d{1,20})\]([0-9]{0,20})\[\/report\d{1,20}\]/i",
    static function ($m) {
        global $database;
        $rid = (int)($m[1] ?: $m[2]);
        $report = $database->getNotice2($rid, null, false);
        return $report
            ? "<a href='berichte.php?id={$rid}'>".bb_e($report['topic'])."</a>"
            : "Report not found!";
    },
    $input
);

/* -------- COORDINATES -------- */
$input = preg_replace_callback(
    "/\[coor(\d{1,20})\](-?\d{1,4}\|-?\d{1,4})\[\/coor\d{1,20}\]/i",
    static function ($m) {
        global $database, $generator;

        [$x, $y] = explode("|", $m[2]);

        $wRef = (int)$database->getVilWref((int)$x, (int)$y);
        if (!$wRef) return "Village not found!";

        $cwref = (int)$generator->getMapCheck($wRef);
        $state = $database->getVillageType($wRef);

        if ($state > 0) {
            $name = $database->getVillageState($wRef)
                ? $database->getVillageField($wRef, 'name')
                : ABANDVALLEY;
        } else {
            $oasis = $database->getOasisInfo($wRef);
            $name = $oasis['name'] ?? '';
        }

        return $name
            ? "<a href='karte.php?d={$wRef}&amp;c={$cwref}'>".bb_e($name)." ({$x}|{$y})</a>"
            : "Village not found!";
    },
    $input
);

/* -------- REMOVE MESSAGE TAGS -------- */
$input = preg_replace('/\[\/?message\]/i', '', $input);

/* ===============================
   FINAL BBCode REPLACE
   =============================== */

$bbcoded = preg_replace($pattern, $replace, $input);
