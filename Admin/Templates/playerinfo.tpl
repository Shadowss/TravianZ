<? php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : playerinfo.tpl                           			       ##
##  Type           : Admin Panel Frontend                                      ##
## --------------------------------------------------------------------------- ##
##  Developed by   : ronix (Original)                                          ##
##  Refactored by  : iopietro                                                  ##
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

?>

<table id="profile" cellpadding="1" cellspacing="1" >
<style>
#profile{width:100%;border-collapse:separate;border-spacing:0;background:#fff;border:1px solid #e5e7eb;border-radius:12px;overflow:hidden;box-shadow:0 4px 12px rgba(0,0,0,.05);font-family:system-ui}
#profile thead tr:first-child th{background:linear-gradient(135deg,#0f172a,#1e293b);color:#fff;padding:6px 10px;font-size:14px;font-weight:600;text-align:left}
#profile thead tr:first-child th a{color:#93c5fd;text-decoration:none}
#profile thead tr:first-child th a:hover{text-decoration:underline}
#profile thead tr:nth-child(2) td{background:#f8fafc;color:#64748b;font-size:11px;text-transform:uppercase;letter-spacing:.5px;padding:4px 8px;border-bottom:1px solid #e5e7eb;font-weight:600}
#profile tbody td.empty{height:2px;background:#fff;border:0}
#profile td.details{width:32%;vertical-align:top;padding:0;background:#fff}
#profile td.details table{width:100%;border-collapse:collapse}
#profile td.details th{width:38%;text-align:left;padding:3px 8px;font-size:12px;color:#64748b;font-weight:500;border-bottom:1px solid #f1f5f9;background:#fcfcfd;line-height:1.2}
#profile td.details td{padding:3px 8px;font-size:12px;color:#0f172a;border-bottom:1px solid #f1f5f9;line-height:1.2}
#profile td.details tr:hover td,#profile td.details tr:hover th{background:#f8fafc}
#profile td.details tr:last-child th,#profile td.details tr:last-child td{border-bottom:0}
#profile td.desc1{vertical-align:top;padding:0;background:#fff;border-left:1px solid #e5e7eb;width:68%}
.desc-block{padding:6px 8px;border-bottom:1px solid #f1f5f9}
.desc-block:last-child{border-bottom:0}
.desc-title{font-size:11px;text-transform:uppercase;color:#64748b;font-weight:600;margin-bottom:4px;letter-spacing:.4px}
.desc1div,.desc2div{min-height:0;max-height:160px;overflow:auto;font-size:12px;line-height:1.3;color:#334155;text-align:center}
#profile a{color:#2563eb;text-decoration:none}
#profile a:hover{text-decoration:underline}
#profile .rn3{color:#dc2626!important}
.badge-tribe{display:inline-block;padding:1px 6px;border-radius:5px;font-size:10.5px;font-weight:600;background:#e2e8f0;color:#334155}
</style>

    <thead>
        <tr>
            <th colspan="2">Player <a href="admin.php?p=player&uid=<?php echo $user['id'];?>"><?php echo $user['username'];?></a></th>
        </tr>
        <tr>
            <td>Details</td>
            <td>Description</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td class="empty"></td><td class="empty"></td>
        </tr>
        <tr>
            <td class="details">
                <table cellpadding="0" cellspacing="0">
                    <tr>
                        <th>Rank</th>
                        <td><?php $ranking->procRankArray();echo $ranking->getUserRank($user['id']);?></td>
                    </tr>
                    <tr>
                        <th>Tribe</th>
                        <td>
                            <?php
                                if($user['tribe'] == 1) { echo '<span class="badge-tribe">Roman</span>'; }
                                else if($user['tribe'] == 2) { echo '<span class="badge-tribe">Teutons</span>'; }
                                else if($user['tribe'] == 3) { echo '<span class="badge-tribe">Gauls</span>'; }
                                else if($user['tribe'] == 4) { echo '<span class="badge-tribe">Nature</span>'; }
                                else if($user['tribe'] == 5) { echo '<span class="badge-tribe">Natars</span>'; }
                          ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Alliance</th>
                        <td>
                            <?php
                                if($user['alliance'] == 0) { echo "-"; }
                                else { echo "<a href=\"?p=alliance&aid=".$user['alliance']."\">".$database->getAllianceName($user['alliance'])."</a>"; }
                          ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Villages</th>
                        <td><?php echo count($varray);?></td>
                    </tr>
                    <tr>
                        <th>Population</th>
                        <td><?php echo number_format($totalpop,0,',','.'); ?> 
						<a href="?action=recountPopUsr&uid=<?php echo $user['id'];?>" title="Recount population" style="margin-left:6px;vertical-align:middle;display:inline-flex">
						<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#64748b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
						<path d="M21 12a9 9 0 1 1-3-6.7"/>
						<path d="M21 3v6h-6"/>
					</svg>
					</a>
					</td>
                    </tr>
                    <tr>
                        <th>Age</th>
                        <td>
                            <?php
                                if(isset($user['birthday']) && $user['birthday']!= 0) {
                                    $age = date("Y")-substr($user['birthday'],0,4);
                                    echo $age;
                                } else {
                                    echo "<span style='color:#dc2626'>Not Available</span>";
                                }
                          ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Gender</th>
                        <td>
                            <?php
                                if(isset($user['gender']) && $user['gender']!= 0) {
                                    $gender = ($user['gender']== 1)? "Male" : "Female";
                                    echo $gender;
                                } else {
                                    echo "<span style='color:#dc2626'>Not Available</span>";
                                }
                          ?>
                        </td>
                    </tr>

					<tr>
						<th>Username</th>
						<td><?php echo htmlspecialchars($user['username']?? '');?></td>
					</tr>

					<tr>
						<th>Location</th>
						<td><?php echo htmlspecialchars($user['location']?? '');?></td>
					</tr>

					<tr>
						<th>Password</th>
						<td>•••••••</td>
					</tr>

					<tr>
						<?php include("playerplusbonus.tpl");?>
					<tr>
						<th>Email</th>
						<td><?php echo htmlspecialchars($user['email']?? '');?></td>
					</tr>

                    <tr>
                        <th>Quest</th>
                        <td>
                            <?php
                                $quest = $user['quest'];
                                if($quest == 1) { $questname = "Woodcutter"; }
                                elseif($quest ==2) {$questname = "Crop"; }
                                elseif($quest ==3) {$questname = "Your Villages Name"; }
                                elseif($quest ==4) {$questname = "Other Players"; }
                                elseif($quest ==5) {$questname = "Two Building Order"; }
                                elseif($quest ==6) {$questname = "Messages"; }
                                elseif($quest ==7) {$questname = "Huge Army!"; }
                                elseif($quest ==8) {$questname = "Everything to 1!"; }
                                elseif($quest ==9) {$questname = "Dove of Peace"; }
                                elseif($quest ==10) {$questname = "Cranny"; }
                                elseif($quest ==11) {$questname = "To Two!"; }
                                elseif($quest ==12) {$questname = "Instruction"; }
                                elseif($quest ==13) {$questname = "Main Building"; }
                                elseif($quest ==14) {$questname = "Advanced!" ;}
                                elseif($quest ==15) {$questname = "Weapons or Dough"; }
                                elseif($quest ==16) {$questname = "Military: Rally Point"; }
                                elseif($quest ==17) {$questname = "Military: Barracks"; }
                                elseif($quest ==18) {$questname = "Military: Train 2 Troops"; }
                                elseif($quest ==19) {$questname = "Economy: Granary"; }
                                elseif($quest ==20) {$questname = "Economy: Warehouse"; }
                                elseif($quest ==21) {$questname = "Economy: Marketplace"; }
                                elseif($quest ==22) {$questname = "Everything to 2!"; }
                                elseif($quest ==28) {$questname = "Alliance : Join to one"; }
                                elseif($quest ==29) {$questname = "Main Building to 5"; }
                                elseif($quest ==30) {$questname = "Granary to Level 3"; }
                                elseif($quest ==31) {$questname = "Warehouse to Level 7"; }
                                elseif($quest ==32) {$questname = "Everything to 5!"; }
                                elseif($quest ==33) {$questname = "Palace or Residence"; }
                                elseif($quest ==34) {$questname = "3 settlers"; }
                                elseif($quest ==35) {$questname = "New Village"; }
                                elseif($quest ==36) {$questname = "Build a Wall/Palisade"; }
                                elseif($quest >=37) {$questname = "Finish"; }
                                else { $questname = "Unknown"; }
                                echo $quest." - ".$questname;
                          ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="empty"></td>
                    </tr>

                    <?php
                        if($_SESSION['access'] == ADMIN) {
                            echo '<tr><td colspan="2"><a href="?p=editUser&uid='.$user['id'].'">&raquo; Edit User</a></td></tr>';
                        }
                        if($_SESSION['access'] == ADMIN) {
                            echo '<tr><td colspan="2"><a class="rn3" href="?p=deletion&uid='.$user['id'].'">&raquo; Delete User</a></td></tr>';
                        }
                  ?>

                    <tr><td colspan="2"><a href="?p=ban&uid=<?php echo $user['id'];?>">&raquo; Ban User</a></td></tr>
					<tr><td colspan="2"><a href="?p=Newmessage&uid=<?php echo $user['id'];?>">&raquo; Send Message</a></td></tr>
					<?php if($_SESSION['access'] == ADMIN) { ?>
					<tr><td colspan="2"><a href="?p=editPlus&uid=<?php echo $user['id'];?>">&raquo; Edit Plus & Res Bonus</a></td></tr>
					<tr><td colspan="2"><a href="?p=editSitter&uid=<?php echo $user['id'];?>">&raquo; Edit Sitters</a></td></tr>
					<tr><td colspan="2"><a href="?p=editProtection&uid=<?php echo $user['id'];?>">&raquo; Edit Protection</a></td></tr>
					<tr><td colspan="2"><a href="?p=editPassword&uid=<?php echo $user['id'];?>">&raquo; Edit Password</a></td></tr>
					<tr><td colspan="2"><a href="?p=editOverall&uid=<?php echo $user['id'];?>">&raquo; Edit Overall Off & Def</a></td></tr>
					<tr><td colspan="2"><a href="?p=editWeek&uid=<?php echo $user['id'];?>">&raquo; Edit Weekly Off, Def, Raid</a></td></tr>
					<?php } ?>
					<tr><td colspan="2"><a href="?p=userlogin&uid=<?php echo $user['id'];?>">&raquo; User Login Log</a></td></tr>
					<tr><td colspan="2"><a href="?p=userillegallog&uid=<?php echo $user['id'];?>">&raquo; User Illegal Log</a></td></tr>
                    <tr>
                        <td colspan="2" class="desc2">
                            <div class="desc2div">
								<center><?php echo nl2br($profiel[0]?? '');?></center>
						    </div>
                        </td>
                    </tr>
                </table>
            <td class="desc1"><div class="desc1div">
                <center><?php echo nl2br($profiel[1]?? '');?></center>
            </div></td>
        </tr>
    </tbody>
</table>