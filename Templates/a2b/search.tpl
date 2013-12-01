<table id="coords" cellpadding="1" cellspacing="1">
<input type="hidden" name="disabledr" value="<?php echo $disabledr; ?>">
<input type="hidden" name="disabled" value="<?php echo $disabled; ?>">
    <tbody><tr>
        <td class="sel">

            <label>
                <input class="radio" name="c" <?php if (!$checked) {?> checked=checked <?php }?>value="2" type="radio" <?php echo $disabledr; ?>>
                Reinforcement
            </label>
        </td>
        <td class="vil">
            <span>Village:</span>
             <input class="text" name="dname" value="<?php echo $form->getValue('dname');?>" maxlength="20" type="text" >
        </td>

    </tr>
    <tr>
        <td class="sel">
            <label>
                <input class="radio" name="c" value="3" type="radio" <?php echo $disabled; ?>>
                Normal attack
            </label>
        </td>
        <td class="or">

            or        </td>
    </tr>
    <tr>
        <td class="sel">
            <label>
                <input class="radio" name="c" <?php echo $checked; ?> value="4" type="radio">
                Raid
            </label>
        </td>

<?php
if(isset($_GET['z'])){
$coor = $database->getCoor($_GET['z']);
}
else{
$coor['x']=$form->getValue("x");
$coor['y']=$form->getValue("y");
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

        <input value="ok" name="s1" id="btn_ok" class="dynamic_img" src="img/x.gif" alt="OK" type="image" onclick="this.disabled=true;this.form.submit();">
    </form>
<p class="error"><?php echo $form->getError("error"); ?></p>
</div>
