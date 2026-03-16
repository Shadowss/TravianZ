<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       users.tpl                                                   ##
##  Purpose:       Admin users list with pagination                            ##
##                                                                             ##
#################################################################################

$page = isset($_GET['upage']) ? (int)$_GET['upage'] : 1;
if ($page < 1) {
    $page = 1;
}

$perPage = 100;
$offset = ($page - 1) * $perPage;

$totalRes = mysqli_query($GLOBALS['link'], "SELECT COUNT(*) AS cnt FROM " . TB_PREFIX . "users");
$totalRow = $totalRes ? mysqli_fetch_assoc($totalRes) : ['cnt' => 0];
$totalUsers = (int)($totalRow['cnt'] ?? 0);
$totalPages = max(1, (int)ceil($totalUsers / $perPage));

if ($page > $totalPages) {
    $page = $totalPages;
    $offset = ($page - 1) * $perPage;
}

$sql = "SELECT id, username, email, access, tribe, gold, timestamp " .
       "FROM " . TB_PREFIX . "users " .
       "ORDER BY id DESC LIMIT " . (int)$perPage . " OFFSET " . (int)$offset;
$result = mysqli_query($GLOBALS['link'], $sql);

function tribeLabel($tribe) {
    $tribe = (int)$tribe;
    if ($tribe === 1) return 'Roman';
    if ($tribe === 2) return 'Teuton';
    if ($tribe === 3) return 'Gaul';
    return 'N/A';
}
?>

<table id="member" cellpadding="1" cellspacing="1">
    <thead>
        <tr>
            <th colspan="7">Users list (<?php echo $totalUsers; ?>)</th>
        </tr>
        <tr>
            <td>ID</td>
            <td>Username</td>
            <td>Email</td>
            <td>Access</td>
            <td>Tribe</td>
            <td>Gold</td>
            <td>Last activity</td>
        </tr>
    </thead>
    <tbody>
        <?php if ($result && mysqli_num_rows($result) > 0) { ?>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo (int)$row['id']; ?></td>
                    <td>
                        <a href="?p=player&amp;uid=<?php echo (int)$row['id']; ?>">
                            <?php echo htmlspecialchars((string)$row['username'], ENT_QUOTES, 'UTF-8'); ?>
                        </a>
                    </td>
                    <td>
                        <?php if (!empty($row['email'])) { ?>
                            <a href="mailto:<?php echo htmlspecialchars((string)$row['email'], ENT_QUOTES, 'UTF-8'); ?>">
                                <?php echo htmlspecialchars((string)$row['email'], ENT_QUOTES, 'UTF-8'); ?>
                            </a>
                        <?php } else { ?>
                            -
                        <?php } ?>
                    </td>
                    <td><?php echo (int)$row['access']; ?></td>
                    <td><?php echo tribeLabel($row['tribe']); ?></td>
                    <td><?php echo (int)$row['gold']; ?></td>
                    <td><?php echo !empty($row['timestamp']) ? date('d.m.Y H:i:s', (int)$row['timestamp']) : '-'; ?></td>
                </tr>
            <?php } ?>
        <?php } else { ?>
            <tr>
                <td colspan="7" class="hab">No users found.</td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<div style="margin-top:10px;">
    <?php if ($page > 1) { ?>
        <a href="?p=users&amp;upage=<?php echo $page - 1; ?>">&laquo; Previous</a>
    <?php } ?>
    <span style="margin:0 10px;">Page <?php echo $page; ?> / <?php echo $totalPages; ?></span>
    <?php if ($page < $totalPages) { ?>
        <a href="?p=users&amp;upage=<?php echo $page + 1; ?>">Next &raquo;</a>
    <?php } ?>
</div>
