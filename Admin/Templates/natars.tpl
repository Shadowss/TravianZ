<?php 

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       natars.tpl                                                  ##
##  Developed by:  Shadow                                                      ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2026. All rights reserved.                ##
##                                                                             ##
#################################################################################

$deletedArtifacts = $database->getDeletedArtifacts();

?>

<style>
h1 {
    margin-top: 20px;
    font-size: 18px;
    border-bottom: 1px solid #ccc;
    padding-bottom: 5px;
    font-family: Arial, sans-serif;
}

table#member,
table#show_artefacts {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 25px;
    background: #f9f9f9;
    font-family: Arial, sans-serif;
    font-size: 13px;
}

table#member th,
table#show_artefacts th {
    background: #333;
    color: #fff;
    padding: 8px;
    font-size: 13px;
    font-weight: normal;
}

table#member td,
table#show_artefacts td {
    border: 1px solid #ddd;
    padding: 6px;
    text-align: center;
    vertical-align: middle;
    font-size: 13px;
}

.none {
    text-align: center;
    padding: 10px;
    color: #777;
}

.icon img {
    width: 24px;
    height: 24px;
}

.bon {
    color: #2b8a3e;
    font-weight: bold;
}

a {
    text-decoration: none;
    color: #1a5fb4;
    font-size: 13px;
}

a:hover {
    text-decoration: underline;
}
</style>

<link href="../<?php echo GP_LOCATE; ?>lang/en/lang.css?f4b7d" rel="stylesheet">
<link href="../<?php echo GP_LOCATE; ?>lang/en/compact.css?f4b7i" rel="stylesheet">

<h1>WW villages management</h1>

<form method="post" action="../Admin/admin.php?action=addWWVillages">
<table id="show_artefacts">
<thead>
<tr>
    <th colspan="2">Add WW village(s)</th>
</tr>
<tr>
    <td>Number</td>
    <td>Player id</td>
</tr>
</thead>

<tbody>
<tr>
    <td><input type="number" name="numberOfVillages" value="1" min="1" max="999"></td>
    <td><input type="text" name="playerId" value="<?php echo Artifacts::NATARS_UID; ?>"></td>
</tr>

<tr>
    <td colspan="2">
        <button class="trav_buttons" onclick="this.disabled=true;this.form.submit();">
            Add
        </button>
    </td>
</tr>
</tbody>
</table>

<h1>Artifacts management</h1>

<form method="post" action="../Admin/admin.php?action=addArtifacts">
<table id="show_artefacts">
<thead>
<tr>
    <th colspan="4">Add artifact(s)</th>
</tr>
<tr>
    <td>Icon</td>
    <td>Type</td>
    <td>Quantity</td>
    <td>Player id</td>
</tr>
</thead>

<tbody>
<tr>
    <td class="icon">
        <img id="artifactImage" class="artefact_icon_1" src="../img/x.gif">
    </td>
    <td>
        <select name="selectedArtifact" id="selectedArtifact" onchange="changeArtifactImage()">
        <?php 
        $artifactArrays = array_merge(Artifacts::NATARS_ARTIFACTS, Artifacts::NATARS_WW_BUILDING_PLANS);

        foreach($artifactArrays as $desc => $artifactType){
            foreach($artifactType as $artifact){
                echo '<option value="'.$artifact['type'].':'.$artifact['size'].':'.$desc.'">'.$artifact['name'].'</option>';
            }
        }
        ?>
        </select>
    </td>
    <td><input type="number" name="artifactQuantity" value="1" min="1" max="999"></td>
    <td><input type="text" name="playerId" value="<?php echo Artifacts::NATARS_UID; ?>"></td>
</tr>

<tr>
    <td colspan="4">
        <button class="trav_buttons" onclick="this.disabled=true;this.form.submit();">
            Add
        </button>
    </td>
</tr>
</tbody>
</table>
</form>

<h1>Deleted artifact(s)</h1>

<table id="show_artefacts">
<thead>
<tr>
    <th colspan="8">Deleted artifact(s)</th>
</tr>
<tr>
    <td></td>
    <td></td>
    <td>Name</td>
    <td>Bonus</td>
    <td>Effect</td>
    <td>Time</td>
    <td>Old owner</td>
    <td>Old village</td>
</tr>
</thead>

<tbody>
<?php 
if(empty($deletedArtifacts)){
    echo '<tr><td colspan="8" class="none">No artifacts</td></tr>';
} else {

    foreach($deletedArtifacts as $artifact){
        $info = Artifacts::getArtifactInfo($artifact);
?>
<tr>
    <td>
        <a href="?action=returnArtifact&artid=<?php echo $artifact['id']; ?>&del=1">
            <img src="../../img/admin/acc.gif">
        </a>
    </td>

    <td class="icon">
        <img class="artefact_icon_<?php echo $artifact['type']; ?>" src="../img/x.gif">
    </td>

    <td><?php echo $artifact['name']; ?></td>
    <td><?php echo $info['bonus']; ?></td>
    <td><?php echo $info['effectInfluence']; ?></td>
    <td><?php echo date("d.m.Y H:i:s", $artifact['conquered']); ?></td>

    <td>
        <?php 
        $u = $database->getUserField($artifact['owner'], "username", 0);
        echo ($u != "[?]")
            ? '<a href="?p=player&uid='.$artifact['owner'].'">'.$u.'</a>'
            : '<span style="color:gray">'.$u.'</span>';
        ?>
    </td>

    <td>
        <?php 
        $v = $database->getVillageField($artifact['vref'], "name");
        echo ($v != "[?]")
            ? '<a href="?p=village&did='.$artifact['vref'].'">'.$v.'</a>'
            : '<span style="color:gray">'.$v.'</span>';
        ?>
    </td>
</tr>
<?php
    }
}
?>
</tbody>
</table>

<h1>Artifacts overview</h1>

<table id="show_artefacts">
<thead>
<tr>
    <th>Icon</th>
    <th>Name</th>
    <th>Effect</th>
    <th>Player</th>
    <th>Alliance</th>
</tr>
</thead>

<tbody>
<?php

// SAFE CALL 1: small
$small = $database->getArtifactsBysize(1);

// SAFE CALL 2: large + unique
$big = $database->getArtifactsBysize(2);

// SAFE CALL 3: unique artifacts (size 3)
$unique = $database->getArtifactsBysize(3);

if(empty($small) && empty($big) && empty($unique)){
    echo '<tr><td colspan="5" class="none">No artifacts found</td></tr>';
} else {

    $all = array();

    if(is_array($small)) $all = array_merge($all, $small);
    if(is_array($big)) $all = array_merge($all, $big);
    if(is_array($unique)) $all = array_merge($all, $unique);

    foreach($all as $a){

        $player = $database->getUserField($a['owner'], "username", 0);
        $aid = $database->getUserField($a['owner'], "alliance", 0);
        $ally = $database->getAllianceName($aid);

        echo '<tr>
            <td class="icon">
                <img src="../img/x.gif" class="artefact_icon_'.(int)$a['type'].'">
            </td>

            <td>'.$a['name'].'</td>

            <td><span class="bon">'.$a['effect'].'</span></td>

            <td>
                <a href="?p=player&uid='.$a['owner'].'">'.$player.'</a>
            </td>

            <td>
                <a href="?p=alliance&aid='.$aid.'">'.$ally.'</a>
            </td>
        </tr>';
    }
}
?>
</tbody>
</table>
</form>


<script>
function changeArtifactImage(){
    var v = document.getElementById("selectedArtifact").value.split(":")[0];
    document.getElementById("artifactImage").className = "artefact_icon_" + v;
}
</script>