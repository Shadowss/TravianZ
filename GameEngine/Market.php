<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       Market.php                                                  ##
##  Developed by:  Dzoki                                                       ##
##  Some fixes:    aggenkeech                                                  ##
##  License:       TravianX Project                                            ##
##  Copyright:     TravianX (c) 2010-2011. All rights reserved.                ##
##                                                                             ##
#################################################################################

class Market
{
    public $onsale, $onmarket, $sending, $recieving, $return = [];
	public $maxcarry, $merchant, $used;

    public function procMarket($post)
    {
        $this->loadMarket();
        if(isset($_SESSION['loadMarket']))
        {
            $this->loadOnsale();
            unset($_SESSION['loadMarket']);
        }
        if(isset($post['ft']))
        {
            switch($post['ft'])
            {
                case "mk1": $this->sendResource($post); break;
                case "mk2": $this->addOffer($post); break;
                case "mk3": $this->tradeResource($post); break;
            }
        }
    }

    public function procRemove($get)
    {
        global $database, $village, $session;

        if(isset($get['t']) && $get['t'] == 1)
        {
            $this->filterNeed($get);
        }
        else if(isset($get['t']) && $get['t'] == 2 && isset($get['a']) && $get['a'] == 5 && isset($get['del']))
        {
            //GET ALL FIELDS FROM MARKET
            $type = $database->getMarketField($village->wid, $get['del'], "gtype");
            $amt = $database->getMarketField($village->wid, $get['del'], "gamt");
            $database->getResourcesBack($village->wid, $type, $amt);
            $database->addMarket($village->wid, $get['del'], 0, 0, 0, 0, 0, 0, 1);
            header("Location: build.php?id=".$get['id']."&t=2");
            exit;
        }
        if(isset($get['t']) && $get['t'] == 1 && isset($get['a']) && $get['a'] == $session->mchecker && !isset($get['del']))
        {
            $session->changeChecker();
            $this->acceptOffer($get);      
        }
    }

    public function merchantAvail()
    {
        return $this->merchant - $this->used;
    }

    private function loadMarket()
    {
        global $session,$building,$bid28,$bid17,$database,$village;

        $this->recieving = $database->getMovement(0,$village->wid,1);
        $this->sending = $database->getMovement(0,$village->wid,0);
        $this->return  = $database->getMovement(2,$village->wid,1);
        $this->merchant = ($building->getTypeLevel(17) > 0)? $bid17[$building->getTypeLevel(17)]['attri'] : 0;
        $this->used = $database->totalMerchantUsed($village->wid);
        $this->onmarket = $database->getMarket($village->wid,0);
        $this->maxcarry = ($session->tribe == 1)? 500 : (($session->tribe == 2)? 1000 : 750);
        $this->maxcarry *= TRADER_CAPACITY;
        if($building->getTypeLevel(28) != 0)
        {
            $this->maxcarry *= $bid28[$building->getTypeLevel(28)]['attri'] / 100;
        }
    }

