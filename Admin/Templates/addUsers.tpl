<form action="../GameEngine/Admin/Mods/addUsers.php" method="POST">
<input type="hidden" name="id" id="id" value="<?php echo $id; ?>">

<center><b>Create Users and Villages</b>
    <br><br>
    <font color="Red">
Submitting this form will create new Users and/or Villages on your server!
</font>
<br>
<font color="blue">
Includes resources, main building, rally point, warehouse, granary, wall, market, residence, troops (for hero level-up), and one cranny.
</font>
<p><b>Base Name</b> should be between 4 and 20 characters long</p>

<!-- NEW: Mode switch -->
<b>Mode</b><br>
<label><input type="radio" name="mode" value="many_accounts" checked> Many accounts (legacy): create X accounts with 1 village each</label><br>
<label><input type="radio" name="mode" value="single_with_villages"> Single account: create 1 account with X villages</label>
<br><br>

<!-- Legacy fields -->
<b>How Many (accounts)</b> should be between 1 and 200<br>
(Higher values might take a while or cause a crash!)
<br><br>

<!-- Example -->
If you want to run this more than once you should use a different Base Name each time.<br>
<br>
Example (legacy):<br>
Base Name = Farm | How Many (accounts) = 5 → Users: Farm1..Farm5<br>
Example (single):<br>
Base Name = FarmLord | Villages = 5 → User: FarmLord with 5 villages
<br><br>

<?php
    $baseNameFontColor = "Black";
    $amountFontColor = "Black";
    $villagesFontColor = "Black";

    $baseName = "Farm";
    $amount = 20;         // accounts (legacy)
    $villages = 5;        // villages (single account)
    $mode = "many_accounts";

    if(isset($_GET['e'])) {
        $baseName = ($_GET['bn']);
        $amount   = isset($_GET['am']) ? ($_GET['am']) : $amount;
        $villages = isset($_GET['vi']) ? ($_GET['vi']) : $villages;
        $mode     = isset($_GET['mo']) ? ($_GET['mo']) : $mode;

        switch ($_GET['e']) {
            case 'BN2S':
                $baseNameFontColor = "Red";
                echo '<br /><br /><font color="Red"><b>Error: Base Name is too short (min 4 chars)</b></font>';
                break;
            case 'BN2L':
                $baseNameFontColor = "Red";
                echo '<br /><br /><font color="Red"><b>Error: Base Name is too long (max 20 chars)</b></font>';
                break;
            case 'AMLO':
                $amountFontColor = "Red";
                echo '<br /><br /><font color="Red"><b>Error: Minimum of 1 for How Many (accounts)</b></font>';
                break;
            case 'AMHI':
                $amountFontColor = "Red";
                echo '<br /><br /><font color="Red"><b>Error: Maximum of 200 for How Many (accounts)</b></font>';
                break;
            case 'VILO':
                $villagesFontColor = "Red";
                echo '<br /><br /><font color="Red"><b>Error: Minimum of 1 for Villages</b></font>';
                break;
            case 'VIHI':
                $villagesFontColor = "Red";
                echo '<br /><br /><font color="Red"><b>Error: Maximum of 200 for Villages</b></font>';
                break;
            default:
                echo '<br /><br /><font color="Red"><b>Error: Unknown</b></font>';
        }
    }
    elseif ( isset($_GET['g']) && $_GET['g'] == 'OK') {
        $baseName = ($_GET['bn']);
        $mode     = ($_GET['mo']);
        $skipped  = ($_GET['sk']);
        $beginnersProtection = ($_GET['bp']);

        // interpret the tribe label
        switch ($_GET['tr']) {
            case '0': $tribe = RANDOM; break;
            case '1': $tribe = TRIBE1; break;
            case '2': $tribe = TRIBE2; break;
            case '3': $tribe = TRIBE3; break;
            default:  $tribe = 'Unknown';
        }

        if ($mode === 'many_accounts') {
            $amount = ($_GET['am']);
            echo '<br /><br /><font color="Blue"><b>'.$amount.'</b></font> Users (1 village each) added with Base Name <font color="Blue"><b>'.$baseName.'</b></font><br>';
        } else {
            $villages = ($_GET['vi']);
            echo '<br /><br />Created User <font color="Blue"><b>'.$baseName.'</b></font> with <font color="Blue"><b>'.$villages.'</b></font> villages.<br>';
        }

        if (($mode === 'many_accounts' && $amount > 0) || ($mode === 'single_with_villages' && $villages > 0)) {
            $usersMessage = ($mode === 'many_accounts' ? (($amount > 1) ? 'these Users' : 'this User') : 'this User');
            $begMessage = 'Beginners Protection was ';
            if (!$beginnersProtection) { $begMessage .= '<font color="red"><b>NOT</b></font> '; }
            $begMessage .= 'set for '.$usersMessage.'<br>';
            echo $begMessage;

            $tribeMessage = 'Tribe for '.$usersMessage.' was '.$tribe.'<br>';
            echo $tribeMessage; 
        }

        if ($skipped > 0) {
            echo '<font color="Red"><b>'.$skipped.'</b></font> Users not created as the user name already exists<br>';
        }

        echo '<br>Now would be a good time to <a href="'.SERVER.'/dorf1.php">Return to the server</a> (updates rankings; may take a while)<br>'
           . 'Make sure <b>max_execution_time</b> is set high enough in php.ini<br><br>';
        $baseName = ""; $amount = ""; $villages = "";
    }
?>
<br>
</center>

<!-- Base name -->
<font color ="<?php echo $baseNameFontColor ?>">Base Name &nbsp;</font>
<input type ="text" name="users_base_name" id="users_name" value="<?php echo $baseName ?>" maxlength="20">
<br><br>

<!-- Accounts amount (legacy) -->
<div id="accountsBlock">
<font color ="<?php echo $amountFontColor ?>">How Many (accounts) &nbsp;&nbsp;</font>
<input type ="text" name="users_amount" id="users_amount" value="<?php echo $amount ?>" maxlength="4">
</div>

<!-- Villages amount (single account) -->
<div id="villagesBlock" style="margin-top:10px;">
<font color ="<?php echo $villagesFontColor ?>">Villages (for single account) &nbsp;&nbsp;</font>
<input type ="text" name="villages_amount" id="villages_amount" value="<?php echo $villages ?>" maxlength="4">
</div>

<br>
Beginners Protection &nbsp;&nbsp;<input type ="checkbox" name="users_protection" id="users_protection" checked>
<br><br>
Tribe:<br>
<label><input type="radio" name="tribe" value="0" checked> &nbsp;<?php echo RANDOM; ?></label><br>
<label><input type="radio" name="tribe" value="1"> &nbsp;<?php echo TRIBE1; ?></label><br>
<label><input type="radio" name="tribe" value="2"> &nbsp;<?php echo TRIBE2; ?></label><br>
<label><input type="radio" name="tribe" value="3"> &nbsp;<?php echo TRIBE3; ?></label><br>
<br><br>
<input type="submit" value="Create">

<script>
// Tiny progressive disclosure (no external JS)
(function(){
  function sync() {
    var mode = document.querySelector('input[name="mode"]:checked').value;
    document.getElementById('accountsBlock').style.opacity = (mode==='many_accounts') ? '1' : '0.3';
    document.getElementById('villagesBlock').style.opacity = (mode==='single_with_villages') ? '1' : '0.3';
  }
  var radios = document.querySelectorAll('input[name="mode"]');
  for (var i=0;i<radios.length;i++){ radios[i].addEventListener('change', sync); }
  sync();
})();
</script>
</form>
