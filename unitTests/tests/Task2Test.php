<?php

use PHPUnit\Framework\TestCase;
require_once 'task2.php';

class Task2Test extends TestCase
{
    // Тест с дубликатами
    public function testArrayUniqueWithDuplicates()
    {
        $array = [1, 2, 2, 3, 4, 4, 5];
        $result = arrayUnique($array);
        $this->assertEquals([1, 2, 3, 4, 5], $result); // проверяем, что дубликаты удалены
    }

    // Тест с пустым массивом
    public function testArrayUniqueWithEmptyArray()
    {
        $array = [];
        $result = arrayUnique($array);
        $this->assertEmpty($result); // ожидаем, что результат будет пустым
    }

    // Тест с массивом, который уже уникален
    public function testArrayUniqueWithUniqueArray()
    {
        $array = [1, 2, 3, 4, 5];
        $result = arrayUnique($array);
        $this->assertEquals([1, 2, 3, 4, 5], $result); // массив должен остаться таким же
    }
}