<?php
if($session->tribe == 1){
?>
<div class="troops">
				<div class="troopGroup">
					<label for="t1"><img class="unit u1" title="<?php echo U1; ?>" src="img/x.gif"></label>
					<input class="text troop" id="t1" type="text" name="t1" value="<?php if($t1!=0){ echo $t1; }else{ echo 0; } ?>">
				</div>
				<div class="troopGroup">
					<label for="t2"><img class="unit u2" title="<?php echo U2; ?>" src="img/x.gif"></label>
					<input class="text troop" id="t2" type="text" name="t2" value="<?php if($t2!=0){ echo $t2; }else{ echo 0; } ?>">
				</div>
				<div class="troopGroup">
					<label for="t3"><img class="unit u3" title="<?php echo U3; ?>" src="img/x.gif"></label>
					<input class="text troop" id="t3" type="text" name="t3" value="<?php if($t3!=0){ echo $t3; }else{ echo 0; } ?>">
				</div>
				<div class="troopGroup">
					<label for="t4"><img class="unit u4" title="<?php echo U4; ?>" src="img/x.gif"></label>
					<input class="text troop" id="t4" type="text" value="<?php if($t4!=0){ echo $t4; }else{ echo 0; } ?>" disabled="disabled">
				</div>
				<div class="troopGroup">
					<label for="t5"><img class="unit u5" title="<?php echo U5; ?>" src="img/x.gif"></label>
					<input class="text troop" id="t5" type="text" name="t5" value="<?php if($t5!=0){ echo $t5; }else{ echo 0; } ?>">
				</div>
				<div class="clear"></div>
				<div class="troopGroup">
					<label for="t6"><img class="unit u6" title="<?php echo U6; ?>" src="img/x.gif"></label>
					<input class="text troop" id="t6" type="text" name="t6" value="<?php if($t6!=0){ echo $t6; }else{ echo 0; } ?>">
				</div>
				<div class="troopGroup">
					<label for="t7"><img class="unit u7" title="<?php echo U7; ?>" src="img/x.gif"></label>
					<input class="text troop" id="t7" type="text" name="t7" value="<?php if($t7!=0){ echo $t7; }else{ echo 0; } ?>">
				</div>
				<div class="troopGroup">
					<label for="t8"><img class="unit u8" title="<?php echo U8; ?>" src="img/x.gif"></label>
					<input class="text troop" id="t8" type="text" name="t8" value="<?php if($t8!=0){ echo $t8; }else{ echo 0; } ?>">
				</div>
				<div class="troopGroup">
					<label for="t9"><img class="unit u9" title="<?php echo U9; ?>" src="img/x.gif"></label>
					<input class="text troop" id="t9" type="text" name="t9" value="<?php if($t9!=0){ echo $t9; }else{ echo 0; } ?>">
				</div>
				<div class="troopGroup">
					<label for="t10"><img class="unit u10" title="<?php echo U10; ?>" src="img/x.gif"></label>
					<input class="text troop" id="t10" type="text" name="t10" value="<?php if($t10!=0){ echo $t10; }else{ echo 0; } ?>">
				</div>
			
						<div class="clear"></div>
		</div>
<?php }elseif($session->tribe == 2){ ?>
<div class="troops">
				<div class="troopGroup">
					<label for="t1"><img class="unit u11" title="<?php echo U11; ?>" src="img/x.gif"></label>
					<input class="text troop" id="t1" type="text" name="t1" value="<?php if($t1!=0){ echo $t1; }else{ echo 0; } ?>">
				</div>
				<div class="troopGroup">
					<label for="t2"><img class="unit u12" title="<?php echo U12; ?>" src="img/x.gif"></label>
					<input class="text troop" id="t2" type="text" name="t2" value="<?php if($t2!=0){ echo $t2; }else{ echo 0; } ?>">
				</div>
				<div class="troopGroup">
					<label for="t3"><img class="unit u13" title="<?php echo U13; ?>" src="img/x.gif"></label>
					<input class="text troop" id="t3" type="text" name="t3" value="<?php if($t3!=0){ echo $t3; }else{ echo 0; } ?>">
				</div>
				<div class="troopGroup">
					<label for="t4"><img class="unit u14" title="<?php echo U14; ?>" src="img/x.gif"></label>
					<input class="text troop" id="t4" type="text" value="<?php if($t4!=0){ echo $t4; }else{ echo 0; } ?>" disabled="disabled">
				</div>
				<div class="troopGroup">
					<label for="t5"><img class="unit u15" title="<?php echo U15; ?>" src="img/x.gif"></label>
					<input class="text troop" id="t5" type="text" name="t5" value="<?php if($t5!=0){ echo $t5; }else{ echo 0; } ?>">
				</div>
				<div class="clear"></div>
				<div class="troopGroup">
					<label for="t6"><img class="unit u16" title="<?php echo U16; ?>" src="img/x.gif"></label>
					<input class="text troop" id="t6" type="text" name="t6" value="<?php if($t6!=0){ echo $t6; }else{ echo 0; } ?>">
				</div>
				<div class="troopGroup">
					<label for="t7"><img class="unit u17" title="<?php echo U17; ?>" src="img/x.gif"></label>
					<input class="text troop" id="t7" type="text" name="t7" value="<?php if($t7!=0){ echo $t7; }else{ echo 0; } ?>">
				</div>
				<div class="troopGroup">
					<label for="t8"><img class="unit u18" title="<?php echo U18; ?>" src="img/x.gif"></label>
					<input class="text troop" id="t8" type="text" name="t8" value="<?php if($t8!=0){ echo $t8; }else{ echo 0; } ?>">
				</div>
				<div class="troopGroup">
					<label for="t9"><img class="unit u19" title="<?php echo U19; ?>" src="img/x.gif"></label>
					<input class="text troop" id="t9" type="text" name="t9" value="<?php if($t9!=0){ echo $t9; }else{ echo 0; } ?>">
				</div>
				<div class="troopGroup">
					<label for="t10"><img class="unit u20" title="<?php echo U20; ?>" src="img/x.gif"></label>
					<input class="text troop" id="t10" type="text" name="t10" value="<?php if($t10!=0){ echo $t10; }else{ echo 0; } ?>">
				</div>
			
						<div class="clear"></div>
		</div>
<?php }elseif($session->tribe == 3){ ?>
<div class="troops">
				<div class="troopGroup">
					<label for="t1"><img class="unit u21" title="<?php echo U21; ?>" src="img/x.gif"></label>
					<input class="text troop" id="t1" type="text" name="t1" value="<?php if($t1!=0){ echo $t1; }else{ echo 0; } ?>">
				</div>
				<div class="troopGroup">
					<label for="t2"><img class="unit u22" title="<?php echo U22; ?>" src="img/x.gif"></label>
					<input class="text troop" id="t2" type="text" name="t2" value="<?php if($t2!=0){ echo $t2; }else{ echo 0; } ?>">
				</div>
				<div class="troopGroup">
					<label for="t3"><img class="unit u23" title="<?php echo U23; ?>" src="img/x.gif"></label>
					<input class="text troop" id="t3" type="text" value="<?php if($t3!=0){ echo $t3; }else{ echo 0; } ?>" disabled="disabled">
				</div>
				<div class="troopGroup">
					<label for="t4"><img class="unit u24" title="<?php echo U24; ?>" src="img/x.gif"></label>
					<input class="text troop" id="t4" type="text" name="t4" value="<?php if($t4!=0){ echo $t4; }else{ echo 0; } ?>">
				</div>
				<div class="troopGroup">
					<label for="t5"><img class="unit u25" title="<?php echo U25; ?>" src="img/x.gif"></label>
					<input class="text troop" id="t5" type="text" name="t5" value="<?php if($t5!=0){ echo $t5; }else{ echo 0; } ?>">
				</div>
				<div class="clear"></div>
				<div class="troopGroup">
					<label for="t6"><img class="unit u26" title="<?php echo U26; ?>" src="img/x.gif"></label>
					<input class="text troop" id="t6" type="text" name="t6" value="<?php if($t6!=0){ echo $t6; }else{ echo 0; } ?>">
				</div>
				<div class="troopGroup">
					<label for="t7"><img class="unit u27" title="<?php echo U27; ?>" src="img/x.gif"></label>
					<input class="text troop" id="t7" type="text" name="t7" value="<?php if($t7!=0){ echo $t7; }else{ echo 0; } ?>">
				</div>
				<div class="troopGroup">
					<label for="t8"><img class="unit u28" title="<?php echo U28; ?>" src="img/x.gif"></label>
					<input class="text troop" id="t8" type="text" name="t8" value="<?php if($t8!=0){ echo $t8; }else{ echo 0; } ?>">
				</div>
				<div class="troopGroup">
					<label for="t9"><img class="unit u29" title="<?php echo U29; ?>" src="img/x.gif"></label>
					<input class="text troop" id="t9" type="text" name="t9" value="<?php if($t9!=0){ echo $t9; }else{ echo 0; } ?>">
				</div>
				<div class="troopGroup">
					<label for="t10"><img class="unit u30" title="<?php echo U30; ?>" src="img/x.gif"></label>
					<input class="text troop" id="t10" type="text" name="t10" value="<?php if($t10!=0){ echo $t10; }else{ echo 0; } ?>">
				</div>
			
						<div class="clear"></div>
		</div>
<?php } ?>