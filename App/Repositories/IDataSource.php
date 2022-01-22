<?php
declare(strict_types=1);
namespace App\Repositories;

interface IDataSource {
    function getPlayerDataArray(): array; // array of Players
    function getPlayerDataJson(): string; // JSON string of Players
    function getPlayerDataFromFile(string $filename): string; // file string of Players
}

