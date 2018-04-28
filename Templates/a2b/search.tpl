<table id="coords" cellpadding="1" cellspacing="1">
<input type="hidden" name="disabledr" value="<?php echo (isset($disabledr) ? $disabledr : ''); ?>">
<input type="hidden" name="disabled" value="<?php echo (isset($disabled) ? $disabled : ''); ?>">
    <tbody><tr>
        <td class="sel">

            <label>
                <input class="radio" name="c" <?php if (!isset($checked) || !$checked) {?> checked=checked <?php }?>value="2" type="radio" <?php echo (isset($disabledr) ? $disabledr : ''); ?>>
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
                <input class="radio" name="c" <?php echo (isset($checked) ? $checked : ''); ?> value="4" type="radio">
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

       <button value="ok" name="s1" id="btn_ok" class="trav_buttons" alt="OK" onclick="this.disabled=true;this.form.submit();" /> Ok </button>
    </form>
<p class="error"><?php echo $form->getError("error"); ?></p>
</div>
