<?php

############################################################################
## Created by: KFCSpike                                                   ##
## Contributors: KFCSpike                                                 ##
## License: TravianZ Project                                              ##
## Copyright: TravianZ (c) 2014. All rights reserved.                     ##
############################################################################

?>

<form action="../GameEngine/Admin/Mods/addUsers.php" method="POST">
<input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
<center><b>Create Users and Villages</b>
    <br><br>
    <font color="Red">
Submitting this form will create new Users<br>(and their home Villages) on your server!
</font><br><font color="blue">with all resource,  mainbuilding, rallypoint, warehouse, granary, wall, marketplaced, residence, troop (for level-up hero) and one cranny.
</b>
</font>
<p>
<b>Base Name</b> should be between 4 and 20 characters long
</p>
    <b>How Many</b> should be between 1 and 200<br>
    (Higher values might take a while or cause a crash!)
    <br><br>
    If you want to run this more than once you should use different a different Base Name each time - if a UserName already exists it will be skipped
    <br><br>
    Example:<br>
    Base Name = Farm<br>
    How Many = 5<br>
    Users created will be Farm1, Farm2, Farm3, Farm4, Farm5<br>
    <br>
    <br>
    
    <?php
    $baseNameFontColor = "Black";
    $amountFontColor = "Black";
    $baseName = "Farm";
    $amount = 20;
    
    if(isset($_GET['e'])) 
        {
            // If &e is set then &bn + &am should be as well
            $baseName = ($_GET['bn']);
            $amount = ($_GET['am']);
            switch ($_GET['e'])
            {
                case 'BN2S':
                    $baseNameFontColor = "Red";
                   echo '<br /><br /><font color="Red"><b>Error: Base Name is too short (min 4 chars)</font></b>';
                    break;
                case 'BN2L':
                    $baseNameFontColor = "Red";
                    echo '<br /><br /><font color="Red"><b>Error: Base Name is too long (max 20 chars)</font></b>';
                    break;
                case 'AMLO':
                    $amountFontColor = "Red";
                    echo '<br /><br /><font color="Red"><b>Error: Minimum of 1 for How Many</font></b>';
                    break;
                case 'AMHI':
                    $amountFontColor = "Red";
                    echo '<br /><br /><font color="Red"><b>Error: Maximum of 200 for How Many</font></b>';
                    break;
                default:
                    // Should never reach here
                    $baseNameFontColor = "Black";
                    $amountFontColor = "Black";
                    echo '<br /><br /><font color="Red"><b>Error: Unknown</font></b>';
            }
        }
        elseif ( isset($_GET['g']) && $_GET['g'] == 'OK')
        {
            $baseName = ($_GET['bn']);
            $amount = ($_GET['am']);
            $skipped = ($_GET['sk']);
            $beginnersProtection = ($_GET['bp']);
            switch ($_GET['tr'])
            {
                case '0':
                    $tribe = RANDOM;
                    break;
                case '1':
                    $tribe = ROMANS;
                    break;
                case '2':
                    $tribe = TEUTONS;
                    break;
                case '3':
                    $tribe = GAULS;
                    break;
                default:
                    // Should never reach here
                    $tribe = 'Unknown';
            }
            
            echo '<br /><br />
                <font color="Blue"><b>'
                . $amount . 
                '</b></font>
                 Users and Villages added using Base Name
                 <font color="Blue"><b>'
                . $baseName . 
                '</b></font><br>';
                
                // Say if Beginners Protection was set for any Users created
                if ($amount > 0)
                {
                    // Plural or Singular for User(s)
                    // TODO: Add options for these to lang files
                    if ($amount > 1)
                    {
                        $usersMessage = 'these Users';
                    }
                    else
                    {
                        $usersMessage = 'this User';
                    }
                    $begMessage = 'Beginners Protection was ';
                    if (!$beginnersProtection)
                    {
                        $begMessage .= '<font color="red"><b>NOT</b></font> ';
                    }
                    $begMessage .= 'set for ' . $usersMessage . '<br>';
                    echo $begMessage;
                    
                    // Say Tribes chosen
                    $tribeMessage = 'Tribe for ' . $usersMessage . ' was ';
                    $tribeMessage .= $tribe . '<br>';
                    echo $tribeMessage; 
                }
            if ($skipped > 0)
            {
                echo '<font color="Red"><b>'
                    . $skipped . 
                    '</b></font>
                     Users not created as the user name already exists
                    </b></font><br>';
            }
            echo '<br>Now would be a good time to '
                . '<a href="' . SERVER . '/dorf1.php">Return to the server</a>'
                . ' this will update rankings etc but <b>will</b> take a while!<br>'
                . ' Make sure <b>max_execution_time</b> is set to a high enough value in php.ini<br><br>'
                . 'Choose a different <b>Base Name</b> if you want to create more<br>';
            // Clear the basename from form values so not used again
            $baseName = "";
            $amount = "";
        }
    ?>
    <br>
</center>
<font color ="<?php echo $baseNameFontColor ?>">Base Name &nbsp;</font><input type ="text" name="users_base_name" id="users_name" value="<?php echo $baseName ?>" maxlength="20">
<br><br>
<font color ="<?php echo $amountFontColor ?>">How Many &nbsp;&nbsp;</font><input type ="text" name="users_amount" id="users_amount" value="<?php echo $amount ?>" maxlength="4">
<br><br>
Beginners Protection &nbsp;&nbsp;<input type ="checkbox" name="users_protection" id="users_protection" checked>
<br><br>
Tribe:<br>
<label><input type="radio" name="tribe" value="0" checked> &nbsp;<?php echo RANDOM; ?></label><br>
<label><input type="radio" name="tribe" value="1"> &nbsp;<?php echo ROMANS; ?></label><br>
<label><input type="radio" name="tribe" value="2"> &nbsp;<?php echo TEUTONS; ?></label><br>
<label><input type="radio" name="tribe" value="3"> &nbsp;<?php echo GAULS; ?></label><br>
<br><br>
<input type="submit" value="Create Users">
</form>
