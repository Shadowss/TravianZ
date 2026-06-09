<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       support.tpl                                                 ##
##  Developed by:  Dzoki                                                       ##
##  Refactored by: Shadow Incremental Refactor 			                       ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2026. All rights reserved.                ##
##                                                                             ##
##  Incremental Refactor Notes:                                                ##
##  - Preserved original HTML structure                                        ##
##  - Added safe PHP wrapper for consistent include behavior                   ##
##  - Kept compatibility with legacy PHP 7+                                    ##
##                                                                             ##
#################################################################################
?>

<h3 class="pop popgreen bold"><?php echo GAME_RULES; ?></h3> 
<div id="rules"> 
    <p> 
        <?php echo TZ_THE_FOLLOWING_SET_OF_RULES_ARE_IN; ?> 
        <br /> 
        <br /> 
        <?php echo TZ_INCITING_MANIPULATING_ENCOURAGING; ?> 
    </p> 
    <ul class="rules"> 
        <li> 
            <strong color="#2A720B">&sect;1 Password, Registration &amp; ownership</strong> 
            <br /> 
            <?php echo TZ_EACH_PLAYER_MAY_ONLY_OWN_AND_PLAY; ?> 
            <ul> 
                <li> 
                    <strong color="#3BAE18">&sect;1.1 Registration</strong> 
                    <br /> 
                    <?php echo TZ_THE_E_MAIL_ADDRESS_USED_FOR_THE_RE; ?>  
                </li> 
                <li> 
                    <strong color="#3BAE18">&sect;1.2 Password</strong> 
                    <br /> 
                    <?php echo TZ_THE_OWNER_OF_AN_ACCOUNT_MAY_NOT_TR; ?> 
                    <br /> 
                    <br /> 
                    <?php echo TZ_HOWEVER_IT_IS_PERMISSIBLE_TO_TRANS; ?> 
                    <br /> 
                    <br /> 
                    <?php echo TZ_THERE_IS_NO_COMPENSATION_FOR_DAMAG_2; ?> 
                </li> 
                <li> 
                    <strong color="#3BAE18">&sect;1.3 Email changes / account transfers</strong> 
                    <br /> 
                    In order to change the email address of your account or to transfer your account to another player NOT playing on the same server, go into your account profile (/spieler.php?s=3) and fill out the new email information. 
                </li> 
                <li> 
                    <strong color="#3BAE18">&sect;1.4 Switching accounts</strong> 
                    <br /> 
                    <?php echo TZ_IN_ORDER_TO_SWITCH_AN_ACCOUNT_WITH; ?> 
                    <ul> 
                        <ol> 
                            <li><?php echo TZ_THE_GAME_WORLD_ON_WHICH_THE_ACCOUN; ?></li> 
                            <li><?php echo TZ_THE_NICKNAME_OF_THE_ACCOUNT; ?></li> 
                            <li><?php echo TZ_THE_E_MAIL_ADDRESS_OF_THE_NEW_OWNE; ?> </li> 
                        </ol> 
                    </ul> 
                    <?php echo TZ_AFTERWARDS_BOTH_PARTIES_MUST_REQUE; ?> 
                </li> 
            </ul> 
        </li> 
        <li> 
            <strong color="#2A720B">&sect;2 Sitting &amp; same pc usage</strong> 
            <br /> 
            <ul> 
                <li> 
                    <strong color="#3BAE18">&sect;2.1 Sitting</strong> 
                    <br /> 
                    <?php echo TZ_ML_TWO_SITTERS_RIGHT; ?> 
                    <br /> 
                    The sitter of an account must sit the account using the ingame account sitting function. The sitter of an account may not tend to an account by logging in with the password of the account they are sitting (see &sect;1.2). 
                    <br /> 
                    <?php echo TZ_THERE_IS_NO_COMPENSATION_FOR_DAMAG; ?> 
                </li> 
                <li> 
                    <strong color="#3BAE18">&sect;2.2 Same pc usage</strong> 
                    <br /> 
                    <?php echo TZ_ML_SAME_COMPUTER_SITTER; ?> 
                </li> 
            </ul> 
        </li> 
        <li> 
            <strong color="#2A720B">&sect;3 Use of externals</strong> 
            <br /> 
            <?php echo TZ_THE_GAME_MUST_BE_PLAYED_WITH_AN_UN; ?>  
        </li> 
        <li> 
            <strong color="#2A720B">&sect;4 Program errors</strong> 
            <br /> 
            <?php echo TZ_PROGRAM_ERRORS_ALSO_CALLED_BUGS_MA; ?>  
        </li> 
        <li> 
            <strong color="#2A720B">&sect;5 Money transactions</strong> 
            <br /> 
            <?php echo TZ_ANY_SALES_OR_PURCHASES_CONCERNING; ?> 
        </li> 
        <li> 
            <strong color="#2A720B">&sect;6 Netiquette</strong> 
            <br /> 
            <?php echo TZ_ML_POLITE_TONE; ?> 
            <ol> 
                <li> 
                    <?php echo TZ_FOLLOWING_BEHAVIOR_IS_PUNISHABLE_A; ?> 
                    <br /> 
                    <?php echo TZ_PARTICIPATION_IN_ABUSIVE_DEFAMATOR; ?> 
                    <br /> 
                    <?php echo TZ_ML_MATERIAL_UNDERAGE; ?> 
                    <br /> 
                    <?php echo TZ_BLACKMAILING_PLAYERS_IN_A_WAY_THAT; ?> 
                    <br /> 
                    <?php echo TZ_DISPLAYING_BATTLE_REPORTS_OR_MESSA; ?> 
                </li> 
                <li><?php echo TZ_NO_REAL_WORLD_POLITICS_ARE_ALLOWED; ?></li> 
                <li><?php echo TZ_ENGLISH_IS_THE_ONLY_LANGUAGE_TOLER; ?> </li> 
                <li><?php echo TZ_IMPERSONATING_OFFICIALS_OR_OFFICIA; ?></li> 
                <li><?php echo TZ_ADVERTISEMENT_OF_ANY_KIND_THAT_HAS; ?></li> 
            </ol> 
        </li> 
        <li> 
            <strong color="#2A720B">&sect;7 Punishments</strong> 
            <br /> 
            <?php echo TZ_IF_THERE_IS_AN_OFFENCE_AGAINST_THE; ?> 
            <br /> 
            <?php echo TZ_RESOURCES_BUILDINGS_VILLAGES_OR_TR; ?> 
            <br /> 
            <?php echo TZ_THERE_IS_NO_SPECIAL_TREATMENT_FOR; ?> 
            <br /> 
            <br /> 
            <?php echo TZ_PLAYERS_MAY_TALK_TO_THE_MULTIHUNTE; ?> 
            <br /> 
            <?php echo TZ_ADDITIONALLY_THE_TRAVIAN_TEAM_WILL; ?>   
            <br /> 
            <br /> 
            <?php echo TZ_MULTIACCOUNTS_ON_THE_SPEED_SERVER; ?> 
        </li> 
        <li> 
            <strong color="#2A720B">&sect;8 Changing of rules</strong> 
            <br /> 
            <?php echo TZ_THE_TRAVIAN_TEAM_RESERVES_THE_RIGH; ?> 
        </li> 
        <li> 
            <strong color="#2A720B">&sect;9 Correction clause</strong> 
            <br /> 
            <?php echo TZ_IF_INDIVIDUAL_REGULATIONS_OF_THIS; ?> 
        </li> 
    </ul> 
</div>