    private function sendResource($post)
    {
        global $database, $village, $session, $generator, $logging, $form;

        $wtrans = (isset($post['r1']) && !empty($post['r1']))? $post['r1'] : 0;
        $ctrans = (isset($post['r2']) && !empty($post['r2']))? $post['r2'] : 0;
        $itrans = (isset($post['r3']) && !empty($post['r3']))? $post['r3'] : 0;
        $crtrans = (isset($post['r4']) && !empty($post['r4']))? $post['r4'] : 0;
        $wtrans = str_replace("-", "", $wtrans);
        $ctrans = str_replace("-", "", $ctrans);
        $itrans = str_replace("-", "", $itrans);
        $crtrans = str_replace("-", "", $crtrans);
        
        // preload all village data, since we're retrieving some of those separately below
        $database->getVillage($village->wid);

        $availableWood = $database->getWoodAvailable($village->wid);
        $availableClay = $database->getClayAvailable($village->wid);
        $availableIron = $database->getIronAvailable($village->wid);
        $availableCrop = $database->getCropAvailable($village->wid);
        
		//check if on vacation:
        if($database->getvacmodexy($id)) $form->addError("error", USER_ON_VACATION);

        if(!$database->checkVilExist($post['getwref'])) $form->addError("error", NO_COORDINATES_SELECTED);
        elseif($post['getwref'] == $village->wid) $form->addError("error", CANNOT_SEND_RESOURCES);
        elseif($post['send3'] < 1 || $post['send3'] > 3 || ($post['send3'] > 1 && !$session->goldclub)) $form->addError("error", INVALID_MERCHANTS_REPETITION);
        elseif($availableWood >= $post['r1'] && $availableClay >= $post['r2'] && $availableIron >= $post['r3'] && $availableCrop >= $post['r4'])
        {
            $resource = [$wtrans, $ctrans, $itrans, $crtrans];
			$reqMerc = ceil((array_sum($resource) - 0.1) / $this->maxcarry);

            if($this->merchantAvail() > 0 && $reqMerc <= $this->merchantAvail())
            {
                $id = $post['getwref'];
                $coor = $database->getCoor($id);
                if($database->getVillageState($id))
                {
                    $timetaken = $generator->procDistanceTime($coor, $village->coor, $session->tribe, 0);
					$res = $resource[0] + $resource[1] + $resource[2] + $resource[3];
					if($res != 0){
						$reference = $database->sendResource($resource[0], $resource[1], $resource[2], $resource[3], $reqMerc, 0);
						$database->modifyResource($village->wid, $resource[0], $resource[1], $resource[2], $resource[3], 0);
						$database->addMovement(0, $village->wid, $id, $reference, time(), time() + $timetaken, $post['send3']);
						$logging->addMarketLog($village->wid, 1, [$resource[0], $resource[1], $resource[2], $resource[3], $id]);
					}
                }
                header("Location: build.php?id=".$post['id']);
                exit;
            }
            else $form->addError("error", TOO_FEW_MERCHANTS);
        }
        else $form->addError("error", TOO_FEW_RESOURCES);
    }

    private function addOffer($post)
    {
        global $database,$village,$session;


        if($post['rid1'] == $post['rid2'])
        {
            // Trading res for res of same type (invalid)
            header("Location: build.php?id=".$post['id']."&t=2&e2");
            exit;
        }
        elseif(!isset($post['m1']) || !isset($post['m2']) || $post['m1'] <= 0 || $post['m2'] <= 0)
        {
            // No resources selected (invalid)
            header("Location: build.php?id=".$post['id']."&t=2&e2");
            exit;
        }
        elseif($post['m1'] > (2 * $post['m2']))
        {
            // Trade is for more than 2x (invalid)
            header("Location: build.php?id=".$post['id']."&t=2&e2");
            exit;
        }
        elseif($post['m2'] > (2 * $post['m1']))
        {
            // Trade is for less than 0.5x (invalid)
            header("Location: build.php?id=".$post['id']."&t=2&e2");
            exit;
        }
        elseif($post['rid1'] < 1 || $post['rid1'] > 4 || $post['rid2'] < 1 || $post['rid2'] > 4)
        {
            // Inexistent resources type (invalid)
            header("Location: build.php?id=".$post['id']."&t=2&e2");
            exit;
        }
        else
        {
            $wood = ($post['rid1'] == 1)? $post['m1'] : 0;
            $clay = ($post['rid1'] == 2)? $post['m1'] : 0;
            $iron = ($post['rid1'] == 3)? $post['m1'] : 0;
            $crop = ($post['rid1'] == 4)? $post['m1'] : 0;

            // preload all village data, since we're retrieving some of those separately below
            $database->getVillage($village->wid);

            $availableWood = $database->getWoodAvailable($village->wid);
            $availableClay = $database->getClayAvailable($village->wid);
            $availableIron = $database->getIronAvailable($village->wid);
            $availableCrop = $database->getCropAvailable($village->wid);

            if($availableWood >= $wood && $availableClay >= $clay && $availableIron >= $iron && $availableCrop >= $crop)
            {
                $reqMerc = 1;

                if(($wood+$clay+$iron+$crop) > $this->maxcarry)
                {
                    $reqMerc = round(($wood+$clay+$iron+$crop)/$this->maxcarry);

                    if(($wood+$clay+$iron+$crop) > $this->maxcarry*$reqMerc) $reqMerc += 1;
                }
                if($this->merchantAvail() > 0 && $reqMerc <= $this->merchantAvail())
                {
                    if($database->modifyResource($village->wid,$wood,$clay,$iron,$crop,0))
                    {
                        $time = 0;
                        if(isset($_POST['d1'])) $time = $_POST['d2'] * 3600;
                        $alliance = (isset($post['ally']) && $post['ally'] == 1)? $session->userinfo['alliance'] : 0;
                        $database->addMarket($village->wid,$post['rid1'],$post['m1'],$post['rid2'],$post['m2'],$time,$alliance,$reqMerc,0);
                    }
                    // Enough merchants
                    header("Location: build.php?id=".$post['id']."&t=2");
                    exit;
                }
                else
                {
                    // Not enough merchants
                    header("Location: build.php?id=".$post['id']."&t=2&e3");
                    exit;
                }
            }
            else
            {
                // not enough resources
                header("Location: build.php?id=".$post['id']."&t=2&e1");
                exit;
            }
        }
    }

