<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       : Market.php                      	                       ##
##  Type           : Market System Backend                                     ##
## --------------------------------------------------------------------------- ##
##  Developed by   : Dzoki           			                               ##
##  Refactored by  : Shadow & Ferywir									       ##
##  Thanks to      : ronix, InCube, Akakori, Elmar & Kirilloid                 ##
## --------------------------------------------------------------------------- ##
##  Contact        : cata7007@gmail.com                                        ##
##  Project        : TravianZ                                                  ##
##  URLs:          : https://travianz.org                                      ##
##  GitHub         : https://github.com/Shadowss/TravianZ                      ##
## --------------------------------------------------------------------------- ##
##  License        : TravianZ Project                                          ##
##  Copyright      : TravianZ (c) 2010-2026. All rights reserved.              ##
## --------------------------------------------------------------------------- ##
#################################################################################

class Market
{
    public $onsale = [];
    public $onmarket = [];
    public $sending = [];
    public $recieving = [];
    public $return = [];

    public $maxcarry;
    public $merchant;
    public $used;
	
	/**
	* Internal request cache.
	* Safe legacy-compatible cache layer.
	*/
	
	private $cache = [];

    /**
     * Main market processor.
     */
    public function procMarket($post)
    {
        $this->loadMarket();

        if (isset($_SESSION['loadMarket'])) {
            $this->loadOnsale();
            unset($_SESSION['loadMarket']);
        }

        if (!isset($post['ft'])) {
            return;
        }

        switch ($post['ft']) {
            case 'mk1':
                $this->sendResource($post);
                break;

            case 'mk2':
                $this->addOffer($post);
                break;

            case 'mk3':
                $this->tradeResource($post);
                break;
        }
    }

    /**
     * Remove / accept market actions.
     */
    public function procRemove($get)
    {
        global $database, $village, $session;

        if (isset($get['t']) && $get['t'] == 1) {
            $this->filterNeed($get);
        } elseif (
            isset($get['t'], $get['a'], $get['del']) &&
            $get['t'] == 2 &&
            $get['a'] == 5
        ) {
            // Get all fields from market
            $type = $database->getMarketField($village->wid, $get['del'], 'gtype');
            $amt  = $database->getMarketField($village->wid, $get['del'], 'gamt');

            $database->getResourcesBack($village->wid, $type, $amt);
            $database->addMarket($village->wid, $get['del'], 0, 0, 0, 0, 0, 0, 1);

            header('Location: build.php?id=' . $get['id'] . '&t=2');
            exit;
        }

        if (
            isset($get['t'], $get['a']) &&
            $get['t'] == 1 &&
            $get['a'] == $session->mchecker &&
            !isset($get['del'])
        ) {
            $session->changeChecker();
            $this->acceptOffer($get);
        }
    }

    /**
     * Available merchants.
     */
    public function merchantAvail()
    {
        return $this->merchant - $this->used;
    }
	
	/**
	* Remember cached value for current request.
	*/
	private function remember($key, callable $callback)
	{
    if (isset($this->cache[$key])) {
        return $this->cache[$key];
    }

    $this->cache[$key] = $callback();

    return $this->cache[$key];
	}

	/**
	* Forget cache entry or entire cache.
	*/
	private function forget($key = null)
	{
    if ($key === null) {
        $this->cache = [];
        return;
    }

    unset($this->cache[$key]);
	}

    /**
     * Load market data.
     */
    private function loadMarket()
    {
        global $session, $building, $bid28, $bid17, $database, $village;

        $this->recieving = $database->getMovement(0, $village->wid, 1);
        $this->sending   = $database->getMovement(0, $village->wid, 0);
        $this->return    = $database->getMovement(2, $village->wid, 1);

        $this->merchant = ($building->getTypeLevel(17) > 0)
            ? $bid17[$building->getTypeLevel(17)]['attri']
            : 0;

        $this->used = $this->remember(
		'merchant_used_' . $village->wid,
		function () use ($database, $village) {
        return $database->totalMerchantUsed($village->wid);
		}
		);

        $this->onmarket = $this->remember(
		'market_' . $village->wid,
		function () use ($database, $village) {
        return $database->getMarket($village->wid, 0);
		}
		);

        // Merchant carry capacity
        $this->maxcarry = ($session->tribe == 1)
            ? 500
            : (($session->tribe == 2) ? 1000 : 750);

        $this->maxcarry *= TRADER_CAPACITY;

        // Trade office bonus
        if ($building->getTypeLevel(28) != 0) {
            $this->maxcarry *= $bid28[$building->getTypeLevel(28)]['attri'] / 100;
        }
    }

