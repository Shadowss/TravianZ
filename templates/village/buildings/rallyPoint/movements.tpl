{assign var=movementConstants value=[
	1 => $smarty.const.SCOUTING, 
	$smarty.const.REINFORCEMENTFOR, 
	$smarty.const.ATTACK_ON, 
	$smarty.const.RAID_ON,
	$smarty.const.SETTLING,
	7 => $smarty.const.RETURNFROM
]}

{if !empty($villageMovementsInfo['to'])}
	<h4>{$smarty.const.INCOMING_TROOPS} ({count($villageMovementsInfo['to'])})</h4>

	{foreach $villageMovementsInfo['to'] as $movement}
		{$isMovement = true}
		{$isPrisoner = false}
		{$showTroops = false}
		{$unitsText = $movementConstants[$movement.type]|cat:{$movement.targetVillageName}}
		{$units = $movement}

		{include file=$smarty.const.TEMPLATES_DIR|cat:'village/buildings/rallyPoint/unitsTable.tpl'}
	{/foreach}
{/if}

<h4>{$smarty.const.TROOPS_IN_THE_VILLAGE}</h4>

{$isMovement = false}
{$isPrisoner = false}
{$showTroops = true}
{$canBeSentBack = false}
{$unitsText = $smarty.const.OWN_TROOPS}
{$units = $villagePresentUnits}

{include file=$smarty.const.TEMPLATES_DIR|cat:'village/buildings/rallyPoint/unitsTable.tpl'}

{if !empty($villageEnforcements['village']['to'])}
	{foreach $villageEnforcements['village']['to'] as $enforcement}
		{$canBeSentBack = true}
		{$unitsSendBackType = 'w'}
		{$unitsSendBackText = $smarty.const.SEND_BACK}
		{$unitsText = $enforcement.ownerUsername|cat:$smarty.const.OWNED_TROOPS}
		{$units = $enforcement}

		{include file=$smarty.const.TEMPLATES_DIR|cat:'village/buildings/rallyPoint/unitsTable.tpl'}
	{/foreach}
{/if}

{if !empty($villageEnforcements['village']['from'])}
<h4>{$smarty.const.TROOPS_IN_OTHER_VILLAGE}</h4>

	{foreach $villageEnforcements['village']['from'] as $enforcement}
		{$isMovement = false}
		{$isPrisoner = false}
		{$showTroops = true}
		{$canBeSentBack = true}
		{$unitsSendBackType = 'r'}
		{$unitsSendBackText = $smarty.const.SEND_BACK}
		{$unitsText = $enforcement.ownerUsername|cat:$smarty.const.OWNED_TROOPS}
		{$units = $enforcement}
		{include file=$smarty.const.TEMPLATES_DIR|cat:'village/buildings/rallyPoint/unitsTable.tpl'}
	{/foreach}
{/if}

{if !empty($villageEnforcements['oasis']['to'])}
<h4>{$smarty.const.TROOPS_IN_OASIS}</h4>

	{foreach $villageEnforcements['oasis']['to'] as $enforcement}
		{$isMovement = false}
		{$isPrisoner = false}
		{$showTroops = true}
		{$canBeSentBack = true}
		{$unitsSendBackType = 'r'}
		{$unitsSendBackText = $smarty.const.SEND_BACK}
		{$unitsText = $enforcement.ownerUsername|cat:$smarty.const.OWNED_TROOPS}
		{$units = $enforcement}
		{include file=$smarty.const.TEMPLATES_DIR|cat:'village/buildings/rallyPoint/unitsTable.tpl'}
	{/foreach}
{/if}
{if !empty($villageTrappedUnits['to'])}
<h4>{$smarty.const.PRISONERS_IN_THIS_VILLAGE}</h4>

	{foreach $villageTrappedUnits['to'] as $trappedUnits}
		{$isMovement = false}
		{$isPrisoner = true}
		{$showTroops = true}
		{$canBeSentBack = true}
		{$unitsSendBackType = 'del'}
		{$unitsSendBackText = $smarty.const.SEND_BACK}
		{$unitsText = $smarty.const.PRISONERS_FROM|cat:' '|cat:$trappedUnits.villageName}
		{$units = $trappedUnits}
		{include file=$smarty.const.TEMPLATES_DIR|cat:'village/buildings/rallyPoint/unitsTable.tpl'}
	{/foreach}
{/if}
		
{if !empty($villageTrappedUnits['from'])}
<h4>{$smarty.const.PRISONERS_IN_OTHER_VILLAGES}</h4>

	{foreach $villageTrappedUnits['from'] as $trappedUnits}
		{$isMovement = false}
		{$isPrisoner = true}
		{$showTroops = true}
		{$canBeSentBack = true}
		{$unitsSendBackType = 'del'}
		{$unitsSendBackText = $smarty.const.KILL}
		{$unitsText = $smarty.const.PRISONERS_IN|cat:' '|cat:$trappedUnits.villageName}
		{$units = $trappedUnits}
		{include file=$smarty.const.TEMPLATES_DIR|cat:'village/buildings/rallyPoint/unitsTable.tpl'}
	{/foreach}
{/if}

{if !empty($villageMovementsInfo['from'])}
<h4>{$smarty.const.TROOPS_ON_THEIR_WAY}</h4>

	{foreach $villageMovementsInfo['from'] as $movement}
		{$isMovement = true}
		{$isPrisoner = false}
		{$showTroops = true}
		{$canBeSentBack = false}
		{$unitsText = $movementConstants[$movement.type]|cat:$movement.targetVillageName}
		{$units = $movement}
		{include file=$smarty.const.TEMPLATES_DIR|cat:'village/buildings/rallyPoint/unitsTable.tpl'}
	{/foreach}
{/if}
