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

namespace TravianZ\Views;

use TravianZ\Mvc\View;
use TravianZ\Models\BuildingModel;

/**
 * @author iopietro
 */
class BuildingView extends View
{
    /**
     * @var string The base template to render
     */
    const BASE_TEMPLATE = 'base.tpl';
    
    /**
     * @var \Smarty
     */
    private $smarty;
    
    public function __construct(BuildingModel $model, string $viewName)
    {
        parent::__construct($model, $viewName);
        $this->smarty = new \Smarty();
    }
    
    /**
     * Render the view
     */
    public function render(float $executionTime)
    {
        // Set the execution time
        $this->smarty->assign('executionTime', $executionTime);

        // Set the template to include
        $this->smarty->assign('templateToRender', TEMPLATES_DIR . '/village/' . strtolower($this->name) . '.tpl');
        
        // Get the datas
        $this->smarty->assign($this->getDatasToShow());
        
        // Render the template file
        $this->smarty->display(TEMPLATES_DIR.self::BASE_TEMPLATE);
    }
}