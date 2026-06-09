<table class="results defender" cellpadding="1" cellspacing="1">
				<thead>
					<tr>
						<td class="role">
							Defender
						</td><td>
								<img src="img/x.gif" class="unit u11" title="<?php echo U11; ?>" alt="<?php echo U11; ?>" />
							</td><td>
								<img src="img/x.gif" class="unit u12" title="<?php echo U12; ?>" alt="<?php echo U12; ?>" />
							</td><td>
								<img src="img/x.gif" class="unit u13" title="<?php echo U13; ?>" alt="<?php echo U13; ?>" />
							</td><td>
								<img src="img/x.gif" class="unit u14" title="<?php echo U14; ?>" alt="<?php echo U14; ?>" />
							</td><td>
								<img src="img/x.gif" class="unit u15" title="<?php echo U15; ?>" alt="<?php echo U15; ?>" />
							</td><td>
								<img src="img/x.gif" class="unit u16" title="<?php echo U16; ?>" alt="<?php echo U16; ?>" />
							</td><td>
								<img src="img/x.gif" class="unit u17" title="<?php echo U17; ?>" alt="<?php echo U17; ?>" />
							</td><td>
								<img src="img/x.gif" class="unit u18" title="<?php echo U18; ?>" alt="<?php echo U18; ?>" />
							</td><td>
								<img src="img/x.gif" class="unit u19" title="<?php echo U19; ?>" alt="<?php echo U19; ?>" />
							</td><td>
								<img src="img/x.gif" class="unit u20" title="<?php echo U10; ?>" alt="<?php echo U10; ?>" />
							</td></tr>
				</thead>
				<tbody>
					<tr>
						<th>
							Troops
						</th>
                                <td <?php if (!$form->getValue('a2_11')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_11');} ?></td>
                                <td <?php if (!$form->getValue('a2_12')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_12');} ?></td>
                                <td <?php if (!$form->getValue('a2_13')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_13');} ?></td>
                                <td <?php if (!$form->getValue('a2_14')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_14');} ?></td>
                                <td <?php if (!$form->getValue('a2_15')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_15');} ?></td>
                                <td <?php if (!$form->getValue('a2_16')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_16');} ?></td>
                                <td <?php if (!$form->getValue('a2_17')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_17');} ?></td>
                                <td <?php if (!$form->getValue('a2_18')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_18');} ?></td>
                                <td <?php if (!$form->getValue('a2_19')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_19');} ?></td>
                                <td <?php if (!$form->getValue('a2_20')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_20');} ?></td>
                                </tr>
					<tr>
						<th>
							Casualties
						</th>
                        <td <?php if (!$troops = $form->getValue('a2_11')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a2_12')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a2_13')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a2_14')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a2_15')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a2_16')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a2_17')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a2_18')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a2_19')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a2_20')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        </tr>
				</tbody>
			</table>
