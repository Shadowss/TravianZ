<?php
include_once("GameEngine/Artifacts.php");

$ownArtifacts = $database->getOwnArtefactsInfo($session->uid);
$wref = $village->wid;
$coor = $database->getCoor($wref);

?>
<body>
<div class="gid27">
<table id="own" cellpadding="1" cellspacing="1">
<thead>
<tr>
<th colspan="4"><?php echo OWN_ARTIFACTS; ?></th>
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

if (empty($ownArtifacts)) echo '<tr><td colspan="4" class="none">'.ANY_ARTIFACTS.'</td></tr>';
else 
{
    foreach($ownArtifacts as $ownArtifact){
        $coor2 = $database->getCoor($ownArtifact['vref']);
        $ownArtifactInfo = Artifacts::getArtifactInfo($ownArtifact);
        echo '<tr><td class="icon"><img class="artefact_icon_' . $ownArtifact['type'] . '" src="img/x.gif"></td>';
        echo '<td class="nam">
                <a href="build.php?id='.$id . '&show='.$ownArtifact['id'].'">' . $ownArtifact['name'] . '</a> <span class="bon">' . $ownArtifact['effect'] . '</span>
                <div class="info">
                    Treasury <b>'.$ownArtifactInfo['requiredLevel'].'</b>, Effect <b>'.$ownArtifactInfo['effectInfluence'].'</b>
                </div>
              </td>';
        echo '<td class="pla"><a href="karte.php?d=' . $ownArtifact['vref'] . '&c=' . $generator->getMapCheck($ownArtifact['vref']) . '">' . $database->getVillageField($ownArtifact['vref'], "name") . '</a></td>';
        echo '<td class="dist">'.date("d.m.Y H:i", $ownArtifact['conquered']) . '</td></tr>';
    }
}

?>
</tbody>
</table>

<table id="near" cellpadding="1" cellspacing="1">
<thead>
<tr>
<th colspan="4"><?php echo ARTIFACTS_AREA; ?></th>
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
if(count($artifacts) == 0) echo '<td colspan="4" class="none">'.NO_ARTIFACTS_AREA.'</td>';
else
{
    $rows = [];
    foreach($artifacts as $artifact){
        $coordinates = $database->getCoor($artifact['vref']);

        $distance = $database->getDistance($village->coor['x'], $village->coor['y'], $coordinates['x'], $coordinates['y']);
        $rows[(string)$distance] = $artifact;  
    }

    ksort($rows);

    foreach($rows as $distance => $row) {
        echo '<tr>
                <td class="icon"><img class="artefact_icon_'.$row['type'].'" src="img/x.gif" alt="" title=""></td>
                <td class="nam">
                <a href="build.php?id='.$id.'&show='.$row['id'].'">'.$row['name'].'</a> <span class="bon">'.$row['effect'].'</span>
              <div class="info">';
        
        $artifactInfo = Artifacts::getArtifactInfo($row);
        
        echo '<div class="info">'.TREASURY.' <b>'.$artifactInfo['requiredLevel'] . '</b>, '.EFFECT.' <b>'.$artifactInfo['effectInfluence'].'</b>
              </div></td><td class="pla">
              <a href="karte.php?d='.$row['vref'].'&c='.$generator->getMapCheck($row['vref']).'">'.$database->getUserField($row['owner'], "username", 0).'</a>
              </td>
                <td class="dist">'.$distance.'</td>
              </tr>';
    }
}

?>
</tbody>
</table>
</div>