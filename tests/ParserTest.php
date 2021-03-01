<?php

/**
 * Тесты file parser
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

use function Differ\Differ\Parsers\parseFile;

/**
 * Класс тестирования parser
 *
 * @category Library
 * @package  Differ\Differ
 * @author   Valeriy Turbanov <tur.4000@gmail.com>
 * @license  https://github.com/Tur-4000/hex-lvl2-php/LICENSE MIT
 * @link     https://github.com/Tur-4000/hex-lvl2-php
 */
class ParserTest extends TestCase
{
    public function testParser()
    {
        $expected1 = new \StdClass();
        $expected1->host = 'hexlet.io';
        $expected1->timeout = 50;
        $expected1->proxy = '123.234.53.22';
        $expected1->follow = false;
        $ymlData1 = parseFile('./tests/fixtures/file01.yaml');
        $jsonData1 = parseFile('./tests/fixtures/file01.json');
        $this->assertEquals($expected1, $ymlData1);
        $this->assertEquals($expected1, $jsonData1);

        $expected2 = new \StdClass();
        $expected2->timeout = 20;
        $expected2->verbose = true;
        $expected2->host = 'hexlet.io';
        $ymlData2 = parseFile('./tests/fixtures/file02.yml');
        $jsonData2 = parseFile('./tests/fixtures/file02.json');
        $this->assertEquals($expected2, $ymlData2);
        $this->assertEquals($expected2, $jsonData2);
    }
}
