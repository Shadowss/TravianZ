<?php
#########################################################
## Filename addUsers.php                               ##
## Created by: KFCSpike                                ##
## Contributors: KFCSpike                              ##
## Improve by: ronix                                   ##
## License: TravianZ Project                           ##
## Copyright: TravianZ (c) 2014. All rights reserved.  ##
#########################################################

use App\Entity\User;

// go max 5 levels up - we don't have folders that go deeper than that
$autoprefix = '';
for ($i = 0; $i < 5; $i++) {
    $autoprefix = str_repeat('../', $i);
    if (file_exists($autoprefix.'autoloader.php')) {
        // we have our path, let's leave
        break;
    }
}

include_once($autoprefix."GameEngine/config.php");
include_once($autoprefix."GameEngine/Session.php");
include_once($autoprefix."GameEngine/Automation.php");
include_once($autoprefix."GameEngine/Database.php");

$wgarray=array(1=>1200,1700,2300,3100,4000,5000,6300,7800,9600,11800,14400,17600,21400,25900,31300,37900,45700,55100,66400,80000);

foreach ($_POST as $key => $value) {
    $_POST[$key] = $database->escape($value);
}

$id = (int) $_POST['id'];
$baseName = $_POST['users_base_name'];
$amount = (int) $_POST['users_amount'];
$beginnersProtection = $_POST['users_protection'];
$postTribe = (int) $_POST['tribe'];

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
    $addUnitsWrefs = [];
    $addTechWrefs = [];
    $addABTechWrefs = [];

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
        if(User::exists($database, $userName))
        {
            // Name already used, do nothing except update $skipped
            $skipped ++;
        }
        else
        {
            // Register them and build the village
            $uid = $database->register($userName, password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]), $email, $tribe, $act);
            if($uid)
            {
                /*
*   [MENTION=6887]Todo[/MENTION]
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
                $q = "UPDATE " . TB_PREFIX . "users SET desc2 = '[#0]' WHERE id = ".(int) $uid;
                mysqli_query($GLOBALS["link"], $q) or die(mysqli_error($database->dblink));

                if (!$beginnersProtection)
                {
                    // No beginners protection so set it to current time
                    // TODO create a $database function for this
                    // also used in editProtection.php so assuming no function
                    // already exists
                    $protection = time();
                    mysqli_query($GLOBALS["link"], "UPDATE ".TB_PREFIX."users SET
                                        protect = '".$protection."'
                                        WHERE id = ".(int) $uid) or die(mysqli_error($database->dblink));
                }

                $database->updateUserField($uid,"act","",1);
                $wid = $database->generateBase($kid, 1);
                $database->setFieldTaken($wid);

                //calculate random generate value and level building
                $rand_resource=rand(30000, 80000);
                $level_storage=rand(10, 20);
                $cap_storage=$wgarray[$level_storage]*(STORAGE_BASE/800);
                $rand_resource=($rand_resource>$cap_storage)? $cap_storage:$rand_resource;

                //insert village with all resource and building with random level
                $time = time();
                $q = "INSERT INTO ".TB_PREFIX."vdata (`wref`,`owner`,`name`,`capital`,`pop`,`cp`,`celebration`,`type`,`wood`,`clay`,`iron`,`maxstore`,`crop`,`maxcrop`,`lastupdate`,`loyalty`,`exp1`,`exp2`,`exp3`,`created`) values (".(int) $wid.",".(int) $uid.",'".$userName."\'s village',1,200,1,0,0,$rand_resource,$rand_resource,$rand_resource,$cap_storage,$rand_resource,$cap_storage,$time,100,0,0,0,$time)";
                mysqli_query($GLOBALS["link"], $q) or die(mysqli_error($database->dblink));
                $q = "insert  into ".TB_PREFIX."fdata (`vref`,`f1`,`f1t`,`f2`,`f2t`,`f3`,`f3t`,`f4`,`f4t`,`f5`,`f5t`,`f6`,`f6t`,`f7`,`f7t`,`f8`,`f8t`,`f9`,`f9t`,`f10`,`f10t`,`f11`,`f11t`,`f12`,`f12t`,`f13`,`f13t`,`f14`,`f14t`,`f15`,`f15t`,`f16`,`f16t`,`f17`,`f17t`,`f18`,`f18t`,`f19`,`f19t`,`f20`,`f20t`,`f21`,`f21t`,`f22`,`f22t`,`f23`,`f23t`,`f24`,`f24t`,`f25`,`f25t`,`f26`,`f26t`,`f27`,`f27t`,`f28`,`f28t`,`f29`,`f29t`,`f30`,`f30t`,`f31`,`f31t`,`f32`,`f32t`,`f33`,`f33t`,`f34`,`f34t`,`f35`,`f35t`,`f36`,`f36t`,`f37`,`f37t`,`f38`,`f38t`,`f39`,`f39t`,`f40`,`f40t`,`f99`,`f99t`,`wwname`) values ($wid ,".rand(5,10).",1,".rand(5,10).",4,".rand(5,10).",1,".rand(5,10).",3,".rand(5,10).",2,".rand(5,10).",2,".rand(5,10).",3,".rand(5,10).",4,".rand(5,10).",4,".rand(5,10).",3,".rand(5,10).",3,".rand(5,10).",4,".rand(5,10).",4,".rand(5,10).",1,".rand(5,10).",4,".rand(5,10).",2,".rand(5,10).",1,".rand(5,10).",2,".rand(2,5).",8,".rand(5,20).",37,".rand(10,20).",26,".rand(10,20).",22,".rand(10,20).",19,".rand(2,5).",9,$level_storage,11,".rand(10,20).",15,".rand(10,20).",20,0,0,".rand(10,15).",17,$level_storage,10,".rand(5,10).",12,0,0,10,23,0,0,0,0,0,0,0,0,".rand(5,10).",18,".rand(5,10).",16,0,0,0,0,'World Wonder')";
                mysqli_query($GLOBALS["link"], $q);
                $pop = $automation->recountPop($wid);
                $cp = $automation->recountPop($wid);
                $addUnitsWrefs[] = $wid;
                $addTechWrefs[] = $wid;
                $addABTechWrefs[] = $wid;
                $database->updateUserField($uid,"access",USER,1);

                //insert units randomly generate the number of troops
                $q = "UPDATE " . TB_PREFIX . "units SET u".(($tribe-1)*10+1)." = ".rand(100, 2000).", u".(($tribe-1)*10+2)." = ".rand(100, 2400).", u".(($tribe-1)*10+3)." = ".rand(100, 1600).", u".(($tribe-1)*10+4)." = ".rand(100, 1500).", u".(($tribe-1)*10+5)." = " .rand(48, 1700).", u".(($tribe-1)*10+6)." = ".rand(60, 1800)." WHERE vref = '".$wid."'";
                mysqli_query($GLOBALS["link"], $q);

                $created ++;

            }
            else
            {
                // Do nothing as the user wasn't created or some unknown error
            }
        }
    }

    $database->addUnits($addUnitsWrefs);
    $database->addTech($addTechWrefs);
    $database->addABTech($addABTechWrefs);

    header("Location: ../../../Admin/admin.php?p=addUsers&g=OK&bn=$baseName&am=$created&sk=$skipped&bp=$beginnersProtection&tr=$postTribe");
}
?>