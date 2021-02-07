<?php

/**
 * Тесты buildAst
 * php version 7.4
 *
 * @category Library
 * @package  Differ\Differ
 * @author   Valeriy Turbanov <tur.4000@gmail.com>
 * @license  https://github.com/Tur-4000/hex-lvl2-php/LICENSE MIT
 * @link     https://github.com/Tur-4000/hex-lvl2-php
 */

namespace Differ\Differ\Tests;

use PHPUnit\Framework\TestCase;

use function Differ\Differ\Parsers\buildAst;

/**
 * Класс тестирования buildAst
 *
 * @category Library
 * @package  Differ\Differ
 * @author   Valeriy Turbanov <tur.4000@gmail.com>
 * @license  https://github.com/Tur-4000/hex-lvl2-php/LICENSE MIT
 * @link     https://github.com/Tur-4000/hex-lvl2-php
 */
class BuildAstTest extends TestCase
{
    /**
     * Тестирование buildAst
     *
     * @return void
     */
    public function testBuildAst()
    {
        $expected1 = [
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

        $this->assertEquals($expected1, buildAst($data1, $data2));

        $expected2 = new \stdClass();
        $expected2->follow = ['state' => 'deleted', 'value' => false,];
        $expected2->host = ['state' => 'unchanged', 'value' => 'hexlet.io',];
        $expected2->proxy = ['state' => 'deleted', 'value' => '123.234.53.22',];
        $expected2->timeout = [
            'state' => 'modified',
            'valueBefore' => 50,
            'valueAfter' => 20
        ];
        $expected2->verbose = ['status' => 'added', 'value' => true,];
    }
}
