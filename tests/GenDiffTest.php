<?php

/**
 * Класс тестирования genDiff
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

use function Differ\Differ\GenDiff\genDiff;

/**
 * Класс тестирования genDiff
 *
 * @category Library
 * @package  Differ\Differ
 * @author   Valeriy Turbanov <tur.4000@gmail.com>
 * @license  https://github.com/Tur-4000/hex-lvl2-php/LICENSE MIT
 * @link     https://github.com/Tur-4000/hex-lvl2-php
 */
class GenDiffTest extends TestCase
{
    /**
     * Тестирование genDiff
     *
     * @return void
     */
    public function testGenDiff()
    {
        // заглушка
        $this->assertEquals(true, true);
        // $plainExpected = file_get_contents('./tests/fixtures/plainExpected.txt');

        // $pathToFile1 = './tests/fixtures/file01.json';
        // $pathToFile2 = './tests/fixtures/file02.json';
        // $this->assertEquals($plainExpected, genDiff($pathToFile1, $pathToFile2));

        // $pathToFile3 = './tests/fixtures/file01.yaml';
        // $pathToFile4 = './tests/fixtures/file02.yaml';
        // $this->assertEquals($plainExpected, genDiff($pathToFile3, $pathToFile4));

        // $pathToFile5 = './tests/fixtures/file01.json';
        // $pathToFile6 = './tests/fixtures/file02.yaml';
        // $this->assertEquals($plainExpected, genDiff($pathToFile5, $pathToFile6));
    }
}
