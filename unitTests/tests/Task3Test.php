<?php

use PHPUnit\Framework\TestCase;
require_once 'task3.php';  // Подключаем тестируемый файл

class Task3Test extends TestCase
{
    // Тест с обычным текстом и сдвигом
    public function testCeasarCipherWithPositiveShift()
    {
        $text = "Пример";
        $key = 3;
        $result = ceasarCipher($text, $key);
        $this->assertEquals('Тулпзх', $result);  // ожидаемое зашифрованное слово
    }

    // Тест с нулевым сдвигом
    public function testCeasarCipherWithZeroShift()
    {
        $text = "Пример";
        $key = 0;
        $result = ceasarCipher($text, $key);
        $this->assertEquals('Пример', $result);  // текст должен остаться таким же
    }

    // Тест с символами, которые не должны изменяться
    public function testCeasarCipherWithSymbols()
    {
        $text = "Пример, тест!";
        $key = 4;
        $result = ceasarCipher($text, $key);

        // Вывод длины строк для сравнения
        echo "\nExpected Length: " . mb_strlen('Тулпзх, фицх!') . "\n";
        echo "Got Length: " . mb_strlen($result) . "\n";

        $this->assertEquals('Тулпзх, фицх!', $result);  // символы и знаки препинания не должны изменяться
    }
}