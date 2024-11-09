<?php
use PHPUnit\Framework\TestCase;

class Task2Test extends TestCase
{
    public function testArrayUnique()
    {
        $this->assertEquals([1, 2, 3, 4, 5], arrayUnique([1, 2, 2, 3, 4, 4, 5]));
        $this->assertEquals(['a', 'b', 'c'], arrayUnique(['a', 'a', 'b', 'c', 'c']));
    }
}