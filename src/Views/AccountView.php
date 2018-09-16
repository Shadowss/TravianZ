<?php
namespace TravianZ\Views;

use TravianZ\Mvc\View;
use TravianZ\Models\AccountModel;

class AccountView extends View
{
    /**
     * @var string The base template to render
     */
    const BASE_TEMPLATE = 'baseNotLoggedIn.tpl';

    /**
     * @var \Smarty
     */
    private $smarty;
    
    public function __construct(AccountModel $model, string $viewName)
    {
        parent::__construct($model, $viewName);
        $this->smarty = new \Smarty();
    }
    
    /**
     * Render the view
     */
    public function render(float $executionTime)
    {
        // Set the template to include
        $this->smarty->assign('templateToRender', TEMPLATES_DIR . '/account/' . strtolower($this->name) . '.tpl');

        // Get the datas
        $this->smarty->assign($this->getDatasToShow());
        
        // Render the template file
        $this->smarty->display(TEMPLATES_DIR.self::BASE_TEMPLATE);
    }
}