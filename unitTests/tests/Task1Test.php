<?php
use PHPUnit\Framework\TestCase;

class Task1Test extends TestCase
{
    public function testMostRecent()
    {
        $this->assertEquals('example', mostRecent('This is an example text example'));
        $this->assertEquals('Text contain over 1000 symbols.', mostRecent(str_repeat("word ", 1001)));
    }
}