<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
#################################################################################

$error = '';
$success = '';

// =========================
// HANDLE ADD BAN
// =========================
if(isset($_POST['action']) && $_POST['action'] == 'addBan')
{
    $uid = isset($_POST['uid']) ? (int)$_POST['uid'] : 0;
    $reason = $_POST['reason'] ?? '';
    $time = isset($_POST['time']) ? (int)$_POST['time'] : 0;

    // =========================
    // ❌ BLOCK SYSTEM USERS
    // =========================
    $blocked = array(1,2,3,4,5);

    if($uid <= 0)
    {
        $error = "Invalid User ID!";
    }
    elseif(in_array($uid, $blocked))
    {
        $error = "You cannot ban system accounts (Support / Nature / Natars / Taskmaster / Multihunter)!";
    }
    else
    {
        // =========================
        // ❌ CHECK IF USER EXISTS
        // =========================
        $userCheck = mysqli_query($database->dblink, "
            SELECT id, username 
            FROM ".TB_PREFIX."users 
            WHERE id = $uid 
            LIMIT 1
        ");

        if(!$userCheck || mysqli_num_rows($userCheck) == 0)
        {
            $error = "This user does not exist!";
        }
        else
        {
            // =========================
            // ❌ CHECK ALREADY BANNED
            // =========================
            $check = mysqli_query($database->dblink, "
                SELECT id 
                FROM ".TB_PREFIX."banlist 
                WHERE uid = $uid 
                AND active = 1 
                LIMIT 1
            ");

            if(mysqli_num_rows($check) > 0)
            {
                $error = "User is already banned!";
            }
            else
            {
                $user = mysqli_fetch_assoc($userCheck);
                $name = $user['username'];

                $end = ($time > 0) ? (time() + $time) : 0;

                mysqli_query($database->dblink, "
                    INSERT INTO ".TB_PREFIX."banlist
                    (uid,name,reason,time,end,admin,active)
                    VALUES
                    ($uid,'$name','$reason',".time().",$end,0,1)
                ");

                $success = "User has been banned successfully!";
            }
        }
    }
}

// =========================
// BAN LIST
// =========================
$bannedUsers = $admin->search_banned();
?>

<style>
.del {width:12px; height:12px; background-image: url(img/admin/icon/del.gif);}

.errorBox {
    background:#ffdddd;
    border:1px solid #ff0000;
    color:#a10000;
    padding:10px;
    margin:10px 0;
    font-weight:bold;
}

.successBox {
    background:#ddffdd;
    border:1px solid #00aa00;
    color:#006600;
    padding:10px;
    margin:10px 0;
    font-weight:bold;
}
</style>

<!-- =========================
     MESSAGES
     ========================= -->
<?php if(!empty($error)) { ?>
    <div class="errorBox"><?php echo $error; ?></div>
<?php } ?>

<?php if(!empty($success)) { ?>
    <div class="successBox"><?php echo $success; ?></div>
<?php } ?>

<!-- =========================
     BAN FORM
     ========================= -->
<form action="" method="post">
    <input type="hidden" name="action" value="addBan">

    <table id="member" cellpadding="1" cellspacing="1">
        <thead>
            <tr>
                <th colspan="6">Ban</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td>User ID</td>
                <td>
                    <input type="text" class="fm" name="uid">
                </td>
            </tr>

            <tr>
                <td>Reason</td>
                <td>
                    <select name="reason" class="fm">
                        <?php
                        $arr = array('Pushing','Cheat','Hack','Bug','Bad Name','Multi Account','Swearing');
                        foreach($arr as $r)
                        {
                            echo '<option value="'.$r.'">'.$r.'</option>';
                        }
                        ?>
                    </select>
                </td>
            </tr>

            <tr>
                <td>Duration</td>
                <td>
                    <select name="time" class="fm">
                        <?php
                        $arr = array(1,2,5,10,12);
                        foreach($arr as $r)
                        {
                            echo '<option value="'.($r*3600).'">'.$r.' hour/s</option>';
                        }

                        $arr2 = array(1,2,5,10,30,50,90);
                        foreach($arr2 as $r)
                        {
                            echo '<option value="'.($r*3600*24).'">'.$r.' day/s</option>';
                        }

                        echo '<option value="0">Forever</option>';
                        ?>
                    </select>
                </td>
            </tr>

            <tr>
                <td colspan="2" class="on">
                    <input type="image" src="../img/admin/b/ok1.gif" value="submit">
                </td>
            </tr>
        </tbody>
    </table>
</form>

<!-- =========================
     BAN LIST
     ========================= -->
<table id="member" cellpadding="1" cellspacing="1">
    <thead>
        <tr>
            <th colspan="6">Banned Players (<?php echo count($bannedUsers); ?>)</th>
        </tr>
        <tr>
            <td><b>Username</b></td>
            <td><b>Length</b></td>
            <td><b>Reason</b></td>
            <td></td>
        </tr>
    </thead>

    <tbody>
    <?php
    if($bannedUsers)
    {
        for ($i = 0; $i <= count($bannedUsers)-1; $i++)
        {
            $name = $database->getUserField($bannedUsers[$i]['uid'],'username',0);

            if($name == '')
            {
                $name = $bannedUsers[$i]['name'];
                $link = "<span class=\"c b\">[".$name."]</span>";
            }
            else
            {
                $link = '<a href="?p=player&uid='.$bannedUsers[$i]['uid'].'">'.$name.'</a>';
            }

            $end = $bannedUsers[$i]['end']
                ? date("d.m.y H:i",$bannedUsers[$i]['end'])
                : '*';

            echo '
            <tr>
                <td>'.$link.'</td>
                <td>'.date("d.m.y H:i",$bannedUsers[$i]['time']).' - '.$end.'</td>
                <td>'.$bannedUsers[$i]['reason'].'</td>
                <td class="on">
                    <a href="?action=delBan&uid='.$bannedUsers[$i]['uid'].'&id='.$bannedUsers[$i]['id'].'">
                        <img src="../img/admin/del.gif" class="del">
                    </a>
                </td>
            </tr>';
        }
    }
    else
    {
        echo '<tr><td colspan="6" class="on">No Players are Banned</td></tr>';
    }
    ?>
    </tbody>
</table>