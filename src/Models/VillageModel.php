<?php

/*
 * This file is part of the TravianZ Project
 *
 * Source code: <https://github.com/Shadowss/TravianZ/>
 *
 * Author: iopietro <https://github.com/iopietro>
 *
 * License: GNU GPL-3.0 <https://github.com/Shadowss/TravianZ/blob/master/LICENSE>
 *
 * Copyright 2010-2018 TravianZ Team
 */

namespace TravianZ\Models;

use TravianZ\Mvc\Model;
use TravianZ\Data\Validator;
use TravianZ\Database\Database;
use TravianZ\Account\Session;
use TravianZ\Account\ISessionBase;
use TravianZ\Entity\Village;
use TravianZ\Data\GetInformations;

/**
 * @author iopietro
 */
class VillageModel extends Model
{
    use GetInformations;
    
    /**
     * @var int
     */
    private $time;

    /**
     * @var ISessionBase
     */
    private $session;
    
    public function __construct(){
        parent::__construct();
        $this->validator = new Validator();

        // Create the Session
        $this->session = new Session(Database::getInstance());
        
        // Set the object creation time
        $this->time = time();
    }

    /**
     * Default dorf1 method, called when there are no action
     *
     * @param array $parameters
     * @return array
     */
    public function defaultDorf1(array $parameters): array
    {
        if (isset($parameters['GET']['newdid'])) {
            $this->session->getUser()->changeSelectedVillage($parameters['GET']['newdid']);
        }

        $selectedVillage = new Village(
            Database::getInstance(), 
            $this->session->getUser(),
            $this->session->getUser()->selectedVillage,
            false
        );

        // Initialize the whole village
        $selectedVillage->initAll();
        
        if ($parameters['GET']['buildingFinish'] == 1) {
            $selectedVillage->finishAll();
        } elseif (isset($parameters['GET']['d'])) {
            $selectedVillage->removeBuildingJob($parameters['GET']['d'], $this->session->getUser()->tribe);
        }
        
        return array_merge(
            $this->getSessionInformations($this->session),
            $this->getVillageInformations($selectedVillage),
            $this->getVillagesInformations($this->session->getUser()->getVillages())
         );
    }
    
    /**
     * Default dorf2 method, called when there are no action
     *
     * @param array $parameters
     * @return array
     */
    public function defaultDorf2(array $parameters): array
    {
        if (isset($parameters['GET']['newdid'])) {
            $this->session->getUser()->changeSelectedVillage($parameters['GET']['newdid']);
        }

        $selectedVillage = new Village(
            Database::getInstance(),
            $this->session->getUser(),
            $this->session->getUser()->selectedVillage,
            false
        );

        // Initialize the whole village
        $selectedVillage->initAll();
        
        if ($parameters['GET']['buildingFinish'] == 1) {
            $selectedVillage->finishAll();
        } elseif (isset($parameters['GET']['d'])) {
            $selectedVillage->removeBuildingJob($parameters['GET']['d']);
        }

        return array_merge(
            $this->getSessionInformations($this->session), 
            $this->getVillageInformations($selectedVillage),
            $this->getVillagesInformations($this->session->getUser()->getVillages())
        );
    }
    
    /**
     * Default dorf3 method, called when there are no action
     *
     * @param array $parameters
     * @return array
     */
    public function defaultDorf3(array $parameters): array
    {
        if (isset($parameters['GET']['newdid'])) {
            $this->session->getUser()->changeSelectedVillage($parameters['GET']['newdid']);
        }
        
        // Initialize the selected village
        foreach ($this->session->getUser()->getVillages() as $village) {
            // Find the selected village
            if ($village->vref == $this->session->getUser()->selectedVillage) {
                $selectedVillage = $village;
                break;
            }
        }
        
        // Initialize the selected village
        $selectedVillage->initAll();
        
        // Set the villages information
        //TODO: Use the Villages class to do it in a single query rather than using a foreach
        switch ($parameters['GET']['s']) {
            case 2:
                foreach ($this->session->getUser()->getVillages() as $village) {
                    if ($village->vref != $selectedVillage->vref) {
                        $village->setBuildings();
                        $village->setOasis();
                        $village->setMovements();
                        $village->setMerchants();
                    }
                }
                break;
            case 3:
                foreach ($this->session->getUser()->getVillages() as $village) {
                    if ($village->vref != $selectedVillage->vref) {
                        $village->setBuildings();
                        $village->setOasis();
                        $village->setEnforcements();
                        $village->setUnits();
                        $village->setTrappedUnits();
                        $village->setMovements();
                        $village->setUpkeep();
                        $village->setProduction();
                        $village->setMerchants();
                    }
                }
                break;
            case 4:
                foreach ($this->session->getUser()->getVillages() as $village) {
                    if ($village->vref != $selectedVillage->vref) {
                        $village->setBuildings();
                        $village->setSlots();
                        $village->setOasis();
                        $village->setEnforcements();
                        $village->setUnits();
                        $village->setTrappedUnits();
                        $village->setMovements();
                    }
                }
                break;
            case 5:
                foreach ($this->session->getUser()->getVillages() as $village) {
                    if ($village->vref != $selectedVillage->vref) {
                        $village->setOasis();
                        $village->setUnits();
                        $village->setEnforcements();
                        $village->setTrappedUnits();
                        $village->setMovements();
                        $village->setUpkeep();
                    }
                }
                break;
            default:  
                foreach ($this->session->getUser()->getVillages() as $village) {
                    if ($village->vref != $selectedVillage->vref) {
                        $village->setOasis();
                        $village->setBuildings();
                        $village->setBuildingJobs();
                        $village->setUnitsInTraining();
                        $village->setMovements();
                        $village->setMerchants();
                    }
                }
        }

        return array_merge(
            $this->getSessionInformations($this->session),
            $this->getVillageInformations($selectedVillage),
            $this->getVillagesInformations($this->session->getUser()->getVillages()),
            ['parameters' => ['s' => $parameters['GET']['s']]]
        );
    }
}
