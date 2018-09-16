<table class="results attacker" cellpadding="1" cellspacing="1">
				<thead>
					<tr>
						<td class="role">
							Attacker
						</td><td>
								<img src="img/x.gif" class="unit u1" title="Legionnaire" alt="Legionnaire" />
							</td><td>
								<img src="img/x.gif" class="unit u2" title="Praetorian" alt="Praetorian" />
							</td><td>
								<img src="img/x.gif" class="unit u3" title="Imperian" alt="Imperian" />
							</td><td>
								<img src="img/x.gif" class="unit u4" title="Equites Legati" alt="Equites Legati" />
							</td><td>
								<img src="img/x.gif" class="unit u5" title="Equites Imperatoris" alt="Equites Imperatoris" />
							</td><td>
								<img src="img/x.gif" class="unit u6" title="Equites Caesaris" alt="Equites Caesaris" />
							</td><td>
								<img src="img/x.gif" class="unit u7" title="Battering Ram" alt="Battering Ram" />
							</td><td>
								<img src="img/x.gif" class="unit u8" title="Fire Catapult" alt="Fire Catapult" />
							</td><td>
								<img src="img/x.gif" class="unit u9" title="Senator" alt="Senator" />
							</td><td>
								<img src="img/x.gif" class="unit u10" title="Settler" alt="Settler" />
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
