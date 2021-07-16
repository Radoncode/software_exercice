<?php
// config for reporting errors ONLY for development
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// AUTOLOADER of composer
require_once dirname(__DIR__).'/vendor/autoload.php';
require_once dirname(__DIR__).'/app/config/config.php';

use App\Controllers\UserController;
use App\Router;
use App\Entities\Staff;

// Router
$router = new Router(dirname(__DIR__)."/Views");
$router->get('/', 'home')
        ->post('/', 'home')
        ->run();


