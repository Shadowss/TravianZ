<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       Market.php                                                  ##
##  Developed by:  Dzoki                                                       ##
##  Some fixes:    aggenkeech                                                  ##
##  Refactor:      Shadow	                                                   ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2025. All rights reserved.                ##
##                                                                             ##
#################################################################################

class Market
{
    public $onsale = array();
    public $onmarket = array();
    public $sending = array();
    public $recieving = array();
    public $return = array();
    public $maxcarry = 0;
    public $merchant = 0;
    public $used = 0;

    /* =========================================================
       INPUT NORMALIZATION LAYER
    ========================================================== */

    private function int($value) {
        return (int)$value;
    }

    private function str($value) {
        return trim((string)$value);
    }

    private function arr($value) {
        return is_array($value) ? $value : array();
    }

    private function safeRedirect($url) {
        header("Location: ".$url);
        exit;
    }

    /* =========================================================
       MARKET ENTRY POINT
    ========================================================== */

    public function procMarket($post)
    {
        $this->loadMarket();

        if(isset($_SESSION['loadMarket'])) {
            $this->loadOnsale();
            unset($_SESSION['loadMarket']);
        }

        if(!is_array($post) || !isset($post['ft'])) {
            return;
        }

        $ft = $this->str($post['ft']);

        switch($ft) {
            case "mk1":
                $this->sendResource($post);
                break;
            case "mk2":
                $this->addOffer($post);
                break;
            case "mk3":
                $this->tradeResource($post);
                break;
        }
    }

    /* =========================================================
       REMOVE / ACCEPT HANDLER
    ========================================================== */

    public function procRemove($get)
    {
        global $database, $village, $session;

        if(!is_array($get)) return;

        $t = isset($get['t']) ? $this->int($get['t']) : 0;
        $id = isset($get['id']) ? $this->int($get['id']) : 0;

        if($t === 1) {
            $this->filterNeed($get);
        }

        if($t === 2 
           && isset($get['a']) 
           && $this->int($get['a']) === 5 
           && isset($get['del']))
        {
            $del = $this->int($get['del']);

            $type = $database->getMarketField($village->wid, $del, "gtype");
            $amt  = $database->getMarketField($village->wid, $del, "gamt");

            $database->getResourcesBack($village->wid, $type, $amt);
            $database->addMarket($village->wid, $del, 0,0,0,0,0,0,1);

            $this->safeRedirect("build.php?id=".$id."&t=2");
        }

        if($t === 1 
           && isset($get['a']) 
           && $this->int($get['a']) === $session->mchecker 
           && !isset($get['del']))
        {
            $session->changeChecker();
            $this->acceptOffer($get);
        }
    }

    /* =========================================================
       MERCHANTS
    ========================================================== */

    public function merchantAvail()
    {
        return max(0, $this->merchant - $this->used);
    }
	
    /* =========================================================
       LOAD MARKET DATA
    ========================================================== */

    private function loadMarket()
    {
        global $session,$building,$bid28,$bid17,$database,$village;

        $this->recieving = $database->getMovement(0,$village->wid,1);
        $this->sending   = $database->getMovement(0,$village->wid,0);
        $this->return    = $database->getMovement(2,$village->wid,1);

        $lvl17 = $building->getTypeLevel(17);
        $this->merchant = ($lvl17 > 0) ? $bid17[$lvl17]['attri'] : 0;

        $this->used     = (int)$database->totalMerchantUsed($village->wid);
        $this->onmarket = $database->getMarket($village->wid,0);

        $baseCarry = ($session->tribe == 1)
            ? 500
            : (($session->tribe == 2) ? 1000 : 750);

        $this->maxcarry = $baseCarry * TRADER_CAPACITY;

        $lvl28 = $building->getTypeLevel(28);
        if($lvl28 > 0) {
            $this->maxcarry *= $bid28[$lvl28]['attri'] / 100;
        }
    }

