<table class="results attacker" cellpadding="1" cellspacing="1">
				<thead>
					<tr>

						<td class="role">
							Attacker
						</td><td>
								<img src="img/x.gif" class="unit u21" title="<?php echo U21; ?>" alt="<?php echo U21; ?>" />
							</td><td>
								<img src="img/x.gif" class="unit u22" title="<?php echo U22; ?>" alt="<?php echo U22; ?>" />
							</td><td>
								<img src="img/x.gif" class="unit u23" title="<?php echo U23; ?>" alt="<?php echo U23; ?>" />
							</td><td>
								<img src="img/x.gif" class="unit u24" title="<?php echo U24; ?>" alt="<?php echo U24; ?>" />
							</td><td>
								<img src="img/x.gif" class="unit u25" title="<?php echo U25; ?>" alt="<?php echo U25; ?>" />
							</td><td>
								<img src="img/x.gif" class="unit u26" title="<?php echo U26; ?>" alt="<?php echo U26; ?>" />
							</td><td>
								<img src="img/x.gif" class="unit u27" title="<?php echo U17; ?>" alt="<?php echo U17; ?>" />
							</td><td>
								<img src="img/x.gif" class="unit u28" title="<?php echo U28; ?>" alt="<?php echo U28; ?>" />
							</td><td>
								<img src="img/x.gif" class="unit u29" title="<?php echo U29; ?>" alt="<?php echo U29; ?>" />
							</td><td>
								<img src="img/x.gif" class="unit u30" title="<?php echo U10; ?>" alt="<?php echo U10; ?>" />
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
