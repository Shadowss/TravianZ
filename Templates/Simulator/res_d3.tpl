<table class="results defender" cellpadding="1" cellspacing="1">
				<thead>
					<tr>

						<td class="role">
							Defender
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
                                <td <?php if (!$form->getValue('a2_21')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_21');} ?></td>
                                <td <?php if (!$form->getValue('a2_22')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_22');} ?></td>
                                <td <?php if (!$form->getValue('a2_23')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_23');} ?></td>
                                <td <?php if (!$form->getValue('a2_24')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_24');} ?></td>
                                <td <?php if (!$form->getValue('a2_25')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_25');} ?></td>
                                <td <?php if (!$form->getValue('a2_26')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_26');} ?></td>
                                <td <?php if (!$form->getValue('a2_27')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_27');} ?></td>
                                <td <?php if (!$form->getValue('a2_28')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_28');} ?></td>
                                <td <?php if (!$form->getValue('a2_29')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_29');} ?></td>
                                <td <?php if (!$form->getValue('a2_30')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_30');} ?></td>
                                </tr>
					<tr>

						<th>
							Casualties
						</th>
						</th>
                        <td <?php if (!$troops = $form->getValue('a2_21')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a2_22')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a2_23')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a2_24')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a2_25')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a2_26')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a2_27')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a2_28')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a2_29')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a2_30')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        </tr>

				</tbody>
			</table>
