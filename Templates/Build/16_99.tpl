<div id="build" class="gid16">
	<div class="build_desc">
		<a href="#" onClick="return Travian.Game.iPopup(16,4);" class="build_logo">
		<img class="g16 big white" src="img/x.gif" alt="Camp" title="Camp" /></a>
		<h1>Camp <span class="level">level <?php echo $village->resarray['f'.$id]; ?></span></h1>
		<p class="build_desc">Your village troops are gathered in this place. From here you can send them to plunder, raid, or conquer other villages are supported.</p>

		<?php include("upgrade.tpl"); ?>
		<div class="contentNavi tabNavi">
			<div class="container normal">
				<div class="background-start">&nbsp;</div>
				<div class="background-end">&nbsp;</div>
				<div class="content"><a href="build.php?id=<?php echo $id; ?>"><span class="tabItem">Rally Point</span></a></div>
			</div>
			
			<div class="container normal">
				<div class="background-start">&nbsp;</div>
				<div class="background-end">&nbsp;</div>
				<div class="content"><a href="a2b.php"><span class="tabItem">Send Troops</span></a></div>
			</div>
			
			<div class="container normal">
				<div class="background-start">&nbsp;</div>
				<div class="background-end">&nbsp;</div>
				<div class="content"><a href="warsim.php"><span class="tabItem">Combat Simulator</span></a></div>
			</div>
			
			<div class="container active">
				<div class="background-start">&nbsp;</div>
				<div class="background-end">&nbsp;</div>
				<div class="content"><a href="build.php?id=39&amp;t=99"><span class="tabItem">Exhibition List </span></a></div>
			</div>
		</div>

		<div id="raidList">
			<?php if(!$session->goldclub) { ?>
			<div class="options">
				<div id="spaceUsed">
					<div class="boxes boxesColor gray">
						<div class="boxes-tl"></div>
						<div class="boxes-tr"></div>
						<div class="boxes-tc"></div>
						<div class="boxes-ml"></div>
						<div class="boxes-mr"></div>
						<div class="boxes-mc"></div>
						<div class="boxes-bl"></div>
						<div class="boxes-br"></div>
						<div class="boxes-bc"></div>
						<div class="boxes-contents">Gold Club is one of our farm list and need to pay another fee to activate it.</div>
					</div>
					<div class="clear"></div>
				</div>
				<a class="arrow" href="plus.php?id=3#goldclub">Gets Gold Club members</a>
			</div>
			<?php }else{ include "Templates/goldClub/farmlist.tpl"; } ?>
		</div>
	</div>
</div>