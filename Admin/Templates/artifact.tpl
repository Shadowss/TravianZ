<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : artifact.tpl                                              ##
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

include_once("../GameEngine/Artifacts.php");

$artifact = reset($database->getOwnArtefactInfo($_GET['did']));
$artifactOfTheFool = !empty($artifact) && $artifact['type'] == 8;
$artifactInfo = $artifact ? Artifacts::getArtifactInfo($artifact) : null;
?>
<style>
.artifact-modern{font-family:system-ui}
.artifact-table{width:100%;border-collapse:collapse;font-size:12.5px;table-layout:fixed}
.artifact-table th{background:#f8fafc;padding:6px 4px;text-align:center;font-weight:600;color:#475569;border-bottom:1px solid #e5e7eb;font-size:11px;text-transform:uppercase;letter-spacing:.2px}
.artifact-table td{padding:8px 4px;border-bottom:1px solid #f1f5f9;text-align:center;vertical-align:middle;color:#334155;word-break:break-word}
.artifact-table td.icon{width:26px}
.artifact-table td.del{width:26px}
.artifact-table td.name{font-weight:600;color:#0f172a}
.artifact-table tr:last-child td{border-bottom:0}
.artifact-empty{padding:14px;text-align:center;color:#94a3b8;font-style:italic;font-size:12.5px}
.artifact-foot{padding:6px 2px 0;font-size:12.5px}
.artifact-foot a{color:#16a34a;text-decoration:none;font-weight:500}
.artifact-foot a:hover{text-decoration:underline}
</style>

<div class="artifact-modern">
<?php if(empty($artifact)): ?>
    <div class="artifact-empty"><?php echo NO_ARTEFACTS; ?></div>
<?php else: ?>
    <table class="artifact-table">
        <thead>
            <tr>
                <th class="del"></th>
                <th class="icon"></th>
                <th>Name</th>
                <th>Bonus</th>
                <th>Area of effect</th>
                <th>Time of conquer</th>
                <th>Time of activation</th>
                <?php if($artifactOfTheFool) echo '<th>Next activation</th>'; ?>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="del"><a href="?action=delArtifact&artid=<?php echo $artifact['id']; ?>&del=0" onclick="return del('arti',<?php echo $artifact['id']; ?>)"><img src="../img/admin/del.gif"></a></td>
                <td class="icon"><img class="artefact_icon_<?php echo $artifact['type']; ?>" src="../img/x.gif"></td>
                <td class="name"><?php echo htmlspecialchars($artifact['name']); ?></td>
                <td><?php echo $artifactInfo['bonus']; ?></td>
                <td><?php echo $artifactInfo['effectInfluence']; ?></td>
                <td><?php echo date("d.m.Y H:i:s", $artifact['conquered']); ?></td>
                <td><b><?php echo $artifactInfo['active']; ?></b></td>
                <?php if($artifactOfTheFool) echo '<td>'.$artifactInfo['nextEffect'].'</td>'; ?>
            </tr>
        </tbody>
    </table>
<?php endif; ?>

<?php if($village['owner'] != 3 && !empty($artifact)): ?>
    <div class="artifact-foot">
        <a href="admin.php?action=returnArtifact&artid=<?php echo $artifact['id']; ?>">Return to Natars</a>
    </div>
<?php endif; ?>
</div>