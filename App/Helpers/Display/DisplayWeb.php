<?php
declare(strict_types=1);
namespace App\Helpers\Display;

use App\Helpers\View;

class DisplayWeb implements IDisplay
{
    function displayPlayers(array $players): void
    {
        $view = new View('players');
        $view->set('players', $players);
        $view->render();
    }
}