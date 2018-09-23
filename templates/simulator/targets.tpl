<table id="select" cellpadding="1" cellspacing="1">
	<thead>
		<tr>
			<td>{$smarty.const.ATTACKER}</td>
			<td>{$smarty.const.DEFENDER}</td>
			<td>{$smarty.const.TYPE_OF_ATTACK}</td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>
				<label>
					<input class="radio" type="radio" name="attacker" value="1"  {if $tribe == 1}checked="checked"{/if} /> {$smarty.const.TRIBE1}
				</label>
				<br />
				<label>
					<input class="radio" type="radio" name="attacker" value="2"  {if $tribe == 2}checked="checked"{/if} /> {$smarty.const.TRIBE2}
				</label>
				<label>
					<input class="radio" type="radio" name="attacker" value="3" {if $tribe == 3}checked="checked"{/if} /> {$smarty.const.TRIBE3}
				</label>
			</td>
			<td>
				<label>
					<input class="check" type="checkbox" name="defender" value="1" /> {$smarty.const.TRIBE1}
				</label>
				<br /> 
				<label>
					<input class="check" type="checkbox" name="defender" value="2" /> {$smarty.const.TRIBE2}
				</label>
				<br /> 
				<label>
					<input class="check" type="checkbox" name="defender" value="3" /> {$smarty.const.TRIBE3}
				</label>
				<br />
				<label>
					<input class="check" type="checkbox" name="defender" value="1" /> {$smarty.const.TRIBE4}
				</label>
				<br />
				<label>
					<input class="check" type="checkbox" name="defender" value="1" /> {$smarty.const.TRIBE5}
				</label>
			</td>
			<td>
				<label>
					<input class="radio" type="radio" name="attackType" value="3" {if $attackType == 3}checked="checked"{/if} /> {$smarty.const.NORMALATTACK}
				</label>
				<br /> 
				<label>
					<input class="radio" type="radio" name="attackType" value="4" {if $attackType == 4}checked="checked"{/if}/> {$smarty.const.RAID}
				</label>
			</td>
		</tr>
	</tbody>
</table>
	
<p class="btn">
	<button value="startSimulation" name="action" id="btn_ok" class="trav_buttons"> Ok </button>
</p>