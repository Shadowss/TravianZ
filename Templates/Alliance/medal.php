<?php
#################################################################################
## -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                              ##
## --------------------------------------------------------------------------- ##
## Project:     TravianZ (Incremental Refactor SAFE)                           ##
## File:        medal.php                                                      ##
## Fixes:                                                                       ##
##  - FIX broken tooltip (escaping JS/HTML)                                    ##
##  - Removed newline issues                                                   ##
##  - Safer string handling                                                    ##
##  - Reduced duplication (safe)                                               ##
#################################################################################

// -------------------------------------------------
// GPACK (unchanged logic, cleaner)
// -------------------------------------------------
$gpack = ($session->gpack == null || GP_ENABLE == false)
    ? GP_LOCATE
    : $session->gpack;

// -------------------------------------------------
// PROFILE SHORTCODES (UNCHANGED LOGIC)
// -------------------------------------------------
$profiel = preg_replace("/\[war]/s",'At war with<br>'.$database->getAllianceWar($aid), $profiel, 1);
$profiel = preg_replace("/\[ally]/s",'Confederacies<br>'.$database->getAllianceDipProfile($aid,1), $profiel, 1);
$profiel = preg_replace("/\[nap]/s",'NAPs<br>'.$database->getAllianceDipProfile($aid,2), $profiel, 1);
$profiel = preg_replace(
    "/\[diplomatie]/s",
    'Confederacies<br>'.$database->getAllianceDipProfile($aid,1).
    '<br>NAPs<br>'.$database->getAllianceDipProfile($aid,2).
    '<br>At war with<br>'.$database->getAllianceWar($aid),
    $profiel,
    1
);

// -------------------------------------------------
// HELPER: SAFE TOOLTIP (CRITICAL FIX)
// -------------------------------------------------
function buildTooltip($html) {
    // remove line breaks (VERY IMPORTANT)
    $html = str_replace(["\r", "\n"], '', $html);

    // escape quotes for JS
    $html = str_replace("'", "\\'", $html);

    return $html;
}

// -------------------------------------------------
// MEDALS LOOP
// -------------------------------------------------
foreach ($varmedal as $medal) {

    $titel = '';
    $woord = '';
    $isBonus = false;

    // -------------------------------------------------
    // CATEGORY SWITCH (UNCHANGED LOGIC)
    // -------------------------------------------------
    switch ($medal['categorie']) {

        case "1":
            $titel="Attackers of the Week";
            $woord="Points";
        break;

        case "2":
            $titel="Defenders of the Week";
            $woord="Points";
        break;

        case "3":
            $titel="Climbers of the week(Ranks)";
            $woord="Ranks";
        break;

        case "4":
            $titel="Robbers of the week";
            $woord="Resources";
        break;

        case "5":
            $titel="Receiving this medal shows that your alliance was in the top 3 of both attacckers and defenders of the week.";
            $isBonus = true;
        break;

        case "6":
            $titel="Receiving this medal shows that your alliance was in the top 3 of the attackers of the week ".$medal['points']." in a row";
            $isBonus = true;
        break;

        case "7":
            $titel="Receiving this medal shows that your alliance was in the top 3 of the deffenders of the week ".$medal['points']." in a row";
            $isBonus = true;
        break;

        case "8":
            $titel="Receiving this medal shows that your alliance was in the top 3 of the rank climbers of the week ".$medal['points']." in a row.";
            $isBonus = true;
        break;

        case "9":
            $titel="Receiving this medal shows that your alliance was in the top 3 of the robbers of the week ".$medal['points']." in a row.";
            $isBonus = true;
        break;

        case "11":
            $titel="Receiving this medal shows that you were in the top 3 of the Rank Climbers of the week ".$medal['points']." in a row.";
            $isBonus = true;
        break;

        case "12":
            $titel="Receiving this medal shows that you were in the top 10 Attackers of the week ".$medal['points']." in a row.";
            $isBonus = true;
        break;

        case "13":
            $titel="Receiving this medal shows that you were in the top 10 Defenders of the week ".$medal['points']." in a row.";
            $isBonus = true;
        break;

        case "15":
            $titel="Receiving this medal shows that you were in the top 10 Robbers of the week ".$medal['points']." in a row.";
            $isBonus = true;
        break;

        case "16":
            $titel="Receiving this medal shows that you were in the top 10 Rank Climbers of the week ".$medal['points']." in a row.";
            $isBonus = true;
        break;
    }

    // -------------------------------------------------
    // TOOLTIP BUILD (SAFE)
    // -------------------------------------------------
    if ($isBonus) {

        $tooltip = "<table><tr><td>"
            . $titel
            . "<br /><br />Received in week: "
            . (int)$medal['week']
            . "</td></tr></table>";

    } else {

        $tooltip = "<table>"
            . "<tr><td>Category:</td><td>".$titel."</td></tr>"
            . "<tr><td>Week:</td><td>".(int)$medal['week']."</td></tr>"
            . "<tr><td>Rank:</td><td>".(int)$medal['plaats']."</td></tr>"
            . "<tr><td>".$woord.":</td><td>".(int)$medal['points']."</td></tr>"
            . "</table>";
    }

    // SAFE tooltip
    $tooltip = buildTooltip($tooltip);

    // -------------------------------------------------
    // FINAL REPLACEMENT (UNCHANGED LOGIC)
    // -------------------------------------------------
    $img = '<img src="'.$gpack.'img/t/'.$medal['img'].'.jpg" border="0" '
         . 'onmouseout="med_closeDescription()" '
         . 'onmousemove="med_mouseMoveHandler(arguments[0],\''.$tooltip.'\')">';

    $profiel = preg_replace("/\[#".$medal['id']."]/is", $img, $profiel, 1);
}
?>