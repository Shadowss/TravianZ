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

    /**
     * Numele de sate NU sunt unice - cele 13 sate de Minune ale Natarilor se
     * cheama toate "WW village". Daca sugestia trimite doar numele, cautarea
     * poate nimeri alt sat, iar resursele pleaca aiurea.
     *
     * Asa ca adaugam coordonatele DOAR la numele care apar de mai multe ori.
     * Numele unice raman curate, deci pentru majoritatea jucatorilor nu se
     * schimba nimic.
     */
    $acCount = array();

    foreach ($acNames as $acRow) {
        $acKey = $acRow['name'];
        $acCount[$acKey] = isset($acCount[$acKey]) ? $acCount[$acKey] + 1 : 1;
    }

    echo '<datalist id="dnameSuggest">';

    foreach ($acNames as $acRow) {
        $acValue = $acRow['name'];

        if ($acCount[$acRow['name']] > 1) {
            $acValue .= ' (' . (int) $acRow['x'] . '|' . (int) $acRow['y'] . ')';
        }

        echo '<option value="' . htmlspecialchars($acValue, ENT_QUOTES) . '">';
    }

    echo '</datalist>';
}
?>
