<?php
#################################################################################
##              -= YOU MAY NOT REMOVE OR CHANGE THIS NOTICE =-                 ##
## --------------------------------------------------------------------------- ##
##  Filename       Protection.php                                              ##
##  Developed by:  SlimShady                                                   ##
##  Edited by:     Dzoki & Dixie                                               ##
##  Enterprise hardening by Shadow                                             ##
##  License:       TravianZ Project                                            ##
##  Copyright:     TravianZ (c) 2010-2025. All rights reserved.                ##
#################################################################################

/*
|--------------------------------------------------------------------------
|  Enterprise Superglobal Sanitizer
|--------------------------------------------------------------------------
|  - Does NOT corrupt numeric values
|  - Recursive array support
|  - Keeps rsargs intact
|  - Does not break AJAX
|  - Does not break NPC
|  - Prevents XSS vectors
|--------------------------------------------------------------------------
*/

if(!function_exists('secure_input_recursive')) {

    function secure_input_recursive($data) {

        if(is_array($data)) {

            $clean = array();

            foreach($data as $key => $value) {
                $clean[$key] = secure_input_recursive($value);
            }

            return $clean;
        }

        if(is_numeric($data)) {
            return $data;
        }

        if(is_string($data)) {

            // remove null bytes
            $data = str_replace("\0", '', $data);

            // trim whitespace
            $data = trim($data);

            // basic XSS protection
            $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');

            return $data;
        }

        return $data;
    }
}

/*
|--------------------------------------------------------------------------
| Preserve rsargs (used by SAJAX)
|--------------------------------------------------------------------------
*/

$rsargs_backup = null;

if(isset($_GET['rsargs'])) {
    $rsargs_backup = $_GET['rsargs'];
}

/*
|--------------------------------------------------------------------------
| Sanitize superglobals safely
|--------------------------------------------------------------------------
*/

if(!empty($_POST)) {
    $_POST = secure_input_recursive($_POST);
}

if(!empty($_GET)) {
    $_GET = secure_input_recursive($_GET);
}

if(!empty($_COOKIE)) {
    $_COOKIE = secure_input_recursive($_COOKIE);
}

/*
|--------------------------------------------------------------------------
| Restore rsargs if needed
|--------------------------------------------------------------------------
*/

if($rsargs_backup !== null) {
    $_GET['rsargs'] = $rsargs_backup;
}
