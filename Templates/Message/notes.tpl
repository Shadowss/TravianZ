<?php
#################################################################################
##  SAFE INCREMENTAL REFACTOR - Notes Module                                   ##
##  Credits: cleaned structure, same logic preserved                           ##
##  Compatibility: PHP 5.6+ / PHP 7+                                           ##
#################################################################################
?>

<div id="content" class="messages">
<h1><?php echo MESSAGES; ?></h1>

<?php include("menu.tpl"); ?>

<form method="post" action="nachrichten.php">

<div id="block">

    <!-- ======================================================
         FORM TYPE (UNCHANGED)
    ======================================================= -->
    <input type="hidden" name="ft" value="m6" />

    <!-- ======================================================
         NOTE CONTENT (UNCHANGED OUTPUT)
    ======================================================= -->
    <textarea name="notizen" id="notice"><?php echo $message->note; ?></textarea>

    <!-- ======================================================
         SAVE BUTTON
         (fix mic: atribut alt era invalid)
    ======================================================= -->
    <p class="btn">
        <button id="btn_save" name="s1" class="trav_buttons"><?php echo SAVE; ?></button>
        <br />&nbsp;
    </p>

</div>

</form>

</div>