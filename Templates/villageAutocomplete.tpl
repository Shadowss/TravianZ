<?php
/**
 * Village-name autocomplete datalist for the rally point and the marketplace.
 * Honours the player's auto-completion preferences (issue #198): v1 own
 * villages, v2 surrounding villages, v3 alliance villages. Renders a
 * <datalist id="dnameSuggest"> consumed by the dname input via
 * list="dnameSuggest". Nothing is emitted when every box is unchecked.
 */
global $database, $session, $village;

$acV1 = !empty($session->userinfo['v1']);
$acV2 = !empty($session->userinfo['v2']);
$acV3 = !empty($session->userinfo['v3']);

if ($acV1 || $acV2 || $acV3) {
    $acNames = $database->getAutoCompleteVillages(
        $session->uid,
        $session->alliance,
        $village->coor['x'] ?? 0,
        $village->coor['y'] ?? 0,
        $acV1,
        $acV2,
        $acV3
    );

    echo '<datalist id="dnameSuggest">';
    foreach ($acNames as $acName) {
        echo '<option value="' . htmlspecialchars($acName, ENT_QUOTES) . '">';
    }
    echo '</datalist>';
}
?>
