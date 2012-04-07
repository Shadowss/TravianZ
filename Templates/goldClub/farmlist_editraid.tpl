<?php
if(isset($_GET['action']) == 'editSlot' && $_GET['eid']) {
$eiddata = $database->getRaidList($_GET['eid']);
$x = $eiddata['x'];
$y = $eiddata['y'];
$t1 = $eiddata['t1'];$t2 = $eiddata['t2'];$t3 = $eiddata['t3'];$t4 = $eiddata['t4'];$t5 = $eiddata['t5'];$t6 = $eiddata['t6'];$t7 = $eiddata['t7'];$t8 = $eiddata['t8'];$t9 = $eiddata['t9'];$t10 = $eiddata['t10'];
}

if(isset($_POST['action']) == 'editSlot' && $_POST['eid']) {

$Wref = $database->getVilWref($_POST['y'], $_POST['x']);
$type = $database->getVillageType2($Wref);
$oasistype = $type['oasistype'];
$vdata = $database->getVillage($Wref);

$troops = "".$_POST['t1']."+".$_POST['t2']."+".$_POST['t3']."+".$_POST['t4']."+".$_POST['t5']."+".$_POST['t6']."+".$_POST['t7']."+".$_POST['t8']."+".$_POST['t9']."+".$_POST['t10']."";

    if(!$_POST['x'] && !$_POST['y']){
    	$errormsg .= "مختصات را وارد کنید.";
    }elseif(!$_POST['x'] || !$_POST['y']){
    	$errormsg .= "مختصات را صحیح وارد کنید.";
    }elseif($oasistype == 0 && $vdata == 0){
    	$errormsg .= "در این مختصات دهکده ای وجود ندارد.";
    }elseif($troops == 0){
     	$errormsg .= "هیچ نیرویی انتخاب نشده.";
    }else{
    
		$Wref = $database->getVilWref($_POST['y'], $_POST['x']);
		$coor = $database->getCoor($village->wid);
			
            function getDistance($coorx1, $coory1, $coorx2, $coory2) {
   				$max = 2 * WORLD_MAX + 1;
   				$x1 = intval($coorx1);
   				$y1 = intval($coory1);
   				$x2 = intval($coorx2);
   				$y2 = intval($coory2);
   				$distanceX = min(abs($x2 - $x1), abs($max - abs($x2 - $x1)));
   				$distanceY = min(abs($y2 - $y1), abs($max - abs($y2 - $y1)));
   				$dist = sqrt(pow($distanceX, 2) + pow($distanceY, 2));
   				return round($dist, 1);
   			}
            $distance = getDistance($coor['x'], $coor['y'], $_POST['y'], $_POST['x']);
            
		$database->editSlotFarm($_GET['eid'], $_POST['lid'], $Wref, $_POST['x'], $_POST['y'], $distance, $_POST['t1'], $_POST['t2'], $_POST['t3'], $_POST['t4'], $_POST['t5'], $_POST['t6'], $_POST['t7'], $_POST['t8'], $_POST['t9'], $_POST['t10']);
        
        header("Location: build.php?id=39&t=99");
}
}


?>

<script type="text/javascript">
	var targets = {};

	function fillTargets()
	{
		var targetId = $('target_id');

		targetId.empty();

		var option = new Element('option',
		{
			'html': 'دهکده‌ای انتخاب کنید'
		});
		targetId.insert(option);

		$each(targets[lid], function(data)
		{
			var option = new Element('option',
			{
				'value': data.did,
				'html': data.name
			});
			targetId.insert(option);
		});
	}

	function getTargetsByLid()
	{
		var lidSelect = $('lid');
		lid = lidSelect.getSelected()[0].value;

		if (targets[lid])
		{
			fillTargets();
		}
		else
		{
			Travian.ajax(
			{
				data:
				{
					cmd: 'raidListTargets',
					'lid': lid
				},
				onSuccess: function(data)
				{
					targets[data.lid] = data.targets;
					fillTargets();
				}
			});

		}
	}

	function selectCoordinates()
	{
		var targetId = $('target_id');
		var did = targetId.getSelected()[0].value;

		if (did == '')
		{
			$('xCoordInput').value = '';
			$('yCoordInput').value = '';
		}
		else
		{
			var array;
			$each(targets[lid], function(data)
			{
				if (data.did == did)
				{
					array = data;
					return;
				}
			});


			$('xCoordInput').value = array.x;
			$('yCoordInput').value = array.y;
		}
	}

	var lid = <?php echo $_GET['lid']; ?>;targets[lid] = {};

