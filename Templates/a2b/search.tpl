<?php
// -- preluăm stările disabled din form (păstrăm exact valorile originale)
$disabled = '';
$disabledr = '';

if (!empty($form) && !empty($form->valuearray)) {
    if (!empty($form->valuearray['disabled'])) {
        $disabled = $form->valuearray['disabled'];
    }
    if (!empty($form->valuearray['disabledr'])) {
        $disabledr = $form->valuearray['disabledr'];
    }
}

// logica originală pentru checked
$reinforcementChecked = (empty($disabledr));
$raidChecked = (!empty($disabledr) && !empty($disabled));

// dacă ambele sunt disabled, reinforcement nu mai e checked (ca în original)
if ($raidChecked) {
    $reinforcementChecked = false;
}

// coordonate
if (isset($_GET['z'])) {
    $coor = $database->getCoor($_GET['z']);
} else {
    $coor['x'] = $form->getValue('x');
    $coor['y'] = $form->getValue('y');
}
?>
<table id="coords" cellpadding="1" cellspacing="1">
    <input type="hidden" name="disabledr" value="<?php echo htmlspecialchars($disabledr ?? '', ENT_QUOTES); ?>">
    <input type="hidden" name="disabled" value="<?php echo htmlspecialchars($disabled ?? '', ENT_QUOTES); ?>">
    <tbody>
        <tr>
            <td class="sel">
                <label>
                    <input class="radio" name="c" value="2" type="radio"
                        <?php if ($reinforcementChecked) echo 'checked="checked"'; ?>
                        <?php echo $disabledr; ?>>
                    Reinforcement
                </label>
            </td>
            <td class="vil">
                <span><?php echo TZ_VILLAGE; ?></span>
                <input class="text" name="dname" value="<?php echo htmlspecialchars($form->getValue('dname'), ENT_QUOTES); ?>" maxlength="20" type="text" list="dnameSuggest" autocomplete="off">
                <?php include("Templates/villageAutocomplete.tpl"); ?>
            </td>
        </tr>
        <tr>
            <td class="sel">
                <label>
                    <input class="radio" name="c" value="3" type="radio" <?php echo $disabled; ?>>
                    Normal attack
                </label>
            </td>
            <td class="or"><?php echo constant('OR'); ?></td>
        </tr>
        <tr>
            <td class="sel">
                <label>
                    <input class="radio" name="c" value="4" type="radio"
                        <?php if ($raidChecked) echo 'checked="checked"'; ?>>
                    Raid
                </label>
            </td>
            <td class="target">
                <span>x:</span>
                <input class="text" name="x" value="<?php echo htmlspecialchars($coor['x'] ?? '', ENT_QUOTES); ?>" maxlength="4" type="text">
                <span>y:</span>
                <input class="text" name="y" value="<?php echo htmlspecialchars($coor['y'] ?? '', ENT_QUOTES); ?>" maxlength="4" type="text">
            </td>
        </tr>
    </tbody>
</table>

<button value="ok" name="s1" id="btn_ok" class="trav_buttons" alt="OK" onclick="this.disabled=true;this.form.submit();"><?php echo TZ_OK_2; ?></button>
</form>
<p class="error"><?php echo $form->getError('error'); ?></p>
</div>
