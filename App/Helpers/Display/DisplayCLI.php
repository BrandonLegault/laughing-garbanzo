<?php
declare(strict_types=1);
namespace App\Helpers\Display;

class DisplayCLI implements IDisplay {
    function displayPlayers(array $players): void
    {
        echo "Current Players: \n";
        foreach ($players as $player) {
            echo "\tName: {$player->getName()}\n";
            echo "\tAge: {$player->getAge()}\n";
            echo "\tSalary: {$player->getSalary()}\n";
            echo "\tJob: {$player->getJob()}\n\n";
        }
    }
}