<?php

namespace TravianZ\Mvc;

abstract class Controller
{
    /**
     * @var Model The controller model
     */
    protected $model = null;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Redirect to the passed URL
     *
     * @param string $url
     */
    protected function redirect($url)
    {
        header('location: '.$url);
        exit;
    }
    
    /**
     * The default method to call
     * 
     * @param string $name
     * @param array $parameters
     */
    abstract public function default(string $name, array $parameters);
}
