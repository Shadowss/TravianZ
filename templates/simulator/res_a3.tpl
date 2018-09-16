<table class="results attacker" cellpadding="1" cellspacing="1">
				<thead>
					<tr>

						<td class="role">
							Attacker
						</td><td>
								<img src="img/x.gif" class="unit u21" title="Phalanx" alt="Phalanx" />
							</td><td>
								<img src="img/x.gif" class="unit u22" title="Swordsman" alt="Swordsman" />
							</td><td>
								<img src="img/x.gif" class="unit u23" title="Pathfinder" alt="Pathfinder" />
							</td><td>
								<img src="img/x.gif" class="unit u24" title="Theutates Thunder" alt="Theutates Thunder" />
							</td><td>
								<img src="img/x.gif" class="unit u25" title="Druidrider" alt="Druidrider" />
							</td><td>
								<img src="img/x.gif" class="unit u26" title="Haeduan" alt="Haeduan" />
							</td><td>
								<img src="img/x.gif" class="unit u27" title="Ram" alt="Ram" />
							</td><td>
								<img src="img/x.gif" class="unit u28" title="Trebuchet" alt="Trebuchet" />
							</td><td>
								<img src="img/x.gif" class="unit u29" title="Chieftain" alt="Chieftain" />
							</td><td>
								<img src="img/x.gif" class="unit u30" title="Settler" alt="Settler" />
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
