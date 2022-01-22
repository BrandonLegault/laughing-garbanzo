<?php
declare(strict_types=1);
namespace App\Repositories;

use App\Models\Player;

class PlayerRepository implements IDataSource {
    public $playersArray;
    public $playerJsonString;

    public function __construct() {
        $this->playersArray = [];
        $this->playerJsonString = "";
    }

    function getPlayerDataArray(): array
    {
        $players = [];

        $jonas = new Player(
            'Jonas Valenciunas',
            '26',
            'Center',
            '4.66m'
        );
        $kyle = new Player(
            'Kyle Lowry',
            '32',
            'Point Guard',
            '28.7m'
        );
        $demar = new Player(
            'Demar DeRozan',
            '28',
            'Shooting Guard',
            '26.54m'
        );
        $jakob = new Player(
            'Jakob Poeltl',
            '22',
            'Center',
            '2.704m'
        );

        $players[] = $jonas;
        $players[] = $kyle;
        $players[] = $demar;
        $players[] = $jakob;

        return $players;
    }

    function getPlayerDataJson(): string
    {
        $json = '[
            {"name":"Jonas Valenciunas","age":26,"job":"Center","salary":"4.66m"},
            {"name":"Kyle Lowry","age":32,"job":"Point Guard","salary":"28.7m"},
            {"name":"Demar DeRozan","age":28,"job":"Shooting Guard","salary":"26.54m"},
            {"name":"Jakob Poeltl","age":22,"job":"Center","salary":"2.704m"}
        ]';
        return $json;
    }

    function getPlayerDataFromFile(string $filename): string
    {
        $file = file_get_contents($filename);
        return $file;
    }

    function writePlayerArray($player): void
    {
        $this->playersArray[] = $player;
    }

    function writePlayerJSON($player): void
    {
        $this->playersArray = [];
        if ($this->playerJsonString) {
            $this->playersArray = json_decode($this->playerJsonString); // convert to array of stdClass objects
        }
        $this->playersArray[] = $player;
        $this->playerJsonString = json_encode($player); // convert back to json string
    }

    function writePlayerFile($filename, $player): void
    {
        $players = json_decode($this->getPlayerDataFromFile($filename)); // convert to array of stdClass objects
        if (!$players) {
            $players = [];
        }
        $players[] = $player->toSTDClass(); // to be able to write to file
        file_put_contents($filename, json_encode($players)); // convert back to json string
    }
}


