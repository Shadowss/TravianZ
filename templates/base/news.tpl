<!--#################################################################################
    ##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
    ## --------------------------------------------------------------------------- ##
    ##  Filename       news.tpl                                                    ##
    ##  Developed by:  Dzoki                                                       ##
    ##  License:       TravianX Project                                            ##
    ##  Copyright:     TravianX (c) 2010-2011. All rights reserved.                ##
    ##                                                                             ##
    #################################################################################-->

{if $smarty.const.NEWSBOX1}
{include file={$smarty.const.TEMPLATES_DIR}|cat:'news\newsbox1.tpl'}
{/if}

{if $smarty.const.NEWSBOX2}
{include file={$smarty.const.TEMPLATES_DIR}|cat:'news\newsbox2.tpl'}
{/if}

{if $smarty.const.NEWSBOX3}
{include file={$smarty.const.TEMPLATES_DIR}|cat:'news\newsbox3.tpl'}
{/if}
