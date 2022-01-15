<?php
declare(strict_types=1);
namespace App\Controllers;

use App\Repositories\PlayerRepository;
use App\Helpers\View;

class PlayerController implements IReadWritePlayers {
    private $repository;

    public function __construct(PlayerRepository $repository) {
        $this->repository = $repository;
    }

    function readPlayers($source, $filename = null): array
    {
        $playerData = null;

        switch ($source) {
            case 'array':
                $playerData = $this->repository->getPlayerDataArray();
                break;
            case 'json':
                $playerData = $this->repository->getPlayerDataJson();
                break;
            case 'file':
                $playerData = $this->repository->getPlayerDataFromFile($filename);
                break;
        }

        if (is_string($playerData)) {
            $playerData = json_decode($playerData); // convert json string to array of STDClass objects
        }
        return $playerData;
    }

    function writePlayer($source, $player, $filename = null): void
    {
        switch ($source) {
            case 'array':
                $this->repository->playersArray[] = $player;
                break;
            case 'json':
                $this->repository->playersArray = [];
                if ($this->repository->playerJsonString) {
                    $this->repository->playersArray = json_decode($this->repository->playerJsonString); // convert to array of stdClass objects
                }
                $this->repository->playersArray[] = $player;
                $this->repository->playerJsonString = json_encode($player); // convert back to json string
                break;
            case 'file':
                $players = json_decode($this->repository->getPlayerDataFromFile($filename)); // convert to array of stdClass objects
                if (!$players) {
                    $players = [];
                }
                $players[] = $player->toSTDClass(); // to be able to write to file
                file_put_contents($filename, json_encode($players)); // convert back to json string
                break;
        }
    }

    function display($isCLI, $source, $filename = null): void
    {
        $players = $this->readPlayers($source, $filename);

        if ($isCLI) {
            echo "Current Players: \n";
            foreach ($players as $player) {
                echo "\tName: {$player->getName()}\n";
                echo "\tAge: {$player->getAge()}\n";
                echo "\tSalary: {$player->getSalary()}\n";
                echo "\tJob: {$player->getJob()}\n\n";
            }
        } else { // web
            $view = new View('players');
            $view->set('players', $players);
            $view->render();
        }
    }

    public function getRepository(): PlayerRepository
    {
        return $this->repository;
    }
}
