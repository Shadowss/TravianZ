<table id="coords" cellpadding="1" cellspacing="1">
	<tbody>
		<tr>
			<td class="sel">
				<label> 
					<input class="radio" name="c" value="2" type="radio"> {$smarty.const.REINFORCEMENT}
				</label>
			</td>

			<td class="vil">
				<span>{$smarty.const.VILLAGE}:</span> 
			<input class="text" name="targetVillageName" value="{$targetVillageName}" maxlength="20" type="text"></td>
		</tr>
		<tr>
			<td class="sel">
				<label> 
					<input class="radio" name="c" value="3" type="radio"> {$smarty.const.NORMALATTACK}
				</label>
			</td>
			<td class="or">{$smarty.const.OR}</td>
		</tr>
		<tr>
			<td class="sel">
				<label> 
					<input class="radio" name="c" value="4" type="radio"> {$smarty.const.RAID}
				</label>
			</td>

        	<td class="target">
        		<span>{$smarty.const.X}:</span> 
        		<input class="text" name="x" value="{$x}" maxlength="4" type="text"> 
        		<span>{$smarty.const.Y}:</span>
				<input class="text" name="y" value="{$y}" maxlength="4" type="text">
			</td>
		</tr>
	</tbody>
</table>
<br />
<button value="prepareUnitsToSend" name="action" id="btn_ok" class="trav_buttons" onclick="this.disabled=true;this.form.submit();"> {$smarty.const.OK} </button>