</script>

<div id="raidListSlot">
	<h4>افزودن غارت</h4>
<font color="#FF0000"><b>    
<?php echo $errormsg; ?>
</b></font>
	
	<form id="edit_form" action="build.php?id=39&t=99&action=showSlot&eid=<?php echo $_GET['eid']; ?>" method="post">
		<div class="boxes boxesColor gray"><div class="boxes-tl"></div><div class="boxes-tr"></div><div class="boxes-tc"></div><div class="boxes-ml"></div><div class="boxes-mr"></div><div class="boxes-mc"></div><div class="boxes-bl"></div><div class="boxes-br"></div><div class="boxes-bc"></div><div class="boxes-contents cf">

<?php
$getlid = $database->getRaidList($_GET["eid"]);
$lid2 = $getlid['lid'];
?>
		<input type="hidden" name="action" value="editSlot">
		<input type="hidden" name="eid" value="<?php echo $_GET['eid']; ?>">
        <input type="hidden" name="lid" value="<?php echo $lid2; ?>">
			
			<table cellpadding="1" cellspacing="1" class="transparent">
				<tbody><tr>
					<th>لیست فارم‌ها:</th><?php echo $_GET["lid"]; ?>
					<td>
						<select onchange="getTargetsByLid();" id="lid" name="lid">
<?php
$sql = mysql_query("SELECT * FROM ".TB_PREFIX."farmlist WHERE owner = $session->uid ORDER BY name ASC");
while($row = mysql_fetch_array($sql)){ 
$lid = $row["id"];
$lname = $row["name"];
$lowner = $row["owner"];
$lwref = $row["wref"];
$lvname = $database->getVillageField($row["wref"], 'name');

	if($lid==$lid2){ $selected = 'selected=""'; }else{ $selected = ''; }
	echo '<option value="'.$lid.'" '.$selected.'>'.$lvname.' - '.$lname.'</option>';
}
?>	
						</select>
					</td>
				</tr>
				<tr>
					<th>هدفی انتخاب کنید:</th>
					<td class="target">
						
			<div class="coordinatesInput">
				<div class="xCoord">
					<label for="xCoordInput">X:</label>
					<input value="<?php echo $x; ?>" name="x" id="xCoordInput" class="text coordinates x ">
				</div>
				<div class="yCoord">
					<label for="yCoordInput">Y:</label>
					<input value="<?php echo $y; ?>" name="y" id="yCoordInput" class="text coordinates y ">
				</div>
				<div class="clear"></div>
			</div>
								<div class="targetSelect">
							<label class="lastTargets" for="last_targets">آخرین هدف‌ها:</label>
							<select id="target_id" name="target_id" onchange="selectCoordinates()">
								<option value="">دهکده‌ای انتخاب کنید</option>
							</select>
						</div>
						<div class="clear"></div>
					</td>
				</tr>
			</tbody></table>
			</div>
				</div>
		<?php include "Templates/goldClub/trooplist.tpl"; ?>

		
<button type="submit" value="ذخیره" name="save" id="save"><div class="button-container"><div class="button-position"><div class="btl"><div class="btr"><div class="btc"></div></div></div><div class="bml"><div class="bmr"><div class="bmc"></div></div></div><div class="bbl"><div class="bbr"><div class="bbc"></div></div></div></div><div class="button-contents">ذخیره</div></div></button>&nbsp;
<button type="button" value="حذف" name="delete" id="delete" onclick="return (function(){
				('واقعاً حذف شود؟').dialog(
				{
					onOkay: function(dialog, contentElement)
					{
						window.location.href = 'build.php?id=39&t=99&action=deleteSlot&eid=<?php echo $_GET['eid']; ?>'}
				});
				return false;
			})()">
<div class="button-container"><div class="button-position"><div class="btl"><div class="btr"><div class="btc"></div></div></div><div class="bml"><div class="bmr"><div class="bmc"></div></div></div><div class="bbl"><div class="bbr"><div class="bbc"></div></div></div></div><div class="button-contents">حذف</div></div></button>
</form>
</div>