    /**
     * Send resources.
     */
    private function sendResource($post)
    {
        global $database, $village, $session, $generator, $logging, $form;

        $wtrans  = (isset($post['r1']) && !empty($post['r1'])) ? $post['r1'] : 0;
        $ctrans  = (isset($post['r2']) && !empty($post['r2'])) ? $post['r2'] : 0;
        $itrans  = (isset($post['r3']) && !empty($post['r3'])) ? $post['r3'] : 0;
        $crtrans = (isset($post['r4']) && !empty($post['r4'])) ? $post['r4'] : 0;

        // Prevent negative values
        $wtrans  = str_replace('-', '', $wtrans);
        $ctrans  = str_replace('-', '', $ctrans);
        $itrans  = str_replace('-', '', $itrans);
        $crtrans = str_replace('-', '', $crtrans);

        // Preload village data
        $database->getVillage($village->wid);

        $resourcesAvailable = $this->remember(
		'resources_' . $village->wid,
		function () use ($database, $village) {
        return [
            'wood' => $database->getWoodAvailable($village->wid),
            'clay' => $database->getClayAvailable($village->wid),
            'iron' => $database->getIronAvailable($village->wid),
            'crop' => $database->getCropAvailable($village->wid),
        ];
    }
	);

		$availableWood = $resourcesAvailable['wood'];
		$availableClay = $resourcesAvailable['clay'];
		$availableIron = $resourcesAvailable['iron'];
		$availableCrop = $resourcesAvailable['crop'];

        // Resource array
        $resource = [
            $wtrans,
            $ctrans,
            $itrans,
            $crtrans
        ];

        // NOTE:
        // Original code referenced $id before definition.
        // Keeping logic safe while preserving compatibility.
        $id = isset($post['getwref']) ? (int)$post['getwref'] : 0;

        // Check vacation mode
        if ($database->getvacmodexy($id)) {
            $form->addError('error', USER_ON_VACATION);
        }

        if (!$database->checkVilExist($post['getwref'])) {
            $form->addError('error', NO_COORDINATES_SELECTED);
        } elseif ($post['getwref'] == $village->wid) {
            $form->addError('error', CANNOT_SEND_RESOURCES);
        } elseif (
            $post['send3'] < 1 ||
            $post['send3'] > 3 ||
            ($post['send3'] > 1 && !$session->goldclub)
        ) {
            $form->addError('error', INVALID_MERCHANTS_REPETITION);
        } elseif (
            $availableWood >= $post['r1'] &&
            $availableClay >= $post['r2'] &&
            $availableIron >= $post['r3'] &&
            $availableCrop >= $post['r4']
        ) {
            $reqMerc = ceil((array_sum($resource) - 0.1) / $this->maxcarry);

            // Acquire merchant lock to prevent race conditions
            $database->getMerchantLock($village->wid);

            $this->forget('merchant_used_' . $village->wid);

			$this->used = $this->remember(
			'merchant_used_' . $village->wid,
			function () use ($database, $village) {
			return $database->totalMerchantUsed($village->wid, false);
			}
			);

            if ($this->merchantAvail() > 0 && $reqMerc <= $this->merchantAvail()) {

                $coor = $database->getCoor($id);

                if ($database->getVillageState($id)) {

                    $timetaken = $generator->procDistanceTime(
                        $coor,
                        $village->coor,
                        $session->tribe,
                        0
                    );

                    $res = array_sum($resource);

                    if ($res != 0) {

                        $reference = $database->sendResource(
                            $resource[0],
                            $resource[1],
                            $resource[2],
                            $resource[3],
                            $reqMerc,
                            0
                        );

                        $database->modifyResource(
                            $village->wid,
                            $resource[0],
                            $resource[1],
                            $resource[2],
                            $resource[3],
                            0
                        );

                        $database->addMovement(
                            0,
                            $village->wid,
                            $id,
                            $reference,
                            time(),
                            time() + $timetaken,
                            $post['send3']
                        );
						$this->forget();
                        $logging->addMarketLog(
                            $village->wid,
                            1,
                            [
                                $resource[0],
                                $resource[1],
                                $resource[2],
                                $resource[3],
                                $id
                            ]
                        );
                    }
                }

                $database->releaseMerchantLock($village->wid);

                header('Location: build.php?id=' . $post['id']);
                exit;
            } else {

                $database->releaseMerchantLock($village->wid);

                $form->addError('error', TOO_FEW_MERCHANTS);
            }
        } else {

            $form->addError('error', TOO_FEW_RESOURCES);
        }
    }

