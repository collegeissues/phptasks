<?php
use PHPUnit\Framework\TestCase;

class Task3Test extends TestCase
{
    public function testCeasarCipher()
    {
        $this->assertEquals('Вгзш', ceasarCipher('Абуф', 3));
        $this->assertEquals('Абуф', ceasarCipher('Вгзш', -3));
    }
}