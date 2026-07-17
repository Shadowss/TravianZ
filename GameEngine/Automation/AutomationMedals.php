<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Project:       TravianZ                                                    ##
##  Filename:      AutomationMedals.php                                        ##
##  Split&Refactor Shadow													   ##
##  Purpose:       Weekly player/alliance medals, statistics reset             ##
##                                                                             ##
##  Phase S2: Trait extracted from GameEngine/Automation.php                   ##
##            (Automation class).                                              ##
##  Methods were moved IDENTICALLY, with no logic changes.                     ##
##                                                                             ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2026. All rights reserved.                ##
##  URLs:          https://travianz.org                                        ##
##                 https://github.com/Shadowss/TravianZ                        ##
#################################################################################

trait AutomationMedals {


    /**
     * Function for automate medals - by yi12345 and Shadow
     *
     */
    
	function medals() {
        global $database;

        // Check the timing window; $time is the next "last awarded" stamp to write.
        $time = $this->shouldAwardMedalsNow();
        if ($time === null) {
            return;
        }

        // Exclude BANNED (0), MH (8), ADMIN (9)
        $userFilter = "id > 5 AND access NOT IN (0,8,9)";

        $week = $this->getNextMedalWeek('medal');
        $allyweek = $this->getNextMedalWeek('allimedal');

        $this->awardPlayerMedals($week, $userFilter);
        $this->resetWeeklyStats('users', $userFilter, "ap=0, dp=0, Rc=0, clp=0, RR=0");
        $this->awardAllianceMedals($allyweek);
        $this->resetWeeklyStats('alidata', '', "ap=0, dp=0, RR=0, clp=0");

        // Update last awarded time
        $database->query("UPDATE ".TB_PREFIX."config SET lastgavemedal=".(int)$time);
    }

    // Returns the next "lastgavemedal" stamp to write if medals are due now, or
    // null to skip this run. On the very first run after server start it only
    // schedules the next run (and returns null).
    private function shouldAwardMedalsNow() {
        global $database;

        $giveMedal = false;
        $time = null;
        $q = "SELECT lastgavemedal FROM ".TB_PREFIX."config";
        $result = mysqli_query($database->dblink, $q);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $stime = strtotime(START_DATE) - strtotime(date('d.m.Y')) + strtotime(START_TIME);

            if ($row['lastgavemedal'] == 0 && $stime < time()) {
                // First run after server start - schedule next run
                $setDays = round(MEDALINTERVAL / 86400);
                $newtime = $setDays < 7? strtotime(($setDays + 1).' day midnight') : strtotime('next monday');
                $database->query("UPDATE ".TB_PREFIX."config SET lastgavemedal = ".(int)$newtime);
            } elseif ($row['lastgavemedal']!= 0) {
                $time = $row['lastgavemedal'] + MEDALINTERVAL;
                $giveMedal = $row['lastgavemedal'] < time();
            }
        }

