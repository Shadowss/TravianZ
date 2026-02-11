<?php

#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       Form.php                                                    ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2025. All rights reserved.                ##
##                                                                             ##
#################################################################################

class Form
{
    private array $errorarray = [];
    public array $valuearray = [];
    private int $errorcount = 0;

    public function __construct()
    {
        if (
            isset($_SESSION['errorarray'], $_SESSION['valuearray']) &&
            is_array($_SESSION['errorarray']) &&
            is_array($_SESSION['valuearray'])
        ) {

            // Defensive copy (avoid reference issues)
            $this->errorarray = $this->sanitizeArray($_SESSION['errorarray']);
            $this->valuearray = $this->sanitizeArray($_SESSION['valuearray']);
            $this->errorcount = count($this->errorarray);

            unset($_SESSION['errorarray'], $_SESSION['valuearray']);
        }
    }

    /* ==============================
       INTERNAL SANITIZER
    ============================== */

    private function sanitizeArray(array $array): array
    {
        $clean = [];

        foreach ($array as $key => $value) {

            // Force string keys
            $safeKey = (string)$key;

            // Prevent object injection / unexpected types
            if (is_scalar($value) || is_null($value)) {
                $clean[$safeKey] = $value;
            } else {
                $clean[$safeKey] = '';
            }
        }

        return $clean;
    }

    /* ==============================
       PUBLIC API (UNCHANGED BEHAVIOR)
    ============================== */

    public function addError($field, $error): void
    {
        $this->errorarray[(string)$field] = $error;
        $this->errorcount = count($this->errorarray);
    }

    public function getError($field)
    {
        return $this->errorarray[(string)$field] ?? "";
    }

    public function getValue($field)
    {
        return $this->valuearray[(string)$field] ?? "";
    }

    public function setValue($field, $value): void
    {
        $this->valuearray[(string)$field] = $value;
    }

    public function getDiff($field, $cookie)
    {
        $field = (string)$field;

        if (isset($this->valuearray[$field]) && $this->valuearray[$field] != $cookie) {
            return $this->valuearray[$field];
        }

        return $cookie;
    }

    public function getRadio($field, $value)
    {
        $field = (string)$field;

        if (isset($this->valuearray[$field]) && $this->valuearray[$field] == $value) {
            return "checked";
        }

        return "";
    }

    public function returnErrors(): int
    {
        return $this->errorcount;
    }

    public function getErrors(): array
    {
        return $this->errorarray;
    }
}