    /* =========================================================
       SEND RESOURCE (FULL HARDENED)
    ========================================================== */

    private function sendResource($post)
    {
        global $database, $village, $session, $generator, $logging, $form;

        if(!is_array($post)) return;

        $r1 = isset($post['r1']) ? max(0,$this->int($post['r1'])) : 0;
        $r2 = isset($post['r2']) ? max(0,$this->int($post['r2'])) : 0;
        $r3 = isset($post['r3']) ? max(0,$this->int($post['r3'])) : 0;
        $r4 = isset($post['r4']) ? max(0,$this->int($post['r4'])) : 0;

        $getwref = isset($post['getwref']) ? $this->int($post['getwref']) : 0;
        $repeat  = isset($post['send3']) ? $this->int($post['send3']) : 1;
        $buildId = isset($post['id']) ? $this->int($post['id']) : 0;

        if($getwref <= 0) {
            $form->addError("error", NO_COORDINATES_SELECTED);
            return;
        }

        if(!$database->checkVilExist($getwref)) {
            $form->addError("error", NO_COORDINATES_SELECTED);
            return;
        }

        if($getwref == $village->wid) {
            $form->addError("error", CANNOT_SEND_RESOURCES);
            return;
        }

        if($repeat < 1 || $repeat > 3 || ($repeat > 1 && !$session->goldclub)) {
            $form->addError("error", INVALID_MERCHANTS_REPETITION);
            return;
        }

        $database->getVillage($village->wid);

        $availableWood = (int)$database->getWoodAvailable($village->wid);
        $availableClay = (int)$database->getClayAvailable($village->wid);
        $availableIron = (int)$database->getIronAvailable($village->wid);
        $availableCrop = (int)$database->getCropAvailable($village->wid);

        if(
            $availableWood < $r1 ||
            $availableClay < $r2 ||
            $availableIron < $r3 ||
            $availableCrop < $r4
        ) {
            $form->addError("error", TOO_FEW_RESOURCES);
            return;
        }

        $total = $r1 + $r2 + $r3 + $r4;
        if($total <= 0) return;

        $reqMerc = ceil(($total - 0.1) / $this->maxcarry);

        if($this->merchantAvail() <= 0 || $reqMerc > $this->merchantAvail()) {
            $form->addError("error", TOO_FEW_MERCHANTS);
            return;
        }

        if(!$database->getVillageState($getwref)) {
            return;
        }

        $coor = $database->getCoor($getwref);
        $timetaken = $generator->procDistanceTime(
            $coor,
            $village->coor,
            $session->tribe,
            0
        );

        $reference = $database->sendResource(
            $r1,$r2,$r3,$r4,$reqMerc,0
        );

        $database->modifyResource(
            $village->wid,
            $r1,$r2,$r3,$r4,
            0
        );

        $database->addMovement(
            0,
            $village->wid,
            $getwref,
            $reference,
            time(),
            time() + $timetaken,
            $repeat
        );

        $logging->addMarketLog(
            $village->wid,
            1,
            array($r1,$r2,$r3,$r4,$getwref)
        );

        $this->safeRedirect("build.php?id=".$buildId);
    }

    /* =========================================================
       ADD OFFER (ANTI EXPLOIT HARDENED)
    ========================================================== */