    /**
     * Add market offer.
     */
    private function addOffer($post)
    {
        global $database, $village, $session;

        // Invalid: same resource type
        if ($post['rid1'] == $post['rid2']) {

            header('Location: build.php?id=' . $post['id'] . '&t=2&e2');
            exit;
        }

        // Invalid values
        if (
            !isset($post['m1'], $post['m2']) ||
            $post['m1'] <= 0 ||
            $post['m2'] <= 0
        ) {

            header('Location: build.php?id=' . $post['id'] . '&t=2&e2');
            exit;
        }

        // Max 2:1 trade ratio
        if ($post['m1'] > (2 * $post['m2'])) {

            header('Location: build.php?id=' . $post['id'] . '&t=2&e2');
            exit;
        }

        // Min 1:2 trade ratio
        if ($post['m2'] > (2 * $post['m1'])) {

            header('Location: build.php?id=' . $post['id'] . '&t=2&e2');
            exit;
        }

        // Invalid resource ids
        if (
            $post['rid1'] < 1 ||
            $post['rid1'] > 4 ||
            $post['rid2'] < 1 ||
            $post['rid2'] > 4
        ) {

            header('Location: build.php?id=' . $post['id'] . '&t=2&e2');
            exit;
        }

        // Offered resources
        $wood = ($post['rid1'] == 1) ? $post['m1'] : 0;
        $clay = ($post['rid1'] == 2) ? $post['m1'] : 0;
        $iron = ($post['rid1'] == 3) ? $post['m1'] : 0;
        $crop = ($post['rid1'] == 4) ? $post['m1'] : 0;

        // Preload village data
        $database->getVillage($village->wid);

		$resourcesAvailable = $this->remember(
		'resources_' . $village->wid,
		function () use ($database, $village) {
        return [
            'wood' => $database->getWoodAvailable($village->wid),
            'clay' => $database->getClayAvailable($village->wid),
            'iron' => $database->getIronAvailable($village->wid),
            'crop' => $database->getCropAvailable($village->wid),
        ];
		}
		);

		$availableWood = $resourcesAvailable['wood'];
		$availableClay = $resourcesAvailable['clay'];
		$availableIron = $resourcesAvailable['iron'];
		$availableCrop = $resourcesAvailable['crop'];

        if (
            $availableWood >= $wood &&
            $availableClay >= $clay &&
            $availableIron >= $iron &&
            $availableCrop >= $crop
        ) {

            $totalRes = $wood + $clay + $iron + $crop;

            $reqMerc = 1;

            if ($totalRes > $this->maxcarry) {

                $reqMerc = round($totalRes / $this->maxcarry);

                if ($totalRes > ($this->maxcarry * $reqMerc)) {
                    $reqMerc += 1;
                }
            }

            // Acquire merchant lock
            $database->getMerchantLock($village->wid);

            $this->forget('merchant_used_' . $village->wid);

			$this->used = $this->remember(
			'merchant_used_' . $village->wid,
			function () use ($database, $village) {
			return $database->totalMerchantUsed($village->wid, false);
			}
		);

            if ($this->merchantAvail() > 0 && $reqMerc <= $this->merchantAvail()) {

                if (
                    $database->modifyResource(
                        $village->wid,
                        $wood,
                        $clay,
                        $iron,
                        $crop,
                        0
                    )
                ) {

                    $time = 0;

                    if (isset($_POST['d1'])) {
                        $time = $_POST['d2'] * 3600;
                    }

                    $alliance = (
                        isset($post['ally']) &&
                        $post['ally'] == 1
                    )
                        ? $session->userinfo['alliance']
                        : 0;

                    $database->addMarket(
                        $village->wid,
                        $post['rid1'],
                        $post['m1'],
                        $post['rid2'],
                        $post['m2'],
                        $time,
                        $alliance,
                        $reqMerc,
                        0
                    );
                }
				$this->forget();
                $database->releaseMerchantLock($village->wid);

                header('Location: build.php?id=' . $post['id'] . '&t=2');
                exit;
            }

            // Not enough merchants
            $database->releaseMerchantLock($village->wid);

            header('Location: build.php?id=' . $post['id'] . '&t=2&e3');
            exit;
        }

        // Not enough resources
        header('Location: build.php?id=' . $post['id'] . '&t=2&e1');
        exit;
    }

