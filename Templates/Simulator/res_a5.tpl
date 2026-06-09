<table class="results attacker" cellpadding="1" cellspacing="1">
				<thead>
					<tr>
                        <td class="role">
                            Attacker
                        </td><td>
                            <img src="img/x.gif" class="unit u41" title="<?php echo U41; ?>" alt="<?php echo U41; ?>" />
                        </td><td>
                            <img src="img/x.gif" class="unit u42" title="<?php echo U42; ?>" alt="<?php echo U42; ?>" />
                        </td><td>
                            <img src="img/x.gif" class="unit u43" title="<?php echo U43; ?>" alt="<?php echo U43; ?>" />
                        </td><td>
                            <img src="img/x.gif" class="unit u44" title="<?php echo U44; ?>" alt="<?php echo U44; ?>"r" />
                        </td><td>
                            <img src="img/x.gif" class="unit u45" title="<?php echo U45; ?>" alt="<?php echo U45; ?>" />
                        </td><td>
                            <img src="img/x.gif" class="unit u46" title="<?php echo U46; ?>" alt="<?php echo U46; ?>" />
                        </td><td>
                            <img src="img/x.gif" class="unit u47" title="<?php echo U47; ?>" alt="<?php echo U47; ?>" />
                        </td><td>
                            <img src="img/x.gif" class="unit u48" title="<?php echo U48; ?>" alt="<?php echo U48; ?>" />
                        </td><td>
                            <img src="img/x.gif" class="unit u49" title="<?php echo U49; ?>" alt="<?php echo U49; ?>" />
                        </td><td>
                            <img src="img/x.gif" class="unit u50" title="<?php echo U50; ?>" alt="<?php echo U50; ?>" />
                        </td>
                    </tr>
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
