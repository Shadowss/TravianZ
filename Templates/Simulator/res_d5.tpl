<table class="results defender" cellpadding="1" cellspacing="1">
				<thead>
					<tr>
						<td class="role">
							Defender
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
				</thead>
				<tbody>
					<tr>
						<th>

							Troops
						</th>
                                <td <?php if (!$form->getValue('a2_41')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_41');} ?></td>
                                <td <?php if (!$form->getValue('a2_42')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_42');} ?></td>
                                <td <?php if (!$form->getValue('a2_43')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_43');} ?></td>
                                <td <?php if (!$form->getValue('a2_44')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_44');} ?></td>
                                <td <?php if (!$form->getValue('a2_45')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_45');} ?></td>
                                <td <?php if (!$form->getValue('a2_46')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_46');} ?></td>
                                <td <?php if (!$form->getValue('a2_47')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_47');} ?></td>
                                <td <?php if (!$form->getValue('a2_48')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_48');} ?></td>
                                <td <?php if (!$form->getValue('a2_49')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_49');} ?></td>
                                <td <?php if (!$form->getValue('a2_50')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_50');} ?></td>
                                </tr>
					<tr>

						<th>
							Casualties
						</th>
						</th>
                        <td <?php if (!$troops = $form->getValue('a2_41')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a2_42')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a2_43')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a2_44')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a2_45')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a2_46')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a2_47')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a2_48')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a2_49')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a2_50')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        </tr>

				</tbody>
			</table>