    /**
     * Accept market offer.
     */
    private function acceptOffer($get)
    {
        global $database, $village, $session, $logging, $generator;

        $infoarray = $database->getMarketInfo($get['g']);

        $reqMerc = 1;

        if ($infoarray['wamt'] > $this->maxcarry) {

            $reqMerc = round($infoarray['wamt'] / $this->maxcarry);

            if ($infoarray['wamt'] > ($this->maxcarry * $reqMerc)) {
                $reqMerc += 1;
            }
        }

        $villageResources = [
            $village->awood,
            $village->aclay,
            $village->airon,
            $village->acrop
        ];

        // Not enough resources
        if (
            $infoarray['wamt'] >
            $villageResources[$infoarray['wtype'] - 1]
        ) {

            header('Location: build.php?id=' . $get['id'] . '&t=1&e1');
            exit;
        }

        // Invalid offer
        if (
            ($infoarray['vref'] == $village->wid) ||
            (
                $infoarray['alliance'] > 0 &&
                $infoarray['alliance'] != $session->alliance
            ) ||
            (
                $infoarray['maxtime'] > 0 &&
                ($infoarray['maxtime'] * 3600) <
                $generator->procDistanceTime(
                    $database->getCoor($infoarray['vref']),
                    $village->coor,
                    $session->tribe,
                    0
                )
            )
        ) {

            header('Location: build.php?id=' . $get['id'] . '&t=1&e2');
            exit;
        }

        // Not enough merchants
        if ($reqMerc > $this->merchantAvail()) {

            header('Location: build.php?id=' . $get['id'] . '&t=1&e3');
            exit;
        }

        // Acquire merchant lock
        $database->getMerchantLock($village->wid);

        $this->forget('merchant_used_' . $village->wid);

		$this->used = $this->remember(
		'merchant_used_' . $village->wid,
		function () use ($database, $village) {
        return $database->totalMerchantUsed($village->wid, false);
		}
		);

        // Double-check after lock
        if ($reqMerc > $this->merchantAvail()) {
			$this->forget();
            $database->releaseMerchantLock($village->wid);

            header('Location: build.php?id=' . $get['id'] . '&t=1&e3');
            exit;
        }

        // Prepare resources
        $myresource = [1 => 0, 0, 0, 0];
        $hisresource = [1 => 0, 0, 0, 0];

        $myresource[$infoarray['wtype']] = $infoarray['wamt'];

        $mysendid = $database->sendResource(
            $myresource[1],
            $myresource[2],
            $myresource[3],
            $myresource[4],
            $reqMerc,
            0
        );

        $hisresource[$infoarray['gtype']] = $infoarray['gamt'];

        $hissendid = $database->sendResource(
            $hisresource[1],
            $hisresource[2],
            $hisresource[3],
            $hisresource[4],
            $infoarray['merchant'],
            0
        );

        $hiscoor = $database->getCoor($infoarray['vref']);

        $mytime = $generator->procDistanceTime(
            $hiscoor,
            $village->coor,
            $session->tribe,
            0
        );

        $targettribe = $database->getUserField(
            $database->getVillageField($infoarray['vref'], 'owner'),
            'tribe',
            0
        );

        $histime = $generator->procDistanceTime(
            $village->coor,
            $hiscoor,
            $targettribe,
            0
        );

        $timestamp = time();

        $database->addMovement(
            [0, 0],
            [$village->wid, $infoarray['vref']],
            [$infoarray['vref'], $village->wid],
            [$mysendid, $hissendid],
            [$timestamp, $timestamp],
            [$mytime + $timestamp, $histime + $timestamp]
        );

        $resource = [1 => 0, 0, 0, 0];
        $resource[$infoarray['wtype']] = $infoarray['wamt'];

        $database->modifyResource(
            $village->wid,
            $resource[1],
            $resource[2],
            $resource[3],
            $resource[4],
            0
        );

        $database->setMarketAcc($get['g']);
        $database->removeAcceptedOffer($get['g']);

        $logging->addMarketLog(
            $village->wid,
            2,
            [$infoarray['vref'], $get['g']]
        );

        $database->releaseMerchantLock($village->wid);

        header('Location: build.php?id=' . $get['id']);
        exit;
    }

