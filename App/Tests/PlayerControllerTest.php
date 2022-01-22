<?php

namespace App\Controllers;

use App\Helpers\Display\DisplayCLI;
use App\Helpers\Display\DisplayWeb;
use App\Models\Player;
use App\Repositories\PlayerRepository;
use PHPUnit\Framework\TestCase;

class PlayerControllerTest extends TestCase
{
    private static $JSON_FILENAME = 'playerdata.json';
    private static $jsonFilePath;
    private static $playerController;

    public static function setUpBeforeClass(): void
    {
        $playerRepository = new PlayerRepository();
        $display = php_sapi_name() === 'cli' ? new DisplayCLI() : new DisplayWeb();
        self::$playerController = new PlayerController($playerRepository, $display);

        self::$jsonFilePath = dirname(getcwd()) . "\\Resources\\" . self::$JSON_FILENAME;
    }

    public function testReadPlayersArray()
    {
        $playersSTDClass = array_map(function ($player) {
            $this->assertInstanceOf(Player::class, $player);
            return $player->toSTDClass();
        }, self::$playerController->readPlayers('array'));

        $this->assertIsArray($playersSTDClass);
        $this->assertCount(4, $playersSTDClass);
        $this->assertContains("Jonas Valenciunas", array_column($playersSTDClass, 'name'));
    }

    public function testReadPlayersJSON()
    {
        $playersSTDClass = self::$playerController->readPlayers('json');

        $this->assertIsArray($playersSTDClass);
        $this->assertCount(4, $playersSTDClass);
        $this->assertContains("Jonas Valenciunas", array_column($playersSTDClass, 'name'));
    }

    public function testReadPlayersFile()
    {
        $playersSTDClass = self::$playerController->readPlayers('file', self::$jsonFilePath);

        $this->assertIsArray($playersSTDClass);
        $this->assertGreaterThanOrEqual(4, $playersSTDClass);
        $this->assertContains("Jonas Valenciunas", array_column($playersSTDClass, 'name'));

    }

    public function testWritePlayerArray()
    {
        $player = new Player("test_name", 1, "test_job", "test_salary");
        self::$playerController->writePlayer("array", $player);

        $players = self::$playerController->getRepository()->playersArray;
        $this->assertIsArray($players);
        $this->assertCount(1, $players);
        $this->assertContains($player, $players);
    }

    public function testWritePlayerJSON()
    {
        $player = new Player("test_name", 1, "test_job", "test_salary");
        self::$playerController->writePlayer("json", $player);

        $players = self::$playerController->getRepository()->playersArray;
        $this->assertIsArray($players);
        $this->assertCount(1, $players);
        $this->assertContains($player, $players);
    }

    public function testWritePlayerFile()
    {
        $player = new Player("test_name", 1, "test_job", "test_salary");
        self::$playerController->writePlayer("file", $player, self::$jsonFilePath);

        $playersSTDClass = self::$playerController->readPlayers('file', self::$jsonFilePath);
        $this->assertIsArray($playersSTDClass);
        $this->assertGreaterThanOrEqual(4, $playersSTDClass);
        $this->assertContains($player->getName(), array_column($playersSTDClass, 'name'));
    }
}
