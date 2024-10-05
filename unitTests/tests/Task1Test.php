<?php

use PHPUnit\Framework\TestCase;
require_once 'task1.php';

class Task1Test extends TestCase
{
    // Тест с обычным текстом
    public function testMostRecentWithNormalText()
    {
        $text = "This is example text, this example contain one same word";
        $result = mostRecent($text);
        $this->assertEquals('this', $result); // ожидаемое самое частое слово
    }

    // Тест с текстом более 1000 символов
    public function testMostRecentWithLongText()
    {
        $longText = str_repeat("This is example text, ", 100); // больше 1000 символов
        $result = mostRecent($longText);
        $this->assertEquals('Text contain over 1000 symbols.', $result); // проверяем ограничение в 1000 символов
    }

    // Тест с пустым текстом
    public function testMostRecentWithEmptyText()
    {
        $emptyText = "";
        $result = mostRecent($emptyText);
        $this->assertEmpty($result); // ожидаем, что вернётся пустой результат
    }
}