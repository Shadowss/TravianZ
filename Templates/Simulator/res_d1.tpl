<table class="results defender" cellpadding="1" cellspacing="1">
				<thead>
					<tr>
						<td class="role">
							Defender
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
                                <td <?php if (!$form->getValue('a2_1')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_1');} ?></td>
                                <td <?php if (!$form->getValue('a2_2')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_2');} ?></td>
                                <td <?php if (!$form->getValue('a2_3')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_3');} ?></td>
                                <td <?php if (!$form->getValue('a2_4')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_4');} ?></td>
                                <td <?php if (!$form->getValue('a2_5')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_5');} ?></td>
                                <td <?php if (!$form->getValue('a2_6')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_6');} ?></td>
                                <td <?php if (!$form->getValue('a2_7')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_7');} ?></td>
                                <td <?php if (!$form->getValue('a2_8')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_8');} ?></td>
                                <td <?php if (!$form->getValue('a2_9')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_9');} ?></td>
                                <td <?php if (!$form->getValue('a2_10')) { echo "class=\"none\">0"; }else{ echo ">".$form->getValue('a2_10');} ?></td>
                  </tr>
					<tr>
						<th>
							Casualties
						</th>
                        <td <?php if (!$troops = $form->getValue('a2_1')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a2_2')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a2_3')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a2_4')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a2_5')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a2_6')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a2_7')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a2_8')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a2_9')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        <td <?php if (!$troops = $form->getValue('a2_10')) { echo "class=\"none\">0"; }else{ echo ">".$dead = round($troops * $_POST['result'][2]);} ?></td>
                        </tr>
				</tbody>
			</table>
