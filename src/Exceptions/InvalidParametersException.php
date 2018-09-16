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

namespace TravianZ\Exceptions;

/**
 * Custom exception to handle exception thrown by inserting
 * invalid parameters in a GET/POST request
 * 
 * @author iopietro
 */
class InvalidParametersException extends \Exception
{
    /**
     * @var array the Message containing the parameters informations
     */
    private $parameters;

    public function __construct(array $parameters = [], $message = null, $code = null, $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->setParameters($parameters);
    }

    /**
     * Get the exception parameters
     * 
     * @return array
     */
    public function getParameters(): array
    {
        return $this->parameters;
    }

    /**
     * Set the exception parameters
     *
     * @param array $parameters
     */
    private function setParameters(array $parameters)
    {
        $this->parameters = $parameters;
    }
}
