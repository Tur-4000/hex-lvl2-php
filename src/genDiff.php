<?php

/**
 * Библиотека сравнения файлов json и yaml
 * php version 7.4
 * 
 * @category Library
 * @package  Tur4000\Differ
 * @author   Valeriy Turbanov <tur.4000@gmail.com>
 * @license  https://github.com/Tur-4000/hex-lvl2-php/LICENSE MIT
 * @link     https://github.com/Tur-4000/hex-lvl2-php
 */
namespace Tur4000\Differ\GenDiff;

use function Tur4000\Differ\Parsers\parser;
use function Tur4000\Differ\Renderer\render;

/**
 * Generate diff fromm 2 json or yaml files
 * 
 * @param string $file1  path to first file
 * @param string $file2  path to second file
 * @param string $format format of output string, default 'stylish'
 * 
 * @return string
 */
function genDiff(string $file1, string $file2, string $format = 'stylish'): string
{
    $ast = parser($file1, $file2);

    $diff = render($ast, $format);

    return $diff;
}
