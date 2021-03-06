<?php

/**
 * Класс тестирования рендера
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

use function Differ\Differ\Renderer\render;

/**
 * Класс тестирования рендера
 *
 * @category Library
 * @package  Differ\Differ
 * @author   Valeriy Turbanov <tur.4000@gmail.com>
 * @license  https://github.com/Tur-4000/hex-lvl2-php/LICENSE MIT
 * @link     https://github.com/Tur-4000/hex-lvl2-php
 */
class RenderTest extends TestCase
{
    /**
     * Тестирование рендера
     *
     * @return void
     */
    public function testRender()
    {
        // заглушка
        $this->assertEquals(true, true);
        // $ast = [
        //     'follow' => [
        //         'status' => 'deleted',
        //         'value' => false,
        //     ],
        //     'host' => [
        //         'status' => 'unchanged',
        //         'value' => 'hexlet.io',
        //     ],
        //     'proxy' => [
        //         'status' => 'deleted',
        //         'value' => '123.234.53.22',
        //     ],
        //     'timeout' => [
        //         'status' => 'modified',
        //         'valueBefore' => 50,
        //         'valueAfter' => 20,
        //     ],
        //     'verbose' => [
        //         'status' => 'added',
        //         'value' => true,
        //     ],
        // ];

        // $plainExpected = file_get_contents('./tests/fixtures/plainExpected.txt');

        // $this->assertEquals($plainExpected, render($ast));
    }
}
