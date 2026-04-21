<?php

interface AreaCalculable {
    public function getArea(): float;
}

abstract class Figure {
    protected float $area;
    protected string $color;
    protected int $sidesCount;

    abstract public function infoAbout(): string;
}

class Rectangle extends Figure implements AreaCalculable {
    private float $a;
    private float $b;
    const SIDES_COUNT = 4;

    public function __construct(float $a, float $b) {
        $this->a = $a;
        $this->b = $b;
        $this->sidesCount = self::SIDES_COUNT;
    }

    public function getArea(): float {
        return $this->a * $this->b;
    }

    public function infoAbout(): string {
        return "Это класс прямоугольника. У него " . $this->sidesCount . " стороны.";
    }
}

class Square extends Figure implements AreaCalculable {
    private float $a;
    const SIDES_COUNT = 4;

    public function __construct(float $a) {
        $this->a = $a;
        $this->sidesCount = self::SIDES_COUNT;
    }

    public function getArea(): float {
        return $this->a * $this->a;
    }

    public function infoAbout(): string {
        return "Это класс квадрата. У него " . $this->sidesCount . " стороны.";
    }
}

class Triangle extends Figure implements AreaCalculable {
    private float $a;
    private float $b;
    private float $c;
    const SIDES_COUNT = 3;

    public function __construct(float $a, float $b, float $c) {
        $this->a = $a;
        $this->b = $b;
        $this->c = $c;
        $this->sidesCount = self::SIDES_COUNT;
    }

    public function getArea(): float {
        $p = ($this->a + $this->b + $this->c) / 2;
        return sqrt($p * ($p - $this->a) * ($p - $this->b) * ($p - $this->c));
    }

    public function infoAbout(): string {
        return "Это класс треугольника. У него " . $this->sidesCount . " стороны.";
    }
}

$rect1 = new Rectangle(5, 10);
$rect2 = new Rectangle(3, 7);

$square1 = new Square(6);
$square2 = new Square(4);

$triangle1 = new Triangle(3, 4, 5);
$triangle2 = new Triangle(5, 5, 6);

echo "<h2>Площади фигур:</h2>";
echo "Прямоугольник 1: " . $rect1->getArea() . "<br>";
echo "Прямоугольник 2: " . $rect2->getArea() . "<br>";
echo "Квадрат 1: " . $square1->getArea() . "<br>";
echo "Квадрат 2: " . $square2->getArea() . "<br>";
echo "Треугольник 1: " . number_format($triangle1->getArea(), 2) . "<br>";
echo "Треугольник 2: " . number_format($triangle2->getArea(), 2) . "<br>";

echo "<h2>Информация о фигурах:</h2>";
echo $rect1->infoAbout() . "<br>";
echo $square1->infoAbout() . "<br>";
echo $triangle1->infoAbout() . "<br>";

?>