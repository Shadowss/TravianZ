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
    $reason = trim($_POST['reason'] ?? '');
    $time = isset($_POST['time']) ? (int)$_POST['time'] : 0;

    // =========================
    // ❌ BLOCK SYSTEM USERS
    // =========================
	
    $blocked = array(1,2,3,4,5);

    // =========================
    // VALIDARE UID
    // =========================
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
            // CHECK ALREADY ACTIVE BAN
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

			// =========================
			// INSERT BAN (ACTIVE)
			// =========================
			$currentTime = time();

			$stmt = $database->dblink->prepare("
				INSERT INTO `".TB_PREFIX."banlist`
				(uid, name, reason, time, end, admin, active)
				VALUES
				(?, ?, ?, ?, ?, 0, 1)
			");

			if ($stmt) {
			// i = integer, s = string
			$stmt->bind_param("issii", $uid, $name, $reason, $currentTime, $end);
			$stmt->execute();
			$stmt->close();
			} else {
			$error = "Database error (ban insert): " . $database->dblink->error;
			}

			// =========================
			// BLOCK USER ACCESS
			// =========================
			if (empty($error)) {
			$stmt2 = $database->dblink->prepare("
				UPDATE `".TB_PREFIX."users`
				SET access = 0
				WHERE id = ?
				LIMIT 1
			");

			if ($stmt2) {
			$stmt2->bind_param("i", $uid);
			$stmt2->execute();
			$stmt2->close();
			} else {
			$error = "Database error (access update): " . $database->dblink->error;
    }
}
			if (empty($error)) {
			$success = "User has been banned successfully!";
}
            }
        }
    }
}

// =========================
// ACTIVE BANS
// =========================
$bannedUsers = $admin->search_banned();

// =========================
// HISTORY (inactive bans)
// =========================
$banHistory = mysqli_query($database->dblink, "
    SELECT * 
    FROM ".TB_PREFIX."banlist 
    WHERE active = 0 
    ORDER BY id DESC 
    LIMIT 50
");
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
                <td><input type="text" class="fm" name="uid"></td>
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
     ACTIVE BANS
     ========================= -->
<table id="member" cellpadding="1" cellspacing="1">
    <thead>
        <tr>
            <th colspan="6">Active Bans (<?php echo count($bannedUsers); ?>)</th>
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
        foreach($bannedUsers as $b)
        {
            $name = $database->getUserField($b['uid'],'username',0);

            if($name == '')
            {
                $name = $b['name'];
                $link = "<span class=\"c b\">[".$name."]</span>";
            }
            else
            {
                $link = '<a href="?p=player&uid='.$b['uid'].'">'.$name.'</a>';
            }

            $end = $b['end'] ? date("d.m.y H:i",$b['end']) : '*';

            echo '
            <tr>
                <td>'.$link.'</td>
                <td>'.date("d.m.y H:i",$b['time']).' - '.$end.'</td>
                <td>'.$b['reason'].'</td>
                <td class="on">
                    <a href="?action=delBan&uid='.$b['uid'].'&id='.$b['id'].'">
                        <img src="../img/admin/del.gif" class="del">
                    </a>
                </td>
            </tr>';
        }
    }
    else
    {
        echo '<tr><td colspan="6">No active bans</td></tr>';
    }
    ?>
    </tbody>
</table>

<br><br>

<!-- =========================
     BAN HISTORY
     ========================= -->
<table id="member" cellpadding="1" cellspacing="1">
    <thead>
        <tr>
            <th colspan="6">Ban History (Inactive)</th>
        </tr>
        <tr>
            <td><b>Username</b></td>
            <td><b>Length</b></td>
            <td><b>Reason</b></td>
        </tr>
    </thead>

    <tbody>
    <?php
    if($banHistory && mysqli_num_rows($banHistory) > 0)
    {
        while($h = mysqli_fetch_assoc($banHistory))
        {
            $end = $h['end'] ? date("d.m.y H:i",$h['end']) : '*';

            echo '
            <tr>
                <td>'.$h['name'].'</td>
                <td>'.date("d.m.y H:i",$h['time']).' - '.$end.'</td>
                <td>'.$h['reason'].'</td>
            </tr>';
        }
    }
    else
    {
        echo '<tr><td colspan="3">No ban history</td></tr>';
    }
    ?>
    </tbody>
</table>