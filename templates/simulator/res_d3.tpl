<table class="results defender" cellpadding="1" cellspacing="1">
				<thead>
					<tr>

						<td class="role">
							Defender
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
