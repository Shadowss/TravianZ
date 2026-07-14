<table class="results attacker" cellpadding="1" cellspacing="1">
				<thead>
					<tr>
						<td class="role">
							Attacker
						</td><td>
								<img src="img/x.gif" class="unit u71" title="<?php echo U71; ?>" alt="<?php echo U71; ?>" />
							</td><td>
								<img src="img/x.gif" class="unit u72" title="<?php echo U72; ?>" alt="<?php echo U72; ?>" />
							</td><td>
								<img src="img/x.gif" class="unit u73" title="<?php echo U73; ?>" alt="<?php echo U73; ?>" />
							</td><td>
								<img src="img/x.gif" class="unit u74" title="<?php echo U74; ?>" alt="<?php echo U74; ?>" />
							</td><td>
								<img src="img/x.gif" class="unit u75" title="<?php echo U75; ?>" alt="<?php echo U75; ?>" />
							</td><td>
								<img src="img/x.gif" class="unit u76" title="<?php echo U76; ?>" alt="<?php echo U76; ?>" />
							</td><td>
								<img src="img/x.gif" class="unit u77" title="<?php echo U77; ?>" alt="<?php echo U77; ?>" />
							</td><td>
								<img src="img/x.gif" class="unit u78" title="<?php echo U78; ?>" alt="<?php echo U78; ?>" />
							</td><td>
								<img src="img/x.gif" class="unit u79" title="<?php echo U79; ?>" alt="<?php echo U79; ?>" />
							</td><td>
								<img src="img/x.gif" class="unit u80" title="<?php echo U80; ?>" alt="<?php echo U80; ?>" />
							</td></tr>
				</thead>
				<tbody>
					<tr>
						<th>
							Troops
						</th>
                        <td <?php if (!$form->getValue('a1_1')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a1_1');} ?></td>
                        <td <?php if (!$form->getValue('a1_2')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a1_2');} ?></td>
                        <td <?php if (!$form->getValue('a1_3')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a1_3');} ?></td>
                        <td <?php if (!$form->getValue('a1_4')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a1_4');} ?></td>
                        <td <?php if (!$form->getValue('a1_5')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a1_5');} ?></td>
                        <td <?php if (!$form->getValue('a1_6')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a1_6');} ?></td>
                        <td <?php if (!$form->getValue('a1_7')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a1_7');} ?></td>
                        <td <?php if (!$form->getValue('a1_8')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a1_8');} ?></td>
                        <td <?php if (!$form->getValue('a1_9')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a1_9');} ?></td>
                        <td <?php if (!$form->getValue('a1_10')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a1_10');} ?></td>
								</tr>
					<tr>
						<th>
							Casualties
						</th>
                        <td <?php if (!$troops = $form->getValue('a1_1')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][1]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a1_2')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][1]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a1_3')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][1]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a1_4')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][1]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a1_5')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][1]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a1_6')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][1]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a1_7')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][1]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a1_8')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][1]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a1_9')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][1]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a1_10')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][1]);} ?></td>
                        </tr>
				</tbody>
			</table>
