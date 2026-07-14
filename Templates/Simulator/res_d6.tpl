<table class="results defender" cellpadding="1" cellspacing="1">
				<thead>
					<tr>
						<td class="role">
							Defender
						</td><td>
								<img src="img/x.gif" class="unit u51" title="<?php echo U51; ?>" alt="<?php echo U51; ?>" />
							</td><td>
								<img src="img/x.gif" class="unit u52" title="<?php echo U52; ?>" alt="<?php echo U52; ?>" />
							</td><td>
								<img src="img/x.gif" class="unit u53" title="<?php echo U53; ?>" alt="<?php echo U53; ?>" />
							</td><td>
								<img src="img/x.gif" class="unit u54" title="<?php echo U54; ?>" alt="<?php echo U54; ?>" />
							</td><td>
								<img src="img/x.gif" class="unit u55" title="<?php echo U55; ?>" alt="<?php echo U55; ?>" />
							</td><td>
								<img src="img/x.gif" class="unit u56" title="<?php echo U56; ?>" alt="<?php echo U56; ?>" />
							</td><td>
								<img src="img/x.gif" class="unit u57" title="<?php echo U57; ?>" alt="<?php echo U57; ?>" />
							</td><td>
								<img src="img/x.gif" class="unit u58" title="<?php echo U58; ?>" alt="<?php echo U58; ?>" />
							</td><td>
								<img src="img/x.gif" class="unit u59" title="<?php echo U59; ?>" alt="<?php echo U59; ?>" />
							</td><td>
								<img src="img/x.gif" class="unit u60" title="<?php echo U60; ?>" alt="<?php echo U60; ?>" />

							</td></tr>
				</thead>
				<tbody>
					<tr>
						<th>
							Troops
						</th>
                                <td <?php if (!$form->getValue('a2_51')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_51');} ?></td>
                                <td <?php if (!$form->getValue('a2_52')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_52');} ?></td>
                                <td <?php if (!$form->getValue('a2_53')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_53');} ?></td>
                                <td <?php if (!$form->getValue('a2_54')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_54');} ?></td>
                                <td <?php if (!$form->getValue('a2_55')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_55');} ?></td>
                                <td <?php if (!$form->getValue('a2_56')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_56');} ?></td>
                                <td <?php if (!$form->getValue('a2_57')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_57');} ?></td>
                                <td <?php if (!$form->getValue('a2_58')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_58');} ?></td>
                                <td <?php if (!$form->getValue('a2_59')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_59');} ?></td>
                                <td <?php if (!$form->getValue('a2_60')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_60');} ?></td>
                  </tr>
					<tr>
						<th>
							Casualties
						</th>
                        <td <?php if (!$troops = $form->getValue('a2_51')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a2_52')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a2_53')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a2_54')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a2_55')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a2_56')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a2_57')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a2_58')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a2_59')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a2_60')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        </tr>
				</tbody>
			</table>
