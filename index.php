<?php
use TravianZ\Controllers\FrontController;

define("ROOT_DIR", __DIR__ . DIRECTORY_SEPARATOR);
define("TEMPLATES_DIR", ROOT_DIR . 'templates' . DIRECTORY_SEPARATOR);
define("ASSETS_DIR", ROOT_DIR . 'assets' . DIRECTORY_SEPARATOR);
define("CONFIG_DIR", ROOT_DIR . 'config' . DIRECTORY_SEPARATOR);
define("SRC_DIR", ROOT_DIR . 'src' . DIRECTORY_SEPARATOR);
define("VENDOR_DIR", ROOT_DIR . 'vendor' . DIRECTORY_SEPARATOR);

require CONFIG_DIR . 'config.php';
require SRC_DIR . 'Lang\en.php';
require VENDOR_DIR . 'autoload.php';

$frontController = new FrontController();