<h1><?php echo SEND_TROOPS; ?></h1>

<form method="POST" name="snd" action="a2b.php"><input name="timestamp" value="1278280730" type="hidden"> <input name="timestamp_checksum" value="597fa8" type="hidden"> <input name="b" value="1" type="hidden">


		<table id="troops" cellpadding="1" cellspacing="1">
	<tbody><tr>
		<td class="line-first column-first large"><img class="unit u61" src="img/x.gif" title="<?php echo U61; ?>" onclick="document.snd.t1.value=''; return false;" alt="<?php echo U61; ?>"> <input class="text" <?php if ($village->unitarray['u61']<=0) {echo ' disabled="disabled"';}?> name="t1" value="" maxlength="6" type="text">
		<?php 
        if ($village->unitarray['u61']>0){
        	echo "<a href=\"#\" onclick=\"document.snd.t1.value=".$village->unitarray['u61']."; return false;\">(".$village->unitarray['u61'].")</a></td>";
        }else{ 
       		echo  "<span class=\"none\">(0)</span></td>";
		}
        ?>
		
        <td class="line-first large"><img class="unit u64" src="img/x.gif" title="<?php echo U64; ?>" alt="<?php echo U64; ?>"> <input class="text" <?php if ($village->unitarray['u64']<=0) {echo ' disabled="disabled"';}?> name="t4" value="" maxlength="6" type="text">
		<?php 
        if ($village->unitarray['u64']>0){
        	echo "<a href=\"#\" onclick=\"document.snd.t4.value=".$village->unitarray['u64']."; return false;\">(".$village->unitarray['u64'].")</a></td>";
        }else{ 
       		echo  "<span class=\"none\">(0)</span></td>";
		}
        ?>
        <td class="line-first regular"><img class="unit u67" src="img/x.gif" title="<?php echo U67; ?>" alt="<?php echo U67; ?>"> <input class="text" <?php if ($village->unitarray['u67']<=0) {echo ' disabled="disabled"';}?> name="t7" value="" maxlength="6" type="text">
		<?php 
        if ($village->unitarray['u67']>0){
        	echo "<a href=\"#\" onclick=\"document.snd.t7.value=".$village->unitarray['u67']."; return false;\">(".$village->unitarray['u67'].")</a></td>";
        }else{ 
       		echo  "<span class=\"none\">(0)</span></td>";
		}
        ?>

		
        <td class="line-first column-last small"><img class="unit u69" src="img/x.gif" title="<?php echo U69; ?>" alt="<?php echo U69; ?>"> <input class="text" <?php if ($village->unitarray['u69']<=0) {echo ' disabled="disabled"';}?> name="t9" value="" maxlength="6" type="text">
		<?php 
        if ($village->unitarray['u69']>0){
        	echo "<a href=\"#\" onclick=\"document.snd.t9.value=".$village->unitarray['u69']."; return false;\">(".$village->unitarray['u69'].")</a></td>";
        }else{ 
       		echo  "<span class=\"none\">(0)</span></td>";
		}
        ?>
	</tr>
	<tr>
		<td class="column-first large"><img class="unit u62" src="img/x.gif" title="<?php echo U62; ?>" alt="<?php echo U62; ?>"> <input class="text" <?php if ($village->unitarray['u62']<=0) {echo ' disabled="disabled"';}?> name="t2" value="" maxlength="6" type="text">
		<?php 
        if ($village->unitarray['u62']>0){
        	echo "<a href=\"#\" onclick=\"document.snd.t2.value=".$village->unitarray['u62']."; return false;\">(".$village->unitarray['u62'].")</a></td>";
        }else{ 
       		echo  "<span class=\"none\">(0)</span></td>";
		}
        ?>

		<td class="large"><img class="unit u65" src="img/x.gif" title="<?php echo U65; ?>" alt="<?php echo U65; ?>"> <input class="text" <?php if ($village->unitarray['u65']<=0) {echo ' disabled="disabled"';}?> name="t5" value="" maxlength="6" type="text">
		<?php 
        if ($village->unitarray['u65']>0){
        	echo "<a href=\"#\" onclick=\"document.snd.t5.value=".$village->unitarray['u65']."; return false;\">(".$village->unitarray['u65'].")</a></td>";
        }else{ 
       		echo  "<span class=\"none\">(0)</span></td>";
		}
        ?>
		<td class="regular"><img class="unit u68" src="img/x.gif" title="<?php echo U68; ?>" alt="<?php echo U68; ?>"> <input class="text" <?php if ($village->unitarray['u68']<=0) {echo ' disabled="disabled"';}?> name="t8" value="" maxlength="6" type="text">
		<?php 
        if ($village->unitarray['u68']>0){
        	echo "<a href=\"#\" onclick=\"document.snd.t8.value=".$village->unitarray['u68']."; return false;\">(".$village->unitarray['u68'].")</a></td>";
        }else{ 
       		echo  "<span class=\"none\">(0)</span></td>";
		}
        ?>
		<td class="column-last small"><img class="unit u70" src="img/x.gif" title="<?php echo U70; ?>" alt="<?php echo U70; ?>"> <input class="text" <?php if ($village->unitarray['u70']<=0) {echo ' disabled="disabled"';}?> name="t10" value="" maxlength="6" type="text">
		<?php 
        if ($village->unitarray['u70']>0){
        	echo "<a href=\"#\" onclick=\"document.snd.t10.value=".$village->unitarray['u70']."; return false;\">(".$village->unitarray['u70'].")</a></td>";
        }else{ 
       		echo  "<span class=\"none\">(0)</span></td>";
		}
        ?>
	</tr>
	<tr>
		<td class="line-last column-first large"><img class="unit u63" src="img/x.gif" title="<?php echo U63; ?>" alt="<?php echo U63; ?>"> <input class="text" <?php if ($village->unitarray['u63']<=0) {echo ' disabled="disabled"';}?> name="t3" value="" maxlength="6" type="text">
		<?php 
        if ($village->unitarray['u63']>0){
        	echo "<a href=\"#\" onclick=\"document.snd.t3.value=".$village->unitarray['u63']."; return false;\">(".$village->unitarray['u63'].")</a></td>";
        }else{ 
       		echo  "<span class=\"none\">(0)</span></td>";
		}
        ?>
		<td class="line-last large"><img class="unit u66" src="img/x.gif" title="<?php echo U66; ?>" alt="<?php echo U66; ?>"> <input class="text" <?php if ($village->unitarray['u66']<=0) {echo ' disabled="disabled"';}?> name="t6" value="" maxlength="6" type="text">
		<?php 
        if ($village->unitarray['u66']>0){
        	echo "<a href=\"#\" onclick=\"document.snd.t6.value=".$village->unitarray['u66']."; return false;\">(".$village->unitarray['u66'].")</a></td>";
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

