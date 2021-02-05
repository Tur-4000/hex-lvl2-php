<?php

namespace Tur4000\Differ\Tests;

use PHPUnit\Framework\TestCase;

use function Tur4000\Differ\Renderer\render;

class RenderTest extends TestCase
{
    public function testRender()
    {
        $ast = [
            'follow' => [
                'status' => 'deleted',
                'value' => false,
            ],
            'host' => [
                'status' => 'unchanged',
                'value' => 'hexlet.io',
            ],
            'proxy' => [
                'status' => 'deleted',
                'value' => '123.234.53.22',
            ],
            'timeout' => [
                'status' => 'modified',
                'valueBefore' => 50,
                'valueAfter' => 20,
            ],
            'verbose' => [
                'status' => 'added',
                'value' => true,
            ],
        ];

        $plainExpected = file_get_contents('./tests/fixtures/plainExpected.txt');

        $this->assertEquals($plainExpected, render($ast));
    }
}
