<?php

namespace Differ\Differ\Tests;

use PHPUnit\Framework\TestCase;

use function Differ\Differ\Renderer\boolToString;

class BoolToStringTest extends TestCase
{
    public function testBoolToString1()
    {
        $this->assertEquals('true', boolToString(true));
        $this->assertEquals('false', boolToString(false));
    }
}
