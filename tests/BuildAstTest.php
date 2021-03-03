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
use function Differ\Differ\Parsers\genAst;

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
    public function testBuildAst()
    {
        // заглушка
        // $this->assertEquals(true, true);

        $data01 = new \stdClass();
        $data01->host = 'hexlet.io';
        $data01->timeout = 50;
        $data01->proxy = '123.234.53.22';
        $data01->follow = false;

        $data02 = new \stdClass();
        $data02->timeout = 20;
        $data02->verbose = true;
        $data02->host = 'hexlet.io';

        $expected01 = [
            'follow' => ['type' => 'value', 'status' => 'deleted', 'value' => false],
            'host' => ['type' => 'value', 'status' => 'unchanged', 'value' => 'hexlet.io'],
            'proxy' => ['type' => 'value', 'status' => 'deleted', 'value' => '123.234.53.22'],
            'timeout' => ['type' => 'value', 'status' => 'modified', 'valueBefore' => 50, 'valueAfter' => 20],
            'verbose' => ['type' => 'value', 'status' => 'added', 'value' => true],
        ];

        $this->assertEquals($expected01, buildAst($data01, $data02));
/*
        $set01 = new \stdClass();
        $set01->key1 = 1;

        $data03 = new \stdClass();
        $data03->host = 'hexlet.io';
        $data03->timeout = 50;
        $data03->proxy = '123.234.53.22';
        $data03->follow = false;
        $data03->dataset01 = $set01;

        $data04 = new \stdClass();
        $data04->timeout = 20;
        $data04->verbose = true;
        $data04->host = 'hexlet.io';

        $expected02 = [
            'follow' => ['type' => 'value', 'status' => 'deleted', 'value' => false],
            'host' => ['type' => 'value', 'status' => 'unchanged', 'value' => 'hexlet.io'],
            'proxy' => ['type' => 'value', 'status' => 'deleted', 'value' => '123.234.53.22'],
            'timeout' => ['type' => 'value', 'status' => 'modified', 'valueBefore' => 50, 'valueAfter' => 20],
            'verbose' => ['type' => 'value', 'status' => 'added', 'value' => true],
            'dataset01' => ['type' => 'node', 'status' => 'added', 'value' => [
                'key1' => ['type' => 'value', 'status' => 'added', 'value' => 1],
            ]]
        ];

        $this->assertEquals($expected02, buildAst($data03, $data04));
*/
    }

    /**
     * Тестирование genAst
     *
     * @return void
     */
    public function testGenAst()
    {
        $this->assertEquals([], genAst(new \stdClass(), new \stdClass()));

        $expected1 = [
            'verbose' => ['type' => 'added', 'value' => true,],
            'follow' => ['type' => 'deleted', 'value' => false,],
            'host' => ['type' => 'unchanged', 'value' => 'hexlet.io',],
            'proxy' => ['type' => 'deleted', 'value' => '123.234.53.22',],
            'timeout' => ['type' => 'modified', 'old' => 50, 'new' => 20],
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

        $this->assertEquals($expected1, genAst($data1, $data2));

        $val1 = new \stdClass();
        $val1->set1 = 1;
        $val1->set2 = 2;
        $val1->set4 = 5;
        $data3 = new \stdClass();
        $data3->key1 = 'val1';
        $data3->key2 = 'val2';
        $data3->key3 = $val1;

        $val2 = new \stdClass();
        $val2->set1 = 1;
        $val2->set2 = 3;
        $val2->set3 = 4;
        $data4 = new \stdClass();
        $data4->key1 = 'val1';
        $data4->key2 = 'val3';
        $data4->key3 = $val2;

        $expected2 = [
            'key1' => ['type' => 'unchanged', 'value' => 'val1',],
            'key2' => ['type' => 'modified', 'old' => 'val2', 'new' => 'val3'],
            'key3' => [
                'type' => 'nested',
                'children' => [
                    'set1' => ['type' => 'unchanged', 'value' => 1,],
                    'set2' => ['type' => 'modified', 'old' => 2, 'new' => 3,],
                    'set3' => ['type' => 'added', 'value' => 4,],
                    'set4' => ['type' => 'deleted', 'value' => 5,],
                ],
            ]
        ];

        $this->assertEquals($expected2, genAst($data3, $data4));
    }
}
