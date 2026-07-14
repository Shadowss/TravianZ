<h1><?php echo SEND_TROOPS; ?></h1>

<form method="POST" name="snd" action="a2b.php"><input name="timestamp" value="1278280730" type="hidden"> <input name="timestamp_checksum" value="597fa8" type="hidden"> <input name="b" value="1" type="hidden">


		<table id="troops" cellpadding="1" cellspacing="1">
	<tbody><tr>
		<td class="line-first column-first large"><img class="unit u81" src="img/x.gif" title="<?php echo U81; ?>" onclick="document.snd.t1.value=''; return false;" alt="<?php echo U81; ?>"> <input class="text" <?php if ($village->unitarray['u81']<=0) {echo ' disabled="disabled"';}?> name="t1" value="" maxlength="6" type="text">
		<?php 
        if ($village->unitarray['u81']>0){
        	echo "<a href=\"#\" onclick=\"document.snd.t1.value=".$village->unitarray['u81']."; return false;\">(".$village->unitarray['u81'].")</a></td>";
        }else{ 
       		echo  "<span class=\"none\">(0)</span></td>";
		}
        ?>
		
        <td class="line-first large"><img class="unit u84" src="img/x.gif" title="<?php echo U84; ?>" alt="<?php echo U84; ?>"> <input class="text" <?php if ($village->unitarray['u84']<=0) {echo ' disabled="disabled"';}?> name="t4" value="" maxlength="6" type="text">
		<?php 
        if ($village->unitarray['u84']>0){
        	echo "<a href=\"#\" onclick=\"document.snd.t4.value=".$village->unitarray['u84']."; return false;\">(".$village->unitarray['u84'].")</a></td>";
        }else{ 
       		echo  "<span class=\"none\">(0)</span></td>";
		}
        ?>
        <td class="line-first regular"><img class="unit u87" src="img/x.gif" title="<?php echo U87; ?>" alt="<?php echo U87; ?>"> <input class="text" <?php if ($village->unitarray['u87']<=0) {echo ' disabled="disabled"';}?> name="t7" value="" maxlength="6" type="text">
		<?php 
        if ($village->unitarray['u87']>0){
        	echo "<a href=\"#\" onclick=\"document.snd.t7.value=".$village->unitarray['u87']."; return false;\">(".$village->unitarray['u87'].")</a></td>";
        }else{ 
       		echo  "<span class=\"none\">(0)</span></td>";
		}
        ?>

		
        <td class="line-first column-last small"><img class="unit u89" src="img/x.gif" title="<?php echo U89; ?>" alt="<?php echo U89; ?>"> <input class="text" <?php if ($village->unitarray['u89']<=0) {echo ' disabled="disabled"';}?> name="t9" value="" maxlength="6" type="text">
		<?php 
        if ($village->unitarray['u89']>0){
        	echo "<a href=\"#\" onclick=\"document.snd.t9.value=".$village->unitarray['u89']."; return false;\">(".$village->unitarray['u89'].")</a></td>";
        }else{ 
       		echo  "<span class=\"none\">(0)</span></td>";
		}
        ?>
	</tr>
	<tr>
		<td class="column-first large"><img class="unit u82" src="img/x.gif" title="<?php echo U82; ?>" alt="<?php echo U82; ?>"> <input class="text" <?php if ($village->unitarray['u82']<=0) {echo ' disabled="disabled"';}?> name="t2" value="" maxlength="6" type="text">
		<?php 
        if ($village->unitarray['u82']>0){
        	echo "<a href=\"#\" onclick=\"document.snd.t2.value=".$village->unitarray['u82']."; return false;\">(".$village->unitarray['u82'].")</a></td>";
        }else{ 
       		echo  "<span class=\"none\">(0)</span></td>";
		}
        ?>

		<td class="large"><img class="unit u85" src="img/x.gif" title="<?php echo U85; ?>" alt="<?php echo U85; ?>"> <input class="text" <?php if ($village->unitarray['u85']<=0) {echo ' disabled="disabled"';}?> name="t5" value="" maxlength="6" type="text">
		<?php 
        if ($village->unitarray['u85']>0){
        	echo "<a href=\"#\" onclick=\"document.snd.t5.value=".$village->unitarray['u85']."; return false;\">(".$village->unitarray['u85'].")</a></td>";
        }else{ 
       		echo  "<span class=\"none\">(0)</span></td>";
		}
        ?>
		<td class="regular"><img class="unit u88" src="img/x.gif" title="<?php echo U88; ?>" alt="<?php echo U88; ?>"> <input class="text" <?php if ($village->unitarray['u88']<=0) {echo ' disabled="disabled"';}?> name="t8" value="" maxlength="6" type="text">
		<?php 
        if ($village->unitarray['u88']>0){
        	echo "<a href=\"#\" onclick=\"document.snd.t8.value=".$village->unitarray['u88']."; return false;\">(".$village->unitarray['u88'].")</a></td>";
        }else{ 
       		echo  "<span class=\"none\">(0)</span></td>";
		}
        ?>
		<td class="column-last small"><img class="unit u90" src="img/x.gif" title="<?php echo U90; ?>" alt="<?php echo U90; ?>"> <input class="text" <?php if ($village->unitarray['u90']<=0) {echo ' disabled="disabled"';}?> name="t10" value="" maxlength="6" type="text">
		<?php 
        if ($village->unitarray['u90']>0){
        	echo "<a href=\"#\" onclick=\"document.snd.t10.value=".$village->unitarray['u90']."; return false;\">(".$village->unitarray['u90'].")</a></td>";
        }else{ 
       		echo  "<span class=\"none\">(0)</span></td>";
		}
        ?>
	</tr>
	<tr>
		<td class="line-last column-first large"><img class="unit u83" src="img/x.gif" title="<?php echo U83; ?>" alt="<?php echo U83; ?>"> <input class="text" <?php if ($village->unitarray['u83']<=0) {echo ' disabled="disabled"';}?> name="t3" value="" maxlength="6" type="text">
		<?php 
        if ($village->unitarray['u83']>0){
        	echo "<a href=\"#\" onclick=\"document.snd.t3.value=".$village->unitarray['u83']."; return false;\">(".$village->unitarray['u83'].")</a></td>";
        }else{ 
       		echo  "<span class=\"none\">(0)</span></td>";
		}
        ?>
		<td class="line-last large"><img class="unit u86" src="img/x.gif" title="<?php echo U86; ?>" alt="<?php echo U86; ?>"> <input class="text" <?php if ($village->unitarray['u86']<=0) {echo ' disabled="disabled"';}?> name="t6" value="" maxlength="6" type="text">
		<?php 
        if ($village->unitarray['u86']>0){
        	echo "<a href=\"#\" onclick=\"document.snd.t6.value=".$village->unitarray['u86']."; return false;\">(".$village->unitarray['u86'].")</a></td>";
        }else{ 
       		echo  "<span class=\"none\">(0)</span></td>";
		}
        ?>
		<td class="line-last regular"><?php 
        if ($village->unitarray['hero']>0){
        echo "<img class=\"unit uhero\" src=\"img/x.gif\" title=\"Hero\" alt=\"Hero\"> <input class=\"text\" name=\"t11\" value=\"\" maxlength=\"6\" type=\"text\">   ";
            echo "<a href=\"#\" onclick=\"document.snd.t11.value=".$village->unitarray['hero']."; return false;\">(".$village->unitarray['hero'].")</a></td>";
        }
        ?></td>
			<td class="line-last column-last"></td>		</tr>
</tbody></table>

