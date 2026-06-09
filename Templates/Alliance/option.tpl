<?php
#################################################################################
## -= TravianZ Alliance Options (incremental refactor) =-                     ##
## - preserves permission logic                                                ##
## - reduces duplication                                                       ##
## - improves readability                                                      ##
## - adds safety                                                               ##
#################################################################################

// -------------------------------------------------
// SAFE ALLIANCE ID
// -------------------------------------------------

$aid = isset($aid) ? (int)$aid : (int)$session->alliance;

// -------------------------------------------------
// LOAD DATA
// -------------------------------------------------

$allianceinfo = $database->getAlliance($aid);

// -------------------------------------------------
// HEADER
// -------------------------------------------------

echo "<h1>" .
    htmlspecialchars($allianceinfo['tag'], ENT_QUOTES, 'UTF-8') .
    " - " .
    htmlspecialchars($allianceinfo['name'], ENT_QUOTES, 'UTF-8') .
    "</h1>";

include_once("alli_menu.tpl");
?>

<!-- ERROR OUTPUT -->
<p class="error">
    <?php echo $form->getError("perm"); ?>
</p>

<form method="POST" action="allianz.php">

<input type="hidden" name="s" value="5">

<table cellpadding="1" cellspacing="1" id="options" class="small_option">

<thead>
<tr>
    <th colspan="2"><?php echo OPTION; ?></th>
</tr>
</thead>

<tbody>

<?php
// -------------------------------------------------
// PERMISSION SHORTCUT
// -------------------------------------------------

$perm = $alliance->userPermArray;

// -------------------------------------------------
// OPTIONS MAP (reduces duplication)
// -------------------------------------------------

$options = [

    1 => [
        'perm' => 'opt1',
        'label' => 'Assign to position'
    ],

    100 => [
        'perm' => 'opt3',
        'label' => 'Change name'
    ],

    2 => [
        'perm' => 'opt2',
        'label' => 'Kick player'
    ],

    3 => [
        'perm' => 'opt3',
        'label' => 'Change alliance description'
    ],

    6 => [
        'perm' => 'opt6',
        'label' => 'Alliance diplomacy'
    ],

    4 => [
        'perm' => 'opt4',
        'label' => 'Invite a player into the alliance'
    ],

    5 => [
        'perm' => 'opt5',
        'label' => 'Link to the forum'
    ]
];

// -------------------------------------------------
// DYNAMIC OPTIONS RENDER
// -------------------------------------------------

foreach ($options as $value => $optData) {

    if (!empty($perm[$optData['perm']]) && $perm[$optData['perm']] == 1) {

        echo "<tr>
            <td class=\"sel\">
                <input class=\"radio\" type=\"radio\" name=\"o\" value=\"" . (int)$value . "\">
            </td>
            <td class=\"val\">" . $optData['label'] . "</td>
        </tr>";
    }
}
?>

<!-- ALWAYS AVAILABLE OPTION -->
<tr>
    <td class="sel">
        <input class="radio" type="radio" name="o" value="11">
    </td>
    <td class="val"><?php echo TZ_QUIT_ALLIANCE; ?></td>
</tr>

</tbody>
</table>

<!-- SUBMIT -->
<p>
    <button
        type="submit"
        name="s1"
        id="btn_ok"
        class="trav_buttons"
        onclick="this.disabled=true;this.form.submit();">
        <?php echo TZ_OK_2; ?>
    </button>
</p>

</form>