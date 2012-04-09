<?php
if(!$session->goldclub) {
			include "Templates/Build/16.tpl";
			}else{
?>
<div id="build" class="gid16"><a href="#" onClick="return Popup(16,4);" class="build_logo">
	<img class="g16" src="img/x.gif" alt="Rally point" title="Rally point" />
</a>
<h1>Rally point <span class="level">level <?php echo $village->resarray['f'.$id]; ?></span></h1>
<p class="build_desc">Your village's troops meet here. From here you can send them out to conquer, raid or reinforce other villages.</p>

<div id="textmenu">
		<a href="build.php?id=<?php echo $id; ?>">Overview</a> |
		<a href="a2b.php">Send troops</a> |
		<a href="warsim.php">Combat Simulator</a> <?php if($session->goldclub==1){ ?>|
		<a href="build.php?id=<?php echo $id; ?>&amp;t=99">Gold Club</a>
		<?php } ?>
		</div>

		<div id="raidList">
			<?php  include "Templates/goldClub/farmlist.tpl"; ?>
		</div>
	</div>
<?php } ?>