    /**
     * Load onsale offers.
     */
    private function loadOnsale()
    {
        global $database, $village, $session, $multisort, $generator;

        $displayarray = $database->getMarket($village->wid, 1);

        $holderarray = [];

        foreach ($displayarray as $value) {

            $targetcoor = $database->getCoor($value['vref']);

            $duration = $generator->procDistanceTime(
                $targetcoor,
                $village->coor,
                $session->tribe,
                0
            );

            if (
                $duration <= ($value['maxtime'] * 3600) ||
                $value['maxtime'] == 0
            ) {

                $value['duration'] = $duration;

                $holderarray[] = $value;
            }
        }

        $this->onsale = $multisort->sorte(
            $holderarray,
            'duration',
            true,
            2
        );
    }

    /**
     * Filter market offers.
     */
    private function filterNeed($get)
    {
        if (
            !isset($get['v']) &&
            !isset($get['s']) &&
            !isset($get['b'])
        ) {

            $this->loadOnsale();
            return;
        }

        $holder  = [];
        $holder2 = [];

        // 1:1 trades
        if (isset($get['v']) && $get['v'] == '1:1') {

            foreach ($this->onsale as $equal) {

                if ($equal['wamt'] <= $equal['gamt']) {
                    $holder[] = $equal;
                }
            }
        } else {

            $holder = $this->onsale;
        }

        foreach ($holder as $sale) {

            if (isset($get['s']) && isset($get['b'])) {

                if (
                    $sale['gtype'] == $get['s'] &&
                    $sale['wtype'] == $get['b']
                ) {
                    $holder2[] = $sale;
                }
            } elseif (isset($get['s']) && !isset($get['b'])) {

                if ($sale['gtype'] == $get['s']) {
                    $holder2[] = $sale;
                }
            } elseif (isset($get['b']) && !isset($get['s'])) {

                if ($sale['wtype'] == $get['b']) {
                    $holder2[] = $sale;
                }
            } else {

                $holder2 = $holder;
            }
        }

        $this->onsale = $holder2;
    }

    /**
     * NPC merchant trade.
     */
    private function tradeResource($post)
    {
        global $session, $database, $village;

        $wwvillage = $database->getResourceLevel($village->wid);

        // Prevent WW villages
        if ($wwvillage['f99t'] == 40) {
            return;
        }

        // Not enough gold
        if ($session->userinfo['gold'] < 3) {

            header('Location: build.php?id=' . $post['id'] . '&t=3');
            exit;
        }

        // Sanitize the requested distribution: never negative, never above the
        // warehouse / granary capacity. Guards against a forged or NaN-corrupted
        // POST (issue #211: NPC distribution).
        $maxstore = (int) $village->maxstore;
        $maxcrop  = (int) $village->maxcrop;

        $m2 = [
            max(0, min($maxstore, (int)($post['m2'][0] ?? 0))),
            max(0, min($maxstore, (int)($post['m2'][1] ?? 0))),
            max(0, min($maxstore, (int)($post['m2'][2] ?? 0))),
            max(0, min($maxcrop,  (int)($post['m2'][3] ?? 0))),
        ];

        $newTotal = $m2[0] + $m2[1] + $m2[2] + $m2[3];

        $currentTotal =
            round($village->awood) +
            round($village->aclay) +
            round($village->airon) +
            round($village->acrop);

        // Too many resources requested
        if ($newTotal > $currentTotal) {

            header('Location: build.php?id=' . $post['id'] . '&t=3');
            exit;
        }

        $database->setVillageField(
            $village->wid,
            ['wood', 'clay', 'iron', 'crop'],
            [
                $m2[0],
                $m2[1],
                $m2[2],
                $m2[3]
            ]
        );
		$this->forget();
        $database->modifyGold($session->uid, 3, 0);

        header('Location: build.php?id=' . $post['id'] . '&t=3&c');
        exit;
    }
}

$market = new Market;
?>