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

namespace TravianZ\Controllers;

use TravianZ\Models\AccountModel;
use TravianZ\Models\VillageModel;
use TravianZ\Views\AccountView;
use TravianZ\Views\VillageView;
use TravianZ\Mvc\Model;
use TravianZ\Mvc\View;
use TravianZ\Mvc\Controller;
use TravianZ\Entity\Timer;
use TravianZ\Models\BuildingModel;
use TravianZ\Views\BuildingView;

/**
 * Elaborates every user's request, by following an MVC pattern
 *
 * @author iopietro
 */
class FrontController
{
    /**
     * @var string The default executed action
     */
    const DEFAULT_ACTION = 'default';

    /**
     * @var int Calculates the script execution time
     */
    private $timer;
    
    /**
     * @var string The method that need to be called
     */
    private $type;

    /**
     * The method that need to be called
     *
     * @var string
     */
    private $action;

    /**
     * @var Controller
     */
    private $controller;

    /**
     * @var Model
     */
    private $model;

    /**
     * @var View
     */
    private $view;

    /**
     * @var array The request parameters
     */
    private $parameters = [];

    public function __construct()
    {
        $this->timer = new Timer();
        $parsedUrl = $this->parseURL($_SERVER['REQUEST_URI']);
        $this->set($parsedUrl['controller']);
        $this->setParameters($parsedUrl['parameters']);
        $this->setAction($parsedUrl['action']);
        $this->executeAction($this->controller, $this->action, $this->type, $this->parameters);
        $this->model->notify();
        $this->view->render($this->timer->getExecutionTime());
    }

    /**
     * Obtain the chosen controller and the GET/POST parameters from the passed URL
     *
     * @param string $request
     *            The URL to be parsed
     * @return array Returns the controller and the GET/POST parameters
     */
    private function parseURL(string $request): array
    {
        // Check if the request is empty
        if (empty($request)) {
            return [
                'action' => '',
                'controller' => [],
                'parameters' => []
            ];
        }
        
        // Variables initialization
        $action = '';
        $parameters = [];
        
        // Clean-up the URL, by removing GET parameters and useless characters
        $controller = trim(strtok($request, '?'), '/');
        
        // Check if there are some GET parameters
        if (!empty($_GET)) {
            $parameters['GET'] = $_GET;
        }
        
        // Check if there are some POST parameters
        if (!empty($_POST)) {
            $parameters['POST'] = $_POST;
        }

        // Check the action that have to be executed, accepted actions are POST only
        if (isset($parameters['POST']['action'])) {
            $action = $parameters['POST']['action'];
        }

        // Return the combined array
        return [
            'action' => $action,
            'controller' => $controller,
            'parameters' => $parameters
        ];
    }

    /**
     * Set the model, view and controller according to the passed string
     *
     * @param string $type
     *            The controller, model and view type
     */
    private function set(string $type)
    {
        // Replace the .php extension
        $type = str_replace('.php', '', $type);

        // For now, we can't use a better system
        switch ($type) {
            case 'login':
            case 'logout':
            case 'anmelden':
            case 'activate':
            case 'password':
                $this->model = new AccountModel();
                $this->view = new AccountView($this->model, $type);
                $this->controller = new AccountController($this->model);
                break;
            case 'dorf1':
            case 'dorf2':
            case 'dorf3':
                $this->model = new VillageModel();
                $this->view = new VillageView($this->model, $type);
                $this->controller = new VillageController($this->model);
                break;
            case 'build':
                $this->model = new BuildingModel();
                $this->view = new BuildingView($this->model, $type);
                $this->controller = new BuildingController($this->model);
        }
        
        // Attack the view to the model
        $this->model->attach($this->view);
        
        // Set the first char to uppercase
        $this->type = ucfirst($type);
    }

    /**
     * Set the value of the $parameters property
     *
     * @param array $parameters
     */
    private function setParameters(array $parameters)
    {
        $this->parameters = $parameters;
    }

    /**
     * Set the method we want to execute
     *
     * @param string $action
     */
    private function setAction(string $action)
    {
        $this->action = $action;
    }

    /**
     * Execute the requested method
     *
     * @param $object
     * @param $action
     * @param $type
     * @param $parameters
     */
    private function executeAction($object, string $action, string $type, array $parameters = [])
    {
        // If the method exists, call it, otherwise call the default method
        if ($action != '' && method_exists($object, $action)) {
            call_user_func_array([$object, $this->action], [$parameters]);
        } else {
            call_user_func_array([$object, self::DEFAULT_ACTION], [self::DEFAULT_ACTION.$type, $parameters]);
        }
    }
}
