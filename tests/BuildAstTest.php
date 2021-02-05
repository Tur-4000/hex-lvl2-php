<?php

namespace Tur4000\Differ\Tests;

use PHPUnit\Framework\TestCase;

use function Tur4000\Differ\Parsers\buildAst;

class BuildAstTest extends TestCase
{
    public function testBuildAst()
    {
        $expected = [
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
        $data1 = new \stdClass();
        $data1->host = 'hexlet.io';
        $data1->timeout = 50;
        $data1->proxy = '123.234.53.22';
        $data1->follow = false;

        $data2 = new \stdClass();
        $data2->timeout = 20;
        $data2->verbose = true;
        $data2->host = 'hexlet.io';

        $this->assertEquals($expected, buildAst($data1, $data2));
    }
}
