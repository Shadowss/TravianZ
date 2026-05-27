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

?>

<!-- =========================
     PAGE HEADER
========================= -->

<h1>Player profile</h1>
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

    <center><h2>Vacation Mode</h2></center>
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
        If you plan on being away for an extended period of time and do not wish to set a sitter,
        you can activate <b>Vacation Mode</b>. During this time your account is essentially frozen.
        No resources, troops or research will progress and your villages cannot be attacked.
        Remember, this just freezes your Travian, not time.
        <br><br>
        Minimum vacation: <b>2 days</b><br>
        Maximum vacation: <b>14 days</b>
    </div>

    <div class="vacationGrid">

        <div class="vacationColumn">
            <h4>Inactive during vacation</h4>
            <ul class="vacList">
                <li>Send or receive troops</li>
                <li>Start new construction order</li>
                <li>Use market</li>
                <li>Train new troops</li>
                <li>Join an alliance</li>
                <li>Delete account</li>
            </ul>
        </div>

        <div class="vacationColumn">
            <h3>Requirements</h3>
            <ul class="vacList">

                <li style="color:<?= vac_ok('TROOPS_MOVING',$errors) ? 'green':'red' ?>">
                    There are no outgoing troops
                </li>

                <li style="color:<?= vac_ok('INCOMING_TROOPS',$errors) ? 'green':'red' ?>">
                    There are no incoming troops
                </li>

                <li style="color:<?= vac_ok('REINFORCEMENTS',$errors) ? 'green':'red' ?>">
                    No reinforcing troops sent/receive
                </li>

                <li style="color:<?= vac_ok('WW',$errors) ? 'green':'red' ?>">
                    No ownership of a Wonder of the World village
                </li>

                <li style="color:<?= vac_ok('ARTEFACTS',$errors) ? 'green':'red' ?>">
                    No ownership of an artifact village
                </li>

                <li style="color:<?= vac_ok('PROTECTION',$errors) ? 'green':'red' ?>">
                    No beginner’s protection
                </li>

                <li style="color:<?= (vac_ok('PRISONERS_IN',$errors) && vac_ok('PRISONERS_OUT',$errors)) ? 'green':'red' ?>">
                    <?php if ($tribe == 3) { ?>
                        No units in your traps
                    <?php } else { ?>
                        No troops in enemy traps
                    <?php } ?>
                </li>

                <li style="color:<?= vac_ok('MARKET',$errors) ? 'green':'red' ?>">
                    No marketplace activity
                </li>

                <li style="color:<?= vac_ok('ACCOUNT_DELETION',$errors) ? 'green':'red' ?>">
                    Account is not scheduled for deletion
                </li>
				
                <li style="color:<?= vac_ok('NO_VACATION_ACCESS',$errors) ? 'green':'red' ?>">
                    Account is Admin or MH
                </li>
            </ul>
        </div>

    </div>

    <div class="vacationActivate">

        <label>
            <input type="radio" name="vac" value="1">
            Activate Vacation Mode
        </label>

        <input type="number" name="vac_days" value="2" min="2" max="14">

        <span>days</span>

    </div>

    <div class="vacationButton">
    <?php if ($canActivate) { ?>
        <input type="image" name="s1" id="btn_save" class="dynamic_img" src="img/x.gif" alt="save">
    <?php } else { ?>
        <div style="padding:10px;background:#300;color:#fff;font-weight:bold;text-align:center;border-radius:5px;">
            Vacation mode cannot be activated – requirements not met
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
