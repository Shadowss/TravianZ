<table class="results defender" cellpadding="1" cellspacing="1">
				<thead>
					<tr>

						<td class="role">
							Defender
						</td><td>
								<img src="img/x.gif" class="unit u31" title="<?php echo U31; ?>" alt="<?php echo U31; ?>" />
							</td><td>

								<img src="img/x.gif" class="unit u32" title="<?php echo U32; ?>" alt="<?php echo U32; ?>" />
							</td><td>
								<img src="img/x.gif" class="unit u33" title="<?php echo U33; ?>" alt="<?php echo U33; ?>" />
							</td><td>
								<img src="img/x.gif" class="unit u34" title="<?php echo U34; ?>" alt="<?php echo U34; ?>" />
							</td><td>
								<img src="img/x.gif" class="unit u35" title="<?php echo U35; ?>" alt="<?php echo U35; ?>" />
							</td><td>
								<img src="img/x.gif" class="unit u36" title="<?php echo U36; ?>" alt="<?php echo U36; ?>" />

							</td><td>
								<img src="img/x.gif" class="unit u37" title="<?php echo U37; ?>" alt="<?php echo U37; ?>" />
							</td><td>
								<img src="img/x.gif" class="unit u38" title="<?php echo U38; ?>" alt="<?php echo U38; ?>" />
							</td><td>
								<img src="img/x.gif" class="unit u39" title="<?php echo U39; ?>" alt="<?php echo U39; ?>" />
							</td><td>
								<img src="img/x.gif" class="unit u40" title="<?php echo U40; ?>" alt="<?php echo U40; ?>" />
							</td></tr>
				</thead>
				<tbody>
					<tr>
						<th>

							Troops
						</th>
                                <td <?php if (!$form->getValue('a2_31')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_31');} ?></td>
                                <td <?php if (!$form->getValue('a2_32')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_32');} ?></td>
                                <td <?php if (!$form->getValue('a2_33')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_33');} ?></td>
                                <td <?php if (!$form->getValue('a2_34')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_34');} ?></td>
                                <td <?php if (!$form->getValue('a2_35')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_35');} ?></td>
                                <td <?php if (!$form->getValue('a2_36')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_36');} ?></td>
                                <td <?php if (!$form->getValue('a2_37')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_37');} ?></td>
                                <td <?php if (!$form->getValue('a2_38')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_38');} ?></td>
                                <td <?php if (!$form->getValue('a2_39')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_39');} ?></td>
                                <td <?php if (!$form->getValue('a2_40')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_40');} ?></td>
                                </tr>
					<tr>

						<th>
							Casualties
						</th>
						</th>
                        <td <?php if (!$troops = $form->getValue('a2_31')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a2_32')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a2_33')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a2_34')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a2_35')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a2_36')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a2_37')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a2_38')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a2_39')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a2_40')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        </tr>

				</tbody>
			</table>
