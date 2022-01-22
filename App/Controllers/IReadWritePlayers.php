<?php
declare(strict_types=1);
namespace App\Controllers;

interface IReadWritePlayers {
    function readPlayers($source, $filename = null): array;
    function writePlayer($source, $player, $filename = null): void;
    function display($source, $filename = null): void;
}

