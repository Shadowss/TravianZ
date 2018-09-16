{if $smarty.const.REG_OPEN}
<div id="content"  class="signup">

<h1><img src="assets/img/x.gif" class="anmelden" alt="register for the game" /></h1>
<h5><img src="assets/img/x.gif" class="img_u05" alt="registration"/></h5>

<p>{$smarty.const.BEFORE_REGISTER}</p>

<form name="snd" method="post" action="anmelden.php">
{if $Ref}
<input type="hidden" name="Ref" value="{$Ref}">
{/if}
<table id="sign_input">
	<tbody>
		<tr class="top">
			<th>{$smarty.const.NICKNAME}</th>
			<td><input class="text" type="text" name="Username" value="{$Username}" maxlength="15" />
			<span class="error">{$UsernameError}</span>
			</td>
		</tr>
		<tr>
			<th>{$smarty.const.EMAIL}</th>
			<td>
				<input class="text" type="text" name="Email" value="{$Email}" maxlength="30"/>
				<span class="error">{$EmailError}</span>
				</td>
			</tr>
		<tr>
			<th>{$smarty.const.PASSWORD}</th>
			<td>
				<input class="text" type="password" name="Password" value="{$Password}" maxlength="100" />
				<span class="error">{$PasswordError}</span>
			</td>
		</tr>
	</tbody>
</table>

<table id="sign_select">
	<tbody>
		<tr class="top">
			<th><img src="assets/img/x.gif" class="img_u06" alt="choose tribe" /></th>
			<th colspan="2"><img src="assets/img/x.gif" class="img_u07" alt="starting position" /></th>
		</tr>
		<tr>
			<td class="nat"><label><input class="radio" type="radio" name="Tribe" value="1" {if $Tribe == 1}checked{/if} />&nbsp;{$smarty.const.ROMANS}</label></td>
			<td class="pos1"><label><input class="radio" type="radio" name="Sector" value="0" {if $Sector == 0 and isset($Sector)}checked{/if}/>&nbsp;{$smarty.const.RANDOM}</label></td>
			<td class="pos2">&nbsp;</td>
		</tr>
		<tr>
			<td><label><input class="radio" type="radio" name="Tribe" value="2" {if $Tribe == 2}checked{/if}/>&nbsp;{$smarty.const.TEUTONS}</label></td>
			<td><label><input class="radio" type="radio" name="Sector" value="1" {if $Sector == 1}checked{/if}>&nbsp;{$smarty.const.NW} <b>(-|+)</b>&nbsp;</label></td>
			<td><label><input class="radio" type="radio" name="Sector" value="2" {if $Sector == 2}checked{/if} />&nbsp;{$smarty.const.NE} <b>(+|+)</b></label></td>
		</tr>
		<tr class="btm">
			<td><label><input class="radio" type="radio" name="Tribe" value="3" {if $Tribe == 3}checked{/if}/>&nbsp;{$smarty.const.GAULS}</label></td>
			<td><label><input class="radio" type="radio" name="Sector" value="3" {if $Sector == 3}checked{/if}/>&nbsp;{$smarty.const.SW} <b>(-|-)</b></label></td>
			<td><label><input class="radio" type="radio" name="Sector" value="4" {if $Sector == 4}checked{/if}/>&nbsp;{$smarty.const.SE} <b>(+|-)</b></label></td>
		</tr>
	</tbody>
</table>

<ul class="important">
{if !empty($TribeError)}
<li>{$TribeError}</li>
{/if}
{if !empty($SectorError)}
<li>{$SectorError}</li>
{/if}
{if !empty($RefError)}
<li>{$RefError}</li>
{/if}
{if !empty($RulesError)}
<li>{$RulesError}</li>
{/if}
</ul>
<p>
<input class="check" type="checkbox" name="Rules" value="1" {if $Rules}checked{/if}/>{$smarty.const.ACCEPT_RULES}</p>

<p class="btn">
	<button value="register" name="action" id="btn_signup" class="trav_buttons"> {$smarty.const.REG} </button> 
</p>
</form>

<p class="info">{$smarty.const.ONE_PER_SERVER}</p>
</div>

{else}

<div id="content"  class="signup">

<h1><img src="assets/img/x.gif" class="anmelden" alt="register for the game" /></h1>
<h5><img src="assets/img/x.gif" class="img_u05" alt="registration"/></h5>

<p>{$smarty.const.REGISTER_CLOSED}</p>
</div>

{/if}