        if (!($giveMedal && MEDALINTERVAL > 0)) {
            return null;
        }
        return $time;
    }

    // Next week number for a medal table (medal / allimedal).
    private function getNextMedalWeek($table) {
        global $database;

        $q = "SELECT week FROM ".TB_PREFIX."$table ORDER BY week DESC LIMIT 1";
        $res = mysqli_query($database->dblink, $q);
        return $res && mysqli_num_rows($res)? (mysqli_fetch_assoc($res)['week'] + 1) : 1;
    }

    // Insert a user medal row.
    private function insertUserMedal($userid, $category, $place, $week, $points, $img) {
        global $database;

        $q = "INSERT INTO ".TB_PREFIX."medal (userid, categorie, plaats, week, points, img) VALUES (".
            (int)$userid.", ".(int)$category.", ".(int)$place.", ".(int)$week.", '".mysqli_real_escape_string($database->dblink, $points)."', '".mysqli_real_escape_string($database->dblink, $img)."')";
        mysqli_query($database->dblink, $q);
    }

    // Insert an alliance medal row.
    private function insertAllianceMedal($allyid, $cat, $place, $week, $points, $img) {
        global $database;

        $q = "INSERT INTO ".TB_PREFIX."allimedal (allyid, categorie, plaats, week, points, img) VALUES (".(int)$allyid.", '".(int)$cat."', ".(int)$place.", '".(int)$week."', '".mysqli_real_escape_string($database->dblink, $points)."', '".mysqli_real_escape_string($database->dblink, $img)."')";
        mysqli_query($database->dblink, $q);
    }

    // Award the top 10 users for a stat field (one category).
    private function awardTopMedals($field, $category, $imgPrefix, $week, $userFilter) {
        global $database;

        $q = "SELECT id, $field FROM ".TB_PREFIX."users WHERE $userFilter ORDER BY $field DESC, id DESC LIMIT 10";
        $res = mysqli_query($database->dblink, $q);
        $i = 0;
        while ($row = mysqli_fetch_array($res)) {
            $i++;
            $this->insertUserMedal($row['id'], $category, $i, $week, $row[$field], $imgPrefix.$i);
        }
    }

    // Award milestone ribbons for 3/5/10 appearances in a top3 or top10 category.
    private function awardMilestoneMedals($field, $sourceCat, $topLimit, $targetCat, $imgBase, $week, $userFilter) {
        global $database;

        $res = mysqli_query($database->dblink, "SELECT id FROM ".TB_PREFIX."users WHERE $userFilter ORDER BY $field DESC, id DESC LIMIT 10");
        while ($u = mysqli_fetch_array($res)) {
            $cnt = mysqli_fetch_row(mysqli_query($database->dblink,
                "SELECT COUNT(*) FROM ".TB_PREFIX."medal WHERE userid=".(int)$u['id']." AND categorie=".(int)$sourceCat." AND plaats<=".(int)$topLimit))[0];

            $map = ['3' => ['Three', $imgBase.'0_1'], '5' => ['Five', $imgBase.'1_1'], '10' => ['Ten', $imgBase.'2_1']];
            if (isset($map[$cnt])) {
                $this->insertUserMedal($u['id'], $targetCat, 0, $week, $map[$cnt][0], $map[$cnt][1]);
            }
        }
    }

    // Player medals: top 10 of each category, the attack+defense bonus, then milestones.
    private function awardPlayerMedals($week, $userFilter) {
        global $database;

        // Top 10 for each category
        $this->awardTopMedals('ap', 1, 't2_', $week, $userFilter);   // Attackers of the week (cat 1)
        $this->awardTopMedals('dp', 2, 't3_', $week, $userFilter);   // Defenders of the week (cat 2)
        $this->awardTopMedals('Rc', 3, 't1_', $week, $userFilter);   // Climbers of the week (cat 3)
        $this->awardTopMedals('clp', 10, 't6_', $week, $userFilter); // Rank climbers of the week (cat 10)
        $this->awardTopMedals('RR', 4, 't4_', $week, $userFilter);   // Robbers of the week (cat 4)

        // --- Bonus: player in both top10 attack AND defense (cat 5) ---
        $topAttackers = mysqli_query($database->dblink, "SELECT id FROM ".TB_PREFIX."users WHERE $userFilter ORDER BY ap DESC, id DESC LIMIT 10");
        while ($a = mysqli_fetch_array($topAttackers)) {
            $topDefenders = mysqli_query($database->dblink, "SELECT id FROM ".TB_PREFIX."users WHERE $userFilter ORDER BY dp DESC, id DESC LIMIT 10");
            while ($d = mysqli_fetch_array($topDefenders)) {
                if ($a['id'] == $d['id']) {
                    $cnt = mysqli_fetch_row(mysqli_query($database->dblink, "SELECT COUNT(*) FROM ".TB_PREFIX."medal WHERE userid=".(int)$a['id']." AND categorie=5"))[0];
                    if ($cnt <= 2) {
                        $texts = [0 => '', 1 => 'twice ', 2 => 'three times '];
                        $this->insertUserMedal($a['id'], 5, 0, $week, $texts[$cnt], 't22'.$cnt.'_1');
                    }
                }
            }
        }

        // --- Milestone ribbons for 3/5/10 times in top3 or top10 ---
        // Attackers milestones
        $this->awardMilestoneMedals('ap', 1, 3, 6, 't12', $week, $userFilter);  // top3 attackers
        $this->awardMilestoneMedals('ap', 1, 10, 12, 't13', $week, $userFilter); // top10 attackers
        // Defenders milestones
        $this->awardMilestoneMedals('dp', 2, 3, 7, 't14', $week, $userFilter);
        $this->awardMilestoneMedals('dp', 2, 10, 13, 't15', $week, $userFilter);
        // Climbers milestones
        $this->awardMilestoneMedals('Rc', 3, 3, 8, 't10', $week, $userFilter);
        $this->awardMilestoneMedals('Rc', 3, 10, 14, 't11', $week, $userFilter);
        // Rank climbers milestones
        $this->awardMilestoneMedals('clp', 10, 3, 11, 't20', $week, $userFilter);
        $this->awardMilestoneMedals('clp', 10, 10, 16, 't21', $week, $userFilter);
        // Robbers milestones
        $this->awardMilestoneMedals('RR', 4, 3, 9, 't16', $week, $userFilter);
        $this->awardMilestoneMedals('RR', 4, 10, 15, 't17', $week, $userFilter);
    }

    // Alliance medals: top 10 of each category, then the attack+defense bonus.
    private function awardAllianceMedals($allyweek) {
        global $database;

        $allyCats = [
            ['ap', 1, 'a2_'],
            ['dp', 2, 'a3_'],
            ['RR', 4, 'a4_'],
            ['clp', 3, 'a1_']
        ];
        foreach ($allyCats as [$field, $cat, $img]) {
            $res = mysqli_query($database->dblink, "SELECT id, $field FROM ".TB_PREFIX."alidata ORDER BY $field DESC, id DESC LIMIT 10");
            $i = 0;
            while ($r = mysqli_fetch_array($res)) { $i++; $this->insertAllianceMedal($r['id'], $cat, $i, $allyweek, $r[$field], $img.$i); }
        }

        // Alliance bonus for attack+defense
        $resA = mysqli_query($database->dblink, "SELECT id FROM ".TB_PREFIX."alidata ORDER BY ap DESC, id DESC LIMIT 10");
        while ($a = mysqli_fetch_array($resA)) {
            $resD = mysqli_query($database->dblink, "SELECT id FROM ".TB_PREFIX."alidata ORDER BY dp DESC, id DESC LIMIT 10");
            while ($d = mysqli_fetch_array($resD)) {
                if ($a['id'] == $d['id']) {
                    $cnt = mysqli_fetch_row(mysqli_query($database->dblink, "SELECT COUNT(*) FROM ".TB_PREFIX."allimedal WHERE allyid=".(int)$a['id']." AND categorie=5"))[0];
                    if ($cnt <= 2) {
                        $texts = [0 => '', 1 => 'twice ', 2 => 'three times '];
                        $this->insertAllianceMedal($a['id'], 5, 0, $allyweek, $texts[$cnt], 't22'.$cnt.'_1');
                    }
                }
            }
        }
    }

    // Reset the weekly stat columns for every id in a table (optionally filtered).
    private function resetWeeklyStats($table, $where, $setClause) {
        global $database;

        $ids = [];
        $sql = "SELECT id FROM ".TB_PREFIX.$table;
        if ($where !== '') $sql .= " WHERE ".$where;
        $res = mysqli_query($database->dblink, $sql);
        while ($r = mysqli_fetch_row($res)) { $ids[] = (int)$r[0]; }
        if ($ids) {
            mysqli_query($database->dblink, "UPDATE ".TB_PREFIX.$table." SET ".$setClause." WHERE id IN(".implode(',', $ids).")");
        }
    }
}
