<!--#################################################################################
    ##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
    ## --------------------------------------------------------------------------- ##
    ##  Filename       links.tpl                                                   ##
    ##  Developed by:  Slim, Manuel Mannhardt <manuel_mannhardt@web.de>            ##
    ##  License:       TravianX Project                                            ##
    ##  Copyright:     TravianX (c) 2010-2011. All rights reserved.                ##
    ##                                                                             ##
    #################################################################################-->

{if !empty($links)}
<table cellpadding="1" cellspacing="1">
    <thead>
        <tr>
            <td colspan="3">    
                <a href="spieler.php?s=2">{$smarty.const.LINKS}:</a>
            </td>
        </tr>
     </thead>
<tbody>

{foreach $links as $link}
   {if ($link.url|substr:-1:1) == '*'}
       {assign var='target' value='target="_blank"'}
       {assign var='external' value='<img src="{$smarty.const.GPACK_LOCATE}travian_default/img/a/external.gif"/>'}
       {$link.url|replace:'*':''}
   {else}
       {assign var='target' value=''}
       {assign var='external' value=''}
   {/if}
  
   <tr>
       <td class="dot">•</td>
       <td class="link">
   	       {if !$plus}
               buy Plus 
           {else}
           <a href="{$link.url}" {$target}> {$link.name}{$external}</a>
       </td>
   </tr>
   {/if}
{/foreach}

</tbody>
</table>
{/if}
