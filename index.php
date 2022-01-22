<?php
declare(strict_types=1);
require_once 'vendor/autoload.php';

use App\Helpers\Display\DisplayCLI;
use App\Helpers\Display\DisplayWeb;
use App\Repositories\PlayerRepository;
use App\Controllers\PlayerController;

$playerRepository = new PlayerRepository();
$display = php_sapi_name() === 'cli' ? new DisplayCLI() : new DisplayWeb();
$playerController = new PlayerController($playerRepository, $display); // could use setters too

$playerController->display('array');