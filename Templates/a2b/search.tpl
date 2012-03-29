<table id="coords" cellpadding="1" cellspacing="1">
    <tbody><tr>
        <td class="sel">

            <label>
                <input class="radio" name="c" <?php if (!$checked) {?> checked=checked <?php }?>value="2" type="radio" <?php echo $disabledr; ?>>
                Reinforcement
            </label>
        </td>
        <td class="vil">
            <span>Village:</span>
            <input class="text" name="dname" value="" maxlength="20" type="text" >
        </td>

    </tr>
    <tr>
        <td class="sel">
            <label>
                <input class="radio" name="c" value="3" type="radio" <?php echo $disabled ?>>
                Normal attack
            </label>
        </td>
        <td class="or">

            or        </td>
    </tr>
    <tr>
        <td class="sel">
            <label>
                <input class="radio" name="c" <?php echo $checked ?> value="4" type="radio">
                Raid
            </label>
        </td>

<?php
if(isset($_GET['z'])){
$coor = $database->getCoor($_GET['z']);
}
else{
$coor['x'] = "";
$coor['y'] = "";
}
?>
        <td class="target">
            <span>x:</span>
            <input class="text" name="x" value="<?php echo $coor['x']; ?>" maxlength="4" type="text">
            <span>y:</span>
            <input class="text" name="y" value="<?php echo $coor['y']; ?>" maxlength="4" type="text">
        </td>
    </tr>
</tbody></table>

        <input value="ok" name="s1" id="btn_ok" class="dynamic_img" src="img/x.gif" alt="OK" type="image">
    </form>
<p class="error"><?php echo $form->getError("error"); ?></p>
</div>
