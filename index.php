<?php
declare(strict_types=1);
require_once 'vendor/autoload.php';

use App\Repositories\PlayerRepository;
use App\Controllers\PlayerController;

$playerRepository = new PlayerRepository();
$playerController = new PlayerController($playerRepository);

$playerController->display(php_sapi_name() === 'cli', 'array');