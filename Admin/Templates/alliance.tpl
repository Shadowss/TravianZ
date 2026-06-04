<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : alliance.tpl                                              ##
##  Type           : Admin Panel Frontend                                      ##
## --------------------------------------------------------------------------- ##
##  Developed by   : Dzoki (Original)                                          ##
##  Refactored by  : Shadow                                                    ##
##  Redesign by    : Shadow                                                    ##
## --------------------------------------------------------------------------- ##
##  Contact        : cata7007@gmail.com                                        ##
##  Project        : TravianZ                                                  ##
##  GitHub         : https://github.com/Shadowss/TravianZ                      ##
## --------------------------------------------------------------------------- ##
##  License        : TravianZ Project                                          ##
##  Copyright      : TravianZ (c) 2010-2025. All rights reserved.              ##
## --------------------------------------------------------------------------- ##
#################################################################################

if($_GET['aid']) {
    $aid = (int)$_GET['aid'];
    $alidata = $database->getAlliance($aid);
    $aliusers = $database->getAllMember($aid);
    
    if($alidata && $aliusers) {
        $memberIDs = array_column($aliusers, 'id');
        $data = $database->getVSumField($memberIDs,"pop");
        $totalpop = 0;
        if(count($data)) {
            foreach($data as $row) { $totalpop += $row['Total']; }
        }
        $founder = $database->getUserField($alidata['leader'],"username",0);

		// --- FIX 1: calculeaza max membri dupa Ambasada (lvl 20 = 60) ---
		$embassyLevel = 0;
		$leaderId = (int)$alidata['leader'];

		// 1. ia toate satele liderului din vdata
		$villages = [];
		$vq = mysqli_query($GLOBALS["link"], "SELECT wref FROM ".TB_PREFIX."vdata WHERE owner = $leaderId");
		while($v = mysqli_fetch_assoc($vq)) {
		$villages[] = (int)$v['wref'];
	}

		if(!empty($villages)) {
		$in = implode(',', $villages);
    
		// 2. cauta in fdata, in TOATE coloanele *t, unde tipul = 18
		// MODIFICARE: punem MAX in jurul GREATEST ca sa luam cel mai mare nivel din TOATE orasele
		$sql = "SELECT MAX(
        GREATEST(
            IF(f1t=18,IFNULL(f1,0),0), IF(f2t=18,IFNULL(f2,0),0), IF(f3t=18,IFNULL(f3,0),0), IF(f4t=18,IFNULL(f4,0),0), IF(f5t=18,IFNULL(f5,0),0),
            IF(f6t=18,IFNULL(f6,0),0), IF(f7t=18,IFNULL(f7,0),0), IF(f8t=18,IFNULL(f8,0),0), IF(f9t=18,IFNULL(f9,0),0), IF(f10t=18,IFNULL(f10,0),0),
            IF(f11t=18,IFNULL(f11,0),0), IF(f12t=18,IFNULL(f12,0),0), IF(f13t=18,IFNULL(f13,0),0), IF(f14t=18,IFNULL(f14,0),0), IF(f15t=18,IFNULL(f15,0),0),
            IF(f16t=18,IFNULL(f16,0),0), IF(f17t=18,IFNULL(f17,0),0), IF(f18t=18,IFNULL(f18,0),0), IF(f19t=18,IFNULL(f19,0),0), IF(f20t=18,IFNULL(f20,0),0),
            IF(f21t=18,IFNULL(f21,0),0), IF(f22t=18,IFNULL(f22,0),0), IF(f23t=18,IFNULL(f23,0),0), IF(f24t=18,IFNULL(f24,0),0), IF(f25t=18,IFNULL(f25,0),0),
            IF(f26t=18,IFNULL(f26,0),0), IF(f27t=18,IFNULL(f27,0),0), IF(f28t=18,IFNULL(f28,0),0), IF(f29t=18,IFNULL(f29,0),0), IF(f30t=18,IFNULL(f30,0),0),
            IF(f31t=18,IFNULL(f31,0),0), IF(f32t=18,IFNULL(f32,0),0), IF(f33t=18,IFNULL(f33,0),0), IF(f34t=18,IFNULL(f34,0),0), IF(f35t=18,IFNULL(f35,0),0),
            IF(f36t=18,IFNULL(f36,0),0), IF(f37t=18,IFNULL(f37,0),0), IF(f38t=18,IFNULL(f38,0),0), IF(f39t=18,IFNULL(f39,0),0), IF(f40t=18,IFNULL(f40,0),0),
            IF(f99t=18,IFNULL(f99,0),0)
        )
		) as emb_lvl
		FROM ".TB_PREFIX."fdata WHERE vref IN ($in)";

    $embQ = mysqli_query($GLOBALS["link"], $sql);
    if($er = mysqli_fetch_assoc($embQ)) {
        $embassyLevel = (int)$er['emb_lvl'];
    }
	}

		$maxMembers = $embassyLevel * 3;
		if($maxMembers < 3) $maxMembers = 3;

        // --- FIX 3: calculeaza rank real dupa puncte ---
        $allianceRank = 1;
        $rankSql = "SELECT a.id, COALESCE(SUM(v.pop),0) as pts FROM ".TB_PREFIX."alidata a LEFT JOIN ".TB_PREFIX."users u ON u.alliance=a.id LEFT JOIN ".TB_PREFIX."vdata v ON v.owner=u.id GROUP BY a.id ORDER BY pts DESC";
        $rankRes = mysqli_query($GLOBALS["link"], $rankSql);
        while($rr = mysqli_fetch_assoc($rankRes)){ if((int)$rr['id'] == $aid) break; $allianceRank++; }
?>
<style>
.ali-wrap{max-width:1200px;margin:0 auto;font-family:Verdana,Arial;}
.ali-head{background:linear-gradient(#fff,#f2f2f2);border:1px solid #c9c9c9;border-radius:5px;padding:14px 16px;margin-bottom:12px;display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:10px;}
.ali-head h1{margin:0;font-size:22px;color:#222;}
.ali-head h1 span.tag{background:#71D000;color:#fff;padding:2px 8px;border-radius:3px;font-size:14px;margin-right:8px;}
.ali-head .stats{display:flex;gap:16px;font-size:12px;color:#555;}
.ali-head .stats b{color:#000;font-size:13px;}

.grid-2{display:grid;grid-template-columns:380px 1fr;gap:12px;}
@media(max-width:950px){.grid-2{grid-template-columns:1fr;}}

.card{background:#fff;border:1px solid #d5d5d5;border-radius:4px;overflow:hidden;box-shadow:0 1px 2px rgba(0,0,0,.04);margin-bottom:12px;}
.card h3{margin:0;padding:8px 12px;background:#f7f7f7;border-bottom:1px solid #e0e0e0;font-size:13px;text-transform:uppercase;color:#444;letter-spacing:.4px;}
.card .body{padding:12px;}

/* --- FIX 2: fundal alb, text negru lizibil --- */
.info-list{width:100%;font-size:12px;border-collapse:collapse;}
.info-list th{width:130px;text-align:left;color:#333;font-weight:600;padding:8px;background:#f8fafc;border-bottom:1px solid #eee;vertical-align:top;}
.info-list td{padding:8px;color:#000;background:#ffffff;border-bottom:1px solid #f5f5f5;}
.info-list td a{color:#0066cc;text-decoration:none;}
.info-list td a:hover{text-decoration:underline;}

.positions{display:flex;flex-direction:column;gap:8px;max-height:220px;overflow:auto;padding-right:4px;}
.pos-item{border:1px solid #eee;border-radius:3px;padding:6px 8px;background:#fafafa;}
.pos-item .name{font-weight:bold;color:#222;}
.pos-item .rank{font-size:11px;color:#71D000;margin-left:4px;}
.pos-item .perms{font-size:11px;color:#666;margin-top:3px;}

.desc-box{background:#fcfcfc;border:1px solid #eee;border-radius:3px;padding:10px;min-height:120px;font-size:12px;line-height:1.5;white-space:pre-wrap;}

.members-table,.mini-table{width:100%;border-collapse:collapse;font-size:12px;}
.members-table th,.mini-table th{background:#f0f0f0;padding:7px;border:1px solid #ddd;text-align:left;font-weight:bold;color:#333;}
.members-table td,.mini-table td{padding:6px;border:1px solid #eee;}
.members-table tr:hover{background:#f9fff0;}
.members-table td.ra{width:30px;text-align:center;color:#888;}
.members-table td.on{width:24px;text-align:center;}

.badge-cap{padding:2px 6px;border-radius:3px;font-weight:bold;color:#fff;}
.badge-cap.ok{background:#2a7;}.badge-cap.full{background:#c00;}

.btn-row{display:flex;gap:8px;margin-top:10px;flex-wrap:wrap;}
.btn{padding:6px 12px;border-radius:3px;font-size:12px;text-decoration:none;border:1px solid #bbb;background:#f5f5f5;color:#333;}
.btn:hover{background:#fff;}
.btn.edit{border-color:#71D000;background:#eaffd5;color:#2a5a00;}
.btn.del{border-color:#c00;background:#ffe5e5;color:#900;}

.diplo-type{font-size:11px;padding:2px 5px;border-radius:2px;color:#fff;}
.diplo-1{background:#2a7;}.diplo-2{background:#06a;}.diplo-3{background:#c00;}
</style>

<div class="ali-wrap">
    <!-- HEADER -->
    <div class="ali-head">
        <h1><span class="tag"><?php echo htmlspecialchars($alidata['tag']); ?></span> <?php echo htmlspecialchars($alidata['name']); ?></h1>
        <div class="stats">
            <div>👑 Founder: <b><a href="?p=player&uid=<?php echo $alidata['leader']; ?>"><?php echo htmlspecialchars($founder); ?></a></b></div>
            <div>👥 Members: <b><?php echo count($aliusers); ?>/<?php echo $maxMembers; ?></b></div>
            <div>🏆 Points: <b><?php echo number_format($totalpop); ?></b></div>
        </div>
    </div>

<!-- ALLIANCE DETAILS -->
<div class="card">
    <h3>📋 Alliance Details</h3>
    <div class="body">
        <table class="info-list">
            <tr><th>Tag</th><td><?php echo htmlspecialchars($alidata['tag']); ?></td></tr>
            <tr><th>Name</th><td><?php echo htmlspecialchars($alidata['name']); ?></td></tr>
            <tr><th>Rank</th><td><b>#<?php echo $allianceRank; ?></b></td></tr>
            <tr><th>Points</th><td><?php echo number_format($totalpop); ?></td></tr>
            <tr><th>Capacity</th><td>
                <?php $now=count($aliusers); $cls=$now>=$maxMembers?'full':'ok'; ?>
                <span class="badge-cap <?php echo $cls; ?>"><?php echo "$now/$maxMembers"; ?></span>
            </td></tr>
        </table>

        <div style="margin-top:12px;">
            <b style="font-size:12px;">🛡 Alliance Positions</b>
            <div class="positions">
            <?php
            $sql = "SELECT * FROM ".TB_PREFIX."ali_permission WHERE alliance = $aid";
            $result = mysqli_query($GLOBALS["link"], $sql);
            while($row = mysqli_fetch_assoc($result)){
                $player = mysqli_fetch_assoc(mysqli_query($GLOBALS["link"], "SELECT username FROM ".TB_PREFIX."users WHERE id = ".(int)$row['uid']));
                $perms = [];
                if($row['opt1']) $perms[]="Assign"; if($row['opt2']) $perms[]="Kick";
                if($row['opt3']) $perms[]="Edit Desc"; if($row['opt4']) $perms[]="Invite";
                if($row['opt5']) $perms[]="Forum"; if($row['opt6']) $perms[]="Diplomacy";
                if($row['opt7']) $perms[]="MM";
                echo '<div class="pos-item"><span class="name"><a href="admin.php?p=player&uid='.$row['uid'].'">'.htmlspecialchars($player['username']).'</a></span> <span class="rank">'.htmlspecialchars($row['rank']).'</span><div class="perms">'.implode(' • ', $perms).'</div></div>';
            }
            ?>
            </div>
        </div>

        <div class="btn-row">
            <a class="btn edit" href="?p=editAli&aid=<?php echo $alidata['id'];?>">✏ Edit Alliance</a>
            <a class="btn del" href="?p=delAli&aid=<?php echo $alidata['id'];?>" onclick="return confirm('Delete alliance?')">🗑 Delete</a>
        </div>
    </div>
</div>

<!-- ALLIANCE DESCRIPTION - ACUM SUB DETAILS -->
<div class="card">
    <h3>📖 Alliance Description</h3>
    <div class="body"><div class="desc-box" style="min-height:120px;"><?php echo nl2br(htmlspecialchars($alidata['desc'])); ?></div></div>
</div>

<!-- ALLIANCE NOTICE - ACUM SUB DESCRIPTION -->
<div class="card">
    <h3>📢 Alliance Notice</h3>
    <div class="body"><div class="desc-box"><?php echo nl2br(htmlspecialchars($alidata['notice'])); ?></div></div>
</div>

    <!-- MEMBERS -->
    <div class="card">
        <h3>👥 Members (<?php echo count($aliusers); ?>)</h3>
        <div class="body" style="padding:0;">
            <table class="members-table">
                <thead><tr><th>#</th><th>Player</th><th>Population</th><th>Villages</th><th></th></tr></thead>
                <tbody>
                <?php
                $rank=0;
                $database->getProfileVillages($memberIDs);
                foreach($aliusers as $user){
                    $rank++;
                    $TotalUserPop = $database->getVSumField($user['id'],"pop");
                    $TotalVillages = $database->getProfileVillages($user['id']);
                    echo "<tr>";
                    echo "<td class='ra'>$rank.</td>";
                    echo "<td><a href='admin.php?p=player&uid=".$user['id']."'>".htmlspecialchars($user['username'])."</a></td>";
                    echo "<td>".(int)$TotalUserPop."</td>";
                    echo "<td>".count($TotalVillages)."</td>";
                    echo "<td class='on'>";
                    if((time()-600) < $user['timestamp']) echo "<img class='online1' src='img/x.gif' title='Online now'>";
                    elseif((time()-86400) < $user['timestamp']) echo "<img class='online2' src='img/x.gif' title='<1 day'>";
                    elseif((time()-259200) < $user['timestamp']) echo "<img class='online3' src='img/x.gif' title='<3 days'>";
                    elseif((time()-604800) < $user['timestamp']) echo "<img class='online4' src='img/x.gif' title='<7 days'>";
                    else echo "<img class='online5' src='img/x.gif' title='Offline'>";
                    echo "</td></tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>

<!-- NEWS - FULL WIDTH -->
<div class="card">
    <h3>📰 Alliance News</h3>
    <div class="body" style="padding:0;max-height:300px;overflow:auto;">
        <table class="mini-table">
            <thead><tr><th>Event</th><th style="width:130px;">Time</th></tr></thead>
            <tbody>
            <?php
            $sql = "SELECT * FROM ".TB_PREFIX."ali_log WHERE aid = $aid ORDER BY date DESC LIMIT 50";
            $result = mysqli_query($GLOBALS["link"], $sql);
            while($row = mysqli_fetch_assoc($result)){
                $comment = html_entity_decode($row['comment']);
                $comment = preg_replace('/<a href="spieler\.php\?uid=(\d+)">([^<]+)<\/a>/i', '<a href="admin.php?p=player&uid=$1">$2</a>', $comment);
                $comment = strip_tags($comment, '<a>');
                echo '<tr><td>'.$comment.'</td><td>'.date('d.m.Y H:i', $row['date']).'</td></tr>';
            }
            ?>
            </tbody>
        </table>
    </div>
</div>

<!-- DIPLOMACY - FULL WIDTH -->
<div class="card">
    <h3>🤝 Diplomacy</h3>
    <div class="body" style="padding:0;">
        <table class="mini-table">
            <thead><tr><th>Alliance</th><th>Type</th><th style="width:60px;">Status</th></tr></thead>
            <tbody>
            <?php
            $sql = "SELECT * FROM ".TB_PREFIX."diplomacy WHERE alli1 = $aid OR alli2 = $aid ORDER BY accepted DESC";
            $result = mysqli_query($GLOBALS["link"], $sql);
            while($row = mysqli_fetch_assoc($result)){
                $other = ($row['alli1']==$aid) ? $row['alli2'] : $row['alli1'];
                $ally = mysqli_fetch_assoc(mysqli_query($GLOBALS["link"], "SELECT tag FROM ".TB_PREFIX."alidata WHERE id = ".(int)$other));
                $type = $row['type']==1?'Confederation':($row['type']==2?'NAP':'War');
                $cls = 'diplo-'.$row['type'];
                $acc = $row['accepted'] ? '<img src="../../gpack/travian_default/img/a/acc.gif">' : '<img src="../../gpack/travian_default/img/a/del.gif">';
                echo '<tr><td><a href="admin.php?p=alliance&aid='.$other.'">'.htmlspecialchars($ally['tag']).'</a></td><span class="diplo-type '.$cls.'">'.$type.'</span></td><td>'.$acc.'</td></tr>';
            }
            ?>
            </tbody>
        </table>
    </div>
</div>

    <?php include("allymedals.tpl"); ?>
</div>

<?php
    } else {
        echo "<div style='padding:30px;text-align:center;'>Alliance not found... <a href='javascript:history.go(-1)'>Back</a></div>";
    }
}
?>