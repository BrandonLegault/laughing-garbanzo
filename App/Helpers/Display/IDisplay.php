<?php
declare(strict_types=1);
namespace App\Helpers\Display;

interface IDisplay {
    function displayPlayers(array $players): void;
}