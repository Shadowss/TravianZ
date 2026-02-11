<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Project:       TravianZ                                                    ##
##  Version:       22.06.2015                    			       ##
##  Filename       Battle.php                                                  ##
##  Developed by:  Dzoki & Dixie   					       ##
##  Fixed by:      Shadow 				  		       ##
##  Thanks to:     Akakori, Elmar & Kirilloid                                  ##
##  Reworked and Fix by:   ronix                                               ##
##  Fixed by:      InCube - double troops				       ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2015. All rights reserved.                ##
##  URLs:          http://travian.shadowss.ro                		       ##
##  Source code:   https://github.com/Shadowss/TravianZ		               ##
##                                                                             ##
#################################################################################

/*
=========================================================
= BATTLE ENGINE – CORE COMBAT CALCULATION
=========================================================
= Responsible for:
= - Battle simulation (warsim)
= - Real combat calculation
= - Hero combat logic
= - Wall / Residence bonus
= - Catapults & Rams damage
= - Casualties computation
= - Bounty calculation
=========================================================
*/

class Battle
{
    /*
    =====================================================
    = INTERNAL MATH ENGINE
    =====================================================
    */

    private $sigma;

    public function __construct()
    {
        // Kirilloid sigma curve for catapult damage
        $this->sigma = function ($x) {
            return ($x > 1 ? 2 - $x ** -1.5 : $x ** 1.5) / 2;
        };
    }

    /*
    =====================================================
    = ================= SIMULATION ======================
    =====================================================
    */

    public function procSim($post)
    {
        global $form;

        if (!isset($post['a1_v'])) {
            return;
        }

        $sum = 0;
        for ($i = 1; $i <= 10; $i++) {
            $sum += (int)($post['a1_'.$i] ?? 0);
        }

        if ($sum <= 0) {
            return;
        }

        $_POST['result'] = $this->simulate($post);
        $form->valuearray = $post;
    }

    /*
    =====================================================
    = SIMULATION CORE
    =====================================================
    */

    private function simulate($post)
    {
        $attacker = $this->buildAttackerArray($post);
        $defender = $this->buildDefenderArray($post);

        return $this->calculateBattle(
            $attacker,
            $defender,
            $post['walllevel'],
            $post['a1_v'],
            $post['tribe'],
            $post['palast'],
            $post['ew1'],
            $post['ew2'],
            $post['ktyp'] + 3,
            [],
            0,0,0,0,0,0,0,0,
            $post['kata'],
            $post['stonemason'],
            $post['walllevel'],
            $post['h_off_bonus'],
            $post['h_off'],
            $post['h_def_bonus'],
            0,0,0,0,0
        );
    }

    /*
    =====================================================
    = HERO ENGINE
    =====================================================
    */

    private function getBattleHero($uid)
    {
        global $database;

        $hero = $database->getHero($uid);
        if (!count($hero)) {
            return [
                'heroid'=>0,'unit'=>'','atk'=>0,
                'di'=>0,'dc'=>0,'ob'=>0,'db'=>0,'health'=>0
            ];
        }

        $unitData = $GLOBALS["h".$hero[0]['unit']];

        $atk = $unitData['atk'] + ($hero[0]['attack'] * $unitData['atkp']);
        $di  = $unitData['di']  + 5 * floor($hero[0]['defence'] * $unitData['dip'] / 5);
        $dc  = $unitData['dc']  + 5 * floor($hero[0]['defence'] * $unitData['dcp'] / 5);

        return [
            'heroid' => (int)$hero[0]['heroid'],
            'unit'   => $hero[0]['unit'],
            'atk'    => $atk,
            'di'     => $di,
            'dc'     => $dc,
            'ob'     => 1 + 0.010 * ($hero[0]['attackbonus'] / 5),
            'db'     => 1 + 0.010 * ($hero[0]['defencebonus'] / 5),
            'health' => $hero[0]['health']
        ];
    }

    /*
    =====================================================
    = MAIN BATTLE CALCULATION
    =====================================================
    */

