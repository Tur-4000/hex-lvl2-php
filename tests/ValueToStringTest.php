<?php

namespace Differ\Differ\Tests;

use PHPUnit\Framework\TestCase;

use function Differ\Differ\Renderer\valueToString;

class ValueToStringTest extends TestCase
{
    public function testValueToString1()
    {
        $this->assertEquals('true', valueToString(true));
        $this->assertEquals('false', valueToString(false));
        $this->assertEquals('null', valueToString(null));
        $this->assertEquals('value', valueToString('value'));
        $this->assertEquals('42', valueToString(42));
        $this->assertEquals('[1, 2, 3]', valueToString([1, 2, 3]));
    }
}
