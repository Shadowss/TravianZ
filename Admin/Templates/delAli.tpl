<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : delAli.tpl 		                                       ##
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
$aid = (int)$_GET['aid'];
$alidata = $database->getAlliance($aid);
if(!$alidata){ echo "<div class='card'><div class='body'>Alliance not found</div></div>"; return; }
$members = $database->getAllMember($aid);
?>
<style>
.del-wrap{max-width:600px;margin:30px auto;font-family:Verdana;}
.del-card{background:#fff;border:1px solid #c00;border-radius:5px;overflow:hidden;}
.del-card h3{margin:0;padding:10px 14px;background:#ffe5e5;color:#900;border-bottom:1px solid #c00;font-size:14px;}
.del-card.body{padding:16px;font-size:13px;line-height:1.5;}
.del-card.warn{background:#fff3cd;border:1px solid #ffc107;padding:8px;margin:10px 0;border-radius:3px;color:#664d03;}
.btn{padding:8px 14px;border-radius:3px;text-decoration:none;font-size:13px;border:1px solid #bbb;display:inline-block;}
.btn.del{background:#c00;color:#fff;border-color:#900;}
.btn.cancel{background:#f5f5f5;color:#333;margin-left:8px;}
</style>

<div class="del-wrap">
<div class="del-card">
    <h3>🗑 Delete Alliance</h3>
    <div class="body">
        <p>Are you sure you want to permanently delete?:</p>
        <p style="font-size:16px;margin:10px 0;"><b>[<?php echo htmlspecialchars($alidata['tag']);?>] <?php echo htmlspecialchars($alidata['name']);?></b></p>
        <p>Members: <b><?php echo count($members);?></b> | Points: <b><?php echo number_format($database->getVSumField(array_column($members,'id'),'pop')[0]['Total']?? 0);?></b></p>

        <div class="warn">⚠ All members will be removed from the alliance, permissions, diplomacy, logs and the alliance forum will be deleted. The action is irreversible!</div>

        <form method="POST" action="../GameEngine/Admin/Mods/delAli.php" onsubmit="return confirm('Last warning: DELETE PERMANENTLY?');">
            <input type="hidden" name="aid" value="<?php echo $aid;?>">
            <input type="hidden" name="admid" value="<?php echo $_SESSION['id'];?>">
            <button type="submit" class="btn del">YES, DELETE</button>
            <a href="admin.php?p=alliance&aid=<?php echo $aid;?>" class="btn cancel">Cancel</a>
        </form>
    </div>
</div>
</div>