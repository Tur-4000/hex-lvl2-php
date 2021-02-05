<?php

namespace Tur4000\Differ\Tests;

use PHPUnit\Framework\TestCase;

use function Tur4000\Differ\Renderer\boolToString;

class BoolToStringTest extends TestCase
{
    public function testBoolToString1()
    {
        $this->assertEquals('true', boolToString(true));
        $this->assertEquals('false', boolToString(false));
    }
}