    private function acceptOffer($get)
    {
        global $database,$village,$session,$logging,$generator;

        $infoarray = $database->getMarketInfo($get['g']);
        $reqMerc = 1;
        if($infoarray['wamt'] > $this->maxcarry)
        {
            $reqMerc = round($infoarray['wamt']/$this->maxcarry);
            if($infoarray['wamt'] > $this->maxcarry*$reqMerc)
            {
                $reqMerc += 1;
            }
        }
        
        // We don't have enough resources
        if($infoarray['wamt'] > ([$village->awood, $village->aclay, $village->airon, $village->acrop])[$infoarray['wtype'] - 1])
        {
            header("Location: build.php?id=".$get['id']."&t=1&e1");
            exit;
        } // We're accepting the offering from the same village/of another alliance/with a too high maxtime
        elseif     
        (($infoarray['vref'] == $village->wid) ||
        ($infoarray['alliance'] > 0 && $infoarray['alliance'] != $session->alliance) ||
        ($infoarray['maxtime'] > 0 && ($infoarray['maxtime'] * 3600) < $generator->procDistanceTime($database->getCoor($infoarray['vref']), $village->coor, $session->tribe, 0)))
        {
            header("Location: build.php?id=".$get['id']."&t=1&e2");
            exit;
        } // We don't have enough merchants
        elseif($reqMerc > $this->merchantAvail()){ 
            header("Location: build.php?id=".$get['id']."&t=1&e3");
            exit;
        }
        
        $myresource = $hisresource = [ 1=> 0, 0, 0, 0];
        $myresource[$infoarray['wtype']] = $infoarray['wamt'];
        $mysendid = $database->sendResource($myresource[1],$myresource[2],$myresource[3],$myresource[4],$reqMerc,0);
        $hisresource[$infoarray['gtype']] = $infoarray['gamt'];
        $hissendid = $database->sendResource($hisresource[1],$hisresource[2],$hisresource[3],$hisresource[4],$infoarray['merchant'],0);
        $hiscoor = $database->getCoor($infoarray['vref']);
        $mytime = $generator->procDistanceTime($hiscoor,$village->coor,$session->tribe,0);
        $targettribe = $database->getUserField($database->getVillageField($infoarray['vref'],"owner"),"tribe",0);
        $histime = $generator->procDistanceTime($village->coor,$hiscoor,$targettribe,0);
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
		$database->modifyResource($village->wid, $resource[1], $resource[2], $resource[3], $resource[4], 0);
		$database->setMarketAcc($get['g']);
		$database->removeAcceptedOffer($get['g']);
		$logging->addMarketLog($village->wid, 2, [$infoarray['vref'], $get['g']]);
		header("Location: build.php?id=" . $get['id']);
        exit;
    }