    public function calculateBattle(
        $Attacker,
        $Defender,
        $def_wall,
        $att_tribe,
        $def_tribe,
        $residence,
        $attpop,
        $defpop,
        $type,
        $def_ab,
        $att_ab1,$att_ab2,$att_ab3,$att_ab4,
        $att_ab5,$att_ab6,$att_ab7,$att_ab8,
        $tblevel,
        $stonemason,
        $walllevel,
        $offhero,
        $hero_strenght,
        $deffhero,
        $AttackerID,
        $DefenderID,
        $AttackerWref,
        $DefenderWref,
        $conqureby,
        $defReinforcements = null
    )
    {
        global $database;

        /*
        =================================================
        = 1. CALCULATE RAW ATTACK / DEFENSE
        =================================================
        */

        $attackPoints  = $this->calculateAttackPoints($Attacker, $att_tribe);
        $defensePoints = $this->calculateDefensePoints($Defender);

        /*
        =================================================
        = 2. WALL & RESIDENCE BONUS
        =================================================
        */

        $defensePoints = $this->applyWallBonus(
            $defensePoints,
            $def_wall,
            $def_tribe,
            $residence
        );

        /*
        =================================================
        = 3. FINAL RAP / RDP
        =================================================
        */

        $rap = round($attackPoints);
        $rdp = round($defensePoints);

        $winner = $rap > $rdp;

        /*
        =================================================
        = 4. CASUALTY FACTOR
        =================================================
        */

        $ratio = $rap > 0
            ? pow(($rdp / $rap), 1.5)
            : 1;

        if ($ratio > 1) $ratio = 1;

        $result = [];
        $result['Attack_points']  = $rap;
        $result['Defend_points']  = $rdp;
        $result['Winner']         = $winner ? "attacker" : "defender";
        $result[1] = $ratio;
        $result[2] = 1 - $ratio;

        /*
        =================================================
        = 5. CASUALTIES
        =================================================
        */

        $result['casualties_attacker'] =
            $this->calculateCasualties($Attacker, $ratio, $att_tribe);

        /*
        =================================================
        = 6. BOUNTY
        =================================================
        */

        $result['bounty'] =
            $this->calculateBounty($Attacker, $result['casualties_attacker'], $att_tribe);

        return $result;
    }

    /*
    =====================================================
    = ATTACK / DEFENSE HELPERS
    =====================================================
    */

    private function calculateAttackPoints($Attacker, $tribe)
    {
        $start = ($tribe - 1) * 10 + 1;
        $end   = $tribe * 10;

        $points = 0;

        for ($i = $start; $i <= $end; $i++) {
            global ${'u'.$i};
            $points += (int)$Attacker['u'.$i] * ${'u'.$i}['atk'];
        }

        return $points;
    }

    private function calculateDefensePoints($Defender)
    {
        $points = 0;

        for ($i = 1; $i <= 50; $i++) {
            global ${'u'.$i};
            $points += (int)$Defender['u'.$i] * ${'u'.$i}['di'];
        }

        return $points;
    }

    private function applyWallBonus($defPoints, $wall, $tribe, $residence)
    {
        if ($wall <= 0) {
            return $defPoints + (2 * pow($residence,2) + 10);
        }

        $factor = ($tribe == 1)
            ? 1.030
            : (($tribe == 2) ? 1.020 : 1.025);

        return $defPoints * pow($factor, $wall);
    }

    private function calculateCasualties($Attacker, $ratio, $tribe)
    {
        $casualties = [];

        $start = ($tribe - 1) * 10 + 1;
        $end   = $tribe * 10;

        for ($i = $start; $i <= $end; $i++) {
            $index = $i - (($tribe - 1) * 10);
            $casualties[$index] =
                round($ratio * (int)$Attacker['u'.$i]);
        }

        return $casualties;
    }

    private function calculateBounty($Attacker, $casualties, $tribe)
    {
        $start = ($tribe - 1) * 10 + 1;
        $end   = $tribe * 10;

        $bounty = 0;

        for ($i = $start; $i <= $end; $i++) {
            global ${'u'.$i};
            $index = $i - (($tribe - 1) * 10);

            $alive = (int)$Attacker['u'.$i] - (int)$casualties[$index];

            $bounty += $alive * (int)${'u'.$i}['cap'];
        }

        return $bounty;
    }
}

$battle = new Battle;
?>
