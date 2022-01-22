<?php
declare(strict_types=1);
namespace App\Controllers;

use App\Helpers\Display\IDisplay;
use App\Repositories\PlayerRepository;

class PlayerController implements IReadWritePlayers {
    private $repository;
    private $display;

    public function __construct(PlayerRepository $repository, IDisplay $display) {
        $this->repository = $repository;
        $this->display = $display;
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
                $this->repository->writePlayerArray($player);
                break;
            case 'json':
                $this->repository->writePlayerJSON($player);
                break;
            case 'file':
                $this->repository->writePlayerFile($filename, $player);
                break;
        }
    }

    function display($source, $filename = null): void
    {
        $players = $this->readPlayers($source, $filename);
        $this->display->displayPlayers($players);
    }

    public function getRepository(): PlayerRepository
    {
        return $this->repository;
    }
}
