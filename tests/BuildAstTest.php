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

// use function Differ\Differ\Parsers\buildAst;
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
    /**
     * Тестирование buildAst
     *
     * @return void
     */
    public function testBuildAst()
    {
        $this->assertEquals((new \stdClass()), genAst(new \stdClass(), new \stdClass()));

        $expected1 = new \stdClass();
        $expected1->verbose = ['state' => 'added', 'value' => true,];
        $expected1->follow = ['state' => 'deleted', 'value' => false,];
        $expected1->host = ['state' => 'unchanged', 'value' => 'hexlet.io',];
        $expected1->proxy = ['state' => 'deleted', 'value' => '123.234.53.22',];
        $expected1->timeout = [
            'state' => 'modified',
            'valueBefore' => 50,
            'valueAfter' => 20
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

        $expected2 = new \stdClass();
        $expected2->key1 = ['state' => 'unchanged', 'value' => 'val1',];
        $expected2->key2 = [
            'state' => 'modified',
            'valueBefore' => 'val2',
            'valueAfter' => 'val3',
        ];
        $expected2->key3 = [
            'state' => 'modified',
            'valueBefore' => $val1,
            'valueAfter' => $val2,
        ];

        $this->assertEquals($expected2, genAst($data3, $data4));
    }
}
