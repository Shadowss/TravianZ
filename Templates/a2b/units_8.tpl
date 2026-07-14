<h1><?php echo SEND_TROOPS; ?></h1>

<form method="POST" name="snd" action="a2b.php"><input name="timestamp" value="1278280730" type="hidden"> <input name="timestamp_checksum" value="597fa8" type="hidden"> <input name="b" value="1" type="hidden">


		<table id="troops" cellpadding="1" cellspacing="1">
	<tbody><tr>
		<td class="line-first column-first large"><img class="unit u71" src="img/x.gif" title="<?php echo U71; ?>" onclick="document.snd.t1.value=''; return false;" alt="<?php echo U71; ?>"> <input class="text" <?php if ($village->unitarray['u71']<=0) {echo ' disabled="disabled"';}?> name="t1" value="" maxlength="6" type="text">
		<?php 
        if ($village->unitarray['u71']>0){
        	echo "<a href=\"#\" onclick=\"document.snd.t1.value=".$village->unitarray['u71']."; return false;\">(".$village->unitarray['u71'].")</a></td>";
        }else{ 
       		echo  "<span class=\"none\">(0)</span></td>";
		}
        ?>
		
        <td class="line-first large"><img class="unit u74" src="img/x.gif" title="<?php echo U74; ?>" alt="<?php echo U74; ?>"> <input class="text" <?php if ($village->unitarray['u74']<=0) {echo ' disabled="disabled"';}?> name="t4" value="" maxlength="6" type="text">
		<?php 
        if ($village->unitarray['u74']>0){
        	echo "<a href=\"#\" onclick=\"document.snd.t4.value=".$village->unitarray['u74']."; return false;\">(".$village->unitarray['u74'].")</a></td>";
        }else{ 
       		echo  "<span class=\"none\">(0)</span></td>";
		}
        ?>
        <td class="line-first regular"><img class="unit u77" src="img/x.gif" title="<?php echo U77; ?>" alt="<?php echo U77; ?>"> <input class="text" <?php if ($village->unitarray['u77']<=0) {echo ' disabled="disabled"';}?> name="t7" value="" maxlength="6" type="text">
		<?php 
        if ($village->unitarray['u77']>0){
        	echo "<a href=\"#\" onclick=\"document.snd.t7.value=".$village->unitarray['u77']."; return false;\">(".$village->unitarray['u77'].")</a></td>";
        }else{ 
       		echo  "<span class=\"none\">(0)</span></td>";
		}
        ?>

		
        <td class="line-first column-last small"><img class="unit u79" src="img/x.gif" title="<?php echo U79; ?>" alt="<?php echo U79; ?>"> <input class="text" <?php if ($village->unitarray['u79']<=0) {echo ' disabled="disabled"';}?> name="t9" value="" maxlength="6" type="text">
		<?php 
        if ($village->unitarray['u79']>0){
        	echo "<a href=\"#\" onclick=\"document.snd.t9.value=".$village->unitarray['u79']."; return false;\">(".$village->unitarray['u79'].")</a></td>";
        }else{ 
       		echo  "<span class=\"none\">(0)</span></td>";
		}
        ?>
	</tr>
	<tr>
		<td class="column-first large"><img class="unit u72" src="img/x.gif" title="<?php echo U72; ?>" alt="<?php echo U72; ?>"> <input class="text" <?php if ($village->unitarray['u72']<=0) {echo ' disabled="disabled"';}?> name="t2" value="" maxlength="6" type="text">
		<?php 
        if ($village->unitarray['u72']>0){
        	echo "<a href=\"#\" onclick=\"document.snd.t2.value=".$village->unitarray['u72']."; return false;\">(".$village->unitarray['u72'].")</a></td>";
        }else{ 
       		echo  "<span class=\"none\">(0)</span></td>";
		}
        ?>

		<td class="large"><img class="unit u75" src="img/x.gif" title="<?php echo U75; ?>" alt="<?php echo U75; ?>"> <input class="text" <?php if ($village->unitarray['u75']<=0) {echo ' disabled="disabled"';}?> name="t5" value="" maxlength="6" type="text">
		<?php 
        if ($village->unitarray['u75']>0){
        	echo "<a href=\"#\" onclick=\"document.snd.t5.value=".$village->unitarray['u75']."; return false;\">(".$village->unitarray['u75'].")</a></td>";
        }else{ 
       		echo  "<span class=\"none\">(0)</span></td>";
		}
        ?>
		<td class="regular"><img class="unit u78" src="img/x.gif" title="<?php echo U78; ?>" alt="<?php echo U78; ?>"> <input class="text" <?php if ($village->unitarray['u78']<=0) {echo ' disabled="disabled"';}?> name="t8" value="" maxlength="6" type="text">
		<?php 
        if ($village->unitarray['u78']>0){
        	echo "<a href=\"#\" onclick=\"document.snd.t8.value=".$village->unitarray['u78']."; return false;\">(".$village->unitarray['u78'].")</a></td>";
        }else{ 
       		echo  "<span class=\"none\">(0)</span></td>";
		}
        ?>
		<td class="column-last small"><img class="unit u80" src="img/x.gif" title="<?php echo U80; ?>" alt="<?php echo U80; ?>"> <input class="text" <?php if ($village->unitarray['u80']<=0) {echo ' disabled="disabled"';}?> name="t10" value="" maxlength="6" type="text">
		<?php 
        if ($village->unitarray['u80']>0){
        	echo "<a href=\"#\" onclick=\"document.snd.t10.value=".$village->unitarray['u80']."; return false;\">(".$village->unitarray['u80'].")</a></td>";
        }else{ 
       		echo  "<span class=\"none\">(0)</span></td>";
		}
        ?>
	</tr>
	<tr>
		<td class="line-last column-first large"><img class="unit u73" src="img/x.gif" title="<?php echo U73; ?>" alt="<?php echo U73; ?>"> <input class="text" <?php if ($village->unitarray['u73']<=0) {echo ' disabled="disabled"';}?> name="t3" value="" maxlength="6" type="text">
		<?php 
        if ($village->unitarray['u73']>0){
        	echo "<a href=\"#\" onclick=\"document.snd.t3.value=".$village->unitarray['u73']."; return false;\">(".$village->unitarray['u73'].")</a></td>";
        }else{ 
       		echo  "<span class=\"none\">(0)</span></td>";
		}
        ?>
		<td class="line-last large"><img class="unit u76" src="img/x.gif" title="<?php echo U76; ?>" alt="<?php echo U76; ?>"> <input class="text" <?php if ($village->unitarray['u76']<=0) {echo ' disabled="disabled"';}?> name="t6" value="" maxlength="6" type="text">
		<?php 
        if ($village->unitarray['u76']>0){
        	echo "<a href=\"#\" onclick=\"document.snd.t6.value=".$village->unitarray['u76']."; return false;\">(".$village->unitarray['u76'].")</a></td>";
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