    private function addOffer($post)
    {
        global $database,$village,$session;

        if(!is_array($post)) return;

        $rid1 = isset($post['rid1']) ? $this->int($post['rid1']) : 0;
        $rid2 = isset($post['rid2']) ? $this->int($post['rid2']) : 0;
        $m1   = isset($post['m1']) ? max(0,$this->int($post['m1'])) : 0;
        $m2   = isset($post['m2']) ? max(0,$this->int($post['m2'])) : 0;
        $buildId = isset($post['id']) ? $this->int($post['id']) : 0;

        if($rid1 < 1 || $rid1 > 4 || $rid2 < 1 || $rid2 > 4) {
            $this->safeRedirect("build.php?id=".$buildId."&t=2&e2");
        }

        if($rid1 === $rid2 || $m1 <= 0 || $m2 <= 0) {
            $this->safeRedirect("build.php?id=".$buildId."&t=2&e2");
        }

        if($m1 > (2 * $m2) || $m2 > (2 * $m1)) {
            $this->safeRedirect("build.php?id=".$buildId."&t=2&e2");
        }

        $wood = ($rid1 === 1) ? $m1 : 0;
        $clay = ($rid1 === 2) ? $m1 : 0;
        $iron = ($rid1 === 3) ? $m1 : 0;
        $crop = ($rid1 === 4) ? $m1 : 0;

        $database->getVillage($village->wid);

        if(
            $database->getWoodAvailable($village->wid) < $wood ||
            $database->getClayAvailable($village->wid) < $clay ||
            $database->getIronAvailable($village->wid) < $iron ||
            $database->getCropAvailable($village->wid) < $crop
        ) {
            $this->safeRedirect("build.php?id=".$buildId."&t=2&e1");
        }

        $total = $wood + $clay + $iron + $crop;
        $reqMerc = ceil(($total - 0.1) / $this->maxcarry);

        if($this->merchantAvail() <= 0 || $reqMerc > $this->merchantAvail()) {
            $this->safeRedirect("build.php?id=".$buildId."&t=2&e3");
        }

        if($database->modifyResource($village->wid,$wood,$clay,$iron,$crop,0)) {

            $time = 0;
            if(isset($post['d2'])) {
                $time = $this->int($post['d2']) * 3600;
            }

            $alliance = (isset($post['ally']) && $this->int($post['ally']) === 1)
                ? $session->userinfo['alliance']
                : 0;

            $database->addMarket(
                $village->wid,
                $rid1,$m1,
                $rid2,$m2,
                $time,
                $alliance,
                $reqMerc,
                0
            );
        }

        $this->safeRedirect("build.php?id=".$buildId."&t=2");
    }

    /* =========================================================
       ACCEPT OFFER (ANTI DUPLICATE / FULL HARDENED)
    ========================================================== */

    private function acceptOffer($get)
    {
        global $database,$village,$session,$logging,$generator;

        if(!is_array($get) || !isset($get['g'])) return;

        $g = $this->int($get['g']);
        $buildId = isset($get['id']) ? $this->int($get['id']) : 0;

        $infoarray = $database->getMarketInfo($g);
        if(empty($infoarray)) {
            $this->safeRedirect("build.php?id=".$buildId."&t=1");
        }

        $reqMerc = ceil(($infoarray['wamt'] - 0.1) / $this->maxcarry);

        $myResources = array(
            1 => $village->awood,
            2 => $village->aclay,
            3 => $village->airon,
            4 => $village->acrop
        );

        if($infoarray['wamt'] > $myResources[$infoarray['wtype']]) {
            $this->safeRedirect("build.php?id=".$buildId."&t=1&e1");
        }

        if(
            $infoarray['vref'] == $village->wid ||
            ($infoarray['alliance'] > 0 && $infoarray['alliance'] != $session->alliance)
        ) {
            $this->safeRedirect("build.php?id=".$buildId."&t=1&e2");
        }

        if($reqMerc > $this->merchantAvail()) {
            $this->safeRedirect("build.php?id=".$buildId."&t=1&e3");
        }

        /* ===========================
           EXECUTE TRADE ATOMICALLY
        ============================ */

        $mySend = array(1=>0,0,0,0);
        $mySend[$infoarray['wtype']] = $infoarray['wamt'];

        $hisSend = array(1=>0,0,0,0);
        $hisSend[$infoarray['gtype']] = $infoarray['gamt'];

        $mysendid = $database->sendResource(
            $mySend[1],$mySend[2],$mySend[3],$mySend[4],
            $reqMerc,0
        );

        $hissendid = $database->sendResource(
            $hisSend[1],$hisSend[2],$hisSend[3],$hisSend[4],
            $infoarray['merchant'],0
        );

        $hiscoor = $database->getCoor($infoarray['vref']);

        $mytime = $generator->procDistanceTime(
            $hiscoor,$village->coor,$session->tribe,0
        );

        $targettribe = $database->getUserField(
            $database->getVillageField($infoarray['vref'],"owner"),
            "tribe",
            0
        );

        $histime = $generator->procDistanceTime(
            $village->coor,$hiscoor,$targettribe,0
        );

        $timestamp = time();

        $database->addMovement(
            array(0,0),
            array($village->wid,$infoarray['vref']),
            array($infoarray['vref'],$village->wid),
            array($mysendid,$hissendid),
            array($timestamp,$timestamp),
            array($mytime+$timestamp,$histime+$timestamp)
        );

        $database->modifyResource(
            $village->wid,
            $mySend[1],$mySend[2],$mySend[3],$mySend[4],
            0
        );

        $database->setMarketAcc($g);
        $database->removeAcceptedOffer($g);

        $logging->addMarketLog(
            $village->wid,
            2,
            array($infoarray['vref'],$g)
        );

        $this->safeRedirect("build.php?id=".$buildId);
    }