    private function loadOnsale()
    {
        global $database,$village,$session,$multisort,$generator;

        $displayarray = $database->getMarket($village->wid,1);
        $holderarray = [];
        foreach($displayarray as $value)
        {
            $targetcoor = $database->getCoor($value['vref']);
            $duration = $generator->procDistanceTime($targetcoor, $village->coor, $session->tribe, 0);
            if($duration <= ($value['maxtime'] * 3600) || $value['maxtime'] == 0)
            {
                $value['duration'] = $duration;
                array_push($holderarray,$value);
            }
        }
        $this->onsale = $multisort->sorte($holderarray, "duration", true, 2);
    }

    private function filterNeed($get)
    {
        if(isset($get['v']) || isset($get['s']) || isset($get['b'])){
			$holder = $holder2 = [];
			if(isset($get['v']) && $get['v'] == "1:1"){
				foreach($this->onsale as $equal){
					if($equal['wamt'] <= $equal['gamt']){
						array_push($holder, $equal);
					}
				}
			}
			else $holder = $this->onsale;			
			
			foreach($holder as $sale){
				if(isset($get['s']) && isset($get['b'])){
					if($sale['gtype'] == $get['s'] && $sale['wtype'] == $get['b']){
						array_push($holder2, $sale);
					}
				}else if(isset($get['s']) && !isset($get['b'])){
					if($sale['gtype'] == $get['s']){
						array_push($holder2, $sale);
					}
				}else if(isset($get['b']) && !isset($get['s'])){
					if($sale['wtype'] == $get['b']){
						array_push($holder2, $sale);
					}
				}
				else $holder2 = $holder;
			}
			$this->onsale = $holder2;
        }
        else $this->loadOnsale();
    }

    private function tradeResource($post)
    {
        global $session,$database,$village;

        $wwvillage = $database->getResourceLevel($village->wid);
        if($wwvillage['f99t'] != 40){
            if($session->userinfo['gold'] >= 3){
                // check that we're not trying to sell more resources that we actually have
                if (
                  (int) $post['m2'][0] < 0 && round($village->awood) + (int) $post['m2'][0] < 0
                  ||
                  (int) $post['m2'][1] < 0 && round($village->aclay) + (int) $post['m2'][1] < 0
                  ||
                  (int) $post['m2'][2] < 0 && round($village->airon) + (int) $post['m2'][2] < 0
                  ||
                  (int) $post['m2'][3] < 0 && round($village->acrop) + (int) $post['m2'][3] < 0
                ) {
                    header("Location: build.php?id=".$post['id']."&t=3");
                    exit;
                }

                //Check if there are too many resources
                if ( ((int) $post['m2'][0] + (int) $post['m2'][1] + (int) $post['m2'][2] + (int) $post['m2'][3] ) <= ( round($village->awood) + round($village->aclay) + round($village->airon) + round($village->acrop) ) ) {
                    $database->setVillageField(
                        $village->wid,
                        ["wood", "clay", "iron", "crop"],
                        [$post['m2'][0], $post['m2'][1], $post['m2'][2], $post['m2'][3]]
                    );
                    $database->modifyGold($session->uid, 3, 0);
                    header("Location: build.php?id=".$post['id']."&t=3&c");
                    exit;
                } else {
                    header("Location: build.php?id=".$post['id']."&t=3");
                    exit;
                }
            }else{
                header("Location: build.php?id=".$post['id']."&t=3");
                exit;
            }
        }
    }
};

$market = new Market;
?>
