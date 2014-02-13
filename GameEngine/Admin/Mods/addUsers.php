<?php
############################################################################
## Filename addUsers.php                                                  ##
## Created by: KFCSpike                                                   ##
## Contributors: KFCSpike                                                 ##
## License: TravianZ Project                                              ##
## Copyright: TravianZ (c) 2014. All rights reserved.                     ##
############################################################################

if (!isset($_SESSION)) session_start();
if($_SESSION['access'] < 9) die("Access Denied: You are not Admin!");
include_once("../../config.php");
include_once("../../Session.php");
include_once("../../Automation.php");
mysql_connect(SQL_SERVER, SQL_USER, SQL_PASS);
mysql_select_db(SQL_DB);

$id = $_POST['id'];
$baseName = $_POST['users_base_name'];
$amount = (int) $_POST['users_amount'];
$beginnersProtection = $_POST['users_protection'];
$postTribe = $_POST['tribe'];

// Some basic error checking
if (strlen($baseName) < 4)
{
    header("Location: ../../../Admin/admin.php?p=addUsers&e=BN2S&bn=$baseName&am=$amount");
}
elseif (strlen($baseName) > 20)
{
    // Might be needed if older browers don't respect form maxlength
    header("Location: ../../../Admin/admin.php?p=addUsers&e=BN2L&bn=$baseName&am=$amount");
}
elseif ($amount < 1)
{
    header("Location: ../../../Admin/admin.php?p=addUsers&e=AMLO&bn=$baseName&am=$amount");
}
elseif ($amount > 200) // TODO: Make this a config variable?
{
    header("Location: ../../../Admin/admin.php?p=addUsers&e=AMHI&bn=$baseName&am=$amount");
}
else
{
    // Looks OK, let's go for it
    $created = 0;
    $skipped = 0;
    for ($i= 1; $i <= $amount; $i++)
    {
        $userName = $baseName . $i;
        // Random passwords disallow admin logging in to use the accounts
        $password = $generator->generateRandStr(20);
        
        // Leaving the line below but commented out - could be used to 
        // allow admin to log in to the generated accounts and play them
        // Easily guessed by players so should only be used for testing
        //$password = $baseName . $i . 'PASS';
        
        $email = $baseName . $i . '@example.com';
        if ($postTribe == 0)
        {
            // Random Tribe
            $tribe = rand(1, 3);
        }
        else
        {
            // No error checking here but should be set to 1-3 from form
            $tribe = $postTribe;
        }
        // Create in a random quad
        $kid = rand(1,4);
        // Dont need to activate, not 100% sure we need to initialise $act
        $act = "";
        
        // Check username not already registered
        if($database->checkExist($userName,0)) 
        {
            // Name already used, do nothing except update $skipped
            $skipped ++;
        }
        else
        {
            // Register them and build the village
            $uid = $database->register($userName, md5($password), $email, $tribe ,$act);
            if($uid) 
            {
                /*
                 * @TODO
                 * 
                 * Allow option to create (random) bigger villages,
                 * upgrade fields, granary, warehouse, wall etc
                 * 
                 * Allow option to create (random) troops in some villages
                 * 
                 * Don't directly access the DB, create a $database function 
                 * where required
                 */
                
                // Show the dove in User Profile - will show this even if
                // beginners protection is not checked
                // Need a $database function for this 
                // (assuming we don't already have one as creating Natars also updates this way) 
                $q = "UPDATE " . TB_PREFIX . "users SET desc2 = '[#0]' WHERE id = $uid";
                mysql_query($q) or die(mysql_error());
               
                if (!$beginnersProtection)
                {
                    // No beginners protection so set it to current time
                    // TODO create a $database function for this
                    // also used in editProtection.php so assuming no function
                    // already exists
                    $protection = time();
                    mysql_query("UPDATE ".TB_PREFIX."users SET 
                        protect = '".$protection."' 
                        WHERE id = $uid") or die(mysql_error());
                }
                
                $database->updateUserField($uid,"act","",1);
                $wid = $database->generateBase($kid,0);
                $database->setFieldTaken($wid);
                $database->addVillage($wid,$uid,$userName,1);
                $database->addResourceFields($wid,$database->getVillageType($wid));
                $database->addUnits($wid);
                $database->addTech($wid);
                $database->addABTech($wid);
                $database->updateUserField($uid,"access",USER,1);
                $created ++;
            }
            else
            {
                // Do nothing as the user wasn't created or some unknown error
            }
        }
    }
    header("Location: ../../../Admin/admin.php?p=addUsers&g=OK&bn=$baseName&am=$created&sk=$skipped&bp=$beginnersProtection&tr=$postTribe");
}
?>
