<table class="results defender" cellpadding="1" cellspacing="1">
				<thead>
					<tr>
						<td class="role">
							Defender
						</td><td>
								<img src="img/x.gif" class="unit u81" title="<?php echo U81; ?>" alt="<?php echo U81; ?>" />
							</td><td>
								<img src="img/x.gif" class="unit u82" title="<?php echo U82; ?>" alt="<?php echo U82; ?>" />
							</td><td>
								<img src="img/x.gif" class="unit u83" title="<?php echo U83; ?>" alt="<?php echo U83; ?>" />
							</td><td>
								<img src="img/x.gif" class="unit u84" title="<?php echo U84; ?>" alt="<?php echo U84; ?>" />
							</td><td>
								<img src="img/x.gif" class="unit u85" title="<?php echo U85; ?>" alt="<?php echo U85; ?>" />
							</td><td>
								<img src="img/x.gif" class="unit u86" title="<?php echo U86; ?>" alt="<?php echo U86; ?>" />
							</td><td>
								<img src="img/x.gif" class="unit u87" title="<?php echo U87; ?>" alt="<?php echo U87; ?>" />
							</td><td>
								<img src="img/x.gif" class="unit u88" title="<?php echo U88; ?>" alt="<?php echo U88; ?>" />
							</td><td>
								<img src="img/x.gif" class="unit u89" title="<?php echo U89; ?>" alt="<?php echo U89; ?>" />
							</td><td>
								<img src="img/x.gif" class="unit u90" title="<?php echo U90; ?>" alt="<?php echo U90; ?>" />

							</td></tr>
				</thead>
				<tbody>
					<tr>
						<th>
							Troops
						</th>
                                <td <?php if (!$form->getValue('a2_81')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_81');} ?></td>
                                <td <?php if (!$form->getValue('a2_82')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_82');} ?></td>
                                <td <?php if (!$form->getValue('a2_83')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_83');} ?></td>
                                <td <?php if (!$form->getValue('a2_84')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_84');} ?></td>
                                <td <?php if (!$form->getValue('a2_85')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_85');} ?></td>
                                <td <?php if (!$form->getValue('a2_86')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_86');} ?></td>
                                <td <?php if (!$form->getValue('a2_87')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_87');} ?></td>
                                <td <?php if (!$form->getValue('a2_88')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_88');} ?></td>
                                <td <?php if (!$form->getValue('a2_89')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_89');} ?></td>
                                <td <?php if (!$form->getValue('a2_90')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_90');} ?></td>
                  </tr>
					<tr>
						<th>
							Casualties
						</th>
                        <td <?php if (!$troops = $form->getValue('a2_81')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a2_82')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a2_83')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a2_84')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a2_85')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a2_86')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a2_87')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a2_88')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a2_89')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a2_90')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        </tr>
				</tbody>
			</table>
