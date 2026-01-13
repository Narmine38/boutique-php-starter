<?php

class Car {
    public string $brand;
    public string $model;
    public int $year;

    public function __construct(string $brand, string $model, int $year) {
        $this->brand = $brand;
        $this->model = $model;
        $this->year = $year;
    }

    public function getAge(): int {
        return (int)date('Y') - $this->year;
    }

    public function display(): string {
        return "{$this->brand} {$this->model} ({$this->getAge()} ans)";
    }
}

$car1 = new Car("Peugeot", "208", 2020);
$car2 = new Car("Renault", "Clio", 2018);
$car3 = new Car("Tesla", "Model 3", 2022);

echo $car1->display() . PHP_EOL;
echo $car2->display() . PHP_EOL;
echo $car3->display() . PHP_EOL;
