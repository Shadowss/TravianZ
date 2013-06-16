<?php
include("next.tpl");
      		$artefact_2 = count($database->getOwnUniqueArtefactInfo2($session->uid,7,3,0));
			$artefact1_2 = count($database->getOwnUniqueArtefactInfo2($village->wid,7,1,1));
			$artefact2_2 = count($database->getOwnUniqueArtefactInfo2($session->uid,7,2,0));
			if($artefact_2 > 0){
			$artefact_bouns = 6;
			}else if($artefact1_2 > 0){
			$artefact_bouns = 3;
			}else if($artefact2_2 > 0){
			$artefact_bouns = 2;
			}else{
			$artefact_bouns = 1;
			}
			$good_effect = $bad_effect = 1;
			$foolartefact = $database->getFoolArtefactInfo(7,$village->wid,$seesion->uid);
			if(count($foolartefact) > 0){
			foreach($foolartefact as $arte){
			if($arte['bad_effect'] == 1){
			$bad_effect = $arte['effect2'];
			}else{
			$good_effect = $arte['effect2'];
			}
			}
			}
?>
<div id="build" class="gid23"><a href="#" onClick="return Popup(23,4);" class="build_logo">
	<img class="building g23" src="img/x.gif" alt="Cranny" title="Cranny" />
</a>
<h1>Cranny <span class="level">Level <?php echo $village->resarray['f'.$id]; ?></span></h1>
<p class="build_desc">The cranny is used to hide some of your resources when the village is attacked. These resources cannot be stolen.</p>


	<table cellpadding="1" cellspacing="1" id="build_value">
	<tr>
		<th>Currently hidden units per resource:</th>
<?php
		if($session->tribe == 3) {
		?>
		<td><b><?php echo $bid23[$village->resarray['f'.$id]]['attri']*2*CRANNY_CAPACITY; ?></b> units</td>
		<?php
			}else{
		?>
		<td><b><?php echo $bid23[$village->resarray['f'.$id]]['attri']*CRANNY_CAPACITY; ?></b> units</td>
		<?php
			}
		?>
	</tr>
	<tr>
<?php 
        if(!$building->isMax($village->resarray['f'.$id.'t'],$id)) {
		if($next<=10){
        ?>
		<th>Hidden units per resource at level <?php echo $village->resarray['f'.$id]+1+$loopsame+$doublebuild+$master; ?>:</th>
<?php
		if($session->tribe == 3) {
		?>
		<td><b><?php echo $bid23[$village->resarray['f'.$id]+1+$loopsame+$doublebuild+$master]['attri']*2*CRANNY_CAPACITY*$artefact_bouns*$good_effect/$bad_effect; ?></b> units</td>
		<?php
			}else{
		?>
		<td><b><?php echo $bid23[$village->resarray['f'.$id]+1+$loopsame+$doublebuild+$master]['attri']*CRANNY_CAPACITY*$artefact_bouns*$good_effect/$bad_effect; ?></b> units</td>
		<?php
			}}else{
        ?>
		<th>Hidden units per resource at level 20:</th>
<?php
		if($session->tribe == 3) {
		?>
		<td><b><?php echo $bid23[10]['attri']*2*CRANNY_CAPACITY*$artefact_bouns*$good_effect/$bad_effect; ?></b> units</td>
		<?php
			}else{
		?>
		<td><b><?php echo $bid23[10]['attri']*CRANNY_CAPACITY*$artefact_bouns*$good_effect/$bad_effect; ?></b> units</td>
		<?php
			}}}
        ?>
	</tr>
	</table>
<?php 
include("upgrade.tpl");
?>
</p></div>