<?php
declare(strict_types=1);
namespace App\Models;

use stdClass;

class Player {
    private $name;
    private $age;
    private $job;
    private $salary;

    public function __construct(string $name, string $age, string $job, string $salary) {
        $this->name = $name;
        $this->age = $age;
        $this->job = $job;
        $this->salary = $salary;
    }

    public function toSTDClass(): stdClass
    {
        $obj = new stdClass;
        $obj->name = $this->getName();
        $obj->age = $this->getAge();
        $obj->job = $this->getJob();
        $obj->salary = $this->getSalary();
        return $obj;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getAge(): string {
        return $this->age;
    }

    public function getJob(): string {
        return $this->job;
    }

    public function getSalary(): string {
        return $this->salary;
    }
}

