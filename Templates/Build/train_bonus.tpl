<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : TRAINING TIME BONUS LINES                                 ##
##  Type           : SHARED BUILDING PARTIAL                                   ##
## --------------------------------------------------------------------------- ##
##  Created by     : Shadow                                                    ##
## --------------------------------------------------------------------------- ##
##  Contact        : cata7007@gmail.com                                        ##
##  Project        : TravianZ                                                  ##
##  GitHub         : https://github.com/Shadowss/TravianZ                      ##
## --------------------------------------------------------------------------- ##
##  License        : TravianZ Project                                          ##
##  Copyright      : TravianZ (c) 2010-2026. All rights reserved.              ##
## --------------------------------------------------------------------------- ##
##                                                                             ##
##  Afiseaza, sub timpul normal de instruire, reducerile active:               ##
##    - coiful eroului (HB_TRAIN_INF / HB_TRAIN_CAV)                           ##
##    - bonusul de alianta "Recruitment"                                       ##
##  si timpul final rezultat.                                                  ##
##                                                                             ##
##  Se include din 19_train.tpl, 20_train.tpl, 29_train.tpl si 30_train.tpl.   ##
##  Variabile asteptate de la sablonul care il include:                        ##
##    $tbUnit - id-ul unitatii                                                 ##
##    $tbTime - timpul de baza, in secunde (dupa cladire + artefacte)          ##
##                                                                             ##
##  Nu afiseaza nimic daca nu exista nicio reducere, deci pe serverele fara    ##
##  erou T4 sau fara bonusuri de alianta lista arata exact ca inainte.         ##
##                                                                             ##
#################################################################################

global $technology, $generator;

if (!isset($tbUnit, $tbTime) || !is_object($technology)
    || !method_exists($technology, 'getTrainingBonusInfo')) {
    return;
}

$tbInfo = $technology->getTrainingBonusInfo($tbUnit, $tbTime);

if (empty($tbInfo['has_bonus'])) {
    return;
}

/**
 * CSS-ul se emite o singura data pe pagina, la primul rand care are bonus.
 * Asa nu trebuie atinse 19.tpl / 20.tpl / 29.tpl / 30.tpl doar pentru stil,
 * si nu se repeta de 10 ori cand sunt 10 unitati in lista.
 */
if (empty($GLOBALS['tbCssDone'])) {
    $GLOBALS['tbCssDone'] = true;
?>
<style type="text/css">
/* reducerile de timp la instruire (cazarma, grajd si variantele mari) */
.trainBonus {
    margin-top: 3px;
    padding-top: 3px;
    border-top: 1px dotted #d9d6cf;
    font-size: 10px;
    line-height: 15px;
    color: #96928a;          /* palid: informatie secundara, nu concureaza cu timpul normal */
}

.trainBonus .tbLine { display: inline-block; margin-right: 10px; white-space: nowrap; }

.trainBonus .tbTag {
    display: inline-block;
    margin-right: 3px;
    padding: 0 4px;
    border-radius: 2px;
    color: #ffffff;
    font-size: 9px;
    line-height: 13px;
}

.trainBonus .tbArte  { background: #7d5ba6; }   /* mov, ca artefactele */
.trainBonus .tbHero  { background: #b8862f; }   /* auriu, ca echipamentul eroului */
.trainBonus .tbAlly  { background: #5d7391; }   /* albastru, ca bonusurile de alianta */
.trainBonus .tbSaved { color: #b3afa7; }

.trainBonus .tbFinal { color: #4a7a24; }        /* verde: rezultatul care conteaza */
.trainBonus .tbFinal b { color: #3f6b1c; }
.trainBonus .tbFinal .clock { vertical-align: -2px; margin-right: 2px; }
</style>
<?php
}

$tbLblArtifact = defined('TRAIN_BONUS_ARTIFACT') ? TRAIN_BONUS_ARTIFACT : 'Artifact bonus';
$tbLblHero     = defined('TRAIN_BONUS_HERO')     ? TRAIN_BONUS_HERO     : 'Hero bonus';
$tbLblAlliance = defined('TRAIN_BONUS_ALLIANCE') ? TRAIN_BONUS_ALLIANCE : 'Alliance bonus';
$tbLblFinal    = defined('TRAIN_BONUS_FINAL')    ? TRAIN_BONUS_FINAL    : 'Training time';
?>
<div class="trainBonus">
    <?php if ($tbInfo['artifact_percent'] > 0) { ?>
        <span class="tbLine">
            <span class="tbTag tbArte"><?php echo $tbLblArtifact; ?></span>
            &minus;<?php echo (int) $tbInfo['artifact_percent']; ?>%
            <?php if ($tbInfo['artifact_saved'] > 0) { ?>
                <span class="tbSaved">(&minus;<?php echo $generator->getTimeFormat($tbInfo['artifact_saved']); ?>)</span>
            <?php } ?>
        </span>
    <?php } ?>

    <?php if ($tbInfo['hero_percent'] > 0) { ?>
        <span class="tbLine">
            <span class="tbTag tbHero"><?php echo $tbLblHero; ?></span>
            &minus;<?php echo (int) $tbInfo['hero_percent']; ?>%
            <?php if ($tbInfo['hero_saved'] > 0) { ?>
                <span class="tbSaved">(&minus;<?php echo $generator->getTimeFormat($tbInfo['hero_saved']); ?>)</span>
            <?php } ?>
        </span>
    <?php } ?>

    <?php if ($tbInfo['alliance_percent'] > 0) { ?>
        <span class="tbLine">
            <span class="tbTag tbAlly"><?php echo $tbLblAlliance; ?></span>
            &minus;<?php echo (int) $tbInfo['alliance_percent']; ?>%
            <?php if ($tbInfo['alliance_saved'] > 0) { ?>
                <span class="tbSaved">(&minus;<?php echo $generator->getTimeFormat($tbInfo['alliance_saved']); ?>)</span>
            <?php } ?>
        </span>
    <?php } ?>

    <span class="tbLine tbFinal">
        <img class="clock" src="img/x.gif" alt="" title="<?php echo $tbLblFinal; ?>" />
        <b><?php echo $generator->getTimeFormat($tbInfo['after_alliance']); ?></b>
    </span>
</div>
