<h1><?php echo SEND_TROOPS; ?></h1>

<form method="POST" name="snd" action="a2b.php"><input name="timestamp" value="1278280730" type="hidden"> <input name="timestamp_checksum" value="597fa8" type="hidden"> <input name="b" value="1" type="hidden">


		<table id="troops" cellpadding="1" cellspacing="1">
	<tbody><tr>
		<td class="line-first column-first large"><img class="unit u51" src="img/x.gif" title="<?php echo U51; ?>" onclick="document.snd.t1.value=''; return false;" alt="<?php echo U51; ?>"> <input class="text" <?php if ($village->unitarray['u51']<=0) {echo ' disabled="disabled"';}?> name="t1" value="" maxlength="6" type="text">
		<?php 
        if ($village->unitarray['u51']>0){
        	echo "<a href=\"#\" onclick=\"document.snd.t1.value=".$village->unitarray['u51']."; return false;\">(".$village->unitarray['u51'].")</a></td>";
        }else{ 
       		echo  "<span class=\"none\">(0)</span></td>";
		}
        ?>
		
        <td class="line-first large"><img class="unit u54" src="img/x.gif" title="<?php echo U54; ?>" alt="<?php echo U54; ?>"> <input class="text" <?php if ($village->unitarray['u54']<=0) {echo ' disabled="disabled"';}?> name="t4" value="" maxlength="6" type="text">
		<?php 
        if ($village->unitarray['u54']>0){
        	echo "<a href=\"#\" onclick=\"document.snd.t4.value=".$village->unitarray['u54']."; return false;\">(".$village->unitarray['u54'].")</a></td>";
        }else{ 
       		echo  "<span class=\"none\">(0)</span></td>";
		}
        ?>
        <td class="line-first regular"><img class="unit u57" src="img/x.gif" title="<?php echo U57; ?>" alt="<?php echo U57; ?>"> <input class="text" <?php if ($village->unitarray['u57']<=0) {echo ' disabled="disabled"';}?> name="t7" value="" maxlength="6" type="text">
		<?php 
        if ($village->unitarray['u57']>0){
        	echo "<a href=\"#\" onclick=\"document.snd.t7.value=".$village->unitarray['u57']."; return false;\">(".$village->unitarray['u57'].")</a></td>";
        }else{ 
       		echo  "<span class=\"none\">(0)</span></td>";
		}
        ?>

		
        <td class="line-first column-last small"><img class="unit u59" src="img/x.gif" title="<?php echo U59; ?>" alt="<?php echo U59; ?>"> <input class="text" <?php if ($village->unitarray['u59']<=0) {echo ' disabled="disabled"';}?> name="t9" value="" maxlength="6" type="text">
		<?php 
        if ($village->unitarray['u59']>0){
        	echo "<a href=\"#\" onclick=\"document.snd.t9.value=".$village->unitarray['u59']."; return false;\">(".$village->unitarray['u59'].")</a></td>";
        }else{ 
       		echo  "<span class=\"none\">(0)</span></td>";
		}
        ?>
	</tr>
	<tr>
		<td class="column-first large"><img class="unit u52" src="img/x.gif" title="<?php echo U52; ?>" alt="<?php echo U52; ?>"> <input class="text" <?php if ($village->unitarray['u52']<=0) {echo ' disabled="disabled"';}?> name="t2" value="" maxlength="6" type="text">
		<?php 
        if ($village->unitarray['u52']>0){
        	echo "<a href=\"#\" onclick=\"document.snd.t2.value=".$village->unitarray['u52']."; return false;\">(".$village->unitarray['u52'].")</a></td>";
        }else{ 
       		echo  "<span class=\"none\">(0)</span></td>";
		}
        ?>

		<td class="large"><img class="unit u55" src="img/x.gif" title="<?php echo U55; ?>" alt="<?php echo U55; ?>"> <input class="text" <?php if ($village->unitarray['u55']<=0) {echo ' disabled="disabled"';}?> name="t5" value="" maxlength="6" type="text">
		<?php 
        if ($village->unitarray['u55']>0){
        	echo "<a href=\"#\" onclick=\"document.snd.t5.value=".$village->unitarray['u55']."; return false;\">(".$village->unitarray['u55'].")</a></td>";
        }else{ 
       		echo  "<span class=\"none\">(0)</span></td>";
		}
        ?>
		<td class="regular"><img class="unit u58" src="img/x.gif" title="<?php echo U58; ?>" alt="<?php echo U58; ?>"> <input class="text" <?php if ($village->unitarray['u58']<=0) {echo ' disabled="disabled"';}?> name="t8" value="" maxlength="6" type="text">
		<?php 
        if ($village->unitarray['u58']>0){
        	echo "<a href=\"#\" onclick=\"document.snd.t8.value=".$village->unitarray['u58']."; return false;\">(".$village->unitarray['u58'].")</a></td>";
        }else{ 
       		echo  "<span class=\"none\">(0)</span></td>";
		}
        ?>
		<td class="column-last small"><img class="unit u60" src="img/x.gif" title="<?php echo U60; ?>" alt="<?php echo U60; ?>"> <input class="text" <?php if ($village->unitarray['u60']<=0) {echo ' disabled="disabled"';}?> name="t10" value="" maxlength="6" type="text">
		<?php 
        if ($village->unitarray['u60']>0){
        	echo "<a href=\"#\" onclick=\"document.snd.t10.value=".$village->unitarray['u60']."; return false;\">(".$village->unitarray['u60'].")</a></td>";
        }else{ 
       		echo  "<span class=\"none\">(0)</span></td>";
		}
        ?>
	</tr>
	<tr>
		<td class="line-last column-first large"><img class="unit u53" src="img/x.gif" title="<?php echo U53; ?>" alt="<?php echo U53; ?>"> <input class="text" <?php if ($village->unitarray['u53']<=0) {echo ' disabled="disabled"';}?> name="t3" value="" maxlength="6" type="text">
		<?php 
        if ($village->unitarray['u53']>0){
        	echo "<a href=\"#\" onclick=\"document.snd.t3.value=".$village->unitarray['u53']."; return false;\">(".$village->unitarray['u53'].")</a></td>";
        }else{ 
       		echo  "<span class=\"none\">(0)</span></td>";
		}
        ?>
		<td class="line-last large"><img class="unit u56" src="img/x.gif" title="<?php echo U56; ?>" alt="<?php echo U56; ?>"> <input class="text" <?php if ($village->unitarray['u56']<=0) {echo ' disabled="disabled"';}?> name="t6" value="" maxlength="6" type="text">
		<?php 
        if ($village->unitarray['u56']>0){
        	echo "<a href=\"#\" onclick=\"document.snd.t6.value=".$village->unitarray['u56']."; return false;\">(".$village->unitarray['u56'].")</a></td>";
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