    /* =========================================================
       LOAD ONSALE (SAFE FILTERED)
    ========================================================== */

    private function loadOnsale()
    {
        global $database,$village,$session,$multisort,$generator;

        $displayarray = $database->getMarket($village->wid,1);
        $holderarray = array();

        foreach($displayarray as $value) {

            $targetcoor = $database->getCoor($value['vref']);

            $duration = $generator->procDistanceTime(
                $targetcoor,
                $village->coor,
                $session->tribe,
                0
            );

            if($duration <= ($value['maxtime'] * 3600) || $value['maxtime'] == 0) {
                $value['duration'] = $duration;
                $holderarray[] = $value;
            }
        }

        $this->onsale = $multisort->sorte($holderarray, "duration", true, 2);
    }

    /* =========================================================
       FILTER NEED (SAFE)
    ========================================================== */

    private function filterNeed($get)
    {
        if(empty($this->onsale)) return;

        $v = isset($get['v']) ? $this->str($get['v']) : null;
        $s = isset($get['s']) ? $this->int($get['s']) : null;
        $b = isset($get['b']) ? $this->int($get['b']) : null;

        $holder = array();

        foreach($this->onsale as $sale) {

            if($v === "1:1" && $sale['wamt'] > $sale['gamt']) continue;
            if($s && $sale['gtype'] != $s) continue;
            if($b && $sale['wtype'] != $b) continue;

            $holder[] = $sale;
        }

        $this->onsale = $holder;
    }

    /* =========================================================
       GOLD TRADE (HARDENED)
    ========================================================== */

    private function tradeResource($post)
    {
        global $session,$database,$village;

        if(!is_array($post) || !isset($post['m2']) || !is_array($post['m2'])) return;

        $buildId = isset($post['id']) ? $this->int($post['id']) : 0;

        if($session->userinfo['gold'] < 3) {
            $this->safeRedirect("build.php?id=".$buildId."&t=3");
        }

        $m2 = array(
            isset($post['m2'][0]) ? $this->int($post['m2'][0]) : 0,
            isset($post['m2'][1]) ? $this->int($post['m2'][1]) : 0,
            isset($post['m2'][2]) ? $this->int($post['m2'][2]) : 0,
            isset($post['m2'][3]) ? $this->int($post['m2'][3]) : 0
        );

        $database->setVillageField(
            $village->wid,
            array("wood","clay","iron","crop"),
            $m2
        );

        $database->modifyGold($session->uid, 3, 0);

        $this->safeRedirect("build.php?id=".$buildId."&t=3&c");
    }
};

$market = new Market;
?>

