<?php

/**
 * 
 * ROUTER
 *
 */

define('ROOT', dirname(__DIR__) . DIRECTORY_SEPARATOR);
define('APP', ROOT . 'app' . DIRECTORY_SEPARATOR);

require_once APP . 'config/config.php';
require_once APP . 'config/constants.php';


// load application class
require_once APP . 'core/application.php';
require_once APP . 'core/controller.php';

// start the application
$app = new  Application();
