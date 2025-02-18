<?php


interface Shape
{
    public function getArea();
}

class Square implements Shape
{
    private $side;

    public function __construct($side)
    {
        $this->side = $side;
    }

    public function getArea()
    {
        return $this->side * $this->side;
    }
}

class Triangle implements Shape
{
    private $base;
    private $height;

    public function __construct($base, $height)
    {
        $this->base = $base;
        $this->height = $height;
    }

    public function getArea()
    {
        return 0.5 * $this->base * $this->height;
    }
}

class Calculator
{
    public function calculateTotalArea($shapes)
    {
        $totalArea = 0;

        foreach ($shapes as $shape) {
            $totalArea += $shape->getArea();
        }

        return $totalArea;
    }
}


$shapes = [
    new Square(4),
    new Triangle(4, 4),
];


$calculator = new Calculator();
echo "Общая площадь фигур: " . $calculator->calculateTotalArea($shapes);