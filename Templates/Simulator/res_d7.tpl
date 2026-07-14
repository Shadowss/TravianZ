<table class="results defender" cellpadding="1" cellspacing="1">
				<thead>
					<tr>
						<td class="role">
							Defender
						</td><td>
								<img src="img/x.gif" class="unit u61" title="<?php echo U61; ?>" alt="<?php echo U61; ?>" />
							</td><td>
								<img src="img/x.gif" class="unit u62" title="<?php echo U62; ?>" alt="<?php echo U62; ?>" />
							</td><td>
								<img src="img/x.gif" class="unit u63" title="<?php echo U63; ?>" alt="<?php echo U63; ?>" />
							</td><td>
								<img src="img/x.gif" class="unit u64" title="<?php echo U64; ?>" alt="<?php echo U64; ?>" />
							</td><td>
								<img src="img/x.gif" class="unit u65" title="<?php echo U65; ?>" alt="<?php echo U65; ?>" />
							</td><td>
								<img src="img/x.gif" class="unit u66" title="<?php echo U66; ?>" alt="<?php echo U66; ?>" />
							</td><td>
								<img src="img/x.gif" class="unit u67" title="<?php echo U67; ?>" alt="<?php echo U67; ?>" />
							</td><td>
								<img src="img/x.gif" class="unit u68" title="<?php echo U68; ?>" alt="<?php echo U68; ?>" />
							</td><td>
								<img src="img/x.gif" class="unit u69" title="<?php echo U69; ?>" alt="<?php echo U69; ?>" />
							</td><td>
								<img src="img/x.gif" class="unit u70" title="<?php echo U70; ?>" alt="<?php echo U70; ?>" />

							</td></tr>
				</thead>
				<tbody>
					<tr>
						<th>
							Troops
						</th>
                                <td <?php if (!$form->getValue('a2_61')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_61');} ?></td>
                                <td <?php if (!$form->getValue('a2_62')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_62');} ?></td>
                                <td <?php if (!$form->getValue('a2_63')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_63');} ?></td>
                                <td <?php if (!$form->getValue('a2_64')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_64');} ?></td>
                                <td <?php if (!$form->getValue('a2_65')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_65');} ?></td>
                                <td <?php if (!$form->getValue('a2_66')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_66');} ?></td>
                                <td <?php if (!$form->getValue('a2_67')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_67');} ?></td>
                                <td <?php if (!$form->getValue('a2_68')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_68');} ?></td>
                                <td <?php if (!$form->getValue('a2_69')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_69');} ?></td>
                                <td <?php if (!$form->getValue('a2_70')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_70');} ?></td>
                  </tr>
					<tr>
						<th>
							Casualties
						</th>
                        <td <?php if (!$troops = $form->getValue('a2_61')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a2_62')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a2_63')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a2_64')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a2_65')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a2_66')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a2_67')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a2_68')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a2_69')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a2_70')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        </tr>
				</tbody>
			</table>
