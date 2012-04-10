<?php
	$loopsame = ($building->isCurrent($id) || $building->isLoop($id))?1:0;
	$doublebuild = ($building->isCurrent($id) && $building->isLoop($id))?1:0;
?>
<div id="build" class="gid36"><h1>Trapper <span class="level">Level <?php echo $village->resarray['f'.$id]; ?></span></h1>
<p class="build_desc">
	<a href="#" onClick="return Popup(36,4, 'gid');"
		class="build_logo"> <img
		class="building g36"
		src="img/x.gif" alt="Trapper"
		title="Trapper" /> </a>
	The trapper protects your village with well hidden traps. This means that unwary enemies can be imprisoned and won't be able to harm your village anymore. </p>

<table cellpadding="1" cellspacing="1" id="build_value">
	<tr>
		<th>Currect maximum traps to train:</th>

		<td><b><?php echo $bid36[$village->resarray['f'.$id]]['attri']; ?></b> Traps</td>
	</tr>
	<tr>
	<?php 
        if(!$building->isMax($village->resarray['f'.$id.'t'],$id)) {
		$next = $village->resarray['f'.$id]+1+$loopsame+$doublebuild;
		if($next<=20){
        ?>
		<th>Maximum traps to train at level <?php echo $next; ?>:</th>
		<td><b><?php echo $bid36[$next]['attri']; ?></b> Traps</td>
        <?php
            }else{
		?>
		<th>Maximum traps to train at level 20:</th>
		<td><b><?php echo $bid36[20]['attri']; ?></b> Traps</td>
		<?php
			}
			}
        ?>

	</tr>
</table>
<p>Your currently have <b>0</b> traps, <b>0</b> of which are occupied.</p>
<form method="POST" name="snd" action="build.php"><input type="hidden"
	name="id" value="22" /> <input type="hidden"
	name="z" value="17" /> <input type="hidden" name="a"
	value="2" />

<table cellpadding="1" cellspacing="1" class="build_details">
	<thead>

		<tr>
			<td>Name</td>
			<td>Quantity</td>
			<td>Max</td>
		</tr>
	</thead>
	<tbody>

		<tr>
			<td class="desc">
			<div class="tit"><img class="unit u99" src="img/x.gif"
				alt="Trap"
				title="Trap" /> <a href="#"
				onClick="return Popup(36,4,'gid');">Trap</a> <span class="info">(Available: 0)</span>
			</div>
			<div class="details">
<span><img class="r1" src="img/x.gif"
				alt="Lumber" title="Lumber" />20|</span><span><img class="r2" src="img/x.gif"
				alt="Clay" title="Clay" />30|</span><span><img class="r3" src="img/x.gif"
				alt="Iron" title="Iron" />10|</span><span><img class="r4" src="img/x.gif"
				alt="Crop" title="Crop" />20|</span><span><img class="r5" src="img/x.gif" alt="Crop consumption"
				title="Crop consumption" />0|<img class="clock" src="img/x.gif"
				alt="Duration" title="Duration" />0:10:00</span>

			</div>
			</td>
			<td class="val"><input type="text" class="text" name="t99" value="0"
				maxlength="4"></td>
			<td class="max"><a href="#"
				onClick="document.snd.t99.value=<?php echo $bid36[$village->resarray['f'.$id]]['attri']; ?>">(<?php echo $bid36[$village->resarray['f'.$id]]['attri']; ?>)</a></td>
		</tr>
	</tbody>
</table>

<p><input type="image" value="ok" name="s1" id="btn_train"
	class="dynamic_img" src="img/x.gif" alt="train" /></p>
</form>
<?php 
include("upgrade.tpl");
?>
</p></div>