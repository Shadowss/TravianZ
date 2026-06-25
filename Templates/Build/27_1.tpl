<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : TREASURY ARTEFACTS AREEA        	                       ##
##  Type           : BUILDING TEMPLATE                                         ##
## --------------------------------------------------------------------------- ##
##  Refactored by  : Shadow                                                    ##
##  Redesign by    : Shadow                                                    ##
## --------------------------------------------------------------------------- ##
##  Contact        : cata7007@gmail.com                                        ##
##  Project        : TravianZ                                                  ##
##  Test Server    : https://travianz.org                                      ##
##  GitHub         : https://github.com/Shadowss/TravianZ                      ##
## --------------------------------------------------------------------------- ##
##  License        : TravianZ Project                                          ##
##  Copyright      : TravianZ (c) 2010-2026. All rights reserved.              ##
## --------------------------------------------------------------------------- ##
#################################################################################


include_once("GameEngine/Artifacts.php");

$ownArtifacts = $database->getOwnArtefactsInfo($session->uid ?? 0);
$wref = $village->wid ?? 0;
?>
<body>
<div class="gid27">
<table id="own" cellpadding="1" cellspacing="1">
<thead>
<tr>
<th colspan="4"><?php echo OWN_ARTEFACTS; ?></th>
</tr>
<tr>
<td></td>
<td><?php echo NAME; ?></td>
<td><?php echo VILLAGE; ?></td>
<td><?php echo CONQUERED; ?></td>
</tr>
</thead>

<tbody>
<?php
if (empty($ownArtifacts)) {
    echo '<tr><td colspan="4" class="none">'.ANY_ARTEFACTS.'</td></tr>';
} else {
    foreach($ownArtifacts as $ownArtifact){
        $ownArtifactInfo = Artifacts::getArtifactInfo($ownArtifact);
        $conquered = !empty($ownArtifact['conquered']) ? date("d.m.Y H:i", $ownArtifact['conquered']) : '-';
        $villageName = $database->getVillageField($ownArtifact['vref'], "name") ?? '-';

        echo '<tr><td class="icon"><img class="artefact_icon_' . $ownArtifact['type'] . '" src="img/x.gif"></td>';
        echo '<td class="nam">
                <a href="build.php?id='.$id . '&show='.$ownArtifact['id'].'">' . $ownArtifact['name'] . '</a> <span class="bon">' . $ownArtifact['effect'] . '</span>
                <div class="info">
                    Treasury <b>'.($ownArtifactInfo['requiredLevel'] ?? 0).'</b>, Effect <b>'.($ownArtifactInfo['effectInfluence'] ?? '').'</b>
                </div>
              </td>';
        echo '<td class="pla"><a href="karte.php?d=' . $ownArtifact['vref'] . '&c=' . $generator->getMapCheck($ownArtifact['vref']) . '">' . $villageName . '</a></td>';
        echo '<td class="dist">'.$conquered.'</td></tr>';
    }
}
?>
</tbody>
</table>

<table id="near" cellpadding="1" cellspacing="1">
<thead>
<tr>
<th colspan="4"><?php echo ARTEFACTS_AREA; ?></th>
</tr>
<tr>
<td></td>
<td><?php echo NAME; ?></td>
<td><?php echo PLAYER; ?></td>
<td><?php echo DISTANCE; ?></td>
</tr>
</thead>

<tbody>
<?php
$artifacts = $database->getArtifactsBysize([1, 2, 3]);
if(count($artifacts) == 0) {
    echo '<tr><td colspan="4" class="none">'.NO_ARTEFACTS_AREA.'</td></tr>';
} else {
    $rows = [];
    foreach($artifacts as $artifact){
        $coordinates = $database->getCoor($artifact['vref']);
        $distance = $database->getDistance($village->coor['x'], $village->coor['y'], $coordinates['x'], $coordinates['y']);
        // unique key prevents overwriting when 2 artifacts are at the same distance
        $rows[$distance.'_'.$artifact['id']] = ['dist' => $distance, 'data' => $artifact];
    }

    ksort($rows);

    foreach($rows as $row) {
        $distance = $row['dist'];
        $artifact = $row['data'];
        $artifactInfo = Artifacts::getArtifactInfo($artifact);
        $ownerName = $database->getUserField($artifact['owner'], "username", 0) ?? 'Natars';

        echo '<tr>
                <td class="icon"><img class="artefact_icon_'.$artifact['type'].'" src="img/x.gif" alt="" title=""></td>
                <td class="nam">
                    <a href="build.php?id='.$id.'&show='.$artifact['id'].'">'.$artifact['name'].'</a> <span class="bon">'.$artifact['effect'].'</span>
                    <div class="info">'.TREASURY.' <b>'.($artifactInfo['requiredLevel'] ?? 0).'</b>, '.EFFECT.' <b>'.($artifactInfo['effectInfluence'] ?? '').'</b></div>
                </td>
                <td class="pla">
                    <a href="karte.php?d='.$artifact['vref'].'&c='.$generator->getMapCheck($artifact['vref']).'">'.$ownerName.'</a>
                </td>
                <td class="dist">'.$distance.'</td>
              </tr>';
    }
}
?>
</tbody>
</table>
</div>