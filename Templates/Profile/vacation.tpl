<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Project:       TravianZ      					       		 		  	   ##
##  Version:       06.05.2026 						       	 				   ##
##  Filename       vacation.tpl                                                ##
##  Developed by:  Advocaite                                                   ##
##  Refactored by  Shadow					                                   ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2026. All rights reserved.                ##
##  URLs:          http://travianz.org						       	 		   ##
##  Source code:   http://github.com/Shadowss/TravianZ/         	       	   ##
##                                                                             ##
#################################################################################

if (NEW_FUNCTIONS_VACATION) {

// -----------------------------------------------------
// Admin validation check
// -----------------------------------------------------

$isAdmin     = (isset($session->access) && $session->access == ADMIN);
$isMH        = (isset($session->access) && $session->access == MULTIHUNTER);

?>

<!-- =========================
     PAGE HEADER
========================= -->

<h1><?php echo PLAYER_PROFILE; ?></h1>
<?php include("menu.tpl"); ?>

<?php

// -----------------------------------------------------
// Tribe + validation check
// -----------------------------------------------------
$tribe = (int) $session->tribe;

// ensure safe return type
$check = $database->checkVacationRequirements($session->uid);
$errors = is_array($check) ? $check : [];

$canActivate = empty($errors);

// helper function
function vac_ok($key, $errors)
{
    return !in_array($key, $errors);
}
?>

<form action="spieler.php" method="POST">
<input type="hidden" name="ft" value="p4">

<div class="vacationBox">

    <center><h2><?php echo VACATION_MODE; ?></h2></center>
    <br>

    <?php
    // ERROR DISPLAY (unchanged logic, safer output)
    if (isset($_SESSION['vac_error'])) {
        echo "<div class='error' style='background:#900;color:#fff;padding:10px;margin-bottom:10px;'>"
            . nl2br(htmlspecialchars($_SESSION['vac_error'], ENT_QUOTES, 'UTF-8')) .
        "</div>";

        unset($_SESSION['vac_error']);
    }
    ?>

    <div class="vacationDesc">
        <?php echo TZ_ML_AWAY_NO_SITTER; ?> <b><?php echo VACATION_MODE; ?></b><?php echo TZ_ML_ACCOUNT_FROZEN; ?>
        <br><br>
        <?php echo TZ_MINIMUM_VACATION; ?> <b><?php echo TZ_N_2_DAYS; ?></b><br>
        <?php echo TZ_MAXIMUM_VACATION; ?> <b><?php echo TZ_N_14_DAYS; ?></b>
    </div>

    <div class="vacationGrid">

        <div class="vacationColumn">
            <h4><?php echo TZ_INACTIVE_DURING_VACATION; ?></h4>
            <ul class="vacList">
                <li><?php echo VAC_OP1; ?></li>
                <li><?php echo VAC_OP2; ?></li>
                <li><?php echo VAC_OP3; ?></li>
                <li><?php echo VAC_OP4; ?></li>
                <li><?php echo TZ_JOIN_AN_ALLIANCE; ?></li>
                <li><?php echo VAC_OP6; ?></li>
            </ul>
        </div>

        <div class="vacationColumn">
            <h3><?php echo TZ_REQUIREMENTS; ?></h3>
            <ul class="vacList">

                <li style="color:<?= vac_ok('TROOPS_MOVING',$errors) ? 'green':'red' ?>">
                    <?php echo TZ_THERE_ARE_NO_OUTGOING_TROOPS; ?>
                </li>

                <li style="color:<?= vac_ok('INCOMING_TROOPS',$errors) ? 'green':'red' ?>">
                    <?php echo TZ_THERE_ARE_NO_INCOMING_TROOPS; ?>
                </li>

                <li style="color:<?= vac_ok('REINFORCEMENTS',$errors) ? 'green':'red' ?>">
                    <?php echo TZ_NO_REINFORCING_TROOPS_SENT_RECEIVE; ?>
                </li>

                <li style="color:<?= vac_ok('WW',$errors) ? 'green':'red' ?>">
                    <?php echo TZ_NO_OWNERSHIP_OF_A_WONDER_OF_THE_WO; ?>
                </li>

                <li style="color:<?= vac_ok('ARTEFACTS',$errors) ? 'green':'red' ?>">
                    <?php echo TZ_NO_OWNERSHIP_OF_AN_ARTIFACT_VILLAG; ?>
                </li>

                <li style="color:<?= vac_ok('PROTECTION',$errors) ? 'green':'red' ?>">
                    <?php echo TZ_NO_BEGINNER_PROT2; ?>
                </li>

                <li style="color:<?= (vac_ok('PRISONERS_IN',$errors) && vac_ok('PRISONERS_OUT',$errors)) ? 'green':'red' ?>">
                    <?php if ($tribe == 3) { ?>
                        No units in your traps
                    <?php } else { ?>
                        No troops in enemy traps
                    <?php } ?>
                </li>

                <li style="color:<?= vac_ok('MARKET',$errors) ? 'green':'red' ?>">
                    <?php echo TZ_NO_MARKETPLACE_ACTIVITY; ?>
                </li>

                <li style="color:<?= vac_ok('ACCOUNT_DELETION',$errors) ? 'green':'red' ?>">
                    <?php echo TZ_ACCOUNT_IS_NOT_SCHEDULED_FOR_DELET; ?>
                </li>
				<?php if ($isAdmin || $isMH): ?>
				<li style="color:<?= vac_ok('NO_VACATION_ACCESS', $errors) ? 'green' : 'red' ?>">
				<?php echo TZ_ACCOUNT_IS_ADMIN_OR_MH; ?>
				</li>
				<?php endif; ?>
            </ul>
        </div>

    </div>

    <div class="vacationActivate">

        <label>
            <input type="radio" name="vac" value="1">
            <?php echo TZ_ACTIVATE_VACATION_MODE; ?>
        </label>

        <input type="number" name="vac_days" value="2" min="2" max="14">

        <span><?php echo DAYS; ?></span>

    </div>

    <div class="vacationButton">
    <?php if ($canActivate) { ?>
        <input type="image" name="s1" id="btn_save" class="dynamic_img" src="img/x.gif" alt="<?php echo SAVE; ?>">
    <?php } else { ?>
        <div style="padding:10px;background:#300;color:#fff;font-weight:bold;text-align:center;border-radius:5px;">
            <?php echo TZ_VACATION_MODE_CANNOT_BE_ACTIVATED; ?>
        </div>
    <?php } ?>
    </div>

</div>

</form>

<script>
// prevent accidental submit via Enter
document.addEventListener('DOMContentLoaded', function () {
    const vacInput = document.querySelector('input[name="vac_days"]');

    if (vacInput) {
        vacInput.addEventListener('keydown', function (e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                return false;
            }
        });
    }
});
</script>

<?php
} else {
    header("Location: ".$_SERVER['PHP_SELF']."?uid=".$session->uid);
    exit;
}
?>
