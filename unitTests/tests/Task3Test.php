<?php

use PHPUnit\Framework\TestCase;
require_once 'task3.php';  // Подключение файла для тестирования

class Task3Test extends TestCase
{
    // Тест с текстом и положительным сдвигом
    public function testCeasarCipherWithPositiveShift()
    {
        $text = "Пример";
        $key = 3;
        $result = ceasarCipher($text, $key);
        $this->assertEquals('Тулпзх', $result);  // ожидаемый результат
    }

    // Тест с текстом и нулевым сдвигом
    public function testCeasarCipherWithZeroShift()
    {
        $text = "Пример";
        $key = 0;
        $result = ceasarCipher($text, $key);
        $this->assertEquals($text, $result);  // текст должен остаться таким же
    }

    // Тест с текстом, содержащим символы
    public function testCeasarCipherWithSymbols()
    {
        $text = "Пример, тест!";
        $key = 4;
        $result = ceasarCipher($text, $key);
        $this->assertEquals('Тулпзх, фицх!', $result);  // символы не должны изменяться
    }
}